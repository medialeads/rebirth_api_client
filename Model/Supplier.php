<?php

namespace Model;

class Supplier
{
    /** @var  string */
    private $projectId;

    /** @var  string */
    private $vatIdentificationNumber;

    /** @var  array */
    private $supplierProfiles;

    /** @var  string */
    private $name;

    /** @var  int */
    private $id;

    /** @var  string */
    private $legalName;

    /** @var  string */
    private $slug;

    /**
     * @param string $projectId
     * @param string $vatIdentificationNumber
     * @param array $supplierProfiles
     * @param string $name
     * @param int $id
     * @param string $legalName
     * @param string $slug
     */
    public function __construct(string $projectId, string $vatIdentificationNumber, array $supplierProfiles, string $name, int $id, string $legalName, string $slug)
    {
        $this->projectId = $projectId;
        $this->vatIdentificationNumber = $vatIdentificationNumber;
        $this->supplierProfiles = $supplierProfiles;
        $this->name = $name;
        $this->id = $id;
        $this->legalName = $legalName;
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getProjectId(): string
    {
        return $this->projectId;
    }

    /**
     * @return string
     */
    public function getVatIdentificationNumber(): string
    {
        return $this->vatIdentificationNumber;
    }

    /**
     * @return array
     */
    public function getSupplierProfiles(): array
    {
        return $this->supplierProfiles;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLegalName(): string
    {
        return $this->legalName;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }
}