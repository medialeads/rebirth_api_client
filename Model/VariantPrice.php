<?php

namespace ES\APIv2Client\Model;

/**
 * @author Dagan MENEZ
 */
class VariantPrice extends Price
{
    /**
     * @var int
     */
    private $fromQuantity;

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
     * @param int $fromQuantity
     */
    public function __construct($id, $calculationValue, $reducedValue, $value, SupplierProfileInterface $supplierProfile, $fromQuantity)
    {
        parent::__construct($id, $calculationValue, $reducedValue, $value);

        $this->fromQuantity = $fromQuantity;
        $this->supplierProfile = $supplierProfile;
    }

    /**
     * @return int
     */
    public function getFromQuantity()
    {
        return $this->fromQuantity;
    }

    /**
     * @return SupplierProfileInterface
     */
    public function getSupplierProfile()
    {
        return $this->supplierProfile;
    }
}