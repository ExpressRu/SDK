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


use ExpressRuSDK\Api\Exceptions\ApiErrorException;
use ExpressRuSDK\Api\Exceptions\InvalidJsonException;
use ExpressRuSDK\Api\Exceptions\InvalidStructureException;
use ExpressRuSDK\Api\Exceptions\NoResponseReceivedException;

/**
 * Class ApiResponse
 * @package ExpressRuSDK\Api
 */
class ApiResponse
{
    /**
     * @var string
     */
    protected $response;

    /**
     * @var bool
     */
    protected $responseReceived = false;

    /**
     * @var bool
     */
    protected $invalidJSON = false;

    /**
     * @var bool
     */
    protected $invalidStructure = false;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var bool
     */
    protected $error = false;

    /**
     * @var
     */
    protected $error_msg;

    /**
     * @var array
     */
    protected $errors = array();

    /**
     * @var array
     */
    protected $result = array();


    /**
     * @param $responseJSON
     * @throws InvalidJsonException
     * @throws InvalidStructureException
     * @throws NoResponseReceivedException
     */
    public function __construct($responseJSON)
    {
        $this->processResponse($responseJSON);
    }

    /**
     * @param $responseJSON
     * @throws ApiErrorException
     * @throws InvalidJsonException
     * @throws InvalidStructureException
     * @throws NoResponseReceivedException
     */
    protected function processResponse($responseJSON)
    {
        if (!$responseJSON) {
            throw new NoResponseReceivedException($this);
        }

        $this->responseReceived = true;

        $responseArray = json_decode($responseJSON, true);

        if (!$responseArray) {
            $this->invalidJSON = true;
            throw new InvalidJsonException($this);
        }

        $this->response = $responseArray;

        if (!$this->structureOk($responseArray)) {
            $this->invalidStructure = true;
            throw new InvalidStructureException($this);
        }

        $this->status($responseArray);

        if (!$this->errors($responseArray)) {
            $this->result = $this->result($responseArray);
        }

    }

    /**
     * @param $responseArray
     * @return bool
     */
    protected function structureOk($responseArray)
    {
        if (!isset($responseArray['error'])) {
            return false;
        }

        if ($responseArray['error'] && (!isset($responseArray['errors']) && !isset($responseArray['error_msg']))) {
            return false;
        }

        if (!$responseArray['error'] && !isset($responseArray['result'])) {
            return false;
        }

        return true;
    }

    /**
     * @param $responseArray array
     */
    protected function status($responseArray)
    {
        $this->status = isset($responseArray['status']) ? $responseArray['status'] : null;
    }

    /**
     * @param $responseArray
     * @return bool
     * @throws ApiErrorException
     */
    protected function errors($responseArray)
    {
        if ($responseArray['error']) {
            $this->error = true;

            if (isset($responseArray['errors'])) {
                $this->errors = $responseArray['errors'];
            }
            if (isset($responseArray['error_msg'])) {
                $this->error_msg = $responseArray['error_msg'];
                throw new ApiErrorException($this, $responseArray['error_msg']);
            }
            if (isset($responseArray['errors']['global_error'])) {
                throw new ApiErrorException($this, $responseArray['errors']['global_error']);
            }
            return true;
        }
        return false;
    }

    /**
     * @param $responseArray
     * @return mixed
     */
    protected function result($responseArray)
    {
        return $responseArray['result'];
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->responseReceived && !$this->invalidJSON && !$this->invalidStructure && !$this->error;
    }

    /**
     * @return bool
     */
    public function isResponseReceived()
    {
        return $this->responseReceived;
    }

    /**
     * @return boolean
     */
    public function isInvalidJSON()
    {
        return $this->invalidJSON;
    }

    /**
     * @return boolean
     */
    public function isInvalidStructure()
    {
        return $this->invalidStructure;
    }

    /**
     * @return boolean
     */
    public function isError()
    {
        return $this->error;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }


}