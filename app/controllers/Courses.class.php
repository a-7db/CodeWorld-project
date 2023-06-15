<?php

class Courses extends Controller {
    
    private $cmodel;
    private $traineeModel;

    public function __construct()
    {
        $this->cmodel = $this->model('course');
        $this->traineeModel = $this->model('Trainee');
    }


    public function index($cateID = null)
    {
        $categories = $this->cmodel->get_categories();
        $tabs = '';
        $content = '';
        $count = 0;
        $courseIDs = [];
        $crsIDs = $this->cmodel->allCourses();
        foreach ($crsIDs as $crs) {
            if ($this->traineeModel->find_order($crs->crs_ID)) {
                $courseIDs[] = $crs->crs_ID;
            }
        }

        if(isset($cateID)){
            foreach ($categories as $cate) {
                // $cate_selected = URLROOT . '/' . 'Courses/' . $cate->slug . '#' . $cateID;
                if ($count == 0) {
                    $tabs .= '
                <a class="nav-link active" href="#'. $cate->slug . '" data-bs-toggle="tab" role="tab">' . $cate->name . '</a>
                ';
                    $content .= '
                <div class="tab-pane fade show active" id="' . $cate->slug . '" role="tabpanel">
                <div class="row justify-content-start">
                ';
                } else {
                    $tabs .= '
                <a class="nav-link" href="#' . $cate->slug . '" data-bs-toggle="tab" role="tab" >' . $cate->name . '</a>
                ';
                    $content .= '
                <div class="tab-pane fade" id="' . $cate->slug . '" role="tabpanel">
                <div class="row justify-content-start">
                ';
                }
                $course = $this->cmodel->get_courses_by_cate($cate->slug);

                if(isset($course)){

                    foreach ($course as $crs) {
                        $isPaied = in_array($crs->crs_ID, $courseIDs) ? 'Watch' : 'SR ' . $crs->price;
                        $url = in_array($crs->crs_ID, $courseIDs) ? URLROOT . '/courses/learn/' . $crs->crs_ID . '/' . $crs->slug : URLROOT . '/courses/details/' . $crs->crs_ID . '/' . $crs->slug;
                        $stars = '';
                        if ($crs->rating > 0) {
                            $rating = explode('.', $crs->rating);
                            $count = empty($rating[1]) ? 0 : 1;
                            $empty = 5 - ($rating[0] + $count);
                            while ($rating[0] > 0) {
                                $stars .= '<i style="margin-right: 3px;"  class="fas fa-star"></i>';
                                $rating[0]--;
                            }
                            $stars .= !empty($rating[1]) ? '<i style="margin-right: 3px;"  class="fas fa-star-half-alt"></i>' : '';
                            while ($empty > 0) {
                                $stars .= '<i style="margin-right: 3px;"  class="far fa-star fa-sm"></i>';
                                $empty--;
                            }
                        } else {
                            for ($i = 0; $i < 5; $i++) {
                                $stars .= '<i style="margin-right: 3px;"  class="far fa-star fa-sm"></i>';
                            }
                        }
                        $content .= '
                        <!-- courses item start -->
                        <div class="col-md-6 col-lg-3">
                          <div class="courses-item">
                            <a href="'. $url .'" class="link">
                              <div class="courses-item-inner">
                                <div class="img-box">
                                  <img src="' . URLROOT . '/images/courses/' . $crs->image . '" alt="course img">
                                </div>
                                <h3 class="title" style="
                                overflow: hidden;
                                display: -webkit-box;
                                -webkit-line-clamp: 2;
                                -webkit-box-orient: vertical;
                                min-height: 50px;
                                ">' . $crs->title . '</h3>
                                <div class="instructor">
                                  <img src="'. URLROOT . '/images/instructor/' . $crs->profile .'" alt="instructor img">
                                  <span class="instructor-name">'. $crs->fname .'</span>
                                </div>
                                <div class="rating">
                                  <span class="average-rating">('. number_format($crs->rating, 1) .')</span>
                                  <span class="average-stars">
                                    '.
                                        $stars
                                    .'
                                  </span>
                                  <span class="reviews">('. $crs->count_rating .')</span>
                                </div>
                                <div class="price">'. $isPaied .'</div>
                              </div>
                            </a>
                          </div>
                        </div>
                        <!-- courses item end -->
                      </div>
                    </div>
                        ';
                    }
                    $count++;
                } else{
                    $content = '';
                }
                }

            $data = [
                    'course' => $course,
                    'tabs' => $tabs,
                    'content' => $content
                ];
            $this->view('User/categories', $data);
        } else{
            $cateID = 'web-frontend';
            redirect('Courses/' . $cateID);
        }
    }


    public function details($slug)
    {
        $course = $this->cmodel->Showdetails($slug);
        $videos = $this->cmodel->getVideos($course->crs_ID);
        $count = $this->cmodel->stdTotal($course->crs_ID);
        $vid_count = $this->cmodel->vidTotal($course->crs_ID);
        $crs_count = $this->cmodel->crsTotal($course->instructor_ID);
        $review_count = $this->cmodel->reviewTotal($course->crs_ID);
        $allFeedBacks = $this->cmodel->show_feedbacks($course->crs_ID);
        $avg = $this->cmodel->AVG($course->crs_ID);
        $instructorJob = $this->cmodel->instructorJob($course->instructor_ID);
        $counter = 5;
        $list = [];

        while ($counter > 0) {
            $list[] = $this->cmodel->stu_feedback($course->crs_ID, $counter);
            $counter--;
        }
        $data = [
            'course' => $course,
            'videos' => $videos,
            'count' => $count,
            'vid_count' => $vid_count,
            'crs_count' => $crs_count,
            'review_count' => $review_count,
            'crs_count' => $crs_count,
            'isRated' => $this->cmodel->find_feedback($course->crs_ID),
            'allFeedbacks' => $allFeedBacks,
            'avg' => $avg,
            'stu_feedback' => $list,
            'instructorJob' => $instructorJob
        ];
        $this->view('User/course_details', $data);

    }
    
    public function learn($crsID, $crs_slug, $vidID = '', $vid_Slug = ''){
        $course = $this->cmodel->Showdetails($crsID);
        if(isLoggedIn() && $this->traineeModel->find_order($crsID) || isLoggedIn() && $_SESSION['user_id'] == $course->userID){
            $allClips = $this->cmodel->getVideos($crsID);
            $stdTotal = $this->cmodel->stdTotal($crsID);
            $vid_count = $this->cmodel->vidTotal($crsID);
            $crs_count = $this->cmodel->crsTotal($course->userID);
            $firstVid = $this->cmodel->showlastVid($crsID);
            $allFeedBacks = $this->cmodel->show_feedbacks($crsID);
            $review_count = $this->cmodel->reviewTotal($crsID);
            $avg = $this->cmodel->AVG($crsID);
            $instructorJob = $this->cmodel->instructorJob($course->instructor_ID);
            $counter = 5;
            $list = [];

            while($counter > 0){
               $list[] = $this->cmodel->stu_feedback($crsID, $counter);
               $counter--;
            }

            $data = [
                    'course' => $course,
                    'videos' => '',
                    'count' => $stdTotal,
                    'vid_count' => $vid_count,
                    'crs_count' => $crs_count,
                    'allClips' => $allClips,
                    'isRated' => $this->cmodel->find_feedback($crsID),
                    'allFeedbacks' => $allFeedBacks,
                    'review_count' => $review_count,
                    'avg' => $avg,
                    'stu_feedback' => $list,
                    'instructorJob' => $instructorJob

                ];
            if (empty($vidID) && empty($vid_Slug)) {
                $data['videos'] = $firstVid;
                $this->view('User/course_videos', $data);
            } else {
                $data['videos'] = $this->cmodel->getSelectedLecture($crsID, $vidID);
                $this->view('User/course_videos', $data);
            }
        } else{
            redirect();
        }

    }

    public function send_feedback($crsID, $crs_slug, $vidID, $vid_Slug)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $date = date_create();
            $data = [
                'rating' => !empty($_POST['rating'])? (float)trim($_POST['rating']) : '',
                'content' => trim($_POST['content']),
                'crsID' => $crsID,
                'dtime' => date_format($date, 'Y-m-d g:i:s A')
            ];
            
            if(empty($data['rating'])){
                if ($this->cmodel->send_comment($data)) {
                    $this->learn($crsID, $crs_slug, $vidID, $vid_Slug);
                } else {
                    $this->learn($crsID, $crs_slug, $vidID, $vid_Slug);
                }
            } else{
                if ($this->cmodel->send_feedback($data)) {
                    $this->learn($crsID, $crs_slug, $vidID, $vid_Slug);
                } else {
                    $this->learn($crsID, $crs_slug, $vidID, $vid_Slug);
                }
            }
        } else{

            $this->learn($crsID, $crs_slug, $vidID, $vid_Slug);
        }
    }

    public function search()
    {
        $courseIDs = [];
        $crsIDs = $this->cmodel->allCourses();
        foreach ($crsIDs as $crs) {
            if ($this->traineeModel->find_order($crs->crs_ID)) {
                $courseIDs[] = $crs->crs_ID;
            }
        }
        if(isset($_POST['text'])){
            $inputText = $_POST['text'];
            if($data = $this->cmodel->search($inputText)){
                foreach($data as $row){
                    $url = in_array($row->crs_ID, $courseIDs) ? URLROOT . '/courses/learn/' . $row->crs_ID . '/' . $row->slug : URLROOT . '/courses/details/' . $row->crs_ID . '/' . $row->slug;
                    echo '<a href="' . $url .'" 
                    class="list-group-item d-flex justify-content-between border-1 box" style="padding: 0.5rem 1rem; margin-bottom: 0px;">
                    <div class="d-flex align-items-center">
                    <img width="15%" src="'. URLROOT . '/images/courses/' . $row->image . '" alt="course img">
                    <div class="d-flex flex-column courses-item" style="margin: 0">
                      <h6 style="
                                overflow: hidden;
                                display: -webkit-box;
                                -webkit-line-clamp: 1;
                                -webkit-box-orient: vertical;
                                " class="mb-1 title mx-3 w-75">'. $row->title . '</h6>
                      <h6 class="mx-3">'. $row->fname .'</h6>
                    </div>
                  </div>
                </a>';
                }
            } else{
                echo '<a class="list-group-item d-flex justify-content-between border-1 box" style="padding: 0.5rem 1rem;">
                <h6>no data</h6>
                </a>';
            }
        } else{
            redirect('Courses');
        }
    }

}

?>
