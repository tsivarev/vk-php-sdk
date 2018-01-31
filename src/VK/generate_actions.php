<?php

require_once(dirname(dirname(__DIR__)) . '/vendor/autoload.php');

use VK\Generators\GenerateActions;

$gen = new GenerateActions();
$gen->generate();
