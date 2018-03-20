<?php

namespace ES\RebirthApiClient\Util\Model;

class SimpleFixedProcessedVariantMarkingOption extends AbstractProcessedVariantMarkingOption
{
    /**
     * @var string|int
     */
    private $value;

    /**
     * @param string $name
     * @param string|int $value
     */
    public function __construct($name, $value)
    {
        parent::__construct($name);

        $this->value = $value;
    }

    /**
     * @return string|int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getUniqueId()
    {
        return sprintf('%s_%s_%s', get_class($this), $this->name, (string) $this->value);
    }
}
