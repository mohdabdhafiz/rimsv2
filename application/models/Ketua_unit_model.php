<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ketua_unit_model extends CI_Model {

    protected $tableName = 'ketua_unit';

    public function kosongkan($perananBil){
        $data = array(
            "ku_tarikh_tamat" => date("Y-m-d")
        );
        $this->db->where('ku_peranan', $perananBil);
        $this->db->where('ku_tarikh_tamat', NULL);
        return $this->db->update($this->tableName, $data);
    }

    public function senarai($perananBil){
        $this->db->where('ketua_unit.ku_peranan', $perananBil);
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = ketua_unit.ku_anggota', 'left');
        $this->db->order_by('ketua_unit.ku_tarikh_tamat', 'ASC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function tamat($ketuaBil){
        $data = array(
            "ku_tarikh_tamat" => date("Y-m-d")
        );
        $this->db->where('ku_bil', $ketuaBil);
        $this->db->where('ku_tarikh_tamat', NULL);
        return $this->db->update($this->tableName, $data);
    }

    public function akaunKetua($pengguna){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = ketua_unit.ku_anggota', 'left');
        $this->db->where('pengguna_tb.bil', $pengguna->bil);
        $this->db->where('pengguna_tb.pengguna_peranan_bil', $pengguna->pengguna_peranan_bil);
        $this->db->order_by('ketua_unit.ku_tarikh_tamat', 'ASC');
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function ketuaUnit($perananBil){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = ketua_unit.ku_anggota', 'left');
        $this->db->where('ketua_unit.ku_peranan', $perananBil);
        $this->db->where('ketua_unit.ku_tarikh_tamat', NULL);
        $this->db->order_by('ketua_unit.ku_tarikh_tamat', 'DESC');
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function setKetuaUnit($ketuaUnit, $perananBil, $penggunaBil, $gelaranJawatan){
        $data = array(
            'ku_anggota' => $ketuaUnit,
            'ku_peranan' => $perananBil,
            'ku_gelaran' => $gelaranJawatan,
            'ku_tarikh_mula' => date('Y-m-d'),
            'ku_pengguna' => $penggunaBil,
            'ku_pengguna_waktu' => date('Y-m-d H:i:s')
        );
        return $this->db->insert($this->tableName, $data);
    }

    public function adaKetuaUnit($perananBil){
        $this->db->where('ku_peranan', $perananBil);
        $this->db->where('ku_tarikh_tamat', '');
        $this->db->order_by('ketua_unit.ku_tarikh_tamat', 'ASC');
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function update20240218(){
        $this->binaTable();
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableName) == FALSE){
            $fields = array(
                'ku_bil' => array(
                    'type' => 'BIGINT',
                    'null' => FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'ku_anggota' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'ku_peranan' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'ku_gelaran' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'ku_tarikh_mula' => array(
                    'type' => 'DATE',
                    'null' => TRUE
                ),
                'ku_tarikh_tamat' => array(
                    'type' => 'DATE',
                    'null' => TRUE
                ),
                'ku_pengguna' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'ku_pengguna_waktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('ku_bil', TRUE);
            $this->dbforge->create_table($this->tableName, TRUE);
        }
    }
}