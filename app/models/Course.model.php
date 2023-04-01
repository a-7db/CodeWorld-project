<?php
class Course{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    // public function getData(){
    //     $this->db->query('SELECT * FROM test');
    //     return $this->db->fetchAll();
    // }


    public function ShowCourses()
    {
    }
}
?>