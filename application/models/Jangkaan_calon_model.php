<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jangkaan_calon_model extends CI_Model {

    //parlimen || winnable_candidate_tb
    //dun || jangka_dun_tb

    public function tambahCalonDun(){
        $data = array(
            "jdt_foto_bil" => $this->input->post('input_foto_bil'),
            "jdt_nama_penuh" => $this->input->post('inputNama'),
            "jdt_parti_bil" => $this->input->post('inputParti'),
            "jdt_jawatan_parti" => $this->input->post('inputJawatan'),
            "jdt_kategori_umur" => $this->input->post('inputKategoriUmur'),
            "jdt_jantina" => $this->input->post('inputJantina'),
            "jdt_kaum" => $this->input->post('inputKaum'),
            "jdt_status_calon" => $this->input->post('inputStatus'),
            "jdt_pengguna_bil" => $this->input->post('inputPengguna'),
            "jdt_pengguna_waktu" => $this->input->post('inputWaktu'),
            "jdt_dun_bil" => $this->input->post('inputDun')
        );
        $return_data['insert_data'] = $this->db->insert($this->table, $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;
    }

    public function semakanNamaDun($calonNama, $dunBil, $partiBil){
        $this->db->select("COUNT(*) AS kiraanData");
        $this->db->where('UPPER(jangka_dun_tb.jdt_nama_penuh)', strtoupper($calonNama));
        $this->db->where('jangka_dun_tb.jdt_dun_bil', $dunBil);
        $this->db->where('jangka_dun_tb.jdt_parti_bil', $partiBil);
        $query = $this->db->get('jangka_dun_tb');
        return $query->row();
    }

    public function rumusanSatuNegeri($senaraiNegeri){
        $this->db->select('UPPER(negeri_tb.nt_nama) AS negeriNama');
        $this->db->select('(
            SELECT COUNT(*) 
            FROM winnable_candidate_tb 
            LEFT JOIN parlimen_tb ON parlimen_tb.pt_bil = winnable_candidate_tb.wct_parlimen_bil
            WHERE UPPER(parlimen_tb.pt_negeri) = UPPER(negeri_tb.nt_nama) 
            ) AS calonBilanganParlimen');
        $this->db->select('(
            SELECT COUNT(*) 
            FROM jangka_dun_tb 
            LEFT JOIN dun_tb ON dun_tb.dun_bil = jangka_dun_tb.jdt_dun_bil
            WHERE UPPER(dun_tb.dun_negeri) = UPPER(negeri_tb.nt_nama) 
            ) AS calonBilanganDun');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $query = $this->db->get('negeri_tb');
        return $query->row();
    }

    public function rumusanNegeri($senaraiNegeri){
        $this->db->select('UPPER(negeri_tb.nt_nama) AS negeriNama');
        $this->db->select('(
            SELECT COUNT(*) 
            FROM winnable_candidate_tb 
            LEFT JOIN parlimen_tb ON parlimen_tb.pt_bil = winnable_candidate_tb.wct_parlimen_bil
            WHERE UPPER(parlimen_tb.pt_negeri) = UPPER(negeri_tb.nt_nama) 
            ) AS calonBilanganParlimen');
        $this->db->select('(
            SELECT COUNT(*) 
            FROM jangka_dun_tb 
            LEFT JOIN dun_tb ON dun_tb.dun_bil = jangka_dun_tb.jdt_dun_bil
            WHERE UPPER(dun_tb.dun_negeri) = UPPER(negeri_tb.nt_nama) 
            ) AS calonBilanganDun');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->order_by('calonBilanganParlimen', 'DESC');
        $query = $this->db->get('negeri_tb');
        return $query->result();
    }

    public function senaraiNegeriCalon(){
        $this->db->select('UPPER(negeri_tb.nt_nama) AS negeriNama');
        $this->db->select('(
            SELECT COUNT(*) 
            FROM winnable_candidate_tb 
            LEFT JOIN parlimen_tb ON parlimen_tb.pt_bil = winnable_candidate_tb.wct_parlimen_bil
            WHERE UPPER(parlimen_tb.pt_negeri) = UPPER(negeri_tb.nt_nama) 
            ) AS calonBilanganParlimen');
        $this->db->select('(
            SELECT COUNT(*) 
            FROM jangka_dun_tb 
            LEFT JOIN dun_tb ON dun_tb.dun_bil = jangka_dun_tb.jdt_dun_bil
            WHERE UPPER(dun_tb.dun_negeri) = UPPER(negeri_tb.nt_nama) 
            ) AS calonBilanganDun');
        $this->db->order_by('calonBilanganParlimen', 'DESC');
        $query = $this->db->get('negeri_tb');
        return $query->result();
    }


}