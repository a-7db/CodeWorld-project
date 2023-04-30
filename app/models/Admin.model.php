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
        $this->db->query('SELECT * FROM users WHERE Role_ID = :roleid ORDER BY user_ID DESC');
        $this->db->bind(':roleid', 2);
        return $this->db->fetchAll();
    }

    public function activeUser($userID){
        $this->db->query('UPDATE users SET statu = :user_status WHERE user_ID = :userID');
        $this->db->bind(':user_status', true);
        $this->db->bind(':userID', $userID);

        if($this->db->execute()){
            return true;
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
        $this->db->query('INSERT INTO category (category_ID, name, slug) VALUES (:cateID, :cateName, :slug)');
        $this->db->bind(':cateID', $data['newID']);
        $this->db->bind(':cateName', $data['cate']);
        $this->db->bind(':slug', $data['slug']);
        
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}