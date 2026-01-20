<?php 
class Kempen extends CI_Controller {

    private function template($sesi){
        $sesi = strtoupper($sesi);
        switch($sesi){
            case 'URUSETIA' :
                $view = "urussetia_na";
                break;
            case "DATA" :
                $view = "us_sismap_na";
                break;
            case 'PPD' :
                $view = "ppd_na";
                break;
            case 'NEGERI' :
                $view = "negeri_na";
                break;
            default :
                redirect(base_url());
        }
        $template = [
            "header" => "$view/susunletak/atas",
            "sidebar" => "$view/susunletak/sidebar",
            "navbar" => "$view/susunletak/navbar",
            "footer" => "$view/susunletak/bawah"
        ];
        return $template;
    }

    private function pengguna(){
        $penggunaBil = $this->session->userdata("pengguna_bil");
        $this->load->model("pengguna_model");
        $pengguna = $this->pengguna_model->pengguna($penggunaBil);
        return $pengguna;
    }

    private function sesi(){
        $sesi = strtoupper($this->session->userdata("peranan"));
        if(empty($sesi)){
            redirect(base_url());
        }
        if(strpos($sesi, 'PPD') !== false){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'NEGERI') !== false){
            $sesi = 'NEGERI';
        }
        return $sesi;
    }

    public function index(){
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        $data = array_merge($data, $this->template($sesi));
        $this->load->model("kempen_model");
        $data['senaraiKempen'] = $this->kempen_model->senaraiTarikh(date("Y-m-d"));
        $data['senaraiGambarKempen'] = $this->kempen_model->senaraiGambarTarikh(date("Y-m-d"));
        $data['gunaView'] = ["kempen/utama"];
        $this->load->view("baseTemplate", $data);
    }

    public function hapus($kempenBil){
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        $this->load->model("kempen_model");
        $this->db->where('kempen_pru_bil', $kempenBil);
        $padam = $this->db->delete('kempen_pru_tb');
        if($padam){
            $this->session->set_flashdata("mesej", "<div class='alert alert-success'>Rekod berjaya dipadam.</div>");
        } else {
            $this->session->set_flashdata("mesej", "<div class='alert alert-danger'>Rekod gagal dipadam. Sila cuba lagi.</div>");
        }
        redirect("kempen");
    }

    // Fungsi untuk membersihkan data sebelum dimasukkan ke dalam sel
    private function bersih_sel($data) {
        // 1. Buang sebarang tab, newline, atau carriage return
        $data = str_replace(["\t", "\n", "\r"], ' ', $data);
        // 2. Jika data adalah '0' (string), kekalkan ia
        if ($data == '0') {
            return '0';
        }
        // 3. Jika data kosong (null atau false), pulangkan string kosong
        if (empty($data)) {
            return '';
        }
        // 4. Pulangkan data yang telah dibersihkan
        return $data;
    }

    public function muatTurunSenarai(){
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        $this->load->model(["kempen_model", 'pdm_model']);
        $senaraiKempen = $this->kempen_model->senarai();
        
        $filename = date("d.m")."_RIMS@SISMAP_aktiviti_kempen.xls";

        header("Content-Type: application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=\"$filename\"");

        // 2. Tajuk (Headers)
        $tajuk = [
            "BIL", "PELAPOR", "PELAPOR JAWATAN", "PELAPOR PENEMPATAN", 
            "PRU NAMA", "PRU SINGKATAN", "TARIKH", "MASA", "PDM NAMA", 
            "LOKASI", "JENIS AKTIVITI", "AKTIVITI", "PARTI SINGKATAN", "PEMIMPIN YANG HADIR", "ISU YANG DIBANGKITKAN"
        ];
        echo implode("\t", $tajuk) . "\n"; // Guna \n untuk baris baru

        // 3. Data (Rows)
        foreach($senaraiKempen as $kempen){
            // Gunakan fungsi 'bersih_sel' pada setiap data
            $baris = [
                $this->bersih_sel($kempen->kempen_pru_bil),
                $this->bersih_sel($kempen->kempen_pru_pelapor_nama),
                $this->bersih_sel($kempen->kempen_pru_pelapor_jawatan),
                $this->bersih_sel($kempen->kempen_pru_pelapor_penempatan),
                $this->bersih_sel($kempen->kempen_pru_pru_nama),
                $this->bersih_sel($kempen->kempen_pru_pru_singkatan),
                $this->bersih_sel($kempen->kempen_pru_tarikh),
                $this->bersih_sel($kempen->kempen_pru_masa),
                $this->bersih_sel($kempen->kempen_pru_pdm_nama),
                $this->bersih_sel($kempen->kempen_pru_lokasi),
                $this->bersih_sel($kempen->kempen_pru_jenis_aktiviti),
                $this->bersih_sel($kempen->kempen_pru_aktiviti),
                $this->bersih_sel($kempen->kempen_pru_parti_singkatan),
                $this->bersih_sel($kempen->kempen_pru_pemimpin),
                $this->bersih_sel($kempen->kempen_pru_perkara_berbangkit)
            ];
            echo implode("\t", $baris) . "\n";
        }
        exit();
    }

    public function uploadGambarKempen($kempenBil){
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        $jumlahGambar = isset($_FILES['inputGambar']['name']) ? count($_FILES['inputGambar']['name']) : 0;
        $upload_path = './assets/img/aktivitiKempen/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
            chmod($upload_path, 0755);
        }
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 0;
        $this->load->library('upload', $config);
        for($i = 0; $i < $jumlahGambar; $i++){
            $_FILES['file']['name'] = $_FILES['inputGambar']['name'][$i];
            $_FILES['file']['type'] = $_FILES['inputGambar']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['inputGambar']['tmp_name'][$i];
            $_FILES['file']['error'] = $_FILES['inputGambar']['error'][$i];
            $_FILES['file']['size'] = $_FILES['inputGambar']['size'][$i];

            
           
            $config['file_name'] = 'AK'.$kempenBil.'_'.time().'_'.$i;

            $this->upload->initialize($config);

            if($this->upload->do_upload('file')){
                $dataGambar = $this->upload->data();
                $simpanDataGambar = [
                    'kempen_pru_gambar_kempen_pru_bil' => $kempenBil,
                    'kempen_pru_gambar_nama_fail' => $dataGambar['file_name'],
                    'kempen_pru_gambar_deskripsi' => 'Gambar Aktiviti Kempen ' . $kempenBil . " - " . date("Y-m-d H:i:s"),
                    'kempen_pru_tarikh_dibina' => date("Y-m-d H:i:s"),
                    'kempen_pru_gambar_pelapor_bil' => $this->session->userdata("pengguna_bil")
                ];
                $this->load->model("kempen_model");
                $this->kempen_model->tambahGambarKempen($simpanDataGambar);
            }
        }
    }

    public function simpan(){
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        $this->load->library("form_validation");
        $this->form_validation->set_rules("inputPdm", "PDM", "required");
        $this->form_validation->set_rules("inputParti", "Parti", "required");
        $this->form_validation->set_rules("tarikh", "Tarikh", "required");
        $this->form_validation->set_rules("masa", "Masa", "required"); 
        if($this->form_validation->run() == FALSE){
            $this->tambah();
        } else {
            $input = $this->input->post();
            $this->load->model(["kempen_model", "pengguna_model", "pilihanraya_model", "pdm_model", "parti_model"]);
            //1) LOAD PELAPOR
            $pelaporBil = $input['inputPengguna'];
            $pelapor = $this->pengguna_model->pelapor($pelaporBil);
            //2) LOAD PILIHAN RAYA
            $pruBil = $input['inputPru'];
            $pru = $this->pilihanraya_model->pr($pruBil);
            //3) LOAD DAERAH MENGUNDI
            $pdmBil = $input['inputPdm'];
            $puncaDm = $input['inputPuncaDmDun'];
            if($pru->pruJenis == "PARLIMEN"){
                $pdm = $this->pdm_model->pdmParlimen($pdmBil);
            } else {
                $pdm = $this->pdm_model->pdmDun($pdmBil);
            }
            //4) LOAD PARTI
            $partiBil = $input['inputParti'];
            $parti = $this->parti_model->satuParti($partiBil);
            //5) SIMPAN DATA KEMPEN
            $simpanData = [
                "kempen_pru_pelapor_bil" => $pelapor->penggunaBil,
                "kempen_pru_pelapor_nama" => $pelapor->penggunaNama,
                "kempen_pru_pelapor_jawatan" => $pelapor->penggunaJawatan,
                "kempen_pru_pelapor_penempatan" => $pelapor->penggunaPenempatan,
                "kempen_pru_pru_bil" => $pru->pruBil,
                "kempen_pru_pru_nama" => $pru->pruNama,
                "kempen_pru_pru_singkatan" => $pru->pruSingkatan,
                "kempen_pru_tarikh" => date("Y-m-d", strtotime($input['tarikh'])),
                "kempen_pru_masa" => date("H:i:s", strtotime($input['masa'])),
                "kempen_pru_pdm_bil" => $pdm->pdmBil,
                "kempen_pru_pdm_nama" => $pdm->pdmNama,
                "kempen_pru_parti_bil" => $parti->partiBil,
                "kempen_pru_parti_nama" => $parti->partiNama,
                "kempen_pru_parti_singkatan" => $parti->partiSingkatan,
                "kempen_pru_lokasi" => $input['lokasi'],
                "kempen_pru_aktiviti" => $input['aktiviti'],
                "kempen_pru_jenis_aktiviti" => $input['inputJenisAktiviti'],
                "kempen_pru_pemimpin" => $input['calon_parti'],
                "kempen_pru_perkara_berbangkit" => $input['inputIsuBerbangkit'],
                "kempen_pru_tarikh_dibina" => $input['inputTarikhCipta']
            ];
            $simpan = $this->kempen_model->tambahKempen($simpanData);
            if($simpan){
                //4) SIMPAN GAMBAR KEMPEN JIKA ADA
                $this->uploadGambarKempen($simpan);
                $this->session->set_flashdata("mesej", "<div class='alert alert-success'>Rekod berjaya disimpan.</div>");
                redirect("kempen");
            } else {
                $this->session->set_flashdata("mesej", "<div class='alert alert-danger'>Rekod gagal disimpan. Sila cuba lagi.</div>");
                $this->simpan();
            }
        }
    }

    public function tambah(){
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        $data = array_merge($data, $this->template($sesi));
        $this->load->model(["pdm_model", "parti_model", "pilihanraya_model", "pencalonan_model", "pencalonan_parlimen_model", "dun_model", "negeri_model"]);
        $data['inputPuncaDmDun'] = "DUN";
        $data['senaraiPdm'] = [];
        $data['senaraiPruAktif'] = [];
        $data['senaraiParti'] = [];
        switch($sesi){
            case "DATA" :
                //SEMUA
                $senaraiTugasanPru = $this->pilihanraya_model->senaraiPruAktif();
                break;
            case 'NEGERI' :
                //MENGIKUT NEGERI
                $senaraiTugasanPru = [];
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $senaraiPruParlimen = $this->pilihanraya_model->senaraiPruParlimenAktifbyNegeri($senaraiNegeri);
                $senaraiPruDun = $this->pilihanraya_model->senaraiPruDunAktifbyNegeri($senaraiNegeri);
                foreach($senaraiPruParlimen as $pru){
                    if(!in_array($pru, $senaraiTugasanPru)){
                        $senaraiTugasanPru[] = $pru;
                    }
                }
                foreach($senaraiPruDun as $pru){
                    if(!in_array($pru, $senaraiTugasanPru)){
                        $senaraiTugasanPru[] = $pru;
                    }
                }
                break;
            case 'PPD' :
                //MENGIKUT PERANAN PPD
                $this->load->model(["pegawai_model"]);
                $senaraiTugasanPru = $this->pegawai_model->senaraiTugasanPruAktif($data['pengguna']->bil);
                break;
            default :
                redirect(base_url());   
        }

        foreach($senaraiTugasanPru as $pru){
            if(!in_array($pru, $data['senaraiPruAktif'])){
                    $data['senaraiPruAktif'][] = $pru;
            }
            if($pru->pilihanraya_jenis == "PARLIMEN"){
                $senaraiParlimen = $this->pilihanraya_model->senaraiParlimen($pru->pruBil);
                $senaraiParlimenDm = $this->pdm_model->pdmParlimenByPru($senaraiParlimen);
                foreach($senaraiParlimenDm as $pdm){
                    if(!in_array($pdm, $data['senaraiPdm'])){
                        $data['senaraiPdm'][] = $pdm;
                    }
                }
                $senaraiPartiParlimen = $this->pencalonan_parlimen_model->senaraiPartiCalon($data['senaraiPruAktif']);
                foreach($senaraiPartiParlimen as $parti){
                    if(!in_array($parti, $data['senaraiParti'])){
                        $data['senaraiParti'][] = $parti;
                    }
                }
            }else{
                $senaraiDun = $this->pilihanraya_model->senaraiDun($pru->pruBil);
                $senaraiDunDm = $this->pdm_model->pdmDunByPru($senaraiDun);
                foreach($senaraiDunDm as $pdm){
                    if(!in_array($pdm, $data['senaraiPdm'])){
                        $data['senaraiPdm'][] = $pdm;
                    }
                }
                $senaraiPartiDun = $this->pencalonan_model->senaraiPartiCalon($data['senaraiPruAktif']);
                foreach($senaraiPartiDun as $parti){
                    if(!in_array($parti, $data['senaraiParti'])){
                        $data['senaraiParti'][] = $parti;
                    }
                }
            }
        }

        $data['gunaView'] = ["kempen/tambah"];
        $this->load->view("baseTemplate", $data);
    }

}