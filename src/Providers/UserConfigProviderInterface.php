<?php
/**
 *
 * This file is part of Express.ru SDK for PHP.
 *
 * @author    Artem Dudov artem.dudov@gmail.com
 * @copyright Copyright (C) 2015 Express.ru, LLC
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU/GPLv3 only
 */


namespace ExpressRuSDK\Providers;

/**
 * Interface UserConfigProviderInterface
 * @package ExpressRuSDK\Providers
 */
interface UserConfigProviderInterface
{
    /**
     * @return mixed
     */
    public function getLogin();

    /**
     * @return mixed
     */
    public function getSignatureKey();

    /**
     * @return mixed
     */
    public function getAuthorizationKey();
}