<?php

namespace ES\RebirthApiClient\Util\Model;

use ES\RebirthCommon\MarkingPositionInterface;
use ES\RebirthCommon\VariantMarkingOptionsInterface;

class MarkingPositionProcessedVariantMarkingOption extends AbstractProcessedVariantMarkingOption
{
    /**
     * @var MarkingPositionInterface
     */
    private $markingPosition;

    /**
     * @param MarkingPositionInterface $markingPosition
     */
    public function __construct(MarkingPositionInterface $markingPosition)
    {
        parent::__construct(VariantMarkingOptionsInterface::POSITION);

        $this->markingPosition = $markingPosition;
    }

    /**
     * @return MarkingPositionInterface
     */
    public function getMarkingPosition()
    {
        return $this->markingPosition;
    }

    /**
     * @return string
     */
    public function getUniqueId()
    {
        return sprintf('%s_%s_%s', get_class($this), $this->variantMarkingOption, $this->markingPosition->getUniqueId());
    }
}
