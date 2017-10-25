<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . "/../Model/AttributeGroup.php");

use Model\AttributeGroup;

class AttributeGroupTransformer extends AbstractTransformer
{
    public static function doFromArray(array $attributeGroups): array
    {
        $response = array();
        foreach ($attributeGroups as $attributeGroup) {
            $response[] = new AttributeGroup($attributeGroup['id'], $attributeGroup['project_id'], $attributeGroup['name'], $attributeGroup['slug']);
        }

        return $response;
    }
}