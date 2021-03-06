<?php


namespace Admin;

use Controller;
use Helper;

class RatingsController extends Controller
{
    public function index(){
        $ratings= $this->model('Rating');
        $this->view('admin' . DIRECTORY_SEPARATOR . 'comments' . DIRECTORY_SEPARATOR . 'index', ['courses' => $ratings->all(), 'deleted' => false]);
        $this->view->pageTitle = 'Ratings';
        $this->view->render();
    }

    public function addRating()
    {
        $data = array(
            ':comment_text' => $_REQUEST['commentText'],
            ':rating_number' => $_REQUEST['rating_number'],
            ':rating_date' => $_REQUEST['rating_date'],
            ':course_id' => $_REQUEST['course_id'],
            ':user_id' => $_REQUEST['user_id'],
        );
        $rating = $this->model('Rating');
        $idRating = $rating->addRating($data);
        if ($idRating>0)
        {
            echo 1;
        }
        else
            echo 0;

//        $ratingData=$rating->getRatingById($idRating);
//        $dataJson =  json_encode($ratingData);

    }

    public function deleteRating()
    {
        $data =[
            'user_id'=>$_REQUEST['user_id'],
            'course_id'=>$_REQUEST['course_id']
        ];

        $rating= $this->model('Rating');
        if($rating->deleteRating($data))
        {
          echo 1;
        }
        else 0;
    }






}