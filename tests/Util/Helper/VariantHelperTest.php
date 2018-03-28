<?php

namespace Tests\Util\Helper;

use ES\RebirthApiClient\Util\Helper\VariantHelper;
use ES\RebirthCommon\VariantInterface;
use ES\RebirthCommon\SupplierProfileInterface;
use ES\RebirthCommon\VariantMinimumQuantityInterface;
use ES\RebirthCommon\VariantPriceInterface;
use Money\Money;
use PHPUnit\Framework\TestCase;

class VariantHelperTest extends TestCase
{
    /**
     * @dataProvider provideGetCalculatedPriceInvalidQuantity
     */
    public function testGetCalculatedPriceWithInvalidQuantity($quantity)
    {
        $variant = $this->createMock(VariantInterface::class);
        $variant->expects($this->never())->method($this->anything());

        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->never())->method($this->anything());

        $calculatedPrice = VariantHelper::getCalculatedPrice($variant, $supplierProfile, $quantity, array());

        $this->assertTrue($calculatedPrice->isOnQuote());
    }

    /**
     * @return array
     */
    public function provideGetCalculatedPriceInvalidQuantity()
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

    public function testGetCalculatedPriceWithTooLowQuantity()
    {
        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->exactly(2))->method('getUniqueId')->willReturn('1');
        $supplierProfile->expects($this->never())->method($this->logicalNot($this->equalTo('getUniqueId')));

        $variantMinimumQuantity = $this->createMock(VariantMinimumQuantityInterface::class);
        $variantMinimumQuantity->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
        $variantMinimumQuantity->expects($this->once())->method('getValue')->willReturn(2);
        $variantMinimumQuantity->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getSupplierProfile'),
            $this->equalTo('getValue')
        )));

        $variantMinimumQuantities = array(
            $variantMinimumQuantity
        );

        $variant = $this->createMock(VariantInterface::class);
        $variant->expects($this->once())->method('getVariantMinimumQuantities')->willReturn($variantMinimumQuantities);
        $variant->expects($this->never())->method($this->logicalNot($this->equalTo('getVariantMinimumQuantities')));

        $calculatedPrice = VariantHelper::getCalculatedPrice($variant, $supplierProfile, 1, array());

        $this->assertTrue($calculatedPrice->isOnQuote());
    }

    public function testGetCalculatedPriceWithMandatoryMarkingAndNoSelectedVariantMarkings()
    {
        $variant = $this->createMock(VariantInterface::class);
        $variant->expects($this->once())->method('getVariantMinimumQuantities')->willReturn(array());
        $variant->expects($this->once())->method('isMandatoryMarking')->willReturn(true);
        $variant->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getVariantMinimumQuantities'),
            $this->equalTo('isMandatoryMarking')
        )));

        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->never())->method($this->anything());

        $calculatedPrice = VariantHelper::getCalculatedPrice($variant, $supplierProfile, 1, array());

        $this->assertTrue($calculatedPrice->isOnQuote());
    }

    public function testGetCalculatedPriceWithNoVariantPrices()
    {
        $variant = $this->createMock(VariantInterface::class);
        $variant->expects($this->once())->method('getVariantMinimumQuantities')->willReturn(array());
        $variant->expects($this->once())->method('isMandatoryMarking')->willReturn(false);
        $variant->expects($this->once())->method('getVariantPrices')->willReturn(array());
        $variant->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getVariantMinimumQuantities'),
            $this->equalTo('isMandatoryMarking'),
            $this->equalTo('getVariantPrices')
        )));

        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->never())->method($this->anything());

        $calculatedPrice = VariantHelper::getCalculatedPrice($variant, $supplierProfile, 1, array());

        $this->assertTrue($calculatedPrice->isOnQuote());
    }

    public function testGetCalculatedPriceWithNoMatchingVariantPrice()
    {
        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->once())->method('getUniqueId')->willReturn('1');
        $supplierProfile->expects($this->never())->method($this->logicalNot($this->equalTo('getUniqueId')));

        $variantPrice = $this->createMock(VariantPriceInterface::class);
        $variantPrice->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
        $variantPrice->expects($this->never())->method($this->logicalNot($this->equalTo('getSupplierProfile')));

        $variantPrices = array(
            $variantPrice
        );

        $variant = $this->createMock(VariantInterface::class);
        $variant->expects($this->once())->method('getVariantMinimumQuantities')->willReturn(array());
        $variant->expects($this->once())->method('isMandatoryMarking')->willReturn(false);
        $variant->expects($this->once())->method('getVariantPrices')->willReturn($variantPrices);
        $variant->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getVariantMinimumQuantities'),
            $this->equalTo('isMandatoryMarking'),
            $this->equalTo('getVariantPrices')
        )));

        $supplierProfile2 = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile2->expects($this->once())->method('getUniqueId')->willReturn('2');
        $supplierProfile2->expects($this->never())->method($this->logicalNot($this->equalTo('getUniqueId')));

        $calculatedPrice = VariantHelper::getCalculatedPrice($variant, $supplierProfile2, 1, array());

        $this->assertTrue($calculatedPrice->isOnQuote());
    }

    public function testGetCalculatedPriceWithTwoVariantPricesThatHaveTheSameFromQuantity()
    {
        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->exactly(4))->method('getUniqueId')->willReturn('1');
        $supplierProfile->expects($this->never())->method($this->logicalNot($this->equalTo('getUniqueId')));

        $variantPrice = $this->createMock(VariantPriceInterface::class);
        $variantPrice->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
        $variantPrice->expects($this->exactly(2))->method('getFromQuantity')->willReturn(1);
        $variantPrice->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getSupplierProfile'),
            $this->equalTo('getFromQuantity')
        )));

        $variantPrice2 = $this->createMock(VariantPriceInterface::class);
        $variantPrice2->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
        $variantPrice2->expects($this->exactly(2))->method('getFromQuantity')->willReturn(1);
        $variantPrice2->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getSupplierProfile'),
            $this->equalTo('getFromQuantity')
        )));

        $variantPrices = array(
            $variantPrice,
            $variantPrice2
        );

        $variant = $this->createMock(VariantInterface::class);
        $variant->expects($this->once())->method('getVariantMinimumQuantities')->willReturn(array());
        $variant->expects($this->once())->method('isMandatoryMarking')->willReturn(false);
        $variant->expects($this->once())->method('getVariantPrices')->willReturn($variantPrices);
        $variant->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getVariantMinimumQuantities'),
            $this->equalTo('isMandatoryMarking'),
            $this->equalTo('getVariantPrices')
        )));

        $calculatedPrice = VariantHelper::getCalculatedPrice($variant, $supplierProfile, 1, array());

        $this->assertTrue($calculatedPrice->isOnQuote());
    }

    /**
     * @dataProvider provideGetCalculatedPriceWithFinalAmountInferiorOrEqualsToZero
     */
    public function testGetCalculatedPriceWithFinalAmountInferiorOrEqualsToZero($calculationValue)
    {
        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->exactly(2))->method('getUniqueId')->willReturn('1');
        $supplierProfile->expects($this->never())->method($this->logicalNot($this->equalTo('getUniqueId')));

        $variantPrice = $this->createMock(VariantPriceInterface::class);
        $variantPrice->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
        $variantPrice->expects($this->once())->method('getFromQuantity')->willReturn(1);
        $variantPrice->expects($this->once())->method('getCalculationValue')->willReturn($calculationValue);
        $variantPrice->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getSupplierProfile'),
            $this->equalTo('getFromQuantity'),
            $this->equalTo('getCalculationValue')
        )));


        $variantPrices = array(
            $variantPrice
        );

        $variant = $this->createMock(VariantInterface::class);
        $variant->expects($this->once())->method('getVariantMinimumQuantities')->willReturn(array());
        $variant->expects($this->once())->method('isMandatoryMarking')->willReturn(false);
        $variant->expects($this->once())->method('getVariantPrices')->willReturn($variantPrices);
        $variant->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getVariantMinimumQuantities'),
            $this->equalTo('isMandatoryMarking'),
            $this->equalTo('getVariantPrices')
        )));

        $calculatedPrice = VariantHelper::getCalculatedPrice($variant, $supplierProfile, 1, array());

        $this->assertTrue($calculatedPrice->isOnQuote());
    }

    /**
     * @return array
     */
    public function provideGetCalculatedPriceWithFinalAmountInferiorOrEqualsToZero()
    {
        return array(
            array(Money::EUR(-1)),
            array(Money::EUR(0)),
            array(-1.0),
            array('-1.0'),
            array('-1'),
            array(-1.234),
            array('-1.234'),
            array(0.0),
            array('0.0'),
            array('0'),
        );
    }

    /**
     * @dataProvider provideGetCalculatedPriceWithVariantPrices
     */
    public function testGetCalculatedPriceWithVariantPrices(array $variantPricesData, $quantity, $expectedAmount)
    {
        $variantPricesDataCount = count($variantPricesData);

        $supplierProfile = $this->createMock(SupplierProfileInterface::class);
        $supplierProfile->expects($this->exactly(2 * $variantPricesDataCount))->method('getUniqueId')->willReturn('1');
        $supplierProfile->expects($this->never())->method($this->logicalNot($this->equalTo('getUniqueId')));

        foreach ($variantPricesData as $row) {
            $fromQuantity = $row['from_quantity'];
            $calculationValue = $row['calculation_value'];

            $variantPrice = $this->createMock(VariantPriceInterface::class);
            $variantPrice->expects($this->once())->method('getSupplierProfile')->willReturn($supplierProfile);
            $variantPrice->expects($this->atMost($variantPricesDataCount))->method('getFromQuantity')->willReturn($fromQuantity);
            if (null !== $calculationValue) {
                $variantPrice->expects($this->once())->method('getCalculationValue')->willReturn($calculationValue);
                $logicalOr = $this->logicalOr(
                    $this->equalTo('getSupplierProfile'),
                    $this->equalTo('getFromQuantity'),
                    $this->equalTo('getCalculationValue')
                );
            } else {
                $logicalOr = $this->logicalOr(
                    $this->equalTo('getSupplierProfile'),
                    $this->equalTo('getFromQuantity')
                );
            }

            $variantPrice->expects($this->never())->method($this->logicalNot($logicalOr));

            $variantPrices[] = $variantPrice;
        }

        $variant = $this->createMock(VariantInterface::class);
        $variant->expects($this->once())->method('getVariantMinimumQuantities')->willReturn(array());
        $variant->expects($this->once())->method('isMandatoryMarking')->willReturn(false);
        $variant->expects($this->once())->method('getVariantPrices')->willReturn($variantPrices);
        $variant->expects($this->never())->method($this->logicalNot($this->logicalOr(
            $this->equalTo('getVariantMinimumQuantities'),
            $this->equalTo('isMandatoryMarking'),
            $this->equalTo('getVariantPrices')
        )));

        $calculatedPrice = VariantHelper::getCalculatedPrice($variant, $supplierProfile, $quantity, array());

        $this->assertFalse($calculatedPrice->isOnQuote());
        $this->assertSame($expectedAmount, $calculatedPrice->getAmount());
    }

    /**
     * @return array
     */
    public function provideGetCalculatedPriceWithVariantPrices()
    {
        return array(
            array(
                'variant_prices_data' => array(
                    array(
                        'from_quantity' => 1,
                        'calculation_value' => Money::EUR(1000)
                    )
                ),
                'quantity' => 1,
                'expected_amount' => '1000'
            ),
            array(
                'variant_prices_data' => array(
                    array(
                        'from_quantity' => 1,
                        'calculation_value' => 3.0
                    )
                ),
                'quantity' => 1,
                'expected_amount' => '3000'
            ),
            array(
                'variant_prices_data' => array(
                    array(
                        'from_quantity' => 1,
                        'calculation_value' => '5.0'
                    )
                ),
                'quantity' => 1,
                'expected_amount' => '5000'
            ),
            array(
                'variant_prices_data' => array(
                    array(
                        'from_quantity' => 1,
                        'calculation_value' => '7'
                    )
                ),
                'quantity' => 1,
                'expected_amount' => '7000'
            ),
            array(
                'variant_prices_data' => array(
                    array(
                        'from_quantity' => 1,
                        'calculation_value' => 9.012
                    )
                ),
                'quantity' => 1,
                'expected_amount' => '9012'
            ),
            array(
                'variant_prices_data' => array(
                    array(
                        'from_quantity' => 1,
                        'calculation_value' => '11.234'
                    )
                ),
                'quantity' => 1,
                'expected_amount' => '11234'
            ),
            array(
                'variant_prices_data' => array(
                    array(
                        'from_quantity' => 1,
                        'calculation_value' => null
                    ),
                    array(
                        'from_quantity' => 50,
                        'calculation_value' => '1'
                    ),
                    array(
                        'from_quantity' => 200,
                        'calculation_value' => null
                    )
                ),
                'quantity' => 100,
                'expected_amount' => '100000'
            )
        );
    }
}
