<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Replies extends Sessions {

	public function __construct(){
		parent::__construct();

		//$this->session->set_userdata('user_id', 1);
		$this->user = $this->session->userdata('user_id');

		if (!$this->user){
			redirect('/');
		}
	}

	public function create(){
		$result = $this->reply->create($this->user, $this->input->post());

		if (!$result['status']){
			$this->session->set_flashdata('error', $result['message']);
		}

		redirect('/');
	}

	public function destroy(){
		$result = $this->reply->destroy($this->input->post('reply_id'));

		if (!$result['status']){
			$this->session->set_flashdata('error', $result['message']);
		}

		redirect('/');
	}
}
