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
use ExpressRuSDK\Api\Responses\CreateOrderApiResponse;

/**
 * Class CreateOrderMethod
 * @package ExpressRuSDK\Api\Methods
 */
class CreateOrderMethod extends AbstractMethod
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
        return 'createOrder';
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
        return array(
            'data' => json_encode($this->orderArray)
        );
    }

    /**
     * @param $responseJSON
     * @return CreateOrderApiResponse
     */
    public function handleResponse($responseJSON)
    {
        return new CreateOrderApiResponse($responseJSON);
    }
}