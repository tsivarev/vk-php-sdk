<?php

use PHPUnit\Framework\TestCase;
use VK\Client\VKApiClient;

class VideoSaveTest extends TestCase {
    const VIDEO_NAME = 'New Video';

    /**
     * @throws \VK\Exceptions\Api\VKApiException
     * @throws \VK\Exceptions\VKClientException
     */
    public function testUpload() {
        $vk = new VKApiClient();

        $video_path = __DIR__ . '/sample_video.mp4';

        $video_url = $vk->video()->save($GLOBALS['access_token_user'], array(
                'name' => static::VIDEO_NAME,
                'group_id' => $GLOBALS['group_id'],
            )
        );

        $video = $vk->request()->upload($video_url['upload_url'],
            'video_file', $video_path);

        $videos = $vk->video()->get($GLOBALS['access_token_user'], array(
            'owner_id' => $GLOBALS['group_id'],
            'videos' => array('-' . $GLOBALS['group_id'] . '_' . $video['video_id']),
        ));

        $last_video = $videos['items'][0];

        $this->assertEquals($last_video['id'], $video['video_id']);
        $this->assertEquals($last_video['title'], static::VIDEO_NAME);

        $vk->video()->delete($GLOBALS['access_token_user'], array(
            'video_id' => $video['video_id'],
            'owner_id' => '-' . $GLOBALS['group_id'],
        ));
    }
}
