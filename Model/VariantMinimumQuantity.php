<?php

namespace ES\RebirthApiClient\Model;

class VariantMinimumQuantity implements ModelInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var int
     */
    private $value;

    /**
     * @var SupplierProfileInterface
     */
    private $supplierProfile;

    /**
     * @param string $id
     * @param int $value
     * @param SupplierProfileInterface $supplierProfile
     */
    public function __construct($id, $value, SupplierProfileInterface $supplierProfile)
    {
        $this->id = $id;
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
     * @return int
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
