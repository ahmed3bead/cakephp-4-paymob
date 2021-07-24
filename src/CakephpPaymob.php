<?php

declare(strict_types=1);

namespace CakephpPaymob;

use Cake\Core\Configure;
use ErrorException;

class CakephpPaymob
{


    public static $apiKey;

    public static $token;

    public function __construct()
    {
        $apiKey = Configure::read('CakephpPaymob.apiKey');
        if (!$apiKey) {
            throw new ErrorException('CakephpPaymob need api key to run,apikey not found on configration file ');
        }
        self::$apiKey = $apiKey;

        $auth  = $this->AuthenticationRequest();


        if (!isset($auth['token'])) {
            throw new ErrorException($auth['detail']);
        }
        self::$token = $auth['token'];
    }

    public function AuthenticationRequest()
    {
        $userInfo = [
            'api_key' => self::$apiKey,
        ];

        $postData = json_encode($userInfo);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://accept.paymob.com/api/auth/tokens');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $response = curl_exec($ch);
        if ($response === false) {
            echo curl_error($ch);
        }
        curl_close($ch);
        return json_decode($response, true);
    }


    public static function OrderRegistrationAPI(array $data)
    {
        $data['auth_token'] = self::$token;
        $postData = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://accept.paymob.com/api/ecommerce/orders');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $response = curl_exec($ch);
        if ($response === false) {
            echo curl_error($ch);
        }
        curl_close($ch);
        return json_decode($response, true);
    }

    static function PaymentKeyRequest($requestData)
    {
       
        $postData = json_encode($requestData);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://accept.paymob.com/api/acceptance/payment_keys');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $response = curl_exec($ch);
        if ($response === false) {
            echo curl_error($ch);
        }
        curl_close($ch);
        return json_decode($response);
    }
}
