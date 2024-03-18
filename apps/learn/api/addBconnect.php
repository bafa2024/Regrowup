<?php
$path=$_SERVER['DOCUMENT_ROOT'];
require_once($path.'/pool/libs/composer/vendor/autoload.php'); // Path to Stripe library


function addBankAccount($connectAccountId, $accountToken) {
    \Stripe\Stripe::setApiKey('sk_test_51KBe3uBG6J77VsYBuVQP8Yav2DrZk3GFri8GKWJm0iv6G5CayB55YhBYZQZd7RlOFQ9JjU5vHO46gL8N1nkDqucU005pbBYCpp');

    try {
        $account = \Stripe\Account::retrieve($connectAccountId);
        $externalAccount = $account->external_accounts->create([
            'external_account' => $accountToken,
        ]);

        // Bank account was added successfully, you can handle the response here

        return $externalAccount; // Optional: return the external account object
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

    return false; // Adding bank account failed
}

// Example usage:
$connectAccountId = 'acct_1N9zLpPfWGqGGrHK'; // The Stripe Connect account ID
$accountToken = 'btok_1NATvxBG6J77VsYBfoubbSd8'; // The bank account token generated with Stripe.js

$result = addBankAccount($connectAccountId, $accountToken);

if ($result) {
    echo "Bank account was added successfully";
} else {
    echo "Adding bank account failed, handle the error";
}
?>
