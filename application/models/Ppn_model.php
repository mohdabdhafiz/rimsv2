<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ppn_model extends CI_Model {

    protected $tableName = 'ppn';

    public function maklumatPpn($ppnBil){
        $this->db->select("pengguna_tb.nama_penuh AS nama");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = ppn.ppn_anggota', 'left');
        $this->db->where('ppn.ppn_bil', $ppnBil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function senaraiTerkini(){
        $this->update();
        $this->db->select("japen_tb.jt_pejabat AS penempatan");
        $this->db->select("pengguna_tb.bil AS nomborSiriPengguna");
        $this->db->select("pengguna_tb.nama_penuh AS namaPengarah");
        $this->db->select("pengguna_tb.pekerjaan AS jawatanPengarah");
        $this->db->select("ppn_tarikh_mula AS tarikhMulaLantikan");
        $this->db->join('organisasi', 'organisasi.o_japen = japen_tb.jt_bil', "left");
        $this->db->join("ppn", "ppn.ppn_peranan = organisasi.o_peranan", "left");
        $this->db->join("pengguna_tb", "pengguna_tb.bil = ppn.ppn_anggota", "left");
        $this->db->where("ppn.ppn_tarikh_tamat", NULL);
        $query = $this->db->get('japen_tb');
        return $query->result();
    }

    public function tamatPerananPpn($ppnBil){
        $data = array(
            'ppn_tarikh_tamat' => date('Y-m-d')
        );
        $this->db->where('ppn_bil', $ppnBil);
        return $this->db->update($this->tableName, $data);
    }

    public function akaunPpn($pengguna){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = ppn.ppn_anggota', 'left');
        $this->db->where('ppn_anggota', $pengguna->bil);
        $this->db->where('ppn_peranan', $pengguna->pengguna_peranan_bil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function senaraiPpn($perananBil){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = ppn.ppn_anggota', 'left');
        $this->db->where('ppn_peranan', $perananBil);
        $this->db->order_by('ppn_tarikh_mula', 'DESC');
        $this->db->order_by('ppn_pengguna_waktu', 'DESC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function ppn($perananBil){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = ppn.ppn_anggota', 'left');
        $this->db->where('ppn_peranan', $perananBil);
        $this->db->order_by('ppn_tarikh_mula', 'DESC');
        $this->db->order_by('ppn_pengguna_waktu', 'DESC');
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function setPpn($ppn, $perananBil, $penggunaBil){
        $data = array(
            'ppn_anggota' => $ppn,
            'ppn_peranan' => $perananBil,
            'ppn_tarikh_mula' => date('Y-m-d'),
            'ppn_pengguna' => $penggunaBil,
            'ppn_pengguna_waktu' => date('Y-m-d H:i:s')
        );
        $this->db->insert($this->tableName, $data);
        return $this->db->insert_id();
    }

    public function adaPpn($perananBil){
        $this->db->where('ppn_peranan', $perananBil);
        $this->db->where('ppn_tarikh_tamat', NULL);
        $this->db->order_by('ppn_tarikh_mula', 'DESC');
        $this->db->order_by('ppn_pengguna_waktu', 'DESC');
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    private function update(){
        $this->binaTable();
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableName) == FALSE){
            $fields = array(
                'ppn_bil' => array(
                    'type' => 'BIGINT',
                    'null' => FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'ppn_anggota' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'ppn_peranan' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'ppn_tarikh_mula' => array(
                    'type' => 'DATE',
                    'null' => TRUE
                ),
                'ppn_tarikh_tamat' => array(
                    'type' => 'DATE',
                    'null' => TRUE
                ),
                'ppn_pengguna' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'ppn_pengguna_waktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('ppn_bil', TRUE);
            $this->dbforge->create_table($this->tableName, TRUE);
        }
    }

}