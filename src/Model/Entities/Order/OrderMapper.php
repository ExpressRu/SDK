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

use ExpressRuSDK\Model\CargoTypes;
use ExpressRuSDK\Model\Entities\AbstractMapper;
use ExpressRuSDK\Model\Entities\CargoForms\Box;
use ExpressRuSDK\Model\Entities\CargoForms\Roll;
use ExpressRuSDK\Model\Entities\CargoForms\Tube;

/**
 * Class OrderMapper
 * @package ExpressRuSDK\Model\Entities\Order
 */
class OrderMapper extends AbstractMapper
{
    /**
     * @var array
     */
    protected $orderToApiPairs = array();

    /**
     * @var array
     */
    protected $orderFromApiPairs = array(
        'expressRuNumber' => 'number'
    );

    /**
     * @var array
     */
    protected $orderToApiCalculatePairs = array(
        'senderCountry' => 'country_from',
        'senderCity' => 'place_from',
        'recipientCountry' => 'country_to',
        'recipientCity' => 'place_to',
        'cargoType' => 'cargo_type', //Вид груза. 1 — крупногабаритный груз, 2 — груз, 3 — документы
        'weight' => 'weight',
        'items' => 'items',
        'fragile' => 'fragile',
    );


    /**
     * @param ExpressRuOrderInterface $order
     * @return array
     * @throws \Exception
     */
    public function mapOrderToApiCalculateArray(ExpressRuOrderInterface $order)
    {
        $resultArray = $this->mapArrayToArrayUsingPairs($this->getAsArray($order), $this->orderToApiCalculatePairs, true);
        $resultArray['cargo_type'] = CargoTypes::getCargoTypeForCalculate($order->getCargoType());

        $cargoForm = $order->getCargoForm();

        if ($cargoForm instanceof Box) {
            $resultArray['cargo_form'] = 2;
            $resultArray['box_length'] = $cargoForm->getLength();
            $resultArray['box_width'] = $cargoForm->getWidth();
            $resultArray['box_height'] = $cargoForm->getHeight();
        } elseif ($cargoForm instanceof Roll) {
            $resultArray['cargo_form'] = 3;
            $resultArray['rulon_length'] = $cargoForm->getLength();
            $resultArray['rulon_radius'] = $cargoForm->getRadius();
        } elseif (($cargoForm instanceof Tube)) {
            $resultArray['cargo_form'] = 1;
            $resultArray['tubus_length'] = $cargoForm->getLength();
            $resultArray['tubus_side_a'] = $cargoForm->getSideA();
            $resultArray['tubus_side_b'] = $cargoForm->getSideB();
            $resultArray['tubus_side_c'] = $cargoForm->getSideC();
        }

        return $resultArray;
    }

    /**
     * @param array $array
     * @param array $pairs
     * @param bool|false $exclude
     * @return array
     */
    protected function mapArrayToArrayUsingPairs(array $array, $pairs = array(), $exclude = false)
    {
        if (!$pairs) {
            return $array;
        }
        $result = array();
        foreach ($array as $field => $value) {
            if (isset($pairs[$field])) {
                $result[$pairs[$field]] = $value;
            } elseif (!$exclude) {
                $result[$field] = $value;
            }
        }
        return $result;
    }

    /**
     * @param ExpressRuOrderInterface $order
     * @return array
     * @throws \Exception
     */
    public function mapOrderToApiArray(ExpressRuOrderInterface $order)
    {
        $orderArray = $this->getAsArray($order);
        $apiArray = $this->mapArrayToArrayUsingPairs($orderArray, $this->orderToApiPairs);

        //$apiArray['cargoType'] = '.';

        $cargoForm = $order->getCargoForm();

        if ($cargoForm instanceof Box) {
            $apiArray['cargoForm'] = 'Box';
            $apiArray['boxLength'] = $cargoForm->getLength();
            $apiArray['boxWidth'] = $cargoForm->getWidth();
            $apiArray['boxHeight'] = $cargoForm->getHeight();
        } elseif ($cargoForm instanceof Roll) {
            $apiArray['cargoForm'] = 'Roll';
            $apiArray['rollLength'] = $cargoForm->getLength();
            $apiArray['rollRadius'] = $cargoForm->getRadius();
        } elseif (($cargoForm instanceof Tube)) {
            $apiArray['cargoForm'] = 'Tube';
            $apiArray['tubeLength'] = $cargoForm->getLength();
            $apiArray['tubeSideA'] = $cargoForm->getSideA();
            $apiArray['tubeSideB'] = $cargoForm->getSideB();
            $apiArray['tubeSideC'] = $cargoForm->getSideC();
        }


        return $apiArray;
    }

    /**
     * @param $order
     * @param $apiResponseArray
     */
    public function mapOrderFromGetOrderApiResponseArray($order, $apiResponseArray)
    {
        $orderProperties = $this->entityMetadataObject->getPropertiesFieldsNames();

        foreach ($orderProperties as $orderField) {

            if (isset($this->orderFromApiPairs[$orderField])) {
                $apiResponseField = $this->orderFromApiPairs[$orderField];
            } else {
                $apiResponseField = $orderField;
            }

            $value = isset($apiResponseArray[$apiResponseField]) ? $apiResponseArray[$apiResponseField] : null;
            $setter = 'set' . ucfirst($orderField);
            if (method_exists($order, $setter) && $value !== null) {
                $order->$setter($value);
            }
        }
    }
}