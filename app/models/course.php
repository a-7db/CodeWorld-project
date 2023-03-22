<?php
class Course{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

<<<<<<< HEAD
    // public function getData(){
    //     $this->db->query('SELECT * FROM test');
    //     return $this->db->fetchAll();
    // }
=======
    public function getData(){
        $this->db->query('SELECT * FROM test');
        return $this->db->fetchAll();
    }
>>>>>>> 04b9b82013a8f67dbb4da6b702876832b2be670c


    public function ShowCourses()
    {
    }
}
?>