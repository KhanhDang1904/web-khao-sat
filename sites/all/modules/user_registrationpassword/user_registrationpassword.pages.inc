<?php

/**
 * @file
 * User page callback file for the user_registrationpassword module.
 */

/**
 * Menu callback; process one time login link.
 *
 * @see user_pass_rehash()
 */
function user_registrationpassword_confirm_account($form, &$form_state, $uid, $timestamp, $hashed_pass) {
  global $user;

  module_load_include('inc', 'user', 'user.pages');

  // When processing the one-time login link, we have to
  // make sure that a user isn't already logged in.
  if ($user->uid) {
    // The existing user is already logged in. Log them out and reload the
    // current page so the password reset process can continue.
    if ($user->uid == $uid) {
      // Preserve the current destination (if any) and ensure the redirect goes
      // back to the current page; any custom destination set in
      // hook_user_logout() and intended for regular logouts would not be
      // appropriate here.
      $destination = array();
      if (isset($_GET['destination'])) {
        $destination = drupal_get_destination();
      }
      user_logout_current_user();
      unset($_GET['destination']);
      drupal_goto(current_path(), array('query' => drupal_get_query_parameters() + $destination));
    }
    // A different user is already logged in on the computer.
    else {
      $reset_link_account = user_load($uid);
      if (!empty($reset_link_account)) {
        drupal_set_message(t('Another user (%other_user) is already logged into the site on this computer, but you tried to use a one-time link for user %resetting_user. Please <a href="!logout">logout</a> and try using the link again.',
          array('%other_user' => $user->name, '%resetting_user' => $reset_link_account->name, '!logout' => url('user/logout'))), 'warning');
      }
      else {
        // Invalid one-time link specifies an unknown user.
        user_registrationpassword_set_message('linkerror', TRUE);
      }
      drupal_goto();
    }
  }
  else {
    // Time out, in seconds, until login URL expires. 24 hours = 86400 seconds.
    $timeout = variable_get('user_registrationpassword_registration_ftll_timeout', 86400);
    $current = REQUEST_TIME;
    $timestamp_created = $timestamp - $timeout;

    // Some redundant checks for extra security ?
    $users = user_load_multiple(array($uid), array('status' => '0', 'access' => '0'));

    // Timestamp can not be larger then current.
    if ($timestamp_created <= $current && $account = reset($users)) {
      // Check if we have to enforce expiration for activation links.
      if (variable_get('user_registrationpassword_registration_ftll_expire', FALSE) && !$account->login && $current - $timestamp > $timeout) {
        user_registrationpassword_set_message('linkerror', TRUE);
      }
      // Else try to activate the account.
      // Password = user's password - timestamp = current request - login =
      // username.
      elseif ($account->uid && $timestamp >= $account->created && !$account->login && $hashed_pass == user_pass_rehash($account->pass, $timestamp, $account->login, $account->uid)) {
        // Format the date, so the logs are a bit more readable.
        $date = format_date($timestamp);
        watchdog('user', 'User %name used one-time login link at time %timestamp.', array('%name' => $account->name, '%timestamp' => $date));
        // Activate the user and update the access and login time to $current.
        $account = user_save($account, array(
          'status' => 1,
          'access' => $current,
          'login' => $current,
        ));
        // Set the new user.
        $user = $account;
        // user_login_finalize() also updates the login timestamp of the
        // user, which invalidates further use of the one-time login link.
        user_login_finalize();

        // Invoke user_registrationpassword_user_activated so other modules can
        // respond to the user activation.
        module_invoke_all('user_registrationpassword_activated_user', $account);

        // Trigger a rules event.
        // @see http://drupal.org/node/1776286
        if (module_exists('rules')) {
          rules_invoke_event('user_registrationpassword_activated', $account);
        }

        // Test for Commerce checkout and redirect to checkout if exists.
        if (module_exists('commerce_checkout_redirect') && module_exists('commerce_cart')) {
          $order_id = commerce_cart_order_id();
          // People need to be coming from the checkout form, and thus
          // have an order ready, so we will forward them to the checkout
          // form if they have an cart order set.
          if (!empty($order_id)) {
            drupal_set_message(t('You have just used your one-time login link. Your account is now active and you are authenticated. You can now continue with checkout.'));
            drupal_goto('checkout/' . $order_id);
          }
        }

        // Display default welcome message.
        drupal_set_message(t('You have just used your one-time login link. Your account is now active and you are authenticated.'));
        // And just redirect to /user if this site does not have commerce,
        // or if the user does not have an order in the cart.
        drupal_goto('user');
      }
      // Something else is wrong, redirect to the password
      // reset form to request a new activation e-mail.
      else {
        user_registrationpassword_set_message('linkerror', TRUE);
      }
    }
    else {
      // Deny access, no more clues.
      // Everything will be in the watchdog's
      // URL for the administrator to check.
      user_registrationpassword_set_message('linkerror', TRUE);
    }
  }
}
