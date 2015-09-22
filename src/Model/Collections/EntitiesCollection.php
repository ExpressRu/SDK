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

/**
 * Class EntitiesCollection
 * @package ExpressRuSDK\Model\Collections
 */
class EntitiesCollection extends Collection
{

    /**
     * @param $key
     * @param $value
     * @return array
     */
    public function getAsArray($key, $value)
    {
        $arrayToReturn = array();
        foreach ($this as $entity) {
            $keyGetter = 'get' . ucfirst($key);
            $valueGetter = 'get' . ucfirst($value);
            $arrayToReturn[$entity->$keyGetter()] = $entity->$valueGetter();
        }
        return $arrayToReturn;
    }
}
