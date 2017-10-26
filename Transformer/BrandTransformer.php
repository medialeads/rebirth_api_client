<?php

namespace Transformer;

use Model\Brand;

require_once(__DIR__ . '/AbstractTransformer.php');
require_once(__DIR__ . '/../Model/Brand.php');


class BrandTransformer extends AbstractTransformer
{
    public static function doFromArray(array $brands): array
    {
        $response = array();
        foreach ($brands as $brand) {
            $response[] = new Brand($brand['id'], $brand['project_id'], $brand['name'], $brand['suffix'], $brand['slug']);
        }

        return $response;
    }
}