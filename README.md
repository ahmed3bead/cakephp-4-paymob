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
        'apiKey' => '{your-api-key-here-from-your-account}',// From https://accept.paymob.com/portal2/en/settings
        'card_payments_iframes_url' => '{card_payments_iframes_url}',// From https://accept.paymob.com/portal2/en/iframes
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

$orderData = [
   "delivery_needed" => "false", 
   "amount_cents" => "100", // price * 100 
   "currency" => "EGP", 
   "merchant_order_id" => 5, 
   "items" => [
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
   "shipping_data" => [
                  "apartment" => "803", 
                  "email" => "claudette09@exa.com", 
                  "floor" => "42", 
                  "first_name" => "Clifford", 
                  "street" => "Ethan Land", 
                  "building" => "8028", 
                  "phone_number" => "+86(8)9135210487", 
                  "postal_code" => "01898", 
                  "extra_description" => "8 Ram , 128 Giga", 
                  "city" => "Jaskolskiburgh", 
                  "country" => "CR", 
                  "last_name" => "Nicolas", 
                  "state" => "Utah" 
               ], 
   "shipping_details" => [
                     "notes" => " test", 
                     "number_of_packages" => 1, 
                     "weight" => 1, 
                     "weight_unit" => "Kilogram", 
                     "length" => 1, 
                     "width" => 1, 
                     "height" => 1, 
                     "contents" => "product of some sorts" 
                  ] 
]; 

 $order = $client->OrderRegistrationAPI($orderData);

  $PaymentKey = $client->PaymentKeyRequest([
      'amount_cents' => 150 * 100,//put your price
      'currency' => 'EGP',
      'order_id' => $order->id, 
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


```



#### finally create view and use your iframe like this ( Card Payment)

```html
  <iframe width="100%" height="800" src="https://accept.paymob.com/api/acceptance/iframes/{{your_frame_id_here}}?payment_token=<?= $PaymentKey->token // from step 5 ?>">
 
```
### card information testing
Card number : 4987654321098769\
Cardholder Name : Test Account\
Expiry Month : 05\
Expiry year : 21\
CVV : 123


### TODO
#### Mobile Wallets
#### Kiosk Payments
#### ValU
#### Cash Collection
#### Bank Installments
#### Premium Card Payments
#### SOUHOOLA Payments
#### GET_GO Payments




