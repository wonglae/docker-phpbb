# Stripe testing and go-live guide

This guide describes the required sequence for testing the Group Subscription Stripe integration locally, testing the deployed container with Stripe sandbox credentials, and finally switching the website to live payments.

The integration supports multiple package terms as one-time purchases:

- Price and currency: configured per term
- Duration: configured per term; `0` days means unlimited
- Payment type: one time
- Successful fulfillment: add the purchaser to the configured VIP group
- Full refund or dispute: deactivate the entitlement and run the package end actions

Do not proceed to a later phase until every acceptance check in the current phase passes.

## Understand the credentials

Stripe test and live environments are separate. Never mix credentials between them.

| Environment | API secret key | Webhook signing secret | Payments |
| --- | --- | --- | --- |
| Local test via Stripe CLI | `sk_test_...` | `whsec_...` printed by `stripe listen` | Test only |
| Deployed sandbox test | `sk_test_...` | `whsec_...` from the sandbox Dashboard destination | Test only |
| Production live | `sk_live_...` | `whsec_...` from the live Dashboard destination | Real money |

The webhook signing secrets in these three rows are different. A CLI signing secret must not be used for a Dashboard webhook destination.

The phpBB integration needs the server-side secret key. It does not use the `pk_test_...` or `pk_live_...` publishable key.

Secrets entered in the phpBB ACP are stored in the database and are not displayed again. Leaving a secret field blank preserves its existing value. Database values take precedence over environment-variable fallbacks.

## Prerequisites

Before testing, confirm the Group Subscription configuration:

1. The extension is enabled.
2. Payments are enabled under **ACP > Extensions > Group Subscription > Settings**.
3. Every purchasable package term has a positive price, a supported currency, and the intended duration.
4. The package start action adds the purchaser to the VIP group.
5. The package end action removes the purchaser from the VIP group.
6. The test user does not already have an active entitlement for the package.

The Checkout button is intentionally hidden for free terms or unsupported currencies.

## Phase 1: Local test with Stripe CLI

### 1. Install and authenticate the CLI

On Windows with Node.js 18 or later:

```powershell
npm install -g @stripe/cli
stripe login
```

Confirm the CLI is authenticated to the same Stripe account that owns the `sk_test_...` key saved in phpBB.

### 2. Stop old listeners

Stop every existing `stripe listen` command with `Ctrl+C`. Run only one listener during a test. Multiple listeners can use different signing secrets and make diagnosis confusing.

### 3. Start the local listener

Run this exact command in one PowerShell window:

```powershell
stripe listen --forward-to http://localhost:8080/app.php/groupsub/stripe/webhook
```

The local route includes `/app.php`. Keep this PowerShell window open for the entire test.

The listener prints a signing secret:

```text
Ready! Your webhook signing secret is whsec_...
```

Copy that newly printed value. Do not reuse a secret from a stopped listener.

### 4. Configure local phpBB

Open **ACP > Extensions > Group Subscription > Settings** and configure:

```text
Stripe secret key:             sk_test_...
Stripe webhook signing secret: whsec_... printed by the active listener
Payments enabled:              Yes
```

If the correct API secret key is already saved, leave that field blank when updating only the webhook secret.

### 5. Complete a test Checkout

Keep the listener running and open:

```text
http://localhost:8080/app.php/groupsub/subs
```

Sign in as a user without an active VIP entitlement and purchase the VIP term. Use Stripe's standard test card:

```text
Card number: 4242 4242 4242 4242
Expiry:      Any future date
CVC:         Any three digits
Name:        Any name
```

The success-page redirect does not grant VIP access. The signed webhook is the only fulfillment path.

### 6. Verify the listener response

A successful delivery resembles:

```text
checkout.session.completed
[200] POST http://localhost:8080/app.php/groupsub/stripe/webhook
```

Do not count the local test as passed without HTTP `200`.

### 7. Verify application state

Confirm all of the following:

- A record appears under **ACP > Group Subscription > Transactions**.
- A record appears under **ACP > Group Subscription > Subscriptions**.
- The purchaser belongs to the VIP group.
- The public subscription page reports that the purchaser is subscribed.

Then issue a full test refund in Stripe and verify:

- The listener receives `charge.refunded` with HTTP `200`.
- The entitlement is deactivated.
- The package end action removes the user from the VIP group.

Local testing has passed only after purchase fulfillment and refund revocation both work.

## Phase 2: Test the deployed container in Stripe sandbox mode

This phase tests the real public routing, TLS certificate, reverse proxy, deployed database, and direct Stripe-to-website delivery. The Stripe CLI is not used.

### 1. Deploy safely

Deploy the image while keeping the phpBB database on persistent storage. Replacing the container must not replace or erase the database.

Keep the deployed site configured with a Stripe `sk_test_...` key during this phase.

### 2. Confirm the public webhook route

The production-style endpoint is:

```text
https://www.wowang.net/groupsub/stripe/webhook
```

It must be publicly accessible over HTTPS. A browser or unsigned request can return an error because the route only accepts signed Stripe webhook requests; that does not by itself indicate a routing failure.

### 3. Create a sandbox Dashboard destination

In the Stripe Dashboard:

1. Select the intended sandbox or test mode.
2. Open **Workbench > Webhooks**.
3. Click **Create destination** or **Add destination**.
4. Select **Your account** as the event source.
5. Use the account-default API version.
6. Select **Webhook endpoint** as the destination type.
7. Enter:

   ```text
   https://www.wowang.net/groupsub/stripe/webhook
   ```

8. Subscribe to:
   - `checkout.session.completed`
   - `checkout.session.async_payment_succeeded`
   - `charge.refunded`
   - `charge.dispute.created`
9. Create the destination.
10. Reveal and copy the destination's `whsec_...` signing secret.

### 4. Configure deployed phpBB for sandbox testing

In the deployed phpBB ACP, save:

```text
Stripe secret key:             sk_test_...
Stripe webhook signing secret: whsec_... from the sandbox Dashboard destination
Payments enabled:              Yes
```

Do not use the local Stripe CLI signing secret here.

### 5. Test the deployed flow

Make a purchase on the public website using `4242 4242 4242 4242`, then verify:

- Stripe Workbench shows a successful HTTP `200` delivery.
- The deployed phpBB transaction exists.
- The deployed phpBB subscription exists.
- The purchaser joins the VIP group.

Issue a full sandbox refund and verify HTTP `200`, entitlement deactivation, and VIP-group removal.

The deployed sandbox test has passed only after both purchase and refund behavior succeed.

## Phase 3: Go live

### 1. Prepare live Stripe configuration

Switch the Stripe Dashboard to live mode and create a separate live webhook destination:

```text
https://www.wowang.net/groupsub/stripe/webhook
```

Subscribe it to the same four events:

- `checkout.session.completed`
- `checkout.session.async_payment_succeeded`
- `charge.refunded`
- `charge.dispute.created`

Copy the live destination's new `whsec_...` signing secret.

Also obtain the live server-side secret API key beginning with `sk_live_...`.

### 2. Cut over both credentials together

In the deployed phpBB ACP, replace both sandbox credentials in one maintenance window:

```text
sk_test_...         -> sk_live_...
sandbox whsec_...   -> live whsec_...
```

Never use a test key with a live signing secret or a live key with a sandbox signing secret.

### 3. Perform a controlled live test

Make a small real purchase with an eligible account and confirm:

- Stripe records the live payment.
- The live webhook delivery returns HTTP `200`.
- phpBB records the transaction and subscription.
- The user receives VIP access.

If practical, refund the controlled purchase and confirm the live revocation flow.

## Troubleshooting

### Checkout completes but phpBB has no transaction or subscription

The success redirect is not fulfillment. Check Stripe CLI output locally or **Workbench > Webhooks > Event deliveries** on a deployed site.

- No delivery attempt: the listener is stopped, the Dashboard destination is missing, the wrong Stripe environment is selected, or the event is not subscribed.
- HTTP `404`: the webhook URL is incorrect. Local Docker uses `/app.php/groupsub/stripe/webhook`; the deployed public route uses `/groupsub/stripe/webhook`.
- HTTP `400`: the saved `whsec_...` does not match the active listener or Dashboard destination.
- HTTP `500`: phpBB accepted the route but event processing failed; inspect phpBB administrative logs and container logs.
- HTTP `200` with no entitlement: inspect the package term, user metadata, start action, transaction records, and phpBB logs.

### Checkout button is missing

Confirm that the package term has a positive price in a supported currency and that the user has no active subscription for that package. The database stores prices in each currency's minor units, so CNY 100.00 is stored as `10000`.

### Listener command receives no events

Use the simplest command first:

```powershell
stripe listen --forward-to http://localhost:8080/app.php/groupsub/stripe/webhook
```

Avoid adding an event filter until the unfiltered flow passes. Confirm the CLI account matches the account that owns the saved `sk_test_...` key.

### Secrets appear saved but verification fails

Secret fields are intentionally not displayed after saving. Entering a new value replaces the stored value; leaving a field blank preserves it. Always copy the signing secret from the listener or Dashboard destination that will actually deliver the event.

### Container replacement loses records

Mount the database directory as persistent storage and include it in the backup plan. Stripe credentials saved through the ACP are also contained in that database, so protect database backups as secrets.

## Final go-live checklist

- [ ] Local test purchase delivered with HTTP `200`
- [ ] Local transaction and subscription created
- [ ] Local full refund removed the entitlement
- [ ] Deployed sandbox destination created
- [ ] Deployed sandbox purchase delivered with HTTP `200`
- [ ] Deployed transaction and subscription created
- [ ] Deployed sandbox refund removed the entitlement
- [ ] Database storage is persistent and backed up
- [ ] Live webhook destination created with the four required events
- [ ] Live `sk_live_...` and live `whsec_...` saved together
- [ ] Controlled live purchase delivered with HTTP `200`
- [ ] Live transaction, subscription, and VIP membership verified
