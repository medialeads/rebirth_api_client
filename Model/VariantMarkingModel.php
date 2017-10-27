<?php

namespace ES\APIv2Client\Model;

class VariantMarkingModel
{
    /**
     * @var VariantMarking
     */
    private $variantMarking;

    /**
     * @var float|null
     */
    private $length;

    /**
     * @var float|null
     */
    private $width;

    // la superficie doit être rensignée en mm carré !!
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
    private $fullColor = false;

    /**
     * @return VariantMarking
     */
    public function getVariantMarking()
    {
        return $this->variantMarking;
    }

    /**
     * @param VariantMarking $variantMarking
     *
     * @return VariantMarkingModel
     */
    public function setVariantMarking(VariantMarking $variantMarking)
    {
        $this->variantMarking = $variantMarking;

        return $this;
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
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
     */
    public function setNumberOfLogos($numberOfLogos)
    {
        $this->numberOfLogos = $numberOfLogos;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFullColor(): bool
    {
        return $this->fullColor;
    }

    /**
     * @param bool $fullColor
     *
     * @return $this
     */
    public function setFullColor(bool $fullColor)
    {
        $this->fullColor = $fullColor;

        return $this;
    }

}
