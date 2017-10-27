<?php

namespace ES\APIv2Client\Model;

class VariantMinimumQuantity
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var null|string
     */
    private $projectId;

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
     * @param null|string $projectId
     * @param int $value
     * @param SupplierProfileInterface $supplierProfile
     */
    public function __construct($id, $projectId, $value, SupplierProfileInterface $supplierProfile)
    {

        if (!$supplierProfile instanceof SupplierProfileInterface) {
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
     * @return null|string
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
     * @return SupplierProfileInterface
     */
    public function getSupplierProfile()
    {
        return $this->supplierProfile;
    }
}