<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bencana_model extends CI_Model {

    private $tableName = 'bencana';
    private $tableGambar = 'bencana_gambar';

    public function gambarBencana($gambarBil){
        $this->db->where('bencana_gambar_bil', $gambarBil); 
        $query = $this->db->get($this->tableGambar);
        return $query->row();
    }

    public function padamGambar($gambarBil){
        $this->db->where('bencana_gambar_bil', $gambarBil); 
        $this->db->delete($this->tableGambar);
    }

    public function tambahGambar($gambarNama, $bencanaBil, $penggunaBil){
        $data = array(
            "bencana_gambar_nama" => $gambarNama,
            'bencana_gambar_bencana' => $bencanaBil,
            'bencana_pengguna' => $penggunaBil,
            'bencana_pengguna_waktu' => date("Y-m-d H:i:s")
        );
        $return_data['insert_data'] = $this->db->insert($this->tableGambar, $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;
    }

    public function senaraiGambar($bencanaBil){
        $this->db->select("bencana_gambar.bencana_gambar_bil AS gambarBil");
        $this->db->select("bencana_gambar.bencana_gambar_nama AS gambarNama");
        $this->db->where("bencana_gambar.bencana_gambar_bencana", $bencanaBil);
        $query = $this->db->get($this->tableGambar);
        return $query->result();
    }

    private function binaTableGambar(){
        //LOAD LIBRARIES
        $this->load->dbforge();

        if($this->db->table_exists($this->tableGambar) == FALSE)
        {
            $fields = array(
                'bencana_gambar_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'bencana_gambar_nama' => array(
                    'type' => 'text',
                    'null' => TRUE
                ),
                'bencana_gambar_bencana' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'bencana_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'bencana_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('bencana_gambar_bil', TRUE);
            $this->dbforge->create_table($this->tableGambar);
        }
    }

    public function bilanganLaporanIndividu($penggunaBil){
        $this->db->select(('COUNT(*) AS bilanganLaporan'));
        $this->db->where('bencana_pelapor', $penggunaBil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function bilanganLaporanHari($tarikh){
        $this->db->select(('COUNT(*) AS bilangan'));
        $this->db->where('DATE(bencana_tarikh_laporan)', date_format(date_create($tarikh), 'Y-m-d'));
        $this->db->where('bencana_status', 'Terima');
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function bilanganLaporanBulan($tarikh){
        $this->db->select(('COUNT(*) AS bilangan'));
        $this->db->where('MONTH(bencana_tarikh_laporan)', date_format(date_create($tarikh), 'm'));
        $this->db->where('YEAR(bencana_tarikh_laporan)', date_format(date_create($tarikh), 'Y'));
        $this->db->where('bencana_status', 'Terima');
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function bilanganLaporanTahun($tahun){
        $this->db->select(('COUNT(*) AS bilangan'));
        $this->db->where('YEAR(bencana_tarikh_laporan)', $tahun);
        $this->db->where('bencana_status', 'Terima');
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function bilanganLaporan(){
        $this->db->select(('COUNT(*) AS bilangan'));
        $this->db->where('DATE(bencana_tarikh_laporan)', date('Y-m-d'));
        $this->db->where('bencana_status', 'Terima');
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function senaraiIndividu($penggunaBil){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = bencana.bencana_pelapor', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = bencana.bencana_negeri', 'left');
        $this->db->join('daerah', 'daerah.bil = bencana.bencana_daerah', 'left');
        $this->db->where('bencana_pelapor', $penggunaBil);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function senarai(){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = bencana.bencana_pelapor', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = bencana.bencana_negeri', 'left');
        $this->db->join('daerah', 'daerah.bil = bencana.bencana_daerah', 'left');
        $this->db->where('YEAR(bencana.bencana_tarikh_laporan)', date('Y'));
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function padamLaporan(){
        $this->db->where('bencana_bil', $this->input->post('inputBil'));
        $this->db->delete($this->tableName);
    }

    public function hantarLaporan(){
        $data = array(
            'bencana_status' => 'Terima'
        );
        $this->db->where('bencana_bil', $this->input->post('inputBil'));
        return $this->db->update($this->tableName, $data);
    }

    public function kemaskini(){
        $data = array(
            'bencana_pelapor' => $this->input->post('inputPelapor'),
            'bencana_negeri' => $this->input->post('inputNegeri'),
            'bencana_daerah' => $this->input->post('inputDaerah'),
            'bencana_situasi' => $this->input->post('inputSituasi'),
            'bencana_pps' => $this->input->post('inputPps'),
            'bencana_mangsa' => $this->input->post('inputMangsa'),
            'bencana_kematian' => $this->input->post('inputKematian'),
            'bencana_hilang' => $this->input->post('inputHilang'),
            'bencana_reaksi' => $this->input->post('inputReaksi'),
            'bencana_ulasan_reaksi' => $this->input->post('inputUlasan'),
            'bencana_masalah' => $this->input->post('inputMasalah'),
            'bencana_lokasi' => $this->input->post('inputLokasi'),
            'bencana_intervensi' => $this->input->post('inputIntervensi'),
            'bencana_rumusan' => $this->input->post('inputRumusan')
        );
        $this->db->where('bencana_bil', $this->input->post('inputBil'));
        return $this->db->update($this->tableName, $data);
    }

    public function bencana($bencanaBil){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = bencana.bencana_pengguna', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = bencana.bencana_negeri', 'left');
        $this->db->join('daerah', 'daerah.bil = bencana.bencana_daerah', 'left');
        $this->db->where('bencana_bil', $bencanaBil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function tambah(){
        $data = array(
            'bencana_jenis' => $this->input->post('inputJenisBencana'),
            'bencana_tarikh_laporan' => date('Y-m-d'),
            'bencana_pelapor' => $this->input->post('inputPelapor'),
            'bencana_negeri' => $this->input->post('inputNegeri'),
            'bencana_daerah' => $this->input->post('inputDaerah'),
            'bencana_situasi' => $this->input->post('inputSituasiSemasa'),
            'bencana_pps' => $this->input->post('inputBilanganPps'),
            'bencana_mangsa' => $this->input->post('inputJumlahMangsa'),
            'bencana_kematian' => $this->input->post('inputBilanganKematian'),
            'bencana_hilang' => $this->input->post('inputBilanganHilang'),
            'bencana_reaksi' => $this->input->post('inputReaksi'),
            'bencana_ulasan_reaksi' => $this->input->post('inputUlasanReaksi'),
            'bencana_masalah' => $this->input->post('inputMasalahBerbangkit'),
            'bencana_lokasi' => $this->input->post('inputLokasi'),
            'bencana_intervensi' => $this->input->post('inputCadanganIntervensi'),
            'bencana_rumusan' => $this->input->post('inputRumusan'),
            'bencana_status' => 'Draf',
            'bencana_pengguna' => $this->input->post('inputPengguna'),
            'bencana_pengguna_waktu' => date('Y-m-d H:i:s')
        );
        $return_data['insert_data'] = $this->db->insert($this->tableName, $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;
    }

    public function update20241128(){
        $this->binaTable();
        $this->binaTableGambar();
    }

    public function update20231227(){
        $this->binaTable();
    }



    private function binaTable(){
        //LOAD LIBRARIES
        $this->load->dbforge();

        if($this->db->table_exists($this->tableName) == TRUE){
            if($this->db->field_exists('bencana_jenis', $this->tableName) == FALSE){
                $fields = array(
                    'bencana_jenis' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($this->tableName, $fields);
            }
        }

        if($this->db->table_exists($this->tableName) == FALSE)
        {
            $fields = array(
                'bencana_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'bencana_jenis' => array(
                    'type' => 'text',
                    'null' => TRUE
                ),
                'bencana_tarikh_laporan' => array(
                    'type' => 'date',
                    'null' => TRUE
                ),
                'bencana_pelapor' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'bencana_negeri' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'bencana_daerah' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'bencana_situasi' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'bencana_pps' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'bencana_mangsa' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'bencana_kematian' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'bencana_hilang' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'bencana_reaksi' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'bencana_ulasan_reaksi' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'bencana_masalah' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'bencana_lokasi' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'bencana_intervensi' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'bencana_rumusan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'bencana_status' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'bencana_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'bencana_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('bencana_bil', TRUE);
            $this->dbforge->create_table($this->tableName);
        }
    }

}