<?php
class Obp_model extends CI_Model {

    public function bilanganLaporanUtama($senaraiPeranan){
        $bilanganLaporan = 0;
        foreach($senaraiPeranan as $peranan){
            $namaTable = 'obp_'.$peranan->peranan_bil;
            if($this->db->table_exists($namaTable)){
                $query = $this->db->get($namaTable);
                $bilanganLaporan = $bilanganLaporan + $query->num_rows();
            }
        }
        return $bilanganLaporan;
    }

    public function obpBilPeranan($obpBil, $perananBil){
        if($this->db->table_exists('obp_'.$perananBil)){
            $this->db->where('obp_id', $obpBil);
            $this->db->where('peranan_id', $perananBil);
            $query = $this->db->get('obp_'.$perananBil);
            return $query->row();
        }
    }

    public function bilanganLaporan($perananBil, $senaraiDaerah){
        $namaTable = 'obp_'.$perananBil;
        $bilanganLaporan = 0;
        if($this->db->table_exists($namaTable)){
            $this->db->select('COUNT(*) AS bilanganLaporan');
            $this->db->group_start();
            foreach($senaraiDaerah as $daerah){
                $this->db->or_where('obp_'.$perananBil.'.daerah_id', $daerah->bil);
            }
            $this->db->group_end();
            $query = $this->db->get($namaTable);
            $bilanganLaporan = $bilanganLaporan + $query->row()->bilanganLaporan;
        }
        return $bilanganLaporan;
    }

    public function bilanganObpNegeri($senaraiNegeri, $idPeranan)
    {
        if($this->db->table_exists('obp_'.$idPeranan)){
        $this->db->select("COUNT(*) AS jumlahObp");
        foreach($senaraiNegeri as $negeri){
            $this->db->or_group_start();
                $this->db->where('obp_'.$idPeranan.'.negeri_id', $negeri->nt_bil);
                $this->db->where('obp_'.$idPeranan.'.peranan_id', $idPeranan);
            $this->db->group_end();
        }

        $query = $this->db->get('obp_'.$idPeranan);
        return $query->row();
        }
    }

    //VIEW TABLE
    public function exactObp($perananBil, $negeriBil, $daerahBil, $parlimenBil, $dunBil, $obpBil){
        if($this->db->table_exists('obp_'.$perananBil)){
            if(!empty($negeriBil)){
                $this->db->where('negeri_id', $negeriBil);
            }
            if(!empty($daerahBil)){
                $this->db->where('daerah_id', $daerahBil);
            }
            if(!empty($parlimenBil)){
                $this->db->where('parlimen_id', $parlimenBil);
            }
            if(!empty($dunBil)){
                $this->db->where('dun_id', $dunBil);
            }
            $this->db->where('obp_id', $obpBil);
            $query = $this->db->get('obp_'.$perananBil);
            return $query->row();
        }
    }

    public function obpProgram2($perananBil, $daerahSenarai){
        if($this->db->table_exists('obp_'.$perananBil)){
            if(!empty($daerahSenarai)){
                $this->db->group_start();
                foreach($daerahSenarai as $daerah){
                    $this->db->or_where('daerah_id', $daerah->bil);
                }
                $this->db->group_end();
            }
            $this->db->order_by('obp_nama', 'ASC');
            $query = $this->db->get('obp_'.$perananBil);
            return $query->result();
        }
    }

    public function obpProgram($perananBil, $negeriBil, $daerahBil, $parlimenBil, $dunBil){
        if($this->db->table_exists('obp_'.$perananBil)){
            if(!empty($negeriBil)){
                $this->db->where('negeri_id', $negeriBil);
            }
            if(!empty($daerahBil)){
                $this->db->where('daerah_id', $daerahBil);
            }
            if(!empty($parlimenBil)){
                $this->db->where('parlimen_id', $parlimenBil);
            }
            if(!empty($dunBil)){
                $this->db->where('dun_id', $dunBil);
            }
            $query = $this->db->get('obp_'.$perananBil);
            return $query->result();
        }
    }
    
    public function senaraiObpIkutNegeriPeranan($negeriBil, $idPeranan)
    {
        if($this->db->table_exists('obp_'.$idPeranan)){
        $this->db->select("*");
        $this->db->select('obp_'.$idPeranan.'.obp_id AS siriObp');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = obp_'.$idPeranan.'.negeri_id', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = obp_'.$idPeranan.'.parlimen_id', 'left');
        $this->db->join('daerah', 'daerah.bil = obp_'.$idPeranan.'.daerah_id', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = obp_'.$idPeranan.'.dun_id', 'left');
        $this->db->join('obp_gambar_'.$idPeranan, 'obp_gambar_'.$idPeranan.'.obp_id = obp_'.$idPeranan.'.obp_id', 'left');
        $this->db->where('obp_'.$idPeranan.'.negeri_id', $negeriBil);
        $this->db->where('obp_'.$idPeranan.'.peranan_id', $idPeranan);

        $query = $this->db->get('obp_'.$idPeranan);
        return $query->result();
        }
    }

    public function senaraiObpIkutParlimenPeranan($parlimenBil, $idPeranan)
    {
        if($this->db->table_exists('obp_'.$idPeranan)){
        $this->db->select("*");
        $this->db->select('obp_'.$idPeranan.'.obp_id AS siriObp');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = obp_'.$idPeranan.'.negeri_id', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = obp_'.$idPeranan.'.parlimen_id', 'left');
        $this->db->join('daerah', 'daerah.bil = obp_'.$idPeranan.'.daerah_id', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = obp_'.$idPeranan.'.dun_id', 'left');
        $this->db->join('obp_gambar_'.$idPeranan, 'obp_gambar_'.$idPeranan.'.obp_id = obp_'.$idPeranan.'.obp_id', 'left');
        $this->db->where('obp_'.$idPeranan.'.parlimen_id', $parlimenBil);
        $this->db->where('obp_'.$idPeranan.'.peranan_id', $idPeranan);

        $query = $this->db->get('obp_'.$idPeranan);
        return $query->result();
        }
    }

    public function senaraiObpIkutDunPeranan($dunBil, $idPeranan)
    {
        if($this->db->table_exists('obp_'.$idPeranan)){
        $this->db->select("*");
        $this->db->select('obp_'.$idPeranan.'.obp_id AS siriObp');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = obp_'.$idPeranan.'.negeri_id', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = obp_'.$idPeranan.'.parlimen_id', 'left');
        $this->db->join('daerah', 'daerah.bil = obp_'.$idPeranan.'.daerah_id', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = obp_'.$idPeranan.'.dun_id', 'left');
        $this->db->join('obp_gambar_'.$idPeranan, 'obp_gambar_'.$idPeranan.'.obp_id = obp_'.$idPeranan.'.obp_id', 'left');
        $this->db->where('obp_'.$idPeranan.'.dun_id', $dunBil);
        $this->db->where('obp_'.$idPeranan.'.peranan_id', $idPeranan);

        $query = $this->db->get('obp_'.$idPeranan);
        return $query->result();
        }
    }

    public function __construct()
        {
                $this->load->database();
                $this->load->dbforge();
        }

    public function tambah()
    {
        $perananBil = $this->input->post('inputPeranan'); 
        $this->checkTableExists($perananBil);
        $this->binaTableGambar($perananBil);

        $data = array(
            'obp_nama' => $this->input->post('inputNama'),
            'obp_jawatan' => $this->input->post('inputJawatan'),
            'obp_alamat' => $this->input->post('inputAlamat'),
            'obp_no_tel' => $this->input->post('inputNoTel'),
            'obp_email' => $this->input->post('inputE-mail'),
            'obp_umur' => $this->input->post('inputUmur'),
            'obp_jantina' => $this->input->post('inputJantina'),
            'obp_kaum' => $this->input->post('inputKaum'),
            'negeri_id' => $this->input->post('inputNegeri'),
            'parlimen_id' => $this->input->post('inputParlimen'),
            'daerah_id' => $this->input->post('inputDaerah'),
            'dun_id' => $this->input->post('inputDun'),
            'peranan_id' => $this->input->post('inputPeranan'),
            'pengguna_id' => $this->input->post('inputPengguna'),
            'pengguna_waktu' => date('Y-m-d H:i:s')
        );

        $this->db->insert('obp_'.$perananBil, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    private function checkTableExists($perananBil)
    {
        if($this->db->table_exists('obp_'.$perananBil) == FALSE)
        {
            $fields = array(
                'obp_id' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'obp_nama' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '250',
                    'null' => TRUE
                ),
                'obp_jawatan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
                ),
                'obp_alamat' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'obp_no_tel' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
                ),
                'obp_email' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
                ),
                'obp_umur' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
                ),
                'obp_jantina' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE
                ),
                'obp_kaum' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE
                ),
                'negeri_id' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'parlimen_id' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'dun_id' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'daerah_id' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'peranan_id' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'pengguna_id' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('obp_id', TRUE);
            $this->dbforge->create_table('obp_'.$perananBil, TRUE);
        }
    }

    public function senarai($peranan_id)
    {
        $nama_table = 'obp_'.$peranan_id;
        if($this->db->table_exists($nama_table)){
            $this->db->select('*');
            $query = $this->db->get($nama_table);
            return $query->result();
        }
    }
    
    public function senaraiIkutPeranan($idPeranan)
    {
        $nama_table = 'obp_'.$idPeranan;
        $nama_table2 = 'obp_gambar_'.$idPeranan;

        if($this->db->table_exists($nama_table) == TRUE && $this->db->table_exists($nama_table2) == TRUE)
        {
            $this->db->select("*");
            $this->db->select('obp_'.$idPeranan.'.pengguna_waktu AS waktuPendaftaran');
        $this->db->select('obp_'.$idPeranan.'.obp_id AS siriObp');
        $this->db->join('obp_gambar_'.$idPeranan, 'obp_gambar_'.$idPeranan.'.obp_id = obp_'.$idPeranan.'.obp_id', 'left');
        
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = obp_'.$idPeranan.'.negeri_id', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = obp_'.$idPeranan.'.parlimen_id', 'left');
        $this->db->join('daerah', 'daerah.bil = obp_'.$idPeranan.'.daerah_id', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = obp_'.$idPeranan.'.dun_id', 'left');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = obp_'.$idPeranan.'.pengguna_id', 'left');
        

        $this->db->where('obp_'.$idPeranan.'.peranan_id', $idPeranan);
        $this->db->order_by('obp_nama', "ASC");

        $query = $this->db->get('obp_'.$idPeranan);
        return $query->result();
        }
    }

    public function senaraiIkutNegeri($negeri_id, $daerah_id)
    {
        $this->db->where('negeri_id', $negeri_id);
        $this->db->where('daerah_id', $daerah_id);

        $query = $this->db->get('obp_'.$negeri_id);
        return $query->result();
    }

    public function maklumatIkutPeranan($bil, $idPeranan)
    {
        $this->db->select("*");
        $this->db->select('obp_'.$idPeranan.'.obp_id AS siriObp');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = obp_'.$idPeranan.'.negeri_id', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = obp_'.$idPeranan.'.parlimen_id', 'left');
        $this->db->join('daerah', 'daerah.bil = obp_'.$idPeranan.'.daerah_id', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = obp_'.$idPeranan.'.dun_id', 'left');
        $this->db->join('obp_gambar_'.$idPeranan, 'obp_gambar_'.$idPeranan.'.obp_id = obp_'.$idPeranan.'.obp_id', 'left');
        $this->db->where('obp_'.$idPeranan.'.obp_id', $bil);
        $this->db->where('obp_'.$idPeranan.'.peranan_id', $idPeranan);

        $query = $this->db->get('obp_'.$idPeranan);
        return $query->row();
    }

    public function maklumatIkutNegeri($bil, $negeri_id)
    {
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = obp_'.$negeri_id.'.negeri_id', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = obp_'.$negeri_id.'.parlimen_id', 'left');
        $this->db->join('daerah', 'daerah.bil = obp_'.$negeri_id.'.daerah_id', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = obp_'.$negeri_id.'.dun_id', 'left');
        $this->db->where('obp_id', $bil);
        $this->db->where('negeri_id', $negeri_id);

        $query = $this->db->get('obp_'.$negeri_id);
        return $query->row();
    }

    public function kemaskiniIkutNegeri($bil, $negeri_id)
    {
        $data = array(
            'obp_nama' => $this->input->post('inputNama'),
            'obp_jawatan' => $this->input->post('inputJawatan'),
            'obp_alamat' => $this->input->post('inputAlamat'),
            'obp_no_tel' => $this->input->post('inputNoTel'),
            'obp_email' => $this->input->post('inputE-mail'),
            'obp_umur' => $this->input->post('inputUmur'),
            'obp_jantina' => $this->input->post('inputJantina'),
            'obp_kaum' => $this->input->post('inputKaum'),
            'negeri_id' => $this->input->post('inputNegeri'),
            'parlimen_id' => $this->input->post('inputParlimen'),
            'daerah_id' => $this->input->post('inputDaerah'),
            'dun_id' => $this->input->post('inputDun'),
            'pengguna_id' => $this->input->post('inputPengguna'),
            'pengguna_waktu' => date('Y-m-d H:i:s')
        );
        $this->db->where('obp_id', $bil);
        $this->db->update('obp_'.$negeri_id, $data);
    }

    public function kemaskiniIkutPeranan($bil, $idPeranan)
    {
        $negeriBil = $this->input->post('inputNegeri');
        $daerahBil = $this->input->post('inputDaerah');
        $parlimenBil = $this->input->post('inputParlimen');
        $dunBil = $this->input->post('inputDun');
        if(empty($negeriBil)){
            $negeriBil = 0;
        }
        if(empty($daerahBil)){
            $negeriBil = 0;
        }
        if(empty($parlimenBil)){
            $negeriBil = 0;
        }
        if(empty($dunBil)){
            $negeriBil = 0;
        }
        $data = array(
            'obp_nama' => $this->input->post('inputNama'),
            'obp_jawatan' => $this->input->post('inputJawatan'),
            'obp_alamat' => $this->input->post('inputAlamat'),
            'obp_no_tel' => $this->input->post('inputNoTel'),
            'obp_email' => $this->input->post('inputE-mail'),
            'obp_umur' => $this->input->post('inputUmur'),
            'obp_jantina' => $this->input->post('inputJantina'),
            'obp_kaum' => $this->input->post('inputKaum'),
            'negeri_id' => $negeriBil,
            'parlimen_id' => $parlimenBil,
            'daerah_id' => $daerahBil,
            'dun_id' => $dunBil,
            'peranan_id' => $this->input->post('inputPeranan'),
            'pengguna_id' => $this->input->post('inputPengguna'),
            'pengguna_waktu' => date('Y-m-d H:i:s')
        );
        $this->db->where('obp_id', $bil);
        $this->db->where('peranan_id', $idPeranan);
        $this->db->update('obp_'.$idPeranan, $data);
    }

    public function kemaskini_gambar($bil)
    {
        
        $data = array(
            'obp_nama' => $this->input->post('inputGambar')
        );

        $this->db->where('obp_id', $bil);
        $this->db->update('test_obp', $data);
    }

    public function padamIkutNegeri($bil, $negeri_id)
    {
        $this->db->where('obp_id', $bil);
        $this->db->delete('obp_'.$negeri_id);
    }

    public function padamIkutPeranan($bil, $idPeranan)
    {
        $this->db->where('obp_id', $bil);
        $this->db->where('peranan_id', $idPeranan);
        $this->db->delete('obp_'.$idPeranan);
    }

    private function binaTableGambar($idPeranan)
    {
        if($this->db->table_exists('obp_gambar_'.$idPeranan) == FALSE)
        {
            $fields = array(
                'og_id' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'og_file' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '250',
                    'null' => TRUE
                ),
                'og_deskripsi' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200',
                    'null' => TRUE
                ),
                'obp_id' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'peranan_id' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'pengguna_id' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('og_id', TRUE);
            $this->dbforge->create_table('obp_gambar_'.$idPeranan, TRUE);
        }
    }

    public function tambah_gambar($bil)
    {
        $data = array(
            'obp_gambar' => $this->input->post('inputGambar')
        );

        $this->db->insert('test_obp', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function gambarObp($idObp, $idPeranan){
        $namaTable = 'obp_gambar_'.$idPeranan;
        if($this->db->table_exists($namaTable) !== FALSE){
            $this->db->select('og_id');
            $this->db->where('obp_id', $idObp);
            $query = $this->db->get($namaTable);
            return $query->row();
        }
    }

    public function muatNaikGambarObp($fileName, $idObp, $idPengguna, $idPeranan){
        $this->binaTableGambar($idPeranan);
        $adaGambar = $this->gambarObp($idObp, $idPeranan);
        $namaTable = 'obp_gambar_'.$idPeranan;
        if(empty($adaGambar)){
            $data = array(
                'og_file' => $fileName,
                'og_deskripsi' => $this->input->post('inputDeskripsi'),
                'obp_id' => $idObp,
                'peranan_id' => $idPeranan,
                'pengguna_id' => $idPengguna,
                'pengguna_waktu' => date("Y-m-d H:i:s")
            );

            $this->db->insert('obp_gambar_'.$idPeranan, $data);
            $idInsert = $this->db->insert_id();
            return $idInsert;
        }else{
            $data = array(
                'og_file' => $fileName,
                'og_deskripsi' => $this->input->post('inputDeskripsi'),
                'obp_id' => $idObp,
                'peranan_id' => $idPeranan,
                'pengguna_id' => $idPengguna,
                'pengguna_waktu' => date("Y-m-d H:i:s")
            );
            $this->db->where('obp_id', $idObp);
            $this->db->update($namaTable, $data);
            return $adaGambar->og_id;
        }
    }
}
?>