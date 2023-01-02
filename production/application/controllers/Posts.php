<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends Sessions {

	public function __construct(){
		parent::__construct();

		//$this->session->set_userdata('user_id', 1);
		$this->user = $this->session->userdata('user_id');

		if (!$this->user){
			redirect('/');
		}
	}

	public function index(){
		$result = $this->post->get_all_records();
		$this->load_view('posts/index', ['posts' => $result]);
	}

	public function create(){
		$result = $this->post->create($this->user, $this->input->post());

		if (!$result['status']){
			$this->session->set_flashdata('error', $result['message']);
		}

		redirect('/');
	}

	public function destroy(){
		$result = $this->post->destroy($this->input->post('post_id'));

		if (!$result['status']){
			$this->session->set_flashdata('error', $result['message']);
		}

		redirect('/');
	}
}
