<?php

namespace Tests\Util\Helper;

use ES\RebirthApiClient\Util\Helper\VariantMarkingHelper;
use ES\RebirthApiClient\Util\Model\SelectedVariantMarking;
use ES\RebirthCommon\DynamicFixedPriceInterface;
use ES\RebirthCommon\DynamicVariablePriceHolderInterface;
use ES\RebirthCommon\DynamicVariablePriceInterface;
use ES\RebirthCommon\StaticFixedPriceInterface;
use ES\RebirthCommon\StaticVariablePriceHolderInterface;
use ES\RebirthCommon\StaticVariablePriceInterface;
use ES\RebirthCommon\SupplierProfileInterface;
use ES\RebirthCommon\VariantMarkingInterface;
use Money\Money;
use PHPUnit\Framework\TestCase;

class VariantMarkingHelperTest extends TestCase
{
    /**
     * @dataProvider provideGetVariantMarkingCalculatedPriceInvalidQuantity
     */
    public function testGetVariantMarkingCalculatedPriceWithInvalidQuantity($quantity)
    {
        $selectedVariantMarking = $this->createMock(SelectedVariantMarking::class);
        $selectedVariantMarking->expects($this->never())->method($this->anything());

        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->never())->method($this->anything());

        $variantMarkingCalculatedPrice = VariantMarkingHelper::getVariantMarkingCalculatedPrice($selectedVariantMarking, array(), $supplierProfile, $quantity);

        $this->assertTrue($variantMarkingCalculatedPrice->isOnQuote());
    }

    /**
     * @return array
     */
    public function provideGetVariantMarkingCalculatedPriceInvalidQuantity()
    {
        return array(
            array('foo'),
            array(0),
            array(-1),
            array('-1'),
            array(-3.4),
            array('-4.5'),
            array(false),
            array(null),
        );
    }

    public function testGetVariantMarkingCalculatedPriceWithTooLowQuantity()
    {
        $variantMarking = $this->createMock(VariantMarkingInterface::class);
        $variantMarking->expects($this->once())->method('getMinimumQuantity')->willReturn(2);
        $variantMarking->expects($this->never())->method($this->logicalNot($this->equalTo('getMinimumQuantity')));

        $selectedVariantMarking = $this->createMock(SelectedVariantMarking::class);
        $selectedVariantMarking->expects($this->once())->method('getVariantMarking')->willReturn($variantMarking);
        $selectedVariantMarking->expects($this->never())->method($this->logicalNot($this->equalTo('getVariantMarking')));

        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->never())->method($this->anything());

        $variantMarkingCalculatedPrice = VariantMarkingHelper::getVariantMarkingCalculatedPrice($selectedVariantMarking, array(), $supplierProfile, 1);

        $this->assertTrue($variantMarkingCalculatedPrice->isOnQuote());
    }

    public function testGetVariantMarkingCalculatedPriceWithTooHighQuantity()
    {
        $variantMarking = $this->createMock(VariantMarkingInterface::class);
        $variantMarking->expects($this->once())->method('getMinimumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getMaximumQuantity')->willReturn(1);
        $variantMarking->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getMinimumQuantity'),
            $this->equalTo('getMaximumQuantity')
        )));

        $selectedVariantMarking = $this->createMock(SelectedVariantMarking::class);
        $selectedVariantMarking->expects($this->once())->method('getVariantMarking')->willReturn($variantMarking);
        $selectedVariantMarking->expects($this->never())->method($this->logicalNot($this->equalTo('getVariantMarking')));

        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->never())->method($this->anything());

        $variantMarkingCalculatedPrice = VariantMarkingHelper::getVariantMarkingCalculatedPrice($selectedVariantMarking, array(), $supplierProfile, 2);

        $this->assertTrue($variantMarkingCalculatedPrice->isOnQuote());
    }

    public function testGetVariantMarkingCalculatedPriceWithSyntaxErrorInDynamicFixedPriceCondition()
    {
        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->exactly(2))->method('getUniqueId')->willReturn('1');
        $supplierProfile->expects($this->never())->method($this->logicalNot($this->equalTo('getUniqueId')));

        $dynamicFixedPrice = $this->createMock(DynamicFixedPriceInterface::class);
        $dynamicFixedPrice->expects($this->once())->method('getCondition')->willReturn('cannot be evaluated');
        $dynamicFixedPrice->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
        $dynamicFixedPrice->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getCondition'),
            $this->equalTo('getSupplierProfile')
        )));

        $dynamicFixedPrices = array(
            $dynamicFixedPrice
        );

        $variantMarking = $this->createMock(VariantMarkingInterface::class);
        $variantMarking->expects($this->once())->method('getMinimumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getMaximumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getDynamicFixedPrices')->willReturn($dynamicFixedPrices);
        $variantMarking->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getMinimumQuantity'),
            $this->equalTo('getMaximumQuantity'),
            $this->equalTo('getDynamicFixedPrices')
        )));

        $selectedVariantMarking = $this->createMock(SelectedVariantMarking::class);
        $selectedVariantMarking->expects($this->once())->method('getVariantMarking')->willReturn($variantMarking);
        $selectedVariantMarking->expects($this->never())->method($this->logicalNot($this->equalTo('getVariantMarking')));

        $variantMarkingCalculatedPrice = VariantMarkingHelper::getVariantMarkingCalculatedPrice($selectedVariantMarking, array(), $supplierProfile, 1);

        $this->assertTrue($variantMarkingCalculatedPrice->isOnQuote());
    }

    public function testGetVariantMarkingCalculatedPriceWithSyntaxErrorInStaticFixedPriceCondition()
    {
        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->exactly(2))->method('getUniqueId')->willReturn('1');
        $supplierProfile->expects($this->never())->method($this->logicalNot($this->equalTo('getUniqueId')));

        $staticFixedPrice = $this->createMock(StaticFixedPriceInterface::class);
        $staticFixedPrice->expects($this->once())->method('getCondition')->willReturn('cannot be evaluated');
        $staticFixedPrice->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
        $staticFixedPrice->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getCondition'),
            $this->equalTo('getSupplierProfile')
        )));

        $staticFixedPrices = array(
            $staticFixedPrice
        );

        $variantMarking = $this->createMock(VariantMarkingInterface::class);
        $variantMarking->expects($this->once())->method('getMinimumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getMaximumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getDynamicFixedPrices')->willReturn(array());
        $variantMarking->expects($this->once())->method('getStaticFixedPrices')->willReturn($staticFixedPrices);
        $variantMarking->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getMinimumQuantity'),
            $this->equalTo('getMaximumQuantity'),
            $this->equalTo('getDynamicFixedPrices'),
            $this->equalTo('getStaticFixedPrices')
        )));

        $selectedVariantMarking = $this->createMock(SelectedVariantMarking::class);
        $selectedVariantMarking->expects($this->once())->method('getVariantMarking')->willReturn($variantMarking);
        $selectedVariantMarking->expects($this->never())->method($this->logicalNot($this->equalTo('getVariantMarking')));

        $variantMarkingCalculatedPrice = VariantMarkingHelper::getVariantMarkingCalculatedPrice($selectedVariantMarking, array(), $supplierProfile, 1);

        $this->assertTrue($variantMarkingCalculatedPrice->isOnQuote());
    }

    public function testGetVariantMarkingCalculatedPriceWithSyntaxErrorInDynamicVariablePriceHolderPriceCondition()
    {
        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->exactly(2))->method('getUniqueId')->willReturn('1');
        $supplierProfile->expects($this->never())->method($this->logicalNot($this->equalTo('getUniqueId')));

        $dynamicVariablePriceHolder = $this->createMock(DynamicVariablePriceHolderInterface::class);
        $dynamicVariablePriceHolder->expects($this->once())->method('getCondition')->willReturn('cannot be evaluated');
        $dynamicVariablePriceHolder->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
        $dynamicVariablePriceHolder->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getCondition'),
            $this->equalTo('getSupplierProfile')
        )));

        $dynamicVariablePriceHolders = array(
            $dynamicVariablePriceHolder
        );

        $variantMarking = $this->createMock(VariantMarkingInterface::class);
        $variantMarking->expects($this->once())->method('getMinimumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getMaximumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getDynamicFixedPrices')->willReturn(array());
        $variantMarking->expects($this->once())->method('getStaticFixedPrices')->willReturn(array());
        $variantMarking->expects($this->once())->method('getDynamicVariablePriceHolders')->willReturn($dynamicVariablePriceHolders);
        $variantMarking->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getMinimumQuantity'),
            $this->equalTo('getMaximumQuantity'),
            $this->equalTo('getDynamicFixedPrices'),
            $this->equalTo('getStaticFixedPrices'),
            $this->equalTo('getDynamicVariablePriceHolders')
        )));

        $selectedVariantMarking = $this->createMock(SelectedVariantMarking::class);
        $selectedVariantMarking->expects($this->once())->method('getVariantMarking')->willReturn($variantMarking);
        $selectedVariantMarking->expects($this->never())->method($this->logicalNot($this->equalTo('getVariantMarking')));

        $variantMarkingCalculatedPrice = VariantMarkingHelper::getVariantMarkingCalculatedPrice($selectedVariantMarking, array(), $supplierProfile, 1);

        $this->assertTrue($variantMarkingCalculatedPrice->isOnQuote());
    }

    public function testGetVariantMarkingCalculatedPriceWithSyntaxErrorInStaticVariablePriceHolderPriceCondition()
    {
        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->exactly(2))->method('getUniqueId')->willReturn('1');
        $supplierProfile->expects($this->never())->method($this->logicalNot($this->equalTo('getUniqueId')));

        $staticVariablePriceHolder = $this->createMock(StaticVariablePriceHolderInterface::class);
        $staticVariablePriceHolder->expects($this->once())->method('getCondition')->willReturn('cannot be evaluated');
        $staticVariablePriceHolder->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
        $staticVariablePriceHolder->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getCondition'),
            $this->equalTo('getSupplierProfile')
        )));

        $staticVariablePriceHolders = array(
            $staticVariablePriceHolder
        );

        $variantMarking = $this->createMock(VariantMarkingInterface::class);
        $variantMarking->expects($this->once())->method('getMinimumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getMaximumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getDynamicFixedPrices')->willReturn(array());
        $variantMarking->expects($this->once())->method('getStaticFixedPrices')->willReturn(array());
        $variantMarking->expects($this->once())->method('getDynamicVariablePriceHolders')->willReturn(array());
        $variantMarking->expects($this->once())->method('getStaticVariablePriceHolders')->willReturn($staticVariablePriceHolders);
        $variantMarking->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getMinimumQuantity'),
            $this->equalTo('getMaximumQuantity'),
            $this->equalTo('getDynamicFixedPrices'),
            $this->equalTo('getStaticFixedPrices'),
            $this->equalTo('getDynamicVariablePriceHolders'),
            $this->equalTo('getStaticVariablePriceHolders')
        )));

        $selectedVariantMarking = $this->createMock(SelectedVariantMarking::class);
        $selectedVariantMarking->expects($this->once())->method('getVariantMarking')->willReturn($variantMarking);
        $selectedVariantMarking->expects($this->never())->method($this->logicalNot($this->equalTo('getVariantMarking')));

        $variantMarkingCalculatedPrice = VariantMarkingHelper::getVariantMarkingCalculatedPrice($selectedVariantMarking, array(), $supplierProfile, 1);

        $this->assertTrue($variantMarkingCalculatedPrice->isOnQuote());
    }

    public function testGetVariantMarkingCalculatedPriceWithNoVariantMarkingPrices()
    {
        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->never())->method($this->anything());

        $variantMarking = $this->createMock(VariantMarkingInterface::class);
        $variantMarking->expects($this->once())->method('getMinimumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getMaximumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getDynamicFixedPrices')->willReturn(array());
        $variantMarking->expects($this->once())->method('getStaticFixedPrices')->willReturn(array());
        $variantMarking->expects($this->once())->method('getDynamicVariablePriceHolders')->willReturn(array());
        $variantMarking->expects($this->once())->method('getStaticVariablePriceHolders')->willReturn(array());
        $variantMarking->expects($this->once())->method('isIncludedInVariantPrices')->willReturn(false);
        $variantMarking->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getMinimumQuantity'),
            $this->equalTo('getMaximumQuantity'),
            $this->equalTo('getDynamicFixedPrices'),
            $this->equalTo('getStaticFixedPrices'),
            $this->equalTo('getDynamicVariablePriceHolders'),
            $this->equalTo('getStaticVariablePriceHolders'),
            $this->equalTo('isIncludedInVariantPrices')
        )));

        $selectedVariantMarking = $this->createMock(SelectedVariantMarking::class);
        $selectedVariantMarking->expects($this->once())->method('getVariantMarking')->willReturn($variantMarking);
        $selectedVariantMarking->expects($this->never())->method($this->logicalNot($this->equalTo('getVariantMarking')));

        $variantMarkingCalculatedPrice = VariantMarkingHelper::getVariantMarkingCalculatedPrice($selectedVariantMarking, array(), $supplierProfile, 1);

        $this->assertTrue($variantMarkingCalculatedPrice->isOnQuote());
    }

    public function testGetVariantMarkingCalculatedPriceWithNoMatchingVariantMarkingPrices()
    {
        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->exactly(4))->method('getUniqueId')->willReturn('1');
        $supplierProfile->expects($this->never())->method($this->logicalNot($this->equalTo('getUniqueId')));

        $dynamicFixedPrice = $this->createMock(DynamicFixedPriceInterface::class);
        $dynamicFixedPrice->expects($this->once())->method('getCondition')->willReturn(null);
        $dynamicFixedPrice->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
        $dynamicFixedPrice->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getCondition'),
            $this->equalTo('getSupplierProfile')
        )));

        $dynamicFixedPrices = array(
            $dynamicFixedPrice
        );

        $staticFixedPrice = $this->createMock(StaticFixedPriceInterface::class);
        $dynamicFixedPrice->expects($this->once())->method('getCondition')->willReturn(null);
        $staticFixedPrice->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
        $staticFixedPrice->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getCondition'),
            $this->equalTo('getSupplierProfile')
        )));

        $staticFixedPrices = array(
            $staticFixedPrice
        );

        $dynamicVariablePriceHolder = $this->createMock(DynamicVariablePriceHolderInterface::class);
        $dynamicFixedPrice->expects($this->once())->method('getCondition')->willReturn(null);
        $dynamicVariablePriceHolder->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
        $dynamicVariablePriceHolder->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getCondition'),
            $this->equalTo('getSupplierProfile')
        )));

        $dynamicVariablePriceHolders = array(
            $dynamicVariablePriceHolder
        );

        $staticVariablePriceHolder = $this->createMock(StaticVariablePriceHolderInterface::class);
        $dynamicFixedPrice->expects($this->once())->method('getCondition')->willReturn(null);
        $staticVariablePriceHolder->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
        $staticVariablePriceHolder->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getCondition'),
            $this->equalTo('getSupplierProfile')
        )));

        $staticVariablePriceHolders = array(
            $staticVariablePriceHolder
        );

        $variantMarking = $this->createMock(VariantMarkingInterface::class);
        $variantMarking->expects($this->once())->method('getMinimumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getMaximumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getDynamicFixedPrices')->willReturn($dynamicFixedPrices);
        $variantMarking->expects($this->once())->method('getStaticFixedPrices')->willReturn($staticFixedPrices);
        $variantMarking->expects($this->once())->method('getDynamicVariablePriceHolders')->willReturn($dynamicVariablePriceHolders);
        $variantMarking->expects($this->once())->method('getStaticVariablePriceHolders')->willReturn($staticVariablePriceHolders);
        $variantMarking->expects($this->once())->method('isIncludedInVariantPrices')->willReturn(false);
        $variantMarking->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getMinimumQuantity'),
            $this->equalTo('getMaximumQuantity'),
            $this->equalTo('getDynamicFixedPrices'),
            $this->equalTo('getStaticFixedPrices'),
            $this->equalTo('getDynamicVariablePriceHolders'),
            $this->equalTo('getStaticVariablePriceHolders'),
            $this->equalTo('isIncludedInVariantPrices')
        )));

        $selectedVariantMarking = $this->createMock(SelectedVariantMarking::class);
        $selectedVariantMarking->expects($this->once())->method('getVariantMarking')->willReturn($variantMarking);
        $selectedVariantMarking->expects($this->never())->method($this->logicalNot($this->equalTo('getVariantMarking')));

        $supplierProfile2 = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile2->expects($this->exactly(4))->method('getUniqueId')->willReturn('2');
        $supplierProfile2->expects($this->never())->method($this->logicalNot($this->equalTo('getUniqueId')));

        $variantMarkingCalculatedPrice = VariantMarkingHelper::getVariantMarkingCalculatedPrice($selectedVariantMarking, array(), $supplierProfile2, 1);

        $this->assertTrue($variantMarkingCalculatedPrice->isOnQuote());
    }

    public function testGetVariantMarkingCalculatedPriceWithSyntaxErrorInDynamicFixedPriceCalculationValue()
    {
        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->exactly(2))->method('getUniqueId')->willReturn('1');
        $supplierProfile->expects($this->never())->method($this->logicalNot($this->equalTo('getUniqueId')));

        $dynamicFixedPrice = $this->createMock(DynamicFixedPriceInterface::class);
        $dynamicFixedPrice->expects($this->once())->method('getCondition')->willReturn(null);
        $dynamicFixedPrice->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
        $dynamicFixedPrice->expects($this->once())->method('getCalculationValue')->willReturn('cannot be evaluated');
        $dynamicFixedPrice->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getCondition'),
            $this->equalTo('getSupplierProfile'),
            $this->equalTo('getCalculationValue')
        )));

        $dynamicFixedPrices = array(
            $dynamicFixedPrice
        );

        $variantMarking = $this->createMock(VariantMarkingInterface::class);
        $variantMarking->expects($this->once())->method('getMinimumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getMaximumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getDynamicFixedPrices')->willReturn($dynamicFixedPrices);
        $variantMarking->expects($this->once())->method('getStaticFixedPrices')->willReturn(array());
        $variantMarking->expects($this->once())->method('getDynamicVariablePriceHolders')->willReturn(array());
        $variantMarking->expects($this->once())->method('getStaticVariablePriceHolders')->willReturn(array());
        $variantMarking->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getMinimumQuantity'),
            $this->equalTo('getMaximumQuantity'),
            $this->equalTo('getDynamicFixedPrices'),
            $this->equalTo('getStaticFixedPrices'),
            $this->equalTo('getDynamicVariablePriceHolders'),
            $this->equalTo('getStaticVariablePriceHolders')
        )));

        $selectedVariantMarking = $this->createMock(SelectedVariantMarking::class);
        $selectedVariantMarking->expects($this->once())->method('getVariantMarking')->willReturn($variantMarking);
        $selectedVariantMarking->expects($this->never())->method($this->logicalNot($this->equalTo('getVariantMarking')));

        $variantMarkingCalculatedPrice = VariantMarkingHelper::getVariantMarkingCalculatedPrice($selectedVariantMarking, array(), $supplierProfile, 1);

        $this->assertTrue($variantMarkingCalculatedPrice->isOnQuote());
    }

    public function testGetVariantMarkingCalculatedPriceWithNonNumericEvaluatedDynamicFixedPriceCalculationValue()
    {
        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->exactly(2))->method('getUniqueId')->willReturn('1');
        $supplierProfile->expects($this->never())->method($this->logicalNot($this->equalTo('getUniqueId')));

        $dynamicFixedPrice = $this->createMock(DynamicFixedPriceInterface::class);
        $dynamicFixedPrice->expects($this->once())->method('getCondition')->willReturn(null);
        $dynamicFixedPrice->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
        $dynamicFixedPrice->expects($this->once())->method('getCalculationValue')->willReturn('"non numeric"');
        $dynamicFixedPrice->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getCondition'),
            $this->equalTo('getSupplierProfile'),
            $this->equalTo('getCalculationValue')
        )));

        $dynamicFixedPrices = array(
            $dynamicFixedPrice
        );

        $variantMarking = $this->createMock(VariantMarkingInterface::class);
        $variantMarking->expects($this->once())->method('getMinimumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getMaximumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getDynamicFixedPrices')->willReturn($dynamicFixedPrices);
        $variantMarking->expects($this->once())->method('getStaticFixedPrices')->willReturn(array());
        $variantMarking->expects($this->once())->method('getDynamicVariablePriceHolders')->willReturn(array());
        $variantMarking->expects($this->once())->method('getStaticVariablePriceHolders')->willReturn(array());
        $variantMarking->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getMinimumQuantity'),
            $this->equalTo('getMaximumQuantity'),
            $this->equalTo('getDynamicFixedPrices'),
            $this->equalTo('getStaticFixedPrices'),
            $this->equalTo('getDynamicVariablePriceHolders'),
            $this->equalTo('getStaticVariablePriceHolders')
        )));

        $selectedVariantMarking = $this->createMock(SelectedVariantMarking::class);
        $selectedVariantMarking->expects($this->once())->method('getVariantMarking')->willReturn($variantMarking);
        $selectedVariantMarking->expects($this->never())->method($this->logicalNot($this->equalTo('getVariantMarking')));

        $variantMarkingCalculatedPrice = VariantMarkingHelper::getVariantMarkingCalculatedPrice($selectedVariantMarking, array(), $supplierProfile, 1);

        $this->assertTrue($variantMarkingCalculatedPrice->isOnQuote());
    }

    public function testGetVariantMarkingCalculatedPriceWithTwoDynamicVariablePricesThatHaveTheSameFromQuantity()
    {
        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->exactly(2))->method('getUniqueId')->willReturn('1');
        $supplierProfile->expects($this->never())->method($this->logicalNot($this->equalTo('getUniqueId')));

        $dynamicVariablePrice = $this->createMock(DynamicVariablePriceInterface::class);
        $dynamicVariablePrice->expects($this->exactly(2))->method('getFromQuantity')->willReturn(1);
        $dynamicVariablePrice->expects($this->never())->method($this->logicalNot($this->equalTo('getFromQuantity')));

        $dynamicVariablePrice2 = $this->createMock(DynamicVariablePriceInterface::class);
        $dynamicVariablePrice2->expects($this->once())->method('getFromQuantity')->willReturn(1);
        $dynamicVariablePrice2->expects($this->never())->method($this->logicalNot($this->equalTo('getFromQuantity')));

        $dynamicVariablePrices = array(
            $dynamicVariablePrice,
            $dynamicVariablePrice2
        );

        $dynamicVariablePriceHolder = $this->createMock(DynamicVariablePriceHolderInterface::class);
        $dynamicVariablePriceHolder->expects($this->once())->method('getCondition')->willReturn(null);
        $dynamicVariablePriceHolder->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
        $dynamicVariablePriceHolder->expects($this->once())->method('getDynamicVariablePrices')->willReturn($dynamicVariablePrices);
        $dynamicVariablePriceHolder->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getCondition'),
            $this->equalTo('getSupplierProfile'),
            $this->equalTo('getDynamicVariablePrices')
        )));

        $dynamicVariablePriceHolders = array(
            $dynamicVariablePriceHolder
        );

        $variantMarking = $this->createMock(VariantMarkingInterface::class);
        $variantMarking->expects($this->once())->method('getMinimumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getMaximumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getDynamicFixedPrices')->willReturn(array());
        $variantMarking->expects($this->once())->method('getStaticFixedPrices')->willReturn(array());
        $variantMarking->expects($this->once())->method('getDynamicVariablePriceHolders')->willReturn($dynamicVariablePriceHolders);
        $variantMarking->expects($this->once())->method('getStaticVariablePriceHolders')->willReturn(array());
        $variantMarking->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getMinimumQuantity'),
            $this->equalTo('getMaximumQuantity'),
            $this->equalTo('getDynamicFixedPrices'),
            $this->equalTo('getStaticFixedPrices'),
            $this->equalTo('getDynamicVariablePriceHolders'),
            $this->equalTo('getStaticVariablePriceHolders')
        )));

        $selectedVariantMarking = $this->createMock(SelectedVariantMarking::class);
        $selectedVariantMarking->expects($this->once())->method('getVariantMarking')->willReturn($variantMarking);
        $selectedVariantMarking->expects($this->never())->method($this->logicalNot($this->equalTo('getVariantMarking')));

        $variantMarkingCalculatedPrice = VariantMarkingHelper::getVariantMarkingCalculatedPrice($selectedVariantMarking, array(), $supplierProfile, 1);

        $this->assertTrue($variantMarkingCalculatedPrice->isOnQuote());
    }

    public function testGetVariantMarkingCalculatedPriceWithSyntaxErrorInDynamicVariablePriceCalculationValue()
    {
        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->exactly(2))->method('getUniqueId')->willReturn('1');
        $supplierProfile->expects($this->never())->method($this->logicalNot($this->equalTo('getUniqueId')));

        $dynamicVariablePrice = $this->createMock(DynamicVariablePriceInterface::class);
        $dynamicVariablePrice->expects($this->once())->method('getFromQuantity')->willReturn(1);
        $dynamicVariablePrice->expects($this->once())->method('getCalculationValue')->willReturn('cannot be evaluated');
        $dynamicVariablePrice->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getFromQuantity'),
            $this->equalTo('getCalculationValue')
        )));

        $dynamicVariablePrices = array(
            $dynamicVariablePrice
        );

        $dynamicVariablePriceHolder = $this->createMock(DynamicVariablePriceHolderInterface::class);
        $dynamicVariablePriceHolder->expects($this->once())->method('getCondition')->willReturn(null);
        $dynamicVariablePriceHolder->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
        $dynamicVariablePriceHolder->expects($this->once())->method('getDynamicVariablePrices')->willReturn($dynamicVariablePrices);
        $dynamicVariablePriceHolder->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getCondition'),
            $this->equalTo('getSupplierProfile'),
            $this->equalTo('getDynamicVariablePrices')
        )));

        $dynamicVariablePriceHolders = array(
            $dynamicVariablePriceHolder
        );

        $variantMarking = $this->createMock(VariantMarkingInterface::class);
        $variantMarking->expects($this->once())->method('getMinimumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getMaximumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getDynamicFixedPrices')->willReturn(array());
        $variantMarking->expects($this->once())->method('getStaticFixedPrices')->willReturn(array());
        $variantMarking->expects($this->once())->method('getDynamicVariablePriceHolders')->willReturn($dynamicVariablePriceHolders);
        $variantMarking->expects($this->once())->method('getStaticVariablePriceHolders')->willReturn(array());
        $variantMarking->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getMinimumQuantity'),
            $this->equalTo('getMaximumQuantity'),
            $this->equalTo('getDynamicFixedPrices'),
            $this->equalTo('getStaticFixedPrices'),
            $this->equalTo('getDynamicVariablePriceHolders'),
            $this->equalTo('getStaticVariablePriceHolders')
        )));

        $selectedVariantMarking = $this->createMock(SelectedVariantMarking::class);
        $selectedVariantMarking->expects($this->once())->method('getVariantMarking')->willReturn($variantMarking);
        $selectedVariantMarking->expects($this->never())->method($this->logicalNot($this->equalTo('getVariantMarking')));

        $variantMarkingCalculatedPrice = VariantMarkingHelper::getVariantMarkingCalculatedPrice($selectedVariantMarking, array(), $supplierProfile, 1);

        $this->assertTrue($variantMarkingCalculatedPrice->isOnQuote());
    }

    public function testGetVariantMarkingCalculatedPriceWithNonNumericEvaluatedDynamicVariablePriceCalculationValue()
    {
        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->exactly(2))->method('getUniqueId')->willReturn('1');
        $supplierProfile->expects($this->never())->method($this->logicalNot($this->equalTo('getUniqueId')));

        $dynamicVariablePrice = $this->createMock(DynamicVariablePriceInterface::class);
        $dynamicVariablePrice->expects($this->once())->method('getFromQuantity')->willReturn(1);
        $dynamicVariablePrice->expects($this->once())->method('getCalculationValue')->willReturn('"non numeric"');
        $dynamicVariablePrice->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getFromQuantity'),
            $this->equalTo('getCalculationValue')
        )));

        $dynamicVariablePrices = array(
            $dynamicVariablePrice
        );

        $dynamicVariablePriceHolder = $this->createMock(DynamicVariablePriceHolderInterface::class);
        $dynamicVariablePriceHolder->expects($this->once())->method('getCondition')->willReturn(null);
        $dynamicVariablePriceHolder->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
        $dynamicVariablePriceHolder->expects($this->once())->method('getDynamicVariablePrices')->willReturn($dynamicVariablePrices);
        $dynamicVariablePriceHolder->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getCondition'),
            $this->equalTo('getSupplierProfile'),
            $this->equalTo('getDynamicVariablePrices')
        )));

        $dynamicVariablePriceHolders = array(
            $dynamicVariablePriceHolder
        );

        $variantMarking = $this->createMock(VariantMarkingInterface::class);
        $variantMarking->expects($this->once())->method('getMinimumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getMaximumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getDynamicFixedPrices')->willReturn(array());
        $variantMarking->expects($this->once())->method('getStaticFixedPrices')->willReturn(array());
        $variantMarking->expects($this->once())->method('getDynamicVariablePriceHolders')->willReturn($dynamicVariablePriceHolders);
        $variantMarking->expects($this->once())->method('getStaticVariablePriceHolders')->willReturn(array());
        $variantMarking->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getMinimumQuantity'),
            $this->equalTo('getMaximumQuantity'),
            $this->equalTo('getDynamicFixedPrices'),
            $this->equalTo('getStaticFixedPrices'),
            $this->equalTo('getDynamicVariablePriceHolders'),
            $this->equalTo('getStaticVariablePriceHolders')
        )));

        $selectedVariantMarking = $this->createMock(SelectedVariantMarking::class);
        $selectedVariantMarking->expects($this->once())->method('getVariantMarking')->willReturn($variantMarking);
        $selectedVariantMarking->expects($this->never())->method($this->logicalNot($this->equalTo('getVariantMarking')));

        $variantMarkingCalculatedPrice = VariantMarkingHelper::getVariantMarkingCalculatedPrice($selectedVariantMarking, array(), $supplierProfile, 1);

        $this->assertTrue($variantMarkingCalculatedPrice->isOnQuote());
    }

    public function testGetVariantMarkingCalculatedPriceWithTwoStaticVariablePricesThatHaveTheSameFromQuantity()
    {
        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->exactly(2))->method('getUniqueId')->willReturn('1');
        $supplierProfile->expects($this->never())->method($this->logicalNot($this->equalTo('getUniqueId')));

        $staticVariablePrice = $this->createMock(StaticVariablePriceInterface::class);
        $staticVariablePrice->expects($this->exactly(2))->method('getFromQuantity')->willReturn(1);
        $staticVariablePrice->expects($this->never())->method($this->logicalNot($this->equalTo('getFromQuantity')));

        $staticVariablePrice2 = $this->createMock(StaticVariablePriceInterface::class);
        $staticVariablePrice2->expects($this->once())->method('getFromQuantity')->willReturn(1);
        $staticVariablePrice2->expects($this->never())->method($this->logicalNot($this->equalTo('getFromQuantity')));

        $staticVariablePrices = array(
            $staticVariablePrice,
            $staticVariablePrice2
        );

        $staticVariablePriceHolder = $this->createMock(StaticVariablePriceHolderInterface::class);
        $staticVariablePriceHolder->expects($this->once())->method('getCondition')->willReturn(null);
        $staticVariablePriceHolder->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
        $staticVariablePriceHolder->expects($this->once())->method('getStaticVariablePrices')->willReturn($staticVariablePrices);
        $staticVariablePriceHolder->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getCondition'),
            $this->equalTo('getSupplierProfile'),
            $this->equalTo('getStaticVariablePrices')
        )));

        $staticVariablePriceHolders = array(
            $staticVariablePriceHolder
        );

        $variantMarking = $this->createMock(VariantMarkingInterface::class);
        $variantMarking->expects($this->once())->method('getMinimumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getMaximumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getDynamicFixedPrices')->willReturn(array());
        $variantMarking->expects($this->once())->method('getStaticFixedPrices')->willReturn(array());
        $variantMarking->expects($this->once())->method('getDynamicVariablePriceHolders')->willReturn(array());
        $variantMarking->expects($this->once())->method('getStaticVariablePriceHolders')->willReturn($staticVariablePriceHolders);
        $variantMarking->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getMinimumQuantity'),
            $this->equalTo('getMaximumQuantity'),
            $this->equalTo('getDynamicFixedPrices'),
            $this->equalTo('getStaticFixedPrices'),
            $this->equalTo('getDynamicVariablePriceHolders'),
            $this->equalTo('getStaticVariablePriceHolders')
        )));

        $selectedVariantMarking = $this->createMock(SelectedVariantMarking::class);
        $selectedVariantMarking->expects($this->once())->method('getVariantMarking')->willReturn($variantMarking);
        $selectedVariantMarking->expects($this->never())->method($this->logicalNot($this->equalTo('getVariantMarking')));

        $variantMarkingCalculatedPrice = VariantMarkingHelper::getVariantMarkingCalculatedPrice($selectedVariantMarking, array(), $supplierProfile, 1);

        $this->assertTrue($variantMarkingCalculatedPrice->isOnQuote());
    }

    /**
     * @dataProvider provideGetVariantMarkingCalculatedPriceWithVariantMarkingPrices
     */
    public function testGetVariantMarkingCalculatedPriceWithVariantMarkingPrices(array $dynamicFixedPricesData,
        array $staticFixedPricesData, array $dynamicVariablePriceHoldersData, array $staticVariablePriceHoldersData,
        array $variables, $quantity, $expectedAmount, $expectedTotalPrice, array $expectedMarkingFees)
    {
        $dynamicFixedPricesDataCount = count($dynamicFixedPricesData);
        $staticFixedPricesDataCount = count($staticFixedPricesData);
        $dynamicVariablePriceHoldersDataCount = count($dynamicVariablePriceHoldersData);
        $staticVariablePriceHoldersDataCount = count($staticVariablePriceHoldersData);

        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->exactly(2 * ($dynamicFixedPricesDataCount + $staticFixedPricesDataCount + $dynamicVariablePriceHoldersDataCount + $staticVariablePriceHoldersDataCount)))->method('getUniqueId')->willReturn('1');
        $supplierProfile->expects($this->never())->method($this->logicalNot($this->equalTo('getUniqueId')));

        $dynamicFixedPrices = array();
        foreach ($dynamicFixedPricesData as $row) {
            $condition = $row['condition'];
            $calculationValue = $row['calculation_value'];

            $dynamicFixedPrice = $this->createMock(DynamicFixedPriceInterface::class);
            $dynamicFixedPrice->expects($this->once())->method('getCondition')->willReturn($condition);
            $dynamicFixedPrice->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
            if (null !== $calculationValue) {
                $totalPrice = $row['total_price'];
                $markingFees = $row['marking_fees'];

                $dynamicFixedPrice->expects($this->once())->method('getCalculationValue')->willReturn($calculationValue);
                $dynamicFixedPrice->expects($this->once())->method('isTotalPrice')->willReturn($totalPrice);
                $dynamicFixedPrice->expects($this->once())->method('getMarkingFees')->willReturn($markingFees);
                $logicalOr = $this->logicalOr(
                    $this->equalTo('getCondition'),
                    $this->equalTo('getSupplierProfile'),
                    $this->equalTo('getCalculationValue'),
                    $this->equalTo('isTotalPrice'),
                    $this->equalTo('getMarkingFees')
                );
            } else {
                $logicalOr = $this->logicalOr(
                    $this->equalTo('getCondition'),
                    $this->equalTo('getSupplierProfile')
                );
            }

            $dynamicFixedPrice->expects($this->never())->method($this->logicalNot($logicalOr));

            $dynamicFixedPrices[] = $dynamicFixedPrice;
        }

        $staticFixedPrices = array();
        foreach ($staticFixedPricesData as $row) {
            $condition = $row['condition'];
            $calculationValue = $row['calculation_value'];

            $staticFixedPrice = $this->createMock(StaticFixedPriceInterface::class);
            $staticFixedPrice->expects($this->once())->method('getCondition')->willReturn($condition);
            $staticFixedPrice->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
            if (null !== $calculationValue) {
                $totalPrice = $row['total_price'];
                $markingFees = $row['marking_fees'];

                $staticFixedPrice->expects($this->once())->method('getCalculationValue')->willReturn($calculationValue);
                $staticFixedPrice->expects($this->once())->method('isTotalPrice')->willReturn($totalPrice);
                $staticFixedPrice->expects($this->once())->method('getMarkingFees')->willReturn($markingFees);
                $logicalOr = $this->logicalOr(
                    $this->equalTo('getCondition'),
                    $this->equalTo('getSupplierProfile'),
                    $this->equalTo('getCalculationValue'),
                    $this->equalTo('isTotalPrice'),
                    $this->equalTo('getMarkingFees')
                );
            } else {
                $logicalOr = $this->logicalOr(
                    $this->equalTo('getCondition'),
                    $this->equalTo('getSupplierProfile')
                );
            }

            $staticFixedPrice->expects($this->never())->method($this->logicalNot($logicalOr));

            $staticFixedPrices[] = $staticFixedPrice;
        }

        $dynamicVariablePriceHolders = array();
        foreach ($dynamicVariablePriceHoldersData as $row) {
            $condition = $row['condition'];
            $dynamicVariablePricesData = $row['dynamic_variable_prices_data'];

            $dynamicVariablePriceHolder = $this->createMock(DynamicVariablePriceHolderInterface::class);
            $dynamicVariablePriceHolder->expects($this->once())->method('getCondition')->willReturn($condition);
            $dynamicVariablePriceHolder->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
            if (!empty($dynamicVariablePricesData)) {
                $totalPrice = $row['total_price'];
                $markingFees = $row['marking_fees'];

                $dynamicVariablePrices = array();
                $dynamicVariablePricesDataCount = count($dynamicVariablePricesData);
                foreach ($dynamicVariablePricesData as $row2) {
                    $fromQuantity = $row2['from_quantity'];
                    $calculationValue = $row2['calculation_value'];

                    $dynamicVariablePrice = $this->createMock(DynamicVariablePriceInterface::class);
                    $dynamicVariablePrice->expects($this->atMost($dynamicVariablePricesDataCount))->method('getFromQuantity')->willReturn($fromQuantity);
                    if (null !== $calculationValue) {
                        $dynamicVariablePrice->expects($this->once())->method('getCalculationValue')->willReturn($calculationValue);
                        $logicalOr = $this->logicalOr(
                            $this->equalTo('getFromQuantity'),
                            $this->equalTo('getCalculationValue')
                        );
                    } else {
                        $logicalOr = $this->equalTo('getFromQuantity');
                    }

                    $dynamicVariablePrice->expects($this->never())->method($this->logicalNot($logicalOr));

                    $dynamicVariablePrices[] = $dynamicVariablePrice;
                }

                $dynamicVariablePriceHolder->expects($this->once())->method('getDynamicVariablePrices')->willReturn($dynamicVariablePrices);
                $dynamicVariablePriceHolder->expects($this->once())->method('isTotalPrice')->willReturn($totalPrice);
                $dynamicVariablePriceHolder->expects($this->once())->method('getMarkingFees')->willReturn($markingFees);
                $logicalOr = $this->logicalOr(
                    $this->equalTo('getCondition'),
                    $this->equalTo('getSupplierProfile'),
                    $this->equalTo('getDynamicVariablePrices'),
                    $this->equalTo('isTotalPrice'),
                    $this->equalTo('getMarkingFees')
                );
            } else {
                $logicalOr = $this->logicalOr(
                    $this->equalTo('getCondition'),
                    $this->equalTo('getSupplierProfile')
                );
            }

            $dynamicVariablePriceHolder->expects($this->never())->method($this->logicalNot($logicalOr));

            $dynamicVariablePriceHolders[] = $dynamicVariablePriceHolder;
        }

        $staticVariablePriceHolders = array();
        foreach ($staticVariablePriceHoldersData as $row) {
            $condition = $row['condition'];
            $staticVariablePricesData = $row['static_variable_prices_data'];

            $staticVariablePriceHolder = $this->createMock(StaticVariablePriceHolderInterface::class);
            $staticVariablePriceHolder->expects($this->once())->method('getCondition')->willReturn($condition);
            $staticVariablePriceHolder->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
            if (!empty($staticVariablePricesData)) {
                $totalPrice = $row['total_price'];
                $markingFees = $row['marking_fees'];

                $staticVariablePrices = array();
                $staticVariablePricesDataCount = count($staticVariablePricesData);
                foreach ($staticVariablePricesData as $row2) {
                    $fromQuantity = $row2['from_quantity'];
                    $calculationValue = $row2['calculation_value'];

                    $staticVariablePrice = $this->createMock(StaticVariablePriceInterface::class);
                    $staticVariablePrice->expects($this->atMost($staticVariablePricesDataCount))->method('getFromQuantity')->willReturn($fromQuantity);
                    if (null !== $calculationValue) {
                        $staticVariablePrice->expects($this->once())->method('getCalculationValue')->willReturn($calculationValue);
                        $logicalOr = $this->logicalOr(
                            $this->equalTo('getFromQuantity'),
                            $this->equalTo('getCalculationValue')
                        );
                    } else {
                        $logicalOr = $this->equalTo('getFromQuantity');
                    }

                    $staticVariablePrice->expects($this->never())->method($this->logicalNot($logicalOr));

                    $staticVariablePrices[] = $staticVariablePrice;
                }

                $staticVariablePriceHolder->expects($this->once())->method('getStaticVariablePrices')->willReturn($staticVariablePrices);
                $staticVariablePriceHolder->expects($this->once())->method('isTotalPrice')->willReturn($totalPrice);
                $staticVariablePriceHolder->expects($this->once())->method('getMarkingFees')->willReturn($markingFees);
                $logicalOr = $this->logicalOr(
                    $this->equalTo('getCondition'),
                    $this->equalTo('getSupplierProfile'),
                    $this->equalTo('getStaticVariablePrices'),
                    $this->equalTo('isTotalPrice'),
                    $this->equalTo('getMarkingFees')
                );
            } else {
                $logicalOr = $this->logicalOr(
                    $this->equalTo('getCondition'),
                    $this->equalTo('getSupplierProfile')
                );
            }

            $staticVariablePriceHolder->expects($this->never())->method($this->logicalNot($logicalOr));

            $staticVariablePriceHolders[] = $staticVariablePriceHolder;
        }

        $variantMarking = $this->createMock(VariantMarkingInterface::class);
        $variantMarking->expects($this->once())->method('getMinimumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getMaximumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getDynamicFixedPrices')->willReturn($dynamicFixedPrices);
        $variantMarking->expects($this->once())->method('getStaticFixedPrices')->willReturn($staticFixedPrices);
        $variantMarking->expects($this->once())->method('getDynamicVariablePriceHolders')->willReturn($dynamicVariablePriceHolders);
        $variantMarking->expects($this->once())->method('getStaticVariablePriceHolders')->willReturn($staticVariablePriceHolders);
        $variantMarking->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getMinimumQuantity'),
            $this->equalTo('getMaximumQuantity'),
            $this->equalTo('getDynamicFixedPrices'),
            $this->equalTo('getStaticFixedPrices'),
            $this->equalTo('getDynamicVariablePriceHolders'),
            $this->equalTo('getStaticVariablePriceHolders')
        )));

        $selectedVariantMarking = $this->createMock(SelectedVariantMarking::class);
        $selectedVariantMarking->expects($this->once())->method('getVariantMarking')->willReturn($variantMarking);
        $selectedVariantMarking->expects($this->never())->method($this->logicalNot($this->equalTo('getVariantMarking')));

        $variantMarkingCalculatedPrice = VariantMarkingHelper::getVariantMarkingCalculatedPrice($selectedVariantMarking, $variables, $supplierProfile, $quantity);

        $this->assertFalse($variantMarkingCalculatedPrice->isOnQuote());
        $this->assertSame($expectedAmount, $variantMarkingCalculatedPrice->getAmount());
        $this->assertSame($expectedTotalPrice, $variantMarkingCalculatedPrice->isTotalPrice());
        $this->assertSame($expectedMarkingFees, $variantMarkingCalculatedPrice->getMarkingFees());
    }

    /**
     * @return array
     */
    public function provideGetVariantMarkingCalculatedPriceWithVariantMarkingPrices()
    {
        return array(
            array(
                'dynamic_fixed_prices_data' => array(
                    array(
                        'condition' => null,
                        'calculation_value' => '1.0',
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'static_fixed_prices_data' => array(),
                'dynamic_variable_price_holders_data' => array(),
                'static_variable_price_holders_data' => array(),
                'variables' => array(),
                'quantity' => 10,
                'expected_amount' => '1000',
                'expected_total_price' => false,
                'expected_marking_fees' => array()
            ),
            array(
                'dynamic_fixed_prices_data' => array(
                    array(
                        'condition' => null,
                        'calculation_value' => '3',
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'static_fixed_prices_data' => array(),
                'dynamic_variable_price_holders_data' => array(),
                'static_variable_price_holders_data' => array(),
                'variables' => array(),
                'quantity' => 10,
                'expected_amount' => '3000',
                'expected_total_price' => false,
                'expected_marking_fees' => array()
            ),
            array(
                'dynamic_fixed_prices_data' => array(
                    array(
                        'condition' => null,
                        'calculation_value' => '5.678',
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'static_fixed_prices_data' => array(),
                'dynamic_variable_price_holders_data' => array(),
                'static_variable_price_holders_data' => array(),
                'variables' => array(),
                'quantity' => 10,
                'expected_amount' => '5678',
                'expected_total_price' => false,
                'expected_marking_fees' => array()
            ),
            array(
                'dynamic_fixed_prices_data' => array(),
                'static_fixed_prices_data' => array(
                    array(
                        'condition' => null,
                        'calculation_value' => Money::EUR(7000),
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'dynamic_variable_price_holders_data' => array(),
                'static_variable_price_holders_data' => array(),
                'variables' => array(),
                'quantity' => 10,
                'expected_amount' => '7000',
                'expected_total_price' => false,
                'expected_marking_fees' => array()
            ),
            array(
                'dynamic_fixed_prices_data' => array(),
                'static_fixed_prices_data' => array(
                    array(
                        'condition' => null,
                        'calculation_value' => 9.0,
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'dynamic_variable_price_holders_data' => array(),
                'static_variable_price_holders_data' => array(),
                'variables' => array(),
                'quantity' => 10,
                'expected_amount' => '9000',
                'expected_total_price' => false,
                'expected_marking_fees' => array()
            ),
            array(
                'dynamic_fixed_prices_data' => array(),
                'static_fixed_prices_data' => array(
                    array(
                        'condition' => null,
                        'calculation_value' => '11.0',
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'dynamic_variable_price_holders_data' => array(),
                'static_variable_price_holders_data' => array(),
                'variables' => array(),
                'quantity' => 10,
                'expected_amount' => '11000',
                'expected_total_price' => false,
                'expected_marking_fees' => array()
            ),
            array(
                'dynamic_fixed_prices_data' => array(),
                'static_fixed_prices_data' => array(
                    array(
                        'condition' => null,
                        'calculation_value' => '13',
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'dynamic_variable_price_holders_data' => array(),
                'static_variable_price_holders_data' => array(),
                'variables' => array(),
                'quantity' => 10,
                'expected_amount' => '13000',
                'expected_total_price' => false,
                'expected_marking_fees' => array()
            ),
            array(
                'dynamic_fixed_prices_data' => array(),
                'static_fixed_prices_data' => array(
                    array(
                        'condition' => null,
                        'calculation_value' => 15.678,
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'dynamic_variable_price_holders_data' => array(),
                'static_variable_price_holders_data' => array(),
                'variables' => array(),
                'quantity' => 10,
                'expected_amount' => '15678',
                'expected_total_price' => false,
                'expected_marking_fees' => array()
            ),
            array(
                'dynamic_fixed_prices_data' => array(),
                'static_fixed_prices_data' => array(
                    array(
                        'condition' => null,
                        'calculation_value' => '17.890',
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'dynamic_variable_price_holders_data' => array(),
                'static_variable_price_holders_data' => array(),
                'variables' => array(),
                'quantity' => 10,
                'expected_amount' => '17890',
                'expected_total_price' => false,
                'expected_marking_fees' => array()
            ),
            array(
                'dynamic_fixed_prices_data' => array(),
                'static_fixed_prices_data' => array(),
                'dynamic_variable_price_holders_data' => array(
                    array(
                        'condition' => null,
                        'dynamic_variable_prices_data' => array(
                            array(
                                'from_quantity' => 1,
                                'calculation_value' => '19.0'
                            )
                        ),
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'static_variable_price_holders_data' => array(),
                'variables' => array(),
                'quantity' => 1,
                'expected_amount' => '19000',
                'expected_total_price' => false,
                'expected_marking_fees' => array()
            ),
            array(
                'dynamic_fixed_prices_data' => array(),
                'static_fixed_prices_data' => array(),
                'dynamic_variable_price_holders_data' => array(
                    array(
                        'condition' => null,
                        'dynamic_variable_prices_data' => array(
                            array(
                                'from_quantity' => 1,
                                'calculation_value' => '21'
                            )
                        ),
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'static_variable_price_holders_data' => array(),
                'variables' => array(),
                'quantity' => 1,
                'expected_amount' => '21000',
                'expected_total_price' => false,
                'expected_marking_fees' => array()
            ),
            array(
                'dynamic_fixed_prices_data' => array(),
                'static_fixed_prices_data' => array(),
                'dynamic_variable_price_holders_data' => array(
                    array(
                        'condition' => null,
                        'dynamic_variable_prices_data' => array(
                            array(
                                'from_quantity' => 1,
                                'calculation_value' => '23.456'
                            )
                        ),
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'static_variable_price_holders_data' => array(),
                'variables' => array(),
                'quantity' => 1,
                'expected_amount' => '23456',
                'expected_total_price' => false,
                'expected_marking_fees' => array()
            ),
            array(
                'dynamic_fixed_prices_data' => array(),
                'static_fixed_prices_data' => array(),
                'dynamic_variable_price_holders_data' => array(),
                'static_variable_price_holders_data' => array(
                    array(
                        'condition' => null,
                        'static_variable_prices_data' => array(
                            array(
                                'from_quantity' => 1,
                                'calculation_value' => Money::EUR(25000)
                            )
                        ),
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'variables' => array(),
                'quantity' => 1,
                'expected_amount' => '25000',
                'expected_total_price' => false,
                'expected_marking_fees' => array()
            ),
            array(
                'dynamic_fixed_prices_data' => array(),
                'static_fixed_prices_data' => array(),
                'dynamic_variable_price_holders_data' => array(),
                'static_variable_price_holders_data' => array(
                    array(
                        'condition' => null,
                        'static_variable_prices_data' => array(
                            array(
                                'from_quantity' => 1,
                                'calculation_value' => 27.0
                            )
                        ),
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'variables' => array(),
                'quantity' => 1,
                'expected_amount' => '27000',
                'expected_total_price' => false,
                'expected_marking_fees' => array()
            ),
            array(
                'dynamic_fixed_prices_data' => array(),
                'static_fixed_prices_data' => array(),
                'dynamic_variable_price_holders_data' => array(),
                'static_variable_price_holders_data' => array(
                    array(
                        'condition' => null,
                        'static_variable_prices_data' => array(
                            array(
                                'from_quantity' => 1,
                                'calculation_value' => '29.0'
                            )
                        ),
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'variables' => array(),
                'quantity' => 1,
                'expected_amount' => '29000',
                'expected_total_price' => false,
                'expected_marking_fees' => array()
            ),
            array(
                'dynamic_fixed_prices_data' => array(),
                'static_fixed_prices_data' => array(),
                'dynamic_variable_price_holders_data' => array(),
                'static_variable_price_holders_data' => array(
                    array(
                        'condition' => null,
                        'static_variable_prices_data' => array(
                            array(
                                'from_quantity' => 1,
                                'calculation_value' => '31'
                            )
                        ),
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'variables' => array(),
                'quantity' => 1,
                'expected_amount' => '31000',
                'expected_total_price' => false,
                'expected_marking_fees' => array()
            ),
            array(
                'dynamic_fixed_prices_data' => array(),
                'static_fixed_prices_data' => array(),
                'dynamic_variable_price_holders_data' => array(),
                'static_variable_price_holders_data' => array(
                    array(
                        'condition' => null,
                        'static_variable_prices_data' => array(
                            array(
                                'from_quantity' => 1,
                                'calculation_value' => 33.456
                            )
                        ),
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'variables' => array(),
                'quantity' => 1,
                'expected_amount' => '33456',
                'expected_total_price' => false,
                'expected_marking_fees' => array()
            ),
            array(
                'dynamic_fixed_prices_data' => array(),
                'static_fixed_prices_data' => array(),
                'dynamic_variable_price_holders_data' => array(),
                'static_variable_price_holders_data' => array(
                    array(
                        'condition' => null,
                        'static_variable_prices_data' => array(
                            array(
                                'from_quantity' => 1,
                                'calculation_value' => '35.678'
                            )
                        ),
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'variables' => array(),
                'quantity' => 1,
                'expected_amount' => '35678',
                'expected_total_price' => false,
                'expected_marking_fees' => array()
            ),
            array(
                'dynamic_fixed_prices_data' => array(
                    array(
                        'condition' => null,
                        'calculation_value' => 'nb_couleurs * 3',
                        'total_price' => true,
                        'marking_fees' => array()
                    )
                ),
                'static_fixed_prices_data' => array(
                    array(
                        'condition' => null,
                        'calculation_value' => '10',
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'dynamic_variable_price_holders_data' => array(),
                'static_variable_price_holders_data' => array(),
                'variables' => array(
                    'nb_couleurs' => 2
                ),
                'quantity' => 10,
                'expected_amount' => '16000',
                'expected_total_price' => true,
                'expected_marking_fees' => array()
            ),
            array(
                'dynamic_fixed_prices_data' => array(),
                'static_fixed_prices_data' => array(),
                'dynamic_variable_price_holders_data' => array(
                    array(
                        'condition' => null,
                        'dynamic_variable_prices_data' => array(
                            array(
                                'from_quantity' => 1,
                                'calculation_value' => null
                            ),
                            array(
                                'from_quantity' => 100,
                                'calculation_value' => 'quantity * nb_couleurs * 5 / 2'
                            ),
                            array(
                                'from_quantity' => 500,
                                'calculation_value' => null
                            )
                        ),
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'static_variable_price_holders_data' => array(
                    array(
                        'condition' => 'nb_couleurs < 8',
                        'static_variable_prices_data' => array(),
                        'total_price' => false,
                        'marking_fees' => array()
                    ),
                    array(
                        'condition' => 'nb_couleurs > 8',
                        'static_variable_prices_data' => array(
                            array(
                                'from_quantity' => 1,
                                'calculation_value' => null
                            ),
                            array(
                                'from_quantity' => 50,
                                'calculation_value' => null
                            ),
                            array(
                                'from_quantity' => 100,
                                'calculation_value' => '1.458'
                            )
                        ),
                        'total_price' => false,
                        'marking_fees' => array()
                    )
                ),
                'variables' => array(
                    'nb_couleurs' => 10,
                    'quantity' => 200
                ),
                'quantity' => 200,
                'expected_amount' => '5291600',
                'expected_total_price' => false,
                'expected_marking_fees' => array()
            )
        );
    }

    public function testGetVariantMarkingCalculatedPriceWithIncludedInVariantPricesAndPerfectOptionsMatches()
    {
        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->never())->method($this->anything());

        $variantMarking = $this->createMock(VariantMarkingInterface::class);
        $variantMarking->expects($this->once())->method('getMinimumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getMaximumQuantity')->willReturn(null);
        $variantMarking->expects($this->once())->method('getDynamicFixedPrices')->willReturn(array());
        $variantMarking->expects($this->once())->method('getStaticFixedPrices')->willReturn(array());
        $variantMarking->expects($this->once())->method('getDynamicVariablePriceHolders')->willReturn(array());
        $variantMarking->expects($this->once())->method('getStaticVariablePriceHolders')->willReturn(array());
        $variantMarking->expects($this->once())->method('isIncludedInVariantPrices')->willReturn(true);
        $variantMarking->expects($this->once())->method('getLength')->willReturn('200');
        $variantMarking->expects($this->once())->method('getWidth')->willReturn(null);
        $variantMarking->expects($this->once())->method('getSquaredSize')->willReturn(null);
        $variantMarking->expects($this->once())->method('getDiameter')->willReturn(null);
        $variantMarking->expects($this->once())->method('getNumberOfColors')->willReturn(2);
        $variantMarking->expects($this->once())->method('getNumberOfPositions')->willReturn(null);
        $variantMarking->expects($this->once())->method('getNumberOfLogos')->willReturn(null);
        $variantMarking->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getMinimumQuantity'),
            $this->equalTo('getMaximumQuantity'),
            $this->equalTo('getDynamicFixedPrices'),
            $this->equalTo('getStaticFixedPrices'),
            $this->equalTo('getDynamicVariablePriceHolders'),
            $this->equalTo('getStaticVariablePriceHolders'),
            $this->equalTo('isIncludedInVariantPrices'),
            $this->equalTo('getLength'),
            $this->equalTo('getWidth'),
            $this->equalTo('getSquaredSize'),
            $this->equalTo('getDiameter'),
            $this->equalTo('getNumberOfColors'),
            $this->equalTo('getNumberOfPositions'),
            $this->equalTo('getNumberOfLogos')
        )));

        $selectedVariantMarking = $this->createMock(SelectedVariantMarking::class);
        $selectedVariantMarking->expects($this->once())->method('getVariantMarking')->willReturn($variantMarking);
        $selectedVariantMarking->expects($this->once())->method('getLength')->willReturn('200');
        $selectedVariantMarking->expects($this->once())->method('getWidth')->willReturn(null);
        $selectedVariantMarking->expects($this->once())->method('getSquaredSize')->willReturn(null);
        $selectedVariantMarking->expects($this->once())->method('getDiameter')->willReturn(null);
        $selectedVariantMarking->expects($this->once())->method('getNumberOfColors')->willReturn(2);
        $selectedVariantMarking->expects($this->once())->method('getNumberOfPositions')->willReturn(null);
        $selectedVariantMarking->expects($this->once())->method('getNumberOfLogos')->willReturn(null);
        $selectedVariantMarking->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getVariantMarking'),
            $this->equalTo('getLength'),
            $this->equalTo('getWidth'),
            $this->equalTo('getSquaredSize'),
            $this->equalTo('getDiameter'),
            $this->equalTo('getNumberOfColors'),
            $this->equalTo('getNumberOfPositions'),
            $this->equalTo('getNumberOfLogos')
        )));

        $variantMarkingCalculatedPrice = VariantMarkingHelper::getVariantMarkingCalculatedPrice($selectedVariantMarking, array(), $supplierProfile, 1);

        $this->assertFalse($variantMarkingCalculatedPrice->isOnQuote());
    }
}
