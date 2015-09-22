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
 * Class StatusesCollection
 * @package ExpressRuSDK\Model\Collections
 */
class StatusesCollection extends EntitiesCollection
{

    /**
     *
     * @param \ExpressRuSDK\Model\Entities\AbstractEntity $entity
     * @return bool|void
     */
    public function add($entity)
    {
        parent::set($entity->getId(), $entity);
    }
}