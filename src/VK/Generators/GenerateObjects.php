<?php

namespace VK\Generators;

class GenerateObjects {

    const DOLLAR = '$';
    const ASTERISK = '*';
    const SPACE = ' ';
    const QUOTE = '\'';
    const SLASH = '\\';
    const METHOD_NAME_DELIMITER = '.';

    const TAB_SIZE = 2;
    const CONNECTION_TIMEOUT = 10;

    const COMMENT_START = '/**';
    const COMMENT_END = '**/';

    const USE = 'use';
    const VK_NAMESPACE = 'VK';
    const VK_ACTIONS = 'VK\Actions';

    const SCHEMA_LINK = 'https://raw.githubusercontent.com/VKCOM/vk-api-schema/master/';
    const METHODS_LINK = self::SCHEMA_LINK . 'methods.json';

    const ACTION_CLASS_NAMESPACE = 'VK\Actions';
    const USE_API_CLIENT = 'use VK\VKAPIClient;';

    private $response = null;
    private $api_client_use = '';
    private $api_client_members = '';
    private $api_client_construct_code = '';
    private $api_client_gets = '';
    private $api_client_member = null;

    protected function getSchemaResponse() {
        $curl = curl_init(static::METHODS_LINK);
        curl_setopt_array($curl, array(
            CURLOPT_CONNECTTIMEOUT => static::CONNECTION_TIMEOUT,
            CURLOPT_RETURNTRANSFER => true,
        ));
        $raw_response = curl_exec($curl);
        $this->response = json_decode($raw_response, true);
    }

    private static function tab($count) {
        return str_repeat(' ', static::TAB_SIZE * $count);
    }

    public function generate($actions_output_path = '../Actions/', $api_client_output_path = '../') {
        $this->getSchemaResponse();

        $mapped_methods = $this->mapMethods();
        ksort($mapped_methods);

        $this->api_client_member = $this->wrapClassMember('VKAPIClient', 'client');
        $this->api_client_members .= $this->api_client_member;
        $this->api_client_construct_code = $this->wrapConstructAssignment('client', 'new VKAPIClient()');

        foreach ($mapped_methods as $object_name => &$object_methods) {
            $class_name = ucwords($object_name);

            $this->updateAPIActionClientProperties($class_name, $object_name);

            $action_class_code = '';
            foreach ($object_methods as &$method) {
                $action_class_code .= $this->wrapActionMethod($method, $object_name);
            }

            $action_class_use = PHP_EOL . static::USE_API_CLIENT;
            $action_class_members = $this->api_client_member;
            $action_class_construct = $this->wrapConstruct('$client',
                $this->wrapConstructAssignment('client', '$client'));

            $action_class = $this->wrapClass($class_name, static::VK_ACTIONS, $action_class_use,
                $action_class_members, $action_class_construct, $action_class_code);

            $file_name = $actions_output_path . $class_name . '.php';
            file_put_contents($file_name, $action_class);
        }

        $api_client_class_name = 'VKAPIActionClient';
        $api_client_construct = $this->wrapConstruct('', $this->api_client_construct_code);

        $api_client_class = $this->wrapClass($api_client_class_name, static::VK_NAMESPACE,
            $this->api_client_use, $this->api_client_members, $api_client_construct, $this->api_client_gets);

        $file_name = $api_client_output_path . $api_client_class_name . '.php';

        file_put_contents($file_name, $api_client_class);
    }

    protected function mapMethods() {
        $mapped_methods = array();
        array_walk($this->response['methods'], function ($method) use (&$mapped_methods) {
            list($object_name, $method_name) = explode(static::METHOD_NAME_DELIMITER, $method['name']);
            if (!isset($mapped_methods[$object_name])) {
                $mapped_methods[$object_name] = array();
            }
            $method['name'] = $method_name;
            $mapped_methods[$object_name][] = $method;
        });
        return $mapped_methods;
    }

    protected function updateAPIActionClientProperties($class_name, $object_name) {
        $this->api_client_use .= $this->wrapActionClassUse($class_name);

        $this->api_client_members .= $this->wrapClassMember($class_name, $object_name);

        $value = 'new ' . $class_name . '(' . static::DOLLAR . 'this->client)';
        $this->api_client_construct_code .= $this->wrapConstructAssignment($object_name, $value);

        $this->api_client_gets .= $this->wrapGetActionMethod($object_name);
    }

    protected function wrapClass($name, $namespace, $use, $members, $construct, $code) {
        $result = '<?php' . PHP_EOL . PHP_EOL;
        $result .= 'namespace ' . $namespace . ';' . PHP_EOL;
        $result .= $use . PHP_EOL . PHP_EOL;
        $result .= 'class ' . $name . ' {' . $members . PHP_EOL . PHP_EOL;
        $result .= $construct;
        $result .= $code;
        $result .= PHP_EOL . '}' . PHP_EOL;
        return $result;
    }

    protected function wrapActionMethod($method, $object_name) {
        $add_params = function ($param) {
            $result = '';
            $need_space = false;
            if (isset($param['name'])) {
                $result .= $param['name'];
                $need_space = true;
            }
            if (isset($param['type'])) {
                if ($need_space) {
                    $result .= static::SPACE;
                }
                $result .= $param['type'];
                $need_space = true;
            }
            if (isset($param['description'])) {
                if ($need_space) {
                    $result .= static::SPACE;
                }
                $result .= $param['description'];
            }
            return $result;
        };

        $params = array();
        if (isset($method['parameters'])) {
            $params = array_map($add_params, $method['parameters']);
        }

        $result = PHP_EOL . PHP_EOL;

        $method_description = '';
        if (isset($method['description'])) {
            $method_description = $method['description'];
        }

        $result .= $this->wrapComment(array_merge(array($method_description, '', '@param $access_token string',
                '@param $params array'), $params, array('', '@return \VK\VKResponse',
                '@throws \VK\Exceptions\VKClientException', ''))) . PHP_EOL;

        $result .= $this->tab(1) . 'public function ' . $method['name'] . '(' . static::DOLLAR . 'access_token'
            . ', ' . static::DOLLAR . 'params = array()) {' . PHP_EOL;

        $result .= $this->tab(2) . 'return ' . static::DOLLAR . 'this->client->request('
            . static::QUOTE . $object_name . static::METHOD_NAME_DELIMITER . $method['name'] . static::QUOTE
            . ', ' . static::DOLLAR . 'access_token, ' . static::DOLLAR . 'params);' . PHP_EOL;

        $result .= $this->tab(1) . '}';

        return $result;
    }

    protected function wrapConstruct($params, $code) {
        $result = $this->tab(1) . 'public function __construct(' . $params . ') {';
        $result .= $code . PHP_EOL;
        $result .= $this->tab(1) . '}';
        return $result;
    }

    protected function wrapClassMember($type, $varName) {
        $result = PHP_EOL . $this->wrapComment(array('@var ' . $type));
        $result .= PHP_EOL;
        $result .= $this->tab(1) . 'private ' . static::DOLLAR . $varName . ';';
        return $result;
    }

    /**
     * @param array $comment
     *
     * @return string
     */
    protected function wrapComment($comment) {
        $result = $this->tab(1) . static::COMMENT_START;
        $format = function ($line) {
            return PHP_EOL . $this->tab(1) . static::SPACE . static::ASTERISK . static::SPACE . $line;
        };
        $result .= implode(array_map($format, $comment));
        $result .= PHP_EOL;
        $result .= $this->tab(1) . static::SPACE . static::COMMENT_END;
        return $result;
    }

    protected function wrapActionClassUse($class_name) {
        return PHP_EOL . static::USE . static::SPACE . static::VK_ACTIONS . static::SLASH . $class_name . ';';
    }

    protected function wrapConstructAssignment($varName, $value) {
        return PHP_EOL . $this->tab(2) . static::DOLLAR . 'this->' . $varName . ' = ' . $value . ';';
    }

    protected function wrapGetActionMethod($varName) {
        $result = PHP_EOL . PHP_EOL;
        $result .= $this->tab(1) . 'public function ' . $varName . '() {' . PHP_EOL;
        $result .= $this->tab(2) . 'return ' . static::DOLLAR . 'this->' . $varName . ';' . PHP_EOL;
        $result .= $this->tab(1) . '}';
        return $result;
    }
}