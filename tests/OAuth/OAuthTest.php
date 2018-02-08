<?php

use PHPUnit\Framework\TestCase;
use VK\OAuth\Enums\OAuthDisplay;
use VK\OAuth\Enums\OAuthResponseType;
use VK\OAuth\Enums\OAuthUserScope;
use VK\OAuth\VKOAuth;

class OAuthTest extends TestCase {
    const REDIRECT_URI = 'http://example.com';

    /**
     * @throws \VK\Exceptions\VKClientException
     * @throws \VK\Exceptions\VKOAuthException
     */
    public function testAuthorize() {
        $oauth = new VKOAuth();

        $oauth->authorize(OAuthResponseType::CODE, $GLOBALS['client_id'], static::REDIRECT_URI,
                OAuthDisplay::POPUP, array(OAuthUserScope::AUDIO, OAuthUserScope::DOCS));

        $this->assertTrue(true);
    }
}
