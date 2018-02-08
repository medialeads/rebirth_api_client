<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\VariantMarking;

class VariantMarkingTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('VariantMarking_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return VariantMarking
     */
    protected function transform(array $data)
    {
        return new VariantMarking($data['id'], $data['key'], $data['type'], $data['length'], $data['minimum_length'],
            $data['maximum_length'], $data['free_entry_length'], $data['width'], $data['minimum_width'],
            $data['maximum_width'], $data['free_entry_width'], $data['squared_size'], $data['minimum_squared_size'],
            $data['maximum_squared_size'], $data['free_entry_squared_size'], $data['diameter'],
            $data['minimum_diameter'], $data['maximum_diameter'], $data['free_entry_diameter'],
            $data['number_of_colors'], $data['minimum_number_of_colors'], $data['maximum_number_of_colors'],
            $data['free_entry_number_of_colors'], $data['number_of_positions'], $data['minimum_number_of_positions'],
            $data['maximum_number_of_positions'], $data['free_entry_number_of_positions'], $data['number_of_logos'],
            $data['minimum_number_of_logos'], $data['maximum_number_of_logos'], $data['free_entry_number_of_logos'],
            $data['full_color'], $data['minimum_quantity'], $data['maximum_quantity'], $data['comment'],
            $data['use_only_variant_prices'],
            MarkingPositionTransformer::create()->transformOne($data['marking_position']),
            SupplierMarkingTransformer::create()->transformOne($data['supplier_marking']),
            MarkingTransformer::create()->transformOne($data['marking']),
            PartialSupplierProfileTransformer::create()->transformMultiple($data['supplier_profiles']),
            DynamicFixedPriceTransformer::create()->transformMultiple($data['dynamic_fixed_prices']),
            DynamicVariablePriceHolderTransformer::create()->transformMultiple($data['dynamic_variable_price_holders']),
            StaticFixedPriceTransformer::create()->transformMultiple($data['static_fixed_prices']),
            StaticVariablePriceHolderTransformer::create()->transformMultiple($data['static_variable_price_holders']));
    }
}
