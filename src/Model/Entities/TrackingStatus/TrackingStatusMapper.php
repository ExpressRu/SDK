<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Model\Entities\TrackingStatus;


use ExpressRuSDK\Model\Entities\AbstractMapper;

/**
 * Class TrackingStatusMapper
 * @package ExpressRuSDK\Model\Entities\TrackingStatus
 */
class TrackingStatusMapper extends AbstractMapper
{
    /**
     * @param TrackingStatus $status
     * @param array $array
     */
    public function mapStatusFromArray(TrackingStatus $status, array $array)
    {
        $this->mapEntityFromArray($status, $array);
    }
}