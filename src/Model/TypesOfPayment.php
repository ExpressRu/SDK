<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Model;


/**
 * Class TypesOfPayment
 * @package ExpressRuSDK\Model
 */
class TypesOfPayment
{
    /**
     * Наличный расчет
     */
    const PAYMENT_IN_CASH = "PAYMENT::CASH";

    /**
     * Безналичный расчет
     */
    const CASHLESS_PAYMENT = "PAYMENT::CASHLESS";

    /**
     * Мини-терминал
     */
    const MINI_TERMINAL = "PAYMENT::MINI_TERMINAL";

    /**
     * Разовый счет
     */
    const ONE_TIME_BILL = "PAYMENT::ONE_TIME_BILL";

    /**
     * Веб сайт
     */
    const WEB_SITE = "PAYMENT::WEB_SITE";
}