<?php
require_once (getcwd() . '/GenerateObjects.php');

use VK\Generators\GenerateObjects;

$gen = new GenerateObjects();
$gen->generate();
