# vk-php-sdk

PHP library for VK API interaction, includes OAuth 2.0 authorization and API methods. Full VK API features documentation can be found [here](http://vk.com/dev).

This library has been created using the VK API JSON Schema. It can be found [here](https://github.com/VKCOM/vk-api-schema). It uses VK API [version](https://vk.com/dev/versions) 5.69.

## 1. Installation

The VK PHP SDK can be installed using Composer by running the following command:

```sh
composer require vk/php-sdk
```

## 2. Initialization

Create VKAPIClient object using the following code:

```php
$vk = new VKAPIClient();
```

## 3. Authorization

The library provides the authorization flows for user based on OAuth 2.0 protocol implementation in vk.com API. Please read the full [documentation](https://vk.com/dev/access_token) before you start.

### 3.1. Authorization Code Flow for User

OAuth 2.0 Authorization Code Flow allows calling methods from the server side.

This flow includes two steps — obtaining an authorization code and exchanging the code for an access token. Primarily you should obtain the "code" ([manual](https://vk.com/dev/authcode_flow_user)) by redirecting the user to the authorization page using the following method:

```php
$oauth = new VKOAuth();

$oauth->authorize('{client_id}', '{redirect_uri}', '{display}', '{scope_array}', 
    OAuthResponseType::CODE, '{api_version}', '{state}');
```

As a '{display}' you should pass a constant from the OAuthDisplay class. The '{scope_array}' should be an array of constants from the OAuthUserScope class.

After successful authorization user's browser will be redirected to the specified **redirect_uri**. Meanwhile the code will be sent as a GET parameter to the specified address:

```sh
REDIRECT_URI?code=CODE
```

Then use this method to get the access token:

```php
$access_token = $oauth->getAccessToken('{client_id}', '{client_secret}', '{redirect_uri}', '{code}');
```

The '{redirect_uri}' should be the URL that was used to get a code at the first step.

## 4. API Requests
 
You can find the full list of VK API methods [here](https://vk.com/dev/methods).
 
### Request sample
 
Example of calling method **users.get**:
 
```php
$users = array(1, 210700286);
$fields = array('city', 'photo');

$response = $vk->users()->get($access_token, array(
    'user_ids' => $users,
    'fields' => $fields
    )
);
```
 
### Uploading Photos into a Private Message
 
Please read [the full manual](https://vk.com/dev/upload_files?f=4.%20Uploading%20Photos%20into%20a%20Private%20Message) before the start.
 
Call **photos.getMessagesUploadServer** to receive an upload address:
 
```php
$response_address = $vk->photos()->getMessagesUploadServer('{access_token}');
```

Then use **upload()** method to send files to the **upload_url** address received in the previous step:

```php
$response_photo = $vk->request()->upload($response_address['upload_url'],'photo', '{photo_path}');
```

You will get a JSON object with **server**, **photo**, **hash** fields. To save a photo call **photos.saveMessagesPhoto** with these three parameters:

```php
$response_save_photo = $vk->photos()->saveMessagesPhoto($access_token, array(
    'server' => $response_photo['server'],
    'photo' => $response_photo['photo'],
    'hash' => $response_photo['hash']
    )
);
```

Then you can use **'owner_id'** and **'id'** parameters from the last response to create an attachment of the uploaded photo. 

### Uploading Video Files
 
Please read [the full manual](https://vk.com/dev/upload_files_2?f=9.%20Uploading%20Video%20Files) before the start.
 
Call **video.save** to get a video upload server address:

```php
$response_address = $vk->video()->save($access_token, array(
    'name' => '{video_name}',
    'description' => '{description}'
    )
);
```

Send a file to **upload_url** received previously calling **upload()** method:

```php
$response_video = $vk->request()->upload($response_address['upload_url'],'video_file', $video_path);
```

Videos are processed for some time after uploading.

## 6. Callback API LongPoll handler

Enable Callback API LongPoll for your group and specify which events should be tracked by calling the following API method:

```php
$vk->groups()->setLongPollSettings($access_token, array(
   'group_id' => '{group_id}',
   'enabled' => 1,
   'message_new' => 1,
   'wall_post_new' => 1,
));
```

Override methods from CallbackApiHandler class for handling events:

```php
class CallbackAPIMyHandler extends CallbackApiHandler {
    public function messageNew($object) {
        var_dump('New message: ' . $object['body']);
    }
    
    public function wallPostNew($object) {
        var_dump('New wall post: ' . $object['text']);
    }
}
```

To start listening to LongPoll events, create an instance of your CallbackAPIMyHandler class, instance of CallbackApiLongPollExecutor class and call method run():

```php
$handler = new CallbackApiMyHandler();
$executor = new CallbackApiLongPollExecutor($vk, $access_token, $group_id, $handler);
$executor->run();
```