<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\MarkingPosition;

/**
 * @author Dagan MENEZ
 */
class MarkingPositionTransformer extends AbstractTransformer
{
    /**
     * @param array $markingPositions
     *
     * @return array
     */
    public static function doFromArray($markingPositions)
    {
        $response = array();
        foreach ($markingPositions as $markingPosition) {
            $response[] = new MarkingPosition($markingPosition['id'], $markingPosition['project_id'], $markingPosition['name'], $markingPosition['slug']);
        }

        return $response;
    }
}