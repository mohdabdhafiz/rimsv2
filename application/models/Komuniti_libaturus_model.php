<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komuniti_libaturus_model extends CI_Model {

    private $tableName = 'komuniti_libat_urus';
    private $tableSenarai = 'komuniti_libat_urus_senarai';
    private $tableGambar = 'komuniti_libat_urus_gambar';

    public function senaraiKeputusanPerjumpaanNama($nama){
        $this->db->select('UPPER(komuniti_libat_urus.komuniti_libat_urus_nama) AS nama');
        $this->db->select('komuniti_libat_urus.komuniti_libat_urus_bil AS siri');
        $this->db->select('komuniti_libat_urus.komuniti_libat_urus_tarikh_masa AS tarikhMasa');
        $this->db->select('UPPER(komuniti_libat_urus.komuniti_libat_urus_nama_pengguna) AS pelapor');
        $this->db->where('komuniti_libat_urus.komuniti_libat_urus_nama', $nama);
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function senaraiPerjumpaan(){
        $this->db->select('UPPER(komuniti_libat_urus.komuniti_libat_urus_nama) AS nama');
        $this->db->group_by('komuniti_libat_urus.komuniti_libat_urus_nama');
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function bilanganLibatUrus($penggunaBil){
        $this->db->select("COUNT(komuniti_libat_urus.komuniti_libat_urus_pengguna) AS bilanganLaporan");
        $this->db->where('komuniti_libat_urus.komuniti_libat_urus_pengguna', $penggunaBil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function senaraiProgramPpd($perananBil){
        $this->db->select("UPPER(pengguna_tb.nama_penuh) AS pelaporNama");
        $this->db->select("COUNT(*) AS jumlah");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = komuniti_libat_urus.komuniti_libat_urus_pengguna', 'left');
        $this->db->where('pengguna_tb.pengguna_peranan_bil', $perananBil);
        $this->db->where('YEAR(komuniti_libat_urus.komuniti_libat_urus_tarikh_masa)', date("Y"));
        $this->db->group_by('pelaporNama');
        $this->db->order_by('jumlah', 'DESC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function padamLaporan($libatUrusBil){
        $this->db->where('komuniti_libat_urus_bil', $libatUrusBil); 
        $this->db->delete($this->tableName);
    }

    public function kemaskini(){
        $data = array(
            'komuniti_libat_urus_nama' => $this->input->post('inputTajukPerjumpaan'),
            'komuniti_libat_urus_tarikh_masa' => $this->input->post('inputTarikhMasa'),
            'komuniti_libat_urus_kehadiran' => $this->input->post('inputKehadiran'),
            'komuniti_libat_urus_catatan' => $this->input->post('inputCatatan'),
            'komuniti_libat_urus_lokasi' => $this->input->post('inputLokasi'),
            'komuniti_libat_urus_pengguna' => $this->input->post('inputPenggunaBil'),
            'komuniti_libat_urus_nama_pengguna' => $this->input->post('inputPenggunaNama'),
            'komuniti_libat_urus_jawatan_pengguna' => $this->input->post('inputPenggunaJawatan'),
            'komuniti_libat_urus_nombor_telefon_pengguna' => $this->input->post('inputPenggunaNoTel'),
            'komuniti_libat_urus_penempatan_pengguna' => $this->input->post('inputPenggunaPenempatan')
        );
        $this->db->where('komuniti_libat_urus_bil', $this->input->post('inputLibatUrusBil'));
        $this->db->update($this->tableName, $data);
    }

    public function padamGambar($gambarBil){
        $this->db->where('komuniti_libat_urus_gambar_bil', $gambarBil); 
        $this->db->delete($this->tableGambar);
    }

    public function gambar($gambarBil){
        $this->db->where('komuniti_libat_urus_gambar_bil', $gambarBil);
        $query = $this->db->get($this->tableGambar);
        return $query->row();
    }

    public function senaraiGambar($libatUrusBil){
        $this->db->select("komuniti_libat_urus_gambar_nama AS gambarNama");
        $this->db->select("komuniti_libat_urus_gambar_bil AS gambarBil");
        $this->db->where('komuniti_libat_urus_gambar_komuniti_libat_urus', $libatUrusBil);
        $query = $this->db->get($this->tableGambar);
        return $query->result();
    }

    public function tambahGambar($gambarNama, $libatUrusBil, $penggunaBil, $penggunaNama, $penggunaJawatan, $penggunaNoTel){
        $data = array(
            'komuniti_libat_urus_gambar_nama' => $gambarNama,
            'komuniti_libat_urus_gambar_komuniti_libat_urus' => $libatUrusBil,
            'komuniti_libat_urus_gambar_pengguna' => $penggunaBil,
            'komuniti_libat_urus_gambar_nama_pengguna' => $penggunaNama,
            'komuniti_libat_urus_gambar_jawatan_pengguna' => $penggunaJawatan,
            'komuniti_libat_urus_gambar_nombor_telefon_pengguna' => $penggunaNoTel,
            'komuniti_libat_urus_gambar_pengguna_waktu' => date("Y-m-d H:i:s")
        );
        return $this->db->insert($this->tableGambar, $data);
    }

    public function adaDalamSenarai($kmBil, $libatUrusBil){
        $this->db->where('komuniti_libat_urus_senarai_komuniti_bil', $kmBil);
        $this->db->where('komuniti_libat_urus_senarai_komuniti_libat_urus_bil', $libatUrusBil);
        $query = $this->db->get($this->tableSenarai);
        return $query->row();
    }

    public function buangSemuaTerlibat($libatUrusBil){
        $this->db->where('komuniti_libat_urus_senarai_komuniti_libat_urus_bil', $libatUrusBil);
        $this->db->delete($this->tableSenarai);
    }

    public function tambahKomunitiTerlibat($km, $libatUrus, $pengguna){
        $data = array(
            'komuniti_libat_urus_senarai_komuniti_libat_urus_bil' => $libatUrus->libatUrusBil,
            'komuniti_libat_urus_senarai_komuniti_libat_urus_nama' => strtoupper($libatUrus->libatUrusNama),
            'komuniti_libat_urus_senarai_komuniti_bil' => $km->komuniti_bil,
            'komuniti_libat_urus_senarai_komuniti_nama' => strtoupper($km->komuniti_nama),
            'komuniti_libat_urus_senarai_pengguna' => $pengguna->bil,
            'komuniti_libat_urus_senarai_nama_pengguna' => strtoupper($pengguna->nama_penuh),
            'komuniti_libat_urus_senarai_jawatan_pengguna' => strtoupper($pengguna->pekerjaan),
            'komuniti_libat_urus_senarai_nombor_telefon_pengguna' => $pengguna->no_tel,
            'komuniti_libat_urus_senarai_pengguna_waktu' => date("Y-m-d H:i:s")
        );
        return $this->db->insert($this->tableSenarai, $data);
    }

    public function sKomunitiTerlibat($libatUrusBil){
        $this->db->select("komuniti_libat_urus_senarai.komuniti_libat_urus_senarai_komuniti_bil AS komunitiBil");
        $this->db->select("UPPER(komuniti_libat_urus_senarai.komuniti_libat_urus_senarai_komuniti_nama) AS komunitiNama");
        $this->db->select("UPPER(negeri_tb.nt_nama) AS negeriNama");
        $this->db->select("UPPER(daerah.nama) AS daerahNama");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS parlimenNama");
        $this->db->select("UPPER(dun_tb.dun_nama) AS dunNama");
        $join = array(
            ["table" => "komuniti", "joinColumn" => "komuniti.komuniti_bil = komuniti_libat_urus_senarai.komuniti_libat_urus_senarai_komuniti_bil", "type" => "left"],
            ["table" => "negeri_tb", "joinColumn" => "negeri_tb.nt_bil = komuniti.komuniti_negeri", "type" => "left"],
            ["table" => "daerah", "joinColumn" => "daerah.bil = komuniti.komuniti_daerah", "type" => "left"],
            ["table" => "parlimen_tb", "joinColumn" => "parlimen_tb.pt_bil = komuniti.komuniti_parlimen", "type" => "left"],
            ["table" => "dun_tb", "joinColumn" => "dun_tb.dun_bil = komuniti.komuniti_dun", "type" => "left"]
        );
        foreach($join as $j){
            $this->db->join($j['table'], $j['joinColumn'], $j['type']);
        }
        $this->db->where('komuniti_libat_urus_senarai.komuniti_libat_urus_senarai_komuniti_libat_urus_bil', $libatUrusBil);
        $this->db->order_by('dunNama', 'ASC');
        $this->db->order_by('komunitiNama', 'ASC');
        $query = $this->db->get($this->tableSenarai);
        return $query->result();
    }

    public function senaraiKomunitiTerlibat($libatUrusBil){
        $this->db->select("komuniti_libat_urus_senarai.komuniti_libat_urus_senarai_komuniti_bil AS komunitiBil");
        $this->db->where('komuniti_libat_urus_senarai.komuniti_libat_urus_senarai_komuniti_libat_urus_bil', $libatUrusBil);
        $query = $this->db->get($this->tableSenarai);
        return $query->result();
    }

    public function laporan($libatUrusBil){
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_bil AS libatUrusBil");
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_nama AS libatUrusNama");
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_lokasi AS libatUrusLokasi");
        $this->db->select("DATE(komuniti_libat_urus.komuniti_libat_urus_tarikh_masa) AS libatUrusTarikh");
        $this->db->select("TIME(komuniti_libat_urus.komuniti_libat_urus_tarikh_masa) AS libatUrusMasa");
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_tarikh_masa AS libatUrusTarikhMasa");
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_kehadiran AS libatUrusKehadiran");
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_catatan AS libatUrusCatatan");
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_pengguna AS libatUrusPelapor");
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_nama_pengguna AS libatUrusPelaporNama");
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_jawatan_pengguna AS libatUrusPelaporJawatan");
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_penempatan_pengguna AS libatUrusPelaporPenempatan");
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_nombor_telefon_pengguna AS libatUrusPelaporNoTel");
        $this->db->where('komuniti_libat_urus.komuniti_libat_urus_bil', $libatUrusBil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function tambah($penggunaPenempatan, $libatUrusNama, $libatUrusTarikhMasa, $libatUrusKehadiran, $libatUrusCatatan, $penggunaBil, $penggunaNama, $penggunaJawatan, $penggunaNoTel, $libatUrusLokasi){
        $data = array(
            'komuniti_libat_urus_nama' => $libatUrusNama,
            'komuniti_libat_urus_tarikh_masa' => $libatUrusTarikhMasa,
            'komuniti_libat_urus_kehadiran' => $libatUrusKehadiran,
            'komuniti_libat_urus_catatan' => $libatUrusCatatan,
            'komuniti_libat_urus_lokasi' => $libatUrusLokasi,
            'komuniti_libat_urus_pengguna' => $penggunaBil,
            'komuniti_libat_urus_nama_pengguna' => $penggunaNama,
            'komuniti_libat_urus_jawatan_pengguna' => $penggunaJawatan,
            'komuniti_libat_urus_nombor_telefon_pengguna' => $penggunaNoTel,
            'komuniti_libat_urus_penempatan_pengguna' => $penggunaPenempatan,
            'komuniti_libat_urus_pengguna_waktu' => date("Y-m-d H:i:s")
        );
        $this->db->insert($this->tableName, $data);
        return $this->db->insert_id();
    }

    public function senaraiLaporanPelapor($perananBil){
        $this->db->select("UPPER(pengguna_tb.nama_penuh) AS pelaporNama");
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_bil AS libatUrusBil");
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_nama AS libatUrusNama");
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_lokasi AS libatUrusLokasi");
        $this->db->select("DATE(komuniti_libat_urus.komuniti_libat_urus_tarikh_masa) AS libatUrusTarikh");
        $this->db->select("TIME(komuniti_libat_urus.komuniti_libat_urus_tarikh_masa) AS libatUrusMasa");
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_kehadiran AS libatUrusKehadiran");
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_catatan AS libatUrusCatatan");
        $this->db->select("(
            SELECT COUNT(*) FROM komuniti_libat_urus_gambar WHERE komuniti_libat_urus_gambar.komuniti_libat_urus_gambar_komuniti_libat_urus = komuniti_libat_urus.komuniti_libat_urus_bil
        ) AS libatUrusBilanganGambar");
        $this->db->select("(
            SELECT COUNT(*) FROM komuniti_libat_urus_senarai WHERE komuniti_libat_urus_senarai.komuniti_libat_urus_senarai_komuniti_libat_urus_bil = komuniti_libat_urus.komuniti_libat_urus_bil
        ) AS libatUrusBilanganKomuniti");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = komuniti_libat_urus.komuniti_libat_urus_pengguna', 'left');
        $this->db->where('pengguna_tb.pengguna_peranan_bil', $perananBil);
        $this->db->order_by('komuniti_libat_urus.komuniti_libat_urus_tarikh_masa', 'DESC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function senaraiLaporan($penggunaBil){
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_bil AS libatUrusBil");
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_nama AS libatUrusNama");
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_lokasi AS libatUrusLokasi");
        $this->db->select("DATE(komuniti_libat_urus.komuniti_libat_urus_tarikh_masa) AS libatUrusTarikh");
        $this->db->select("TIME(komuniti_libat_urus.komuniti_libat_urus_tarikh_masa) AS libatUrusMasa");
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_kehadiran AS libatUrusKehadiran");
        $this->db->select("komuniti_libat_urus.komuniti_libat_urus_catatan AS libatUrusCatatan");
        $this->db->select("(
            SELECT COUNT(*) FROM komuniti_libat_urus_gambar WHERE komuniti_libat_urus_gambar.komuniti_libat_urus_gambar_komuniti_libat_urus = komuniti_libat_urus.komuniti_libat_urus_bil
        ) AS libatUrusBilanganGambar");
        $this->db->select("(
            SELECT COUNT(*) FROM komuniti_libat_urus_senarai WHERE komuniti_libat_urus_senarai.komuniti_libat_urus_senarai_komuniti_libat_urus_bil = komuniti_libat_urus.komuniti_libat_urus_bil
        ) AS libatUrusBilanganKomuniti");
        $this->db->where('komuniti_libat_urus.komuniti_libat_urus_pengguna', $penggunaBil);
        $this->db->order_by('komuniti_libat_urus.komuniti_libat_urus_tarikh_masa', 'DESC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function rumusanLibatUrusNegeri($negeriSenarai){
        $this->db->select("komuniti_libat_urus_senarai_komuniti_libat_urus_nama AS komunitiNama");
        $this->db->select("COUNT(komuniti_libat_urus_senarai_komuniti_libat_urus_nama) AS bilanganPerjumpaan");
        $this->db->join('komuniti', 'komuniti.komuniti_bil = komuniti_libat_urus_senarai.komuniti_libat_urus_senarai_komuniti_bil', 'left');
        $this->db->group_start();
        foreach($negeriSenarai as $negeri){
            $this->db->or_where('komuniti.komuniti_negeri', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->group_by("komuniti_libat_urus_senarai_komuniti_libat_urus_nama");
        $query = $this->db->get($this->tableSenarai);
        return $query->result();
    }

    public function rumusanLibatUrusDaerah($daerahSenarai){
        $this->db->select("komuniti_libat_urus_senarai_komuniti_nama AS komunitiNama");
        $this->db->select("COUNT(komuniti_libat_urus_senarai_komuniti_nama) AS bilanganPerjumpaan");
        $this->db->join('komuniti', 'komuniti.komuniti_bil = komuniti_libat_urus_senarai.komuniti_libat_urus_senarai_komuniti_bil', 'left');
        $this->db->group_start();
        foreach($daerahSenarai as $daerah){
            $this->db->or_where('komuniti.komuniti_daerah', $daerah->bil);
        }
        $this->db->group_end();
        $this->db->group_by("komuniti_libat_urus_senarai_komuniti_nama");
        $this->db->order_by("bilanganPerjumpaan", "DESC");
        $query = $this->db->get($this->tableSenarai);
        return $query->result();
    }

    public function rumusanLibatUrus(){
        $this->db->select("komuniti_libat_urus_senarai_komuniti_libat_urus_nama AS komunitiNama");
        $this->db->select("COUNT(komuniti_libat_urus_senarai_komuniti_libat_urus_nama) AS bilanganPerjumpaan");
        $this->db->join('komuniti', 'komuniti.komuniti_bil = komuniti_libat_urus_senarai.komuniti_libat_urus_senarai_komuniti_bil', 'left');
        $this->db->group_by("komuniti_libat_urus_senarai_komuniti_libat_urus_nama");
        $query = $this->db->get($this->tableSenarai);
        return $query->result();
    }


    public function update20241130(){
        $this->binaTable();
    }

    private function binaTable(){
        //LOAD LIBRARIES
        $this->load->dbforge();

        $table = $this->tableName;
        $tableSenarai = $this->tableSenarai;
        $tableGambar = $this->tableGambar;

        //TABLE
        if($this->db->table_exists($table) == FALSE)
        {
            $fields = array(
                'komuniti_libat_urus_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'komuniti_libat_urus_nama' => array(
                    'type' => 'text',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_tarikh_masa' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_kehadiran' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_lokasi' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_catatan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_nama_pengguna' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_jawatan_pengguna' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_nombor_telefon_pengguna' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_penempatan_pengguna' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('komuniti_libat_urus_bil', TRUE);
            $this->dbforge->create_table($table);
        }

        if($this->db->table_exists($tableSenarai) == FALSE)
        {
            $fields = array(
                'komuniti_libat_urus_senarai_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'komuniti_libat_urus_senarai_komuniti_libat_urus_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_senarai_komuniti_libat_urus_nama' => array(
                    'type' => 'text',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_senarai_komuniti_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_senarai_komuniti_nama' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_senarai_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_senarai_nama_pengguna' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_senarai_jawatan_pengguna' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_senarai_nombor_telefon_pengguna' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_senarai_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('komuniti_libat_urus_senarai_bil', TRUE);
            $this->dbforge->create_table($tableSenarai);
        }

        if($this->db->table_exists($tableGambar) == FALSE)
        {
            $fields = array(
                'komuniti_libat_urus_gambar_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'komuniti_libat_urus_gambar_nama' => array(
                    'type' => 'text',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_gambar_komuniti_libat_urus' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_gambar_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_gambar_nama_pengguna' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_gambar_jawatan_pengguna' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_gambar_nombor_telefon_pengguna' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'komuniti_libat_urus_gambar_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('komuniti_libat_urus_gambar_bil', TRUE);
            $this->dbforge->create_table($tableGambar);
        }
    }

}