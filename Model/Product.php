<?php

namespace Model;

class Product
{
    /** @var  int */
    private $id;

    /** @var \DateTimeInterface */
    private $lastIndexedAt;

    /** @var string */
    private $projectKey;

    /** @var string */
    private $countryOfOrigin;

    /** @var int */
    private $mainProductImageId;

    /** @var array */
    private $variants;

    /** @var  string */
    private $unionCustomsCode;

    /** @var  int */
    private $mainCategoryId;

    /** @var  array */
    private $labels;

    /** @var  array */
    private $productImages;

    /** @var  array */
    private $visibleOn;

    /** @var  int */
    private $projectId;

    /** @var  int */
    private $mainVariantId;

    /** @var  Supplier */
    private $supplier;

    /** @var  array */
    private $categories;

    /** @var  string */
    private $supplierBaseReference;

    /** @var  string */
    private $internalReference;

    /** @var  Brand */
    private $brand;

    /**
     * @param int $id
     * @param \DateTimeInterface $lastIndexedAt
     * @param string $projectKey
     * @param string $countryOfOrigin
     * @param int $mainProductImageId
     * @param array $variants
     * @param string $unionCustomsCode
     * @param int $mainCategoryId
     * @param array $labels
     * @param array $productImages
     * @param array $visibleOn
     * @param string $projectId
     * @param int $mainVariantId
     * @param Supplier $supplier
     * @param array $categories
     * @param string $supplierBaseReference
     * @param string $internalReference
     * @param Brand $brand
     */
    public function __construct(int $id, \DateTimeInterface $lastIndexedAt, string $projectKey, string $countryOfOrigin, int $mainProductImageId, array $variants, string $unionCustomsCode, int $mainCategoryId, array $labels, array $productImages, array $visibleOn, string $projectId, int $mainVariantId, Supplier $supplier, array $categories, string $supplierBaseReference, string $internalReference, Brand $brand)
    {
        foreach ($categories as $category) {
            if (!$category instanceof Category) {
               throw new \InvalidArgumentException();
            }
        }

        if (!$supplier instanceof Supplier) {
            throw new \InvalidArgumentException();
        }

        if (!$brand instanceof Brand) {
            throw new \InvalidArgumentException();
        }

        foreach ($labels as $label) {
            if (!$label instanceof Label) {
                throw new \InvalidArgumentException();
            }
        }

        foreach ($variants as $variant) {
            if (!$variant instanceof Variant) {
                throw new \InvalidArgumentException();
            }
        }

        $this->id = $id;
        $this->lastIndexedAt = $lastIndexedAt;
        $this->projectKey = $projectKey;
        $this->countryOfOrigin = $countryOfOrigin;
        $this->mainProductImageId = $mainProductImageId;
        $this->variants = $variants;
        $this->unionCustomsCode = $unionCustomsCode;
        $this->mainCategoryId = $mainCategoryId;
        $this->labels = $labels;
        $this->productImages = $productImages;
        $this->visibleOn = $visibleOn;
        $this->projectId = $projectId;
        $this->mainVariantId = $mainVariantId;
        $this->supplier = $supplier;
        $this->categories = $categories;
        $this->supplierBaseReference = $supplierBaseReference;
        $this->internalReference = $internalReference;
        $this->brand = $brand;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getLastIndexedAt(): \DateTimeInterface
    {
        return $this->lastIndexedAt;
    }

    /**
     * @return string
     */
    public function getProjectKey(): string
    {
        return $this->projectKey;
    }

    /**
     * @return string
     */
    public function getCountryOfOrigin(): string
    {
        return $this->countryOfOrigin;
    }

    /**
     * @return int
     */
    public function getMainProductImageId(): int
    {
        return $this->mainProductImageId;
    }

    /**
     * @return array
     */
    public function getVariants(): array
    {
        return $this->variants;
    }

    /**
     * @return mixed
     */
    public function getUnionCustomsCode(): mixed
    {
        return $this->unionCustomsCode;
    }

    /**
     * @return int
     */
    public function getMainCategoryId(): int
    {
        return $this->mainCategoryId;

    }

    /**
     * @return array
     */
    public function getLabels(): array
    {
        return $this->labels;
    }

    /**
     * @return array
     */
    public function getProductImages(): array
    {
        return $this->productImages;
    }

    /**
     * @return array
     */
    public function getVisibleOn(): array
    {
        return $this->visibleOn;
    }

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * @return int
     */
    public function getMainVariantId(): int
    {
        return $this->mainVariantId;
    }

    /**
     * @return Supplier
     */
    public function getSupplier(): Supplier
    {
        return $this->supplier;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @return string
     */
    public function getSupplierBaseReference(): string
    {
        return $this->supplierBaseReference;
    }

    /**
     * @return string
     */
    public function getInternalReference(): string
    {
        return $this->internalReference;
    }

    /**
     * @return mixed
     */
    public function getBrand(): mixed
    {
        return $this->brand;
    }
}