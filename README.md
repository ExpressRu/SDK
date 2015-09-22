# Экспресс Точка Ру - курьерская служба, которая осуществляет доставку документов и грузов в любой уголок России и мира. 
Подробнее об услугах нашей компании можно узнать на странице http://www.express.ru/courierdostavka.

Ниже представлен комплект SDK, который поможет Вам использовать сервисы нашей компании еще более гибко.
При возникновении вопросов, обращайтесь по адресам:
* вопросы касающиеся услуг компании и заказов - dostavka@express.ru
* вопросы касающиеся SDK - i@express.ru

## Использование Express.Ru SDK
> NB: Из-за особенностей реализации API названия стран должны записываться в верхнем регистре (например, РОССИЯ). 

### Конфигурация
#### Пользователь
Файл ExpressRuSDK\UserConfig.php
```php
const USER_LOGIN = 'Логин';
const USER_SIGNATURE_KEY = 'Ключ подписи';
const USER_AUTHORIZATION_KEY = 'Ключ авторизации';
```
#### Настройки
Файл ExpressRuSDK\Config.php
```php
const ORDER_CLASS = 'ExpressRuSDK\\Model\\Entities\\Order\\Order';
```
Объект этого класса будет возвращаться из методов SDK. Класс должен реализовывать интерфейс 
```\ExpressRuSDK\Model\Entities\Order\ExpressRuOrderInterface```

#### Свойства заказа по умолчанию
При создании объекта заказа класса ```ExpressRuSDK\\Model\\Entities\\Order\\Order``` ему будут присвоены свойства прописанные в классе ```\ExpressRuSDK\OrderDefaults```. Если необходимо получать эти свойства из другого источника, то обратитесь к разделу **Провайдеры кофигураций**

### Работа с SDK
#### Получение объекта нового заказа

Получение заказа с предустановленными значениями по умолчанию
```php
$sdk = new \ExpressRuSDK\SDK();
$order = $sdk->getNewOrder();
```

При создании сущности заказа класса ```ExpressRuSDK\\Model\\Entities\\Order\\Order```  используя оператор ```new``` с присвоением значений свойств по умолчанию  необходимо вызвать метод ```setDefaultsFromProvider()```в который будет передан объект реализующий интерфейс ```ExpressRuSDK\Providers\OrderDefaultsProviderInterface```
```php
$sdk = new \ExpressRuSDK\SDK();
$orderDefaultsProvider = $sdk->getOrderDefaultsProvider();
$order = new \ExpressRuSDK\Model\Entities\Order\Order();
$order->setDefaultsFromProvider($orderDefaultsProvider);
```
#### Использование своего класса заказа
Вы можете использовать объекты заказа собственного класса, при условии реализации ими интерфейса ```ExpressRuSDK\Model\Entities\Order\ExpressRuOrderInterface```

#### Расчет стоимости заказа
```php
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
    ->setCargoType(\ExpressRuSDK\Model\CargoTypes::CARGO_TYPE_CARGO)  //Тип груза
    ->setCargoForm(new \ExpressRuSDK\Model\Entities\CargoForms\Box(10, 20, 30)); //Форма груза и размеры

$calculateResultsCollection = $calculateService->getDeliveryPricesForOrder($order);
var_export($calculateResultsCollection);
```

#### Создание заказа

```php
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
    ->setPickupDate('2015-09-22')//Дата забора
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
    ->setPickupDate('2015-09-20')//Дата забора
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
    ->setUrgency(\ExpressRuSDK\Model\Urgency::STANDARD) //Срочность
    ->setReceivedInOffice(false) //Заказ принят в офисе
    ->setSelfPickup(false); //Самовывоз получателем. Получение заказа в офисе


try {
    $orderRepository->add($order);
    echo "<pre>";
    echo var_export($order->getExpressRuNumber());
    echo "</pre>";
} catch (\ExpressRuSDK\Model\Exceptions\ValidationException $ve) {
    echo "<pre>";
    echo var_export($ve->getErrors());
    echo "</pre>";
}
```

#### Получение данных заказа
```php
$sdk = new \ExpressRuSDK\SDK();

/* @var $order \ExpressRuSDK\Model\Entities\Order\Order */
$order = $sdk->getOrderApiRepository()->getOrderByNumber('WEBN230001274');

echo "<pre>";
var_export($order);
echo "<pre>";
```

#### Получение истории заказов
```php
$sdk = new \ExpressRuSDK\SDK();

/* @var $orders \ExpressRuSDK\Model\Collections\OrdersCollection*/
$orders = $sdk->getOrderApiRepository()->getOrdersHistory(new DateTime(), new DateTime());

echo "<pre>";
var_export($orders);
echo "<pre>";
```
#### Получение статусов заказа
```php
$sdk = new \ExpressRuSDK\SDK();

// Вариант 1: Создание нового заказа и присвоение ему номера
$order = $sdk->getNewOrder()->setExpressRuNumber('WEBN230001274');

// Вариант 2: Получение заказа с данными и передача его в метод
$order = $sdk->getOrderApiRepository()->getOrderByNumber('WEBN230001274');

$result = $sdk->getTrackingService()->getTrackingStatus($order);
/* @var $result \ExpressRuSDK\Model\Collections\StatusesCollection|null */
echo "<pre>";
var_export($result);
echo "<pre><hr>";
```

#### Получение PDF накладной и сохранение на диск
```php
 $sdk = new \ExpressRuSDK\SDK();

// Вариант 1: Создание нового заказа и присвоение ему номера
$order = $sdk->getNewOrder()->setExpressRuNumber('WEBN2300012574');

// Вариант 2: Получение заказа с данными и передача его в метод
$order = $sdk->getOrderApiRepository()->getOrderByNumber('WEBN230001274');

if($order) {
    //Получение PDF как текста
    //возвращает PDF как текст | null если заказ не найден
    $invoicePDFFile = $sdk->getPDFService()->getInvoicePDFForOrder($order);
    //Получени PDF и сохранение на диск
    //возвращает имя файла | null если заказ не найден
    $invoicePDFFile = $sdk->getPDFService()->saveInvoicePDFForOrderOnDisk($order, APPPATH . 'logs');

    echo "<pre>";
    var_export($invoicePDFFile);
    echo "<pre><hr>";
}
```

## Исключения
В случае нештатных ситуаций методы SDK пробрасывают следующие исключения.
Объекты исключений содержат метод ``` getApiResponse()``` возвращающий объект ```ExpressRuSDK\Api\ApiResponse```
* Исключения наследующие ```ExpressRuSDK\Api\Exceptions\ApiTransmitException```. 
    * ```ExpressRuSDK\Api\Exceptions\NoResponseReceivedException``` - не получен ответ от API
    * ```ExpressRuSDK\Api\Exceptions\InvalidJsonException``` - получен  не валидный JSON
    * ```ExpressRuSDK\Api\Exceptions\InvalidStructureException``` - структура ответа не соответствует ожидаемой
    * ```ExpressRuSDK\Api\Exceptions\ApiErrorException``` - в ответе API пресутствует ошибка
* ```ExpressRuSDK\Model\Exceptions\ValidationException``` - выбрасывается в случае если создаваемая сущность не прошла валидацию на стороне API. Содержит метод ```getError()``` возвращающий массив ошибок.

## Провайдеры кофигураций
По умолчанию объект SDK создается со следующими провайдерами конфигурации ```ExpressRuSDK\Providers\UserConfigConstProvider``` и ```ExpressRuSDK\Providers\OrderDefaultsConstProvider``` которые получают значения из классов ```ExpressRuSDK\UserConfig``` и ```ExpressRuSDK\OrderDefaults``` соответственно. Если есть необходимость получать конфигурации из других хранилищ, то при созданиии объекта SDK в конструктор передаются провайдеры реализующие ```ExpressRuSDK\Providers\UserConfigProviderInterface``` и ```ExpressRuSDK\Providers\OrderDefaultsProviderInterface```
```php
$userConfigProvider = new MySQLUSerConfigProvider();
$orderDefaultsProvider = new MySQLOrderDefaultsProvider();
$sdk = new \ExpressRuSDK\SDK($userConfigProvider, $orderDefaultsProvider);
```
Использовать собственный провайдер конфигурации заказа можно и при создании его объекта с помощью оператора ```new```. Это касается объекта заказа класса ```\ExpressRuSDK\Model\Entities\Order\Order```. Подобный механизм можно реализовать используя собственный класс заказа.
```php
$sdk = new \ExpressRuSDK\SDK();
$orderDefaultsProvider = new MySQLOrderDefaultsProvider();
$order = new \ExpressRuSDK\Model\Entities\Order\Order();
$order->setDefaultsFromProvider($orderDefaultsProvider);
```

## Работа с запросами и ответами API напрямую
Помимо использования сущностей и репозиториев SDK возможна работа с ответами API напрямую. ```transmitMethod()``` Возвращает объекты классов унаследованных от ```ExpressRuSDK\Api\ApiResponse```


### Расчет стоимости заказа
```php
/**
* $orderArray array - массив параметров заказа
*/
$sdk = new \ExpressRuSDK\SDK();
$apiTransmitter = $sdk->getApiTransmitter();
$method = new \ExpressRuSDK\Api\Methods\CalculateOrderMethod($orderArray);
/* @var  $apiResponse \ExpressRuSDK\API\Responses\CalculateOrderApiResponse */
$apiResponse = $this->apiTransmitter->transmitMethod($method);
```
### Создание заказа
```php
/**
* $orderArray array - массив параметров заказа
*/
$sdk = new \ExpressRuSDK\SDK();
$apiTransmitter = $sdk->getApiTransmitter();
$method = new \ExpressRuSDK\Api\Methods\CreateOrderMethod($orderArray);
/* @var  $apiResponse \ExpressRuSDK\API\Responses\CreateOrderApiResponse */
$apiResponse = $this->apiTransmitter->transmitMethod($method);
```

### Получение данных заказа
```php
/**
* $orderNumber string - номер заказа
*/
$sdk = new \ExpressRuSDK\SDK();
$apiTransmitter = $sdk->getApiTransmitter();
$method = new \ExpressRuSDK\Api\Methods\GetOrderMethod($orderNumber);
/* @var  $apiResponse \ExpressRuSDK\API\Responses\GetOrderApiResponse */
$apiResponse = $this->apiTransmitter->transmitMethod($method);
```

### Получение истории заказов
```php
/**
* $startDate \DateTime - дата начала выборки
* $toDate \DateTime - дата окончания выборки
*/
$sdk = new \ExpressRuSDK\SDK();
$apiTransmitter = $sdk->getApiTransmitter();
$method = new \ExpressRuSDK\Api\Methods\GetOrdersHistoryMethod($startDate, $toDate);
/* @var  $apiResponse \ExpressRuSDK\API\Responses\GetOrdersHistoryApiResponse */
$apiResponse = $this->apiTransmitter->transmitMethod($method);
```

### Получение статусов заказа
```php
/**
* $numberS int|string|array - номера заказов
* $date string дата с которой начать выборку
*/
$sdk = new \ExpressRuSDK\SDK();
$apiTransmitter = $sdk->getApiTransmitter();
$method = new \ExpressRuSDK\Api\Methods\GetTrackingStatusesMethod($numberS, $date);
/* @var  $apiResponse \ExpressRuSDK\API\ApiResponse */
$apiResponse = $this->apiTransmitter->transmitMethod($method);
```

### Получение PDF накладной
```php
/**
* $orderNumber - номер заказа
*/
$sdk = new \ExpressRuSDK\SDK();
$apiTransmitter = $sdk->getApiTransmitter();
$method = new \ExpressRuSDK\Api\Methods\PrintInvoiceMethod($orderNumber);
/* @var  $apiResponse \ExpressRuSDK\API\Responses\PrintInvoiceApiResponse */
$apiResponse = $this->apiTransmitter->transmitMethod($method);
```



    

