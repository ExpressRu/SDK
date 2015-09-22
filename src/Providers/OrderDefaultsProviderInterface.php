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


/**
 * Interface OrderDefaultsProviderInterface
 * @package ExpressRuSDK\Providers
 */
interface OrderDefaultsProviderInterface
{

    /**
     * @return string
     */
    public function getClientContact();

    /**
     * @return string
     */
    public function getPayer();

    /**
     * @return string
     */
    public function getTypeOfPayment();

    /**
     * @return int
     */
    public function getItems();

    /**
     * @return float
     */
    public function getWeight();

    /**
     * @return string
     */
    public function getSender();

    /**
     * @return string
     */
    public function getSenderCity();

    /**
     * @return string
     */
    public function getSenderCountry();

    /**
     * @return string
     */
    public function getSenderAddress();

    /**
     * @return string
     */
    public function getSenderContact();

    /**
     * @return string
     */
    public function getSenderPhone();

    /**
     * @return string
     */
    public function getUrgency();

    /**
     * @return string
     */
    public function getCargoType();

    /**
     * @return bool
     */
    public function getReceivedInOffice();

    /**
     * @return bool
     */
    public function getSelfPickup();
}