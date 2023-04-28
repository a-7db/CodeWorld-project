<?php

class Trainee extends User{

    public function __construct()
    {
        $this->db = new Database;
    }

    public function fill_Cart($Course_ID)
    {
        $this->db->query('INSERT INTO cart (user_ID, course_ID) VALUES (:userID, :crsID)');

        $this->db->bind(':userID',  $_SESSION['user_id']);
        $this->db->bind(':crsID',  $Course_ID);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCart()
    {

        $this->db->query('SELECT * FROM cart crt
       
       inner join courses crs
       on crs.crs_ID = course_ID 
       inner join users usr
       on usr.user_ID = crs.instructor_ID

       where crt.user_ID = :userID
       order by cart_ID desc
       
       ');

        $this->db->bind(':userID',  $_SESSION['user_id']);


        return $this->db->fetchAll();
    }


    public function find_cart($Course_ID){
        $this->db->query('SELECT * FROM cart WHERE course_ID = :crsID AND user_ID = :userID');

        $this->db->bind(':userID',  $_SESSION['user_id']);
        $this->db->bind(':crsID',  $Course_ID);

        $this->db->execute();

        if($this->db->count() > 0){
            return true;
        } else{
            return false;
        }
    }


    public function find_order($Course_ID){
        $this->db->query('SELECT * FROM orders WHERE course_ID = :crsID AND user_ID = :userID');

        $this->db->bind(':userID',  $_SESSION['user_id']);
        $this->db->bind(':crsID',  $Course_ID);

        $this->db->execute();
        
        if($this->db->count() > 0){
            return true;
        } else{
            return false;
        }
    }

}