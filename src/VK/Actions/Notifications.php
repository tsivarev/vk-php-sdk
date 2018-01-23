<?php

namespace VK\Actions;

use VK\VKAPIClient;
use VK\Exceptions\VKClientException;
use VK\VKResponse;

class Notifications {
    /**
     * @var VKAPIClient
     **/
    private $client;

    public function __construct($client) {
        $this->client = $client;
    }

    /**
     * Returns a list of notifications about other users' feedback to the current user's wall posts.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer count: Number of notifications to return.
     *      - string start_from:
     *      - array filters: Type of notifications to return: 'wall' — wall posts, 'mentions' — mentions in
     *        wall posts, comments, or topics, 'comments' — comments to wall posts, photos, and videos, 'likes' —
     *        likes, 'reposted' — wall posts that are copied from the current user's wall, 'followers' — new
     *        followers, 'friends' — accepted friend requests
     *      - integer start_time: Earliest timestamp (in Unix time) of a notification to return. By default, 24
     *        hours ago.
     *      - integer end_time: Latest timestamp (in Unix time) of a notification to return. By default, the
     *        current time.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function get($access_token, $params = array()) {
        return $this->client->request('notifications.get', $access_token, $params);
    }

    /**
     * Resets the counter of new notifications about other users' feedback to the current user's wall posts.
     * 
     * @param $access_token string
     * @param $params array
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function markAsViewed($access_token, $params = array()) {
        return $this->client->request('notifications.markAsViewed', $access_token, $params);
    }
}
