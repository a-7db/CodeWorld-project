<?php

class Admin extends User{


    public function __construct()
    {
        $this->db = new Database;
    }

    public function showUsers(){
        $this->db->query('SELECT * FROM users WHERE Role_ID = :roleid ORDER BY user_ID DESC');
        $this->db->bind(':roleid', 3);
        return $this->db->fetchAll();
    }

    
    public function showInstructors(){
        $this->db->query('SELECT * FROM users WHERE Role_ID = :roleid OR Role_ID = :roleid4 ORDER BY user_ID DESC');
        $this->db->bind(':roleid', 2);
        $this->db->bind(':roleid4', 4);
        return $this->db->fetchAll();
    }

    public function activeUser($userID){
        $this->db->query('UPDATE users SET Role_ID = :Role_ID WHERE user_ID = :userID');
        $this->db->bind(':Role_ID', 2);
        $this->db->bind(':userID', $userID);

        if($this->db->execute()){
            $this->db->query('SELECT * FROM users WHERE user_ID = :userID');
            $this->db->bind(':userID', $userID);
            return $this->db->fetchOne();
        }
        else{
            return false;
        }
    }

    public function deleteUser($userID){
        $this->db->query('DELETE FROM users WHERE user_ID = :userID');
        $this->db->bind(':userID', $userID);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function lastCateID(){
        $this->db->query('SELECT category_ID FROM category ORDER BY category_ID DESC LIMIT 1');
        return $this->db->fetchOne();
    }

    public function insert_cate($data){
        $slug = $data['slug'];
        $this->db->query('SELECT slug FROM category WHERE slug LIKE :check_slug');
        $this->db->bind(':check_slug', '%' . $slug . '%');

        if($this->db->execute()){
            $rows = $this->db->count();
            if ($rows > 0) {
                $obj = $this->db->fetchAll();
                foreach ($obj as $row) {
                    $slugs[] = $row->slug;
                }
                if (in_array($slug, $slugs)) {
                    $count = 0;
                    while (in_array(($slug . '-' . ++$count), $slugs));
                    $slug = $slug . '-' . $count;
                }
            }
        }
        $this->db->query('INSERT INTO category (category_ID, name, slug) VALUES (:cateID, :cateName, :slug)');
        $this->db->bind(':cateID', $data['newID']);
        $this->db->bind(':cateName', $data['cate']);
        $this->db->bind(':slug', $slug);
        
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function update_cate_name($cateID, $cateName){
        $slug = slug($cateName);
        $this->db->query('SELECT slug FROM category WHERE slug LIKE :check_slug');
        $this->db->bind(':check_slug', '%' . $slug . '%');

        if ($this->db->execute()) {
            $rows = $this->db->count();
            if ($rows > 0) {
                $obj = $this->db->fetchAll();
                foreach ($obj as $row) {
                    $slugs[] = $row->slug;
                }
                if (in_array($slug, $slugs)) {
                    $count = 0;
                    while (in_array(($slug . '-' . ++$count), $slugs));
                    $slug = $slug . '-' . $count;
                }
            }
        }

        $this->db->query('UPDATE category SET name = :cateName, slug = :new_slug WHERE category_ID = :cateID');
        $this->db->bind(':cateName', $cateName);
        $this->db->bind(':new_slug', $slug);
        $this->db->bind(':cateID', $cateID);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        
    }

    public function remove_category($cateID){
        $this->db->query('DELETE FROM category WHERE category_ID = :cateID');
        $this->db->bind(':cateID', $cateID);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPaidUsers()
    {
        $this->db->query('SELECT DISTINCT
                        usr.profile,
                        usr.fname,
                        usr.email,
                        crs.title,
                        crs.price
                        FROM orders ord
                        INNER JOIN courses crs
                        ON crs.crs_ID = ord.course_ID
                        INNER JOIN users usr
                        ON ord.user_ID = usr.user_ID
                        ORDER BY ord.order_ID DESC
                                    ');

        return $this->db->fetchAll();
    }

    public function top_courses()
    {
        $this->db->query('SELECT crs.image, crs.title, COUNT(ord.course_ID) AS count
                        FROM orders ord
                        INNER JOIN courses crs
                        ON crs.crs_ID = ord.course_ID
                        GROUP BY crs.crs_ID
                        ORDER BY count DESC
                        LIMIT :num
                        ');

        $this->db->bind(':num', 10);

        return $this->db->fetchAll();
    }

    public function top_trainees()
    {
        $this->db->query('SELECT usr.fname, usr.email, usr.profile, COUNT(ord.course_ID) AS count
                        FROM orders ord
                        INNER JOIN courses crs
                        ON crs.crs_ID = ord.course_ID
                        INNER JOIN users usr
                        ON usr.user_ID = ord.user_ID
                        GROUP BY usr.user_ID
                        ORDER BY count DESC
                        LIMIT :num
                            ');

        $this->db->bind(':num', 10);

        return $this->db->fetchAll();
    }

    public function getFeedbacks()
    {
        $this->db->query('SELECT 
                            comm.comment_ID AS commID,
                            comm.content,
                            usr.fname
                            FROM comments comm
                            INNER JOIN users usr
                            ON usr.user_ID = comm.user_ID
                            WHERE comm.home_view = :homeView
                            ');

        $this->db->bind(':homeView', false);

        return $this->db->fetchAll();
    }

    public function get_selected_feedbacks()
    {
        $this->db->query('SELECT 
                            comm.comment_ID AS commID,
                            comm.content,
                            comm.dateTime,
                            usr.fname,
                            usr.profile
                            FROM comments comm
                            INNER JOIN users usr
                            ON usr.user_ID = comm.user_ID
                            WHERE comm.home_view = :homeView
                            ');

        $this->db->bind(':homeView', true);

        return $this->db->fetchAll();
    }

    public function update_feedbacks_home($commID)
    {
        $this->db->query('UPDATE comments SET home_view = :homeView WHERE comment_ID = :commID');

        $this->db->bind(':homeView', true);
        $this->db->bind(':commID', $commID);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function delete_comment($commID)
    {
        $this->db->query('UPDATE comments SET home_view = :homeView WHERE comment_ID = :commID');

        $this->db->bind(':homeView', false);
        $this->db->bind(':commID', $commID);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

    public function getTax(){

        $this->db->query('SELECT * FROM taxes');
        
        $row=$this->db->fetchone();
        if($this->db->count()> 0){
            return $row;

        }
        else{
           return false;
        }

    }

    public function update_Tax($newTax)
    {

        $this->db->query('UPDATE taxes SET Tax = :newTax');

        $this->db->bind(':newTax', $newTax / 100);
        

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}