<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Docs {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Returns detailed information about user or community documents.
   * 
   * @param $access_token string
   * @param $params array
   * count integer Number of documents to return. By default, all documents.
   * offset integer Offset needed to return a specific subset of documents.
   * owner_id integer ID of the user or community that owns the documents. Use a negative value to designate a community ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function get($access_token, $params = array()) {
    return $this->client->request('docs.get', $access_token, $params);
  }

  /**
   * Returns information about documents by their IDs.
   * 
   * @param $access_token string
   * @param $params array
   * docs array Document IDs. Example: , "66748_91488,66748_91455",
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getById($access_token, $params = array()) {
    return $this->client->request('docs.getById', $access_token, $params);
  }

  /**
   * Returns the server address for document upload.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID (if the document will be uploaded to the community).
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getUploadServer($access_token, $params = array()) {
    return $this->client->request('docs.getUploadServer', $access_token, $params);
  }

  /**
   * Returns the server address for document upload onto a user's or community's wall.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID (if the document will be uploaded to the community).
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getWallUploadServer($access_token, $params = array()) {
    return $this->client->request('docs.getWallUploadServer', $access_token, $params);
  }

  /**
   * Saves a document after [vk.com/dev/upload_files_2|uploading it to a server].
   * 
   * @param $access_token string
   * @param $params array
   * file string This parameter is returned when the file is [vk.com/dev/upload_files_2|uploaded to the server].
   * title string Document title.
   * tags string Document tags.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function save($access_token, $params = array()) {
    return $this->client->request('docs.save', $access_token, $params);
  }

  /**
   * Deletes a user or community document.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the document. Use a negative value to designate a community ID.
   * doc_id integer Document ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function delete($access_token, $params = array()) {
    return $this->client->request('docs.delete', $access_token, $params);
  }

  /**
   * Copies a document to a user's or community's document list.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the document. Use a negative value to designate a community ID.
   * doc_id integer Document ID.
   * access_key string Access key. This parameter is required if 'access_key' was returned with the document's data.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function add($access_token, $params = array()) {
    return $this->client->request('docs.add', $access_token, $params);
  }

  /**
   * Returns documents types available for current user.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the documents. Use a negative value to designate a community ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getTypes($access_token, $params = array()) {
    return $this->client->request('docs.getTypes', $access_token, $params);
  }

  /**
   * Returns a list of documents matching the search criteria.
   * 
   * @param $access_token string
   * @param $params array
   * q string Search query string.
   * count integer Number of results to return.
   * offset integer Offset needed to return a specific subset of results.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function search($access_token, $params = array()) {
    return $this->client->request('docs.search', $access_token, $params);
  }

  /**
   * Edits a document.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer User ID or community ID. Use a negative value to designate a community ID.
   * doc_id integer Document ID.
   * title string Document title.
   * tags array Document tags.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function edit($access_token, $params = array()) {
    return $this->client->request('docs.edit', $access_token, $params);
  }
}
