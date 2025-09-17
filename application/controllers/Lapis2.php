<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Lapis2 Controller
 * * This controller manages all functionalities for RIMS@LAPIS 2.0.
 * It handles user sessions, data retrieval, and loading the appropriate views.
 * The structure is designed to be clean and scalable.
 *
 * @author     MOHD ABD HAFIZ BIN AWANG
 * @version    2.9
 */

class Lapis2 extends CI_Controller {

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
    // PUBLIC FUNCTIONS (URL Endpoints)
    //======================================================================

    /**
     * FUNGSI SEMENTARA: Lawati URL ini sekali untuk membina jadual lapis_tb.
     * URL: /lapis2/setup_database
     */
    public function setup_database()
    {
        $this->load->model('lapis2_model');
        $this->lapis2_model->update20250716(); // This calls the binaTable() function
        echo "Jadual 'lapis_tb' telah berjaya diwujudkan. Sila padam fungsi ini dari controller Lapis2.php";
    }

    public function index(){
        $sesi = $this->sesi();
        $data["pengguna"] = $this->pengguna();
        $data = array_merge($data, $this->templates($sesi));
        
        // KEMAS KINI DI SINI: Muatkan model dan dapatkan data aktiviti terkini
        $this->load->model('lapis2_model');
        $data['aktiviti_terkini'] = $this->lapis2_model->dapatkan_laporan_terkini(5);
        // TAMAT KEMAS KINI

        $this->renderView($data, ["lapis2/utama"]);
    }
    
    public function tambahLaporan(){
        $sesi = $this->sesi();
        $data["pengguna"] = $this->pengguna();
        $data = array_merge($data, $this->templates($sesi));

        $this->load->model('kluster_isu_model');
        $this->load->model('negeri_model');
        $data['senaraiKluster'] = $this->kluster_isu_model->senarai();
        $data['senaraiNegeri'] = $this->negeri_model->senarai();
        
        $this->renderView($data, ["lapis2/borangTambah"]);
    }

    public function simpanLaporan()
    {
        // Muatkan semua model yang diperlukan untuk mendapatkan nama
        $models = [
            'lapis2_model', 'kluster_isu_model', 'negeri_model', 
            'daerah_model', 'parlimen_model', 'dun_model', 'pdm_model'
        ];
        $this->load->model($models);
        $pengguna = $this->pengguna();

        // Dapatkan nama berdasarkan ID yang diterima dari borang
        $kluster = $this->kluster_isu_model->satu_data($this->input->post('lapis_kluster_bil'));
        $negeri = $this->negeri_model->satu_data($this->input->post('lapis_negeri_bil'));
        $daerah = $this->daerah_model->satu_data($this->input->post('lapis_daerah_bil'));
        $parlimen = $this->parlimen_model->satu_data($this->input->post('lapis_parlimen_bil'));
        $dun = $this->dun_model->satu_data($this->input->post('lapis_dun_bil'));
        $pdm = $this->pdm_model->satu_data_parlimen($this->input->post('lapis_dm_bil'));

        // Kumpul semua data (ID dan Nama) untuk disimpan
        $data_laporan = [
            'lapis_kluster_bil' => $this->input->post('lapis_kluster_bil'),
            'lapis_kluster_nama' => $kluster ? $kluster->kit_nama : null,
            
            'lapis_tarikh_laporan' => $this->input->post('lapis_tarikh_laporan'),
            'lapis_tarikh_laporan_bil' => strtotime($this->input->post('lapis_tarikh_laporan')),
            'lapis_tarikh_laporan_dibina' => date('Y-m-d H:i:s'),

            'lapis_negeri_bil' => $this->input->post('lapis_negeri_bil'),
            'lapis_negeri_nama' => $negeri ? $negeri->nt_nama : null,

            'lapis_daerah_bil' => $this->input->post('lapis_daerah_bil'),
            'lapis_daerah_nama' => $daerah ? $daerah->nama : null,

            'lapis_parlimen_bil' => $this->input->post('lapis_parlimen_bil'),
            'lapis_parlimen_nama' => $parlimen ? $parlimen->pt_nama : null,

            'lapis_dun_bil' => $this->input->post('lapis_dun_bil'),
            'lapis_dun_nama' => $dun ? $dun->dun_nama : null,
            
            'lapis_dm_bil' => $this->input->post('lapis_dm_bil'),
            'lapis_dm_nama' => $pdm ? $pdm->ppt_nama : null,
            
            'lapis_jenis_kawasan' => $this->input->post('lapis_jenis_kawasan'),

            'lapis_tajuk_isu' => $this->input->post('lapis_tajuk_isu'),
            'lapis_ringkasan_isu' => $this->input->post('lapis_ringkasan_isu'),
            'lapis_cadangan_intervensi' => $this->input->post('lapis_cadangan_intervensi'),
            'lapis_lokasi' => $this->input->post('lapis_lokasi'),
            'lapis_latitude' => $this->input->post('lapis_latitude'),
            'lapis_longitude' => $this->input->post('lapis_longitude'),
            
            'lapis_pelapor_bil' => $pengguna->bil,
            'lapis_pelapor_nama' => $pengguna->nama_penuh,
            'lapis_waktu_dibina' => date('Y-m-d H:i:s')
        ];

        // Panggil model untuk simpan data
        $this->lapis2_model->tambah_laporan($data_laporan);

        // Set mesej kejayaan dan redirect
        $this->session->set_flashdata('mesej_sukses', 'Laporan baru telah berjaya disimpan.');
        redirect('lapis2/senaraiLaporan');
    }

    public function senaraiLaporan()
    {
        $sesi = $this->sesi();
        $data["pengguna"] = $this->pengguna();
        $data = array_merge($data, $this->templates($sesi));
        
        $models = [
            "lapis2_model", "daerah_model", "negeri_model", 
            "parlimen_model", "dun_model", "pdm_model", "kluster_isu_model"
        ];
        $this->load->model($models);
        
        // KEMAS KINI: Memuatkan semua data untuk dropdown carian
        $data["senaraiPelapor"] = $this->pengguna_model->senaraiBukanAdmin();
        $data["senaraiNegeri"] = $this->negeri_model->senarai();
        $data["senaraiDaerah"] = $this->daerah_model->senarai();
        $data["senaraiParlimen"] = $this->parlimen_model->senarai();
        $data["senaraiDun"] = $this->dun_model->senarai();
        $data['senaraiDm'] = $this->pdm_model->senarai_pdm_dun();
        $data['senaraiKluster'] = $this->kluster_isu_model->senarai();
        // Nota: Anda perlu pastikan model untuk $senaraiIsu wujud dan dimuatkan
        $data['senaraiIsu'] = []; 

        // Logik untuk memproses carian
        $filters = [];
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $filters = [
                'tarikhMula' => $this->input->post('inputTarikhMula'),
                'tarikhAkhir' => $this->input->post('inputTarikhAkhir'),
                'pelapor' => $this->input->post('inputPelapor'),
                'negeri' => $this->input->post('inputNegeri'),
                'daerah' => $this->input->post('inputDaerah'),
                'parlimen' => $this->input->post('inputParlimen'),
                'dun' => $this->input->post('inputDun'),
                'dm' => $this->input->post('inputDm'),
                'jenisKawasan' => $this->input->post('inputJenisKawasan'),
                'kluster' => $this->input->post('inputKluster'),
                'isu' => $this->input->post('inputIsu')
            ];
            $data['senarai_laporan'] = $this->lapis2_model->dapatkan_laporan_carian($filters);
        } else {
            // Paparan kali pertama (tanpa carian)
            $data['senarai_laporan'] = $this->lapis2_model->dapatkan_laporan();
        }
        // Hantar nilai penapis kembali ke view
        $data['filters'] = $filters;
        $this->renderView($data, ["lapis2/senaraiLaporan"]);
    }

    /**
     * FUNGSI BARU: Memaparkan butiran satu laporan.
     */
    public function lihatLaporan($laporan_bil)
    {
        $sesi = $this->sesi();
        $data["pengguna"] = $this->pengguna();
        $data = array_merge($data, $this->templates($sesi));

        $this->load->model('lapis2_model');
        $data['laporan'] = $this->lapis2_model->dapatkan_satu_laporan($laporan_bil);

        if (empty($data['laporan'])) {
            // Jika laporan tidak dijumpai, tunjukkan ralat 404
            show_404();
        }

        $this->renderView($data, ["lapis2/lihatLaporan"]);
    }

    /**
     * FUNGSI BARU: Menjana dan memuat turun laporan sebagai fail PDF.
     */
    public function cetakPdf($laporan_bil)
    {
        // 1. Muatkan library dan model
        $this->load->library('pdf');
        $this->load->model('lapis2_model');

        // 2. Dapatkan data laporan
        $data['laporan'] = $this->lapis2_model->dapatkan_satu_laporan($laporan_bil);

        if (empty($data['laporan'])) {
            show_404();
        }

        // 3. Muatkan view khas untuk PDF sebagai HTML
        $html = $this->load->view('lapis2/cetakLaporanPdf', $data, TRUE);

        // 4. Jana PDF menggunakan library wrapper
        $this->pdf->generate($html, "Laporan-LAPIS-" . $laporan_bil);
    }

    /**
     * Memaparkan borang untuk mengemas kini laporan.
     */
    public function kemaskiniLaporan($laporan_bil)
    {
        $sesi = $this->sesi();
        $data["pengguna"] = $this->pengguna();
        $data = array_merge($data, $this->templates($sesi));

        $models = ['lapis2_model', 'kluster_isu_model', 'negeri_model', 'daerah_model', 'parlimen_model', 'dun_model', 'pdm_model'];
        $this->load->model($models);

        // Dapatkan data laporan yang sedia ada
        $data['laporan'] = $this->lapis2_model->dapatkan_satu_laporan($laporan_bil);

        if (empty($data['laporan'])) {
            show_404();
        }

        // Muatkan data untuk dropdown
        $data['senaraiKluster'] = $this->kluster_isu_model->senarai();
        $data['senaraiNegeri'] = $this->negeri_model->senarai();
        
        // Muatkan senarai untuk dropdown bersandaran berdasarkan data laporan sedia ada
        $negeri_bil_laporan = $data['laporan']->lapis_negeri_bil;
        $parlimen_bil_laporan = $data['laporan']->lapis_parlimen_bil;
        $data['senaraiDaerah'] = $this->daerah_model->senarai_ikut_negeri($negeri_bil_laporan);
        $data['senaraiParlimen'] = $this->parlimen_model->senarai_ikut_negeri($negeri_bil_laporan);
        $data['senaraiDun'] = $this->dun_model->senarai_ikut_negeri($negeri_bil_laporan);
        $data['senaraiDm'] = $this->pdm_model->parlimen($parlimen_bil_laporan);


        $this->renderView($data, ["lapis2/kemaskiniLaporan"]);
    }

    /**
     * Memproses data dari borang kemas kini.
     */
    public function prosesKemaskini()
    {
        $laporan_bil = $this->input->post('lapis_bil');

        $models = [
            'lapis2_model', 'kluster_isu_model', 'negeri_model', 
            'daerah_model', 'parlimen_model', 'dun_model', 'pdm_model'
        ];
        $this->load->model($models);

        // Dapatkan nama berdasarkan ID yang dikemas kini
        $kluster = $this->kluster_isu_model->satu_data($this->input->post('lapis_kluster_bil'));
        $negeri = $this->negeri_model->satu_data($this->input->post('lapis_negeri_bil'));
        $daerah = $this->daerah_model->satu_data($this->input->post('lapis_daerah_bil'));
        $parlimen = $this->parlimen_model->satu_data($this->input->post('lapis_parlimen_bil'));
        $dun = $this->dun_model->satu_data($this->input->post('lapis_dun_bil'));
        $pdm = $this->pdm_model->satu_data_parlimen($this->input->post('lapis_dm_bil'));
        $status_laporan = $this->input->post('lapis_status');
        $ulasan_tolak = null;
        // KEMAS KINI: Proses ulasan jika laporan ditolak
        if ($status_laporan === 'Laporan Ditolak') {
            $ulasan_array = $this->input->post('ulasan_tolak');
            if (is_array($ulasan_array)) {
                // Gabungkan ulasan yang dipilih menjadi satu string, dipisahkan dengan koma
                $ulasan_tolak = implode(', ', $ulasan_array);
            }
        }
        
        // Kumpul data yang telah dikemas kini
        $data_kemaskini = [
            'lapis_kluster_bil' => $this->input->post('lapis_kluster_bil'),
            'lapis_kluster_nama' => $kluster ? $kluster->kit_nama : null,
            'lapis_tarikh_laporan' => $this->input->post('lapis_tarikh_laporan'),
            'lapis_tajuk_isu' => $this->input->post('lapis_tajuk_isu'),
            'lapis_ringkasan_isu' => $this->input->post('lapis_ringkasan_isu'),
            'lapis_cadangan_intervensi' => $this->input->post('lapis_cadangan_intervensi'),
            'lapis_status' => $status_laporan,
            'lapis_ulasan_tolak' => $ulasan_tolak,
            'lapis_negeri_bil' => $this->input->post('lapis_negeri_bil'),
            'lapis_negeri_nama' => $negeri ? $negeri->nt_nama : null,
            'lapis_daerah_bil' => $this->input->post('lapis_daerah_bil'),
            'lapis_daerah_nama' => $daerah ? $daerah->nama : null,
            'lapis_parlimen_bil' => $this->input->post('lapis_parlimen_bil'),
            'lapis_parlimen_nama' => $parlimen ? $parlimen->pt_nama : null,
            'lapis_dun_bil' => $this->input->post('lapis_dun_bil'),
            'lapis_dun_nama' => $dun ? $dun->dun_nama : null,
            'lapis_dm_bil' => $this->input->post('lapis_dm_bil'),
            'lapis_dm_nama' => $pdm ? $pdm->ppt_nama : null,
            // KEMAS KINI DI SINI
            'lapis_lokasi' => $this->input->post('lapis_lokasi'),
            'lapis_latitude' => $this->input->post('lapis_latitude'),
            'lapis_longitude' => $this->input->post('lapis_longitude')
        ];

        // Panggil model untuk kemas kini data
        $this->lapis2_model->kemaskini_laporan($laporan_bil, $data_kemaskini);

        // Set mesej kejayaan dan redirect
        $this->session->set_flashdata('mesej_sukses', 'Laporan #' . $laporan_bil . ' telah berjaya dikemas kini.');
        redirect('lapis2/lihatLaporan/' . $laporan_bil);
    }

    /**
     * Memaparkan dashboard eksekutif dengan penapis tarikh.
     */
    public function dashboard()
    {
        $sesi = $this->sesi();
        $data["pengguna"] = $this->pengguna();
        $data = array_merge($data, $this->templates($sesi));
        
        $this->load->model('lapis2_model');

        // Dapatkan input tarikh dari borang
        $tarikhMula = $this->input->post('inputTarikhMula');
        $tarikhTamat = $this->input->post('inputTarikhTamat');

        $filters = [
            'tarikhMula' => $tarikhMula,
            'tarikhTamat' => $tarikhTamat
        ];

        $data['tarikhMula'] = $tarikhMula;
        $data['tarikhTamat'] = $tarikhTamat;

        // 1. Dapatkan data agregat dari model (dengan penapis)
        $data['jumlah_laporan'] = $this->lapis2_model->kira_jumlah_laporan($filters);
        $pecahan_kluster = $this->lapis2_model->dapatkan_pecahan_kluster($filters);
        
        // KEMAS KINI DI SINI: Dapatkan data prestasi negeri
        $data['prestasi_negeri'] = $this->lapis2_model->dapatkan_prestasi_negeri($filters);
        // KEMAS KINI DI SINI: Dapatkan dan proses data prestasi status
        $prestasi_mentah = $this->lapis2_model->dapatkan_prestasi_status();
        $prestasi_tersusun = [
            'Laporan Diterima' => 0,
            'Laporan Dipinda' => 0,
            'Laporan Ditolak' => 0,
        ];
        foreach ($prestasi_mentah as $status) {
            if (isset($prestasi_tersusun[$status->lapis_status])) {
                $prestasi_tersusun[$status->lapis_status] = $status->jumlah;
            }
        }
        $data['prestasi_status'] = $prestasi_tersusun;

        // KEMAS KINI DI SINI: Dapatkan dan proses data prestasi negeri mengikut status
        $prestasi_status_mentah = $this->lapis2_model->dapatkan_prestasi_negeri_by_status($filters);
        $prestasi_status_negeri = [];

        foreach ($prestasi_status_mentah as $row) {
            // Wujudkan array untuk negeri jika belum ada
            if (!isset($prestasi_status_negeri[$row->negeri])) {
                $prestasi_status_negeri[$row->negeri] = [
                    'Laporan Diterima' => 0,
                    'Laporan Dipinda' => 0,
                    'Laporan Ditolak' => 0,
                    'JUMLAH' => 0
                ];
            }
            // Masukkan jumlah mengikut status
            if (isset($prestasi_status_negeri[$row->negeri][$row->status])) {
                $prestasi_status_negeri[$row->negeri][$row->status] = $row->jumlah;
            }
            // Kira jumlah keseluruhan untuk negeri tersebut
            $prestasi_status_negeri[$row->negeri]['JUMLAH'] += $row->jumlah;
        }
        $data['prestasi_status_negeri'] = $prestasi_status_negeri;
        
        // 2. Proses data untuk carta dan paparan
        $kluster_data = [];
        foreach ($pecahan_kluster as $kluster) {
            $isu_utama = $this->lapis2_model->dapatkan_isu_utama_kluster($kluster->lapis_kluster_nama, 5, $filters);
            $kluster_data[] = [
                'nama' => $kluster->lapis_kluster_nama,
                'jumlah' => $kluster->jumlah,
                'peratus' => ($data['jumlah_laporan'] > 0) ? round(($kluster->jumlah / $data['jumlah_laporan']) * 100, 1) : 0,
                'isu_utama' => $isu_utama
            ];
        }
        $data['senarai_kluster_data'] = $kluster_data;

        // 3. Sediakan data khas untuk Chart.js
        $data['chart_labels'] = json_encode(array_column($kluster_data, 'nama'));
        $data['chart_data'] = json_encode(array_column($kluster_data, 'jumlah'));

        $this->renderView($data, ["lapis2/dashboard"]);
    }

    //======================================================================
    // AJAX HANDLER FUNCTIONS
    //======================================================================

    public function dapatkan_daerah()
    {
        $this->load->model('daerah_model');
        $negeri_bil = $this->input->post('negeri_bil');
        $senarai_daerah = $this->daerah_model->senarai_ikut_negeri($negeri_bil);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($senarai_daerah));
    }

    public function dapatkan_parlimen()
    {
        $this->load->model('parlimen_model');
        $negeri_bil = $this->input->post('negeri_bil');
        $senarai_parlimen = $this->parlimen_model->senarai_ikut_negeri($negeri_bil);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($senarai_parlimen));
    }

    public function dapatkan_dun()
    {
        $this->load->model('dun_model');
        $negeri_bil = $this->input->post('negeri_bil');
        $senarai_dun = $this->dun_model->senarai_ikut_negeri($negeri_bil);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($senarai_dun));
    }
    
    public function dapatkan_pdm()
    {
        $this->load->model('pdm_model');
        $parlimen_bil = $this->input->post('parlimen_bil'); // Terima ID Parlimen
        // Panggil fungsi 'parlimen' dari pdm_model
        $senarai_pdm = $this->pdm_model->parlimen($parlimen_bil);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($senarai_pdm));
    }
}
