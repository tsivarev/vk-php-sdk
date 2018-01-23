<?php

namespace VK\Actions;

use VK\VKAPIClient;
use VK\Exceptions\VKClientException;
use VK\VKResponse;
use VK\Actions\Enums\VideoSearchSort;
use VK\Actions\Enums\VideoGetCommentsSort;
use VK\Actions\Enums\VideoReportReason;
use VK\Actions\Enums\VideoReportCommentReason;

class Video {
    /**
     * @var VKAPIClient
     **/
    private $client;

    public function __construct($client) {
        $this->client = $client;
    }

    /**
     * Returns detailed information about videos.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer owner_id: ID of the user or community that owns the video(s).
     *      - array videos: Video IDs, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", Use
     *        a negative value to designate a community ID. Example: "-4363_136089719,13245770_137352259"
     *      - integer album_id: ID of the album containing the video(s).
     *      - integer count: Number of videos to return.
     *      - integer offset: Offset needed to return a specific subset of videos.
     *      - boolean extended: '1' — to return an extended response with additional fields
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function get($access_token, $params = array()) {
        return $this->client->request('video.get', $access_token, $params);
    }

    /**
     * Edits information about a video on a user or community page.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer owner_id: ID of the user or community that owns the video.
     *      - integer video_id: Video ID.
     *      - string name: New video title.
     *      - string desc: New video description.
     *      - array privacy_view: Privacy settings in a [vk.com/dev/privacy_setting|special format]. Privacy
     *        setting is available for videos uploaded to own profile by user.
     *      - array privacy_comment: Privacy settings for comments in a [vk.com/dev/privacy_setting|special
     *        format].
     *      - boolean no_comments: Disable comments for the group video.
     *      - boolean repeat: '1' — to repeat the playback of the video, '0' — to play the video once,
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function edit($access_token, $params = array()) {
        return $this->client->request('video.edit', $access_token, $params);
    }

    /**
     * Adds a video to a user or community page.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer target_id: identifier of a user or community to add a video to. Use a negative value to
     *        designate a community ID.
     *      - integer video_id: Video ID.
     *      - integer owner_id: ID of the user or community that owns the video. Use a negative value to designate
     *        a community ID.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function add($access_token, $params = array()) {
        return $this->client->request('video.add', $access_token, $params);
    }

    /**
     * Returns a server address (required for upload) and video data.
     * 
     * @param $access_token string
     * @param $params array
     *      - string name: Name of the video.
     *      - string description: Description of the video.
     *      - boolean is_private: '1' — to designate the video as private (send it via a private message), the
     *        video will not appear on the user's video list and will not be available by ID for other users, '0' — not
     *        to designate the video as private
     *      - boolean wallpost: '1' — to post the saved video on a user's wall, '0' — not to post the saved
     *        video on a user's wall
     *      - string link: URL for embedding the video from an external website.
     *      - integer group_id: ID of the community in which the video will be saved. By default, the current
     *        user's page.
     *      - integer album_id: ID of the album to which the saved video will be added.
     *      - array privacy_view:
     *      - array privacy_comment:
     *      - boolean no_comments:
     *      - boolean repeat: '1' — to repeat the playback of the video, '0' — to play the video once,
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function save($access_token, $params = array()) {
        return $this->client->request('video.save', $access_token, $params);
    }

    /**
     * Deletes a video from a user or community page.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer video_id: Video ID.
     *      - integer owner_id: ID of the user or community that owns the video.
     *      - integer target_id:
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function delete($access_token, $params = array()) {
        return $this->client->request('video.delete', $access_token, $params);
    }

    /**
     * Restores a previously deleted video.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer video_id: Video ID.
     *      - integer owner_id: ID of the user or community that owns the video.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function restore($access_token, $params = array()) {
        return $this->client->request('video.restore', $access_token, $params);
    }

    /**
     * Returns a list of videos under the set search criterion.
     * 
     * @param $access_token string
     * @param $params array
     *      - string q: Search query string (e.g., 'The Beatles').
     *      - VideoSearchSort sort: Sort order: '1' — by duration, '2' — by relevance, '0' — by date added
     *        @see VideoSearchSort
     *      - integer hd: If not null, only searches for high-definition videos.
     *      - boolean adult: '1' — to disable the Safe Search filter, '0' — to enable the Safe Search filter
     *      - array filters: Filters to apply: 'youtube' — return YouTube videos only, 'vimeo' — return Vimeo
     *        videos only, 'short' — return short videos only, 'long' — return long videos only
     *      - boolean search_own: 
     *      - integer offset: Offset needed to return a specific subset of videos.
     *      - integer longer:
     *      - integer shorter:
     *      - integer count: Number of videos to return.
     *      - boolean extended: 
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function search($access_token, $params = array()) {
        return $this->client->request('video.search', $access_token, $params);
    }

    /**
     * Returns list of videos in which the user is tagged.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: User ID.
     *      - integer offset: Offset needed to return a specific subset of videos.
     *      - integer count: Number of videos to return.
     *      - boolean extended: 
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getUserVideos($access_token, $params = array()) {
        return $this->client->request('video.getUserVideos', $access_token, $params);
    }

    /**
     * Returns a list of video albums owned by a user or community.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer owner_id: ID of the user or community that owns the video album(s).
     *      - integer offset: Offset needed to return a specific subset of video albums.
     *      - integer count: Number of video albums to return.
     *      - boolean extended: '1' — to return additional information about album privacy settings for the
     *        current user
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getAlbums($access_token, $params = array()) {
        return $this->client->request('video.getAlbums', $access_token, $params);
    }

    /**
     * Returns video album info
     * 
     * @param $access_token string
     * @param $params array
     *      - integer owner_id: identifier of a user or community to add a video to. Use a negative value to
     *        designate a community ID.
     *      - integer album_id: Album ID.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getAlbumById($access_token, $params = array()) {
        return $this->client->request('video.getAlbumById', $access_token, $params);
    }

    /**
     * Creates an empty album for videos.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer group_id: Community ID (if the album will be created in a community).
     *      - string title: Album title.
     *      - array privacy: new access permissions for the album. Possible values: , *'0' – all users,, *'1' –
     *        friends only,, *'2' – friends and friends of friends,, *'3' – "only me".
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function addAlbum($access_token, $params = array()) {
        return $this->client->request('video.addAlbum', $access_token, $params);
    }

    /**
     * Edits the title of a video album.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer group_id: Community ID (if the album edited is owned by a community).
     *      - integer album_id: Album ID.
     *      - string title: New album title.
     *      - array privacy: new access permissions for the album. Possible values: , *'0' – all users,, *'1' –
     *        friends only,, *'2' – friends and friends of friends,, *'3' – "only me".
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function editAlbum($access_token, $params = array()) {
        return $this->client->request('video.editAlbum', $access_token, $params);
    }

    /**
     * Deletes a video album.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer group_id: Community ID (if the album is owned by a community).
     *      - integer album_id: Album ID.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function deleteAlbum($access_token, $params = array()) {
        return $this->client->request('video.deleteAlbum', $access_token, $params);
    }

    /**
     * Reorders the album in the list of user video albums.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer owner_id: ID of the user or community that owns the albums..
     *      - integer album_id: Album ID.
     *      - integer before: ID of the album before which the album in question shall be placed.
     *      - integer after: ID of the album after which the album in question shall be placed.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function reorderAlbums($access_token, $params = array()) {
        return $this->client->request('video.reorderAlbums', $access_token, $params);
    }

    /**
     * Reorders the video in the video album.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer target_id: ID of the user or community that owns the album with videos.
     *      - integer album_id: ID of the video album.
     *      - integer owner_id: ID of the user or community that owns the video.
     *      - integer video_id: ID of the video.
     *      - integer before_owner_id: ID of the user or community that owns the video before which the video in
     *        question shall be placed.
     *      - integer before_video_id: ID of the video before which the video in question shall be placed.
     *      - integer after_owner_id: ID of the user or community that owns the video after which the photo in
     *        question shall be placed.
     *      - integer after_video_id: ID of the video after which the photo in question shall be placed.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function reorderVideos($access_token, $params = array()) {
        return $this->client->request('video.reorderVideos', $access_token, $params);
    }

    /**
     * 
     * 
     * @param $access_token string
     * @param $params array
     *      - integer target_id:
     *      - integer album_id:
     *      - array album_ids:
     *      - integer owner_id:
     *      - integer video_id:
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function addToAlbum($access_token, $params = array()) {
        return $this->client->request('video.addToAlbum', $access_token, $params);
    }

    /**
     * 
     * 
     * @param $access_token string
     * @param $params array
     *      - integer target_id:
     *      - integer album_id:
     *      - array album_ids:
     *      - integer owner_id:
     *      - integer video_id:
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function removeFromAlbum($access_token, $params = array()) {
        return $this->client->request('video.removeFromAlbum', $access_token, $params);
    }

    /**
     * 
     * 
     * @param $access_token string
     * @param $params array
     *      - integer target_id:
     *      - integer owner_id:
     *      - integer video_id:
     *      - boolean extended: 
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getAlbumsByVideo($access_token, $params = array()) {
        return $this->client->request('video.getAlbumsByVideo', $access_token, $params);
    }

    /**
     * Returns a list of comments on a video.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer owner_id: ID of the user or community that owns the video.
     *      - integer video_id: Video ID.
     *      - boolean need_likes: '1' — to return an additional 'likes' field
     *      - integer start_comment_id:
     *      - integer offset: Offset needed to return a specific subset of comments.
     *      - integer count: Number of comments to return.
     *      - VideoGetCommentsSort sort: Sort order: 'asc' — oldest comment first, 'desc' — newest comment
     *        first
     *        @see VideoGetCommentsSort
     *      - boolean extended:
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getComments($access_token, $params = array()) {
        return $this->client->request('video.getComments', $access_token, $params);
    }

    /**
     * Adds a new comment on a video.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer owner_id: ID of the user or community that owns the video.
     *      - integer video_id: Video ID.
     *      - string message: New comment text.
     *      - array attachments: List of objects attached to the comment, in the following format:
     *        "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video'
     *        — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media attachment owner.
     *        '<media_id>' — Media attachment ID. Example: "photo100172_166443618,photo66748_265827614"
     *      - boolean from_group: '1' — to post the comment from a community name (only if 'owner_id'<0)
     *      - integer reply_to_comment: 
     *      - integer sticker_id:
     *      - string guid:
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function createComment($access_token, $params = array()) {
        return $this->client->request('video.createComment', $access_token, $params);
    }

    /**
     * Deletes a comment on a video.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer owner_id: ID of the user or community that owns the video.
     *      - integer comment_id: ID of the comment to be deleted.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function deleteComment($access_token, $params = array()) {
        return $this->client->request('video.deleteComment', $access_token, $params);
    }

    /**
     * Restores a previously deleted comment on a video.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer owner_id: ID of the user or community that owns the video.
     *      - integer comment_id: ID of the deleted comment.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function restoreComment($access_token, $params = array()) {
        return $this->client->request('video.restoreComment', $access_token, $params);
    }

    /**
     * Edits the text of a comment on a video.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer owner_id: ID of the user or community that owns the video.
     *      - integer comment_id: Comment ID.
     *      - string message: New comment text.
     *      - array attachments: List of objects attached to the comment, in the following format:
     *        "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video'
     *        — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media attachment owner.
     *        '<media_id>' — Media attachment ID. Example: "photo100172_166443618,photo66748_265827614"
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function editComment($access_token, $params = array()) {
        return $this->client->request('video.editComment', $access_token, $params);
    }

    /**
     * Returns a list of tags on a video.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer owner_id: ID of the user or community that owns the video.
     *      - integer video_id: Video ID.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getTags($access_token, $params = array()) {
        return $this->client->request('video.getTags', $access_token, $params);
    }

    /**
     * Adds a tag on a video.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: ID of the user to be tagged.
     *      - integer owner_id: ID of the user or community that owns the video.
     *      - integer video_id: Video ID.
     *      - string tagged_name: Tag text.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function putTag($access_token, $params = array()) {
        return $this->client->request('video.putTag', $access_token, $params);
    }

    /**
     * Removes a tag from a video.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer tag_id: Tag ID.
     *      - integer owner_id: ID of the user or community that owns the video.
     *      - integer video_id: Video ID.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function removeTag($access_token, $params = array()) {
        return $this->client->request('video.removeTag', $access_token, $params);
    }

    /**
     * Returns a list of videos with tags that have not been viewed.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer offset: Offset needed to return a specific subset of videos.
     *      - integer count: Number of videos to return.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getNewTags($access_token, $params = array()) {
        return $this->client->request('video.getNewTags', $access_token, $params);
    }

    /**
     * Reports (submits a complaint about) a video.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer owner_id: ID of the user or community that owns the video.
     *      - integer video_id: Video ID.
     *      - VideoReportReason reason: Reason for the complaint: '0' – spam, '1' – child pornography, '2' –
     *        extremism, '3' – violence, '4' – drug propaganda, '5' – adult material, '6' – insult, abuse
     *        @see VideoReportReason
     *      - string comment: Comment describing the complaint.
     *      - string search_query: (If the video was found in search results.) Search query string.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function report($access_token, $params = array()) {
        return $this->client->request('video.report', $access_token, $params);
    }

    /**
     * Reports (submits a complaint about) a comment on a video.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer owner_id: ID of the user or community that owns the video.
     *      - integer comment_id: ID of the comment being reported.
     *      - VideoReportCommentReason reason: Reason for the complaint: , 0 – spam , 1 – child pornography , 2
     *        – extremism , 3 – violence , 4 – drug propaganda , 5 – adult material , 6 – insult, abuse
     *        @see VideoReportCommentReason
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function reportComment($access_token, $params = array()) {
        return $this->client->request('video.reportComment', $access_token, $params);
    }

    /**
     * Returns video catalog
     * 
     * @param $access_token string
     * @param $params array
     *      - integer count: number of catalog blocks to return.
     *      - integer items_count: number of videos in each block.
     *      - string from: parameter for requesting the next results page. Value for transmitting here is returned
     *        in the 'next' field in a reply.
     *      - array filters: list of requested catalog sections
     *      - boolean extended: 1 – return additional infor about users and communities in profiles and groups
     *        fields.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getCatalog($access_token, $params = array()) {
        return $this->client->request('video.getCatalog', $access_token, $params);
    }

    /**
     * Returns a separate catalog section
     * 
     * @param $access_token string
     * @param $params array
     *      - string section_id: 'id' value returned with a block by the '' method.
     *      - string from: 'next' value returned with a block by the '' method.
     *      - integer count: number of blocks to return.
     *      - boolean extended: 1 – return additional infor about users and communities in profiles and groups
     *        fields.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getCatalogSection($access_token, $params = array()) {
        return $this->client->request('video.getCatalogSection', $access_token, $params);
    }

    /**
     * Hides a video catalog section from a user.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer section_id: 'id' value returned with a block to hide by the '' method.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function hideCatalogSection($access_token, $params = array()) {
        return $this->client->request('video.hideCatalogSection', $access_token, $params);
    }
}
