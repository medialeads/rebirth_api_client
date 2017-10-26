<?php

namespace ES\APIv2Client\Model;

class StaticVariablePriceHolder
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
     * @var int
     */
    private $projectId;

    /**
     * @var array
     */
    private $markingFees;

    /**
     * @var array
     */
    private $staticVariablePrices;

    /**
     * @var SupplierProfile
     */
    private $supplierProfile;

    /**
     * @param $id
     * @param $condition
     * @param $totalPrice
     * @param $projectId
     * @param $markingFees
     * @param $staticVariablePrices
     * @param $supplierProfile
     */
    public function __construct($id, $condition, $totalPrice, $projectId, $markingFees, $staticVariablePrices, $supplierProfile)
    {
        foreach ($markingFees as $markingFee) {
            if (!$markingFee instanceof MarkingFee) {
                throw new \InvalidArgumentException();
            }
        }

        foreach ($staticVariablePrices as $staticVariablePrice) {
            if (!$staticVariablePrice instanceof StaticVariablePrice) {
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
        $this->staticVariablePrices = $staticVariablePrices;
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
    public function getStaticVariablePrices()
    {
        return $this->staticVariablePrices;
    }

    /**
     * @return SupplierProfile
     */
    public function getSupplierProfile()
    {
        return $this->supplierProfile;
    }
}