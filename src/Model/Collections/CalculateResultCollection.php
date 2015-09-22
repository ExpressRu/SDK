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
 * Class CalculateResultCollection
 * @package ExpressRuSDK\Model\Collections
 */
class CalculateResultCollection extends EntitiesCollection
{
    /**
     * @var array
     */
    protected $resultsByUrgency = array();

    /**
     * @param mixed $entity
     * @return bool|void
     */
    public function add($entity)
    {
        parent::add($entity);
        $this->resultsByUrgency[$entity->getTypeLabel()] = $entity;
    }

    /**
     * @param $urgency
     * @return array
     */
    public function getByUrgency($urgency)
    {
        return isset($this->resultsByUrgency[$urgency]) ? $this->resultsByUrgency[$urgency] : null;
    }

}