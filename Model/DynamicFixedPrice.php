<?php

namespace ES\RebirthApiClient\Model;

use ES\RebirthCommon\DynamicFixedPriceInterface;

class DynamicFixedPrice extends AbstractModel implements DynamicFixedPriceInterface
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
     * @var string
     */
    private $value;

    /**
     * @var string|null
     */
    private $reducedValue;

    /**
     * @var string
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
     * @param string $value
     * @param string|null $reducedValue
     * @param string $calculationValue
     * @param bool $totalPrice
     * @param PartialSupplierProfile $supplierProfile
     * @param MarkingFee[] $markingFees
     */
    public function __construct($id, $condition, $value, $reducedValue, $calculationValue, $totalPrice,
        PartialSupplierProfile $supplierProfile, array $markingFees)
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
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string|null
     */
    public function getReducedValue()
    {
        return $this->reducedValue;
    }

    /**
     * @return string
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
