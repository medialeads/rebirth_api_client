<?php

namespace ES\APIv2Client\Model;

class DynamicVariablePriceHolder
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var
     */
    private $condition;

    /**
     * @var bool
     */
    private $totalPrice;

    /**
     * @var string
     */
    private $projectId;

    /**
     * @var array
     */
    private $markingFees;

    /**
     * @var array
     */
    private $dynamicVariablePrices;

    /**
     * @var SupplierProfile
     */
    private $supplierProfile;

    /**
     * @param int $id
     * @param $condition
     * @param bool $totalPrice
     * @param string $projectId
     * @param array $markingFees
     * @param array $dynamicVariablePrices
     * @param SupplierProfile $supplierProfile
     */
    public function __construct($id, $condition, $totalPrice, $projectId, $markingFees, $dynamicVariablePrices, $supplierProfile)
    {
        foreach ($markingFees as $markingFee) {
            if (!$markingFee instanceof MarkingFee) {
                throw new \InvalidArgumentException();
            }
        }

        foreach ($dynamicVariablePrices as $dynamicVariablePrice) {
            if (!$dynamicVariablePrice instanceof DynamicVariablePrice) {
                throw new \InvalidArgumentException();
            }
        }

        if (!$supplierProfile instanceof SupplierProfile)
        {
            throw new InvalidArgumentException();
        }

        $this->id = $id;
        $this->condition = $condition;
        $this->totalPrice = $totalPrice;
        $this->markingFees = $markingFees;
        $this->dynamicVariablePrices = $dynamicVariablePrices;
        $this->supplierProfile = $supplierProfile;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
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
     * @return string
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @return array
     */
    public function getMarkingFees()
    {
        return $this->markingFees;
    }

    /**
     * @return array
     */
    public function getDynamicVariablePrices()
    {
        return $this->dynamicVariablePrices;
    }

    /**
     * @return SupplierProfile
     */
    public function getSupplierProfile()
    {
        return $this->supplierProfile;
    }
}