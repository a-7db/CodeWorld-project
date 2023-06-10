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
       inner join taxes txes
       on crs.tax_ID = txes.tax_ID

       where crt.user_ID = :userID
       order by cart_ID desc
       
       ');

        $this->db->bind(':userID',  $_SESSION['user_id']);


        return $this->db->fetchAll();
    }


    public function findUserCart(){
        $this->db->query('SELECT * FROM cart WHERE user_ID = :userID');

        $this->db->bind(':userID',  $_SESSION['user_id']);

        $this->db->execute();

        if($this->db->count() > 0){
            return true;
        } else{
            return false;
        }
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

        $this->db->bind(':userID', isLoggedIn()? $_SESSION['user_id']: 0);
        $this->db->bind(':crsID',  $Course_ID);

        $this->db->execute();

        if($this->db->count() > 0){
            return true;
        } else{
            return false;
        }
    }



    public function deleteCart()
    {

        $this->db->query('DELETE FROM cart WHERE user_ID = :user_ID');
        $this->db->bind(':user_ID', $_SESSION['user_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function do_order($data)
    {

        $this->db->query(
            'INSERT INTO orders (user_ID, price, course_ID)
         VALUES (:user_ID , :price , :crs_ID )'
        );

        $this->db->bind(':user_ID',  $_SESSION['user_id']);
        $this->db->bind(':price',   $data['price']);
        $this->db->bind(':crs_ID',   $data['crs_ID']);



        if ($this->db->execute()) {

            return true;
            flash('AddToOrders', 'done', 'order is done ');
        } else {
            return false;
        }
    }

    public function my_Learning()
    {
        $this->db->query('SELECT crs.crs_ID,
                                crs.title,
                                crs.description,
                                crs.price,
                                usr.fname,
                                cate.name,
                                crs.image,
                                crs.last_updated,
                                usr.profile,
                                crs.slug
                         FROM orders ord
                         INNER JOIN courses crs
                         ON ord.course_ID = crs.crs_ID
                         INNER JOIN users usr
                         ON crs.instructor_ID  = usr.user_ID
                         INNER JOIN category cate
                         ON cate.category_ID = crs.cate_ID
                         WHERE ord.user_ID = :userID
                         ');

        $this->db->bind(':userID', $_SESSION['user_id']);

        return $this->db->fetchAll();
    }
    
    

    public function delete_Item($id){


        $this->db->query('delete from cart
                            WHERE cart_ID = :id ');

        $this->db->bind(':id', $id);

        if ($this->db->execute()) {

            return true;
           
        } else {
            return false;
        }
      

        
    }

}
