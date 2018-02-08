<?php

namespace ES\RebirthApiClient\Model;

class Product implements ModelInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $internalReference;

    /**
     * @var string
     */
    private $supplierBaseReference;

    /**
     * @var \DateTime
     */
    private $lastIndexedAt;

    /**
     * @var string|null
     */
    private $countryOfOrigin;

    /**
     * @var string|null
     */
    private $unionCustomsCode;

    /**
     * @var Supplier
     */
    private $supplier;

    /**
     * @var Brand|null
     */
    private $brand;

    /**
     * @var Variant
     */
    private $mainVariant;

    /**
     * @var Category|null
     */
    private $mainCategory;

    /**
     * @var ProductImage|null
     */
    private $mainProductImage;

    /**
     * @var Variant[]
     */
    private $variants;

    /**
     * @var Category[]
     */
    private $categories;

    /**
     * @var ProductImage[]
     */
    private $productImages;

    /**
     * @var Label[]
     */
    private $labels;

    /**
     * @param string $id
     * @param string $internalReference
     * @param string $supplierBaseReference
     * @param \DateTime $lastIndexedAt
     * @param string|null $countryOfOrigin
     * @param string|null $unionCustomsCode
     * @param Supplier $supplier
     * @param Brand|null $brand
     * @param Variant $mainVariant
     * @param Category|null $mainCategory
     * @param ProductImage|null $mainProductImage
     * @param Variant[] $variants
     * @param Category[] $categories
     * @param ProductImage[] $productImages
     * @param Label[] $labels
     */
    public function __construct($id, $internalReference, $supplierBaseReference, \DateTime $lastIndexedAt,
        $countryOfOrigin, $unionCustomsCode, Supplier $supplier, Brand $brand = null, Variant $mainVariant,
        Category $mainCategory = null, ProductImage $mainProductImage = null, array $variants, array $categories,
        array $productImages, array $labels)
    {
        $this->id = $id;
        $this->internalReference = $internalReference;
        $this->supplierBaseReference = $supplierBaseReference;
        $this->lastIndexedAt = $lastIndexedAt;
        $this->countryOfOrigin = $countryOfOrigin;
        $this->unionCustomsCode = $unionCustomsCode;
        $this->supplier = $supplier;
        $this->brand = $brand;
        $this->mainVariant = $mainVariant;
        $this->mainCategory = $mainCategory;
        $this->mainProductImage = $mainProductImage;
        $this->variants = $variants;
        $this->categories = $categories;
        $this->productImages = $productImages;
        $this->labels = $labels;
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
    public function getInternalReference()
    {
        return $this->internalReference;
    }

    /**
     * @return string
     */
    public function getSupplierBaseReference()
    {
        return $this->supplierBaseReference;
    }

    /**
     * @return \DateTime
     */
    public function getLastIndexedAt()
    {
        return $this->lastIndexedAt;
    }

    /**
     * @return string|null
     */
    public function getCountryOfOrigin()
    {
        return $this->countryOfOrigin;
    }

    /**
     * @return string|null
     */
    public function getUnionCustomsCode()
    {
        return $this->unionCustomsCode;
    }

    /**
     * @return Supplier
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

    /**
     * @return Brand|null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @return Variant
     */
    public function getMainVariant()
    {
        return $this->mainVariant;
    }

    /**
     * @return Category|null
     */
    public function getMainCategory()
    {
        return $this->mainCategory;
    }

    /**
     * @return ProductImage|null
     */
    public function getMainProductImage()
    {
        return $this->mainProductImage;
    }

    /**
     * @return Variant[]
     */
    public function getVariants()
    {
        return $this->variants;
    }

    /**
     * @return Category[]
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @return ProductImage[]
     */
    public function getProductImages()
    {
        return $this->productImages;
    }

    /**
     * @return Label[]
     */
    public function getLabels()
    {
        return $this->labels;
    }
}
