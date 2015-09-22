<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Service;

use ExpressRuSDK\Api\ApiTransmitter;

/**
 * Class AbstractService
 * @package ExpressRuSDK\Service
 */
abstract class AbstractService
{

    /**
     * @var ApiTransmitter
     */
    protected $apiTransmitter;

    /**
     * @param ApiTransmitter $apiTransmitter
     */
    public function __construct(ApiTransmitter $apiTransmitter)
    {
        $this->apiTransmitter = $apiTransmitter;
    }

}