<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Model\Entities;

use ExpressRuSDK\Api\ApiTransmitter;

/**
 * Class AbstractApiRepository
 * @package ExpressRuSDK\Model\Entities
 */
class AbstractApiRepository
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