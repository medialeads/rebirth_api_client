<?php

namespace ES\RebirthApiClient\Util\Helper;

use ES\RebirthApiClient\Exception\NotImplementedException;
use ES\RebirthApiClient\Util\Model\TrueProcessedVariantMarkingOption;
use ES\RebirthApiClient\Util\Model\CalculatedPrice;
use ES\RebirthApiClient\Util\Model\MarkingPositionProcessedVariantMarkingOption;
use ES\RebirthApiClient\Util\Model\MarkingProcessedVariantMarkingOption;
use ES\RebirthApiClient\Util\Model\ProcessedVariantMarkingOptionInterface;
use ES\RebirthApiClient\Util\Model\SelectedVariantMarking;
use ES\RebirthApiClient\Util\Model\SimpleFixedProcessedVariantMarkingOption;
use ES\RebirthApiClient\Util\Model\SimpleVariableProcessedVariantMarkingOption;
use ES\RebirthApiClient\Util\Model\VariantMarkingCalculatedPrice;
use ES\RebirthCommon\MarkingPositionInterface;
use ES\RebirthCommon\SupplierMarkingInterface;
use ES\RebirthCommon\SupplierProfileInterface;
use ES\RebirthCommon\VariantInterface;
use ES\RebirthCommon\VariantMarkingOptionsInterface;
use ES\RebirthCommon\VariantPriceInterface;
use Fhaculty\Graph\Graph;
use Fhaculty\Graph\Vertex;
use Graphp\GraphViz\GraphViz;
use Money\Money;

class VariantHelper
{
    /**
     * @var string
     */
    const GRAPH_START_VERTEX_ID = 'start';

    /**
     * @var string
     */
    const GRAPH_END_VERTEX_ID = 'end';

    /**
     * @param VariantInterface $variant
     * @param array $variantMarkingOptionsOrder
     *
     * @return array
     */
    public static function getVariantMarkingsData(VariantInterface $variant, array $variantMarkingOptionsOrder = array())
    {
        $data = array();

        $allVariantMarkingsOptionsStack = array();

        foreach ($variant->getVariantMarkings() as $variantMarking) {
            $variantMarkingOptionsStack = array(
                VariantMarkingOptionsInterface::MARKING => new MarkingProcessedVariantMarkingOption($variantMarking->getMarking(), $variantMarking->getSupplierMarking())
            );

            $minimumLength = $variantMarking->getMinimumLength();
            $maximumLength = $variantMarking->getMaximumLength();
            $freeEntryLength = $variantMarking->isFreeEntryLength();
            if ($freeEntryLength || null !== $minimumLength || null !== $maximumLength) {
                if (null !== $minimumLength && $minimumLength === $maximumLength) {
                    $variantMarkingOptionsStack[VariantMarkingOptionsInterface::LENGTH] = new SimpleFixedProcessedVariantMarkingOption(VariantMarkingOptionsInterface::LENGTH, (string) $minimumLength);
                } else {
                    $variantMarkingOptionsStack[VariantMarkingOptionsInterface::LENGTH] = new SimpleVariableProcessedVariantMarkingOption(VariantMarkingOptionsInterface::LENGTH, false, $freeEntryLength, null !== $minimumLength ? (string) $minimumLength : null, null !== $maximumLength ? (string) $maximumLength : null);
                }
            }

            $minimumWidth = $variantMarking->getMinimumWidth();
            $maximumWidth = $variantMarking->getMaximumWidth();
            $freeEntryWidth = $variantMarking->isFreeEntryWidth();
            if ($freeEntryWidth || null !== $minimumWidth || null !== $maximumWidth) {
                if (null !== $minimumWidth && $minimumWidth === $maximumWidth) {
                    $variantMarkingOptionsStack[VariantMarkingOptionsInterface::WIDTH] = new SimpleFixedProcessedVariantMarkingOption(VariantMarkingOptionsInterface::WIDTH, (string) $minimumWidth);
                } else {
                    $variantMarkingOptionsStack[VariantMarkingOptionsInterface::WIDTH] = new SimpleVariableProcessedVariantMarkingOption(VariantMarkingOptionsInterface::WIDTH, false, $freeEntryWidth, null !== $minimumWidth ? (string) $minimumWidth : null, null !== $maximumWidth ? (string) $maximumWidth : null);
                }
            }

            $minimumSquaredSize = $variantMarking->getMinimumSquaredSize();
            $maximumSquaredSize = $variantMarking->getMaximumSquaredSize();
            $freeEntrySquaredSize = $variantMarking->isFreeEntrySquaredSize();
            if ($freeEntrySquaredSize || null !== $minimumSquaredSize || null !== $maximumSquaredSize) {
                if (null !== $minimumSquaredSize && $minimumSquaredSize === $maximumSquaredSize) {
                    $variantMarkingOptionsStack[VariantMarkingOptionsInterface::SQUARED_SIZE] = new SimpleFixedProcessedVariantMarkingOption(VariantMarkingOptionsInterface::SQUARED_SIZE, (string) $minimumSquaredSize);
                } else {
                    $variantMarkingOptionsStack[VariantMarkingOptionsInterface::SQUARED_SIZE] = new SimpleVariableProcessedVariantMarkingOption(VariantMarkingOptionsInterface::SQUARED_SIZE, false, $freeEntrySquaredSize, null !== $minimumSquaredSize ? (string) $minimumSquaredSize : null, null !== $maximumSquaredSize ? (string) $maximumSquaredSize : null);
                }
            }

            $minimumDiameter = $variantMarking->getMinimumDiameter();
            $maximumDiameter = $variantMarking->getMaximumDiameter();
            $freeEntryDiameter = $variantMarking->isFreeEntryDiameter();
            if ($freeEntryDiameter || null !== $minimumDiameter || null !== $maximumDiameter) {
                if (null !== $minimumDiameter && $minimumDiameter === $maximumDiameter) {
                    $variantMarkingOptionsStack[VariantMarkingOptionsInterface::DIAMETER] = new SimpleFixedProcessedVariantMarkingOption(VariantMarkingOptionsInterface::DIAMETER, (string) $minimumDiameter);
                } else {
                    $variantMarkingOptionsStack[VariantMarkingOptionsInterface::DIAMETER] = new SimpleVariableProcessedVariantMarkingOption(VariantMarkingOptionsInterface::DIAMETER, false, $freeEntryDiameter, null !== $minimumDiameter ? (string) $minimumDiameter : null, null !== $maximumDiameter ? (string) $maximumDiameter : null);
                }
            }

            $minimumNumberOfColors = $variantMarking->getMinimumNumberOfColors();
            $maximumNumberOfColors = $variantMarking->getMaximumNumberOfColors();
            $freeEntryNumberOfColors = $variantMarking->isFreeEntryNumberOfColors();
            if ($freeEntryNumberOfColors || null !== $minimumNumberOfColors || null !== $maximumNumberOfColors) {
                if (null !== $minimumNumberOfColors && $minimumNumberOfColors === $maximumNumberOfColors) {
                    $variantMarkingOptionsStack[VariantMarkingOptionsInterface::NUMBER_OF_COLORS] = new SimpleFixedProcessedVariantMarkingOption(VariantMarkingOptionsInterface::NUMBER_OF_COLORS, $minimumNumberOfColors);
                } else {
                    $variantMarkingOptionsStack[VariantMarkingOptionsInterface::NUMBER_OF_COLORS] = new SimpleVariableProcessedVariantMarkingOption(VariantMarkingOptionsInterface::NUMBER_OF_COLORS, true, $freeEntryNumberOfColors, null !== $minimumNumberOfColors ? $minimumNumberOfColors : null, null !== $maximumNumberOfColors ? $maximumNumberOfColors : null);
                }
            }

            $minimumNumberOfPositions = $variantMarking->getMinimumNumberOfPositions();
            $maximumNumberOfPositions = $variantMarking->getMaximumNumberOfPositions();
            $freeEntryNumberOfPositions = $variantMarking->isFreeEntryNumberOfPositions();
            if ($freeEntryNumberOfPositions || null !== $minimumNumberOfPositions || null !== $maximumNumberOfPositions) {
                if (null !== $minimumNumberOfPositions && $minimumNumberOfPositions === $maximumNumberOfPositions) {
                    $variantMarkingOptionsStack[VariantMarkingOptionsInterface::NUMBER_OF_POSITIONS] = new SimpleFixedProcessedVariantMarkingOption(VariantMarkingOptionsInterface::NUMBER_OF_POSITIONS, $minimumNumberOfPositions);
                } else {
                    $variantMarkingOptionsStack[VariantMarkingOptionsInterface::NUMBER_OF_POSITIONS] = new SimpleVariableProcessedVariantMarkingOption(VariantMarkingOptionsInterface::NUMBER_OF_POSITIONS, true, $freeEntryNumberOfPositions, null !== $minimumNumberOfPositions ? $minimumNumberOfPositions : null, null !== $maximumNumberOfPositions ? $maximumNumberOfPositions : null);
                }
            }

            $minimumNumberOfLogos = $variantMarking->getMinimumNumberOfLogos();
            $maximumNumberOfLogos = $variantMarking->getMaximumNumberOfLogos();
            $freeEntryNumberOfLogos = $variantMarking->isFreeEntryNumberOfLogos();
            if ($freeEntryNumberOfLogos || null !== $minimumNumberOfLogos || null !== $maximumNumberOfLogos) {
                if (null !== $minimumNumberOfLogos && $minimumNumberOfLogos === $maximumNumberOfLogos) {
                    $variantMarkingOptionsStack[VariantMarkingOptionsInterface::NUMBER_OF_LOGOS] = new SimpleFixedProcessedVariantMarkingOption(VariantMarkingOptionsInterface::NUMBER_OF_LOGOS, $minimumNumberOfLogos);
                } else {
                    $variantMarkingOptionsStack[VariantMarkingOptionsInterface::NUMBER_OF_LOGOS] = new SimpleVariableProcessedVariantMarkingOption(VariantMarkingOptionsInterface::NUMBER_OF_LOGOS, true, $freeEntryNumberOfLogos, null !== $minimumNumberOfLogos ? $minimumNumberOfLogos : null, null !== $maximumNumberOfLogos ? $maximumNumberOfLogos : null);
                }
            }

            if ($variantMarking->isFullColor()) {
                $variantMarkingOptionsStack[VariantMarkingOptionsInterface::FULL_COLOR] = new TrueProcessedVariantMarkingOption(VariantMarkingOptionsInterface::FULL_COLOR);
            }

            $markingPosition = $variantMarking->getMarkingPosition();
            if ($markingPosition instanceof MarkingPositionInterface) {
                $variantMarkingOptionsStack[VariantMarkingOptionsInterface::POSITION] = new MarkingPositionProcessedVariantMarkingOption($markingPosition);
            }

            foreach ($variantMarkingOptionsStack as $variantMarkingOption => $_) {
                if (!isset($allVariantMarkingsOptionsStack[$variantMarkingOption])) {
                    $allVariantMarkingsOptionsStack[$variantMarkingOption] = true;
                }
            }

            $data[] = array(
                'data' => $variantMarkingOptionsStack,
                'variant_marking' => $variantMarking
            );
        }

        if (empty($data)) {
            return array();
        }

        foreach($data as &$row) {
            foreach ($allVariantMarkingsOptionsStack as $variantMarkingOption => $_) {
                if (!isset($row['data'][$variantMarkingOption])) {
                    $row['data'][$variantMarkingOption] = null;
                }
            }
        }

        unset($row);

        if (!empty($variantMarkingOptionsOrder)) {
            $variantMarkingOptionsOrder = array_filter($variantMarkingOptionsOrder, function ($variantMarkingOption) use ($allVariantMarkingsOptionsStack) {
                return isset($allVariantMarkingsOptionsStack[$variantMarkingOption]);
            });
            $variantMarkingOptionsOrder = array_flip($variantMarkingOptionsOrder);
            asort($variantMarkingOptionsOrder);
            $i = 0;
            foreach ($variantMarkingOptionsOrder as &$position) {
                $position = $i++;
            }

            unset($position);
            foreach ($allVariantMarkingsOptionsStack as $variantMarkingOption => $_) {
                if (!isset($variantMarkingOptionsOrder[$variantMarkingOption])) {
                    $variantMarkingOptionsOrder[$variantMarkingOption] = $i++;
                }
            }

            foreach ($data as &$row) {
                uksort($row['data'], function ($a, $b) use ($variantMarkingOptionsOrder) {
                    return $variantMarkingOptionsOrder[$a] - $variantMarkingOptionsOrder[$b];
                });
            }

            unset($row);
        } else {
            foreach ($data as &$row) {
                ksort($row['data']);
            }

            unset($row);
        }

        return $data;
    }

    /**
     * @param VariantInterface $variant
     * @param array $variantMarkingOptionsOrder
     *
     * @return Graph
     */
    public static function getVariantMarkingsGraph(VariantInterface $variant, array $variantMarkingOptionsOrder = array())
    {
        $graph = new Graph();

        $start = $graph->createVertex(self::GRAPH_START_VERTEX_ID);
        $start->setGroup(0);
        $end = $graph->createVertex(self::GRAPH_END_VERTEX_ID);
        $end->setGroup(1);

        $data = self::getVariantMarkingsData($variant, $variantMarkingOptionsOrder);
        if (empty($data)) {
            return $graph;
        }

        $maxLevel = count($data[0]['data']);
        $end->setGroup($maxLevel + 1);

        foreach ($data as $row) {
            $level = 1;
            $lastVertex = null;
            foreach ($row['data'] as $variantMarkingOption => $processedVariantMarkingOption) {
                if ($processedVariantMarkingOption instanceof ProcessedVariantMarkingOptionInterface) {
                    $variantMarkingOptionVertexId = sprintf('_%s', $processedVariantMarkingOption->getUniqueId());
                } else {
                    $variantMarkingOptionVertexId = sprintf('__%s', $variantMarkingOption);
                }

                if (!$graph->hasVertex($variantMarkingOptionVertexId)) {
                    $variantMarkingOptionVertex = $graph->createVertex($variantMarkingOptionVertexId);
                    $variantMarkingOptionVertex->setAttribute('processed_variant_marking_option', $processedVariantMarkingOption);
                    $variantMarkingOptionVertex->setGroup($level);
                } else {
                    $variantMarkingOptionVertex = $graph->getVertex($variantMarkingOptionVertexId);
                }

                if ($lastVertex instanceof Vertex) {
                    if (!$variantMarkingOptionVertex->hasEdgeTo($lastVertex)) {
                        $variantMarkingOptionVertex->createEdge($lastVertex);
                    }
                }

                if (1 === $level) {
                    if (!$variantMarkingOptionVertex->hasEdgeTo($start)) {
                        $variantMarkingOptionVertex->createEdge($start);
                    }
                } elseif ($maxLevel === $level) {
                    if (!$variantMarkingOptionVertex->hasEdgeTo($end)) {
                        $variantMarkingOptionVertex->createEdge($end);
                    }
                }

                $lastVertex = $variantMarkingOptionVertex;

                $level++;
            }
        }

        return $graph;
    }

    /**
     * @param VariantInterface $variant
     * @param array $variantMarkingOptionsOrder
     *
     * @return string|null
     */
    public static function getVariantMarkingsGraphImageSrc(VariantInterface $variant, array $variantMarkingOptionsOrder = array())
    {
        $graph = self::getVariantMarkingsGraph($variant, $variantMarkingOptionsOrder);
        if ($graph->getVertices()->count() <= 2) {
            return null;
        }

        $graph->setAttribute('graphviz.graph.rankdir', 'RL');

        $start = $graph->getVertex(self::GRAPH_START_VERTEX_ID);
        $end = $graph->getVertex(self::GRAPH_END_VERTEX_ID);
        $process = function (Vertex $fromVertex, $level) use (&$process, $end) {
            $vertices = $fromVertex->getVerticesEdgeTo()->getVerticesMatch(function (Vertex $vertex) use ($end, $level) {
                return $end !== $vertex && $level === $vertex->getGroup();
            });

            $nextLevel = $level + 1;
            /* @var Vertex $vertex */
            foreach ($vertices as $vertex) {
                $processedVariantMarkingOption = $vertex->getAttribute('processed_variant_marking_option');
                if ($processedVariantMarkingOption instanceof ProcessedVariantMarkingOptionInterface) {
                    if ($processedVariantMarkingOption instanceof MarkingProcessedVariantMarkingOption) {
                        $label = sprintf('%s : %s', ucfirst($processedVariantMarkingOption->getVariantMarkingOption()), $processedVariantMarkingOption->getMarking()->getName());
                        $supplierMarking = $processedVariantMarkingOption->getSupplierMarking();
                        if ($supplierMarking instanceof SupplierMarkingInterface) {
                            $nameComplement = $supplierMarking->getNameComplement();
                            if (is_string($nameComplement)) {
                                $label .= sprintf(' (%s)', $nameComplement);
                            }
                        }
                    } elseif ($processedVariantMarkingOption instanceof SimpleFixedProcessedVariantMarkingOption) {
                        $label = sprintf('%s = %s', ucfirst($processedVariantMarkingOption->getVariantMarkingOption()), (string) $processedVariantMarkingOption->getValue());
                    } elseif ($processedVariantMarkingOption instanceof MarkingPositionProcessedVariantMarkingOption) {
                        $label = sprintf('%s : %s', ucfirst($processedVariantMarkingOption->getVariantMarkingOption()), $processedVariantMarkingOption->getMarkingPosition()->getName());
                    } elseif ($processedVariantMarkingOption instanceof SimpleVariableProcessedVariantMarkingOption) {
                        $label = ucfirst($processedVariantMarkingOption->getVariantMarkingOption());
                        $minimumValue = $processedVariantMarkingOption->getMinimumValue();
                        if (null !== $minimumValue) {
                            $label = sprintf('%s < %s', $minimumValue, $label);
                        }

                        $maximumValue = $processedVariantMarkingOption->getMaximumValue();
                        if (null !== $maximumValue) {
                            $label = sprintf('%s < %s', $label, $maximumValue);
                        }
                    } elseif ($processedVariantMarkingOption instanceof TrueProcessedVariantMarkingOption) {
                        $label = ucfirst($processedVariantMarkingOption->getVariantMarkingOption());
                    } else {
                        throw new NotImplementedException();
                    }
                } else {
                    $label = '@NULL@';
                }

                $vertex->setAttribute('graphviz.label', $label);

                $process($vertex, $nextLevel);
            }
        };

        $process($start, 1);

        $start->destroy();
        $end->destroy();

        $graphviz = new GraphViz();

        return $graphviz->createImageSrc($graph);
    }

    /**
     * @param VariantInterface $variant
     * @param SupplierProfileInterface $supplierProfile
     * @param int $quantity
     * @param SelectedVariantMarking[] $selectedVariantMarkings
     *
     * @return CalculatedPrice
     */
    public static function getCalculatedPrice(VariantInterface $variant, SupplierProfileInterface $supplierProfile,
        $quantity, array $selectedVariantMarkings)
    {
        $calculatedPrice = new CalculatedPrice();

        $quantity = intval($quantity);
        // if the provided quantity is negative => on quote
        if ($quantity < 1) {
            return $calculatedPrice;
        }

        foreach ($variant->getVariantMinimumQuantities() as $variantMinimumQuantity) {
            if ($variantMinimumQuantity->getSupplierProfile()->getUniqueId() !== $supplierProfile->getUniqueId()) {
                continue;
            }

            // if the provided quantity is inferior than the matching minimum quantity => on quote
            if ($quantity < $variantMinimumQuantity->getValue()) {
                return $calculatedPrice;
            }

            break;
        }

        // if the marking is mandatory but not a single selected variant marking was provided => on quote
        if ($variant->isMandatoryMarking() && empty($selectedVariantMarkings)) {
            return $calculatedPrice;
        }

        $filteredVariantPrices = array();
        /* @var VariantPriceInterface $variantPrice */
        foreach ($variant->getVariantPrices() as $variantPrice) {
            if ($supplierProfile->getUniqueId() === $variantPrice->getSupplierProfile()->getUniqueId() && $variantPrice->getFromQuantity() <= $quantity) {
                $filteredVariantPrices[] = $variantPrice;
            }
        }

        if (empty($filteredVariantPrices)) {
            return $calculatedPrice;
        }

        $matchingVariantPrice = null;
        /* @var VariantPriceInterface $variantPrice */
        foreach ($filteredVariantPrices as $variantPrice) {
            if (!$matchingVariantPrice instanceof VariantPriceInterface) {
                $matchingVariantPrice = $variantPrice;

                continue;
            }

            $fromQuantity = $variantPrice->getFromQuantity();
            $matchingFromQuantity = $matchingVariantPrice->getFromQuantity();
            // if two variant prices are set for the same from quantity => on quote
            if ($fromQuantity === $matchingFromQuantity) {
                return $calculatedPrice;
            }

            if ($fromQuantity > $matchingFromQuantity) {
                $matchingVariantPrice = $variantPrice;
            }
        }

        // if there is no matching variant price => on quote
        if (!$matchingVariantPrice instanceof VariantPriceInterface) {
            return $calculatedPrice;
        }

        if (!empty($selectedVariantMarkings)) {
            $totalPriceCount = 0;
            $variantMarkingCalculatedPrices = array();
            $selectedVariantMarkingsVariables = VariantMarkingHelper::getVariables($selectedVariantMarkings, $quantity);
            /* @var SelectedVariantMarking $selectedVariantMarking */
            foreach (array_values($selectedVariantMarkings) as $i => $selectedVariantMarking) {
                $selectedVariantMarkingCalculatedPrice = VariantMarkingHelper::getVariantMarkingCalculatedPrice($selectedVariantMarking, $selectedVariantMarkingsVariables[$i], $supplierProfile, $quantity);
                // if one variant marking calculated price is on quote => on quote
                if ($selectedVariantMarkingCalculatedPrice->isOnQuote()) {
                    return $calculatedPrice;
                }

                $variantMarkingCalculatedPrices[] = $selectedVariantMarkingCalculatedPrice;

                if ($selectedVariantMarkingCalculatedPrice->isTotalPrice()) {
                    // if there is more than one total price => on quote
                    if (2 === ++$totalPriceCount) {
                        return $calculatedPrice;
                    }
                }
            }

            switch ($totalPriceCount) {
                case 0:
                    $calculationValue = $matchingVariantPrice->getCalculationValue();
                    if (!$calculationValue instanceof Money) {
                        $calculationValue = Money::EUR(intval($calculationValue * 1000));
                    }

                    $calculatedPrice->add($calculationValue->multiply($quantity));
                case 1:
                    /* @var VariantMarkingCalculatedPrice $variantMarkingCalculatedPrice */
                    foreach ($variantMarkingCalculatedPrices as $variantMarkingCalculatedPrice) {
                        $calculatedPrice->add(Money::EUR($variantMarkingCalculatedPrice->getAmount()));
                    }

                    break;
                default:
                    throw new \LogicException();
            }
        } else {
            $calculationValue = $matchingVariantPrice->getCalculationValue();
            if (!$calculationValue instanceof Money) {
                $calculationValue = Money::EUR(intval($calculationValue * 1000));
            }

            $calculatedPrice->add($calculationValue->multiply($quantity));
        }

        if ($calculatedPrice->getAmount() > 0) {
            $calculatedPrice->setOnQuote(false);
        }

        return $calculatedPrice;
    }
}
