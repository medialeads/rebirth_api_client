<?php

namespace ES\RebirthApiClient;

use ES\RebirthApiClient\Model\Product;
use ES\RebirthApiClient\Transformer\ProductTransformer;

class Client
{
    /**
     * @var array
     */
    private $headers;

    /**
     * @var string|null
     */
    private $searchUrl;

    /**
     * @param string $token
     * @param string $baseUrl
     */
    public function __construct($token, $baseUrl = 'http://apiv2.europeansourcing.com/api/v1.0')
    {
        $this->headers = array(
            'Content-Type: application/ld+json',
            'Accept: application/ld+json',
            sprintf('X-AUTH-TOKEN: %s', $token)
        );
        $this->searchUrl = sprintf('%s/search', rtrim($baseUrl, '/'));
    }

    /**
     * @param array $params
     *
     * @return Product[]
     */
    public function search(array $params = array())
    {
        if (!isset($params['lang'])) {
            $params['lang'] = 'fr';
        }

        $encodedParams = json_encode($params);
        if (false === $encodedParams || JSON_ERROR_NONE !== json_last_error()) {
            throw new \Exception(sprintf('Could not json_encode() your params : %s.', json_last_error_msg()));
        }

        $ch = curl_init($this->searchUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $encodedParams);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $curlErrno = curl_errno($ch);
        if (0 !== $curlErrno || false === $response) {
            throw new \Exception('CURL call failed : %s %s', $curlErrno, curl_error($ch));
        }

        curl_close($ch);
        $decodedResponse = json_decode($response, true);

        if (null === $decodedResponse || JSON_ERROR_NONE !== json_last_error()) {
            throw new \Exception(sprintf('Could not json_decode() the API response : %s', json_last_error_msg()));
        }

        return ProductTransformer::create()->transformMultiple($decodedResponse['products']);
    }
}
