<?php

namespace ES\APIv2Client\Model;

class PartialSupplierProfile implements SupplierProfileInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $countryCode;

    /**
     * @param int $id
     * @param string $countryCode
     */
    public function __construct($id, $countryCode)
    {
        $this->id = $id;
        $this->countryCode = $countryCode;
    }

    /**
     * @return int
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