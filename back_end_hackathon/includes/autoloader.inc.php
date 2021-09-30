<?php
    spl_autoload_register('MyAutoLoader');

    function myAutoLoader($classname) {
        $path = "classes/";
        $extension = ".class.php";
        $fullPath = $path . $classname . $extension;
        if (!file_exists($fullPath)) {
            return false;
        }
        require_once $fullPath;
    }