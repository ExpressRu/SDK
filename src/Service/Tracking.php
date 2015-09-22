<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Service;

use ExpressRuSDK\Api\ApiTransmitter;
use ExpressRuSDK\Api\Methods\GetTrackingStatusesMethod;
use ExpressRuSDK\Model\Collections\OrdersCollection;
use ExpressRuSDK\Model\Collections\StatusesCollection;
use ExpressRuSDK\Model\Entities\Order\ExpressRuOrderInterface;
use ExpressRuSDK\Model\Entities\TrackingStatus\TrackingStatus;
use ExpressRuSDK\Model\Entities\TrackingStatus\TrackingStatusMapper;
use ExpressRuSDK\Model\Entities\TrackingStatus\TrackingStatusMetadata;

/**
 * Class Tracking
 * @package ExpressRuSDK\Service
 */
class Tracking extends AbstractService
{


    /**
     * @var TrackingStatusMapper
     */
    protected $trackingStatusMapper;

    /**
     * @var TrackingStatusMetadata
     */
    protected $trackingStatusMetadata;

    /**
     * @param ApiTransmitter $apiTransmitter
     * @param TrackingStatusMetadata $trackingStatusMetadata
     * @param TrackingStatusMapper $trackingStatusMapper
     */
    public function __construct(ApiTransmitter $apiTransmitter, TrackingStatusMetadata $trackingStatusMetadata, TrackingStatusMapper $trackingStatusMapper)
    {
        parent::__construct($apiTransmitter);
        $this->trackingStatusMapper = $trackingStatusMapper;
        $this->trackingStatusMetadata = $trackingStatusMetadata;
    }

    /**
     * @param ExpressRuOrderInterface $order
     * @param \DateTime|null $date
     * @return null
     */
    public function getTrackingStatus(ExpressRuOrderInterface $order, \DateTime $date = null)
    {
        $ordersCollection = new OrdersCollection();
        $ordersCollection->add($order);
        $statusesResultArray = $this->getTrackingStatusesForCollection($ordersCollection, $date);
        return isset($statusesResultArray[$order->getExpressRuNumber()]) ? $statusesResultArray[$order->getExpressRuNumber()] : null;
    }

    /**
     * @param OrdersCollection $ordersCollection
     * @param \DateTime|null $date
     * @return array
     */
    public function getTrackingStatusesForCollection(OrdersCollection $ordersCollection, \DateTime $date = null)
    {
        $numberS = array();
        foreach ($ordersCollection as $order) {
            /* @var $order \ExpressRuSDK\Model\Entities\Order\Order */
            if ($order->getExpressRuNumber()) {
                $numberS[] = $order->getExpressRuNumber();
            }
        }

        if (!$numberS) {
            throw new \InvalidArgumentException('Empty orders numbers');
        }

        $dateText = $date instanceof \DateTime ? $date->format('Y-m-d H:i') : null;

        $method = new GetTrackingStatusesMethod($numberS, $dateText);
        $apiResponse = $this->apiTransmitter->transmitMethod($method);

        $statusesResultArray = array();
        if ($apiResponse->isError()) {
            return $statusesResultArray;
        }

        foreach ($apiResponse->getResult() as $number => $statusesArray) {
            $statusesCollection = new StatusesCollection();
            foreach ($statusesArray as $statusArray) {
                $status = new TrackingStatus($this->trackingStatusMetadata);
                $this->trackingStatusMapper->mapStatusFromArray($status, $statusArray);
                $statusesCollection[] = $status;
            }
            $statusesResultArray[$number] = $statusesCollection;
        }
        return $statusesResultArray;
    }

}