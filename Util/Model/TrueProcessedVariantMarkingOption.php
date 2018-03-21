<?php

namespace ES\RebirthApiClient\Util\Model;

class TrueProcessedVariantMarkingOption extends AbstractProcessedVariantMarkingOption
{
    /**
     * @return string
     */
    public function getUniqueId()
    {
        return sprintf('%s_%s', get_class($this), $this->variantMarkingOption);
    }
}
