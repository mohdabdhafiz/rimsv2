<?php
class Sentimen extends CI_Controller
{

    public function statusPenghantaran(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        switch($sesi){
            case 'NEGERI' :
                $this->load->model(['negeri_model', 'sentimen_model']);
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $senaraiAnggota = $this->pengguna_model->senaraiAnggotaNegeri($senaraiNegeri);
                $data['senaraiPelapor'] = $this->sentimen_model->statusPenghantaran($senaraiAnggota);
                $data = array_merge($data, $this->susunletak('negeri_na'));
                break;
            default :
                redirect(base_url());
        }     
        $this->load->view('lpk/statusPenghantaran', $data);
    }
    
    public function muatTurun(){
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $this->load->model('pengguna_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        switch($sesi){
            case 'PPD' :
                $this->load->dbutil(); 
                $this->load->model('sentimen_model');
                $this->load->helper('download');
                $this->load->model('daerah_model');
                $senaraiDaerah = $this->daerah_model->senaraiTugasanDaerah($data['pengguna']->pengguna_peranan_bil);
                $query = $this->sentimen_model->muatTurunDaerah($senaraiDaerah);
                $delimiter = ","; 
                $newline = "\r\n"; 
                $enclosure = '"'; 
                $csv_data = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure); 
                $file_name = 'RIMS@LKS_' . strtoupper($data['pengguna']->pengguna_peranan_nama) . '_' . date('Ymd') . '.csv'; 
                force_download($file_name, $csv_data);
                break;
            case 'LAPIS' :
                $this->load->dbutil(); 
                $this->load->model('sentimen_model');
                $this->load->helper('download');
                $tarikhMula = $this->input->post("inputTarikhMula");
                $tarikhTamat = $this->input->post("inputTarikhTamat");
                if(!empty($tarikhMula) && !empty($tarikhTamat)){
                    $query = $this->sentimen_model->muatTurunTarikh($tarikhMula, $tarikhTamat);
                    $delimiter = ","; 
                    $newline = "\r\n"; 
                    $enclosure = '"'; 
                    $csv_data = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure); 
                    $file_name = 'RIMS@LKS_' . strtoupper($data['pengguna']->pengguna_peranan_nama) . '_' . date('Ymd') . '.csv'; 
                    force_download($file_name, $csv_data);
                }
                break;
            case 'NEGERI' :
                $this->load->model('negeri_model');
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $this->load->dbutil(); 
                $this->load->model('sentimen_model');
                $this->load->helper('download');
                $query = $this->sentimen_model->muatTurun($senaraiNegeri);
                $delimiter = ","; 
                $newline = "\r\n"; 
                $enclosure = '"'; 
                $csv_data = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure); 
                $file_name = 'RIMS@LKS_' . strtoupper($data['pengguna']->pengguna_peranan_nama) . '_' . date('Ymd') . '.csv'; 
                force_download($file_name, $csv_data);
                break;
            case 'DATA' :
                $this->load->dbutil(); 
                $this->load->model('sentimen_model');
                $this->load->helper('download');
                $query = $this->sentimen_model->muatTurunSemua();
                $delimiter = ","; 
                $newline = "\r\n"; 
                $enclosure = '"'; 
                $csv_data = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure); 
                $file_name = 'RIMS@LKS_' . strtoupper($data['pengguna']->pengguna_peranan_nama) . '_' . date('Ymd') . '.csv'; 
                force_download($file_name, $csv_data);
                break;
            default :
                redirect(base_url());
        }                
    }

    public function prosesCarian(){

        //CHECK VALUES
        $tarikhMula = $this->input->post('inputTarikhMula');
        $tarikhTamat = $this->input->post('inputTarikhTamat');

        if(empty($tarikhMula)){
            redirect(base_url());
        }

        if(empty($tarikhTamat)){
            redirect(base_url());
        }

        //SENARAI KETETAPAN
        //1. Tarikh Mula
        $data['tarikhMula'] = $this->input->post('inputTarikhMula');
        //2. Tarikh Tamat
        $data['tarikhTamat'] = $this->input->post('inputTarikhTamat');
        //3. Kawasan
        $data['kawasan'] = $this->input->post('inputKawasan');
        //4. Pekerjaan
        $data['pekerjaan'] = $this->input->post('inputPekerjaan');
        //5. Julat Umur
        $data['julatUmur'] = $this->input->post('inputJulatUmur');
        //6. Kaum
        $data['kaum'] = $this->input->post('inputKaum');
        //7. Sentimen
        $data['sentimen'] = $this->input->post('inputSentimen');
        //8. Negeri
        $data['negeri'] = $this->input->post('inputNegeri');

        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');
        $this->load->model('daerah_model');
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $this->load->model('sentimen_model');
        $this->load->model('negeri_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $data['dataDaerah'] = $this->daerah_model;
        $data['dataParlimen'] = $this->parlimen_model;
        $data['dataDun'] = $this->dun_model;
        if(!empty($data['negeri']) && $data['negeri'] != 'Semua'){
            $data['pilihanNegeri'] = $this->negeri_model->negeri($data['negeri'])->nt_nama;
        }

        //ACCORDINGLY
        switch($sesi){
            case 'LAPIS'    :
                $data['senaraiLks'] = $this->sentimen_model->senaraiCarian();
                $this->load->view('us_lapis_na/sentimen/senaraiCarian', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function carian(){
        
        //INITIALIZATION
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');

        //LOAD MODEL
        $this->load->model('pengguna_model');
        $this->load->model('sentimen_model');
        $this->load->model('negeri_model');

        //LOAD DATA
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);

        //DATA SENTIMEN
        //1. Kawasan
        $data['senaraiKawasan'] = $this->sentimen_model->senaraiKawasan();
        //2. Pekerjaan
        $data['senaraiPekerjaan'] = $this->sentimen_model->senaraiPekerjaan();
        //3. Julat Umur
        $data['senaraiJulatUmur'] = $this->sentimen_model->senaraiJulatUmur();
        //4. Kaum
        $data['senaraiKaum'] = $this->sentimen_model->senaraiKaum();
        //5. Sentimen
        $data['senaraiSentimen'] = $this->sentimen_model->senaraiSentimen();
        //6. Senarai Negeri
        $data['senaraiNegeri'] = $this->negeri_model->senarai();

        switch($sesi){
            case 'LAPIS' :
                //LOAD VIEW
                $this->load->view('us_lapis_na/sentimen/carian', $data);
                break;
            default:
                redirect(base_url());
        }

    }

    public function padam($sentimenBil){
        if(empty($sentimenBil)){
            redirect(base_url());
        }
        $this->load->model('sentimen_model');
        $this->load->model('pengguna_model');
        $sentimen = $this->sentimen_model->sentimen($sentimenBil);
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(empty($sentimenBil)){
            redirect(base_url());
        }
        if($sentimen->stPelaporBil == $penggunaBil){
            $this->sentimen_model->padam($sentimenBil);
        }
        redirect('sentimen');
    }

    public function keputusanPenghantaran(){
        $sentimenBil = $this->input->post('inputBil');
        if(empty($sentimenBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        switch($sesi){
            case 'LAPIS' :
                $this->load->model('sentimen_model');
                $keputusan = $this->input->post('inputKeputusan');
                if($keputusan == 'Terima'){
                    $this->sentimen_model->terima($sentimenBil);
                    redirect('sentimen/senarai');
                }
                if($keputusan == 'Semakan Semula'){
                    $this->sentimen_model->draf($sentimenBil);
                    redirect(base_url());
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function bil($sentimenBil){
        if(empty($sentimenBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $perananBil = $this->session->userdata('peranan_bil');
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        $this->load->model('pengguna_model');
        $this->load->model('sentimen_model');
        $this->load->model('daerah_model');
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $data['dataDaerah'] = $this->daerah_model;
        $data['dataParlimen'] = $this->parlimen_model;
        $data['dataDun'] = $this->dun_model;
        $data['dataPengguna'] = $this->pengguna_model;
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'LAPIS' :
                $data['sentimen'] = $this->sentimen_model->sentimen($sentimenBil);
                if($data['sentimen']->stTapisan != 'Hantar'){
                    redirect(base_url());
                }
                $this->load->view('us_lapis_na/sentimen/bil', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function tapisan()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $perananBil = $this->session->userdata('peranan_bil');
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        $this->load->model('pengguna_model');
        $this->load->model('sentimen_model');
        $this->load->model('daerah_model');
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $data['dataDaerah'] = $this->daerah_model;
        $data['dataParlimen'] = $this->parlimen_model;
        $data['dataDun'] = $this->dun_model;
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'LAPIS' :
                $data['senaraiLks'] = $this->sentimen_model->tapisan();
                $this->load->view('us_lapis_na/sentimen/tapisan', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function prosesKemaskini()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        $this->load->model('sentimen_model');
        switch($sesi){
            case 'PPD' :
                $this->load->library('form_validation');
                $this->form_validation->set_rules('inputTarikhLaporan', 'Tarikh Laporan', 'required');
                $this->form_validation->set_rules('inputPelaporBil', 'Pelapor', 'required');
                $this->form_validation->set_rules('inputDaerahBil', 'Daerah', 'required');
                $this->form_validation->set_rules('inputSentimen', 'Pilihan Sentimen', 'required');
                $this->form_validation->set_rules('inputAlasan', 'Alasan Sentimen', 'required');
                $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
                $this->form_validation->set_message('required', 'Sila penuhi ruangan {field}');
                if($this->form_validation->run() === FALSE){
                    $this->borang();
                }else{
                    $this->sentimen_model->kemaskini();
                    redirect('sentimen/senarai', 'refresh');
                }
                break;
            default :
                redirect(base_url());
        }
    }

    public function kemaskini($sentimenBil)
    {
        if(empty($sentimenBil)){
            redirect(base_url());
        }
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $perananBil = $this->session->userdata('peranan_bil');
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }
        $this->load->model('pengguna_model');
        $this->load->model('daerah_model');
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $this->load->model('sentimen_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'PPD' :
                $data['senaraiPelapor'] = $this->pengguna_model->senarai_pelapor($perananBil);
                $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($perananBil);
                $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($perananBil);
                $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($perananBil);
                $data['sentimen'] = $this->sentimen_model->sentimen($sentimenBil);
                $this->load->view('ppd_na/sentimen/kemaskini', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    private function susunletak($rolePrefix)
    {
        return [
            'header' => "$rolePrefix/susunletak/atas",
            'sidebar' => "$rolePrefix/susunletak/sidebar",
            'navbar' => "$rolePrefix/susunletak/navbar",
            'footer' => "$rolePrefix/susunletak/bawah",
        ];
    }

    public function prosesMuatTurunPilihan() {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        // Load model
        $this->load->model(['sentimen_model', 'pengguna_model']); // Replace with your model name
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }elseif(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        switch($sesi){
            case 'LAPIS' :

                break;
            case 'PPD' :
                $senaraiPeranan = ['bil' => $data['pengguna']->pengguna_peranan_bil];
                break;
            case 'NEGERI' :
                break;
            default :
                redirect(base_url());
        }
        
    
        // Define filters if needed
        $filters = []; // Add any filtering logic if required
    
        // Fetch data
        $data = $this->sentimen_model->muatTurunPilihan($filters, $senaraiPeranan);
    
        // File name for download
        $filename = 'laporan_sentimen_' . date('Y-m-d_H-i-s') . '.csv';
    
        // Open output stream
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename={$filename}");
        header("Content-Type: application/csv;");
    
        $output = fopen('php://output', 'w');
    
        // Write CSV headers
        if (!empty($data)) {
            fputcsv($output, array_keys($data[0])); // Use the first row to get column names
        }
    
        // Write CSV rows
        foreach ($data as $row) {
            fputcsv($output, $row);
        }
    
        // Close output stream
        fclose($output);
        exit();
    }

    public function pilihMuatTurun()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }elseif(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model(['pengguna_model', 'peranan_model']);
        $this->load->model('sentimen_model');
        $this->load->model('daerah_model');
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $data['dataDaerah'] = $this->daerah_model;
        $data['dataParlimen'] = $this->parlimen_model;
        $data['dataDun'] = $this->dun_model;
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'LAPIS' :
                $data = array_merge($data, $this->susunletak('us_lapis_na'));
                $data['senaraiLks'] = $this->sentimen_model->semua();
                break;
            case 'PPD' :
                $senaraiPeranan = $this->peranan_model->senaraiPeranan($penggunaBil);
                $data = array_merge($data, $this->susunletak('ppd_na'));
                $data = array_merge($data, [
                    'senaraiPelapor' => $this->sentimen_model->pelaporPeranan($senaraiPeranan),
                    'senaraiNegeri' => $this->sentimen_model->negeriPeranan($senaraiPeranan),
                    'senaraiDaerah' => $this->sentimen_model->daerahPeranan($senaraiPeranan),
                    'senaraiParlimen' => $this->sentimen_model->parlimenPeranan($senaraiPeranan),
                    'senaraiDun' => $this->sentimen_model->dunPeranan($senaraiPeranan),
                    'senaraiKawasan' => $this->sentimen_model->kawasanPeranan($senaraiPeranan),
                    'senaraiPekerjaan' => $this->sentimen_model->pekerjaanPeranan($senaraiPeranan),
                    'senaraiUmur' => $this->sentimen_model->umurPeranan($senaraiPeranan),
                    'senaraiKaum' => $this->sentimen_model->kaumPeranan($senaraiPeranan),
                    'senaraiJantina' => $this->sentimen_model->jantinaPeranan($senaraiPeranan),
                    'senaraiSentimen' => $this->sentimen_model->sentimenPeranan($senaraiPeranan)
                ]);
                break;
            case 'NEGERI' :
                $data = array_merge($data, $this->susunletak('negeri_na'));
                $this->load->model('negeri_model');
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiLks'] = $this->sentimen_model->senaraiNegeri($senaraiNegeri);
                break;
            default :
                redirect(base_url());
        }

        $this->load->view('lpk/pilihMuatTurun', $data);
        
    }

    public function mengikutSenaraiAnggota()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $perananBil = $this->session->userdata('peranan_bil');
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }elseif(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $this->load->model('sentimen_model');
        $this->load->model('daerah_model');
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $data['dataDaerah'] = $this->daerah_model;
        $data['dataParlimen'] = $this->parlimen_model;
        $data['dataDun'] = $this->dun_model;
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'LAPIS' :
                $data['senaraiLks'] = $this->sentimen_model->semua();
                $this->load->view('us_lapis_na/sentimen/senarai', $data);
                break;
            case 'PPD' :
                $data['senaraiLks'] = $this->sentimen_model->senaraiIkutPeranan($perananBil);
                $this->load->view('ppd_na/sentimen/senarai', $data);
                break;
            case 'NEGERI' :
                $this->load->model('negeri_model');
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($data['pengguna']->pengguna_peranan_bil);
                $data['senaraiLks'] = $this->sentimen_model->senaraiNegeri($senaraiNegeri);
                $this->load->view('negeri_na/lapis/sentimen/senarai', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function senarai()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $perananBil = $this->session->userdata('peranan_bil');
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }elseif(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $this->load->model('sentimen_model');
        $this->load->model('daerah_model');
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $data['dataDaerah'] = $this->daerah_model;
        $data['dataParlimen'] = $this->parlimen_model;
        $data['dataDun'] = $this->dun_model;
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'LAPIS' :
                $data['senaraiLks'] = $this->sentimen_model->semua();
                $this->load->view('us_lapis_na/sentimen/senarai', $data);
                break;
            case 'PPD' :
                $tahun = date("Y");
                $data['senaraiLks'] = $this->sentimen_model->senaraiIkutIndividu($penggunaBil, $tahun);
                $this->load->view('ppd_na/sentimen/senarai', $data);
                break;
            case 'NEGERI' :
                $tahun = date("Y");
                $data['senaraiLks'] = $this->sentimen_model->senaraiIkutIndividu($penggunaBil, $tahun);
                $this->load->view('negeri_na/lapis/sentimen/senarai', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function prosesTambah()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
    if (strpos($sesi, 'PPD') !== FALSE) {
        $sesi = 'PPD';
    } elseif (strpos($sesi, 'NEGERI') !== FALSE) {
        $sesi = 'NEGERI';
    }

    // Only allow PPD and NEGERI to proceed
    if (in_array($sesi, ['PPD', 'NEGERI'])) {
        $this->load->library('form_validation');
        $this->load->model('sentimen_model');

        // Validation rules
        $this->form_validation->set_rules('inputTarikhLaporan', 'Tarikh Laporan', 'required');
        $this->form_validation->set_rules('inputPelaporBil', 'Pelapor', 'required');
        $this->form_validation->set_rules('inputDaerahBil', 'Daerah', 'required');
        $this->form_validation->set_rules('inputSentimen', 'Pilihan Sentimen', 'required');
        $this->form_validation->set_rules('inputAlasan', 'Alasan Sentimen', 'required');

        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
        $this->form_validation->set_message('required', 'Sila penuhi ruangan {field}');

        // Validate form
        if ($this->form_validation->run() === FALSE) {
            $this->borang();
        } else {
            $this->sentimen_model->tambah();
            redirect('sentimen/senarai', 'refresh');
        }
    } else {
        // Redirect unauthorized access
        redirect(base_url());
    }
    }

    public function borang()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        $perananBil = $this->session->userdata('peranan_bil');
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }elseif(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model('pengguna_model');
        $this->load->model(['negeri_model', 'daerah_model']);
        $this->load->model('parlimen_model');
        $this->load->model('dun_model');
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        switch($sesi){
            case 'NEGERI' :
                $senaraiNegeri = $this->negeri_model->senaraiTugasanNegeri($perananBil);
                $data['senaraiPelapor'] = $this->pengguna_model->senarai_pelapor($perananBil);
                $data['senaraiDaerah'] = $this->daerah_model->senaraiDaerah($senaraiNegeri);
                $data['senaraiParlimen'] = $this->parlimen_model->senaraiParlimenNegeri($senaraiNegeri);
                $data['senaraiDun'] = $this->dun_model->senaraiDunNegeri($senaraiNegeri);
                $viewPath = 'negeri_na';
                $data['header'] = "$viewPath/susunletak/atas";
                $data['sidebar'] = "$viewPath/susunletak/sidebar";
                $data['navbar'] = "$viewPath/susunletak/navbar";
                $data['footer'] = "$viewPath/susunletak/bawah";
                $this->load->view('lpk/borang', $data);
                break;
            case 'PPD' :
                $data['senaraiPelapor'] = $this->pengguna_model->senarai_pelapor($perananBil);
                $data['senaraiDaerah'] = $this->daerah_model->senaraiTugasanDaerah($perananBil);
                $data['senaraiParlimen'] = $this->parlimen_model->senaraiTugasanParlimen($perananBil);
                $data['senaraiDun'] = $this->dun_model->senaraiTugasanDun($perananBil);
                $this->load->view('ppd_na/sentimen/borang', $data);
                break;
            default :
                redirect(base_url());
        }
    }

    public function index()
    {
        $sesi = strtoupper($this->session->userdata('peranan'));
        $penggunaBil = $this->session->userdata('pengguna_bil');
        if(strpos($sesi, 'PPD') !== FALSE){
            $sesi = 'PPD';
        }elseif(strpos($sesi, 'NEGERI') !== FALSE){
            $sesi = 'NEGERI';
        }
        $this->load->model(['pengguna_model', 'sentimen_model']);
        $data['pengguna'] = $this->pengguna_model->pengguna($penggunaBil);
        $tahun = date('Y');
        switch($sesi){
            case 'LAPIS' :
                $data['nav'] = 'us_lapis_na/sentimen/nav';
                $data['senaraiNegeri'] = $this->sentimen_model->rumusanIkutNegeri($tahun);
                $this->load->view('us_lapis_na/sentimen/utama', $data);
                break;
            case 'NEGERI' :
                $this->load->view('negeri_na/sentimen/utama', $data);
                break;
            case 'PPD' :
                $this->load->model('sentimen_model');
                $data['senaraiPelapor'] = $this->sentimen_model->senaraiLaporanMengikutPelapor($data['pengguna']->pengguna_peranan_bil, $tahun);
                $data['senaraiBilanganLaporan'] = $this->sentimen_model->senaraiBilanganLaporan($data["pengguna"]->pengguna_peranan_bil, $tahun);
                $this->load->view('ppd_na/sentimen/utama', $data);
                break;
            default :
                redirect(base_url());
        }
    }

}
?>