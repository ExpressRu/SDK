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
use ExpressRuSDK\Model\Entities\CargoForms\AbstractCargoForm;

/**
 * Interface ExpressRuOrderInterface
 * @package ExpressRuSDK\Model\Entities\Order
 */
interface ExpressRuOrderInterface
{
    /**
     * @return mixed
     */
    public function getExpressRuNumber();

    /**
     * @param mixed $expressRuNumber
     */
    public function setExpressRuNumber($expressRuNumber);

    /**
     * @param string $format
     * @return mixed
     */
    public function getCreationDate($format = 'd-m-Y');

    /**
     * @param mixed $creationDate
     * @return Order
     */
    public function setCreationDate($creationDate);

    /**
     * @param string $format
     * @return mixed
     */
    public function getPickupDate($format = 'd-m-Y');

    /**
     * @param $pickupDate
     * @return mixed
     */
    public function setPickupDate($pickupDate);

    /**
     * @return mixed
     */
    public function getPickupTime();

    /**
     * @param mixed $pickupTime
     * @return Order
     */
    public function setPickupTime($pickupTime);

    /**
     * @return mixed
     */
    public function getSender();

    /**
     * @param mixed $sender
     */
    public function setSender($sender);

    /**
     * @return mixed
     */
    public function getSenderCity();

    /**
     * @param mixed $senderCity
     */
    public function setSenderCity($senderCity);

    /**
     * @return mixed
     */
    public function getSenderCountry();

    /**
     * @param mixed $senderCountry
     * @return Order
     */
    public function setSenderCountry($senderCountry);

    /**
     * @return mixed
     */
    public function getSenderAddress();

    /**
     * @param mixed $senderAddress
     */
    public function setSenderAddress($senderAddress);

    /**
     * @return mixed
     */
    public function getSenderContact();

    /**
     * @param mixed $senderContact
     */
    public function setSenderContact($senderContact);

    /**
     * @return mixed
     */
    public function getSenderPhone();

    /**
     * @param mixed $senderPhone
     */
    public function setSenderPhone($senderPhone);

    /**
     * @return mixed
     */
    public function getRecipient();

    /**
     * @param mixed $recipient
     */
    public function setRecipient($recipient);

    /**
     * @return mixed
     */
    public function getRecipientCity();

    /**
     * @param mixed $recipientCity
     */
    public function setRecipientCity($recipientCity);

    /**
     * @return mixed
     */
    public function getRecipientCountry();

    /**
     * @param mixed $recipientCountry
     * @return Order
     */
    public function setRecipientCountry($recipientCountry);

    /**
     * @return mixed
     */
    public function getRecipientAddress();

    /**
     * @param mixed $recipientAddress
     */
    public function setRecipientAddress($recipientAddress);

    /**
     * @return mixed
     */
    public function getRecipientContact();

    /**
     * @param mixed $recipientContact
     */
    public function setRecipientContact($recipientContact);

    /**
     * @return mixed
     */
    public function getRecipientPhone();

    /**
     * @param mixed $recipientPhone
     */
    public function setRecipientPhone($recipientPhone);

    /**
     * @return mixed
     */
    public function getDescription();

    /**
     * @param mixed $description
     */
    public function setDescription($description);

    /**
     * @return mixed
     */
    public function getItems();

    /**
     * @param mixed $items
     */
    public function setItems($items);

    /**
     * @return mixed
     */
    public function getWeight();

    /**
     * @param mixed $weight
     */
    public function setWeight($weight);

    /**
     * @return int
     */
    public function getVolumeWeight();

    /**
     * @param mixed $volumeWeight
     */
    public function setVolumeWeight($volumeWeight);

    /**
     * @return mixed
     */
    public function getComment();

    /**
     * @param mixed $comment
     */
    public function setComment($comment);

    /**
     * @return mixed
     */
    public function getClientContact();

    /**
     * @param mixed $contact
     */
    public function setClientContact($contact);

    /**
     * @return mixed
     */
    public function getPayer();

    /**
     * @param mixed $payer
     */
    public function setPayer($payer);

    /**
     * @return mixed
     */
    public function getTypeOfPayment();

    /**
     * @param mixed $typeOfPayment
     */
    public function setTypeOfPayment($typeOfPayment);

    /**
     * @return mixed
     */
    public function getUrgency();

    /**
     * @param mixed $urgency
     * @return Order
     */
    public function setUrgency($urgency);

    /**
     * @return mixed
     */
    public function getStatus();

    /**
     * @param mixed $status
     * @return Order
     */
    public function setStatus($status);

    /**
     * @return mixed
     */
    public function getStatusCode();

    /**
     * @param mixed $statusCode
     * @return Order
     */
    public function setStatusCode($statusCode);

    /**
     * @return mixed
     */
    public function getPayStatus();

    /**
     * @param mixed $payStatus
     * @return Order
     */
    public function setPayStatus($payStatus);

    /**
     * @return mixed
     */
    public function getCashOnDelivery();

    /**
     * @param mixed $cashOnDelivery
     * @return Order
     */
    public function setCashOnDelivery($cashOnDelivery);

    /**
     * @return mixed
     */
    public function getSelfPickup();

    /**
     * @param $selfPickup
     * @return mixed
     */
    public function setSelfPickup($selfPickup);

    /**
     * @return mixed
     */
    public function getReceivedInOffice();

    /**
     * @param mixed $receivedInOffice
     * @return Order
     */
    public function setReceivedInOffice($receivedInOffice);

    /**
     * @return mixed
     */
    public function getSum();

    /**
     * @param mixed $sum
     * @return Order
     */
    public function setSum($sum);

    /**
     * @param StatusesCollection $statusesCollection
     */
    public function setStatusesCollection(StatusesCollection $statusesCollection);

    /**
     * @return StatusesCollection
     */
    public function getStatusesCollection();

    /**
     * @return mixed
     */
    public function getCargoType();

    /**
     * @param mixed $cargoType
     * @return Order
     */
    public function setCargoType($cargoType);

    /**
     * @return AbstractCargoForm
     */
    public function getCargoForm();

    /**
     * @param AbstractCargoForm $cargoForm
     * @return $this
     */
    public function setCargoForm(AbstractCargoForm $cargoForm);
}