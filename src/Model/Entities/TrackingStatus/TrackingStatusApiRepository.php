<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Model\Entities\TrackingStatus;

use ExpressRuSDK\Api\ApiTransmitter;
use ExpressRuSDK\Api\Methods\GetTrackingStatusesMethod;
use ExpressRuSDK\Model\Collections\OrdersCollection;
use ExpressRuSDK\Model\Collections\StatusesCollection;
use ExpressRuSDK\Model\Entities\AbstractApiRepository;
use ExpressRuSDK\Model\Entities\Order\ExpressRuOrderInterface;


/**
 * Class TrackingStatusApiRepository
 * @package ExpressRuSDK\Model\Entities\TrackingStatus
 */
class TrackingStatusApiRepository extends AbstractApiRepository
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
     * @param null $date
     * @return ExpressRuOrderInterface
     */
    public function getTrackingStatus(ExpressRuOrderInterface $order, $date = null)
    {
        $ordersCollection = new OrdersCollection();
        $ordersCollection->add($order);
        $this->getTrackingStatusesForCollection($ordersCollection, $date);
        return $order;
    }

    /**
     * @param OrdersCollection $ordersCollection
     * @param null $date
     * @return OrdersCollection
     */
    public function getTrackingStatusesForCollection(OrdersCollection $ordersCollection, $date = null)
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

        $method = new GetTrackingStatusesMethod($numberS, $date);
        $apiResponse = $this->apiTransmitter->transmitMethod($method);

        if ($apiResponse->isError()) {
            return $ordersCollection;
        }

        foreach ($apiResponse->getResult() as $number => $statusesArray) {
            $order = $ordersCollection->getByExpressRuNumber($number);
            $statusesCollection = new StatusesCollection();
            foreach ($statusesArray as $statusArray) {
                $status = new TrackingStatus($this->trackingStatusMetadata);
                $this->trackingStatusMapper->mapStatusFromArray($status, $statusArray);
                $statusesCollection[] = $status;
            }
            $order->setStatusesCollection($statusesCollection);
        }
        return $ordersCollection;
    }
}