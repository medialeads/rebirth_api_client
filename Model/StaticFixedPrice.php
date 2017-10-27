<?php

namespace ES\APIv2Client\Model;

class StaticFixedPrice
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
     * @var string
     */
    private $calculationValue;

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
     * @var string
     */
    private $reducedValue;

    /**
     * @var float
     */
    private $value;

    /**
     * @var SupplierProfileInterface
     */
    private $supplierProfile;

    /**
     * @param string $id
     * @param string $condition
     * @param string $calculationValue
     * @param bool $totalPrice
     * @param string $projectId
     * @param array $markingFees
     * @param string $reducedValue
     * @param float $value
     * @param SupplierProfileInterface $supplierProfile
     */
    public function __construct($id, $condition, $calculationValue, $totalPrice, $projectId, $markingFees, $reducedValue, $value, SupplierProfileInterface $supplierProfile)
    {
        foreach ($markingFees as $markingFee) {
            if (!$markingFee instanceof MarkingFee) {
                throw new \InvalidArgumentException();
            }
        }

        if (!$supplierProfile instanceof SupplierProfileInterface) {
            throw new \InvalidArgumentException();
        }

        $this->id = $id;
        $this->condition = $condition;
        $this->calculationValue = $calculationValue;
        $this->totalPrice = $totalPrice;
        $this->projectId = $projectId;
        $this->markingFees = $markingFees;
        $this->reducedValue = $reducedValue;
        $this->value = $value;
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
     * @return float
     */
    public function getReducedValue()
    {
        return $this->reducedValue;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return SupplierProfileInterface
     */
    public function getSupplierProfile()
    {
        return $this->supplierProfile;
    }
}