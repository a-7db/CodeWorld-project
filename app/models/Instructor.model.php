<?php

class Instructor extends User{

    protected $userRole = 2;
    protected $status = false;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users (Role_ID, fname, email, pass, statu, profile) VALUES(:roleID, :fname , :email, :pass, :statu, :profile)');

        $this->db->bind(':roleID', $this->userRole);
        $this->db->bind(':fname', $data['fname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':pass', $data['pass']);
        $this->db->bind(':statu', $this->status);
        $this->db->bind(':profile', 'instructor.png');

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function ViewMyCourses($inst_id){
        $this->db->query('SELECT
                                crs.crs_ID,
                                crs.title,
                                crs.description,
                                crs.price,
                                usr.fname,
                                cate.name as category,
                                crs.image,
                                crs.public,
                                crs.last_updated as ddate
                            FROM
                                courses crs
                            INNER JOIN
                                users usr
                            ON crs.instructor_ID = usr.user_ID 
                            INNER JOIN category cate
                            ON cate.category_ID = crs.cate_ID
                            WHERE crs.instructor_ID = :id
                            ORDER BY crs.crs_ID DESC
                        ');
        $this->db->bind(':id', $inst_id);

        return $this->db->fetchAll();
    }

    public function get_categories(){
        $this->db->query('SELECT * FROM category');
        return $this->db->fetchAll();
    }

    public function createCousre($data){
        $this->db->query('INSERT INTO courses (title, description, price, instructor_ID, cate_ID, image, public, last_updated) VALUES (:title , :descc , :price, :instID, :cate, :imagee, :public, :timeNow)');

        $this->db->bind(':title', $data['title']);
        $this->db->bind(':descc', $data['desc']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':instID', $_SESSION['user_id']);
        $this->db->bind(':cate', $data['cate']);
        $this->db->bind(':imagee', $data['image']);
        $this->db->bind(':public', $data['public']);
        $this->db->bind(':timeNow', $data['time']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    

    public function delete($crs_id){
        $this->db->query('DELETE FROM courses WHERE crs_ID = :id');
        $this->db->bind(':id', $crs_id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function return_course_byDate($date){
        $this->db->query('SELECT * FROM courses WHERE instructor_ID = :inst_id AND last_updated = :last_updated');
        $this->db->bind(':inst_id', $_SESSION['user_id']);
        $this->db->bind(':last_updated', $date);

        $row = $this->db->fetchOne();

        if ($this->db->count() > 0) {
            return $row;
        } else {
            return false;
        }

    }

    public function addVideo($data){
        $this->db->query('INSERT INTO videos (crs_ID, name, filename) 
                    VALUES (:crsID,:Vname, :filenamee)');
        $this->db->bind(':crsID', $data['crsID']);
        $this->db->bind(':Vname', $data['vname']);
        $this->db->bind(':filenamee', $data['filename']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getVideos($crsID){
        $this->db->query('SELECT * FROM videos WHERE crs_ID = :crsID');
        $this->db->bind(':crsID', $crsID);

        $row = $this->db->fetchAll();

        if ($this->db->count() > 0) {
            return $row;
        } else {
            return false;
        }
    }

}