<?php

namespace ES\APIv2Client\Model;

class DynamicVariablePriceHolder
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
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
     * @var SupplierProfileInterface
     */
    private $supplierProfile;

    /**
     * @param string $id
     * @param null|string $condition
     * @param bool $totalPrice
     * @param string $projectId
     * @param array $markingFees
     * @param array $dynamicVariablePrices
     * @param SupplierProfileInterface $supplierProfile
     */
    public function __construct($id, $condition, $totalPrice, $projectId, $markingFees, $dynamicVariablePrices, SupplierProfileInterface $supplierProfile)
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

        if (!$supplierProfile instanceof SupplierProfileInterface)
        {
            throw new \InvalidArgumentException();
        }

        $this->id = $id;
        $this->condition = $condition;
        $this->totalPrice = $totalPrice;
        $this->markingFees = $markingFees;
        $this->dynamicVariablePrices = $dynamicVariablePrices;
        $this->supplierProfile = $supplierProfile;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
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
     * @return SupplierProfileInterface
     */
    public function getSupplierProfile()
    {
        return $this->supplierProfile;
    }
}