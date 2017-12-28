<?php

namespace ES\APIv2Client;

use ES\APIv2Client\Transformer\ProductTransformer;

/**
 * @author Dagan MENEZ
 */
class Client
{
    private $url;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $lang;

    /**
     * @param string $key
     * @param string $lang
     * @param string $version
     */
    public function __construct($key, $lang, $version)
    {
        $this->key = $key;
        $this->lang = $lang;
        $this->url  = sprintf("http://apiv2.europeansourcing.com/api/%s/search", $version);

        $this->checkVersion($version);
    }

    /**
     * @param array[] $handlers
     * @param int $page
     * @param int $offset
     * @param int $limit
     * @param string $sort_direction
     *
     * @return array|mixed|null
     */
    public function searchProductsBy($handlers, $page = 1, $offset = 0, $limit = 52, $sort_direction = 'asc')
    {
        $params = array(
            'page' => $page,
            'offset' => $offset,
            'lang' => $this->lang,
            'limit' => $limit,
            'sort_direction' => $sort_direction,
            'search_handlers' => $handlers
        );

        return $this->searchRequest($params);
    }

    /**
     * @param string $query
     * @param int $page
     * @param int $offset
     * @param int $limit
     * @param string $sort_direction
     *
     * @return array|mixed|null
     */
    public function searchProductsByQuery($query, $page = 1, $offset = 0, $limit = 52, $sort_direction = 'asc')
    {
        $params = array(
            'page' => $page,
            'offset' => $offset,
            'lang' => $this->lang,
            'limit' => $limit,
            'sort_direction' => $sort_direction,
            'search_handlers' => array(
                array(
                    'query' => $query
                )
            )
        );

        return $this->searchRequest($params);
    }

    /**
     * @param array[] $params
     *
     * @return array|mixed|null
     */
    private function searchRequest($params)
    {
        $ch = curl_init($this->url);
        $param = json_encode($params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/ld+json',
            'Accept: application/ld+json',
            'X-AUTH-TOKEN: ' .  $this->key
        ));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);

        if (false === $data) {
            echo 'Erreur Curl : ' . curl_error($ch);
            die();
        }

        curl_close($ch);
        $data = json_decode($data, true);

        if (null === $data) {
            throw new \UnexpectedValueException("API did not answer with JSON data.");
        }

        if (!isset($data['products'])) {
            return $data;
        }

        $products = ProductTransformer::fromArray($data['products']);

        return $products;
    }

    /**
     * @param string $version
     */
    private function checkVersion($version) {
        if (substr($version, 0,1) !== "v") {
            throw new \InvalidArgumentException('The version provided is not a valid version.');
        }

        if (intval(substr($version, 1,1)) > "1") {
            throw new \InvalidArgumentException("The API version provided is not supported by this API client. Please consider using another API version or update this API Client");
        }
    }

//    /**
//     * @param Variant $variant
//     * @return CalculatedPrice
//     */
//    public function price($variant)
//    {
//        /** @var SupplierProfile $supplierProfile */
//        $supplierProfile = $variant->getSupplierProfiles()[0];
//        $quantity = 50000;
//        /** @var VariantMarking $variantMarking */
//        if (empty($variant->getVariantMarkings())) {
//            return;
//        }
//        $variantMarking = $variant->getVariantMarkings()[0];
//        $variantMarkingModel = new VariantMarkingModel();
//        $variantMarkingModel->setVariantMarking($variantMarking);
//        $variantMarkingModel->setDiameter($variantMarking->getDiameter());
//        $variantMarkingModel->setFullColor($variantMarking->isFullColor());
//        $variantMarkingModel->setLength($variantMarking->getLength());
//        $variantMarkingModel->setWidth($variantMarking->getWidth());
//        $variantMarkingModel->setSquaredSize($variantMarking->getSquaredSize());
//        $variantMarkingModel->setNumberOfColors($variantMarking->getNumberOfColors());
//        $variantMarkingModel->setNumberOfLogos($variantMarking->getNumberOfLogos());
//        $variantMarkingModel->setNumberOfPositions($variantMarking->getNumberOfPositions());
//        $variantMarkingModels = array($variantMarkingModel);
//
//
//        return $variant->getCalculatedPrice($supplierProfile, $quantity, $variantMarkingModels)->getValue();
//    }
}