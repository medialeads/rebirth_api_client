<?php

namespace ES\RebirthApiClient\Model;

use ES\RebirthCommon\VariantInterface;

class Variant implements ModelInterface, VariantInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $supplierReference;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var string|null
     */
    private $rawDescription;

    /**
     * @var bool
     */
    private $mandatoryMarking;

    /**
     * @var string|null
     */
    private $markingAdditionalInformation;

    /**
     * @var string|null
     */
    private $netWeight;

    /**
     * @var string|null
     */
    private $grossWeight;

    /**
     * @var int|null
     */
    private $stock;

    /**
     * @var string|null
     */
    private $europeanArticleNumbering;

    /**
     * @var string|null
     */
    private $slug;

    /**
     * @var VariantPackaging|null
     */
    private $variantPackaging;

    /**
     * @var VariantImage|null
     */
    private $mainVariantImage;

    /**
     * @var Attribute[]
     */
    private $attributes;

    /**
     * @var SupplierProfileInterface[]
     */
    private $supplierProfiles;

    /**
     * @var Keyword[]
     */
    private $keywords;

    /**
     * @var VariantPrice[]
     */
    private $variantPrices;

    /**
     * @var VariantImage[]
     */
    private $variantImages;

    /**
     * @var VariantMarking[]
     */
    private $variantMarkings;

    /**
     * @var VariantMinimumQuantity[]
     */
    private $variantMinimumQuantities;

    /**
     * @var VariantDeliveryTime[]
     */
    private $variantDeliveryTimes;

    /**
     * @var VariantSamplePrice[]
     */
    private $variantSamplePrices;

    /**
     * @var VariantExternalLink[]
     */
    private $variantExternalLinks;

    /**
     * @var VariantListPrice[]
     */
    private $variantListPrices;

    /**
     * @var VariantSize[]
     */
    private $variantSizes;

    /**
     * @param string $id
     * @param string $supplierReference
     * @param string|null $name
     * @param string|null $description
     * @param string|null $rawDescription
     * @param bool $mandatoryMarking
     * @param string|null $markingAdditionalInformation
     * @param string|null $netWeight
     * @param string|null $grossWeight
     * @param int|null $stock
     * @param string|null $europeanArticleNumbering
     * @param string|null $slug
     * @param VariantPackaging|null $variantPackaging
     * @param VariantImage|null $mainVariantImage
     * @param Attribute[] $attributes
     * @param SupplierProfileInterface[] $supplierProfiles
     * @param Keyword[] $keywords
     * @param VariantPrice[] $variantPrices
     * @param VariantImage[] $variantImages
     * @param VariantMarking[] $variantMarkings
     * @param VariantMinimumQuantity[] $variantMinimumQuantities
     * @param VariantDeliveryTime[] $variantDeliveryTimes
     * @param VariantSamplePrice[] $variantSamplePrices
     * @param VariantExternalLink[] $variantExternalLinks
     * @param VariantListPrice[] $variantListPrices
     * @param VariantSize[] $variantSizes
     */
    public function __construct($id, $supplierReference, $name, $description, $rawDescription, $mandatoryMarking,
        $markingAdditionalInformation, $netWeight, $grossWeight, $stock, $europeanArticleNumbering, $slug,
        VariantPackaging $variantPackaging = null, VariantImage $mainVariantImage = null, array $attributes,
        array $supplierProfiles, array $keywords, array $variantPrices, array $variantImages, array $variantMarkings,
        array $variantMinimumQuantities, array $variantDeliveryTimes, array $variantSamplePrices,
        array $variantExternalLinks, array $variantListPrices, array $variantSizes)
    {
        $this->id = $id;
        $this->supplierReference = $supplierReference;
        $this->name = $name;
        $this->description = $description;
        $this->rawDescription = $rawDescription;
        $this->mandatoryMarking = $mandatoryMarking;
        $this->markingAdditionalInformation = $markingAdditionalInformation;
        $this->netWeight = $netWeight;
        $this->grossWeight = $grossWeight;
        $this->stock = $stock;
        $this->europeanArticleNumbering = $europeanArticleNumbering;
        $this->slug = $slug;
        $this->variantPackaging = $variantPackaging;
        $this->mainVariantImage = $mainVariantImage;
        $this->attributes = $attributes;
        $this->supplierProfiles = $supplierProfiles;
        $this->keywords = $keywords;
        $this->variantPrices = $variantPrices;
        $this->variantImages = $variantImages;
        $this->variantMarkings = $variantMarkings;
        $this->variantMinimumQuantities = $variantMinimumQuantities;
        $this->variantDeliveryTimes = $variantDeliveryTimes;
        $this->variantSamplePrices = $variantSamplePrices;
        $this->variantExternalLinks = $variantExternalLinks;
        $this->variantListPrices = $variantListPrices;
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
     * @return string
     */
    public function getSupplierReference()
    {
        return $this->supplierReference;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getRawDescription()
    {
        return $this->rawDescription;
    }

    /**
     * @return bool
     */
    public function isMandatoryMarking()
    {
        return $this->mandatoryMarking;
    }

    /**
     * @return string|null
     */
    public function getMarkingAdditionalInformation()
    {
        return $this->markingAdditionalInformation;
    }

    /**
     * @return string|null
     */
    public function getNetWeight()
    {
        return $this->netWeight;
    }

    /**
     * @return string|null
     */
    public function getGrossWeight()
    {
        return $this->grossWeight;
    }

    /**
     * @return int|null
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @return string|null
     */
    public function getEuropeanArticleNumbering()
    {
        return $this->europeanArticleNumbering;
    }

    /**
     * @return string|null
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return VariantPackaging|null
     */
    public function getVariantPackaging()
    {
        return $this->variantPackaging;
    }

    /**
     * @return VariantImage|null
     */
    public function getMainVariantImage()
    {
        return $this->mainVariantImage;
    }

    /**
     * @return Attribute[]
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return SupplierProfile[]
     */
    public function getSupplierProfiles()
    {
        return $this->supplierProfiles;
    }

    /**
     * @return Keyword[]
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @return VariantPrice[]
     */
    public function getVariantPrices()
    {
        return $this->variantPrices;
    }

    /**
     * @return VariantImage[]
     */
    public function getVariantImages()
    {
        return $this->variantImages;
    }

    /**
     * @return VariantMarking[]
     */
    public function getVariantMarkings()
    {
        return $this->variantMarkings;
    }

    /**
     * @return VariantMinimumQuantity[]
     */
    public function getVariantMinimumQuantities()
    {
        return $this->variantMinimumQuantities;
    }

    /**
     * @return VariantDeliveryTime[]
     */
    public function getVariantDeliveryTimes()
    {
        return $this->variantDeliveryTimes;
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
     * @return VariantListPrice[]
     */
    public function getVariantListPrices()
    {
        return $this->variantListPrices;
    }

    /**
     * @return VariantSize[]
     */
    public function getVariantSizes()
    {
        return $this->variantSizes;
    }
}
