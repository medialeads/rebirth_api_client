<?php

namespace ES\RebirthApiClient\Model;

use ES\RebirthCommon\VariantMinimumQuantityInterface;

class VariantMinimumQuantity extends AbstractModel implements VariantMinimumQuantityInterface
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
     * @var PartialSupplierProfile
     */
    private $supplierProfile;

    /**
     * @param string $id
     * @param int $value
     * @param PartialSupplierProfile $supplierProfile
     */
    public function __construct($id, $value, PartialSupplierProfile $supplierProfile)
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
     * @return PartialSupplierProfile
     */
    public function getSupplierProfile()
    {
        return $this->supplierProfile;
    }
}
