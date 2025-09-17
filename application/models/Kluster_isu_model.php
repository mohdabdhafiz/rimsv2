<?php

class Kluster_isu_model extends CI_Model {

    /**
     * Mendapatkan nama kluster berdasarkan nombor siri (ID).
     * @param int $kluster_bil Nombor siri kluster.
     * @return string|null Nama kluster atau null jika tidak dijumpai.
     */
    public function dapatkan_nama($kluster_bil)
    {
        $this->db->select('kit_nama');
        $this->db->where('kit_bil', $kluster_bil);
        $query = $this->db->get('kluster_isu_tb'); // Pastikan nama jadual betul
        $result = $query->row();

        if ($result) {
            return $result->kit_nama;
        }
        return 'Kluster Tidak Dinamakan'; // Nilai lalai jika tidak dijumpai
    }

    /**
     * Mengira bilangan laporan hari ini untuk setiap kluster.
     * Menggunakan LEFT JOIN untuk memastikan semua kluster dipaparkan, walaupun tiada laporan.
     * @return array
     */
    public function bilangan_laporan_harian_per_kluster()
    {
        $tarikh_hari_ini = date('Y-m-d');

        $this->db->select([
            'kluster_isu_tb.kit_nama',
            'kluster_isu_tb.kit_shortform',
            'COUNT(lapis_tb.lapis_bil) as bilangan_hari_ini' // Mengira laporan dari lapis_tb
        ]);

        $this->db->from('kluster_isu_tb');

        // Guna LEFT JOIN untuk sertakan kluster dengan 0 laporan
        $this->db->join('lapis_tb', 
            "lapis_tb.lapis_kluster_bil = kluster_isu_tb.kit_bil AND lapis_tb.lapis_tarikh_laporan = '{$tarikh_hari_ini}'", 
            'left'
        );

        $this->db->group_by('kluster_isu_tb.kit_bil');
        $this->db->order_by('kluster_isu_tb.kit_nama', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    //======================================================================
    // FUNGSI BARU DITAMBAH DI SINI
    //======================================================================

    /**
     * Mendapatkan satu baris data kluster berdasarkan ID (bil).
     * Ini adalah alias untuk fungsi papar($bil) untuk konsistensi.
     *
     * @param int $bil ID kluster (kit_bil).
     * @return object Data kluster.
     */
    public function satu_data($bil)
    {
        // Memanggil fungsi 'papar' yang sedia ada.
        return $this->papar($bil);
    }

    //======================================================================
    // FUNGSI SEDIA ADA ANDA
    //======================================================================

    public function senaraiCarianTerperinci($table){
        $tarikhMula = $this->input->post("inputTarikhMula");
        $tarikhTamat = $this->input->post("inputTarikhTamat");
        $pelaporBil = $this->input->post("inputPelapor");
        $negeriBil = $this->input->post("inputNegeri");
        $daerahBil = $this->input->post("inputDaerah");
        $parlimenBil = $this->input->post("inputParlimen");
        $dunBil = $this->input->post("inputDun");
        $jenisKawasan = $this->input->post("inputKawasan");
        $klusterBil = $this->input->post("inputKluster");
        $column = [
            "UPPER(kluster_isu_tb.kit_nama) AS klusterNama", 
            "$table.pengguna_waktu AS laporanTimestamp", 
            'UPPER(pengguna_tb.nama_penuh) AS pelaporNama', 
            'UPPER(negeri_tb.nt_nama) AS negeriNama', 
            'UPPER(daerah.nama) AS daerahNama', 
            'UPPER(parlimen_tb.pt_nama) AS parlimenNama', 
            'UPPER(dun_tb.dun_nama) AS dunNama', 
            "UPPER($table.jenis_kawasan) AS laporanKawasan", 
            "UPPER($table.lokasi_isu) AS laporanIsu", 
            "$table.ringkasan_isu AS laporanRingkasanIsu", 
            "UPPER($table.lokasi_isu) AS laporanLokasi", 
            "$table.cadangan_intervensi AS laporanIntervensi" 
        ];
        $this->db->select($column);
        $this->db->join('pengguna_tb', "pengguna_tb.bil = $table.pelapor", 'left');
        $this->db->join('daerah', "daerah.bil = $table.daerah", 'left');
        $this->db->join('parlimen_tb', "parlimen_tb.pt_bil = $table.parlimen", 'left');
        $this->db->join('dun_tb', "dun_tb.dun_bil = $table.dun", 'left');
        $this->db->join('pdm_parlimen_tb', "pdm_parlimen_tb.ppt_bil = $table.pdm", 'left');
        $this->db->join('kluster_isu_tb', "kluster_isu_tb.kit_bil = $table.kluster_bil", 'left');
        $this->db->join('negeri_tb', "negeri_tb.nt_bil = daerah.negeri_bil", 'left');
        if(!empty($tarikhMula)){
            $this->db->where("$table.pengguna_waktu >=", $tarikhMula);
        }
        if(!empty($tarikhTamat)){
            $this->db->where("$table.pengguna_waktu <=", $tarikhTamat);
        }
        if(!empty($pelaporBil)){
            $this->db->where("pengguna_tb.bil", $pelaporBil);
        }
        if(!empty($negeriBil)){
            $this->db->where("negeri_tb.nt_bil", $negeriBil);
        }
        if(!empty($daerahBil)){
            $this->db->where("daerah.bil", $daerahBil);
        }
        if(!empty($parlimenBil)){
            $this->db->where("parlimen_tb.pt_bil", $parlimenBil);
        }
        if(!empty($dunBil)){
            $this->db->where("dun_tb.dun_bil", $dunBil);
        }
        if(!empty($jenisKawasan)){
            $this->db->where("$table.jenis_kawasan", $jenisKawasan);
        }
        if(!empty($klusterBil)){
            $this->db->where("kluster_isu_tb.kit_bil", $klusterBil);
        }
        $query = $this->db->get($table);
        return $query->result();
    }

    public function senaraiTable($tahun, $pelaporBil, $klusterShortForm){
        $senaraiTable = array();
        $nama_table = $klusterShortForm.'_'.$pelaporBil.'_'.$tahun;
        if($this->db->table_exists($nama_table)){
            $senaraiTable = array_merge($senaraiTable, [$nama_table]);
        }
        return $senaraiTable;
    }

    public function senaraiKlusterCarian(){
        $column = [
            'kluster_isu_tb.kit_bil AS kitBil', 
            'UPPER(kluster_isu_tb.kit_nama) AS kitNama'
        ];
        $this->db->select($column);
        $this->db->order_by("kitNama", "ASC");
        $query = $this->db->get("kluster_isu_tb");
        return $query->result();
    }

    public function laporan2($kluster_shortform, $pelapor_bil, $tahun, $laporan_bil)
    {
        $nama_table = $kluster_shortform.'_'.$pelapor_bil.'_'.$tahun;
        if($this->db->table_exists($nama_table)){
            $this->db->select("$nama_table.tarikh_laporan AS tarikhLaporan");
            $this->db->select("pengguna_tb.nama_penuh AS pelaporNama");
            $this->db->select("negeri_tb.nt_nama AS negeri");
            $this->db->select("daerah.nama AS daerah");
            $this->db->select("parlimen_tb.pt_nama AS parlimen");
            $this->db->select("dun_tb.dun_nama AS dun");  
            $this->db->select("pdm_parlimen_tb.ppt_nama AS dm");
            $this->db->select("kluster_isu_tb.kit_nama AS kluster");
            $this->db->select("$nama_table.bil AS laporanBil");
            $this->db->select("$nama_table.pelapor AS pelaporBil");
            $this->db->select("$nama_table.jenis_kawasan");
            $this->db->select("$nama_table.lokasi_isu");
            $this->db->select("$nama_table.latitude");
            $this->db->select("$nama_table.longitude");
            $this->db->select("$nama_table.ringkasan_isu");
            $this->db->select("$nama_table.cadangan_intervensi");
            $this->db->select("$nama_table.pengguna_waktu");
            if($kluster_shortform == "politik"){
                $this->db->select("$nama_table.isu_politik");
            }
            $this->db->join('pengguna_tb', "pengguna_tb.bil = $nama_table.pelapor", 'left');
            $this->db->join('daerah', "daerah.bil = $nama_table.daerah", 'left');
            $this->db->join('parlimen_tb', "parlimen_tb.pt_bil = $nama_table.parlimen", 'left');
            $this->db->join('dun_tb', "dun_tb.dun_bil = $nama_table.dun", 'left');
            $this->db->join('pdm_parlimen_tb', "pdm_parlimen_tb.ppt_bil = $nama_table.pdm", 'left');
            $this->db->join('kluster_isu_tb', "kluster_isu_tb.kit_bil = $nama_table.kluster_bil", 'left');
            $this->db->join('negeri_tb', "negeri_tb.nt_bil = daerah.negeri_bil", 'left');
            $this->db->where("$nama_table.bil", $laporan_bil);
            $query = $this->db->get($nama_table);
            return $query->row();
        }
    }

    public function hasilCarianPpd($pelapor_bil, $kluster_shortform, $senaraiDaerah, $senaraiParlimen, $senaraiDun, $tahun){
        $nama_table = $kluster_shortform.'_'.$pelapor_bil.'_'.$tahun;
        $teleRangkaian = 'telekomunikasi_rangkaian_'.$pelapor_bil.'_'.$tahun;
        $barangNaik = 'ekonomi_kenaikan_harga_'.$pelapor_bil.'_'.$tahun;
        $bekalanKurang = 'ekonomi_kekurangan_barangan_'.$pelapor_bil.'_'.$tahun;
        if($this->db->table_exists($nama_table)){
            $this->db->select('*');
            $this->db->select($nama_table.'.pengguna_waktu AS tarikhLaporan');
            $this->db->select($nama_table.'.bil AS laporanBil');
            if($kluster_shortform == 'ekonomi'){
                $this->db->select("(
                    SELECT GROUP_CONCAT(naik1.jenis_barangan SEPARATOR ', ') 
                    FROM ".$barangNaik." AS naik1 
                    WHERE naik1.laporan_bil = ".$nama_table.".bil
                    ) AS 'senaraiBarangNaik'");
                $this->db->select("(
                    SELECT GROUP_CONCAT(kurang1.jenis_barangan SEPARATOR ', ') 
                    FROM ".$bekalanKurang." AS kurang1 
                    WHERE kurang1.laporan_bil = ".$nama_table.".bil
                    ) AS 'senaraiBarangKurang'");
            } 
            $this->db->join('daerah', 'daerah.bil = '.$nama_table.'.daerah', 'left');
            $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = '.$nama_table.'.parlimen', 'left');
            $this->db->join('dun_tb', 'dun_tb.dun_bil = '.$nama_table.'.dun', 'left');
            $this->db->join('pengguna_tb', 'pengguna_tb.bil = '.$nama_table.'.pelapor', 'left');
            $this->db->join('kluster_isu_tb', 'kluster_isu_tb.kit_bil = '.$nama_table.'.kluster_bil', 'left');
            if($kluster_shortform == 'telekomunikasi'){
                $this->db->join($teleRangkaian, $teleRangkaian.'.telekomunikasi = '.$nama_table.'.bil', 'left');
            }
            $this->db->where('YEAR('.$nama_table.'.pengguna_waktu) >=', date_format(date_create($tahun), 'Y'));
            foreach($senaraiDaerah as $daerah){
                $this->db->or_where('daerah.bil', $daerah->bil);
            }
            foreach($senaraiParlimen as $parlimen){
                $this->db->or_where('parlimen_tb.pt_bil', $parlimen->pt_bil);
            }
            foreach($senaraiDun as $dun){
                $this->db->or_where('dun_tb.dun_bil', $dun->dun_bil);
            }
            $this->db->order_by($nama_table.'.pengguna_waktu', 'DESC');
            $query = $this->db->get($nama_table);
            return $query->result();
        }
    }

    public function hasilCarianUrusetiaKluster($negeriBil, $kluster_shortform, $pelapor_bil, $tahun)
    {
        $nama_table = $kluster_shortform.'_'.$pelapor_bil.'_'.$tahun;
        if($this->db->table_exists($nama_table)){
            $this->db->select('*');
            $this->db->select($nama_table.'.pengguna_waktu AS tarikhLaporan');
            $this->db->select($nama_table.'.bil AS laporanBil');
            $this->db->join('daerah', 'daerah.bil = '.$nama_table.'.daerah', 'left');
            $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = '.$nama_table.'.parlimen', 'left');
            $this->db->join('dun_tb', 'dun_tb.dun_bil = '.$nama_table.'.dun', 'left');
            $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil OR negeri_tb.nt_nama = parlimen_tb.pt_negeri OR negeri_tb.nt_nama = dun_tb.dun_negeri');
            $this->db->join('pengguna_tb', 'pengguna_tb.bil = '.$nama_table.'.pelapor', 'left');
            $this->db->join('pdm_parlimen_tb', 'pdm_parlimen_tb.ppt_bil = '.$nama_table.'.pdm', 'left');
            $this->db->join('kluster_isu_tb', "kluster_isu_tb.kit_bil = $nama_table.kluster_bil", 'left');
            //$this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
            //$this->db->where('YEAR(pengguna_waktu) >=', date_format(date_create($tahun), 'Y'));
            $this->db->where('negeri_tb.nt_bil', $negeriBil);
            $this->db->order_by('tarikhLaporan', 'DESC');
            $query = $this->db->get($nama_table);
            return $query->result();
        }
    }

    public function hasilCarianUrusetia($negeriBil, $kluster_shortform, $pelapor_bil, $tahun)
    {
        $nama_table = $kluster_shortform.'_'.$pelapor_bil.'_'.$tahun;
        if($this->db->table_exists($nama_table)){
            $this->db->select('*');
            $this->db->select($nama_table.'.pengguna_waktu AS tarikhLaporan');
            $this->db->select($nama_table.'.bil AS laporanBil');
            $this->db->join('daerah', 'daerah.bil = '.$nama_table.'.daerah', 'left');
            $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = '.$nama_table.'.parlimen', 'left');
            $this->db->join('dun_tb', 'dun_tb.dun_bil = '.$nama_table.'.dun', 'left');
            $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil OR negeri_tb.nt_nama = parlimen_tb.pt_negeri OR negeri_tb.nt_nama = dun_tb.dun_negeri');
            $this->db->join('pengguna_tb', 'pengguna_tb.bil = '.$nama_table.'.pelapor', 'left');
            $this->db->join('pdm_parlimen_tb', 'pdm_parlimen_tb.ppt_bil = '.$nama_table.'.pdm', 'left');
            //$this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
            //$this->db->where('YEAR(pengguna_waktu) >=', date_format(date_create($tahun), 'Y'));
            $this->db->where('negeri_tb.nt_bil', $negeriBil);
            $this->db->order_by('tarikhLaporan', 'DESC');
            $query = $this->db->get($nama_table);
            return $query->result();
        }
    }

    public function kluster($klusterBil){
        $this->db->where('kluster_isu_tb.kit_bil', $klusterBil);
        $query = $this->db->get('kluster_isu_tb');
        return $query->row();
    }

    public function carianSenaraiLaporanNegeri($negeriBil, $daerahBil, $parlimenBil, $dunBil, $kluster_shortform, $pelapor_bil, $tahun, $status, $tarikhMula, $tarikhTamat)
    {
        $nama_table = $kluster_shortform.'_'.$pelapor_bil.'_'.$tahun;
        if($this->db->table_exists($nama_table)){
            $this->db->select('*');
            $this->db->select($nama_table.'.bil AS laporanBil');
            $this->db->join('daerah', 'daerah.bil = '.$nama_table.'.daerah', 'left');
            $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = '.$nama_table.'.parlimen', 'left');
            $this->db->join('dun_tb', 'dun_tb.dun_bil = '.$nama_table.'.dun', 'left');
            $this->db->where($nama_table.'.tapisan', $status);
            $this->db->where('daerah.negeri_bil', $negeriBil);
            if(!empty($daerahBil)){
                $this->db->where('daerah.bil', $daerahBil);
            }
            if(!empty($parlimenBil)){
                $this->db->where('parlimen_tb.pt_bil', $parlimenBil);
            }
            if(!empty($dunBil)){
                $this->db->where('dun_tb.dun_bil', $dunBil);
            }
            $this->db->where('DATE('.$nama_table.'.pengguna_waktu) >=', date_format(date_create($tarikhMula), 'Y-m-d'));
            $this->db->where('DATE('.$nama_table.'.pengguna_waktu) <=', date_format(date_create($tarikhTamat), 'Y-m-d'));
            $query = $this->db->get($nama_table);
            return $query->result();
        }
    }
    
    public function senaraiPelapor(){
        $this->db->select('bil');
        $query = $this->db->get('pengguna_tb');
        return $query->result();
    }

    public function carianLaporan()
    {
        $bilKluster = $this->input->post('inputKluster');
        $tarikhMula = $this->input->post('inputTarikhMula');
        $tarikhTamat = $this->input->post('inputTarikhTamat');
        $bilNegeri = $this->input->post('inputNegeriBil');
        $daerahBil = $this->input->post('inputDaerah');
        $parlimenBil = $this->input->post('inputParlimen');
        $dunBil = $this->input->post('inputDun');
        $tahunMula = date_format(date_create($tarikhMula), 'Y');
        $tahunTamat = date_format(date_create($tarikhTamat), 'Y');
        $kluster = $this->papar($bilKluster);
        $senaraiPelapor = $this->senaraiPelapor();
        $senaraiLaporan = array();
        foreach($senaraiPelapor as $pelapor){
            for($i = $tahunMula; $i <= $tahunTamat; $i++){
                $senaraiLaporanKluster = $this->carianSenaraiLaporan($daerahBil, $parlimenBil, $dunBil, $kluster->kit_shortform, $pelapor->bil, $i, 'Terima', $tarikhMula, $tarikhTamat);
                if(!empty($bilNegeri)){
                    $senaraiLaporanKluster = $this->carianSenaraiLaporanNegeri($bilNegeri, $daerahBil, $parlimenBil, $dunBil, $kluster->kit_shortform, $pelapor->bil, $i, 'Terima', $tarikhMula, $tarikhTamat);
                }
                if(!empty($senaraiLaporanKluster)){
                    $senaraiLaporan = array_merge($senaraiLaporan, $senaraiLaporanKluster);
                }
            }
        }
        return $senaraiLaporan;

    }

    public function carianSenaraiLaporan($daerahBil, $parlimenBil, $dunBil, $kluster_shortform, $pelapor_bil, $tahun, $status, $tarikhMula, $tarikhTamat)
    {
        $nama_table = $kluster_shortform.'_'.$pelapor_bil.'_'.$tahun;
        if($this->db->table_exists($nama_table)){
            $this->db->select('*');
            $this->db->select($nama_table.'.bil AS laporanBil');
            $this->db->join('daerah', 'daerah.bil = '.$nama_table.'.daerah', 'left');
            $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = '.$nama_table.'.parlimen', 'left');
            $this->db->join('dun_tb', 'dun_tb.dun_bil = '.$nama_table.'.dun', 'left');
            $this->db->where($nama_table.'.tapisan', $status);
            $this->db->where('DATE(pengguna_waktu) >=', date_format(date_create($tarikhMula), 'Y-m-d'));
            $this->db->where('DATE(pengguna_waktu) <=', date_format(date_create($tarikhTamat), 'Y-m-d'));
            if(!empty($daerahBil)){
                $this->db->where('daerah.bil', $daerahBil);
            }
            if(!empty($parlimenBil)){
                $this->db->where('parlimen_tb.pt_bil', $parlimenBil);
            }
            if(!empty($dunBil)){
                $this->db->where('dun_tb.dun_bil', $dunBil);
            }
            $this->db->order_by('pengguna_waktu', 'DESC');
            $query = $this->db->get($nama_table);
            return $query->result();
        }
    }

    public function senaraiLaporan($kluster_shortform, $pelapor_bil, $tahun, $status)
    {
        $nama_table = $kluster_shortform.'_'.$pelapor_bil.'_'.$tahun;
        if($this->db->table_exists($nama_table)){
            $this->db->select('*');
            $this->db->select($nama_table.'.bil AS laporanBil');
            $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = '.$nama_table.'.parlimen', 'left');
            $this->db->join('dun_tb', 'dun_tb.dun_bil = '.$nama_table.'.dun', 'left');
            $this->db->where($nama_table.'.tapisan', $status);
            $query = $this->db->get($nama_table);
            return $query->result();
        }
    }

    public function tambahColumnCadanganIntervensi($kluster_shortform, $pelapor_bil, $tahun){
        $this->load->dbforge();
        $nama_table = $kluster_shortform.'_'.$pelapor_bil.'_'.$tahun;
        if($this->db->table_exists($nama_table)){
            if(!$this->db->field_exists('cadangan_intervensi', $nama_table)){
                $fieldNegeri = array(
                    'cadangan_intervensi' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($nama_table, $fieldNegeri);
            }
        }
    }

    public function ada($klusterShortForm, $pelaporBil, $tahunLaporan){
        $namaTable = $klusterShortForm.'_'.$pelaporBil.'_'.$tahunLaporan;
        if($this->db->table_exists($namaTable)){
            $query = $this->db->get($namaTable);
            return $query->result();
        }else{
            return FALSE;
        }
    }

    public function masukNegeri($klusterShortForm, $pelaporBil, $tahunLaporan, $laporanBil, $negeriBil){
        $namaTable = $klusterShortForm.'_'.$pelaporBil.'_'.$tahunLaporan;
        if($this->db->table_exists($namaTable)){
            $data = array(
                'negeri' => $negeriBil
            );
            $this->db->where('bil', $laporanBil);
            $this->db->update($namaTable, $data);
        }
    }

    public function tambahColumnNegeri($kluster_shortform, $pelapor_bil, $tahun){
        $this->load->dbforge();
        $nama_table = $kluster_shortform.'_'.$pelapor_bil.'_'.$tahun;
        if($this->db->table_exists($nama_table)){
            if(!$this->db->field_exists('negeri', $nama_table)){
                $fieldNegeri = array(
                    'negeri' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($nama_table, $fieldNegeri);
            }
        }
    }

    public function senaraiPenuhLaporan($kluster_shortform, $pelapor_bil, $tahun)
    {
        $nama_table = $kluster_shortform.'_'.$pelapor_bil.'_'.$tahun;
        if($this->db->table_exists($nama_table)){
            $this->db->select('*');
            $query = $this->db->get($nama_table);
            return $query->result();
        }
    }

    public function padam($kluster_shortform, $pelapor_bil, $tahun, $laporan_bil)
    {
        $nama_table = $kluster_shortform.'_'.$pelapor_bil.'_'.$tahun;
        if($this->db->table_exists($nama_table)){
            $this->db->where('bil', $laporan_bil);
            $this->db->delete($nama_table);
            return TRUE;
        }
        
        return FALSE;
    }

    public function laporan($kluster_shortform, $pelapor_bil, $tahun, $laporan_bil)
    {
        $nama_table = $kluster_shortform.'_'.$pelapor_bil.'_'.$tahun;
        if($this->db->table_exists($nama_table)){
            $this->db->select('*');
            $this->db->where('bil', $laporan_bil);
            $query = $this->db->get($nama_table);
            return $query->row();
        }
    }

    public function tahun_ini_terima($nama_kluster, $pelapor_bil, $tahun)
    {
        if($this->db->table_exists($nama_kluster.'_'.$pelapor_bil.'_'.$tahun) != FALSE){
            $this->db->select('1');
            $this->db->where('tapisan', 'Terima');
            $query = $this->db->get($nama_kluster.'_'.$pelapor_bil.'_'.$tahun);
            return $query->result();
        }
    }

    public function bulan_ini_terima($nama_kluster, $pelapor_bil, $tahun, $bulan)
    {
        if($this->db->table_exists($nama_kluster.'_'.$pelapor_bil.'_'.$tahun) != FALSE){
            $this->db->select('1');
            $this->db->where('MONTH(tarikh_laporan)', date_format(date_create($bulan), 'm'));
            $this->db->where('tapisan', 'Terima');
            $query = $this->db->get($nama_kluster.'_'.$pelapor_bil.'_'.$tahun);
            return $query->result();
        }
    }

    public function minggu_ini_terima($nama_kluster, $pelapor_bil, $tahun, $tarikh)
    {
        if($this->db->table_exists($nama_kluster.'_'.$pelapor_bil.'_'.$tahun) != FALSE){
            $this->db->select('1');
            //$this->db->where('WEEK(tarikh_laporan)', date('W'));
            $this->db->where('WEEK(tarikh_laporan)', date_format(date_create($tarikh), 'W'));
            $this->db->where('tapisan', 'Terima');
            $query = $this->db->get($nama_kluster.'_'.$pelapor_bil.'_'.$tahun);
            return $query->result();
        }
    }


    public function hari_ini_terima($nama_kluster, $pelapor_bil, $tahun, $tarikh)
    {
        if($this->db->table_exists($nama_kluster.'_'.$pelapor_bil.'_'.$tahun) != FALSE){
            $this->db->select('*');
            $this->db->where('DATE(tarikh_laporan)', date_format(date_create($tarikh), 'Y-m-d'));
            $this->db->where('tapisan', 'Terima');
            $query = $this->db->get($nama_kluster.'_'.$pelapor_bil.'_'.$tahun);
            return $query->result();
        }
    }

    public function minggu_ini($nama_kluster, $pelapor_bil, $tahun, $minggu){
        $namaTable = $nama_kluster.'_'.$pelapor_bil.'_'.$tahun;
        if($this->db->table_exists($namaTable) !== FALSE){
            $this->db->from($namaTable);
            $this->db->where('WEEK(tarikh_laporan,1)', $minggu);
            $this->db->where('YEAR(tarikh_laporan)', $tahun);
            return $this->db->count_all_results();
        }
    }

    public function bulan_ini($nama_kluster, $pelapor_bil, $tahun, $bulan)
    {
        if($this->db->table_exists($nama_kluster.'_'.$pelapor_bil.'_'.$tahun) != FALSE){
            $this->db->select('1');
            $this->db->where('MONTH(tarikh_laporan)', date_format(date_create($bulan), 'm'));
            $query = $this->db->get($nama_kluster.'_'.$pelapor_bil.'_'.$tahun);
            return $query->result();
        }
    }

    public function tahun_ini($nama_kluster, $pelapor_bil, $tahun)
    {
        if($this->db->table_exists($nama_kluster.'_'.$pelapor_bil.'_'.$tahun) != FALSE){
            $this->db->select('1');
            $query = $this->db->get($nama_kluster.'_'.$pelapor_bil.'_'.$tahun);
            return $query->result();
        }
    }

    public function hari_ini($nama_kluster, $pelapor_bil, $tahun, $tarikh)
    {
        if($this->db->table_exists($nama_kluster.'_'.$pelapor_bil.'_'.$tahun) != FALSE){
            $this->db->select('1');
            $this->db->where('DATE(tarikh_laporan)', date_format(date_create($tarikh), 'Y-m-d'));
            $query = $this->db->get($nama_kluster.'_'.$pelapor_bil.'_'.$tahun);
            return $query->result();
        }
    }

    public function ikut_shortform($sf)
    {
        $this->db->select('kit_bil');
        $this->db->select('kit_nama');
        $this->db->select('kit_deskripsi');
        $this->db->where('kit_shortform', $sf);
        $query = $this->db->get('kluster_isu_tb');
        return $query->row();
    }

    public function kemaskini()
    {
        $data = array(
            'kit_nama' => $this->input->post('input_nama'),
            'kit_deskripsi' => $this->input->post('input_deskripsi')
        );
        $this->db->where('kit_bil', $this->input->post('input_bil'));
        $this->db->update('kluster_isu_tb', $data);
    }

    public function padam_ki(){
        $this->db->where('kit_bil', $this->input->post('input_bil'));
        $this->db->delete('kluster_isu_tb');
    }

    public function papar($bil)
    {
        $this->db->select('kit_bil');
        $this->db->select('kit_nama');
        $this->db->select('kit_deskripsi');
        $this->db->select('kit_shortform');
        $this->db->where('kit_bil', $bil);
        $query = $this->db->get('kluster_isu_tb');
        return $query->row();
    }

    public function senarai_penuh()
    {
        $query = $this->db->get('kluster_isu_tb');
        return $query->result();
    }

    public function senarai()
    {
        $this->db->select('kit_bil');
        $this->db->select('kit_nama');
        $this->db->select('kit_deskripsi');
        $this->db->select('kit_shortform');
        $query = $this->db->get('kluster_isu_tb');
        return $query->result();
    }

    public function tambah_kluster_isu()
    {
        $data = array(
            'kit_nama' => $this->input->post('input_nama'),
            'kit_deskripsi' => $this->input->post('input_deskripsi'),
            'kit_shortform' => $this->input->post('input_shortform'),
            'kit_pengguna' => $this->input->post('input_pengguna_bil'),
            'kit_pengguna_waktu' => $this->input->post('input_pengguna_waktu')
        );
        $this->db->insert('kluster_isu_tb', $data);
    }

}

?>