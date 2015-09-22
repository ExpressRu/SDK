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
 * Class CalculateOrderApiResponse
 * @package ExpressRuSDK\Api\Responses
 */
class CalculateOrderApiResponse extends ApiResponse
{

    /**
     * @param $responseArray
     * @return bool
     */
    protected function structureOk($responseArray)
    {
        $baseStructureOk = parent::structureOk($responseArray);
        if ($baseStructureOk && ($responseArray['result'])) {
            return is_array($responseArray['result']);
        }
        return $baseStructureOk;
    }
}