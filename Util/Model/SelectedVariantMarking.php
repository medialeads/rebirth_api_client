<?php

namespace ES\RebirthApiClient\Util\Model;

use ES\RebirthCommon\VariantMarkingInterface;

class SelectedVariantMarking
{
    /**
     * @var string|null
     */
    private $length;

    /**
     * @var string|null
     */
    private $width;

    /**
     * @var string|null
     */
    private $squaredSize;

    /**
     * @var string|null
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
     * @var VariantMarkingInterface
     */
    private $variantMarking;

    public function __construct(VariantMarkingInterface $variantMarking)
    {
        $this->variantMarking = $variantMarking;
    }

    /**
     * @return string|null
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param string|null $length
     *
     * @return SelectedVariantMarking
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param string|null $width
     *
     * @return SelectedVariantMarking
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSquaredSize()
    {
        return $this->squaredSize;
    }

    /**
     * @param string|null $squaredSize
     *
     * @return SelectedVariantMarking
     */
    public function setSquaredSize($squaredSize)
    {
        $this->squaredSize = $squaredSize;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDiameter()
    {
        return $this->diameter;
    }

    /**
     * @param string|null $diameter
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
     * @return VariantMarkingInterface
     */
    public function getVariantMarking()
    {
        return $this->variantMarking;
    }
}
