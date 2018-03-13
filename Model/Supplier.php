<?php

namespace ES\RebirthApiClient\Model;

class Supplier extends AbstractModel
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string|null
     */
    private $vatIdentificationNumber;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $legalName;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var SupplierProfile[]
     */
    private $supplierProfiles;

    /**
     * @param string $id
     * @param string|null $vatIdentificationNumber
     * @param string $name
     * @param string $legalName
     * @param string $slug
     * @param SupplierProfile[] $supplierProfiles
     */
    public function __construct($id, $vatIdentificationNumber, $name, $legalName, $slug, array $supplierProfiles)
    {
        $this->id = $id;
        $this->vatIdentificationNumber = $vatIdentificationNumber;
        $this->name = $name;
        $this->legalName = $legalName;
        $this->slug = $slug;
        $this->supplierProfiles = $supplierProfiles;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getVatIdentificationNumber()
    {
        return $this->vatIdentificationNumber;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLegalName()
    {
        return $this->legalName;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return SupplierProfile[]
     */
    public function getSupplierProfiles()
    {
        return $this->supplierProfiles;
    }
}
