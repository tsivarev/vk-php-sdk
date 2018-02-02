<?php

namespace VK\Client;

class VKApiError {
    protected const ERROR_CODE_KEY = 'error_code';
    protected const ERROR_MSG_KEY = 'error_msg';
    protected const CAPTCHA_SID_KEY = '$captcha_sid';
    protected const CAPTCHA_IMG_KEY = '$captcha_img';
    protected const CONFIRMATION_TEXT_KEY = '$confirmation_text';
    protected const REDIRECT_URI_KEY = '$redirect_uri';
    protected const REQUEST_PARAMS_KEY = '$request_params';

    protected $error_code;
    protected $error_msg;
    protected $captcha_sid;
    protected $captcha_img;
    protected $confirmation_text;
    protected $redirect_uri;
    protected $request_params;

    public function __construct(array $error) {
        $this->error_code = $error[static::ERROR_CODE_KEY];
        $this->error_msg = $error[static::ERROR_MSG_KEY];
        $this->captcha_sid = $error[static::CAPTCHA_SID_KEY];
        $this->captcha_img = $error[static::CAPTCHA_IMG_KEY];
        $this->confirmation_text = $error[static::CONFIRMATION_TEXT_KEY];
        $this->redirect_uri = $error[static::REDIRECT_URI_KEY];
        $this->request_params = $error[static::REQUEST_PARAMS_KEY];
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
