<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Messages {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Returns a list of the current user's incoming or outgoing private messages.
   * 
   * @param $access_token string
   * @param $params array
   * out boolean '1' — to return outgoing messages, '0' — to return incoming messages (default)
   * offset integer Offset needed to return a specific subset of messages.
   * count integer Number of messages to return.
   * filter integer 8 - important messages
   * time_offset integer Maximum time since a message was sent, in seconds. To return messages without a time limitation, set as '0'.
   * preview_length integer Number of characters after which to truncate a previewed message. To preview the full message, specify '0'. "NOTE: Messages are not truncated by default. Messages are truncated by words."
   * last_message_id integer ID of the message received before the message that will be returned last (provided that no more than 'count' messages were received before it, otherwise 'offset' parameter shall be used).
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function get($access_token, $params = array()) {
    return $this->client->request('messages.get', $access_token, $params);
  }

  /**
   * Returns a list of the current user's conversations.
   * 
   * @param $access_token string
   * @param $params array
   * offset integer Offset needed to return a specific subset of conversations.
   * count integer Number of conversations to return.
   * start_message_id integer ID of the message from what to return dialogs.
   * preview_length integer Number of characters after which to truncate a previewed message. To preview the full message, specify '0'. "NOTE: Messages are not truncated by default. Messages are truncated by words."
   * unread boolean '1' — return conversations with unread messages only.
   * important boolean '1' — return important conversations only.
   * unanswered boolean '1' — return unanswered conversations only.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getDialogs($access_token, $params = array()) {
    return $this->client->request('messages.getDialogs', $access_token, $params);
  }

  /**
   * Returns messages by their IDs.
   * 
   * @param $access_token string
   * @param $params array
   * message_ids array Message IDs.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getById($access_token, $params = array()) {
    return $this->client->request('messages.getById', $access_token, $params);
  }

  /**
   * Returns a list of the current user's private messages that match search criteria.
   * 
   * @param $access_token string
   * @param $params array
   * q string Search query string.
   * peer_id integer Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
   * date integer Date to search message before in Unixtime.
   * preview_length integer Number of characters after which to truncate a previewed message. To preview the full message, specify '0'. "NOTE: Messages are not truncated by default. Messages are truncated by words."
   * offset integer Offset needed to return a specific subset of messages.
   * count integer Number of messages to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function search($access_token, $params = array()) {
    return $this->client->request('messages.search', $access_token, $params);
  }

  /**
   * Returns message history for the specified user or group chat.
   * 
   * @param $access_token string
   * @param $params array
   * offset integer Offset needed to return a specific subset of messages.
   * count integer Number of messages to return.
   * user_id integer ID of the user whose message history you want to return.
   * peer_id integer
   * start_message_id integer Starting message ID from which to return history.
   * rev integer Sort order: '1' — return messages in chronological order. '0' — return messages in reverse chronological order.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getHistory($access_token, $params = array()) {
    return $this->client->request('messages.getHistory', $access_token, $params);
  }

  /**
   * Returns media files from the dialog or group chat.
   * 
   * @param $access_token string
   * @param $params array
   * peer_id integer Peer ID. ", For group chat: '2000000000 + chat ID' , , For community: '-community ID'"
   * media_type string Type of media files to return: *'photo',, *'video',, *'audio',, *'doc',, *'link'.,*'market'.,*'wall'.,*'share'
   * start_from string Message ID to start return results from.
   * count integer Number of objects to return.
   * photo_sizes boolean '1' — to return photo sizes in a
   * fields array Additional profile [vk.com/dev/fields|fields] to return. 
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getHistoryAttachments($access_token, $params = array()) {
    return $this->client->request('messages.getHistoryAttachments', $access_token, $params);
  }

  /**
   * Sends a message.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer User ID (by default — current user).
   * random_id integer Unique identifier to avoid resending the message.
   * peer_id integer Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
   * domain string User's short address (for example, 'illarionov').
   * chat_id integer ID of conversation the message will relate to.
   * user_ids array IDs of message recipients (if new conversation shall be started).
   * message string (Required if 'attachments' is not set.) Text of the message.
   * lat number Geographical latitude of a check-in, in degrees (from -90 to 90).
   * long number Geographical longitude of a check-in, in degrees (from -180 to 180).
   * attachment string (Required if 'message' is not set.) List of objects attached to the message, separated by commas, in the following format: "<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, 'wall' — wall post, '<owner_id>' — ID of the media attachment owner. '<media_id>' — media attachment ID. Example: "photo100172_166443618"
   * forward_messages string ID of forwarded messages, separated with a comma. Listed messages of the sender will be shown in the message body at the recipient's. Example: "123,431,544"
   * sticker_id integer Sticker id.
   * notification boolean '1' if the message is a notification (for community messages).
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function send($access_token, $params = array()) {
    return $this->client->request('messages.send', $access_token, $params);
  }

  /**
   * Deletes one or more messages.
   * 
   * @param $access_token string
   * @param $params array
   * message_ids array Message IDs.
   * spam boolean '1' — to mark message as spam.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function delete($access_token, $params = array()) {
    return $this->client->request('messages.delete', $access_token, $params);
  }

  /**
   * Deletes all private messages in a conversation.
   * 
   * @param $access_token string
   * @param $params array
   * user_id string User ID. To clear a chat history use 'chat_id'
   * peer_id integer Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
   * offset integer Offset needed to return a specific subset of messages.
   * count integer Number of messages to delete. "NOTE: If the number of messages exceeds the maximum, the method shall be called several times."
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function deleteDialog($access_token, $params = array()) {
    return $this->client->request('messages.deleteDialog', $access_token, $params);
  }

  /**
   * Restores a deleted message.
   * 
   * @param $access_token string
   * @param $params array
   * message_id integer ID of a previously-deleted message to restore.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function restore($access_token, $params = array()) {
    return $this->client->request('messages.restore', $access_token, $params);
  }

  /**
   * Marks messages as read.
   * 
   * @param $access_token string
   * @param $params array
   * message_ids array IDs of messages to mark as read.
   * peer_id string Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
   * start_message_id integer Message ID to start from.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function markAsRead($access_token, $params = array()) {
    return $this->client->request('messages.markAsRead', $access_token, $params);
  }

  /**
   * Marks and unmarks messages as important (starred).
   * 
   * @param $access_token string
   * @param $params array
   * message_ids array IDs of messages to mark as important.
   * important boolean '1' — to add a star (mark as important), '0' — to remove the star
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function markAsImportant($access_token, $params = array()) {
    return $this->client->request('messages.markAsImportant', $access_token, $params);
  }

  /**
   * Marks and unmarks dialogs as important.
   * 
   * @param $access_token string
   * @param $params array
   * peer_id array IDs of messages to mark as important.
   * important boolean '1' — to add a star (mark as important), '0' — to remove the star
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function markAsImportantDialog($access_token, $params = array()) {
    return $this->client->request('messages.markAsImportantDialog', $access_token, $params);
  }

  /**
   * Marks and unmarks dialogs as unanswered.
   * 
   * @param $access_token string
   * @param $params array
   * peer_id array IDs of messages to mark as important.
   * important boolean '1' — to add a star (mark as important), '0' — to remove the star
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function markAsUnansweredDialog($access_token, $params = array()) {
    return $this->client->request('messages.markAsUnansweredDialog', $access_token, $params);
  }

  /**
   * Returns data required for connection to a Long Poll server.
   * 
   * @param $access_token string
   * @param $params array
   * lp_version integer Long poll version
   * need_pts boolean '1' — to return the 'pts' field, needed for the [vk.com/dev/messages.getLongPollHistory|messages.getLongPollHistory] method.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getLongPollServer($access_token, $params = array()) {
    return $this->client->request('messages.getLongPollServer', $access_token, $params);
  }

  /**
   * Returns updates in user's private messages.
   * 
   * @param $access_token string
   * @param $params array
   * ts integer Last value of the 'ts' parameter returned from the Long Poll server or by using [vk.com/dev/messages.getLongPollHistory|messages.getLongPollHistory] method.
   * pts integer Lsat value of 'pts' parameter returned from the Long Poll server or by using [vk.com/dev/messages.getLongPollHistory|messages.getLongPollHistory] method.
   * preview_length integer Number of characters after which to truncate a previewed message. To preview the full message, specify '0'. "NOTE: Messages are not truncated by default. Messages are truncated by words."
   * onlines boolean '1' — to return history with online users only.
   * fields array Additional profile [vk.com/dev/fields|fields] to return.
   * events_limit integer Maximum number of events to return.
   * msgs_limit integer Maximum number of messages to return.
   * max_msg_id integer Maximum ID of the message among existing ones in the local copy. Both messages received with API methods (for example, , ), and data received from a Long Poll server (events with code 4) are taken into account.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getLongPollHistory($access_token, $params = array()) {
    return $this->client->request('messages.getLongPollHistory', $access_token, $params);
  }

  /**
   * Returns information about a chat.
   * 
   * @param $access_token string
   * @param $params array
   * chat_id integer Chat ID.
   * chat_ids array Chat IDs.
   * fields array Profile fields to return.
   * name_case string Case for declension of user name and surname: 'nom' — nominative (default), 'gen' — genitive , 'dat' — dative, 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getChat($access_token, $params = array()) {
    return $this->client->request('messages.getChat', $access_token, $params);
  }

  /**
   * Creates a chat with several participants.
   * 
   * @param $access_token string
   * @param $params array
   * user_ids array IDs of the users to be added to the chat.
   * title string Chat title.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function createChat($access_token, $params = array()) {
    return $this->client->request('messages.createChat', $access_token, $params);
  }

  /**
   * Edits the title of a chat.
   * 
   * @param $access_token string
   * @param $params array
   * chat_id integer Chat ID.
   * title string New title of the chat.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function editChat($access_token, $params = array()) {
    return $this->client->request('messages.editChat', $access_token, $params);
  }

  /**
   * Returns a list of IDs of users participating in a chat.
   * 
   * @param $access_token string
   * @param $params array
   * chat_id integer Chat ID.
   * chat_ids array Chat IDs.
   * fields array Profile fields to return.
   * name_case string Case for declension of user name and surname: 'nom' — nominative (default), 'gen' — genitive, 'dat' — dative, 'acc' — accusative, 'ins' — instrumental, 'abl' — prepositional
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getChatUsers($access_token, $params = array()) {
    return $this->client->request('messages.getChatUsers', $access_token, $params);
  }

  /**
   * Changes the status of a user as typing in a conversation.
   * 
   * @param $access_token string
   * @param $params array
   * user_id string User ID.
   * type string 'typing' — user has started to type.
   * peer_id integer Destination ID. "For user: 'User ID', e.g. '12345'. For chat: '2000000000' + 'chat_id', e.g. '2000000001'. For community: '- community ID', e.g. '-12345'. "
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function setActivity($access_token, $params = array()) {
    return $this->client->request('messages.setActivity', $access_token, $params);
  }

  /**
   * Returns a list of the current user's conversations that match search criteria.
   * 
   * @param $access_token string
   * @param $params array
   * q string Search query string.
   * limit integer Maximum number of results.
   * fields array Profile fields to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function searchDialogs($access_token, $params = array()) {
    return $this->client->request('messages.searchDialogs', $access_token, $params);
  }

  /**
   * Adds a new user to a chat.
   * 
   * @param $access_token string
   * @param $params array
   * chat_id integer Chat ID.
   * user_id integer ID of the user to be added to the chat.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function addChatUser($access_token, $params = array()) {
    return $this->client->request('messages.addChatUser', $access_token, $params);
  }

  /**
   * Allows the current user to leave a chat or, if the current user started the chat, allows the user to remove another user from the chat.
   * 
   * @param $access_token string
   * @param $params array
   * chat_id integer Chat ID.
   * user_id string ID of the user to be removed from the chat.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function removeChatUser($access_token, $params = array()) {
    return $this->client->request('messages.removeChatUser', $access_token, $params);
  }

  /**
   * Returns a user's current status and date of last activity.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer User ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getLastActivity($access_token, $params = array()) {
    return $this->client->request('messages.getLastActivity', $access_token, $params);
  }

  /**
   * Sets a previously-uploaded picture as the cover picture of a chat.
   * 
   * @param $access_token string
   * @param $params array
   * file string Upload URL from the 'response' field returned by the [vk.com/dev/photos.getChatUploadServer|photos.getChatUploadServer] method upon successfully uploading an image.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function setChatPhoto($access_token, $params = array()) {
    return $this->client->request('messages.setChatPhoto', $access_token, $params);
  }

  /**
   * Deletes a chat's cover picture.
   * 
   * @param $access_token string
   * @param $params array
   * chat_id integer Chat ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function deleteChatPhoto($access_token, $params = array()) {
    return $this->client->request('messages.deleteChatPhoto', $access_token, $params);
  }

  /**
   * Denies sending message from community to the current user.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Group ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function denyMessagesFromGroup($access_token, $params = array()) {
    return $this->client->request('messages.denyMessagesFromGroup', $access_token, $params);
  }

  /**
   * Allows sending messages from community to the current user.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Group ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function allowMessagesFromGroup($access_token, $params = array()) {
    return $this->client->request('messages.allowMessagesFromGroup', $access_token, $params);
  }

  /**
   * Returns information whether sending messages from the community to current user is allowed.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Group ID.
   * user_id integer User ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function isMessagesFromGroupAllowed($access_token, $params = array()) {
    return $this->client->request('messages.isMessagesFromGroupAllowed', $access_token, $params);
  }
}
