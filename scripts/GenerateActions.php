<?php

class GenerateActions {

    protected const DOLLAR = '$';
    protected const ASTERISK = '*';
    protected const SPACE = ' ';
    protected const SPACE3 = '   ';
    protected const QUOTE = '\'';
    protected const BACKSLASH = '\\';
    protected const SLASH = '/';
    protected const METHOD_NAME_DELIMITER = '.';
    protected const DASH = '-';
    protected const COLON = ':';
    protected const UNDERSCORE = '_';

    protected const TAB_SIZE = 4;
    protected const CONNECTION_TIMEOUT = 10;
    protected const LINE_LENGTH_PARAMETER = 108;
    protected const LINE_LENGTH_DESCRIPTION = 112;

    protected const COMMENT_START = '/**';
    protected const COMMENT_END = '**/';

    protected const METHODS_KEYWORD = 'methods';
    protected const USE_KEYWORD = 'use';
    protected const NEW_KEYWORD = 'new ';
    protected const STATIC_KEYWORD = 'static::';
    protected const THIS_KEYWORD = 'this->';
    protected const RETURN_KEYWORD = 'return ';
    protected const VK_NAMESPACE = 'VK';
    protected const ACTIONS_KEYWORD = 'Actions';
    protected const ENUMS_KEYWORD = 'Enums';
    protected const CLIENT_KEYWORD = 'Client';
    protected const USE_VK = self::USE_KEYWORD . self::SPACE . self::VK_NAMESPACE . self::BACKSLASH;
    protected const VK_ACTIONS = self::VK_NAMESPACE . self::BACKSLASH . self::ACTIONS_KEYWORD;
    protected const VK_ENUMS = self::VK_ACTIONS . self::BACKSLASH. self::ENUMS_KEYWORD;
    protected const VK_CLIENT = self::VK_NAMESPACE . self::BACKSLASH. self::CLIENT_KEYWORD;
    protected const API_REQUEST_VAR_NAME = 'request';
    protected const API_REQUEST_CLASS_NAME = 'VKApiRequest';
    protected const AUTH_VAR_NAME = 'oauth';
    protected const AUTH_CLASS_NAME = 'OAuthClient';
    protected const VK_API_HOST = 'VK_API_HOST';
    protected const VK_API_VERSION = 'VK_API_VERSION';
    protected const VK_API_VERSION_VALUE = '5.69';
    protected const PHP_EXPANSION = '.php';
    protected const ACCESS_TOKEN_ARG_NAME = 'access_token';
    protected const PARAMS_ARG_NAME = 'params';

    protected const NAME_KEY = 'name';
    protected const DESCRIPTION_KEY = 'description';
    protected const PARAMETERS_KEY = 'parameters';
    protected const ENUM_KEY = 'enum';
    protected const ENUM_NAMES_KEY = 'enumNames';
    protected const TYPE_KEY = 'type';

    protected const SCHEMA_LINK = 'https://raw.githubusercontent.com/VKCOM/vk-api-schema/master/';
    protected const METHODS_LINK = self::SCHEMA_LINK . 'methods.json';
    protected const VK_API_HOST_LINK = 'https://api.vk.com/method';

    protected const SCHEMA_PATH = '/vendor/vkcom/vk-api-schema/methods.json';
    protected const SRC_VK = '/src/VK/';

    protected const USE_VK_API_REQUEST = self::USE_VK . self::CLIENT_KEYWORD . self::BACKSLASH . self::API_REQUEST_CLASS_NAME . ';';
    protected const USE_OAUTH_CLIENT = self::USE_VK .'OAuth' . self::BACKSLASH . self::AUTH_CLASS_NAME . ';';
    protected const USE_VK_CLIENT_EXCEPTION = self::USE_VK . 'Exceptions\VKClientException;';
    protected const USE_VK_API_EXCEPTION = self::USE_VK . 'Exceptions\Api\VKApiException;';

    protected $response = null;
    protected $enums_path = null;
    protected $api_client_use = '';
    protected $api_client_members = '';
    protected $api_client_construct_code = '';
    protected $api_client_gets = '';
    protected $api_request_member = null;

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
        $schema = file_get_contents($path);
        $this->response = json_decode($schema, true);
    }

    private static function tab($count) {
        return str_repeat(' ', static::TAB_SIZE * $count);
    }

    private function checkDirPath($path) {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }

    public function generate($schema_path = null, $actions_output_path = null, $api_client_output_path = null) {
        if ($schema_path == null) {
            $schema_path = (dirname(__DIR__)) .
                static::SCHEMA_PATH;
        }
        $this->getSchemaFromFile($schema_path);

        if ($actions_output_path == null) {
            $actions_output_path = dirname(__DIR__) . static::SRC_VK . static::ACTIONS_KEYWORD . static::SLASH;
            $this->checkDirPath($actions_output_path);
        }

        if ($api_client_output_path == null) {
            $api_client_output_path = dirname(__DIR__) . static::SRC_VK . static::CLIENT_KEYWORD . static::SLASH;
            $this->checkDirPath($api_client_output_path);
        }

        $this->enums_path = dirname(__DIR__) . static::SRC_VK . static::ACTIONS_KEYWORD . static::SLASH .
            static::ENUMS_KEYWORD . static::SLASH;
        $this->checkDirPath($this->enums_path);

        $mapped_methods = $this->mapMethods();
        ksort($mapped_methods);

        $this->api_client_use = PHP_EOL . static::USE_OAUTH_CLIENT;

        $this->api_request_member = $this->wrapClassMember(self::API_REQUEST_CLASS_NAME, static::API_REQUEST_VAR_NAME);

        $this->api_client_members .= $this->wrapConstant(static::VK_API_HOST, static::VK_API_HOST_LINK,
            '', 'protected ');
        $this->api_client_members .= $this->wrapConstant(static::VK_API_VERSION, static::VK_API_VERSION_VALUE,
            '', 'protected ');
        $this->api_client_members .= $this->api_request_member;
        $this->api_client_members .= $this->wrapClassMember(self::AUTH_CLASS_NAME, static::AUTH_VAR_NAME);
        $this->api_client_construct_code = $this->wrapConstructAssignment(static::API_REQUEST_VAR_NAME,
            static::NEW_KEYWORD . self::API_REQUEST_CLASS_NAME .
            '(' . static::STATIC_KEYWORD . static::VK_API_HOST . ', ' . '$api_version' .')');
        $this->api_client_construct_code .= $this->wrapConstructAssignment(static::AUTH_VAR_NAME,
            static::NEW_KEYWORD . self::AUTH_CLASS_NAME . '(' . static::STATIC_KEYWORD . static::VK_API_VERSION . ')');
        $this->api_client_gets = $this->wrapGetActionMethod(static::API_REQUEST_VAR_NAME);
        $this->api_client_gets .= $this->wrapGetActionMethod(static::AUTH_VAR_NAME);

        foreach ($mapped_methods as $action_name => &$action_methods) {
            $class_name = ucwords($action_name);

            $this->updateApiActionClientProperties($class_name, $action_name);

            $action_class_code = '';
            foreach ($action_methods as &$method) {
                $action_class_code .= $this->wrapActionMethod($method, $action_name);
            }

            $action_class_use = PHP_EOL . static::USE_VK_API_REQUEST;
            $action_class_use .= PHP_EOL . static::USE_VK_CLIENT_EXCEPTION;
            $action_class_use .= PHP_EOL . static::USE_VK_API_EXCEPTION;
            $action_class_use .= $this->addActionEnumsToUse($action_methods, $action_name);
            $action_class_members = $this->api_request_member;
            $action_class_construct = $this->wrapConstruct(static::API_REQUEST_CLASS_NAME . static::SPACE .
                static::DOLLAR . static::API_REQUEST_VAR_NAME,
                $this->wrapConstructAssignment(static::API_REQUEST_VAR_NAME,
                    static::DOLLAR . static::API_REQUEST_VAR_NAME));

            $action_class = $this->wrapClass($class_name, static::VK_ACTIONS, $action_class_use,
                $action_class_members, $action_class_construct, $action_class_code);

            $file_name = $actions_output_path . $class_name . static::PHP_EXPANSION;
            file_put_contents($file_name, $action_class);
        }

        $api_client_class_name = 'VKApiClient';
        $api_client_construct = $this->wrapConstruct('string $api_version = self::VK_API_VERSION', $this->api_client_construct_code);

        $api_client_class = $this->wrapClass($api_client_class_name, static::VK_CLIENT,
            $this->api_client_use, $this->api_client_members, $api_client_construct, $this->api_client_gets);

        $file_name = $api_client_output_path . $api_client_class_name . static::PHP_EXPANSION;

        file_put_contents($file_name, $api_client_class);

        echo 'SDK is generated.' . PHP_EOL;
    }

    protected function mapMethods() {
        $mapped_methods = array();
        array_walk($this->response[static::METHODS_KEYWORD], function ($method) use (&$mapped_methods) {
            list($action_name, $method_name) = explode(static::METHOD_NAME_DELIMITER, $method[static::NAME_KEY]);
            if (!isset($mapped_methods[$action_name])) {
                $mapped_methods[$action_name] = array();
            }
            $method[static::NAME_KEY] = $method_name;
            $mapped_methods[$action_name][] = $method;
        });
        return $mapped_methods;
    }

    protected function updateApiActionClientProperties($class_name, $action_name) {
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
        $method_name = $method[static::NAME_KEY];
        $add_params = function ($param) use (&$action_name, &$method_name) {
            $result = static::SPACE . $this->tab(1) . static::DASH . static::SPACE;
            $need_space = false;

            if (isset($param[static::ENUM_KEY])) {
                $enum_name = $this->createParameterEnum($param, $param[static::NAME_KEY], $method_name, $action_name);
                $result .= $enum_name;
                $description_end = '@see ' . $enum_name;
                $need_space = true;
            } else if (isset($param[static::TYPE_KEY])) {
                $result .= $param[static::TYPE_KEY];
                $need_space = true;
            }
            if (isset($param[static::NAME_KEY])) {
                if ($need_space) {
                    $result .= static::SPACE;
                }
                $result .= $param[static::NAME_KEY];
                $need_space = true;
            }

            $result .= static::COLON;

            if (isset($param[static::DESCRIPTION_KEY])) {
                if ($need_space) {
                    $result .= static::SPACE;
                }
                $result .= $param[static::DESCRIPTION_KEY];
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
        if (isset($method[static::PARAMETERS_KEY]) && $method[static::PARAMETERS_KEY] !== array()) {
            $params = array_map($add_params, $method[static::PARAMETERS_KEY]);
            $params = call_user_func_array('array_merge', $params);
        }

        $result = PHP_EOL . PHP_EOL;

        $method_description = '';
        if (isset($method[static::DESCRIPTION_KEY])) {
            $method_description = $method[static::DESCRIPTION_KEY];
        }

        $method_description = wordwrap($method_description, static::LINE_LENGTH_DESCRIPTION);
        $method_description_array = explode(PHP_EOL, $method_description);

        $result .= $this->wrapComment(array_merge($method_description_array, array('', '@param ' . static::DOLLAR .
        static::ACCESS_TOKEN_ARG_NAME . ' string', '@param ' . static::DOLLAR .
            static::PARAMS_ARG_NAME . ' array'), $params, array('', '@return mixed',
                '@throws VKClientException in case of error on the Api side',
                '@throws VKApiException in case of network error', ''))) . PHP_EOL;

        $result .= $this->tab(1) . 'public function ' . $method_name . '(string ' . static::DOLLAR . static::ACCESS_TOKEN_ARG_NAME
            . ', array ' . static::DOLLAR . static::PARAMS_ARG_NAME . ' = array()) {' . PHP_EOL;

        $result .= $this->tab(2) . static::RETURN_KEYWORD . static::DOLLAR . static::THIS_KEYWORD .
            static::API_REQUEST_VAR_NAME . '->post(' . static::QUOTE . $action_name . static::METHOD_NAME_DELIMITER .
            $method[static::NAME_KEY] . static::QUOTE . ', ' . static::DOLLAR . static::ACCESS_TOKEN_ARG_NAME .
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
        $enum = $param[static::ENUM_KEY];
        $enum_names = array();
        if (isset($param[static::ENUM_NAMES_KEY])) {
            $enum_names = $param[static::ENUM_NAMES_KEY];
        }
        for ($i = 0; $i < count($enum); $i++) {
            $value = $enum[$i];
            $description = $enum_names ? $enum_names[$i] : null;
            $members .= $this->wrapConstant(strtoupper($value), $value, $description);
        }
        return $members;
    }

    protected function wrapConstant($name, $value, $description, $type = '') {
        if (is_numeric($name[0])) {
            $name = str_replace(static::SPACE, static::UNDERSCORE, strtoupper($description));
        }
        $result = PHP_EOL . $this->tab(1) . $type . 'const ' . $name . ' = ' . static::QUOTE . $value . static::QUOTE . ';';
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
            if (isset($method[static::PARAMETERS_KEY])) {
                $params = $method[static::PARAMETERS_KEY];
                foreach ($params as &$param) {
                    if (isset($param[static::ENUM_KEY])) {
                        $result .= PHP_EOL . static::USE_KEYWORD . static::SPACE . static::VK_ENUMS . static::BACKSLASH .
                            $this->buildEnumName($param[static::NAME_KEY], $method[static::NAME_KEY], $action_name) . ';';
                    }
                }
            }
        }
        return $result;
    }
}
