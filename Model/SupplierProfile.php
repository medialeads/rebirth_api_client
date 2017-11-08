<?php

namespace ES\APIv2Client\Model;

/**
 * @author Dagan MENEZ
 */
class SupplierProfile implements SupplierProfileInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $countryCode;

    /**
     * @var string
     */
    private $projectId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var null|string
     */
    private $association;

    /**
     * @var bool
     */
    private $displayPrices;

    /**
     * @var string
     */
    private $status;

    /**
     * @param string $id
     * @param string $countryCode
     * @param string $projectId
     * @param string $name
     * @param null|string $association
     * @param bool $displayPrices
     * @param string $status
     */
    public function __construct($id, $countryCode, $projectId, $name, $association, $displayPrices, $status)
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
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @return string
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function getDisplayPrices()
    {
        return $this->displayPrices;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}