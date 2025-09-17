<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parti_model extends CI_Model {

    protected $table = 'parti_tb';

    public function bilanganLaporanUtama(){
        $this->db->select("COUNT(*) AS bilanganLaporan");
        $query = $this->db->get($this->table);
        $bilanganLaporan = $query->row();
        return $bilanganLaporan->bilanganLaporan;
    }

    public function senaraiParti(){
        $this->db->select("parti_tb.parti_bil AS partiBil");
        $this->db->select("parti_tb.parti_warna AS partiWarna");
        $this->db->select("parti_tb.parti_singkatan AS partiSingkatan");
        $this->db->select("UPPER(parti_tb.parti_nama) AS partiNama");
        $this->db->order_by('partiNama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function buang_parti_pilihan($bil)
    {
        $this->db->where('ppt_bil', $bil);
        $this->db->delete('parti_pilihan_tb');
    }

    public function tambah_parti_pilihan($parti_bil, $pengguna_bil, $pengguna_waktu)
    {
        $data = array(
            'ppt_parti_bil' => $parti_bil,
            'ppt_pengguna_bil' => $pengguna_bil,
            'ppt_pengguna_waktu' => $pengguna_waktu
        );
        $this->db->insert("parti_pilihan_tb", $data);
    }

    public function pilihan_parti($parti_bil)
    {
        $this->db->where('ppt_parti_bil', $parti_bil);
        $query = $this->db->get('parti_pilihan_tb');
        return $query->row();
    }

    public function senarai_parti_pilihan()
    {
        $this->db->join('parti_pilihan_tb', 'parti_pilihan_tb.ppt_parti_bil = parti_tb.parti_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function bukan_parti_pilihan()
    {
        $this->db->where_not_in('parti_tb.parti_bil', 'SELECT ppt_parti_bil FROM parti_pilihan_tb');
        $query = $this->db->get($this->table);
        return $query->result();
    }

	public function daftar()
	{
        $data = array(
            'parti_nama' => $this->input->post('parti_nama'),
            'parti_singkatan' => $this->input->post('parti_singkatan'),
            'parti_logo' => $this->input->post('parti_logo'),
            'parti_waktu' => date ('Y-m-d H:i:s'),
            'parti_pengguna' => $this->input->post('parti_pengguna')          
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
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = parti_tb.parti_pengguna', 'left');
        $this->db->join('foto_tb', 'foto_tb.foto_bil = parti_tb.parti_logo', 'left');
        $this->db->order_by('parti_tb.parti_singkatan', 'ASC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function papar($bil){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = parti_tb.parti_pengguna', 'left');
        $this->db->join('foto_tb', 'foto_tb.foto_bil = parti_tb.parti_logo', 'left');
        $this->db->where('parti_tb.parti_bil', $bil);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function padam($bil){
        $this->db->where('parti_bil', $bil);
        $this->db->delete($this->table);
    }

    public function logo($parti_bil){
        $this->db->join('foto_tb', 'foto_tb.foto_bil = parti_tb.parti_logo', 'left');
        $this->db->where('parti_tb.parti_bil', $parti_bil);
        $query = $this->db->get($this->table);
        foreach($query->result() as $q){
            $nama_logo = $q->foto_nama;
        }
        return $nama_logo;
    }

    public function bilangan_kerusi($pilihanraya_bil, $parti_bil){
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_parti = parti_tb.parti_bil', 'right');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_tb.pencalonan_parti', $parti_bil);
        $query = $this->db->get($this->table);
        return count($query->result());
    }

    public function senarai_ikut_pilihanraya($pilihanraya_bil){
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_parti = parti_tb.parti_bil', 'right');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->group_by('parti_tb.parti_bil');
        $query = $this->db->get($this->table);
        $parti = array();
        $count = 0;

        foreach($query->result() as $q){
            $parti[$count]['parti_singkatan'] = $q->parti_singkatan;
            $parti[$count]['bilangan_kerusi'] = $this->bilangan_kerusi($pilihanraya_bil, $q->parti_bil);
            $count++;
        }
        $bilangan_kerusi = array_column($parti, 'bilangan_kerusi');
        array_multisort($bilangan_kerusi, SORT_DESC, $parti);
        return $parti;
    }

    public function bilangan_calon($parti_bil){
        $this->db->where('parti_bil', $parti_bil);
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function belum_dipilih($dun_bil, $pilihanraya_bil){
        $where = "parti_tb.parti_bil NOT IN (SELECT pencalonan_tb.pencalonan_parti FROM pencalonan_tb WHERE pencalonan_tb.pencalonan_pilihanraya = $pilihanraya_bil AND pencalonan_tb.pencalonan_dun = $dun_bil)";
        $this->db->where($where);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function tukar_gambar_parti($parti_bil, $foto_bil){
        $data = array('parti_logo' => $foto_bil);
        $this->db->where('parti_bil', $parti_bil);
        $this->db->update($this->table, $data);
    }

    public function parti_ikut_pilihanraya($pilihanraya_bil){
        $this->db->select('pencalonan_tb.pencalonan_parti');
        $this->db->select('parti_tb.parti_nama');
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_parti = parti_tb.parti_bil', 'right');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya', 'left');
        $this->db->where('pilihanraya_tb.pilihanraya_bil', $pilihanraya_bil);
        $this->db->group_by('pencalonan_tb.pencalonan_parti');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_rumusan_parti($parti_bil, $pilihanraya_bil){
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_parti = parti_tb.parti_bil', 'right');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pencalonan_tb.pencalonan_pilihanraya', 'left');
        $this->db->where('pilihanraya_tb.pilihanraya_bil', $pilihanraya_bil);
        $this->db->where('parti_tb.parti_bil', $parti_bil);
        $this->db->group_by('pencalonan_tb.pencalonan_parti');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function code_color($parti_bil){
        $this->db->where('parti_bil', $parti_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function warna_parti_ikut_nama($parti_singkatan)
    {
        $this->db->where('parti_singkatan', $parti_singkatan);
        $query = $this->db->get($this->table); 
        $warna ="";
        foreach($query->result() as $q)
        {
            $warna = $q->parti_warna;
        }
        return $warna;
    }

    public function tukar_warna($parti_bil, $parti_warna)
    {
        $data = array('parti_warna' => $parti_warna);
        $this->db->where('parti_bil', $parti_bil);
        $this->db->update($this->table, $data);
    }

    public function tukar_umum($parti_bil, $parti_nama, $parti_singkatan, $parti_jenis)
    {
        $data = array(
            'parti_nama' => $parti_nama,
            'parti_singkatan' => $parti_singkatan,
            'parti_jenis' => $parti_jenis
        );
        $this->db->where('parti_bil', $parti_bil);
        $this->db->update($this->table, $data);
    }

    public function ahliParti($partiBil)
    {
        $this->db->where('parti_bil', $partiBil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function parti($parti_bil)
    {
        $this->db->where('parti_bil', $parti_bil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function senarai()
    {
        $this->db->order_by('parti_singkatan', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_jenis($jenis)
    {
        $this->db->where('parti_jenis', $jenis);
        $this->db->order_by('parti_singkatan', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function jawatan_parti($parti_bil)
    {
        $this->db->where('pjt_parti_bil', $parti_bil);
        $query = $this->db->get('parti_jawatan_tb');
        return $query->result();
    }

    public function tambah_jawatan()
    {
        $data = array(
            "pjt_nama" => $this->input->post('input_nama'),
            "pjt_kumpulan" => $this->input->post('input_kumpulan'),
            "pjt_pengguna_bil" => $this->input->post('input_pengguna_bil'),
            "pjt_pengguna_waktu" => $this->input->post('input_pengguna_waktu'),
            "pjt_parti_bil" => $this->input->post('input_parti_bil')
        );
        $this->db->insert("parti_jawatan_tb", $data);
    }

    public function kemaskini_jawatan()
    {
        $data = array(
            "pjt_nama" => $this->input->post('input_nama'),
            "pjt_kumpulan" => $this->input->post('input_kumpulan'),
            "pjt_pengguna_bil" => $this->input->post('input_pengguna_bil'),
            "pjt_pengguna_waktu" => $this->input->post('input_pengguna_waktu')
        );
        $this->db->where('pjt_bil', $this->input->post('input_jawatan_parti_bil'));
        $this->db->update("parti_jawatan_tb", $data);
    }

    public function jawatan_kumpulan()
    {
        $this->db->select('pjt_kumpulan');
        $this->db->group_by('pjt_kumpulan');
        $query = $this->db->get('parti_jawatan_tb');
        return $query->result();
    }

    public function senarai_jawatan_kumpulan($kumpulan)
    {
        $this->db->select('pjt_nama');
        $this->db->where('pjt_kumpulan', $kumpulan);
        $this->db->group_by('pjt_nama');
        $query = $this->db->get('parti_jawatan_tb');
        return $query->result();
    }

}
