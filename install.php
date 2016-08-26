<?php

namespace recaptcha;

/**
 * Implements hook_uninstall()
 */
function uninstall() {
  variable_set('recaptcha_site_key');
  variable_set('recaptcha_private_key');
  return true;
}

/**
 * Implements hook_update_version()
 */
function update_1() {
  variable_set('recaptcha_site_key', '0');
  variable_set('recaptcha_private_key', '0');
  return true;
}