<?php

namespace ES\APIv2Client;

use ES\APIv2Client\Model\CalculatedPrice;
use ES\APIv2Client\Model\SupplierProfile;
use ES\APIv2Client\Model\Variant;
use ES\APIv2Client\Model\VariantMarking;
use ES\APIv2Client\Model\VariantMarkingModel;
use ES\APIv2Client\Transformer\ProductTransformer;

class Client
{
    const URL = "http://apiv2.europeansourcing.com/api/search";

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $countryCode;

    /**
     * @param string $key
     * @param string $countryCode
     */
    public function __construct($key, $countryCode)
    {
        $this->key = $key;
        $this->countryCode = $countryCode;
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
    public function searchProductsBy($handlers, $page = 1, $offset = 0, $limit = 20, $sort_direction = 'asc')
    {
        $params = array(
            'page' => $page,
            'offset' => $offset,
            'lang' => 'fr',
            'limit' => $limit,
            'sort_direction' => $sort_direction,
            'context' => array(
                'country_code' => $this->countryCode
            ),
            'search_handlers' => $handlers
        );

        return $this->searchRequest($params);
    }

    /**
     * @param $string
     * @param int $page
     * @param int $offset
     * @param int $limit
     * @param string $sort_direction
     *
     * @return array|mixed|null
     */
    public function searchProductsByQuery($string, $page = 1, $offset = 0, $limit = 20, $sort_direction = 'asc')
    {
        $params = array(
            'page' => $page,
            'offset' => $offset,
            'lang' => 'fr',
            'limit' => $limit,
            'sort_direction' => $sort_direction,
            'context' => array(
                'country_code' => $this->countryCode
            ),
            'search_handlers' => array(
                array(
                    'query' => $string
                )
            )
        );

        return $this->searchRequest($params);
    }

    /**
     * @param array $params
     *
     * @return array|mixed|null
     */
    private function searchRequest($params)
    {
        $ch = curl_init(self::URL);
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
     * @param Variant $variant
     * @return CalculatedPrice
     */
    public function price($variant)
    {
        /** @var SupplierProfile $supplierProfile */
        $supplierProfile = $variant->getSupplierProfiles()[0];
        $quantity = 50000;
        /** @var VariantMarking $variantMarking */
        if (empty($variant->getVariantMarkings())) {
            return;
        }
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


        return var_dump($variant->getCalculatedPrice($supplierProfile, $quantity, $variantMarkingModels)->getValue());
    }
}