<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */

namespace ExpressRuSDK\Model\Collections;


use ExpressRuSDK\Model\Entities\Order\ExpressRuOrderInterface;

/**
 * Class OrdersCollection
 * @package ExpressRuSDK\Model\Collections
 */
class OrdersCollection extends EntitiesCollection
{

    /**
     * @param ExpressRuOrderInterface $order
     */
    public function add(ExpressRuOrderInterface $order)
    {
        parent::set($order->getExpressRuNumber(), $order);
    }

    /**
     * @param $number
     * @return ExpressRuOrderInterface|null
     */
    public function getByExpressRuNumber($number)
    {
        return isset($this->collection[$number]) ? $this->collection[$number] : null;
    }

}