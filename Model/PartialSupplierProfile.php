<?php

namespace Model;

require_once('SupplierProfileInterface.php');

class PartialSupplierProfile implements SupplierProfileInterface
{
    /** @var  int */
    private $id;

    /** @var  string */
    private $countryCode;

    /**
     * @param int $id
     * @param string $countryCode
     */
    public function __construct(int $id, string $countryCode)
    {
        $this->id = $id;
        $this->countryCode = $countryCode;
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
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }
}