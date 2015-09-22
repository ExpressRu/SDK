<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */



namespace ExpressRuSDK\Api\Methods;

use ExpressRuSDK\Api\AbstractMethod;
use ExpressRuSDK\Api\Responses\CalculateOrderApiResponse;

/**
 * Class CalculateOrderMethod
 * @package ExpressRuSDK\Api\Methods
 */
class CalculateOrderMethod extends AbstractMethod
{
    /**
     * @var array
     */
    protected $orderArray;

    /**
     * Массив параметров заказа
     * @param array $orderArray
     */
    public function __construct(array $orderArray)
    {
        $this->orderArray = $orderArray;
    }


    /**
     * @return string
     */
    public function getMethod()
    {
        return 'calculateOrder';
    }


    /**
     * @return array
     */
    public function getGetParams()
    {
        return array();
    }

    /**
     * @return array
     */
    public function getPostParams()
    {
        return $this->orderArray;
    }

    /**
     * @param $responseJSON
     * @return CalculateOrderApiResponse
     */
    public function handleResponse($responseJSON)
    {
        return new CalculateOrderApiResponse($responseJSON);
    }
}