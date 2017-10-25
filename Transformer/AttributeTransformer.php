<?php

namespace Transformer;

require_once(__DIR__ . "/../Model/Attribute.php");
require_once(__DIR__ . "/AttributeGroupTransformer.php");

use Model\Attribute;

class AttributeTransformer
{
    public function fromArray($attribute)
    {
        $attributeGroup = null;
        if (array_key_exists('attribute_group', $attribute)) {
            $attributeGroup = AttributeGroupTransformer::fromArray($attribute['attribute_group']);
        }

        $hierarchy = array();
        if (array_key_exists('hierarchy', $attribute)) {
            foreach ($attribute['hierarchy'] as $row)
            $hierarchy[] = HierarchyTransformer::fromArray($row);
        }

        return new Attribute($attribute['project_id'], $attributeGroup, $attribute['parent_id'], $hierarchy, $attribute['id'], $attribute['type'], $attribute['value'], $attribute['slug']);
    }
}