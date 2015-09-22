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


use ExpressRuSDK\Model\Entities\AbstractEntityMetadata;

/**
 * Class CalculateResultMetadata
 * @package ExpressRuSDK\Model\Entities\CalculateResult
 */
class CalculateResultMetadata extends AbstractEntityMetadata
{
    /**
     * @return string
     */
    public function getEntityClassName()
    {
        return CalculateResult::getClassName();
    }

    /**
     *
     */
    protected function defineShortName()
    {
        $this->shortName = CalculateResult::shortName;
    }

    /**
     *
     */
    protected function definePropertiesFieldsNames()
    {
        $this->setPropertiesFieldsNames(array(
            'gid',
            'group',
            'name',
            'from',
            'to',
            'weightId',
            'type',
            'docType',
            'price',
            'priceKG',
            'weightFrom',
            'weightTo',
            'weightStep',
            'typeLabel',
            'tType',
            'dayFrom',
            'dayTo',
            'dayComment',
            'deliveryTime',
            'weight',
            'rawPrice',
            'endPointPayment',
        ));
    }
}