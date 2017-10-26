<?php

namespace ES\APIv2Client\Model;

class VariantMinimumQuantity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string|null
     */
    private $projectId;

    /**
     * @var int
     */
    private $value;

    /**
     * @var SupplierProfile
     */
    private $supplierProfile;

    /**
     * @param int $id
     * @param string|null $projectId
     * @param int $value
     * @param SupplierProfile $supplierProfile
     */
    public function __construct($id, $projectId, $value, $supplierProfile)
    {

        if (!$supplierProfile instanceof SupplierProfile) {
            throw new \InvalidArgumentException();
        }

        $this->id = $id;
        $this->projectId = $projectId;
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
     * @return string|null
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @return int
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