<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Winnable_candidate_parlimen_model extends CI_Model {

    protected $table = 'winnable_candidate_tb';

    public function partiBilanganCalon($senaraiKerusi){
        $this->db->select("parti_tb.parti_bil AS partiBil");
        $this->db->select("parti_tb.parti_warna AS partiWarna");
        $this->db->select("UPPER(parti_tb.parti_nama) AS partiNama");
        $this->db->select("parti_tb.parti_singkatan AS partiSingkatan");
        $this->db->select("COUNT(winnable_candidate_tb.wct_parti_bil) AS bilanganCalon");
        $this->db->select('(
            SELECT foto_nama FROM foto_tb
            WHERE foto_tb.foto_bil = parti_tb.parti_logo
        ) AS fotoParti');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = winnable_candidate_tb.wct_parlimen_bil', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = winnable_candidate_tb.wct_parti_bil', 'left');
        $this->db->group_start();
        foreach($senaraiKerusi as $kerusi){
            $this->db->or_where('winnable_candidate_tb.wct_parlimen_bil', $kerusi->bil);
        }
        $this->db->group_end();
        $this->db->group_by('winnable_candidate_tb.wct_parti_bil');
        $this->db->order_by('bilanganCalon', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }


    public function kawasanBilanganCalon($senaraiKerusi){
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS kerusiNama");
        $this->db->select("COUNT(winnable_candidate_tb.wct_parlimen_bil) AS bilanganCalon");
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = winnable_candidate_tb.wct_parlimen_bil', 'left');
        $this->db->group_start();
        foreach($senaraiKerusi as $kerusi){
            $this->db->or_where('winnable_candidate_tb.wct_parlimen_bil', $kerusi->bil);
        }
        $this->db->group_end();
        $this->db->group_by('winnable_candidate_tb.wct_parlimen_bil');
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function kekuatanCalonParlimen($kekuatan, $parlimenBil)
    {
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = winnable_candidate_tambahan_tb.wctm_pengguna_bil', 'left');
        $this->db->join('winnable_candidate_tb', 'winnable_candidate_tb.wct_bil = winnable_candidate_tambahan_tb.wctm_winnable_candidate_bil', 'left');
        $this->db->where('winnable_candidate_tb.wct_parlimen_bil', $parlimenBil);
        $this->db->where('wctm_kuat_lemah', $kekuatan);
        $query = $this->db->get('winnable_candidate_tambahan_tb');
        return $query->result();
    }

    public function senaraiCalonParlimen($parlimen_bil)
    {
        $this->db->select('UPPER(winnable_candidate_tb.wct_nama_penuh) AS calonNama');
        $this->db->select('winnable_candidate_tb.wct_bil AS calonBil');
        $this->db->select('winnable_candidate_tb.wct_kategori_umur AS calonUmur');
        $this->db->select('UPPER(parti_tb.parti_nama) AS partiNama');
        $this->db->select('parti_tb.parti_singkatan AS partiSF');
        $this->db->select('parti_tb.parti_warna AS partiWarna');
        $this->db->select('(
            SELECT foto_nama FROM foto_tb
            WHERE foto_tb.foto_bil = winnable_candidate_tb.wct_foto_bil
        ) AS fotoCalon');
        $this->db->select('(
            SELECT foto_nama FROM foto_tb
            WHERE foto_tb.foto_bil = parti_tb.parti_logo
        ) AS fotoParti');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = winnable_candidate_tb.wct_parti_bil', 'left');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = winnable_candidate_tb.wct_pengguna_bil', 'left');
        $this->db->where('winnable_candidate_tb.wct_parlimen_bil', $parlimen_bil);
        $this->db->order_by('parti_tb.parti_nama', 'ASC');
        $this->db->order_by('winnable_candidate_tb.wct_pengguna_waktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiIkutNegeri(){
        $this->db->select("UPPER(parlimen_tb.pt_negeri) AS kriteriaNama");
        $this->db->select("COUNT(parlimen_tb.pt_negeri) AS calonBilangan");
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = winnable_candidate_tb.wct_parlimen_bil', 'left');
        $this->db->group_by('parlimen_tb.pt_negeri');
        $this->db->order_by('kriteriaNama');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function bil($bil){
        $this->db->select('*');
        $this->db->select('(
            SELECT foto_nama FROM foto_tb
            WHERE foto_tb.foto_bil = winnable_candidate_tb.wct_foto_bil
        ) AS fotoJangkaanCalon');
        $this->db->select('(
            SELECT foto_nama FROM foto_tb
            WHERE foto_tb.foto_bil = parti_tb.parti_logo
        ) AS fotoParti');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = winnable_candidate_tb.wct_parti_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = winnable_candidate_tb.wct_parlimen_bil', 'left');
        $this->db->where('winnable_candidate_tb.wct_bil', $bil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function bilanganJangkaanCalonParlimen($senaraiParlimen)
    {
        $this->db->select("COUNT(*) AS bilanganCalon");
        foreach($senaraiParlimen as $parlimen){
            $this->db->or_where('winnable_candidate_tb.wct_parlimen_bil', $parlimen->pt_bil);
        }
        $this->db->order_by('winnable_candidate_tb.wct_pengguna_waktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function senaraiCalon(){
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function daftar()
    {
        $data = array(
            "wct_foto_bil" => $this->input->post('input_foto_bil'),
            "wct_nama_penuh" => $this->input->post('input_nama_penuh'),
            "wct_parti_bil" => $this->input->post('input_parti_bil'),
            "wct_jawatan_parti" => $this->input->post('input_jawatan_parti'),
            "wct_kategori_umur" => $this->input->post('input_kategori_umur'),
            "wct_jantina" => $this->input->post('input_jantina'),
            "wct_kaum" => $this->input->post('input_kaum'),
            "wct_status_calon" => $this->input->post('input_status_calon'),
            "wct_pengguna_bil" => $this->input->post('input_pengguna_bil'),
            "wct_pengguna_waktu" => $this->input->post('input_pengguna_waktu'),
            "wct_parlimen_bil" => $this->input->post('input_parlimen_bil')
        );
        $return_data['insert_data'] = $this->db->insert($this->table, $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;
    }

    public function calon_id($calon_id)
    {
        $this->db->where('wct_bil', $calon_id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function calon_parlimen($parlimen_bil)
    {
        $this->db->join('parti_tb', 'parti_tb.parti_bil = winnable_candidate_tb.wct_parti_bil', 'left');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = winnable_candidate_tb.wct_pengguna_bil', 'left');
        $this->db->where('winnable_candidate_tb.wct_parlimen_bil', $parlimen_bil);
        $this->db->order_by('parti_tb.parti_nama', 'ASC');
        $this->db->order_by('winnable_candidate_tb.wct_pengguna_waktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    public function tukar_gambar_wct($wct_bil, $foto_bil){
        $data = array('wct_foto_bil' => $foto_bil);
        $this->db->where('wct_bil', $wct_bil);
        $this->db->update($this->table, $data);
    }

    public function kemaskini_calon()
    {
        $data = array(
            "wct_nama_penuh" => $this->input->post('input_nama_penuh'),
            "wct_parti_bil" => $this->input->post('input_parti_bil'),
            "wct_jawatan_parti" => $this->input->post('input_jawatan_parti'),
            "wct_kategori_umur" => $this->input->post('input_kategori_umur'),
            "wct_jantina" => $this->input->post('input_jantina'),
            "wct_kaum" => $this->input->post('input_kaum'),
            "wct_status_calon" => $this->input->post('input_status_calon'),
            "wct_pengguna_bil" => $this->input->post('input_pengguna_bil'),
            "wct_pengguna_waktu" => $this->input->post('input_pengguna_waktu')
        );
        $this->db->where('wct_bil', $this->input->post('input_wct_bil'));
        $this->db->update($this->table, $data);
    }

    public function padam_calon()
    {
        $this->db->where('wct_bil', $this->input->post('input_wct_bil'));
        $this->db->delete($this->table);

        $this->db->where('wctm_winnable_candidate_bil', $this->input->post('input_wct_bil'));
        $this->db->delete('winnable_candidate_tambahan_tb');

    }

    public function semua()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function semua_negeri($negeri){
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = winnable_candidate_tb.wct_parlimen_bil');
        $this->db->where('parlimen_tb.pt_negeri', $negeri);
        $this->db->order_by('winnable_candidate_tb.wct_parlimen_bil', 'ASC');
        $this->db->order_by('winnable_candidate_tb.wct_parti_bil', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusan_ikut_negeri(){
        $this->db->select('parlimen_tb.pt_negeri, COUNT(*) AS kira');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = winnable_candidate_tb.wct_parlimen_bil');
        $this->db->group_by('parlimen_tb.pt_negeri');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    public function rumusan_ikut_parti(){
        $this->db->select('winnable_candidate_tb.wct_parti_bil, COUNT(*) AS kira');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = winnable_candidate_tb.wct_parlimen_bil');
        $this->db->group_by('winnable_candidate_tb.wct_parti_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusan_ikut_jawatan(){
        $this->db->select('wct_jawatan_parti, COUNT(*) AS kira');
        $this->db->group_by('wct_jawatan_parti');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusan_ikut_umur(){
        $this->db->select('wct_kategori_umur, COUNT(*) AS kira');
        $this->db->group_by('wct_kategori_umur');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusan_ikut_jantina(){
        $this->db->select('wct_jantina, COUNT(*) AS kira');
        $this->db->group_by('wct_jantina');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusan_ikut_kaum(){
        $this->db->select('wct_kaum, COUNT(*) AS kira');
        $this->db->group_by('wct_kaum');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusan_ikut_status(){
        $this->db->select('wct_status_calon, COUNT(*) AS kira');
        $this->db->group_by('wct_status_calon');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ikut_negeri($negeri){
        $this->db->select('wct_parlimen_bil, COUNT(*) AS kira');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = winnable_candidate_tb.wct_parlimen_bil');
        $this->db->where('parlimen_tb.pt_negeri', $negeri);
        $this->db->group_by('winnable_candidate_tb.wct_parlimen_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ikut_negeri_parti($negeri)
    {
        $this->db->select('winnable_candidate_tb.wct_parti_bil, COUNT(*) AS kira');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = winnable_candidate_tb.wct_parlimen_bil');
        $this->db->where('parlimen_tb.pt_negeri', $negeri);
        $this->db->group_by('winnable_candidate_tb.wct_parti_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ikut_jawatan($negeri)
    {
        $this->db->select('winnable_candidate_tb.wct_jawatan_parti, COUNT(*) AS kira');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = winnable_candidate_tb.wct_parlimen_bil');
        $this->db->where('parlimen_tb.pt_negeri', $negeri);
        $this->db->group_by('winnable_candidate_tb.wct_jawatan_parti');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_jawatan_parti($parti_bil, $jawatan, $negeri)
    {
        $this->db->select('winnable_candidate_tb.wct_parti_bil, COUNT(*) AS kira');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = winnable_candidate_tb.wct_parlimen_bil');
        $this->db->where('parlimen_tb.pt_negeri', $negeri);
        $this->db->where('winnable_candidate_tb.wct_parti_bil', $parti_bil);
        $this->db->where('winnable_candidate_tb.wct_jawatan_parti', $jawatan);
        $this->db->group_by('winnable_candidate_tb.wct_parti_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ikut_umur($negeri)
    {
        $this->db->select('winnable_candidate_tb.wct_kategori_umur, COUNT(*) AS kira');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = winnable_candidate_tb.wct_parlimen_bil');
        $this->db->where('parlimen_tb.pt_negeri', $negeri);
        $this->db->group_by('winnable_candidate_tb.wct_kategori_umur');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ikut_jantina($negeri)
    {
        $this->db->select('winnable_candidate_tb.wct_jantina, COUNT(*) AS kira');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = winnable_candidate_tb.wct_parlimen_bil');
        $this->db->where('parlimen_tb.pt_negeri', $negeri);
        $this->db->group_by('winnable_candidate_tb.wct_jantina');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ikut_kaum($negeri)
    {
        $this->db->select('winnable_candidate_tb.wct_kaum, COUNT(*) AS kira');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = winnable_candidate_tb.wct_parlimen_bil');
        $this->db->where('parlimen_tb.pt_negeri', $negeri);
        $this->db->group_by('winnable_candidate_tb.wct_kaum');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ikut_status($negeri)
    {
        $this->db->select('winnable_candidate_tb.wct_status_calon, COUNT(*) AS kira');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = winnable_candidate_tb.wct_parlimen_bil');
        $this->db->where('parlimen_tb.pt_negeri', $negeri);
        $this->db->group_by('winnable_candidate_tb.wct_status_calon');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function tambahan_calon()
    {
        $data = array(
            "wctm_winnable_candidate_bil" => $this->input->post('input_calon'),
            "wctm_kuat_lemah" => $this->input->post('input_kuat_lemah'),
            "wctm_deskripsi" => $this->input->post('input_kekuatan'),
            "wctm_pengguna_bil" => $this->input->post('input_pengguna_bil'),
            "wctm_pengguna_waktu" => $this->input->post('input_pengguna_waktu')
        );
        $return_data['insert_data'] = $this->db->insert('winnable_candidate_tambahan_tb', $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;
    }

    public function kekuatan_calon($wct_bil, $kekuatan)
    {
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = winnable_candidate_tambahan_tb.wctm_pengguna_bil', 'left');
        $this->db->where('wctm_winnable_candidate_bil', $wct_bil);
        $this->db->where('wctm_kuat_lemah', $kekuatan);
        $query = $this->db->get('winnable_candidate_tambahan_tb');
        return $query->result();
    }

    public function padam_kuat_lemah()
    {
        $this->db->where('wctm_bil', $this->input->post('input_wctm_bil'));
        $this->db->where('wctm_pengguna_bil', $this->input->post('input_pengguna_bil'));
        $this->db->delete('winnable_candidate_tambahan_tb');
    }

    public function calon_parti_parlimen($parti_bil, $parlimen_bil)
    {
        $this->db->where('wct_parti_bil', $parti_bil);
        $this->db->where('wct_parlimen_bil', $parlimen_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function calon_parti($parti_bil)
    {
        $this->db->select('wct_parlimen_bil, COUNT(*) AS kira');
        $this->db->where('wct_parti_bil', $parti_bil);
        $this->db->group_by('wct_parlimen_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function calon_umur($umur)
    {
        $this->db->select('wct_parlimen_bil, COUNT(*) AS kira');
        $this->db->where('wct_kategori_umur', $umur);
        $this->db->group_by('wct_parlimen_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function jantina_parlimen($jantina)
    {
        $this->db->select('wct_parlimen_bil, COUNT(*) AS kira');
        $this->db->where('wct_jantina', $jantina);
        $this->db->group_by('wct_parlimen_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function kaum_parlimen($kaum)
    {
        $this->db->select('wct_parlimen_bil, COUNT(*) AS kira');
        $this->db->where('wct_kaum', $kaum);
        $this->db->group_by('wct_parlimen_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function status_parlimen($status)
    {
        $this->db->select('wct_parlimen_bil, COUNT(*) AS kira');
        $this->db->where('wct_status_calon', $status);
        $this->db->group_by('wct_parlimen_bil');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_parlimen_ikut_nama($nama)
    {
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = winnable_candidate_tb.wct_parlimen_bil');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = winnable_candidate_tb.wct_parti_bil');
        $this->db->where('wct_nama_penuh', $nama);
        $query = $this->db->get($this->table);
        return $query->result();
    }


}