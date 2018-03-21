<?php

namespace ES\RebirthApiClient\Util\Model;

abstract class AbstractProcessedVariantMarkingOption implements ProcessedVariantMarkingOptionInterface
{
    /**
     * @var string
     */
    protected $variantMarkingOption;

    /**
     * @param string $variantMarkingOption
     */
    public function __construct($variantMarkingOption)
    {
        $this->variantMarkingOption = $variantMarkingOption;
    }

    /**
     * @return string
     */
    public function getVariantMarkingOption()
    {
        return $this->variantMarkingOption;
    }
}
