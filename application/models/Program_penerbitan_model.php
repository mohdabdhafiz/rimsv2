<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_penerbitan_model extends CI_Model {

    private $tableName = 'penerbitan_program';

    public function update20240120(){
        $this->binaTable();
    }

    //4. VIEW

    public function ada($penerbitan, $programBil){
        $this->db->where('penerbitan_program_program', $programBil);
        $this->db->where('penerbitan_program_penerbitan', $penerbitan);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

        //4.1 VIEW MANY
        public function senaraipenerbitan($programBil){
            $this->db->where('penerbitan_program_program', $programBil);
            $this->db->order_by('penerbitan_program_pengguna_waktu', 'DESC');
            $query = $this->db->get($this->tableName);
            return $query->result();
        }
    //5. ADD
        //5.1 ADD NEW URL USING POST
        public function tambahpenerbitanPost(){
            //5.1.1 COLLECT DATA
            $data = array(
                'penerbitan_program_program' => $this->input->post('inputProgram'),
                'penerbitan_program_penerbitan' => $this->input->post('inputpenerbitan'),
                'penerbitan_program_bilangan' => $this->input->post('inputBilanganPenerbitan'),
                'penerbitan_program_pengguna' => $this->input->post('inputPenggunaBil'),
                'penerbitan_program_pengguna_waktu' => date("Y-m-d H:i:s")
            );
            //5.1.2 STORE DATA
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
        $this->db->where('penerbitan_program_program', $this->input->post('inputProgramBil'));
        $this->db->delete($this->tableName);
    }

    public function padampenerbitanProgram($penerbitanBil){
        $this->db->where('penerbitan_program_bil', $penerbitanBil);
        return $this->db->delete($this->tableName);
    }

    private function binaTable(){
        $this->load->dbforge();
        if($this->db->table_exists($this->tableName) == FALSE)
        {
            $fields = array(
                'penerbitan_program_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'penerbitan_program_program' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE
                ),
                'penerbitan_program_penerbitan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'penerbitan_program_bilangan' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'penerbitan_program_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'penerbitan_program_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('penerbitan_program_bil', TRUE);
            $this->dbforge->create_table($this->tableName);
        }
    }

}

?>