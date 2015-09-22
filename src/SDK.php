<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK;

use ExpressRuSDK\Api\ApiConfig;
use ExpressRuSDK\Api\ApiTransmitter;
use ExpressRuSDK\Api\Auth\SignatureGenerator;
use ExpressRuSDK\Model\Entities\CalculateResult\CalculateResultMapper;
use ExpressRuSDK\Model\Entities\CalculateResult\CalculateResultMetadata;
use ExpressRuSDK\Model\Entities\Order\Order;
use ExpressRuSDK\Model\Entities\Order\OrderApiRepository;
use ExpressRuSDK\Model\Entities\Order\OrderMapper;
use ExpressRuSDK\Model\Entities\Order\OrderMetadata;
use ExpressRuSDK\Model\Entities\TrackingStatus\TrackingStatusApiRepository;
use ExpressRuSDK\Model\Entities\TrackingStatus\TrackingStatusMapper;
use ExpressRuSDK\Model\Entities\TrackingStatus\TrackingStatusMetadata;
use ExpressRuSDK\Providers\OrderDefaultsConstProvider;
use ExpressRuSDK\Providers\OrderDefaultsProviderInterface;
use ExpressRuSDK\Providers\UserConfigConstProvider;
use ExpressRuSDK\Providers\UserConfigProviderInterface;
use ExpressRuSDK\Service\Calculate;
use ExpressRuSDK\Service\PDF;
use ExpressRuSDK\Service\Tracking;


/**
 * Class SDK
 * @package ExpressRuSDK
 */
class SDK
{

    /**
     * @var UserConfigProviderInterface
     */
    protected $userConfigProvider;

    /**
     * @var OrderDefaultsConstProvider
     */
    protected $orderDefaultsProvider;

    /**
     * @var
     */
    protected $apiConfigProvider;

    /**
     * @var SignatureGenerator
     */
    protected $signatureGenerator;

    /**
     * @var ApiTransmitter
     */
    protected $apiTransmitter;

    /**
     * @var
     */
    protected $orderMetadata;
    /**
     * @var
     */
    protected $orderMapper;
    /**
     * @var
     */
    protected $orderRepository;
    /**
     * @var string
     */
    protected $orderClass;

    /**
     * @var TrackingStatusMetadata
     */
    protected $trackingStatusMetadata;
    /**
     * @var TrackingStatusMapper
     */
    protected $trackingStatusMapper;
    /**
     * @var TrackingStatusApiRepository
     */
    protected $trackingStatusApiRepository;


    /**
     * @var
     */
    protected $trackingService;

    /**
     * @var PDF
     */
    protected $PDFService;

    /**
     * @var
     */
    protected $calculateService;
    /**
     * @var
     */
    protected $calculateResultMetadata;
    /**
     * @var
     */
    protected $calculateResultMapper;

    /**
     * @param UserConfigProviderInterface|null $userConfigProvider
     * @param OrderDefaultsProviderInterface|null $orderDefaultsProvider
     */
    public function __construct(UserConfigProviderInterface $userConfigProvider = null, OrderDefaultsProviderInterface $orderDefaultsProvider = null)
    {

        if ($userConfigProvider) {
            $this->userConfigProvider = $userConfigProvider;
        } else {
            $this->userConfigProvider = new UserConfigConstProvider();
        }

        if ($orderDefaultsProvider) {
            $this->orderDefaultsProvider = $orderDefaultsProvider;
        } else {
            $this->orderDefaultsProvider = new OrderDefaultsConstProvider();
        }

        $this->signatureGenerator = new SignatureGenerator();

        $this->apiTransmitter = new ApiTransmitter(
            ApiConfig::API_HOST,
            ApiConfig::API_PATH,
            $this->userConfigProvider->getLogin(),
            $this->userConfigProvider->getSignatureKey(),
            $this->signatureGenerator,
            ApiConfig::API_AUTH_HEADING,
            $this->userConfigProvider->getAuthorizationKey()
        );

        $this->orderClass = Config::ORDER_CLASS;

    }

    /**
     * @return ApiTransmitter
     */
    public function getApiTransmitter()
    {
        return $this->apiTransmitter;
    }


    /**
     * @return OrderDefaultsConstProvider
     */
    public function getOrderDefaultsProvider()
    {
        return $this->orderDefaultsProvider;
    }


    /**
     * @return OrderApiRepository
     */
    public function getOrderApiRepository()
    {
        if (!$this->orderRepository) {
            $this->orderRepository = new OrderApiRepository(
                $this->apiTransmitter,
                $this->getOrderMetadata(),
                $this->getOrderMapper(),
                $this->orderClass
            );
        }
        return $this->orderRepository;
    }

    /**
     * @return OrderMetadata
     */
    protected function getOrderMetadata()
    {
        if (!$this->orderMetadata) {
            $this->orderMetadata = new OrderMetadata();
        }
        return $this->orderMetadata;
    }

    /**
     *
     */
    protected function getOrderMapper()
    {
        if (!$this->orderMapper) {
            $this->orderMapper = new OrderMapper($this->getOrderMetadata());
        }
        return $this->orderMapper;
    }

    /**
     * @return TrackingStatusApiRepository
     */
    public function getTrackingStatusApiRepository()
    {
        if (!$this->trackingStatusApiRepository) {
            $this->trackingStatusApiRepository = new TrackingStatusApiRepository(
                $this->apiTransmitter,
                $this->getTrackingStatusMetadata(),
                $this->getTrackingStatusMapper()
            );
        }
        return $this->trackingStatusApiRepository;
    }

    /**
     * @return TrackingStatusMetadata
     */
    protected function getTrackingStatusMetadata()
    {
        if (!$this->trackingStatusMetadata) {
            $this->trackingStatusMetadata = new TrackingStatusMetadata();
        }
        return $this->trackingStatusMetadata;
    }

    /**
     * @return TrackingStatusMapper
     */
    protected function getTrackingStatusMapper()
    {
        if (!$this->trackingStatusMapper) {
            $this->trackingStatusMapper = new TrackingStatusMapper($this->getTrackingStatusMetadata());
        }
        return $this->trackingStatusMapper;
    }

    /**
     * @return Tracking
     */
    public function getTrackingService()
    {
        if (!$this->trackingService) {
            $this->trackingService = new Tracking(
                $this->apiTransmitter,
                $this->getTrackingStatusMetadata(),
                $this->getTrackingStatusMapper()
            );
        }
        return $this->trackingService;
    }

    /**
     * @return PDF
     */
    public function getPDFService()
    {
        if (!$this->PDFService) {
            $this->PDFService = new PDF($this->apiTransmitter);
        }
        return $this->PDFService;
    }

    /**
     * @return Calculate
     */
    public function getCalculateService()
    {
        if (!$this->calculateService) {
            $this->calculateService = new Calculate(
                $this->apiTransmitter,
                $this->getOrderMapper(),
                $this->getCalculateResultMetadata(),
                $this->getCalculateResultMapper()
            );
        }
        return $this->calculateService;
    }

    /**
     * @return CalculateResultMetadata
     */
    protected function getCalculateResultMetadata()
    {
        if (!$this->calculateResultMetadata) {
            $this->calculateResultMetadata = new CalculateResultMetadata();
        }
        return $this->calculateResultMetadata;
    }

    /**
     * @return CalculateResultMapper
     */
    protected function getCalculateResultMapper()
    {
        if (!$this->calculateResultMapper) {
            $this->calculateResultMapper = new CalculateResultMapper($this->getCalculateResultMetadata());
        }
        return $this->calculateResultMapper;
    }

    /**
     * @return Order
     */
    public function getNewOrder()
    {
        $order = new $this->orderClass();
        if ($order instanceof Order) {
            $order->setMetadataObject($this->getOrderMetadata());
            $order->setDefaultsFromProvider($this->orderDefaultsProvider);
        }
        return $order;
    }

    /**
     * @return UserConfigProviderInterface
     */
    protected function getUserConfigProvider()
    {
        return $this->userConfigProvider;
    }
}