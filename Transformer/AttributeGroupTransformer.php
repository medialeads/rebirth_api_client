<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\AttributeGroup;

/**
 * @author Dagan MENEZ
 */
class AttributeGroupTransformer extends AbstractTransformer
{
    /**
     * @param array $attributeGroups
     *
     * @return array
     */
    public static function doFromArray($attributeGroups)
    {
        $response = array();
        foreach ($attributeGroups as $attributeGroup) {
            $response[] = new AttributeGroup($attributeGroup['id'], $attributeGroup['project_id'], $attributeGroup['name'], $attributeGroup['slug']);
        }

        return $response;
    }
}