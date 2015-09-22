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


/**
 * Interface ValidatedResponse
 * @package ExpressRuSDK\Api\Responses
 */
interface ValidatedResponse
{
    /**
     * @return mixed
     */
    public function getValidationErrors();
}