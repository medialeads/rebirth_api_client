<?php

namespace ES\APIv2Client\Model;

class Price
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var float
     */
    private $calculationValue;

    /**
     * @var float
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
     * @param float $calculationValue
     * @param float $reducedValue
     * @param float $value
     * @param SupplierProfileInterface $supplierProfile
     */
    public function __construct($id, $calculationValue, $reducedValue, $value, SupplierProfileInterface $supplierProfile)
    {
        if ($supplierProfile instanceof SupplierProfileInterface) {
            throw new \InvalidArgumentException();
        }

        $this->id = $id;
        $this->calculationValue = $calculationValue;
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
     * @return float
     */
    public function getCalculationValue()
    {
        return $this->calculationValue;
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