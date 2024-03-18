<?php
$path=$_SERVER['DOCUMENT_ROOT'];
require_once($path.'/pool/libs/composer/vendor/autoload.php'); // Path to Stripe library

function makePayout($amount, $currency, $destinationAccountId) {
    \Stripe\Stripe::setApiKey('sk_test_51KBe3uBG6J77VsYBuVQP8Yav2DrZk3GFri8GKWJm0iv6G5CayB55YhBYZQZd7RlOFQ9JjU5vHO46gL8N1nkDqucU005pbBYCpp');

    try {
        $payout = \Stripe\Payout::create([
            'amount' => $amount,
            'currency' => $currency,
            'destination' => $destinationAccountId
        ]);

        // Payout was successful, you can handle the response here

        return $payout; // Optional: return the payout object
    } catch (\Stripe\Exception\CardException $e) {
        // Handle card errors
        $error = $e->getError();
        // Log or display error message
    } catch (\Stripe\Exception\RateLimitException $e) {
        // Handle rate limit errors
    } catch (\Stripe\Exception\InvalidRequestException $e) {
        // Handle invalid request errors
    } catch (\Stripe\Exception\AuthenticationException $e) {
        // Handle authentication errors
    } catch (\Stripe\Exception\ApiConnectionException $e) {
        // Handle API connection errors
    } catch (\Stripe\Exception\ApiErrorException $e) {
        // Handle generic API errors
    }

    return false; // Payout failed
}

function createExternalAccount($connectAccountId, $externalAccountDetails) {
    \Stripe\Stripe::setApiKey('YOUR_STRIPE_SECRET_KEY');

    try {
        $account = \Stripe\Account::retrieve($connectAccountId);
        $externalAccount = $account->external_accounts->create($externalAccountDetails);

        // External account created successfully, you can handle the response here

        return $externalAccount; // Return the created external account object
    } catch (\Stripe\Exception\CardException $e) {
        // Handle card errors
        $error = $e->getError();
        // Log or display error message
    } catch (\Stripe\Exception\RateLimitException $e) {
        // Handle rate limit errors
    } catch (\Stripe\Exception\InvalidRequestException $e) {
        // Handle invalid request errors
    } catch (\Stripe\Exception\AuthenticationException $e) {
        // Handle authentication errors
    } catch (\Stripe\Exception\ApiConnectionException $e) {
        // Handle API connection errors
    } catch (\Stripe\Exception\ApiErrorException $e) {
        // Handle generic API errors
    }

    return false; // Creating external account failed
}

// Example usage:
$payoutAmount = 1000; // Amount in cents/pennies
$payoutCurrency = 'cad'; // Currency code
$destinationAccount = 'acct_1N9zLpPfWGqGGrHK'; // The Stripe account ID to receive the payout

$result = makePayout($payoutAmount, $payoutCurrency, $destinationAccount);

if ($result) {
    echo "Payout was successful";
} else {
    echo  "Payout failed, handle the error";
}
?>
