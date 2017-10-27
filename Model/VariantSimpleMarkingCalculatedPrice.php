<?php

namespace ES\APIv2Client\Model;

class VariantSimpleMarkingCalculatedPrice extends CalculatedPrice
{
    /**
     * @var bool
     */
    private $totalPrice;

    public function __construct()
    {
        $this->totalPrice = false;
    }

    /**
     * @return bool
     */
    public function isTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @param bool $totalPrice
     *
     * @return VariantSimpleMarkingCalculatedPrice
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }
}