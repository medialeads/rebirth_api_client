<?php

namespace ES\APIv2Client\Model;

use ES\APIv2Client\Helper\VariantMarkingHelper;

class VariantMarking
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var bool
     */
    private $freeEntrySquaredSize;

    /**
     * @var string
     */
    private $type;

    /**
     * @var float|null
     */
    private $minimumLength;

    /**
     * @var float|null
     */
    private $minimumDiameter;

    /**
     * @var int|null
     */
    private $numberOfPositions;

    /**
     * @var bool
     */
    private $freeEntryNumberOfLogos;

    /**
     * @var float|null
     */
    private $maximumDiameter;

    /**
     * @var float|null
     */
    private $diameter;

    /**
     * @var string
     */
    private $projectId;

    /**
     * @var bool
     */
    private $freeEntryLength;

    /**
     * @var array
     */
    private $staticVariablePriceHolders;

    /**
     * @var int|null
     */
    private $minimumNumberOfColors;

    /**
     * @var bool
     */
    private $freeEntryDiameter;

    /**
     * @var array
     */
    private $staticFixedPrices;

    /**
     * @var bool
     */
    private $fullColor;

    /**
     * @var MarkingPosition|null
     */
    private $markingPosition;

    /**
     * @var bool
     */
    private $freeEntryNumberOfColors;

    /**
     * @var int|null
     */
    private $maximumNumberOfPositions;

    /**
     * @var bool
     */
    private $freeEntryNumberOfPositions;

    /**
     * @var int|null
     */
    private $maximumQuantity;

    /**
     * @var int|null
     */
    private $minimumNumberOfLogos;

    /**
     * @var float|null
     */
    private $length;

    /**
     * @var float|null
     */
    private $minimumWidth;

    /**
     * @var float|null
     */
    private $minimumSquaredSize;

    /**
     * @var array
     */
    private $dynamicVariablePriceHolders;

    /**
     * @var int|null
     */
    private $numberOfColors;

    /**
     * @var SupplierMarking|null
     */
    private $supplierMarking;

    /**
     * @var Marking
     */
    private $marking;

    /**
     * @var float|null
     */
    private $maximumLength;

    /**
     * @var float|null
     */
    private $squaredSize;

    /**
     * @var float|null
     */
    private $width;

    /**
     * @var int|null
     */
    private $maximumNumberOfLogos;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var int|null
     */
    private $maximumWidth;

    /**
     * @var int|null
     */
    private $minimumQuantity;

    /**
     * @var int|null
     */
    private $maximumNumberOfColors;

    /**
     * @var array
     */
    private $dynamicFixedPrices;

    /**
     * @var float|null
     */
    private $maximumSquaredSize;

    /**
     * @param string $id
     * @param bool $freeEntrySquaredSize
     * @param string $type
     * @param float|null $minimumLength
     * @param float|null $minimumDiameter
     * @param int|null $numberOfPositions
     * @param bool $freeEntryNumberOfLogos
     * @param float|null $maximumDiameter
     * @param float|null $diameter
     * @param string $projectId
     * @param bool $freeEntryLength
     * @param array $staticVariablePriceHolders
     * @param int|null $minimumNumberOfColors
     * @param bool $freeEntryDiameter
     * @param array $staticFixedPrices
     * @param bool $fullColor
     * @param MarkingPosition|null $markingPosition
     * @param bool $freeEntryNumberOfColors
     * @param int|null $maximumNumberOfPositions
     * @param bool $freeEntryNumberOfPositions
     * @param int|null $maximumQuantity
     * @param int|null $minimumNumberOfLogos
     * @param float|null $length
     * @param float|null $minimumWidth
     * @param float|null $minimumSquaredSize
     * @param array $dynamicVariablePriceHolders
     * @param int|null $numberOfColors
     * @param SupplierMarking|null $supplierMarking
     * @param Marking $marking
     * @param float|null $maximumLength
     * @param float|null $squaredSize
     * @param float|null $width
     * @param int|null $maximumNumberOfLogos
     * @param string $comment
     * @param int|null $maximumWidth
     * @param int|null $minimumQuantity
     * @param int|null $maximumNumberOfColors
     * @param array $dynamicFixedPrices
     * @param float|null $maximumSquaredSize
     */
    public function __construct($id, $freeEntrySquaredSize, $type, $minimumLength, $minimumDiameter, $numberOfPositions, $freeEntryNumberOfLogos, $maximumDiameter, $diameter, $projectId, $freeEntryLength, $staticVariablePriceHolders, $minimumNumberOfColors, $freeEntryDiameter, $staticFixedPrices, $fullColor, $markingPosition, $freeEntryNumberOfColors, $maximumNumberOfPositions, $freeEntryNumberOfPositions, $maximumQuantity, $minimumNumberOfLogos, $length, $minimumWidth, $minimumSquaredSize, $dynamicVariablePriceHolders, $numberOfColors, $supplierMarking, $marking, $maximumLength, $squaredSize, $width, $maximumNumberOfLogos, $comment, $maximumWidth, $minimumQuantity, $maximumNumberOfColors, $dynamicFixedPrices, $maximumSquaredSize)
    {
        foreach ($staticVariablePriceHolders as $staticVariablePriceHolder)
        {
            if (!$staticVariablePriceHolder instanceof StaticVariablePriceHolder) {
                throw new \InvalidArgumentException();
            }
        }

        if (!$markingPosition instanceof MarkingPosition && null !== $markingPosition) {
            throw new \InvalidArgumentException();
        }

        foreach ($staticFixedPrices as $staticFixedPrice)
        {
            if (!$staticFixedPrice instanceof StaticFixedPrice) {
                throw new \InvalidArgumentException();
            }
        }

        foreach ($dynamicVariablePriceHolders as $dynamicVariablePriceHolder)
        {
            if (!$dynamicVariablePriceHolder instanceof DynamicVariablePriceHolder) {
                throw new \InvalidArgumentException();
            }
        }

        if ($type === "supplier") {
            if (!$supplierMarking instanceof SupplierMarking) {
                throw new \UnexpectedValueException('Type is "supplier", variable $supplierMarking must be instance of SupplierMarking ');
            }
        } else {
            if ($supplierMarking instanceof SupplierMarking) {
                throw new \UnexpectedValueException('Type is "simple", variable $supplierMarking must be null');
            }
        }

        if (!$marking instanceof Marking) {
            throw new \InvalidArgumentException();
        }

        foreach ($dynamicFixedPrices as $dynamicFixedPrice)
        {
            if (!$dynamicFixedPrice instanceof DynamicFixedPrice) {
                throw new \InvalidArgumentException();
            }
        }

        $this->id = $id;
        $this->freeEntrySquaredSize = $freeEntrySquaredSize;
        $this->type = $type;
        $this->minimumLength = $minimumLength;
        $this->minimumDiameter = $minimumDiameter;
        $this->numberOfPositions = $numberOfPositions;
        $this->freeEntryNumberOfLogos = $freeEntryNumberOfLogos;
        $this->maximumDiameter =$maximumDiameter;
        $this->diameter = $diameter;
        $this->projectId = $projectId;
        $this->freeEntryLength = $freeEntryLength;
        $this->staticVariablePriceHolders = $staticVariablePriceHolders;
        $this->minimumNumberOfColors = $minimumNumberOfColors;
        $this->freeEntryDiameter = $freeEntryDiameter;
        $this->staticFixedPrices = $staticFixedPrices;
        $this->fullColor = $fullColor;
        $this->markingPosition = $markingPosition;
        $this->freeEntryNumberOfColors = $freeEntryNumberOfColors;
        $this->maximumNumberOfPositions = $maximumNumberOfPositions;
        $this->freeEntryNumberOfPositions = $freeEntryNumberOfPositions;
        $this->maximumQuantity = $maximumQuantity;
        $this->minimumNumberOfLogos = $minimumNumberOfLogos;
        $this->length = $length;
        $this->minimumWidth = $minimumWidth;
        $this->minimumSquaredSize = $minimumSquaredSize;
        $this->dynamicVariablePriceHolders = $dynamicVariablePriceHolders;
        $this->numberOfColors = $numberOfColors;
        $this->supplierMarking = $supplierMarking;
        $this->marking = $marking;
        $this->maximumLength = $maximumLength;
        $this->squaredSize = $squaredSize;
        $this->width = $width;
        $this->maximumNumberOfLogos = $maximumNumberOfLogos;
        $this->comment = $comment;
        $this->maximumWidth = $maximumWidth;
        $this->minimumQuantity = $minimumQuantity;
        $this->maximumNumberOfColors = $minimumNumberOfColors;
        $this->dynamicFixedPrices = $dynamicFixedPrices;
        $this->maximumSquaredSize = $maximumSquaredSize;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isFreeEntrySquaredSize()
    {
        return $this->freeEntrySquaredSize;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return float|null
     */
    public function getMinimumLength()
    {
        return $this->minimumLength;
    }

    /**
     * @return float|null
     */
    public function getMinimumDiameter()
    {
        return $this->minimumDiameter;
    }

    /**
     * @return int|null
     */
    public function getNumberOfPositions()
    {
        return $this->numberOfPositions;
    }

    /**
     * @return bool
     */
    public function isFreeEntryNumberOfLogos()
    {
        return $this->freeEntryNumberOfLogos;
    }

    /**
     * @return float|null
     */
    public function getMaximumDiameter()
    {
        return $this->maximumDiameter;
    }

    /**
     * @return float|null
     */
    public function getDiameter()
    {
        return $this->diameter;
    }

    /**
     * @return string
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @return bool
     */
    public function isFreeEntryLength()
    {
        return $this->freeEntryLength;
    }

    /**
     * @return array
     */
    public function getStaticVariablePriceHolders()
    {
        return $this->staticVariablePriceHolders;
    }

    /**
     * @return int|null
     */
    public function getMinimumNumberOfColors()
    {
        return $this->minimumNumberOfColors;
    }

    /**
     * @return bool
     */
    public function isFreeEntryDiameter()
    {
        return $this->freeEntryDiameter;
    }

    /**
     * @return array
     */
    public function getStaticFixedPrices()
    {
        return $this->staticFixedPrices;
    }

    /**
     * @return bool
     */
    public function isFullColor()
    {
        return $this->fullColor;
    }

    /**
     * @return MarkingPosition
     */
    public function getMarkingPosition()
    {
        return $this->markingPosition;
    }

    /**
     * @return bool
     */
    public function isFreeEntryNumberOfColors()
    {
        return $this->freeEntryNumberOfColors;
    }

    /**
     * @return int|null
     */
    public function getMaximumNumberOfPositions()
    {
        return $this->maximumNumberOfPositions;
    }

    /**
     * @return bool
     */
    public function isFreeEntryNumberOfPositions()
    {
        return $this->freeEntryNumberOfPositions;
    }

    /**
     * @return int|null
     */
    public function getMaximumQuantity()
    {
        return $this->maximumQuantity;
    }

    /**
     * @return int|null
     */
    public function getMinimumNumberOfLogos()
    {
        return $this->minimumNumberOfLogos;
    }

    /**
     * @return float|null
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @return float|null
     */
    public function getMinimumWidth()
    {
        return $this->minimumWidth;
    }

    /**
     * @return float|null
     */
    public function getMinimumSquaredSize()
    {
        return $this->minimumSquaredSize;
    }

    /**
     * @return array
     */
    public function getDynamicVariablePriceHolders()
    {
        return $this->dynamicVariablePriceHolders;
    }

    /**
     * @return int|null
     */
    public function getNumberOfColors()
    {
        return $this->numberOfColors;
    }

    /**
     * @return SupplierMarking
     */
    public function getSupplierMarking()
    {
        return $this->supplierMarking;
    }

    /**
     * @return Marking
     */
    public function getMarking()
    {
        return $this->marking;
    }

    /**
     * @return float|null
     */
    public function getMaximumLength()
    {
        return $this->maximumLength;
    }

    /**
     * @return float|null
     */
    public function getSquaredSize()
    {
        return $this->squaredSize;
    }

    /**
     * @return float|null
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int|null
     */
    public function getMaximumNumberOfLogos()
    {
        return $this->maximumNumberOfLogos;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return float|null
     */
    public function getMaximumWidth()
    {
        return $this->maximumWidth;
    }

    /**
     * @return int|null
     */
    public function getMinimumQuantity()
    {
        return $this->minimumQuantity;
    }

    /**
     * @return int|null
     */
    public function getMaximumNumberOfColors()
    {
        return $this->maximumNumberOfColors;
    }

    /**
     * @return array
     */
    public function getDynamicFixedPrices()
    {
        return $this->dynamicFixedPrices;
    }

    /**
     * @return float|null
     */
    public function getMaximumSquaredSize()
    {
        return $this->maximumSquaredSize;
    }

    public function getCalculatedPrice(SupplierProfileInterface $supplierProfile, $quantity, VariantMarkingModel $variantMarkingModel)
    {
        return VariantMarkingHelper::getCalculatedPrice($this, $supplierProfile, $quantity, $variantMarkingModel);
    }
}
