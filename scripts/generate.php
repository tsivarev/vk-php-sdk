<?php

require_once('GenerateActions.php');
require_once('GenerateExceptions.php');

$gen_actions = new GenerateActions();
$gen_actions->generate();

$gen_exceptions = new GenerateExceptions();
$gen_exceptions->initSchemaFromFile();
$gen_exceptions->generate();

$schema = file_get_contents(dirname(__DIR__) . '/vendor/vkcom/vk-api-schema/methods.json');
$schema = json_decode($schema, true);

foreach ($schema['methods'] as $method) {
    if (isset($method['errors'])) {
        $gen_exceptions->initSchemaFromJson($method);
        $gen_exceptions->generate();
    }
}

$gen_exceptions->writeMapper();