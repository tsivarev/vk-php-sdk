<?php

namespace VK\TransportClient;

interface TransportClient {
    public function post($url, $payload = null);

    public function upload($url, $parameter_name, $path);
}
