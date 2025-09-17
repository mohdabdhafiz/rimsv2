<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ppd_model extends CI_Model {

    protected $tableName = 'ppd';

    public function tamatPerananPpd($ppdBil){
        $data = array(
            'p_tarikh_tamat' => date('Y-m-d')
        );
        $this->db->where('p_bil', $ppdBil);
        return $this->db->update($this->tableName, $data);
    }

    public function akaunPpd($pengguna){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = ppd.p_anggota', 'left');
        $this->db->where('p_anggota', $pengguna->bil);
        $this->db->where('p_peranan', $pengguna->pengguna_peranan_bil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function senaraiPpd($perananBil){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = ppd.p_anggota', 'left');
        $this->db->where('p_peranan', $perananBil);
        $this->db->order_by('p_tarikh_mula', 'DESC');
        $this->db->order_by('p_pengguna_waktu', 'DESC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function ppd($perananBil){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = ppd.p_anggota', 'left');
        $this->db->where('p_peranan', $perananBil);
        $this->db->order_by('p_tarikh_mula', 'DESC');
        $this->db->order_by('p_pengguna_waktu', 'DESC');
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function setPpd($ppd, $perananBil, $penggunaBil){
        $data = array(
            'p_anggota' => $ppd,
            'p_peranan' => $perananBil,
            'p_tarikh_mula' => date('Y-m-d'),
            'p_pengguna' => $penggunaBil,
            'p_pengguna_waktu' => date('Y-m-d H:i:s')
        );
        return $this->db->insert($this->tableName, $data);
    }

    public function adaPpd($perananBil){
        $this->db->where('p_peranan', $perananBil);
        $this->db->where('p_tarikh_tamat', NULL);
        $this->db->order_by('p_tarikh_mula', 'DESC');
        $this->db->order_by('p_pengguna_waktu', 'DESC');
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function update20240206(){
        $this->binaTable();
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableName) == FALSE){
            $fields = array(
                'p_bil' => array(
                    'type' => 'BIGINT',
                    'null' => FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'p_anggota' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'p_peranan' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'p_tarikh_mula' => array(
                    'type' => 'DATE',
                    'null' => TRUE
                ),
                'p_tarikh_tamat' => array(
                    'type' => 'DATE',
                    'null' => TRUE
                ),
                'p_pengguna' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'p_pengguna_waktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('p_bil', TRUE);
            $this->dbforge->create_table($this->tableName, TRUE);
        }
    }
}