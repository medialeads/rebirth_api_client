<?php

namespace ES\RebirthApiClient\Util\Model;

class SimpleVariableProcessedVariantMarkingOption extends AbstractProcessedVariantMarkingOption
{
    /**
     * @var bool
     */
    private $integer;

    /**
     * @var bool
     */
    private $freeEntry;

    /**
     * @var string|int|null
     */
    private $minimumValue;

    /**
     * @var string|int|null
     */
    private $maximumValue;

    /**
     * @param string $name
     * @param bool $integer
     * @param bool $freeEntry
     * @param string|int|null $minimumValue
     * @param string|int|null $maximumValue
     */
    public function __construct($name, $integer, $freeEntry, $minimumValue, $maximumValue)
    {
        parent::__construct($name);

        $this->integer = $integer;
        $this->freeEntry = $freeEntry;
        $this->minimumValue = $minimumValue;
        $this->maximumValue = $maximumValue;
    }

    /**
     * @return bool
     */
    public function isInteger()
    {
        return $this->integer;
    }

    /**
     * @return bool
     */
    public function isFreeEntry()
    {
        return $this->freeEntry;
    }

    /**
     * @return string|int|null
     */
    public function getMinimumValue()
    {
        return $this->minimumValue;
    }

    /**
     * @return string|int|null
     */
    public function getMaximumValue()
    {
        return $this->maximumValue;
    }

    /**
     * @return string
     */
    public function getUniqueId()
    {
        return sprintf('%s_%s_%s_%s_%s', get_class($this), $this->variantMarkingOption, intval($this->freeEntry), $this->minimumValue, $this->maximumValue);
    }
}
