<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Pages {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Returns information about a wiki page.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer Page owner ID.
   * page_id integer Wiki page ID.
   * global boolean '1' — to return information about a global wiki page
   * site_preview boolean '1' — resulting wiki page is a preview for the attached link
   * title string Wiki page title.
   * need_source boolean
   * need_html boolean '1' — to return the page as HTML,
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function get($access_token, $params = array()) {
    return $this->client->request('pages.get', $access_token, $params);
  }

  /**
   * Saves the text of a wiki page.
   * 
   * @param $access_token string
   * @param $params array
   * text string Text of the wiki page in wiki-format.
   * page_id integer Wiki page ID. The 'title' parameter can be passed instead of 'pid'.
   * group_id integer ID of the community that owns the wiki page.
   * user_id integer 
   * title string Wiki page title.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function save($access_token, $params = array()) {
    return $this->client->request('pages.save', $access_token, $params);
  }

  /**
   * Saves modified read and edit access settings for a wiki page.
   * 
   * @param $access_token string
   * @param $params array
   * page_id integer Wiki page ID.
   * group_id integer ID of the community that owns the wiki page.
   * user_id integer 
   * view integer Who can view the wiki page: '1' — only community members, '2' — all users can view the page, '0' — only community managers
   * edit integer Who can edit the wiki page: '1' — only community members, '2' — all users can edit the page, '0' — only community managers
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function saveAccess($access_token, $params = array()) {
    return $this->client->request('pages.saveAccess', $access_token, $params);
  }

  /**
   * Returns a list of all previous versions of a wiki page.
   * 
   * @param $access_token string
   * @param $params array
   * page_id integer Wiki page ID.
   * group_id integer ID of the community that owns the wiki page.
   * user_id integer 
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getHistory($access_token, $params = array()) {
    return $this->client->request('pages.getHistory', $access_token, $params);
  }

  /**
   * Returns a list of wiki pages in a group.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer ID of the community that owns the wiki page.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getTitles($access_token, $params = array()) {
    return $this->client->request('pages.getTitles', $access_token, $params);
  }

  /**
   * Returns the text of one of the previous versions of a wiki page.
   * 
   * @param $access_token string
   * @param $params array
   * version_id integer 
   * group_id integer ID of the community that owns the wiki page.
   * user_id integer 
   * need_html boolean '1' — to return the page as HTML
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getVersion($access_token, $params = array()) {
    return $this->client->request('pages.getVersion', $access_token, $params);
  }

  /**
   * Returns HTML representation of the wiki markup.
   * 
   * @param $access_token string
   * @param $params array
   * text string Text of the wiki page.
   * group_id integer ID of the group in the context of which this markup is interpreted.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function parseWiki($access_token, $params = array()) {
    return $this->client->request('pages.parseWiki', $access_token, $params);
  }

  /**
   * Allows to clear the cache of particular 'external' pages which may be attached to VK posts.
   * 
   * @param $access_token string
   * @param $params array
   * url string Address of the page where you need to refesh the cached version
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function clearCache($access_token, $params = array()) {
    return $this->client->request('pages.clearCache', $access_token, $params);
  }
}
