<?php
class Course{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }



    public function showCourses()
    {
        $this->db->query('SELECT
                                crs.crs_ID,
                                crs.title,
                                crs.description,
                                crs.price,
                                usr.fname,
                                cate.name,
                                crs.image,
                                usr.profile
                            FROM
                                courses crs
                            INNER JOIN
                                users usr
                            ON crs.instructor_ID = usr.user_ID 
                            INNER JOIN category cate
                            ON cate.category_ID = crs.cate_ID
                            WHERE crs.public = :isPublic
                            LIMIT :limli;
        ');
        $this->db->bind(':isPublic', 1);
        $this->db->bind(':limli', 4);

        return $this->db->fetchAll();


    }

    public function Showdetails($id){
        $this->db->query('SELECT
                                crs.crs_ID,
                                crs.title,
                                crs.description,
                                crs.price,
                                usr.fname,
                                cate.name,
                                crs.image
                            FROM
                                courses crs
                            INNER JOIN
                                users usr
                            ON crs.instructor_ID = usr.user_ID 
                            INNER JOIN category cate
                            ON cate.category_ID = crs.cate_ID
                            WHERE crs.crs_ID = :id AND crs.public = :isPublic;');

        $this->db->bind(':id', $id);
        $this->db->bind(':isPublic', 1);

        return $this->db->fetchOne();
    }

   public function fill_Cart($Course_ID){

     $this->db->query(
        'INSERT INTO cart (user_ID, course_ID)
      VALUES (:userID , :crsID )'
      );

      $this->db->bind(':userID',  $_SESSION['user_id']);
      $this->db->bind(':crsID',  $Course_ID);

      if ($this->db->execute()) {

        return true;
        flash('AddToCart','done','course is added ');
    } else{
        return false;
    }

      

    }

    public function getCart()
    {
        
       $this->db->query('SELECT * FROM cart 
       
       inner join courses crs
       on crs.crs_ID = course_ID
       

       where user_ID = :userID
       order by cart_ID desc
       
       ');
        
        $this->db->bind(':userID',  $_SESSION['user_id']);


       return $this->db->fetchAll();

    }
    
    public function deleteCart(){

        $this->db->query('DELETE FROM cart WHERE user_ID = :user_ID');
        $this->db->bind(':user_ID' , $_SESSION['user_id']);

        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }

    }

    public function do_order($data){

        $this->db->query(
           'INSERT INTO orders (user_ID, price, course_ID)
         VALUES (:user_ID , :price , :crs_ID )'
         );
   
         $this->db->bind(':user_ID',  $_SESSION['user_id']);
         $this->db->bind(':price',   $data['price']);
         $this->db->bind(':crs_ID',   $data['crs_ID']);
   
        
   
         if ($this->db->execute()) {
   
            return true;
            flash('AddToOrders','done','order is done ');
        } else{
            return false;
        }
         
   
    }

}
?>
