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
        $this->db->query('INSERT INTO users (Role_ID, fname, email, pass, statu) VALUES(:roleID, :fname , :email, :pass, :statu)');

        $this->db->bind(':roleID', $this->userRole);
        $this->db->bind(':fname', $data['fname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':pass', $data['pass']);
        $this->db->bind(':statu', $this->status);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


}