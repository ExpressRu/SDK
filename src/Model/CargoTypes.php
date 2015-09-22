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
 * Class CargoTypes
 * @package ExpressRuSDK\Model
 */
class CargoTypes
{

    /**
     * Документы
     */
    const CARGO_TYPE_DOCUMENTS = 'CARGO_TYPE::DOCUMENTS';

    /**
     * Груз
     */
    const CARGO_TYPE_CARGO = 'CARGO_TYPE::CARGO';

    /**
     * Негабаритный груз
     */
    const CARGO_TYPE_OVERSIZE_CARGO = 'CARGO_TYPE::OVERSIZE_CARGO';


    /**
     * @var array
     */
    protected static $cargoTypesForCalculate = array(
        self::CARGO_TYPE_DOCUMENTS => '3',
        self::CARGO_TYPE_CARGO => '2',
        self::CARGO_TYPE_OVERSIZE_CARGO => '1'
    );


    /**
     * @var array
     */
    protected static $cargoTypesToNames = array(
        self::CARGO_TYPE_DOCUMENTS => 'Документы',
        self::CARGO_TYPE_CARGO => 'Груз',
        self::CARGO_TYPE_OVERSIZE_CARGO => 'Негабаритный груз'
    );

    /**
     * @return array
     */
    static public function gerSelectArray()
    {
        return self::$cargoTypesToNames;
    }

    /**
     * @param $cargoType
     * @return null|string
     */
    public static function getNameForCargoType($cargoType)
    {
        return isset(self::$cargoTypesToNames[$cargoType]) ? self::$cargoTypesToNames[$cargoType] : null;
    }

    /**
     * @param $cargoType
     * @return null|string
     */
    static public function getCargoTypeForCalculate($cargoType)
    {
        return isset(self::$cargoTypesForCalculate[$cargoType]) ? self::$cargoTypesForCalculate[$cargoType] : null;
    }
}