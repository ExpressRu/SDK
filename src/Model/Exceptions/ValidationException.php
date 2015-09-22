<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Model\Exceptions;

use Exception;
use ExpressRuSDK\Api\Responses\ValidatedResponse;

/**
 * Class ValidationException
 * @package ExpressRuSDK\Model\Exceptions
 */
class ValidationException extends ModelException
{

    /**
     * @var array|mixed
     */
    protected $errors = array();

    /**
     * @param ValidatedResponse $apiResponse
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(ValidatedResponse $apiResponse,  $message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($apiResponse, $message, $code, $previous);
        $this->errors = $apiResponse->getValidationErrors();
    }


    /**
     * @return array|mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

}