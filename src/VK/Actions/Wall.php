<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Wall {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Returns a list of posts on a user wall or community wall.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the wall. By default, current user ID. Use a negative value to designate a community ID.
   * domain string User or community short address.
   * offset integer Offset needed to return a specific subset of posts.
   * count integer Number of posts to return (maximum 100).
   * filter string Filter to apply: 'owner' — posts by the wall owner, 'others' — posts by someone else, 'all' — posts by the wall owner and others (default), 'postponed' — timed posts (only available for calls with an 'access_token'), 'suggests' — suggested posts on a community wall
   * extended boolean '1' — to return 'wall', 'profiles', and 'groups' fields, '0' — to return no additional fields (default)
   * fields array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function get($access_token, $params = array()) {
    return $this->client->request('wall.get', $access_token, $params);
  }

  /**
   * Allows to search posts on user or community walls.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer user or community id. "Remember that for a community 'owner_id' must be negative."
   * domain string user or community screen name.
   * query string search query string.
   * owners_only boolean '1' – returns only page owner's posts.
   * count integer count of posts to return.
   * offset integer Offset needed to return a specific subset of posts.
   * extended boolean show extended post info.
   * fields array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function search($access_token, $params = array()) {
    return $this->client->request('wall.search', $access_token, $params);
  }

  /**
   * Returns a list of posts from user or community walls by their IDs.
   * 
   * @param $access_token string
   * @param $params array
   * posts array User or community IDs and post IDs, separated by underscores. Use a negative value to designate a community ID. Example: "93388_21539,93388_20904,2943_4276,-1_1"
   * extended boolean '1' — to return user and community objects needed to display posts, '0' — no additional fields are returned (default)
   * copy_history_depth integer Sets the number of parent elements to include in the array 'copy_history' that is returned if the post is a repost from another wall.
   * fields array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getById($access_token, $params = array()) {
    return $this->client->request('wall.getById', $access_token, $params);
  }

  /**
   * Adds a new post on a user wall or community wall. Can also be used to publish suggested or scheduled posts.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer User ID or community ID. Use a negative value to designate a community ID.
   * friends_only boolean '1' — post will be available to friends only, '0' — post will be available to all users (default)
   * from_group boolean For a community: '1' — post will be published by the community, '0' — post will be published by the user (default)
   * message string (Required if 'attachments' is not set.) Text of the post.
   * attachments array (Required if 'message' is not set.) List of objects attached to the post, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, 'page' — wiki-page, 'note' — note, 'poll' — poll, 'album' — photo album, '<owner_id>' — ID of the media application owner. '<media_id>' — Media application ID. Example: "photo100172_166443618,photo66748_265827614", May contain a link to an external page to include in the post. Example: "photo66748_265827614,http://habrahabr.ru", "NOTE: If more than one link is being attached, an error will be thrown."
   * services string List of services or websites the update will be exported to, if the user has so requested. Sample values: 'twitter', 'facebook'.
   * signed boolean Only for posts in communities with 'from_group' set to '1': '1' — post will be signed with the name of the posting user, '0' — post will not be signed (default)
   * publish_date integer Publication date (in Unix time). If used, posting will be delayed until the set time.
   * lat number Geographical latitude of a check-in, in degrees (from -90 to 90).
   * long number Geographical longitude of a check-in, in degrees (from -180 to 180).
   * place_id integer ID of the location where the user was tagged.
   * post_id integer Post ID. Used for publishing of scheduled and suggested posts.
   * guid string
   * mark_as_ads boolean
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function post($access_token, $params = array()) {
    return $this->client->request('wall.post', $access_token, $params);
  }

  /**
   * Reposts (copies) an object to a user wall or community wall.
   * 
   * @param $access_token string
   * @param $params array
   * object string ID of the object to be reposted on the wall. Example: "wall66748_3675"
   * message string Comment to be added along with the reposted object.
   * group_id integer Target community ID when reposting to a community.
   * mark_as_ads boolean
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function repost($access_token, $params = array()) {
    return $this->client->request('wall.repost', $access_token, $params);
  }

  /**
   * Returns information about reposts of a post on user wall or community wall.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer User ID or community ID. By default, current user ID. Use a negative value to designate a community ID.
   * post_id integer Post ID.
   * offset integer Offset needed to return a specific subset of reposts.
   * count integer Number of reposts to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getReposts($access_token, $params = array()) {
    return $this->client->request('wall.getReposts', $access_token, $params);
  }

  /**
   * Edits a post on a user wall or community wall.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer User ID or community ID. Use a negative value to designate a community ID.
   * post_id integer Post ID.
   * friends_only boolean (Applies only when editing a scheduled post.), '1' — post will be available to friends only, '0' — post will be available to all users (default)
   * message string (Required if 'attachments' is not set.) Text of the post.
   * attachments array (Required if 'message' is not set.) List of objects attached to the post, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media application owner. '<media_id>' — Media application ID. Example: "photo100172_166443618,photo66748_265827614", May contain a link to an external page to include in the post. Example: "photo66748_265827614,http://habrahabr.ru", "NOTE: If more than one link is being attached, an error is thrown."
   * services string (Applies only to a scheduled post.) List of services or websites where status will be updated, if the user has so requested. Sample values: 'twitter', 'facebook'.
   * signed boolean (Applies only to a post that was created "as community" on a community wall.), '1' — to add the signature of the user who created the post
   * publish_date integer (Applies only to a scheduled post.) Publication date (in Unix time). If used, posting will be delayed until the set time.
   * lat number Geographical latitude of the check-in, in degrees (from -90 to 90).
   * long number Geographical longitude of the check-in, in degrees (from -180 to 180).
   * place_id integer ID of the location where the user was tagged.
   * mark_as_ads boolean
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function edit($access_token, $params = array()) {
    return $this->client->request('wall.edit', $access_token, $params);
  }

  /**
   * Deletes a post from a user wall or community wall.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer User ID or community ID. Use a negative value to designate a community ID.
   * post_id integer ID of the post to be deleted.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function delete($access_token, $params = array()) {
    return $this->client->request('wall.delete', $access_token, $params);
  }

  /**
   * Restores a post deleted from a user wall or community wall.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer User ID or community ID from whose wall the post was deleted. Use a negative value to designate a community ID.
   * post_id integer ID of the post to be restored.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function restore($access_token, $params = array()) {
    return $this->client->request('wall.restore', $access_token, $params);
  }

  /**
   * Pins the post on wall.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the wall. By default, current user ID. Use a negative value to designate a community ID.
   * post_id integer Post ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function pin($access_token, $params = array()) {
    return $this->client->request('wall.pin', $access_token, $params);
  }

  /**
   * Unpins the post on wall.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the wall. By default, current user ID. Use a negative value to designate a community ID.
   * post_id integer Post ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function unpin($access_token, $params = array()) {
    return $this->client->request('wall.unpin', $access_token, $params);
  }

  /**
   * Returns a list of comments on a post on a user wall or community wall.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer User ID or community ID. Use a negative value to designate a community ID.
   * post_id integer Post ID.
   * need_likes boolean '1' — to return the 'likes' field, '0' — not to return the 'likes' field (default)
   * start_comment_id integer
   * offset integer Offset needed to return a specific subset of comments.
   * count integer Number of comments to return (maximum 100).
   * sort string Sort order: 'asc' — chronological, 'desc' — reverse chronological
   * preview_length integer Number of characters at which to truncate comments when previewed. By default, '90'. Specify '0' if you do not want to truncate comments.
   * extended boolean
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getComments($access_token, $params = array()) {
    return $this->client->request('wall.getComments', $access_token, $params);
  }

  /**
   * Adds a comment to a post on a user wall or community wall.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer User ID or community ID. Use a negative value to designate a community ID.
   * post_id integer Post ID.
   * from_group integer Group ID.
   * message string (Required if 'attachments' is not set.) Text of the comment.
   * reply_to_comment integer ID of comment to reply.
   * attachments array (Required if 'message' is not set.) List of media objects attached to the comment, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media ojbect: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media owner. '<media_id>' — Media ID. For example: "photo100172_166443618,photo66748_265827614"
   * sticker_id integer Sticker ID.
   * guid string Unique identifier to avoid repeated comments.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function createComment($access_token, $params = array()) {
    return $this->client->request('wall.createComment', $access_token, $params);
  }

  /**
   * Edits a comment on a user wall or community wall.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer User ID or community ID. Use a negative value to designate a community ID.
   * comment_id integer Comment ID.
   * message string New comment text.
   * attachments array List of objects attached to the comment, in the following format: , "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media attachment owner. '<media_id>' — Media attachment ID. For example: "photo100172_166443618,photo66748_265827614"
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function editComment($access_token, $params = array()) {
    return $this->client->request('wall.editComment', $access_token, $params);
  }

  /**
   * Deletes a comment on a post on a user wall or community wall.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer User ID or community ID. Use a negative value to designate a community ID.
   * comment_id integer Comment ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function deleteComment($access_token, $params = array()) {
    return $this->client->request('wall.deleteComment', $access_token, $params);
  }

  /**
   * Restores a comment deleted from a user wall or community wall.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer User ID or community ID. Use a negative value to designate a community ID.
   * comment_id integer Comment ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function restoreComment($access_token, $params = array()) {
    return $this->client->request('wall.restoreComment', $access_token, $params);
  }

  /**
   * Reports (submits a complaint about) a post on a user wall or community wall.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the wall.
   * post_id integer Post ID.
   * reason integer Reason for the complaint: '0' – spam, '1' – child pornography, '2' – extremism, '3' – violence, '4' – drug propaganda, '5' – adult material, '6' – insult, abuse
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function reportPost($access_token, $params = array()) {
    return $this->client->request('wall.reportPost', $access_token, $params);
  }

  /**
   * Reports (submits a complaint about) a comment on a post on a user wall or community wall.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the wall.
   * comment_id integer Comment ID.
   * reason integer Reason for the complaint: '0' – spam, '1' – child pornography, '2' – extremism, '3' – violence, '4' – drug propaganda, '5' – adult material, '6' – insult, abuse
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function reportComment($access_token, $params = array()) {
    return $this->client->request('wall.reportComment', $access_token, $params);
  }
}
