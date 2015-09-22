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

/**
 * Class AbstractMethod
 * @package ExpressRuSDK\Api
 */
abstract class AbstractMethod
{
    /**
     * @return array
     */
    abstract public function getGetParams();

    /**
     * @return array
     */
    abstract public function getPostParams();

    /**
     * @return string
     */
    abstract public function getMethod();

    /**
     * @param $responseJSON
     * @return ApiResponse
     */
    public function handleResponse($responseJSON)
    {
        return new ApiResponse($responseJSON);
    }
}