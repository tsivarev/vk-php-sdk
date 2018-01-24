<?php

namespace VK\Generators;

class GenerateActions {

    const DOLLAR = '$';
    const ASTERISK = '*';
    const SPACE = ' ';
    const SPACE3 = '   ';
    const QUOTE = '\'';
    const SLASH = '\\';
    const METHOD_NAME_DELIMITER = '.';
    const DASH = '-';
    const COLON = ':';
    const UNDERSCORE = '_';

    const TAB_SIZE = 4;
    const CONNECTION_TIMEOUT = 10;
    const LINE_LENGTH_PARAMETER = 108;
    const LINE_LENGTH_DESCRIPTION = 112;

    const COMMENT_START = '/**';
    const COMMENT_END = '**/';

    const USE = 'use';
    const VK_NAMESPACE = 'VK';
    const VK_ACTIONS = 'VK\Actions';
    const VK_ENUMS = 'VK\Actions\Enums';
    const PATH_ENUMS = '../Actions/Enums/';

    const SCHEMA_LINK = 'https://raw.githubusercontent.com/VKCOM/vk-api-schema/master/';
    const METHODS_LINK = self::SCHEMA_LINK . 'methods.json';

    const ACTION_CLASS_NAMESPACE = 'VK\Actions';
    const USE_VK_API_REQUEST = 'use VK\VKAPIRequest;';
    const USE_VK_CLIENT_EXCEPTION = 'use VK\Exceptions\VKClientException;';
    const USE_VK_API_EXCEPTION = 'use VK\Exceptions\VKAPIException;';
    private $response = null;
    private $api_client_use = '';
    private $api_client_members = '';
    private $api_client_construct_code = '';
    private $api_client_gets = '';
    private $api_request_member = null;

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

        $this->api_request_member = $this->wrapClassMember('VKAPIRequest', 'client');

        $this->api_client_members .= $this->wrapConstant('VK_API_HOST', 'https://api.vk.com/method', '');
        $this->api_client_members .= $this->api_request_member;
        $this->api_client_construct_code = $this->wrapConstructAssignment('client',
            'new VKAPIRequest(static::VK_API_HOST)');

        foreach ($mapped_methods as $action_name => &$action_methods) {
            $class_name = ucwords($action_name);

            $this->updateAPIActionClientProperties($class_name, $action_name);

            $action_class_code = '';
            foreach ($action_methods as &$method) {
                $action_class_code .= $this->wrapActionMethod($method, $action_name);
            }

            $action_class_use = PHP_EOL . static::USE_VK_API_REQUEST;
            $action_class_use .= PHP_EOL . static::USE_VK_CLIENT_EXCEPTION;
            $action_class_use .= PHP_EOL . static::USE_VK_API_EXCEPTION;
            $action_class_use .= $this->addActionEnumsToUse($action_methods, $action_name);
            $action_class_members = $this->api_request_member;
            $action_class_construct = $this->wrapConstruct('$client',
                $this->wrapConstructAssignment('client', '$client'));

            $action_class = $this->wrapClass($class_name, static::VK_ACTIONS, $action_class_use,
                $action_class_members, $action_class_construct, $action_class_code);

            $file_name = $actions_output_path . $class_name . '.php';
            file_put_contents($file_name, $action_class);
        }

        $api_client_class_name = 'VKAPIClient';
        $api_client_construct = $this->wrapConstruct('', $this->api_client_construct_code);

        $api_client_class = $this->wrapClass($api_client_class_name, static::VK_NAMESPACE,
            $this->api_client_use, $this->api_client_members, $api_client_construct, $this->api_client_gets);

        $file_name = $api_client_output_path . $api_client_class_name . '.php';

        file_put_contents($file_name, $api_client_class);
    }

    protected function mapMethods() {
        $mapped_methods = array();
        array_walk($this->response['methods'], function ($method) use (&$mapped_methods) {
            list($action_name, $method_name) = explode(static::METHOD_NAME_DELIMITER, $method['name']);
            if (!isset($mapped_methods[$action_name])) {
                $mapped_methods[$action_name] = array();
            }
            $method['name'] = $method_name;
            $mapped_methods[$action_name][] = $method;
        });
        return $mapped_methods;
    }

    protected function updateAPIActionClientProperties($class_name, $action_name) {
        $this->api_client_use .= $this->wrapActionClassUse($class_name);

        $this->api_client_members .= $this->wrapClassMember($class_name, $action_name);

        $value = 'new ' . $class_name . '(' . static::DOLLAR . 'this->client)';
        $this->api_client_construct_code .= $this->wrapConstructAssignment($action_name, $value);

        $this->api_client_gets .= $this->wrapGetActionMethod($action_name);
    }

    protected function wrapClass($name, $namespace, $use, $members, $construct, $code) {
        $result = '<?php' . PHP_EOL . PHP_EOL;
        if (isset($namespace)) {
            $result .= 'namespace ' . $namespace . ';' . PHP_EOL;
        }
        if (isset($use)) {
            $result .= $use . PHP_EOL;
        }
        $result .= PHP_EOL . 'class ' . $name . ' {';
        if (isset($members)) {
            $result .= $members;
        }
        if (isset($construct)) {
            $result .= PHP_EOL . PHP_EOL . $construct;
        }
        if (isset($code)) {
            $result .= $code;
        }
        $result .= PHP_EOL . '}' . PHP_EOL;
        return $result;
    }

    protected function wrapActionMethod($method, $action_name) {
        $method_name = $method['name'];
        $add_params = function ($param) use (&$action_name, &$method_name) {
            $result = static::SPACE . $this->tab(1) . static::DASH . static::SPACE;
            $need_space = false;

            if (isset($param['enum'])) {
                $enum_name = $this->createParameterEnum($param, $param['name'], $method_name, $action_name);
                $result .= $enum_name;
                $description_end = '@see ' . $enum_name;
                $need_space = true;
            } else if (isset($param['type'])) {
                $result .= $param['type'];
                $need_space = true;
            }
            if (isset($param['name'])) {
                if ($need_space) {
                    $result .= static::SPACE;
                }
                $result .= $param['name'];
                $need_space = true;
            }

            $result .= static::COLON;

            if (isset($param['description'])) {
                if ($need_space) {
                    $result .= static::SPACE;
                }
                $result .= $param['description'];
            }
            $result = wordwrap($result, static::LINE_LENGTH_PARAMETER, PHP_EOL .
                $this->tab(1) . static::SPACE3);
            $result = explode(PHP_EOL, $result);
            if (isset($description_end)) {
                $result[] = $this->tab(1) . static::SPACE3 . $description_end;
            }
            return $result;
        };

        $params = array();
        if (isset($method['parameters']) && $method['parameters'] !== array()) {
            $params = array_map($add_params, $method['parameters']);
            $params = call_user_func_array('array_merge', $params);
        }

        $result = PHP_EOL . PHP_EOL;

        $method_description = '';
        if (isset($method['description'])) {
            $method_description = $method['description'];
        }

        $method_description = wordwrap($method_description, static::LINE_LENGTH_DESCRIPTION);
        $method_description_array = explode(PHP_EOL, $method_description);

        $result .= $this->wrapComment(array_merge($method_description_array, array('', '@param $access_token string',
                '@param $params array'), $params, array('', '@return mixed',
                '@throws VKClientException error on the API side', '@throws VKAPIException network error', ''))) . PHP_EOL;

        $result .= $this->tab(1) . 'public function ' . $method_name . '(' . static::DOLLAR . 'access_token'
            . ', ' . static::DOLLAR . 'params = array()) {' . PHP_EOL;

        $result .= $this->tab(2) . 'return ' . static::DOLLAR . 'this->client->post('
            . static::QUOTE . $action_name . static::METHOD_NAME_DELIMITER . $method['name'] . static::QUOTE
            . ', ' . static::DOLLAR . 'access_token, ' . static::DOLLAR . 'params);' . PHP_EOL;

        $result .= $this->tab(1) . '}';

        return $result;
    }

    protected function createParameterEnum($param, $parameter_name, $method_name, $action_name) {
        $enum_name = $this->buildEnumName($parameter_name, $method_name, $action_name);

        $enum_members = $this->createEnumClassMembers($param);
        $enum_class = $this->wrapClass($enum_name, static::VK_ENUMS, null, $enum_members,
            null, null);

        $filename = static::PATH_ENUMS . $enum_name . '.php';
        file_put_contents($filename, $enum_class);

        return $enum_name;
    }

    protected function buildEnumName($parameter_name, $method_name, $action_name) {
        $result = ucwords($action_name) . ucwords($method_name);
        $result .= str_replace(static::SPACE, '', ucwords(str_replace(static::UNDERSCORE,
            static::SPACE, $parameter_name)));
        return $result;
    }

    protected function createEnumClassMembers($param) {
        $members = '';
        $enum = $param['enum'];
        $enum_names = $param['enumNames'];
        for ($i = 0; $i < count($enum); $i++) {
            $value = $enum[$i];
            $description = $enum_names ? $enum_names[$i] : null;
            $members .= $this->wrapConstant(strtoupper($value), $value, $description);
        }
        return $members;
    }

    protected function wrapConstant($name, $value, $description) {
        if (is_numeric($name[0])) {
            $name = str_replace(static::SPACE, static::UNDERSCORE, strtoupper($description));
        }
        $result = PHP_EOL . $this->tab(1) . 'const ' . $name . ' = \'' . $value . '\';';
        if ($description){
            $result .= ' // ' . $description;
        }
        return $result;
    }

    protected function wrapConstruct($params, $code) {
        $result = $this->tab(1) . 'public function __construct(' . $params . ') {';
        $result .= $code . PHP_EOL;
        $result .= $this->tab(1) . '}';
        return $result;
    }

    protected function wrapClassMember($type, $var_name) {
        $result = PHP_EOL . PHP_EOL . $this->wrapComment(array('@var ' . $type));
        $result .= PHP_EOL;
        $result .= $this->tab(1) . 'private ' . static::DOLLAR . $var_name . ';';
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

    protected function wrapGetActionMethod($var_name) {
        $result = PHP_EOL . PHP_EOL;
        $result .= $this->tab(1) . 'public function ' . $var_name . '() {' . PHP_EOL;
        $result .= $this->tab(2) . 'return ' . static::DOLLAR . 'this->' . $var_name . ';' . PHP_EOL;
        $result .= $this->tab(1) . '}';
        return $result;
    }
    
    protected function addActionEnumsToUse($action_methods, $action_name) {
        $result = '';
        foreach ($action_methods as &$method) {
            if (isset($method['parameters'])) {
                $params = $method['parameters'];
                foreach ($params as &$param) {
                    if (isset($param['enum'])) {
                        $result .= PHP_EOL . static::USE . static::SPACE . static::VK_ENUMS . static::SLASH .
                            $this->buildEnumName($param['name'], $method['name'], $action_name) . ';';
                    }
                }
            }
        }
        return $result;
    }
}