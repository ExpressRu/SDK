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

class Tube extends AbstractCargoForm
{
    protected $length = 0;
    protected $sideA = 0;
    protected $sideB = 0;
    protected $sideC = 0;

    public function __construct($length = 0, $sideA = 0, $sideB = 0, $sideC =0) {
        $this->length = $length;
        $this->sideA = $sideA;
        $this->sideB = $sideB;
        $this->sideC = $sideC;
    }
    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param int $length
     * @return Tube
     */
    public function setLength($length)
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @return int
     */
    public function getSideA()
    {
        return $this->sideA;
    }

    /**
     * @param int $sideA
     * @return Tube
     */
    public function setSideA($sideA)
    {
        $this->sideA = $sideA;
        return $this;
    }

    /**
     * @return int
     */
    public function getSideB()
    {
        return $this->sideB;
    }

    /**
     * @param int $sideB
     * @return Tube
     */
    public function setSideB($sideB)
    {
        $this->sideB = $sideB;
        return $this;
    }

    /**
     * @return int
     */
    public function getSideC()
    {
        return $this->sideC;
    }

    /**
     * @param int $sideC
     * @return Tube
     */
    public function setSideC($sideC)
    {
        $this->sideC = $sideC;
        return $this;
    }


    /**
     * @return float
     */
    public function getVolumeWeight()
    {
        $x = ($this->sideA + $this->sideB + $this->sideC) / 2;
        $quad = sqrt($x * ($x - $this->sideA) * ($x - $this->sideB) * ($x - $this->sideC));
        return ceil(($quad * $this->length) / 5000);
    }
}