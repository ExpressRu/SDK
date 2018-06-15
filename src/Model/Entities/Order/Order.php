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

use ExpressRuSDK\Model\Collections\StatusesCollection;
use ExpressRuSDK\Model\Entities\AbstractEntity;
use ExpressRuSDK\Model\Entities\AbstractEntityMetadata;
use ExpressRuSDK\Model\Entities\CargoForms\AbstractCargoForm;
use ExpressRuSDK\Providers\OrderDefaultsProviderInterface;

/**
 * Class Order
 * @package ExpressRuSDK\Model\Entities\Order
 */
class Order extends AbstractEntity implements ExpressRuOrderInterface
{
    /**
     * @var
     */
    protected $expressRuNumber;
    /**
     * @var
     */
    protected $creationDate;
    /**
     * @var
     */
    protected $pickupDate;
    /**
     * @var
     */
    protected $pickupTime;
    /**
     * @var string
     */
    protected $sender;
    /**
     * @var string
     */
    protected $senderCity;
    /**
     * @var string
     */
    protected $senderCountry;
    /**
     * @var string
     */
    protected $senderAddress;
    /**
     * @var string
     */
    protected $senderContact;
    /**
     * @var string
     */
    protected $senderPhone;
    /**
     * @var string
     */
    protected $senderZip;
    /**
     * @var
     */
    protected $recipient;
    /**
     * @var
     */
    protected $recipientCity;
    /**
     * @var
     */
    protected $recipientCountry;
    /**
     * @var
     */
    protected $recipientAddress;
    /**
     * @var
     */
    protected $recipientContact;
    /**
     * @var
     */
    protected $recipientPhone;
    /**
     * @var
     */
    protected $recipientZip;
    /**
     * @var
     */
    protected $description;
    /**
     * @var string
     */
    protected $cargoType;

    /**
     * @var AbstractCargoForm
     */
    protected $cargoForm;
    /**
     * @var int
     */
    protected $items = 1;
    /**
     * @var float
     */
    protected $weight;

    /**
     * Объемный вес
     * @var int
     */
    protected $volumeWeight;

    /**
     * Объемный вес установлен вручную
     * @var bool
     */
    protected $volumeWeightManuallySet = false;
    /**
     * @var
     */
    protected $comment;
    /**
     * @var string
     */
    protected $clientContact;
    /**
     * @var
     */
    protected $urgency;
    /**
     * @var string
     */
    protected $payer;
    /**
     * @var string
     */
    protected $typeOfPayment;
    /**
     * @var
     */
    protected $status;
    /**
     * @var
     */
    protected $statusCode;
    /**
     * @var
     */
    protected $payStatus;
    /**
     * @var
     */
    protected $cashOnDelivery;
    /**
     * @var
     */
    protected $selfPickup;
    /**
     * @var
     */
    protected $receivedInOffice;
    /**
     * @var
     */
    protected $sum;


    /**
     * @var \ExpressRuSDK\Model\Collections\StatusesCollection
     */
    protected $statusesCollection = array();

    /**
     *
     */
    public function __construct()
    {
        parent::__construct(null);
    }


    /**
     * @param AbstractEntityMetadata $entityMetadataObject
     */
    public function setMetadataObject(AbstractEntityMetadata $entityMetadataObject)
    {
        $this->entityMetadataObject = $entityMetadataObject;
    }

    /**
     * @param OrderDefaultsProviderInterface $orderDefaultsProvider
     */
    public function setDefaultsFromProvider(OrderDefaultsProviderInterface $orderDefaultsProvider)
    {
        $this->clientContact = $orderDefaultsProvider->getClientContact();
        $this->payer = $orderDefaultsProvider->getPayer();
        $this->typeOfPayment = $orderDefaultsProvider->getTypeOfPayment();
        $this->items = $orderDefaultsProvider->getItems();
        $this->weight = $orderDefaultsProvider->getWeight();
        $this->sender = $orderDefaultsProvider->getSender();
        $this->senderCity = $orderDefaultsProvider->getSenderCity();
        $this->senderCountry = $orderDefaultsProvider->getSenderCountry();
        $this->senderAddress = $orderDefaultsProvider->getSenderAddress();
        $this->senderContact = $orderDefaultsProvider->getSenderContact();
        $this->senderPhone = $orderDefaultsProvider->getSenderPhone();
        $this->urgency = $orderDefaultsProvider->getUrgency();
        $this->receivedInOffice = $orderDefaultsProvider->getReceivedInOffice();
        $this->selfPickup = $orderDefaultsProvider->getSelfPickup();
        $this->cargoType = $orderDefaultsProvider->getCargoType();
    }

    /**
     * @return mixed
     */
    public function getExpressRuNumber()
    {
        return $this->expressRuNumber;
    }

    /**
     * @param mixed $expressRuNumber
     * @return $this
     */
    public function setExpressRuNumber($expressRuNumber)
    {
        $this->expressRuNumber = $expressRuNumber;
        return $this;
    }

    /**
     * @param string $format
     * @return string
     */
    public function getCreationDate($format = 'd-m-Y')
    {
        if ($this->creationDate instanceof \DateTime) {
            return $this->creationDate->format($format);
        } else {
            return $this->creationDate;
        }
    }

    /**
     * @param mixed $creationDate
     * @return Order
     */
    public function setCreationDate($creationDate)
    {
        if (strtotime($creationDate)) {
            $this->creationDate = new \DateTime($creationDate);
        } else {
            $this->creationDate = $creationDate;
        }
        return $this;
    }


    /**
     * @param string $format
     * @return string
     */
    public function getPickupDate($format = 'd-m-Y')
    {
        if ($this->pickupDate instanceof \DateTime) {
            return $this->pickupDate->format($format);
        } else {
            return $this->pickupDate;
        }
    }

    /**
     * @param $pickupDate
     * @return $this
     */
    public function setPickupDate($pickupDate)
    {
        if (strtotime($pickupDate)) {
            $this->pickupDate = new \DateTime($pickupDate);
        } else {
            $this->pickupDate = $pickupDate;
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPickupTime()
    {
        return $this->pickupTime;
    }

    /**
     * @param mixed $pickupTime
     * @return Order
     */
    public function setPickupTime($pickupTime)
    {
        $this->pickupTime = $pickupTime;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param mixed $sender
     * @return $this
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSenderCity()
    {
        return $this->senderCity;
    }

    /**
     * @param mixed $senderCity
     * @return $this
     */
    public function setSenderCity($senderCity)
    {
        $this->senderCity = $senderCity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSenderCountry()
    {
        return $this->senderCountry;
    }

    /**
     * @param mixed $senderCountry
     * @return Order
     */
    public function setSenderCountry($senderCountry)
    {
        $this->senderCountry = $senderCountry;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getSenderAddress()
    {
        return $this->senderAddress;
    }

    /**
     * @param mixed $senderAddress
     * @return $this
     */
    public function setSenderAddress($senderAddress)
    {
        $this->senderAddress = $senderAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSenderContact()
    {
        return $this->senderContact;
    }

    /**
     * @param mixed $senderContact
     * @return $this
     */
    public function setSenderContact($senderContact)
    {
        $this->senderContact = $senderContact;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSenderPhone()
    {
        return $this->senderPhone;
    }

    /**
     * @param mixed $senderPhone
     * @return $this
     */
    public function setSenderPhone($senderPhone)
    {
        $this->senderPhone = $senderPhone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSenderZip()
    {
        return $this->senderZip;
    }

    /**
     * @param mixed $senderZip
     * @return $this
     */
    public function setSenderZip($senderZip)
    {
        $this->senderZip = $senderZip;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param mixed $recipient
     * @return $this
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecipientCity()
    {
        return $this->recipientCity;
    }

    /**
     * @param mixed $recipientCity
     * @return $this
     */
    public function setRecipientCity($recipientCity)
    {
        $this->recipientCity = $recipientCity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecipientCountry()
    {
        return $this->recipientCountry;
    }

    /**
     * @param mixed $recipientCountry
     * @return Order
     */
    public function setRecipientCountry($recipientCountry)
    {
        $this->recipientCountry = $recipientCountry;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getRecipientAddress()
    {
        return $this->recipientAddress;
    }

    /**
     * @param mixed $recipientAddress
     * @return $this
     */
    public function setRecipientAddress($recipientAddress)
    {
        $this->recipientAddress = $recipientAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecipientContact()
    {
        return $this->recipientContact;
    }

    /**
     * @param mixed $recipientContact
     * @return $this
     */
    public function setRecipientContact($recipientContact)
    {
        $this->recipientContact = $recipientContact;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecipientPhone()
    {
        return $this->recipientPhone;
    }

    /**
     * @param mixed $recipientPhone
     * @return $this
     */
    public function setRecipientPhone($recipientPhone)
    {
        $this->recipientPhone = $recipientPhone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecipientZip()
    {
        return $this->recipientZip;
    }

    /**
     * @param mixed $recipientZip
     * @return $this
     */
    public function setRecipientZip($recipientZip)
    {
        $this->recipientZip = $recipientZip;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param mixed $items
     * @return $this
     */
    public function setItems($items)
    {
        $this->items = $items;
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
     * @return $this
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return int
     */
    public function getVolumeWeight()
    {
        if ($this->volumeWeightManuallySet) {
            return $this->volumeWeight;
        }
        if ($this->cargoForm) {
            return $this->cargoForm->getVolumeWeight();
        }
        return 0;
    }

    /**
     * @param mixed $volumeWeight
     * @return $this
     */
    public function setVolumeWeight($volumeWeight)
    {
        $volumeWeight = (int)$volumeWeight;
        if ($volumeWeight) {
            $this->volumeWeight = $volumeWeight;
            $this->volumeWeightManuallySet = true;
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     * @return $this
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClientContact()
    {
        return $this->clientContact;
    }

    /**
     * @param mixed $clientContact
     * @return $this
     */
    public function setClientContact($clientContact)
    {
        $this->clientContact = $clientContact;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * @param mixed $payer
     * @return $this
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypeOfPayment()
    {
        return $this->typeOfPayment;
    }

    /**
     * @param mixed $typeOfPayment
     * @return $this
     */
    public function setTypeOfPayment($typeOfPayment)
    {
        $this->typeOfPayment = $typeOfPayment;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrgency()
    {
        return $this->urgency;
    }

    /**
     * @param mixed $urgency
     * @return Order
     */
    public function setUrgency($urgency)
    {
        $this->urgency = $urgency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return Order
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return Order
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayStatus()
    {
        return $this->payStatus;
    }

    /**
     * @param mixed $payStatus
     * @return Order
     */
    public function setPayStatus($payStatus)
    {
        $this->payStatus = $payStatus;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCashOnDelivery()
    {
        return $this->cashOnDelivery;
    }

    /**
     * @param mixed $cashOnDelivery
     * @return Order
     */
    public function setCashOnDelivery($cashOnDelivery)
    {
        $this->cashOnDelivery = $cashOnDelivery;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSelfPickup()
    {
        return $this->selfPickup;
    }

    /**
     * @param $selfPickup
     * @return $this
     */
    public function setSelfPickup($selfPickup)
    {
        $this->selfPickup = $selfPickup;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReceivedInOffice()
    {
        return $this->receivedInOffice;
    }

    /**
     * @param mixed $receivedInOffice
     * @return Order
     */
    public function setReceivedInOffice($receivedInOffice)
    {
        $this->receivedInOffice = $receivedInOffice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSum()
    {
        return $this->sum;
    }

    /**
     * @param mixed $sum
     * @return Order
     */
    public function setSum($sum)
    {
        $this->sum = $sum;
        return $this;
    }

    /**
     * @return StatusesCollection
     */
    public function getStatusesCollection()
    {
        return $this->statusesCollection;
    }

    /**
     * @param StatusesCollection $statusesCollection
     */
    public function setStatusesCollection(StatusesCollection $statusesCollection)
    {
        $this->statusesCollection = $statusesCollection;
    }

    /**
     * @return mixed
     */
    public function getCargoType()
    {
        return $this->cargoType;
    }

    /**
     * @param mixed $cargoType
     * @return Order
     */
    public function setCargoType($cargoType)
    {
        $this->cargoType = $cargoType;
        return $this;
    }

    /**
     * @return AbstractCargoForm
     */
    public function getCargoForm()
    {
        return $this->cargoForm;
    }

    /**
     * @param AbstractCargoForm $cargoForm
     * @return $this
     */
    public function setCargoForm(AbstractCargoForm $cargoForm)
    {
        $this->cargoForm = $cargoForm;
        return $this;
    }

}
