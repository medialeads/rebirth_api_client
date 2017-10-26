<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\MarkingFee;

class MarkingFeeTransformer extends AbstractTransformer
{
    /**
     * @param array $markingFees
     *
     * @return array
     */
    public static function doFromArray(array $markingFees): array
    {
        $response = array();
        foreach ($markingFees as $markingFee) {
            $response[] = new MarkingFee($markingFee['id'], $markingFee['project_id'], $markingFee['name'], $markingFee['slug']);
        }

        return $response;
    }
}