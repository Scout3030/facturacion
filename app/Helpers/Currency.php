<?php

namespace App\Helpers;

use NumberFormatter;

class Currency
{
    public static function formatCurrency(float $amount)
    {
        return (new \NumberFormatter(app()->getLocale(), \NumberFormatter::CURRENCY))->formatCurrency(
            $amount, env('CURRENCY')
        );
    }
}
