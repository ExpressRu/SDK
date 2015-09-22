<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Model\Entities\Order;


use ExpressRuSDK\Model\Entities\AbstractEntityMetadata;

/**
 * Class OrderMetadata
 * @package ExpressRuSDK\Model\Entities\Order
 */
class OrderMetadata extends AbstractEntityMetadata
{

    /**
     * @return string
     */
    public function getEntityClassName()
    {
        return Order::getClassName();
    }


    /**
     *
     */
    protected function defineShortName()
    {
        $this->shortName = Order::shortName;
    }

    /**
     *
     */
    protected function definePropertiesFieldsNames()
    {
        $this->setPropertiesFieldsNames(array(
            'expressRuNumber',
            'creationDate',
            'pickupDate',
            'pickupTime',
            'sender',
            'senderCity',
            'senderCountry',
            'senderAddress',
            'senderContact',
            'senderPhone',
            'recipient',
            'recipientCity',
            'recipientCountry',
            'recipientAddress',
            'recipientContact',
            'recipientPhone',
            'cargoType',
            'cargoForm',
            'description',
            'items',
            'weight',
            'volumeWeight',
            'comment',
            'clientContact',
            'urgency',
            'payer',
            'typeOfPayment',
            'status',
            'statusCode',
            'payStatus',
            'cashOnDelivery',
            'selfPickup',
            'receivedInOffice',
            'sum'
        ));
    }
}