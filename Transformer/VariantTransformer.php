<?php

namespace ES\APIv2Client\Transformer;

use ES\APIv2Client\Model\Variant;

/**
 * @author Dagan MENEZ
 */
class VariantTransformer extends AbstractTransformer
{
    /**
     * @param array $variants
     *
     * @return array
     */
    public static function doFromArray($variants)
    {
        $response = array();
        foreach ($variants as $variant) {
            $supplierProfiles = SupplierProfileTransformer::fromArray($variant['supplier_profiles']);

            $variantPrices = VariantPriceTransformer::fromArray($variant['variant_prices']);

            $variantMinimumQuantities = VariantMinimumQuantityTransformer::fromArray($variant['variant_minimum_quantities']);

            $variantImages = VariantImageTransformer::fromArray($variant['variant_images']);

            $variantSamplePrices = VariantSamplePriceTransformer::fromArray($variant['variant_sample_prices']);

            $variantExternalLinks = VariantExternalLinkTransformer::fromArray($variant['variant_external_links']);

            $variantListPrices = VariantListPriceTransformer::fromArray($variant['variant_list_prices']);

            $attributes = AttributeTransformer::fromArray($variant['attributes']);

            $variantMarkings = VariantMarkingTransformer::fromArray($variant['variant_markings']);

            $keywords = KeywordTransformer::fromArray($variant['keywords']);

            $variantPackaging = VariantPackagingTransformer::fromArray($variant['variant_packaging']);

            $variantSizes = VariantSizeTransformer::fromArray($variant['variant_sizes']);

            $response[] = new Variant($variant['id'], $variantMarkings, $supplierProfiles, $variant['description'], $variant['raw_description'], $variant['marking_additional_information'], $variant['supplier_reference'], $variant['net_weight'], $variant['main_variant_image_id'], $variantMinimumQuantities, $variant['project_id'], $variantPrices, $variant['stock'], $variant['gross_weight'], $variant['slug'], $variantImages, $variant['european_article_numbering'], $variantSamplePrices, $variantExternalLinks, $variant['name'], $variantListPrices, $attributes, $variant['mandatory_marking'], $keywords, $variantPackaging, $variantSizes);
        }

        return $response;
    }
}