<?php

declare(strict_types=1);

namespace CakephpPaymob\PaymentTypes;

use CakephpPaymob\CakephpPaymob;
use Cake\Core\Configure;
use ErrorException;

class Card extends CakephpPaymob implements PaymentTypes
{

    private static $card_integration_id = '';

    public function __construct()
    {
        $card_integration_id = Configure::read('CakephpPaymob.card_integration_id');
        if (!$card_integration_id) {
            throw new ErrorException('card payment need card integration id to run,card_integration_id not found on configration file ');
        }

        self::$card_integration_id = $card_integration_id;
    }


    static function hasIframe()
    {
        return true;
    }

    static function PaymentKeyRequest($requestData)
    {

        $requestData['expiration'] = 3600;
        $requestData['integration_id'] = self::$card_integration_id;
        $requestData['auth_token'] = parent::$token;

        $res = parent::PaymentKeyRequest($requestData);


        if (isset($res->token)) {
            if (self::hasIframe()) {
                return self::generateIframe($res->token);
            }
        }

        

        return "https://accept.paymob.com/api/acceptance/iframes/{{your_iframe_id}}?payment_token={{payment_token_obtained_from_step_3}}";

        dd($res);
    }


    static function generateIframe($token)
    {
        
        dd("https://accept.paymob.com/api/acceptance/iframes/{{your_iframe_id}}?payment_token={{payment_token_obtained_from_step_3}}");
    }
}
