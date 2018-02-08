<?php

namespace ES\RebirthApiClient\Model;

class StaticFixedPrice implements ModelInterface
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
     * @var float
     */
    private $value;

    /**
     * @var float|null
     */
    private $reducedValue;

    /**
     * @var float
     */
    private $calculationValue;

    /**
     * @var bool
     */
    private $totalPrice;

    /**
     * @var SupplierProfileInterface
     */
    private $supplierProfile;

    /**
     * @var MarkingFee[]
     */
    private $markingFees;

    /**
     * @param string $id
     * @param string|null $condition
     * @param float $value
     * @param float|null $reducedValue
     * @param float $calculationValue
     * @param bool $totalPrice
     * @param SupplierProfileInterface $supplierProfile
     * @param MarkingFee[] $markingFees
     */
    public function __construct($id, $condition, $value, $reducedValue, $calculationValue, $totalPrice,
        SupplierProfileInterface $supplierProfile, array $markingFees)
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
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return float|null
     */
    public function getReducedValue()
    {
        return $this->reducedValue;
    }

    /**
     * @return float
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
     * @return SupplierProfileInterface
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
