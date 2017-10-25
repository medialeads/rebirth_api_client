<?php

namespace Transformer;

require_once(__DIR__ . "/../Model/AttributeGroup.php");

use Model\AttributeGroup;

class AttributeGroupTransformer
{
    public function fromArray($attributeGroup) {
        return new AttributeGroup($attributeGroup['id'], $attributeGroup['project_id'], $attributeGroup['name'], $attributeGroup['slug']);
    }
}