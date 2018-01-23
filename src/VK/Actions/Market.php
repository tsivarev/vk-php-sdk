<?php

namespace VK\Actions;

use VK\VKAPIClient;
use VK\Exceptions\VKClientException;
use VK\VKResponse;
use VK\Actions\Enums\MarketSearchRev;
use VK\Actions\Enums\MarketGetCommentsSort;
use VK\Actions\Enums\MarketReportCommentReason;
use VK\Actions\Enums\MarketReportReason;

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
     *      - integer owner_id: ID of an item owner community, "Note that community id in the 'owner_id' parameter
     *        should be negative number. For example 'owner_id'=-1 matches the [vk.com/apiclub|VK API] community "
     *      - integer count: Number of items to return.
     *      - integer offset: Offset needed to return a specific subset of results.
     *      - boolean extended: '1' – method will return additional fields: 'likes, can_comment, car_repost,
     *        photos'. These parameters are not returned by default.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - array item_ids: Comma-separated ids list: {user id}_{item id}. If an item belongs to a community
     *        -{community id} is used. " 'Videos' value example: , '-4363_136089719,13245770_137352259'"
     *      - boolean extended: '1' – to return additional fields: 'likes, can_comment, car_repost, photos'. By
     *        default: '0'.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: ID of an items owner community.
     *      - string q: Search query, for example "pink slippers".
     *      - integer price_from: Minimum item price value.
     *      - integer price_to: Maximum item price value.
     *      - array tags: Comma-separated tag IDs list.
     *      - MarketSearchRev rev: '0' — do not use reverse order, '1' — use reverse order
     *        @see MarketSearchRev
     *      - integer offset: Offset needed to return a specific subset of results.
     *      - integer count: Number of items to return.
     *      - boolean extended: '1' – to return additional fields: 'likes, can_comment, car_repost, photos'. By
     *        default: '0'.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: ID of an items owner community.
     *      - integer offset: Offset needed to return a specific subset of results.
     *      - integer count: Number of items to return.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: identifier of an album owner community, "Note that community id in the 'owner_id'
     *        parameter should be negative number. For example 'owner_id'=-1 matches the [vk.com/apiclub|VK API] community
     *        "
     *      - array album_ids: collections identifiers to obtain data from
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: ID of an item owner community.
     *      - integer item_id: Item ID.
     *      - string message: Comment text (required if 'attachments' parameter is not specified)
     *      - array attachments: Comma-separated list of objects attached to a comment. The field is submitted the
     *        following way: , "'<owner_id>_<media_id>,<owner_id>_<media_id>'", , '' - media attachment type: "'photo' -
     *        photo, 'video' - video, 'audio' - audio, 'doc' - document", , '<owner_id>' - media owner id, '<media_id>' -
     *        media attachment id, , For example: "photo100172_166443618,photo66748_265827614",
     *      - boolean from_group: '1' - comment will be published on behalf of a community, '0' - on behalf of a
     *        user (by default).
     *      - integer reply_to_comment: ID of a comment to reply with current comment to.
     *      - integer sticker_id: Sticker ID.
     *      - string guid: Random value to avoid resending one comment.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: ID of an item owner community
     *      - integer item_id: Item ID.
     *      - boolean need_likes: '1' — to return likes info.
     *      - integer start_comment_id: ID of a comment to start a list from (details below).
     *      - integer count: Number of results to return.
     *      - MarketGetCommentsSort sort: Sort order ('asc' — from old to new, 'desc' — from new to old)
     *        @see MarketGetCommentsSort
     *      - boolean extended: '1' — comments will be returned as numbered objects, in addition lists of
     *        'profiles' and 'groups' objects will be returned.
     *      - array fields: List of additional profile fields to return. See the [vk.com/dev/fields|details]
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: identifier of an item owner community, "Note that community id in the 'owner_id'
     *        parameter should be negative number. For example 'owner_id'=-1 matches the [vk.com/apiclub|VK API] community
     *        "
     *      - integer comment_id: comment id
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: identifier of an item owner community, "Note that community id in the 'owner_id'
     *        parameter should be negative number. For example 'owner_id'=-1 matches the [vk.com/apiclub|VK API] community
     *        "
     *      - integer comment_id: deleted comment id
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: ID of an item owner community.
     *      - integer comment_id: Comment ID.
     *      - string message: New comment text (required if 'attachments' are not specified), , 2048 symbols
     *        maximum.
     *      - array attachments: Comma-separated list of objects attached to a comment. The field is submitted the
     *        following way: , "'<owner_id>_<media_id>,<owner_id>_<media_id>'", , '' - media attachment type: "'photo' -
     *        photo, 'video' - video, 'audio' - audio, 'doc' - document", , '<owner_id>' - media owner id, '<media_id>' -
     *        media attachment id, , For example: "photo100172_166443618,photo66748_265827614",
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: ID of an item owner community.
     *      - integer comment_id: Comment ID.
     *      - MarketReportCommentReason reason: Complaint reason. Possible values: *'0' — spam,, *'1' — child
     *        porn,, *'2' — extremism,, *'3' — violence,, *'4' — drugs propaganda,, *'5' — adult materials,, *'6'
     *        — insult.
     *        @see MarketReportCommentReason
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer count: Number of results to return.
     *      - integer offset: Offset needed to return a specific subset of results.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: ID of an item owner community.
     *      - integer item_id: Item ID.
     *      - MarketReportReason reason: Complaint reason. Possible values: *'0' — spam,, *'1' — child porn,,
     *        *'2' — extremism,, *'3' — violence,, *'4' — drugs propaganda,, *'5' — adult materials,, *'6' —
     *        insult.
     *        @see MarketReportReason
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: ID of an item owner community.
     *      - string name: Item name.
     *      - string description: Item description.
     *      - integer category_id: Item category ID.
     *      - number price: Item price.
     *      - boolean deleted: Item status ('1' — deleted, '0' — not deleted).
     *      - integer main_photo_id: Cover photo ID.
     *      - array photo_ids: IDs of additional photos.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: ID of an item owner community.
     *      - integer item_id: Item ID.
     *      - string name: Item name.
     *      - string description: Item description.
     *      - integer category_id: Item category ID.
     *      - number price: Item price.
     *      - boolean deleted: Item status ('1' — deleted, '0' — not deleted).
     *      - integer main_photo_id: Cover photo ID.
     *      - array photo_ids: IDs of additional photos.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: ID of an item owner community.
     *      - integer item_id: Item ID.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: ID of an item owner community.
     *      - integer item_id: Deleted item ID.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: ID of an item owner community.
     *      - integer album_id: ID of a collection to reorder items in. Set 0 to reorder full items list.
     *      - integer item_id: Item ID.
     *      - integer before: ID of an item to place current item before it.
     *      - integer after: ID of an item to place current item after it.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: ID of an item owner community.
     *      - integer album_id: Collection ID.
     *      - integer before: ID of a collection to place current collection before it.
     *      - integer after: ID of a collection to place current collection after it.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: ID of an item owner community.
     *      - string title: Collection title.
     *      - integer photo_id: Cover photo ID.
     *      - boolean main_album: Set as main ('1' – set, '0' – no).
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: ID of an collection owner community.
     *      - integer album_id: Collection ID.
     *      - string title: Collection title.
     *      - integer photo_id: Cover photo id
     *      - boolean main_album: Set as main ('1' – set, '0' – no).
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: ID of an collection owner community.
     *      - integer album_id: Collection ID.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: ID of an item owner community.
     *      - integer item_id: Item ID.
     *      - array album_ids: Collections IDs to remove item from.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer owner_id: ID of an item owner community.
     *      - integer item_id: Item ID.
     *      - array album_ids: Collections IDs to add item to.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function addToAlbum($access_token, $params = array()) {
        return $this->client->request('market.addToAlbum', $access_token, $params);
    }
}
