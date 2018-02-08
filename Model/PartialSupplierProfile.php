<?php

namespace ES\RebirthApiClient\Model;

class PartialSupplierProfile implements ModelInterface, SupplierProfileInterface
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
     * @param string $id
     * @param string $countryCode
     */
    public function __construct($id, $countryCode)
    {
        $this->id = $id;
        $this->countryCode = $countryCode;
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
    public function getCountryCode()
    {
        return $this->countryCode;
    }
}
