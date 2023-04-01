<?php
    require_once 'configs/config.php';
    require_once 'helpers/url_helper.php';

    spl_autoload_register(function($className){
    require_once '../app/libraries/'. $className .'.php';
    });
?>