<?php

namespace Model;

class VariantMarking
{
    /** @var  bool */
    private $freeEntrySquaredSize;

    /** @var  string */
    private $type;

    /** @var  float|null */
    private $minimumLength;

    /** @var  float|null */
    private $minimumDiameter;

    /** @var  int|null */
    private $numberOfPositions;

    /** @var  bool */
    private $freeEntryNumberOfLogos;

    /** @var  float|null */
    private $maximumDiameter;

    /** @var  float|null */
    private $diameter;

    /** @var  string */
    private $projectId;

    /** @var  bool */
    private $freeEntryLength;

    /** @var  array */
    private $staticVariablePriceHolders;

    /** @var  int */
    private $id;

    /** @var  int|null */
    private $minimumNumberOfColors;

    /** @var  bool */
    private $freeEntryDiameter;

    /** @var  array */
    private $staticFixedPrices;

    /** @var  bool */
    private $fullColor;

    /** @var  MarkingPosition */
    private $markingPosition;

    /** @var  bool */
    private $freeEntryNumberOfColors;

    /** @var  int|null */
    private $maximumNumberOfPositions;

    /** @var  bool */
    private $freeEntryNumberOfPositions;

    /** @var  int|null */
    private $maximumQuantity;

    /** @var  int|null */
    private $minimumNumberOfLogos;

    /** @var  float|null */
    private $length;

    /** @var  float|null */
    private $minimumWidth;

    /** @var  float|null */
    private $minimumSquaredSize;

    /** @var  array */
    private $dynamicVariablePriceHolders;

    /** @var  int|null */
    private $numberOfColors;

    /** @var  SupplierMarking */
    private $supplierMarking;

    /** @var  Marking */
    private $marking;

    /** @var  float|null */
    private $maximumLength;

    /** @var  float|null */
    private $squaredSize;

    /** @var  float|null */
    private $width;

    /** @var  int|null */
    private $maximumNumberOfLogos;

    /** @var  string */
    private $comment;

    /** @var  float|null */
    private $maximumWidth;

    /** @var  int|null */
    private $minimumQuantity;

    /** @var  int|null */
    private $maximumNumberOfColors;

    /** @var  array */
    private $dynamicFixedPrices;

    /** @var  float|null */
    private $maximumSquaredSize;

    /**
     * @param bool $freeEntrySquaredSize
     * @param string $type
     * @param mixed $minimumLength
     * @param mixed $minimumDiameter
     * @param mixed $numberOfPositions
     * @param bool $freeEntryNumberOfLogos
     * @param mixed $maximumDiameter
     * @param mixed $diameter
     * @param mixed $projectId
     * @param bool $freeEntryLength
     * @param array $staticVariablePriceHolders
     * @param int $id
     * @param mixed $minimumNumberOfColors
     * @param bool $freeEntryDiameter
     * @param array $staticFixedPrices
     * @param bool $fullColor
     * @param MarkingPosition $markingPosition
     * @param bool $freeEntryNumberOfColors
     * @param mixed $maximumNumberOfPositions
     * @param bool $freeEntryNumberOfPositions
     * @param mixed $maximumQuantity
     * @param mixed $minimumNumberOfLogos
     * @param mixed $length
     * @param mixed $minimumWidth
     * @param mixed $minimumSquaredSize
     * @param mixed $dynamicVariablePriceHolders
     * @param mixed $numberOfColors
     * @param SupplierMarking $supplierMarking
     * @param Marking $marking
     * @param mixed $maximumLength
     * @param mixed $squaredSize
     * @param mixed $width
     * @param mixed $maximumNumberOfLogos
     * @param string $comment
     * @param mixed $maximumWidth
     * @param mixed $minimumQuantity
     * @param mixed $maximumNumberOfColors
     * @param array $dynamicFixedPrices
     * @param mixed $maximumSquaredSize
     */
    public function __construct(bool $freeEntrySquaredSize, string $type, mixed $minimumLength, mixed $minimumDiameter, mixed $numberOfPositions, bool $freeEntryNumberOfLogos, mixed $maximumDiameter, mixed $diameter, mixed $projectId, bool $freeEntryLength, array $staticVariablePriceHolders, int $id, mixed $minimumNumberOfColors, bool $freeEntryDiameter, array $staticFixedPrices, bool $fullColor, MarkingPosition $markingPosition, bool $freeEntryNumberOfColors, mixed $maximumNumberOfPositions, bool $freeEntryNumberOfPositions, mixed $maximumQuantity, mixed $minimumNumberOfLogos, mixed $length, mixed $minimumWidth, mixed $minimumSquaredSize, mixed $dynamicVariablePriceHolders, mixed $numberOfColors, SupplierMarking $supplierMarking, Marking $marking, mixed $maximumLength, mixed $squaredSize, mixed $width, mixed $maximumNumberOfLogos, string $comment, mixed $maximumWidth, mixed $minimumQuantity, mixed $maximumNumberOfColors, array $dynamicFixedPrices, mixed $maximumSquaredSize)
    {
        if (!$supplierMarking instanceof SupplierMarking) {
            throw new \InvalidArgumentException();
        }

        if (!$marking instanceof Marking) {
            throw new \InvalidArgumentException();
        }

        if (!$markingPosition instanceof MarkingPosition) {
            throw new \InvalidArgumentException();
        }

        foreach ($staticVariablePriceHolders as $staticVariablePriceHolder)
        {
            if (!$staticVariablePriceHolder instanceof StaticVariablePriceHolder) {
                throw new \InvalidArgumentException();
            }
        }

        foreach ($dynamicVariablePriceHolders as $dynamicVariablePriceHolder)
        {
            if (!$dynamicVariablePriceHolder instanceof DynamicVariablePriceHolder) {
                throw new \InvalidArgumentException();
            }
        }

        foreach ($staticFixedPrices as $staticFixedPrice)
        {
            if (!$staticFixedPrice instanceof StaticFixedPrice) {
                throw new \InvalidArgumentException();
            }
        }

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
        $this->id = $id;
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
     * @return bool
     */
    public function isFreeEntrySquaredSize(): bool
    {
        return $this->freeEntrySquaredSize;
    }

    /**
     * @return string
     */
    public function getType(): string
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
    public function isFreeEntryNumberOfLogos(): bool
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
    public function getProjectId(): string
    {
        return $this->projectId;
    }

    /**
     * @return bool
     */
    public function isFreeEntryLength(): bool
    {
        return $this->freeEntryLength;
    }

    /**
     * @return array
     */
    public function getStaticVariablePriceHolders(): array
    {
        return $this->staticVariablePriceHolders;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
    public function isFreeEntryDiameter(): bool
    {
        return $this->freeEntryDiameter;
    }

    /**
     * @return array
     */
    public function getStaticFixedPrices(): array
    {
        return $this->staticFixedPrices;
    }

    /**
     * @return bool
     */
    public function isFullColor(): bool
    {
        return $this->fullColor;
    }

    /**
     * @return MarkingPosition
     */
    public function getMarkingPosition(): MarkingPosition
    {
        return $this->markingPosition;
    }

    /**
     * @return bool
     */
    public function isFreeEntryNumberOfColors(): bool
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
    public function isFreeEntryNumberOfPositions(): bool
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
    public function getDynamicVariablePriceHolders(): array
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
    public function getSupplierMarking(): SupplierMarking
    {
        return $this->supplierMarking;
    }

    /**
     * @return Marking
     */
    public function getMarking(): Marking
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
    public function getComment(): string
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
    public function getDynamicFixedPrices(): array
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
}
