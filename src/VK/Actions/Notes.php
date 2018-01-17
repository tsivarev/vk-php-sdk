<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Notes {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Returns a list of notes created by a user.
   * 
   * @param $access_token string
   * @param $params array
   * note_ids array Note IDs.
   * user_id integer Note owner ID.
   * count integer Number of notes to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function get($access_token, $params = array()) {
    return $this->client->request('notes.get', $access_token, $params);
  }

  /**
   * Returns a note by its ID.
   * 
   * @param $access_token string
   * @param $params array
   * note_id integer Note ID.
   * owner_id integer Note owner ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getById($access_token, $params = array()) {
    return $this->client->request('notes.getById', $access_token, $params);
  }

  /**
   * Creates a new note for the current user.
   * 
   * @param $access_token string
   * @param $params array
   * title string Note title.
   * text string Note text.
   * privacy_view array
   * privacy_comment array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function add($access_token, $params = array()) {
    return $this->client->request('notes.add', $access_token, $params);
  }

  /**
   * Edits a note of the current user.
   * 
   * @param $access_token string
   * @param $params array
   * note_id integer Note ID.
   * title string Note title.
   * text string Note text.
   * privacy_view array
   * privacy_comment array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function edit($access_token, $params = array()) {
    return $this->client->request('notes.edit', $access_token, $params);
  }

  /**
   * Deletes a note of the current user.
   * 
   * @param $access_token string
   * @param $params array
   * note_id integer Note ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function delete($access_token, $params = array()) {
    return $this->client->request('notes.delete', $access_token, $params);
  }

  /**
   * Returns a list of comments on a note.
   * 
   * @param $access_token string
   * @param $params array
   * note_id integer Note ID.
   * owner_id integer Note owner ID.
   * count integer Number of comments to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getComments($access_token, $params = array()) {
    return $this->client->request('notes.getComments', $access_token, $params);
  }

  /**
   * Adds a new comment on a note.
   * 
   * @param $access_token string
   * @param $params array
   * note_id integer Note ID.
   * owner_id integer Note owner ID.
   * reply_to integer ID of the user to whom the reply is addressed (if the comment is a reply to another comment).
   * message string Comment text.
   * guid string
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function createComment($access_token, $params = array()) {
    return $this->client->request('notes.createComment', $access_token, $params);
  }

  /**
   * Edits a comment on a note.
   * 
   * @param $access_token string
   * @param $params array
   * comment_id integer Comment ID.
   * owner_id integer Note owner ID.
   * message string New comment text.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function editComment($access_token, $params = array()) {
    return $this->client->request('notes.editComment', $access_token, $params);
  }

  /**
   * Deletes a comment on a note.
   * 
   * @param $access_token string
   * @param $params array
   * comment_id integer Comment ID.
   * owner_id integer Note owner ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function deleteComment($access_token, $params = array()) {
    return $this->client->request('notes.deleteComment', $access_token, $params);
  }

  /**
   * Restores a deleted comment on a note.
   * 
   * @param $access_token string
   * @param $params array
   * comment_id integer Comment ID.
   * owner_id integer Note owner ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function restoreComment($access_token, $params = array()) {
    return $this->client->request('notes.restoreComment', $access_token, $params);
  }
}
