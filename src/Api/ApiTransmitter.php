<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Api;

use ExpressRuSDK\Api\Auth\SignatureGenerator;

/**
 * Class ApiTransmitter
 * @package ExpressRuSDK\Api
 */
class ApiTransmitter
{

    /**
     * @var string
     */
    protected $client;

    /**
     * @var string
     */
    protected $signatureSecretKey;

    /**
     * @var string
     */
    protected $apiHost;

    /**
     * @var string
     */
    protected $apiPath;

    /**
     * @var SignatureGenerator
     */
    protected $signatureGenerator;

    /**
     * @var string
     */
    protected $authHeading;

    /**
     * @var string
     */
    protected $authString;

    /**
     * @param $apiHost
     * @param $apiPath
     * @param $client
     * @param $signatureSecretKey
     * @param SignatureGenerator $signatureGenerator
     * @param $authHeading
     * @param $authString
     */
    public function __construct($apiHost, $apiPath, $client, $signatureSecretKey, SignatureGenerator $signatureGenerator, $authHeading, $authString)
    {
        $this->apiHost = $apiHost;
        $this->apiPath = $apiPath;
        $this->client = $client;
        $this->signatureSecretKey = $signatureSecretKey;
        $this->signatureGenerator = $signatureGenerator;
        $this->authHeading = $authHeading;
        $this->authString = $authString;
    }


    /**
     * @param AbstractMethod $method
     * @return ApiResponse
     */
    public function transmitMethod(AbstractMethod $method)
    {
        return $method->handleResponse($this->sendApiRequest($method->getMethod(), $method->getGetParams(), $method->getPostParams()));
    }


    /**
     * @param $method
     * @param array $getP
     * @param array $postP
     * @return mixed
     */
    protected function sendApiRequest($method, $getP = array(), $postP = array())
    {
        $usurl = $this->apiHost . DIRECTORY_SEPARATOR . $this->apiPath . DIRECTORY_SEPARATOR . $method;

        $sig = $this->signatureGenerator->generate($this->client, $this->signatureSecretKey, $usurl, $getP, $postP);

        $query = http_build_query(array_merge($getP, array('sig' => $sig)));


        $url = $usurl . '?' . $query;

        $headers = array(
            $this->authHeading . ' : ' . $this->authString
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);

        if (ApiConfig::API_BASIC_AUTH) {
            curl_setopt($ch, CURLOPT_USERPWD, ApiConfig::API_BASIC_AUTH_LOGIN . ':' . ApiConfig::API_BASIC_AUTH_PASSWORD);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($postP) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postP);
        }

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Express.Ru API SDK User');
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;

    }
}