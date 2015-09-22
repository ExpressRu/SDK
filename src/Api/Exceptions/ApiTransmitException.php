<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Api\Exceptions;

use Exception;
use ExpressRuSDK\Api\ApiResponse;

class ApiTransmitException extends \Exception
{
    /**
     * @var ApiResponse
     */
    protected $apiResponse;

    /**
     * @param ApiResponse $apiResponse
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(ApiResponse $apiResponse, $message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->apiResponse = $apiResponse;
    }


    public function getApiResponse() {
        return $this->apiResponse;
    }

}