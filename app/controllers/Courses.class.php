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
                                ">' . $crs->title . '</h3>
                                <div class="instructor">
                                  <img src="'. URLROOT . '/images/instructor/' . $crs->profile .'" alt="instructor img">
                                  <span class="instructor-name">'. $crs->fname .'</span>
                                </div>
                                <div class="rating">
                                  <span class="average-rating">(4.5)</span>
                                  <span class="average-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                  </span>
                                  <span class="reviews">(230)</span>
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
        $crs_count = $this->cmodel->crsTotal($course->userID);
        $data = [
            'course' => $course,
            'videos' => $videos,
            'count' => $count,
            'vid_count' => $vid_count,
            'crs_count' => $crs_count,
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
            
            $data = [
                    'course' => $course,
                    'videos' => '',
                    'count' => $stdTotal,
                    'vid_count' => $vid_count,
                    'crs_count' => $crs_count,
                    'allClips' => $allClips
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


}

?>
