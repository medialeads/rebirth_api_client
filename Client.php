<?php

namespace ES\APIv2Client;

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
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function search()
    {
        $ch = curl_init(self::URL);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);

        if(curl_errno($ch))
        {
            echo 'Erreur Curl : ' . curl_error($ch);
        }

        curl_close($ch);
        $data = json_decode($data, true);

        if (null === $data) {
            throw new \UnexpectedValueException("API did not answer with JSON data.");
        }

        $products = ProductTransformer::fromArray($data['products']);

        return $products;
    }
}