<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

    

    public function prosesKemaskiniPilihanPengguna(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'URUSETIA' :
                $icBaru = $this->input->post('inputNoIc');
                if(empty($icBaru)){
                    redirect(base_url());
                }
                $icLama = $this->input->post('inputNoIcSemasa');
                $pilihanPenggunaBil = $this->input->post('inputPenggunaBil');
                $this->load->model('pengguna_model');
                $data['pilihanPengguna'] = $this->pengguna_model->pengguna($pilihanPenggunaBil);
                $semakAda = $this->pengguna_model->penggunaIc($icBaru);
                if(!empty($semakAda) && ($icLama != $icBaru)){
                    $data['senaraiPenggunaLain'] = $semakAda;
                    redirect('pengguna/kemaskini/'.$data['pilihanPengguna']->bil);
                }else{
                    $entri = $this->pengguna_model->kemaskiniPilihanPengguna();
                    redirect('pengguna/kemaskini/'.$data['pilihanPengguna']->bil);
                }
            
                break;
            default :
                redirect(base_url());
        }
        
    }

    public function senaraiAnggotaDaerah(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('negeri_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PKPM') !== FALSE){
            $sesi = 'PKPM';
        }
        switch($sesi){
            case 'PKPM' :
                $data['senaraiNegeri'] = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senarai_anggota'] = $this->pengguna_model->senaraiAnggotaDaerah($data['senaraiNegeri']);
                $this->load->view('us_program_negeri_na/pengguna/senaraiAnggotaDaerah', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function konfigurasi(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }elseif(strpos($sesi, 'PKPM') !== FALSE){
            $sesi = 'PKPM';
        }elseif(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'NEGERI' :
            case 'PKPM' :
                if($data['pengguna']->pengguna_status == ''){
                    redirect('pengguna/status_tambah');
                }elseif(!empty($data['pengguna']->pengguna_status)){
                    $this->load->model('japen_model');
                    $data['organisasi'] = $this->japen_model->organisasi($data['pengguna']->pengguna_peranan_bil);
                    $data['header'] = 'us_program_negeri_na/susunletak/atas';
                    $data['sidebar'] = 'us_program_negeri_na/susunletak/sidebar';
                    $data['navbar'] = 'us_program_negeri_na/susunletak/navbar';
                    $data['footer'] = 'us_program_negeri_na/susunletak/bawah';
                    $this->load->view('pengguna/konfigurasi', $data);
                }else{
                    redirect(base_url());
                }
                break;
            case 'PPD' :
                if(!empty($data['pengguna']->pengguna_status)){
                    $this->load->model('japen_model');
                    $data['organisasi'] = $this->japen_model->organisasi($data['pengguna']->pengguna_peranan_bil);
                    $data['header'] = 'ppd_na/susunletak/atas';
                    $data['sidebar'] = 'ppd_na/susunletak/sidebar';
                    $data['navbar'] = 'ppd_na/susunletak/navbar';
                    $data['footer'] = 'ppd_na/susunletak/bawah';
                    $this->load->view('pengguna/konfigurasi', $data);
                }else{
                    redirect(base_url());
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function bilangan(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('peranan_model');
        $this->load->model('pengguna_model');
        $pengguna = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PKPM') !== FALSE){
          $sesi = 'PKPM';
        }
        switch($sesi){
          case 'PKPM' :
            $jumlahPengguna = $this->pengguna_model->bilanganPengguna($pengguna->pengguna_peranan_bil);
            echo $jumlahPengguna->jumlahPengguna;
            break;
          default :
            redirect(base_url());
        }
      }

    public function pertukaran(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        if(strpos($sesi, 'PKPM') !== FALSE){
            $sesi = 'PKPM';
        }
        switch($sesi){
            case 'PKPM' :
                $data['senaraiPegawai'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
                $this->load->view('us_program_negeri_na/pengguna/pertukaran', $data);
                break;
            case 'NEGERI' :
                $data['senaraiPegawai'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
                $this->load->view('negeri_na/pengguna/pertukaran', $data);
                break;
            case 'LAPIS' :
                $data['senaraiPegawai'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
                $this->load->view('us_lapis_na/pengguna/pertukaran', $data);
                break;
            case 'PPD' : 
                $data['senaraiPegawai'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
                $this->load->view('ppd_na/pengguna/pertukaran', $data);
                break;
            case 'US_PROGRAM' :
                $data['senaraiPegawai'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
                $this->load->view('us_program_na/pengguna/pertukaran', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function negeri_belum()
    {
        $this->load->view('susunletak/atas');
        $this->load->view('pengguna/negeri/belum');
        $this->load->view('susunletak/bawah');
    }

    public function senarai_pelapor()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'LAPIS' :
                $this->load->model('peranan_model');
                $data['data_peranan'] = $this->peranan_model;
                $data['senarai_pelapor'] = $this->pengguna_model->senarai_penuh_pelapor();
                $this->load->view('susunletak/atas', $data);
                $this->load->view('pengguna/pelapor/senarai_penuh');
                $this->load->view('susunletak/bawah');
                break;
            default :
                redirect(base_url());
        }
        
    }

    public function sah_padam()
    {
        $this->load->model('pengguna_model');
        $this->pengguna_model->padam();
        redirect(base_url(), 'refresh');
    }

    public function senarai_padam($negeri_bil)
    {
        $this->load->model('pengguna_model');
        $data['senarai_pengguna'] = $this->pengguna_model->senarai_padam_parlimen($negeri_bil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('pengguna/senarai_sah_padam');
        $this->load->view('susunletak/bawah');
    }

    public function proses_padam()
    {
        $this->load->model('pengguna_model');
        $this->pengguna_model->kemaskini_ppd();
        redirect('pengguna/status_tambah', 'refresh');
    }

    public function padam_maklumat($bil)
    {
        if(empty($bil)){
            redirect(base_url());
        }
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($bil);
        if(empty($data['pengguna'])){
            redirect(base_url());
        }
        $this->load->view('susunletak/atas', $data);
        $this->load->view('pengguna/arahan_padam');
        $this->load->view('susunletak/bawah');
    }

    public function proses_kemaskini(){
        $bil = $this->input->post('input_bil');
        $peranan = $this->input->post('input_peranan_nama');
        if(empty($bil)){
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_no_ic', 'Nombor Kad Pengenalan', 'required');
        $this->form_validation->set_rules('input_no_tel', 'Nombor Telefon', 'required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        $this->form_validation->set_message('required', 'Sila penuhkan maklumat di ruangan {field}');
        if($this->form_validation->run() === FALSE)
        {
            $this->kemaskini_maklumat($bil);
        }
        else
        {
            $this->load->model('pengguna_model');
            $this->pengguna_model->kemaskini_ppd();
            $tempPengguna = $this->pengguna_model->pengguna($bil);
            if(empty($tempPengguna->pengguna_status)){
                redirect('pengguna/status_tambah');        
            }else{
                redirect('pengguna/konfigurasi');
            }
        }
    }

    public function kemaskini_maklumat($bil)
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        if(strpos($sesi, 'PKPM') !== FALSE){
            $sesi = 'PKPM';
        }
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['penggunaKemaskini'] = $this->pengguna_model->pengguna($bil);
        if(empty($data['penggunaKemaskini'])){
            redirect(base_url());
        }
        switch($sesi){
            case 'PKPM' :
                $this->load->view('us_program_negeri_na/pengguna/kemaskini_maklumat', $data);
                break;
            case 'NEGERI' :
                $this->load->view('negeri_na/pengguna/kemaskini_maklumat', $data);
                break;
            case 'LAPIS' :
                $this->load->view('us_lapis_na/pengguna/kemaskini_maklumat', $data);
                break;
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/pengguna/kemaskini_maklumat', $data);
                break;
            case 'PPD' :
                $this->load->view('susunletak/atas', $data);
                $this->load->view('pengguna/kemaskini_maklumat');
                $this->load->view('susunletak/bawah');
                break;
            default :
                redirect(base_url());
        }
    }

    public function proses_tambah()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('input_no_ic', 'Nombor Kad Pengenalan', 'required');
        $this->form_validation->set_rules('input_no_tel', 'Nombor Telefon', 'required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        $this->form_validation->set_message('required', 'Sila penuhkan maklumat di ruangan {field}');
        if($this->form_validation->run() === FALSE)
        {
            $this->tambah();
        }
        else
        {
            $this->load->model('pengguna_model');
            $ic = $this->input->post('input_no_ic');
            $tel = $this->input->post('input_no_tel');
            $ada = $this->pengguna_model->semakan($ic, $tel);
            if(count($ada) == 0)
            {
                $this->pengguna_model->tambah_ppd();            
                $this->status_tambah();
            }else{
                $this->tambah();
            }
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
        if(strpos($sesi, 'PKPM') !== FALSE){
            $sesi = 'PKPM';
        }
        switch($sesi){
            case 'PKPM' :
                $this->load->model('negeri_model');
                $data['senaraiNegeri'] = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiPerjawatan'] = $this->pengguna_model->senaraiPerjawatan($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiPerjawatanDaerah'] = $this->pengguna_model->senaraiPerjawatanDaerah($data['senaraiNegeri']);
                $this->load->view('us_program_negeri_na/pengguna/laman', $data);
                break;
            case 'NEGERI' :
                $this->load->model('negeri_model');
                $data['senaraiNegeri'] = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiPerjawatan'] = $this->pengguna_model->senaraiPerjawatan($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiPerjawatanDaerah'] = $this->pengguna_model->senaraiPerjawatanDaerah3($data['senaraiNegeri']);
                $this->load->view('negeri_na/pengguna/laman', $data);
                break;
            case 'LAPIS':
                $data['senaraiPerjawatan'] = $this->pengguna_model->senaraiPerjawatan($data['pengguna']->pengguna_peranan_bil);
                $this->load->view('us_lapis_na/pengguna/laman', $data);
                break;
            case 'URUSETIA' :
                $data['senaraiPengguna'] = $this->pengguna_model->papar_semua();
                $this->load->view('urusetia_na/pengguna/lihat_semua', $data);
                break;
            default : 
                redirect(base_url());
        }
        
	}

	public function daftar()
{
    $sesi = strtoupper($this->session->userdata('peranan'));
    if(empty($sesi)){
        redirect(base_url());
    }
    $this->load->helper('form');
	$this->load->library('form_validation');
	$this->load->model('pengguna_model');

    $data['title'] = 'Daftar Pengguna';

    $this->form_validation->set_rules('nama_penuh', 'Nama', 'required');
    $this->form_validation->set_rules('no_tel', 'Nombor Telefon', 'required');

    if ($this->form_validation->run() === FALSE)
    {
        $this->load->view('susunletak/atas', $data);
        $this->load->view('pengguna/daftar');
        $this->load->view('susunletak/bawah');

    }
    else
    {
        $this->pengguna_model->daftar_pengguna();
        $this->load->view('susunletak/atas', $data);
        $this->load->view('pengguna/berjaya');
        $this->load->view('susunletak/bawah');

    }
}

    public function login(){
        // Set header to output JSON
        header('Content-Type: application/json');
        $this->load->library('form_validation');
        $this->load->model('pengguna_model');
         // Your existing validation rules
        $this->form_validation->set_rules('pengguna_ic', 'ID', 'required');
        $this->form_validation->set_rules('no_tel', 'Password', 'required');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        $this->form_validation->set_message('required', 'Sila maklumat di ruangan {field}');
    
        if ($this->form_validation->run() === FALSE)
        {
             echo json_encode([
                'success' => false,
                'message' => validation_errors()
            ]);
            return;    
        }
        else
        {
            $pengguna = $this->pengguna_model->semak_ada($this->input->post('pengguna_ic'),$this->input->post('no_tel'));
            if(count($pengguna) == 0){
                echo json_encode([
                'success' => false,
                'message' => 'ID atau Kata Laluan tidak sah.'
            ]);
            }else{
                foreach($pengguna as $p){
                    $pengguna_bil = $p->bil;
                    $pengguna_nama = $p->nama_penuh;
                    $peranan_bil = $p->pengguna_peranan_bil;
                    $peranan = $p->pengguna_peranan_nama;
                }
                
                $newdata = array(
                    'pengguna_bil'  => $pengguna_bil,
                    'pengguna_nama' => $pengguna_nama,
                    'peranan_bil' => $peranan_bil,
                    'peranan'     => $peranan,
                    'logged_in' => TRUE
                );
            
            $this->session->set_userdata($newdata);
            // Send a success response with a redirect URL
            echo json_encode([
                'success' => true,
                'redirect_url' => base_url() // Or wherever you redirect after login
            ]);
            }
        }
    }

    public function logout(){
        
            $data = $this->session->all_userdata();
            foreach($data as $row => $rows_value)
            {
             $this->session->unset_userdata($row);
            }
            redirect(base_url());
           
    }

    public function tambah_peranan()
    {
        $this->load->model('pengguna_model');
        $penggunaBil = $this->input->post('inputPenggunaBil');
        $this->pengguna_model->tambahPeranan();
        $this->bil($penggunaBil);
    }

    public function bil($penggunaBil)
    {
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('pengguna/pengguna');
        $this->load->view('susunletak/bawah');
    }

    public function tamat_peranan()
    {
        $this->load->model('pengguna_model');
        $penggunaBil = $this->input->post('inputPenggunaBil');
        $this->pengguna_model->tamatPeranan();
        redirect('pengguna/pertukaran');
    }

    public function kemaskini($pilihanPenggunaBil){
        if(empty($pilihanPenggunaBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'URUSETIA' :
                $data['pilihanPengguna'] = $this->pengguna_model->pengguna($pilihanPenggunaBil);
                $this->load->view('urusetia_na/pengguna/kemaskiniPilihanPengguna', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    // 1) tambah

    public function tambah()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos(strtoupper($sesi), "PPD") !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        if(strpos($sesi, 'PKPM') !== FALSE){
            $sesi = 'PKPM';
        }
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'PKPM' :
                $this->load->view('us_program_negeri_na/pengguna/tambah', $data);
                break;
            case 'NEGERI' :
                $this->load->view('negeri_na/pengguna/tambah', $data);
                break;
            case 'LAPIS' :
                $this->load->view('us_lapis_na/pengguna/tambah', $data);
                break;
            case 'US_PROGRAM' :
                $this->load->view('us_program_na/pengguna/tambah', $data);
                break;
            case 'PPD' : 
                $this->load->view('susunletak/atas');
        $this->load->view('pengguna/tambah');
        $this->load->view('susunletak/bawah');
                break;
            default :
                redirect(base_url());
        }
        
    }

    // 2) status_tambah

    public function status_tambah()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        if(strpos($sesi, 'PKPM') !== FALSE){
            $sesi = 'PKPM';
        }
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['senarai_anggota'] = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
        switch($sesi){
            case 'PKPM':
                $this->load->view('us_program_negeri_na/pengguna/status', $data);
                break;
            case 'NEGERI':
                $this->load->view('negeri_na/pengguna/status', $data);
                break;
            case 'LAPIS':
                $this->load->view('us_lapis_na/pengguna/status', $data);
                break;
            case 'US_PROGRAM':
                $this->load->view('us_program_na/pengguna/status', $data);
                break;
            case 'PPD':
                $this->load->view('susunletak/atas');
                $this->load->view('pengguna/status');
                $this->load->view('susunletak/bawah');
                break;
            default :
                redirect(base_url());
        }
        
    }

    // 3) senarai_pegawai_kemaskini

    public function senarai_pegawai_kemaskini($peranan)
    {
        $this->load->model('pengguna_model');
        $data['senarai_anggota'] = $this->pengguna_model->anggota($this->session->userdata('peranan_bil'));
        $this->load->view('susunletak/atas', $data);
        $this->load->view('pengguna/senarai_kemaskini');
        $this->load->view('susunletak/bawah');
    }

    // 4) senarai_pegawai_padam
    
    public function senarai_pegawai_padam($peranan)
    {
        $this->load->model('pengguna_model');
        $data['senarai_anggota'] = $this->pengguna_model->anggota($this->session->userdata('peranan_bil'));
        $this->load->view('susunletak/atas', $data);
        $this->load->view('pengguna/senarai_padam');
        $this->load->view('susunletak/bawah');
    }


    // KOMPONEN

    public function status()
    {
        $this->load->model('pengguna_model');
        $data['senarai_anggota'] = $this->pengguna_model->anggota($this->session->userdata('peranan_bil'));
        $this->load->view('pengguna/komponen/status', $data);
    }

    public function tambah_akaun()
    {
        $sesi = $this->session->userdata('peranan');
        if(strpos(strtoupper($sesi), "PPD") === FALSE){
            $this->tambah();
        }
        $this->load->library('form_validation');
        $this->load->view('pengguna/komponen/tambah');
    }
    

}
