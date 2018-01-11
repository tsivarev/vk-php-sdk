<?php

$methods_link = 'https://raw.githubusercontent.com/VKCOM/vk-api-schema/master/methods.json';
$curl = curl_init($methods_link);
curl_setopt_array($curl, array(
    CURLOPT_CONNECTTIMEOUT => 10,
    CURLOPT_RETURNTRANSFER => true,
));
$raw_response = curl_exec($curl);
$response = json_decode($raw_response, true);

$api_client_result = '<?php' . PHP_EOL . PHP_EOL . 'namespace VK;' . PHP_EOL . PHP_EOL . 'class VKAPIClient {' . PHP_EOL;
$api_client_result .= '    /**' . PHP_EOL . '     * @var HttpClient' . PHP_EOL . '     */' . PHP_EOL;
$api_client_result .= '    private $client;';

$api_client_members = '';

$api_client_construct = PHP_EOL . PHP_EOL . '    public function __construct() {' . PHP_EOL;
$api_client_construct .= '        $this->client = new HttpClient();';

$api_client_gets = '';

$mapped_methods = array();
$map_methods = function($method) {
    global $mapped_methods;
    list($object_name, $method_name) = explode('.', $method['name']);
    if (!isset($mapped_methods[$object_name])) {
        $mapped_methods[$object_name] = array();
    }
    $method['name'] = $method_name;
    $mapped_methods[$object_name][] = $method;
};
array_map($map_methods, $response['methods']);

ksort($mapped_methods);

$generate_object = function(&$object_methods, $object_name) {
    global $api_client_members;
    global $api_client_construct;
    global $api_client_gets;

    $class_name = ucwords($object_name);

    $api_client_members .= PHP_EOL . PHP_EOL . '    /**' . PHP_EOL . '     * @var \\' . "{$class_name}" . PHP_EOL;
    $api_client_members .= '     */' . PHP_EOL . '    private $' . "{$object_name}" . ';';

    $api_client_construct .= PHP_EOL . '        $this->' . "{$object_name}" . ' = new \\' . "{$class_name}";
    $api_client_construct .= '($this->client);';

    $api_client_gets .= PHP_EOL . PHP_EOL . '    public function ' . "{$object_name}" . '() {' . PHP_EOL;
    $api_client_gets .= '        return $this->' . "{$object_name}" . ';' . PHP_EOL . '    }';

    $result = '<?php' . PHP_EOL . PHP_EOL . 'use VK\HttpClient;' . PHP_EOL . PHP_EOL;
    $result .= "class {$class_name} {" . PHP_EOL . PHP_EOL;
    $result .= '    /**' . PHP_EOL . '     * @var HttpClient' . PHP_EOL . '     */';
    $result .= PHP_EOL . '    private $client;' . PHP_EOL . PHP_EOL;
    $result .= '    public function __construct($client) {' . PHP_EOL . '        $this->client = $client;';
    $result .= PHP_EOL . '    }';

    $generate_method = function($method) use (&$result, &$object_name) {
        $result .= PHP_EOL . PHP_EOL . '    /**' . PHP_EOL;
        $result .= '     * ' . $method['description'] . PHP_EOL . '     *' . PHP_EOL;
        $result .= '     * @param $access_token' . PHP_EOL . '     * @param array $params' . PHP_EOL;

        $add_params = function($param) use (&$result) {
            $result .= '     * ' . $param['name'] . ' ' . $param['type'] . '  ' . $param['description'] . PHP_EOL;
        };
        if (isset($method['parameters'])) {
            array_map($add_params, $method['parameters']);
        }

        $result .= '     *' . PHP_EOL . '     * @return \VK\VKResponse' . PHP_EOL;
        $result .= '     * @throws \VK\Exceptions\VKClientException' . PHP_EOL . '     */' . PHP_EOL;
        $result .= '    public function ' . $method['name'] . '($access_token, $params = array()) {' . PHP_EOL;
        $result .= '        return $this->client->request(' . "'{$object_name}.{$method['name']}'";
        $result .= ', $access_token, $params);' . PHP_EOL . '    }';
    };
    array_map($generate_method, $object_methods);
    $result .= PHP_EOL . '}' . PHP_EOL;

    $file_name = "Actions/" . $class_name . ".php";
    file_put_contents($file_name, $result);
};

array_walk($mapped_methods, $generate_object);

$api_client_construct .= PHP_EOL . '    }';

$api_client_result .= $api_client_members . $api_client_construct . $api_client_gets . PHP_EOL . '}' . PHP_EOL;
$file_name = "VKAPIClient.php";
file_put_contents($file_name, $api_client_result);
