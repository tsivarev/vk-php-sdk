<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Newsfeed {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Returns data required to show newsfeed for the current user.
   * 
   * @param $access_token string
   * @param $params array
   * filters array Filters to apply: 'post' — new wall posts, 'photo' — new photos, 'photo_tag' — new photo tags, 'wall_photo' — new wall photos, 'friend' — new friends, 'note' — new notes
   * return_banned boolean '1' — to return news items from banned sources
   * start_time integer Earliest timestamp (in Unix time) of a news item to return. By default, 24 hours ago.
   * end_time integer Latest timestamp (in Unix time) of a news item to return. By default, the current time.
   * max_photos integer Maximum number of photos to return. By default, '5'.
   * source_ids array Sources to obtain news from, separated by commas. User IDs can be specified in formats '' or 'u' , where '' is the user's friend ID. Community IDs can be specified in formats '-' or 'g' , where '' is the community ID. If the parameter is not set, all of the user's friends and communities are returned, except for banned sources, which can be obtained with the [vk.com/dev/newsfeed.getBanned|newsfeed.getBanned] method.
   * start_from string identifier required to get the next page of results. Value for this parameter is returned in 'next_from' field in a reply.
   * count integer Number of news items to return (default 50, maximum 100). For auto feed, you can use the 'new_offset' parameter returned by this method.
   * fields array Additional fields of [vk.com/dev/fields|profiles] and [vk.com/dev/fields_groups|communities] to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function get($access_token, $params = array()) {
    return $this->client->request('newsfeed.get', $access_token, $params);
  }

  /**
   * , Returns a list of newsfeeds recommended to the current user.
   * 
   * @param $access_token string
   * @param $params array
   * start_time integer Earliest timestamp (in Unix time) of a news item to return. By default, 24 hours ago.
   * end_time integer Latest timestamp (in Unix time) of a news item to return. By default, the current time.
   * max_photos integer Maximum number of photos to return. By default, '5'.
   * start_from string 'new_from' value obtained in previous call.
   * count integer Number of news items to return.
   * fields array Additional fields of [vk.com/dev/fields|profiles] and [vk.com/dev/fields_groups|communities] to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getRecommended($access_token, $params = array()) {
    return $this->client->request('newsfeed.getRecommended', $access_token, $params);
  }

  /**
   * Returns a list of comments in the current user's newsfeed.
   * 
   * @param $access_token string
   * @param $params array
   * count integer Number of comments to return. For auto feed, you can use the 'new_offset' parameter returned by this method.
   * filters array Filters to apply: 'post' — new comments on wall posts, 'photo' — new comments on photos, 'video' — new comments on videos, 'topic' — new comments on discussions, 'note' — new comments on notes,
   * reposts string Object ID, comments on repost of which shall be returned, e.g. 'wall1_45486'. (If the parameter is set, the 'filters' parameter is optional.),
   * start_time integer Earliest timestamp (in Unix time) of a comment to return. By default, 24 hours ago.
   * end_time integer Latest timestamp (in Unix time) of a comment to return. By default, the current time.
   * start_from string Identificator needed to return the next page with results. Value for this parameter returns in 'next_from' field.
   * fields array Additional fields of [vk.com/dev/fields|profiles] and [vk.com/dev/fields_groups|communities] to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getComments($access_token, $params = array()) {
    return $this->client->request('newsfeed.getComments', $access_token, $params);
  }

  /**
   * Returns a list of posts on user walls in which the current user is mentioned.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer Owner ID.
   * start_time integer Earliest timestamp (in Unix time) of a post to return. By default, 24 hours ago.
   * end_time integer Latest timestamp (in Unix time) of a post to return. By default, the current time.
   * offset integer Offset needed to return a specific subset of posts.
   * count integer Number of posts to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getMentions($access_token, $params = array()) {
    return $this->client->request('newsfeed.getMentions', $access_token, $params);
  }

  /**
   * Returns a list of users and communities banned from the current user's newsfeed.
   * 
   * @param $access_token string
   * @param $params array
   * extended boolean '1' — return extra information about users and communities
   * fields array Profile fields to return.
   * name_case string Case for declension of user name and surname: 'nom' — nominative (default), 'gen' — genitive , 'dat' — dative, 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getBanned($access_token, $params = array()) {
    return $this->client->request('newsfeed.getBanned', $access_token, $params);
  }

  /**
   * Prevents news from specified users and communities from appearing in the current user's newsfeed.
   * 
   * @param $access_token string
   * @param $params array
   * user_ids array
   * group_ids array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function addBan($access_token, $params = array()) {
    return $this->client->request('newsfeed.addBan', $access_token, $params);
  }

  /**
   * Allows news from previously banned users and communities to be shown in the current user's newsfeed.
   * 
   * @param $access_token string
   * @param $params array
   * user_ids array
   * group_ids array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function deleteBan($access_token, $params = array()) {
    return $this->client->request('newsfeed.deleteBan', $access_token, $params);
  }

  /**
   * Hides an item from the newsfeed.
   * 
   * @param $access_token string
   * @param $params array
   * type string Item type. Possible values: *'wall' – post on the wall,, *'tag' – tag on a photo,, *'profilephoto' – profile photo,, *'video' – video,, *'audio' – audio.
   * owner_id integer Item owner's identifier (user or community), "Note that community id must be negative. 'owner_id=1' – user , 'owner_id=-1' – community "
   * item_id integer Item identifier
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function ignoreItem($access_token, $params = array()) {
    return $this->client->request('newsfeed.ignoreItem', $access_token, $params);
  }

  /**
   * Returns a hidden item to the newsfeed.
   * 
   * @param $access_token string
   * @param $params array
   * type string Item type. Possible values: *'wall' – post on the wall,, *'tag' – tag on a photo,, *'profilephoto' – profile photo,, *'video' – video,, *'audio' – audio.
   * owner_id integer Item owner's identifier (user or community), "Note that community id must be negative. 'owner_id=1' – user , 'owner_id=-1' – community "
   * item_id integer Item identifier
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function unignoreItem($access_token, $params = array()) {
    return $this->client->request('newsfeed.unignoreItem', $access_token, $params);
  }

  /**
   * Returns search results by statuses.
   * 
   * @param $access_token string
   * @param $params array
   * q string Search query string (e.g., 'New Year').
   * extended boolean '1' — to return additional information about the user or community that placed the post.
   * count integer Number of posts to return.
   * latitude number Geographical latitude point (in degrees, -90 to 90) within which to search.
   * longitude number Geographical longitude point (in degrees, -180 to 180) within which to search.
   * start_time integer Earliest timestamp (in Unix time) of a news item to return. By default, 24 hours ago.
   * end_time integer Latest timestamp (in Unix time) of a news item to return. By default, the current time.
   * start_from string
   * fields array Additional fields of [vk.com/dev/fields|profiles] and [vk.com/dev/fields_groups|communities] to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function search($access_token, $params = array()) {
    return $this->client->request('newsfeed.search', $access_token, $params);
  }

  /**
   * Returns a list of newsfeeds followed by the current user.
   * 
   * @param $access_token string
   * @param $params array
   * list_ids array numeric list identifiers.
   * extended boolean Return additional list info
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getLists($access_token, $params = array()) {
    return $this->client->request('newsfeed.getLists', $access_token, $params);
  }

  /**
   * Creates and edits user newsfeed lists
   * 
   * @param $access_token string
   * @param $params array
   * list_id integer numeric list identifier (if not sent, will be set automatically).
   * title string list name.
   * source_ids array users and communities identifiers to be added to the list. Community identifiers must be negative numbers.
   * no_reposts boolean reposts display on and off ('1' is for off).
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function saveList($access_token, $params = array()) {
    return $this->client->request('newsfeed.saveList', $access_token, $params);
  }

  /**
   * 
   * 
   * @param $access_token string
   * @param $params array
   * list_id integer
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function deleteList($access_token, $params = array()) {
    return $this->client->request('newsfeed.deleteList', $access_token, $params);
  }

  /**
   * Unsubscribes the current user from specified newsfeeds.
   * 
   * @param $access_token string
   * @param $params array
   * type string Type of object from which to unsubscribe: 'note' — note, 'photo' — photo, 'post' — post on user wall or community wall, 'topic' — topic, 'video' — video
   * owner_id integer Object owner ID.
   * item_id integer Object ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function unsubscribe($access_token, $params = array()) {
    return $this->client->request('newsfeed.unsubscribe', $access_token, $params);
  }

  /**
   * Returns communities and users that current user is suggested to follow.
   * 
   * @param $access_token string
   * @param $params array
   * offset integer offset required to choose a particular subset of communities or users.
   * count integer amount of communities or users to return.
   * shuffle boolean shuffle the returned list or not.
   * fields array list of extra fields to be returned. See available fields for [vk.com/dev/fields|users] and [vk.com/dev/fields_groups|communities].
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getSuggestedSources($access_token, $params = array()) {
    return $this->client->request('newsfeed.getSuggestedSources', $access_token, $params);
  }
}
