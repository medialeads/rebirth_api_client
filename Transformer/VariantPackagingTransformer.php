<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\VariantPackaging;

class VariantPackagingTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('VariantPackaging_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return VariantPackaging
     */
    protected function transform(array $data)
    {
        $parent = null;
        $parentId = $data['parent_id'];
        if (null !== $parentId) {
            $hierarchyIndexedById = array_combine(array_map(function ($row) {
                return $row['id'];
            }, $data['hierarchy']), $data['hierarchy']);
            $parentsDataStack = array();
            while (null !== $parentId) {
                $parentData = $hierarchyIndexedById[$parentId];
                $parentsDataStack[] = $parentData;
                $parentId = $parentData['parent_id'];
            }

            $parentData = array_pop($parentsDataStack);
            $parent = $this->createVariantPackaging($parentData, null);

            $parentsCount = count($parentsDataStack);
            for ($i = $parentsCount - 1; $i >= 0; $i--) {
                $parentData = $parentsDataStack[$i];
                $parent = $this->createVariantPackaging($parentData, $parent);
            }
        }

        return $this->createVariantPackaging($data, $parent);
    }

    /**
     * @param array $data
     * @param VariantPackaging|null $parent
     *
     * @return VariantPackaging
     */
    private function createVariantPackaging(array $data, VariantPackaging $parent = null)
    {
        return new VariantPackaging($data['id'], $data['type'], $data['inner_quantity'], $data['weight'], $parent,
            VariantPackagingSizeTransformer::create()->transformMultiple($data['variant_packaging_sizes']));
    }
}
