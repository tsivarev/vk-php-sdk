<?php

namespace VK\Actions;

use VK\VKAPIRequest;
use VK\Exceptions\VKClientException;
use VK\Exceptions\VKAPIException;

class Notifications {

    /**
     * @var VKAPIRequest
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
     * @return mixed
     * @throws VKClientException error on the API side
     * @throws VKAPIException network error
     * 
     **/
    public function get($access_token, $params = array()) {
        return $this->client->post('notifications.get', $access_token, $params);
    }

    /**
     * Resets the counter of new notifications about other users' feedback to the current user's wall posts.
     * 
     * @param $access_token string
     * @param $params array
     * 
     * @return mixed
     * @throws VKClientException error on the API side
     * @throws VKAPIException network error
     * 
     **/
    public function markAsViewed($access_token, $params = array()) {
        return $this->client->post('notifications.markAsViewed', $access_token, $params);
    }
}
