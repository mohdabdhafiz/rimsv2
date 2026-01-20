<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

    /**
     * Constructor
     * Loads common models needed across multiple functions.
     */
    public function __construct()
    {
        parent::__construct();
        // Load models that are frequently used to avoid repetition.
        $this->load->model("pengguna_model");
        $this->load->helper('url'); // Load URL Helper for site_url()
        $this->load->library('session'); // Load Session Library for flashdata
    }

    //======================================================================
    // PRIVATE HELPER FUNCTIONS
    //======================================================================

    private function pengguna(){
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(empty($penggunaBil)){
            redirect(base_url());
        }
        return $this->pengguna_model->pengguna($penggunaBil);
    }

    private function sesi(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(empty($sesi)){
            redirect(base_url());
        }
        switch($sesi){
            case "URUSETIA" : return "urusetia_na";
            case "LAPIS": return 'us_lapis_na';
            case "DATA": return 'us_sismap_na';
            default : redirect(base_url());
        }
    }

    private function templates($sesi){
        return [
            "header"  => $sesi."/susunletak/atas",
            "sidebar" => $sesi."/susunletak/sidebar",
            "navbar"  => $sesi."/susunletak/navbar",
            "footer"  => $sesi."/susunletak/bawah"
        ];
    }

    private function renderView($viewData, $viewFiles)
    {
        $viewData['gunaView'] = $viewFiles;
        $this->load->view("baseTemplate", $viewData);
    }
    //======================================================================
    // PUBLIC FUNCTIONS


    public function pru_view($pru_bil){
        if(empty($pru_bil) || !is_numeric($pru_bil)){
            redirect(site_url('pegawai/senarai'));
        }
        $this->load->model(['pegawai_model', 'pilihanraya_model']);
        $sesi = $this->sesi();
        $data["pengguna"] = $this->pengguna();
        $data = array_merge($data, $this->templates($sesi));
        $data['pru'] = $this->pilihanraya_model->pilihanraya($pru_bil);
        $data['petugas_list'] = [];
        if(empty($data['pru'])){
            $this->session->set_flashdata('error', 'Rekod pilihan raya tidak dijumpai.');
            redirect(site_url('pegawai/senarai'));
        }
        $data['petugas_list'] = $this->pegawai_model->senarai_pegawai_by_pru($pru_bil);
        $this->renderView($data, ["pegawai/pru_view"]);
    }

    public function delete($pgBil){
        if(empty($pgBil) || !is_numeric($pgBil)){
            redirect(site_url('pegawai/senarai'));
        }
        $this->load->model('pegawai_model');
        $pegawai = $this->pegawai_model->satu_data($pgBil);
        if(empty($pegawai)){
            $this->session->set_flashdata('error', 'Rekod pegawai tidak dijumpai.');
            redirect(site_url('pegawai/senarai'));
        }   
        if($this->pegawai_model->buang($pgBil)){
            $this->session->set_flashdata('success', 'Pegawai berjaya dipadam.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memadam pegawai. Sila cuba lagi.');
        }
        redirect(site_url('pegawai/senarai'));
    }

    public function view($pengguna_bil){
        if(empty($pengguna_bil) || !is_numeric($pengguna_bil)){
            redirect(site_url('pegawai/senarai'));
        }
        $this->load->model('pegawai_model');
        $sesi = $this->sesi();
        $data["pengguna"] = $this->pengguna();
        $data = array_merge($data, $this->templates($sesi));
        $data['pegawai'] = $this->pengguna_model->pengguna($pengguna_bil);
        $data['pilihanraya_list'] = [];
        if(empty($data['pegawai'])){
            $this->session->set_flashdata('error', 'Rekod pegawai tidak dijumpai.');
            redirect(site_url('pegawai/senarai'));
        }   
        $data['pilihanraya_list'] = $this->pegawai_model->senarai_pru_by_pegawai($pengguna_bil);
        $this->renderView($data, ["pegawai/pegawai_view"]);
    }

    public function tambah(){
        $sesi = $this->sesi();
        $data["pengguna"] = $this->pengguna();
        $data = array_merge($data, $this->templates($sesi));

        $this->load->model(['pegawai_model', 'pilihanraya_model']);
        $data['penggunaList'] = $this->pengguna_model->senarai();
        $data['pruList'] = $this->pilihanraya_model->senarai();
        if($this->input->post()){
            $postData = $this->input->post();
            // Validate required fields
            $requiredFields = ['pengguna_bil', 'pruBil'];
            foreach($requiredFields as $field){         
                if(empty($postData[$field])){
                    $this->session->set_flashdata('error', 'Sila lengkapkan semua medan yang diperlukan.');
                    $this->renderView($data, ["pegawai/tambah"]);   
                    return;
                }
            }
            $pruBil = isset($postData['pruBil']) ? $postData['pruBil'] : null;
            $pegawaiBil = isset($postData['pengguna_bil']) ? $postData['pengguna_bil'] : null;

            //SEMAKAN DATA ADA
            $ada = $this->pegawai_model->cari_pegawai_pru($pegawaiBil, $pruBil);
            if(!empty($ada)){
                $this->session->set_flashdata('error', 'Pegawai ini telah wujud untuk pilihan raya yang dipilih.');
                $this->renderView($data, ["pegawai/tambah"]);   
                return;
            }

            //PILIHAN RAYA
            if(empty($pruBil)){
                $this->session->set_flashdata('error', 'Sila pilih PRU yang sah.');
                $this->renderView($data, ["pegawai/tambah"]);   
                return;
            }else{
                $pru = $this->pilihanraya_model->pilihanraya($pruBil);
                if(empty($pru)){
                    $this->session->set_flashdata('error', 'Sila pilih PRU yang sah.');
                    $this->renderView($data, ["pegawai/tambah"]);   
                    return;
                }else{
                    $postData['pru_bil'] = $pru->pilihanraya_bil;
                    $postData['pru_nama'] = $pru->pilihanraya_nama;
                    $postData['pru_singkatan'] = $pru->pilihanraya_singkatan;
                }
            }
            
            //PENGGUNA
            if(empty($pegawaiBil)){
                $this->session->set_flashdata('error', 'Sila pilih pengguna yang sah.');
                $this->renderView($data, ["pegawai/tambah"]);   
                return;
            }else{
                $this->load->model('pengguna_model');
                $pengguna = $this->pengguna_model->pengguna($pegawaiBil);
                if(empty($pengguna)){
                    $this->session->set_flashdata('error', 'Sila pilih pengguna yang sah.');
                    $this->renderView($data, ["pegawai/tambah"]);   
                    return;
                }else{
                    $postData['pengguna'] = $pengguna;
                }
            }   

            $dataToInsert = array(
                'pengguna_bil'     => $postData['pengguna']->bil,
                'pg_nama'          => $postData['pengguna']->nama_penuh,
                'pg_jawatan'       => $postData['pengguna']->pekerjaan,
                'pg_bahagian'      => $postData['pengguna']->pengguna_tempat_tugas,
                'pg_email'         => $postData['pengguna']->emel,
                'pg_telefon'       => $postData['pengguna']->no_tel,
                'pg_ic'            => $postData['pengguna']->pengguna_ic,
                'pru_bil'          => $postData['pru_bil'],
                'pru_nama'         => $postData['pru_nama'],
                'pru_singkatan'    => $postData['pru_singkatan'],
                'pg_peranan'       => $postData['pengguna']->pengguna_peranan_bil,
                'pg_catatan'       => isset($postData['catatan']) ? $postData['catatan'] : null,
                'pg_dicipta_pada'  => date('Y-m-d H:i:s'),
                'pg_diubah_pada'   => date('Y-m-d H:i:s'),
                'pg_dicipta_oleh'  => $this->session->userdata('pengguna_bil'),
                'pg_diubah_oleh'   => $this->session->userdata('pengguna_bil')
            );

            if($this->pegawai_model->tambah($dataToInsert)){
                $this->session->set_flashdata('success', 'Pegawai berjaya ditambah.');
                redirect(site_url('pegawai/senarai'));
            } else {
                $this->session->set_flashdata('error', 'Gagal menambah pegawai. Sila cuba lagi.');
            }
        }
        $this->renderView($data, ["pegawai/tambah"]);
    }

    public function senarai(){
        $sesi = $this->sesi();
        $data["pengguna"] = $this->pengguna();
        $data = array_merge($data, $this->templates($sesi));

        $this->load->model('pegawai_model');
        $data['senarai'] = $this->pegawai_model->senarai();
        $this->renderView($data, ["pegawai/senarai"]);
    }


    public function index(){
        $sesi = $this->sesi();
        $data["pengguna"] = $this->pengguna();
        $data = array_merge($data, $this->templates($sesi));
        
        if($sesi == "URUSETIA"){
            $this->senaraiPeranan();
            return;
        }

        $this->renderView($data, ["pegawai/utama"]);
    }
    
    public function senaraiPeranan(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case "DATA":
                $this->load->view("pegawai/utama", $data);
                break;
            case 'URUSETIA' :
                $this->load->view('urusetia_na/peranan/senaraiPeranan', $data);
                break;
            default :
                redirect(base_url());
        }
    }

}

?>