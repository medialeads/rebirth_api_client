<?php

namespace ES\RebirthApiClient\Model;

class VariantPackaging implements ModelInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string|null
     */
    private $type;

    /**
     * @var int|null
     */
    private $innerQuantity;

    /**
     * @var string|null
     */
    private $weight;

    /**
     * @var VariantPackaging|null
     */
    private $parent;

    /**
     * @var VariantPackagingSize[]
     */
    private $variantPackagingSizes;

    /**
     * @param string $id
     * @param string|null $type
     * @param int|null $innerQuantity
     * @param string|null $weight
     * @param VariantPackaging|null $parent
     * @param VariantPackagingSize[] $variantPackagingSizes
     */
    public function __construct($id, $type, $innerQuantity, $weight, VariantPackaging $parent = null,
        array $variantPackagingSizes)
    {
        $this->id = $id;
        $this->type = $type;
        $this->innerQuantity = $innerQuantity;
        $this->weight = $weight;
        $this->parent = $parent;
        $this->variantPackagingSizes = $variantPackagingSizes;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int|null
     */
    public function getInnerQuantity()
    {
        return $this->innerQuantity;
    }

    /**
     * @return string|null
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @return VariantPackaging|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return VariantPackagingSize[]
     */
    public function getVariantPackagingSizes()
    {
        return $this->variantPackagingSizes;
    }
}
