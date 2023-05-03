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
                                crs.last_updated,
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
                                usr.profile,
                                usr.user_ID as userID,
                                cate.name,
                                crs.last_updated,
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


    public function get_categories()
    {
        $this->db->query('SELECT * FROM category');
        return $this->db->fetchAll();
    }

    public function getVideos($crsID)
    {
        $this->db->query('SELECT * FROM videos WHERE crs_ID = :crsID');
        $this->db->bind(':crsID', $crsID);

        $row = $this->db->fetchAll();

        if ($this->db->count() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function showlastVid($crsID)
    {
        $this->db->query('SELECT * FROM videos WHERE crs_ID = :crsID ORDER BY crs_ID DESC LIMIT 1');
        $this->db->bind(':crsID', $crsID);

        $row = $this->db->fetchOne();

        if ($this->db->count() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSelectedLecture($crsID, $lecID)
    {
        $this->db->query('SELECT * FROM videos WHERE crs_ID = :crsID AND vid_ID = :vidID');
        $this->db->bind(':crsID', $crsID);
        $this->db->bind(':vidID', $lecID);

        $row = $this->db->fetchOne();

        if ($this->db->count() > 0) {
            return $row;
        } else {
            return false;
        }
    }
    
    public function stdTotal($crsID){
        $this->db->query('SELECT COUNT(course_ID) as total FROM orders WHERE course_ID = :crsID');
        $this->db->bind(':crsID', $crsID);

        $count = $this->db->fetchOne();

        if ($this->db->count() > 0) {
            return $count;
        } else {
            return false;
        }
    }
    
    public function vidTotal($crsID){
        $this->db->query('SELECT COUNT(crs_ID) as vid_count FROM videos WHERE crs_ID = :crsID');
        $this->db->bind(':crsID', $crsID);

        $count = $this->db->fetchOne();

        if ($this->db->count() > 0) {
            return $count;
        } else {
            return false;
        }
    }
    
    public function crsTotal($instructor_ID){
        $this->db->query('SELECT COUNT(instructor_ID) as crs_count FROM courses WHERE instructor_ID  = :instructor_ID');
        $this->db->bind(':instructor_ID', $instructor_ID);

        $count = $this->db->fetchOne();

        if ($this->db->count() > 0) {
            return $count;
        } else {
            return false;
        }
    }
    
    
    //-- count for instructors start --
    public function instructor_Money(){
        $this->db->query('SELECT distinct SUM(ord.price) as price FROM orders ord
        inner join courses crs
         on crs.crs_ID = ord.course_ID
         WHERE crs.instructor_ID  = :instructor_ID');

        $this->db->bind(':instructor_ID', $_SESSION['user_id']);

        $count = $this->db->fetchOne();

        if ($this->db->count() > 0) {
            return $count;
        } else {
            return false;
        }
    }

    public function count_users(){
        $this->db->query('SELECT distinct count(ord.user_ID) as users FROM orders ord
        inner join courses crs
         on crs.crs_ID = ord.course_ID
         WHERE crs.instructor_ID  = :instructor_ID
         order by ord.user_ID
         ');
         

        $this->db->bind(':instructor_ID', $_SESSION['user_id']);

        $count = $this->db->fetchOne();

        if ($this->db->count() > 0) {
            return $count;
        } else {
            return false;
        }
    }

    public function count_courses(){
        $this->db->query(' SELECT distinct count(crs_ID) as courses  FROM courses 
         WHERE instructor_ID  = :instructor_ID
         
         ');
         

        $this->db->bind(':instructor_ID', $_SESSION['user_id']);

        $count = $this->db->fetchOne();

        if ($this->db->count() > 0) {
            return $count;
        } else {
            return false;
        }
    }

     //-- count for instructors End --


     //-- count for All Start --

     public function Count_Money(){
        $this->db->query('SELECT distinct SUM(ord.price) as price FROM orders ord
        inner join courses crs
         on crs.crs_ID = ord.course_ID
         ');

       

        $count = $this->db->fetchOne();

        if ($this->db->count() > 0) {
            return $count;
        } else {
            return false;
        }
    }

    public function countAllusers(){
        $this->db->query('SELECT distinct count(usr.user_ID) as users FROM users usr
       
         ');
         


        $count = $this->db->fetchOne();

        if ($this->db->count() > 0) {
            return $count;
        } else {
            return false;
        }
    }

    public function countAllcourses(){
        $this->db->query(' SELECT distinct count(crs_ID) as courses  FROM courses 
        
         
         ');
         


        $count = $this->db->fetchOne();

        if ($this->db->count() > 0) {
            return $count;
        } else {
            return false;
        }
    }

         //-- count for All End --

   

         public function Count_student(){
            $this->db->query('SELECT distinct count(user_ID) as users FROM users 
               where Role_ID = 3
             ');
             
    
    
            $count = $this->db->fetchOne();
    
            if ($this->db->count() > 0) {
                return $count;
            } else {
                return false;
            }
        }

        public function Count_instructor(){
            $this->db->query('SELECT distinct count(user_ID) as instructors FROM users 
               where Role_ID = 2
             ');
             
    
    
            $count = $this->db->fetchOne();
    
            if ($this->db->count() > 0) {
                return $count;
            } else {
                return false;
            }
        }

    

}
?>
