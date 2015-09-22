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

use ExpressRuSDK\Api\ApiTransmitter;
use ExpressRuSDK\Api\Methods\CreateOrderMethod;
use ExpressRuSDK\Api\Methods\GetOrderMethod;
use ExpressRuSDK\Api\Methods\GetOrdersHistoryMethod;
use ExpressRuSDK\Model\Collections\OrdersCollection;
use ExpressRuSDK\Model\Entities\AbstractApiRepository;
use ExpressRuSDK\Model\Exceptions\ValidationException;

/**
 * Class OrderApiRepository
 * @package ExpressRuSDK\Model\Entities\Order
 */
class OrderApiRepository extends AbstractApiRepository
{

    /**
     * @var OrderMapper
     */
    protected $orderMapper;
    /**
     * @var OrderMetadata
     */
    protected $orderMetadata;
    /**
     * @var
     */
    protected $orderClass;

    /**
     * @param ApiTransmitter $apiTransmitter
     * @param OrderMetadata $orderMetadata
     * @param OrderMapper $orderMapper
     * @param $orderClass
     */
    public function __construct(
        ApiTransmitter $apiTransmitter,
        OrderMetadata $orderMetadata,
        OrderMapper $orderMapper,
        $orderClass
    )
    {
        parent::__construct($apiTransmitter);
        $this->orderMapper = $orderMapper;
        $this->orderMetadata = $orderMetadata;

        if (!class_exists($orderClass)) {
            throw new \InvalidArgumentException('Order class not exists');
        }

        if (!in_array('ExpressRuSDK\Model\Entities\Order\ExpressRuOrderInterface', class_implements($orderClass))) {
            throw new \InvalidArgumentException('Order class must implements ExpressRuSDK\Model\Entities\Order\ExpressRuOrderInterface');
        }
        $this->orderClass = $orderClass;
    }

    /**
     * @param $orderNumber
     * @return Order
     */
    public function getOrderByNumber($orderNumber)
    {

        $getOrderMethod = new GetOrderMethod($orderNumber);
        $apiResponse = $this->apiTransmitter->transmitMethod($getOrderMethod);

        /* @var $apiResponse \ExpressRuSDK\API\Responses\GetOrderApiResponse */
        if (!$apiResponse->isSuccess() and $apiResponse->isNotFound()) {
            return null;
        }

        $order = new $this->orderClass();
        if ($order instanceof Order) {
            $order->setMetadataObject($this->orderMetadata);
        }

        $this->orderMapper->mapOrderFromGetOrderApiResponseArray($order, $apiResponse->getOrderArray());

        return $order;
    }


    /**
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @return array|OrdersCollection
     * @throws \Exception
     */
    public function getOrdersHistory(\DateTime $startDate, \DateTime $endDate)
    {
        $getOrderMethod = new GetOrdersHistoryMethod($startDate, $endDate);

        $apiResponse = $this->apiTransmitter->transmitMethod($getOrderMethod);

        /* @var $apiResponse \ExpressRuSDK\API\Responses\GetOrdersHistoryApiResponse */
        $ordersCollection = new OrdersCollection();
        foreach ($apiResponse->getOrdersArray() as $orderArray) {
            $order = new $this->orderClass();
            if ($order instanceof Order) {
                $order->setMetadataObject($this->orderMetadata);
            }
            $this->orderMapper->mapOrderFromGetOrderApiResponseArray($order, $orderArray);
            $ordersCollection[] = $order;
        }

        return $ordersCollection;
    }


    /**
     * @param ExpressRuOrderInterface $order
     */
    public function calculatePriceForOrder(ExpressRuOrderInterface $order)
    {

    }


    /**
     * @param ExpressRuOrderInterface $order
     * @return ExpressRuOrderInterface
     * @throws \Exception
     */
    public function add(ExpressRuOrderInterface $order)
    {
        $orderApiArray = $this->orderMapper->mapOrderToApiArray($order);

        $createOrderMethod = new CreateOrderMethod($orderApiArray);
        $apiResponse = $this->apiTransmitter->transmitMethod($createOrderMethod);

        /* @var $apiResponse \ExpressRuSDK\API\Responses\CreateOrderApiResponse */
        if (!$apiResponse->isSuccess() and $apiResponse->getValidationErrors()) {
            throw new ValidationException($apiResponse);
        }

        $order->setExpressRuNumber($apiResponse->getOrderNumber());
        return $order;
    }
}
