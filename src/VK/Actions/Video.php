<?php

namespace VK\Actions;

use VK\VKAPIClient;

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
   * owner_id integer ID of the user or community that owns the video(s).
   * videos array Video IDs, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", Use a negative value to designate a community ID. Example: "-4363_136089719,13245770_137352259"
   * album_id integer ID of the album containing the video(s).
   * count integer Number of videos to return.
   * offset integer Offset needed to return a specific subset of videos.
   * extended boolean '1' — to return an extended response with additional fields
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * owner_id integer ID of the user or community that owns the video.
   * video_id integer Video ID.
   * name string New video title.
   * desc string New video description.
   * privacy_view array Privacy settings in a [vk.com/dev/privacy_setting|special format]. Privacy setting is available for videos uploaded to own profile by user.
   * privacy_comment array Privacy settings for comments in a [vk.com/dev/privacy_setting|special format].
   * no_comments boolean Disable comments for the group video.
   * repeat boolean '1' — to repeat the playback of the video, '0' — to play the video once,
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * target_id integer identifier of a user or community to add a video to. Use a negative value to designate a community ID.
   * video_id integer Video ID.
   * owner_id integer ID of the user or community that owns the video. Use a negative value to designate a community ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * name string Name of the video.
   * description string Description of the video.
   * is_private boolean '1' — to designate the video as private (send it via a private message), the video will not appear on the user's video list and will not be available by ID for other users, '0' — not to designate the video as private
   * wallpost boolean '1' — to post the saved video on a user's wall, '0' — not to post the saved video on a user's wall
   * link string URL for embedding the video from an external website.
   * group_id integer ID of the community in which the video will be saved. By default, the current user's page.
   * album_id integer ID of the album to which the saved video will be added.
   * privacy_view array
   * privacy_comment array
   * no_comments boolean
   * repeat boolean '1' — to repeat the playback of the video, '0' — to play the video once,
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * video_id integer Video ID.
   * owner_id integer ID of the user or community that owns the video.
   * target_id integer
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * video_id integer Video ID.
   * owner_id integer ID of the user or community that owns the video.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * q string Search query string (e.g., 'The Beatles').
   * sort integer Sort order: '1' — by duration, '2' — by relevance, '0' — by date added
   * hd integer If not null, only searches for high-definition videos.
   * adult boolean '1' — to disable the Safe Search filter, '0' — to enable the Safe Search filter
   * filters array Filters to apply: 'youtube' — return YouTube videos only, 'vimeo' — return Vimeo videos only, 'short' — return short videos only, 'long' — return long videos only
   * search_own boolean 
   * offset integer Offset needed to return a specific subset of videos.
   * longer integer
   * shorter integer
   * count integer Number of videos to return.
   * extended boolean 
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * user_id integer User ID.
   * offset integer Offset needed to return a specific subset of videos.
   * count integer Number of videos to return.
   * extended boolean 
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * owner_id integer ID of the user or community that owns the video album(s).
   * offset integer Offset needed to return a specific subset of video albums.
   * count integer Number of video albums to return.
   * extended boolean '1' — to return additional information about album privacy settings for the current user
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * owner_id integer identifier of a user or community to add a video to. Use a negative value to designate a community ID.
   * album_id integer Album ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * group_id integer Community ID (if the album will be created in a community).
   * title string Album title.
   * privacy array new access permissions for the album. Possible values: , *'0' – all users,, *'1' – friends only,, *'2' – friends and friends of friends,, *'3' – "only me".
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * group_id integer Community ID (if the album edited is owned by a community).
   * album_id integer Album ID.
   * title string New album title.
   * privacy array new access permissions for the album. Possible values: , *'0' – all users,, *'1' – friends only,, *'2' – friends and friends of friends,, *'3' – "only me".
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * group_id integer Community ID (if the album is owned by a community).
   * album_id integer Album ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * owner_id integer ID of the user or community that owns the albums..
   * album_id integer Album ID.
   * before integer ID of the album before which the album in question shall be placed.
   * after integer ID of the album after which the album in question shall be placed.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * target_id integer ID of the user or community that owns the album with videos.
   * album_id integer ID of the video album.
   * owner_id integer ID of the user or community that owns the video.
   * video_id integer ID of the video.
   * before_owner_id integer ID of the user or community that owns the video before which the video in question shall be placed.
   * before_video_id integer ID of the video before which the video in question shall be placed.
   * after_owner_id integer ID of the user or community that owns the video after which the photo in question shall be placed.
   * after_video_id integer ID of the video after which the photo in question shall be placed.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * target_id integer
   * album_id integer
   * album_ids array
   * owner_id integer
   * video_id integer
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * target_id integer
   * album_id integer
   * album_ids array
   * owner_id integer
   * video_id integer
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * target_id integer
   * owner_id integer
   * video_id integer
   * extended boolean 
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * owner_id integer ID of the user or community that owns the video.
   * video_id integer Video ID.
   * need_likes boolean '1' — to return an additional 'likes' field
   * start_comment_id integer
   * offset integer Offset needed to return a specific subset of comments.
   * count integer Number of comments to return.
   * sort string Sort order: 'asc' — oldest comment first, 'desc' — newest comment first
   * extended boolean
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * owner_id integer ID of the user or community that owns the video.
   * video_id integer Video ID.
   * message string New comment text.
   * attachments array List of objects attached to the comment, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media attachment owner. '<media_id>' — Media attachment ID. Example: "photo100172_166443618,photo66748_265827614"
   * from_group boolean '1' — to post the comment from a community name (only if 'owner_id'<0)
   * reply_to_comment integer 
   * sticker_id integer
   * guid string
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * owner_id integer ID of the user or community that owns the video.
   * comment_id integer ID of the comment to be deleted.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * owner_id integer ID of the user or community that owns the video.
   * comment_id integer ID of the deleted comment.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * owner_id integer ID of the user or community that owns the video.
   * comment_id integer Comment ID.
   * message string New comment text.
   * attachments array List of objects attached to the comment, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — ID of the media attachment owner. '<media_id>' — Media attachment ID. Example: "photo100172_166443618,photo66748_265827614"
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * owner_id integer ID of the user or community that owns the video.
   * video_id integer Video ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * user_id integer ID of the user to be tagged.
   * owner_id integer ID of the user or community that owns the video.
   * video_id integer Video ID.
   * tagged_name string Tag text.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * tag_id integer Tag ID.
   * owner_id integer ID of the user or community that owns the video.
   * video_id integer Video ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * offset integer Offset needed to return a specific subset of videos.
   * count integer Number of videos to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * owner_id integer ID of the user or community that owns the video.
   * video_id integer Video ID.
   * reason integer Reason for the complaint: '0' – spam, '1' – child pornography, '2' – extremism, '3' – violence, '4' – drug propaganda, '5' – adult material, '6' – insult, abuse
   * comment string Comment describing the complaint.
   * search_query string (If the video was found in search results.) Search query string.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * owner_id integer ID of the user or community that owns the video.
   * comment_id integer ID of the comment being reported.
   * reason integer Reason for the complaint: , 0 – spam , 1 – child pornography , 2 – extremism , 3 – violence , 4 – drug propaganda , 5 – adult material , 6 – insult, abuse
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * count integer number of catalog blocks to return.
   * items_count integer number of videos in each block.
   * from string parameter for requesting the next results page. Value for transmitting here is returned in the 'next' field in a reply.
   * filters array list of requested catalog sections
   * extended boolean 1 – return additional infor about users and communities in profiles and groups fields.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * section_id string 'id' value returned with a block by the '' method.
   * from string 'next' value returned with a block by the '' method.
   * count integer number of blocks to return.
   * extended boolean 1 – return additional infor about users and communities in profiles and groups fields.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
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
   * section_id integer 'id' value returned with a block to hide by the '' method.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function hideCatalogSection($access_token, $params = array()) {
    return $this->client->request('video.hideCatalogSection', $access_token, $params);
  }
}
