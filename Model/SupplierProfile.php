<?php

namespace ES\RebirthApiClient\Model;

class SupplierProfile implements ModelInterface, SupplierProfileInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $countryCode;

    /**
     * @var string|null
     */
    private $association;

    /**
     * @param string $id
     * @param string $name
     * @param string $countryCode
     * @param string|null $association
     */
    public function __construct($id, $name, $countryCode, $association)
    {
        $this->id = $id;
        $this->name = $name;
        $this->countryCode = $countryCode;
        $this->association = $association;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @return string|null
     */
    public function getAssociation()
    {
        return $this->association;
    }
}
