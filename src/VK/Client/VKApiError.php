<?php

namespace VK\Client;

class VKApiError {
    protected const KEY_ERROR_CODE = 'error_code';
    protected const KEY_ERROR_MSG = 'error_msg';
    protected const KEY_CAPTCHA_SID = '$captcha_sid';
    protected const KEY_CAPTCHA_IMG = '$captcha_img';
    protected const KEY_CONFIRMATION_TEXT = '$confirmation_text';
    protected const KEY_REDIRECT_URI = '$redirect_uri';
    protected const KEY_REQUEST_PARAMS = '$request_params';

    protected $error_code;
    protected $error_msg;
    protected $captcha_sid;
    protected $captcha_img;
    protected $confirmation_text;
    protected $redirect_uri;
    protected $request_params;

    public function __construct(array $error) {
        $this->error_code = $error[static::KEY_ERROR_CODE];
        $this->error_msg = $error[static::KEY_ERROR_MSG];
        $this->captcha_sid = $error[static::KEY_CAPTCHA_SID];
        $this->captcha_img = $error[static::KEY_CAPTCHA_IMG];
        $this->confirmation_text = $error[static::KEY_CONFIRMATION_TEXT];
        $this->redirect_uri = $error[static::KEY_REDIRECT_URI];
        $this->request_params = $error[static::KEY_REQUEST_PARAMS];
    }

    public function getErrorCode() {
        return $this->error_code;
    }

    public function getErrorMsg() {
        return $this->error_msg;
    }

    public function getCaptchaSid() {
        return $this->captcha_sid;
    }

    public function getCaptchaImg() {
        return $this->captcha_img;
    }

    public function getConfirmationText() {
        return $this->confirmation_text;
    }

    public function getRedirectUri() {
        return $this->redirect_uri;
    }

    public function getRequestParams() {
        return $this->request_params;
    }
}
