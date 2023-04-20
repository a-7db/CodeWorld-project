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
}
?>