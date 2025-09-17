<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pilihanraya_model extends CI_Model {

    protected $table = 'pilihanraya_tb';

    public function bilanganLaporanUtama(){
        $this->db->select("COUNT(*) AS bilanganLaporan");
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function kiraanPruParlimenNegeri($senaraiNegeri){
        $this->db->select("COUNT(*) as bilanganPruParlimen");
        $this->db->join('pilihanraya_parlimen_tb', 'pilihanraya_parlimen_tb.ppt_pilihanraya_bil = pilihanraya_tb.pilihanraya_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pilihanraya_parlimen_tb.ppt_parlimen_bil', 'left');
        $this->db->join('negeri_tb', 'UPPER(negeri_tb.nt_nama) = UPPER(parlimen_tb.pt_negeri)', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->group_by('pilihanraya_tb.pilihanraya_bil');
        $query = $this->db->get('pilihanraya_tb');
        return $query->row();
    }

    public function kiraanPruDunNegeri($senaraiNegeri){
        $this->db->select("COUNT(*) as bilanganPruDun");
        $this->db->join('pilihanraya_dun_tb', 'pilihanraya_dun_tb.pdt_pilihanraya_bil = pilihanraya_tb.pilihanraya_bil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pilihanraya_dun_tb.pdt_dun_bil', 'left');
        $this->db->join('negeri_tb', 'UPPER(negeri_tb.nt_nama) = UPPER(dun_tb.dun_negeri)', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->group_by('pilihanraya_tb.pilihanraya_bil');
        $query = $this->db->get('pilihanraya_tb');
        return $query->row();
    }


    public function senaraiPruDunNegeri($senaraiNegeri){
        $this->db->select("UPPER(pilihanraya_tb.pilihanraya_nama) AS pruNama");
        $this->db->select("UPPER(pilihanraya_tb.pilihanraya_bil) AS pruBil");
        $this->db->join('pilihanraya_dun_tb', 'pilihanraya_dun_tb.pdt_pilihanraya_bil = pilihanraya_tb.pilihanraya_bil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pilihanraya_dun_tb.pdt_dun_bil', 'left');
        $this->db->join('negeri_tb', 'UPPER(negeri_tb.nt_nama) = UPPER(dun_tb.dun_negeri)', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->group_by('pruBil');
        $this->db->order_by('pilihanraya_tb.pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get('pilihanraya_tb');
        return $query->result();
    }

    public function senaraiPruParlimenNegeri($senaraiNegeri){
        $this->db->select("UPPER(pilihanraya_tb.pilihanraya_nama) AS pruNama");
        $this->db->select("UPPER(pilihanraya_tb.pilihanraya_bil) AS pruBil");
        $this->db->join('pilihanraya_parlimen_tb', 'pilihanraya_parlimen_tb.ppt_pilihanraya_bil = pilihanraya_tb.pilihanraya_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pilihanraya_parlimen_tb.ppt_parlimen_bil', 'left');
        $this->db->join('negeri_tb', 'UPPER(negeri_tb.nt_nama) = UPPER(parlimen_tb.pt_negeri)', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->group_by('pruBil');
        $this->db->order_by('pilihanraya_tb.pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get('pilihanraya_tb');
        return $query->result();
    }

    public function senaraiPruParlimen($senaraiParlimen){
        $this->db->select('*');
        $this->db->join('pilihanraya_tb', 'pilihanraya_parlimen_tb.ppt_pilihanraya_bil = pilihanraya_tb.pilihanraya_bil', 'left');
        $this->db->group_start();
        foreach($senaraiParlimen as $parlimen){
            $this->db->or_where('pilihanraya_parlimen_tb.ppt_parlimen_bil', $parlimen->pt_bil);
        }
        $this->db->group_end();
        $this->db->group_by('pilihanraya_parlimen_tb.ppt_pilihanraya_bil');
        $this->db->order_by('pilihanraya_tb.pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get('pilihanraya_parlimen_tb');
        return $query->result();
    }

    public function senaraiPru(){
        $this->db->select("UPPER(pilihanraya_tb.pilihanraya_nama) AS pruNama");
        $this->db->select("UPPER(pilihanraya_tb.pilihanraya_singkatan) AS pruSingkatan");
        $this->db->select("pilihanraya_tb.pilihanraya_tahun AS pruTahun");
        $this->db->select("pilihanraya_tb.pilihanraya_penamaan_calon AS pruPenamaanCalon");
        $this->db->select("pilihanraya_tb.pilihanraya_lock_status AS pruLockStatus");
        $this->db->select("pilihanraya_tb.pilihanraya_status AS pruStatus");
        $this->db->select("pilihanraya_tb.pilihanraya_jenis AS pruJenis");
        $this->db->order_by('pilihanraya_tb.pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiPilihanrayaDunPeranan($perananBil){
        $this->db->join('pilihanraya_dun_tb', 'pilihanraya_dun_tb.pdt_pilihanraya_bil = pilihanraya_tb.pilihanraya_bil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pilihanraya_dun_tb.pdt_dun_bil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = dun_tb.dun_negeri', 'left');
        $this->db->join('tugas_dun_tb', 'tugas_dun_tb.tdt_dun_bil = dun_tb.dun_bil', 'left');
        $this->db->where('tugas_dun_tb.tdt_peranan_bil', $perananBil);
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'AKTIF');
        $this->db->group_by('pilihanraya_tb.pilihanraya_bil');
        $this->db->order_by('pilihanraya_tb.pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiPilihanrayaParlimenPeranan($perananBil){
        $this->db->join('pilihanraya_parlimen_tb', 'pilihanraya_parlimen_tb.ppt_pilihanraya_bil = pilihanraya_tb.pilihanraya_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pilihanraya_parlimen_tb.ppt_parlimen_bil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = parlimen_tb.pt_negeri', 'left');
        $this->db->join('tugas_parlimen_tb', 'tugas_parlimen_tb.tpt_parlimen_bil = parlimen_tb.pt_bil', 'left');
        $this->db->where('tugas_parlimen_tb.tpt_peranan_bil', $perananBil);
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'AKTIF');
        $this->db->group_by('pilihanraya_tb.pilihanraya_bil');
        $this->db->order_by('pilihanraya_tb.pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function ikutNegeriParlimen($perananBil){
        $this->db->join('pilihanraya_parlimen_tb', 'pilihanraya_parlimen_tb.ppt_pilihanraya_bil = pilihanraya_tb.pilihanraya_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pilihanraya_parlimen_tb.ppt_parlimen_bil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = parlimen_tb.pt_negeri', 'left');
        $this->db->join('tugas_negeri', 'tugas_negeri.negeri = negeri_tb.nt_bil', 'left');
        $this->db->where('tugas_negeri.peranan', $perananBil);
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'AKTIF');
        $this->db->group_by('pilihanraya_tb.pilihanraya_bil');
        $this->db->order_by('pilihanraya_tb.pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get('pilihanraya_tb');
        return $query->result();
    }

    public function senaraiNegeriIkutPeranan($perananBil){
        $this->db->join('pilihanraya_dun_tb', 'pilihanraya_dun_tb.pdt_pilihanraya_bil = pilihanraya_tb.pilihanraya_bil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pilihanraya_dun_tb.pdt_dun_bil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = dun_tb.dun_negeri', 'left');
        $this->db->join('tugas_negeri', 'tugas_negeri.negeri = negeri_tb.nt_bil', 'left');
        $this->db->where('tugas_negeri.peranan', $perananBil);
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'AKTIF');
        $this->db->group_by('negeri_tb.nt_bil');
        $this->db->order_by('pilihanraya_tb.pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get('pilihanraya_tb');
        return $query->result();
    }

    public function ikutNegeriDun($perananBil){
        $this->db->join('pilihanraya_dun_tb', 'pilihanraya_dun_tb.pdt_pilihanraya_bil = pilihanraya_tb.pilihanraya_bil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pilihanraya_dun_tb.pdt_dun_bil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_nama = dun_tb.dun_negeri', 'left');
        $this->db->join('tugas_negeri', 'tugas_negeri.negeri = negeri_tb.nt_bil', 'left');
        $this->db->where('tugas_negeri.peranan', $perananBil);
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'AKTIF');
        $this->db->group_by('pilihanraya_tb.pilihanraya_bil');
        $this->db->order_by('pilihanraya_tb.pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get('pilihanraya_tb');
        return $query->result();
    }

    public function senaraiParlimen($pilihanrayaBil)
    {
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pilihanraya_parlimen_tb.ppt_parlimen_bil');
        $this->db->where('pilihanraya_parlimen_tb.ppt_pilihanraya_bil', $pilihanrayaBil);
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $query = $this->db->get('pilihanraya_parlimen_tb');
        return $query->result();
    }

    public function senaraiParlimenPilihanrayaPeranan($pilihanrayaBil, $perananBil){
        $this->db->join('pilihanraya_parlimen_tb', 'pilihanraya_parlimen_tb.ppt_parlimen_bil = tugas_parlimen_tb.tpt_parlimen_bil');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pilihanraya_parlimen_tb.ppt_pilihanraya_bil');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = tugas_parlimen_tb.tpt_parlimen_bil');
        $this->db->where('pilihanraya_tb.pilihanraya_bil', $pilihanrayaBil);
        $this->db->where('tugas_parlimen_tb.tpt_peranan_bil', $perananBil);
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $query = $this->db->get('tugas_parlimen_tb');
        return $query->result();
    }

    public function senaraiDunPilihanrayaPeranan($pilihanrayaBil, $perananBil){
        $this->db->join('pilihanraya_dun_tb', 'pilihanraya_dun_tb.pdt_dun_bil = tugas_dun_tb.tdt_dun_bil');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pilihanraya_dun_tb.pdt_pilihanraya_bil');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = tugas_dun_tb.tdt_dun_bil');
        $this->db->where('pilihanraya_tb.pilihanraya_bil', $pilihanrayaBil);
        $this->db->where('tugas_dun_tb.tdt_peranan_bil', $perananBil);
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $query = $this->db->get('tugas_dun_tb');
        return $query->result();
    }

    public function senaraiParlimenPilihanraya($status, $perananBil){
        $this->db->join('pilihanraya_parlimen_tb', 'pilihanraya_parlimen_tb.ppt_parlimen_bil = tugas_parlimen_tb.tpt_parlimen_bil');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pilihanraya_parlimen_tb.ppt_pilihanraya_bil');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = tugas_parlimen_tb.tpt_parlimen_bil');
        $this->db->where('pilihanraya_tb.pilihanraya_status', $status);
        $this->db->where('tugas_parlimen_tb.tpt_peranan_bil', $perananBil);
        $query = $this->db->get('tugas_parlimen_tb');
        return $query->result();
    }

    public function senarai(){
        $this->db->order_by('pilihanraya_tb.pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get('pilihanraya_tb');
        return $query->result();
    }

    public function senaraiDunPilihanraya($status, $perananBil){
        $this->db->join('pilihanraya_dun_tb', 'pilihanraya_dun_tb.pdt_dun_bil = tugas_dun_tb.tdt_dun_bil');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pilihanraya_dun_tb.pdt_pilihanraya_bil');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = tugas_dun_tb.tdt_dun_bil');
        $this->db->where('pilihanraya_tb.pilihanraya_status', $status);
        $this->db->where('tugas_dun_tb.tdt_peranan_bil', $perananBil);
        $query = $this->db->get('tugas_dun_tb');
        return $query->result();
    }

    public function senaraiDun($pilihanrayaBil)
    {
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pilihanraya_dun_tb.pdt_dun_bil');
        $this->db->where('pilihanraya_dun_tb.pdt_pilihanraya_bil', $pilihanrayaBil);
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $query = $this->db->get('pilihanraya_dun_tb');
        return $query->result();
    }

    public function pilihanraya_aktif_ikut_negeri_dun($negeri)
    {
        $this->db->join('pilihanraya_dun_tb', 'pilihanraya_dun_tb.pdt_pilihanraya_bil = pilihanraya_tb.pilihanraya_bil');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pilihanraya_dun_tb.pdt_dun_bil');
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'AKTIF');
        $this->db->where('dun_tb.dun_negeri', $negeri);
        $this->db->group_by('pilihanraya_tb.pilihanraya_bil');
        $this->db->order_by('pilihanraya_tb.pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function pilihanraya_aktif_ikut_negeri_parlimen($negeri)
    {
        $this->db->join('pilihanraya_parlimen_tb', 'pilihanraya_parlimen_tb.ppt_pilihanraya_bil = pilihanraya_tb.pilihanraya_bil');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pilihanraya_parlimen_tb.ppt_parlimen_bil');
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'AKTIF');
        $this->db->where('parlimen_tb.pt_negeri', $negeri);
        $this->db->group_by('pilihanraya_tb.pilihanraya_bil');
        $this->db->order_by('pilihanraya_tb.pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function pilihanraya_selesai_ikut_negeri_dun($negeri)
    {
        $this->db->join('pilihanraya_dun_tb', 'pilihanraya_dun_tb.pdt_pilihanraya_bil = pilihanraya_tb.pilihanraya_bil');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pilihanraya_dun_tb.pdt_dun_bil');
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'SELESAI');
        $this->db->where('dun_tb.dun_negeri', $negeri);
        $this->db->group_by('pilihanraya_tb.pilihanraya_bil');
        $this->db->order_by('pilihanraya_tb.pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function pilihanraya_selesai_ikut_negeri_parlimen($negeri)
    {
        $this->db->join('pilihanraya_parlimen_tb', 'pilihanraya_parlimen_tb.ppt_pilihanraya_bil = pilihanraya_tb.pilihanraya_bil');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pilihanraya_parlimen_tb.ppt_parlimen_bil');
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'SELESAI');
        $this->db->where('parlimen_tb.pt_negeri', $negeri);
        $this->db->group_by('pilihanraya_tb.pilihanraya_bil');
        $this->db->order_by('pilihanraya_tb.pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    //MANY //BIL, NAMA, JENIS

    public function selesai(){
        $this->db->select('pilihanraya_bil, pilihanraya_nama, pilihanraya_jenis');
        $this->db->where('pilihanraya_status', 'SELESAI');
        $this->db->order_by('pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function senaraiPruAktif(){
        $this->db->select('pilihanraya_tb.pilihanraya_bil AS pruBil');
        $this->db->select('UPPER(pilihanraya_tb.pilihanraya_nama) AS pruNama');
        $this->db->select('pilihanraya_tb.pilihanraya_singkatan AS pruSingkatan');
        $this->db->select('pilihanraya_bil, pilihanraya_nama, pilihanraya_jenis');
        $this->db->where('pilihanraya_status', 'AKTIF');
        $this->db->order_by('pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function aktif(){
        $this->db->select('pilihanraya_bil, pilihanraya_nama, pilihanraya_jenis');
        $this->db->where('pilihanraya_status', 'AKTIF');
        $this->db->order_by('pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function senarai_dun_pilihanraya($pilihanraya_bil)
    {
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pilihanraya_dun_tb.pdt_dun_bil');
        $this->db->where('pdt_pilihanraya_bil', $pilihanraya_bil);
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $query = $this->db->get('pilihanraya_dun_tb');

        return $query->result();
    }

    public function senarai_parlimen_pilihanraya($pilihanraya_bil)
    {
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pilihanraya_parlimen_tb.ppt_parlimen_bil');
        $this->db->where('ppt_pilihanraya_bil', $pilihanraya_bil);
        $this->db->order_by('parlimen_tb.pt_nama', 'ASC');
        $query = $this->db->get('pilihanraya_parlimen_tb');

        return $query->result();
    }

    public function senaraiKawasanParlimenBaru($pilihanraya_bil){
        $this->db->select("parlimen_tb.pt_bil AS bil");
        $this->db->select('UPPER(parlimen_tb.pt_nama) AS nama');
        $this->db->select('UPPER(parlimen_tb.pt_negeri) AS negeri');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pilihanraya_parlimen_tb.ppt_parlimen_bil');
        $this->db->where('pilihanraya_parlimen_tb.ppt_pilihanraya_bil', $pilihanraya_bil);
        $query = $this->db->get('pilihanraya_parlimen_tb');
        return $query->result();
    }

    public function senaraiKawasanParlimen($pilihanraya_bil){
        $this->db->select("parlimen_tb.pt_bil AS bil");
        $this->db->select('UPPER(parlimen_tb.pt_nama) AS nama');
        $this->db->select('UPPER(parlimen_tb.pt_negeri) AS negeri');
        $this->db->join('pilihanraya_parlimen_tb', 'pilihanraya_parlimen_tb.ppt_pilihanraya_bil = pilihanraya_tb.pilihanraya_bil');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pilihanraya_parlimen_tb.ppt_parlimen_bil');
        $this->db->where('pilihanraya_tb.pilihanraya_bil', $pilihanraya_bil);
        $this->db->group_by('parlimen_tb.pt_negeri');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function senarai_negeri_parlimen($pilihanraya_bil){
        $this->db->join('pilihanraya_parlimen_tb', 'pilihanraya_parlimen_tb.ppt_pilihanraya_bil = pilihanraya_tb.pilihanraya_bil');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pilihanraya_parlimen_tb.ppt_parlimen_bil');
        $this->db->where('pilihanraya_tb.pilihanraya_bil', $pilihanraya_bil);
        $this->db->group_by('parlimen_tb.pt_negeri');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function senaraiKawasanDunBaru($pilihanrayaBil){
        $this->db->select("dun_tb.dun_bil AS bil");
        $this->db->select("UPPER(dun_tb.dun_nama) AS nama");
        $this->db->select("UPPER(dun_tb.dun_negeri) AS negeri");
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pilihanraya_dun_tb.pdt_dun_bil', 'left');
        $this->db->where('pilihanraya_dun_tb.pdt_pilihanraya_bil', $pilihanrayaBil);
        $query = $this->db->get('pilihanraya_dun_tb');
        return $query->result();
    }

    public function senaraiKawasanDun($pilihanraya_bil){
        $this->db->select("dun_tb.dun_bil AS bil");
        $this->db->select("UPPER(dun_tb.dun_nama) AS nama");
        $this->db->select("UPPER(dun_tb.dun_negeri) AS negeri");
        $this->db->join('pilihanraya_dun_tb', 'pilihanraya_dun_tb.pdt_pilihanraya_bil = pilihanraya_tb.pilihanraya_bil');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pilihanraya_dun_tb.pdt_dun_bil');
        $this->db->where('pilihanraya_tb.pilihanraya_bil', $pilihanraya_bil);
        $this->db->group_by('dun_tb.dun_negeri');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function senarai_negeri_dun($pilihanraya_bil){
        $this->db->join('pilihanraya_dun_tb', 'pilihanraya_dun_tb.pdt_pilihanraya_bil = pilihanraya_tb.pilihanraya_bil');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pilihanraya_dun_tb.pdt_dun_bil');
        $this->db->where('pilihanraya_tb.pilihanraya_bil', $pilihanraya_bil);
        $this->db->group_by('dun_tb.dun_negeri');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function clear_semasa(){
        $data = array('pilihanraya_status' => 'BUKAN');
        $this->db->where('pilihanraya_status', 'SEMASA');
        $this->db->update($this->table, $data);
    }

	public function tambah()
	{
        $data = array(
            'pilihanraya_nama' => $this->input->post('pilihanraya_nama'),
            'pilihanraya_singkatan' => $this->input->post('pilihanraya_singkatan'),
            'pilihanraya_tahun' => date ('Y', strtotime($this->input->post('pilihanraya_tahun'))),
            'pilihanraya_status' => $this->input->post('pilihanraya_status'),
            'pilihanraya_waktu' => date ('Y-m-d H:i:s'),
            'pilihanraya_pengguna' => $this->session->userdata('pengguna_bil')          
        );

    return $this->db->insert($this->table, $data);
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
        $this->db->order_by('pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function papar_aktif()
    {
        $this->db->where('pilihanraya_status', 'AKTIF');
        $this->db->order_by('pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function papar_aktif_jenis($jenis)
    {
        $this->db->where('pilihanraya_status', 'AKTIF');
        $this->db->where('pilihanraya_jenis', $jenis);
        $this->db->order_by('pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function papar_parlimen_semua(){
        $this->db->join('pencalonan_parlimen_tb', 'pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil = pilihanraya_tb.pilihanraya_bil');
        $this->db->order_by('pilihanraya_tb.pilihanraya_penamaan_calon', 'DESC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function padam($bil){
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_pilihanraya = pilihanraya_tb.pilihanraya_bil');
        $this->db->where('pilihanraya_bil', $bil);
        $this->db->delete($this->table);
    }

    public function pilihanraya_semasa(){
        $this->db->where('pilihanraya_status', 'SEMASA');
        $query = $this->db->get($this->table);
        $result = $query->result();
        foreach($result as $r){
            $bil = $r->pilihanraya_bil;
        }
        return $bil;
    }

    public function papar($pilihanraya_bil){
        $this->db->where('pilihanraya_bil', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function semak_semasa($pilihanraya_bil){
        $this->db->where('pilihanraya_status', 'SEMASA');
        $this->db->where('pilihanraya_bil', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function set_semasa($pilihanraya_bil){
        $data = array('pilihanraya_status' => 'SEMASA');
        $this->db->where('pilihanraya_bil', $pilihanraya_bil);
        $this->db->update($this->table, $data);
    }

    public function kemaskini_maklumat($pilihanraya_bil)
    {
        $data = array(
            'pilihanraya_nama' => $this->input->post('pilihanraya_nama'),
            'pilihanraya_singkatan' => $this->input->post('pilihanraya_singkatan'),
            'pilihanraya_tahun' => $this->input->post('pilihanraya_tahun'),
            'pilihanraya_penamaan_calon' => $this->input->post('pilihanraya_penamaan_calon'),
            'pilihanraya_lock_status' => $this->input->post('pilihanraya_lock_status'),
            'pilihanraya_status' => $this->input->post('pilihanraya_status'),
            'pilihanraya_jenis' => $this->input->post('pilihanraya_jenis')
        );
        $this->db->where('pilihanraya_bil', $pilihanraya_bil);
        $this->db->update($this->table, $data);
    }

    public function pilihanraya_terakhir_bil(){
        $bil = 1;
        $this->db->order_by('pilihanraya_bil', 'ASC');
        $query = $this->db->get($this->table);
        foreach($query->result() as $q){
            $bil = $q->pilihanraya_bil;
        }
        return $bil;
    }

    public function bilangan_menang_sebenar($pilihanraya_bil, $parti_bil){
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_pilihanraya = pilihanraya_tb.pilihanraya_bil', 'right');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_tb.pencalonan_parti', $parti_bil);
        $this->db->where('pencalonan_tb.pencalonan_keputusan_sebenar', 'MENANG');
        $query = $this->db->get($this->table);
        return count($query->result());
    } 

    public function jangkaan_japen($pilihanraya_bil, $parti_bil){
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_pilihanraya = pilihanraya_tb.pilihanraya_bil', 'right');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_tb.pencalonan_parti', $parti_bil);
        $this->db->where('pencalonan_tb.pencalonan_jangkaan_japen', 'MENANG');
        $query = $this->db->get($this->table);
        return count($query->result());
    } 

    public function keputusan_tidak_rasmi($pilihanraya_bil, $parti_bil){
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_pilihanraya = pilihanraya_tb.pilihanraya_bil', 'right');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_tb.pencalonan_parti', $parti_bil);
        $this->db->where('pencalonan_tb.pencalonan_keputusan_tidak_rasmi', 'MENANG');
        $query = $this->db->get($this->table);
        return count($query->result());
    } 

    public function keputusan_rasmi($pilihanraya_bil, $parti_bil){
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_pilihanraya = pilihanraya_tb.pilihanraya_bil', 'right');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->where('pencalonan_tb.pencalonan_parti', $parti_bil);
        $this->db->where('pencalonan_tb.pencalonan_keputusan_sebenar', 'MENANG');
        $query = $this->db->get($this->table);
        return count($query->result());
    } 

    public function keputusan_penuh($pilihanraya_bil){
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_pilihanraya = pilihanraya_tb.pilihanraya_bil', 'right');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->group_by('pencalonan_tb.pencalonan_parti');
        $query = $this->db->get($this->table);
        $parti = array();
        $count = 0;

        foreach($query->result() as $q){
            $parti[$count]['parti_singkatan'] = $q->parti_singkatan;
            $parti[$count]['bilangan_menang'] = $this->bilangan_menang_sebenar($pilihanraya_bil, $q->parti_bil);
            $parti[$count]['jangkaan_japen'] = $this->jangkaan_japen($pilihanraya_bil, $q->parti_bil);
            $count++;
        }
        $bilangan_menang = array_column($parti, 'bilangan_menang');
        array_multisort($bilangan_menang, SORT_DESC, $parti);
        return $parti;
        
    }

    public function dun_jangkaan_japen($dun_bil){
        $singkatan_parti = "BELUM DITENTUKAN";
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_pilihanraya = pilihanraya_tb.pilihanraya_bil', 'right');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->where('pencalonan_tb.pencalonan_dun', $dun_bil);
        $this->db->where('pencalonan_tb.pencalonan_jangkaan_japen', 'MENANG');
        $query = $this->db->get($this->table);
        foreach($query->result() as $q){
            $singkatan_parti = $q->parti_singkatan;
        }
        return $singkatan_parti; 
    }

    public function dun_tidak_rasmi($dun_bil, $pilihanraya_bil){
        $singkatan_parti = "BELUM DITENTUKAN";
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_pilihanraya = pilihanraya_tb.pilihanraya_bil', 'right');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->where('pencalonan_tb.pencalonan_dun', $dun_bil);
        $this->db->where('pencalonan_tb.pencalonan_keputusan_tidak_rasmi', 'MENANG');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $query = $this->db->get($this->table);
        foreach($query->result() as $q){
            $singkatan_parti = $q->parti_singkatan;
        }
        return $singkatan_parti; 
    }

    public function dun_rasmi($dun_bil){
        $singkatan_parti = "BELUM DITENTUKAN";
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_pilihanraya = pilihanraya_tb.pilihanraya_bil', 'right');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->where('pencalonan_tb.pencalonan_dun', $dun_bil);
        $this->db->where('pencalonan_tb.pencalonan_keputusan_sebenar', 'MENANG');
        $query = $this->db->get($this->table);
        foreach($query->result() as $q){
            $singkatan_parti = $q->parti_singkatan;
        }
        return $singkatan_parti; 
    }

    public function keputusan_dun($pilihanraya_bil){
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_pilihanraya = pilihanraya_tb.pilihanraya_bil', 'right');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->where('pencalonan_tb.pencalonan_pilihanraya', $pilihanraya_bil);
        $this->db->group_by('pencalonan_tb.pencalonan_dun');
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $query = $this->db->get($this->table);
        $parti = array();
        $count = 0;

        foreach($query->result() as $q){
            $parti[$count]['nama_dun'] = $q->dun_nama;
            $parti[$count]['parti_jangkaan_japen'] = $this->dun_jangkaan_japen($q->dun_bil);
            $parti[$count]['parti_menang'] = $this->dun_rasmi($q->dun_bil);
            $count++;
        }
        return $parti;
    }

    public function senarai_dun($pilihanraya_bil){
        $this->db->select('pencalonan_tb.pencalonan_bil');
        $this->db->select('dun_tb.dun_nama');
        $this->db->select('dun_tb.dun_bil');
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_pilihanraya = pilihanraya_tb.pilihanraya_bil', 'right');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->where('pilihanraya_bil', $pilihanraya_bil);
        $this->db->group_by('pencalonan_tb.pencalonan_dun');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senarai_dun_ikut_negeri($pilihanraya_bil, $negeri_nama){
        $this->db->select('pencalonan_tb.pencalonan_bil');
        $this->db->select('dun_tb.dun_nama');
        $this->db->select('dun_tb.dun_bil');
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_pilihanraya = pilihanraya_tb.pilihanraya_bil', 'right');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->where('pilihanraya_bil', $pilihanraya_bil);
        $this->db->where('dun_tb.dun_negeri', $negeri_nama);
        $this->db->group_by('pencalonan_tb.pencalonan_dun');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    

    public function senarai_calon($pilihanraya_bil){
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_pilihanraya = pilihanraya_tb.pilihanraya_bil', 'right');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pencalonan_tb.pencalonan_dun', 'left');
        $this->db->join('ahli_tb', 'ahli_tb.ahli_bil = pencalonan_tb.pencalonan_ahli', 'left');
        $this->db->join('parti_tb', 'parti_tb.parti_bil = pencalonan_tb.pencalonan_parti', 'left');
        $this->db->where('pilihanraya_bil', $pilihanraya_bil);
        $this->db->group_by('pencalonan_tb.pencalonan_ahli');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    public function pilihan_japen()
    {

        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function pilihanraya($pilihanrayaBil)
    {
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = pilihanraya_tb.pilihanraya_pengguna', 'left');
        $this->db->where('pilihanraya_bil', $pilihanrayaBil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function pilihanraya_parlimen($pilihanrayaBil)
    {
        $this->db->join('pencalonan_parlimen_tb', 'pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil = pilihanraya_tb.pilihanraya_bil');
        $this->db->where('pilihanraya_tb.pilihanraya_bil', $pilihanrayaBil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function pilihanraya_baru()
    {
        $this->db->order_by('pilihanraya_penamaan_calon', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function pilihanraya_parlimen_baru()
    {
        $this->db->join('pencalonan_parlimen_tb', 'pencalonan_parlimen_tb.pencalonan_parlimen_pilihanrayaBil = pilihanraya_tb.pilihanraya_bil');
        $this->db->order_by('pilihanraya_tb.pilihanraya_penamaan_calon', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function pilihanraya_dun_baru()
    {
        $this->db->join('pencalonan_tb', 'pencalonan_tb.pencalonan_pilihanraya = pilihanraya_tb.pilihanraya_bil');
        $this->db->order_by('pilihanraya_tb.pilihanraya_penamaan_calon', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function pilihanraya_ikut_tahun($tahun){
        $this->db->where('YEAR(pilihanraya_penamaan_calon)', date_format(date_create($tahun), "Y"));
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function parlimen_pr($parlimen_bil)
    {
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pilihanraya_parlimen_tb.ppt_parlimen_bil');
        $this->db->where('parlimen_tb.pt_bil', $parlimen_bil);
        $query = $this->db->get('pilihanraya_parlimen_tb');
        return $query->result();
    }

    public function parlimen_pr_aktif($parlimen_bil)
    {
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pilihanraya_parlimen_tb.ppt_parlimen_bil');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pilihanraya_parlimen_tb.ppt_pilihanraya_bil');
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'AKTIF');
        $this->db->where('parlimen_tb.pt_bil', $parlimen_bil);
        $query = $this->db->get('pilihanraya_parlimen_tb');
        return $query->result();
    }

    public function dun_pr_aktif($dun_bil)
    {
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pilihanraya_dun_tb.pdt_dun_bil');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pilihanraya_dun_tb.pdt_pilihanraya_bil');
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'AKTIF');
        $this->db->where('dun_tb.dun_bil', $dun_bil);
        $query = $this->db->get('pilihanraya_dun_tb');
        return $query->result();
    }

    public function negeri_pr_aktif($negeri)
    {
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pilihanraya_parlimen_tb.ppt_parlimen_bil');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pilihanraya_parlimen_tb.ppt_pilihanraya_bil');
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'AKTIF');
        $this->db->where('parlimen_tb.pt_negeri', $negeri);
        $query = $this->db->get('pilihanraya_parlimen_tb');
        return $query->result();
    }

    public function negeri_dun_aktif($negeri)
    {
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pilihanraya_dun_tb.pdt_dun_bil');
        $this->db->join('pilihanraya_tb', 'pilihanraya_tb.pilihanraya_bil = pilihanraya_dun_tb.pdt_pilihanraya_bil');
        $this->db->where('pilihanraya_tb.pilihanraya_status', 'AKTIF');
        $this->db->where('dun_tb.dun_negeri', $negeri);
        $this->db->order_by('dun_tb.dun_nama', 'ASC');
        $query = $this->db->get('pilihanraya_dun_tb');
        return $query->result();
    }

    public function pr_parlimen($pilihanraya_bil){
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = pilihanraya_parlimen_tb.ppt_parlimen_bil');
        $this->db->where('pilihanraya_parlimen_tb.ppt_pilihanraya_bil', $pilihanraya_bil);
        $query = $this->db->get('pilihanraya_parlimen_tb');
        return $query->result();
    }

    public function pr_dun($pilihanraya_bil){
        $this->db->join('dun_tb', 'dun_tb.dun_bil = pilihanraya_dun_tb.pdt_dun_bil');
        $this->db->where('pilihanraya_dun_tb.pdt_pilihanraya_bil', $pilihanraya_bil);
        $query = $this->db->get('pilihanraya_dun_tb');
        return $query->result();
    }

    public function semak_parlimen($pilihanraya_bil, $parlimen_bil){
        $this->db->where('ppt_pilihanraya_bil', $pilihanraya_bil);
        $this->db->where('ppt_parlimen_bil', $parlimen_bil);
        $query = $this->db->get('pilihanraya_parlimen_tb');
        return $query->row();
    }

    public function semak_dun($pilihanraya_bil, $dun_bil){
        $this->db->where('pdt_pilihanraya_bil', $pilihanraya_bil);
        $this->db->where('pdt_dun_bil', $dun_bil);
        $query = $this->db->get('pilihanraya_dun_tb');
        return $query->row();
    }

    public function tambah_parlimen($parlimen_bil)
    {
        $data = array(
            'ppt_pilihanraya_bil' => $this->input->post('input_pilihanraya_bil'),
            'ppt_parlimen_bil' => $parlimen_bil,
            'ppt_pengguna_bil' => $this->input->post('input_pengguna_bil'),
            'ppt_pengguna_waktu' => $this->input->post('input_pengguna_waktu')
        );
        $this->db->insert("pilihanraya_parlimen_tb", $data);
    }

    public function tambah_dun($dun_bil)
    {
        $data = array(
            'pdt_pilihanraya_bil' => $this->input->post('input_pilihanraya_bil'),
            'pdt_dun_bil' => $dun_bil,
            'pdt_pengguna_bil' => $this->input->post('input_pengguna_bil'),
            'pdt_pengguna_waktu' => $this->input->post('input_pengguna_waktu')
        );
        $this->db->insert("pilihanraya_dun_tb", $data);
    }

    public function buang_parlimen_tanding()
    {
        $this->db->where('ppt_bil', $this->input->post('input_bil'));
        $this->db->delete("pilihanraya_parlimen_tb");
    }

    public function buang_dun_tanding()
    {
        $this->db->where('pdt_bil', $this->input->post('input_bil'));
        $this->db->delete("pilihanraya_dun_tb");
    }

}
