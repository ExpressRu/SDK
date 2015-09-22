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
 * Class Box
 * @package ExpressRuSDK\Model\Entities\CargoForms
 */
class Box extends AbstractCargoForm
{
    /**
     * @var int
     */
    protected $width;

    /**
     * @var int
     */
    protected $height;

    /**
     * @var int
     */
    protected $length;

    /**
     * @param int $width
     * @param int $height
     * @param int $length
     */
    public function __construct($width = 0, $height = 0, $length = 0) {
        $this->width = $width;
        $this->height = $height;
        $this->length = $length;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     * @return Box
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     * @return Box
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
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
     * @return Box
     */
    public function setLength($length)
    {
        $this->length = $length;
        return $this;
    }


    /**
     * @return float
     */
    public function getVolumeWeight()
    {
        return ceil(($this->length * $this->width * $this->height) / 5000);
    }

}