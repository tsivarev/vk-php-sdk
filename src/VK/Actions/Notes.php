<?php

namespace VK\Actions;

use VK\VKAPIClient;
use VK\Exceptions\VKClientException;
use VK\VKResponse;

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
     *      - array note_ids: Note IDs.
     *      - integer user_id: Note owner ID.
     *      - integer count: Number of notes to return.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer note_id: Note ID.
     *      - integer owner_id: Note owner ID.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - string title: Note title.
     *      - string text: Note text.
     *      - array privacy_view:
     *      - array privacy_comment:
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer note_id: Note ID.
     *      - string title: Note title.
     *      - string text: Note text.
     *      - array privacy_view:
     *      - array privacy_comment:
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer note_id: Note ID.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer note_id: Note ID.
     *      - integer owner_id: Note owner ID.
     *      - integer count: Number of comments to return.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer note_id: Note ID.
     *      - integer owner_id: Note owner ID.
     *      - integer reply_to: ID of the user to whom the reply is addressed (if the comment is a reply to another
     *        comment).
     *      - string message: Comment text.
     *      - string guid:
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer comment_id: Comment ID.
     *      - integer owner_id: Note owner ID.
     *      - string message: New comment text.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer comment_id: Comment ID.
     *      - integer owner_id: Note owner ID.
     * 
     * @return VKResponse
     * @throws VKClientException
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
     *      - integer comment_id: Comment ID.
     *      - integer owner_id: Note owner ID.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function restoreComment($access_token, $params = array()) {
        return $this->client->request('notes.restoreComment', $access_token, $params);
    }
}
