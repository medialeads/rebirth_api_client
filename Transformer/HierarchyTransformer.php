<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . "/../Model/Hierarchy.php");

use Model\Hierarchy;

class HierarchyTransformer extends AbstractTransformer
{
    public static function doFromArray(array $hierarchies): array
    {
        $response = array();
        foreach ($hierarchies as $hierarchy) {
            $response[] = new Hierarchy($hierarchy['id'], $hierarchy['project_id'], $hierarchy['parent_id'], $hierarchy['type'], $hierarchy['value'], $hierarchy['slug']);
        }

        return $response;
    }
}