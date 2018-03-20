<?php

namespace ES\RebirthApiClient\Util\Helper;

use ES\RebirthCommon\AttributeGroupInterface;
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
     * @return array
     */
    public static function getAttributesData(ProductInterface $product, array $attributeGroupsOrder = array())
    {
        $data = array();

        $attributeGroups = array();
        $attributeGroupsMaxPositionStack = array();

        foreach ($product->getVariants() as $variant) {
            $attributesStack = array();
            /* @var AttributeInterface $attribute */
            foreach ($variant->getAttributes() as $attribute) {
                $attributeGroup = $attribute->getAttributeGroup();
                $attributeGroupUniqueId = $attributeGroup->getUniqueId();
                if (!isset($attributesStack[$attributeGroupUniqueId])) {
                    $attributesStack[$attributeGroupUniqueId] = array(
                        'attribute_group' => $attributeGroup,
                        'attributes' => array()
                    );
                }

                $attributesStack[$attributeGroupUniqueId]['attributes'][] = $attribute;

                if (!isset($attributeGroups[$attributeGroupUniqueId])) {
                    $attributeGroups[$attributeGroupUniqueId] = $attributeGroup;
                }
            }

            if (empty($attributesStack)) {
                continue;
            }

            foreach ($attributesStack as $attributeGroupUniqueId => $row) {
                if (!isset($attributeGroupsMaxPositionStack[$attributeGroupUniqueId])) {
                    $attributeGroupsMaxPositionStack[$attributeGroupUniqueId] = count($row['attributes']);
                } else {
                    $attributeGroupsMaxPositionStack[$attributeGroupUniqueId] = max($attributeGroupsMaxPositionStack[$attributeGroupUniqueId], count($row['attributes']));
                }
            }

            $data[] = array(
                'data' => $attributesStack,
                'variant' => $variant
            );
        }

        if (empty($data)) {
            return array();
        }

        foreach($data as &$row) {
            foreach ($attributeGroupsMaxPositionStack as $attributeGroupUniqueId => $attributeGroupMaxPosition) {
                if (!isset($row['data'][$attributeGroupUniqueId])) {
                    $row['data'][$attributeGroupUniqueId] = array(
                        'attribute_group' => $attributeGroups[$attributeGroupUniqueId],
                        'attributes' => array()
                    );
                }

                for ($i = 0; $i < $attributeGroupMaxPosition; $i++) {
                    if (!isset($row['data'][$attributeGroupUniqueId]['attributes'][$i])) {
                        $row['data'][$attributeGroupUniqueId]['attributes'][$i] = null;
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

            foreach ($data as &$row) {
                uksort($row['data'], function ($a, $b) use ($attributeGroupsOrder) {
                    return $attributeGroupsOrder[$a] - $attributeGroupsOrder[$b];
                });
            }

            unset($row);
        } else {
            foreach ($data as &$row) {
                ksort($row['data']);
            }

            unset($row);
        }

        array_walk($data, function (&$row) {
            $row['data'] = array_values($row['data']);
        });

        return $data;
    }

    /**
     * @param ProductInterface $product
     * @param array $attributeGroupsOrder
     *
     * @return Graph
     */
    public static function getAttributesGraph(ProductInterface $product, array $attributeGroupsOrder = array())
    {
        $graph = new Graph();

        $start = $graph->createVertex(self::GRAPH_START_VERTEX_ID);
        $start->setGroup(0);
        $end = $graph->createVertex(self::GRAPH_END_VERTEX_ID);
        $end->setGroup(1);

        $data = self::getAttributesData($product, $attributeGroupsOrder);
        if (empty($data)) {
            return $graph;
        }

        $maxLevel = array_reduce($data[0]['data'], function ($carry, $row) {
            return $carry + count($row['attributes']);
        }, 0);
        $end->setGroup($maxLevel + 1);

        foreach ($data as $row) {
            $level = 1;
            $lastVertex = null;
            foreach ($row['data'] as $row2) {
                /* @var AttributeGroupInterface $attributeGroup */
                $attributeGroup = $row2['attribute_group'];
                $attributeGroupUniqueId = $attributeGroup->getUniqueId();
                foreach ($row2['attributes'] as $position => $attribute) {
                    if ($attribute instanceof AttributeInterface) {
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
     * @param ProductInterface $product
     * @param array $attributeGroupsOrder
     *
     * @return string|null
     */
    public static function getAttributesGraphImageSrc(ProductInterface $product, array $attributeGroupsOrder = array())
    {
        $graph = self::getAttributesGraph($product, $attributeGroupsOrder);
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
