<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\Brand;

/**
 * @author Dagan MENEZ
 */
class BrandTransformer extends AbstractTransformer
{
    /**
     * @param array $brands
     *
     * @return array
     */
    public static function doFromArray($brands)
    {
        $response = array();
        foreach ($brands as $brand) {
            $response[] = new Brand($brand['id'], $brand['project_id'], $brand['name'], $brand['suffix'], $brand['slug']);
        }

        return $response;
    }
}