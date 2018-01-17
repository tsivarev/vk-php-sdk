<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Database {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Returns a list of countries.
   * 
   * @param $access_token string
   * @param $params array
   * need_all boolean '1' — to return a full list of all countries, '0' — to return a list of countries near the current user's country (default).
   * code string Country codes in [vk.com/dev/country_codes|ISO 3166-1 alpha-2] standard.
   * offset integer Offset needed to return a specific subset of countries.
   * count integer Number of countries to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getCountries($access_token, $params = array()) {
    return $this->client->request('database.getCountries', $access_token, $params);
  }

  /**
   * Returns a list of regions.
   * 
   * @param $access_token string
   * @param $params array
   * country_id integer Country ID, received in [vk.com/dev/database.getCountries|database.getCountries] method.
   * q string Search query.
   * offset integer Offset needed to return specific subset of regions.
   * count integer Number of regions to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getRegions($access_token, $params = array()) {
    return $this->client->request('database.getRegions', $access_token, $params);
  }

  /**
   * Returns information about streets by their IDs.
   * 
   * @param $access_token string
   * @param $params array
   * street_ids array Street IDs.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getStreetsById($access_token, $params = array()) {
    return $this->client->request('database.getStreetsById', $access_token, $params);
  }

  /**
   * Returns information about countries by their IDs.
   * 
   * @param $access_token string
   * @param $params array
   * country_ids array Country IDs.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getCountriesById($access_token, $params = array()) {
    return $this->client->request('database.getCountriesById', $access_token, $params);
  }

  /**
   * Returns a list of cities.
   * 
   * @param $access_token string
   * @param $params array
   * country_id integer Country ID.
   * region_id integer Region ID.
   * q string Search query.
   * need_all boolean '1' — to return all cities in the country, '0' — to return major cities in the country (default),
   * offset integer Offset needed to return a specific subset of cities.
   * count integer Number of cities to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getCities($access_token, $params = array()) {
    return $this->client->request('database.getCities', $access_token, $params);
  }

  /**
   * Returns information about cities by their IDs.
   * 
   * @param $access_token string
   * @param $params array
   * city_ids array City IDs.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getCitiesById($access_token, $params = array()) {
    return $this->client->request('database.getCitiesById', $access_token, $params);
  }

  /**
   * Returns a list of higher education institutions.
   * 
   * @param $access_token string
   * @param $params array
   * q string Search query.
   * country_id integer Country ID.
   * city_id integer City ID.
   * offset integer Offset needed to return a specific subset of universities.
   * count integer Number of universities to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getUniversities($access_token, $params = array()) {
    return $this->client->request('database.getUniversities', $access_token, $params);
  }

  /**
   * Returns a list of schools.
   * 
   * @param $access_token string
   * @param $params array
   * q string Search query.
   * city_id integer City ID.
   * offset integer Offset needed to return a specific subset of schools.
   * count integer Number of schools to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getSchools($access_token, $params = array()) {
    return $this->client->request('database.getSchools', $access_token, $params);
  }

  /**
   * Returns a list of school classes specified for the country.
   * 
   * @param $access_token string
   * @param $params array
   * country_id integer Country ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getSchoolClasses($access_token, $params = array()) {
    return $this->client->request('database.getSchoolClasses', $access_token, $params);
  }

  /**
   * Returns a list of faculties (i.e., university departments).
   * 
   * @param $access_token string
   * @param $params array
   * university_id integer University ID.
   * offset integer Offset needed to return a specific subset of faculties.
   * count integer Number of faculties to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getFaculties($access_token, $params = array()) {
    return $this->client->request('database.getFaculties', $access_token, $params);
  }

  /**
   * Returns list of chairs on a specified faculty.
   * 
   * @param $access_token string
   * @param $params array
   * faculty_id integer id of the faculty to get chairs from
   * offset integer offset required to get a certain subset of chairs
   * count integer amount of chairs to get
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getChairs($access_token, $params = array()) {
    return $this->client->request('database.getChairs', $access_token, $params);
  }
}
