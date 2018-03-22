<?php

namespace ES\RebirthApiClient\Model;

use ES\RebirthCommon\DynamicVariablePriceHolderInterface;

class DynamicVariablePriceHolder extends AbstractModel implements DynamicVariablePriceHolderInterface
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
     * @var PartialSupplierProfile
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
     * @param PartialSupplierProfile $supplierProfile
     * @param DynamicVariablePrice[] $dynamicVariablePrices
     * @param MarkingFee[] $markingFees
     */
    public function __construct($id, $condition, $totalPrice, PartialSupplierProfile $supplierProfile,
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
     * @return PartialSupplierProfile
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
