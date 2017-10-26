<?php

namespace ES\APIv2Client\Model;

class Price
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var mixed
     */
    private $calculationValue;

    /**
     * @var float
     */
    private $reducedValue;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @var SupplierProfile
     */
    private $supplierProfile;

    /**
     * @param mixed $calculationValue
     * @param float $reducedValue
     * @param int $id
     * @param mixed $value
     * @param SupplierProfile $supplierProfile
     */
    public function __construct($id, $calculationValue, $reducedValue, $value, $supplierProfile)
    {
        if ($supplierProfile instanceof SupplierProfile) {
            throw new \InvalidArgumentException();
        }

        $this->id = $id;
        $this->calculationValue = $calculationValue;
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
    public function getCalculationValue()
    {
        return $this->calculationValue;
    }

    /**
     * @return mixed
     */
    public function getReducedValue()
    {
        return $this->reducedValue;
    }

    /**
     * @return mixed
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