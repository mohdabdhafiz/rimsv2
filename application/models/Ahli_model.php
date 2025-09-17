<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ahli_model extends CI_Model {

    protected $table = 'ahli_tb';

    public function update(){
        if($this->db->table_exists('ahli_tb')){
            if(!$this->db->field_exists('ahli_kaum', 'ahli_tb')){
                $fieldKaum = array(
                    'ahli_kaum' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column('ahli_tb', $fieldKaum);
            }
        }
    }

	public function kemaskini(){
        $data = array(
            'ahli_nama' => $this->input->post('input_ahli_nama'),
            'ahli_umur' => $this->input->post('input_ahli_umur'),
            'ahli_pendidikan' => $this->input->post('input_ahli_pendidikan'),
            'ahli_jantina' => $this->input->post('input_ahli_jantina'),
            'ahli_kaum' => $this->input->post('input_kaum')
        );
        $this->db->where('ahli_bil', $this->input->post('input_ahli_bil'));
        $this->db->update($this->table, $data);
    }
    
    public function daftar()
	{
        $data = array(
            'ahli_foto' => $this->input->post('ahli_foto'),
            'ahli_nama' => $this->input->post('ahli_nama'),
            'ahli_umur' => $this->input->post('ahli_umur'),
            'ahli_jantina' => $this->input->post('ahli_jantina'),
            'ahli_pendidikan' => $this->input->post('ahli_pendidikan'),
            'ahli_waktu' => date ('Y-m-d H:i:s'),
            'ahli_pengguna' => $this->input->post('ahli_pengguna')          
        );

        $return_data['insert_data'] = $this->db->insert($this->table, $data);
        $return_data['last_id'] = $this->db->insert_id();
    return $return_data;
    }

    public function daftar_ahli($ahliFoto, $ahliNama, $ahliUmur, $ahliJantina, $ahliPendidikan, $ahliPengguna)
	{
        $data = array(
            'ahli_foto' => $ahliFoto,
            'ahli_nama' => $ahliNama,
            'ahli_umur' => $ahliUmur,
            'ahli_jantina' => $ahliJantina,
            'ahli_pendidikan' => $ahliPendidikan,
            'ahli_waktu' => date ('Y-m-d H:i:s'),
            'ahli_pengguna' => $ahliPengguna         
        );

        $return_data['insert_data'] = $this->db->insert($this->table, $data);
        $return_data['last_id'] = $this->db->insert_id();
    return $return_data;
    }

    public function kira_semua(){
        return $this->db->count_all($this->table);
    }
    
    public function lihat_semua($limit, $start){
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function papar_semua(){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = ahli_tb.ahli_pengguna', 'left');
        $this->db->join('foto_tb', 'foto_tb.foto_bil = ahli_tb.ahli_foto', 'left');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function papar($bil){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = ahli_tb.ahli_pengguna', 'left');
        $this->db->join('foto_tb', 'foto_tb.foto_bil = ahli_tb.ahli_foto', 'left');
        $this->db->where('ahli_tb.ahli_bil', $bil);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function tukar_gambar_ahli($ahli_bil, $foto_bil){
        $data = array('ahli_foto' => $foto_bil);
        $this->db->where('ahli_bil', $ahli_bil);
        $this->db->update($this->table, $data);
    }

    public function padam($bil){
        $this->db->where('ahli_bil', $bil);
        $this->db->delete($this->table);
    }

    public function foto($ahli_bil){
        $this->db->join('foto_tb', 'foto_tb.foto_bil = ahli_tb.ahli_foto', 'left');
        $this->db->where('ahli_tb.ahli_bil', $ahli_bil);
        $query = $this->db->get($this->table);
        foreach($query->result() as $q){
            $nama_foto = $q->foto_nama;
        }
        return $nama_foto;
    }

    public function parti_ahli($bil){
        $this->db->select('pencalonan_tb.pencalonan_bil');
        $this->db->select('parti_tb.parti_nama');
        $this->db->select('parti_tb.parti_singkatan');
        $this->db->select('pilihanraya_tb.pilihanraya_tahun');
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_ahli = ahli_tb.ahli_bil', 'right');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->where('ahli_tb.ahli_bil', $bil);
        $this->db->group_by('pencalonan_tb.pencalonan_parti');
        $this->db->group_by('pencalonan_tb.pencalonan_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function pilihanraya_ahli($bil){
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_ahli = ahli_tb.ahli_bil', 'right');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->where('ahli_tb.ahli_bil', $bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ahli($ahliBil)
    {
        $this->db->where('ahli_bil', $ahliBil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function ahli_nama($nama)
    {
        $this->db->where('ahli_nama', $nama);
        $query = $this->db->get($this->table);
        return $query->row();
    }

}
