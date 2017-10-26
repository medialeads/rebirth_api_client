<?php

namespace ES\APIv2Client\Model;

class Product
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTimeInterface
     */
    private $lastIndexedAt;

    /**
     * @var string
     */
    private $projectKey;

    /**
     * @var null|string
     */
    private $countryOfOrigin;

    /**
     * @var int
     */
    private $mainProductImageId;

    /**
     * @var array
     */
    private $variants;

    /**
     * @var null|string
     */
    private $unionCustomsCode;

    /**
     * @var int
     */
    private $mainCategoryId;

    /**
     * @var array
     */
    private $labels;

    /**
     * @var array
     */
    private $productImages;

    /**
     * @var array
     */
    private $visibleOn;

    /**
     * @var string
     */
    private $projectId;

    /**
     * @var int
     */
    private $mainVariantId;

    /**
     * @var Supplier
     */
    private $supplier;

    /**
     * @var array
     */
    private $categories;

    /**
     * @var string
     */
    private $supplierBaseReference;

    /**
     * @var string
     */
    private $internalReference;

    /**
     * @var Brand
     */
    private $brand;

    /**
     * @param int $id
     * @param \DateTimeInterface $lastIndexedAt
     * @param string $projectKey
     * @param string|null $countryOfOrigin
     * @param int $mainProductImageId
     * @param array $variants
     * @param string|null $unionCustomsCode
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
    public function __construct($id, $lastIndexedAt, $projectKey, $countryOfOrigin, $mainProductImageId, $variants, $unionCustomsCode, $mainCategoryId, $labels, $productImages, $visibleOn, $projectId, $mainVariantId, $supplier, $categories, $supplierBaseReference, $internalReference, $brand)
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getLastIndexedAt()
    {
        return $this->lastIndexedAt;
    }

    /**
     * @return string
     */
    public function getProjectKey()
    {
        return $this->projectKey;
    }

    /**
     * @return string|null
     */
    public function getCountryOfOrigin()
    {
        return $this->countryOfOrigin;
    }

    /**
     * @return int
     */
    public function getMainProductImageId()
    {
        return $this->mainProductImageId;
    }

    /**
     * @return array
     */
    public function getVariants()
    {
        return $this->variants;
    }

    /**
     * @return string|null
     */
    public function getUnionCustomsCode()
    {
        return $this->unionCustomsCode;
    }

    /**
     * @return int
     */
    public function getMainCategoryId()
    {
        return $this->mainCategoryId;

    }

    /**
     * @return array
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * @return array
     */
    public function getProductImages()
    {
        return $this->productImages;
    }

    /**
     * @return array
     */
    public function getVisibleOn()
    {
        return $this->visibleOn;
    }

    /**
     * @return int
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @return int
     */
    public function getMainVariantId()
    {
        return $this->mainVariantId;
    }

    /**
     * @return Supplier
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @return string
     */
    public function getSupplierBaseReference()
    {
        return $this->supplierBaseReference;
    }

    /**
     * @return string
     */
    public function getInternalReference()
    {
        return $this->internalReference;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }
}