<?php

require_once (dirname(dirname(__DIR__)) . '/autoload.php');

use VK\Generators\GenerateActions;

$gen = new GenerateActions();
$gen->generate();
