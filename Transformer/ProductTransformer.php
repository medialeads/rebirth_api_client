<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\Product;

class ProductTransformer extends AbstractTransformer
{
    /**
     * @param array $products
     *
     * @return array
     */
    public static function doFromArray($products)
    {
        $response = array();
        foreach ($products as $product) {
            $supplier = SupplierTransformer::fromArray($product['supplier']);
            $lastIndexedAt = new \DateTime($product['last_indexed_at']);
            $labels = LabelTransformer::fromArray($product['labels']);
            $variants = VariantTransformer::fromArray($product['variants']);
            $productImages = ProductImageTransformer::fromArray($product['product_images']);
            $categories = CategoryTransformer::fromArray($product['categories']);
            $brand = BrandTransformer::fromArray($product['brand']);

            $response[] = new Product($product['id'], $lastIndexedAt, $product['project_key'], $product['country_of_origin'], $product['main_product_image_id'], $variants, $product['union_customs_code'], $product['main_category_id'], $labels, $productImages, $product['visible_on'], $product['project_id'], $product['main_variant_id'], $supplier, $categories, $product['supplier_base_reference'], $product['internal_reference'], $brand);
        }

        return $response;
    }
}