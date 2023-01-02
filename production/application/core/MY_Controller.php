<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessions extends CI_Controller {

	/**
	 * DOCU: This function render the current page
	 * Created at: Nov 1 2022
	 * @author: v88jet
	 */
	public function load_view($view, $data = []){
		$this->load->view('partials/_header', $data);
		$this->load->view($view);
		$this->load->view('partials/_footer');
	}

	/**
	 * DOCU: This function will logout the user
	 * Created at: Nov 1 2022
	 * @author: v88jet
	 */
	public function logout(){
		session_destroy();
		redirect('/');
	}
}
