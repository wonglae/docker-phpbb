# Stripe lifetime VIP integration

This fork replaces the extension's PayPal checkout and IPN route with Stripe-hosted Checkout and signed webhooks. It sells exactly one permanent membership term:

- Price: CNY 100.00, tax inclusive
- Duration: unlimited (`0` days)
- Payment type: one time
- Fulfillment: add the buyer to the package's configured phpBB groups
- Full refund or dispute: deactivate the matching entitlement and run the package's end actions

Existing subscription, transaction, and group membership rows are preserved by the `1.3.0` migration.

## Server secrets

Supply these values to the PHP container at runtime. Never put their real values in the image, this repository, or phpBB's ACP.

```text
STRIPE_SECRET_KEY=sk_test_...        # use sk_live_... for production
STRIPE_WEBHOOK_SECRET=whsec_...
STRIPE_TAX_CODE=txcd_...             # optional; Stripe Tax default is used when omitted
```

A restricted `rk_test_...` or `rk_live_...` key also works if it has permission to create Checkout Sessions. Hosted Checkout does not require a publishable key in this integration.

For Azure Container Instances, add the first two variables as `secureValue` entries in the container's `environmentVariables`. Keep the actual values in the deployment system, not a committed YAML file.

## Stripe Dashboard

1. Enable Stripe Tax and confirm the US business address, registrations, and default product tax code.
2. In **Payment methods**, enable Alipay and WeChat Pay for Checkout. Card payments can remain enabled as a fallback. The code uses Stripe's dynamic payment methods, so Stripe only displays methods eligible for the account, currency, device, and customer.
3. Create a live webhook endpoint at:

   `https://www.wowang.net/groupsub/stripe/webhook`

4. Subscribe the endpoint to:

   - `checkout.session.completed`
   - `checkout.session.async_payment_succeeded`
   - `charge.refunded`
   - `charge.dispute.created`

5. Copy that endpoint's `whsec_...` signing secret into `STRIPE_WEBHOOK_SECRET`. Test and live endpoints have different secrets.

Stripe Dashboard receipt emails can remain enabled. The integration also passes the logged-in phpBB email as the PaymentIntent receipt address.

## phpBB ACP

When upgrading an existing installation, disable the extension in ACP **without deleting its data**, deploy the new image, and enable it again. Enabling runs the `1.3.0` database migration. Never choose **Delete data** during this upgrade.

Under **Extensions > Group Subscription**:

1. Confirm the package representing VIP has exactly one term with price `100.00`, currency `CNY`, and unlimited duration (`0`).
2. Configure its start action to add the user to the `VIP` group.
3. Configure its end action to remove the user from the `VIP` group.
4. Open **Settings**, confirm both Stripe credentials show as configured, and enable payments.

Only logged-in users without an active entitlement can start Checkout. The server independently validates the user, term, currency, amount, and unlimited duration again when the signed webhook arrives.

## Safe rollout without a staging site

Deploy first with Stripe test credentials and a test webhook endpoint. Complete a test purchase, replay its webhook once to confirm idempotency, then test a full refund and verify VIP is removed. Afterward, replace both values with live credentials, restart the container, and register the live webhook endpoint before enabling payments.

The success-page redirect does not grant access. A verified paid webhook is the only path that creates the permanent entitlement.
