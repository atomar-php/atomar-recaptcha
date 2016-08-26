<?php

namespace recaptcha;

use atomar\Atomar;
use atomar\core\Logger;

class RecaptchaApi {

  /**
   * Generates a new recaptcha element that can be inserted into the form
   * @return string
   */
  public static function create() {
    $site_key = variable_get('recaptcha_site_key', '');

    // validate key
    if (!$site_key || $site_key == '0') {
      $notice = 'Missing captcha public key. Please view your extension settings.';
      if (Atomar::$config['debug']) {
        set_notice($notice);
      } else {
        Logger::log_notice($notice);
      }
      return '';
    } else {
      $lang = 'en';
      return <<<HTML
<div style="margin:5px 0" class="g-recaptcha" data-sitekey="$site_key"></div>
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang; ?>"></script>
HTML;
    }
  }

  /**
   * Checks if the captcha response is valid
   * @param null $remote_addr the remote address to the server
   * @param null $response the recatpcha response
   * @return bool
   */
  public static function isSuccess($remote_addr = null, $response = null) {
    require('vendor/autoload.php');
    $secret = variable_get('recaptcha_private_key', '');
    if ($remote_addr == null) {
      $remote_addr = $_SERVER['REMOTE_ADDR'];
    }
    if ($response == null) {
      $response = $_REQUEST['g-recaptcha-response'];
    }

    // validate key
    if (!$secret || $secret == '0') {
      $notice = 'Missing captcha secret key. Please view your extension settings.';
      if (Atomar::$config['debug']) {
        set_notice($notice);
      } else {
        Logger::log_warning($notice);
      }
      return false;
    } else {
      $recaptcha = new \ReCaptcha\RecaptchaApi($secret);
      $resp = $recaptcha->verify($response, $remote_addr);
      return $resp->isSuccess();
    }
  }
}