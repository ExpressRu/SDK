# Экспресс Точка Ру - курьерская служба доставки документов и грузов по России и миру. 
Подробнее об услугах нашей компании можно узнать на странице http://www.express.ru/services.

Ниже представлен комплект SDK, который поможет Вам использовать сервисы нашей компании еще более гибко.
При возникновении вопросов, обращайтесь по адресам:
* вопросы касающиеся услуг компании и заказов - dostavka@express.ru
* вопросы касающиеся SDK - i@express.ru

## Использование Express.Ru SDK
> NB: Из-за особенностей реализации API названия стран должны записываться в верхнем регистре (например РОССИЯ). 

### Установка
Через composer
```
composer require express-ru/sdk
```
Либо скопируйте файлы SDK в ваш проект сохраняя структуру файлов, например ```\vendor\ExpressRuSDK``` и подключите файл  ```bootstrap.php``` который зарегистрирует автозагрузчик классов SDK. 

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
Объект этого класса будет возвращаться из методов SDK. Класс должен реализовывать интерфейс ```\ExpressRuSDK\Model\Entities\Order\ExpressRuOrderInterface```

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
    ->setSenderZip('109000')//Почтовый индекс
    ->setSenderCity('Москва')//Город отправителя
    ->setSenderAddress('Адрес отправителя')//Адрес отправителя
    ->setSenderContact('Контакт отправителя')//Контакт отправителя
    ->setSenderPhone('+0000000000')//Телефон отправителя
    ->setRecipient('Тестовый Получатель')
    ->setRecipientCountry('РОССИЯ')//Страна получателя
    ->setRecipientZip('109001')//Почтовый индекс получателя
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
    * ```ExpressRuSDK\Api\Exceptions\InvalidJsonException``` - получен не валидный JSON
    * ```ExpressRuSDK\Api\Exceptions\InvalidStructureException``` - структура ответа не соответствует ожидаемой
    * ```ExpressRuSDK\Api\Exceptions\ApiErrorException``` - в ответе API присутствует ошибка
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

---

# Express Tochka Ru-在俄罗斯及全世界范围内提供文件与货物快递服务。
可在http://www.express.ru/services网站中了解本公司服务的详细内容。

下面为大家介绍SDK集合，它可帮助您更灵活地使用我公司的服务。
如有疑问，请联系以下电子邮箱：
* 有关公司服务和订单问题-dostavka@express.ru
* 有关SDK的问题- i@express.ru

## Express.Ru SDK的使用
> NB: 由于API实现的特性，国家名称要标注在上方注册表中（例如 俄罗斯）。

### 安装
通过composer
```
composer require express-ru/sdk
```
 或将SDK文件复制到您的项目中，同时保留文件的结构，如```\vendor\ExpressRuSDK``` ，接通对SDK等级自动装载器进行注册的```bootstrap.php```文件。

### 配置
#### 用户
ExpressRuSDK\UserConfig.php文件
```php
const USER_LOGIN = '用户名';
const USER_SIGNATURE_KEY = '签名密钥';
const USER_AUTHORIZATION_KEY = '授权密钥';
```
#### 设置
ExpressRuSDK\UserConfig.php文件
```php
const ORDER_CLASS = 'ExpressRuSDK\\Model\\Entities\\Order\\Order';
```
SDK方法论中的该等级对象将被还原。等级应实现```\ExpressRuSDK\Model\Entities\Order\ExpressRuOrderInterface```接口

#### 订单的默认性能
在建立等级订单对象```ExpressRuSDK\\Model\\Entities\\Order\\Order``` 时，将授予它 ```\ExpressRuSDK\OrderDefaults```等级中指定的性能。如果需要从其他来源中获得该性能，则请联系配置提供方一栏

### SDK的操作
#### 新订单对象的获取

获取带有设定默认值的订单
```php
$sdk = new \ExpressRuSDK\SDK();
$order = $sdk->getNewOrder();
```
在建立```ExpressRuSDK\\Model\\Entities\\Order\\Order```等级订单实体时，在使用包含有默认值性能的```new```操作器情况下，必须提出```setDefaultsFromProvider()```方法论，将已实现的```ExpressRuSDK\Providers\OrderDefaultsProviderInterface```接口对象传递到该方法论中。

```php
$sdk = new \ExpressRuSDK\SDK();
$orderDefaultsProvider = $sdk->getOrderDefaultsProvider();
$order = new \ExpressRuSDK\Model\Entities\Order\Order();
$order->setDefaultsFromProvider($orderDefaultsProvider);
```

#### 订单固有等级的使用
在实现```ExpressRuSDK\Model\Entities\Order\ExpressRuOrderInterface```接口条件下，您可使用固有等级订单对象。

#### 订单的价格计算
```php
$sdk = new \ExpressRuSDK\SDK();
$calculateService = $sdk->getCalculateService();
/**
 * 新订单对象的获取
 */
$order = $sdk->getNewOrder();
$order
    ->setSenderCountry('俄罗斯')
    ->setRecipientCountry('俄罗斯')
    ->setSenderCity('俄罗斯')
    ->setRecipientCity('俄罗斯')
    ->setWeight(1)
    ->setCargoType(\ExpressRuSDK\Model\CargoTypes::CARGO_TYPE_CARGO)  //货物类型
    ->setCargoForm(new \ExpressRuSDK\Model\Entities\CargoForms\Box(10, 20, 30)); //货物类型

$calculateResultsCollection = $calculateService->getDeliveryPricesForOrder($order);
var_export($calculateResultsCollection);
```

#### 建立订单

```php
$sdk = new \ExpressRuSDK\SDK();
$orderRepository = $sdk->getOrderApiRepository();
$order = $sdk->getNewOrder();

/**
 * 方案1：为成功建立订单所需的最小计算技术数据组
 * 被建立订单中的默认数据显示在
 * \ExpressRuSDK\OrderDefaults中，或在使用它的条件下，出现在默认数据的其他提供方中。
 * 部分内容将被跳过
 */
$order
    ->setPickupDate('2015-09-22')//取件日期
    ->setRecipient('测试性收件人')
    ->setRecipientCountry('俄罗斯')
    ->setRecipientCity('莫斯科')//收件人所在城市
    ->setRecipientAddress('收件人地址')
    ->setRecipientContact('收件人联系人')
    ->setRecipientPhone('+0000000000');

/**
 * 方案2：使用数据的全部计算技术数据组
 */
$order
    ->setPickupDate('2015-09-20')//取件日期
    ->setClientContact('客户联系人')// 客户联系人
    ->setSender('测试性发件人')
    ->setSenderCountry('俄罗斯')//发件人所在国家
    ->setSenderZip('109000')//邮政编码
    ->setSenderCity('莫斯科')//收件人所在城市
    ->setSenderAddress('发件人地址')//发件人地址
    ->setSenderContact('发件人联系人')//发件人联系人
    ->setSenderPhone('+0000000000')//发件人电话
    ->setRecipient('测试性收件人')
    ->setRecipientCountry('俄罗斯')//收件人所在国家
    ->setRecipientZip('109001')//邮政编码
    ->setRecipientCity('莫斯科')//收件人所在城市
    ->setRecipientAddress('收件人地址')//收件人地址
    ->setRecipientContact('收件人联系人')//收件人联系人
    ->setRecipientPhone('+0000000000')//收件人电话
    ->setItems(1)//邮件件数
    ->setWeight(1)//质量，千克
    ->setCargoType(\ExpressRuSDK\Model\CargoTypes::CARGO_TYPE_CARGO)//货物类型
    ->setCargoForm(new \ExpressRuSDK\Model\Entities\CargoForms\Box(10, 20, 30))//货物形状和尺寸
    ->setDescription('邮件描述')
    ->setComment('邮件注释')
    ->setCashOnDelivery(false)//货到付款
    ->setPayer(\ExpressRuSDK\Model\Payers::CLIENT)//付款人
    ->setTypeOfPayment(\ExpressRuSDK\Model\TypesOfPayment::CASHLESS_PAYMENT)//付款方式
    ->setUrgency(\ExpressRuSDK\Model\Urgency::STANDARD) //急件
    ->setReceivedInOffice(false) //、在办事处接受订单
    ->setSelfPickup(false); //收件人自取。


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

#### 订单数据获取
```php
$sdk = new \ExpressRuSDK\SDK();

/* @var $order \ExpressRuSDK\Model\Entities\Order\Order */
$order = $sdk->getOrderApiRepository()->getOrderByNumber('WEBN230001274');

echo "<pre>";
var_export($order);
echo "<pre>";
```

#### 订单历史获取
```php
$sdk = new \ExpressRuSDK\SDK();

/* @var $orders \ExpressRuSDK\Model\Collections\OrdersCollection*/
$orders = $sdk->getOrderApiRepository()->getOrdersHistory(new DateTime(), new DateTime());

echo "<pre>";
var_export($orders);
echo "<pre>";
```
#### 订单状态获取
```php
$sdk = new \ExpressRuSDK\SDK();

// 方案1：创建新订单并获得订单号
$order = $sdk->getNewOrder()->setExpressRuNumber('WEBN230001274');

// 方案2：获得带有数据的订单并将它发送到方法论中
$order = $sdk->getOrderApiRepository()->getOrderByNumber('WEBN230001274');

$result = $sdk->getTrackingService()->getTrackingStatus($order);
/* @var $result \ExpressRuSDK\Model\Collections\StatusesCollection|null */
echo "<pre>";
var_export($result);
echo "<pre><hr>";
```

#### 获得PDF提货单并保存在磁盘中
```php
 $sdk = new \ExpressRuSDK\SDK();

// 方案1：创建新订单并获得订单号
$order = $sdk->getNewOrder()->setExpressRuNumber('WEBN2300012574');

// 方案2：获得带有数据的订单并将它发送到方法论中
$order = $sdk->getOrderApiRepository()->getOrderByNumber('WEBN230001274');

if($order) {
    //获得PDF文本
    //如果无法找到订单，则将PDF还原为| null 文本
    $invoicePDFFile = $sdk->getPDFService()->getInvoicePDFForOrder($order);
    //获得PDF并保存在磁盘中
    //如果无法找到订单，则还原 | null 文件名
    $invoicePDFFile = $sdk->getPDFService()->saveInvoicePDFForOrderOnDisk($order, APPPATH . 'logs');

    echo "<pre>";
    var_export($invoicePDFFile);
    echo "<pre><hr>";
}
```

## 特殊情况
在出现意外情况时，SDK 方法论会漏掉以下意外情况。
意外对象包含```getApiResponse ()```方法论 ```ExpressRuSDK\Api\ApiResponse``` 还原对象
* 以下```ExpressRuSDK\Api\Exceptions\ApiTransmitException```意外
    * ```ExpressRuSDK\Api\Exceptions\NoResponseReceivedException``` -未获得API回应
    * ```ExpressRuSDK\Api\Exceptions\InvalidJsonException``` -得到错误的JSON
    * ```ExpressRuSDK\Api\Exceptions\InvalidStructureException``` - 回应结构与期待不符
    * ```ExpressRuSDK\Api\Exceptions\ApiErrorException``` - API响应中存在错误
* ```ExpressRuSDK\Model\Exceptions\ValidationException``` -当所建立的实体在API方面出现错误时跳出。 ```getError()```方法论包含 错误的还原数组。

## 配置提供方
建立的```SDK``` 默认对象带有以下配置提供方```ExpressRuSDK\Providers\UserConfigConstProvider```和```ExpressRuSDK\Providers\OrderDefaultsConstProvide```，它们从```ExpressRuSDK\UserConfig和ExpressRuSDK\OrderDefaults``` 等级中获得相应的数值。 如果可能从其他存储器中获得配置，则在创建```SDK``` 对象时将所实现的```ExpressRuSDK\Providers\UserConfigProviderInterface```和```ExpressRuSDK\Providers\OrderDefaultsProviderInterface```提供方发送至构造函数中
```php
$userConfigProvider = new MySQLUSerConfigProvider();
$orderDefaultsProvider = new MySQLOrderDefaultsProvider();
$sdk = new \ExpressRuSDK\SDK($userConfigProvider, $orderDefaultsProvider);
```
在借助```new```操作器创建起对象的条件下，可使用订单配置的原有提供方。这与```\ExpressRuSDK\Model\Entities\Order\Order```等级订单对象有关。该结构可在使用订单原有等级时实现。

```php
$sdk = new \ExpressRuSDK\SDK();
$orderDefaultsProvider = new MySQLOrderDefaultsProvider();
$order = new \ExpressRuSDK\Model\Entities\Order\Order();
$order->setDefaultsFromProvider($orderDefaultsProvider);
```

## 直接实现API询问和回应
除使用SDK实体和软件源外，还可以与API进行直接回应。 ```transmitMethod()``` 从```ExpressRuSDK\Api\ApiResponse```中还原沿用等级对象

### 订单的价格计算
```php
/**
* $orderArray array - 订单数据数组
*/
$sdk = new \ExpressRuSDK\SDK();
$apiTransmitter = $sdk->getApiTransmitter();
$method = new \ExpressRuSDK\Api\Methods\CalculateOrderMethod($orderArray);
/* @var  $apiResponse \ExpressRuSDK\API\Responses\CalculateOrderApiResponse */
$apiResponse = $this->apiTransmitter->transmitMethod($method);
```
### 建立订单
```php
/**
* $orderArray array - 订单数据数组
*/
$sdk = new \ExpressRuSDK\SDK();
$apiTransmitter = $sdk->getApiTransmitter();
$method = new \ExpressRuSDK\Api\Methods\CreateOrderMethod($orderArray);
/* @var  $apiResponse \ExpressRuSDK\API\Responses\CreateOrderApiResponse */
$apiResponse = $this->apiTransmitter->transmitMethod($method);
```

### 订单数据获取
```php
/**
* $orderNumber string - 订单号
*/
$sdk = new \ExpressRuSDK\SDK();
$apiTransmitter = $sdk->getApiTransmitter();
$method = new \ExpressRuSDK\Api\Methods\GetOrderMethod($orderNumber);
/* @var  $apiResponse \ExpressRuSDK\API\Responses\GetOrderApiResponse */
$apiResponse = $this->apiTransmitter->transmitMethod($method);
```

### 订单历史获取
```php
/**
* $startDate \DateTime - 取样的开始日期
* $toDate \DateTime - 取样的结束日期
*/
$sdk = new \ExpressRuSDK\SDK();
$apiTransmitter = $sdk->getApiTransmitter();
$method = new \ExpressRuSDK\Api\Methods\GetOrdersHistoryMethod($startDate, $toDate);
/* @var  $apiResponse \ExpressRuSDK\API\Responses\GetOrdersHistoryApiResponse */
$apiResponse = $this->apiTransmitter->transmitMethod($method);
```

### 订单状态获取
```php
/**
* $numberS int|string|array - 订单号
* $date string 取样的开始日期
*/
$sdk = new \ExpressRuSDK\SDK();
$apiTransmitter = $sdk->getApiTransmitter();
$method = new \ExpressRuSDK\Api\Methods\GetTrackingStatusesMethod($numberS, $date);
/* @var  $apiResponse \ExpressRuSDK\API\ApiResponse */
$apiResponse = $this->apiTransmitter->transmitMethod($method);
```

### 获取PDF提货单
```php
/**
* $orderNumber - 订单号
*/
$sdk = new \ExpressRuSDK\SDK();
$apiTransmitter = $sdk->getApiTransmitter();
$method = new \ExpressRuSDK\Api\Methods\PrintInvoiceMethod($orderNumber);
/* @var  $apiResponse \ExpressRuSDK\API\Responses\PrintInvoiceApiResponse */
$apiResponse = $this->apiTransmitter->transmitMethod($method);
```
