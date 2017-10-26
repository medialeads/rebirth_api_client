<?php

namespace Model;

use Helper\VariantHelper;

class Variant
{
    /** @var  int */
    private $id;

    /** @var  string|null */
    private $subPackagingInformation;

    /** @var  array */
    private $variantMarkings;

    /** @var  array */
    private $supplierProfiles;

    /** @var  string */
    private $description;

    /** @var  string|null */
    private $markingAdditionalInformation;

    /** @var  string */
    private $supplierReference;

    /** @var  string */
    private $netWeight;

    /** @var  int|null */
    private $mainVariantImageId;

    /** @var  string|null */
    private $subSubPackagingSize;

    /** @var  array */
    private $variantMinimumQuantities;

    /** @var  string */
    private $projectId;

    /** @var  array */
    private $variantPrices;

    /** @var  */
    private $stock;

    /** @var  string */
    private $grossWeight;

    /** @var  string */
    private $packagingInformation;

    /** @var  string */
    private $slug;

    /** @var  string|null */
    private $subPackagingSize;

    /** @var  array */
    private $variantImages;

    /** @var  string */
    private $packagingGrossWeight;

    /** @var  string|null */
    private $packagingSize;

    /** @var  int|null */
    private $europeanArticleNumbering;

    /** @var  array */
    private $variantSamplePrices;

    /** @var  string */
    private $size;

    /** @var  array */
    private $variantExternalLinks;

    /** @var  string */
    private $name;

    /** @var  array */
    private $variantListPrices;

    /** @var  array */
    private $attributes;

    /** @var  string|null */
    private $subSubPackagingInformation;

    /** @var  bool */
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
    public function __construct(int $id, $subPackagingInformation, array $variantMarkings, array $supplierProfiles, string $description, $markingAdditionalInformation, string $supplierReference, string $netWeight, $mainVariantImageId, $subSubPackagingSize, array $variantMinimumQuantities, string $projectId, array $variantPrices, $stock, string $grossWeight, string $packagingInformation, string $slug, $subPackagingSize, array $variantImages, $packagingGrossWeight, $packagingSize, $europeanArticleNumbering, array $variantSamplePrices, string $size, array $variantExternalLinks, string $name, array $variantListPrices, array $attributes, $subSubPackagingInformation, bool $mandatoryMarking)
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
    public function getVariantMarkings(): array
    {
        return $this->variantMarkings;
    }

    /**
     * @return array
     */
    public function getSupplierProfiles(): array
    {
        return $this->supplierProfiles;
    }

    /**
     * @return string
     */
    public function getDescription(): string
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
    public function getSupplierReference(): string
    {
        return $this->supplierReference;
    }

    /**
     * @return string
     */
    public function getNetWeight(): string
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
    public function getVariantMinimumQuantities(): array
    {
        return $this->variantMinimumQuantities;
    }

    /**
     * @return string
     */
    public function getProjectId(): string
    {
        return $this->projectId;
    }

    /**
     * @return array
     */
    public function getVariantPrices(): array
    {
        return $this->variantPrices;
    }

    /**
     * @return int
     */
    public function getId(): int
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
    public function getGrossWeight(): string
    {
        return $this->grossWeight;
    }

    /**
     * @return string
     */
    public function getPackagingInformation(): string
    {
        return $this->packagingInformation;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getSubPackagingSize(): string
    {
        return $this->subPackagingSize;
    }

    /**
     * @return array
     */
    public function getVariantImages(): array
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
    public function getVariantSamplePrices(): array
    {
        return $this->variantSamplePrices;
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * @return array
     */
    public function getVariantExternalLinks(): array
    {
        return $this->variantExternalLinks;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getVariantListPrices(): array
    {
        return $this->variantListPrices;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
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
    public function isMandatoryMarking(): bool
    {
        return $this->mandatoryMarking;
    }

    public function getCalculatedPrice()
    {
        return VariantHelper::getCalculatedPrice($this);
    }
}