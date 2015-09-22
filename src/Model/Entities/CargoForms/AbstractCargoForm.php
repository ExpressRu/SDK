<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Model\Entities\CargoForms;


/**
 * Class AbstractCargoForm
 * @package ExpressRuSDK\Model\Entities\CargoForms
 */
abstract class AbstractCargoForm
{

    /**
     * @return float
     */
    abstract public function getVolumeWeight();
}