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
 * Class CreateOrderApiResponse
 * @package ExpressRuSDK\Api\Responses
 */
class CreateOrderApiResponse extends ApiResponse implements ValidatedResponse
{

    /**
     * @var string
     */
    protected $orderNumber;


    /**
     * @var
     */
    protected $validationErrors = array();

    /**
     * @return mixed
     */
    public function getValidationErrors()
    {
        return $this->validationErrors;
    }

    /**
     * @return mixed
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @param $responseJSON
     */
    protected function processResponse($responseJSON)
    {
        parent::processResponse($responseJSON);
        if ($this->isSuccess()) {
            $this->orderNumber = trim($this->result['orderNumber']);
        }
    }

    /**
     * @param $responseArray
     * @return bool
     */
    protected function structureOk($responseArray)
    {
        $baseStructureOk = parent::structureOk($responseArray);
        /*if($baseStructureOk) {
            return isset($responseArray['result']['orderNumber']);
        }*/
        return $baseStructureOk;
    }

    /**
     * @param $responseArray
     * @return bool
     */
    protected function errors($responseArray)
    {
        parent::errors($responseArray);
        if (isset($this->errors['validationErrors'])) {
            $this->validationErrors = $this->errors['validationErrors'];
        }
    }
}
