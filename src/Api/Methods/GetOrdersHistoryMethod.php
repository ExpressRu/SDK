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
use ExpressRuSDK\Api\Responses\GetOrdersHistoryApiResponse;

/**
 * Class GetOrdersHistoryMethod
 * @package ExpressRuSDK\Api\Methods
 */
class GetOrdersHistoryMethod extends AbstractMethod
{
    /**
     * @var \DateTime
     */
    protected $startDate;

    /**
     * @var \DateTime
     */
    protected $toDate;

    /**
     * @param \DateTime $startDate
     * @param \DateTime $toDate
     */
    public function __construct(\DateTime $startDate, \DateTime $toDate)
    {
        $this->startDate = $startDate;
        $this->toDate = $toDate;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'getHistory';
    }


    /**
     * @return array
     */
    public function getGetParams()
    {
        return array(
            'startDate' => $this->startDate->format('Y-m-d'),
            'toDate' => $this->toDate->format('Y-m-d'),
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
     * @return GetOrdersHistoryApiResponse
     */
    public function handleResponse($responseJSON)
    {
        return new GetOrdersHistoryApiResponse($responseJSON);
    }
}