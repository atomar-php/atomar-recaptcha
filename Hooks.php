<?php

namespace recaptcha;
use atomar\Atomar;
use atomar\core\HookReceiver;

/**
 * Receives hook events from Atomar on behalf of the module
 */
class Hooks extends HookReceiver
{

    function hookInstall()
    {
        Atomar::set_variable('recaptcha_site_key', '');
        Atomar::set_variable('recaptcha_private_key', '');
    }

    function hookUninstall()
    {
        Atomar::set_variable('recaptcha_site_key', null);
        Atomar::set_variable('recaptcha_private_key', null);
    }

    function hookPermission()
    {
        return array(
            'administer_recaptcha',
            'access_recaptcha'
        );
    }

    function hookLibraries()
    {
        return array(
            'lib/RecaptchaAPI.php'
        );
    }
}