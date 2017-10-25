<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . "/../Model/Attribute.php");
require_once(__DIR__ . "/AttributeGroupTransformer.php");

use Model\Attribute;

class AttributeTransformer extends AbstractTransformer
{
    public static function doFromArray(array $attributes): array
    {
        $response = array();
        foreach ($attributes as $attribute) {
            $attributeGroup = AttributeGroupTransformer::fromArray($attribute['attribute_group']);
            $hierarchy[] = HierarchyTransformer::fromArray($attribute['hierarchy']);

            $response[] =  new Attribute($attribute['project_id'], $attributeGroup, $attribute['parent_id'], $hierarchy, $attribute['id'], $attribute['type'], $attribute['value'], $attribute['slug']);
        }

        return $response;
    }
}