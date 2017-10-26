<?php

namespace ES\APIv2Client\Model;

class DynamicFixedPrice
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
     * @var string
     */
    private $value;

    /**
     * @var SupplierProfile
     */
    private $supplierProfile;

    /**
     * @param int $id
     * @param $condition
     * @param string $calculationValue
     * @param bool $totalPrice
     * @param string $projectId
     * @param array $markingFees
     * @param string $reducedValue
     * @param $value
     * @param SupplierProfile $supplierProfile
     */
    public function __construct($id, $condition, $calculationValue, $totalPrice, $projectId, $markingFees, $reducedValue, $value, $supplierProfile)
    {
        foreach ($markingFees as $markingFee) {
            if (!$markingFee instanceof MarkingFee) {
                throw new \InvalidArgumentException();
            }
        }

        if (!$supplierProfile instanceof SupplierProfile) {
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
     * @return string
     */
    public function getReducedValue()
    {
        return $this->reducedValue;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return SupplierProfile
     */
    public function getSupplierProfile()
    {
        return $this->supplierProfile;
    }
}