<?php

namespace VK;

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

class VKAPIActionClient {
    /**
     * @var VKAPIClient
     **/
    private $client;

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
        $this->client = new VKAPIClient();
        $this->account = new Account($this->client);
        $this->ads = new Ads($this->client);
        $this->apps = new Apps($this->client);
        $this->auth = new Auth($this->client);
        $this->board = new Board($this->client);
        $this->database = new Database($this->client);
        $this->docs = new Docs($this->client);
        $this->fave = new Fave($this->client);
        $this->friends = new Friends($this->client);
        $this->gifts = new Gifts($this->client);
        $this->groups = new Groups($this->client);
        $this->leads = new Leads($this->client);
        $this->likes = new Likes($this->client);
        $this->market = new Market($this->client);
        $this->messages = new Messages($this->client);
        $this->newsfeed = new Newsfeed($this->client);
        $this->notes = new Notes($this->client);
        $this->notifications = new Notifications($this->client);
        $this->orders = new Orders($this->client);
        $this->pages = new Pages($this->client);
        $this->photos = new Photos($this->client);
        $this->places = new Places($this->client);
        $this->polls = new Polls($this->client);
        $this->search = new Search($this->client);
        $this->secure = new Secure($this->client);
        $this->stats = new Stats($this->client);
        $this->status = new Status($this->client);
        $this->storage = new Storage($this->client);
        $this->streaming = new Streaming($this->client);
        $this->users = new Users($this->client);
        $this->utils = new Utils($this->client);
        $this->video = new Video($this->client);
        $this->wall = new Wall($this->client);
        $this->widgets = new Widgets($this->client);
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
