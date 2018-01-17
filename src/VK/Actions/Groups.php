<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Groups {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Returns information specifying whether a user is a member of a community.
   * 
   * @param $access_token string
   * @param $params array
   * group_id string ID or screen name of the community.
   * user_id integer User ID.
   * user_ids array User IDs.
   * extended boolean '1' — to return an extended response with additional fields. By default: '0'.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function isMember($access_token, $params = array()) {
    return $this->client->request('groups.isMember', $access_token, $params);
  }

  /**
   * Returns information about communities by their IDs.
   * 
   * @param $access_token string
   * @param $params array
   * group_ids array IDs or screen names of communities.
   * group_id string ID or screen name of the community.
   * fields array Group fields to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getById($access_token, $params = array()) {
    return $this->client->request('groups.getById', $access_token, $params);
  }

  /**
   * Returns a list of the communities to which a user belongs.
   * 
   * @param $access_token string
   * @param $params array
   * user_id integer User ID.
   * extended boolean '1' — to return complete information about a user's communities, '0' — to return a list of community IDs without any additional fields (default),
   * filter array Types of communities to return: 'admin' — to return communities administered by the user , 'editor' — to return communities where the user is an administrator or editor, 'moder' — to return communities where the user is an administrator, editor, or moderator, 'groups' — to return only groups, 'publics' — to return only public pages, 'events' — to return only events
   * fields array Profile fields to return.
   * offset integer Offset needed to return a specific subset of communities.
   * count integer Number of communities to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function get($access_token, $params = array()) {
    return $this->client->request('groups.get', $access_token, $params);
  }

  /**
   * Returns a list of community members.
   * 
   * @param $access_token string
   * @param $params array
   * group_id string ID or screen name of the community.
   * sort string Sort order. Available values: 'id_asc', 'id_desc', 'time_asc', 'time_desc'. 'time_asc' and 'time_desc' are availavle only if the method is called by the group's 'moderator'.
   * offset integer Offset needed to return a specific subset of community members.
   * count integer Number of community members to return.
   * fields array List of additional fields to be returned. Available values: 'sex, bdate, city, country, photo_50, photo_100, photo_200_orig, photo_200, photo_400_orig, photo_max, photo_max_orig, online, online_mobile, lists, domain, has_mobile, contacts, connections, site, education, universities, schools, can_post, can_see_all_posts, can_see_audio, can_write_private_message, status, last_seen, common_count, relation, relatives, counters'.
   * filter string *'friends' – only friends in this community will be returned,, *'unsure' – only those who pressed 'I may attend' will be returned (if it's an event).
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getMembers($access_token, $params = array()) {
    return $this->client->request('groups.getMembers', $access_token, $params);
  }

  /**
   * With this method you can join the group or public page, and also confirm your participation in an event.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer ID or screen name of the community.
   * not_sure string Optional parameter which is taken into account when 'gid' belongs to the event: '1' — Perhaps I will attend, '0' — I will be there for sure (default), ,
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function join($access_token, $params = array()) {
    return $this->client->request('groups.join', $access_token, $params);
  }

  /**
   * With this method you can leave a group, public page, or event.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer ID or screen name of the community.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function leave($access_token, $params = array()) {
    return $this->client->request('groups.leave', $access_token, $params);
  }

  /**
   * Returns a list of communities matching the search criteria.
   * 
   * @param $access_token string
   * @param $params array
   * q string Search query string.
   * type string Community type. Possible values: 'group, page, event.'
   * country_id integer Country ID.
   * city_id integer City ID. If this parameter is transmitted, country_id is ignored.
   * future boolean '1' — to return only upcoming events. Works with the 'type' = 'event' only.
   * market boolean '1' — to return communities with enabled market only.
   * sort integer Sort order. Possible values: *'0' — default sorting (similar the full version of the site),, *'1' — by growth speed,, *'2'— by the "day attendance/members number" ratio,, *'3' — by the "Likes number/members number" ratio,, *'4' — by the "comments number/members number" ratio,, *'5' — by the "boards entries number/members number" ratio.
   * offset integer Offset needed to return a specific subset of results.
   * count integer Number of communities to return. "Note that you can not receive more than first thousand of results, regardless of 'count' and 'offset' values."
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function search($access_token, $params = array()) {
    return $this->client->request('groups.search', $access_token, $params);
  }

  /**
   * Returns communities list for a catalog category.
   * 
   * @param $access_token string
   * @param $params array
   * category_id integer Category id received from [vk.com/dev/groups.getCatalogInfo|groups.getCatalogInfo].
   * subcategory_id integer Subcategory id received from [vk.com/dev/groups.getCatalogInfo|groups.getCatalogInfo].
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getCatalog($access_token, $params = array()) {
    return $this->client->request('groups.getCatalog', $access_token, $params);
  }

  /**
   * Returns categories list for communities catalog
   * 
   * @param $access_token string
   * @param $params array
   * extended boolean 1 – to return communities count and three communities for preview. By default: 0.
   * subcategories boolean 1 – to return subcategories info. By default: 0.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getCatalogInfo($access_token, $params = array()) {
    return $this->client->request('groups.getCatalogInfo', $access_token, $params);
  }

  /**
   * Returns a list of invitations to join communities and events.
   * 
   * @param $access_token string
   * @param $params array
   * offset integer Offset needed to return a specific subset of invitations.
   * count integer Number of invitations to return.
   * extended boolean '1' — to return additional [vk.com/dev/fields_groups|fields] for communities..
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getInvites($access_token, $params = array()) {
    return $this->client->request('groups.getInvites', $access_token, $params);
  }

  /**
   * Returns invited users list of a community
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Group ID to return invited users for.
   * offset integer Offset needed to return a specific subset of results.
   * count integer Number of results to return.
   * fields array List of additional fields to be returned. Available values: 'sex, bdate, city, country, photo_50, photo_100, photo_200_orig, photo_200, photo_400_orig, photo_max, photo_max_orig, online, online_mobile, lists, domain, has_mobile, contacts, connections, site, education, universities, schools, can_post, can_see_all_posts, can_see_audio, can_write_private_message, status, last_seen, common_count, relation, relatives, counters'.
   * name_case string Case for declension of user name and surname. Possible values: *'nom' — nominative (default),, *'gen' — genitive,, *'dat' — dative,, *'acc' — accusative, , *'ins' — instrumental,, *'abl' — prepositional.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getInvitedUsers($access_token, $params = array()) {
    return $this->client->request('groups.getInvitedUsers', $access_token, $params);
  }

  /**
   * Adds a user to a community blacklist.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * user_id integer User ID.
   * end_date integer Date (in Unix time) when the user will be removed from the blacklist.
   * reason integer Reason for ban: '1' — spam, '2' — verbal abuse, '3' — strong language, '4' — irrelevant messages, '0' — other (default)
   * comment string Text of comment to ban.
   * comment_visible boolean '1' — text of comment will be visible to the user,, '0' — text of comment will be invisible to the user. By default: '0'.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function banUser($access_token, $params = array()) {
    return $this->client->request('groups.banUser', $access_token, $params);
  }

  /**
   * Removes a user from a community blacklist.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * user_id integer User ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function unbanUser($access_token, $params = array()) {
    return $this->client->request('groups.unbanUser', $access_token, $params);
  }

  /**
   * Returns a list of users on a community blacklist.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * offset integer Offset needed to return a specific subset of users.
   * count integer Number of users to return.
   * fields array
   * user_id integer
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getBanned($access_token, $params = array()) {
    return $this->client->request('groups.getBanned', $access_token, $params);
  }

  /**
   * Creates a new community.
   * 
   * @param $access_token string
   * @param $params array
   * title string Community title.
   * description string Community description (ignored for 'type' = 'public').
   * type string Community type. Possible values: *'group' – group,, *'event' – event,, *'public' – public page
   * public_category integer Category ID (for 'type' = 'public' only).
   * subtype integer Public page subtype. Possible values: *'1' – place or small business,, *'2' – company, organization or website,, *'3' – famous person or group of people,, *'4' – product or work of art.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function create($access_token, $params = array()) {
    return $this->client->request('groups.create', $access_token, $params);
  }

  /**
   * Edits a community.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * title string Community title.
   * description string Community description.
   * screen_name string Community screen name.
   * access integer Community type. Possible values: *'0' – open,, *'1' – closed,, *'2' – private.
   * website string Website that will be displayed in the community information field.
   * subject string Community subject. Possible values: , *'1' – auto/moto,, *'2' – activity holidays,, *'3' – business,, *'4' – pets,, *'5' – health,, *'6' – dating and communication, , *'7' – games,, *'8' – IT (computers and software),, *'9' – cinema,, *'10' – beauty and fashion,, *'11' – cooking,, *'12' – art and culture,, *'13' – literature,, *'14' – mobile services and internet,, *'15' – music,, *'16' – science and technology,, *'17' – real estate,, *'18' – news and media,, *'19' – security,, *'20' – education,, *'21' – home and renovations,, *'22' – politics,, *'23' – food,, *'24' – industry,, *'25' – travel,, *'26' – work,, *'27' – entertainment,, *'28' – religion,, *'29' – family,, *'30' – sports,, *'31' – insurance,, *'32' – television,, *'33' – goods and services,, *'34' – hobbies,, *'35' – finance,, *'36' – photo,, *'37' – esoterics,, *'38' – electronics and appliances,, *'39' – erotic,, *'40' – humor,, *'41' – society, humanities,, *'42' – design and graphics.
   * email string Organizer email (for events).
   * phone string Organizer phone number (for events).
   * rss string RSS feed address for import (available only to communities with special permission. Contact vk.com/support to get it.
   * event_start_date integer Event start date in Unixtime format.
   * event_finish_date integer Event finish date in Unixtime format.
   * event_group_id integer Organizer community ID (for events only).
   * public_category integer Public page category ID.
   * public_subcategory integer Public page subcategory ID.
   * public_date string Founding date of a company or organization owning the community in "dd.mm.YYYY" format.
   * wall integer Wall settings. Possible values: *'0' – disabled,, *'1' – open,, *'2' – limited (groups and events only),, *'3' – closed (groups and events only).
   * topics integer Board topics settings. Possbile values: , *'0' – disabled,, *'1' – open,, *'2' – limited (for groups and events only).
   * photos integer Photos settings. Possible values: *'0' – disabled,, *'1' – open,, *'2' – limited (for groups and events only).
   * video integer Video settings. Possible values: *'0' – disabled,, *'1' – open,, *'2' – limited (for groups and events only).
   * audio integer Audio settings. Possible values: *'0' – disabled,, *'1' – open,, *'2' – limited (for groups and events only).
   * links boolean Links settings (for public pages only). Possible values: *'0' – disabled,, *'1' – enabled.
   * events boolean Events settings (for public pages only). Possible values: *'0' – disabled,, *'1' – enabled.
   * places boolean Places settings (for public pages only). Possible values: *'0' – disabled,, *'1' – enabled.
   * contacts boolean Contacts settings (for public pages only). Possible values: *'0' – disabled,, *'1' – enabled.
   * docs integer Documents settings. Possible values: *'0' – disabled,, *'1' – open,, *'2' – limited (for groups and events only).
   * wiki integer Wiki pages settings. Possible values: *'0' – disabled,, *'1' – open,, *'2' – limited (for groups and events only).
   * messages boolean Community messages. Possible values: *'0' — disabled,, *'1' — enabled.
   * age_limits integer Community age limits. Possible values: *'1' — no limits,, *'2' — 16+,, *'3' — 18+.
   * market boolean Market settings. Possible values: *'0' – disabled,, *'1' – enabled.
   * market_comments boolean market comments settings. Possible values: *'0' – disabled,, *'1' – enabled.
   * market_country array Market delivery countries.
   * market_city array Market delivery cities (if only one country is specified).
   * market_currency integer Market currency settings. Possbile values: , *'643' – Russian rubles,, *'980' – Ukrainian hryvnia,, *'398' – Kazakh tenge,, *'978' – Euro,, *'840' – US dollars
   * market_contact integer Seller contact for market. Set '0' for community messages.
   * market_wiki integer ID of a wiki page with market description.
   * obscene_filter boolean Obscene expressions filter in comments. Possible values: , *'0' – disabled,, *'1' – enabled.
   * obscene_stopwords boolean Stopwords filter in comments. Possible values: , *'0' – disabled,, *'1' – enabled.
   * obscene_words array Keywords for stopwords filter.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function edit($access_token, $params = array()) {
    return $this->client->request('groups.edit', $access_token, $params);
  }

  /**
   * Edits the place in community.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * title string Place title.
   * address string Place address.
   * country_id integer Country ID.
   * city_id integer City ID.
   * latitude number Geographical latitude.
   * longitude number Geographical longitude.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function editPlace($access_token, $params = array()) {
    return $this->client->request('groups.editPlace', $access_token, $params);
  }

  /**
   * Returns community settings.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getSettings($access_token, $params = array()) {
    return $this->client->request('groups.getSettings', $access_token, $params);
  }

  /**
   * Returns a list of requests to the community.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * offset integer Offset needed to return a specific subset of results.
   * count integer Number of results to return.
   * fields array Profile fields to return.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getRequests($access_token, $params = array()) {
    return $this->client->request('groups.getRequests', $access_token, $params);
  }

  /**
   * Allows to add, remove or edit the community manager.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * user_id integer User ID.
   * role string Manager role. Possible values: *'moderator',, *'editor',, *'administrator'.
   * is_contact boolean '1' — to show the manager in Contacts block of the community.
   * contact_position string Position to show in Contacts block.
   * contact_phone string Contact phone.
   * contact_email string Contact e-mail.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function editManager($access_token, $params = array()) {
    return $this->client->request('groups.editManager', $access_token, $params);
  }

  /**
   * Allows to invite friends to the community.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * user_id integer User ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function invite($access_token, $params = array()) {
    return $this->client->request('groups.invite', $access_token, $params);
  }

  /**
   * Allows to add a link to the community.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * link string Link URL.
   * text string Description text for the link.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function addLink($access_token, $params = array()) {
    return $this->client->request('groups.addLink', $access_token, $params);
  }

  /**
   * Allows to delete a link from the community.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * link_id integer Link ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function deleteLink($access_token, $params = array()) {
    return $this->client->request('groups.deleteLink', $access_token, $params);
  }

  /**
   * Allows to edit a link in the community.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * link_id integer Link ID.
   * text string New description text for the link.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function editLink($access_token, $params = array()) {
    return $this->client->request('groups.editLink', $access_token, $params);
  }

  /**
   * Allows to reorder links in the community.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * link_id integer Link ID.
   * after integer ID of the link after which to place the link with 'link_id'.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function reorderLink($access_token, $params = array()) {
    return $this->client->request('groups.reorderLink', $access_token, $params);
  }

  /**
   * Removes a user from the community.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * user_id integer User ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function removeUser($access_token, $params = array()) {
    return $this->client->request('groups.removeUser', $access_token, $params);
  }

  /**
   * Allows to approve join request to the community.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * user_id integer User ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function approveRequest($access_token, $params = array()) {
    return $this->client->request('groups.approveRequest', $access_token, $params);
  }

  /**
   * Returns Callback API confirmation code for the community.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getCallbackConfirmationCode($access_token, $params = array()) {
    return $this->client->request('groups.getCallbackConfirmationCode', $access_token, $params);
  }

  /**
   * Returns [vk.com/dev/callback_api|Callback API] notifications settings.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * server_id integer Server ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getCallbackSettings($access_token, $params = array()) {
    return $this->client->request('groups.getCallbackSettings', $access_token, $params);
  }

  /**
   * Allow to set notifications settings for group.
   * 
   * @param $access_token string
   * @param $params array
   * group_id integer Community ID.
   * server_id integer Server ID.
   * message_new boolean A new incoming message has been received ('0' — disabled, '1' — enabled).
   * message_reply boolean A new outcoming message has been received ('0' — disabled, '1' — enabled).
   * message_allow boolean Allowed messages notifications ('0' — disabled, '1' — enabled).
   * message_deny boolean Denied messages notifications ('0' — disabled, '1' — enabled).
   * photo_new boolean New photos notifications ('0' — disabled, '1' — enabled).
   * audio_new boolean New audios notifications ('0' — disabled, '1' — enabled).
   * video_new boolean New videos notifications ('0' — disabled, '1' — enabled).
   * wall_reply_new boolean New wall replies notifications ('0' — disabled, '1' — enabled).
   * wall_reply_edit boolean Wall replies edited notifications ('0' — disabled, '1' — enabled).
   * wall_reply_delete boolean A wall comment has been deleted ('0' — disabled, '1' — enabled).
   * wall_reply_restore boolean A wall comment has been restored ('0' — disabled, '1' — enabled).
   * wall_post_new boolean New wall posts notifications ('0' — disabled, '1' — enabled).
   * wall_repost boolean New wall posts notifications ('0' — disabled, '1' — enabled).
   * board_post_new boolean New board posts notifications ('0' — disabled, '1' — enabled).
   * board_post_edit boolean Board posts edited notifications ('0' — disabled, '1' — enabled).
   * board_post_restore boolean Board posts restored notifications ('0' — disabled, '1' — enabled).
   * board_post_delete boolean Board posts deleted notifications ('0' — disabled, '1' — enabled).
   * photo_comment_new boolean New comment to photo notifications ('0' — disabled, '1' — enabled).
   * photo_comment_edit boolean A photo comment has been edited ('0' — disabled, '1' — enabled).
   * photo_comment_delete boolean A photo comment has been deleted ('0' — disabled, '1' — enabled).
   * photo_comment_restore boolean A photo comment has been restored ('0' — disabled, '1' — enabled).
   * video_comment_new boolean New comment to video notifications ('0' — disabled, '1' — enabled).
   * video_comment_edit boolean A video comment has been edited ('0' — disabled, '1' — enabled).
   * video_comment_delete boolean A video comment has been deleted ('0' — disabled, '1' — enabled).
   * video_comment_restore boolean A video comment has been restored ('0' — disabled, '1' — enabled).
   * market_comment_new boolean New comment to market item notifications ('0' — disabled, '1' — enabled).
   * market_comment_edit boolean A market comment has been edited ('0' — disabled, '1' — enabled).
   * market_comment_delete boolean A market comment has been deleted ('0' — disabled, '1' — enabled).
   * market_comment_restore boolean A market comment has been restored ('0' — disabled, '1' — enabled).
   * poll_vote_new boolean A vote in a public poll has been added ('0' — disabled, '1' — enabled).
   * group_join boolean Joined community notifications ('0' — disabled, '1' — enabled).
   * group_leave boolean Left community notifications ('0' — disabled, '1' — enabled).
   * user_block boolean User added to community blacklist
   * user_unblock boolean User removed from community blacklist
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function setCallbackSettings($access_token, $params = array()) {
    return $this->client->request('groups.setCallbackSettings', $access_token, $params);
  }
}
