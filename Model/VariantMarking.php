<?php

namespace ES\RebirthApiClient\Model;

use ES\RebirthCommon\VariantMarkingOptionsInterface;

class VariantMarking extends AbstractModel implements VariantMarkingOptionsInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string|null
     */
    private $length;

    /**
     * @var string|null
     */
    private $minimumLength;

    /**
     * @var string|null
     */
    private $maximumLength;

    /**
     * @var bool
     */
    private $freeEntryLength;

    /**
     * @var string|null
     */
    private $width;

    /**
     * @var string|null
     */
    private $minimumWidth;

    /**
     * @var string|null
     */
    private $maximumWidth;

    /**
     * @var bool
     */
    private $freeEntryWidth;

    /**
     * @var string|null
     */
    private $squaredSize;

    /**
     * @var string|null
     */
    private $minimumSquaredSize;

    /**
     * @var string|null
     */
    private $maximumSquaredSize;

    /**
     * @var bool
     */
    private $freeEntrySquaredSize;

    /**
     * @var string|null
     */
    private $diameter;

    /**
     * @var string|null
     */
    private $minimumDiameter;

    /**
     * @var string|null
     */
    private $maximumDiameter;

    /**
     * @var bool
     */
    private $freeEntryDiameter;

    /**
     * @var int|null
     */
    private $numberOfColors;

    /**
     * @var int|null
     */
    private $minimumNumberOfColors;

    /**
     * @var int|null
     */
    private $maximumNumberOfColors;

    /**
     * @var bool
     */
    private $freeEntryNumberOfColors;

    /**
     * @var int|null
     */
    private $numberOfPositions;

    /**
     * @var int|null
     */
    private $minimumNumberOfPositions;

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
    private $numberOfLogos;

    /**
     * @var int|null
     */
    private $minimumNumberOfLogos;

    /**
     * @var int|null
     */
    private $maximumNumberOfLogos;

    /**
     * @var bool
     */
    private $freeEntryNumberOfLogos;

    /**
     * @var bool
     */
    private $fullColor;

    /**
     * @var int|null
     */
    private $minimumQuantity;

    /**
     * @var int|null
     */
    private $maximumQuantity;

    /**
     * @var string|null
     */
    private $comment;

    /**
     * @var bool
     */
    private $includedInVariantPrices;

    /**
     * @var MarkingPosition|null
     */
    private $markingPosition;

    /**
     * @var SupplierMarking|null
     */
    private $supplierMarking;

    /**
     * @var Marking
     */
    private $marking;

    /**
     * @var PartialSupplierProfile[]
     */
    private $supplierProfiles;

    /**
     * @var DynamicFixedPrice[]
     */
    private $dynamicFixedPrices;

    /**
     * @var DynamicVariablePriceHolder[]
     */
    private $dynamicVariablePriceHolders;

    /**
     * @var StaticFixedPrice[]
     */
    private $staticFixedPrices;

    /**
     * @var StaticVariablePriceHolder[]
     */
    private $staticVariablePriceHolders;

    /**
     * @param string $id
     * @param string $key
     * @param string $type
     * @param string|null $length
     * @param string|null $minimumLength
     * @param string|null $maximumLength
     * @param bool $freeEntryLength
     * @param string|null $width
     * @param string|null $minimumWidth
     * @param string|null $maximumWidth
     * @param bool $freeEntryWidth
     * @param string|null $squaredSize
     * @param string|null $minimumSquaredSize
     * @param string|null $maximumSquaredSize
     * @param bool $freeEntrySquaredSize
     * @param string|null $diameter
     * @param string|null $minimumDiameter
     * @param string|null $maximumDiameter
     * @param bool $freeEntryDiameter
     * @param int|null $numberOfColors
     * @param int|null $minimumNumberOfColors
     * @param int|null $maximumNumberOfColors
     * @param bool $freeEntryNumberOfColors
     * @param int|null $numberOfPositions
     * @param int|null $minimumNumberOfPositions
     * @param int|null $maximumNumberOfPositions
     * @param bool $freeEntryNumberOfPositions
     * @param int|null $numberOfLogos
     * @param int|null $minimumNumberOfLogos
     * @param int|null $maximumNumberOfLogos
     * @param bool $freeEntryNumberOfLogos
     * @param bool $fullColor
     * @param int|null $minimumQuantity
     * @param int|null $maximumQuantity
     * @param string|null $comment
     * @param bool $includedInVariantPrices
     * @param MarkingPosition|null $markingPosition
     * @param SupplierMarking|null $supplierMarking
     * @param Marking $marking
     * @param PartialSupplierProfile[] $supplierProfiles
     * @param DynamicFixedPrice[] $dynamicFixedPrices
     * @param DynamicVariablePriceHolder[] $dynamicVariablePriceHolders
     * @param StaticFixedPrice[] $staticFixedPrices
     * @param StaticVariablePriceHolder[] $staticVariablePriceHolders
     */
    public function __construct($id, $key, $type, $length, $minimumLength, $maximumLength, $freeEntryLength, $width,
        $minimumWidth, $maximumWidth, $freeEntryWidth, $squaredSize, $minimumSquaredSize, $maximumSquaredSize,
        $freeEntrySquaredSize, $diameter, $minimumDiameter, $maximumDiameter, $freeEntryDiameter, $numberOfColors,
        $minimumNumberOfColors, $maximumNumberOfColors, $freeEntryNumberOfColors, $numberOfPositions,
        $minimumNumberOfPositions, $maximumNumberOfPositions, $freeEntryNumberOfPositions, $numberOfLogos,
        $minimumNumberOfLogos, $maximumNumberOfLogos, $freeEntryNumberOfLogos, $fullColor, $minimumQuantity,
        $maximumQuantity, $comment, $includedInVariantPrices, MarkingPosition $markingPosition = null,
        SupplierMarking $supplierMarking = null, Marking $marking, array $supplierProfiles, array $dynamicFixedPrices,
        array $dynamicVariablePriceHolders, array $staticFixedPrices, array $staticVariablePriceHolders)
    {
        $this->id = $id;
        $this->key = $key;
        $this->type = $type;
        $this->length = $length;
        $this->minimumLength = $minimumLength;
        $this->maximumLength = $maximumLength;
        $this->freeEntryLength = $freeEntryLength;
        $this->width = $width;
        $this->minimumWidth = $minimumWidth;
        $this->maximumWidth = $maximumWidth;
        $this->freeEntryWidth = $freeEntryWidth;
        $this->squaredSize = $squaredSize;
        $this->minimumSquaredSize = $minimumSquaredSize;
        $this->maximumSquaredSize = $maximumSquaredSize;
        $this->freeEntrySquaredSize = $freeEntrySquaredSize;
        $this->diameter = $diameter;
        $this->minimumDiameter = $minimumDiameter;
        $this->maximumDiameter = $maximumDiameter;
        $this->freeEntryDiameter = $freeEntryDiameter;
        $this->numberOfColors = $numberOfColors;
        $this->minimumNumberOfColors = $minimumNumberOfColors;
        $this->maximumNumberOfColors = $maximumNumberOfColors;
        $this->freeEntryNumberOfColors = $freeEntryNumberOfColors;
        $this->numberOfPositions = $numberOfPositions;
        $this->minimumNumberOfPositions = $minimumNumberOfPositions;
        $this->maximumNumberOfPositions = $maximumNumberOfPositions;
        $this->freeEntryNumberOfPositions = $freeEntryNumberOfPositions;
        $this->numberOfLogos = $numberOfLogos;
        $this->minimumNumberOfLogos = $minimumNumberOfLogos;
        $this->maximumNumberOfLogos = $maximumNumberOfLogos;
        $this->freeEntryNumberOfLogos = $freeEntryNumberOfLogos;
        $this->fullColor = $fullColor;
        $this->minimumQuantity = $minimumQuantity;
        $this->maximumQuantity = $maximumQuantity;
        $this->comment = $comment;
        $this->includedInVariantPrices = $includedInVariantPrices;
        $this->markingPosition = $markingPosition;
        $this->supplierMarking = $supplierMarking;
        $this->marking = $marking;
        $this->supplierProfiles = $supplierProfiles;
        $this->dynamicFixedPrices = $dynamicFixedPrices;
        $this->dynamicVariablePriceHolders = $dynamicVariablePriceHolders;
        $this->staticFixedPrices = $staticFixedPrices;
        $this->staticVariablePriceHolders = $staticVariablePriceHolders;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @return string|null
     */
    public function getMinimumLength()
    {
        return $this->minimumLength;
    }

    /**
     * @return string|null
     */
    public function getMaximumLength()
    {
        return $this->maximumLength;
    }

    /**
     * @return bool
     */
    public function isFreeEntryLength()
    {
        return $this->freeEntryLength;
    }

    /**
     * @return string|null
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return string|null
     */
    public function getMinimumWidth()
    {
        return $this->minimumWidth;
    }

    /**
     * @return string|null
     */
    public function getMaximumWidth()
    {
        return $this->maximumWidth;
    }

    /**
     * @return bool
     */
    public function isFreeEntryWidth()
    {
        return $this->freeEntryWidth;
    }

    /**
     * @return string|null
     */
    public function getSquaredSize()
    {
        return $this->squaredSize;
    }

    /**
     * @return string|null
     */
    public function getMinimumSquaredSize()
    {
        return $this->minimumSquaredSize;
    }

    /**
     * @return string|null
     */
    public function getMaximumSquaredSize()
    {
        return $this->maximumSquaredSize;
    }

    /**
     * @return bool
     */
    public function isFreeEntrySquaredSize()
    {
        return $this->freeEntrySquaredSize;
    }

    /**
     * @return string|null
     */
    public function getDiameter()
    {
        return $this->diameter;
    }

    /**
     * @return string|null
     */
    public function getMinimumDiameter()
    {
        return $this->minimumDiameter;
    }

    /**
     * @return string|null
     */
    public function getMaximumDiameter()
    {
        return $this->maximumDiameter;
    }

    /**
     * @return bool
     */
    public function isFreeEntryDiameter()
    {
        return $this->freeEntryDiameter;
    }

    /**
     * @return int|null
     */
    public function getNumberOfColors()
    {
        return $this->numberOfColors;
    }

    /**
     * @return int|null
     */
    public function getMinimumNumberOfColors()
    {
        return $this->minimumNumberOfColors;
    }

    /**
     * @return int|null
     */
    public function getMaximumNumberOfColors()
    {
        return $this->maximumNumberOfColors;
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
    public function getNumberOfPositions()
    {
        return $this->numberOfPositions;
    }

    /**
     * @return int|null
     */
    public function getMinimumNumberOfPositions()
    {
        return $this->minimumNumberOfPositions;
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
    public function getNumberOfLogos()
    {
        return $this->numberOfLogos;
    }

    /**
     * @return int|null
     */
    public function getMinimumNumberOfLogos()
    {
        return $this->minimumNumberOfLogos;
    }

    /**
     * @return int|null
     */
    public function getMaximumNumberOfLogos()
    {
        return $this->maximumNumberOfLogos;
    }

    /**
     * @return bool
     */
    public function isFreeEntryNumberOfLogos()
    {
        return $this->freeEntryNumberOfLogos;
    }

    /**
     * @return bool
     */
    public function isFullColor()
    {
        return $this->fullColor;
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
    public function getMaximumQuantity()
    {
        return $this->maximumQuantity;
    }

    /**
     * @return string|null
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return bool
     */
    public function isIncludedInVariantPrices()
    {
        return $this->includedInVariantPrices;
    }

    /**
     * @return MarkingPosition|null
     */
    public function getMarkingPosition()
    {
        return $this->markingPosition;
    }

    /**
     * @return SupplierMarking|null
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
     * @return PartialSupplierProfile[]
     */
    public function getSupplierProfiles()
    {
        return $this->supplierProfiles;
    }

    /**
     * @return DynamicFixedPrice[]
     */
    public function getDynamicFixedPrices()
    {
        return $this->dynamicFixedPrices;
    }

    /**
     * @return DynamicVariablePriceHolder[]
     */
    public function getDynamicVariablePriceHolders()
    {
        return $this->dynamicVariablePriceHolders;
    }

    /**
     * @return StaticFixedPrice[]
     */
    public function getStaticFixedPrices()
    {
        return $this->staticFixedPrices;
    }

    /**
     * @return StaticVariablePriceHolder[]
     */
    public function getStaticVariablePriceHolders()
    {
        return $this->staticVariablePriceHolders;
    }
}
