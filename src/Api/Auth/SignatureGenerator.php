<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Api\Auth;

/**
 * Class SignatureGenerator
 * @package ExpressRuSDK\Api\Auth
 */
class SignatureGenerator
{

    /**
     * @var string
     */
    public $signatureParam;

    /**
     * @var string
     */
    public $signatureSendMethod;

    /**
     * @param string $signatureParam
     * @param string $signatureSendMethod
     */
    public function __construct($signatureParam = 'sig', $signatureSendMethod = 'GET')
    {
        $this->signatureParam = $signatureParam;
        $this->signatureSendMethod = $signatureSendMethod;
    }

    /**
     * @param $username
     * @param $signatureSecretKey
     * @param $url
     * @param array $getArray
     * @param array $postArray
     * @param bool|TRUE $excludeSignatureParam
     * @return string
     */
    public function generate($username, $signatureSecretKey, $url, array $getArray, array $postArray, $excludeSignatureParam = TRUE)
    {
        $concatGet = $concatPost = '';

        ksort($getArray);
        foreach ($getArray as $key => $value) {
            if ($excludeSignatureParam AND $key == $this->signatureParam AND $this->signatureSendMethod == 'GET') {
                continue;
            }
            if (!$value) {
                continue;
            }
            $concatGet .= $key . '=' . $value;
        }

        ksort($postArray);
        foreach ($postArray as $key => $value) {
            if ($excludeSignatureParam AND $key == $this->signatureParam AND $this->signatureSendMethod == 'POST') {
                continue;
            }
            $concatPost .= $key . '=' . $value;
        }
        return md5($username . $url . $concatGet . $concatPost . $signatureSecretKey);
    }
}

    
 