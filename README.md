reCaptcha
========

This extension provides support for the [reCaptcha] service provided by Google.

##Requirements
In order to use reCaptcha you must have registered for an account with google and generated the proper public and private keys. Please view [reCaptcha] for details.

##Usage
###Controller
To set up the controller you must create a new captcha field using the extension API and insert it into your template from your controller's GET method. Then you must check if the chaptcha response is valid in the POST method.

    function GET() {
      ...
      $captcha = \recaptcha\RecaptchaAPI::create();
      ...
      echo $this->renderView('my_site_or_extension/views/contact.html', array(
        'captcha'=>$captcha
      ));
    }

    function POST() {
      ...
      if(!\recaptcha\RecaptchaAPI::is_valid()) {
        set_error('The captcha is invalid.');
        $this->go_back();
      }
      ...
    }

The method `\recaptcha\RecaptchaAPI::is_valid()` also takes some optional arguments `\recaptcha\RecaptchaAPI::is_valid($remote_addr, $challenge, $response)` which, if left null, will be automatically populated with the following values `$_SERVER['REMOTE_ADDR']`, `$_REQUEST['recaptcha_challenge_field']`, `$_REQUEST['recaptcha_response_field']`.

###Template
Once your controller is properly configured you need to place the `captcha` variable that we inserted earlier.

    {{ captcha|raw }}
>NOTE: `raw` ensures the captcha is renderd as full html and not escaped

Be sure to place the captcha inside of your form element otherwise the captcha validation will fail.

###Settings
Once the controller and template are configured you must lastly provide your public and private key. You can do so by visiting the [Extension Settings] page and editing the default values.

[reCaptcha]:https://www.google.com/recaptcha
[Extension Settings]:/admin/extensions/settings