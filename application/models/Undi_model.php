<?php
class Undi_model extends CI_Model{

    protected $parlimen = 'keputusan_parlimen_tb';
    protected $dun = 'keputusan_dun_tb';

    public function padamStatusKeluarMengundiDun(){
        $this->db->where('dkmt_bil', $this->input->post('inputDkmtBil'));
        $this->db->delete('dun_keluar_mengundi_tb');
    }

    public function padamStatusKeluarMengundiParlimen(){
        $this->db->where('pkmt_bil', $this->input->post('inputPkmtBil'));
        $this->db->delete('parlimen_keluar_mengundi_tb');
    }

    public function senaraiKeluarMengundiParlimen($pilihanrayaBil)
    {
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = parlimen_keluar_mengundi_tb.pkmt_parlimen_bil', 'left');
        $this->db->where('pkmt_pilihanraya_bil', $pilihanrayaBil);
        $this->db->order_by('pkmt_waktu', 'DESC');
        $query = $this->db->get('parlimen_keluar_mengundi_tb');
        return $query->result();
    }

    public function senaraiKeluarMengundiDun($pilihanrayaBil)
    {
        $this->db->join('dun_tb', 'dun_tb.dun_bil = dun_keluar_mengundi_tb.dkmt_dun_bil', 'left');
        $this->db->where('dkmt_pilihanraya_bil', $pilihanrayaBil);
        $this->db->order_by('dkmt_waktu', 'DESC');
        $query = $this->db->get('dun_keluar_mengundi_tb');
        return $query->result();
    }

    public function tambahKeluarMengundiParlimen(){
        $data = array(
            'pkmt_pilihanraya_bil' => $this->input->post('inputPilihanrayaBil'),
            'pkmt_parlimen_bil' => $this->input->post('inputParlimenBil'),
            'pkmt_bilangan_pengundi' => $this->input->post('inputBilanganPengundi'),
            'pkmt_pengguna_bil' => $this->input->post('inputPenggunaBil'),
            'pkmt_waktu' => $this->input->post('inputWaktu')
        );
        $this->db->insert('parlimen_keluar_mengundi_tb', $data);
    }

    public function tambahKeluarMengundiDun(){
        $data = array(
            'dkmt_pilihanraya_bil' => $this->input->post('inputPilihanrayaBil'),
            'dkmt_dun_bil' => $this->input->post('inputDunBil'),
            'dkmt_bilangan_pengundi' => $this->input->post('inputBilanganPengundi'),
            'dkmt_pengguna_bil' => $this->input->post('inputPenggunaBil'),
            'dkmt_waktu' => $this->input->post('inputWaktu')
        );
        $this->db->insert('dun_keluar_mengundi_tb', $data);
    }

    public function update(){
        $this->binaTable();
        $this->updateLatest();
    }

    private function updateLatest(){

        $this->load->dbforge();

        //DUN
        if($this->db->table_exists('rekod_pilihanraya_dun_tb')){
            if(!$this->db->field_exists('rpdt_undi_rosak', 'rekod_pilihanraya_dun_tb')){
                $fieldRosak = array(
                    'rpdt_undi_rosak' => array(
                        'type' => 'BIGINT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column('rekod_pilihanraya_dun_tb', $fieldRosak);
            }
        }

        //PARLIMEN
        if($this->db->table_exists('rekod_pilihanraya_parlimen_tb')){
            if(!$this->db->field_exists('rppt_undi_rosak', 'rekod_pilihanraya_parlimen_tb')){
                $fieldRosak = array(
                    'rppt_undi_rosak' => array(
                        'type' => 'BIGINT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column('rekod_pilihanraya_parlimen_tb', $fieldRosak);
            }
        }

    }

    private function binaTable(){
        $this->load->dbforge();

        //STATUS KELUAR MENGUNDI - PARLIMEN
        if($this->db->table_exists('parlimen_keluar_mengundi_tb') == FALSE){
            $fields = array(
                'pkmt_bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'pkmt_pilihanraya_bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'pkmt_parlimen_bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'pkmt_bilangan_pengundi' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'pkmt_pengguna_bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'pkmt_waktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('pkmt_bil', TRUE);
            $this->dbforge->create_table('parlimen_keluar_mengundi_tb', TRUE);
        }

        //STATUS KELUAR MENGUNDI - DUN
        if($this->db->table_exists('dun_keluar_mengundi_tb') == FALSE){
            $fields = array(
                'dkmt_bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'dkmt_pilihanraya_bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'dkmt_dun_bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'dkmt_bilangan_pengundi' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'dkmt_pengguna_bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'dkmt_waktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('dkmt_bil', TRUE);
            $this->dbforge->create_table('dun_keluar_mengundi_tb', TRUE);
        }

        //REKOD PILIHAN RAYA
        //CREATE TABLE FOR DUN
        if($this->db->table_exists('rekod_pilihanraya_dun_tb') == FALSE){
            $fields = array(
                'rpdt_bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'rpdt_dun_bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'rpdt_pilihanraya_bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'rpdt_calon_sebelum' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'rpdt_calon_selepas' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'rpdt_calon_baru' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'rpdt_majoriti' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'rpdt_undi_rosak' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'rpdt_kategori_perubahan' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'rpdt_warna' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'rpdt_peti_undi' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '50',
                        'null' => TRUE
                ),
                'rpdt_waktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('rpdt_bil', TRUE);
            $this->dbforge->create_table('rekod_pilihanraya_dun_tb', TRUE);
        }

        //CREATE TABLE FOR PARLIMEN
        if($this->db->table_exists('rekod_pilihanraya_parlimen_tb') == FALSE){
            $fields = array(
                'rppt_bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'rppt_parlimen_bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'rppt_pilihanraya_bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'rppt_calon_sebelum' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'rppt_calon_selepas' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'rppt_calon_baru' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'rppt_majoriti' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'rppt_undi_rosak' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'rppt_kategori_perubahan' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'rppt_warna' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE
                ),
                'rppt_peti_undi' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '50',
                        'null' => TRUE
                ),
                'rppt_waktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('rppt_bil', TRUE);
            $this->dbforge->create_table('rekod_pilihanraya_parlimen_tb', TRUE);
        }

        //KEPUTUSAN TB - CREATE FOR PARLIMEN
        if($this->db->table_exists('keputusan_parlimen_tb') == FALSE){
            $fields = array(
                'kpt_bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'kpt_pencalonan' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'kpt_undi' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'kpt_waktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('kpt_bil', TRUE);
            $this->dbforge->create_table('keputusan_parlimen_tb', TRUE);
        }


        //KEPUTUSAN TB - CREATE FOR DUN
        if($this->db->table_exists('keputusan_dun_tb') == FALSE){
            $fields = array(
                'kdt_bil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'kdt_pencalonan' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'kdt_undi' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'kdt_waktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('kdt_bil', TRUE);
            $this->dbforge->create_table('keputusan_dun_tb', TRUE);
        }

    }


    public function senarai_pemenang_dun($dun_bil, $pilihanraya_bil){
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_bil = keputusan_dun_tb.kdt_pencalonan', 'left');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->where('pencalonan_tb.pencalonan_dun', $dun_bil);
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->order_by('keputusan_dun_tb.kdt_undi', 'DESC');
        $query = $this->db->get($this->dun);
        return $query->result();
    }

    public function simpan_dun($pengundi, $undi_bil, $waktu){
        $data = array(
            'kdt_undi' => $pengundi,
            'kdt_waktu' => $waktu
        );
        $this->db->where('kdt_bil', $undi_bil);
        $this->db->update($this->dun, $data);
    }   

    public function tambah_undi_dun($pencalonan_bil, $pengundi, $waktu)
    {
        $data = array(
            'kdt_pencalonan' => $pencalonan_bil,
            'kdt_undi' => $pengundi,
            'kdt_waktu' => $waktu
        );
        $this->db->insert($this->dun, $data);
    }

    public function pemenang_dun($dun_bil, $pilihanraya_bil){
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_bil = keputusan_dun_tb.kdt_pencalonan', 'left');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->where('pencalonan_tb.pencalonan_dun', $dun_bil);
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->order_by('keputusan_dun_tb.kdt_undi', 'DESC');
        $query = $this->db->get($this->dun);
        return $query->row();
    }

    public function undi_dun($calon_bil){
        $this->db->where('kdt_pencalonan', $calon_bil);
        $this->db->order_by('kdt_waktu', 'DESC');
        $query = $this->db->get($this->dun);
        return $query->row();
    }

    public function undi($calon_bil){
        $this->db->where('kpt_pencalonan', $calon_bil);
        $this->db->order_by('kpt_waktu', 'DESC');
        $query = $this->db->get($this->parlimen);
        return $query->row();
    }

    public function pemenang($parlimen_bil, $pilihanraya_bil){
        $this->db->join('pencalonan_parlimen_tb', 'pencalonan_parlimen_tb.pencalonan_parlimen_bil = keputusan_parlimen_tb.kpt_pencalonan', 'left');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil', 'left');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', $parlimen_bil);
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->order_by('keputusan_parlimen_tb.kpt_undi', 'DESC');
        $query = $this->db->get($this->parlimen);
        return $query->row();
    }

    public function senarai_pemenang($parlimen_bil, $pilihanraya_bil){
        $this->db->join('pencalonan_parlimen_tb', 'pencalonan_parlimen_tb.pencalonan_parlimen_bil = keputusan_parlimen_tb.kpt_pencalonan', 'left');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil', 'left');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', $parlimen_bil);
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil', $pilihanraya_bil);
        $this->db->order_by('keputusan_parlimen_tb.kpt_undi', 'DESC');
        $query = $this->db->get($this->parlimen);
        return $query->result();
    }

    public function padam($undi_bil){
        $this->db->where('kpt_bil', $undi_bil);
        $this->db->delete($this->parlimen);
    }

    public function simpan($pengundi, $undi_bil, $waktu){
        $data = array(
            'kpt_undi' => $pengundi,
            'kpt_waktu' => $waktu
        );
        $this->db->where('kpt_bil', $undi_bil);
        $this->db->update($this->parlimen, $data);
    }   

    public function senarai_parlimen($parlimen_bil)
    {
        $this->db->join('pencalonan_parlimen_tb', 'pencalonan_parlimen_tb.pencalonan_parlimen_bil = keputusan_parlimen_tb.kpt_pencalonan');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_parlimen_tb.pencalonan_parlimen_ahliBil');
        $this->db->where('pencalonan_parlimen_tb.pencalonan_parlimen_parlimenBil', $parlimen_bil);
        $this->db->order_by('keputusan_parlimen_tb.kpt_waktu', 'DESC');
        $query = $this->db->get($this->parlimen);
        return $query->result();
    }

    public function tambah_undi($pencalonan_bil, $pengundi, $waktu)
    {
        $data = array(
            'kpt_pencalonan' => $pencalonan_bil,
            'kpt_undi' => $pengundi,
            'kpt_waktu' => $waktu
        );
        $this->db->insert($this->parlimen, $data);
    }

}
?>