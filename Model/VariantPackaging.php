<?php

namespace ES\APIv2Client\Model;

class VariantPackaging
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $projectId;

    /**
     * @var null|VariantPackaging
     */
    private $parent;

    /**
     * @var string
     */
    private $type;

    /**
     * @var integer
     */
    private $innerQuantity;

    /**
     * @var float
     */
    private $weight;

    /**
     * @var VariantPackagingSize[]
     */
    private $variantPackagingSizes;

    /**
     * @param string $id
     * @param string $projectId
     * @param null|VariantPackaging $parent
     * @param string $type
     * @param integer $innerQuantity
     * @param float $weight
     * @param VariantPackagingSize[] $variantPackagingSizes
     */
    public function __construct($id, $projectId, $parent, $type, $innerQuantity, $weight, $variantPackagingSizes)
    {
        $this->id = $id;
        $this->projectId = $projectId;
        $this->parent = $parent;
        $this->type = $type;
        $this->innerQuantity = $innerQuantity;
        $this->weight = $weight;
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
     * @return string
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @return null|VariantPackaging
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getInnerQuantity()
    {
        return $this->innerQuantity;
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @return VariantPackagingSize[]
     */
    public function getVariantPackagingSizes()
    {
        return $this->variantPackagingSizes;
    }
}