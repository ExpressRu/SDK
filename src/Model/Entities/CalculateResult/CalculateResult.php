<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Model\Entities\CalculateResult;


use ExpressRuSDK\Model\Entities\AbstractEntity;

/**
 * Class CalculateResult
 * @package ExpressRuSDK\Model\Entities\CalculateResult
 */
class CalculateResult extends AbstractEntity
{

    /**
     * @var
     */
    protected $gid;
    /**
     * @var
     */
    protected $group;
    /**
     * @var
     */
    protected $name;
    /**
     * @var
     */
    protected $from;
    /**
     * @var
     */
    protected $to;
    /**
     * @var
     */
    protected $weightId;
    /**
     * @var
     */
    protected $type;
    /**
     * @var
     */
    protected $docType;
    /**
     * @var
     */
    protected $price;
    /**
     * @var
     */
    protected $priceKG;
    /**
     * @var
     */
    protected $weightFrom;
    /**
     * @var
     */
    protected $weightTo;
    /**
     * @var
     */
    protected $weightStep;
    /**
     * @var
     */
    protected $typeLabel;
    /**
     * @var
     */
    protected $tType;
    /**
     * @var
     */
    protected $dayFrom;
    /**
     * @var
     */
    protected $dayTo;
    /**
     * @var
     */
    protected $dayComment;
    /**
     * @var
     */
    protected $deliveryTime;
    /**
     * @var
     */
    protected $weight;
    /**
     * @var
     */
    protected $rawPrice;
    /**
     * @var
     */
    protected $endPointPayment;

    /**
     * @return mixed
     */
    public function getGid()
    {
        return $this->gid;
    }

    /**
     * @param mixed $gid
     * @return CalculateResult
     */
    public function setGid($gid)
    {
        $this->gid = $gid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param mixed $group
     * @return CalculateResult
     */
    public function setGroup($group)
    {
        $this->group = $group;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return CalculateResult
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $from
     * @return CalculateResult
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     * @return CalculateResult
     */
    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWeightId()
    {
        return $this->weightId;
    }

    /**
     * @param mixed $weightId
     * @return CalculateResult
     */
    public function setWeightId($weightId)
    {
        $this->weightId = $weightId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return CalculateResult
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDocType()
    {
        return $this->docType;
    }

    /**
     * @param mixed $docType
     * @return CalculateResult
     */
    public function setDocType($docType)
    {
        $this->docType = $docType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return CalculateResult
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPriceKG()
    {
        return $this->priceKG;
    }

    /**
     * @param mixed $priceKG
     * @return CalculateResult
     */
    public function setPriceKG($priceKG)
    {
        $this->priceKG = $priceKG;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWeightFrom()
    {
        return $this->weightFrom;
    }

    /**
     * @param mixed $weightFrom
     * @return CalculateResult
     */
    public function setWeightFrom($weightFrom)
    {
        $this->weightFrom = $weightFrom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWeightTo()
    {
        return $this->weightTo;
    }

    /**
     * @param mixed $weightTo
     * @return CalculateResult
     */
    public function setWeightTo($weightTo)
    {
        $this->weightTo = $weightTo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWeightStep()
    {
        return $this->weightStep;
    }

    /**
     * @param mixed $weightStep
     * @return CalculateResult
     */
    public function setWeightStep($weightStep)
    {
        $this->weightStep = $weightStep;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypeLabel()
    {
        return $this->typeLabel;
    }

    /**
     * @param mixed $typeLabel
     * @return CalculateResult
     */
    public function setTypeLabel($typeLabel)
    {
        $this->typeLabel = $typeLabel;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTType()
    {
        return $this->tType;
    }

    /**
     * @param mixed $tType
     * @return CalculateResult
     */
    public function setTType($tType)
    {
        $this->tType = $tType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDayFrom()
    {
        return $this->dayFrom;
    }

    /**
     * @param mixed $dayFrom
     * @return CalculateResult
     */
    public function setDayFrom($dayFrom)
    {
        $this->dayFrom = $dayFrom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDayTo()
    {
        return $this->dayTo;
    }

    /**
     * @param mixed $dayTo
     * @return CalculateResult
     */
    public function setDayTo($dayTo)
    {
        $this->dayTo = $dayTo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDayComment()
    {
        return $this->dayComment;
    }

    /**
     * @param mixed $dayComment
     * @return CalculateResult
     */
    public function setDayComment($dayComment)
    {
        $this->dayComment = $dayComment;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeliveryTime()
    {
        return $this->deliveryTime;
    }

    /**
     * @param mixed $deliveryTime
     * @return CalculateResult
     */
    public function setDeliveryTime($deliveryTime)
    {
        $this->deliveryTime = $deliveryTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     * @return CalculateResult
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRawPrice()
    {
        return $this->rawPrice;
    }

    /**
     * @param mixed $rawPrice
     * @return CalculateResult
     */
    public function setRawPrice($rawPrice)
    {
        $this->rawPrice = $rawPrice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndPointPayment()
    {
        return $this->endPointPayment;
    }

    /**
     * @param mixed $endPointPayment
     * @return CalculateResult
     */
    public function setEndPointPayment($endPointPayment)
    {
        $this->endPointPayment = $endPointPayment;
        return $this;
    }

    /**
     * @param int $number
     * @param int $percent
     */
    public function makeDiscount($number = 0, $percent = 0)
    {
        $this->rawPrice = $this->getRawPriceWDiscount($number, $percent);
        $this->price = (string)$this->rawPrice . ' руб.';
    }

    /**
     * @param int $number
     * @param int $percent
     * @return float
     */
    public function getRawPriceWDiscount($number = 0, $percent = 0)
    {
        return ceil($this->rawPrice - $this->rawPrice / 100 * $percent) - $number;
    }
}