<?php
class User {
    private $db;
    private $userRole = 3;
    private $status = true;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function register($data){
        $this->db->query('INSERT INTO users (Role_ID, fname, email, pass, statu) VALUES(:roleID, :fname , :email, :pass, :statu)');
        
        $this->db->bind(':roleID', $this->userRole);
        $this->db->bind(':fname', $data['fname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':pass', $data['pass']);
        $this->db->bind(':statu', $this->status);

        if ($this->db->execute()) {
            return true;
        } else{
            return false;
        }
    }

    public function login($email, $pass){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->fetchOne();
        $hashed_pass = $row->pass;

        if(password_verify($pass, $hashed_pass)){
            return $row;
        } else{
            return false;
        }
    }

    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->fetchOne();

        if($this->db->count() > 0){
            return true;
        }
        else{
            return false;
        }
    }

}

?>
