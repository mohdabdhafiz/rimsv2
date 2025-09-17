<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jangka_dun_model extends CI_Model {

    protected $table = 'jangka_dun_tb';

    public function partiBilanganCalon($senaraiKerusi){
        $this->db->select("parti_tb.parti_bil AS partiBil");
        $this->db->select("parti_tb.parti_warna AS partiWarna");
        $this->db->select("UPPER(parti_tb.parti_nama) AS partiNama");
        $this->db->select("parti_tb.parti_singkatan AS partiSingkatan");
        $this->db->select("COUNT(jangka_dun_tb.jdt_parti_bil) AS bilanganCalon");
        $this->db->select('(
            SELECT foto_nama FROM foto_tb
            WHERE foto_tb.foto_bil = parti_tb.parti_logo
        ) AS fotoParti');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = jangka_dun_tb.jdt_dun_bil', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = jangka_dun_tb.jdt_parti_bil', 'left');
        $this->db->group_start();
        foreach($senaraiKerusi as $kerusi){
            $this->db->or_where('jangka_dun_tb.jdt_dun_bil', $kerusi->bil);
        }
        $this->db->group_end();
        $this->db->group_by('jangka_dun_tb.jdt_parti_bil');
        $this->db->order_by('bilanganCalon', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function kawasanBilanganCalon($senaraiKerusi){
        $this->db->select("UPPER(dun_tb.dun_nama) AS kerusiNama");
        $this->db->select("COUNT(jangka_dun_tb.jdt_dun_bil) AS bilanganCalon");
        $this->db->join('dun_tb', 'dun_tb.dun_bil = jangka_dun_tb.jdt_dun_bil', 'left');
        $this->db->group_start();
        foreach($senaraiKerusi as $kerusi){
            $this->db->or_where('jangka_dun_tb.jdt_dun_bil', $kerusi->bil);
        }
        $this->db->group_end();
        $this->db->group_by('jangka_dun_tb.jdt_dun_bil');
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiIkutNegeri(){
        $this->db->select("UPPER(dun_tb.dun_negeri) AS kriteriaNama");
        $this->db->select("COUNT(dun_tb.dun_negeri) AS calonBilangan");
        $this->db->join('dun_tb', 'dun_tb.dun_bil = jangka_dun_tb.jdt_dun_bil', 'left');
        $this->db->group_by('dun_tb.dun_negeri');
        $this->db->order_by('kriteriaNama');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function daftar()
    {
        $data = array(
            "jdt_foto_bil" => $this->input->post('input_foto_bil'),
            "jdt_nama_penuh" => $this->input->post('input_nama_penuh'),
            "jdt_parti_bil" => $this->input->post('input_parti_bil'),
            "jdt_jawatan_parti" => $this->input->post('input_jawatan_parti'),
            "jdt_kategori_umur" => $this->input->post('input_kategori_umur'),
            "jdt_jantina" => $this->input->post('input_jantina'),
            "jdt_kaum" => $this->input->post('input_kaum'),
            "jdt_status_calon" => $this->input->post('input_status_calon'),
            "jdt_pengguna_bil" => $this->input->post('input_pengguna_bil'),
            "jdt_pengguna_waktu" => $this->input->post('input_pengguna_waktu'),
            "jdt_dun_bil" => $this->input->post('input_dun_bil')
        );
        $return_data['insert_data'] = $this->db->insert($this->table, $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;
    }

    public function calon_id($calon_id)
    {
        $this->db->where('jdt_bil', $calon_id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function calon_dun($dun_bil)
    {
        $this->db->join('parti_tb', 'parti_tb.parti_bil = jangka_dun_tb.jdt_parti_bil', 'left');
        $this->db->where('jdt_dun_bil', $dun_bil);
        $this->db->order_by('jangka_dun_tb.jdt_parti_bil', 'ASC');
        $this->db->order_by('jdt_pengguna_waktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    public function tukar_gambar_jdt($jdt_bil, $foto_bil){
        $data = array('jdt_foto_bil' => $foto_bil);
        $this->db->where('jdt_bil', $jdt_bil);
        $this->db->update($this->table, $data);
    }

    public function kemaskini_calon()
    {
        $data = array(
            "jdt_nama_penuh" => $this->input->post('input_nama_penuh'),
            "jdt_parti_bil" => $this->input->post('input_parti_bil'),
            "jdt_jawatan_parti" => $this->input->post('input_jawatan_parti'),
            "jdt_kategori_umur" => $this->input->post('input_kategori_umur'),
            "jdt_jantina" => $this->input->post('input_jantina'),
            "jdt_kaum" => $this->input->post('input_kaum'),
            "jdt_status_calon" => $this->input->post('input_status_calon'),
            "jdt_pengguna_bil" => $this->input->post('input_pengguna_bil'),
            "jdt_pengguna_waktu" => $this->input->post('input_pengguna_waktu')
        );
        $this->db->where('jdt_bil', $this->input->post('input_jdt_bil'));
        $this->db->update($this->table, $data);
    }

    public function padam_calon()
    {
        $this->db->where('jdt_bil', $this->input->post('input_jdt_bil'));
        $this->db->delete($this->table);

        $this->db->where('jdtt_jangka_dun_bil', $this->input->post('input_jdt_bil'));
        $this->db->delete('jangka_dun_tambahan_tb');

    }

    public function semua()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function semua_negeri($negeri){
        $this->db->join('dun_tb', 'dun_tb.dun_bil = jangka_dun_tb.jdt_dun_bil');
        $this->db->where('dun_tb.pt_negeri', $negeri);
        $this->db->order_by('jangka_dun_tb.jdt_dun_bil', 'ASC');
        $this->db->order_by('jangka_dun_tb.jdt_parti_bil', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusan_ikut_negeri(){
        $this->db->select('dun_tb.pt_negeri, COUNT(*) AS kira');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = jangka_dun_tb.jdt_dun_bil');
        $this->db->group_by('dun_tb.pt_negeri');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    public function rumusan_ikut_parti(){
        $this->db->select('jangka_dun_tb.jdt_parti_bil, COUNT(*) AS kira');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = jangka_dun_tb.jdt_dun_bil');
        $this->db->group_by('jangka_dun_tb.jdt_parti_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusan_ikut_jawatan(){
        $this->db->select('jdt_jawatan_parti, COUNT(*) AS kira');
        $this->db->group_by('jdt_jawatan_parti');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusan_ikut_umur(){
        $this->db->select('jdt_kategori_umur, COUNT(*) AS kira');
        $this->db->group_by('jdt_kategori_umur');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusan_ikut_jantina(){
        $this->db->select('jdt_jantina, COUNT(*) AS kira');
        $this->db->group_by('jdt_jantina');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusan_ikut_kaum(){
        $this->db->select('jdt_kaum, COUNT(*) AS kira');
        $this->db->group_by('jdt_kaum');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusan_ikut_status(){
        $this->db->select('jdt_status_calon, COUNT(*) AS kira');
        $this->db->group_by('jdt_status_calon');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ikut_negeri($negeri){
        $this->db->select('jdt_dun_bil, COUNT(*) AS kira');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = jangka_dun_tb.jdt_dun_bil');
        $this->db->where('dun_tb.pt_negeri', $negeri);
        $this->db->group_by('jangka_dun_tb.jdt_dun_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ikut_negeri_parti($negeri)
    {
        $this->db->select('jangka_dun_tb.jdt_parti_bil, COUNT(*) AS kira');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = jangka_dun_tb.jdt_dun_bil');
        $this->db->where('dun_tb.pt_negeri', $negeri);
        $this->db->group_by('jangka_dun_tb.jdt_parti_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ikut_jawatan($negeri)
    {
        $this->db->select('jangka_dun_tb.jdt_jawatan_parti, COUNT(*) AS kira');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = jangka_dun_tb.jdt_dun_bil');
        $this->db->where('dun_tb.pt_negeri', $negeri);
        $this->db->group_by('jangka_dun_tb.jdt_jawatan_parti');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_jawatan_parti($parti_bil, $jawatan, $negeri)
    {
        $this->db->select('jangka_dun_tb.jdt_parti_bil, COUNT(*) AS kira');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = jangka_dun_tb.jdt_dun_bil');
        $this->db->where('dun_tb.pt_negeri', $negeri);
        $this->db->where('jangka_dun_tb.jdt_parti_bil', $parti_bil);
        $this->db->where('jangka_dun_tb.jdt_jawatan_parti', $jawatan);
        $this->db->group_by('jangka_dun_tb.jdt_parti_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ikut_umur($negeri)
    {
        $this->db->select('jangka_dun_tb.jdt_kategori_umur, COUNT(*) AS kira');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = jangka_dun_tb.jdt_dun_bil');
        $this->db->where('dun_tb.pt_negeri', $negeri);
        $this->db->group_by('jangka_dun_tb.jdt_kategori_umur');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ikut_jantina($negeri)
    {
        $this->db->select('jangka_dun_tb.jdt_jantina, COUNT(*) AS kira');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = jangka_dun_tb.jdt_dun_bil');
        $this->db->where('dun_tb.pt_negeri', $negeri);
        $this->db->group_by('jangka_dun_tb.jdt_jantina');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ikut_kaum($negeri)
    {
        $this->db->select('jangka_dun_tb.jdt_kaum, COUNT(*) AS kira');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = jangka_dun_tb.jdt_dun_bil');
        $this->db->where('dun_tb.pt_negeri', $negeri);
        $this->db->group_by('jangka_dun_tb.jdt_kaum');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ikut_status($negeri)
    {
        $this->db->select('jangka_dun_tb.jdt_status_calon, COUNT(*) AS kira');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = jangka_dun_tb.jdt_dun_bil');
        $this->db->where('dun_tb.pt_negeri', $negeri);
        $this->db->group_by('jangka_dun_tb.jdt_status_calon');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function tambahan_calon()
    {
        $data = array(
            "jdtt_jangka_dun_bil" => $this->input->post('input_calon'),
            "jdtt_kuat_lemah" => $this->input->post('input_kuat_lemah'),
            "jdtt_deskripsi" => $this->input->post('input_kekuatan'),
            "jdtt_pengguna_bil" => $this->input->post('input_pengguna_bil'),
            "jdtt_pengguna_waktu" => $this->input->post('input_pengguna_waktu')
        );
        $return_data['insert_data'] = $this->db->insert('jangka_dun_tambahan_tb', $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;
    }

    public function kekuatan_calon($jdt_bil, $kekuatan)
    {
        $this->db->where('jdtt_jangka_dun_bil', $jdt_bil);
        $this->db->where('jdtt_kuat_lemah', $kekuatan);
        $query = $this->db->get('jangka_dun_tambahan_tb');
        return $query->result();
    }

    public function padam_kuat_lemah()
    {
        $this->db->where('jdtt_bil', $this->input->post('input_jdtt_bil'));
        $this->db->where('jdtt_pengguna_bil', $this->input->post('input_pengguna_bil'));
        $this->db->delete('jangka_dun_tambahan_tb');
    }

    public function calon_parti_dun($parti_bil, $dun_bil)
    {
        $this->db->where('jdt_parti_bil', $parti_bil);
        $this->db->where('jdt_dun_bil', $dun_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function calon_parti($parti_bil)
    {
        $this->db->select('jdt_dun_bil, COUNT(*) AS kira');
        $this->db->where('jdt_parti_bil', $parti_bil);
        $this->db->group_by('jdt_dun_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function calon_umur($umur)
    {
        $this->db->select('jdt_dun_bil, COUNT(*) AS kira');
        $this->db->where('jdt_kategori_umur', $umur);
        $this->db->group_by('jdt_dun_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function jantina_dun($jantina)
    {
        $this->db->select('jdt_dun_bil, COUNT(*) AS kira');
        $this->db->where('jdt_jantina', $jantina);
        $this->db->group_by('jdt_dun_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function kaum_dun($kaum)
    {
        $this->db->select('jdt_dun_bil, COUNT(*) AS kira');
        $this->db->where('jdt_kaum', $kaum);
        $this->db->group_by('jdt_dun_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function status_dun($status)
    {
        $this->db->select('jdt_dun_bil, COUNT(*) AS kira');
        $this->db->where('jdt_status_calon', $status);
        $this->db->group_by('jdt_dun_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_dun_ikut_nama($nama)
    {
        $this->db->join('dun_tb', 'dun_tb.dun_bil = jangka_dun_tb.jdt_dun_bil');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = jangka_dun_tb.jdt_parti_bil');
        $this->db->where('jangka_dun_tb.jdt_nama_penuh', $nama);
        $query = $this->db->get($this->table);
        return $query->result();
    }


}