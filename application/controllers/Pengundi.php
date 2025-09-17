<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengundi extends CI_Controller {

	public function jumlah(){
		if(empty($this->input->post('pengundi_bil'))){
			redirect(base_url());
		}
		$this->load->model('pengundi_model');
		$this->pengundi_model->set_pengundi($this->input->post('pengundi_bil'), $this->input->post('pengundi_jumlah'));
		redirect('dun/papar_dun/'.$this->input->post('dun_bil'), 'refresh');
		
	}

	



}