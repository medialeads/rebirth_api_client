<?php

namespace Model;

class Variant
{
    /** @var  int */
    private $id;

    /** @var  string */
    private $subPackagingInformation;

    /** @var  array */
    private $variantMarkings;

    /** @var  array */
    private $supplierProfiles;

    /** @var  string */
    private $description;

    /** @var  string */
    private $markingAdditionalInformation;

    /** @var  string */
    private $supplierReference;

    /** @var  string */
    private $netWeight;

    /** @var  int */
    private $mainVariantImageId;

    /** @var  string */
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

    /** @var  string */
    private $subPackagingSize;

    /** @var  array */
    private $variantImages;

    /** @var  string */
    private $packagingGrossWeight;

    /** @var  string */
    private $packagingSize;

    /** @var  int */
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

    /** @var  string */
    private $subSubPackagingInformation;

    /** @var  bool */
    private $mandatoryMarking;

    /**
     * @param int $id
     * @param string $subPackagingInformation
     * @param array $variantMarkings
     * @param array $supplierProfiles
     * @param string $description
     * @param string $markingAdditionalInformation
     * @param string $supplierReference
     * @param string $netWeight
     * @param int $mainVariantImageId
     * @param string $subSubPackagingSize
     * @param array $variantMinimumQuantities
     * @param string $projectId
     * @param array $variantPrices
     * @param $stock
     * @param string $grossWeight
     * @param string $packagingInformation
     * @param string $slug
     * @param string $subPackagingSize
     * @param array $variantImages
     * @param string $packagingGrossWeight
     * @param string $packagingSize
     * @param int $europeanArticleNumbering
     * @param array $variantSamplePrices
     * @param string $size
     * @param array $variantExternalLinks
     * @param string $name
     * @param array $variantListPrices
     * @param array $attributes
     * @param string $subSubPackagingInformation
     * @param bool $mandatoryMarking
     */
    public function __construct(int $id, string $subPackagingInformation, array $variantMarkings, array $supplierProfiles, string $description, string $markingAdditionalInformation, string $supplierReference, string $netWeight, int $mainVariantImageId, string $subSubPackagingSize, array $variantMinimumQuantities, string $projectId, array $variantPrices, $stock, string $grossWeight, string $packagingInformation, string $slug, string $subPackagingSize, array $variantImages, string $packagingGrossWeight, string $packagingSize, int $europeanArticleNumbering, array $variantSamplePrices, string $size, array $variantExternalLinks, string $name, array $variantListPrices, array $attributes, string $subSubPackagingInformation, bool $mandatoryMarking)
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
     * @return string
     */
    public function getSubPackagingInformation(): string
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
     * @return string
     */
    public function getMarkingAdditionalInformation(): string
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
     * @return int
     */
    public function getMainVariantImageId(): int
    {
        return $this->mainVariantImageId;
    }

    /**
     * @return string
     */
    public function getSubSubPackagingSize(): string
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
     * @return string
     */
    public function getPackagingGrossWeight(): string
    {
        return $this->packagingGrossWeight;
    }

    /**
     * @return string
     */
    public function getPackagingSize(): string
    {
        return $this->packagingSize;
    }

    /**
     * @return int
     */
    public function getEuropeanArticleNumbering(): int
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
     * @return string
     */
    public function getSubSubPackagingInformation(): string
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
}