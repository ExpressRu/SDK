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

/**
 * Class GetTrackingStatusesMethod
 * @package ExpressRuSDK\Api\Methods
 */
class GetTrackingStatusesMethod extends AbstractMethod
{

    /**
     * @var array
     */
    protected $numbers = array();
    /**
     * @var null
     */
    protected $startDateTime = null;

    /**
     * @param $numberS
     * @param $startDateTime
     * @throws \Exception
     */
    public function __construct($numberS, $startDateTime)
    {
        if (!is_array($numberS) and !is_scalar($numberS)) {
            throw new \Exception('$numberS can be string, int or array');
        }
        if (!is_array($numberS)) {
            $this->numbers = array($numberS);
        } else {
            $this->numbers = $numberS;
        }

        $this->startDateTime = $startDateTime;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'getTracking';
    }


    /**
     * @return array
     */
    public function getGetParams()
    {
        return array(
            'track_code' => implode(',', $this->numbers),
            'date' => $this->startDateTime
        );
    }

    /**
     * @return array
     */
    public function getPostParams()
    {
        return array();
    }

}