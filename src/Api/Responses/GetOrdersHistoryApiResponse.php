<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Api\Responses;

use ExpressRuSDK\Api\ApiResponse;

/**
 * Class GetOrdersHistoryApiResponse
 * @package ExpressRuSDK\Api\Responses
 */
class GetOrdersHistoryApiResponse extends ApiResponse
{

    /**
     * @var array
     */
    protected $ordersArray = array();

    /**
     * @return array
     */
    public function getOrdersArray()
    {
        return $this->ordersArray;
    }

    /**
     * @param $responseJSON
     */
    protected function processResponse($responseJSON)
    {
        parent::processResponse($responseJSON);
        if ($this->isSuccess()) {
            $this->ordersArray = $this->result['orders'];
        }
    }

    /**
     * @param $responseArray
     * @return bool
     */
    protected function structureOk($responseArray)
    {
        $baseStructureOk = parent::structureOk($responseArray);
        if ($baseStructureOk) {
            return isset($responseArray['result']['orders']) && is_array($responseArray['result']['orders']);
        }
        return $baseStructureOk;
    }
}