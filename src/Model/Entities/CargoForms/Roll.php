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


class Roll extends AbstractCargoForm
{
    /**
     * @var int
     */
    protected $length;

    /**
     * @var int
     */
    protected $radius;

    /**
     * @param int $length
     * @param int $radius
     */
    public function __construct($length = 0, $radius = 0) {
        $this->length = $length;
        $this->radius = $radius;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param mixed $length
     * @return Roll
     */
    public function setLength($length)
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * @param mixed $radius
     * @return Roll
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;
        return $this;
    }

    /**
     * @return float
     */
    public function getVolumeWeight()
    {
        return ceil(($this->radius * $this->radius * $this->length * 3.14) / 5000);
    }
}