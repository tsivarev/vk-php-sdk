<?php

namespace VK\TransportClient;

interface TransportClient {
    public function post(string $url, ?array $payload = null);

    public function get(string $url, ?array $payload = null);

    public function upload(string $url, string $parameter_name, string $path);
}
