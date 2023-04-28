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






}
?>
