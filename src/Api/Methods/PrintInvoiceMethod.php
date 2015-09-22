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
use ExpressRuSDK\Api\Responses\GetOrderApiResponse;
use ExpressRuSDK\Api\Responses\PrintInvoiceApiResponse;

/**
 * Class PrintInvoiceMethod
 * @package ExpressRuSDK\Api\Methods
 */
class PrintInvoiceMethod extends AbstractMethod
{
    /**
     * @var
     */
    protected $orderNumber;

    /**
     * @param $orderNumber
     */
    public function __construct($orderNumber)
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'printInvoice';
    }


    /**
     * @return array
     */
    public function getGetParams()
    {
        return array(
            'orderNumber' => $this->orderNumber
        );
    }

    /**
     * @return array
     */
    public function getPostParams()
    {
        return array();
    }

    /**
     * @param $responseJSON
     * @return GetOrderApiResponse
     */
    public function handleResponse($responseJSON)
    {
        return new PrintInvoiceApiResponse($responseJSON);
    }
}