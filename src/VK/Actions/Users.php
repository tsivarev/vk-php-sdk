<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Users {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Returns detailed information on users.
   * 
   * @param $access_token string
   * @param $params array
   * user_ids array User IDs or screen names ('screen_name'). By default, current user ID.
   * fields array Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'contacts', 'education', 'online', 'counters', 'relation', 'last_seen', 'activity', 'can_write_private_message', 'can_see_all_posts', 'can_post', 'universities',
   * name_case string Case for declension of user name and surname: 'nom' — nominative (default), 'gen' — genitive , 'dat' — dative, 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function get($access_token, $params = array()) {
    return $this->client->request('users.get', $access_token, $params);
  }

  /**
   * Returns a list of users matching the search criteria.
   * 
   * @param $access_token string
   * @param $params array
   * q string Search query string (e.g., 'Vasya Babich').
   * sort integer Sort order: '1' — by date registered, '0' — by rating
   * offset integer Offset needed to return a specific subset of users.
   * count integer Number of users to return.
   * fields array Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate', 'contacts', 'education', 'online',
   * city integer City ID.
   * country integer Country ID.
   * hometown string City name in a string.
   * university_country integer ID of the country where the user graduated.
   * university integer ID of the institution of higher education.
   * university_year integer Year of graduation from an institution of higher education.
   * university_faculty integer Faculty ID.
   * university_chair integer Chair ID.
   * sex integer '1' — female, '2' — male, '0' — any (default)
   * status integer Relationship status: '1' — Not married, '2' — In a relationship, '3' — Engaged, '4' — Married, '5' — It's complicated, '6' — Actively searching, '7' — In love
   * age_from integer Minimum age.
   * age_to integer Maximum age.
   * birth_day integer Day of birth.
   * birth_month integer Month of birth.
   * birth_year integer Year of birth.
   * online boolean '1' — online only, '0' — all users
   * has_photo boolean '1' — with photo only, '0' — all users
   * school_country integer ID of the country where users finished school.
   * school_city integer ID of the city where users finished school.
   * school_class integer
   * school integer ID of the school.
   * school_year integer School graduation year.
   * religion string Users' religious affiliation.
   * interests string Users' interests.
   * company string Name of the company where users work.
   * position string Job position.
   * group_id integer ID of a community to search in communities.
   * from_list array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function search($access_token, $params = array()) {
    return $this->client->request('users.search', $access_token, $params);
  }

  /**
   * Returns information whether a user installed the application.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function isAppUser($access_token, $params = array()) {
    return $this->client->request('users.isAppUser', $access_token, $params);
  }

  /**
   * Returns a list of IDs of users and communities followed by the user.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer User ID.
   * extended boolean '1' — to return a combined list of users and communities, '0' — to return separate lists of users and communities (default)
   * offset integer Offset needed to return a specific subset of subscriptions.
   * count integer Number of users and communities to return.
   * fields array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getSubscriptions($access_token, $params = array()) {
    return $this->client->request('users.getSubscriptions', $access_token, $params);
  }

  /**
   * Returns a list of IDs of followers of the user in question, sorted by date added, most recent first.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer User ID.
   * offset integer Offset needed to return a specific subset of followers.
   * count integer Number of followers to return.
   * fields array Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate', 'contacts', 'education', 'online'.
   * name_case string Case for declension of user name and surname: 'nom' — nominative (default), 'gen' — genitive , 'dat' — dative, 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getFollowers($access_token, $params = array()) {
    return $this->client->request('users.getFollowers', $access_token, $params);
  }

  /**
   * Reports (submits a complain about) a user.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer ID of the user about whom a complaint is being made.
   * type string Type of complaint: 'porn' – pornography, 'spam' – spamming, 'insult' – abusive behavior, 'advertisment' – disruptive advertisements
   * comment string Comment describing the complaint.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function report($access_token, $params = array()) {
    return $this->client->request('users.report', $access_token, $params);
  }

  /**
   * Indexes current user location and returns nearby users.
   * 
   * @param $access_token string
   * @param $params array
   * latitude number geographic latitude of the place a user is located, in degrees (from -90 to 90)
   * longitude number geographic longitude of the place a user is located, in degrees (from -180 to 180)
   * accuracy integer current location accuracy in meters
   * timeout integer time when a user disappears from location search results, in seconds
   * radius integer search zone radius type (1 to 4), :* 1 – 300 m,, :* 2 – 2400 m,, :* 3 – 18 km,, :* 4 – 150 km.
   * fields array list of additional fields to return. Available values: sex, bdate, city, country, photo_50, photo_100, photo_200_orig, photo_200, photo_400_orig, photo_max, photo_max_orig, online, online_mobile, domain, has_mobile, contacts, connections, site, education, universities, schools, can_post, can_see_all_posts, can_see_audio, can_write_private_message, status, last_seen, common_count, relation, relatives, counters, screen_name, maiden_name, timezone, occupation
   * name_case string Case for declension of user name and surname: , nom –nominative (default) , gen – genitive , dat – dative , acc – accusative , ins – instrumental , abl – prepositional
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getNearby($access_token, $params = array()) {
    return $this->client->request('users.getNearby', $access_token, $params);
  }
}
