<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_gambar_model extends CI_Model {

    private $tableName = 'gambar_program';

    public function senaraiProgramIkutGambar($kumpulanGambar){
        $this->db->select("gambar_program.gambar_program_nama_fail AS gambarNama");
        $this->db->select("UPPER(pengguna_tb.pengguna_tempat_tugas) AS organisasiPenganjur");
        $this->db->select("UPPER(jenis_tb.jt_nama) AS programNama");
        $this->db->select("DATE(program.program_tarikh_masa) AS programTarikh");
        $this->db->select("(SELECT GROUP_CONCAT(UPPER(lokasi1.lokasi_program_lokasi) SEPARATOR ', ') FROM lokasi_program AS lokasi1 WHERE lokasi1.lokasi_program_program = program.program_bil) AS programLokasi");
        $this->db->select("UPPER(negeri_tb.nt_nama) AS programNegeri");
        $this->db->select("negeri_tb.nt_nama_fail AS programGambarNegeri");
        $this->db->join('program', 'program.program_bil = gambar_program.gambar_program_program', 'left');
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        $this->db->group_start();
        foreach($kumpulanGambar as $gambar){
            $namaFail = basename($gambar);
            $this->db->or_where('gambar_program_nama_fail', $namaFail);
        }
        $this->db->group_end();
        $this->db->order_by("RAND()");
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    //1. UDPATES
    public function update20231125(){
        $this->binaTable();
    }
        //1.1. UPDATE FILE NAME USING BIL
        public function kemaskiniNamaFail($fileName, $gambarBil){
            $data = array('gambar_program_nama_fail' => $fileName);
            $this->db->where('gambar_program_bil', $gambarBil);
            $this->db->update($this->tableName, $data);
        }
    //2. DELETE VALUES
        //2.1. DELETE IF UPLOAD PICTURE UNSUCCESSFULLY
        public function padamGambar($gambarBil){
            $this->db->where('gambar_program_bil', $gambarBil);
            $this->db->delete($this->tableName);
        }
        //2.2. DELETE USING PROGRAM POST
        public function padamPost(){
            $this->db->where('gambar_program_program', $this->input->post('inputProgramBil'));
            $this->db->delete($this->tableName);
        }
    //3. ADD VALUES
        //3.1. ADD NEW PICTURE
        public function tambah(){
            $data = array(
                'gambar_program_nama_fail' => $this->input->post('inputNamaFail'),
                'gambar_program_program' => $this->input->post('inputProgramBil'),
                'gambar_program_deskripsi' => $this->input->post('inputDeskripsi'), 
                'gambar_program_pengguna' => $this->input->post('inputPenggunaBil'),
                'gambar_program_pengguna_waktu' => date("Y-m-d H:i:s")
            );
            $return_data['insert_data'] = $this->db->insert($this->tableName, $data);
            $return_data['last_id'] = $this->db->insert_id();
            return $return_data;
        }
    //4. VIEW TABLE
    //4.1 VIEW MANY 
    //4.1.1 PROGRAM BIL
    public function senaraiGambarIkutProgram($programBil){
        if($this->db->table_exists($this->tableName) == TRUE){
            $select = [
                "*",
                "gambar_program.gambar_program_nama_fail AS gambarNamaFail",
                "UPPER(gambar_program.gambar_program_deskripsi) AS gambarDeskripsi",
            ];
            $this->db->select($select);
            $this->db->where('gambar_program_program', $programBil);
            $query = $this->db->get($this->tableName);
            return $query->result();
        }
    }
    //4.2 VIEW ONE  
    //4.2.1 GAMBAR BIL
    public function gambar($gambarBil){
        if($this->db->table_exists($this->tableName) == TRUE){
            $this->db->where('gambar_program_bil', $gambarBil);
            $query = $this->db->get($this->tableName);
            return $query->row();
        }
    }
    
    //5. CREATE TABLE
    private function binaTable()
    {
        //LOAD LIBRARIES
        $this->load->dbforge();

        if($this->db->table_exists($this->tableName) == FALSE)
        {
            $fields = array(
                'gambar_program_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'gambar_program_nama_fail' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
                ),
                'gambar_program_program' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'gambar_program_deskripsi' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'gambar_program_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'gambar_program_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('gambar_program_bil', TRUE);
            $this->dbforge->create_table($this->tableName);
        }
    }
}

?>