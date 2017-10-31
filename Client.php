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
    const URL = "http://extranet-rebirth.es.local/generator.php";

    /**
     * @var string
     */
    private $key;

    /**
     * @param string $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * @return array|mixed|null
     */
    public function search()
    {
        $ch = curl_init(self::URL);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);

        if (curl_errno($ch))
        {
            echo 'Erreur Curl : ' . curl_error($ch);
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