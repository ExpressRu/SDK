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
use ExpressRuSDK\Api\Methods\CalculateOrderMethod;
use ExpressRuSDK\Model\Collections\CalculateResultCollection;
use ExpressRuSDK\Model\Entities\CalculateResult\CalculateResult;
use ExpressRuSDK\Model\Entities\CalculateResult\CalculateResultMapper;
use ExpressRuSDK\Model\Entities\CalculateResult\CalculateResultMetadata;
use ExpressRuSDK\Model\Entities\Order\ExpressRuOrderInterface;
use ExpressRuSDK\Model\Entities\Order\OrderMapper;

/**
 * Class Calculate
 * @package ExpressRuSDK\Service
 */
class Calculate extends AbstractService
{

    /**
     * @var OrderMapper
     */
    protected $orderMapper;

    /**
     * @var CalculateResultMetadata
     */
    protected $calculateResultMetadata;

    /**
     * @var CalculateResultMapper
     */
    protected $calculateResultMapper;

    /**
     * @param ApiTransmitter $apiTransmitter
     * @param OrderMapper $orderMapper
     * @param CalculateResultMetadata $calculateResultMetadata
     * @param CalculateResultMapper $calculateResultMapper
     */
    public function __construct(
        ApiTransmitter $apiTransmitter,
        OrderMapper $orderMapper,
        CalculateResultMetadata $calculateResultMetadata,
        CalculateResultMapper $calculateResultMapper
    )
    {
        parent::__construct($apiTransmitter);
        $this->orderMapper = $orderMapper;
        $this->calculateResultMetadata = $calculateResultMetadata;
        $this->calculateResultMapper = $calculateResultMapper;
    }


    /**
     * @param ExpressRuOrderInterface $order
     * @return array|CalculateResultCollection
     * @throws \Exception
     */
    public function getDeliveryPricesForOrder(ExpressRuOrderInterface $order)
    {
        $calculateArray = $this->orderMapper->mapOrderToApiCalculateArray($order);
        $method = new CalculateOrderMethod($calculateArray);
        $apiResponse = $this->apiTransmitter->transmitMethod($method);

        $resultsCollection = new CalculateResultCollection();
        foreach ($apiResponse->getResult() as $resultItem) {
            $calculateResult = new CalculateResult($this->calculateResultMetadata);
            $this->calculateResultMapper->mapFromArrayOneToOne($calculateResult, $resultItem);
            $resultsCollection[] = $calculateResult;
        }
        return $resultsCollection;
    }

}