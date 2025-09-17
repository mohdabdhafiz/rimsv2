<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iow extends CI_Controller {

	public function index()
	{
		$this->load->view('susunletak/atas');
		$this->load->view('iow/lihat_semua');
		$this->load->view('susunletak/bawah');
	}

    public function laporan_iow($id_laporan) {
        $data['id_laporan'] = $id_laporan;
        $this->load->view('susunletak/atas');
        $this->load->view('iow/laporan_iow', $data);
        $this->load->view('susunletak/bawah');
    }
}
