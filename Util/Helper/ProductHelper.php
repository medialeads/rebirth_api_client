<?php

namespace ES\RebirthApiClient\Util\Helper;

use ES\RebirthCommon\AttributeInterface;
use ES\RebirthCommon\ProductInterface;
use Fhaculty\Graph\Graph;
use Fhaculty\Graph\Vertex;
use Graphp\GraphViz\GraphViz;

class ProductHelper
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
     * @param ProductInterface $product
     * @param array $attributeGroupsOrder
     *
     * @return Graph
     */
    public static function getAttributesGraph(ProductInterface $product, array $attributeGroupsOrder = array())
    {
        $graph = new Graph();

        $stack = array();
        $attributeGroupsMaxPositionStack = array();
        foreach ($product->getVariants() as $variant) {
            $data = array(
                'variant' => $variant,
                'attributes' => array()
            );

            $attributesStack = array();
            /* @var AttributeInterface $attribute */
            foreach ($variant->getAttributes() as $attribute) {
                $attributeGroupUniqueId = $attribute->getAttributeGroup()->getUniqueId();
                if (!isset($attributesStack[$attributeGroupUniqueId])) {
                    $attributesStack[$attributeGroupUniqueId] = array();
                }

                $attributesStack[$attributeGroupUniqueId][] = $attribute;
            }

            foreach ($attributesStack as $attributeGroupUniqueId => $attributes) {
                if (!isset($attributeGroupsMaxPositionStack[$attributeGroupUniqueId])) {
                    $attributeGroupsMaxPositionStack[$attributeGroupUniqueId] = count($attributes);
                } else {
                    $attributeGroupsMaxPositionStack[$attributeGroupUniqueId] = max($attributeGroupsMaxPositionStack[$attributeGroupUniqueId], count($attributes));
                }
            }

            $data['attributes'] = $attributesStack;

            $stack[] = $data;
        }

        foreach($stack as &$row) {
            foreach ($attributeGroupsMaxPositionStack as $attributeGroupUniqueId => $attributeGroupMaxPosition) {
                if (!isset($row['attributes'][$attributeGroupUniqueId])) {
                    $row['attributes'][$attributeGroupUniqueId] = array();
                }

                for ($i = 0; $i < $attributeGroupMaxPosition; $i++) {
                    if (!isset($row['attributes'][$attributeGroupUniqueId][$i])) {
                        $row['attributes'][$attributeGroupUniqueId][$i] = null;
                    }
                }
            }
        }

        unset($row);

        if (!empty($attributeGroupsOrder)) {
            $attributeGroupsOrder = array_filter($attributeGroupsOrder, function ($attributeGroupUniqueId) use ($attributeGroupsMaxPositionStack) {
                return isset($attributeGroupsMaxPositionStack[$attributeGroupUniqueId]);
            });
            $attributeGroupsOrder = array_flip($attributeGroupsOrder);
            asort($attributeGroupsOrder);
            $i = 0;
            foreach ($attributeGroupsOrder as &$position) {
                $position = $i++;
            }

            unset($position);
            foreach ($attributeGroupsMaxPositionStack as $attributeGroupUniqueId => $_) {
                if (!isset($attributeGroupsOrder[$attributeGroupUniqueId])) {
                    $attributeGroupsOrder[$attributeGroupUniqueId] = $i++;
                }
            }

            foreach ($stack as &$row) {
                uksort($row['attributes'], function ($a, $b) use ($attributeGroupsOrder) {
                    return $attributeGroupsOrder[$a] - $attributeGroupsOrder[$b];
                });
            }

            unset($row);
        } else {
            foreach ($stack as &$row) {
                ksort($row['attributes']);
            }

            unset($row);
        }

        $maxLevel = array_sum($attributeGroupsMaxPositionStack);

        $start = $graph->createVertex('start');
        $start->setGroup(0);
        $end = $graph->createVertex('end');
        $end->setGroup($maxLevel + 1);
        foreach ($stack as $row) {
            $level = 1;
            $lastVertex = null;
            foreach ($row['attributes'] as $attributeGroupUniqueId => $attributes) {
                foreach ($attributes as $position => $attribute) {
                    $nullAttribute = !$attribute instanceof AttributeInterface;
                    if (!$nullAttribute) {
                        $attributeVertexId = sprintf('%s_%s_%s', $attributeGroupUniqueId, $attribute->getUniqueId(), $position);
                    } else {
                        $attributeVertexId = sprintf('_%s_%s', $attributeGroupUniqueId, $position);
                    }

                    if (!$graph->hasVertex($attributeVertexId)) {
                        $attributeVertex = $graph->createVertex($attributeVertexId);
                        $attributeVertex->setAttribute('attribute', $attribute);
                        $attributeVertex->setGroup($level);
                    } else {
                        $attributeVertex = $graph->getVertex($attributeVertexId);
                    }

                    if ($lastVertex instanceof Vertex) {
                        if (!$attributeVertex->hasEdgeTo($lastVertex)) {
                            $attributeVertex->createEdge($lastVertex);
                        }
                    }

                    if (1 === $level) {
                        if (!$attributeVertex->hasEdgeTo($start)) {
                            $attributeVertex->createEdge($start);
                        }
                    } elseif ($maxLevel === $level) {
                        if (!$attributeVertex->hasEdgeTo($end)) {
                            $attributeVertex->createEdge($end);
                        }
                    }

                    $lastVertex = $attributeVertex;

                    $level++;
                }
            }
        }

        return $graph;
    }

    /**
     * @param Graph $graph
     *
     * @return string
     */
    public static function getAttributesGraphImageSrc(Graph $graph)
    {
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
                $attribute = $vertex->getAttribute('attribute');
                $vertex->setAttribute('graphviz.label', $attribute instanceof AttributeInterface ? $attribute->getValue() : '@NULL@');

                $process($vertex, $nextLevel);
            }
        };

        $process($start, 1);

        $start->destroy();
        $end->destroy();

        $graphviz = new GraphViz();

        return $graphviz->createImageSrc($graph);
    }
}
