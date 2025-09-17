<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kpi extends CI_Controller {

    public function index()
    {
        $this->load->model('jenis_model');
        $this->load->model('japen_model');
        $this->load->model('kpi_model');
        $data['data_kpi'] = $this->kpi_model;
        $data['senarai_jabatan'] = $this->japen_model->senaraiJapen();
        $data['senarai_jenis_program'] = $this->jenis_model->semua();
        $this->load->view('susunletak/atas', $data);
        $this->load->view('kpi/utama');
        $this->load->view('susunletak/bawah');   
    }

    public function proses_kemaskini()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_bilangan', 'Bilangan KPI', 'regex_match["^[0-9]*$"]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
        $this->form_validation->set_message('regex_match', 'Sila gunakan nombor sahaja');
        if($this->form_validation->run() === FALSE){
            $this->index();
        }else{
            $this->load->model('kpi_model');
            $this->kpi_model->kemaskini();
            $this->index();
        }
    }
}