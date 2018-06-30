<?php
	class posts extends CI_controller{
		public function index(){

			$data =null;
			
			
			$data['title'] = 'Latest post';

			$this->load->model('Post_model');

			$data['posts'] = $this->Post_model-> get_posts();
			
			$this->load->view('templets/headers');
			$this->load->view('posts/index',$data);
			$this->load->view('templets/footer');
		}

			public function view($slug = NULL){

				$data['post'] = null;
				$data['post'] = $this->Post_model->get_posts($slug);

				if(empty($data['post'])){
					show_404();
				}

				$data['title'] = $data['post']['title'];
			
			$this->load->view('templets/headers');
			$this->load->view('posts/view',$data);
			$this->load->view('templets/footer');
		}

		public function create(){
			$data['title']= 'create post';

			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('body', 'Body', 'required');

			if($this->form_validation->run() === FALSE){
		
				$this->load->view('templets/headers');
				$this->load->view('posts/create',$data);
				$this->load->view('templets/footer');
			   } else {
			   	$this->Post_model->create_post();
		        redirect('posts');

	 		
				}

			}
	}
	
