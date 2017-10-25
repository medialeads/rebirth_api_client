<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . "/../Model/VariantExternalLink.php");

use Model\VariantExternalLink;

class VariantExternalLinkTransformer extends AbstractTransformer
{
    public static function doFromArray(array $variantExternalLinks): array
    {
        $response = array();
        foreach ($variantExternalLinks as $variantExternalLink) {
            $response[] = new VariantExternalLink($variantExternalLink['id'], $variantExternalLink['project_id'], $variantExternalLink['type'], $variantExternalLink['url']);
        }

        return $response;
    }
}