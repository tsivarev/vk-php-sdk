<?php

namespace VK\Client;

use VK\OAuth\OAuthClient;
use VK\Actions\Account;
use VK\Actions\Ads;
use VK\Actions\Apps;
use VK\Actions\Auth;
use VK\Actions\Board;
use VK\Actions\Database;
use VK\Actions\Docs;
use VK\Actions\Fave;
use VK\Actions\Friends;
use VK\Actions\Gifts;
use VK\Actions\Groups;
use VK\Actions\Leads;
use VK\Actions\Likes;
use VK\Actions\Market;
use VK\Actions\Messages;
use VK\Actions\Newsfeed;
use VK\Actions\Notes;
use VK\Actions\Notifications;
use VK\Actions\Orders;
use VK\Actions\Pages;
use VK\Actions\Photos;
use VK\Actions\Places;
use VK\Actions\Polls;
use VK\Actions\Search;
use VK\Actions\Secure;
use VK\Actions\Stats;
use VK\Actions\Status;
use VK\Actions\Storage;
use VK\Actions\Streaming;
use VK\Actions\Users;
use VK\Actions\Utils;
use VK\Actions\Video;
use VK\Actions\Wall;
use VK\Actions\Widgets;

class VKApiClient {
    protected const VK_API_HOST = 'https://api.vk.com/method';
    protected const VK_API_VERSION = '5.69';

    /**
     * @var VKApiRequest
     **/
    private $request;

    /**
     * @var OAuthClient
     **/
    private $oauth;

    /**
     * @var Account
     **/
    private $account;

    /**
     * @var Ads
     **/
    private $ads;

    /**
     * @var Apps
     **/
    private $apps;

    /**
     * @var Auth
     **/
    private $auth;

    /**
     * @var Board
     **/
    private $board;

    /**
     * @var Database
     **/
    private $database;

    /**
     * @var Docs
     **/
    private $docs;

    /**
     * @var Fave
     **/
    private $fave;

    /**
     * @var Friends
     **/
    private $friends;

    /**
     * @var Gifts
     **/
    private $gifts;

    /**
     * @var Groups
     **/
    private $groups;

    /**
     * @var Leads
     **/
    private $leads;

    /**
     * @var Likes
     **/
    private $likes;

    /**
     * @var Market
     **/
    private $market;

    /**
     * @var Messages
     **/
    private $messages;

    /**
     * @var Newsfeed
     **/
    private $newsfeed;

    /**
     * @var Notes
     **/
    private $notes;

    /**
     * @var Notifications
     **/
    private $notifications;

    /**
     * @var Orders
     **/
    private $orders;

    /**
     * @var Pages
     **/
    private $pages;

    /**
     * @var Photos
     **/
    private $photos;

    /**
     * @var Places
     **/
    private $places;

    /**
     * @var Polls
     **/
    private $polls;

    /**
     * @var Search
     **/
    private $search;

    /**
     * @var Secure
     **/
    private $secure;

    /**
     * @var Stats
     **/
    private $stats;

    /**
     * @var Status
     **/
    private $status;

    /**
     * @var Storage
     **/
    private $storage;

    /**
     * @var Streaming
     **/
    private $streaming;

    /**
     * @var Users
     **/
    private $users;

    /**
     * @var Utils
     **/
    private $utils;

    /**
     * @var Video
     **/
    private $video;

    /**
     * @var Wall
     **/
    private $wall;

    /**
     * @var Widgets
     **/
    private $widgets;

    public function __construct() {
        $this->request = new VKApiRequest(static::VK_API_HOST, static::VK_API_VERSION);
        $this->oauth = new OAuthClient(static::VK_API_VERSION);
        $this->account = new Account($this->request);
        $this->ads = new Ads($this->request);
        $this->apps = new Apps($this->request);
        $this->auth = new Auth($this->request);
        $this->board = new Board($this->request);
        $this->database = new Database($this->request);
        $this->docs = new Docs($this->request);
        $this->fave = new Fave($this->request);
        $this->friends = new Friends($this->request);
        $this->gifts = new Gifts($this->request);
        $this->groups = new Groups($this->request);
        $this->leads = new Leads($this->request);
        $this->likes = new Likes($this->request);
        $this->market = new Market($this->request);
        $this->messages = new Messages($this->request);
        $this->newsfeed = new Newsfeed($this->request);
        $this->notes = new Notes($this->request);
        $this->notifications = new Notifications($this->request);
        $this->orders = new Orders($this->request);
        $this->pages = new Pages($this->request);
        $this->photos = new Photos($this->request);
        $this->places = new Places($this->request);
        $this->polls = new Polls($this->request);
        $this->search = new Search($this->request);
        $this->secure = new Secure($this->request);
        $this->stats = new Stats($this->request);
        $this->status = new Status($this->request);
        $this->storage = new Storage($this->request);
        $this->streaming = new Streaming($this->request);
        $this->users = new Users($this->request);
        $this->utils = new Utils($this->request);
        $this->video = new Video($this->request);
        $this->wall = new Wall($this->request);
        $this->widgets = new Widgets($this->request);
    }

    public function request() {
        return $this->request;
    }

    public function oauth() {
        return $this->oauth;
    }

    public function account() {
        return $this->account;
    }

    public function ads() {
        return $this->ads;
    }

    public function apps() {
        return $this->apps;
    }

    public function auth() {
        return $this->auth;
    }

    public function board() {
        return $this->board;
    }

    public function database() {
        return $this->database;
    }

    public function docs() {
        return $this->docs;
    }

    public function fave() {
        return $this->fave;
    }

    public function friends() {
        return $this->friends;
    }

    public function gifts() {
        return $this->gifts;
    }

    public function groups() {
        return $this->groups;
    }

    public function leads() {
        return $this->leads;
    }

    public function likes() {
        return $this->likes;
    }

    public function market() {
        return $this->market;
    }

    public function messages() {
        return $this->messages;
    }

    public function newsfeed() {
        return $this->newsfeed;
    }

    public function notes() {
        return $this->notes;
    }

    public function notifications() {
        return $this->notifications;
    }

    public function orders() {
        return $this->orders;
    }

    public function pages() {
        return $this->pages;
    }

    public function photos() {
        return $this->photos;
    }

    public function places() {
        return $this->places;
    }

    public function polls() {
        return $this->polls;
    }

    public function search() {
        return $this->search;
    }

    public function secure() {
        return $this->secure;
    }

    public function stats() {
        return $this->stats;
    }

    public function status() {
        return $this->status;
    }

    public function storage() {
        return $this->storage;
    }

    public function streaming() {
        return $this->streaming;
    }

    public function users() {
        return $this->users;
    }

    public function utils() {
        return $this->utils;
    }

    public function video() {
        return $this->video;
    }

    public function wall() {
        return $this->wall;
    }

    public function widgets() {
        return $this->widgets;
    }
}
