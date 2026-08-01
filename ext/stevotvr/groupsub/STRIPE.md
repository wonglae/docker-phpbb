# Stripe lifetime VIP integration

This fork replaces the extension's PayPal checkout and IPN route with Stripe-hosted Checkout and signed webhooks. It supports multiple phpBB package terms as one-time membership purchases:

- Price and currency: supplied dynamically by each configured term, tax inclusive
- Duration: supplied by each term, including unlimited (`0` days)
- Payment type: one time
- Fulfillment: add the buyer to the package's configured phpBB groups
- Full refund or dispute: deactivate the matching entitlement and run the package's end actions

Existing subscription, transaction, and group membership rows are preserved by the `1.3.0` migration.

## Server secrets

Enter the first two values in **ACP > Extensions > Group Subscription > Settings**. They are stored in phpBB's `config_text` database table and are never displayed back in the form. Leave an existing field blank when saving other settings to keep its current value.

```text
STRIPE_SECRET_KEY=sk_test_...        # use sk_live_... for production
STRIPE_WEBHOOK_SECRET=whsec_...
STRIPE_TAX_CODE=txcd_...             # optional; Stripe Tax default is used when omitted
```

A restricted `rk_test_...` or `rk_live_...` key also works if it has permission to create Checkout Sessions. Hosted Checkout does not require a publishable key in this integration. Protect database backups because they contain these secrets.

Environment variables remain supported as a fallback when a value has not been saved in the database. Never put real values in the image or repository.

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

1. Give every purchasable package term a positive price, a supported currency, and the intended duration (`0` means unlimited).
2. Configure each package's start actions to grant the intended groups or permissions.
3. Configure each package's end actions to revoke those groups or permissions.
4. Open **Settings**, enter both Stripe credentials, save, confirm they show as configured, and enable payments.

Only logged-in users without an active entitlement for that package can start Checkout. The server independently loads the selected term and validates the user, currency, and exact amount again when the signed webhook arrives.

## Safe rollout without a staging site

Deploy first with Stripe test credentials and a test webhook endpoint. Complete a test purchase, replay its webhook once to confirm idempotency, then test a full refund and verify VIP is removed. Afterward, replace both values with live credentials, restart the container, and register the live webhook endpoint before enabling payments.

The success-page redirect does not grant access. A verified paid webhook is the only path that creates the permanent entitlement.
