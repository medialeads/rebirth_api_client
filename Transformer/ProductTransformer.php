<?php

namespace Transformer;

require_once('VariantTransformer.php');
require_once('LabelTransformer.php');
require_once(__DIR__ . '/../Model/Product.php');

use Model\Product;

class ProductTransformer
{
    public function fromArray(array $data)
    {
        // check si pas d'erreur
        // check si c'est un tableau
        // check 1ere clé : si numérique / si pas numérique
        $simple = false;

        if (!self::isNumericArray($data)) {
            $data = array($data);
        }

        foreach ($data as $product) {
            $labels = array();
            foreach ($product['labels'] as $label) {
                $labels[] = LabelTransformer::fromArray($label);
            }

            $variants = array();
            foreach ($product['variants'] as $variant) {
                $variants[] = VariantTransformer::fromArray($variant);
            }
            $products[] = new Product($product['id'], date_create($product['last_indexed_at']), $product['country_of_origin'], $product['main_product_image_id'],   $labels, $variants);
            var_dump($products); die();
        }
        die();


        if ($simple) {
            return reset($data);
        }

        return $data;
    }

    /**
     * @param array $array
     * @return bool
     */
    private function isNumericArray(array $array)
    {
        foreach (array_keys($array) as $a) {
            if (!is_int($a)) {
                return false;
            }
        }

        return true;
    }
}