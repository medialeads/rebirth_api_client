<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\Product;

class ProductTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    public function getId(array $data)
    {
        return sprintf('Product_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return Product
     */
    public function transform(array $data)
    {
        $mainVariant = null;
        $variants = VariantTransformer::create()->transformMultiple($data['variants']);
        if (!empty($variants)) {
            $mainVariant = $variants[$data['main_variant_id']];
        }

        $mainCategory = null;
        $categories = CategoryTransformer::create()->transformMultiple($data['categories']);
        if (!empty($categories)) {
            $mainCategory = $categories[$data['main_category_id']];
        }

        $mainProductImage = null;
        $productImages = ProductImageTransformer::create()->transformMultiple($data['product_images']);
        if (!empty($productImages)) {
            $mainProductImage = $productImages[$data['main_product_image']];
        }

        return new Product($data['id'], $data['internal_reference'], $data['supplier_base_reference'],
            new \DateTime($data['last_indexed_at']), $data['country_of_origin'], $data['union_customs_code'],
            SupplierTransformer::create()->transformOne($data['supplier']),
            BrandTransformer::create()->transformOne($data['brand']), $mainVariant, $mainCategory, $mainProductImage,
            $variants, $categories, $productImages, LabelTransformer::create()->transformMultiple($data['labels']));
    }

}
