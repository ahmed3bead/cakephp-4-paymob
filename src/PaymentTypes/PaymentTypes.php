<?php
declare(strict_types=1);

namespace CakephpPaymob\PaymentTypes;


interface PaymentTypes{

    static function hasIframe();

    static function generateIframe($token);

    
    
}