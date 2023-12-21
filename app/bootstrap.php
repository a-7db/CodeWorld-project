<?php
    require_once 'configs/config.php';
    require_once 'helpers/url_helper.php';
    require_once 'helpers/flash_messages.php';
    require_once '../public/mail.php';
    

    spl_autoload_register(function($className){
    require_once '../app/libraries/'. $className .'.php';
    });

    require_once '../app/controllers/Users.class.php';
    require_once '../app/models/User.model.php';

    
?>