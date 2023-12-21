<?php

class Instructor extends User{

    protected $userRole = 4;
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
                                crs.last_updated as ddate,
                                crs.slug,
                                crs.public
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
        $slug = $data['slug'];
        $this->db->query('SELECT slug FROM courses WHERE slug LIKE :check_slug');
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
        $this->db->query('INSERT INTO courses (title, slug, description, price, instructor_ID, cate_ID, image, public, last_updated, tax_ID) VALUES (:title , :slug, :descc , :price, :instID, :cate, :imagee, :public, :timeNow, :tax)');

        $this->db->bind(':title', $data['title']);
        $this->db->bind(':descc', $data['desc']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':instID', $_SESSION['user_id']);
        $this->db->bind(':cate', $data['cate']);
        $this->db->bind(':imagee', $data['image']);
        $this->db->bind(':public', $data['public']);
        $this->db->bind(':timeNow', $data['time']);
        $this->db->bind(':slug', $slug);
        $this->db->bind(':tax', 1);

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
        $slug = $data['slug'];
        $this->db->query('SELECT slug FROM videos WHERE slug LIKE :check_slug');
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
        $this->db->query('INSERT INTO videos (crs_ID, name, filename, slug) 
                    VALUES (:crsID,:Vname, :filenamee, :slug)');
        $this->db->bind(':crsID', $data['crsID']);
        $this->db->bind(':Vname', $data['vname']);
        $this->db->bind(':filenamee', $data['filename']);
        $this->db->bind(':slug', $slug);

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

    public function Showdetails($id)
    {
        $this->db->query('SELECT
                                crs.crs_ID,
                                crs.title,
                                crs.description,
                                crs.price,
                                usr.fname,
                                usr.profile,
                                usr.user_ID as userID,
                                cate.name,
                                crs.cate_ID,
                                crs.last_updated,
                                crs.image,
                                crs.slug,
                                crs.public
                            FROM
                                courses crs
                            INNER JOIN
                                users usr
                            ON crs.instructor_ID = usr.user_ID 
                            INNER JOIN category cate
                            ON cate.category_ID = crs.cate_ID
                            WHERE crs.crs_ID = :id AND crs.instructor_ID  = :instID;');

        $this->db->bind(':id', $id);
        $this->db->bind(':instID', $_SESSION['user_id']);

        return $this->db->fetchOne();
    }

    public function update_without_image($data){
        $slug = $data['slug'];
        $this->db->query('SELECT slug FROM courses WHERE slug LIKE :check_slug');
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
        $this->db->query('UPDATE courses
                        SET title = :title,
                        slug = :slug,
                        description = :desc,
                        price = :price,
                        cate_ID = :cate,
                        public = :public,
                        last_updated = :last_updated
                        WHERE crs_ID = :crsID');

        $this->db->bind(':title', $data['title']);
        $this->db->bind(':slug', $slug);
        $this->db->bind(':desc', $data['desc']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':cate', $data['cate']);
        $this->db->bind(':public', $data['public']);
        $this->db->bind(':last_updated', $data['time']);
        $this->db->bind(':crsID', $data['crsID']);

        if($this->db->execute()){
            return true;
        } else{
            return false;
        }
    }

    public function update_all($data){
        $slug = $data['slug'];
        $this->db->query('SELECT slug FROM courses WHERE slug LIKE :check_slug');
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
        $this->db->query('UPDATE courses
                        SET title = :title,
                        slug = :slug,
                        description = :desc,
                        price = :price,
                        cate_ID = :cate,
                        image = :imagee,
                        -- public = :public,
                        last_updated = :last_updated
                        WHERE crs_ID = :crsID');

        $this->db->bind(':title', $data['title']);
        $this->db->bind(':slug', $slug);
        $this->db->bind(':desc', $data['desc']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':cate', $data['cate']);
        // $this->db->bind(':public', $data['public']);
        $this->db->bind(':imagee', $data['image']);
        $this->db->bind(':last_updated', $data['time']);
        $this->db->bind(':crsID', $data['crsID']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update_course_status($id){
        $this->db->query('SELECT public FROM courses WHERE crs_ID = :crsID');
        $this->db->bind(':crsID', $id);

        $row = $this->db->fetchOne();

        if($this->db->count() > 0){
            if ($row->public == 1) {
                $this->db->query('UPDATE courses SET public = :public WHERE crs_ID = :ID');
                $this->db->bind(':public', 0);
                $this->db->bind(':ID', $id);
            } else {
                $this->db->query('UPDATE courses SET public = :public WHERE crs_ID = :ID');
                $this->db->bind(':public', 1);
                $this->db->bind(':ID', $id);
            }
            $this->db->query('SELECT public FROM courses WHERE crs_ID = :crsID');
            $this->db->bind(':crsID', $id);
            return $this->db->fetchOne();
        } else{
            return false;
        }

        
    }

    public function update_vid_name($data){
        $this->db->query('UPDATE videos SET name = :vidName WHERE vid_ID = :vidID');
        $this->db->bind(':vidName', $data['vidName']);
        $this->db->bind(':vidID', $data['vidID']);

        if($this->db->execute()){
            return true;
        } else{
            return false;
        }
    }

    public function remove_video($vidID){
        $this->db->query('DELETE FROM videos WHERE vid_ID = :vidID');
        $this->db->bind(':vidID', $vidID);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getMyUsers(){
        $this->db->query('SELECT 
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
                        WHERE crs.instructor_ID = :instID
                        ORDER BY ord.order_ID DESC
                                    ');
        $this->db->bind(':instID', $_SESSION['user_id']);

        return $this->db->fetchAll();
    }

    public function getEachCourseUsers(){
        $this->db->query('SELECT 
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
                        WHERE crs.instructor_ID = :instID
                        GROUP BY crs.title
                                    ');
        $this->db->bind(':instID', $_SESSION['user_id']);

        return $this->db->fetchAll();
    }

    public function git_crs_with_count(){
        $this->db->query('SELECT distinct crs.image, crs.title, crs.slug, crs.crs_ID, COUNT(ord.user_ID) as count
                        FROM orders ord
                        INNER JOIN courses crs
                        ON crs.crs_ID = ord.course_ID
                        WHERE crs.instructor_ID = :instID
                        GROUP BY crs.crs_ID
                            ');
        $this->db->bind(':instID', $_SESSION['user_id']);
        
        return $this->db->fetchAll();
    }

    public function getTrainees($crsID)
    {
        $this->db->query('SELECT DISTINCT crs.title, usr.fname, usr.email, usr.profile
                        FROM orders ord
                        INNER JOIN courses crs
                        ON crs.crs_ID = ord.course_ID
                        INNER JOIN users usr
                        ON usr.user_ID = ord.user_ID
                        WHERE crs.instructor_ID = :instID AND crs.crs_ID = :crsID
                            ');
        $this->db->bind(':instID', $_SESSION['user_id']);
        $this->db->bind(':crsID', $crsID);

        return $this->db->fetchAll();
    }

    public function top_courses()
    {
        $this->db->query('SELECT crs.image, crs.title, COUNT(ord.course_ID) AS count
                        FROM orders ord
                        INNER JOIN courses crs
                        ON crs.crs_ID = ord.course_ID
                        WHERE crs.instructor_ID = :instID
                        GROUP BY crs.crs_ID
                        ORDER BY count DESC
                        LIMIT :num
                        ');

        $this->db->bind(':instID', $_SESSION['user_id']);
        $this->db->bind(':num', 5);

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
                        WHERE crs.instructor_ID = :instID
                        GROUP BY usr.user_ID
                        ORDER BY count DESC
                        LIMIT :num
                            ');

        $this->db->bind(':instID', $_SESSION['user_id']);
        $this->db->bind(':num', 5);

        return $this->db->fetchAll();
    }

    public function getTax(){

        $this->db->query('SELECT * FROM taxes  ');
        
        $row=$this->db->fetchone();
        if($this->db->count()> 0){
            return $row;

        }
        else{
           return false;
        }

    }

}