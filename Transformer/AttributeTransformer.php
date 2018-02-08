<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\Attribute;
use ES\RebirthApiClient\Model\AttributeGroup;
use Symfony\Component\VarDumper\VarDumper;

class AttributeTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('Attribute_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return Attribute
     */
    protected function transform(array $data)
    {
        $attributeGroup = AttributeGroupTransformer::create()->transformOne(array_merge($data['attribute_group'], array(
            'type' => $data['type']
        )));

        $parent = null;
        $parentId = $data['parent_id'];
        if (null !== $parentId) {
            $hierarchyIndexedById = array_combine(array_map(function ($row) {
                return $row['id'];
            }, $data['hierarchy']), $data['hierarchy']);
            $parentsDataStack = array();
            while (null !== $parentId) {
                $parentData = array_merge($hierarchyIndexedById[$parentId], array(
                    'type' => $data['type']
                ));
                $parentsDataStack[] = $parentData;
                $parentId = $parentData['parent_id'];
            }

            $parentData = array_pop($parentsDataStack);
            $parent = $this->createAttribute($parentData, $attributeGroup, null);

            $parentsCount = count($parentsDataStack);
            for ($i = $parentsCount - 1; $i >= 0; $i--) {
                $parentData = $parentsDataStack[$i];
                $parent = $this->createAttribute($parentData, $attributeGroup, $parent);
            }
        }

        return $this->createAttribute($data, $attributeGroup, $parent);
    }

    /**
     * @param array $data
     * @param AttributeGroup $attributeGroup
     * @param Attribute|null $parent
     *
     * @return Attribute
     */
    private function createAttribute(array $data, AttributeGroup $attributeGroup, Attribute $parent = null)
    {
        return new Attribute($data['id'], $data['type'], $data['value'], $data['full_hierarchy_value'],
            $data['additional_text_data'], $data['slug'], $parent, $attributeGroup);
    }
}
