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
                                crs.image
                            FROM
                                courses crs
                            INNER JOIN
                                users usr
                            ON crs.instructor_ID = usr.user_ID 
                            INNER JOIN category cate
                            ON cate.category_ID = crs.cate_ID
                            LIMIT 4;
        ');

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
                            WHERE crs.crs_ID = :id;');

        $this->db->bind(':id', $id);

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
}
?>
