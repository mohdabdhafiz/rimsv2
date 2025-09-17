<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Isu_ekonomi_model extends CI_Model
{


    public function senarai_kekurangan_bekalan($tahun, $pelapor, $bil)
    {
        $this->checkTableExists($pelapor, $tahun);
        $this->db->where('laporan_bil', $bil);
        $query = $this->db->get('ekonomi_kekurangan_barangan_'.$pelapor.'_'.$tahun);
        return $query->result();
    }

    public function senarai_kenaikan_harga($tahun, $pelapor, $bil)
    {
        $this->checkTableExists($pelapor, $tahun);
        $namaTable = 'ekonomi_'.$pelapor.'_'.$tahun;
        if($this->db->table_exists($namaTable) == TRUE){
            $this->db->where('laporan_bil', $bil);
            $query = $this->db->get('ekonomi_kenaikan_harga_'.$pelapor.'_'.$tahun);
            return $query->result();
        }
    }

    public function senarai_laporan($pelapor, $tahun)
    {
        $namaTable = 'ekonomi_'.$pelapor.'_'.$tahun;
        if($this->db->table_exists('ekonomi_'.$pelapor.'_'.$tahun) != FALSE){
            $this->db->select('*');
            $this->db->select($namaTable.'.bil AS laporanBil');
            $this->db->join('daerah', 'daerah.bil = '.$namaTable.'.daerah', 'left');
            $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
            $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = '.$namaTable.'.parlimen', 'left');
            $this->db->join('dun_tb', 'dun_tb.dun_bil = '.$namaTable.'.dun', 'left');
            $this->db->join('pdm_parlimen_tb', 'pdm_parlimen_tb.ppt_bil = '.$namaTable.'.pdm', 'left');
            $query = $this->db->get('ekonomi_'.$pelapor.'_'.$tahun);
            return $query->result();
        }
    }

    public function tambah()
    {
        $pelapor = $this->input->post('input_pelapor');
        if(empty($pelapor)){
            redirect(base_url());
        }
        $isuEkonomi = "";
        $tarikhLaporan = $this->input->post('input_tarikh_laporan');
        $tahun = date_format(date_create($tarikhLaporan), 'Y');
        $this->checkTableExists($pelapor, $tahun);
        $jenis_barangan = $this->input->post('input_kenaikan_barangan');
        $kira_maklumat = count($jenis_barangan);
        $jenis_bekalan = $this->input->post('input_kurang_barangan');
        $kira_maklumat_2 = count($jenis_bekalan);
        $isuLain = $this->input->post('inputEkonomi');
        if($kira_maklumat > 0){
            if(empty($isuEkonomi)){
                $isuEkonomi = 'Kenaikan Harga Barang';
            }else{
                $isuEkonomi = $isuEkonomi.", ".'Kenaikan Harga Barang';
            }
        }
        if($kira_maklumat_2 > 0){
            if(empty($isuEkonomi)){
                $isuEkonomi = 'Kekurangan Bekalan Barangan';
            }else{
                $isuEkonomi = $isuEkonomi.", ".'Kekurangan Bekalan Barangan';
            }
        }
        if(!empty($isuLain)){
            if(empty($isuEkonomi)){
                $isuEkonomi = $isuLain;
            }else{
                $isuEkonomi = $isuEkonomi.", ".$isuLain;
            }
        }
        $data = array(
            'tarikh_laporan' => date_format(date_create($this->input->post('input_tarikh_laporan')), 'Y-m-d'),
            'pelapor' => $pelapor,
            'parlimen' => $this->input->post('input_parlimen'),
            'dun' => $this->input->post('input_dun'),
            'pdm' => $this->input->post('input_pdm'),
            'kluster_bil' => $this->input->post('input_kluster_bil'),
            'pengguna_bil' => $this->input->post('input_pengguna_bil'),
            'pengguna_waktu' => date('Y-m-d H:i:s'),
            'daerah' => $this->input->post('input_daerah'),
            'jenis_kawasan' => $this->input->post('input_jenis_kawasan'),
            'tapisan' => 'Terima',
            'isu_ekonomi' => $isuEkonomi,
            'ringkasan_isu' => $this->input->post('input_ringkasan_isu'),
            'lokasi_isu' => $this->input->post('input_lokasi'),
            'latitude' => $this->input->post('input_latitude'),
            'longitude' => $this->input->post('input_longitude'),
            'cadangan_intervensi' => $this->input->post('input_cadangan_intervensi')
        );
        $this->db->insert('ekonomi_'.$pelapor.'_'.date("Y"), $data);
        $laporan_bil = $this->db->insert_id();
        
        if($kira_maklumat > 0){
            for($i = 0; $i < $kira_maklumat; $i++){
                $jenis = $jenis_barangan[$i];
                $lain = $this->input->post('input_lain');
                if(!empty($lain) && $jenis_barangan[$i] == 'Lain-lain'){
                    $jenis = $lain;
                }
                $data_naik = array(
                    'tarikh_laporan' => date_format(date_create($this->input->post('input_tarikh_laporan')), 'Y-m-d'),
                    'laporan_bil' => $laporan_bil,
                    'jenis_barangan' => $jenis
                );
                $this->db->insert('ekonomi_kenaikan_harga_'.$pelapor.'_'.date("Y"), $data_naik);
            }
        }

        if($kira_maklumat_2 > 0){
            for($i = 0; $i < $kira_maklumat_2; $i++){
                $jenis = $jenis_bekalan[$i];
                $lain = $this->input->post('input_kurang_lain');
                if(!empty($lain) && $jenis_bekalan[$i] == 'Lain-lain'){
                    $jenis = $lain;
                }
                $data_kurang = array(
                    'tarikh_laporan' => date_format(date_create($this->input->post('input_tarikh_laporan')), 'Y-m-d'),
                    'laporan_bil' => $laporan_bil,
                    'jenis_barangan' => $jenis
                );
                $this->db->insert('ekonomi_kekurangan_barangan_'.$pelapor.'_'.date("Y"), $data_kurang);
            }
        }
    }

    public function checkTableExists($pelapor, $tahun)
    {   
        $this->load->dbforge();
        if($this->db->table_exists('ekonomi_'.$pelapor.'_'.$tahun) == FALSE){
            $fields = array(
                'bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'tarikh_laporan' => array(
                        'type' => 'DATE',
                        'null' => TRUE
                ),
                'pelapor' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'parlimen' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'dun' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'pdm' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'kluster_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
                    'null' => TRUE
                ),
                'pengguna_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
                    'null' => TRUE
                ),
                'pengguna_waktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                ),
                'daerah' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 200,
                    'null' => TRUE
                ),
                'jenis_kawasan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => TRUE
                ),
                'tapisan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                    'null' => TRUE
                ),
                'isu_ekonomi' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'ringkasan_isu' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'cadangan_intervensi' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'lokasi_isu' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'latitude' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'longitude' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('bil', TRUE);
            $this->dbforge->create_table('ekonomi_'.$pelapor.'_'.$tahun, TRUE);
        }

        if($this->db->table_exists('ekonomi_kenaikan_harga_'.$pelapor.'_'.$tahun) == FALSE){
            $fields = array(
                'bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'tarikh_laporan' => array(
                        'type' => 'DATE',
                        'null' => TRUE
                ),
                'laporan_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
                    'null' => TRUE
                ),
                'jenis_barangan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('bil', TRUE);
            $this->dbforge->create_table('ekonomi_kenaikan_harga_'.$pelapor.'_'.$tahun, TRUE);
        }

        if($this->db->table_exists('ekonomi_kekurangan_barangan_'.$pelapor.'_'.$tahun) == FALSE){
            $fields = array(
                'bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'tarikh_laporan' => array(
                        'type' => 'DATE',
                        'null' => TRUE
                ),
                'laporan_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
                    'null' => TRUE
                ),
                'jenis_barangan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('bil', TRUE);
            $this->dbforge->create_table('ekonomi_kekurangan_barangan_'.$pelapor.'_'.$tahun, TRUE);
        }

        $namaTable = 'ekonomi_'.$pelapor.'_'.$tahun;
        if($this->db->table_exists($namaTable) == TRUE){
            if ($this->db->field_exists('isu_ekonomi', $namaTable) == FALSE)
            {   
                $fields = array(
                    'isu_ekonomi' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($namaTable, $fields);
            }
            if ($this->db->field_exists('cadangan_intervensi', $namaTable) == FALSE)
            {   
                $fields = array(
                    'cadangan_intervensi' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($namaTable, $fields);
            }
            if ($this->db->field_exists('ringkasan_isu', $namaTable) == FALSE)
            {   
                $fields = array(
                    'ringkasan_isu' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($namaTable, $fields);
            }
            if ($this->db->field_exists('lokasi_isu', $namaTable) == FALSE)
            {   
                $fields = array(
                    'lokasi_isu' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($namaTable, $fields);
            }
            if ($this->db->field_exists('pdm', $namaTable) == FALSE)
            {   
                $fields = array(
                    'pdm' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($namaTable, $fields);
            }
            if ($this->db->field_exists('latitude', $namaTable) == FALSE)
            {   
                $fields = array(
                    'latitude' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($namaTable, $fields);
            }
            if ($this->db->field_exists('longitude', $namaTable) == FALSE)
            {   
                $fields = array(
                    'longitude' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($namaTable, $fields);
            }
        }

    }
}


?>