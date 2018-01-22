<?php
require_once(getcwd() . '/GenerateActions.php');

use VK\Generators\GenerateActions;

$gen = new GenerateActions();
$gen->generate();
