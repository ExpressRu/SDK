<?php

require_once('../bootstrap.php');

/**
 * Получение данных заказа
 */
$sdk = new \ExpressRuSDK\SDK();

/* @var $order \ExpressRuSDK\Model\Entities\Order\Order */
$order = $sdk->getOrderApiRepository()->getOrderByNumber('WEBN23005262');

echo "<pre>";
var_export($order);
echo "<pre><hr>";


/**
 * Получение PDF накладной и сохранение на диск
 */

$sdk = new \ExpressRuSDK\SDK();

// Вариант 1: Создание нового заказа и присвоение ему номера
$order = $sdk->getNewOrder()->setExpressRuNumber('WEBN23005262');

// Вариант 2: Получение заказа с данными и передача его в метод
$order = $sdk->getOrderApiRepository()->getOrderByNumber('WEBN23005262');

if ($order) {
    //Получение PDF как текста
    //возвращает PDF как текст | null если заказ не найден
    $invoicePDFFile = $sdk->getPDFService()->getInvoicePDFForOrder($order);

    //Получени PDF и сохранение на диск
    //возвращает имя файла | null если заказ не найден
    $invoicePDFFile = $sdk->getPDFService()->saveInvoicePDFForOrderOnDisk($order, __DIR__);

    echo "<pre>";
    var_export($invoicePDFFile);
    echo "<pre><hr>";
}


/**
 * Получение истории заказов
 */
$sdk = new \ExpressRuSDK\SDK();

/* @var $orders \ExpressRuSDK\Model\Collections\OrdersCollection */
$orders = $sdk->getOrderApiRepository()->getOrdersHistory(new DateTime('2015-09-01'), new DateTime());

echo "<pre>";
var_export($orders);
echo "<pre><hr>";


/**
 * Получение статусов заказа
 */
$sdk = new \ExpressRuSDK\SDK();

// Вариант 1: Создание нового заказа и присвоение ему номера
$order = $sdk->getNewOrder()->setExpressRuNumber('WEBN23005262');

// Вариант 2: Получение заказа с данными и передача его в метод
$order = $sdk->getOrderApiRepository()->getOrderByNumber('WEBN23005262');

$result = $sdk->getTrackingService()->getTrackingStatus($order);
/* @var $result \ExpressRuSDK\Model\Collections\StatusesCollection|null */
echo "<pre>";
var_export($result);
echo "<pre><hr>";


/**
 * Расчет стоимости заказа
 */

$sdk = new \ExpressRuSDK\SDK();
$calculateService = $sdk->getCalculateService();

/**
 * Получение объекта нового заказа
 */
$order = $sdk->getNewOrder();
$order
    ->setSenderCountry('Россия')
    ->setRecipientCountry('Россия')
    ->setSenderCity('Москва')
    ->setRecipientCity('Москва')
    ->setWeight(1)
    ->setCargoType(\ExpressRuSDK\Model\CargoTypes::CARGO_TYPE_CARGO)//Тип груза
    ->setCargoForm(new \ExpressRuSDK\Model\Entities\CargoForms\Box(10, 20, 30)); //Форма груза и размеры

$calculateResultsCollection = $calculateService->getDeliveryPricesForOrder($order);
echo "<pre>";
var_export($calculateResultsCollection);
echo "<pre><hr>";


/**
 * Создание заказа
 */
$sdk = new \ExpressRuSDK\SDK();
$orderRepository = $sdk->getOrderApiRepository();
$order = $sdk->getNewOrder();

/**
 * Вариант 1: Минимальный набор необходимый для успешного создания заказа
 * Заказ будет создан с параметрами по умолчанию, указанными в
 * \ExpressRuSDK\OrderDefaults или в другом провайдере значений по умолчанию при его использовании.
 * Часть полей будет опущена
 */
$order
    ->setPickupDate('2015-09-23')//Дата забора
    ->setRecipient('Тестовый Получатель')
    ->setRecipientCountry('РОССИЯ')
    ->setRecipientCity('Москва')//Город Получателя
    ->setRecipientAddress('Адрес получателя')
    ->setRecipientContact('Контакт получателя')
    ->setRecipientPhone('+0000000000');


/**
 * Вариант 2: Использование полного набора параметров
 */
$order
    ->setPickupDate('2015-09-22')//Дата забора
    ->setClientContact('Контактное лицо клиента')// Контактное лицо клиента
    ->setSender('Тестовый Отправитель')
    ->setSenderCountry('РОССИЯ')//Страна отправителя
    ->setSenderCity('Москва')//Город Получателя
    ->setSenderAddress('Адрес отправителя')//Адрес отправителя
    ->setSenderContact('Контакт отправителя')//Контакт отправителя
    ->setSenderPhone('+0000000000')//Телефон отправителя
    ->setRecipient('Тестовый Получатель')
    ->setRecipientCountry('РОССИЯ')//Страна получателя
    ->setRecipientCity('Москва')//Город Получателя
    ->setRecipientAddress('Адрес получателя')//Адрес получателя
    ->setRecipientContact('Контакт получателя')//Контакт получателя
    ->setRecipientPhone('+0000000000')//Телефон получателя
    ->setItems(1)//Количество мест в отправлении
    ->setWeight(1)//Вес, кг
    ->setCargoType(\ExpressRuSDK\Model\CargoTypes::CARGO_TYPE_CARGO)//Тип груза
    ->setCargoForm(new \ExpressRuSDK\Model\Entities\CargoForms\Box(10, 20, 30))//Форма груза и размеры
    ->setDescription('Описание отправления')
    ->setComment('Комментарий к отправлению')
    ->setCashOnDelivery(false)//Ноложенный платеж
    ->setPayer(\ExpressRuSDK\Model\Payers::CLIENT)//Плательщик
    ->setTypeOfPayment(\ExpressRuSDK\Model\TypesOfPayment::CASHLESS_PAYMENT)//Тип оплаты
    ->setUrgency(\ExpressRuSDK\Model\Urgency::STANDARD)//Срочность
    ->setReceivedInOffice(false)//Заказ принят в офисе
    ->setSelfPickup(false); //Самовывоз получателем. Получение заказа в офисе


try {
    $orderRepository->add($order);
    echo "<pre>";
    echo var_export($order->getExpressRuNumber());
    echo "</pre></hr>";
} catch (\ExpressRuSDK\Model\Exceptions\ValidationException $ve) {
    echo "<pre>";
    echo var_export($ve->getErrors());
    echo "</pre></hr>";
}

