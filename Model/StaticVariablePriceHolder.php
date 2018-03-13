<?php

namespace ES\RebirthApiClient\Model;

use ES\RebirthCommon\StaticVariablePriceHolderInterface;

class StaticVariablePriceHolder extends AbstractModel implements StaticVariablePriceHolderInterface
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
     * @var StaticVariablePrice[]
     */
    private $staticVariablePrices;

    /**
     * @var MarkingFee[]
     */
    private $markingFees;

    /**
     * @param string $id
     * @param string|null $condition
     * @param bool $totalPrice
     * @param PartialSupplierProfile $supplierProfile
     * @param StaticVariablePrice[] $staticVariablePrices
     * @param MarkingFee[] $markingFees
     */
    public function __construct($id, $condition, $totalPrice, PartialSupplierProfile $supplierProfile,
        array $staticVariablePrices, array $markingFees)
    {
        $this->id = $id;
        $this->condition = $condition;
        $this->totalPrice = $totalPrice;
        $this->supplierProfile = $supplierProfile;
        $this->staticVariablePrices = $staticVariablePrices;
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
     * @return StaticVariablePrice[]
     */
    public function getStaticVariablePrices()
    {
        return $this->staticVariablePrices;
    }

    /**
     * @return MarkingFee[]
     */
    public function getMarkingFees()
    {
        return $this->markingFees;
    }
}
