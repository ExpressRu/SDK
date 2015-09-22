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


use ExpressRuSDK\Model\CargoTypes;
use ExpressRuSDK\Model\Payers;
use ExpressRuSDK\Model\TypesOfPayment;
use ExpressRuSDK\Model\Urgency;

/**
 * Class OrderDefaults
 * @package ExpressRuSDK
 */
class OrderDefaults
{
    /**
     * Контактное лицо клиента
     */
    const CLIENT_CONTACT = 'Контактное лицо клиента';

    /**
     * Плательщик
     * PAYER::CLIENT Клиент
     * PAYER::SENDER Отправитель
     * PAYER::RECIPIENT Получатель
     */
    const PAYER = Payers::CLIENT;

    /**
     * Вид оплаты
     * PAYMENT::CASH Наличный расчет
     * PAYMENT::CASHLESS Безналичный расчет
     * PAYMENT::MINI_TERMINAL Отплата через мини-терминал
     * PAYMENT::ONE_TIME_BILL Разовый счет
     * PAYMENT::WEB_SITE Оплата через сайт www.express.ru
     */
    const TYPE_OF_PAYMENT = TypesOfPayment::CASHLESS_PAYMENT;

    /**
     * Количество мест в грузе
     */
    const ITEMS = 1;

    /**
     *  Вес
     */
    const WEIGHT = 1;

    /**
     * Отправитель
     */
    const SENDER = 'Тестовый Отправитель';

    /**
     * Страна отправителя
     */
    const SENDER_COUNTRY = 'РОССИЯ';

    /**
     * Город отправителя
     */
    const SENDER_CITY = 'Москва';

    /**
     * Адрес отправителя
     */
    const SENDER_ADDRESS = 'Адрес отправителя';

    /**
     * Контакт отправителя
     */
    const SENDER_CONTACT = 'Контакт отправителя';

    /**
     * Телефон отправителя
     */
    const SENDER_PHONE = '+0000000000';

    /**
     * Срочность
     */
    const URGENCY = Urgency::STANDARD;

    /**
     * Тип груза
     */
    const CARGO_TYPE = CargoTypes::CARGO_TYPE_CARGO;

    /**
     * Заказ принят в офисе
     */
    const RECEIVED_IN_OFFICE = false;

    /**
     * Самовывоз из офиса получателем
     */
    const SELF_PICKUP = false;


}