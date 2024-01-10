<?php

/**
 * @file
 * Token support for the user_registrationpassword module.
 */

/**
 * Implements hook_token_info().
 */
function user_registrationpassword_token_info() {
  $info = array();

  $info['tokens']['user']['registrationpassword-url'] = array(
    'name' => t('User registration password activation URL'),
    'description' => t('User registration password activation URL'),
    'needs-data' => 'user',
  );

  return $info;
}

/**
 * Implements hook_tokens().
 */
function user_registrationpassword_tokens($type, $tokens, array $data = array(), array $options = array()) {
  $replacements = array();

  if ($type == 'user' && !empty($data['user']) && isset($tokens['registrationpassword-url'])) {
    $replacements[$tokens['registrationpassword-url']] = user_registrationpassword_confirmation_url($data['user']);
  }

  return $replacements;
}
