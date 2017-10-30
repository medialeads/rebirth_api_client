<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\Marking;

class MarkingTransformer extends AbstractTransformer
{
    /**
     * @param array $markings
     *
     * @return array
     */
    public static function doFromArray($markings)
    {
        $response = array();
        foreach ($markings as $marking) {
            foreach ($marking['hierarchy'] as $hierarchy) {
                if (isset($hierarchy['id']) && $hierarchy['id'] = $marking['parent_id']) {
                    $parent = $hierarchy;
                }
            }
            $response[] = new Marking($marking['id'], $marking['full_hierarchy_name'], $marking['project_id'], $marking['parent_id'], $hierarchy, $marking['name'], $marking['slug']);
        }

        return $response;
    }
}