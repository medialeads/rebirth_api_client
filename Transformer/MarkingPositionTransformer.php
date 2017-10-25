<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . "/../Model/MarkingPosition.php");

use Model\MarkingPosition;

class MarkingPositionTransformer extends AbstractTransformer
{
    public static function doFromArray(array $markingPositions): array
    {
        $response = array();
        foreach ($markingPositions as $markingPosition) {
            $response[] = new MarkingPosition($markingPosition['id'], $markingPosition['project_id'], $markingPosition['name'], $markingPosition['slug']);
        }

        return $response;
    }
}