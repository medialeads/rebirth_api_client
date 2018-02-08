<?php

namespace ES\RebirthApiClient\Model;

class DynamicVariablePriceHolder implements ModelInterface
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
     * @var bool
     */
    private $totalPrice;

    /**
     * @var SupplierProfileInterface
     */
    private $supplierProfile;

    /**
     * @var DynamicVariablePrice[]
     */
    private $dynamicVariablePrices;

    /**
     * @var MarkingFee[]
     */
    private $markingFees;

    /**
     * @param string $id
     * @param string|null $condition
     * @param bool $totalPrice
     * @param SupplierProfileInterface $supplierProfile
     * @param DynamicVariablePrice[] $dynamicVariablePrices
     * @param MarkingFee[] $markingFees
     */
    public function __construct($id, $condition, $totalPrice, SupplierProfileInterface $supplierProfile,
        array $dynamicVariablePrices, array $markingFees)
    {
        $this->id = $id;
        $this->condition = $condition;
        $this->totalPrice = $totalPrice;
        $this->supplierProfile = $supplierProfile;
        $this->dynamicVariablePrices = $dynamicVariablePrices;
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
     * @return DynamicVariablePrice[]
     */
    public function getDynamicVariablePrices()
    {
        return $this->dynamicVariablePrices;
    }

    /**
     * @return MarkingFee[]
     */
    public function getMarkingFees()
    {
        return $this->markingFees;
    }
}
