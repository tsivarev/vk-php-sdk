<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Places {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Adds a new location to the location database.
   * 
   * @param $access_token string
   * @param $params array
   * type integer ID of the location's type (e.g., '1' — Home, '2' — Work). To get location type IDs, use the [vk.com/dev/places.getTypes|places.getTypes] method.
   * title string Title of the location.
   * latitude number Geographical latitude, in degrees (from '-90' to '90').
   * longitude number Geographical longitude, in degrees (from '-180' to '180').
   * country integer ID of the location's country. To get country IDs, use the [vk.com/dev/database.getCountries|database.getCountries] method.
   * city integer ID of the location's city. To get city IDs, use the [vk.com/dev/database.getCities|database.getCities] method.
   * address string Street address of the location (e.g., '125 Elm Street').
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function add($access_token, $params = array()) {
    return $this->client->request('places.add', $access_token, $params);
  }

  /**
   * Returns information about locations by their IDs.
   * 
   * @param $access_token string
   * @param $params array
   * places array Location IDs.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getById($access_token, $params = array()) {
    return $this->client->request('places.getById', $access_token, $params);
  }

  /**
   * Returns a list of locations that match the search criteria.
   * 
   * @param $access_token string
   * @param $params array
   * q string Search query string.
   * city integer City ID.
   * latitude number Geographical latitude of the initial search point, in degrees (from '-90' to '90').
   * longitude number Geographical longitude of the initial search point, in degrees (from '-180' to '180').
   * radius integer Radius of the search zone: '1' — 100 m. (default), '2' — 800 m. '3' — 6 km. '4' — 50 km.
   * offset integer Offset needed to return a specific subset of locations.
   * count integer Number of locations to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function search($access_token, $params = array()) {
    return $this->client->request('places.search', $access_token, $params);
  }

  /**
   * Checks a user in at the specified location.
   * 
   * @param $access_token string
   * @param $params array
   * place_id integer Location ID.
   * text string Text of the comment on the check-in (255 characters maximum, line breaks not supported).
   * latitude number Geographical latitude of the check-in, in degrees (from '-90' to '90').
   * longitude number Geographical longitude of the check-in, in degrees (from '-180' to '180').
   * friends_only boolean '1' — Check-in will be available only for friends. '0' — Check-in will be available for all users (default).
   * services array List of services or websites (e.g., 'twitter', 'facebook') to which the check-in will be exported, if the user has set up the respective option.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function checkin($access_token, $params = array()) {
    return $this->client->request('places.checkin', $access_token, $params);
  }

  /**
   * Returns a list of user check-ins at locations according to the set parameters.
   * 
   * @param $access_token string
   * @param $params array
   * latitude number Geographical latitude of the initial search point, in degrees (from '-90' to '90').
   * longitude number Geographical longitude of the initial search point, in degrees (from '-180' to '180').
   * place integer Location ID of check-ins to return. (Ignored if 'latitude' and 'longitude' are specified.)
   * user_id integer
   * offset integer Offset needed to return a specific subset of check-ins. (Ignored if 'timestamp' is not null.)
   * count integer Number of check-ins to return. (Ignored if 'timestamp' is not null.)
   * timestamp integer Specifies that only those check-ins created after the specified timestamp will be returned.
   * friends_only boolean '1' — to return only check-ins with set geographical coordinates. (Ignored if 'latitude' and 'longitude' are not set.)
   * need_places boolean '1' — to return location information with the check-ins. (Ignored if 'place' is not set.),
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getCheckins($access_token, $params = array()) {
    return $this->client->request('places.getCheckins', $access_token, $params);
  }

  /**
   * Returns a list of all types of locations.
   * 
   * @param $access_token string
   * @param $params array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getTypes($access_token, $params = array()) {
    return $this->client->request('places.getTypes', $access_token, $params);
  }
}
