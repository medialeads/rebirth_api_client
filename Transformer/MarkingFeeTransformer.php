<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\MarkingFee;

/**
 * @author Dagan MENEZ
 */
class MarkingFeeTransformer extends AbstractTransformer
{
    /**
     * @param array $markingFees
     *
     * @return array
     */
    public static function doFromArray($markingFees)
    {
        $response = array();
        foreach ($markingFees as $markingFee) {
            $response[] = new MarkingFee($markingFee['id'], $markingFee['project_id'], $markingFee['name'], $markingFee['slug']);
        }

        return $response;
    }
}