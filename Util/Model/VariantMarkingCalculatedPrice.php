<?php

namespace ES\RebirthApiClient\Util\Model;

use ES\RebirthApiClient\Model\MarkingFee;

class VariantMarkingCalculatedPrice extends CalculatedPrice
{
    /**
     * @var bool
     */
    private $totalPrice;

    /**
     * @var MarkingFee[]
     */
    private $markingFees;

    public function __construct()
    {
        parent::__construct();

        $this->totalPrice = false;
        $this->markingFees = array();
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
     * @return VariantMarkingCalculatedPrice
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * @return MarkingFee[]
     */
    public function getMarkingFees()
    {
        return $this->markingFees;
    }

    /**
     * @param MarkingFee[] $markingFees
     *
     * @return VariantMarkingCalculatedPrice
     */
    public function setMarkingFees(array $markingFees)
    {
        $this->markingFees = $markingFees;

        return $this;
    }
}
