<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Apps {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Returns a list of applications (apps) available to users in the App Catalog.
   * 
   * @param $access_token string
   * @param $params array
   * sort string Sort order: 'popular_today' — popular for one day (default), 'visitors' — by visitors number , 'create_date' — by creation date, 'growth_rate' — by growth rate, 'popular_week' — popular for one week
   * offset integer Offset required to return a specific subset of apps.
   * count integer Number of apps to return.
   * platform string
   * extended boolean '1' — to return additional fields 'screenshots', 'MAU', 'catalog_position', and 'international'. If set, 'count' must be less than or equal to '100'. '0' — not to return additional fields (default).
   * return_friends boolean
   * fields array
   * name_case string
   * q string Search query string.
   * genre_id integer
   * filter string 'installed' — to return list of installed apps (only for mobile platform).
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getCatalog($access_token, $params = array()) {
    return $this->client->request('apps.getCatalog', $access_token, $params);
  }

  /**
   * Returns applications data.
   * 
   * @param $access_token string
   * @param $params array
   * app_id integer Application ID
   * app_ids array List of application ID
   * platform string platform. Possible values: *'ios' — iOS,, *'android' — Android,, *'winphone' — Windows Phone,, *'web' — приложения на vk.com. By default: 'web'.
   * fields array Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'contacts', 'education', 'online', 'counters', 'relation', 'last_seen', 'activity', 'can_write_private_message', 'can_see_all_posts', 'can_post', 'universities', (only if return_friends - 1)
   * name_case string Case for declension of user name and surname: 'nom' — nominative (default),, 'gen' — genitive,, 'dat' — dative,, 'acc' — accusative,, 'ins' — instrumental,, 'abl' — prepositional. (only if 'return_friends' = '1')
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function get($access_token, $params = array()) {
    return $this->client->request('apps.get', $access_token, $params);
  }

  /**
   * Sends a request to another user in an app that uses VK authorization.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer id of the user to send a request
   * text string request text
   * type string request type. Values: 'invite' – if the request is sent to a user who does not have the app installed,, 'request' – if a user has already installed the app
   * name string
   * key string special string key to be sent with the request
   * separate boolean
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function sendRequest($access_token, $params = array()) {
    return $this->client->request('apps.sendRequest', $access_token, $params);
  }

  /**
   * Deletes all request notifications from the current app.
   * 
   * @param $access_token string
   * @param $params array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function deleteAppRequests($access_token, $params = array()) {
    return $this->client->request('apps.deleteAppRequests', $access_token, $params);
  }

  /**
   * Creates friends list for requests and invites in current app.
   * 
   * @param $access_token string
   * @param $params array
   * count integer List size.
   * type string List type. Possible values: * 'invite' — available for invites (don't play the game),, * 'request' — available for request (play the game). By default: 'invite'.
   * fields array Additional profile fields, see [vk.com/dev/fields|description].
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getFriendsList($access_token, $params = array()) {
    return $this->client->request('apps.getFriendsList', $access_token, $params);
  }

  /**
   * Returns players rating in the game.
   * 
   * @param $access_token string
   * @param $params array
   * type string Leaderboard type. Possible values: *'level' — by level,, *'points' — by mission points,, *'score' — by score ().
   * global boolean Rating type. Possible values: *'1' — global rating among all players,, *'0' — rating among user friends.
   * extended boolean 1 — to return additional info about users
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getLeaderboard($access_token, $params = array()) {
    return $this->client->request('apps.getLeaderboard', $access_token, $params);
  }

  /**
   * Returns user score in app
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getScore($access_token, $params = array()) {
    return $this->client->request('apps.getScore', $access_token, $params);
  }
}
