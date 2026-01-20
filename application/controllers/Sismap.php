<?php
class Sismap extends CI_Controller {

    public function index()
    {
        $this->load->view('susunletak/atas');
        $this->load->view('negeri/sismap/utama');
        $this->load->view('susunletak/bawah');
    }

}