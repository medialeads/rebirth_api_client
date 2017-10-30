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
    public static function doFromArray($attributes)
    {
        $response = array();
        foreach ($attributes as $attribute) {
            $attributeGroup = AttributeGroupTransformer::fromArray($attribute['attribute_group']);
            $hierarchy[] = array();

            $response[] =  new Attribute($attribute['id'], $attribute['project_id'], $attributeGroup, $attribute['parent_id'], $hierarchy, $attribute['type'], $attribute['value'], $attribute['slug']);
        }

        return $response;
    }
}