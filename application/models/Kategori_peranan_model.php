<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_peranan_model extends CI_Model {

    private $table = 'kategori_peranan_tb';

    public function semakPerananAnggotaPegawai($anggotaBil, $pegawaiBil){
        $this->db->where('kategori_peranan_tb.kategori_peranan_anggota_bil', $anggotaBil);
        $this->db->where('kategori_peranan_tb.kategori_peranan_pegawai_pengesah_bil', $pegawaiBil);
        $this->db->where('kategori_peranan_tb.kategori_peranan_tarikh_tamat', NULL);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiPerananAnggota($anggotaBil){
        //perananBil
        $this->db->select("kategori_peranan_tb.kategori_peranan_bil AS perananBil");
        //anggotaNama
        $this->db->select("kategori_peranan_tb.kategori_peranan_anggota_nama AS anggotaNama");
        //anggotaJawatan
        $this->db->select("kategori_peranan_tb.kategori_peranan_anggota_jawatan AS anggotaJawatan");
        //anggotaTempatBertugas
        $this->db->select("kategori_peranan_tb.kategori_peranan_anggota_tempat_tugas AS anggotaTempatBertugas");
        //kategoriPeranan
        $this->db->select("kategori_peranan_tb.kategori_peranan_nama AS kategoriPeranan");
        //pegawaiNama
        $this->db->select("kategori_peranan_tb.kategori_peranan_pegawai_pengesah_nama AS pegawaiNama");
        //pegawaiJawatan
        $this->db->select("kategori_peranan_tb.kategori_peranan_pegawai_pengesah_jawatan AS pegawaiJawatan");
        //pegawaiTempatBertugas
        $this->db->select("kategori_peranan_tb.kategori_peranan_pegawai_pengesah_tempat_tugas AS pegawaiTempatBertugas");
        //tarikhMula
        $this->db->select("kategori_peranan_tb.kategori_peranan_tarikh_mula AS tarikhMula");
        //tarikhTamat
        $this->db->select("kategori_peranan_tb.kategori_peranan_tarikh_tamat AS tarikhTamat");
        $this->db->where('kategori_peranan_tb.kategori_peranan_anggota_bil', $anggotaBil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function update20240811(){
        $this->binaTable();
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->table) == FALSE){
            $fields = array(
                'kategori_peranan_bil' => array(
                    'type' => 'BIGINT',
                    'null'=> FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'kategori_peranan_anggota_bil' => array(
                        'type' => 'BIGINT',
                        'null' => TRUE
                ),
                'kategori_peranan_anggota_nama' => array(
                'type' => 'TEXT',
                'null' => TRUE
                ),
                'kategori_peranan_anggota_jawatan' => array(
                'type' => 'TEXT',
                'null' => TRUE
                ),
                'kategori_peranan_anggota_tempat_tugas' => array(
                'type' => 'TEXT',
                'null' => TRUE
                ),
                'kategori_peranan_nama' => array(
                'type' => 'TEXT',
                'null' => TRUE
                ),
                'kategori_peranan_pegawai_pengesah_bil' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'kategori_peranan_pegawai_pengesah_nama' => array(
                'type' => 'TEXT',
                'null' => TRUE
                ),
                'kategori_peranan_pegawai_pengesah_jawatan' => array(
                'type' => 'TEXT',
                'null' => TRUE
                ),
                'kategori_peranan_pegawai_pengesah_tempat_tugas' => array(
                'type' => 'TEXT',
                'null' => TRUE
                ),
                'kategori_peranan_tarikh_mula' => array(
                'type' => 'DATE',
                'null' => TRUE
                ),
                'kategori_peranan_tarikh_tamat' => array(
                'type' => 'DATE',
                'null' => TRUE
                ),
                'kategori_peranan_pengguna_bil' => array(
                'type' => 'BIGINT',
                'null' => TRUE
                ),
                'kategori_peranan_pengguna_waktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('kategori_peranan_bil', TRUE);
            $this->dbforge->create_table($this->table, TRUE);
        }
    }

}