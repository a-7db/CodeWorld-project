<?php
    require_once 'configs/config.php';

    spl_autoload_register(function($className){
    require_once '../app/libraries/'. $className .'.php';
    });
?>