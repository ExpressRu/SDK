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


use ExpressRuSDK\UserConfig;

/**
 * Class UserConfigConstProvider
 * @package ExpressRuSDK\Providers
 */
class UserConfigConstProvider implements UserConfigProviderInterface
{

    /**
     * @return string
     */
    public function getLogin() {
        return UserConfig::USER_LOGIN;
    }

    /**
     * @return string
     */
    public function getSignatureKey() {
        return UserConfig::USER_SIGNATURE_KEY;
    }

    /**
     * @return string
     */
    public function getAuthorizationKey() {
        return UserConfig::USER_AUTHORIZATION_KEY;
    }

}