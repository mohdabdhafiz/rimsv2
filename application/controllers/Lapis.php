<?php class Lapis extends CI_Controller {

    //PRIVATE

    private function templates($sesi){
        $templates = [
            "header" => $sesi."/susunletak/atas",
            "sidebar" => $sesi."/susunletak/sidebar",
            "navbar" => $sesi."/susunletak/navbar",
            "footer" => $sesi."/susunletak/bawah"
        ];
        return $templates;
    }

    private function pengguna(){
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(empty($penggunaBil)){
            redirect(base_url());
        }
        $this->load->model("pengguna_model");
        $pengguna = $this->pengguna_model->pengguna($penggunaBil);
        return $pengguna;
    }

    private function sesi(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(empty($sesi)){
            redirect(base_url());
        }
        switch($sesi){
            case "URUSETIA" : 
                $sesi = "urusetia_na";
                break;
            case "LAPIS":
                $sesi = 'us_lapis_na';
                break;
            default :
                redirect(base_url());
        }
        return $sesi;
    }

    //PUBLIC

    /**
     * FUNGSI BANTUAN BARU: Mengumpul data dari borang lama dan menyimpannya ke lapis_tb.
     * Fungsi ini boleh dipanggil oleh semua fungsi proses_...() untuk mengelakkan ulangan kod.
     */
    private function simpan_ke_lapis_tb()
    {
        // 1. Muatkan semua model yang diperlukan untuk sistem baru
        $models = [
            'lapis2_model', 'kluster_isu_model', 'negeri_model', 
            'daerah_model', 'parlimen_model', 'dun_model', 'pdm_model', 'pengguna_model'
        ];
        $this->load->model($models);

        // 2. Dapatkan maklumat pengguna yang sedang login
        //$pengguna = $this->pengguna();
        $pelapor_bil = $this->input->post('input_pelapor');
        $pengguna = $this->pengguna_model->pengguna($pelapor_bil);

        // 3. Dapatkan nama-nama berdasarkan ID dari borang lama
        // Nota: Nama input (cth: 'input_kluster') adalah andaian. Sila sesuaikan jika berbeza.
        $kluster = $this->kluster_isu_model->satu_data($this->input->post('input_kluster_bil'));
        $daerah = $this->daerah_model->satu_data($this->input->post('input_daerah'));
        $negeri = $this->negeri_model->satu_data($daerah->negeri_bil);
        $parlimen = $this->parlimen_model->satu_data($this->input->post('input_parlimen'));
        $dun = $this->dun_model->satu_data($this->input->post('input_dun'));
        $pdm = $this->pdm_model->satu_data_parlimen($this->input->post('input_pdm'));

        $tajuk_isu = "Laporan Kluster " . ucfirst($kluster->kit_shortform);
        $ringkasan_isu = $this->input->post('input_ringkasan_isu');

        if ($kluster->kit_shortform === 'ekonomi') {
            $tmp_inputEkonomi = $this->input->post('inputEkonomi');
            $tajuk_isu = $tmp_inputEkonomi ? $tmp_inputEkonomi : "Laporan Kluster Ekonomi";
            
            $kenaikan_harga = $this->input->post('input_kenaikan_barangan');
            if ($kenaikan_harga) {
                $tajuk_isu = $tmp_inputEkonomi ? $tmp_inputEkonomi : "Laporan Kenaikan Harga Barangan & Kekurangan Bekalan Barangan";
                $ringkasan_isu .= "<br><br>Isu Kenaikan Harga: " . implode(', ', $kenaikan_harga);
                $tmp_input_lain = $this->input->post('input_lain');
                if (in_array('Lain-lain', $kenaikan_harga) && $tmp_input_lain) {
                    $ringkasan_isu .= " (" . $tmp_input_lain . ")";
                }
            }

            $kekurangan_bekalan = $this->input->post('input_kurang_barangan');
            if ($kekurangan_bekalan) {
                $tajuk_isu = $tmp_inputEkonomi ? $tmp_inputEkonomi : "Laporan Kenaikan Harga Barangan & Kekurangan Bekalan Barangan";
                $ringkasan_isu .= "<br><br>Isu Kekurangan Bekalan: " . implode(', ', $kekurangan_bekalan);
                $tmp_input_kurang_lain = $this->input->post('input_kurang_lain');
                if (in_array('Lain-lain', $kekurangan_bekalan) && $tmp_input_kurang_lain) {
                    $ringkasan_isu .= " (" . $tmp_input_kurang_lain . ")";
                }
            }
        } else {
            $tmp_input_tajuk_isu = $this->input->post('input_tajuk_isu');
            $lain = $this->input->post('input_tajuk_isu_lain');
            if(!empty($lain) && $tmp_input_tajuk_isu == 'Lain-lain'){
                $tmp_input_tajuk_isu = $lain;
            }
            $tajuk_isu = $tmp_input_tajuk_isu;
        }

        // 4. Kumpul data dalam format yang sepadan dengan jadual lapis_tb
        $data_laporan_baru = [
            'lapis_kluster_bil' => $this->input->post('input_kluster_bil'),
            'lapis_kluster_nama' => $kluster ? $kluster->kit_nama : null,
            'lapis_tarikh_laporan' => date('Y-m-d'),
            'lapis_tarikh_laporan_bil' => strtotime($this->input->post('input_tarikh_laporan')),
            'lapis_tarikh_laporan_dibina' => date('Y-m-d H:i:s'),
            'lapis_negeri_bil' => $daerah->negeri_bil,
            'lapis_negeri_nama' => $negeri ? $negeri->nt_nama : null,
            'lapis_daerah_bil' => $this->input->post('input_daerah'),
            'lapis_daerah_nama' => $daerah ? $daerah->nama : null,
            'lapis_parlimen_bil' => $this->input->post('input_parlimen'),
            'lapis_parlimen_nama' => $parlimen ? $parlimen->pt_nama : null,
            'lapis_dun_bil' => $this->input->post('input_dun'),
            'lapis_dun_nama' => $dun ? $dun->dun_nama : null,
            'lapis_dm_bil' => $this->input->post('input_pdm'),
            'lapis_dm_nama' => $pdm ? $pdm->ppt_nama : null,
            'lapis_jenis_kawasan' => $this->input->post('input_jenis_kawasan'),
            'lapis_tajuk_isu' => $tajuk_isu,
            'lapis_ringkasan_isu' => $ringkasan_isu,
            'lapis_cadangan_intervensi' => $this->input->post('input_cadangan_intervensi'),
            'lapis_lokasi' => $this->input->post('input_lokasi'),
            'lapis_latitude' => $this->input->post('input_latitude'),
            'lapis_longitude' => $this->input->post('input_longitude'),
            'lapis_pelapor_bil' => $pengguna->bil,
            'lapis_pelapor_nama' => $pengguna->nama_penuh,
            'lapis_waktu_dibina' => date('Y-m-d H:i:s'),
            'lapis_status' => 'Laporan Diterima' // Status lalai
        ];

        // 5. Panggil model BARU untuk simpan data ke dalam lapis_tb
        $this->lapis2_model->tambah_laporan($data_laporan_baru);
    }

    public function laporanTolak($klusterBil){
        echo "KLUSTER BIL: " . $klusterBil;
    }

    public function check_date_range($end_date) {
        $start_date = $this->input->post('inputTarikhMula');

        if (strtotime($end_date) < strtotime($start_date)) {
            $this->form_validation->set_message('check_date_range', 'Tarikh Tamat mesti selepas Tarikh Mula.');
            return FALSE;
        }
        return TRUE;
    }

    public function carianTerperinci(){
        $this->load->library("form_validation");
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        $data = array_merge($data, $this->templates($sesi));
        $this->load->model([
            "pengguna_model",
            "negeri_model",
            "daerah_model",
            "parlimen_model",
            "dun_model",
            "kluster_isu_model"
        ]);
        $this->form_validation->set_rules('inputTarikhMula', 'Tarikh Mula', 'required');
        $this->form_validation->set_rules('inputTarikhTamat', 'Tarikh Tamat', 'required|callback_check_date_range');
        //DATA YANG DIPERLUKAN
        //1. SENARAI PELAPOR
        $data['senaraiPelapor'] = $this->pengguna_model->senaraiPelaporCarian();
        //2. SENARAI NEGERI
        $data['senaraiNegeri'] = $this->negeri_model->senaraiNegeriCarian();
        //3. SENARAI DAERAH
        $data['senaraiDaerah'] = $this->daerah_model->senaraiDaerahCarian();
        //4. SENARAI PARLIMEN
        $data['senaraiParlimen'] = $this->parlimen_model->senaraiParlimenCarian();
        //5. SENARAI DUN
        $data['senaraiDun'] = $this->dun_model->senaraiDunCarian();
        //6. SENARAI KAWASAN
        $data['senaraiKawasan'] = array(
            "Bandar", "Pinggir Bandar", "Luar Bandar"
        );
        //7. SENARAI KLUSTER
        $data['senaraiKluster'] = $this->kluster_isu_model->senaraiKlusterCarian();
        if ($this->form_validation->run() !== FALSE) {
            // Process the form data
            $this->session->set_flashdata('success', 'Carian berjaya dilakukan!');
            $tahun = date("Y");
            $senaraiKluster = $this->kluster_isu_model->senarai();
            $senaraiPelapor = $this->pengguna_model->senarai();
            $senaraiTable = array();
            foreach($senaraiPelapor as $pelapor){
                foreach($senaraiKluster as $kluster){
                    $senaraiTable = array_merge($senaraiTable, $this->kluster_isu_model->senaraiTable($tahun, $pelapor->bil, $kluster->kit_shortform));
                }
            }
            $data['hasilCarian'] = array();
            foreach($senaraiTable as $table){
                $data['hasilCarian'] = array_merge($data['hasilCarian'], $this->kluster_isu_model->senaraiCarianTerperinci($table));
            }
        }
        $data['content'] = [
            "lapis/carian/carianTerperinci",
            "lapis/carian/carianTerperinciHasil"
        ];
        $this->load->view("lapis/templates", $data);
    }

    public function muatTurun(){
        $negeriBil = $this->input->post('inputNegeri');
        if(empty($negeriBil)){
            redirect(base_url());
        }
        $klusterBil = $this->input->post('inputKluster');
        if(empty($klusterBil)){
            redirect(base_url());
        }
        $tahun = $this->input->post('inputTahun');
        if(empty($tahun)){
            redirect(base_url());
        }
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('negeri_model');
        $this->load->model('kluster_isu_model');
        $this->load->model('pengguna_model');
        $this->load->model('isu_alamsekitar_model');
        $this->load->model('isu_ekonomi_model');
        $this->load->model('isu_infrastruktur_model');
        $this->load->model('isu_keselamatan_model');
        $this->load->model('isu_politik_model');
        $this->load->model('isu_sosial_model');
        $this->load->model('isu_telekomunikasi_model');
        $this->load->model('isu_keselamatan_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['negeri'] = $this->negeri_model->negeri($negeriBil);
        $data['kluster'] = $this->kluster_isu_model->kluster($klusterBil);
        $data['tahun'] = $tahun;

        $data['senaraiPelapor'] = $this->pengguna_model->senarai();
        $senaraiLaporan = array();
        foreach($data['senaraiPelapor'] as $pelapor){
            $tempLaporan = $this->kluster_isu_model->hasilCarianUrusetiaKluster($negeriBil, $data['kluster']->kit_shortform, $pelapor->bil, $tahun);
            if(!empty($tempLaporan)){
                $senaraiLaporan = array_merge($senaraiLaporan, $tempLaporan);
            }
        }
        $data['senaraiLaporan'] = $senaraiLaporan;

        $this->load->view('urusetia_na/lapis/hasilCarian', $data);
    }

    public function tahunA(){
        $this->load->view('loadArkib');
    }

    public function arkibYear($tahun){
        if(empty($tahun)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $models = [
            'negeri_model',
            'lapis_arkib_model',
            'pengguna_model',
            'peranan_model'
        ];
        $this->load->model($models);
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        switch($sesi){
            case 'NEGERI' :
                $data['senaraiNegeri'] = $this->peranan_model->tugasNegeriPeranan($data['pengguna']->pengguna_peranan_bil);
                $senaraiPelapor = $this->lapis_arkib_model->senaraiPelapor();
                $senaraiKluster = $this->lapis_arkib_model->senaraiKluster();
                foreach($senaraiPelapor as $pelapor){

                }
                //$data['senaraiLaporan'] = $this->lapis_arkib_model->tahun($tahun, $data['senaraiNegeri']);
                $this->load->view('negeri_na/lapis/arkib/senaraiLaporan', $data);
                break;
            case "URUSETIA" : 
                $data['senaraiNegeri'] = $this->negeri_model->senarai();
                $senaraiPelapor = $this->lapis_arkib_model->senaraiPelapor();
                $senaraiKluster = $this->lapis_arkib_model->senaraiKluster();
                foreach($senaraiPelapor as $pelapor){

                }
                //$data['senaraiLaporan'] = $this->lapis_arkib_model->tahun($tahun, $data['senaraiNegeri']);
                //$this->load->view('urusetia_na/lapis/arkib/senaraiLaporan', $data);
                $this->load->view('negeri_na/lapis/arkib/senaraiLaporan', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function listArkib(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        switch($sesi){
            case 'NEGERI' :
                $this->load->view('negeri_na/lapis/arkib/senaraiArkib', $data);
                break;
            case 'URUSETIA' :
                //$this->load->view('urusetia_na/lapis/arkib/senaraiArkib', $data);
                $this->load->view('negeri_na/lapis/arkib/senaraiArkib', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function borangIsu($klusterBil){

        //CHECK VALUES
        if(empty($klusterBil)){
            redirect(base_url());
        }
        
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $perananBil = $this->session->userdata('peranan_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');
        $this->load->model('kluster_isu_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['kluster_isu'] = $this->kluster_isu_model->papar($klusterBil);

        //CHECK EXISTS IN KLUSTER INFO
        if(empty($data['kluster_isu'])){
            redirect(base_url());
        }

        //CHECK IF PPD
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }

        //ACCORDINGLY
        switch($sesi){
            case 'URUSETIA' : 

                //LOAD MODEL
                $this->load->model('daerah_model');
                $this->load->model('parlimen_model');
                $this->load->model('dun_model');

                //LOAD DATA
                $data['senarai_anggota'] = $this->pengguna_model->senarai();
                $data['senaraiDaerah'] = $this->daerah_model->senarai();
                $data['senaraiParlimen'] = $this->parlimen_model->senarai();
                $data['senaraiDun'] = $this->dun_model->senarai();

                //LOAD VIEW
                //$this->load->view('urusetia_na/lapis/borangUmum', $data);
                $this->load->view('ppd_na/lapis/borangUmum', $data);

                break;
            case 'PPD' : 

                //LOAD MODEL
                $this->load->model('daerah_model');
                $this->load->model('parlimen_model');
                $this->load->model('dun_model');

                //LOAD DATA
                $data['senarai_anggota'] = $this->pengguna_model->senarai_pelapor($perananBil);
                $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($perananBil);
                $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($perananBil);
                $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($perananBil);

                //LOAD VIEW
                $this->load->view('ppd_na/lapis/borangUmum', $data);

                break;
            default : 
                redirect(base_url());
        }

    }

    public function carianStatusPenghantaran(){
        
        //CHECK VALUES
        $pelaporBil = $this->input->post('inputPelapor');
        $tarikhMula = $this->input->post('inputTarikhMula');
        $tarikhTamat = $this->input->post('inputTarikhTamat');
        $klusterBil = $this->input->post('inputKlusterBil');

        if(empty($pelaporBil)){
            redirect(base_url());
        }
        if(empty($tarikhMula)){
            redirect(base_url());
        }
        if(empty($tarikhTamat)){
            redirect(base_url());
        }
        if(empty($klusterBil)){
            redirect(base_url());
        }

        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //SEANDAINYA TAHUN YANG BERBEZA
        $tahunMula = date_format(date_create($tarikhMula), 'Y');
        $tahunTamat = date_format(date_create($tarikhTamat), 'Y');
        if($tahunMula != $tahunTamat){
            $tarikhMula = $tahunTamat.'-01-01';
        }

        //LOAD MODEL
        $this->load->model('pengguna_model');
        $this->load->model('kluster_isu_model');
        
        //LOAD DATA GLOBAL
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['senarai_kluster'] = $this->kluster_isu_model->senarai_penuh();

        //CHECK NEGERI
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }

        //KETETAPAN CARIAN
        

        $data['bilKluster'] = $klusterBil;
        $data['namaKluster'] = '';
        $data['senaraiKlusterCarian'] = '';
        if($klusterBil == 'Semua'){
            $data['namaKluster'] = $klusterBil;
            $data['senaraiKlusterCarian'] = $data['senarai_kluster'];
        }else{
            $tmpKluster = $this->kluster_isu_model->papar($klusterBil);
            $data['namaKluster'] = $tmpKluster->kit_nama;
            $data['senaraiKlusterCarian'] = array($tmpKluster);
        }

        $data['tarikhMula'] = '';
        $data['tarikhMula'] = date_format(date_create($tarikhMula), 'Y-m-d');

        $data['tarikhTamat'] = '';
        $data['tarikhTamat'] = date_format(date_create($tarikhTamat), 'Y-m-d');

        $data['dataLaporan'] = $this->kluster_isu_model;

        //ACCORDINGLY
        switch($sesi){
            case 'NEGERI'   :
                //LOAD DATA NEGERI
                $this->load->model('winnable_candidate_assign_model');
                $negeri = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
                $senarai_negeri = $this->pengguna_model->ikut_negeri($negeri);
                $senarai_penuh = array();
                foreach($senarai_negeri as $sn){
                    $pelapor = $this->pengguna_model->maklumat_pengguna($sn['bil']);
                    $senarai_penuh = array_merge($senarai_penuh, $pelapor);
                }
                $data['senarai_pelapor'] = $senarai_penuh;

                //KETETAPAN CARIAN
                $data['bilPelapor'] = $pelaporBil;
                $data['namaPelapor'] = '';
                $data['senaraiPelaporCarian'] = '';
                if($pelaporBil == 'Semua'){
                    $data['namaPelapor'] = $pelaporBil;
                    $data['senaraiPelaporCarian'] = $data['senarai_pelapor'];
                }else{
                    $tmpPengguna = $this->pengguna_model->pengguna($pelaporBil);
                    $data['namaPelapor'] = $tmpPengguna->nama_penuh;
                    $data['senaraiPelaporCarian'] = array($tmpPengguna);
                }

                //LOAD VIEW
                $this->load->view('negeri_na/lapis/carianStatusPenghantaran', $data);

                break;
            default:
                redirect(base_url());
        }

    }

    public function carian()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        switch($sesi){
            case 'LAPIS' :
                $this->load->model('kluster_isu_model');
                $this->load->model('daerah_model');
                $this->load->model('negeri_model');
                $this->load->model('parlimen_model');
                $this->load->model('dun_model');
				$data['senarai_kluster'] = $this->kluster_isu_model->senarai_penuh();
                $data['senarai_negeri'] = $this->negeri_model->senarai();
                $data['senaraiParlimen'] = $this->parlimen_model->senarai();
                $data['senaraiDun'] = $this->dun_model->senarai();
                $data['senaraiDaerah'] = $this->daerah_model->senarai();
                $klusterBil = $this->input->post('inputKluster');
                $tempKluster = $this->kluster_isu_model->papar($klusterBil);
                $negeriBil = $this->input->post('inputNegeriBil');
                $namaNegeri = 'Semua Negeri';
                if(!empty($negeriBil)){
                    $tempNegeri = $this->negeri_model->negeri($negeriBil);
                    $namaNegeri = $tempNegeri->nt_nama;
                }
                $rumusanCarian = array(
                    'namaKluster' => $tempKluster->kit_nama,
                    'negeri' => $namaNegeri,
                    'daerah' => $this->input->post('inputDaerah'),
                    'parlimen' => $this->input->post('inputParlimen'),
                    'dun' => $this->input->post('inputDun'),
                    'tarikhMula' => $this->input->post('inputTarikhMula'),
                    'tarikhTamat' => $this->input->post('inputTarikhTamat')
                );
                $data['rumusanCarian'] = $rumusanCarian;
                $data['senaraiLaporan'] = $this->kluster_isu_model->carianLaporan();
                $data['dataDaerah'] = $this->daerah_model;
                $data['dataPengguna'] = $this->pengguna_model;
                $data['kluster'] = $tempKluster;
                switch($tempKluster->kit_shortform){
                    case 'politik' :
                        $this->load->model('isu_politik_model');
                        $data['data_isu'] = $this->isu_politik_model;
                        break;
                    case 'ekonomi' :
                        $this->load->model('isu_ekonomi_model');
                        $data['data_isu'] = $this->isu_ekonomi_model;
                        break;
                    case 'alamsekitar' :
                        $this->load->model('isu_alamsekitar_model');
                        $data['data_isu'] = $this->isu_alamsekitar_model;
                        break;
                    case 'kesihatan' :
                        $this->load->model('isu_kesihatan_model');
                        $data['data_isu'] = $this->isu_kesihatan_model;
                        break;
                    case 'keselamatan' :
                        $this->load->model('isu_keselamatan_model');
                        $data['data_isu'] = $this->isu_keselamatan_model;
                        break;
                    case 'sosial' :
                        $this->load->model('isu_sosial_model');
                        $data['data_isu'] = $this->isu_sosial_model;
                        break;
                    case 'infrastruktur' :
                        $this->load->model('isu_infrastruktur_model');
                        $data['data_isu'] = $this->isu_infrastruktur_model;
                        break;
                    case 'telekomunikasi' :
                        $this->load->model('isu_telekomunikasi_model');
                        $data['data_isu'] = $this->isu_telekomunikasi_model;
                        break;
                    default : 
                        $data['data_isu'] = '';
                }
                $this->load->view('us_lapis_na/lapis/hasilCarian', $data);
                break;
                case 'PPD' :
                    $klusterBil = $this->input->post('inputKluster');
                    if(empty($klusterBil)){
                        redirect(base_url());
                    }
                    $tahun = $this->input->post('inputTahun');
                    if(empty($tahun)){
                        redirect(base_url());
                    }
                    $this->load->model('daerah_model');
                    $this->load->model('parlimen_model');
                    $this->load->model('dun_model');
                    $this->load->model('kluster_isu_model');
                    $senaraiDaerah = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
                    $senaraiParlimen = $this->parlimen_model->senaraiTugasanParlimen($data['pengguna']->pengguna_peranan_bil);
                    $senaraiDun = $this->dun_model->senaraiTugasanDun($data['pengguna']->pengguna_peranan_bil);
                    $data['kluster'] = $this->kluster_isu_model->kluster($klusterBil);
                    $data['tahun'] = $tahun;
                    $data['senarai_kluster'] = $this->kluster_isu_model->senarai();
                    $senaraiPelapor = $this->pengguna_model->anggota($data['pengguna']->pengguna_peranan_bil);
                    $senaraiLaporan = array();
                    foreach($senaraiPelapor as $pelapor){
                        $tempLaporan = $this->kluster_isu_model->hasilCarianPpd($pelapor->bil, $data['kluster']->kit_shortform, $senaraiDaerah, $senaraiParlimen, $senaraiDun, $tahun);
                        if(!empty($tempLaporan)){
                            $senaraiLaporan = array_merge($senaraiLaporan, $tempLaporan);
                        }
                    }
                    $data['senaraiLaporan'] = $senaraiLaporan;
                    $this->load->view('ppd_na/lapis/hasilCarian', $data);
                    break;
            default :
                redirect(base_url());
        }
    }

    public function terima($kluster_bil)
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        switch($sesi){
            case 'LAPIS' :
        $this->load->model('kluster_isu_model');
        $this->load->model('daerah_model');
        $data['dataDaerah'] = $this->daerah_model;
        $data['data_isu'] = $this->kluster_isu_model;
        $data['data_pengguna'] = $this->pengguna_model;
        $data['kluster'] = $this->kluster_isu_model->papar($kluster_bil);

        $k = $this->kluster_isu_model->papar($kluster_bil);
        $sf = $k->kit_shortform;

        $senarai_laporan = array();
        if($sf == 'politik'){
            $this->load->model('isu_politik_model');
            $this->load->model('pengguna_model');
            $senarai_pelapor = $this->pengguna_model->senarai_penuh_pelapor();
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_politik_model->senarai_laporan($pelapor->bil, date('Y'));
                if(!empty($laporan)){
                    $senarai_laporan = array_merge($senarai_laporan, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan;
        }

        $senarai_laporan_ekonomi = array();
        if($sf == 'ekonomi'){
            $this->load->model('isu_ekonomi_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_ekonomi_model;
            $senarai_pelapor = $this->pengguna_model->senarai_penuh_pelapor();
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_ekonomi_model->senarai_laporan($pelapor->bil, date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_ekonomi = array_merge($senarai_laporan_ekonomi, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_ekonomi;
        }

        $senarai_laporan_alamsekitar = array();
        if($sf == 'alamsekitar'){
            $this->load->model('isu_alamsekitar_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_alamsekitar_model;
            $senarai_pelapor = $this->pengguna_model->senarai_penuh_pelapor();
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_alamsekitar_model->senarai_laporan($pelapor->bil, date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_alamsekitar = array_merge($senarai_laporan_alamsekitar, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_alamsekitar;
        }

        $senarai_laporan_kesihatan = array();
        if($sf == 'kesihatan'){
            $this->load->model('isu_kesihatan_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_kesihatan_model;
            $senarai_pelapor = $this->pengguna_model->senarai_penuh_pelapor();
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_kesihatan_model->senarai_laporan($pelapor->bil, date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_kesihatan = array_merge($senarai_laporan_kesihatan, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_kesihatan;
        }

        $senarai_laporan_keselamatan = array();
        if($sf == 'keselamatan'){
            $this->load->model('isu_keselamatan_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_keselamatan_model;
            $senarai_pelapor = $this->pengguna_model->senarai_penuh_pelapor();
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_keselamatan_model->senarai_laporan($pelapor->bil, date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_keselamatan = array_merge($senarai_laporan_keselamatan, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_keselamatan;
        }

        $senarai_laporan_sosial = array();
        if($sf == 'sosial'){
            $this->load->model('isu_sosial_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_sosial_model;
            $senarai_pelapor = $this->pengguna_model->senarai_penuh_pelapor();
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_sosial_model->senarai_laporan($pelapor->bil, date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_sosial = array_merge($senarai_laporan_sosial, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_sosial;
        }

        $senarai_laporan_infrastruktur = array();
        if($sf == 'infrastruktur'){
            $this->load->model('isu_infrastruktur_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_infrastruktur_model;
            $senarai_pelapor = $this->pengguna_model->senarai_penuh_pelapor();
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_infrastruktur_model->senarai_laporan($pelapor->bil, date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_infrastruktur = array_merge($senarai_laporan_infrastruktur, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_infrastruktur;
        }

        $senarai_laporan_telekomunikasi = array();
        if($sf == 'telekomunikasi'){
            $this->load->model('isu_telekomunikasi_model');
            $data['data_isu'] = $this->isu_telekomunikasi_model;
            $senarai_pelapor = $this->pengguna_model->senarai_penuh_pelapor();
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->kluster_isu_model->senaraiLaporan($sf, $pelapor->bil, date("Y"), 'Terima');
                if(!empty($laporan)){
                    $senarai_laporan_telekomunikasi = array_merge($senarai_laporan_telekomunikasi, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_telekomunikasi;
        }

        $this->load->model('negeri_model');
        $data['senarai_negeri'] = $this->negeri_model->senarai();
        $this->load->view('us_lapis_na/lapis/senaraiTerima', $data);

                break;
            default :
                redirect(base_url());
        }
    }

public function laporanTidakTerima(){
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    if(strpos($sesi, 'NEGERI') !== FALSE){
        $sesi = 'NEGERI';
    }
    $input_kluster_bil = $this->input->post('input_kluster_bil');
    $input_kluster_shortform = $this->input->post('input_kluster_shortform');
    $input_tahun_laporan = $this->input->post('input_tarikh_laporan');
    $tahun = date_format(date_create($input_tahun_laporan), 'Y');
    $input_pelapor_bil = $this->input->post('input_pelapor_bil');
    $input_laporan_bil = $this->input->post('input_laporan_bil');
    $this->load->model('pengguna_model');
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    $data['klusterBil'] = $input_kluster_bil;
    switch($sesi){
        case 'NEGERI' : 
            if($input_kluster_shortform == 'telekomunikasi'){
                $this->load->model('isu_telekomunikasi_model');
                $this->load->model('kluster_isu_model');
                $isu = $this->isu_telekomunikasi_model->papar($input_laporan_bil, $input_pelapor_bil, $tahun);
                $data['kluster'] = $this->kluster_isu_model->papar($input_kluster_bil);
                //Syarat Penghantaran
                //1. Hantar Negeri
                $syarat = TRUE;
                if($isu->tapisan != 'Hantar Negeri'){
                    $syarat = FALSE;
                }
                if($syarat){
                    $this->isu_telekomunikasi_model->hantarPPD($input_kluster_shortform, $input_laporan_bil, $input_pelapor_bil, $tahun);
                    $this->load->view('negeri_na/lapis/laporanTidakTerima', $data);
                }else{
                    redirect('lapis/statusPenghantaran/'.$input_kluster_bil);
                }
            }
            break;
            case 'LAPIS' : 
                if($input_kluster_shortform == 'telekomunikasi'){
                    $this->load->model('isu_telekomunikasi_model');
                    $this->load->model('kluster_isu_model');
                    $isu = $this->isu_telekomunikasi_model->papar($input_laporan_bil, $input_pelapor_bil, $tahun);
                    $data['kluster'] = $this->kluster_isu_model->papar($input_kluster_bil);
                    //Syarat Penghantaran
                    //1. Hantar Negeri
                    $syarat = TRUE;
                    if($isu->tapisan != 'Hantar HQ'){
                        $syarat = FALSE;
                    }
                    if($syarat){
                        $this->isu_telekomunikasi_model->hantarPPD($input_kluster_shortform, $input_laporan_bil, $input_pelapor_bil, $tahun);
                        $this->load->view('us_lapis_na/lapis/laporanTidakTerima', $data);
                    }else{
                        redirect('lapis/statusPenghantaran/'.$input_kluster_bil);
                    }
                }
                break;
        default:
            redirect(base_url());
    }
}

public function prosesDraf(){
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $perananBil = $this->session->userdata('peranan_bil');
    if(empty($sesi)){
        redirect(base_url());
    }
    if(strpos($sesi, 'PPD') !== FALSE){
        $sesi = 'PPD';
    }
    if(strpos($sesi, 'NEGERI') !== FALSE){
        $sesi = 'NEGERI';
    }
    $this->load->model('pengguna_model');
    $this->load->model('kluster_isu_model');
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    $data['senaraiKluster'] = $this->kluster_isu_model->senarai();
    switch($sesi){
        case 'NEGERI' :
            $this->load->model('winnable_candidate_assign_model');
            $data['dataKlusterIsu'] = $this->kluster_isu_model;
            $data['negeri'] = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
            $data['senaraiPelapor'] = $this->pengguna_model->ikut_negeri($data['negeri']);

            $laporan_bil = $this->input->post('input_laporan_bil');
            $pelapor_bil = $this->input->post('input_pelapor_bil');
            $kluster_shortform = $this->input->post('input_kluster_shortform');
            $tahun_laporan = $this->input->post('input_tahun_laporan');

            if(empty($laporan_bil) || empty($pelapor_bil) || empty($kluster_shortform) || empty($tahun_laporan)){
                redirect(base_url());
            }

            $data['kluster_shortform'] = $kluster_shortform;
            $this->load->model('kluster_isu_model');
            $this->load->model('pengguna_model');
            $this->load->model('negeri_model');
            $this->load->model('daerah_model');
            $this->load->model('parlimen_model');
            $this->load->model('dun_model');

            $this->load->model('isu_telekomunikasi_model');
            $data['dataIsuTelekomunikasi'] = $this->isu_telekomunikasi_model;
            $data['data_dun'] = $this->dun_model;
            $data['data_parlimen'] = $this->parlimen_model;
            $data['data_daerah'] = $this->daerah_model;
            $data['data_negeri'] = $this->negeri_model;
            $data['data_pengguna'] = $this->pengguna_model;
            $data['dataKluster'] = $this->kluster_isu_model;
            $data['laporan'] = $this->kluster_isu_model->laporan($kluster_shortform, $pelapor_bil, $tahun_laporan, $laporan_bil);

            $this->load->view('negeri_na/lapis/pengesahanDraf', $data);

            break;

            case 'LAPIS' :
                $data['dataKlusterIsu'] = $this->kluster_isu_model;
                $data['senaraiPelapor'] = $this->pengguna_model->senarai_penuh_pelapor();
    
                $laporan_bil = $this->input->post('input_laporan_bil');
                $pelapor_bil = $this->input->post('input_pelapor_bil');
                $kluster_shortform = $this->input->post('input_kluster_shortform');
                $tahun_laporan = $this->input->post('input_tahun_laporan');
    
                if(empty($laporan_bil) || empty($pelapor_bil) || empty($kluster_shortform) || empty($tahun_laporan)){
                    redirect(base_url());
                }
    
                $data['kluster_shortform'] = $kluster_shortform;
                $this->load->model('kluster_isu_model');
                $this->load->model('pengguna_model');
                $this->load->model('negeri_model');
                $this->load->model('daerah_model');
                $this->load->model('parlimen_model');
                $this->load->model('dun_model');
    
                $this->load->model('isu_telekomunikasi_model');
                $data['dataIsuTelekomunikasi'] = $this->isu_telekomunikasi_model;
                $data['data_dun'] = $this->dun_model;
                $data['data_parlimen'] = $this->parlimen_model;
                $data['data_daerah'] = $this->daerah_model;
                $data['data_negeri'] = $this->negeri_model;
                $data['data_pengguna'] = $this->pengguna_model;
                $data['dataKluster'] = $this->kluster_isu_model;
                $data['laporan'] = $this->kluster_isu_model->laporan($kluster_shortform, $pelapor_bil, $tahun_laporan, $laporan_bil);
    
                $this->load->view('us_lapis_na/lapis/pengesahanDraf', $data);
    
                break;

        default : 
            redirect(base_url());
    }
}

    public function laporanTerima(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $input_kluster_bil = $this->input->post('input_kluster_bil');
        $input_kluster_shortform = $this->input->post('input_kluster_shortform');
        $input_tahun_laporan = $this->input->post('input_tarikh_laporan');
        $tahun = date_format(date_create($input_tahun_laporan), 'Y');
        $input_pelapor_bil = $this->input->post('input_pelapor_bil');
        $input_laporan_bil = $this->input->post('input_laporan_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['klusterBil'] = $input_kluster_bil;
        switch($sesi){
            case 'NEGERI' : 
                if($input_kluster_shortform == 'telekomunikasi'){
                    $this->load->model('isu_telekomunikasi_model');
                    $this->load->model('kluster_isu_model');
                    $isu = $this->isu_telekomunikasi_model->papar($input_laporan_bil, $input_pelapor_bil, $tahun);
                    $data['kluster'] = $this->kluster_isu_model->papar($input_kluster_bil);
                    //Syarat Penghantaran
                    //1. Hantar Negeri
                    $syarat = TRUE;
                    if($isu->tapisan != 'Hantar Negeri'){
                        $syarat = FALSE;
                    }
                    if($syarat){
                        $this->isu_telekomunikasi_model->hantarHq($input_kluster_shortform, $input_laporan_bil, $input_pelapor_bil, $tahun);
                        $this->load->view('negeri_na/lapis/laporanTerima', $data);
                    }else{
                        redirect('lapis/statusPenghantaran/'.$input_kluster_bil);
                    }
                }
                break;
            case 'LAPIS' : 
                    if($input_kluster_shortform == 'telekomunikasi'){
                        $this->load->model('isu_telekomunikasi_model');
                        $this->load->model('kluster_isu_model');
                        $isu = $this->isu_telekomunikasi_model->papar($input_laporan_bil, $input_pelapor_bil, $tahun);
                        $data['kluster'] = $this->kluster_isu_model->papar($input_kluster_bil);
                        //Syarat Penghantaran
                        //1. Hantar Negeri
                        $syarat = TRUE;
                        if($isu->tapisan != 'Hantar HQ'){
                            $syarat = FALSE;
                        }
                        if($syarat){
                            $this->isu_telekomunikasi_model->terima($input_kluster_shortform, $input_laporan_bil, $input_pelapor_bil, $tahun);
                            $this->load->view('us_lapis_na/lapis/laporanTerima', $data);
                        }else{
                            redirect('lapis/statusPenghantaran/'.$input_kluster_bil);
                        }
                    }
                    break;
            default:
                redirect(base_url());
        }
    }

    public function prosesSemakan(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $perananBil = $this->session->userdata('peranan_bil');
        if(empty($sesi)){
            redirect(base_url());
        }
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $this->load->model('kluster_isu_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['senaraiKluster'] = $this->kluster_isu_model->senarai();
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('winnable_candidate_assign_model');
                $data['dataKlusterIsu'] = $this->kluster_isu_model;
                $data['negeri'] = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
                $data['senaraiPelapor'] = $this->pengguna_model->ikut_negeri($data['negeri']);

                $laporan_bil = $this->input->post('input_laporan_bil');
                $pelapor_bil = $this->input->post('input_pelapor_bil');
                $kluster_shortform = $this->input->post('input_kluster_shortform');
                $tahun_laporan = $this->input->post('input_tahun_laporan');

                if(empty($laporan_bil) || empty($pelapor_bil) || empty($kluster_shortform) || empty($tahun_laporan)){
                    redirect(base_url());
                }

                $data['kluster_shortform'] = $kluster_shortform;
                $this->load->model('kluster_isu_model');
                $this->load->model('pengguna_model');
                $this->load->model('negeri_model');
                $this->load->model('daerah_model');
                $this->load->model('parlimen_model');
                $this->load->model('dun_model');

                $this->load->model('isu_telekomunikasi_model');
                $data['dataIsuTelekomunikasi'] = $this->isu_telekomunikasi_model;
                $data['data_dun'] = $this->dun_model;
                $data['data_parlimen'] = $this->parlimen_model;
                $data['data_daerah'] = $this->daerah_model;
                $data['data_negeri'] = $this->negeri_model;
                $data['data_pengguna'] = $this->pengguna_model;
                $data['dataKluster'] = $this->kluster_isu_model;
                $data['laporan'] = $this->kluster_isu_model->laporan($kluster_shortform, $pelapor_bil, $tahun_laporan, $laporan_bil);

                $this->load->view('negeri_na/lapis/pengesahanTerima', $data);

                break;

                case 'LAPIS' :
                    $data['dataKlusterIsu'] = $this->kluster_isu_model;
                    $data['senaraiPelapor'] = $this->pengguna_model->senarai_penuh_pelapor();
    
                    $laporan_bil = $this->input->post('input_laporan_bil');
                    $pelapor_bil = $this->input->post('input_pelapor_bil');
                    $kluster_shortform = $this->input->post('input_kluster_shortform');
                    $tahun_laporan = $this->input->post('input_tahun_laporan');
    
                    if(empty($laporan_bil) || empty($pelapor_bil) || empty($kluster_shortform) || empty($tahun_laporan)){
                        redirect(base_url());
                    }
    
                    $data['kluster_shortform'] = $kluster_shortform;
                    $this->load->model('kluster_isu_model');
                    $this->load->model('pengguna_model');
                    $this->load->model('negeri_model');
                    $this->load->model('daerah_model');
                    $this->load->model('parlimen_model');
                    $this->load->model('dun_model');
    
                    $this->load->model('isu_telekomunikasi_model');
                    $data['dataIsuTelekomunikasi'] = $this->isu_telekomunikasi_model;
                    $data['data_dun'] = $this->dun_model;
                    $data['data_parlimen'] = $this->parlimen_model;
                    $data['data_daerah'] = $this->daerah_model;
                    $data['data_negeri'] = $this->negeri_model;
                    $data['data_pengguna'] = $this->pengguna_model;
                    $data['dataKluster'] = $this->kluster_isu_model;
                    $data['laporan'] = $this->kluster_isu_model->laporan($kluster_shortform, $pelapor_bil, $tahun_laporan, $laporan_bil);
    
                    $this->load->view('us_lapis_na/lapis/pengesahanSemakan', $data);
    
                    break;

            default : 
                redirect(base_url());
        }
    }

    public function prosesTerima(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $perananBil = $this->session->userdata('peranan_bil');
        if(empty($sesi)){
            redirect(base_url());
        }
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $this->load->model('kluster_isu_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['senaraiKluster'] = $this->kluster_isu_model->senarai();
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('winnable_candidate_assign_model');
                $data['dataKlusterIsu'] = $this->kluster_isu_model;
                $data['negeri'] = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
                $data['senaraiPelapor'] = $this->pengguna_model->ikut_negeri($data['negeri']);

                $laporan_bil = $this->input->post('input_laporan_bil');
                $pelapor_bil = $this->input->post('input_pelapor_bil');
                $kluster_shortform = $this->input->post('input_kluster_shortform');
                $tahun_laporan = $this->input->post('input_tahun_laporan');

                if(empty($laporan_bil) || empty($pelapor_bil) || empty($kluster_shortform) || empty($tahun_laporan)){
                    redirect(base_url());
                }

                $data['kluster_shortform'] = $kluster_shortform;
                $this->load->model('kluster_isu_model');
                $this->load->model('pengguna_model');
                $this->load->model('negeri_model');
                $this->load->model('daerah_model');
                $this->load->model('parlimen_model');
                $this->load->model('dun_model');

                $this->load->model('isu_telekomunikasi_model');
                $data['dataIsuTelekomunikasi'] = $this->isu_telekomunikasi_model;
                $data['data_dun'] = $this->dun_model;
                $data['data_parlimen'] = $this->parlimen_model;
                $data['data_daerah'] = $this->daerah_model;
                $data['data_negeri'] = $this->negeri_model;
                $data['data_pengguna'] = $this->pengguna_model;
                $data['dataKluster'] = $this->kluster_isu_model;
                $data['laporan'] = $this->kluster_isu_model->laporan($kluster_shortform, $pelapor_bil, $tahun_laporan, $laporan_bil);

                $this->load->view('negeri_na/lapis/pengesahanTerima', $data);

                break;

                case 'LAPIS' :
                    $data['dataKlusterIsu'] = $this->kluster_isu_model;
                    $data['senaraiPelapor'] = $this->pengguna_model->senarai_penuh_pelapor();
    
                    $laporan_bil = $this->input->post('input_laporan_bil');
                    $pelapor_bil = $this->input->post('input_pelapor_bil');
                    $kluster_shortform = $this->input->post('input_kluster_shortform');
                    $tahun_laporan = $this->input->post('input_tahun_laporan');
    
                    if(empty($laporan_bil) || empty($pelapor_bil) || empty($kluster_shortform) || empty($tahun_laporan)){
                        redirect(base_url());
                    }
    
                    $data['kluster_shortform'] = $kluster_shortform;
                    $this->load->model('kluster_isu_model');
                    $this->load->model('pengguna_model');
                    $this->load->model('negeri_model');
                    $this->load->model('daerah_model');
                    $this->load->model('parlimen_model');
                    $this->load->model('dun_model');
    
                    $this->load->model('isu_telekomunikasi_model');
                    $data['dataIsuTelekomunikasi'] = $this->isu_telekomunikasi_model;
                    $data['data_dun'] = $this->dun_model;
                    $data['data_parlimen'] = $this->parlimen_model;
                    $data['data_daerah'] = $this->daerah_model;
                    $data['data_negeri'] = $this->negeri_model;
                    $data['data_pengguna'] = $this->pengguna_model;
                    $data['dataKluster'] = $this->kluster_isu_model;
                    $data['laporan'] = $this->kluster_isu_model->laporan($kluster_shortform, $pelapor_bil, $tahun_laporan, $laporan_bil);
    
                    $this->load->view('us_lapis_na/lapis/pengesahanTerima', $data);
    
                    break;

            default : 
                redirect(base_url());
        }
    }
    

    public function senaraiHantarNegeri($klusterBil){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $perananBil = $this->session->userdata('peranan_bil');
        if(empty($sesi)){
            redirect(base_url());
        }
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $this->load->model('kluster_isu_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['senaraiKluster'] = $this->kluster_isu_model->senarai();
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('kluster_isu_model');
        $this->load->model('pengguna_model');
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('daerah_model');
        $data['dataDaerah'] = $this->daerah_model;
        $data['data_isu'] = $this->kluster_isu_model;
        $data['data_pengguna'] = $this->pengguna_model;
        $data['kluster'] = $this->kluster_isu_model->papar($klusterBil);

        $k = $this->kluster_isu_model->papar($klusterBil);
        $sf = $k->kit_shortform;
        $data['negeri'] = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
        $data['senaraiPelapor'] = $this->pengguna_model->ikut_negeri($data['negeri']);
        $senarai_pelapor = $data['senaraiPelapor'];

        $senarai_laporan = array();
        if($sf == 'politik'){
            $this->load->model('isu_politik_model');
            $this->load->model('pengguna_model');
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->kluster_isu_model->senaraiLaporan($sf, $pelapor['bil'], date('Y'), 'Hantar Negeri');
                if(!empty($laporan)){
                    $senarai_laporan = array_merge($senarai_laporan, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan;
        }

        $senarai_laporan_ekonomi = array();
        if($sf == 'ekonomi'){
            $this->load->model('isu_ekonomi_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_ekonomi_model;
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->kluster_isu_model->senaraiLaporan($sf, $pelapor['bil'], date('Y'), 'Hantar Negeri');
                if(!empty($laporan)){
                    $senarai_laporan_ekonomi = array_merge($senarai_laporan_ekonomi, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_ekonomi;
        }

        $senarai_laporan_alamsekitar = array();
        if($sf == 'alamsekitar'){
            $this->load->model('isu_alamsekitar_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_alamsekitar_model;
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->kluster_isu_model->senaraiLaporan($sf, $pelapor['bil'], date('Y'), 'Hantar Negeri');
                if(!empty($laporan)){
                    $senarai_laporan_alamsekitar = array_merge($senarai_laporan_alamsekitar, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_alamsekitar;
        }

        $senarai_laporan_kesihatan = array();
        if($sf == 'kesihatan'){
            $this->load->model('isu_kesihatan_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_kesihatan_model;
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->kluster_isu_model->senaraiLaporan($sf, $pelapor['bil'], date('Y'), 'Hantar Negeri');
                if(!empty($laporan)){
                    $senarai_laporan_kesihatan = array_merge($senarai_laporan_kesihatan, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_kesihatan;
        }

        $senarai_laporan_keselamatan = array();
        if($sf == 'keselamatan'){
            $this->load->model('isu_keselamatan_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_keselamatan_model;
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->kluster_isu_model->senaraiLaporan($sf, $pelapor['bil'], date('Y'), 'Hantar Negeri');
                if(!empty($laporan)){
                    $senarai_laporan_keselamatan = array_merge($senarai_laporan_keselamatan, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_keselamatan;
        }

        $senarai_laporan_sosial = array();
        if($sf == 'sosial'){
            $this->load->model('isu_sosial_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_sosial_model;
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->kluster_isu_model->senaraiLaporan($sf, $pelapor['bil'], date('Y'), 'Hantar Negeri');
                if(!empty($laporan)){
                    $senarai_laporan_sosial = array_merge($senarai_laporan_sosial, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_sosial;
        }

        $senarai_laporan_infrastruktur = array();
        if($sf == 'infrastruktur'){
            $this->load->model('isu_infrastruktur_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_infrastruktur_model;
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->kluster_isu_model->senaraiLaporan($sf, $pelapor['bil'], date('Y'), 'Hantar Negeri');
                if(!empty($laporan)){
                    $senarai_laporan_infrastruktur = array_merge($senarai_laporan_infrastruktur, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_infrastruktur;
        }

        $senarai_laporan_telekomunikasi = array();
        if($sf == 'telekomunikasi'){
            $this->load->model('isu_telekomunikasi_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_telekomunikasi_model;
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->kluster_isu_model->senaraiLaporan($sf, $pelapor['bil'], date('Y'), 'Hantar Negeri');
                if(!empty($laporan)){
                    $senarai_laporan_telekomunikasi = array_merge($senarai_laporan_telekomunikasi, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_telekomunikasi;
        }

        $this->load->model('negeri_model');
        $data['senarai_negeri'] = $this->negeri_model->senarai();
        $this->load->view('negeri_na/lapis/hantarNegeri', $data);
                break;
                

                case 'LAPIS' :
                    $this->load->model('kluster_isu_model');
            $this->load->model('pengguna_model');
            $this->load->model('winnable_candidate_assign_model');
            $this->load->model('daerah_model');
            $data['dataDaerah'] = $this->daerah_model;
            $data['data_isu'] = $this->kluster_isu_model;
            $data['data_pengguna'] = $this->pengguna_model;
            $data['kluster'] = $this->kluster_isu_model->papar($klusterBil);
    
            $k = $this->kluster_isu_model->papar($klusterBil);
            $sf = $k->kit_shortform;
            $data['senaraiPelapor'] = $this->pengguna_model->senarai_penuh_pelapor();
            $senarai_pelapor = $data['senaraiPelapor'];
    
            $senarai_laporan = array();
            if($sf == 'politik'){
                $this->load->model('isu_politik_model');
                $this->load->model('pengguna_model');
                foreach($senarai_pelapor as $pelapor){
                    $laporan = $this->kluster_isu_model->senaraiLaporan($sf, $pelapor->bil, date('Y'), 'Hantar HQ');
                    if(!empty($laporan)){
                        $senarai_laporan = array_merge($senarai_laporan, $laporan);
                    }
                }
                $data['senarai_laporan'] = $senarai_laporan;
            }
    
            $senarai_laporan_ekonomi = array();
            if($sf == 'ekonomi'){
                $this->load->model('isu_ekonomi_model');
                $this->load->model('pengguna_model');
                $data['data_isu'] = $this->isu_ekonomi_model;
                foreach($senarai_pelapor as $pelapor){
                    $laporan = $this->kluster_isu_model->senaraiLaporan($sf, $pelapor->bil, date('Y'), 'Hantar HQ');
                    if(!empty($laporan)){
                        $senarai_laporan_ekonomi = array_merge($senarai_laporan_ekonomi, $laporan);
                    }
                }
                $data['senarai_laporan'] = $senarai_laporan_ekonomi;
            }
    
            $senarai_laporan_alamsekitar = array();
            if($sf == 'alamsekitar'){
                $this->load->model('isu_alamsekitar_model');
                $this->load->model('pengguna_model');
                $data['data_isu'] = $this->isu_alamsekitar_model;
                foreach($senarai_pelapor as $pelapor){
                    $laporan = $this->kluster_isu_model->senaraiLaporan($sf, $pelapor->bil, date('Y'), 'Hantar HQ');
                    if(!empty($laporan)){
                        $senarai_laporan_alamsekitar = array_merge($senarai_laporan_alamsekitar, $laporan);
                    }
                }
                $data['senarai_laporan'] = $senarai_laporan_alamsekitar;
            }
    
            $senarai_laporan_kesihatan = array();
            if($sf == 'kesihatan'){
                $this->load->model('isu_kesihatan_model');
                $this->load->model('pengguna_model');
                $data['data_isu'] = $this->isu_kesihatan_model;
                foreach($senarai_pelapor as $pelapor){
                    $laporan = $this->kluster_isu_model->senaraiLaporan($sf, $pelapor->bil, date('Y'), 'Hantar HQ');
                    if(!empty($laporan)){
                        $senarai_laporan_kesihatan = array_merge($senarai_laporan_kesihatan, $laporan);
                    }
                }
                $data['senarai_laporan'] = $senarai_laporan_kesihatan;
            }
    
            $senarai_laporan_keselamatan = array();
            if($sf == 'keselamatan'){
                $this->load->model('isu_keselamatan_model');
                $this->load->model('pengguna_model');
                $data['data_isu'] = $this->isu_keselamatan_model;
                foreach($senarai_pelapor as $pelapor){
                    $laporan = $this->kluster_isu_model->senaraiLaporan($sf, $pelapor->bil, date('Y'), 'Hantar HQ');
                    if(!empty($laporan)){
                        $senarai_laporan_keselamatan = array_merge($senarai_laporan_keselamatan, $laporan);
                    }
                }
                $data['senarai_laporan'] = $senarai_laporan_keselamatan;
            }
    
            $senarai_laporan_sosial = array();
            if($sf == 'sosial'){
                $this->load->model('isu_sosial_model');
                $this->load->model('pengguna_model');
                $data['data_isu'] = $this->isu_sosial_model;
                foreach($senarai_pelapor as $pelapor){
                    $laporan = $this->kluster_isu_model->senaraiLaporan($sf, $pelapor->bil, date('Y'), 'Hantar HQ');
                    if(!empty($laporan)){
                        $senarai_laporan_sosial = array_merge($senarai_laporan_sosial, $laporan);
                    }
                }
                $data['senarai_laporan'] = $senarai_laporan_sosial;
            }
    
            $senarai_laporan_infrastruktur = array();
            if($sf == 'infrastruktur'){
                $this->load->model('isu_infrastruktur_model');
                $this->load->model('pengguna_model');
                $data['data_isu'] = $this->isu_infrastruktur_model;
                foreach($senarai_pelapor as $pelapor){
                    $laporan = $this->kluster_isu_model->senaraiLaporan($sf, $pelapor->bil, date('Y'), 'Hantar HQ');
                    if(!empty($laporan)){
                        $senarai_laporan_infrastruktur = array_merge($senarai_laporan_infrastruktur, $laporan);
                    }
                }
                $data['senarai_laporan'] = $senarai_laporan_infrastruktur;
            }
    
            $senarai_laporan_telekomunikasi = array();
            if($sf == 'telekomunikasi'){
                $this->load->model('isu_telekomunikasi_model');
                $this->load->model('pengguna_model');
                $data['data_isu'] = $this->isu_telekomunikasi_model;
                foreach($senarai_pelapor as $pelapor){
                    $laporan = $this->kluster_isu_model->senaraiLaporan($sf, $pelapor->bil, date('Y'), 'Hantar HQ');
                    if(!empty($laporan)){
                        $senarai_laporan_telekomunikasi = array_merge($senarai_laporan_telekomunikasi, $laporan);
                    }
                }
                $data['senarai_laporan'] = $senarai_laporan_telekomunikasi;
            }
    
            $this->load->model('negeri_model');
            $data['senarai_negeri'] = $this->negeri_model->senarai();
            $this->load->view('us_lapis_na/lapis/hantarNegeri', $data);
                    break;
                    


            default : 
                redirect(base_url());
        }
    }

    public function statusPenghantaran(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $perananBil = $this->session->userdata('peranan_bil');
        if(empty($sesi)){
            redirect(base_url());
        }
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $this->load->model('kluster_isu_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['senaraiKluster'] = $this->kluster_isu_model->senarai();
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('winnable_candidate_assign_model');
                $data['dataKlusterIsu'] = $this->kluster_isu_model;
                $data['negeri'] = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
                $data['senaraiPelapor'] = $this->pengguna_model->ikut_negeri($data['negeri']);
                $this->load->view('negeri_na/lapis/statusPenghantaran', $data);
                break;
            default : 
                redirect(base_url());
        }
    }

    public function proses_hantar(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        $input_kluster_bil = $this->input->post('input_kluster_bil');
        $input_kluster_shortform = $this->input->post('input_kluster_shortform');
        $input_tahun_laporan = $this->input->post('input_tarikh_laporan');
        $tahun = date_format(date_create($input_tahun_laporan), 'Y');
        $input_pelapor_bil = $this->input->post('input_pelapor_bil');
        $input_laporan_bil = $this->input->post('input_laporan_bil');
        switch($sesi){
            case 'PPD' : 
                if($input_kluster_shortform == 'telekomunikasi'){
                    $this->load->model('isu_telekomunikasi_model');
                    $this->load->model('kluster_isu_model');
                    $isu = $this->isu_telekomunikasi_model->papar($input_laporan_bil, $input_pelapor_bil, $tahun);
                    $data['kluster'] = $this->kluster_isu_model->papar($input_kluster_bil);
                    //Syarat Penghantaran
                    //1. Draf
                    $syarat = TRUE;
                    if($isu->tapisan != 'Draf'){
                        $syarat = FALSE;
                    }
                    //2. Kalau isu rangkaian internet / data dan tiada screenshot
                    $isuRangkaian = $this->isu_telekomunikasi_model->isuRangkaian($input_laporan_bil, $input_pelapor_bil, $tahun);
                    if($isu->isu_telekomunikasi == 'Rangkaian Internet / Data' && empty($isuRangkaian)){
                        $syarat = FALSE;
                    }
                    if($syarat){
                        $this->isu_telekomunikasi_model->hantarNegeri($input_kluster_shortform, $input_laporan_bil, $input_pelapor_bil, $tahun);
                        $this->load->view('susunletak/atas', $data);
                        $this->load->view('lapis/nav');
                        $this->load->view('lapis/hantar_negeri');
                        $this->load->view('susunletak/bawah');
                    }else{
                        redirect('lapis/penuh/'.$input_kluster_shortform);
                    }
                }
                break;
            default:
                redirect(base_url());
        }
    }

    public function kluster($klusterBil)
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(empty($sesi))
        {
            redirect(base_url());
        }
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        switch($sesi){
            case 'NEGERI' :
                $this->load->model('kluster_isu_model');
        $this->load->model('pengguna_model');
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('daerah_model');
        $data['dataDaerah'] = $this->daerah_model;
        $data['data_isu'] = $this->kluster_isu_model;
        $data['data_pengguna'] = $this->pengguna_model;
        $data['kluster'] = $this->kluster_isu_model->papar($klusterBil);

        $k = $this->kluster_isu_model->papar($klusterBil);
        $sf = $k->kit_shortform;
        $data['negeri'] = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
        $data['senaraiPelapor'] = $this->pengguna_model->ikut_negeri($data['negeri']);
        $senarai_pelapor = $data['senaraiPelapor'];

        $senarai_laporan = array();
        if($sf == 'politik'){
            $this->load->model('isu_politik_model');
            $this->load->model('pengguna_model');
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_politik_model->senarai_laporan($pelapor['bil'], date('Y'));
                if(!empty($laporan)){
                    $senarai_laporan = array_merge($senarai_laporan, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan;
        }

        $senarai_laporan_ekonomi = array();
        if($sf == 'ekonomi'){
            $this->load->model('isu_ekonomi_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_ekonomi_model;
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_ekonomi_model->senarai_laporan($pelapor['bil'], date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_ekonomi = array_merge($senarai_laporan_ekonomi, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_ekonomi;
        }

        $senarai_laporan_alamsekitar = array();
        if($sf == 'alamsekitar'){
            $this->load->model('isu_alamsekitar_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_alamsekitar_model;
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_alamsekitar_model->senarai_laporan($pelapor['bil'], date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_alamsekitar = array_merge($senarai_laporan_alamsekitar, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_alamsekitar;
        }

        $senarai_laporan_kesihatan = array();
        if($sf == 'kesihatan'){
            $this->load->model('isu_kesihatan_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_kesihatan_model;
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_kesihatan_model->senarai_laporan($pelapor['bil'], date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_kesihatan = array_merge($senarai_laporan_kesihatan, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_kesihatan;
        }

        $senarai_laporan_keselamatan = array();
        if($sf == 'keselamatan'){
            $this->load->model('isu_keselamatan_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_keselamatan_model;
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_keselamatan_model->senarai_laporan($pelapor['bil'], date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_keselamatan = array_merge($senarai_laporan_keselamatan, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_keselamatan;
        }

        $senarai_laporan_sosial = array();
        if($sf == 'sosial'){
            $this->load->model('isu_sosial_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_sosial_model;
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_sosial_model->senarai_laporan($pelapor['bil'], date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_sosial = array_merge($senarai_laporan_sosial, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_sosial;
        }

        $senarai_laporan_infrastruktur = array();
        if($sf == 'infrastruktur'){
            $this->load->model('isu_infrastruktur_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_infrastruktur_model;
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_infrastruktur_model->senarai_laporan($pelapor['bil'], date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_infrastruktur = array_merge($senarai_laporan_infrastruktur, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_infrastruktur;
        }

        $senarai_laporan_telekomunikasi = array();
        if($sf == 'telekomunikasi'){
            $this->load->model('isu_telekomunikasi_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_telekomunikasi_model;
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_telekomunikasi_model->senarai_laporan($pelapor['bil'], date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_telekomunikasi = array_merge($senarai_laporan_telekomunikasi, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_telekomunikasi;
        }

        $this->load->model('negeri_model');
        $data['senarai_negeri'] = $this->negeri_model->senarai();
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/lapis/kluster');
        $this->load->view('susunletak/bawah');
                break;
            default : 
                redirect(base_url());
        }
        
    }

    public function senarai_kluster()
    {
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('kluster_isu_model');
        $this->load->model('pengguna_model');
        $data['dataKlusterIsu'] = $this->kluster_isu_model;
        $data['negeri'] = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
        $data['senarai_kluster'] = $this->kluster_isu_model->senarai();
        $data['senaraiPelapor'] = $this->pengguna_model->ikut_negeri($data['negeri']);
        $data['dataPengguna'] = $this->pengguna_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/lapis/senarai_kluster');
        $this->load->view('susunletak/bawah');
    }

    public function proses_padam_laporan_sah()
    {
        $pengesahan = $this->input->post('input_pengesahan');
        $kluster_shortform = $this->input->post('input_kluster_shortform');
        if(empty($pengesahan) || empty($kluster_shortform))
        {
            redirect(base_url());
        }
        if($pengesahan == 'Ya'){
            $this->load->model('kluster_isu_model');
            $pelapor_bil = $this->input->post('input_pelapor_bil');
            $tahun = $this->input->post('input_tahun_laporan');
            $laporan_bil = $this->input->post('input_laporan_bil');
            $status_padam = $this->kluster_isu_model->padam($kluster_shortform, $pelapor_bil, $tahun, $laporan_bil);
            $data['kluster_shortform'] = $kluster_shortform;
            if($status_padam){
                $this->load->view('susunletak/atas', $data);
                $this->load->view('lapis/sah_padam');
                $this->load->view('susunletak/bawah');
            }else{
                $this->load->view('susunletak/atas', $data);
                $this->load->view('lapis/gagal_padam');
                $this->load->view('susunletak/bawah');
            }
        }
    }

    public function proses_padam_laporan()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(empty($sesi)){
            redirect(base_url());
        }
        $laporan_bil = $this->input->post('input_laporan_bil');
        $pelapor_bil = $this->input->post('input_pelapor_bil');
        $kluster_shortform = $this->input->post('input_kluster_shortform');
        $tahun_laporan = $this->input->post('input_tahun_laporan');

        if(empty($laporan_bil) || empty($pelapor_bil) || empty($kluster_shortform) || empty($tahun_laporan)){
            redirect(base_url());
        }

        $data['kluster_shortform'] = $kluster_shortform;
        $this->load->model('kluster_isu_model');
        $this->load->model('pengguna_model');
        $this->load->model('negeri_model');
        $this->load->model('daerah_model');
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $data['data_dun'] = $this->dun_model;
        $data['data_parlimen'] = $this->parlimen_model;
        $data['data_daerah'] = $this->daerah_model;
        $data['data_negeri'] = $this->negeri_model;
        $data['data_pengguna'] = $this->pengguna_model;
        $data['laporan'] = $this->kluster_isu_model->laporan2($kluster_shortform, $pelapor_bil, $tahun_laporan, $laporan_bil);
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        if(empty($data['laporan'])){
            die('Errornya kat sini dong');
            //redirect(base_url());
        }

        $this->load->view('ppd_na/lapis/verifyPadamLaporan', $data);

        //$this->load->view('susunletak/atas', $data);
        //$this->load->view('lapis/verify_padam_laporan');
        //$this->load->view('susunletak/bawah');
    }

    public function analisis_kluster($kluster_bil){
        if(empty($kluster_bil)){
            redirect(base_url());
        }
        $this->load->model('kluster_isu_model');
        $this->load->model('negeri_model');
        $this->load->model('pengguna_model');
        $data['data_kluster'] = $this->kluster_isu_model;
        $data['data_pengguna'] = $this->pengguna_model;
        $data['senarai_negeri'] = $this->negeri_model->senarai();
        $data['kluster_pilihan'] = $this->kluster_isu_model->papar($kluster_bil);
        $data['senarai_kluster'] = $this->kluster_isu_model->senarai();
        $this->load->view('susunletak/atas', $data);
        $this->load->view('cpi/analisis/kluster');
        $this->load->view('susunletak/bawah');
    }

    public function negeri_pelapor()
    {
        $peranan = strtoupper($this->session->userdata('peranan'));
        if(empty($peranan)){
            redirect(base_url());
        }
        if(strpos($peranan, "NEGERI") === FALSE){
            redirect(base_url());
        }
        $this->load->model('winnable_candidate_assign_model');
        $this->load->model('pengguna_model');
        $data['data_pengguna'] = $this->pengguna_model;
        $data['negeri'] = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('negeri/lapis/pelapor');
        $this->load->view('susunletak/bawah');
    }

    public function laporan_hari_ini($kluster_bil)
    {
        $this->load->model('kluster_isu_model');
        $this->load->model('pengguna_model');
        $this->load->model('daerah_model');
        $data['dataDaerah'] = $this->daerah_model;
        $data['data_isu'] = $this->kluster_isu_model;
        $data['data_pengguna'] = $this->pengguna_model;
        $data['kluster'] = $this->kluster_isu_model->papar($kluster_bil);

        $k = $this->kluster_isu_model->papar($kluster_bil);
        $sf = $k->kit_shortform;

        $senarai_laporan = array();
        if($sf == 'politik'){
            $this->load->model('isu_politik_model');
            $this->load->model('pengguna_model');
            $senarai_pelapor = $this->pengguna_model->senarai_penuh_pelapor();
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_politik_model->senarai_laporan($pelapor->bil, date('Y'));
                if(!empty($laporan)){
                    $senarai_laporan = array_merge($senarai_laporan, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan;
        }

        $senarai_laporan_ekonomi = array();
        if($sf == 'ekonomi'){
            $this->load->model('isu_ekonomi_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_ekonomi_model;
            $senarai_pelapor = $this->pengguna_model->senarai_penuh_pelapor();
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_ekonomi_model->senarai_laporan($pelapor->bil, date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_ekonomi = array_merge($senarai_laporan_ekonomi, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_ekonomi;
        }

        $senarai_laporan_alamsekitar = array();
        if($sf == 'alamsekitar'){
            $this->load->model('isu_alamsekitar_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_alamsekitar_model;
            $senarai_pelapor = $this->pengguna_model->senarai_penuh_pelapor();
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_alamsekitar_model->senarai_laporan($pelapor->bil, date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_alamsekitar = array_merge($senarai_laporan_alamsekitar, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_alamsekitar;
        }

        $senarai_laporan_kesihatan = array();
        if($sf == 'kesihatan'){
            $this->load->model('isu_kesihatan_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_kesihatan_model;
            $senarai_pelapor = $this->pengguna_model->senarai_penuh_pelapor();
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_kesihatan_model->senarai_laporan($pelapor->bil, date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_kesihatan = array_merge($senarai_laporan_kesihatan, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_kesihatan;
        }

        $senarai_laporan_keselamatan = array();
        if($sf == 'keselamatan'){
            $this->load->model('isu_keselamatan_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_keselamatan_model;
            $senarai_pelapor = $this->pengguna_model->senarai_penuh_pelapor();
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_keselamatan_model->senarai_laporan($pelapor->bil, date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_keselamatan = array_merge($senarai_laporan_keselamatan, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_keselamatan;
        }

        $senarai_laporan_sosial = array();
        if($sf == 'sosial'){
            $this->load->model('isu_sosial_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_sosial_model;
            $senarai_pelapor = $this->pengguna_model->senarai_penuh_pelapor();
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_sosial_model->senarai_laporan($pelapor->bil, date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_sosial = array_merge($senarai_laporan_sosial, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_sosial;
        }

        $senarai_laporan_infrastruktur = array();
        if($sf == 'infrastruktur'){
            $this->load->model('isu_infrastruktur_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_infrastruktur_model;
            $senarai_pelapor = $this->pengguna_model->senarai_penuh_pelapor();
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_infrastruktur_model->senarai_laporan($pelapor->bil, date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_infrastruktur = array_merge($senarai_laporan_infrastruktur, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_infrastruktur;
        }

        $senarai_laporan_telekomunikasi = array();
        if($sf == 'telekomunikasi'){
            $this->load->model('isu_telekomunikasi_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_telekomunikasi_model;
            $senarai_pelapor = $this->pengguna_model->senarai_penuh_pelapor();
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_telekomunikasi_model->senarai_laporan($pelapor->bil, date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_telekomunikasi = array_merge($senarai_laporan_telekomunikasi, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_telekomunikasi;
        }

        $this->load->model('negeri_model');
        $data['senarai_negeri'] = $this->negeri_model->senarai();
        $this->load->view('susunletak/atas', $data);
        $this->load->view('cpi/laporan/laporan_penuh');
        $this->load->view('susunletak/bawah');
    }

    public function penuh($sf){

        $sesi = strtoupper($this->session->userdata('peranan'));
        if(empty($sesi)){
            redirect(base_url());
        }
        if(empty($sf)){
            redirect(base_url());
        }

        $data['kluster_shortform'] = $sf;
        $this->load->model('kluster_isu_model');
        $data['kluster_isu'] = $this->kluster_isu_model->ikut_shortform($sf);

        $senarai_laporan = array();
        if($sf == 'politik'){
            $this->load->model('isu_politik_model');
            $this->load->model('pengguna_model');
            $senarai_pelapor = $this->pengguna_model->senarai_pelapor($this->session->userdata('peranan_bil'));
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_politik_model->senarai_laporan($pelapor->bil, date('Y'));
                if(!empty($laporan)){
                    $senarai_laporan = array_merge($senarai_laporan, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan;
        }

        $senarai_laporan_ekonomi = array();
        if($sf == 'ekonomi'){
            $this->load->model('isu_ekonomi_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_ekonomi_model;
            $senarai_pelapor = $this->pengguna_model->senarai_pelapor($this->session->userdata('peranan_bil'));
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_ekonomi_model->senarai_laporan($pelapor->bil, date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_ekonomi = array_merge($senarai_laporan_ekonomi, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_ekonomi;
        }

        $senarai_laporan_alamsekitar = array();
        if($sf == 'alamsekitar'){
            $this->load->model('isu_alamsekitar_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_alamsekitar_model;
            $senarai_pelapor = $this->pengguna_model->senarai_pelapor($this->session->userdata('peranan_bil'));
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_alamsekitar_model->senarai_laporan($pelapor->bil, date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_alamsekitar = array_merge($senarai_laporan_alamsekitar, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_alamsekitar;
        }

        $senarai_laporan_kesihatan = array();
        if($sf == 'kesihatan'){
            $this->load->model('isu_kesihatan_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_kesihatan_model;
            $senarai_pelapor = $this->pengguna_model->senarai_pelapor($this->session->userdata('peranan_bil'));
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_kesihatan_model->senarai_laporan($pelapor->bil, date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_kesihatan = array_merge($senarai_laporan_kesihatan, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_kesihatan;
        }

        $senarai_laporan_keselamatan = array();
        if($sf == 'keselamatan'){
            $this->load->model('isu_keselamatan_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_keselamatan_model;
            $senarai_pelapor = $this->pengguna_model->senarai_pelapor($this->session->userdata('peranan_bil'));
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_keselamatan_model->senarai_laporan($pelapor->bil, date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_keselamatan = array_merge($senarai_laporan_keselamatan, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_keselamatan;
        }

        $senarai_laporan_sosial = array();
        if($sf == 'sosial'){
            $this->load->model('isu_sosial_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_sosial_model;
            $senarai_pelapor = $this->pengguna_model->senarai_pelapor($this->session->userdata('peranan_bil'));
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_sosial_model->senarai_laporan($pelapor->bil, date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_sosial = array_merge($senarai_laporan_sosial, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_sosial;
        }

        $senarai_laporan_infrastruktur = array();
        if($sf == 'infrastruktur'){
            $this->load->model('isu_infrastruktur_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_infrastruktur_model;
            $senarai_pelapor = $this->pengguna_model->senarai_pelapor($this->session->userdata('peranan_bil'));
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_infrastruktur_model->senarai_laporan($pelapor->bil, date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_infrastruktur = array_merge($senarai_laporan_infrastruktur, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_infrastruktur;
        }

        $senarai_laporan_telekomunikasi = array();
        if($sf == 'telekomunikasi'){
            $this->load->model('isu_telekomunikasi_model');
            $this->load->model('pengguna_model');
            $data['data_isu'] = $this->isu_telekomunikasi_model;
            $senarai_pelapor = $this->pengguna_model->senarai_pelapor($this->session->userdata('peranan_bil'));
            foreach($senarai_pelapor as $pelapor){
                $laporan = $this->isu_telekomunikasi_model->senarai_laporan($pelapor->bil, date("Y"));
                if(!empty($laporan)){
                    $senarai_laporan_telekomunikasi = array_merge($senarai_laporan_telekomunikasi, $laporan);
                }
            }
            $data['senarai_laporan'] = $senarai_laporan_telekomunikasi;
        }

        $data['bilangan_pelapor'] = count($senarai_pelapor);
        $data['data_pengguna'] = $this->pengguna_model;
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $this->load->model('daerah_model');
        $data['dataDaerah'] = $this->daerah_model;
        $data['data_parlimen'] = $this->parlimen_model;
        $data['data_dun'] = $this->dun_model;
        $this->load->view('susunletak/atas', $data);
        $this->load->view('lapis/laporan_kluster/'.$sf);
        $this->load->view('susunletak/bawah');
    }

    public function maklumat_penuh(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $this->load->model('kluster_isu_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['senarai_kluster'] = $this->kluster_isu_model->senarai_penuh();
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        switch($sesi){
            case 'PPD' :
                $this->load->view('ppd_na/lapis/maklumatPenuh', $data);
                break;
            case 'PPD2' :
                $this->load->model('kluster_isu_model');
                $data['senarai_kluster'] = $this->kluster_isu_model->senarai_penuh();
                $this->load->view('susunletak/atas', $data);
                $this->load->view('lapis/maklumat_penuh');
                $this->load->view('susunletak/bawah');
                break;
            default :
                redirect(base_url());
        }
        
    }

    /**
     * FUNGSI BAHARU: Untuk mendapatkan data rumusan bagi papan pemuka LAPIS.
     */
    private function _bilanganLapis()
    {
        $this->load->model('lapis2_model'); // Model baharu yang berinteraksi dengan lapis_tb
        $this->load->model('kluster_isu_model');

        $bilangan = [];

        // 1. Dapatkan jumlah keseluruhan laporan (andaian fungsi wujud dalam model)
        $bilangan['jumlah_laporan'] = $this->lapis2_model->kira_semua();

        // 2. Dapatkan jumlah laporan yang ditolak (andaian fungsi wujud dalam model)
        $bilangan['laporan_ditolak'] = $this->lapis2_model->kira_mengikut_status('Ditolak');

        // TAMBAHKAN BARIS INI untuk mendapatkan 5 laporan terkini
        $bilangan['laporan_terkini'] = $this->lapis2_model->dapatkan_laporan_terkini(5);


        // 3. Dapatkan taburan laporan mengikut kluster untuk tujuan carta
        $senaraiKluster = $this->kluster_isu_model->senarai();
        $laporanPerKluster = [];
        foreach ($senaraiKluster as $kluster) {
            $laporanPerKluster[$kluster->kit_nama] = $this->lapis2_model->kira_mengikut_kluster($kluster->kit_bil);
        }
        $bilangan['pecahan_kluster'] = $laporanPerKluster;

        return $bilangan;
    }

    public function index()
    {

        //INITIALIZATION
        $peranan = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('kluster_isu_model');
        $this->load->model('pengguna_model');

        //LOAD VIEW ATAS

        //LOAD DATA
        $data['senarai_kluster'] = $this->kluster_isu_model->senarai_penuh();
        $data['data_laporan'] = $this->kluster_isu_model;
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        
        if(strpos(strtoupper($peranan), 'PPD') !== FALSE){
            $data['senarai_pelapor'] = $this->pengguna_model->senarai_pelapor($this->session->userdata('peranan_bil'));
            
        $this->load->view('susunletak/atas');
        $this->load->view('lapis/ppd', $data);
            $this->load->view('susunletak/bawah');
        }

        if(strpos($peranan, 'NEGERI') !== FALSE){
            $this->load->model('winnable_candidate_assign_model');
            $negeri = $this->winnable_candidate_assign_model->assign($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil)->wcat_negeri;
            $senarai_negeri = $this->pengguna_model->ikut_negeri($negeri);
            $senarai_penuh = array();
            foreach($senarai_negeri as $sn){
                $pelapor = $this->pengguna_model->maklumat_pengguna($sn['bil']);
                $senarai_penuh = array_merge($senarai_penuh, $pelapor);
            }
            $data['senarai_pelapor'] = $senarai_penuh;
        $this->load->view('susunletak/atas');
        $this->load->view('lapis/negeri', $data);
            $this->load->view('susunletak/bawah');

        }

        switch($peranan){
             case 'URUSETIA' :
                // 1. Panggil data untuk papan pemuka
                $data['bilanganLapis'] = $this->_bilanganLapis(); 
                
                // 2. Muatkan paparan secara terus (header, content, footer)
                $this->load->view('susunletak/atas', $data);
                $this->load->view('lapis/utama'); // Fail papan pemuka Lapis yang kita reka
                $this->load->view('susunletak/bawah');
                break;
        }

    }



/// MAIN ///

/// CREATE ///

    public function pilih_kluster(){

        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $perananBil = $this->session->userdata('peranan_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        if(strpos($sesi, 'PPD') === FALSE || empty($sesi)){
            redirect(base_url());
        }
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }

        //ACCORDINGLY
        switch($sesi){
            case 'PPD' : 
                //LOAD MODEL
                $this->load->model('kluster_isu_model');

                //LOAD DATA
                $data['senarai_kluster'] = $this->kluster_isu_model->senarai_penuh();
                
                //LOAD VIEW
                $this->load->view('ppd_na/lapis/borangPilihanKluster', $data);
                break;
            default :
                redirect(base_url());
        }
        
    }

//// KOMPONEN ////

///// PPD /////

public function ppd(){
    $this->load->view('ppd/komponen/lapis');
}

/// SENARAI KLUSTER ///

public function proses_politik()
{
    $this->load->model('isu_politik_model');
    $this->isu_politik_model->tambah(); 
    $this->simpan_ke_lapis_tb('politik');
    redirect('lapis');
}

public function politik()
{
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $this->load->model('pengguna_model');
    $this->load->model('lapis_kategori_model');
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    if(empty($sesi)){
        redirect(base_url());
    }
    if(strpos($sesi, 'PPD') !== FALSE){
        $sesi = 'PPD';
    }
    $perananBil = $this->session->userdata('peranan_bil');
    $this->load->model('pdm_model');
    switch($sesi){
        case 'PPD' :
            $this->load->library('form_validation');
            $this->load->model('pengguna_model');
            $this->load->model('kluster_isu_model');
            $this->load->model('japen_model');
            $this->load->model('dun_model');
            $this->load->model('parlimen_model');
            $this->load->model('daerah_model');
            $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($perananBil);
            $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($perananBil);
            $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($perananBil);
            $data['kluster_isu'] = $this->kluster_isu_model->ikut_shortform('politik');
            $data['senarai_anggota'] = $this->pengguna_model->anggota($this->session->userdata('peranan_bil'));
            $data['senarai_parlimen'] = $this->japen_model->senarai_tugas_parlimen($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
            $data['senarai_dun'] = $this->japen_model->senarai_tugas_dun($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
            $data['senaraiPdm'] = $this->pdm_model->senaraiPdmParlimen($data['senaraiParlimen']);
            $data['senaraiKategori'] = $this->lapis_kategori_model->senaraiIkutKlusterBorang($data['kluster_isu']->kit_bil);
            //$this->load->view('susunletak/atas', $data);
            //$this->load->view('lapis/kluster/politik');
            //$this->load->view('susunletak/bawah');
            $this->load->view('ppd_na/lapis/politik/borang', $data);
            break;
        default :
            redirect(base_url());
    }
    
}

public function proses_ekonomi()
{
    $this->load->model('isu_ekonomi_model');
    $this->isu_ekonomi_model->tambah();
    $this->simpan_ke_lapis_tb('ekonomi');
    redirect('lapis');
}

public function ekonomi()
{
    $perananBil = $this->session->userdata('peranan_bil');
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');
    if(strpos($sesi, 'PPD') !== FALSE){
        $sesi = 'PPD';
    }
    $this->load->model('pengguna_model');
    $this->load->model('kluster_isu_model');
    $this->load->model('japen_model');
    $this->load->model('daerah_model');
    $this->load->model('lapis_kategori_model');
    $this->load->model('pdm_model');
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    switch($sesi){
        case 'PPD' :
            $data['kluster_isu'] = $this->kluster_isu_model->ikut_shortform('ekonomi');
            $data['senarai_anggota'] = $this->pengguna_model->anggota($this->session->userdata('peranan_bil'));
            $data['senaraiParlimen'] = $this->japen_model->senarai_tugas_parlimen($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
            $data['senaraiDun'] = $this->japen_model->senarai_tugas_dun($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
            $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($perananBil);
            $data['senaraiPdm'] = $this->pdm_model->senaraiPdmParlimen($data['senaraiParlimen']);
            $data['senaraiKategori'] = $this->lapis_kategori_model->senaraiIkutKlusterBorang($data['kluster_isu']->kit_bil);
            $this->load->view('ppd_na/lapis/ekonomi/borang', $data);
            break;
        default :
            redirect(base_url());
    }
    
}

public function proses_alamsekitar()
{
    $this->load->model('isu_alamsekitar_model');
    $this->isu_alamsekitar_model->tambah();
    $this->simpan_ke_lapis_tb('alamsekitar');
    redirect('lapis');
}

public function alamsekitar()
{
    $perananBil = $this->session->userdata('peranan_bil');
    $sesi = strtoupper($this->session->userdata('peranan'));
    if(strpos($sesi, 'PPD') !== FALSE){
        $sesi = 'PPD';
    }
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $this->load->model('pengguna_model');
    $this->load->model('kluster_isu_model');
    $this->load->model('japen_model');
    $this->load->model('daerah_model');
    $this->load->model('pdm_model');
    $this->load->model('lapis_kategori_model');
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    $data['kluster_isu'] = $this->kluster_isu_model->ikut_shortform('alamsekitar');
    switch($sesi){
        case 'PPD' :
            $data['senarai_anggota'] = $this->pengguna_model->anggota($this->session->userdata('peranan_bil'));
            $data['senaraiParlimen'] = $this->japen_model->senarai_tugas_parlimen($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
            $data['senaraiDun'] = $this->japen_model->senarai_tugas_dun($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
            $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($perananBil);
            $data['senaraiPdm'] = $this->pdm_model->senaraiPdmParlimen($data['senaraiParlimen']);
            $data['senaraiKategori'] = $this->lapis_kategori_model->senaraiIkutKlusterBorang($data['kluster_isu']->kit_bil);
            //$this->load->view('susunletak/atas', $data);
            //$this->load->view('lapis/kluster/alamsekitar');
            //$this->load->view('susunletak/bawah');
            $this->load->view('ppd_na/lapis/alamsekitar/borang', $data);
            break;
        default :
            redirect(base_url());
    }
}

public function proses_kesihatan()
{
    $this->load->model('isu_kesihatan_model');
    $this->isu_kesihatan_model->tambah();
    $this->simpan_ke_lapis_tb('kesihatan');
    redirect('lapis');
}


public function kesihatan()
{
    $perananBil = $this->session->userdata('peranan_bil');
    $sesi = strtoupper($this->session->userdata('peranan'));
    if(strpos($sesi, 'PPD') !== FALSE){
        $sesi = 'PPD';
    }
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $this->load->model('pengguna_model');
    $this->load->model('kluster_isu_model');
    $this->load->model('japen_model');
    $this->load->model('daerah_model');
    $this->load->model('pdm_model');
    $this->load->model('lapis_kategori_model');
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    $data['kluster_isu'] = $this->kluster_isu_model->ikut_shortform('kesihatan');
    switch($sesi){
        case 'PPD' :
            $data['senarai_anggota'] = $this->pengguna_model->anggota($this->session->userdata('peranan_bil'));
            $data['senaraiParlimen'] = $this->japen_model->senarai_tugas_parlimen($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
            $data['senaraiDun'] = $this->japen_model->senarai_tugas_dun($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
            $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($perananBil);
            $data['senaraiPdm'] = $this->pdm_model->senaraiPdmParlimen($data['senaraiParlimen']);
            $data['senaraiKategori'] = $this->lapis_kategori_model->senaraiIkutKlusterBorang($data['kluster_isu']->kit_bil);
            //$this->load->view('susunletak/atas', $data);
            //$this->load->view('lapis/kluster/kesihatan');
            //$this->load->view('susunletak/bawah');
            $this->load->view('ppd_na/lapis/kesihatan/borang', $data);
            break;
        default :
            redirect(base_url());
    }
    
}

public function proses_keselamatan()
{
    $this->load->model('isu_keselamatan_model');
    $this->isu_keselamatan_model->tambah();
    $this->simpan_ke_lapis_tb('keselamatan');
    redirect('lapis');
}

public function keselamatan()
{
    //INITIALIZATION
    $sesi = strtoupper($this->session->userdata('peranan'));
    $penggunaBil = $this->session->userdata('pengguna_bil');

    //LOAD MODEL
    $this->load->model('pengguna_model');
    $this->load->model('lapis_kategori_model');
    $this->load->model('pdm_model');

    //LOAD DATA
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

    //CHECK IF PPD
    if(strpos($sesi, 'PPD') !== FALSE){
        $sesi = 'PPD';
    }

    //ACCORDINGLY
    switch($sesi){
        case 'PPD' : 
            $perananBil = $this->session->userdata('peranan_bil');
            $this->load->model('pengguna_model');
            $this->load->model('kluster_isu_model');
            $this->load->model('japen_model');
            $this->load->model('daerah_model');
            $data['kluster_isu'] = $this->kluster_isu_model->ikut_shortform('keselamatan');
            $data['senarai_anggota'] = $this->pengguna_model->anggota($this->session->userdata('peranan_bil'));
            $data['senarai_parlimen'] = $this->japen_model->senarai_tugas_parlimen($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
            $data['senarai_dun'] = $this->japen_model->senarai_tugas_dun($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
            $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($perananBil);
            $data['senaraiKategori'] = $this->lapis_kategori_model->senaraiIkutKlusterBorang($data['kluster_isu']->kit_bil);
            $data['senaraiPdm'] = $this->pdm_model->senaraiPdmParlimen($data['senarai_parlimen']);
            //$this->load->view('susunletak/atas', $data);
            //$this->load->view('lapis/kluster/keselamatan');
            //$this->load->view('susunletak/bawah');
            
            //LOAD VIEW
            $this->load->view('ppd_na/lapis/keselamatan/borang', $data);

            break;
        default :
            redirect(base_url());
    }
    
}

public function proses_sosial()
{
    $this->load->model('isu_sosial_model');
    $this->isu_sosial_model->tambah();
    $this->simpan_ke_lapis_tb('sosial');
    redirect('lapis');
}

public function sosial()
{
    $perananBil = $this->session->userdata('peranan_bil');
    $sesi = strtoupper($this->session->userdata('peranan'));
    if(strpos($sesi, 'PPD') !== FALSE){
        $sesi = 'PPD';
    }
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $this->load->model('pengguna_model');
    $this->load->model('kluster_isu_model');
    $this->load->model('japen_model');
    $this->load->model('daerah_model');
    $this->load->model('pdm_model');
    $this->load->model('lapis_kategori_model');
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    $data['kluster_isu'] = $this->kluster_isu_model->ikut_shortform('sosial');
    switch($sesi){
        case 'PPD' :
            $data['senarai_anggota'] = $this->pengguna_model->anggota($this->session->userdata('peranan_bil'));
            $data['senaraiParlimen'] = $this->japen_model->senarai_tugas_parlimen($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
            $data['senaraiDun'] = $this->japen_model->senarai_tugas_dun($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
            $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($perananBil);
            $data['senaraiPdm'] = $this->pdm_model->senaraiPdmParlimen($data['senaraiParlimen']);
            $data['senaraiKategori'] = $this->lapis_kategori_model->senaraiIkutKlusterBorang($data['kluster_isu']->kit_bil);
            //$this->load->view('susunletak/atas', $data);
            //$this->load->view('lapis/kluster/kesihatan');
            //$this->load->view('susunletak/bawah');
            $this->load->view('ppd_na/lapis/sosial/borang', $data);
            break;
        default :
            redirect(base_url());
    }
}

public function proses_infrastruktur()
{
    $this->load->model('isu_infrastruktur_model');
    $this->isu_infrastruktur_model->tambah();
    $this->simpan_ke_lapis_tb('infrastruktur');
    redirect('lapis');
}

public function infrastruktur()
{
    $sesi = strtoupper($this->session->userdata('peranan'));
    $perananBil = $this->session->userdata('peranan_bil');
    $penggunaBil = $this->session->userdata('pengguna_bil');
    $this->load->model('pengguna_model');
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    if(strpos($sesi, 'PPD') !== 'PPD'){
        $sesi = 'PPD';
    }
    switch($sesi){
        case 'PPD' :
            $this->load->model('pengguna_model');
            $this->load->model('kluster_isu_model');
            $this->load->model('japen_model');
            $this->load->model('daerah_model');
            $this->load->model('pdm_model');
            $this->load->model('lapis_kategori_model');
            $data['kluster_isu'] = $this->kluster_isu_model->ikut_shortform('infrastruktur');
            $data['senarai_anggota'] = $this->pengguna_model->anggota($this->session->userdata('peranan_bil'));
            $data['senaraiParlimen'] = $this->japen_model->senarai_tugas_parlimen($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
            $data['senaraiDun'] = $this->japen_model->senarai_tugas_dun($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
            $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($perananBil);
            $data['senaraiPdm'] = $this->pdm_model->senaraiPdmParlimen($data['senaraiParlimen']);
            $data['senaraiKategori'] = $this->lapis_kategori_model->senaraiIkutKlusterBorang($data['kluster_isu']->kit_bil);
            $this->load->view('ppd_na/lapis/infrastruktur/borang', $data);
            break;
        default : 
            redirect(base_url());
    }
}

public function proses_telekomunikasi()
{
    $this->load->library('form_validation');
    $this->form_validation->set_rules('input_pelapor', 'Pilihan Pelapor', 'required');
    $this->form_validation->set_rules('input_daerah', 'Pilihan Daerah', 'required');
    $this->form_validation->set_rules('input_tajuk', 'Pilihan Isu Telekomunikasi', 'required');
    $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
    $this->form_validation->set_message('required', 'Sila penuhi ruangan {field}');
    $this->load->model('isu_telekomunikasi_model');

    if($this->form_validation->run() === FALSE){
        $this->telekomunikasi();
    }else{
        $telekomunikasiBil = $this->isu_telekomunikasi_model->tambah();
        $pelaporBil = $this->input->post('input_pelapor');
        $tahun = date_format(date_create($this->input->post('input_tarikh_laporan')), 'Y');
        $isu = $this->isu_telekomunikasi_model->papar($telekomunikasiBil, $pelaporBil, $tahun);
        $filename = "internet".$telekomunikasiBil."_";
        $config['upload_path'] = './assets/img/';
        $config['allowed_types'] = '*';
        $config['file_name'] = $filename;
        $config['overwrite'] = FALSE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if($isu->isu_telekomunikasi == 'Rangkaian Internet / Data'){
        if ( ! $this->upload->do_upload('input_gambar'))
        {
            $error = array(
                'error' => $this->upload->display_errors()
            );
            foreach($error as $e){
                echo $e;
            }
            $this->telekomunikasi();
        }
        else
        {
            $data = array(
                'upload_data' => $this->upload->data()
            );
            $this->isu_telekomunikasi_model->tambah_internet($telekomunikasiBil, $this->upload->data('file_name'));
            // --- PENAMBAHAN BARU UNTUK RIMS@LAPIS 2.0 ---
            $this->simpan_ke_lapis_tb('telekomunikasi');
            // --- TAMAT PENAMBAHAN ---
        }
        }
        redirect('lapis');
    }
}

public function telekomunikasi()
{
    $this->load->library('form_validation');
    $sesi = strtoupper($this->session->userdata('peranan'));
    $perananBil = $this->session->userdata('peranan_bil');
    $penggunaBil = $this->session->userdata('pengguna_bil');
    if(empty($sesi)){
        redirect(base_url());
    }
    if(strpos($sesi, 'PPD') !== FALSE){
        $sesi = 'PPD';
    }elseif(strpos($sesi, 'NEGERI') !== FALSE){
        $sesi = 'NEGERI';
    }
    $this->load->model('pengguna_model');
    $this->load->model('kluster_isu_model');
    $this->load->model('japen_model');
    $this->load->model('negeri_model');
    $this->load->model('daerah_model');
    $data['kluster_isu'] = $this->kluster_isu_model->ikut_shortform('telekomunikasi');
    $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
    switch($sesi){
        case 'URUSETIA' : 
            $data['senarai_anggota'] = $this->pengguna_model->senarai();
            $data['senaraiDaerah'] = $this->daerah_model->senarai();
            $data['senarai_parlimen'] = $this->japen_model->senarai();
            $data['senarai_dun'] = $this->japen_model->senarai();
            $this->load->view('susunletak/atas', $data);
            $this->load->view('lapis/kluster/telekomunikasi_1');
            $this->load->view('susunletak/bawah');
            break;
        case 'LAPIS' : 
            $data['senarai_anggota'] = $this->pengguna_model->senarai();
            $data['senaraiDaerah'] = $this->daerah_model->senarai();
            $data['senarai_parlimen'] = $this->japen_model->senarai();
            $data['senarai_dun'] = $this->japen_model->senarai();
            $this->load->view('susunletak/atas', $data);
            $this->load->view('lapis/kluster/telekomunikasi_1');
            $this->load->view('susunletak/bawah');
            break;
        case 'NEGERI' : 
            redirect(base_url());
            break;
        case 'PPD' : 
            $data['senarai_anggota'] = $this->pengguna_model->anggota($perananBil);
            $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($perananBil);
            $data['senarai_parlimen'] = $this->japen_model->senarai_tugas_parlimen($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
            $data['senarai_dun'] = $this->japen_model->senarai_tugas_dun($this->pengguna_model->pengguna($this->session->userdata('pengguna_bil'))->pengguna_peranan_bil);
            $this->load->view('ppd_na/lapis/telekomunikasi/borang', $data);
            break;
        default : redirect(base_url());
    }
    //$this->load->view('susunletak/atas', $data);
    //$this->load->view('lapis/kluster/telekomunikasi_1');
    //$this->load->view('susunletak/bawah');
}




    public function padam_gambar($telekomunikasiBil)
    {
        //belum buat
      $this->load->helper('url');
      $this->load->helper('file');
      $this->load->model('gambar_model');
      $gambar = $this->gambar_model->gambar($gambarBil);
      $programBil = $gambar->gt_bilProgram;
      $namaFail = $gambar->gt_nama;
      $this->gambar_model->padam($gambarBil);
      delete_files("./assets/".$namaFail);
      redirect('program/bil/'.$programBil);
    }

 } ?>