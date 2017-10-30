<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\VariantExternalLink;

class VariantExternalLinkTransformer extends AbstractTransformer
{
    /**
     * @param array $variantExternalLinks
     *
     * @return array
     */
    public static function doFromArray($variantExternalLinks)
    {
        $response = array();
        foreach ($variantExternalLinks as $variantExternalLink) {
            $response[] = new VariantExternalLink($variantExternalLink['id'], $variantExternalLink['project_id'], $variantExternalLink['type'], $variantExternalLink['url']);
        }

        return $response;
    }
}