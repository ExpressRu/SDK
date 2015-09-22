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


use ExpressRuSDK\Model\Entities\AbstractEntityMetadata;

/**
 * Class TrackingStatusMetadata
 * @package ExpressRuSDK\Model\Entities\TrackingStatus
 */
class TrackingStatusMetadata extends AbstractEntityMetadata
{

    /**
     * @return string
     */
    public function getEntityClassName()
    {
        return TrackingStatus::getClassName();
    }


    /**
     *
     */
    protected function defineShortName()
    {
        $this->shortName = TrackingStatus::shortName;
    }

    /**
     *
     */
    protected function definePropertiesFieldsNames()
    {
        $this->setPropertiesFieldsNames(array(
            'date',
            'note',
            'status'
        ));
    }
}