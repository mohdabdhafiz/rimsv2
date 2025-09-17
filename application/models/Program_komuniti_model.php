<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_komuniti_model extends CI_Model {

    private $tableName = 'komuniti_program';

    public function komunitiProgram($programBil, $komunitiBil){
        $this->db->select('komuniti_program_bil');
        $this->db->where('komuniti_program_program', $programBil);
        $this->db->where('komuniti_program_komuniti', $komunitiBil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function komunitiKehadiranProgram($programBil, $komunitiBil, $bilanganKehadiran){
        $this->db->select('komuniti_program_bil');
        $this->db->where('komuniti_program_program', $programBil);
        $this->db->where('komuniti_program_komuniti', $komunitiBil);
        $this->db->where('komuniti_program_bilangan_kehadiran', $bilanganKehadiran);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function kemaskiniBilanganKehadiran($bilanganKehadiran, $bil){
        $data = array(
            'komuniti_program_bilangan_kehadiran' => $bilanganKehadiran
        );
        $this->db->where('komuniti_program_bil', $bil);
        return $this->db->update($this->tableName, $data);
    }

    public function update20240220(){
        $this->binaTable();
    }

    public function libatProgram($komunitiBil){
        $this->db->select('*');
        $this->db->select('DATE(program.program_tarikh_masa) AS tarikhProgram');
        $this->db->join('program', 'program.program_bil = komuniti_program.komuniti_program_program', 'left');
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        $this->db->where('komuniti_program.komuniti_program_komuniti', $komunitiBil);
        $this->db->order_by('program.program_tarikh_masa', 'DESC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function tambahSatu($komunitiBil, $bilanganKehadiran, $programBil){
        $data = array(
            'komuniti_program_komuniti' => $komunitiBil,
            'komuniti_program_program' => $programBil,
            'komuniti_program_pengguna' => $this->input->post('inputPengguna'),
            'komuniti_program_pengguna_waktu' => date("Y-m-d H:i:s"),
            'komuniti_program_bilangan_kehadiran' => $bilanganKehadiran
        );
        return $this->db->insert($this->tableName, $data);
    }

    public function padam($programBil){
        $this->db->where('komuniti_program_program', $programBil);
        return $this->db->delete($this->tableName);
    }

    public function padamSatu($bil){
        $this->db->where('komuniti_program_bil', $bil);
        return $this->db->delete($this->tableName);
    }

    public function senarai($programBil){
        $select = [
            "*",
            "UPPER(komuniti.komuniti_nama) AS komunitiNama",
            "komuniti_program.komuniti_program_bilangan_kehadiran AS komunitiBilangan"
        ];
        $this->db->select($select);
        $this->db->join('komuniti', 'komuniti.komuniti_bil = komuniti_program.komuniti_program_komuniti', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = komuniti.komuniti_negeri', 'left');
        $this->db->where('komuniti_program_program', $programBil);
        $this->db->order_by('komuniti.komuniti_nama', 'ASC');
        $this->db->order_by('negeri_tb.nt_nama', 'ASC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function update20231224(){
        $this->binaTable();
    }

    private function binaTable(){
        //LOAD LIBRARIES
        $this->load->dbforge();

        if($this->db->table_exists($this->tableName) == FALSE)
        {
            $fields = array(
                'komuniti_program_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'komuniti_program_program' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'komuniti_program_komuniti' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'komuniti_program_bilangan_kehadiran' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'komuniti_program_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'komuniti_program_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('komuniti_program_bil', TRUE);
            $this->dbforge->create_table($this->tableName);
        }

        if($this->db->table_exists($this->tableName)){
            if(!$this->db->field_exists('komuniti_program_bilangan_kehadiran', $this->tableName)){
                $field = array(
                    'komuniti_program_bilangan_kehadiran' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($this->tableName, $field);
            }
        }

    }

}
?>