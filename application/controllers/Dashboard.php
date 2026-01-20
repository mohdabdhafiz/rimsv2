<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
            case 'TOPONE' :
                $view = "topone";
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

    public function data_dashboard() {
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();       
        // 1. Load Model
        $this->load->model('sentimen_model');

        switch($sesi){
            case 'NEGERI' :
                $this->load->model('negeri_model');
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $statistik = $this->sentimen_model->dapatkan_statistik_kad_info_negeri($senaraiNegeri);
                $top_isu_raw = $this->sentimen_model->dapatkan_top_isu_sentimen_negeri(5, $senaraiNegeri);
                $taburan_raw = $this->sentimen_model->dapatkan_taburan_sentimen_negeri($senaraiNegeri);
                break;
            default :
                 // 2. Dapatkan Data Statistik (KPI)
                $statistik = $this->sentimen_model->dapatkan_statistik_kad_info();
                
                // 3. Dapatkan Data Top 5 Isu
                $top_isu_raw = $this->sentimen_model->dapatkan_top_isu_sentimen(5);
                
                // 4. Dapatkan Data Donut (Keseluruhan)
                $taburan_raw = $this->sentimen_model->dapatkan_taburan_sentimen_keseluruhan();
                break;
        }

        // 5. Susun Data (Manual Loop untuk ganti array_column)
        
        // A. Proses Data Bar Chart
        $bar_labels = array();
        $bar_positif = array();
        $bar_neutral = array();
        $bar_negatif = array();

        if(!empty($top_isu_raw)) {
            foreach ($top_isu_raw as $row) {
                $bar_labels[] = $row->sit_isu;
                $bar_positif[] = $row->positif;
                $bar_neutral[] = $row->neutral;
                $bar_negatif[] = $row->negatif;
            }
        }

        // B. Proses Data Donut Chart
        $donut_labels = array();
        $donut_data = array();

        if(!empty($taburan_raw)) {
            foreach ($taburan_raw as $row) {
                $donut_labels[] = $row->label;
                $donut_data[] = $row->jumlah;
            }
        }

        // 6. Bina Array Respons (Guna array() bukan [])
        $response = array(
            'kpi' => array(
                'jumlah_pelapor' => isset($statistik->jumlah_pelapor) ? $statistik->jumlah_pelapor : 0,
                'dominan' => isset($statistik->dominan_keseluruhan) ? $statistik->dominan_keseluruhan : 'Tiada Data',
                'isu_kritikal' => isset($statistik->isu_paling_negatif) ? $statistik->isu_paling_negatif : 'Tiada Data',
                'jumlah_kritikal' => isset($statistik->jumlah_paling_negatif) ? $statistik->jumlah_paling_negatif : 0
            ),
            'chart_bar' => array(
                'labels' => $bar_labels,
                'positif' => $bar_positif,
                'neutral' => $bar_neutral,
                'negatif' => $bar_negatif
            ),
            'chart_donut' => array(
                'labels' => $donut_labels,
                'data' => $donut_data
            )
        );

        // 7. Hantar sebagai JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function __construct()
    {
        parent::__construct();
        // Load necessary models, libraries, etc.
    }

    public function index()
    {
        $sesi = $this->sesi();
        $data['pengguna'] = $this->pengguna();
        $data = array_merge($data, $this->template($sesi));
        $this->load->model("pengguna_model");
        switch($sesi){
            case 'TOPONE' :
                // 4. DATA CARTA DONUT (TABURAN SENTIMEN KESELURUHAN)
                $taburan_raw = $this->pengguna_model->taburan_perjawatan();
                $data['donut_label'] = json_encode(array_column($taburan_raw, 'label'));
                $data['donut_data']  = json_encode(array_column($taburan_raw, 'jumlah'));
                break;
        }
        $data['gunaView'] = ["dashboard/laman"];
        $this->load->view("baseTemplate", $data);
    }

    public function grading()
    {
        // Load the main view for data virtualization
        $this->load->model(['pilihanraya_model', 'pencalonan_parlimen_model', 'pencalonan_model']);
        $data['pru'] = $this->pilihanraya_model->pruTerkini();
        //RUMUSAN PARTI
        if($data['pru']->pruJenis == 'PARLIMEN') {
            $data['senaraiParti'] = $this->pencalonan_parlimen_model->senaraiPartiParlimen($data['pru']->pruBil);
        } else {
            $data['senaraiParti'] = $this->pencalonan_model->senaraiPartiDun($data['pru']->pruBil);
        }
        $this->load->view('data_virtualization/index', $data);
    }

    /**
     * Fungsi ini adalah 'endpoint' untuk AJAX call dari JavaScript anda.
     * Ia mengambil ID PRU, mendapatkan data dari model, dan
     * mengembalikannya dalam format JSON.
     */
    public function fetch_data($pruBil = 0) {
        
        // Langkah 1: Pengesahan ringkas
        if (empty($pruBil) || !is_numeric($pruBil)) {
            // Hantar ralat jika tiada ID PRU yang sah
            $this->output
                ->set_status_header(400) // 400 Bad Request
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'ID PRU tidak sah atau hilang.']));
            return; // Hentikan perlaksanaan
        }

        $pru = $this->pilihanraya_model->pr($pruBil);
        if (!$pru) {
            // Hantar ralat jika PRU tidak ditemui
            $this->output
                ->set_status_header(404) // 404 Not Found
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'PRU tidak ditemui.']));
            return; // Hentikan perlaksanaan
        }

        try {
            // Langkah 2: Dapatkan data dari Model
            // (Anda perlu cipta 3 fungsi ini dalam Dashboard_model.php)

            // Data untuk lajur tengah (Senarai Kerusi)
            if($pru->pruJenis == 'PARLIMEN') {
                $senaraiKerusi = $this->pilihanraya_model->senaraiKerusiParlimen($pruBil);
            } else {
                $senaraiKerusi = $this->pilihanraya_model->senaraiKerusiDun($pruBil);
            }

            // Data untuk lajur kanan (Rumusan Parti)
            $kedudukanParti = $this->pilihanraya_model->senaraiCulaanMenangParti($pruBil);

            // Data untuk lajur kanan (Rumusan Grading)
            $kedudukanGrading = $this->Dashboard_model->get_rumusan_grading($pruBil);

            // Langkah 3: Sediakan data untuk output JSON
            // Nama kunci (cth: 'senaraiKerusi') MESTI sepadan dengan apa
            // yang JavaScript anda jangkakan (cth: data.senaraiKerusi)
            $data = [
                'senaraiKerusi'   => $senaraiKerusi,
                'kedudukanParti'  => $kedudukanParti,
                'kedudukanGrading' => $kedudukanGrading
            ];

            // Langkah 4: Hantar respon sebagai JSON
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));

        } catch (Exception $e) {
            // Tangkap sebarang ralat database atau lain-lain
            $this->output
                ->set_status_header(500) // 500 Internal Server Error
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Ralat dalaman server: ' . $e->getMessage()]));
        }
    }

}