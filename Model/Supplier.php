<?php

namespace ES\APIv2Client\Model;

/**
 * @author Dagan MENEZ
 */
class Supplier
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $projectId;

    /**
     * @var null|string
     */
    private $vatIdentificationNumber;

    /**
     * @var array
     */
    private $supplierProfiles;

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
     * @param string $id
     * @param string $projectId
     * @param null|string $vatIdentificationNumber
     * @param array $supplierProfiles
     * @param string $name
     * @param string $legalName
     * @param string $slug
     */
    public function __construct($id, $projectId, $vatIdentificationNumber, $supplierProfiles, $name, $legalName, $slug)
    {
        foreach ($supplierProfiles as $supplierProfile) {
            if(!$supplierProfile instanceof SupplierProfileInterface) {
                throw new \InvalidArgumentException();
            }
        }

        $this->id = $id;
        $this->projectId = $projectId;
        $this->vatIdentificationNumber = $vatIdentificationNumber;
        $this->supplierProfiles = $supplierProfiles;
        $this->name = $name;
        $this->legalName = $legalName;
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @return null|string
     */
    public function getVatIdentificationNumber()
    {
        return $this->vatIdentificationNumber;
    }

    /**
     * @return array
     */
    public function getSupplierProfiles()
    {
        return $this->supplierProfiles;
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
}