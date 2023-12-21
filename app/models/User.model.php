<?php
class User {
    protected $db;
    protected $userRole = 3;
    protected $status = false;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function register($data){
        $this->db->query('INSERT INTO users (Role_ID, fname, email, pass, statu, profile) VALUES(:roleID, :fname , :email, :pass, :statu, :profile)');
        
        $this->db->bind(':roleID', $this->userRole);
        $this->db->bind(':fname', $data['fname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':pass', $data['pass']);
        $this->db->bind(':statu', $this->status);
        $this->db->bind(':profile', 'user.png');

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
            return $row;
        }
        else{
            return false;
        }
    }

    public function forgotpass($email, $code, $expire){
        $this->db->query('UPDATE users SET code = :code, expire = :expire WHERE email = :email');
        $this->db->bind(':code', $code);
        $this->db->bind(':expire', $expire);
        $this->db->bind(':email', $email);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCodeFromUser($email, $code){
        $this->db->query('SELECT * FROM users WHERE email = :email && code = :code limit 1');
        $this->db->bind(':code', $code);
        $this->db->bind(':email', $email);

        $row = $this->db->fetchOne();

        if($this->db->count() > 0){
            return $row;
        }
        return false;
    }

    public function updateUserPassword($newPassword, $email){
        $this->db->query('UPDATE users SET pass = :pass WHERE email = :email');
        $this->db->bind(':pass', $newPassword);
        $this->db->bind(':email', $email);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getInfo($id){

        $this->db->query('SELECT * FROM users  where user_ID=:id');
        $this->db->bind(':id', $id);
        $row=$this->db->fetchone();
        if($this->db->count()> 0){
            return $row;

        }
        else{
           return false;
        }

    }

    public function udpdate_status($id)
    {
        $this->db->query('UPDATE users SET statu = :statu WHERE user_ID = :id');
        $this->db->bind(':statu', true);
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function count_crs($userID){
        $this->db->query('SELECT COUNT(user_ID) AS count
                        FROM orders
                        WHERE user_ID = :usrID');

        $this->db->bind(':usrID', $userID);

        $row = $this->db->fetchOne();

        if ($this->db->execute()) {
            return $row;
        } else {
            return false;
        }
    }

    public function count_reviews($userID){
        $this->db->query('SELECT COUNT(user_ID) AS count
                        FROM comments
                        WHERE user_ID = :usrID');

        $this->db->bind(':usrID', $userID);

        $row = $this->db->fetchOne();

        if ($this->db->execute()) {
            return $row;
        } else {
            return false;
        }
    }

    public function count_rating($userID){
        $this->db->query('SELECT COUNT(user_ID) AS count
                        FROM rating
                        WHERE user_ID = :usrID');

        $this->db->bind(':usrID', $userID);

        $row = $this->db->fetchOne();

        if ($this->db->execute()) {
            return $row;
        } else {
            return false;
        }
    }

}

?>
