<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kpi_model extends CI_Model {

    protected $table = 'kpi_tb';

    private function checkTableExists()
    {
        $checkTable = $this->table;
        $this->load->dbforge();
        if($this->db->table_exists($checkTable) == FALSE){
            $fields = array(
                'kt_bil' => array(
                    'type' => 'BIGINT',
                    'null'=> FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
            ),
            'kt_japen_bil' => array(
              'type' => 'BIGINT',
              'null' => TRUE
            ),
            'kt_japen_pejabat' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
            ),
            'kt_jenis_program_bil' => array(
              'type' => 'BIGINT',
              'null' => TRUE
            ),
            'kt_jenis_program_nama' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
            ),
            'kt_bilangan' => array(
                'type' => 'BIGINT',
                'null' => TRUE
            ),
            'kt_pengguna_bil' => array(
              'type' => 'BIGINT',
              'null' => TRUE
            ),
            'kt_pengguna_nama' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
            ),
            'kt_tarikh_masuk' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('kt_bil', TRUE);
            $this->dbforge->create_table($this->table, TRUE);
        }
    }

    public function laporan_kpi($japen_bil, $jenis_bil){
        $this->checkTableExists();
        $this->db->where('kt_japen_bil', $japen_bil);
        $this->db->where('kt_jenis_program_bil', $jenis_bil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function kpi($japen_bil, $jenis_bil){
        $this->checkTableExists();
        $this->db->where('kt_japen_bil', $japen_bil);
        $this->db->where('kt_jenis_program_bil', $jenis_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_kpi()
    {
        $this->checkTableExists();
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function tambah($japen_bil, $japen_pejabat, $jenis_program_bil, $jenis_program_nama, $pengguna_bil, $pengguna_nama, $tarikh)
    {
        $data = array(
            'kt_japen_bil' => $japen_bil,
            'kt_japen_pejabat' => $japen_pejabat,
            'kt_jenis_program_bil' => $jenis_program_bil,
            'kt_jenis_program_nama' => $jenis_program_nama,
            'kt_bilangan' => 0,
            'kt_pengguna_bil' => $pengguna_bil,
            'kt_pengguna_nama' => $pengguna_nama,
            'kt_tarikh_masuk' => date_format(date_create($tarikh), "Y-m-d H:i:s")
        );
        return $this->db->insert($this->table, $data); 
    }

    public function daftar()
    {
        $data = array(
            'kt_japen_bil' => $this->input->post('input_japen_bil'),
            'kt_japen_pejabat' => $this->input->post('input_japen_pejabat'),
            'kt_jenis_program_bil' => $this->input->post('input_jenis_program_bil'),
            'kt_jenis_program_nama' => $this->input->post('input_jenis_program_nama'),
            'kt_bilangan' => $this->input->post('input_bilangan'),
            'kt_pengguna_bil' => $this->input->post('input_pengguna_bil'),
            'kt_pengguna_nama' => $this->input->post('input_pengguna_nama'),
            'kt_tarikh_masuk' => date_format(date_create($this->input->post('input_tarikh_masa')), "Y-m-d H:i:s")
        );
        return $this->db->insert($this->table, $data);
    }

    public function kemaskini()
    {
        $data = array(
            'kt_bilangan' => $this->input->post('input_bilangan'),
            'kt_tarikh_masuk' => date_format(date_create($this->input->post('input_tarikh_masa')), "Y-m-d H:i:s")
        );
        $this->db->where('kt_bil', $this->input->post('input_kpi_bil'));
        return $this->db->update($this->table, $data);
    }

    public function padam()
    {
        $this->db->where('kt_bil', $this->input->post('input_kpi_bil'));
        return $this->db->delete($this->table);
    }
}