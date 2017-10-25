<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . "/../Model/MarkingFee.php");

use Model\MarkingFee;

class MarkingFeeTransformer extends AbstractTransformer
{
    public static function doFromArray(array $markingFees): array
    {
        $response = array();
        foreach ($markingFees as $markingFee) {
            $response[] = new MarkingFee($markingFee['id'], $markingFee['project_id'], $markingFee['name'], $markingFee['slug']);
        }

        return $response;
    }
}