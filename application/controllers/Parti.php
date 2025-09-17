<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parti extends CI_Controller {

    public function buang_parti_pilihan()
    {
        $this->load->model('parti_model');
        $bil = $this->input->post('input_parti_pilihan');
        if(!empty($bil)){
            $this->parti_model->buang_parti_pilihan($bil);
        }
        redirect('parti/pilihan_parti', 'refresh');
    }

    public function tambah_parti_pilihan()
    {
        $this->load->model('parti_model');
        if($this->input->post('input_parti_bil') !== FALSE){
            $pengguna_bil = $this->session->userdata('pengguna_bil');
            $pengguna_waktu = date("Y-m-d H:i:s");
            $senarai_parti_bil = array();
            $senarai_parti_bil = $this->input->post('input_parti_bil');
            foreach($senarai_parti_bil as $parti_bil){
                $ada = $this->parti_model->pilihan_parti($parti_bil);
                if(empty($ada)){
                    $this->parti_model->tambah_parti_pilihan($parti_bil, $pengguna_bil, $pengguna_waktu);
                }
            }
        }
        redirect('parti/pilihan_parti', 'refresh');
    }

    public function pilihan_parti()
    {
        $this->load->model('parti_model');
        $data['senarai_bukan_parti_pilihan'] = $this->parti_model->bukan_parti_pilihan();
        $data['senarai_parti_pilihan'] = $this->parti_model->senarai_parti_pilihan();
        $this->load->view('susunletak/atas', $data);
        $this->load->view('parti/pilihan_parti');
        $this->load->view('susunletak/bawah');
    }

	public function index()
	{
        $this->load->model('pilihanraya_model');
        $this->load->model('parti_model');

        $sesi = strtoupper($this->session->userdata('peranan'));
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');

        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['senarai_parti'] = $this->parti_model->papar_semua();
		$this->load->view('susunletak/atas',$data);
		$this->load->view('parti/utama');
		$this->load->view('susunletak/bawah');
	}

	public function daftar()
    {
        $tmp_peranan = $this->session->userdata('peranan');
        if(empty($tmp_peranan)){
            redirect(base_url());
        }
        $this->load->model('pilihanraya_model');
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('parti_model');

        $data['title'] = 'Daftar Parti';

        $this->form_validation->set_rules('parti_nama', 'Nama Parti', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('susunletak/atas', $data);
            $this->load->view('parti/daftar');
            $this->load->view('susunletak/bawah');

        }
        else
        {
            $insert = $this->parti_model->daftar();
            $data['data_parti'] = $this->parti_model->papar($insert['last_id']);
            $data['daftar'] = $this->load->view('parti/daftar', $data, TRUE);
            $data['title'] = 'Daftar Parti';

            $this->load->view('susunletak/atas', $data);
            $this->load->view('parti/daftar_berjaya', $data);
            $this->load->view('susunletak/bawah');
        }
    }

    public function proses_kemaskini_jawatan()
    {
        $this->load->library('form_validation', array(), 'kemaskini_jawatan');
        $this->kemaskini_jawatan->set_rules('input_nama', 'Nama Jawatan', 'required');
        $this->kemaskini_jawatan->set_rules('input_kumpulan', 'Kumpulan Jawatan', 'required');
        $this->kemaskini_jawatan->set_message('required', 'Sila penuhi maklumat di ruangan {field}');
        $this->kemaskini_jawatan->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        if($this->kemaskini_jawatan->run() === FALSE){
            $this->kemaskini($this->input->post('input_parti_bil'));
        }else{
            $this->load->model('parti_model');
            $this->parti_model->kemaskini_jawatan();
            redirect('parti/kemaskini/'.$this->input->post('input_parti_bil'));
        }
    }

    public function kemaskini($parti_bil){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('pilihanraya_model');
        $this->load->model('parti_model');
        $this->load->model('pengguna_model');

        $sesi = strtoupper($this->session->userdata('peranan'));
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');

        $data['parti'] = $this->parti_model->papar($parti_bil);
        $data['senarai_jawatan'] = $this->parti_model->jawatan_parti($parti_bil);
        $data['senarai_kumpulan_jawatan'] = $this->parti_model->jawatan_kumpulan();
        $data['data_pengguna'] = $this->pengguna_model;

        $this->form_validation->set_rules('parti_nama', 'Nama Parti', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
            $this->load->view('susunletak/atas', $data);
            $this->load->view('parti/parti', $data);
            $this->load->view('susunletak/bawah');

        }
        else
        {
            $adjust = $this->parti_model->kemaskini();
            $data['data_parti'] = $this->parti_model->papar($adjust['last_id']);
            $data['daftar'] = $this->load->view('parti/daftar', $data, TRUE);
            $data['title'] = 'Daftar Parti';

            $this->load->view('susunletak/atas', $data);
            $this->load->view('parti/daftar_berjaya', $data);
            $this->load->view('susunletak/bawah');
        }
    }

    public function tambah_jawatan()
    {
        $this->load->library('form_validation', array(), 'tambah_jawatan');
        $this->tambah_jawatan->set_rules('input_nama', 'Nama Jawatan', 'required');
        $this->tambah_jawatan->set_rules('input_kumpulan', 'Kumpulan Jawatan', 'required');
        $this->tambah_jawatan->set_message('required', 'Sila penuhi maklumat di ruangan {field}');
        $this->tambah_jawatan->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        if($this->tambah_jawatan->run() === FALSE){
            $this->kemaskini($this->input->post('input_parti_bil'));
        }else{
            $this->load->model('parti_model');
            $this->parti_model->tambah_jawatan();
            redirect('parti/kemaskini/'.$this->input->post('input_parti_bil'));
        }
    }

    public function id($parti_bil){
        $this->load->model('pilihanraya_model');
        $this->load->model('parti_model');
        $this->load->model('pencalonan_model');
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['parti'] = $this->parti_model->papar($parti_bil);
        $data['bilangan_calon'] = count($this->parti_model->bilangan_calon($parti_bil));
        $data['pencalonan'] = $this->pencalonan_model;
            $this->load->view('susunletak/atas', $data);
            $this->load->view('parti/maklumat');
            $this->load->view('susunletak/bawah');
    }

    public function rumusan(){
        $tmp_pr = $this->input->post('pilihanraya_bil');
        $tmp_parti_bil = $this->input->post('parti_bil');
        $tmp_peranan = $this->session->userdata('peranan');
        if(empty($tmp_pr) || empty($tmp_parti_bil)){
            redirect('pengguna/logout');
        }
        if(empty($tmp_peranan)){
            redirect('pengguna/logout');
        }
        if(strtoupper($this->session->userdata('peranan')) != 'ADMIN'){
            redirect('pengguna/logout');
        }
        $this->load->model('pilihanraya_model');
        $this->load->model('dun_model');
        $this->load->model('pencalonan_model');
        $this->load->model('ahli_model');
        $this->load->model('parti_model');
        $this->load->model('pengundi_model');
        $this->load->model('harian_model');
        $data['senarai_parti'] = $this->parti_model->senarai_rumusan_parti($this->input->post('parti_bil'), $this->input->post('pilihanraya_bil'));
        $data['senarai_calon'] = $this->pencalonan_model->senarai_parti_calon($this->input->post('parti_bil'), $this->input->post('pilihanraya_bil'));
        if(empty($data['senarai_calon'])){
            redirect('pilihanraya/grading/'.$this->input->post('pilihanraya_bil'));
        }
        $data['model_parti'] = $this->parti_model;
        $data['model_ahli'] = $this->ahli_model;
        $this->load->view('admin/atas', $data);
        $this->load->view('admin/parti');
        $this->load->view('admin/bawah');
    }

    public function tukar_warna()
    {
        $tmp_parti_bil = $this->input->post('parti_bil');
        if(empty($tmp_parti_bil)){
            redirect(base_url());
        }
        $this->load->model('parti_model');
        $parti_warna = "background-color: ".$this->input->post('warna_parti')."; color: ".$this->input->post('warna_teks').";";
        $this->parti_model->tukar_warna($this->input->post('parti_bil'), $parti_warna);
        redirect("parti/kemaskini/".$this->input->post("parti_bil"), 'refresh');
    }

    public function tukar_umum()
    {
        $tmp_parti_bil = $this->input->post('parti_bil');
        if(empty($tmp_parti_bil)){
            redirect(base_url());
        }
        $this->load->model('parti_model');
        $this->parti_model->tukar_umum(
            $this->input->post('parti_bil'), 
            $this->input->post('parti_nama'), 
            $this->input->post('parti_singkatan'),
            $this->input->post('parti_jenis')
        );
        redirect("parti/kemaskini/".$this->input->post("parti_bil"), 'refresh');
    }

    public function padam()
    {
        $tmp_parti_bil = $this->input->post('parti_bil');
        $tmp_kebenaran = $this->input->post('kebenaran');
        if(empty($tmp_parti_bil) && empty($tmp_kebenaran)){
            redirect(base_url());
        }
        if($tmp_kebenaran != 'Benar')
        {
            redirect(base_url());
        }
        $this->load->model('parti_model');
        $this->load->model('pencalonan_model');
        $this->load->model('status_grading_model');
        $this->parti_model->padam($this->input->post('parti_bil'));
        $senarai_pencalonan = $this->pencalonan_model->ikut_parti($this->input->post('parti_bil'));
        foreach($senarai_pencalonan as $calon)
        {
            $this->status_grading_model->padam_pencalonan($calon->pencalonan_bil);
        }
        $this->pencalonan_model->padam_parti($this->input->post('parti_bil'));
        redirect("parti", 'refresh');
    }

}
