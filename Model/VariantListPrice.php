<?php

namespace ES\APIv2Client\Model;

/**
 * @author Dagan MENEZ
 */
class VariantListPrice extends Price
{
    /**
     * @var SupplierProfileInterface
     */
    private $supplierProfile;

    /**
     * @param string $id
     * @param mixed $calculationValue
     * @param float $reducedValue
     * @param mixed $value
     * @param SupplierProfileInterface $supplierProfile
     */
    public function __construct($id, $calculationValue, $reducedValue, $value, $supplierProfile)
    {
        parent::__construct($id, $calculationValue, $reducedValue, $value, $supplierProfile);

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