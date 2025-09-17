<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {

  public function padam(){
    $jenisBil = $this->input->post('inputJenisBil');
    if(empty($jenisBil)){
      redirect(base_url());
    }
    $sesi = strtoupper($this->session->userdata('peranan'));
    switch($sesi){
      case 'US_PROGRAM' :
        $this->load->model('jenis_model');
        $entri = $this->jenis_model->padam($jenisBil);
        if($entri){
          redirect('jenis');
        }else{
          die("TERDAPAT MASALAH. HUBUNGI URUS SETIA.");
        }
        break;
      default :
        redirect(base_url());
    }
  }

  public function kemaskini(){
    $jenisBil = $this->input->post('inputBil');
    if(empty($jenisBil)){
      redirect(base_url());
    }
    $this->load->model('jenis_model');
    $entri = $this->jenis_model->kemaskiniPost();
    if($entri){
      redirect('jenis');
    }else{
      die('Terdapat masalah');
    }
  }

  //1. VIEW ALL
  //1.1 VIEW HOME
  public function index()
  {
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $this->load->model('pengguna_model');
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    switch($sesi){
      case 'DATA' :
        $this->load->model('jenis_model');
        $data['senaraiJenis'] = $this->jenis_model->semua();
        $this->load->view('us_sismap_na/konfigurasi/jenisProgram/laman', $data);
        break;
      case 'URUSETIA' :
        $this->load->model('jenis_model');
        $data['senaraiJenis'] = $this->jenis_model->semua();
        $this->load->view('urusetia_na/konfigurasi/jenisProgram/laman', $data);
        break;
      case 'US_PROGRAM' :
        $this->load->model('jenis_model');
        $data['senaraiJenis'] = $this->jenis_model->semua();
        $this->load->view('us_program_na/konfigurasi/jenisProgram/laman', $data);
        break;
      default :
        redirect(base_url());
    }
  }

  //2. ADD NEW
  public function tambah()
  {
    $sesi = strtoupper($this->session->userdata('peranan'));
    switch($sesi){
      case 'US_PROGRAM' :
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->view('susunletak/atas');
    $this->load->view('program/tambah_jenis');
    $this->load->view('susunletak/bawah');
    break;
  default :
    redirect(base_url());
}
  }

  //3. PROCESS ADDING
  public function proses_tambah()
  {
    $sesi = strtoupper($this->session->userdata('peranan'));
    switch($sesi){
      case 'US_PROGRAM' :
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('inputJenis', 'Nama Jenis Program', 'required');
    $this->form_validation->set_error_delimiters("<div class='alert alert-warning'>", "</div>");
    $this->form_validation->set_message('required', 'Sila pasti maklumat %s telah dipenuhi');
    if($this->form_validation->run() === FALSE){
      $this->tambah();
    }else{
      $this->load->model('jenis_model');
      $this->jenis_model->tambah();
      $this->load->view('susunletak/atas');
      $this->load->view('program/berjaya_jenis');
      $this->load->view('susunletak/bawah');
    }
    break;
  default :
    redirect(base_url());
}
  }

}
