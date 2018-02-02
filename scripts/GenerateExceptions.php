<?php

class GenerateExceptions {

    protected const SPACE = ' ';
    protected const UNDERSCORE = '_';
    protected const COLON = ':';
    protected const COMMA = ', ';
    protected const QUOTE = '\'';
    protected const CLOSING_BRACKET = '}';

    protected const TAB_SIZE = 4;

    protected const ERRORS_KEY = 'errors';
    protected const NAME_KEY = 'name';
    protected const CODE_KEY = 'code';
    protected const DESCRIPTION_KEY = 'description';
    protected const PHP = '.php';
    protected const EXCEPTION_MAPPER = 'ExceptionMapper';

    protected const VK_API_EXCEPTION = 'VKApiException';
    protected const NAMESPACE_API = 'VK\Exceptions\Api';

    protected const SCHEMA_PATH = '/vendor/vkcom/vk-api-schema/methods.json';
    protected const EXCEPTIONS_PATH = '/src/VK/Exceptions/Api/';

    protected $response = null;

    protected function getSchemaFromFile(string $path) {
        $schema = file_get_contents($path);
        $this->response = json_decode($schema, true);
    }

    private static function tab(int $count) {
        return str_repeat(' ', static::TAB_SIZE * $count);
    }

    public function generate(string $schema_path = null, string $exceptions_path = null, string $mapper_path = null) {
        if ($schema_path == null) {
            $schema_path = (dirname(__DIR__)) .
                static::SCHEMA_PATH;
        }

        if ($exceptions_path == null) {
            $exceptions_path = dirname(__DIR__) . static::EXCEPTIONS_PATH;
        }

        if ($mapper_path == null) {
            $mapper_path = $exceptions_path;
        }

        $this->getSchemaFromFile($schema_path);

        $errors = $this->response[static::ERRORS_KEY];

        $switch_content = '';

        foreach ($errors as $error) {
            $name = $error[static::NAME_KEY];
            $code = $error[static::CODE_KEY];
            $description = $error[static::DESCRIPTION_KEY];

            $class_name = str_replace(static::SPACE, '',
                ucwords(str_replace(static::UNDERSCORE, static::SPACE, strtolower($name))));
            $class_name = str_replace('Error', '', $class_name);
            $class_name .= 'Exception';

            $switch_content .= $this->wrapSwitchCase($code, $class_name);

            $exception_construct = $this->wrapExceptionConstruct($code, $description);

            $exception_content = $this->wrapClass($class_name, static::NAMESPACE_API, null,
                static::VK_API_EXCEPTION, null, $exception_construct, null);

            file_put_contents($exceptions_path . $class_name . static::PHP, $exception_content);
        }

        $mapper_code = PHP_EOL . $this->buildParseFunction($switch_content);

        $mapper_content = $this->wrapClass(static::EXCEPTION_MAPPER, static::NAMESPACE_API,
            'use VK\CLient\VKApiError;', null, null, null, $mapper_code);

        file_put_contents($mapper_path . static::EXCEPTION_MAPPER . static::PHP, $mapper_content);
    }

    protected function wrapSwitchCase(int $code, string $class_name) {
        $result = $this->tab(3) . 'case ' . $code . '' . static::COLON . PHP_EOL;
        $result .= $this->tab(4)  . 'return new ' . $class_name . '($error->getErrorMsg());' . PHP_EOL;
        return $result;
    }

    protected function wrapClass($name, $namespace, $use, $extends, $members, $construct, $code) {
        $result = '<?php' . PHP_EOL . PHP_EOL;
        if (isset($namespace)) {
            $result .= 'namespace ' . $namespace . ';' . PHP_EOL;
        }
        if (isset($use)) {
            $result .= PHP_EOL . $use . PHP_EOL;
        }
        $result .= PHP_EOL . 'class ' . $name;
        if (isset($extends)) {
            $result .= ' extends ' . $extends;
        }
        $result .= ' {';
        if (isset($members)) {
            $result .= $members;
        }
        if (isset($construct)) {
            $result .= PHP_EOL . $construct;
        }
        if (isset($code)) {
            $result .= $code;
        }
        $result .= PHP_EOL . static::CLOSING_BRACKET . PHP_EOL;
        return $result;
    }

    protected function wrapExceptionConstruct(int $code, string $description) {
        $result = $this->tab(1) . 'public function __construct($message) {';
        $result .= PHP_EOL . $this->tab(2) . 'parent::__construct(' . $code . static::COMMA . static::SPACE;
        $result .= static::QUOTE . $description . static::QUOTE . static::COMMA . static::SPACE . '$message);';
        $result .= PHP_EOL . $this->tab(1) . static::CLOSING_BRACKET;
        return $result;
    }

    protected function buildParseFunction($switch_content) {
        $result = $this->tab(1) . 'public function parse(VKApiError $error) {';
        $result .= PHP_EOL . $this->tab(2) . 'switch($error->getErrorCode()) {';
        $result .= PHP_EOL . $switch_content;
        $result .= PHP_EOL . $this->tab(2) . static::CLOSING_BRACKET;
        $result .= PHP_EOL . $this->tab(1) . static::CLOSING_BRACKET;
        return $result;
    }
}