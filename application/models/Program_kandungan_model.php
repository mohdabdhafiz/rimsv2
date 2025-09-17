<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_kandungan_model extends CI_Model {

    private $tableName = 'kandungan_program';

    public function senaraiHebahan(){
        $this->db->select("kandungan_program_kandungan AS hebahanNama");
        $this->db->group_by("kandungan_program_kandungan");
        $this->db->order_by("kandungan_program_kandungan", "ASC");
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function update20240108(){
        $this->binaTable();
    }

    //4. VIEW

    public function ada($tajuk, $programBil){
        $this->db->where('kandungan_program_program', $programBil);
        $this->db->where('kandungan_program_kandungan', $tajuk);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

        //4.1 VIEW MANY
        public function senaraiTajuk($programBil){
            $this->db->where('kandungan_program_program', $programBil);
            $this->db->order_by('kandungan_program_pengguna_waktu', 'DESC');
            $query = $this->db->get($this->tableName);
            return $query->result();
        }
    //5. ADD
        //5.1 ADD NEW URL USING POST
        public function tambahKandunganPost(){
            //5.1.1 COLLECT DATA
            $data = array(
                'kandungan_program_program' => $this->input->post('inputProgram'),
                'kandungan_program_kandungan' => $this->input->post('inputKandungan'),
                'kandungan_program_pengguna' => $this->input->post('inputPenggunaBil'),
                'kandungan_program_pengguna_waktu' => date("Y-m-d H:i:s")
            );
            //5.1.2 STORE DATA
            return $this->db->insert($this->tableName, $data);
        }
        //5.2 ADD NEW MANUALLY
        public function tambahKandunganManual($programBil, $kandungan, $penggunaBil){
            //5.2.1 COLLECT DATA
            $data = array(
                'kandungan_program_program' => $programBil,
                'kandungan_program_kandungan' => $kandungan,
                'kandungan_program_pengguna' => $penggunaBil,
                'kandungan_program_pengguna_waktu' => date("Y-m-d H:i:s")
            );
            //5.2.2 STORE DATA
            return $this->db->insert($this->tableName, $data);
        }
    //6. EDIT
        //6.1 EDIT URL USING POST
        public function kemaskiniPautan(){
            $data = array(
                'pautan_program_pautan' => $this->input->post('inputPautan'),
                'pautan_program_pengguna' => $this->input->post('inputPenggunaBil'),
                'pautan_program_pengguna_waktu' => date('Y-m-d H:i:s')
            );
            $this->db->where('pautan_program_program', $this->input->post('inputProgramBil'));
            $this->db->where('pautan_program_bil', $this->input->post('inputPautanBil'));
            $this->db->update($this->tableName, $data);
        }
    //7. DELETE

    public function padamPost(){
        $this->db->where('kandungan_program_program', $this->input->post('inputProgramBil'));
        $this->db->delete($this->tableName);
    }

    public function padamKandunganProgram($kandunganBil){
        $this->db->where('kandungan_program_bil', $kandunganBil);
        return $this->db->delete($this->tableName);
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableName) == FALSE)
        {
            $fields = array(
                'kandungan_program_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'kandungan_program_program' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE
                ),
                'kandungan_program_kandungan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'kandungan_program_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'kandungan_program_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('kandungan_program_bil', TRUE);
            $this->dbforge->create_table($this->tableName);
        }
    }

}

?>