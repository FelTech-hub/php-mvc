<?php

  class Posts extends Controller {

    public function __construct(){
      if(!isLoggedIn()){
          redirect('users/login');
      }

      $this->postModel = $this->model('Post');
			$this->userModel = $this->model('User');
    }

    public function index(){
      $post = $this->postModel->getPosts();
      $data = [
        'posts' => $post
    	];

      $this->view('posts/index', $data);
    }

		// Add Method
    public function add(){
     if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Sanitize Data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
					'title' => trim($_POST['title']),
					'body' => trim($_POST['body']),
					'user_id' => $_SESSION['user_id'],
					'title_err' => '',
					'body_err' => ''
        ];

        // Validate Data
        if(empty($data['title'])){
          $data['title_err'] = 'Field can not be empty, enter title';
        }
        if(empty($data['body'])){
          $data['body_err'] = 'Field can not be empty, enetr body text';
        }

        // Make sure no errors
        if(empty($data['title_err']) && empty($data['body_err'])){
          // Valideate
          if($this->postModel->addPost($data)){
              flash('post_message', 'Post Added');
              redirect('posts');
          	} else {
							die('Something went wrong');
        	}

    		} else {
        // Load View
        $this->view('posts/add', $data);
    	}
		} else {
    	$data = [
        'title' => '',
        'body' => ''
    ];

		$this->view('posts/add', $data);

    }


  	}


		// Edit Method
    public function edit($id){
     if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Sanitize Data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
					'id' => $id,
					'title' => trim($_POST['title']),
					'body' => trim($_POST['body']),
					'user_id' => $_SESSION['user_id'],
					'title_err' => '',
					'body_err' => ''
        ];

        // Validate Data
        if(empty($data['title'])){
          $data['title_err'] = 'Field can not be empty, enter title';
        }
        if(empty($data['body'])){
          $data['body_err'] = 'Field can not be empty, enetr body text';
        }

        // Make sure no errors
        if(empty($data['title_err']) && empty($data['body_err'])){
          // Valideate
          if($this->postModel->updatePosts($data)){
              flash('post_message', 'Post Updated');
              redirect('posts');
          	} else {
							die('Something went wrong');
        	}

    		} else {
        // Load View
        $this->view('posts/edit', $data);
    	}

		} else {
			// Get existing post from model
			$post = $this->postModel->getPostById($id);
			//Check for owner
			if($post->user_id != $_SESSION['user_id']){
				redirect('posts');
			}

    	$data = [
				'id' => $id,
        'title' => $post->title,
        'body' => $post->body
    ];

		$this->view('posts/edit', $data);

    }
  }


		public function show($id){
			$post = $this->postModel->getPostById($id);
			$user = $this->userModel->getUserByid($post->user_id);
			$data = [
				'posts' => $post,
				'user' => $user
			];

			$this->view('posts/show', $data);
		}

		public function delete($id){
			if($_SERVER['REQUEST_METHOD']){

				$post = $this->postModel->getPostById($id);
				//Check for owner
					if($post->user_id != $_SESSION['user_id']){
					redirect('posts');
				}
				if($this->postModel->deletePost($id)){
					flash('post_message', 'Post Deleted');
					redirect('posts');
				} else {
					die('Something went wrong');
				}

			} else{
				redirect('posts');
			}
		}
  }

?>