<?php

namespace ES\RebirthApiClient\Transformer;

use ES\RebirthApiClient\Model\Variant;

class VariantTransformer extends AbstractModelTransformer
{
    /**
     * @param array $data
     *
     * @return string
     */
    protected function getId(array $data)
    {
        return sprintf('Variant_%s', $data['id']);
    }

    /**
     * @param array $data
     *
     * @return Variant
     */
    protected function transform(array $data)
    {
        $mainVariantImage = null;
        $variantImages = VariantImageTransformer::create()->transformMultiple($data['variant_images']);
        if (!empty($variantImages)) {
            $mainVariantImage = $variantImages[$data['main_variant_image_id']];
        }

        return new Variant($data['id'], $data['supplier_reference'], $data['name'], $data['description'],
            $data['raw_description'], $data['mandatory_marking'], $data['marking_additional_information'],
            $data['net_weight'], $data['gross_weight'], $data['stock'], $data['european_article_numbering'],
            $data['slug'], VariantPackagingTransformer::create()->transformOne($data['variant_packaging']),
            $mainVariantImage, AttributeTransformer::create()->transformMultiple($data['attributes']),
            PartialSupplierProfileTransformer::create()->transformMultiple($data['supplier_profiles']),
            KeywordTransformer::create()->transformMultiple($data['keywords']),
            VariantPriceTransformer::create()->transformMultiple($data['variant_prices']), $variantImages,
            VariantMarkingTransformer::create()->transformMultiple($data['variant_markings']),
            VariantMinimumQuantityTransformer::create()->transformMultiple($data['variant_minimum_quantities']),
            VariantDeliveryTimeTransformer::create()->transformMultiple($data['variant_delivery_times']),
            VariantSamplePriceTransformer::create()->transformMultiple($data['variant_sample_prices']),
            VariantExternalLinkTransformer::create()->transformMultiple($data['variant_external_links']),
            VariantListPriceTransformer::create()->transformMultiple($data['variant_list_prices']),
            VariantSizeTransformer::create()->transformMultiple($data['variant_sizes']));
    }
}
