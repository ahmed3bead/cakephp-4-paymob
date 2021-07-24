<?php

declare(strict_types=1);

namespace CakephpPaymob\PaymentTypes;

use CakephpPaymob\CakephpPaymob;
use Cake\Core\Configure;
use ErrorException;

class MobileWallet extends CakephpPaymob implements PaymentTypes
{

    private static $mobile_wallet_integration_id = '';

    public function __construct()
    {
        $mobile_wallet_integration_id = Configure::read('CakephpPaymob.card_integration_id');
        if (!$mobile_wallet_integration_id) {
            throw new ErrorException('card payment need card integration id to run,apikey not found on configration file ');
        }

        self::$mobile_wallet_integration_id = $mobile_wallet_integration_id;
    }




    static function hasIframe()
    {
        return false;
    }

    static function generateIframe($token)
    {
        # code...
    }
}
