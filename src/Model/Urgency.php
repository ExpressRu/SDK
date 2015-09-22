<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Model;


/**
 * Class Urgency
 * @package ExpressRuSDK\Model
 */
class Urgency
{
    /**
     * Стандартная
     */
    const STANDARD = "URGENCY::STANDARD";

    /**
     * Срочная
     */
    const URGENT = "URGENCY::URGENT";

    /**
     * Сверхсрочная
     */
    const EXTRA_URGENT = "URGENCY::EXTRA_URGENT";

    /**
     * Стандартная к определенному времени
     */
    const STANDARD_GIVEN_TIME = "URGENCY::STANDARD_GIVEN_TIME";

    /**
     * @var array
     */
    protected static $urgencyToNames = array(
        self::STANDARD => 'Стандартная',
        self::URGENT => 'Срочная',
        self::EXTRA_URGENT => 'Сверхсрочная',
        self::STANDARD_GIVEN_TIME => 'Стандартная к опред.времени'
    );

    /**
     * @return array
     */
    public static function getAsArray()
    {
        return array(
            self::STANDARD,
            self::URGENT,
            self::EXTRA_URGENT,
            self::STANDARD_GIVEN_TIME
        );
    }

    /**
     * @param $name
     * @return null
     */
    public static function getUrgencyForName($name) {
        $nameToUrgencyArray = array_flip(self::$urgencyToNames);
        return isset($nameToUrgencyArray[$name]) ? $nameToUrgencyArray[$name] : null;
    }
}