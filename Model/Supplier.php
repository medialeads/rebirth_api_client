<?php

namespace Model;

class Supplier
{
    /** @var  int */
    private $id;

    /** @var  string */
    private $projectId;

    /** @var  string */
    private $vatIdentificationNumber;

    /** @var  array */
    private $supplierProfiles;

    /** @var  string */
    private $name;

    /** @var  string */
    private $legalName;

    /** @var  string */
    private $slug;

    /**
     * @param string $projectId
     * @param string|null $vatIdentificationNumber
     * @param array $supplierProfiles
     * @param string $name
     * @param int $id
     * @param string $legalName
     * @param string $slug
     */
    public function __construct(int $id, string $projectId, $vatIdentificationNumber, array $supplierProfiles, string $name, string $legalName, string $slug)
    {
        $this->id = $id;
        $this->projectId = $projectId;
        $this->vatIdentificationNumber = $vatIdentificationNumber;
        $this->supplierProfiles = $supplierProfiles;
        $this->name = $name;
        $this->legalName = $legalName;
        $this->slug = $slug;
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
    public function getProjectId(): string
    {
        return $this->projectId;
    }

    /**
     * @return string|null
     */
    public function getVatIdentificationNumber()
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