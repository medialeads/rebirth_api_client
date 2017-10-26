<?php

namespace Transformer;

require_once(__DIR__ . "/AbstractTransformer.php");
require_once(__DIR__ . "/../Model/VariantMarking.php");
require_once(__DIR__ . "/DynamicVariablePriceHolderTransformer.php");
require_once(__DIR__ . "/DynamicFixedPriceTransformer.php");
require_once(__DIR__ . "/StaticVariablePriceHolderTransformer.php");
require_once(__DIR__ . "/StaticFixedPriceTransformer.php");
require_once(__DIR__ . "/MarkingPositionTransformer.php");
require_once(__DIR__ . "/SupplierMarkingTransformer.php");
require_once(__DIR__ . "/MarkingTransformer.php");

use Model\VariantMarking;

class VariantMarkingTransformer extends AbstractTransformer
{
    public static function doFromArray(array $variantMarkings): array
    {
        $response = array();
        foreach ($variantMarkings as $variantMarking) {
            $staticVariablePriceHolders = StaticVariablePriceHolderTransformer::fromArray($variantMarking['static_variable_price_holders']);
            $markingPosition = MarkingPositionTransformer::fromArray($variantMarking['marking_position']);
            $dynamicVariablePriceHolders = DynamicVariablePriceHolderTransformer::fromArray($variantMarking['dynamic_variable_price_holders']);
            $supplierMarking = SupplierMarkingTransformer::fromArray($variantMarking['supplier_marking']);
            $marking = MarkingTransformer::fromArray($variantMarking['marking']);
            $staticFixedPrices = StaticFixedPriceTransformer::fromArray($variantMarking['static_fixed_prices']);
            $dynamicFixedPrices = DynamicFixedPriceTransformer::fromArray($variantMarking['dynamic_fixed_prices']);

            $response[] = new VariantMarking($variantMarking['id'], $variantMarking['free_entry_squared_size'], $variantMarking['type'], $variantMarking['minimum_length'], $variantMarking['minimum_diameter'], $variantMarking['number_of_positions'], $variantMarking['free_entry_number_of_logos'], $variantMarking['maximum_diameter'], $variantMarking['diameter'], $variantMarking['project_id'], $variantMarking['free_entry_length'], $staticVariablePriceHolders, $variantMarking['minimum_number_of_colors'], $variantMarking['free_entry_diameter'], $staticFixedPrices, $variantMarking['full_color'], $markingPosition, $variantMarking['free_entry_number_of_colors'], $variantMarking['maximum_number_of_colors'], $variantMarking['free_entry_number_of_positions'], $variantMarking['maximum_quantity'], $variantMarking['minimum_number_of_logos'], $variantMarking['length'], $variantMarking['minimum_width'], $variantMarking['minimum_squared_size'], $dynamicVariablePriceHolders, $variantMarking['number_of_colors'], $supplierMarking, $marking, $variantMarking['maximum_length'], $variantMarking['squared_size'], $variantMarking['width'], $variantMarking['maximum_number_of_logos'], $variantMarking['comment'], $variantMarking['maximum_width'], $variantMarking['minimum_quantity'], $variantMarking['maximum_number_of_colors'], $dynamicFixedPrices, $variantMarking['maximum_squared_size']);
        }

        return $response;
    }
}