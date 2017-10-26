<?php

namespace Model;

interface SupplierProfileInterface
{

    /**
     * @return int
     */
    public function getId(): int;


    /**
     * @return string
     */
    public function getCountryCode(): string;
}