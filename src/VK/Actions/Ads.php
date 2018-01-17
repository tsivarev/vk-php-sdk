<?php

namespace VK\Actions;

use VK\VKAPIClient;

class Ads {
  /**
   * @var VKAPIClient
   **/
  private $client;

  public function __construct($client) {
    $this->client = $client;
  }

  /**
   * Returns a list of advertising accounts.
   * 
   * @param $access_token string
   * @param $params array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getAccounts($access_token, $params = array()) {
    return $this->client->request('ads.getAccounts', $access_token, $params);
  }

  /**
   * Returns a list of advertising agency's clients.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getClients($access_token, $params = array()) {
    return $this->client->request('ads.getClients', $access_token, $params);
  }

  /**
   * Creates clients of an advertising agency.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * data string Serialized JSON array of objects that describe created campaigns. Description of 'client_specification' objects see below.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function createClients($access_token, $params = array()) {
    return $this->client->request('ads.createClients', $access_token, $params);
  }

  /**
   * Edits clients of an advertising agency.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * data string Serialized JSON array of objects that describe changes in clients. Description of 'client_mod' objects see below.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function updateClients($access_token, $params = array()) {
    return $this->client->request('ads.updateClients', $access_token, $params);
  }

  /**
   * Archives clients of an advertising agency.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * ids string Serialized JSON array with IDs of deleted clients.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function deleteClients($access_token, $params = array()) {
    return $this->client->request('ads.deleteClients', $access_token, $params);
  }

  /**
   * Returns a list of campaigns in an advertising account.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * client_id integer 'For advertising agencies'. ID of the client advertising campaigns are retrieved from.
   * include_deleted boolean Flag that specifies whether archived ads shall be shown. *0 — show only active campaigns,, *1 — show all campaigns.
   * campaign_ids string Filter of advertising campaigns to show. Serialized JSON array with campaign IDs. Only campaigns that exist in 'campaign_ids' and belong to the specified advertising account will be shown. If the parameter is null, all campaigns will be shown.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getCampaigns($access_token, $params = array()) {
    return $this->client->request('ads.getCampaigns', $access_token, $params);
  }

  /**
   * Creates advertising campaigns.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * data string Serialized JSON array of objects that describe created campaigns. Description of 'campaign_specification' objects see below.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function createCampaigns($access_token, $params = array()) {
    return $this->client->request('ads.createCampaigns', $access_token, $params);
  }

  /**
   * Edits advertising campaigns.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * data string Serialized JSON array of objects that describe changes in campaigns. Description of 'campaign_mod' objects see below.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function updateCampaigns($access_token, $params = array()) {
    return $this->client->request('ads.updateCampaigns', $access_token, $params);
  }

  /**
   * Archives advertising campaigns.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * ids string Serialized JSON array with IDs of deleted campaigns.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function deleteCampaigns($access_token, $params = array()) {
    return $this->client->request('ads.deleteCampaigns', $access_token, $params);
  }

  /**
   * Returns number of ads.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * client_id integer 'Available and required for advertising agencies.' ID of the client ads are retrieved from.
   * include_deleted boolean Flag that specifies whether archived ads shall be shown: *0 — show only active ads,, *1 — show all ads.
   * campaign_ids string Filter by advertising campaigns. Serialized JSON array with campaign IDs. If the parameter is null, ads of all campaigns will be shown.
   * ad_ids string Filter by ads. Serialized JSON array with ad IDs. If the parameter is null, all ads will be shown.
   * limit integer Limit of number of returned ads. Used only if ad_ids parameter is null, and 'campaign_ids' parameter contains ID of only one campaign.
   * offset integer Offset. Used in the same cases as 'limit' parameter.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getAds($access_token, $params = array()) {
    return $this->client->request('ads.getAds', $access_token, $params);
  }

  /**
   * Returns descriptions of ad layouts.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * client_id integer 'For advertising agencies.' ID of the client ads are retrieved from.
   * include_deleted boolean Flag that specifies whether archived ads shall be shown. *0 — show only active ads,, *1 — show all ads.
   * campaign_ids string Filter by advertising campaigns. Serialized JSON array with campaign IDs. If the parameter is null, ads of all campaigns will be shown.
   * ad_ids string Filter by ads. Serialized JSON array with ad IDs. If the parameter is null, all ads will be shown.
   * limit integer Limit of number of returned ads. Used only if 'ad_ids' parameter is null, and 'campaign_ids' parameter contains ID of only one campaign.
   * offset integer Offset. Used in the same cases as 'limit' parameter.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getAdsLayout($access_token, $params = array()) {
    return $this->client->request('ads.getAdsLayout', $access_token, $params);
  }

  /**
   * Returns ad targeting parameters.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * client_id integer 'For advertising agencies.' ID of the client ads are retrieved from.
   * include_deleted boolean flag that specifies whether archived ads shall be shown: *0 — show only active ads,, *1 — show all ads.
   * campaign_ids string Filter by advertising campaigns. Serialized JSON array with campaign IDs. If the parameter is null, ads of all campaigns will be shown.
   * ad_ids string Filter by ads. Serialized JSON array with ad IDs. If the parameter is null, all ads will be shown.
   * limit integer Limit of number of returned ads. Used only if 'ad_ids' parameter is null, and 'campaign_ids' parameter contains ID of only one campaign.
   * offset integer Offset needed to return a specific subset of results.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getAdsTargeting($access_token, $params = array()) {
    return $this->client->request('ads.getAdsTargeting', $access_token, $params);
  }

  /**
   * Creates ads.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * data string Serialized JSON array of objects that describe created ads. Description of 'ad_specification' objects see below.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function createAds($access_token, $params = array()) {
    return $this->client->request('ads.createAds', $access_token, $params);
  }

  /**
   * Edits ads.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * data string Serialized JSON array of objects that describe changes in ads. Description of 'ad_edit_specification' objects see below.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function updateAds($access_token, $params = array()) {
    return $this->client->request('ads.updateAds', $access_token, $params);
  }

  /**
   * Archives ads.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * ids string Serialized JSON array with ad IDs.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function deleteAds($access_token, $params = array()) {
    return $this->client->request('ads.deleteAds', $access_token, $params);
  }

  /**
   * Allows to check the ad link.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * link_type string Object type: *'community' — community,, *'post' — community post,, *'application' — VK application,, *'video' — video,, *'site' — external site.
   * link_url string Object URL.
   * campaign_id integer Campaign ID
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function checkLink($access_token, $params = array()) {
    return $this->client->request('ads.checkLink', $access_token, $params);
  }

  /**
   * Returns statistics of performance indicators for ads, campaigns, clients or the whole account.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * ids_type string Type of requested objects listed in 'ids' parameter: *ad — ads,, *campaign — campaigns,, *client — clients,, *office — account.
   * ids string IDs requested ads, campaigns, clients or account, separated with a comma, depending on the value set in 'ids_type'. Maximum 2000 objects.
   * period string Data grouping by dates: *day — statistics by days,, *month — statistics by months,, *overall — overall statistics. 'date_from' and 'date_to' parameters set temporary limits.
   * date_from string Date to show statistics from. For different value of 'period' different date format is used: *day: YYYY-MM-DD, example: 2011-09-27 — September 27, 2011, **0 — day it was created on,, *month: YYYY-MM, example: 2011-09 — September 2011, **0 — month it was created in,, *overall: 0.
   * date_to string Date to show statistics to. For different value of 'period' different date format is used: *day: YYYY-MM-DD, example: 2011-09-27 — September 27, 2011, **0 — current day,, *month: YYYY-MM, example: 2011-09 — September 2011, **0 — current month,, *overall: 0.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getStatistics($access_token, $params = array()) {
    return $this->client->request('ads.getStatistics', $access_token, $params);
  }

  /**
   * Returns demographics for ads or campaigns.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * ids_type string Type of requested objects listed in 'ids' parameter: *ad — ads,, *campaign — campaigns.
   * ids string IDs requested ads or campaigns, separated with a comma, depending on the value set in 'ids_type'. Maximum 2000 objects.
   * period string Data grouping by dates: *day — statistics by days,, *month — statistics by months,, *overall — overall statistics. 'date_from' and 'date_to' parameters set temporary limits.
   * date_from string Date to show statistics from. For different value of 'period' different date format is used: *day: YYYY-MM-DD, example: 2011-09-27 — September 27, 2011, **0 — day it was created on,, *month: YYYY-MM, example: 2011-09 — September 2011, **0 — month it was created in,, *overall: 0.
   * date_to string Date to show statistics to. For different value of 'period' different date format is used: *day: YYYY-MM-DD, example: 2011-09-27 — September 27, 2011, **0 — current day,, *month: YYYY-MM, example: 2011-09 — September 2011, **0 — current month,, *overall: 0.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getDemographics($access_token, $params = array()) {
    return $this->client->request('ads.getDemographics', $access_token, $params);
  }

  /**
   * Allows to get detailed information about the ad post reach.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * ads_ids string Ads IDS separated by comma.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getAdsPostsReach($access_token, $params = array()) {
    return $this->client->request('ads.getAdsPostsReach', $access_token, $params);
  }

  /**
   * Returns current budget of the advertising account.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getBudget($access_token, $params = array()) {
    return $this->client->request('ads.getBudget', $access_token, $params);
  }

  /**
   * Returns a list of managers and supervisors of advertising account.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getOfficeUsers($access_token, $params = array()) {
    return $this->client->request('ads.getOfficeUsers', $access_token, $params);
  }

  /**
   * Adds managers and/or supervisors to advertising account.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * data string Serialized JSON array of objects that describe added managers. Description of 'user_specification' objects see below.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function addOfficeUsers($access_token, $params = array()) {
    return $this->client->request('ads.addOfficeUsers', $access_token, $params);
  }

  /**
   * Removes managers and/or supervisors from advertising account.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * ids string Serialized JSON array with IDs of deleted managers.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function removeOfficeUsers($access_token, $params = array()) {
    return $this->client->request('ads.removeOfficeUsers', $access_token, $params);
  }

  /**
   * Returns the size of targeting audience, and also recommended values for CPC and CPM.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * criteria string Serialized JSON object that describes targeting parameters. Description of 'criteria' object see below.
   * ad_id integer ID of an ad which targeting parameters shall be analyzed.
   * ad_format integer Ad format. Possible values: *'1' — image and text,, *'2' — big image,, *'3' — exclusive format,, *'4' — community, square image,, *'7' — special app format,, *'8' — special community format,, *'9' — post in community,, *'10' — app board.
   * ad_platform string Platforms to use for ad showing. Possible values: (for 'ad_format' = '1'), *'0' — VK and partner sites,, *'1' — VK only. (for 'ad_format' = '9'), *'all' — all platforms,, *'desktop' — desktop version,, *'mobile' — mobile version and apps.
   * link_url string URL for the advertised object.
   * link_domain string Domain of the advertised object.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getTargetingStats($access_token, $params = array()) {
    return $this->client->request('ads.getTargetingStats', $access_token, $params);
  }

  /**
   * Returns a set of auto-suggestions for various targeting parameters.
   * 
   * @param $access_token string
   * @param $params array
   * section string Section, suggestions are retrieved in. Available values: *countries — request of a list of countries. If q is not set or blank, a short list of countries is shown. Otherwise, a full list of countries is shown. *regions — requested list of regions. 'country' parameter is required. *cities — requested list of cities. 'country' parameter is required. *districts — requested list of districts. 'cities' parameter is required. *stations — requested list of subway stations. 'cities' parameter is required. *streets — requested list of streets. 'cities' parameter is required. *schools — requested list of educational organizations. 'cities' parameter is required. *interests — requested list of interests. *positions — requested list of positions (professions). *group_types — requested list of group types. *religions — requested list of religious commitments. *browsers — requested list of browsers and mobile devices.
   * ids string Objects IDs separated by commas. If the parameter is passed, 'q, country, cities' should not be passed.
   * q string Filter-line of the request (for countries, regions, cities, streets, schools, interests, positions).
   * country integer ID of the country objects are searched in.
   * cities string IDs of cities where objects are searched in, separated with a comma.
   * lang string Language of the returned string values. Supported languages: *ru — Russian,, *ua — Ukrainian,, *en — English.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getSuggestions($access_token, $params = array()) {
    return $this->client->request('ads.getSuggestions', $access_token, $params);
  }

  /**
   * Returns a list of possible ad categories.
   * 
   * @param $access_token string
   * @param $params array
   * lang string Language. The full list of supported languages is [vk.com/dev/api_requests|here].
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getCategories($access_token, $params = array()) {
    return $this->client->request('ads.getCategories', $access_token, $params);
  }

  /**
   * Returns URL to upload an ad photo to.
   * 
   * @param $access_token string
   * @param $params array
   * ad_format integer Ad format: *1 — image and text,, *2 — big image,, *3 — exclusive format,, *4 — community, square image,, *7 — special app format.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getUploadURL($access_token, $params = array()) {
    return $this->client->request('ads.getUploadURL', $access_token, $params);
  }

  /**
   * Returns URL to upload an ad video to.
   * 
   * @param $access_token string
   * @param $params array
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getVideoUploadURL($access_token, $params = array()) {
    return $this->client->request('ads.getVideoUploadURL', $access_token, $params);
  }

  /**
   * Returns information about current state of a counter — number of remaining runs of methods and time to the next counter nulling in seconds.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getFloodStats($access_token, $params = array()) {
    return $this->client->request('ads.getFloodStats', $access_token, $params);
  }

  /**
   * Returns a reason of ad rejection for pre-moderation.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * ad_id integer Ad ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getRejectionReason($access_token, $params = array()) {
    return $this->client->request('ads.getRejectionReason', $access_token, $params);
  }

  /**
   * Creates a group to re-target ads for users who visited advertiser's site (viewed information about the product, registered, etc.).
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * client_id integer 'Only for advertising agencies.', ID of the client with the advertising account where the group will be created.
   * name string Name of the target group — a string up to 64 characters long.
   * domain string Domain of the site where user accounting code will be placed.
   * lifetime integer 'For groups with auditory created with pixel code only.', , Number of days after that users will be automatically removed from the group. '0' — not to remove users.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function createTargetGroup($access_token, $params = array()) {
    return $this->client->request('ads.createTargetGroup', $access_token, $params);
  }

  /**
   * Edits a retarget group.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * client_id integer 'Only for advertising agencies.' , ID of the client with the advertising account where the group will be created.
   * target_group_id integer Group ID.
   * name string New name of the target group — a string up to 64 characters long.
   * domain string Domain of the site where user accounting code will be placed.
   * lifetime integer 'Only for the groups that get audience from sites with user accounting code.', Time in days when users added to a retarget group will be automatically excluded from it. '0' – automatic exclusion is off.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function updateTargetGroup($access_token, $params = array()) {
    return $this->client->request('ads.updateTargetGroup', $access_token, $params);
  }

  /**
   * Deletes a retarget group.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * client_id integer 'Only for advertising agencies.' , ID of the client with the advertising account where the group will be created.
   * target_group_id integer Group ID.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function deleteTargetGroup($access_token, $params = array()) {
    return $this->client->request('ads.deleteTargetGroup', $access_token, $params);
  }

  /**
   * Returns a list of target groups.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * client_id integer 'Only for advertising agencies.', ID of the client with the advertising account where the group will be created.
   * extended boolean '1' — to return pixel code.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function getTargetGroups($access_token, $params = array()) {
    return $this->client->request('ads.getTargetGroups', $access_token, $params);
  }

  /**
   * Imports a list of advertiser's contacts to count VK registered users against the target group.
   * 
   * @param $access_token string
   * @param $params array
   * account_id integer Advertising account ID.
   * client_id integer 'Only for advertising agencies.' , ID of the client with the advertising account where the group will be created.
   * target_group_id integer Target group ID.
   * contacts string List of phone numbers, emails or user IDs separated with a comma.
   * 
   * @return \VK\VKResponse
   * @throws \VK\Exceptions\VKClientException
   * 
   **/
  public function importTargetContacts($access_token, $params = array()) {
    return $this->client->request('ads.importTargetContacts', $access_token, $params);
  }
}
