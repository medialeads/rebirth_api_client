<?php

namespace ES\APIv2Client\Model;

class StaticVariablePriceHolder
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
    private $staticVariablePrices;

    /**
     * @var SupplierProfileInterface
     */
    private $supplierProfile;

    /**
     * @param string $id
     * @param string $condition
     * @param bool $totalPrice
     * @param string $projectId
     * @param array $markingFees
     * @param array $staticVariablePrices
     * @param SupplierProfileInterface $supplierProfile
     */
    public function __construct($id, $condition, $totalPrice, $projectId, $markingFees, $staticVariablePrices, SupplierProfileInterface $supplierProfile)
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

        if (!$supplierProfile instanceof SupplierProfileInterface)
        {
            throw new \InvalidArgumentException();
        }

        $this->id = $id;
        $this->condition = $condition;
        $this->totalPrice = $totalPrice;
        $this->markingFees = $markingFees;
        $this->staticVariablePrices = $staticVariablePrices;
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
     * @return string
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
     * @return SupplierProfileInterface
     */
    public function getSupplierProfile()
    {
        return $this->supplierProfile;
    }
}