<?php

namespace ES\RebirthApiClient\Util\Model;

interface ProcessedVariantMarkingOptionInterface
{
    /**
     * @return string
     */
    public function getUniqueId();

    /**
     * @return string
     */
    public function getName();
}
