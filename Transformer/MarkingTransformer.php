<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\Marking;

class MarkingTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('Marking_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return Marking
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
            $parent = $this->createMarking($parentData, null);

            $parentsCount = count($parentsDataStack);
            for ($i = $parentsCount - 1; $i >= 0; $i--) {
                $parentData = $parentsDataStack[$i];
                $parent = $this->createMarking($parentData, $parent);
            }
        }

        return $this->createMarking($data, $parent);
    }

    /**
     * @param array $data
     * @param Marking|null $parent
     *
     * @return Marking
     */
    private function createMarking(array $data, Marking $parent = null)
    {
        return new Marking($data['id'], $data['name'], $data['full_hierarchy_name'], $data['slug'], $parent);
    }
}
