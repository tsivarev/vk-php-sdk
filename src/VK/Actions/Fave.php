<?php

namespace VK\Actions;

use VK\VKAPIClient;
use VK\Exceptions\VKClientException;
use VK\VKResponse;

class Fave {
    /**
     * @var VKAPIClient
     **/
    private $client;

    public function __construct($client) {
        $this->client = $client;
    }

    /**
     * Returns a list of users whom the current user has bookmarked.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer offset: Offset needed to return a specific subset of users.
     *      - integer count: Number of users to return.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getUsers($access_token, $params = array()) {
        return $this->client->request('fave.getUsers', $access_token, $params);
    }

    /**
     * Returns a list of photos that the current user has liked.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer offset: Offset needed to return a specific subset of photos.
     *      - integer count: Number of photos to return.
     *      - boolean photo_sizes: '1' — to return photo sizes in a [vk.com/dev/photo_sizes|special format].
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getPhotos($access_token, $params = array()) {
        return $this->client->request('fave.getPhotos', $access_token, $params);
    }

    /**
     * Returns a list of wall posts that the current user has liked.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer offset: Offset needed to return a specific subset of posts.
     *      - integer count: Number of posts to return.
     *      - boolean extended: '1' — to return additional 'wall', 'profiles', and 'groups' fields. By default:
     *        '0'.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getPosts($access_token, $params = array()) {
        return $this->client->request('fave.getPosts', $access_token, $params);
    }

    /**
     * Returns a list of videos that the current user has liked.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer offset: Offset needed to return a specific subset of videos.
     *      - integer count: Number of videos to return.
     *      - boolean extended: Return an additional information about videos. Also returns all owners profiles and
     *        groups.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getVideos($access_token, $params = array()) {
        return $this->client->request('fave.getVideos', $access_token, $params);
    }

    /**
     * Returns a list of links that the current user has bookmarked.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer offset: Offset needed to return a specific subset of users.
     *      - integer count: Number of results to return.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getLinks($access_token, $params = array()) {
        return $this->client->request('fave.getLinks', $access_token, $params);
    }

    /**
     * Returns market items bookmarked by current user.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer count: Number of results to return.
     *      - boolean extended: '1' – to return additional fields 'likes, can_comment, can_repost, photos'. By
     *        default: '0'.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getMarketItems($access_token, $params = array()) {
        return $this->client->request('fave.getMarketItems', $access_token, $params);
    }

    /**
     * Adds a profile to user faves.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: Profile ID.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function addUser($access_token, $params = array()) {
        return $this->client->request('fave.addUser', $access_token, $params);
    }

    /**
     * Removes a profile from user faves.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: Profile ID.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function removeUser($access_token, $params = array()) {
        return $this->client->request('fave.removeUser', $access_token, $params);
    }

    /**
     * Adds a community to user faves.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer group_id: Community ID.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function addGroup($access_token, $params = array()) {
        return $this->client->request('fave.addGroup', $access_token, $params);
    }

    /**
     * Removes a community from user faves.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer group_id: Community ID.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function removeGroup($access_token, $params = array()) {
        return $this->client->request('fave.removeGroup', $access_token, $params);
    }

    /**
     * Adds a link to user faves.
     * 
     * @param $access_token string
     * @param $params array
     *      - string link: Link URL.
     *      - string text: Description text.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function addLink($access_token, $params = array()) {
        return $this->client->request('fave.addLink', $access_token, $params);
    }

    /**
     * Removes link from the user's faves.
     * 
     * @param $access_token string
     * @param $params array
     *      - string link_id: Link ID (can be obtained by [vk.com/dev/faves.getLinks|faves.getLinks] method).
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function removeLink($access_token, $params = array()) {
        return $this->client->request('fave.removeLink', $access_token, $params);
    }
}
