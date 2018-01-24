<?php

spl_autoload_register(function ($class) {
    $filename = trim(str_replace('\\','/', $class), '/') . '.php';
    if (file_exists(__DIR__ . '/' .$filename)) {
        require_once $filename;
    }
});
