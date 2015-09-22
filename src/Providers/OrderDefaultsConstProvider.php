<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Providers;


use ExpressRuSDK\OrderDefaults;

/**
 * Class OrderDefaultsConstProvider
 * @package ExpressRuSDK\Providers
 */
class OrderDefaultsConstProvider implements OrderDefaultsProviderInterface
{

    /**
     * @return string
     */
    public function getClientContact()
    {
        return OrderDefaults::CLIENT_CONTACT;
    }

    /**
     * @return string
     */
    public function getPayer()
    {
        return OrderDefaults::PAYER;
    }

    /**
     * @return string
     */
    public function getTypeOfPayment()
    {
        return OrderDefaults::TYPE_OF_PAYMENT;
    }

    /**
     * @return int
     */
    public function getItems()
    {
        return OrderDefaults::ITEMS;
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return OrderDefaults::WEIGHT;
    }

    /**
     * @return string
     */
    public function getSender()
    {
        return OrderDefaults::SENDER;
    }

    /**
     * @return string
     */
    public function getSenderCountry()
    {
        return OrderDefaults::SENDER_COUNTRY;
    }

    /**
     * @return string
     */
    public function getSenderCity()
    {
        return OrderDefaults::SENDER_CITY;
    }

    /**
     * @return string
     */
    public function getSenderAddress()
    {
        return OrderDefaults::SENDER_ADDRESS;
    }

    /**
     * @return string
     */
    public function getSenderContact()
    {
        return OrderDefaults::SENDER_CONTACT;
    }

    /**
     * @return string
     */
    public function getSenderPhone()
    {
        return OrderDefaults::SENDER_PHONE;
    }

    /**
     * @return string
     */
    public function getUrgency()
    {
        return OrderDefaults::URGENCY;
    }

    /**
     * @return mixed
     */
    public function getCargoType()
    {
        return OrderDefaults::CARGO_TYPE;
    }

    /**
     * @return bool
     */
    public function getReceivedInOffice()
    {
        return OrderDefaults::RECEIVED_IN_OFFICE;
    }

    /**
     * @return bool
     */
    public function getSelfPickup()
    {
        return OrderDefaults::SELF_PICKUP;
    }

}