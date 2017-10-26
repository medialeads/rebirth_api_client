<?php

namespace ES\APIv2Client\Model;

use Helper\VariantHelper;

class Variant
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var null|string
     */
    private $subPackagingInformation;

    /**
     * @var array
     */
    private $variantMarkings;

    /**
     * @var array
     */
    private $supplierProfiles;

    /**
     * @var string
     */
    private $description;

    /**
     * @var null|string
     */
    private $markingAdditionalInformation;

    /**
     * @var string
     */
    private $supplierReference;

    /**
     * @var string
     */
    private $netWeight;

    /**
     * @var int|null
     */
    private $mainVariantImageId;

    /**
     * @var null|string
     */
    private $subSubPackagingSize;

    /**
     * @var array
     */
    private $variantMinimumQuantities;

    /**
     * @var string
     */
    private $projectId;

    /**
     * @var array
     */
    private $variantPrices;

    /**
     * @var
     */
    private $stock;

    /**
     * @var string
     */
    private $grossWeight;

    /**
     * @var string
     */
    private $packagingInformation;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var null|string
     */
    private $subPackagingSize;

    /**
     * @var array
     */
    private $variantImages;

    /**
     * @var null|string
     */
    private $packagingGrossWeight;

    /**
     * @var null|string
     */
    private $packagingSize;

    /**
     * @var int|null
     */
    private $europeanArticleNumbering;

    /**
     * @var array
     */
    private $variantSamplePrices;

    /**
     * @var string
     */
    private $size;

    /**
     * @var array
     */
    private $variantExternalLinks;

    /**
     * @var string
     */
    private $name;

    /**
     * @var
     */
    private $variantListPrices;

    /**
     * @var array
     */
    private $attributes;

    /**
     * @var null|string
     */
    private $subSubPackagingInformation;

    /**
     * @var bool
     */
    private $mandatoryMarking;

    /**
     * @param int $id
     * @param string|null $subPackagingInformation
     * @param array $variantMarkings
     * @param array $supplierProfiles
     * @param string $description
     * @param string|null $markingAdditionalInformation
     * @param string $supplierReference
     * @param string $netWeight
     * @param int|null $mainVariantImageId
     * @param string|null $subSubPackagingSize
     * @param array $variantMinimumQuantities
     * @param string $projectId
     * @param array $variantPrices
     * @param $stock
     * @param string $grossWeight
     * @param string $packagingInformation
     * @param string $slug
     * @param string|null $subPackagingSize
     * @param array $variantImages
     * @param string|null $packagingGrossWeight
     * @param string|null $packagingSize
     * @param int|null $europeanArticleNumbering
     * @param array $variantSamplePrices
     * @param string $size
     * @param array $variantExternalLinks
     * @param string $name
     * @param array $variantListPrices
     * @param array $attributes
     * @param string|null $subSubPackagingInformation
     * @param bool $mandatoryMarking
     */
    public function __construct($id, $subPackagingInformation, $variantMarkings, $supplierProfiles, $description, $markingAdditionalInformation, $supplierReference, $netWeight, $mainVariantImageId, $subSubPackagingSize, $variantMinimumQuantities, $projectId, $variantPrices, $stock, $grossWeight, $packagingInformation, $slug, $subPackagingSize, $variantImages, $packagingGrossWeight, $packagingSize, $europeanArticleNumbering, $variantSamplePrices, $size, $variantExternalLinks, $name, $variantListPrices, $attributes, $subSubPackagingInformation, $mandatoryMarking)
    {
        foreach ($variantMarkings as $variantMarking) {
            if (!$variantMarking instanceof VariantMarking) {
                throw new \InvalidArgumentException();
            }
        }

        foreach ($supplierProfiles as $supplierProfile) {
            if (!$supplierProfile instanceof SupplierProfile) {
                throw new \InvalidArgumentException();
            }
        }

        foreach ($variantImages as $variantImage) {
            if (!$variantImage instanceof VariantImage) {
                throw new \InvalidArgumentException();
            }
        }

        foreach ($attributes as $attribute) {
            if (!$attribute instanceof Attribute) {
                throw new \InvalidArgumentException();
            }
        }

        foreach ($variantExternalLinks as $variantExternalLink) {
            if (!$variantExternalLink instanceof VariantExternalLink) {
                throw new \InvalidArgumentException();
            }
        }

        $this->subPackagingInformation = $subPackagingInformation;
        $this->variantMarkings = $variantMarkings;
        $this->supplierProfiles = $supplierProfiles;
        $this->description = $description;
        $this->markingAdditionalInformation = $markingAdditionalInformation;
        $this->supplierReference = $supplierReference;
        $this->netWeight = $netWeight;
        $this->mainVariantImageId = $mainVariantImageId;
        $this->subSubPackagingSize = $subSubPackagingSize;
        $this->variantMinimumQuantities = $variantMinimumQuantities;
        $this->projectId = $projectId;
        $this->variantPrices = $variantPrices;
        $this->id = $id;
        $this->stock = $stock;
        $this->grossWeight = $grossWeight;
        $this->packagingInformation = $packagingInformation;
        $this->slug = $slug;
        $this->subPackagingSize = $subPackagingSize;
        $this->variantImages = $variantImages;
        $this->packagingGrossWeight = $packagingGrossWeight;
        $this->packagingSize = $packagingSize;
        $this->europeanArticleNumbering = $europeanArticleNumbering;
        $this->variantSamplePrices = $variantSamplePrices;
        $this->size = $size;
        $this->variantExternalLinks = $variantExternalLinks;
        $this->name = $name;
        $this->variantListPrices;
        $this->attributes = $attributes;
        $this->subSubPackagingInformation = $subSubPackagingInformation;
        $this->mandatoryMarking = $mandatoryMarking;
    }

    /**
     * @return string|null
     */
    public function getSubPackagingInformation()
    {
        return $this->subPackagingInformation;
    }

    /**
     * @return array
     */
    public function getVariantMarkings()
    {
        return $this->variantMarkings;
    }

    /**
     * @return array
     */
    public function getSupplierProfiles()
    {
        return $this->supplierProfiles;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getMarkingAdditionalInformation()
    {
        return $this->markingAdditionalInformation;
    }

    /**
     * @return string
     */
    public function getSupplierReference()
    {
        return $this->supplierReference;
    }

    /**
     * @return string
     */
    public function getNetWeight()
    {
        return $this->netWeight;
    }

    /**
     * @return int|null
     */
    public function getMainVariantImageId()
    {
        return $this->mainVariantImageId;
    }

    /**
     * @return string|null
     */
    public function getSubSubPackagingSize()
    {
        return $this->subSubPackagingSize;
    }

    /**
     * @return array
     */
    public function getVariantMinimumQuantities()
    {
        return $this->variantMinimumQuantities;
    }

    /**
     * @return string
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @return array
     */
    public function getVariantPrices()
    {
        return $this->variantPrices;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @return string
     */
    public function getGrossWeight()
    {
        return $this->grossWeight;
    }

    /**
     * @return string
     */
    public function getPackagingInformation()
    {
        return $this->packagingInformation;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getSubPackagingSize()
    {
        return $this->subPackagingSize;
    }

    /**
     * @return array
     */
    public function getVariantImages()
    {
        return $this->variantImages;
    }

    /**
     * @return string|null
     */
    public function getPackagingGrossWeight()
    {
        return $this->packagingGrossWeight;
    }

    /**
     * @return string|null
     */
    public function getPackagingSize()
    {
        return $this->packagingSize;
    }

    /**
     * @return int|null
     */
    public function getEuropeanArticleNumbering()
    {
        return $this->europeanArticleNumbering;
    }

    /**
     * @return array
     */
    public function getVariantSamplePrices()
    {
        return $this->variantSamplePrices;
    }

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return array
     */
    public function getVariantExternalLinks()
    {
        return $this->variantExternalLinks;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getVariantListPrices()
    {
        return $this->variantListPrices;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return string|null
     */
    public function getSubSubPackagingInformation()
    {
        return $this->subSubPackagingInformation;
    }

    /**
     * @return bool
     */
    public function isMandatoryMarking()
    {
        return $this->mandatoryMarking;
    }

    public function getCalculatedPrice()
    {
        return VariantHelper::getCalculatedPrice($this);
    }
}