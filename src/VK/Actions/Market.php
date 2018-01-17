<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Market {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Returns items list for a community.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of an item owner community, "Note that community id in the 'owner_id' parameter should be negative number. For example 'owner_id'=-1 matches the [vk.com/apiclub|VK API] community "
   * count integer Number of items to return.
   * offset integer Offset needed to return a specific subset of results.
   * extended boolean '1' – method will return additional fields: 'likes, can_comment, car_repost, photos'. These parameters are not returned by default.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function get($access_token, $params = array()) {
    return $this->client->request('market.get', $access_token, $params);
  }

  /**
   * Returns information about market items by their ids.
   * 
   * @param $access_token string
   * @param $params array
   * item_ids array Comma-separated ids list: {user id}_{item id}. If an item belongs to a community -{community id} is used. " 'Videos' value example: , '-4363_136089719,13245770_137352259'"
   * extended boolean '1' – to return additional fields: 'likes, can_comment, car_repost, photos'. By default: '0'.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getById($access_token, $params = array()) {
    return $this->client->request('market.getById', $access_token, $params);
  }

  /**
   * Searches market items in a community's catalog
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of an items owner community.
   * q string Search query, for example "pink slippers".
   * price_from integer Minimum item price value.
   * price_to integer Maximum item price value.
   * tags array Comma-separated tag IDs list.
   * rev integer '0' — do not use reverse order, '1' — use reverse order
   * offset integer Offset needed to return a specific subset of results.
   * count integer Number of items to return.
   * extended boolean '1' – to return additional fields: 'likes, can_comment, car_repost, photos'. By default: '0'.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function search($access_token, $params = array()) {
    return $this->client->request('market.search', $access_token, $params);
  }

  /**
   * Returns community's collections list.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of an items owner community.
   * offset integer Offset needed to return a specific subset of results.
   * count integer Number of items to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getAlbums($access_token, $params = array()) {
    return $this->client->request('market.getAlbums', $access_token, $params);
  }

  /**
   * Returns items album's data
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer identifier of an album owner community, "Note that community id in the 'owner_id' parameter should be negative number. For example 'owner_id'=-1 matches the [vk.com/apiclub|VK API] community "
   * album_ids array collections identifiers to obtain data from
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getAlbumById($access_token, $params = array()) {
    return $this->client->request('market.getAlbumById', $access_token, $params);
  }

  /**
   * Creates a new comment for an item.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of an item owner community.
   * item_id integer Item ID.
   * message string Comment text (required if 'attachments' parameter is not specified)
   * attachments array Comma-separated list of objects attached to a comment. The field is submitted the following way: , "'<owner_id>_<media_id>,<owner_id>_<media_id>'", , '' - media attachment type: "'photo' - photo, 'video' - video, 'audio' - audio, 'doc' - document", , '<owner_id>' - media owner id, '<media_id>' - media attachment id, , For example: "photo100172_166443618,photo66748_265827614",
   * from_group boolean '1' - comment will be published on behalf of a community, '0' - on behalf of a user (by default).
   * reply_to_comment integer ID of a comment to reply with current comment to.
   * sticker_id integer Sticker ID.
   * guid string Random value to avoid resending one comment.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function createComment($access_token, $params = array()) {
    return $this->client->request('market.createComment', $access_token, $params);
  }

  /**
   * Returns comments list for an item.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of an item owner community
   * item_id integer Item ID.
   * need_likes boolean '1' — to return likes info.
   * start_comment_id integer ID of a comment to start a list from (details below).
   * count integer Number of results to return.
   * sort string Sort order ('asc' — from old to new, 'desc' — from new to old)
   * extended boolean '1' — comments will be returned as numbered objects, in addition lists of 'profiles' and 'groups' objects will be returned.
   * fields array List of additional profile fields to return. See the [vk.com/dev/fields|details]
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getComments($access_token, $params = array()) {
    return $this->client->request('market.getComments', $access_token, $params);
  }

  /**
   * Deletes an item's comment
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer identifier of an item owner community, "Note that community id in the 'owner_id' parameter should be negative number. For example 'owner_id'=-1 matches the [vk.com/apiclub|VK API] community "
   * comment_id integer comment id
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function deleteComment($access_token, $params = array()) {
    return $this->client->request('market.deleteComment', $access_token, $params);
  }

  /**
   * Restores a recently deleted comment
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer identifier of an item owner community, "Note that community id in the 'owner_id' parameter should be negative number. For example 'owner_id'=-1 matches the [vk.com/apiclub|VK API] community "
   * comment_id integer deleted comment id
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function restoreComment($access_token, $params = array()) {
    return $this->client->request('market.restoreComment', $access_token, $params);
  }

  /**
   * Chages item comment's text
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of an item owner community.
   * comment_id integer Comment ID.
   * message string New comment text (required if 'attachments' are not specified), , 2048 symbols maximum.
   * attachments array Comma-separated list of objects attached to a comment. The field is submitted the following way: , "'<owner_id>_<media_id>,<owner_id>_<media_id>'", , '' - media attachment type: "'photo' - photo, 'video' - video, 'audio' - audio, 'doc' - document", , '<owner_id>' - media owner id, '<media_id>' - media attachment id, , For example: "photo100172_166443618,photo66748_265827614",
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function editComment($access_token, $params = array()) {
    return $this->client->request('market.editComment', $access_token, $params);
  }

  /**
   * Sends a complaint to the item's comment.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of an item owner community.
   * comment_id integer Comment ID.
   * reason integer Complaint reason. Possible values: *'0' — spam,, *'1' — child porn,, *'2' — extremism,, *'3' — violence,, *'4' — drugs propaganda,, *'5' — adult materials,, *'6' — insult.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function reportComment($access_token, $params = array()) {
    return $this->client->request('market.reportComment', $access_token, $params);
  }

  /**
   * Returns a list of market categories.
   * 
   * @param $access_token string
   * @param $params array
   * count integer Number of results to return.
   * offset integer Offset needed to return a specific subset of results.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getCategories($access_token, $params = array()) {
    return $this->client->request('market.getCategories', $access_token, $params);
  }

  /**
   * Sends a complaint to the item.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of an item owner community.
   * item_id integer Item ID.
   * reason integer Complaint reason. Possible values: *'0' — spam,, *'1' — child porn,, *'2' — extremism,, *'3' — violence,, *'4' — drugs propaganda,, *'5' — adult materials,, *'6' — insult.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function report($access_token, $params = array()) {
    return $this->client->request('market.report', $access_token, $params);
  }

  /**
   * Ads a new item to the market.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of an item owner community.
   * name string Item name.
   * description string Item description.
   * category_id integer Item category ID.
   * price number Item price.
   * deleted boolean Item status ('1' — deleted, '0' — not deleted).
   * main_photo_id integer Cover photo ID.
   * photo_ids array IDs of additional photos.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function add($access_token, $params = array()) {
    return $this->client->request('market.add', $access_token, $params);
  }

  /**
   * Edits an item.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of an item owner community.
   * item_id integer Item ID.
   * name string Item name.
   * description string Item description.
   * category_id integer Item category ID.
   * price number Item price.
   * deleted boolean Item status ('1' — deleted, '0' — not deleted).
   * main_photo_id integer Cover photo ID.
   * photo_ids array IDs of additional photos.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function edit($access_token, $params = array()) {
    return $this->client->request('market.edit', $access_token, $params);
  }

  /**
   * Deletes an item.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of an item owner community.
   * item_id integer Item ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function delete($access_token, $params = array()) {
    return $this->client->request('market.delete', $access_token, $params);
  }

  /**
   * Restores recently deleted item
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of an item owner community.
   * item_id integer Deleted item ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function restore($access_token, $params = array()) {
    return $this->client->request('market.restore', $access_token, $params);
  }

  /**
   * Changes item place in a collection.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of an item owner community.
   * album_id integer ID of a collection to reorder items in. Set 0 to reorder full items list.
   * item_id integer Item ID.
   * before integer ID of an item to place current item before it.
   * after integer ID of an item to place current item after it.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function reorderItems($access_token, $params = array()) {
    return $this->client->request('market.reorderItems', $access_token, $params);
  }

  /**
   * Reorders the collections list.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of an item owner community.
   * album_id integer Collection ID.
   * before integer ID of a collection to place current collection before it.
   * after integer ID of a collection to place current collection after it.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function reorderAlbums($access_token, $params = array()) {
    return $this->client->request('market.reorderAlbums', $access_token, $params);
  }

  /**
   * Creates new collection of items
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of an item owner community.
   * title string Collection title.
   * photo_id integer Cover photo ID.
   * main_album boolean Set as main ('1' – set, '0' – no).
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function addAlbum($access_token, $params = array()) {
    return $this->client->request('market.addAlbum', $access_token, $params);
  }

  /**
   * Edits a collection of items
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of an collection owner community.
   * album_id integer Collection ID.
   * title string Collection title.
   * photo_id integer Cover photo id
   * main_album boolean Set as main ('1' – set, '0' – no).
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function editAlbum($access_token, $params = array()) {
    return $this->client->request('market.editAlbum', $access_token, $params);
  }

  /**
   * Deletes a collection of items.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of an collection owner community.
   * album_id integer Collection ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function deleteAlbum($access_token, $params = array()) {
    return $this->client->request('market.deleteAlbum', $access_token, $params);
  }

  /**
   * Removes an item from one or multiple collections.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of an item owner community.
   * item_id integer Item ID.
   * album_ids array Collections IDs to remove item from.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function removeFromAlbum($access_token, $params = array()) {
    return $this->client->request('market.removeFromAlbum', $access_token, $params);
  }

  /**
   * Adds an item to one or multiple collections.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of an item owner community.
   * item_id integer Item ID.
   * album_ids array Collections IDs to add item to.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function addToAlbum($access_token, $params = array()) {
    return $this->client->request('market.addToAlbum', $access_token, $params);
  }
}
