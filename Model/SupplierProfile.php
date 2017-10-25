<?php

namespace Model;

class SupplierProfile
{
    /** @var  int */
    private $id;

    /** @var  string */
    private $countryCode;

    /** @var  string */
    private $projectId;

    /** @var  string */
    private $name;

    /** @var  string */
    private $association;

    /** @var  bool */
    private $displayPrices;

    /** @var  string */
    private $status;

    /**
     * @param string $countryCode
     * @param string $projectId
     * @param string $name
     * @param string $association
     * @param int $id
     * @param bool $displayPrices
     * @param string $status
     */
    public function __construct(int $id, string $countryCode, string $projectId = "", string $name = "", string $association = "", bool $displayPrices = false, string $status = "")
    {
        $this->countryCode = $countryCode;
        $this->projectId = $projectId;
        $this->name = $name;
        $this->association = $association;
        $this->id = $id;
        $this->displayPrices = $displayPrices;
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function getDisplayPrices(): bool
    {
        return $this->displayPrices;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}