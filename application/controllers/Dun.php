<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dun extends CI_Controller {

    public function getBilanganPengundi($dunBil){
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));

        if(strpos($sesi, 'PERUMUS') !== FALSE){
            $sesi = 'PERUMUS';
        }

        //ACCORDINGLY
        switch($sesi){
            case 'PERUMUS' :
                //INITIAL
                $bilanganPengundi = 0;

                //LOAD MODEL
                $this->load->model('pdm_model');

                //PROSES DATA
                $bilanganPengundi = $this->pdm_model->jumlah_pengundi_dun($dunBil);

                //RETURN JSON
                echo json_encode($bilanganPengundi->jumlah);

                break;
            default :
                redirect(base_url());
        }

    }

    public function index()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('negeri_model');
                $this->load->model('dun_model');
                $data['header'] = 'negeri_na/susunletak/atas';
                $data['navbar'] = 'negeri_na/susunletak/navbar';
                $data['sidebar'] = 'negeri_na/susunletak/sidebar';
                $data['footer'] = 'negeri_na/susunletak/bawah';
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiDun'] = $this->dun_model->senaraiDunNegeri($senaraiNegeri);
                $this->load->view('dun/laman', $data);
                break;
            case 'URUSETIA':
                $this->load->model('dun_model');
                $this->load->model('kapar_kadun_model');
                $this->load->model('parlimen_model');
                $this->load->model('negeri_model');
                $data['data_dun'] = $this->dun_model;
                $data['senarai_negeri'] = $this->negeri_model->senarai();
                $data['senarai_dun'] = $this->dun_model->papar_semua();
                $data['data_kapar_kadun'] = $this->kapar_kadun_model;
                $data['data_parlimen'] = $this->parlimen_model;
                $this->load->view('susunletak/atas', $data);
                $this->load->view('dun/utama');
                $this->load->view('susunletak/bawah');
                break;
            default :
                redirect(base_url());
        }
    }

    public function daftar()
{   
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->model('dun_model');
    $this->load->model('pilihanraya_model');
    $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['pilihanraya_bil'] = $pilihanraya_bil;
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
    

    $data['title'] = 'Tambah DUN';

    $this->form_validation->set_rules('dun_nama', 'Nama DUN', 'required');

    if ($this->form_validation->run() === FALSE)
    {
        $this->load->view('susunletak/atas', $data);
        $this->load->view('dun/daftar', $data);
        $this->load->view('susunletak/bawah');

    }
    else
    {
        $insert = $this->dun_model->daftar();
        $data['data_dun'] = $this->dun_model->papar($insert['last_id']);
        $data['daftar'] = $this->load->view('dun/daftar', $data, TRUE);
        $data['title'] = 'Tambah DUN';
        $this->load->view('susunletak/atas', $data);
        $this->load->view('dun/daftar_berjaya', $data);
        $this->load->view('susunletak/bawah');
    }
}

    public function papar_dun($bil){
        $this->load->model('dun_model');
        $tmp_dun = $this->dun_model->papar($bil);
        if(empty($bil) || empty($tmp_dun)){
            redirect(base_url());
        }
        $tmp_peranan = $this->session->userdata('peranan');
        if(empty($tmp_peranan)){
            redirect('pengguna/logout');
        }
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_model');
        $this->load->model('parti_model');
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['pilihanraya_bil'] = $pilihanraya_bil;
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['dun'] = $this->dun_model->papar($bil);
        $data['pencalonan_dun'] = $this->pencalonan_model->senaraiCalon($bil, $pilihanraya_bil);
        $data['senarai_parti'] = $this->parti_model->papar_semua();
        $data['semua_pilihanraya'] = $this->pilihanraya_model->papar_semua();
        $sesi = strtoupper($this->session->userdata('peranan'));
        switch($sesi){
            case 'PEGAWAI LAPANGAN' :   $this->load->model('pengguna_model');
                                        $this->load->model('ahli_model');
                                        $this->load->model('parti_model');
                                        $data['maklumat_pengguna'] = $this->pengguna_model->maklumat_pengguna($this->session->userdata('pengguna_bil'));  
                                        $data['ahli'] = $this->ahli_model;
                                        $data['parti'] = $this->parti_model;
                                        
                                        //SISMAP
                                        $this->load->model('status_grading_model');
                                        $this->load->model('harian_model');
                                        $this->load->model('pengundi_model');
                                        $data['senarai_tarikh'] = $this->status_grading_model->senarai_tarikh($pilihanraya_bil, $bil);
                                        $data['harian'] = $this->harian_model->papar_ikut_dun($bil, $pilihanraya_bil);
                                        $data['undi'] = $this->pengundi_model->semakAda($bil, $pilihanraya_bil);
                                        $data['senarai_grading'] = $this->status_grading_model->papar_ikut_dun($bil);

                                        $data['calon_daftar'] = $this->pencalonan_model->senarai_calon_bertanding($pilihanraya_bil, $bil);
                                        foreach($data['pilihanraya'] as $pru){
                                            $tarikh_mula = strtotime($pru->pilihanraya_penamaan_calon);
                                            $tarikh_tamat = strtotime($pru->pilihanraya_lock_status);
                                            $tarikh_lock_status = $pru->pilihanraya_lock_status;
                                        }
                                        for($i = $tarikh_mula; $i <= $tarikh_tamat; $i = $i + 86400){
                                            $hari = date('Y-m-d', $i);
                                            $this->harian_model->calibrate($bil, $pilihanraya_bil, $hari);
                                            foreach($data['calon_daftar'] as $calon){
                                                $this->status_grading_model->calibrate($calon->pencalonan_bil, $hari);
                                            }
                                        }
                                        if(empty($data['undi'])){
                                            $this->pengundi_model->cipta($bil, $pilihanraya_bil, 40000);
                                            redirect('dun/papar_dun/'.$bil, 'refresh');
                                        }
                                        $data['undi'] = $this->pengundi_model->semakAda($bil, $pilihanraya_bil);
                                        $tarikh_hari_ini = date("Y-m-d");
                                        if($tarikh_hari_ini > $tarikh_lock_status){
                                            $tarikh_hari_ini = $tarikh_lock_status;
                                        }
                                        $data['senarai_calon'] = $this->pencalonan_model->senarai_rumusan_calon2($pilihanraya_bil, $bil, $tarikh_hari_ini);
                                        $data['stat'] = $this->harian_model->semak_ikut_tarikh($bil, $pilihanraya_bil, $tarikh_hari_ini);
                                        $this->load->view('pegawai_lapangan/atas', $data);
                                        $this->load->view('dun/dun_lapangan');
                                        $this->load->view('pegawai_lapangan/bawah');  
                                        break;

            
            default                 :   
                                        $data['senarai_pilihanraya'] = $this->pilihanraya_model->papar_aktif();
                                        $this->load->view('susunletak/atas', $data);
                                        $this->load->view('dun/dun');
                                        $this->load->view('susunletak/bawah');
        }
        
    }

    public function cari(){
        $tmp_peranan = $this->session->userdata('peranan');
        if(empty($tmp_peranan)){
            redirect('pengguna/logout');
        }
        $tmp_dun_nama = $this->input->post('dun_nama');
        if($tmp_dun_nama == ""){
            redirect('utama');
        }
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_model');
        $this->load->model('parti_model');
        $this->load->model('dun_model');
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['pilihanraya_bil'] = $pilihanraya_bil;
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $hasil_carian = $this->dun_model->carian();
        if(count($hasil_carian) == 0){
            redirect(base_url());
        }elseif(count($hasil_carian) == 1){
            foreach($hasil_carian as $c){
                $bil = $c->dun_bil;
            }
            redirect('dun/papar_dun/'.$bil);
        }else{
            $cari = 0;
            foreach($hasil_carian as $c){

                $data['dun'][$cari++] = $this->dun_model->papar($c->dun_bil);
                $data['pencalonan_dun'][$cari] = $this->pencalonan_model->papar_ikut_dun($c->dun_bil);
            }
            $data['senarai_parti'] = $this->parti_model->papar_semua();
            $data['semua_pilihanraya'] = $this->pilihanraya_model->papar_semua();
            $this->load->model('pengguna_model');
            $data['maklumat_pengguna'] = $this->pengguna_model->maklumat_pengguna($this->session->userdata('pengguna_bil'));
            $this->load->view('pegawai_lapangan/atas', $data);
            $this->load->view('pegawai_lapangan/pilih_carian');
            $this->load->view('pegawai_lapangan/bawah');
        }
        
    }

    public function rumusan(){
        $tmp_pru_bil = $this->input->post('pilihanraya_bil');
        $tmp_dun_bil = $this->input->post('dun_bil');
        $tmp_peranan = $this->session->userdata('peranan');
        if(empty($tmp_pru_bil) || empty($tmp_dun_bil)){
            redirect('pengguna/logout');
        }
        if(empty($tmp_peranan)){
            redirect('pengguna/logout');
        }
        if(strtoupper($tmp_peranan) != 'ADMIN'){
            redirect('pengguna/logout');
        }
        $this->load->model('pilihanraya_model');
        $this->load->model('dun_model');
        $this->load->model('pencalonan_model');
        $this->load->model('ahli_model');
        $this->load->model('parti_model');
        $this->load->model('pengundi_model');
        $this->load->model('harian_model');
        $data['parti'] = $this->parti_model;
        $data['senarai_pilihanraya'] = $this->pilihanraya_model->papar($this->input->post('pilihanraya_bil'));
        $data['senarai_dun'] = $this->dun_model->papar($this->input->post('dun_bil'));

        $data['senarai_dun_2'] = $this->dun_model->dun_ikut_pilihanraya($this->input->post('pilihanraya_bil'));
        $data['senarai_calon'] = $this->pencalonan_model->senarai_rumusan_calon($this->input->post('pilihanraya_bil'), $this->input->post('dun_bil'));
        $data['ahli'] = $this->ahli_model;
        $data['jumlah_undi'] = $this->pengundi_model->papar_ikut_dun($this->input->post('dun_bil'), $this->input->post('pilihanraya_bil'));
        $data['harian_dun'] = $this->harian_model->semakAda($this->input->post('dun_bil'), $this->input->post('pilihanraya_bil'));
        $data['peratus_keluar_mengundi'] = 0.65;
        if(empty($data['senarai_calon'])){
            redirect('pilihanraya/grading/'.$this->input->post('pilihanraya_bil'));
        }
        $this->load->view('admin/atas', $data);
        $this->load->view('admin/dun');
        $this->load->view('admin/bawah');
    }

    public function status_harian3()
    {
        $tmp_dun_bil = $this->input->post('dun_bil');
        if(empty($tmp_dun_bil)){
            redirect(base_url());
        }
        $this->load->model('harian_model');
        $this->load->model('status_grading_model');
        $this->load->model('pengundi_model');
        $this->harian_model->set_keluar_mengundi($this->input->post('harian_bil'), $this->input->post('harian_keluar_mengundi'));
        $this->harian_model->set_atas_pagar($this->input->post('harian_bil'), $this->input->post('harian_atas_pagar'));
        $status_grading_peratus = $this->input->post('status_grading_peratus');
        $status_grading_bil = $this->input->post('status_grading_bil');
        $penjuru = $this->input->post('penjuru');
        for($i = 0; $i < count($status_grading_bil); $i++){
            $this->status_grading_model->set($status_grading_bil[$i], $status_grading_peratus[$i]);
        }
        $majoriti = number_format($this->input->post('peratus_majoriti'),2);
        $grade = 'HITAM';
        $warna = 'background:black; color:white';
        if(10.01 <= $majoriti){
            $grade = 'PUTIH';
            $warna = 'background:white; color:black';
        }
        if($majoriti >= 0.00 && $majoriti <= 10.00){
            $grade = 'KELABU PUTIH';
            $warna = 'background:#BEBEBE; color:black';
        }
        if($majoriti <= -0.01 && $majoriti >= -10.00){
            $grade = 'KELABU HITAM';
            $warna = 'background:#696969; color:white';
        }
        if($majoriti <= -10.01){
            $grade = 'HITAM';
            $warna = 'background:#000000; color:white';
        }
        var_dump($majoriti);
        $this->harian_model->set_grading($this->input->post('harian_bil'), $grade, $warna);
        //redirect('dun/papar_dun/'.$this->input->post('dun_bil'), 'refresh');
    }

    public function status_harian(){
        $tmp_dun_bil = $this->input->post('dun_bil');
        if(empty($tmp_dun_bil)){
            redirect(base_url());
        }
        $this->load->model('harian_model');
        $this->load->model('status_grading_model');
        $this->load->model('pengundi_model');
        $this->harian_model->set_keluar_mengundi($this->input->post('harian_bil'), $this->input->post('harian_keluar_mengundi'));
        $this->harian_model->set_atas_pagar($this->input->post('harian_bil'), $this->input->post('harian_atas_pagar'));
        $status_grading_peratus = $this->input->post('status_grading_peratus');
        $status_grading_bil = $this->input->post('status_grading_bil');
        $penjuru = $this->input->post('penjuru');
        for($i = 0; $i < count($status_grading_bil); $i++){
            $this->status_grading_model->set($status_grading_bil[$i], $status_grading_peratus[$i]);
        }
        $tarikh = $this->input->post('tarikh');
        $maklumat_pengundi = $this->pengundi_model->semakAda($this->input->post('dun_bil'), $this->session->userdata('pilihanraya_bil'));
        $jumlah_pengundi = 0;
        $jangkaan_keluar_mengundi = (int)$this->input->post('harian_keluar_mengundi');
        foreach($maklumat_pengundi as $undi)
        {
            $jumlah_pengundi = $undi->pengundi_jumlah;   
        }
        $keluar = floor(($jangkaan_keluar_mengundi/100)*$jumlah_pengundi);

        
        $maklumat_pengundi_bukan_bn = $this->status_grading_model->susunan_ikut_hari_selain_bn($this->session->userdata('pilihanraya_bil'), $this->input->post('dun_bil'), $tarikh);
        $maklumat_pengundi_bn = $this->status_grading_model->grading_bn($this->session->userdata('pilihanraya_bil'), $this->input->post('dun_bil'), $tarikh);
        $undi_bukan_bn = 0;
        $undi_bn = 0;
        foreach($maklumat_pengundi_bukan_bn as $notbn)
        {
            $undi_bukan_bn = floor(($notbn->status_grading_peratus/100)*$keluar);
        }
        foreach($maklumat_pengundi_bn as $bn)
        {
            $undi_bn = floor(($bn->status_grading_peratus/100)*$keluar);
        }
        $m = $undi_bn - $undi_bukan_bn;
        $majoriti = ($m/$keluar)*100;
        $grade = 'HITAM';
        $warna = 'background:black; color:white';
        if(10.01 <= $majoriti){
            $grade = 'PUTIH';
            $warna = 'background:#FFFFFF; color:black';
        }
        if($majoriti >= 0.00 && $majoriti <= 10.00){
            $grade = 'KELABU PUTIH';
            $warna = 'background:#BEBEBE; color:black';
        }
        if($majoriti <= -0.01 && $majoriti >= -10.00){
            $grade = 'KELABU HITAM';
            $warna = 'background:#696969; color:white';
        }
        if($majoriti <= -10.01){
            $grade = 'HITAM';
            $warna = 'background:#000000; color:white';
        }
        $this->harian_model->set_grading($this->input->post('harian_bil'), $grade, $warna);
        redirect('dun/papar_dun/'.$this->input->post('dun_bil'), 'refresh');
    }

    public function pilih_kapar(){
        
    }

    public function negeri($negeri_bil)
    {
        $tmp_peranan = $this->session->userdata('peranan');
        if($tmp_peranan != 'Urusetia'){
            redirect(base_url());
        }
        $this->load->model('negeri_model');
        $negeri = $this->negeri_model->negeri($negeri_bil);
        if(empty($negeri)){
            redirect(base_url());
        }
        $nama_negeri = $negeri->nt_nama;
        $data['negeri'] = $negeri;
        $this->load->model('dun_model');
        $data['senarai_dun'] = $this->dun_model->ikut_negeri($nama_negeri);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/dun');
        $this->load->view('susunletak/bawah');
    }

    public function proses_padam()
    {
        $tmp_peranan = $this->session->userdata('peranan');
        if($tmp_peranan != 'Urusetia'){
            redirect(base_url());
        }
        $this->load->model('negeri_model');
        $negeri_bil = $this->input->post('input_negeri_bil');
        $negeri = $this->negeri_model->negeri($negeri_bil);
        if(empty($negeri)){
            redirect(base_url());
        }
        $this->load->model('dun_model');
        $this->dun_model->padam($this->input->post('input_dun_bil'));
        redirect('dun/negeri/'.$negeri_bil, 'refresh');
    }

    public function tambah_negeri()
    {
        $negeri_bil = $this->input->post('input_negeri_bil');
        $nama_dun = $this->input->post('dun_nama');
        if(empty($nama_dun)){
            redirect(base_url()."index.php/dun/negeri/".$negeri_bil, 'refresh');
        }
        $this->load->model('dun_model');
        $tambah = $this->dun_model->daftar();
        redirect(base_url()."index.php/dun/negeri/".$negeri_bil, 'refresh');
    }

    public function tambah_jangkaan_calon()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
		{
			redirect(base_url());
		}
        $this->load->library('form_validation');
        $this->load->model('parti_model');
        $this->load->model('dun_model');
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('pengguna_model');
        $this->load->model('japen_model');
		$data['data_japen'] = $this->japen_model;
        $data['senarai_parti'] = $this->parti_model->senarai_jenis("Parti Komponen");
        $data['data_dun'] = $this->dun_model;
		$data['pengguna'] = $this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'));
        $data['data_assign'] = $this->winnable_candidate_assign_model;
        $data['data_parti'] = $this->parti_model;
        $data['senarai_kumpulan_jawatan'] = $this->parti_model->jawatan_kumpulan();
        $this->load->view('susunletak/atas', $data);
        $this->load->view('dun/tambah_jangkaan_calon');
        $this->load->view('susunletak/bawah');
    }

    public function proses_gambar($calon_id)
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
		{
			redirect(base_url());
		}
        $this->load->model('jangka_dun_model');
        $this->load->model('foto_model');
        $this->load->model('dun_model');
        $data['calon'] = $this->jangka_dun_model->calon_id($calon_id);
        $data['data_foto'] = $this->foto_model;
        $data['data_dun'] = $this->dun_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('dun/tambah_jangkaan_calon_2');
        $this->load->view('susunletak/bawah');
    }

    function pilih_check($str)
    {
        if ($str == 0)
                {
                        $this->form_validation->set_message('pilih_check', 'Sila pilih di ruangan {field}');
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
    }

    public function proses_jangkaan_calon()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
		{
			redirect(base_url());
		}
        $this->load->library('form_validation');
        $this->load->model('jangka_dun_model');
        $this->form_validation->set_rules('input_dun_bil', 'DUN', 'callback_pilih_check');
        $this->form_validation->set_rules('input_nama_penuh', 'Nama Calon', 'required');
        $this->form_validation->set_rules('input_parti_bil', 'Parti', 'callback_pilih_check');
        $this->form_validation->set_rules('input_jawatan_parti', 'Jawatan Parti', 'required');
        $this->form_validation->set_rules('input_kategori_umur', 'Kategori Umur', 'callback_pilih_check');
        $this->form_validation->set_message('required', 'Sila penuhi maklumat di ruangan {field}');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        if($this->form_validation->run() === FALSE){
            $this->tambah_jangkaan_calon();
        }else{
            $data_calon = $this->jangka_dun_model->daftar();
            $this->proses_gambar($data_calon['last_id']);
        }
    }

    public function senarai_negeri()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
		{
			redirect(base_url());
		}
        $this->load->model('dun_model');
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('jangka_dun_model');
        $this->load->model('pengguna_model');
        $this->load->model('foto_model');
        $pengguna = $this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'));
        $assign = $this->winnable_candidate_assign_model->assign($pengguna->pengguna_peranan_bil);
        if(empty($assign)){
            $negeri = "";
            $senarai_dun = $this->dun_model->ikut_tugasan($pengguna->pengguna_peranan_bil);
        }else{
            $negeri = $assign->wcat_negeri;
            $senarai_dun = $this->dun_model->ikut_negeri($assign->wcat_negeri);
        }
        $data['negeri'] = $negeri;
        $data['senarai_dun_negeri'] = $senarai_dun;
        $data['data_calon'] = $this->jangka_dun_model;
        $data['data_foto'] = $this->foto_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('dun/senarai_negeri');
        $this->load->view('susunletak/bawah');
    }

    public function senarai_jangkaan_calon($dun_bil)
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
		{
			redirect(base_url());
		}
        $this->load->model('dun_model');
        $this->load->model('jangka_dun_model');
        $this->load->model('foto_model');
        $this->load->model('parti_model');
        $data['data_parti'] = $this->parti_model;
        $data['data_foto'] = $this->foto_model;
        $data['dun'] = $this->dun_model->dun_bil($dun_bil);
        $data['senarai_calon'] = $this->jangka_dun_model->calon_dun($dun_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('dun/senarai_jdt');
        $this->load->view('susunletak/bawah');
    }

    public function kemaskini_jangkaan_dun($dun_bil)
    {

        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
		{
			redirect(base_url());
		}
        $this->load->library('form_validation');
        $this->load->model('dun_model');
        $this->load->model('jangka_dun_model');
        $this->load->model('foto_model');
        $this->load->model('parti_model');
        $data['senarai_parti'] = $this->parti_model->senarai();
        $data['data_foto'] = $this->foto_model;
        $data['dun'] = $this->dun_model->dun_bil($dun_bil);
        $data['senarai_calon'] = $this->jangka_dun_model->calon_dun($dun_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('dun/kemaskini_jdt');
        $this->load->view('susunletak/bawah');
    }

    public function proses_kemaskini()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
		{
			redirect(base_url());
		}
        $tmp_jdt_bil = $this->input->post('input_jdt_bil');
        if(empty($tmp_jdt_bil)){
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->load->model('jangka_dun_model');
        $this->form_validation->set_rules('input_nama_penuh', 'Nama Calon', 'required');
        $this->form_validation->set_rules('input_parti_bil', 'Parti', 'callback_pilih_check');
        $this->form_validation->set_rules('input_kategori_umur', 'Kategori Umur', 'callback_pilih_check');
        $this->form_validation->set_message('required', 'Sila penuhi maklumat di ruangan {field}');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        if($this->form_validation->run() === FALSE){
            $this->kemaskini_jangkaan_dun($this->input->post('input_dun_bil'));
        }else{
            $this->jangka_dun_model->kemaskini_calon();
            $this->kemaskini_jangkaan_dun($this->input->post('input_dun_bil'));
        }
    }

    public function verify_padam($jdt_bil)
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
		{
			redirect(base_url());
		}
        if(empty($jdt_bil)){
            redirect(base_url());
        }
        $this->load->model('jangka_dun_model');
        $this->load->model('dun_model');
        $this->load->model('parti_model');
        $data['calon'] = $this->jangka_dun_model->calon_id($jdt_bil);
        $data['data_dun'] = $this->dun_model;
        $data['data_parti'] = $this->parti_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('dun/verify_padam');
        $this->load->view('susunletak/bawah');
    }

    public function padam_jangkaan_calon()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
		{
			redirect(base_url());
		}
        $tmp_jdt_bil = $this->input->post('input_jdt_bil');
        $tmp_foto_bil = $this->input->post('input_foto_bil');
        $tmp_dun_bil = $this->input->post('input_dun_bil');
        if(empty($tmp_jdt_bil) && empty($tmp_foto_bil) && empty($tmp_dun_bil))
        {
            redirect(base_url());
        }
        $this->load->model('jangka_dun_model');
        $this->load->model('foto_model');
        $nama_foto = $this->foto_model->foto($this->input->post('input_foto_bil'));
        $this->jangka_dun_model->padam_calon();
        if($this->input->post('input_foto_bil') != '5'){
            $this->foto_model->padam($this->input->post('input_foto_bil'));
            unlink('./assets/img/'.$nama_foto->foto_nama);
        }
        redirect('dun/kemaskini_jangkaan_dun/'.$this->input->post('input_dun_bil'), 'refresh');
    }

    public function tambahan($jdt_bil){
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
		{
			redirect(base_url());
		}
        $this->load->model('jangka_dun_model');
        $data['calon'] = $this->jangka_dun_model->calon_id($jdt_bil);
        if(empty($jdt_bil) && empty($data['calon'])){
            redirect(base_url());
        }
        $this->load->model('dun_model');
        $this->load->model('foto_model');
        $this->load->model('parti_model');
        $this->load->model('pengguna_model');
        $data['data_pengguna'] = $this->pengguna_model;
        $data['data_dun'] = $this->dun_model;
        $data['data_foto'] = $this->foto_model;
        $data['data_parti'] = $this->parti_model;
        $data['kekuatan_calon'] = $this->jangka_dun_model->kekuatan_calon($jdt_bil, 'Kekuatan Calon');
        $data['kelemahan_calon'] = $this->jangka_dun_model->kekuatan_calon($jdt_bil, 'Kelemahan Calon');
        $this->load->view('susunletak/atas', $data);
        $this->load->view('dun/tambahan');
        $this->load->view('susunletak/bawah');
    }

    public function kuat_lemah()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
		{
			redirect(base_url());
		}
        $this->load->library('form_validation');
        $this->load->model('jangka_dun_model');
        $this->form_validation->set_rules('input_kekuatan', 'Kekuatan/Kelemahan Calon', 'required');
        $this->form_validation->set_message('required', 'Sila penuhi maklumat di ruangan {field}');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        if($this->form_validation->run() === FALSE){
            $this->tambahan($this->input->post('input_calon'));
        }else{
            $this->jangka_dun_model->tambahan_calon();
            $this->tambahan($this->input->post('input_calon'));
        }
    }

    public function padam_kuat_lemah()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, "NEGERI") === FALSE && strpos($sesi, "PPD") === FALSE)
		{
			redirect(base_url());
		}
        $this->load->library('form_validation');
        $this->load->model('jangka_dun_model');
        $this->form_validation->set_rules('input_jdtt_bil', 'Nombor ID Calon', 'required');
        $this->form_validation->set_rules('input_pengguna_bil', 'Pengguna ID', 'required');
        $this->form_validation->set_message('required', 'Wajib ada {field}');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        if($this->form_validation->run() === FALSE){
            $this->tambahan($this->input->post('input_calon'));
        }else{
            $this->jangka_dun_model->padam_kuat_lemah();
            redirect('dun/tambahan/'.$this->input->post('input_calon'), 'refresh');
        }
    }

    public function dm($dun_bil)
    {
        $this->load->library('form_validation');
        $this->load->model('dun_model');
        $this->load->model('pdm_model');
        $this->load->model('japen_model');
        $this->load->model('pengguna_model');
        $data['data_pdm'] = $this->pdm_model;
        $data['dun'] = $this->dun_model->dun_bil($dun_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('pdm/dun');
        $this->load->view('susunletak/bawah');
    }

    public function tambah_dm()
    {
        $this->load->library('form_validation');
        $this->load->model('dun_model');
        $this->load->model('pdm_model');
        $this->load->model('japen_model');
        $this->load->model('pengguna_model');
        $data['data_pdm'] = $this->pdm_model;
        $data['senarai_dun'] = $this->dun_model->semua();
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, 'PPD') !== FALSE){

            $data['senarai_dun'] = $this->japen_model->senarai_tugas_dun($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
        }
        $this->load->view('susunletak/atas', $data);
        $this->load->view('pdm/tambah_dun');
        $this->load->view('susunletak/bawah');
    }

    public function proses_tambah_dm()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_nama_dm', 'Daerah Mengundi', 'required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        $this->form_validation->set_message('required', 'Sila penuhi ruangan {field}');
        if($this->form_validation->run() === FALSE)
        {
            if(strpos($sesi, "NEGERI") !== FALSE || strpos($sesi, "PPD") !== FALSE){
                $this->tambah_dm();
            }
            else
            {
                $dun_bil = $this->input->post('input_dun_bil');
                $this->dm($dun_bil);
            }
        }else{
            $this->load->model('pdm_model');
            $tmp_nama_pdm = $this->input->post('input_nama_dm');
            $tmp_dun_bil = $this->input->post('input_dun_bil');
            $tmp_bilangan_pengundi = $this->input->post('input_bilangan_pengundi');
            $ada = $this->pdm_model->semak_pdm_dun($tmp_dun_bil, $tmp_nama_pdm);
            if(empty($ada)){
                $this->pdm_model->tambah_pdm_dun($tmp_nama_pdm, $tmp_dun_bil, $tmp_bilangan_pengundi);
            }   
            if(strpos($sesi, "NEGERI") !== FALSE || strpos($sesi, "PPD") !== FALSE){
                redirect('dun/tambah_dm', 'refresh');
            }else{
                $dun_bil = $this->input->post('input_dun_bil');
                redirect('dun/dm/'.$dun_bil, 'refresh');
            }
        }
    }

    public function proses_kemaskini_pdm()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_nama_dm', 'Daerah Mengundi', 'required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        $this->form_validation->set_message('required', 'Sila penuhi ruangan {field}');
        if($this->form_validation->run() === FALSE){
            if(strpos($sesi, "NEGERI") !== FALSE || strpos($sesi, "PPD") !== FALSE){
                $this->tambah_dm();
            }else{
                $dun_bil = $this->input->post('input_dun_bil');
                $this->dm($dun_bil);
            }
        }
        else
        {
            $this->load->model('pdm_model');
            $tmp_nama_pdm = $this->input->post('input_nama_dm');
            $tmp_pdm_bil = $this->input->post('input_dm_bil');
            $tmp_bilangan_pengundi = $this->input->post('input_bilangan_pengundi');
            $this->pdm_model->kemaskini_dun($tmp_pdm_bil, $tmp_nama_pdm, $tmp_bilangan_pengundi);
            if(strpos($sesi, "NEGERI") !== FALSE || strpos($sesi, "PPD") !== FALSE){
                redirect('dun/tambah_dm', 'refresh');
            }else{
                $dun_bil = $this->input->post('input_dun_bil');
                redirect('dun/dm/'.$dun_bil, 'refresh');
            }
        }
    }

    public function proses_padam_pdm()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_dm_bil', 'ID Daerah Mengundi', 'required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        $this->form_validation->set_message('required', 'Tiada maklumat {field}. SILA LOGIN SEMULA.');
        if($this->form_validation->run() === FALSE){
            if(strpos($sesi, "NEGERI") !== FALSE || strpos($sesi, "PPD") !== FALSE){
                $this->tambah_dm();
            }else{
                $dun_bil = $this->input->post('input_dun_bil');
                $this->dm($dun_bil);
            }
        }
        else
        {
            $this->load->model('pdm_model');
            $tmp_pdm_bil = $this->input->post('input_dm_bil');
            $this->pdm_model->padam_dun($tmp_pdm_bil);
            if(strpos($sesi, "NEGERI") !== FALSE || strpos($sesi, "PPD") !== FALSE){
                redirect('dun/tambah_dm', 'refresh');
            }else{
                $dun_bil = $this->input->post('input_dun_bil');
                redirect('dun/dm/'.$dun_bil, 'refresh');
            }
        }
    }

}