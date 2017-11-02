<?php

use PHPUnit\Framework\TestCase;
use ES\APIv2Client\Model\Supplier;
use ES\APIv2Client\Model\Product;
use ES\APIv2Client\Model\Variant;
use ES\APIv2Client\Model\VariantPrice;
use ES\APIv2Client\Model\CalculatedPrice;
use ES\APIv2Client\Model\SupplierProfile;
use ES\APIv2Client\Model\VariantMarking;
use ES\APIv2Client\Model\VariantMarkingModel;
use ES\APIv2Client\Model\StaticFixedPrice;
use ES\APIv2Client\Model\Marking;
use ES\APIv2Client\Model\MarkingPosition;
use ES\APIv2Client\Model\DynamicFixedPrice;

class CalculatedPriceTest extends TestCase
{
    public function test() {

        /**
         *
         * TEST 1 with VariantPrices only
         *
         */
        $supplierProfiles = array(new SupplierProfile('1', 'FR', '', 'name', '', true, ''));
        $variantPrices = array(new VariantPrice('1', '2', '1', '0.5', reset($supplierProfiles), '100'));
        $variantPrices[] = new VariantPrice('2', '4', '2', '1', reset($supplierProfiles), '1');
        $variantMarkings = array();
        $variants = array(new Variant('1', '', $variantMarkings, $supplierProfiles, '', '', '', '', '', '','2', '', $variantPrices, '', '', '', '', '', array(), '','', '', array(), '', array(), 'name', array(), array(), '', false));
        $supplier = new Supplier('1', '', '', $supplierProfiles, 'name', '', 'name');
        $product = new Product('1', new DateTime('now'), '', 'CN', '', $variants, '', '', array(), array(), array(), '', '', $supplier, array(), '', '', null);

        /** @var Variant $variant */
        $variant = $product->getVariants()[0];
        /** @var SupplierProfile $supplierProfile */
        $supplierProfile = $variant->getSupplierProfiles()[0];
        $quantity = 50;
        $calculatedPrice = $variant->getCalculatedPrice($supplierProfile, $quantity);
        $this->assertInstanceOf(CalculatedPrice::class, $calculatedPrice);
        $this->assertEquals(200, $calculatedPrice->getValue());

        $quantity = 500;
        $calculatedPrice = $variant->getCalculatedPrice($supplierProfile, $quantity);
        $this->assertEquals(1000, $calculatedPrice->getValue());

        /**
         *
         * TEST 2 with StaticFixedPrices, VariantPrices
         *
         */
        $markingPosition = new MarkingPosition('1', '', 'name', 'name');
        $marking = new Marking('1', 'hierarchy > hierarchy', '', '', array(), 'name', 'name');
        $staticVariablePriceHolders = array();
        $dynamicVariablePriceHolder = array();
        $staticFixedPrices = array(new StaticFixedPrice('1', 'nb_couleurs==1', '5', false, '', array(), '2.5', '3', $supplierProfile));
        $dynamicFixedPrices = array();
        $variantMarkings = array(new VariantMarking('1', true, '',null, null, 5, false, 5, null, null, '', false, $staticVariablePriceHolders, null, false, $staticFixedPrices, true, $markingPosition, false, 5, false, 50000, 1, null, null, null, $dynamicVariablePriceHolder, 1, array(), $marking, null, null, null, null, '', null, 2, null, $dynamicFixedPrices, null));

        $variant = new Variant('1', '', $variantMarkings, $supplierProfiles, '', '', '', '', '', '','2', '', $variantPrices, '', '', '', '', '', array(), '','', '', array(), '', array(), 'name', array(), array(), '', false);

        /** @var VariantMarking $variantMarking */
        $variantMarking = $variant->getVariantMarkings()[0];
        $variantMarkingModel = new VariantMarkingModel();
        $variantMarkingModel->setVariantMarking($variantMarking);
        $variantMarkingModel->setDiameter($variantMarking->getDiameter());
        $variantMarkingModel->setFullColor($variantMarking->isFullColor());
        $variantMarkingModel->setLength($variantMarking->getLength());
        $variantMarkingModel->setWidth($variantMarking->getWidth());
        $variantMarkingModel->setSquaredSize($variantMarking->getSquaredSize());
        $variantMarkingModel->setNumberOfColors($variantMarking->getNumberOfColors());
        $variantMarkingModel->setNumberOfLogos($variantMarking->getNumberOfLogos());
        $variantMarkingModel->setNumberOfPositions($variantMarking->getNumberOfPositions());
        $variantMarkingModels = array($variantMarkingModel);

        $quantity = 2;
        $calculatedPrice = $variant->getCalculatedPrice($supplierProfile, $quantity, $variantMarkingModels);
        $this->assertEquals(18, $calculatedPrice->getValue());

        /**
         *
         * TEST 3 with DynamicFixedPrices, StaticFixedPrices, VariantPrices
         *
         */
        $dynamicFixedPrices = array(new DynamicFixedPrice('1', 'nb_couleurs>0',5,true,'',array(),3,5, $supplierProfile));
        $variantMarkings = array(new VariantMarking('1', true, '',null, null, 5, false, 5, null, null, '', false, $staticVariablePriceHolders, null, false, $staticFixedPrices, true, $markingPosition, false, 5, false, 50000, 1, null, null, null, $dynamicVariablePriceHolder, 1, array(), $marking, null, null, null, null, '', null, 2, null, $dynamicFixedPrices, null));
        $variant = new Variant('1', '', $variantMarkings, $supplierProfiles, '', '', '', '', '', '','2', '', $variantPrices, '', '', '', '', '', array(), '','', '', array(), '', array(), 'name', array(), array(), '', false);
        $quantity = 2;

        $variantMarking = $variant->getVariantMarkings()[0];
        $variantMarkingModel->setVariantMarking($variantMarking);
        $variantMarkingModels = array($variantMarkingModel);

        $calculatedPrice = $variant->getCalculatedPrice($supplierProfile, $quantity, $variantMarkingModels);
        $this->assertEquals(23, $calculatedPrice->getValue());
    }
}