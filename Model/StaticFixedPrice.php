<?php

namespace ES\RebirthApiClient\Model;

use ES\RebirthCommon\StaticFixedPriceInterface;
use Money\Money;

class StaticFixedPrice extends AbstractModel implements StaticFixedPriceInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string|null
     */
    private $condition;

    /**
     * @var Money
     */
    private $value;

    /**
     * @var Money|null
     */
    private $reducedValue;

    /**
     * @var Money
     */
    private $calculationValue;

    /**
     * @var bool
     */
    private $totalPrice;

    /**
     * @var PartialSupplierProfile
     */
    private $supplierProfile;

    /**
     * @var MarkingFee[]
     */
    private $markingFees;

    /**
     * @param string $id
     * @param string|null $condition
     * @param Money $value
     * @param Money|null $reducedValue
     * @param Money $calculationValue
     * @param bool $totalPrice
     * @param PartialSupplierProfile $supplierProfile
     * @param MarkingFee[] $markingFees
     */
    public function __construct($id, $condition, Money $value, Money $reducedValue = null,
        Money $calculationValue = null, $totalPrice, PartialSupplierProfile $supplierProfile, array $markingFees)
    {
        $this->id = $id;
        $this->condition = $condition;
        $this->value = $value;
        $this->reducedValue = $reducedValue;
        $this->calculationValue = $calculationValue;
        $this->totalPrice = $totalPrice;
        $this->supplierProfile = $supplierProfile;
        $this->markingFees = $markingFees;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @return Money
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return Money|null
     */
    public function getReducedValue()
    {
        return $this->reducedValue;
    }

    /**
     * @return Money
     */
    public function getCalculationValue()
    {
        return $this->calculationValue;
    }

    /**
     * @return bool
     */
    public function isTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * @return PartialSupplierProfile
     */
    public function getSupplierProfile()
    {
        return $this->supplierProfile;
    }

    /**
     * @return MarkingFee[]
     */
    public function getMarkingFees()
    {
        return $this->markingFees;
    }
}
