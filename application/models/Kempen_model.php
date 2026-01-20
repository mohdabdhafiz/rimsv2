<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kempen_model extends CI_Model {

    //--------------------------------------------------------------
    //1) PROTECTED VARIABLES
    //--------------------------------------------------------------

    protected $table = 'kempen_pru_tb';

    protected $tableGambar = 'kempen_pru_gambar_tb';

    //--------------------------------------------------------------
    //2) PUBLIC METHODS
    //--------------------------------------------------------------

    public function bilanganLaporanAktivitiKempenNegeri($senaraiNegeri){
        $this->binaTable();
        $this->db->select('COUNT(kempen_pru_pru_bil) AS bilanganLaporan');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = kempen_pru_tb.kempen_pru_pru_bil', 'left');
        $this->db->join("pdm_parlimen_tb", "pdm_parlimen_tb.ppt_nama = kempen_pru_tb.kempen_pru_pdm_nama", "left");
        $this->db->join("parlimen_tb", "parlimen_tb.pt_bil = pdm_parlimen_tb.ppt_parlimen_bil", "left");
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('parlimen_tb.pt_negeri', $negeri->nt_nama);
        }
        $this->db->group_end();
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'AKTIF');
        $query = $this->db->get($this->table);
        return $query->row();
    }

public function bilanganLaporanAktivitiKempen($penggunaBil){
        $this->binaTable();
        $this->db->select('COUNT(kempen_pru_bil) AS bilanganLaporan');
        $this->db->where('kempen_pru_pelapor_bil', $penggunaBil);
        $query = $this->db->get($this->table);
        return $query->row();
}

    public function senaraiGambarTarikh($tarikh){
        $this->binaTableGambar();
        $this->db->select('
            kempen_pru_gambar_bil AS gambarBil, 
            kempen_pru_gambar_kempen_pru_bil AS kempenBil, 
            kempen_pru_gambar_nama_fail AS gambarFail, 
            kempen_pru_gambar_deskripsi AS gambarDeskripsi');
        $this->db->join($this->table, 'kempen_pru_gambar_tb.kempen_pru_gambar_kempen_pru_bil = kempen_pru_tb.kempen_pru_bil', 'left');
        $this->db->where('kempen_pru_tb.kempen_pru_tarikh', $tarikh);
        $this->db->or_where('kempen_pru_tb.kempen_pru_tarikh', date('Y-m-d', strtotime('-1 day')));
        $query = $this->db->get($this->tableGambar);
        return $query->result();
    }
    
    public function tambahKempen($data){
        $this->binaTable();
        $this->binaTableGambar();
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function tambahGambarKempen($data){
        $this->binaTableGambar();
        $this->db->insert($this->tableGambar, $data);
        return $this->db->insert_id();
    }
        
    public function senaraiTarikh($tarikh){
                $this->binaTable();
                $this->binaTableGambar();
                $this->db->select('
                kempen_pru_bil AS kempenBil, 
                kempen_pru_pru_singkatan AS kempenPruSingkatan,
                kempen_pru_pelapor_nama AS kempenPelapor,
                kempen_pru_pdm_nama AS dmNama,
                kempen_pru_tarikh AS kempenTarikh, 
                kempen_pru_masa AS kempenMasa, 
                kempen_pru_lokasi AS kempenLokasi, 
                kempen_pru_jenis_aktiviti AS kempenJenisAktiviti, 
                kempen_pru_aktiviti AS kempenAktiviti, 
                kempen_pru_parti_singkatan AS partiSingkatan, 
                kempen_pru_pemimpin AS kempenPemimpinHadir,
                kempen_pru_perkara_berbangkit
                '
                );
                $this->db->where('kempen_pru_tarikh >=', date('Y-m-d', strtotime('-1 day')));
                $this->db->where('kempen_pru_tarikh <=', date('Y-m-d'));
                $this->db->order_by('kempen_pru_tarikh', 'DESC');
                $this->db->order_by('kempen_pru_masa', 'DESC');
                $query = $this->db->get($this->table);
                return $query->result();
        }

    public function senarai(){
        $this->binaTable();
        $this->binaTableGambar();
        $this->db->join("pilihanraya_tb", "pilihanraya_tb.pilihanraya_bil = kempen_pru_tb.kempen_pru_pru_bil", "left");
        $this->db->where("pilihanraya_tb.pilihanraya_status", "AKTIF");
        $this->db->order_by('kempen_pru_tb.kempen_pru_tarikh', 'desc');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    //--------------------------------------------------------------
    //3) PRIVATE METHODS
    //--------------------------------------------------------------

    private function binaTableGambar(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableGambar) == FALSE){
            $fields = array(
                'kempen_pru_gambar_bil' => array(
                    'type' => 'BIGINT',
                    'null'=> FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'kempen_pru_gambar_kempen_pru_bil' => array(
                        'type' => 'BIGINT',
                        'null' => TRUE
                ),
                'kempen_pru_gambar_nama_fail' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '255',
                        'null' => TRUE
                ),
                'kempen_pru_gambar_deskripsi' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                ),
                'kempen_pru_tarikh_dibina' => array(
                        'type' => 'DATETIME',
                        'null' => TRUE
                ),
                'kempen_pru_gambar_pelapor_bil' => array(
                        'type' => 'BIGINT',
                        'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('kempen_pru_gambar_bil', TRUE);
            $this->dbforge->create_table($this->tableGambar);
        }
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->table) == FALSE){
            $fields = array(
                'kempen_pru_bil' => array(
                    'type' => 'BIGINT',
                    'null'=> FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'kempen_pru_pelapor_bil' => array(
                        'type' => 'BIGINT',
                        'null' => TRUE
                ),
                'kempen_pru_pelapor_nama' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '255',
                        'null' => TRUE
                ),
                'kempen_pru_pelapor_jawatan' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '255',
                        'null' => TRUE
                ),
                'kempen_pru_pelapor_penempatan' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                ),
                'kempen_pru_pru_bil' => array(
                        'type' => 'BIGINT',
                        'null' => TRUE
                ),
                'kempen_pru_pru_nama' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '255',
                        'null' => TRUE
                ),
                'kempen_pru_pru_singkatan' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '50',
                        'null' => TRUE
                ),
                'kempen_pru_tarikh' => array(
                        'type' => 'DATE',
                        'null' => TRUE
                ),
                'kempen_pru_masa' => array(
                        'type' => 'TIME',
                        'null' => TRUE
                ),
                'kempen_pru_pdm_bil' => array(
                        'type' => 'BIGINT',
                        'null' => TRUE
                ),
                'kempen_pru_pdm_nama' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '255',
                        'null' => TRUE
                ),
                'kempen_pru_lokasi' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                ),
                'kempen_pru_parti_bil' => array(
                        'type' => 'BIGINT',
                        'null' => TRUE
                ),
                'kempen_pru_parti_nama' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '255',
                        'null' => TRUE
                ),
                'kempen_pru_parti_singkatan' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '50',
                        'null' => TRUE
                ),
                'kempen_pru_aktiviti' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                ),
                'kempen_pru_jenis_aktiviti' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '255',
                        'null' => TRUE
                ),
                'kempen_pru_pemimpin' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                ),
                'kempen_pru_perkara_berbangkit' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                ),
                'kempen_pru_tarikh_dibina' => array(
                        'type' => 'DATETIME',
                        'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('kempen_pru_bil', TRUE);
            $this->dbforge->create_table($this->table);
        }
    }

}