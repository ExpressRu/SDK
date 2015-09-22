<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\API\Responses;


use ExpressRuSDK\Api\ApiResponse;

/**
 * Class GetOrderApiResponse
 * @package ExpressRuSDK\API\Responses
 */
class GetOrderApiResponse extends ApiResponse
{

    /**
     * @var array
     */
    protected $orderArray;

    /**
     * @var bool
     */
    protected $notFound = false;

    /**
     * @return boolean
     */
    public function isNotFound()
    {
        return $this->notFound;
    }

    /**
     * @return array
     */
    public function getOrderArray()
    {
        return $this->orderArray;
    }

    /**
     * @param $responseJSON
     */
    protected function processResponse($responseJSON)
    {
        parent::processResponse($responseJSON);
        if ($this->isSuccess()) {
            $this->orderArray = $this->result['order'];
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
            if (!$responseArray['error']) {
                return isset($responseArray['result']['order']);
            }
        }
        return $baseStructureOk;
    }

    /**
     * @param $responseArray
     * @return bool
     */
    protected function errors($responseArray)
    {
        if (parent::errors($responseArray)) {
            if ($this->status == 'NotFound') {
                $this->notFound = true;
            }
        }
    }
}