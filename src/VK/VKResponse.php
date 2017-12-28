<?php

namespace VK;

class VKResponse
{
    /**
     * @var string|boolean The raw response from the server.
     */
    private $raw_response;

    /**
     * @var int The HTTP status code response.
     */
    protected $http_status_code;

    /**
     * @var array The returned headers.
     */
    protected $headers;

    /**
     * @var string The raw body of the response.
     */
    protected $body;

    /**
     * @var array The decoded body of the response.
     */
    protected $decoded_body = [];

    /**
     * Creates a new Response entity from raw response.
     *
     * @var string|boolean The raw response from the server
     */
    public function __construct($raw_response)
    {
        $this->raw_response = $raw_response;
        $this->parse_raw_response();

        $this->decodeBody();
    }

    /**
     * Return the HTTP status code for this response.
     *
     * @return int
     */
    public function get_http_status_code()
    {
        return $this->http_status_code;
    }

    /**
     * Return the HTTP headers for this response.
     *
     * @return array
     */
    public function get_headers()
    {
        return $this->headers;
    }

    /**
     * Return the raw body response.
     *
     * @return string
     */
    public function get_body()
    {
        return $this->body;
    }

    /**
     * Return the decoded body response.
     *
     * @return array
     */
    public function get_decoded_body()
    {
        return $this->decoded_body;
    }

    /**
     * Breaks the raw response down into its headers, body and http status code.
     *
     */
    private function parse_raw_response()
    {
        list($raw_headers, $raw_body) = $this->extract_response_headers_and_body();

        $this->set_headers_from_string($raw_headers);

        $this->body = $raw_body;
    }

    /**
     * Extracts the headers and the body into a two-part array
     *
     * @return array
     */
    private function extract_response_headers_and_body()
    {
        $parts = explode("\r\n\r\n", $this->raw_response);
        $rawBody = array_pop($parts);
        $rawHeaders = implode("\r\n\r\n", $parts);

        return [trim($rawHeaders), trim($rawBody)];
    }

    /**
     * Parse the raw headers and set as an array.
     *
     * @param string The raw headers from the response.
     */
    private function set_headers_from_string($raw_headers)
    {
        // Normalize line breaks
        $raw_headers = str_replace("\r\n", "\n", $raw_headers);

        // There will be multiple headers if a 301 was followed
        // or a proxy was followed, etc
        $header_collection = explode("\n\n", trim($raw_headers));
        // We just want the last response (at the end)
        $raw_header = array_pop($header_collection);

        $header_components = explode("\n", $raw_header);
        foreach ($header_components as $line) {
            if (strpos($line, ': ') === false) {
                $this->set_http_response_code_from_header($line);
            } else {
                list($key, $value) = explode(': ', $line, 2);
                $this->headers[$key] = $value;
            }
        }
    }

    /**
     * Sets the HTTP response code from a raw header.
     *
     * @param string
     */
    private function set_http_response_code_from_header($raw_response_header)
    {
        preg_match('|HTTP/\d\.\d\s+(\d+)\s+.*|', $raw_response_header, $match);
        $this->http_status_code = (int)$match[1];
    }

    /**
     * Convert the raw response into an array if possible.
     */
    private function decodeBody()
    {
        $this->decoded_body = json_decode($this->body, true);

        if ($this->decoded_body === null) {
            $this->decoded_body = [];
        }

        if (!is_array($this->decoded_body)) {
            $this->decoded_body = [];
        }

        if (isset($this->decodedBody['error'])) {
            $this->makeException();
        }
    }
}
