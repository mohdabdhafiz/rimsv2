<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pilihanraya extends CI_Controller {

    public function senarai(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'PPD' :
                $data['header'] = 'ppd_na/susunletak/atas';
                $data['navbar'] = 'ppd_na/susunletak/navbar';
                $data['sidebar'] = 'ppd_na/susunletak/sidebar';
                $data['footer'] = 'ppd_na/susunletak/bawah';
                $this->load->view('sismap/pilihanraya/senarai', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function senaraiGrading($pilihanrayaBil){
        echo $pilihanrayaBil;
    }

    public function prosesSetCalonRasmiDun(){

        //GET VALUES
        $calonBil = $this->input->post('inputCalonBil');

        //CHECK IF EMPTY
        if(empty($calonBil)){
            redirect(base_url());
        }

        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        
        //ACCORDINGLY
        switch($sesi){
            case 'DATA' :

                //LOAD MODEL
                $this->load->model('pencalonan_model');

                //SET DATA
                $calon = $this->pencalonan_model->maklumat_calon($calonBil);

                //KOSONGKAN MENANG RASMI
                $this->pencalonan_model->kosongRasmi($calon->pencalonan_pilihanraya, $calon->pencalonan_dun);
                $this->pencalonan_model->kemaskiniMenangRasmi($calonBil);

                $this->lockRasmi();

                break;
            default :
                redirect(base_url());
        }

    }

    public function setCalonRasmiDun(){
        
        //GET VALUES
        $dunBil = $this->input->post('inputDunBil');
        $pilihanrayaBil = $this->input->post('inputPilihanrayaBil');

        //CHECK IF VALUES ARE EMPTY
        if(empty($dunBil)){
            redirect(base_url());
        }
        if(empty($pilihanrayaBil)){
            redirect(base_url());
        }

        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        
        //ACCORDINGLY
        switch($sesi){
            case 'DATA' :

                //LOAD MODEL
                $this->load->model('pilihanraya_model');
                $this->load->model('dun_model');
                $this->load->model('pencalonan_model');

                //LOAD DATA
                $data['pru'] = $this->pilihanraya_model->pilihanraya($pilihanrayaBil);
                $data['dun'] = $this->dun_model->dun($dunBil);
                $data['senaraiCalon'] = $this->pencalonan_model->calon_dun($dunBil, $pilihanrayaBil);

                //LOAD VIEW
                $this->load->view('us_sismap_na/sismap/pilihanraya/setCalonRasmiDun', $data);

                break;
            default :
                redirect(base_url());
        }

    }

    public function lockRasmi(){

        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        
        //ACCORDINGLY
        switch($sesi){
            case 'DATA' :

                //LOAD MODEL
                $this->load->model('pilihanraya_model');
                $this->load->model('dun_model');

                //LOAD DATA
                $data['senaraiPilihanraya'] = $this->pilihanraya_model->senarai();
                $data['dataDun'] = $this->dun_model;

                //LOAD VIEW
                $this->load->view('us_sismap_na/sismap/pilihanraya/setRasmi', $data);

                break;
            default :
                redirect(base_url());
        }

    }

    public function bilX($pilihanrayaBil)
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('penggunaBil');
        $this->load->model('pengguna_model');
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('status_grading_model');
        $this->load->model('harian_model');
        $this->load->model('parti_model');
        $data['dataParti'] = $this->parti_model;
        $data['dataHarian'] = $this->harian_model;
        $data['dataGrading'] = $this->status_grading_model;
        $data['dataPr'] = $this->pilihanraya_model;
        $data['dataCalonParlimen'] = $this->pencalonan_parlimen_model;
        $data['dataCalonDun'] = $this->pencalonan_model;
        $data['pr'] = $this->pilihanraya_model->pilihanraya($pilihanrayaBil);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('top/pilihanraya');
        $this->load->view('susunletak/bawah');
    }

    public function bil($pilihanrayaBil)
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'DATA' :
                $this->load->model('pilihanraya_model');
                $data['pr'] = $this->pilihanraya_model->pilihanraya($pilihanrayaBil);
                $data['senaraiKawasan'] = array();
                $data['kawasanBilanganCalon'] = array();
                $data['partiBilanganCalon'] = array();
                if($data['pr']->pilihanraya_jenis == 'PARLIMEN'){
                    $this->load->model(['winnable_candidate_parlimen_model', 'pencalonan_parlimen_model', 'harian_parlimen_model']);
                    $data['senaraiKawasan'] = $this->pilihanraya_model->senaraiKawasanParlimenBaru($pilihanrayaBil);
                    $data['kawasanBilanganCalon'] = $this->winnable_candidate_parlimen_model->kawasanBilanganCalon($data['senaraiKawasan']);
                    $data['partiBilanganCalon'] = $this->winnable_candidate_parlimen_model->partiBilanganCalon($data['senaraiKawasan']);
                    $data['senaraiCalon'] = $this->pencalonan_parlimen_model->senaraiPencalonanPru($pilihanrayaBil);
                    $data['senaraiKawasanGrading'] = $this->harian_parlimen_model->kedudukanTerkini($pilihanrayaBil);
                    $data['senaraiLockStatus'] = $this->pencalonan_parlimen_model->senaraiLockStatus($pilihanrayaBil);
                    $data['senaraiRumusanLockStatus'] = $this->pencalonan_parlimen_model->senaraiRumusanLockStatus($pilihanrayaBil);
                    $data['senaraiKeputusan'] = $this->pencalonan_parlimen_model->senaraiRumusanKeputusan($pilihanrayaBil);
                    $data['senaraiKeputusanRasmi'] = $this->pencalonan_parlimen_model->senaraiKeputusanRasmi($pilihanrayaBil);
                    $data['senaraiKeputusanTidakRasmi'] = $this->pencalonan_parlimen_model->senaraiKeputusanTidakRasmi($pilihanrayaBil);

                }
                if($data['pr']->pilihanraya_jenis == 'DUN'){
                    $this->load->model(['jangka_dun_model', 'pencalonan_model', 'harian_model']);
                    $data['senaraiKawasan'] = $this->pilihanraya_model->senaraiKawasanDunBaru($pilihanrayaBil);
                    $data['kawasanBilanganCalon'] = $this->jangka_dun_model->kawasanBilanganCalon($data['senaraiKawasan']);
                    $data['partiBilanganCalon'] = $this->jangka_dun_model->partiBilanganCalon($data['senaraiKawasan']);
                    $data['senaraiCalon'] = $this->pencalonan_model->senaraiPencalonanPru($pilihanrayaBil);
                    $data['senaraiKawasanGrading'] = $this->harian_model->kedudukanTerkini($pilihanrayaBil);
                    $data['senaraiLockStatus'] = $this->pencalonan_model->senaraiLockStatus($pilihanrayaBil);
                    $data['senaraiRumusanLockStatus'] = $this->pencalonan_model->senaraiRumusanLockStatus($pilihanrayaBil);
                    $data['senaraiKeputusan'] = $this->pencalonan_model->senaraiRumusanKeputusan($pilihanrayaBil);
                    $data['senaraiKeputusanRasmi'] = $this->pencalonan_model->senaraiKeputusanRasmi($pilihanrayaBil);
                    $data['senaraiKeputusanTidakRasmi'] = $this->pencalonan_model->senaraiKeputusanTidakRasmi($pilihanrayaBil);
                }
                $data['header'] = 'us_sismap_na/susunletak/atas';
                $data['navbar'] = 'us_sismap_na/susunletak/navbar';
                $data['sidebar'] = 'us_sismap_na/susunletak/sidebar';
                $data['footer'] = 'us_sismap_na/susunletak/bawah';
                $this->load->view('sismap/pilihanraya/bil', $data);
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
                $this->load->model('pilihanraya_model');
                $this->load->model('negeri_model');
                $data['header'] = 'negeri_na/susunletak/atas';
                $data['navbar'] = 'negeri_na/susunletak/navbar';
                $data['sidebar'] = 'negeri_na/susunletak/sidebar';
                $data['footer'] = 'negeri_na/susunletak/bawah';
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiPruParlimen'] = $this->pilihanraya_model->senaraiPruParlimenNegeri($senaraiNegeri);
                $data['senaraiPruDun'] = $this->pilihanraya_model->senaraiPruDunNegeri($senaraiNegeri);
                $this->load->view('pilihanraya/laman', $data);
                break;
            case 'URUSETIA' :
                $this->load->model('pilihanraya_model');
                $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
                $data['pilihanraya_bil'] = $pilihanraya_bil;
                $data['senarai_pilihanraya'] = $this->pilihanraya_model->papar_semua();
                $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
                $data['pilihanraya_bil'] = $pilihanraya_bil;
                $this->load->view('susunletak/atas', $data);
                $this->load->view('pilihanraya/utama');
                $this->load->view('susunletak/bawah');
                break;
            case 'DATA' :
                $this->load->model('pilihanraya_model');
                $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
                $data['pilihanraya_bil'] = $pilihanraya_bil;
                $data['senarai_pilihanraya'] = $this->pilihanraya_model->papar_semua();
                $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
                $data['pilihanraya_bil'] = $pilihanraya_bil;
                $this->load->view('susunletak/atas', $data);
                $this->load->view('pilihanraya/utama');
                $this->load->view('susunletak/bawah');
                break;
            default :
                redirect(base_url());
        }
    }

    public function tambah()
    {
        if(strtoupper($this->session->userdata('peranan')) == 'URUSETIA' && $this->session->userdata('logged_in') == TRUE){
            $this->load->view('susunletak/atas');
            $this->load->view('pilihanraya/daftar');
            $this->load->view('susunletak/bawah');
        }
        else
        {
            echo "Sila rujuk admin";
        }
    }

    public function daftar()
    {
        $tmp_peranan = $this->session->userdata('peranan');
        if(empty($tmp_peranan)){
            redirect(base_url());
        }
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('pilihanraya_model');

        $this->form_validation->set_rules('pilihanraya_nama', 'Nama Pilihanraya', 'required', array(
            "required" => "<div class='alert alert-warning'>Sila penuhkan maklumat NAMA PILIHAN RAYA</div>"
        ));
        $this->form_validation->set_rules('pilihanraya_singkatan', 'Nama Singkatan Pilihanraya', 'required', array(
            "required" => "<div class='alert alert-warning'>Sila penuhkan maklumat NAMA SINGKATAN PILIHAN RAYA</div>"
        ));
        $this->form_validation->set_rules('pilihanraya_tahun', 'Tahun Pilihan Raya', 'required', array(
            "required" => "<div class='alert alert-warning'>Sila penuhkan maklumat TAHUN PILIHAN RAYA</div>"
        ));

        if ($this->form_validation->run() === FALSE)
        {
            $data['senarai_pilihanraya'] = $this->pilihanraya_model->papar_semua();
            $this->load->view('susunletak/atas', $data);
            $this->load->view('pilihanraya/daftar');
            $this->load->view('susunletak/bawah');
        }
        else
        {
            $this->pilihanraya_model->clear_semasa();
            $this->pilihanraya_model->tambah();
            $this->index();
        }
    }

    public function set($pilihanraya_id){
        $tmp_peranan = $this->session->userdata('peranan');
        if(empty($tmp_peranan)){
            redirect(base_url());
        }
        $this->load->model('pilihanraya_model');
        $this->pilihanraya_model->clear_semasa();
        $this->pilihanraya_model->set_semasa($pilihanraya_id);
        redirect('pengguna/logout');
    }

    public function kemaskini($pilihanraya_bil2){
        $tmp_peranan = $this->session->userdata('peranan');
        if(empty($tmp_peranan)){
            redirect(base_url());
        }
        $this->load->model('pilihanraya_model');
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['senarai_pilihanraya'] = $this->pilihanraya_model->papar_semua();
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['pilihanraya_bil'] = $pilihanraya_bil;
        $data['pilihanraya2'] = $this->pilihanraya_model->papar($pilihanraya_bil2);
        $this->load->view('susunletak/atas', $data);
        $this->load->view('pilihanraya/kemaskini');
        $this->load->view('susunletak/bawah');
    }

    public function padam($bil){
        $tmp_peranan = $this->session->userdata('peranan');
        if(empty($tmp_peranan)){
            redirect(base_url());
        }
        $this->load->model('pilihanraya_model');
        $pilihanraya_bil = $this->session->userdata('pilihanraya_bil');
        $data['senarai_pilihanraya'] = $this->pilihanraya_model->papar_semua();
        $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
        $data['pilihanraya_bil'] = $pilihanraya_bil;
        $data['pilihanraya2'] = $this->pilihanraya_model->papar($bil);
        $this->load->model('pilihanraya_model');
        $this->load->view('susunletak/atas', $data);
        $this->load->view('pilihanraya/padam');
        $this->load->view('susunletak/bawah');
    }

    public function setuju_padam($bil){
        $this->load->model('pilihanraya_model');
        $tmp_peranan = $this->session->userdata('peranan');
        $tmp_pr = $this->pilihanraya_model->papar($bil);
        if(empty($tmp_peranan) || empty($tmp_pr)){
            redirect(base_url());
        }
        $tmp_pr_semasa = $this->pilihanraya_model->semak_semasa($bil);
        if(!empty($tmp_pr_semasa)){
            $this->pilihanraya_model->clear_semasa();
            $this->pilihanraya_model->padam($bil);
            $this->pilihanraya_model->set_semasa($this->pilihanraya_model->pilihanraya_terakhir_bil());
        }else{
            $this->pilihanraya_model->padam($bil);
        }
        
        redirect('pengguna/logout');
    }

    public function info($pilihanraya_bil)
    {
        //BAGI MENGELAKKAN MASALAH
        //redirect(base_url());

        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));

        //ACCORDINGLY
        switch($sesi){
            case 'URUSETIA' :

                $this->load->library('form_validation');
                $this->load->model('pengguna_model');
                $this->load->model('parlimen_model');
                $this->load->model('dun_model');
                $this->load->model('negeri_model');
                $this->load->model('pilihanraya_model');
                $data['data_pr'] = $this->pilihanraya_model;
                $data['senarai_negeri'] = $this->negeri_model->senarai();
                $data['data_parlimen'] = $this->parlimen_model;
                $data['data_dun'] = $this->dun_model;
                $data['model_pengguna'] = $this->pengguna_model;
                $this->form_validation->set_rules('pilihanraya_nama', 'Nama Pilihanraya', 'required', array(
                "required" => "<div class='alert alert-warning'>Maklumat NAMA PILIHANRAYA perlu diisi</div>"
                ));
                $this->form_validation->set_rules('pilihanraya_singkatan', 'Nama Singkatan Pilihanraya', 'required', array(
                    "required" => "<div class='alert alert-warning'>Maklumat NAMA SINGKATAN PILIHAN RAYA perlu diisi</div>"
                ));
                $this->form_validation->set_rules('pilihanraya_tahun', 'Tahun Pilihan Raya', 'required', array(
                    "required" => "<div class='alert alert-warning'>Maklumat TAHUN PILIHAN RAYA perlu diisi</div>"
                ));
        
                if ($this->form_validation->run() === FALSE)
                {
                    $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
                    $this->load->view('susunletak/atas', $data);
                    $this->load->view('pilihanraya/info');
                    $this->load->view('susunletak/bawah');
                }
                else
                {
                    $this->pilihanraya_model->kemaskini_maklumat($pilihanraya_bil);
                    $status_pilihanraya = $this->input->post('pilihanraya_status');
                    $jenis_pilihanraya = $this->input->post('pilihanraya_jenis');
                    if(strtoupper($status_pilihanraya) == 'AKTIF' && strtoupper($jenis_pilihanraya) == 'PARLIMEN'){
                        $this->pencalonan_parlimen_aktif($pilihanraya_bil);
                    }
                    if(strtoupper($status_pilihanraya) == 'AKTIF' && strtoupper($jenis_pilihanraya) == 'DUN'){
                        $this->pencalonan_dun_aktif($pilihanraya_bil);
                    }
                    $data['pilihanraya'] = $this->pilihanraya_model->papar($pilihanraya_bil);
                    $data['status_berjaya'] = 'Maklumat telah disimpan';
                    $this->load->view('susunletak/atas', $data);
                    $this->load->view('pilihanraya/info');
                    $this->load->view('susunletak/bawah');
                }

                break;
            default :
                redirect(base_url());
        }
        
        

    }

    private function pencalonan_parlimen_aktif($pilihanraya_bil)
    {
        if(empty($pilihanraya_bil)){
            redirect(base_url());
        }
        $this->load->model('pilihanraya_model');
        $this->load->model('winnable_candidate_parlimen_model');
        $this->load->model('ahli_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('foto_model');
        $senarai_parlimen = $this->pilihanraya_model->pr_parlimen($pilihanraya_bil);
        foreach($senarai_parlimen as $parlimen){
            $senarai_calon = $this->winnable_candidate_parlimen_model->calon_parlimen($parlimen->ppt_parlimen_bil);
            foreach($senarai_calon as $calon){
                $calon_ahli = $this->ahli_model->ahli_nama($calon->wct_nama_penuh);
     
                    //MASUK AHLI
                    $ahliFoto = "5"; 
                    $ahliNama = $calon->wct_nama_penuh;
                    $umur_calon = $calon->wct_kategori_umur;
                    $umur = explode(" ", $umur_calon);
                    $ahliUmur = $umur[0];
                    $ahliJantina = $calon->wct_jantina; 
                    $ahliPendidikan = "Belum Ditetapkan"; 
                    $ahliPengguna = $this->session->userdata('pengguna_bil');
                    $ahli = $this->ahli_model->daftar_ahli($ahliFoto, $ahliNama, $ahliUmur, $ahliJantina, $ahliPendidikan, $ahliPengguna);
                    $ahliBil = $ahli['last_id'];
                    //MASUK FOTO
                    $foto = $this->foto_model->foto($calon->wct_foto_bil);
                    $wct_path = './assets/img/'.$foto->foto_nama;
                    if(file_exists($wct_path)){
                        $wct_info_path = pathinfo($wct_path);
                        $filename = "ahli".$ahliBil.".".$wct_info_path['extension'];
                        $ahli_path = './assets/img/'.$filename;
                        if(copy($wct_path, $ahli_path)){
                            $nama = $filename;
                            $deskripsi = "Gambar bagi ".$calon->wct_nama_penuh; 
                            $waktu = date("Y-m-d H:i:s"); 
                            $pengguna_bil = $this->session->userdata('pengguna_bil');
                            $insert_id = $this->foto_model->wct_ahli($nama, $deskripsi, $waktu, $pengguna_bil);
						    $this->ahli_model->tukar_gambar_ahli($ahliBil, $insert_id);
                        }
                    }
                
                $parlimenBil = $parlimen->ppt_parlimen_bil; 
                $pencalonan_bil = "";
                $pencalonan_parlimen = $this->pencalonan_parlimen_model->papar_ada($pilihanraya_bil, $parlimenBil, $ahliBil);
                if(empty($pencalonan_parlimen)){
                    //MASUK PENCALONAN PARLIMEN
                    $parlimenNama = $parlimen->pt_nama; 
                    $ahliNama = $calon->wct_nama_penuh; 
                    $partiBil = $calon->wct_parti_bil; 
                    $penggunaBil = $this->session->userdata('pengguna_bil'); 
                    $penggunaNama = $this->session->userdata('pengguna_nama'); 
                    $pencalonan = $this->pencalonan_parlimen_model->daftar_calon($parlimenBil, $parlimenNama, $ahliBil, $ahliNama, $partiBil, $penggunaBil, $penggunaNama, $pilihanraya_bil);
                    $pencalonan_bil = $pencalonan['last_id'];
                }else{
                    $pencalonan_bil = $pencalonan_parlimen->pencalonan_parlimen_bil;
                }
                //MASUK KEKUATAN
                $kuat_calon = $this->winnable_candidate_parlimen_model->kekuatan_calon($calon->wct_bil, "Kekuatan Calon");
                if(!empty($kuat_calon)){
                foreach($kuat_calon as $kuat){
                    $kuat_parlimen = $this->pencalonan_parlimen_model->cari_kuat($pencalonan_bil, 'Kekuatan Calon', $kuat->wctm_deskripsi);
                    if(empty($kuat_parlimen)){
                        $d = array(
                            'pptt_pencalonan_bil' => $pencalonan_bil,
                            'pptt_kuat_lemah' => 'Kekuatan Calon',
                            'pptt_deskripsi' => $kuat->wctm_deskripsi,
                            'pptt_pengguna_bil' => $this->session->userdata('pengguna_bil'),
                            'pptt_pengguna_waktu' => date('Y-m-d H:i:s')
                        );
                        $this->pencalonan_parlimen_model->tambah_kuat($d);
                    }   
                }
                }
                //MASUK KELEMAHAN
                $lemah_calon = $this->winnable_candidate_parlimen_model->kekuatan_calon($calon->wct_bil, "Kelemahan Calon");
                if(!empty($lemah_calon)){
                foreach($lemah_calon as $lemah){
                    $lemah_parlimen = $this->pencalonan_parlimen_model->cari_kuat($pencalonan_bil, 'Kelemahan Calon', $kuat->wctm_deskripsi);
                    if(empty($lemah_parlimen)){
                        $d = array(
                            'pptt_pencalonan_bil' => $pencalonan_bil,
                            'pptt_kuat_lemah' => 'Kelemahan Calon',
                            'pptt_deskripsi' => $kuat->wctm_deskripsi,
                            'pptt_pengguna_bil' => $this->session->userdata('pengguna_bil'),
                            'pptt_pengguna_waktu' => date('Y-m-d H:i:s')
                        );
                        $this->pencalonan_parlimen_model->tambah_kuat($d);
                    }   
                }
                }
            }         
        }
    }

    private function pencalonan_dun_aktif($pilihanraya_bil)
    {
        if(empty($pilihanraya_bil)){
            redirect(base_url());
        }
        $this->load->model('pilihanraya_model');
        $this->load->model('jangka_dun_model');
        $this->load->model('ahli_model');
        $this->load->model('pencalonan_model');
        $this->load->model('foto_model');
        $senarai_dun = $this->pilihanraya_model->pr_dun($pilihanraya_bil);
        foreach($senarai_dun as $dun){
            $senarai_calon = $this->jangka_dun_model->calon_dun($dun->pdt_dun_bil);
            foreach($senarai_calon as $calon){
                $calon_ahli = $this->ahli_model->ahli_nama($calon->jdt_nama_penuh);
                
                    //MASUK AHLI
                    $ahliFoto = "5"; 
                    $ahliNama = $calon->jdt_nama_penuh;
                    $umur_calon = $calon->jdt_kategori_umur;
                    $umur = explode(" ", $umur_calon);
                    $ahliUmur = $umur[0];
                    $ahliJantina = $calon->jdt_jantina; 
                    $ahliPendidikan = "Belum Ditetapkan"; 
                    $ahliPengguna = $this->session->userdata('pengguna_bil');
                    $ahli = $this->ahli_model->daftar_ahli($ahliFoto, $ahliNama, $ahliUmur, $ahliJantina, $ahliPendidikan, $ahliPengguna);
                    $ahliBil = $ahli['last_id'];
                    //MASUK FOTO
                    $foto = $this->foto_model->foto($calon->jdt_foto_bil);
                    $jdt_path = './assets/img/'.$foto->foto_nama;
                    if(file_exists($jdt_path)){
                        $jdt_info_path = pathinfo($jdt_path);
                        $filename = "ahli".$ahliBil.".".$jdt_info_path['extension'];
                        $ahli_path = './assets/img/'.$filename;
                        if(copy($jdt_path, $ahli_path)){
                            $nama = $filename;
                            $deskripsi = "Gambar bagi ".$calon->jdt_nama_penuh; 
                            $waktu = date("Y-m-d H:i:s"); 
                            $pengguna_bil = $this->session->userdata('pengguna_bil');
                            $insert_id = $this->foto_model->wct_ahli($nama, $deskripsi, $waktu, $pengguna_bil);
						    $this->ahli_model->tukar_gambar_ahli($ahliBil, $insert_id);
                        }
                    }
                
                $dunBil = $dun->pdt_dun_bil; 
                $pencalonan_bil = "";
                $pencalonan_dun = $this->pencalonan_model->papar_ada($pilihanraya_bil, $dunBil, $ahliBil);
                if(empty($pencalonan_dun)){
                    //MASUK PENCALONAN DUN
                    $dunNama = $dun->dun_nama; 
                    $ahliNama = $calon->jdt_nama_penuh; 
                    $partiBil = $calon->jdt_parti_bil; 
                    $penggunaBil = $this->session->userdata('pengguna_bil'); 
                    $penggunaNama = $this->session->userdata('pengguna_nama'); 
                    $pencalonan = $this->pencalonan_model->daftar_calon($dunBil, $ahliBil, $partiBil, $penggunaBil, $penggunaNama, $pilihanraya_bil);
                    $pencalonan_bil = $pencalonan['last_id'];
                }else{
                    $pencalonan_bil = $pencalonan_dun->pencalonan_bil;
                }
                //MASUK KEKUATAN
                $kuat_calon_dun = $this->jangka_dun_model->kekuatan_calon($calon->jdt_bil, "Kekuatan Calon");
                if(!empty($kuat_calon_dun)){
                foreach($kuat_calon_dun as $kuat){
                    $kuat_dun = $this->pencalonan_model->cari_kuat($pencalonan_bil, 'Kekuatan Calon', $kuat->jdtt_deskripsi);
                    if(empty($kuat_dun)){
                        $d = array(
                            'pdtt_pencalonan_bil' => $pencalonan_bil,
                            'pdtt_kuat_lemah' => 'Kekuatan Calon',
                            'pdtt_deskripsi' => $kuat->jdtt_deskripsi,
                            'pdtt_pengguna_bil' => $this->session->userdata('pengguna_bil'),
                            'pdtt_pengguna_waktu' => date('Y-m-d H:i:s')
                        );
                        $this->pencalonan_model->tambah_kuat($d);
                    }   
                }
                }
                //MASUK KELEMAHAN
                $lemah_calon_dun = $this->jangka_dun_model->kekuatan_calon($calon->jdt_bil, "Kelemahan Calon");
                if(!empty($lemah_calon_dun)){
                foreach($lemah_calon_dun as $lemah){
                    $lemah_dun = $this->pencalonan_model->cari_kuat($pencalonan_bil, 'Kelemahan Calon', $lemah->jdtt_deskripsi);
                    if(empty($lemah_dun)){
                        $d = array(
                            'pdtt_pencalonan_bil' => $pencalonan_bil,
                            'pdtt_kuat_lemah' => 'Kelemahan Calon',
                            'pdtt_deskripsi' => $lemah->jdtt_deskripsi,
                            'pdtt_pengguna_bil' => $this->session->userdata('pengguna_bil'),
                            'pdtt_pengguna_waktu' => date('Y-m-d H:i:s')
                        );
                        $this->pencalonan_model->tambah_kuat($d);
                    }   
                }
                }
            }         
        }
    }

    public function proses_parlimen(){
        $tmp_peranan = $this->session->userdata('peranan');
        if(empty($tmp_peranan)){
            redirect('pengguna/logout');
        }
        if(strtoupper($tmp_peranan) != 'URUSETIA'){
            redirect('pengguna/logout');
        }
        $this->load->model('pilihanraya_model');
        $parlimen_bil = $this->input->post('input_parlimen');
        $pilihanraya_bil = $this->input->post('input_pilihanraya_bil');
        
        if(!empty($parlimen_bil)){
            $bil = count($parlimen_bil);
            for($i = 0; $i < $bil; $i++){
                $ada = $this->pilihanraya_model->semak_parlimen($pilihanraya_bil, $parlimen_bil[$i]);
                if(empty($ada)){
                    $this->pilihanraya_model->tambah_parlimen($parlimen_bil[$i]);
                }
            }
        }

        redirect('pilihanraya/info/'.$pilihanraya_bil, 'refresh');

    }
    public function proses_dun(){
        $tmp_peranan = $this->session->userdata('peranan');
        if(empty($tmp_peranan)){
            redirect('pengguna/logout');
        }
        if(strtoupper($tmp_peranan) != 'URUSETIA'){
            redirect('pengguna/logout');
        } 
        $this->load->model('pilihanraya_model');
        $dun_bil = $this->input->post('input_dun');
        $pilihanraya_bil = $this->input->post('input_pilihanraya_bil');
        
        if(!empty($dun_bil)){
            $bil = count($dun_bil);
            for($i = 0; $i < $bil; $i++){
                $ada = $this->pilihanraya_model->semak_dun($pilihanraya_bil, $dun_bil[$i]);
                if(empty($ada)){
                    $this->pilihanraya_model->tambah_dun($dun_bil[$i]);
                }
            }
        }

        redirect('pilihanraya/info/'.$pilihanraya_bil, 'refresh');
        
    }

    public function buang_parlimen_tanding()
    {
        $this->load->model('pilihanraya_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->pilihanraya_model->buang_parlimen_tanding();
        $this->pencalonan_parlimen_model->padam_parlimen($this->input->post('input_parlimen_dun_bil'), $this->input->post('input_pilihanraya_bil'));
        $pilihanraya_bil = $this->input->post('input_pilihanraya_bil');
        redirect('pilihanraya/info/'.$pilihanraya_bil, 'refresh');
    }

    public function buang_dun_tanding()
    {
        $this->load->model('pilihanraya_model');
        $this->pilihanraya_model->buang_dun_tanding();
        $pilihanraya_bil = $this->input->post('input_pilihanraya_bil');
        redirect('pilihanraya/info/'.$pilihanraya_bil, 'refresh');
    }


    public function maklumat($bil){
        $this->load->model('pilihanraya_model');
        $this->load->model('parti_model');
        $this->load->model('pencalonan_model');
        $this->load->model('pencalonan_parlimen_model');
        $this->load->model('parlimen_model');
        $data['data_parlimen'] = $this->parlimen_model;
        $data['pilihanraya'] = $this->pilihanraya_model->papar($bil);
        $data['senarai_pencalonan_parlimen'] = $this->pencalonan_parlimen_model->senarai_parlimen($bil);
        $data['senarai_calon_parlimen'] = $this->pencalonan_parlimen_model->senaraiCalonPilihanraya($bil);
        $data['senarai_dun'] = $this->pencalonan_model->dun_pilihanraya($bil);
        $data['senarai_calon'] = $this->pencalonan_model->papar_ikut_calon($bil);
        $data['parti'] = $this->parti_model;
        $this->load->view('admin/atas', $data);
        $this->load->view('admin/maklumat');
        $this->load->view('admin/bawah');

    }

    public function pilih_japen(){
        $this->load->model('pencalonan_model');
        $this->pencalonan_model->clear_semasa_japen($this->input->post('pilihanraya_bil'), $this->input->post('dun_bil'));
        $this->pencalonan_model->pilih_japen();
        redirect('pilihanraya/maklumat/'.$this->input->post('pilihanraya_bil'));
    }

    public function tidak_rasmi(){
        $this->load->model('pencalonan_model');
        $this->pencalonan_model->clear_semasa_tidak_rasmi($this->input->post('pilihanraya_bil'), $this->input->post('dun_bil'));
        $this->pencalonan_model->tidak_rasmi();
        redirect('pilihanraya/maklumat/'.$this->input->post('pilihanraya_bil'));
    }

    public function keputusan(){
        $this->load->model('pencalonan_model');
        $this->pencalonan_model->clear_semasa_rasmi($this->input->post('pilihanraya_bil'), $this->input->post('dun_bil'));
        $this->pencalonan_model->pilih_rasmi();
        redirect('pilihanraya/maklumat/'.$this->input->post('pilihanraya_bil'));
    }

    public function grading($bil){
        $tmp_peranan = $this->session->userdata('peranan');
        if(empty($tmp_peranan)){
            redirect('pengguna/logout');
        }
        if(strtoupper($tmp_peranan) != 'ADMIN'){
            redirect('pengguna/logout');
        }
        $this->load->model('pilihanraya_model');
        $this->load->model('dun_model');
        $this->load->model('parti_model');
        $data['pilihanraya'] = $this->pilihanraya_model->papar($bil);
        $data['senarai_dun'] = $this->dun_model->dun_ikut_pilihanraya($bil);
        $data['senarai_parti'] = $this->parti_model->parti_ikut_pilihanraya($bil);
        $this->load->view('admin/atas', $data);
        $this->load->view('admin/sismap');
        $this->load->view('admin/bawah');
    }

    public function pilih($pilihanraya_bil)
    {
        if(empty($pilihanraya_bil))
        {
            redirect(base_url());
        }
        $this->load->model('pilihanraya_model');
        foreach($this->pilihanraya_model->papar($pilihanraya_bil) as $p)
        {
            $pilihanraya_nama = $p->pilihanraya_nama;
            $pilihanraya_singkatan = $p->pilihanraya_singkatan;
        }
        $stored = array(
            'pilihanraya_bil' => $pilihanraya_bil,
            'pilihanraya_nama' => $pilihanraya_nama,
            'pilihanraya_singkatan' => $pilihanraya_singkatan
        );
        $this->session->set_userdata($stored);
        $data['pilihanraya_singkatan'] = $pilihanraya_singkatan;
        $this->load->view('pegawai_lapangan/atas', $data);
		$this->load->view('pegawai_lapangan/pilih_negeri');
		$this->load->view('pegawai_lapangan/bawah');
    }

    public function pilih_negeri($negeri_bil)
    {
        $negeri = '';
        switch($negeri_bil)
        {
            case '1'    : $negeri = 'Terengganu'; break;
            case '2'    : $negeri = 'Perlis'; break;
            case '3'    : $negeri = 'Selangor'; break;
            case '4'    : $negeri = 'Negeri Sembilan'; break;
            case '5'    : $negeri = 'Johor'; break;
            case '6'    : $negeri = 'Kelantan'; break;
            case '7'    : $negeri = 'Perak'; break;
            case '8'    : $negeri = 'Kedah'; break;
            case '9'    : $negeri = 'Pahang'; break;
            case '10'   : $negeri = 'Pulau Pinang'; break;
            case '11'   : $negeri = 'Sabah'; break;
            case '12'   : $negeri = 'Sarawak'; break;
            case '13'   : $negeri = 'Melaka'; break;
            case '14'   : $negeri = 'Wilayah Persekutuan Kuala Lumpur'; break;
            case '15'   : $negeri = 'Wilayah Persekutuan Labuan'; break;
            case '16'   : $negeri = 'Wilayah Persekutuan Putrajaya'; break;
            default :   redirect(base_url());
        }
        $stored = array(
            'negeri_nama' => $negeri,
            'negeri_bil' => $negeri_bil
        );
        $this->session->set_userdata($stored);
        $data['pilihanraya_singkatan'] = $this->session->userdata('pilihanraya_singkatan');
        $data['pilihanrayaBil'] = $this->session->userdata('pilihanraya_bil');
        $data['negeri_bil'] = $negeri_bil;
        $data['negeri_nama'] = $negeri;
        $this->load->model('dun_model');
        $this->load->model('parlimen_model');
        $data['senarai_dun'] = $this->dun_model->papar_ikut_negeri($negeri);
        $data['senaraiParlimen'] = $this->parlimen_model->paparIkutNegeri($negeri);
        $this->load->view('pegawai_lapangan/atas', $data);
		$this->load->view('pegawai_lapangan/utama');
		$this->load->view('pegawai_lapangan/bawah');
    }

}