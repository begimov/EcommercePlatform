<?php

namespace App\Models\Traits;

use Money\Money;
use Money\Currency;
use NumberFormatter;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;

trait HasPrice
{
    public function getPriceAttribute($price)
    {
        return new Money($price, new Currency('RUB'));
    }

    public function getFormattedPriceAttribute()
    {
        $formatter = new IntlMoneyFormatter(
            new NumberFormatter('ru_RU', NumberFormatter::CURRENCY),
            new ISOCurrencies()
        );

        return $formatter->format($this->price);
    }
}
