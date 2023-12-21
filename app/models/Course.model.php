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
                                usr.profile,
                                crs.slug,
                                AVG(rat.rating) AS rating,
                                COUNT(rat.rating) AS count_rating
                            FROM
                                courses crs
                            INNER JOIN
                                users usr
                            ON crs.instructor_ID = usr.user_ID 
                            INNER JOIN category cate
                            ON cate.category_ID = crs.cate_ID
                            LEFT JOIN rating rat
                            ON crs.crs_ID = rat.crs_ID
                            WHERE crs.public = :isPublic
                            GROUP BY crs.crs_ID
                            ORDER BY rating DESC
                            LIMIT :limli;
        ');
        $this->db->bind(':isPublic', 1);
        $this->db->bind(':limli', 4);

        return $this->db->fetchAll();


    }

    public function allCourses()
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
                                usr.profile,
                                crs.slug
                            FROM
                                courses crs
                            INNER JOIN
                                users usr
                            ON crs.instructor_ID = usr.user_ID 
                            INNER JOIN category cate
                            ON cate.category_ID = crs.cate_ID
                            WHERE crs.public = :isPublic
        ');
        $this->db->bind(':isPublic', 1);

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
                                crs.cate_ID,
                                crs.last_updated,
                                crs.image,
                                crs.slug,
                                crs.instructor_ID,
                                crs.public
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

    public function get_courses_by_cate($cate){
        $this->db->query('SELECT
                                crs.crs_ID,
                                cate.category_ID as cateID,
                                crs.title,
                                crs.description,
                                crs.price,
                                usr.fname,
                                usr.profile,
                                usr.user_ID as userID,
                                cate.name,
                                crs.last_updated,
                                crs.image,
                                crs.slug,
                                AVG(rat.rating) AS rating,
                                COUNT(rat.rating) AS count_rating
                            FROM
                                courses crs
                            INNER JOIN
                                users usr
                            ON crs.instructor_ID = usr.user_ID 
                            INNER JOIN category cate
                            ON cate.category_ID = crs.cate_ID
                            LEFT JOIN rating rat
                            ON crs.crs_ID = rat.crs_ID
                            WHERE cate.slug = :slug AND crs.public = :isPublic
                            ORDER BY rat.rating, COUNT(rat.rating) DESC
                            ');
                            
        $this->db->bind(':slug', $cate);
        $this->db->bind(':isPublic', 1);

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
        $this->db->query('SELECT * FROM videos WHERE crs_ID = :crsID ORDER BY crs_ID ASC LIMIT 1');
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
        $this->db->query('SELECT * FROM videos WHERE crs_ID = :crsID AND vid_ID = :vidID LIMIT 1');
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
        $this->db->query('SELECT COUNT(ord.user_ID) as users FROM orders ord
        inner join courses crs
         on crs.crs_ID = ord.course_ID
         WHERE crs.instructor_ID  = :instructor_ID
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
        $this->db->query('SELECT  SUM(ord.price) as price FROM orders ord
        inner join courses crs
         on crs.crs_ID = ord.course_ID
         inner join taxes txes 
         on crs.crs_ID = txes.tax_ID
         ');

       

        $count = $this->db->fetchOne();

        if ($this->db->count() > 0) {
            return $count;
        } else {
            return false;
        }
    }

    public function countAllusers(){
        $this->db->query('SELECT distinct count(user_ID) as users FROM users 
                        WHERE Role_ID = :num
       
         ');
         $this->db->bind(':num', 3);


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

    public function profits(){
        $this->db->query('SELECT SUM(ord.price) as profits FROM orders ord
                        INNER JOIN courses crs
                        ON crs.crs_ID = ord.course_ID
                        WHERE crs.instructor_ID = :instID ');

        $this->db->bind(':instID', $_SESSION['user_id']);

        return $this->db->fetchOne();
    }

    public function send_feedback($data)
    {
        $this->db->query('INSERT INTO rating(crs_ID, user_ID, rating) VALUES 
                        (:crsID, :userID, :rate)');

        $this->db->bind(':crsID', $data['crsID']);
        $this->db->bind(':userID', $_SESSION['user_id']);
        $this->db->bind(':rate', $data['rating']);

        if($this->db->execute()){
            $this->db->query('INSERT INTO comments(content, crs_ID, user_ID, dateTime) VALUES 
                        (:content, :crsID, :userID, :dtime)');

            $this->db->bind(':content', $data['content']);
            $this->db->bind(':crsID', $data['crsID']);
            $this->db->bind(':userID', $_SESSION['user_id']);
            $this->db->bind(':dtime', $data['dtime']);

            if($this->db->execute()){
                return true;
            } else{
                return false;
            }
        } else{
            return false;
        }
    }

    public function find_feedback($Course_ID)
    {
        $this->db->query('SELECT * FROM rating WHERE crs_ID = :crsID');

        // $this->db->bind(':userID', $_SESSION['user_id']);
        $this->db->bind(':crsID',  $Course_ID);

        $this->db->execute();

        if ($this->db->count() > 0) {
            return $this->db->fetchOne();
        } else {
            return false;
        }
    }

    public function show_feedbacks($crsID)
    {
        $this->db->query('SELECT comm.content,
                            comm.dateTime,
                            rat.rating,
                            usr.fname,
                            usr.profile
                            FROM comments comm
                            INNER JOIN rating rat
                            ON comm.user_ID = rat.user_ID
                            INNER JOIN users usr
                            ON usr.user_ID = comm.user_ID
                            WHERE comm.crs_ID = :crsID AND rat.crs_ID = :crsID
                            GROUP BY comm.comment_ID
                            ORDER BY dateTime DESC
                            ');

        $this->db->bind(':crsID',  $crsID);

        return $this->db->fetchAll();
    }

    public function send_comment($data)
    {
        $this->db->query('INSERT INTO comments(content, crs_ID, user_ID, dateTime) VALUES 
                        (:content, :crsID, :userID, :dtime)');

        $this->db->bind(':content', $data['content']);
        $this->db->bind(':crsID', $data['crsID']);
        $this->db->bind(':userID', $_SESSION['user_id']);
        $this->db->bind(':dtime', $data['dtime']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function reviewTotal($crsID)
    {
        $this->db->query('SELECT COUNT(rating) as count FROM rating WHERE crs_ID = :crsID');

        $this->db->bind(':crsID', $crsID);

        $count = $this->db->fetchOne();

        if ($this->db->count() > 0) {
            return $count;
        } else {
            return false;
        }
    }

    public function AVG($crsID)
    {
        $this->db->query('SELECT AVG(rating) as avg FROM rating WHERE crs_ID = :crsID');

        $this->db->bind(':crsID', $crsID);

        $count = $this->db->fetchOne();

        if ($this->db->count() > 0) {
            return $count;
        } else {
            return false;
        }
    }

    public function stu_feedback($crsID, $counter)
    {
        $this->db->query('SELECT COUNT(rating) / SUM(rating) * 100 AS percent FROM rating WHERE crs_ID = :crsID
                             AND rating BETWEEN :num1 AND :num2 ');

        $this->db->bind(':crsID', $crsID);
        $this->db->bind(':num1', $counter);
        $this->db->bind(':num2', $counter + 0.9);

        $result = $this->db->fetchOne();

        if ($this->db->count() > 0) {
            return $result->percent;
        } else {
            return false;
        }
    }

    public function instructorJob($instructor_ID)
    {
        $this->db->query('SELECT COUNT(rating) AS count, AVG(rating) AS avg FROM rating rat
                          INNER JOIN courses crs
                          ON crs.crs_ID = rat.crs_ID
                          WHERE crs.instructor_ID = :instID  ');

        $this->db->bind(':instID', $instructor_ID);

        $result = $this->db->fetchOne();

        if ($this->db->count() > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function Count_ratings()
    {
        $this->db->query('SELECT COUNT(rating) as rating FROM rating');

        $result = $this->db->fetchOne();

        if ($this->db->count() > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function get_selected_feedbacks()
    {
        $this->db->query('SELECT 
                            comm.comment_ID AS commID,
                            comm.content,
                            comm.dateTime,
                            usr.fname,
                            usr.profile,
                            COUNT(ord.user_ID) AS orders
                            FROM comments comm
                            INNER JOIN users usr
                            ON usr.user_ID = comm.user_ID
                            INNER JOIN orders ord
                            ON ord.user_ID = usr.user_ID
                            WHERE comm.home_view = :homeView
                            GROUP BY commID
                            ');

        $this->db->bind(':homeView', true);

        return $this->db->fetchAll();
    }

    public function search($input)
    {
        $this->db->query('SELECT crs.crs_ID, crs.title, crs.price, crs.image, usr.fname, crs.slug
                        FROM courses crs
                        INNER JOIN users usr
                        ON usr.user_ID = crs.instructor_ID
                        INNER JOIN category cate
                        ON cate.category_ID = crs.cate_ID
                        WHERE crs.title LIKE :input
                        OR usr.fname LIKE :input
                        OR cate.name LIKE :input
                        ');

        $this->db->bind(':input', '%' . $input . '%');

        $rows = $this->db->fetchAll();

        if($this->db->count() > 0){
            return $rows;
        } else{
            return false;
        }
    }

}
?>
