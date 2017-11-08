<?php

namespace ES\APIv2Client\Model;

/**
 * @author Dagan MENEZ
 */
class VariantSamplePrice extends Price
{
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
        parent::__construct($id, $calculationValue, $reducedValue, $value);

        $this->supplierProfile = $supplierProfile;
    }

    /**
     * @return SupplierProfileInterface
     */
    public function getSupplierProfile()
    {
        return $this->supplierProfile;
    }
}