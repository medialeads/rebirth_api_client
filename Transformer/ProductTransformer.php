<?php

namespace Transformer;

require_once(__DIR__ . '/AbstractTransformer.php');
require_once(__DIR__ . '/LabelTransformer.php');
require_once(__DIR__ . '/VariantTransformer.php');
require_once(__DIR__ . '/ProductImageTransformer.php');
require_once(__DIR__ . '/SupplierTransformer.php');
require_once(__DIR__ . '/CategoryTransformer.php');
require_once(__DIR__ . '/BrandTransformer.php');
require_once(__DIR__ . '/../Model/Product.php');
require_once(__DIR__ . '/../Model/SupplierProfile.php');

use Model\Product;
use Model\SupplierProfile;

class ProductTransformer extends AbstractTransformer
{
    public static function doFromArray(array $products): array
    {
        $response = array();
        foreach ($products as $product) {
            $lastIndexedAt = new \DateTime($product['last_indexed_at']);
            $labels = LabelTransformer::fromArray($product['labels']);
            $variants = VariantTransformer::fromArray($product['variants']);
            $productImages = ProductImageTransformer::fromArray($product['product_images']);
            $supplier = SupplierTransformer::fromArray($product['supplier']);
            $categories = CategoryTransformer::fromArray($product['categories']);
            $brand = BrandTransformer::fromArray($product['brand']);

            var_dump(SupplierProfile::getInstances()); die();

            $response[] = new Product($product['id'], $lastIndexedAt, $product['project_key'], $product['country_of_origin'], $product['main_product_image_id'], $variants, $product['union_customs_code'], $product['main_category_id'], $labels, $productImages, $product['visible_on'], $product['project_id'], $product['main_variant_id'], $supplier, $categories, $product['supplier_base_reference'], $product['internal_reference'], $brand);
        }

        return $response;

    }
}