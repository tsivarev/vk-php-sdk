<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Fave {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Returns a list of users whom the current user has bookmarked.
   * 
   * @param $access_token string
   * @param $params array
   * offset integer Offset needed to return a specific subset of users.
   * count integer Number of users to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getUsers($access_token, $params = array()) {
    return $this->client->request('fave.getUsers', $access_token, $params);
  }

  /**
   * Returns a list of photos that the current user has liked.
   * 
   * @param $access_token string
   * @param $params array
   * offset integer Offset needed to return a specific subset of photos.
   * count integer Number of photos to return.
   * photo_sizes boolean '1' — to return photo sizes in a [vk.com/dev/photo_sizes|special format].
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getPhotos($access_token, $params = array()) {
    return $this->client->request('fave.getPhotos', $access_token, $params);
  }

  /**
   * Returns a list of wall posts that the current user has liked.
   * 
   * @param $access_token string
   * @param $params array
   * offset integer Offset needed to return a specific subset of posts.
   * count integer Number of posts to return.
   * extended boolean '1' — to return additional 'wall', 'profiles', and 'groups' fields. By default: '0'.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getPosts($access_token, $params = array()) {
    return $this->client->request('fave.getPosts', $access_token, $params);
  }

  /**
   * Returns a list of videos that the current user has liked.
   * 
   * @param $access_token string
   * @param $params array
   * offset integer Offset needed to return a specific subset of videos.
   * count integer Number of videos to return.
   * extended boolean Return an additional information about videos. Also returns all owners profiles and groups.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getVideos($access_token, $params = array()) {
    return $this->client->request('fave.getVideos', $access_token, $params);
  }

  /**
   * Returns a list of links that the current user has bookmarked.
   * 
   * @param $access_token string
   * @param $params array
   * offset integer Offset needed to return a specific subset of users.
   * count integer Number of results to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getLinks($access_token, $params = array()) {
    return $this->client->request('fave.getLinks', $access_token, $params);
  }

  /**
   * Returns market items bookmarked by current user.
   * 
   * @param $access_token string
   * @param $params array
   * count integer Number of results to return.
   * extended boolean '1' – to return additional fields 'likes, can_comment, can_repost, photos'. By default: '0'.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getMarketItems($access_token, $params = array()) {
    return $this->client->request('fave.getMarketItems', $access_token, $params);
  }

  /**
   * Adds a profile to user faves.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer Profile ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function addUser($access_token, $params = array()) {
    return $this->client->request('fave.addUser', $access_token, $params);
  }

  /**
   * Removes a profile from user faves.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer Profile ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function removeUser($access_token, $params = array()) {
    return $this->client->request('fave.removeUser', $access_token, $params);
  }

  /**
   * Adds a community to user faves.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function addGroup($access_token, $params = array()) {
    return $this->client->request('fave.addGroup', $access_token, $params);
  }

  /**
   * Removes a community from user faves.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function removeGroup($access_token, $params = array()) {
    return $this->client->request('fave.removeGroup', $access_token, $params);
  }

  /**
   * Adds a link to user faves.
   * 
   * @param $access_token string
   * @param $params array
   * link string Link URL.
   * text string Description text.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function addLink($access_token, $params = array()) {
    return $this->client->request('fave.addLink', $access_token, $params);
  }

  /**
   * Removes link from the user's faves.
   * 
   * @param $access_token string
   * @param $params array
   * link_id string Link ID (can be obtained by [vk.com/dev/faves.getLinks|faves.getLinks] method).
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function removeLink($access_token, $params = array()) {
    return $this->client->request('fave.removeLink', $access_token, $params);
  }
}
