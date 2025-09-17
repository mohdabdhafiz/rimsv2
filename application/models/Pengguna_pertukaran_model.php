<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_pertukaran_model extends CI_Model {

    protected $tableName = "pengguna_pertukaran_model";

    public function tambahPertukaran(){
        $data = array(
            'pengguna_pertukaran_anggota_bil' => $this->input->post('inputAnggotaBil'),
            'pengguna_pertukaran_anggota_nama' => $this->input->post('inputAnggotaNama'),
            'pengguna_pertukaran_anggota_jawatan' => $this->input->post('inputAnggotaJawatan'),
            'pengguna_pertukaran_anggota_tempat_bertugas' => $this->input->post('inputAnggotaPenempatan'),
            'pengguna_pertukaran_peranan_bil' => $this->input->post('inputPerananBil'),
            'pengguna_pertukaran_peranan_nama' => $this->input->post('inputPerananNama'),
            'pengguna_pertukaran_organisasi_bil' => $this->input->post('inputOrganisasiBil'),
            'pengguna_pertukaran_organisasi_nama' => $this->input->post('inputOrganisasiNama'),
            'pengguna_pertukaran_tarikh' => $this->input->post('inputPertukaranTarikh'),
            'pengguna_pertukaran_pengguna' => $this->input->post('inputPenggunaBil'),
            'pengguna_pertukaran_waktu' => $this->input->post('inputPenggunaWaktu')
        );
        return $this->db->insert($this->tableName, $data);
    }

    public function wujud($anggotaBil, $organisasiBil){
        $this->db->where('pengguna_pertukaran_anggota_bil', $anggotaBil);
        $this->db->where('pengguna_pertukaran_organisasi_bil', $organisasiBil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function latest($anggotaBil, $penggunaWaktu){
        $this->db->where('pengguna_pertukaran_anggota_bil', $anggotaBil);
        $this->db->where('DATE(pengguna_pertukaran_waktu)', date("Y-m-d", $penggunaWaktu));
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function update20241011(){
        $this->binaTable();
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableName) == FALSE)
        {
            $fields = array(
                'pengguna_pertukaran_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'pengguna_pertukaran_anggota_bil' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'pengguna_pertukaran_anggota_nama' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'pengguna_pertukaran_anggota_jawatan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'pengguna_pertukaran_anggota_tempat_bertugas' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'pengguna_pertukaran_peranan_bil' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'pengguna_pertukaran_peranan_nama' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'pengguna_pertukaran_organisasi_bil' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'pengguna_pertukaran_organisasi_nama' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'pengguna_pertukaran_tarikh' => array(
                    'type' => 'date',
                    'null' => TRUE
                ),
                'pengguna_pertukaran_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'pengguna_pertukaran_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('pengguna_pertukaran_bil', TRUE);
            $this->dbforge->create_table($this->tableName);
        }
    }

}
?>