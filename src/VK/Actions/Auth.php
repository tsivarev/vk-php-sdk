<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Auth {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Checks a user's phone number for correctness.
   * 
   * @param $access_token string
   * @param $params array
   * phone string Phone number.
   * client_id integer User ID.
   * client_secret string
   * auth_by_phone boolean
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function checkPhone($access_token, $params = array()) {
    return $this->client->request('auth.checkPhone', $access_token, $params);
  }

  /**
   * Registers a new user by phone number.
   * 
   * @param $access_token string
   * @param $params array
   * first_name string User's first name.
   * last_name string User's surname.
   * birthday string User's birthday.
   * client_id integer Your application ID.
   * client_secret string
   * phone string User's phone number. Can be pre-checked with the [vk.com/dev/auth.checkPhone|auth.checkPhone] method.
   * password string User's password (minimum of 6 characters). Can be specified later with the [vk.com/dev/auth.confirm|auth.confirm] method.
   * test_mode boolean '1' — test mode, in which the user will not be registered and the phone number will not be checked for availability, '0' — default mode (default)
   * voice boolean '1' — call the phone number and leave a voice message of the authorization code, '0' — send the code by SMS (default)
   * sex integer '1' — female, '2' — male
   * sid string Session ID required for method recall when SMS was not delivered.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function signup($access_token, $params = array()) {
    return $this->client->request('auth.signup', $access_token, $params);
  }

  /**
   * Completes a user's registration (begun with the [vk.com/dev/auth.signup|auth.signup] method) using an authorization code.
   * 
   * @param $access_token string
   * @param $params array
   * client_id integer
   * client_secret string
   * phone string
   * code string
   * password string
   * test_mode boolean
   * intro integer
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function confirm($access_token, $params = array()) {
    return $this->client->request('auth.confirm', $access_token, $params);
  }

  /**
   * Allows to restore account access using a code received via SMS. " This method is only available for apps with [vk.com/dev/auth_direct|Direct authorization] access. "
   * 
   * @param $access_token string
   * @param $params array
   * phone string User phone number.
   * last_name string User last name.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function restore($access_token, $params = array()) {
    return $this->client->request('auth.restore', $access_token, $params);
  }
}
