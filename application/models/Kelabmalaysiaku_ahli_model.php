<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelabmalaysiaku_ahli_model extends CI_Model {

    private $tableName = 'kelabmalaysiaku_ahli';

    public function bilanganAhliPeranan($perananBil){
        $this->db->select('COUNT(*) AS bilanganAhli');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = kelabmalaysiaku_ahli.ka_pengguna', 'left');
        $this->db->where('pengguna_tb.pengguna_peranan_bil', $perananBil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function bilanganAhliPengguna($penggunaBil){
        $this->db->select('COUNT(*) AS bilanganAhli');
        $this->db->where('ka_pengguna', $penggunaBil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function bilanganAhliTingkatan($bil){
        $this->db->select('kelabmalaysiaku_ahli.ka_tingkatan AS tingkatan');
        $this->db->select('COUNT(kelabmalaysiaku_ahli.ka_tingkatan) AS bilanganAhli');
        $this->db->where('kelabmalaysiaku_ahli.ka_kelabmalaysiaku', $bil);
        $this->db->group_by('kelabmalaysiaku_ahli.ka_tingkatan');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function bilanganAhliKaum($bil){
        $this->db->select('kelabmalaysiaku_ahli.ka_kaum AS kaum');
        $this->db->select('COUNT(kelabmalaysiaku_ahli.ka_kaum) AS bilanganAhli');
        $this->db->where('kelabmalaysiaku_ahli.ka_kelabmalaysiaku', $bil);
        $this->db->group_by('kelabmalaysiaku_ahli.ka_kaum');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function bilanganAhliJantina($bil){
        $this->db->select('kelabmalaysiaku_ahli.ka_jantina AS jantina');
        $this->db->select('COUNT(kelabmalaysiaku_ahli.ka_jantina) AS bilanganAhli');
        $this->db->where('kelabmalaysiaku_ahli.ka_kelabmalaysiaku', $bil);
        $this->db->group_by('kelabmalaysiaku_ahli.ka_jantina');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function bilanganAhliUmur($bil){
        $this->db->select('kelabmalaysiaku_ahli.ka_umur AS umur');
        $this->db->select('COUNT(kelabmalaysiaku_ahli.ka_umur) AS bilanganAhli');
        $this->db->where('kelabmalaysiaku_ahli.ka_kelabmalaysiaku', $bil);
        $this->db->group_by('kelabmalaysiaku_ahli.ka_umur');
        $this->db->order_by('kelabmalaysiaku_ahli.ka_umur', 'DESC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function rumusanUmurAhli(){
        $this->db->select('DISTINCT(kelabmalaysiaku_ahli.ka_umur) AS umur');
        $this->db->select('COUNT(DISTINCT kelabmalaysiaku_ahli.ka_umur) AS kiraanUmur');
        $this->db->join('kelabmalaysiaku', 'kelabmalaysiaku.kelabmalaysiaku_bil = kelabmalaysiaku_ahli.ka_kelabmalaysiaku', 'left');
        $this->db->where('kelabmalaysiaku.kelabmalaysiaku_status_aktif', 'AKTIF');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function rumusanJantinaAhli(){
        $this->db->select('DISTINCT(kelabmalaysiaku_ahli.ka_jantina) AS jantina');
        $this->db->select('COUNT(DISTINCT kelabmalaysiaku_ahli.ka_jantina) AS kiraanJantina');
        $this->db->join('kelabmalaysiaku', 'kelabmalaysiaku.kelabmalaysiaku_bil = kelabmalaysiaku_ahli.ka_kelabmalaysiaku', 'left');
        $this->db->where('kelabmalaysiaku.kelabmalaysiaku_status_aktif', 'AKTIF');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function rumusanKaumAhli(){
        $this->db->select('DISTINCT(kelabmalaysiaku_ahli.ka_kaum) AS kaum');
        $this->db->select('COUNT(DISTINCT kelabmalaysiaku_ahli.ka_kaum) AS kiraanKaum');
        $this->db->join('kelabmalaysiaku', 'kelabmalaysiaku.kelabmalaysiaku_bil = kelabmalaysiaku_ahli.ka_kelabmalaysiaku', 'left');
        $this->db->where('kelabmalaysiaku.kelabmalaysiaku_status_aktif', 'AKTIF');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function tambahAhliPost(){
        $data = array(
            'ka_nama' => $this->input->post('inputNama'),
            'ka_jawatan' => $this->input->post('inputJawatan'),
            'ka_alamat' => $this->input->post('inputAlamat'),
            'ka_no_telefon' => $this->input->post('inputTelefon'),
            'ka_emel' => $this->input->post('inputEmel'),
            'ka_umur' => $this->input->post('inputUmur'),
            'ka_jantina' => $this->input->post('inputJantina'),
            'ka_kaum' => $this->input->post('inputKaum'),
            'ka_kelabmalaysiaku' => $this->input->post('inputKelabmalaysiaku'),
            'ka_tingkatan' => $this->input->post('inputTingkatan'),
            'ka_pendaftaran' => date('Y-m-d'),
            'ka_pengguna' => $this->input->post('inputPengguna'),
            'ka_pengguna_waktu' => date("Y-m-d H:i:s")
        );
        $return_data['insert_data'] = $this->db->insert($this->tableName, $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;
    }

    public function senarai($kelabmalaysiakuBil){
        $this->db->order_by('ka_nama', 'ASC');
        $this->db->where('ka_kelabmalaysiaku', $kelabmalaysiakuBil);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function update20240124(){
        $this->binaTable();
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableName) == FALSE){
            $fields = array(
                'ka_bil' => array(
                    'type' => 'BIGINT',
                    'null'=> FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
            ),
            'ka_nama' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
            ),
            'ka_jawatan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
            ),
            'ka_alamat' => array(
                    'type' => 'TEXT'
            ),
            'ka_no_telefon' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
            ),
            'ka_emel' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
            ),
            'ka_umur' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
            ),
            'ka_jantina' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
            ),
            'ka_kaum' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
            ),
            'ka_kelabmalaysiaku' => array(
              'type' => 'BIGINT',
              'null' => TRUE
            ),
            'ka_tingkatan' => array(
              'type' => 'TEXT',
              'null' => TRUE
            ),
            'ka_pendaftaran' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'ka_pengguna' => array(
              'type' => 'BIGINT',
              'null' => TRUE
            ),
            'ka_pengguna_waktu' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('ka_bil', TRUE);
            $this->dbforge->create_table($this->tableName, TRUE);
        }
    }
}
?>