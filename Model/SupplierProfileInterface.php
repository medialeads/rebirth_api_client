<?php

namespace ES\RebirthApiClient\Model;

interface SupplierProfileInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getCountryCode();
}
