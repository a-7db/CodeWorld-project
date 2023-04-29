<?php

    function redirect($page = ''){
        if(empty($page)){
            header('location: ' . URLROOT . '/');
        }
        else{
            header('location: ' . URLROOT . '/' . $page);
        }
    }

    function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
            return true;
        } else{
            return false;
        }
    }

    function isAdmin(){
        if($_SESSION['Role'] == 1){
            return true;
        } else{
            return false;
        }
    }

    function isInstructor()
    {
        if ($_SESSION['Role'] == 2) {
            return true;
        } else {
            return false;
        }
    }

    function isTrainee()
    {
        if ($_SESSION['Role'] == 3) {
            return true;
        } else {
            return false;
        }
    }