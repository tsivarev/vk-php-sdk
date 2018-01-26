<?php

namespace VK\Generators;

class GenerateActions {

    const DOLLAR = '$';
    const ASTERISK = '*';
    const SPACE = ' ';
    const SPACE3 = '   ';
    const QUOTE = '\'';
    const BACKSLASH = '\\';
    const SLASH = '/';
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

    const USE_KEYWORD = 'use';
    const NEW_KEYWORD = 'new ';
    const STATIC_KEYWORD = 'static::';
    const THIS_KEYWORD = 'this->';
    const RETURN_KEYWORD = 'return ';
    const VK_NAMESPACE = 'VK';
    const ACTIONS_KEYWORD = 'Actions';
    const ENUMS_KEYWORD = 'Enums';
    const USE_VK = self::USE_KEYWORD . self::SPACE . self::VK_NAMESPACE . self::BACKSLASH;
    const VK_ACTIONS = self::VK_NAMESPACE . self::BACKSLASH . self::ACTIONS_KEYWORD;
    const VK_ENUMS = self::VK_ACTIONS . self::BACKSLASH. self::ENUMS_KEYWORD;
    const API_REQUEST_VAR_NAME = 'request';
    const API_REQUEST_CLASS_NAME = 'VKAPIRequest';
    const AUTH_VAR_NAME = 'oauth';
    const AUTH_CLASS_NAME = 'OAuthClient';
    const VK_API_HOST = 'VK_API_HOST';
    const VK_API_VERSION = 'VK_API_VERSION';
    const VK_API_VERSION_VALUE = '5.69';
    const PHP_EXPANSION = '.php';
    const ACCESS_TOKEN_ARG_NAME = 'access_token';
    const PARAMS_ARG_NAME = 'params';

    const PARAM_NAME = 'name';
    const PARAM_DESCRIPTION = 'description';
    const PARAM_PARAMETERS = 'parameters';
    const PARAM_ENUM = 'enum';
    const PARAM_ENUM_NAMES = 'enumNames';
    const PARAM_TYPE = 'type';

    const SCHEMA_LINK = 'https://raw.githubusercontent.com/VKCOM/vk-api-schema/master/';
    const METHODS_LINK = self::SCHEMA_LINK . 'methods.json';
    const VK_API_HOST_LINK = 'https://api.vk.com/method';

    const SCHEMA_METHODS_PATH = '/vendor/vkcom/vk-api-schema/methods.json';

    const USE_VK_API_REQUEST = self::USE_VK . self::API_REQUEST_CLASS_NAME . ';';
    const USE_OAUTH_CLIENT = self::USE_VK .'OAuth' . self::BACKSLASH . self::AUTH_CLASS_NAME . ';';
    const USE_VK_CLIENT_EXCEPTION = self::USE_VK . 'Exceptions\VKClientException;';
    const USE_VK_API_EXCEPTION = self::USE_VK . 'Exceptions\VKAPIException;';

    private $response = null;
    private $enums_path = null;
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

    protected function getSchemaFromFile($path) {
        $methods = file_get_contents($path);
        $this->response = json_decode($methods, true);
    }

    private static function tab($count) {
        return str_repeat(' ', static::TAB_SIZE * $count);
    }

    private function checkDirPath($path) {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }

    public function generate($methods_path = null, $actions_output_path = null, $api_client_output_path = null) {
        if ($methods_path == null) {
            $methods_path = dirname(dirname(dirname(__DIR__))) .
                static::SCHEMA_METHODS_PATH;
        }
        $this->getSchemaFromFile($methods_path);

        if ($actions_output_path == null) {
            $actions_output_path = dirname(__DIR__) . static::SLASH . static::ACTIONS_KEYWORD . static::SLASH;
            $this->checkDirPath($actions_output_path);
        }

        if ($api_client_output_path == null) {
            $api_client_output_path = dirname(__DIR__) . static::SLASH;
            $this->checkDirPath($api_client_output_path);
        }

        $this->enums_path = dirname(__DIR__) . static::SLASH . static::ACTIONS_KEYWORD . static::SLASH .
            static::ENUMS_KEYWORD . static::SLASH;
        $this->checkDirPath($this->enums_path);

        $mapped_methods = $this->mapMethods();
        ksort($mapped_methods);

        $this->api_client_use = static::USE_OAUTH_CLIENT;

        $this->api_request_member = $this->wrapClassMember(self::API_REQUEST_CLASS_NAME, static::API_REQUEST_VAR_NAME);

        $this->api_client_members .= $this->wrapConstant(static::VK_API_HOST, static::VK_API_HOST_LINK, '');
        $this->api_client_members .= $this->wrapConstant(static::VK_API_VERSION, static::VK_API_VERSION_VALUE, '');
        $this->api_client_members .= $this->api_request_member;
        $this->api_client_members .= $this->wrapClassMember(self::AUTH_CLASS_NAME, static::AUTH_VAR_NAME);
        $this->api_client_construct_code = $this->wrapConstructAssignment(static::API_REQUEST_VAR_NAME,
            static::NEW_KEYWORD . self::API_REQUEST_CLASS_NAME .
            '(' . static::STATIC_KEYWORD . static::VK_API_HOST . ', ' . static::STATIC_KEYWORD . static::VK_API_VERSION .')');
        $this->api_client_construct_code .= $this->wrapConstructAssignment(static::AUTH_VAR_NAME,
            static::NEW_KEYWORD . self::AUTH_CLASS_NAME . '(' . static::STATIC_KEYWORD . static::VK_API_VERSION . ')');
        $this->api_client_gets = $this->wrapGetActionMethod(static::API_REQUEST_VAR_NAME);
        $this->api_client_gets .= $this->wrapGetActionMethod(static::AUTH_VAR_NAME);

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
            $action_class_construct = $this->wrapConstruct(static::DOLLAR . static::API_REQUEST_VAR_NAME,
                $this->wrapConstructAssignment(static::API_REQUEST_VAR_NAME,
                    static::DOLLAR . static::API_REQUEST_VAR_NAME));

            $action_class = $this->wrapClass($class_name, static::VK_ACTIONS, $action_class_use,
                $action_class_members, $action_class_construct, $action_class_code);

            $file_name = $actions_output_path . $class_name . static::PHP_EXPANSION;
            file_put_contents($file_name, $action_class);
        }

        $api_client_class_name = 'VKAPIClient';
        $api_client_construct = $this->wrapConstruct('', $this->api_client_construct_code);

        $api_client_class = $this->wrapClass($api_client_class_name, static::VK_NAMESPACE,
            $this->api_client_use, $this->api_client_members, $api_client_construct, $this->api_client_gets);

        $file_name = $api_client_output_path . $api_client_class_name . static::PHP_EXPANSION;

        file_put_contents($file_name, $api_client_class);

        echo 'SDK is generated.' . PHP_EOL;
    }

    protected function mapMethods() {
        $mapped_methods = array();
        array_walk($this->response['methods'], function ($method) use (&$mapped_methods) {
            list($action_name, $method_name) = explode(static::METHOD_NAME_DELIMITER, $method[static::PARAM_NAME]);
            if (!isset($mapped_methods[$action_name])) {
                $mapped_methods[$action_name] = array();
            }
            $method[static::PARAM_NAME] = $method_name;
            $mapped_methods[$action_name][] = $method;
        });
        return $mapped_methods;
    }

    protected function updateAPIActionClientProperties($class_name, $action_name) {
        $this->api_client_use .= $this->wrapActionClassUse($class_name);

        $this->api_client_members .= $this->wrapClassMember($class_name, $action_name);

        $value = static::NEW_KEYWORD . $class_name . '(' . static::DOLLAR . static::THIS_KEYWORD . static::API_REQUEST_VAR_NAME . ')';
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
        $method_name = $method[static::PARAM_NAME];
        $add_params = function ($param) use (&$action_name, &$method_name) {
            $result = static::SPACE . $this->tab(1) . static::DASH . static::SPACE;
            $need_space = false;

            if (isset($param[static::PARAM_ENUM])) {
                $enum_name = $this->createParameterEnum($param, $param[static::PARAM_NAME], $method_name, $action_name);
                $result .= $enum_name;
                $description_end = '@see ' . $enum_name;
                $need_space = true;
            } else if (isset($param[static::PARAM_TYPE])) {
                $result .= $param[static::PARAM_TYPE];
                $need_space = true;
            }
            if (isset($param[static::PARAM_NAME])) {
                if ($need_space) {
                    $result .= static::SPACE;
                }
                $result .= $param[static::PARAM_NAME];
                $need_space = true;
            }

            $result .= static::COLON;

            if (isset($param[static::PARAM_DESCRIPTION])) {
                if ($need_space) {
                    $result .= static::SPACE;
                }
                $result .= $param[static::PARAM_DESCRIPTION];
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
        if (isset($method[static::PARAM_PARAMETERS]) && $method[static::PARAM_PARAMETERS] !== array()) {
            $params = array_map($add_params, $method[static::PARAM_PARAMETERS]);
            $params = call_user_func_array('array_merge', $params);
        }

        $result = PHP_EOL . PHP_EOL;

        $method_description = '';
        if (isset($method[static::PARAM_DESCRIPTION])) {
            $method_description = $method[static::PARAM_DESCRIPTION];
        }

        $method_description = wordwrap($method_description, static::LINE_LENGTH_DESCRIPTION);
        $method_description_array = explode(PHP_EOL, $method_description);

        $result .= $this->wrapComment(array_merge($method_description_array, array('', '@param ' . static::DOLLAR .
        static::ACCESS_TOKEN_ARG_NAME . ' string', '@param ' . static::DOLLAR .
            static::PARAMS_ARG_NAME . ' array'), $params, array('', '@return mixed',
                '@throws VKClientException in case of error on the API side',
                '@throws VKAPIException in case of network error', ''))) . PHP_EOL;

        $result .= $this->tab(1) . 'public function ' . $method_name . '(' . static::DOLLAR . static::ACCESS_TOKEN_ARG_NAME
            . ', ' . static::DOLLAR . static::PARAMS_ARG_NAME . ' = array()) {' . PHP_EOL;

        $result .= $this->tab(2) . static::RETURN_KEYWORD . static::DOLLAR . static::THIS_KEYWORD .
            static::API_REQUEST_VAR_NAME . '->post(' . static::QUOTE . $action_name . static::METHOD_NAME_DELIMITER .
            $method[static::PARAM_NAME] . static::QUOTE . ', ' . static::DOLLAR . static::ACCESS_TOKEN_ARG_NAME .
            ', ' . static::DOLLAR . static::PARAMS_ARG_NAME . ');' . PHP_EOL;

        $result .= $this->tab(1) . '}';

        return $result;
    }

    protected function createParameterEnum($param, $parameter_name, $method_name, $action_name) {
        $enum_name = $this->buildEnumName($parameter_name, $method_name, $action_name);

        $enum_members = $this->createEnumClassMembers($param);
        $enum_class = $this->wrapClass($enum_name, static::VK_ENUMS, null, $enum_members,
            null, null);

        $filename = $this->enums_path . $enum_name . static::PHP_EXPANSION;
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
        $enum = $param[static::PARAM_ENUM];
        $enum_names = array();
        if (isset($param[static::PARAM_ENUM_NAMES])) {
            $enum_names = $param[static::PARAM_ENUM_NAMES];
        }
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
        $result = PHP_EOL . $this->tab(1) . 'const ' . $name . ' = ' . static::QUOTE . $value . static::QUOTE . ';';
        if ($description) {
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
        return PHP_EOL . static::USE_KEYWORD . static::SPACE . static::VK_ACTIONS . static::BACKSLASH . $class_name . ';';
    }

    protected function wrapConstructAssignment($varName, $value) {
        return PHP_EOL . $this->tab(2) . static::DOLLAR . static::THIS_KEYWORD . $varName . ' = ' . $value . ';';
    }

    protected function wrapGetActionMethod($var_name) {
        $result = PHP_EOL . PHP_EOL;
        $result .= $this->tab(1) . 'public function ' . $var_name . '() {' . PHP_EOL;
        $result .= $this->tab(2) . static::RETURN_KEYWORD . static::DOLLAR . static::THIS_KEYWORD . $var_name . ';' . PHP_EOL;
        $result .= $this->tab(1) . '}';
        return $result;
    }

    protected function addActionEnumsToUse($action_methods, $action_name) {
        $result = '';
        foreach ($action_methods as &$method) {
            if (isset($method[static::PARAM_PARAMETERS])) {
                $params = $method[static::PARAM_PARAMETERS];
                foreach ($params as &$param) {
                    if (isset($param[static::PARAM_ENUM])) {
                        $result .= PHP_EOL . static::USE_KEYWORD . static::SPACE . static::VK_ENUMS . static::BACKSLASH .
                            $this->buildEnumName($param[static::PARAM_NAME], $method[static::PARAM_NAME], $action_name) . ';';
                    }
                }
            }
        }
        return $result;
    }
}