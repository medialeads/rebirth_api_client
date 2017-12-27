<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\VariantPackaging;
use ES\APIv2Client\Model\VariantPackagingSize;

/**
 * @author Dagan MENEZ
 */
class VariantPackagingTransformer extends AbstractTransformer
{
    /**
     * @param array $variantPackagings
     *
     * @return array
     */
    public static function doFromArray($variantPackagings, $hierarchy = null)
    {
        $response = array();
        foreach ($variantPackagings as $variantPackaging) {
            $variantPackagingSizes = VariantPackagingSizeTransformer::fromArray($variantPackaging['variant_packaging_sizes']);

            if (null === $hierarchy) {
                $hierarchy = $variantPackaging['hierarchy'];
            }

            $parent = null;
            foreach ($hierarchy as $hierarchyPackaging) {
                if ($variantPackaging['id'] === $hierarchyPackaging['id']) {
                    $parent = VariantPackagingTransformer::doFromArray($hierarchyPackaging, $hierarchy)[0];
                }
            }

            $response[] = new VariantPackaging($variantPackaging['id'], $variantPackaging['project_id'], $parent, $variantPackaging['type'], $variantPackaging['inner_quantity'], $variantPackaging['weight'], $variantPackagingSizes);
        }

        return $response;
    }
}