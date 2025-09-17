<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dpi_model extends CI_Model {

    public function senaraiKaumDun(){
        $this->db->group_by('dkdt_kaum');
        $query = $this->db->get('dpi_kaum_dun_tb');
        return $query->result();
    }

    public function kemaskiniDun($dmBil, $kaum, $bilanganPengundi, $penggunaBil, $penggunaWaktu){
        $data = array(
            'dkdt_bilangan_pengundi' => $bilanganPengundi,
            'dkdt_pengguna_bil' => $penggunaBil,
            'dkdt_pengguna_waktu' => $penggunaWaktu
        );
        $this->db->where('dkdt_dm_bil', $dmBil);
        $this->db->where('dkdt_kaum', $kaum);
        return $this->db->update('dpi_kaum_dun_tb', $data);
    }

    public function tambahDun($dmBil, $kaum, $bilanganPengundi, $penggunaBil, $penggunaWaktu){
        $data = array(
            'dkdt_dm_bil' => $dmBil,
            'dkdt_kaum' => $kaum,
            'dkdt_bilangan_pengundi' => $bilanganPengundi,
            'dkdt_pengguna_bil' => $penggunaBil,
            'dkdt_pengguna_waktu' => $penggunaWaktu
        );
        $this->db->insert('dpi_kaum_dun_tb', $data);
    }

    public function dmKaumDun($dmBil, $kaum){
        $this->db->where('dkdt_dm_bil', $dmBil);
        $this->db->where('dkdt_kaum', $kaum);
        $query = $this->db->get('dpi_kaum_dun_tb');
        return $query->row();
    }

    private function checkTableExists()
    {   
        $this->load->dbforge();
        if($this->db->table_exists('dpi_kaum_dun_tb') == FALSE){
            $fields = array(
                'dkdt_bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'dkdt_dm_bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'dkdt_kaum' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'dkdt_bilangan_pengundi' => array(
                    'type' => 'BIGINT',
                    'null' => TRUE
                ),
                'dkdt_pengguna_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
                    'null' => TRUE
                ),
                'dkdt_pengguna_waktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('dkdt_bil', TRUE);
            $this->dbforge->create_table('dpi_kaum_dun_tb', TRUE);
        }
    }

    public function update(){
        $this->checkTableExists();
    }

}

?>