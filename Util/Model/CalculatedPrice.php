<?php

namespace ES\RebirthApiClient\Util\Model;

use Money\Money;

class CalculatedPrice
{
    /**
     * @var bool
     */
    private $onQuote;

    /**
     * @var Money
     */
    private $money;

    public function __construct()
    {
        $this->onQuote = true;
        $this->money = Money::EUR(0);
    }

    /**
     * @return bool
     */
    public function isOnQuote()
    {
        return $this->onQuote;
    }

    /**
     * @param bool $onQuote
     *
     * @return CalculatedPrice
     */
    public function setOnQuote($onQuote)
    {
        $this->onQuote = $onQuote;

        return $this;
    }

    // one unit = 0.001 €
    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->money->getAmount();
    }

    /**
     * @param Money $money
     *
     * @return CalculatedPrice
     */
    public function add(Money $money)
    {
        $this->money = $this->money->add($money);

        return $this;
    }
}
