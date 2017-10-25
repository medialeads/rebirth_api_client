<?php

namespace Transformer;

require_once(__DIR__ . "/VariantMinimumQuantityTransformer.php");
require_once(__DIR__ . "/SupplierProfileTransformer.php");
require_once(__DIR__ . "/VariantPriceTransformer.php");
require_once(__DIR__ . "/VariantImageTransformer.php");
require_once(__DIR__ . "/VariantSamplePriceTransformer.php");
require_once(__DIR__ . "/VariantExternalLinkTransformer.php");

use Model\Variant;

class VariantTransformer
{
    public function fromArray($variant)
    {
        $supplierProfiles = array();
        foreach ($variant['supplier_profiles'] as $supplierProfile) {
            $supplierProfiles[] = SupplierProfileTransformer::fromArray($supplierProfile);
        }

        $variantPrices = array();
        foreach ($variant['variant_prices'] as $variantPrice) {
            $variantPrices[] = VariantPriceTransformer::fromArray($variantPrice);
        }

        $variantMinimumQuantities = null;
        foreach ($variant['variant_minimum_quantities'] as $variantMinimumQuantity) {
            $variantMinimumQuantities[] = VariantMinimumQuantityTransformer::fromArray($variantMinimumQuantity);
        }

        $variantImages = array();
        foreach ($variant['variant_images'] as $variantImage) {
            $variantImages[] = VariantImageTransformer::fromArray($variantImage);
        }

        $variantSamplePrices = array();
        foreach ($variant['variant_sample_prices'] as $variantSamplePrice) {
            $variantSamplePrices[] = VariantSamplePriceTransformer::fromArray($variantSamplePrice);
        }

        $variantExternalLinks = array();
        foreach ($variant['variant_external_links'] as $variantExternalLink) {
            $variantExternalLinks[] = VariantExternalLinkTransformer::fromArray($variantExternalLink);
        }

        $variantListPrices = array();
        foreach ($variant['variant_list_prices'] as $variantListPrice) {
            $variantListPrices[] = VariantListPriceTransformer::fromArray($variantListPrice);
        }

        $attributes = array();
        foreach ($variant['attributes'] as $attribute) {
            $attributes[] = AttributeTransformer::fromArray($attribute);
        }

        $variantMarkings = array();
        foreach ($variant['variant_markings'] as $variantMarking) {
            $variantMarkings[] = VariantMarkingTransformer::fromArray($variantMarking);
        }

        return new Variant($variant['id'], $variant['sub_packaging_information'], $variantMarkings, $supplierProfiles, $variant['description'], $variant['marking_additional_information'], $variant['supplier_reference'], $variant['net_weight'], $variant['main_variant_image_id'], $variant['sub_sub_packaging_size'], $variantMinimumQuantities, $variant['project_id'], $variantPrices, $variant['stock'], $variant['gross_weight'], $variant['packaging_information'], $variant['slug'], $variant['sub_packaging_size'], $variantImages, $variant['packaging_gross_weight'], $variant['packagingSize'], $variant['european_article_numbering'], $variantSamplePrices, $variant['size'], $variantExternalLinks, $variant['name'], $variantListPrices, $attributes, $variant['sub_sub_packaging_information'], $variant['mandatoryMarking']);
    }
}