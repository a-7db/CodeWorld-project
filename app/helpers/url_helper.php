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

    function slug($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // trim
        $text = trim($text, '-');
        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
        // lowercase
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }