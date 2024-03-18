<?php
$path=$_SERVER['DOCUMENT_ROOT'];
require_once($path.'/pool/libs/composer/vendor/autoload.php'); // Path to Stripe library

function generateBankAccountToken($bankAccountDetails) {
    \Stripe\Stripe::setApiKey('sk_test_51KBe3uBG6J77VsYBuVQP8Yav2DrZk3GFri8GKWJm0iv6G5CayB55YhBYZQZd7RlOFQ9JjU5vHO46gL8N1nkDqucU005pbBYCpp');

    try {
        $token = \Stripe\Token::create([
            'bank_account' => $bankAccountDetails,
        ]);

        // Bank account token generated successfully, you can handle the response here

        return $token->id; // Return the generated bank account token ID
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

    return false; // Generating bank account token failed
}

// Example usage:
$bankAccountDetails = [
    'country' => 'US',
    'currency' => 'usd',
    'account_holder_name' => 'John Doe',
    'account_holder_type' => 'individual',
    'routing_number' => '110000000',
    'account_number' => '000123456789',
];

$bankAccountToken = generateBankAccountToken($bankAccountDetails);

if ($bankAccountToken) {
    // Bank account token generated successfully
} else {
    // Generating bank account token failed, handle the error
}
?>
