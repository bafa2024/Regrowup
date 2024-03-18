<?php
$path = $_SERVER['DOCUMENT_ROOT'];

require $path . '/pool/libs/composer/vendor/autoload.php';



trait PaymentController {

  private $stripe_secret_key = 'sk_test_51KBe3uBG6J77VsYBuVQP8Yav2DrZk3GFri8GKWJm0iv6G5CayB55YhBYZQZd7RlOFQ9JjU5vHO46gL8N1nkDqucU005pbBYCpp';
  private $stripe_publishable_key = 'sk_test_51KBe3uBG6J77VsYBuVQP8Yav2DrZk3GFri8GKWJm0iv6G5CayB55YhBYZQZd7RlOFQ9JjU5vHO46gL8N1nkDqucU005pbBYCpp';


  private $stripe_secret_key_connect = 'sk_test_51KBe3uBG6J77VsYBuVQP8Yav2DrZk3GFri8GKWJm0iv6G5CayB55YhBYZQZd7RlOFQ9JjU5vHO46gL8N1nkDqucU005pbBYCpp';
  private $stripe_publishable_key_connect = 'sk_test_51KBe3uBG6J77VsYBuVQP8Yav2DrZk3GFri8GKWJm0iv6G5CayB55YhBYZQZd7RlOFQ9JjU5vHO46gL8N1nkDqucU005pbBYCpp';

  /*
  Algorthim Fpr Stripe Payments:
  1. Create a customer
  2. Create a payment method
  3. Attach the payment method to the customer
  4. Create a subscription
  5. Charge the customer
  6. Create a payout
  7. Create a source
  8. Attach the source to the customer
  9. Create a token
  10. Create a charge
  11. Create a payment intent
  12. Create a payment intent with a payment method
  13. Create a payment intent with a source
  14. Create a payment intent with a token
  15. Create a payment intent with a customer
  */




  //list all the connected accounts

  public function list_connected_accounts()
  {
    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);

    //  $result = $stripe->accounts->all();
      $result = $stripe->accounts->all(['limit' => 3]);

      return json_encode($result);

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }
  }

  //create a bank for a source
  public function create_bank_account($customer_id, $source_id)
  {

    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);

      $result = $stripe->customers->createSource(
        $customer_id,
        ['source' => $source_id]
      );

      return json_encode($result);

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }

  }
  //vtify a bank for a source
  public function verify_bank_account($customer_id, $bank_account_id, $amount1, $amount2)
  {

    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);

      $result = $$stripe->customers->verifySource(
        $customer_id,
        $bank_account_id,
        ['amounts' => [$amount1, $amount2]]

      );
      return json_encode($result);

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }

  }

  public function create_payment_method($type, $number, $exp_month, $exp_year, $cvc, $name, $email, $phone, $address_line1, $address_line2, $address_city, $address_state, $address_country, $address_zip)
  {
    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
      $result = $stripe->paymentMethods->create([
        'type' => $type,

        'card' => [
          'number' => $number,
          'exp_month' => $exp_month,
          'exp_year' => $exp_year,
          'cvc' => $cvc,
        ],
        'billing_details' => [
          'name' => $name,
          'address' => [
            'line1' => $address_line1,
            'line2' => $address_line2,
            'postal_code' => $address_zip,
            'city' => $address_city,
            'state' => $address_state,
            'country' => $address_country,
          ],
          'email' => $email, 
          'phone' => $phone,

        ],

      ]);
      return json_encode($result);

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }
  }

  public function create_payment_method_customer($type, $number, $exp_month, $exp_year, $cvc, $name, $email)
  {
    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
      $result = $stripe->paymentMethods->create([
        'type' => $type,

        'card' => [
          'number' => $number,
          'exp_month' => $exp_month,
          'exp_year' => $exp_year,
          'cvc' => $cvc,
        ],
      

      ]);
      $payment_method = $result['id'];
      $customer = $this->create_customer($name, $email);
      $this->attach_payment_method_customer($payment_method, $customer);
      $res = array(json_encode($result), $customer);
      return $res[0];

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }
  }

  public function checkup_balance()
  {

    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
      $result = $stripe->balance->retrieve([]);
      return json_encode($result);

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }

  }

  public function create_token_cards($number, $exp_month, $exp_year, $cvc)
  {

    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
      $result = $stripe->tokens->create([
        'card' => [
          'number' => $number,
          'exp_month' => $exp_month,
          'exp_year' => $exp_year,
          'cvc' => $cvc,
        ],
      ]);
      return $result['id'];

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }

  }

  public function create_token_bank($country, $currency, $account_holder_name, $account_holder_type, $routing_number, $account_number)
  {

    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
      $result = $stripe->tokens->create([
        'bank_account' => [
          'country' => $country,
          'currency' => $currency,
          'account_holder_name' => $account_holder_name,
          'account_holder_type' => $account_holder_type,
          'routing_number' => $routing_number,
          'account_number' => $account_number,
        ],
      ]);
      return json_encode($result);

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }

  }

  public function attach_payment_method_customer($payment_id, $customer_id)
  {

    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
      $result = $stripe->paymentMethods->attach(
        $payment_id,
        ['customer' => $customer_id]
      );
      return json_encode($result);

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }

  }

  public function detach_payment_method($payment_id)
  {

    try {

      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);

      $result = $stripe->paymentMethods->detach(
        $payment_id,
        []
      );
      return json_encode($result);

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();
    }

  }

  public function create_source($currency, $email)
  {

    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);

      $result = $stripe->sources->create([
        "type" => "ach_credit_transfer",
        "currency" => $currency,
        "owner" => [
          "email" => $email
        ]
      ]);

      return json_encode($result);

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }

  }

  public function retrieve_source($source_id)
  {

    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
      $result = $stripe->sources->retrieve(
        $source_id,
        []
      );

      return json_encode($result);
    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();
    }

  }

  public function attach_source($source_id, $customer_id)
  {

    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
      $result = $stripe->customers->createSource(
        $customer_id,
        [
          'source' => $source_id,
        ]
      );
      return json_encode($result);

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();
    }

  }

  public function payout_normal($amount, $currency)
  {

    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
      $result = $stripe->payouts->create(['amount' => $amount, 'currency' => $currency]);

      return json_encode($result);

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();
    }

  }

  public function list_customer_payment_methods($customer_id)
  {

    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
      $result = $stripe->paymentMethods->all([
        'customer' => $customer_id,
        'type' => 'card',
      ]);
      return json_encode($result);

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }

  }

  public function retrieve_payment_method($payment_id)
  {
    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
      $result = $stripe->paymentMethods->retrieve(
        $payment_id,
        []
      );
      return json_encode($result);

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }
  }

  public function retrieve_customer_payment_method($payment_id, $customer_id)
  {
    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
      $result = $stripe->customers->retrievePaymentMethod(
        $customer_id,
        $payment_id,
        []
      );
      return json_encode($result);

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }
  }

  public function update_payment_method()
  {
    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }
  }

  //Retrieve a connect account
  public function retrieve_connect_account($account_id)
  {
    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
      $result = $stripe->accounts->retrieve(
        $account_id,
        []
      );
      return json_encode($result);
    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }
  }

  public function login_link_express_account($account_id)
  {
    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
      $result = $stripe->accounts->createLoginLink(
        $account_id,
        []
      );
      return json_encode($result);
    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }
  }

  public function create_destination_charge($account_id,$amount)
  {
    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
      $result = $stripe->charges->create([
        'amount' => $amount,
        'currency' => 'usd',
        'destination' => [
          'account' => $account_id,
        ],
      ]);
      return json_encode($result);
    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }
  }

  public function create_cardholder($type, $name, $email, $phone_number, $line1, $city, $state, $country, $postal_code)
  {
    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
      $result = $stripe->issuing->cardholders->create([
        'type' => $type,
        'name' => $name,
        'email' => $email,
        'phone_number' => $phone_number,
        'billing' => [
          'address' => [
            'line1' => $line1,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'postal_code' => $postal_code,
          ],
        ],
      
      ]);
      return json_encode($result);
    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }
  }

  public function create_card($cardholder_id, $currency, $type)
  {
    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
      $result = $stripe->issuing->cards->create([
        'cardholder' => $cardholder_id,
        'currency' => $currency,
        'type' => $type,
      ]);
      return json_encode($result);
    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }
  }
  
  public function instant_payout($amount, $currency ,$method, $source_type, $stripe_account)
  {
    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
      $result = $stripe->payouts->create(
        [
          'amount' => $amount,
          'currency' => $currency,
          'method' => $method,
          'source_type' => $source_type,
        ],
        ['stripe_account' => $stripe_account]
      );

    

      return json_encode($result);

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }
  }

  public function create_stripe_connect_accounts($first_name, $last_name, $email, $country, $type, $business_type)
  {


    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
      $result = $stripe->accounts->create(
        [
          'country' => $country,
          'type' => $type,
          'business_type' => $business_type,
          'individual' => [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
          ],
          'capabilities' => [
            'card_payments' => ['requested' => true],
            'transfers' => ['requested' => true],
            'legacy_payments'=>['requested' =>true],
        
            
        
            'sepa_debit_payments'=>['requested' =>true],
            'sofort_payments'=>['requested' =>true],
            'giropay_payments'=>['requested' =>true],
            'acss_debit_payments'=>['requested' =>true],
            'p24_payments'=>['requested' =>true],
            'eps_payments'=>['requested' =>true],
    
          
            

          ],
          
        ]
      );
      $res = array(json_encode($result['id']), $email);
      return $res[0];

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }

  }

  public function account_cap($account_id){
    try {
      $stripe = new \Stripe\StripeClient($this->stripe_secret_key);
      $result = 
      $stripe->accounts->retrieveCapability(
        $account_id,
        'card_payments',
        []
      );
      
      return json_encode($result);

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }
  }

  public function payout($user_stripe_id, $amount, $currency)
  {


    try {

      // Set your secret key. Remember to switch to your live secret key in production.
      // See your keys here: https://dashboard.stripe.com/apikeys
      \Stripe\Stripe::setApiKey($this->stripe_secret_key);

      $transfer = \Stripe\Transfer::create([
        "amount" => $amount,
        "currency" => $currency,
        "destination" => $user_stripe_id,
      ]);
      return json_encode($transfer);

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }

  }

  public function normal_payout($amount, $currency,$user_stripe_id)
  {


    try {

      // Set your secret key. Remember to switch to your live secret key in production.
      // See your keys here: https://dashboard.stripe.com/apikeys
      \Stripe\Stripe::setApiKey($this->stripe_secret_key);

      $transfer = \Stripe\Transfer::create([
        "amount" => $amount,
        "currency" => $currency,
        "destination" => $user_stripe_id,
      ]);
      return json_encode($transfer);

    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }

  }

  public function charge_payment($token, $amount, $currency, $description)
  {


    try {

      \Stripe\Stripe::setApiKey($this->stripe_secret_key);

      $charge = \Stripe\Charge::create([
        'amount' => $amount,
        'currency' => $currency,
        'description' => $description,
        'source' => $token,
      ]);

      return json_encode($charge);



    } catch (Error $e) {
      echo 'Error: ' . $e->getMessage();

    }

  }

  public function charge_amount($itemPrice, $currency, $itemName)
  {

    $itemPriceCents = round($itemPrice * 100);

    try {

      \Stripe\Stripe::setApiKey($this->stripe_secret_key);
      // Create PaymentIntent with amount and currency 
      $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $itemPriceCents,
        'currency' => $currency,
        'description' => $itemName,
        'payment_method_types' => [
          'card'
        ]
      ]);

      $output = [
        'id' => $paymentIntent->id,
        'clientSecret' => $paymentIntent->client_secret
      ];

      echo json_encode($output);
    } catch (Error $e) {
      http_response_code(500);
      echo json_encode(['error' => $e->getMessage()]);
    }


  }

  public function create_customer($name, $email)
  {

    \Stripe\Stripe::setApiKey($this->stripe_secret_key);
    try {
      $result = \Stripe\Customer::create([
        'name' => $name,
        'email' => $email
      ]);
      return json_encode($result);

    } catch (Exception $e) {
      $api_error = $e->getMessage();
    }

  }


  public function connect_account_payment_method($connect_id, $external_account)
  {

    \Stripe\Stripe::setApiKey($this->stripe_secret_key);
    try {
      $result = $external_account = \Stripe\Account::createExternalAccount(
        $connect_id,
        [
          'external_account' => $external_account,
        ]
      );
      return json_encode($result);

    } catch (Exception $e) {
      $api_error = $e->getMessage();
    }

  }

  public function subscription($price, $currency, $planInterval, $planName)
  {

    try {
      $plan_priceCents = round($price * 100);
      \Stripe\Stripe::setApiKey($this->stripe_secret_key);
      // Create price with subscription info and interval 
      $result = \Stripe\Price::create([
        'unit_amount' => $plan_priceCents,
        'currency' => $currency,
        'recurring' => ['interval' => $planInterval],
        
        'product_data' => ['name' => $planName],

      ]);
      return json_encode($result);

    } catch (Exception $e) {
      $api_error = $e->getMessage();
    }

  }



  public function project_view($pid)
  {
      $sql = "SELECT * FROM projects WHERE id='$pid'";
      $results = $this->run_query($sql);
      $res = $results->fetch_assoc();
      return $res;
  }

  public function projects_transcations($payer_id,$payee_id,$transaction_type,$transaction_status,$amount,$payment_method_id,$project_id,$proposal_id){
    $sql = "INSERT INTO projects_transactions (payer_id,payee_id,transaction_type,transaction_status,amount,payment_method_id,project_id,proposal_id) 
    VALUES ('$payer_id','$payee_id','$transaction_type','$transaction_status','$amount','$payment_method_id','$project_id','$proposal_id')";
    $results = $this->run_query($sql);
    return $results;
  }

  public function user_payment_methods($user_id)
  {
      $sql = "SELECT * FROM payment_method_cards WHERE user_id='$user_id'";
      $results = $this->run_query($sql);
      $res = $results->fetch_assoc();
      return $res;
  }

  public function finance_partner_fr($user_id)
  {
      $sql = "SELECT * FROM finance_partner_freelancer WHERE user_id='$user_id'";
      $results = $this->run_query($sql);
      $res = $results->fetch_assoc();
      return $res;
  }

  public function   finance_partner_client($user_id)
  {
      $sql = "SELECT * FROM finance_partner_client WHERE user_id='$user_id'";
      $results = $this->run_query($sql);
      $res = $results->fetch_assoc();
      return $res;
  }

  public function view_proposal($app_id)
  {
      $sql = "SELECT * FROM project_proposals WHERE id='$app_id'";
      $results = $this->run_query($sql);
      $res = $results->fetch_assoc();
      return $res;
  }






















}