<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Friends {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Returns a list of user IDs or detailed information about a user's friends.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer User ID. By default, the current user ID.
   * order string Sort order: , 'name' — by name (enabled only if the 'fields' parameter is used), 'hints' — by rating, similar to how friends are sorted in My friends section, , This parameter is available only for [vk.com/dev/standalone|desktop applications].
   * list_id integer ID of the friend list returned by the [vk.com/dev/friends.getLists|friends.getLists] method to be used as the source. This parameter is taken into account only when the uid parameter is set to the current user ID. This parameter is available only for [vk.com/dev/standalone|desktop applications].
   * count integer Number of friends to return.
   * offset integer Offset needed to return a specific subset of friends.
   * fields array Profile fields to return. Sample values: 'uid', 'first_name', 'last_name', 'nickname', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'domain', 'has_mobile', 'rate', 'contacts', 'education'.
   * name_case string Case for declension of user name and surname: , 'nom' — nominative (default) , 'gen' — genitive , 'dat' — dative , 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function get($access_token, $params = array()) {
    return $this->client->request('friends.get', $access_token, $params);
  }

  /**
   * Returns a list of user IDs of a user's friends who are online.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer User ID.
   * list_id integer Friend list ID. If this parameter is not set, information about all online friends is returned.
   * online_mobile boolean '1' — to return an additional 'online_mobile' field, '0' — (default),
   * order string Sort order: 'random' — random order
   * count integer Number of friends to return.
   * offset integer Offset needed to return a specific subset of friends.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getOnline($access_token, $params = array()) {
    return $this->client->request('friends.getOnline', $access_token, $params);
  }

  /**
   * Returns a list of user IDs of the mutual friends of two users.
   * 
   * @param $access_token string
   * @param $params array
   * source_uid integer ID of the user whose friends will be checked against the friends of the user specified in 'target_uid'.
   * target_uid integer ID of the user whose friends will be checked against the friends of the user specified in 'source_uid'.
   * target_uids array IDs of the users whose friends will be checked against the friends of the user specified in 'source_uid'.
   * order string Sort order: 'random' — random order
   * count integer Number of mutual friends to return.
   * offset integer Offset needed to return a specific subset of mutual friends.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getMutual($access_token, $params = array()) {
    return $this->client->request('friends.getMutual', $access_token, $params);
  }

  /**
   * Returns a list of user IDs of the current user's recently added friends.
   * 
   * @param $access_token string
   * @param $params array
   * count integer Number of recently added friends to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getRecent($access_token, $params = array()) {
    return $this->client->request('friends.getRecent', $access_token, $params);
  }

  /**
   * Returns information about the current user's incoming and outgoing friend requests.
   * 
   * @param $access_token string
   * @param $params array
   * offset integer Offset needed to return a specific subset of friend requests.
   * count integer Number of friend requests to return (default 100, maximum 1000).
   * extended boolean '1' — to return response messages from users who have sent a friend request or, if 'suggested' is set to '1', to return a list of suggested friends
   * need_mutual boolean '1' — to return a list of mutual friends (up to 20), if any
   * out boolean '1' — to return outgoing requests, '0' — to return incoming requests (default)
   * sort integer Sort order: '1' — by number of mutual friends, '0' — by date
   * suggested boolean '1' — to return a list of suggested friends, '0' — to return friend requests (default)
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getRequests($access_token, $params = array()) {
    return $this->client->request('friends.getRequests', $access_token, $params);
  }

  /**
   * Approves or creates a friend request.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer ID of the user whose friend request will be approved or to whom a friend request will be sent.
   * text string Text of the message (up to 500 characters) for the friend request, if any.
   * follow boolean '1' to pass an incoming request to followers list.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function add($access_token, $params = array()) {
    return $this->client->request('friends.add', $access_token, $params);
  }

  /**
   * Edits the friend lists of the selected user.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer ID of the user whose friend list is to be edited.
   * list_ids array IDs of the friend lists to which to add the user.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function edit($access_token, $params = array()) {
    return $this->client->request('friends.edit', $access_token, $params);
  }

  /**
   * Declines a friend request or deletes a user from the current user's friend list.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer ID of the user whose friend request is to be declined or who is to be deleted from the current user's friend list.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function delete($access_token, $params = array()) {
    return $this->client->request('friends.delete', $access_token, $params);
  }

  /**
   * Returns a list of the user's friend lists.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer User ID.
   * return_system boolean '1' — to return system friend lists. By default: '0'.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getLists($access_token, $params = array()) {
    return $this->client->request('friends.getLists', $access_token, $params);
  }

  /**
   * Creates a new friend list for the current user.
   * 
   * @param $access_token string
   * @param $params array
   * name string Name of the friend list.
   * user_ids array IDs of users to be added to the friend list.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function addList($access_token, $params = array()) {
    return $this->client->request('friends.addList', $access_token, $params);
  }

  /**
   * Edits a friend list of the current user.
   * 
   * @param $access_token string
   * @param $params array
   * name string Name of the friend list.
   * list_id integer Friend list ID.
   * user_ids array IDs of users in the friend list.
   * add_user_ids array (Applies if 'user_ids' parameter is not set.), User IDs to add to the friend list.
   * delete_user_ids array (Applies if 'user_ids' parameter is not set.), User IDs to delete from the friend list.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function editList($access_token, $params = array()) {
    return $this->client->request('friends.editList', $access_token, $params);
  }

  /**
   * Deletes a friend list of the current user.
   * 
   * @param $access_token string
   * @param $params array
   * list_id integer ID of the friend list to delete.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function deleteList($access_token, $params = array()) {
    return $this->client->request('friends.deleteList', $access_token, $params);
  }

  /**
   * Returns a list of IDs of the current user's friends who installed the application.
   * 
   * @param $access_token string
   * @param $params array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getAppUsers($access_token, $params = array()) {
    return $this->client->request('friends.getAppUsers', $access_token, $params);
  }

  /**
   * Returns a list of the current user's friends whose phone numbers, validated or specified in a profile, are in a given list.
   * 
   * @param $access_token string
   * @param $params array
   * phones array List of phone numbers in MSISDN format (maximum 1000). Example: "+79219876543,+79111234567"
   * fields array Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate', 'contacts', 'education', 'online, counters'.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getByPhones($access_token, $params = array()) {
    return $this->client->request('friends.getByPhones', $access_token, $params);
  }

  /**
   * Marks all incoming friend requests as viewed.
   * 
   * @param $access_token string
   * @param $params array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function deleteAllRequests($access_token, $params = array()) {
    return $this->client->request('friends.deleteAllRequests', $access_token, $params);
  }

  /**
   * Returns a list of profiles of users whom the current user may know.
   * 
   * @param $access_token string
   * @param $params array
   * filter array Types of potential friends to return: 'mutual' — users with many mutual friends , 'contacts' — users found with the [vk.com/dev/account.importContacts|account.importContacts] method , 'mutual_contacts' — users who imported the same contacts as the current user with the [vk.com/dev/account.importContacts|account.importContacts] method
   * count integer Number of suggestions to return.
   * offset integer Offset needed to return a specific subset of suggestions.
   * fields array Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate', 'contacts', 'education', 'online', 'counters'.
   * name_case string Case for declension of user name and surname: , 'nom' — nominative (default) , 'gen' — genitive , 'dat' — dative , 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getSuggestions($access_token, $params = array()) {
    return $this->client->request('friends.getSuggestions', $access_token, $params);
  }

  /**
   * Checks the current user's friendship status with other specified users.
   * 
   * @param $access_token string
   * @param $params array
   * user_ids array IDs of the users whose friendship status to check.
   * need_sign boolean '1' — to return 'sign' field. 'sign' is md5("{id}_{user_id}_{friends_status}_{application_secret}"), where id is current user ID. This field allows to check that data has not been modified by the client. By default: '0'.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function areFriends($access_token, $params = array()) {
    return $this->client->request('friends.areFriends', $access_token, $params);
  }

  /**
   * Returns a list of friends who can be called by the current user.
   * 
   * @param $access_token string
   * @param $params array
   * fields array Profile fields to return. Sample values: 'uid', 'first_name', 'last_name', 'nickname', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'domain', 'has_mobile', 'rate', 'contacts', 'education'.
   * name_case string Case for declension of user name and surname: , 'nom' — nominative (default) , 'gen' — genitive , 'dat' — dative , 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getAvailableForCall($access_token, $params = array()) {
    return $this->client->request('friends.getAvailableForCall', $access_token, $params);
  }

  /**
   * Returns a list of friends matching the search criteria.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer User ID.
   * q string Search query string (e.g., 'Vasya Babich').
   * fields array Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'rate', 'contacts', 'education', 'online',
   * name_case string Case for declension of user name and surname: 'nom' — nominative (default), 'gen' — genitive , 'dat' — dative, 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
   * offset integer Offset needed to return a specific subset of friends.
   * count integer Number of friends to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function search($access_token, $params = array()) {
    return $this->client->request('friends.search', $access_token, $params);
  }
}
