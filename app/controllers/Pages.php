<?php
  class Pages extends Controller {
    public function __construct(){
    

    }

    public function index(){
      if(isLoggedIn()){
        redirect('posts');
      }
      $data = [
        'title' => 'SharePosts',
        'description' => 'Simple social network build on Felixmvc PHP frameork',
      ];

      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About Us',
         'description' => 'Simple social network build on Felixmvc PHP frameork',
      ];

      $this->view('pages/about', $data);
    }
  }