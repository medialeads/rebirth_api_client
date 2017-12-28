<?php

namespace ES\APIv2Client\Model;

use ES\APIv2Client\Helper\VariantHelper;

/**
 * @author Dagan MENEZ
 */
class Variant
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var VariantMarking[]
     */
    private $variantMarkings;

    /**
     * @var SupplierProfile[]
     */
    private $supplierProfiles;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $rawDescription;

    /**
     * @var null|string
     */
    private $markingAdditionalInformation;

    /**
     * @var string
     */
    private $supplierReference;

    /**
     * @var float
     */
    private $netWeight;

    /**
     * @var int|null
     */
    private $mainVariantImageId;

    /**
     * @var VariantMinimumQuantity[]
     */
    private $variantMinimumQuantities;

    /**
     * @var string
     */
    private $projectId;

    /**
     * @var VariantPrice[]
     */
    private $variantPrices;

    /**
     * @var string
     */
    private $stock;

    /**
     * @var float
     */
    private $grossWeight;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var VariantImage[]
     */
    private $variantImages;

    /**
     * @var int|null
     */
    private $europeanArticleNumbering;

    /**
     * @var VariantSamplePrice[]
     */
    private $variantSamplePrices;

    /**
     * @var VariantExternalLink[]
     */
    private $variantExternalLinks;

    /**
     * @var string
     */
    private $name;

    /**
     * @var VariantListPrice[]
     */
    private $variantListPrices;

    /**
     * @var Attribute[]
     */
    private $attributes;

    /**
     * @var bool
     */
    private $mandatoryMarking;

    /**
     * @var Keyword[]
     */
    private $keywords;

    /**
     * @var VariantPackaging
     */
    private $variantPackaging;

    /**
     * @var VariantSize[]
     */
    private $variantSizes;

    /**
     * @param string $id
     * @param VariantMarking[] $variantMarkings
     * @param SupplierProfile[] $supplierProfiles
     * @param string $description
     * @param string $rawDescription
     * @param null|string $markingAdditionalInformation
     * @param string $supplierReference
     * @param float $netWeight
     * @param int|null $mainVariantImageId
     * @param VariantMinimumQuantity[] $variantMinimumQuantities
     * @param string $projectId
     * @param VariantPrice[] $variantPrices
     * @param string $stock
     * @param float $grossWeight
     * @param string $slug
     * @param VariantImage[] $variantImages
     * @param int|null $europeanArticleNumbering
     * @param VariantSamplePrice[] $variantSamplePrices
     * @param VariantExternalLink[] $variantExternalLinks
     * @param string $name
     * @param VariantListPrice[] $variantListPrices
     * @param Attribute[] $attributes
     * @param bool $mandatoryMarking
     * @param Keyword[] $keywords
     * @param VariantPackaging $variantPackaging
     * @param VariantSize[] $variantSizes
     */
    public function __construct($id, $variantMarkings, $supplierProfiles, $description, $rawDescription, $markingAdditionalInformation, $supplierReference, $netWeight, $mainVariantImageId, $variantMinimumQuantities, $projectId, $variantPrices, $stock, $grossWeight, $slug, $variantImages, $europeanArticleNumbering, $variantSamplePrices, $variantExternalLinks, $name, $variantListPrices, $attributes, $mandatoryMarking, $keywords, $variantPackaging, $variantSizes)
    {
        foreach ($variantMarkings as $variantMarking) {
            if (!$variantMarking instanceof VariantMarking) {
                throw new \InvalidArgumentException();
            }
        }

        foreach ($supplierProfiles as $supplierProfile) {
            if (!$supplierProfile instanceof SupplierProfileInterface) {
                throw new \InvalidArgumentException();
            }
        }

        foreach ($variantImages as $variantImage) {
            if (!$variantImage instanceof VariantImage) {
                throw new \InvalidArgumentException();
            }
        }

        foreach ($variantExternalLinks as $variantExternalLink) {
            if (!$variantExternalLink instanceof VariantExternalLink) {
                throw new \InvalidArgumentException();
            }
        }

        foreach ($attributes as $attribute) {
            if (!$attribute instanceof Attribute) {
                throw new \InvalidArgumentException();
            }
        }

        foreach ($keywords as $keyword) {
            if (!$keyword instanceof Keyword) {
                throw new \InvalidArgumentException();
            }
        }

        if (!$variantPackaging instanceof VariantPackaging) {
            throw new \InvalidArgumentException();
        }

        foreach ($variantSizes as $variantSize) {
            if (!$variantSize instanceof VariantSize) {
                throw new \InvalidArgumentException();
            }
        }

        $this->variantMarkings = $variantMarkings;
        $this->supplierProfiles = $supplierProfiles;
        $this->description = $description;
        $this->rawDescription = $rawDescription;
        $this->markingAdditionalInformation = $markingAdditionalInformation;
        $this->supplierReference = $supplierReference;
        $this->netWeight = $netWeight;
        $this->mainVariantImageId = $mainVariantImageId;
        $this->variantMinimumQuantities = $variantMinimumQuantities;
        $this->projectId = $projectId;
        $this->variantPrices = $variantPrices;
        $this->id = $id;
        $this->stock = $stock;
        $this->grossWeight = $grossWeight;
        $this->slug = $slug;
        $this->variantImages = $variantImages;
        $this->europeanArticleNumbering = $europeanArticleNumbering;
        $this->variantSamplePrices = $variantSamplePrices;
        $this->variantExternalLinks = $variantExternalLinks;
        $this->name = $name;
        $this->variantListPrices;
        $this->attributes = $attributes;
        $this->mandatoryMarking = $mandatoryMarking;
        $this->keywords = $keywords;
        $this->variantPackaging = $variantPackaging;
        $this->variantSizes = $variantSizes;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return VariantMarking[]
     */
    public function getVariantMarkings()
    {
        return $this->variantMarkings;
    }

    /**
     * @return SupplierProfile[]
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
     * @return string
     */
    public function getRawDescription()
    {
        return $this->rawDescription;
    }

    /**
     * @return null|string
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
     * @return float
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
     * @return VariantMinimumQuantity[]
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
     * @return VariantPrice[]
     */
    public function getVariantPrices()
    {
        return $this->variantPrices;
    }

    /**
     * @return string
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @return float
     */
    public function getGrossWeight()
    {
        return $this->grossWeight;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return VariantImage[]
     */
    public function getVariantImages()
    {
        return $this->variantImages;
    }

    /**
     * @return int|null
     */
    public function getEuropeanArticleNumbering()
    {
        return $this->europeanArticleNumbering;
    }

    /**
     * @return VariantSamplePrice[]
     */
    public function getVariantSamplePrices()
    {
        return $this->variantSamplePrices;
    }

    /**
     * @return VariantExternalLink[]
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
     * @return VariantListPrice[]
     */
    public function getVariantListPrices()
    {
        return $this->variantListPrices;
    }

    /**
     * @return Attribute[]
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return bool
     */
    public function isMandatoryMarking()
    {
        return $this->mandatoryMarking;
    }

    /**
     * @return Keyword[]
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @return VariantPackaging
     */
    public function getVariantPackaging()
    {
        return $this->variantPackaging;
    }

    /**
     * @return VariantSize[]
     */
    public function getVariantSizes()
    {
        return $this->variantSizes;
    }

    public function getCalculatedPrice(SupplierProfile $supplierProfile, $quantity, array $variantMarkingModels = array())
    {
        return VariantHelper::getCalculatedPrice($this, $supplierProfile, $quantity, $variantMarkingModels);
    }
}