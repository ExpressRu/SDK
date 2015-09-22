<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Model\Entities\CalculateResult;

use ExpressRuSDK\Model\Entities\AbstractMapper;

/**
 * Class CalculateResultMapper
 * @package ExpressRuSDK\Model\Entities\CalculateResult
 */
class CalculateResultMapper extends AbstractMapper
{
    /**
     * @param CalculateResult $calculateResult
     * @param $calculateResultArray
     * @return CalculateResult
     */
    public function mapFromArrayOneToOne(CalculateResult $calculateResult, $calculateResultArray)
    {
        $this->mapEntityFromArray($calculateResult, $calculateResultArray);
        return $calculateResult;
    }
}