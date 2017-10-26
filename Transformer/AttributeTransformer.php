<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\Attribute;

class AttributeTransformer extends AbstractTransformer
{
    /**
     * @param array $attributes
     *
     * @return array
     */
    public static function doFromArray(array $attributes): array
    {
        $response = array();
        foreach ($attributes as $attribute) {
            $attributeGroup = AttributeGroupTransformer::fromArray($attribute['attribute_group']);
            $hierarchy[] = array();

            $response[] =  new Attribute($attribute['project_id'], $attributeGroup, $attribute['parent_id'], $hierarchy, $attribute['id'], $attribute['type'], $attribute['value'], $attribute['slug']);
        }

        return $response;
    }
}