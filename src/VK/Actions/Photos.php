<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Photos {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Creates an empty photo album.
   * 
   * @param $access_token string
   * @param $params array
   * title string Album title.
   * group_id integer ID of the community in which the album will be created.
   * description string Album description.
   * privacy_view array
   * privacy_comment array
   * upload_by_admins_only boolean
   * comments_disabled boolean
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function createAlbum($access_token, $params = array()) {
    return $this->client->request('photos.createAlbum', $access_token, $params);
  }

  /**
   * Edits information about a photo album.
   * 
   * @param $access_token string
   * @param $params array
   * album_id integer ID of the photo album to be edited.
   * title string New album title.
   * description string New album description.
   * owner_id integer ID of the user or community that owns the album.
   * privacy_view array
   * privacy_comment array
   * upload_by_admins_only boolean
   * comments_disabled boolean
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function editAlbum($access_token, $params = array()) {
    return $this->client->request('photos.editAlbum', $access_token, $params);
  }

  /**
   * Returns a list of a user's or community's photo albums.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the albums.
   * album_ids array Album IDs.
   * offset integer Offset needed to return a specific subset of albums.
   * count integer Number of albums to return.
   * need_system boolean '1' — to return system albums with negative IDs
   * need_covers boolean '1' — to return an additional 'thumb_src' field, '0' — (default)
   * photo_sizes boolean '1' — to return photo sizes in a
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getAlbums($access_token, $params = array()) {
    return $this->client->request('photos.getAlbums', $access_token, $params);
  }

  /**
   * Returns a list of a user's or community's photos.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the photos. Use a negative value to designate a community ID.
   * album_id string Photo album ID. To return information about photos from service albums, use the following string values: 'profile, wall, saved'.
   * photo_ids array Photo IDs.
   * rev boolean Sort order: '1' — reverse chronological, '0' — chronological
   * extended boolean '1' — to return additional 'likes', 'comments', and 'tags' fields, '0' — (default)
   * feed_type string Type of feed obtained in 'feed' field of the method.
   * feed integer unixtime, that can be obtained with [vk.com/dev/newsfeed.get|newsfeed.get] method in date field to get all photos uploaded by the user on a specific day, or photos the user has been tagged on. Also, 'uid' parameter of the user the event happened with shall be specified.
   * photo_sizes boolean '1' — to return photo sizes in a [vk.com/dev/photo_sizes|special format]
   * offset integer
   * count integer
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function get($access_token, $params = array()) {
    return $this->client->request('photos.get', $access_token, $params);
  }

  /**
   * Returns the number of photo albums belonging to a user or community.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer User ID.
   * group_id integer Community ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getAlbumsCount($access_token, $params = array()) {
    return $this->client->request('photos.getAlbumsCount', $access_token, $params);
  }

  /**
   * Returns information about photos by their IDs.
   * 
   * @param $access_token string
   * @param $params array
   * photos array IDs separated with a comma, that are IDs of users who posted photos and IDs of photos themselves with an underscore character between such IDs. To get information about a photo in the group album, you shall specify group ID instead of user ID. Example: "1_129207899,6492_135055734, , -20629724_271945303"
   * extended boolean '1' — to return additional fields, '0' — (default)
   * photo_sizes boolean '1' — to return photo sizes in a
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getById($access_token, $params = array()) {
    return $this->client->request('photos.getById', $access_token, $params);
  }

  /**
   * Returns the server address for photo upload.
   * 
   * @param $access_token string
   * @param $params array
   * album_id integer Album ID.
   * group_id integer ID of community that owns the album (if the photo will be uploaded to a community album).
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getUploadServer($access_token, $params = array()) {
    return $this->client->request('photos.getUploadServer', $access_token, $params);
  }

  /**
   * Returns the server address for owner cover upload.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer ID of community that owns the album (if the photo will be uploaded to a community album).
   * crop_x integer X coordinate of the left-upper corner
   * crop_y integer Y coordinate of the left-upper corner
   * crop_x2 integer X coordinate of the right-bottom corner
   * crop_y2 integer Y coordinate of the right-bottom corner
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getOwnerCoverPhotoUploadServer($access_token, $params = array()) {
    return $this->client->request('photos.getOwnerCoverPhotoUploadServer', $access_token, $params);
  }

  /**
   * Returns an upload server address for a profile or community photo.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer identifier of a community or current user. "Note that community id must be negative. 'owner_id=1' – user, 'owner_id=-1' – community, "
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getOwnerPhotoUploadServer($access_token, $params = array()) {
    return $this->client->request('photos.getOwnerPhotoUploadServer', $access_token, $params);
  }

  /**
   * Returns an upload link for chat cover pictures.
   * 
   * @param $access_token string
   * @param $params array
   * chat_id integer ID of the chat for which you want to upload a cover photo.
   * crop_x integer 
   * crop_y integer 
   * crop_width integer Width (in pixels) of the photo after cropping.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getChatUploadServer($access_token, $params = array()) {
    return $this->client->request('photos.getChatUploadServer', $access_token, $params);
  }

  /**
   * Returns the server address for market photo upload.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * main_photo boolean '1' if you want to upload the main item photo.
   * crop_x integer X coordinate of the crop left upper corner.
   * crop_y integer Y coordinate of the crop left upper corner.
   * crop_width integer Width of the cropped photo in px.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getMarketUploadServer($access_token, $params = array()) {
    return $this->client->request('photos.getMarketUploadServer', $access_token, $params);
  }

  /**
   * Returns the server address for market album photo upload.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getMarketAlbumUploadServer($access_token, $params = array()) {
    return $this->client->request('photos.getMarketAlbumUploadServer', $access_token, $params);
  }

  /**
   * Saves market photos after successful uploading.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * photo string Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
   * server integer Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
   * hash string Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
   * crop_data string Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
   * crop_hash string Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function saveMarketPhoto($access_token, $params = array()) {
    return $this->client->request('photos.saveMarketPhoto', $access_token, $params);
  }

  /**
   * Saves cover photo after successful uploading.
   * 
   * @param $access_token string
   * @param $params array
   * photo string Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
   * hash string Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function saveOwnerCoverPhoto($access_token, $params = array()) {
    return $this->client->request('photos.saveOwnerCoverPhoto', $access_token, $params);
  }

  /**
   * Saves market album photos after successful uploading.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * photo string Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
   * server integer Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
   * hash string Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function saveMarketAlbumPhoto($access_token, $params = array()) {
    return $this->client->request('photos.saveMarketAlbumPhoto', $access_token, $params);
  }

  /**
   * Saves a profile or community photo. Upload URL can be got with the [vk.com/dev/photos.getOwnerPhotoUploadServer|photos.getOwnerPhotoUploadServer] method.
   * 
   * @param $access_token string
   * @param $params array
   * server string parameter returned after [vk.com/dev/upload_files|photo upload].
   * hash string parameter returned after [vk.com/dev/upload_files|photo upload].
   * photo string parameter returned after [vk.com/dev/upload_files|photo upload].
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function saveOwnerPhoto($access_token, $params = array()) {
    return $this->client->request('photos.saveOwnerPhoto', $access_token, $params);
  }

  /**
   * Saves a photo to a user's or community's wall after being uploaded.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer ID of the user on whose wall the photo will be saved.
   * group_id integer ID of community on whose wall the photo will be saved.
   * photo string Parameter returned when the the photo is [vk.com/dev/upload_files|uploaded to the server].
   * server integer
   * hash string
   * latitude number Geographical latitude, in degrees (from '-90' to '90').
   * longitude number Geographical longitude, in degrees (from '-180' to '180').
   * caption string Text describing the photo. 2048 digits max.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function saveWallPhoto($access_token, $params = array()) {
    return $this->client->request('photos.saveWallPhoto', $access_token, $params);
  }

  /**
   * Returns the server address for photo upload onto a user's wall.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer ID of community to whose wall the photo will be uploaded.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getWallUploadServer($access_token, $params = array()) {
    return $this->client->request('photos.getWallUploadServer', $access_token, $params);
  }

  /**
   * Returns the server address for photo upload in a private message for a user.
   * 
   * @param $access_token string
   * @param $params array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getMessagesUploadServer($access_token, $params = array()) {
    return $this->client->request('photos.getMessagesUploadServer', $access_token, $params);
  }

  /**
   * Saves a photo after being successfully uploaded. URL obtained with [vk.com/dev/photos.getMessagesUploadServer|photos.getMessagesUploadServer] method.
   * 
   * @param $access_token string
   * @param $params array
   * photo string Parameter returned when the photo is [vk.com/dev/upload_files|uploaded to the server].
   * server integer
   * hash string
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function saveMessagesPhoto($access_token, $params = array()) {
    return $this->client->request('photos.saveMessagesPhoto', $access_token, $params);
  }

  /**
   * Reports (submits a complaint about) a photo.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the photo.
   * photo_id integer Photo ID.
   * reason integer Reason for the complaint: '0' – spam, '1' – child pornography, '2' – extremism, '3' – violence, '4' – drug propaganda, '5' – adult material, '6' – insult, abuse
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function report($access_token, $params = array()) {
    return $this->client->request('photos.report', $access_token, $params);
  }

  /**
   * Reports (submits a complaint about) a comment on a photo.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the photo.
   * comment_id integer ID of the comment being reported.
   * reason integer Reason for the complaint: '0' – spam, '1' – child pornography, '2' – extremism, '3' – violence, '4' – drug propaganda, '5' – adult material, '6' – insult, abuse
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function reportComment($access_token, $params = array()) {
    return $this->client->request('photos.reportComment', $access_token, $params);
  }

  /**
   * Returns a list of photos.
   * 
   * @param $access_token string
   * @param $params array
   * q string Search query string.
   * lat number Geographical latitude, in degrees (from '-90' to '90').
   * long number Geographical longitude, in degrees (from '-180' to '180').
   * start_time integer 
   * end_time integer 
   * sort integer Sort order:
   * offset integer Offset needed to return a specific subset of photos.
   * count integer Number of photos to return.
   * radius integer Radius of search in meters (works very approximately). Available values: '10', '100', '800', '6000', '50000'.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function search($access_token, $params = array()) {
    return $this->client->request('photos.search', $access_token, $params);
  }

  /**
   * Saves photos after successful uploading.
   * 
   * @param $access_token string
   * @param $params array
   * album_id integer ID of the album to save photos to.
   * group_id integer ID of the community to save photos to.
   * server integer Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
   * photos_list string Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
   * hash string Parameter returned when photos are [vk.com/dev/upload_files|uploaded to server].
   * latitude number Geographical latitude, in degrees (from '-90' to '90').
   * longitude number Geographical longitude, in degrees (from '-180' to '180').
   * caption string Text describing the photo. 2048 digits max.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function save($access_token, $params = array()) {
    return $this->client->request('photos.save', $access_token, $params);
  }

  /**
   * Allows to copy a photo to the "Saved photos" album
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer photo's owner ID
   * photo_id integer photo ID
   * access_key string for private photos
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function copy($access_token, $params = array()) {
    return $this->client->request('photos.copy', $access_token, $params);
  }

  /**
   * Edits the caption of a photo.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the photo.
   * photo_id integer Photo ID.
   * caption string New caption for the photo. If this parameter is not set, it is considered to be equal to an empty string.
   * latitude number
   * longitude number
   * place_str string
   * foursquare_id string
   * delete_place boolean
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function edit($access_token, $params = array()) {
    return $this->client->request('photos.edit', $access_token, $params);
  }

  /**
   * Moves a photo from one album to another.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the photo.
   * target_album_id integer ID of the album to which the photo will be moved.
   * photo_id integer Photo ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function move($access_token, $params = array()) {
    return $this->client->request('photos.move', $access_token, $params);
  }

  /**
   * Makes a photo into an album cover.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the photo.
   * photo_id integer Photo ID.
   * album_id integer Album ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function makeCover($access_token, $params = array()) {
    return $this->client->request('photos.makeCover', $access_token, $params);
  }

  /**
   * Reorders the album in the list of user albums.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the album.
   * album_id integer Album ID.
   * before integer ID of the album before which the album in question shall be placed.
   * after integer ID of the album after which the album in question shall be placed.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function reorderAlbums($access_token, $params = array()) {
    return $this->client->request('photos.reorderAlbums', $access_token, $params);
  }

  /**
   * Reorders the photo in the list of photos of the user album.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the photo.
   * photo_id integer Photo ID.
   * before integer ID of the photo before which the photo in question shall be placed.
   * after integer ID of the photo after which the photo in question shall be placed.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function reorderPhotos($access_token, $params = array()) {
    return $this->client->request('photos.reorderPhotos', $access_token, $params);
  }

  /**
   * Returns a list of photos belonging to a user or community, in reverse chronological order.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of a user or community that owns the photos. Use a negative value to designate a community ID.
   * extended boolean '1' — to return detailed information about photos
   * offset integer Offset needed to return a specific subset of photos. By default, '0'.
   * count integer Number of photos to return.
   * photo_sizes boolean '1' – to return image sizes in [vk.com/dev/photo_sizes|special format].
   * no_service_albums boolean '1' – to return photos only from standard albums, '0' – to return all photos including those in service albums, e.g., 'My wall photos' (default)
   * need_hidden boolean '1' – to show information about photos being hidden from the block above the wall.
   * skip_hidden boolean '1' – not to return photos being hidden from the block above the wall. Works only with owner_id>0, no_service_albums is ignored.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getAll($access_token, $params = array()) {
    return $this->client->request('photos.getAll', $access_token, $params);
  }

  /**
   * Returns a list of photos in which a user is tagged.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer User ID.
   * offset integer Offset needed to return a specific subset of photos. By default, '0'.
   * count integer Number of photos to return. Maximum value is 1000.
   * extended boolean '1' — to return an additional 'likes' field, '0' — (default)
   * sort string Sort order: '1' — by date the tag was added in ascending order, '0' — by date the tag was added in descending order
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getUserPhotos($access_token, $params = array()) {
    return $this->client->request('photos.getUserPhotos', $access_token, $params);
  }

  /**
   * Deletes a photo album belonging to the current user.
   * 
   * @param $access_token string
   * @param $params array
   * album_id integer Album ID.
   * group_id integer ID of the community that owns the album.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function deleteAlbum($access_token, $params = array()) {
    return $this->client->request('photos.deleteAlbum', $access_token, $params);
  }

  /**
   * Deletes a photo.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the photo.
   * photo_id integer Photo ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function delete($access_token, $params = array()) {
    return $this->client->request('photos.delete', $access_token, $params);
  }

  /**
   * Restores a deleted photo.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the photo.
   * photo_id integer Photo ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function restore($access_token, $params = array()) {
    return $this->client->request('photos.restore', $access_token, $params);
  }

  /**
   * Confirms a tag on a photo.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the photo.
   * photo_id string Photo ID.
   * tag_id integer Tag ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function confirmTag($access_token, $params = array()) {
    return $this->client->request('photos.confirmTag', $access_token, $params);
  }

  /**
   * Returns a list of comments on a photo.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the photo.
   * photo_id integer Photo ID.
   * need_likes boolean '1' — to return an additional 'likes' field, '0' — (default)
   * start_comment_id integer
   * offset integer Offset needed to return a specific subset of comments. By default, '0'.
   * count integer Number of comments to return.
   * sort string Sort order: 'asc' — old first, 'desc' — new first
   * access_key string
   * extended boolean
   * fields array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getComments($access_token, $params = array()) {
    return $this->client->request('photos.getComments', $access_token, $params);
  }

  /**
   * Returns a list of comments on a specific photo album or all albums of the user sorted in reverse chronological order.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the album(s).
   * album_id integer Album ID. If the parameter is not set, comments on all of the user's albums will be returned.
   * need_likes boolean '1' — to return an additional 'likes' field, '0' — (default)
   * offset integer Offset needed to return a specific subset of comments. By default, '0'.
   * count integer Number of comments to return. By default, '20'. Maximum value, '100'.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getAllComments($access_token, $params = array()) {
    return $this->client->request('photos.getAllComments', $access_token, $params);
  }

  /**
   * Adds a new comment on the photo.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the photo.
   * photo_id integer Photo ID.
   * message string Comment text.
   * attachments array (Required if 'message' is not set.) List of objects attached to the post, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — Media attachment owner ID. '<media_id>' — Media attachment ID. Example: "photo100172_166443618,photo66748_265827614"
   * from_group boolean '1' — to post a comment from the community
   * reply_to_comment integer 
   * sticker_id integer
   * access_key string
   * guid string
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function createComment($access_token, $params = array()) {
    return $this->client->request('photos.createComment', $access_token, $params);
  }

  /**
   * Deletes a comment on the photo.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the photo.
   * comment_id integer Comment ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function deleteComment($access_token, $params = array()) {
    return $this->client->request('photos.deleteComment', $access_token, $params);
  }

  /**
   * Restores a deleted comment on a photo.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the photo.
   * comment_id integer ID of the deleted comment.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function restoreComment($access_token, $params = array()) {
    return $this->client->request('photos.restoreComment', $access_token, $params);
  }

  /**
   * Edits a comment on a photo.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the photo.
   * comment_id integer Comment ID.
   * message string New text of the comment.
   * attachments array (Required if 'message' is not set.) List of objects attached to the post, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, '<owner_id>' — Media attachment owner ID. '<media_id>' — Media attachment ID. Example: "photo100172_166443618,photo66748_265827614"
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function editComment($access_token, $params = array()) {
    return $this->client->request('photos.editComment', $access_token, $params);
  }

  /**
   * Returns a list of tags on a photo.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the photo.
   * photo_id integer Photo ID.
   * access_key string
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getTags($access_token, $params = array()) {
    return $this->client->request('photos.getTags', $access_token, $params);
  }

  /**
   * Adds a tag on the photo.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the photo.
   * photo_id integer Photo ID.
   * user_id integer ID of the user to be tagged.
   * x number Upper left-corner coordinate of the tagged area (as a percentage of the photo's width).
   * y number Upper left-corner coordinate of the tagged area (as a percentage of the photo's height).
   * x2 number Lower right-corner coordinate of the tagged area (as a percentage of the photo's width).
   * y2 number Lower right-corner coordinate of the tagged area (as a percentage of the photo's height).
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function putTag($access_token, $params = array()) {
    return $this->client->request('photos.putTag', $access_token, $params);
  }

  /**
   * Removes a tag from a photo.
   * 
   * @param $access_token string
   * @param $params array
   * owner_id integer ID of the user or community that owns the photo.
   * photo_id integer Photo ID.
   * tag_id integer Tag ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function removeTag($access_token, $params = array()) {
    return $this->client->request('photos.removeTag', $access_token, $params);
  }

  /**
   * Returns a list of photos with tags that have not been viewed.
   * 
   * @param $access_token string
   * @param $params array
   * offset integer Offset needed to return a specific subset of photos.
   * count integer Number of photos to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getNewTags($access_token, $params = array()) {
    return $this->client->request('photos.getNewTags', $access_token, $params);
  }
}
