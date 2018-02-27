<?php

namespace ES\RebirthApiClient\Util\Model;

use ES\RebirthApiClient\Model\VariantMarking;
use ES\RebirthCommon\VariantMarkingOptionsInterface;

class SelectedVariantMarking implements VariantMarkingOptionsInterface
{
    /**
     * @var float|null
     */
    private $length;

    /**
     * @var float|null
     */
    private $width;

    /**
     * @var float|null
     */
    private $squaredSize;

    /**
     * @var float|null
     */
    private $diameter;

    /**
     * @var int|null
     */
    private $numberOfColors;

    /**
     * @var int|null
     */
    private $numberOfPositions;

    /**
     * @var int|null
     */
    private $numberOfLogos;

    /**
     * @var bool
     */
    private $fullColor;

    /**
     * @var VariantMarking
     */
    private $variantMarking;

    public function __construct(VariantMarking $variantMarking)
    {
        $this->variantMarking = $variantMarking;

        $this->fullColor = false;
    }

    /**
     * @return float|null
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param float|null $length
     *
     * @return SelectedVariantMarking
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param float|null $width
     *
     * @return SelectedVariantMarking
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getSquaredSize()
    {
        return $this->squaredSize;
    }

    /**
     * @param float|null $squaredSize
     *
     * @return SelectedVariantMarking
     */
    public function setSquaredSize($squaredSize)
    {
        $this->squaredSize = $squaredSize;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getDiameter()
    {
        return $this->diameter;
    }

    /**
     * @param float|null $diameter
     *
     * @return SelectedVariantMarking
     */
    public function setDiameter($diameter)
    {
        $this->diameter = $diameter;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNumberOfColors()
    {
        return $this->numberOfColors;
    }

    /**
     * @param int|null $numberOfColors
     *
     * @return SelectedVariantMarking
     */
    public function setNumberOfColors($numberOfColors)
    {
        $this->numberOfColors = $numberOfColors;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNumberOfPositions()
    {
        return $this->numberOfPositions;
    }

    /**
     * @param int|null $numberOfPositions
     *
     * @return SelectedVariantMarking
     */
    public function setNumberOfPositions($numberOfPositions)
    {
        $this->numberOfPositions = $numberOfPositions;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNumberOfLogos()
    {
        return $this->numberOfLogos;
    }

    /**
     * @param int|null $numberOfLogos
     *
     * @return SelectedVariantMarking
     */
    public function setNumberOfLogos($numberOfLogos)
    {
        $this->numberOfLogos = $numberOfLogos;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFullColor()
    {
        return $this->fullColor;
    }

    /**
     * @param bool $fullColor
     *
     * @return SelectedVariantMarking
     */
    public function setFullColor($fullColor)
    {
        $this->fullColor = $fullColor;

        return $this;
    }

    /**
     * @return VariantMarking
     */
    public function getVariantMarking()
    {
        return $this->variantMarking;
    }
}
