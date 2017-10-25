<?php

namespace Transformer;

require_once(__DIR__ . "/../Model/VariantExternalLink.php");

use Model\VariantExternalLink;

class VariantExternalLinkTransformer
{
    public function fromArray($variantExternalLink)
    {
        return new VariantExternalLink($variantExternalLink['id'], $variantExternalLink['project_id'], $variantExternalLink['type'], $variantExternalLink['url']);
    }
}