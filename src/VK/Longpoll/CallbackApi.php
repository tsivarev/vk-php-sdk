<?php

namespace VK\Longpoll;

class CallbackApi {
    protected const TYPE_KEY = 'type';
    protected const OBJECT_KEY = 'object';

    protected const CALLBACK_EVENT_MESSAGE_NEW = 'message_new';
    protected const CALLBACK_EVENT_MESSAGE_REPLY = 'message_reply';
    protected const CALLBACK_EVENT_MESSAGE_ALLOW = 'message_allow';
    protected const CALLBACK_EVENT_MESSAGE_DENY = 'message_deny';
    protected const CALLBACK_EVENT_PHOTO_NEW = 'photo_new';
    protected const CALLBACK_EVENT_PHOTO_COMMENT_NEW = 'photo_comment_new';
    protected const CALLBACK_EVENT_PHOTO_COMMENT_EDIT = 'photo_comment_edit';
    protected const CALLBACK_EVENT_PHOTO_COMMENT_RESTORE = 'photo_comment_restore';
    protected const CALLBACK_EVENT_PHOTO_COMMENT_DELETE = 'photo_comment_delete';
    protected const CALLBACK_EVENT_AUDIO_NEW = 'audio_new';
    protected const CALLBACK_EVENT_VIDEO_NEW = 'video_new';
    protected const CALLBACK_EVENT_VIDEO_COMMENT_NEW = 'video_comment_new';
    protected const CALLBACK_EVENT_VIDEO_COMMENT_EDIT = 'video_comment_edit';
    protected const CALLBACK_EVENT_VIDEO_COMMENT_RESTORE = 'video_comment_restore';
    protected const CALLBACK_EVENT_VIDEO_COMMENT_DELETE = 'video_comment_delete';
    protected const CALLBACK_EVENT_WALL_POST_NEW = 'wall_post_new';
    protected const CALLBACK_EVENT_WALL_REPOST = 'wall_repost';
    protected const CALLBACK_EVENT_WALL_REPLY_NEW = 'wall_reply_new';
    protected const CALLBACK_EVENT_WALL_REPLY_EDIT = 'wall_reply_edit';
    protected const CALLBACK_EVENT_WALL_REPLY_RESTORE = 'wall_reply_restore';
    protected const CALLBACK_EVENT_WALL_REPLY_DELETE = 'wall_reply_delete';
    protected const CALLBACK_EVENT_BOARD_POST_NEW = 'board_post_new';
    protected const CALLBACK_EVENT_BOARD_POST_EDIT = 'board_post_edit';
    protected const CALLBACK_EVENT_BOARD_POST_RESTORE = 'board_post_restore';
    protected const CALLBACK_EVENT_BOARD_POST_DELETE = 'board_post_delete';
    protected const CALLBACK_EVENT_MARKET_COMMENT_NEW = 'market_comment_new';
    protected const CALLBACK_EVENT_MARKET_COMMENT_EDIT = 'market_comment_edit';
    protected const CALLBACK_EVENT_MARKET_COMMENT_RESTORE = 'market_comment_restore';
    protected const CALLBACK_EVENT_MARKET_COMMENT_DELETE = 'market_comment_delete';
    protected const CALLBACK_EVENT_GROUP_LEAVE = 'group_leave';
    protected const CALLBACK_EVENT_GROUP_JOIN = 'group_join';
    protected const CALLBACK_EVENT_GROUP_CHANGE_SETTINGS = 'group_change_settings';
    protected const CALLBACK_EVENT_GROUP_CHANGE_PHOTO = 'group_change_photo';
    protected const CALLBACK_EVENT_GROUP_OFFICERS_EDIT = 'group_officers_edit';
    protected const CALLBACK_EVENT_POLL_VOTE_NEW = 'poll_vote_new';
    protected const CALLBACK_EVENT_USER_BLOCK = 'user_block';
    protected const CALLBACK_EVENT_USER_UNBLOCK = 'user_unblock';

    public function messageNew($object) {}

    public function messageReply($object) {}

    public function messageAllow($object) {}

    public function messageDeny($object) {}

    public function photoNew($object) {}

    public function photoCommentNew($object) {}

    public function photoCommentEdit($object) {}

    public function photoCommentRestore($object) {}

    public function photoCommentDelete($object) {}

    public function audioNew($object) {}

    public function videoNew($object) {}

    public function videoCommentNew($object) {}

    public function videoCommentEdit($object) {}

    public function videoCommentRestore($object) {}

    public function videoCommentDelete($object) {}

    public function wallPostNew($object) {}

    public function wallRepost($object) {}

    public function wallReplyNew($object) {}

    public function wallReplyEdit($object) {}

    public function wallReplyRestore($object) {}

    public function wallReplyDelete($object) {}

    public function boardPostNew($object) {}

    public function boardPostEdit($object) {}

    public function boardPostRestore($object) {}

    public function boardPostDelete($object) {}

    public function marketCommentNew($object) {}

    public function marketCommentEdit($object) {}

    public function marketCommentRestore($object) {}

    public function marketCommentDelete($object) {}

    public function groupLeave($object) {}

    public function groupJoin($object) {}

    public function groupChangeSettings($object) {}

    public function groupChangePhoto($object) {}

    public function groupOfficersEdit($object) {}

    public function pollVoteNew($object) {}

    public function userBlock($object) {}

    public function userUnblock($object) {}

    public function parse($event) {
        $event_type = $event[static::TYPE_KEY];
        $object = $event[static::OBJECT_KEY];

        switch ($event_type) {
            case static::CALLBACK_EVENT_MESSAGE_NEW:
                $this->messageNew($object);
                break;
            case static::CALLBACK_EVENT_MESSAGE_REPLY:
                $this->messageReply($object);
                break;
            case static::CALLBACK_EVENT_MESSAGE_ALLOW:
                $this->messageAllow($object);
                break;
            case static::CALLBACK_EVENT_MESSAGE_DENY:
                $this->messageDeny($object);
                break;
            case static::CALLBACK_EVENT_PHOTO_NEW:
                $this->photoNew($object);
                break;
            case static::CALLBACK_EVENT_PHOTO_COMMENT_NEW:
                $this->photoCommentNew($object);
                break;
            case static::CALLBACK_EVENT_PHOTO_COMMENT_EDIT:
                $this->photoCommentEdit($object);
                break;
            case static::CALLBACK_EVENT_PHOTO_COMMENT_RESTORE:
                $this->photoCommentRestore($object);
                break;
            case static::CALLBACK_EVENT_PHOTO_COMMENT_DELETE:
                $this->photoCommentDelete($object);
                break;
            case static::CALLBACK_EVENT_AUDIO_NEW:
                $this->audioNew($object);
                break;
            case static::CALLBACK_EVENT_VIDEO_NEW:
                $this->videoNew($object);
                break;
            case static::CALLBACK_EVENT_VIDEO_COMMENT_NEW:
                $this->videoCommentNew($object);
                break;
            case static::CALLBACK_EVENT_VIDEO_COMMENT_EDIT:
                $this->videoCommentEdit($object);
                break;
            case static::CALLBACK_EVENT_VIDEO_COMMENT_RESTORE:
                $this->videoCommentRestore($object);
                break;
            case static::CALLBACK_EVENT_VIDEO_COMMENT_DELETE:
                $this->videoCommentDelete($object);
                break;
            case static::CALLBACK_EVENT_WALL_POST_NEW:
                $this->wallPostNew($object);
                break;
            case static::CALLBACK_EVENT_WALL_REPOST:
                $this->wallRepost($object);
                break;
            case static::CALLBACK_EVENT_WALL_REPLY_NEW:
                $this->wallReplyNew($object);
                break;
            case static::CALLBACK_EVENT_WALL_REPLY_EDIT:
                $this->wallReplyEdit($object);
                break;
            case static::CALLBACK_EVENT_WALL_REPLY_RESTORE:
                $this->wallReplyRestore($object);
                break;
            case static::CALLBACK_EVENT_WALL_REPLY_DELETE:
                $this->wallReplyDelete($object);
                break;
            case static::CALLBACK_EVENT_BOARD_POST_NEW:
                $this->boardPostNew($object);
                break;
            case static::CALLBACK_EVENT_BOARD_POST_EDIT:
                $this->boardPostEdit($object);
                break;
            case static::CALLBACK_EVENT_BOARD_POST_RESTORE:
                $this->boardPostRestore($object);
                break;
            case static::CALLBACK_EVENT_BOARD_POST_DELETE:
                $this->boardPostDelete($object);
                break;
            case static::CALLBACK_EVENT_MARKET_COMMENT_NEW:
                $this->marketCommentNew($object);
                break;
            case static::CALLBACK_EVENT_MARKET_COMMENT_EDIT:
                $this->marketCommentEdit($object);
                break;
            case static::CALLBACK_EVENT_MARKET_COMMENT_RESTORE:
                $this->marketCommentRestore($object);
                break;
            case static::CALLBACK_EVENT_MARKET_COMMENT_DELETE:
                $this->marketCommentDelete($object);
                break;
            case static::CALLBACK_EVENT_GROUP_LEAVE:
                $this->groupLeave($object);
                break;
            case static::CALLBACK_EVENT_GROUP_JOIN:
                $this->groupJoin($object);
                break;
            case static::CALLBACK_EVENT_GROUP_CHANGE_SETTINGS:
                $this->groupChangeSettings($object);
                break;
            case static::CALLBACK_EVENT_GROUP_CHANGE_PHOTO:
                $this->groupChangePhoto($object);
                break;
            case static::CALLBACK_EVENT_GROUP_OFFICERS_EDIT:
                $this->groupOfficersEdit($object);
                break;
            case static::CALLBACK_EVENT_POLL_VOTE_NEW:
                $this->pollVoteNew($object);
                break;
            case static::CALLBACK_EVENT_USER_BLOCK:
                $this->userBlock($object);
                break;
            case static::CALLBACK_EVENT_USER_UNBLOCK:
                $this->userUnblock($object);
                break;
        }
    }
}
