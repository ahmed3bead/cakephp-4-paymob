# CAKEPHP 4 Paymob

# paymob
paymob payment gateway https://paymob.com


## Installation
```bash
composer require ahmedebead/cakephp-4-paymob
```
## Usage In CakePhp
    

### Enable Plugin

```php
// src/Application.php

public function bootstrap()
{
    $this->addPlugin('CakephpLte', ['autoload' => true, 'bootstrap' => true, 'routes' => true]);
}
```

Or, you can load the plugin using the shell command

```php
   $ bin/cake plugin load CakeRestApi
```


### Configure

```php
// new config/cakephplte.php file

return [
    'CakephpPaymob' => [
        'apiKey' => '{your-api-key-here-from-your-account}',
        'card_integration_id' => 'card_integration_id', //https://accept.paymob.com/portal2/en/PaymentIntegrations
        'mobile_wallet_integration_id' => 'mobile_wallet_integration_id', //https://accept.paymob.com/portal2/en/PaymentIntegrations

    ]
];

// config/bootstrap.php

Configure::load('cakephppaymob', 'default');
```


## Usage 



#### step 1 :

```php
use CakephpPaymob\CakephpPaymob;
```

#### step 2 :

Init new client

```php

 $client = new CakephpPaymob();

```

#### step 3 :


Order Registration

```php

$orderData = [
   "delivery_needed" => "false",  // Required -- Set it to be true if your order needs to be delivered by Accept's product delivery services.
   "amount_cents" => 100, // price * 100  Required
   "currency" => "EGP", // Required
   "merchant_order_id" => 5, 
   "items" => [// Required
         [
            "name" => "ASC1515", 
            "amount_cents" => "500000", 
            "description" => "Smart Watch", 
            "quantity" => "1" 
         ], 
         [
               "name" => "ERT6565", 
               "amount_cents" => "200000", 
               "description" => "Power Bank", 
               "quantity" => "1" 
            ] 
      ], 

]; 

 $order = $client->OrderRegistrationAPI($orderData);


```


### Card Payment

```php

use CakephpPaymob\PaymentTypes\Card;

 $card = new Card();
        $PaymentKey =  $card->PaymentKeyRequest([
            'amount_cents' => 150 * 100, //put your price
            'currency' => 'EGP',
            'order_id' => $order['id'],// From step 3 before
            "billing_data" => [ // put your client information
                "apartment" => "803",
                "email" => "claudette09@exa.com",
                "floor" => "42",
                "first_name" => "Clifford",
                "street" => "Ethan Land",
                "building" => "8028",
                "phone_number" => "+86(8)9135210487",
                "shipping_method" => "PKG",
                "postal_code" => "01898",
                "city" => "Jaskolskiburgh",
                "country" => "CR",
                "last_name" => "Nicolas",
                "state" => "Utah"
            ]
        ]);

        $this->set('PaymentKey',$PaymentKey);


```

#### finally create view and use your iframe like this ( Card Payment)

### card information testing
Card number : 4987654321098769
Cardholder Name : Test Account
Expiry Month : 05
Expiry year : 21
CVV : 123

```html
  <iframe width="100%" height="800" src="https://accept.paymob.com/api/acceptance/iframes/{{your_frame_id_here}}?payment_token=<?= $PaymentKey // from steps ?>"> 
  <!-- https://accept.paymob.com/portal2/en/iframes -->
 
```

### Walet payment

In progress
=======



### TODO
#### Mobile Wallets
#### Kiosk Payments
#### ValU
#### Cash Collection
#### Bank Installments
#### Premium Card Payments
#### SOUHOOLA Payments
#### GET_GO Payments



