<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_model extends CI_Model {

    private $tableName = 'program';

    public function senaraiDashboardBerhalaman($limit, $start, $search = NULL) {
        if (!empty($search)) {
            $this->db->like('program_nama', $search); // ubah ikut nama lajur yang sesuai
            $this->db->or_like('program_lokasi', $search);
        }

        $this->db->limit($limit, $start);
        $this->db->order_by('program_tarikh_masa', 'DESC'); // optional: ikut susunan masa
        $query = $this->db->get($this->tableName); // ganti dengan nama jadual sebenar anda

        return $query->result();
    }


    public function kiraJumlah($search = NULL) {
        if (!empty($search)) {
            $this->db->like('program_nama', $search);
            $this->db->or_like('program_lokasi', $search);
        }

        return $this->db->count_all_results($this->tableName); // nama jadual sebenar
    }

    public function senaraiIndividu($penggunaBil){
        $select = [
            "program.program_perasmi AS programPerasmi",
            "program.program_status AS programStatus",
            "program.program_tarikh_masa AS programTarikhMasa",
            "program.program_bil AS programNomborSiri",
            "UPPER(jenis_tb.jt_nama) AS programNama",
            "UPPER(pengguna_tb.nama_penuh) AS pelaporNama",
            "UPPER(pengguna_tb.pekerjaan) AS pelaporJawatan",
            "UPPER(pengguna_tb.pengguna_tempat_tugas) AS pelaporPenempatan",
            "UPPER(pengguna_tb.no_tel) AS pelaporNomborTelefon",
            "UPPER(pengguna_tb.emel) AS pelaporEmel",
            "UPPER(negeri_tb.nt_nama) AS negeriNama",
            "UPPER(daerah.nama) AS daerahNama",
            "UPPER(parlimen_tb.pt_nama) AS parlimenNama",
            "UPPER(dun_tb.dun_nama) AS dunNama",
            "(
                SELECT GROUP_CONCAT(UPPER(kandungan_program.kandungan_program_kandungan) SEPARATOR '; ') 
                FROM kandungan_program
                WHERE kandungan_program.kandungan_program_program = program.program_bil
            ) AS naratifSenarai",
            "(
                SELECT GROUP_CONCAT(UPPER(pengisian_program.pengisian_program_pengisian) SEPARATOR '; ') 
                FROM pengisian_program
                WHERE pengisian_program.pengisian_program_program = program.program_bil
            ) AS pengisianSenarai",
            "(
                SELECT GROUP_CONCAT(UPPER(komuniti.komuniti_nama) SEPARATOR '; ') 
                FROM komuniti_program
                LEFT JOIN komuniti ON komuniti.komuniti_bil = komuniti_program.komuniti_program_komuniti
                WHERE komuniti_program.komuniti_program_program = program.program_bil
            ) AS komunitiSenarai",
            "(
                SELECT GROUP_CONCAT(UPPER(program_obp.obp_program_nama) SEPARATOR '; ') 
                FROM program_obp
                WHERE program_obp.obp_program_program = program.program_bil
            ) AS obpSenarai",
            "(
                SELECT GROUP_CONCAT(UPPER(kelabmalaysiaku.kelabmalaysiaku_nama) SEPARATOR '; ') 
                FROM kelabmalaysiaku_program
                LEFT JOIN kelabmalaysiaku ON kelabmalaysiaku.kelabmalaysiaku_bil = kelabmalaysiaku_program.kelabmalaysiaku_program_kelabmalaysiaku
                WHERE kelabmalaysiaku_program.kelabmalaysiaku_program_program = program.program_bil
            ) AS kelabMalaysiakuSenarai",
            "(
                SELECT GROUP_CONCAT(UPPER(lokasi_program.lokasi_program_lokasi) SEPARATOR '; ') 
                FROM lokasi_program
                WHERE lokasi_program.lokasi_program_program = program.program_bil
            ) AS programLokasi",
            "(
                SELECT GROUP_CONCAT(UPPER(penerbitan_program.penerbitan_program_penerbitan) SEPARATOR '; ') 
                FROM penerbitan_program
                WHERE penerbitan_program.penerbitan_program_program = program.program_bil
            ) AS penerbitanSenarai",
            "(
                SELECT SUM(penerbitan_program.penerbitan_program_bilangan) 
                FROM penerbitan_program
                WHERE penerbitan_program.penerbitan_program_program = program.program_bil
            ) AS edaranBilangan",
            "(
                SELECT GROUP_CONCAT(UPPER(agensi_program.agensi_program_agensi) SEPARATOR '; ') 
                FROM agensi_program
                WHERE agensi_program.agensi_program_program = program.program_bil
            ) AS agensiSenarai",
            "(
                SELECT COUNT(*)
                FROM gambar_program
                WHERE gambar_program.gambar_program_program = program.program_bil
            ) AS gambarBilangan",
            "program.program_khalayak AS programKhalayak"
        ];
        $this->db->select($select);
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        $this->db->where("program.program_pelapor", $penggunaBil);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function bilanganLaporan(){
        $query = $this->db->get($this->tableName);
        $bilanganLaporan = $query->num_rows();
        return $bilanganLaporan;
    }

    public function jomMuatTurun(){
        $this->db->select('UPPER(jenis_tb.jt_nama) AS `Nama Program`'); 
        $this->db->select('(SELECT GROUP_CONCAT(UPPER(kandungan_program_kandungan) SEPARATOR ", ") FROM kandungan_program WHERE kandungan_program_program = program.program_bil) AS `Tajuk Hebahan`'); 
        $this->db->select("(
            SELECT GROUP_CONCAT(UPPER(km.komuniti_nama) SEPARATOR ', ') 
            FROM komuniti_program AS komuniti1 
            LEFT JOIN komuniti AS km ON km.komuniti_bil = komuniti1.komuniti_program_komuniti
            WHERE komuniti1.komuniti_program_program = program.program_bil
        ) AS `Komuniti Terlibat`");
        $this->db->select('DATE(program.program_tarikh_masa) AS Tarikh'); 
        $this->db->select('TIME(program.program_tarikh_masa) AS Masa'); 
        $this->db->select('(SELECT GROUP_CONCAT(UPPER(lokasi1.lokasi_program_lokasi) SEPARATOR ", ") FROM lokasi_program AS lokasi1 WHERE lokasi1.lokasi_program_program = program.program_bil) AS Lokasi'); 
        $this->db->select('UPPER(negeri_tb.nt_nama) AS Negeri'); 
        $this->db->select('UPPER(daerah.nama) AS Daerah'); 
        $this->db->select('program.program_khalayak AS `Sasaran Khalayak`'); 
        $this->db->select('UPPER(program.program_perasmi) AS `Tetamu Jemputan`');
        
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT PERANAN TB
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = program.program_peranan', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        $jenisBil = $this->input->post('inputJenisBil');
        if(!empty($jenisBil)){
            $this->db->where('program.program_jenis_program', $jenisBil);
        }
        $negeriBil = $this->input->post('inputNegeriBil');
        if(!empty($negeriBil)){
            $this->db->where('program.program_negeri', $negeriBil);
        }
        $tarikhMula = $this->input->post('inputTarikhMula');
        if(!empty($tarikhMula)){
            $this->db->where('DATE(program.program_tarikh_masa) >= ', $tarikhMula);
        }
        $tarikhTamat = $this->input->post('inputTarikhTamat');
        if(!empty($tarikhTamat)){
            $this->db->where('DATE(program.program_tarikh_masa) <= ', $tarikhTamat);
        }
        $naratif = $this->input->post('inputTajukHebahan');
        if(!empty($naratif)){
            $this->db->where('kandungan_program.kandungan_program_kandungan', $naratif);
        }
        $this->db->where('program.program_status', 'Jadual Aktiviti');
        $this->db->order_by('program.program_tarikh_masa', 'DESC');
        $query = $this->db->get($this->tableName);
        return $query;
    } 


    public function senaraiProgramBil($jenisBil){
        $this->db->select("jenis_tb.jt_bil AS jenisBil");
        $this->db->select("jenis_tb.jt_nama AS jenisNama");
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        $this->db->where("jenis_tb.jt_bil", $jenisBil);
        $this->db->group_by("jenisBil");
        $this->db->order_by("jenisNama", "ASC");
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function senaraiProgram(){
        $this->db->select("jenis_tb.jt_bil AS jenisBil");
        $this->db->select("jenis_tb.jt_nama AS jenisNama");
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        $this->db->group_by("jenisBil");
        $this->db->order_by("jenisNama", "ASC");
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function tukarPelaporLaporan($programBil, $programPelapor){
        $data = array(
            "program_pelapor" => $programPelapor
        );
        $this->db->where('program_bil', $programBil);
        return $this->db->update($this->tableName, $data);
    }

    public function tukarStatusLaporan($programBil, $programStatus){
        $data = array(
            "program_status" => $programStatus
        );
        $this->db->where('program_bil', $programBil);
        return $this->db->update($this->tableName, $data);
    }

    public function program2($programBil){
        $select = [
            "program.program_bil AS programBil",
            "UPPER(jenis_tb.jt_nama) AS programNama",
            "UPPER(pengguna_tb.nama_penuh) AS pelaporNama",
            "UPPER(pengguna_tb.pekerjaan) AS pelaporJawatan",
            "UPPER(pengguna_tb.pengguna_tempat_tugas) AS pelaporPenempatan",
            "UPPER(pengguna_tb.no_tel) AS pelaporNomborTelefon",
            "UPPER(pengguna_tb.emel) AS pelaporEmel",
            "UPPER(daerah.nama) AS daerahNama",
            "UPPER(parlimen_tb.pt_nama) AS parlimenNama",
            "UPPER(dun_tb.dun_nama) AS dunNama",
            "(
                SELECT GROUP_CONCAT(UPPER(kandungan_program.kandungan_program_kandungan) SEPARATOR '; ') 
                FROM kandungan_program
                WHERE kandungan_program.kandungan_program_program = program.program_bil
            ) AS naratifSenarai",
            "(
                SELECT GROUP_CONCAT(UPPER(lokasi_program.lokasi_program_lokasi) SEPARATOR '; ') 
                FROM lokasi_program
                WHERE lokasi_program.lokasi_program_program = program.program_bil
            ) AS lokasiSenarai",
            "DATE(program.program_tarikh_masa) AS programTarikh",
            "TIME(program.program_tarikh_masa) AS programMasa",
            "(
                SELECT SUM(penerbitan_program.penerbitan_program_bilangan) 
                FROM penerbitan_program
                WHERE penerbitan_program.penerbitan_program_program = program.program_bil
            ) AS edaranBilangan",
            "(
                SELECT GROUP_CONCAT(UPPER(agensi_program.agensi_program_agensi) SEPARATOR '; ') 
                FROM agensi_program
                WHERE agensi_program.agensi_program_program = program.program_bil
            ) AS agensiSenarai",
            "program.program_khalayak AS programKhalayak"
        ];
        $this->db->select($select);
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        $this->db->where('program.program_bil', $programBil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function program($programBil){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        $this->db->where('program.program_bil', $programBil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function keputusanCarianNegeri($senaraiNegeri){
        
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT PERANAN TB
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = program.program_peranan', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        //JOIN LEFT KANDUNGAN TB
        $this->db->join('kandungan_program', 'kandungan_program.kandungan_program_program = program.program_bil', 'left');
        $jenisBil = $this->input->post('inputJenis');
        if(!empty($jenisBil)){
            $this->db->where('program.program_jenis_program', $jenisBil);
        }
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('program.program_negeri', $negeri->nt_bil);
        }
        $this->db->group_end();
        $daerahBil = $this->input->post('inputDaerah');
        if(!empty($daerahBil)){
            $this->db->where('program.program_daerah', $daerahBil);
        }
        $parlimenBil = $this->input->post('inputParlimen');
        if(!empty($parlimenBil)){
            $this->db->where('program.program_parlimen', $parlimenBil);
        }
        $dunBil = $this->input->post('inputDun');
        if(!empty($dunBil)){
            $this->db->where('program.program_dun', $dunBil);
        }
        $statusLaporan = $this->input->post('inputStatus');
        if(!empty($statusLaporan)){
            $this->db->where('program.program_status', $statusLaporan);
        }
        $tarikhMula = $this->input->post('inputTarikhMula');
        if(!empty($tarikhMula)){
            $this->db->where('DATE(program.program_tarikh_masa) >= ', $tarikhMula);
        }
        $tarikhTamat = $this->input->post('inputTarikhTamat');
        if(!empty($tarikhTamat)){
            $this->db->where('DATE(program.program_tarikh_masa) <= ', $tarikhTamat);
        }
        $naratif = $this->input->post('inputNaratif');
        if(!empty($naratif)){
            $this->db->where('kandungan_program.kandungan_program_kandungan', $naratif);
        }
        $this->db->group_by('program.program_bil');
        $this->db->order_by('program.program_tarikh_masa', 'DESC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function senaraiLaporanPengguna($personelBil){
        $this->db->select("program.program_bil AS programBil");
        $this->db->select("jenis_tb.jt_nama AS programNama");
        $this->db->select("program.program_tarikh_masa AS programTarikhMasa");
        $this->db->select("negeri_tb.nt_nama AS negeriNama");
        $this->db->select("daerah.nama AS daerahNama");
        $this->db->select("parlimen_tb.pt_nama AS parlimenNama");
        $this->db->select("dun_tb.dun_nama AS dunNama");
        $this->db->select("program.program_status AS programStatus");
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        $this->db->where('program.program_pelapor', $personelBil);
        $this->db->order_by("program.program_tarikh_masa", "DESC");
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function rumusanIkutNegeriProgram($status, $tahun, $programBil){
        $this->db->select("negeri_tb.nt_nama AS negeriNama");
        $this->db->select("COUNT(*) AS negeriBilanganProgram");
        $this->db->select("SUM((
            SELECT COUNT(*)
            FROM lokasi_program
            WHERE lokasi_program.lokasi_program_program = program.program_bil
        )) AS negeriBilanganLokasi");
        $this->db->select("SUM(program.program_khalayak) AS negeriJumlahKhalayak");
        $this->db->select("jenis_tb.jt_nama AS programNama");
        $this->db->select("program.program_jenis_program AS programBil");
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        $this->db->where('program.program_status', $status);
        $this->db->where('YEAR(program.program_tarikh_masa)', $tahun);
        $this->db->where('program.program_jenis_program', $programBil);
        $this->db->group_by('program.program_negeri');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function rumusanIkutNegeri($status, $tahun){
        $this->db->select("negeri_tb.nt_nama AS negeriNama");
        $this->db->select("COUNT(*) AS negeriBilanganProgram");
        $this->db->select("SUM((
            SELECT COUNT(*)
            FROM lokasi_program
            WHERE lokasi_program.lokasi_program_program = program.program_bil
        )) AS negeriBilanganLokasi");
        $this->db->select("SUM(program.program_khalayak) AS negeriJumlahKhalayak");
        $this->db->select("jenis_tb.jt_nama AS programNama");
        $this->db->select("program.program_jenis_program AS programBil");
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        $this->db->where('program.program_status', $status);
        $this->db->where('YEAR(program.program_tarikh_masa)', $tahun);
        $this->db->group_by('program.program_jenis_program', 'program.program_negeri');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function senaraiProgramDashboard($status, $tahun){
        $this->db->select("jenis_tb.jt_nama AS programNama");
        $this->db->select("program.program_jenis_program AS programBil");
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        $this->db->where('program.program_status', $status);
        $this->db->where('YEAR(program.program_tarikh_masa)', $tahun);
        $this->db->group_by('program.program_jenis_program');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function padamSemuaProgram(){
        $this->db->truncate($this->tableName);
        $this->db->truncate('agensi_program');
        $this->db->truncate('gambar_program');
        $this->db->truncate('kandungan_program');
        $this->db->truncate('kelabmalaysiaku_program');
        $this->db->truncate('maklumat_tambahan_program_kelabmalaysiaku');
        $this->db->truncate('maklumat_kaum_program_kelabmalaysiaku');
        $this->db->truncate('program_obp');
        $this->db->truncate('keratan_akhbar_program');
        $this->db->truncate('komuniti_program');
        $this->db->truncate('pautan_program');
        $this->db->truncate('penerbitan_program');
        $this->db->truncate('pengisian_program');
        $this->db->truncate('program_semakan');
        $this->db->truncate('status_program');
        $this->db->truncate('lokasi_program');
    }

    public function senaraiProgramNegeriLaksana($senaraiNegeri, $tahun){
        $this->db->select("program.program_bil AS programBil");
        $this->db->select("jenis_tb.jt_nama AS namaProgram");
        $this->db->select("program.program_tarikh_masa AS tarikhMasaProgram");
        $this->db->select("(SELECT GROUP_CONCAT(lokasi1.lokasi_program_lokasi SEPARATOR '; ') FROM lokasi_program AS lokasi1 WHERE lokasi1.lokasi_program_program = program.program_bil) AS tempatProgram");
        $this->db->select('pengguna_tb.pengguna_tempat_tugas AS urusSetia');
        $this->db->select("negeri_tb.nt_nama AS namaNegeri");
        $this->db->select("daerah.nama AS namaDaerah");
        $this->db->select("parlimen_tb.pt_nama AS namaParlimen");
        $this->db->select("dun_tb.dun_nama AS namaDun");
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
            $this->db->group_start();
            foreach($senaraiNegeri as $negeri){
                $this->db->or_where('program_negeri', $negeri->nt_bil);
            }
            $this->db->group_end();
        $this->db->where('program_status', 'Selesai');
        $this->db->where('YEAR(program_tarikh_masa)', $tahun);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function senaraiProgramNegeriRancang($senaraiNegeri, $tahun){
        //$this->db->select('COUNT(*) AS jumlahProgram');
        $this->db->select("program.program_bil AS programBil");
        $this->db->select("jenis_tb.jt_nama AS namaProgram");
        $this->db->select("program.program_tarikh_masa AS tarikhMasaProgram");
        $this->db->select("(SELECT GROUP_CONCAT(lokasi1.lokasi_program_lokasi SEPARATOR '; ') FROM lokasi_program AS lokasi1 WHERE lokasi1.lokasi_program_program = program.program_bil) AS tempatProgram");
        $this->db->select('pengguna_tb.pengguna_tempat_tugas AS urusSetia');
        $this->db->select("negeri_tb.nt_nama AS namaNegeri");
        $this->db->select("daerah.nama AS namaDaerah");
        $this->db->select("parlimen_tb.pt_nama AS namaParlimen");
        $this->db->select("dun_tb.dun_nama AS namaDun");
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('program_negeri', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('program_status', 'Jadual Aktiviti');
        $this->db->where('YEAR(program_tarikh_masa)', $tahun);
        $this->db->where('DATE(program_tarikh_masa) >=', date("Y-m-d"));
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function bilanganProgramNegeriRancang($senaraiNegeri, $tahun){
        $this->db->select('COUNT(*) AS jumlahProgram');
        $this->db->group_start();
            foreach($senaraiNegeri as $negeri){
                $this->db->or_where('program_negeri', $negeri->nt_bil);
            }
        $this->db->group_end();
        $this->db->where('program_status', 'Jadual Aktiviti');
        $this->db->where('YEAR(program_tarikh_masa)', $tahun);
        $this->db->where('DATE(program_tarikh_masa) >=', date("Y-m-d"));
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function bilanganProgramNegeriLaksana($senaraiNegeri, $tahun){
        $this->db->select('COUNT(*) AS jumlahProgram');
        $this->db->group_start();
            foreach($senaraiNegeri as $negeri){
                $this->db->or_where('program_negeri', $negeri->nt_bil);
            }
        $this->db->group_end();
        $this->db->where('program_status', 'Selesai');
        $this->db->where('YEAR(program_tarikh_masa)', $tahun);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function kuiriDashboardIndividu($penggunaBil){
        $this->db->select('program.program_status AS `Status Program`');
        $this->db->select('program.program_bil AS `Nombor Siri`');
        $this->db->select('pengguna_tb.nama_penuh AS `Nama Pelapor`');
        $this->db->select('pengguna_tb.pekerjaan AS `Jawatan Pelapor`');
        $this->db->select('pengguna_tb.pengguna_tempat_tugas AS `Penempatan Pelapor`');
        $this->db->select('jenis_tb.jt_nama AS `Nama Program`');
        $this->db->select('negeri_tb.nt_nama AS `Negeri`');
        $this->db->select('daerah.nama AS `Daerah`');
        $this->db->select('parlimen_tb.pt_nama AS `Parlimen`');
        $this->db->select('dun_tb.dun_nama AS `DUN`');
        $this->db->select('DATE(program.program_tarikh_masa) AS `Tarikh`');
        $this->db->select('TIME(program.program_tarikh_masa) AS `Masa`');
        $this->db->select('program.program_khalayak AS `Jumlah Khalayak`');
        //BAHAGIAN B - TAJUK HEBAHAN - DONE
        $this->db->select("(SELECT GROUP_CONCAT(kandungan1.kandungan_program_kandungan SEPARATOR '; ') FROM kandungan_program AS kandungan1 WHERE kandungan1.kandungan_program_program = program.program_bil) AS 'Senarai Naratif / Tajuk Hebahan / Ceramah'");
        //BAHAGIAN C - PENGISIAN PROGRAM - DONE
        $this->db->select("(SELECT GROUP_CONCAT(pengisian1.pengisian_program_pengisian SEPARATOR '; ') FROM pengisian_program AS pengisian1 WHERE pengisian1.pengisian_program_program = program.program_bil) AS 'Senarai Pengisian Program'");
        //BAHAGIAN D - LOKASI PROGRAM - DONE
        $this->db->select("(SELECT GROUP_CONCAT(lokasi1.lokasi_program_lokasi SEPARATOR '; ') FROM lokasi_program AS lokasi1 WHERE lokasi1.lokasi_program_program = program.program_bil) AS 'Senarai Lokasi'");
        $this->db->select("(SELECT COUNT(*) FROM lokasi_program AS lokasi1 WHERE lokasi1.lokasi_program_program = program.program_bil) AS 'Bilangan Lokasi'");
        //BAHAGIAN E - PENGLIBATAN KOMUNITI
        $this->db->select("(
            SELECT GROUP_CONCAT(km.komuniti_nama SEPARATOR '; ') 
            FROM komuniti_program AS komuniti1 
            LEFT JOIN komuniti AS km ON km.komuniti_bil = komuniti1.komuniti_program_komuniti
            WHERE komuniti1.komuniti_program_program = program.program_bil
        ) AS 'Senarai Komuniti'");
        //BAHAGIAN F - PENGLIBATAN OBP
        $this->db->select("(
            SELECT GROUP_CONCAT(obp1.obp_program_nama SEPARATOR '; ') 
            FROM program_obp AS obp1 
            WHERE obp1.obp_program_program = program.program_bil
            ) AS 'Senarai OBP'");
        //BAHAGIAN G - PENGLIBATAN KELAB MALAYSIAKU
        $this->db->select("(
            SELECT GROUP_CONCAT(kmk.kelabmalaysiaku_nama SEPARATOR '; ') 
            FROM kelabmalaysiaku_program AS kelab1 
            LEFT JOIN kelabmalaysiaku AS kmk ON kmk.kelabmalaysiaku_bil = kelab1.kelabmalaysiaku_program_kelabmalaysiaku
            WHERE kelab1.kelabmalaysiaku_program_program = program.program_bil
            ) AS 'Senarai Kelab Malaysiaku'");
        //BAHAGIAN H - KERJASAMA AGENSI LAIN
        $this->db->select("(
            SELECT GROUP_CONCAT(agensi1.agensi_program_agensi SEPARATOR '; ') 
            FROM agensi_program AS agensi1 
            WHERE agensi1.agensi_program_program = program.program_bil
            ) AS 'Senarai Penglibatan Agensi Lain'");
        //BAHAGIAN I - EDARAN PENERBITAN
        $this->db->select("(
            SELECT GROUP_CONCAT(penerbitan1.penerbitan_program_penerbitan SEPARATOR '; ') 
            FROM penerbitan_program AS penerbitan1 
            WHERE penerbitan1.penerbitan_program_program = program.program_bil
            ) AS 'Senarai Edaran Penerbitan'");
        $this->db->select("(
            SELECT SUM(penerbitan1.penerbitan_program_bilangan) 
            FROM penerbitan_program AS penerbitan1 
            WHERE penerbitan1.penerbitan_program_program = program.program_bil
            ) AS 'Jumlah Bilangan Edaran Penerbitan'");
        //BAHAGIAN J - BILANGAN GAMBAR/VIDEO
        $this->db->select("(
            SELECT COUNT(*) 
            FROM gambar_program AS gambar1 
            WHERE gambar1.gambar_program_program = program.program_bil
            ) AS 'Bilangan Gambar/Video'");
        //BAHAGIAN K - BILANGAN PAUTAN
        $this->db->select("(
            SELECT COUNT(*) 
            FROM pautan_program AS pautan1 
            WHERE pautan1.pautan_program_program = program.program_bil
            ) AS 'Bilangan Pautan'");
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT PERANAN TB
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = program.program_peranan', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        $this->db->where('YEAR(program.program_tarikh_masa)', date('Y'));
        $this->db->where('program.program_pelapor', $penggunaBil);
        $this->db->order_by('program.program_tarikh_masa', 'DESC');       
        $query = $this->db->get($this->tableName);
        return $query;
    }

    public function senaraiRumusanProgramGspiNegeri($senaraiPelapor){
        $this->db->select('program.program_status');
        $this->db->select('COUNT(*) AS bilanganLaporan');
        foreach($senaraiPelapor as $p){
            $this->db->where('program.program_pelapor', $p->bil);
        }
        $this->db->group_by('program.program_status');
        $this->db->order_by('program_pengguna_waktu', 'DESC');        
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function rumusanPenganjurStatus($status){
        $this->db->select('program.program_bil AS laporanBil');
        $this->db->select('japen_tb.jt_pejabat AS namaOrganisasi');
        $this->db->select('COUNT(pengguna_tb.pengguna_peranan_bil) AS bilanganLaporan');
        $this->db->select('pengguna_tb.pengguna_peranan_bil');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        $this->db->join('organisasi', 'organisasi.o_peranan = pengguna_tb.pengguna_peranan_bil', 'left');
        $this->db->join('japen_tb', 'japen_tb.jt_bil = organisasi.o_japen', 'left');
        $this->db->where('program.program_status', $status);
        $this->db->group_by('pengguna_tb.pengguna_peranan_bil');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function senaraiRumusanProgram($tahun){
        $this->db->select('program.program_status');
        $this->db->select('COUNT(*) AS bilanganLaporan');
        $this->db->where('program.program_status !=', 'Draf');
        $this->db->where('program.program_status !=', 'Draf Negeri');
        $this->db->where('program.program_status !=', 'Pengesahan Perancangan PPD');
        $this->db->where('program.program_status !=', 'Pengesahan Perancangan Negeri');
        $this->db->where('program.program_status !=', 'Pengesahan Perancangan PP PKPM Negeri');
        $this->db->where('program.program_status !=', '');
        $this->db->where('YEAR(program.program_tarikh_masa)', $tahun);
        $this->db->group_by('program.program_status');
        $this->db->order_by('program_pengguna_waktu', 'DESC');        
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function senaraiProgramPerananStatus($perananBil, $status){
        $this->db->select('program.program_bil AS laporanBil');
        $this->db->select('jenis_tb.jt_nama AS namaProgram');
        $this->db->select('daerah.nama AS namaDaerah');
        $this->db->select('parlimen_tb.pt_nama AS namaParlimen');
        $this->db->select('dun_tb.dun_nama AS namaDun');
        $this->db->select('DATE(program.program_tarikh_masa) AS tarikhProgram');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        $this->db->where('pengguna_tb.pengguna_peranan_bil', $perananBil);
        $this->db->where('program.program_status', $status);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function senaraiRumusanPpd($senaraiNegeri, $status){
        $this->db->select('japen_tb.jt_pejabat');
        $this->db->select('pengguna_tb.pengguna_peranan_bil');
        $this->db->select('COUNT(*) AS bilanganLaporan');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        $this->db->join('organisasi', 'organisasi.o_peranan = pengguna_tb.pengguna_peranan_bil', 'left');
        $this->db->join('japen_tb', 'japen_tb.jt_bil = organisasi.o_japen', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('program.program_negeri', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('program.program_status', $status);
        $this->db->group_by('japen_tb.jt_pejabat');
        $this->db->order_by('program.program_tarikh_masa', 'ASC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function senaraiRumusanAnggota($senaraiPelapor){
        $this->db->select('program.program_status');
        $this->db->select('COUNT(*) AS bilanganLaporan');
        $this->db->group_start();
        foreach($senaraiPelapor as $n){
            $this->db->or_where('program.program_pelapor', $n->bil);
        }
        $this->db->group_end();
        $this->db->where('program.program_status !=', 'Draf');
        $this->db->where('program.program_status !=', 'Pengesahan Perancangan PPD');
        $this->db->where('program.program_status !=', '');
        $this->db->where('YEAR(program.program_tarikh_masa)', date("Y"));
        $this->db->group_by('program.program_status');
        $this->db->order_by('program.program_tarikh_masa', 'DESC');        
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function senaraiRumusanProgramNegeri($senaraiNegeri){
        $this->db->select('program.program_status');
        $this->db->select('COUNT(*) AS bilanganLaporan');
        foreach($senaraiNegeri as $n){
            $this->db->or_where('program.program_negeri', $n->negeri);
        }
        $this->db->where('program.program_status !=', 'Draf');
        $this->db->where('program.program_status !=', 'Pengesahan Perancangan PPD');
        $this->db->group_by('program.program_status');
        $this->db->order_by('program_pengguna_waktu', 'DESC');        
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function senaraiLaporanPpdIkutStatus($status, $ppd){
        $this->db->select("*");
        $this->db->select("(SELECT GROUP_CONCAT(kandungan1.kandungan_program_kandungan SEPARATOR ', ') FROM kandungan_program AS kandungan1 WHERE kandungan1.kandungan_program_program = program.program_bil) AS 'senaraiNaratif'");
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT PERANAN TB
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = program.program_peranan', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        $this->db->where('pengguna_tb.pengguna_peranan_bil', $ppd->pengguna_peranan_bil);
        $this->db->where('program_status', $status);
        $this->db->order_by('program.program_tarikh_masa', 'DESC');       
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function keputusanCarianIndividu($penggunaBil){
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT PERANAN TB
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = program.program_peranan', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        //JOIN LEFT KANDUNGAN TB
        $this->db->join('kandungan_program', 'kandungan_program.kandungan_program_program = program.program_bil', 'left');
        $jenisBil = $this->input->post('inputJenis');
        if(!empty($jenisBil)){
            $this->db->where('program.program_jenis_program', $jenisBil);
        }
        $daerahBil = $this->input->post('inputDaerah');
        if(!empty($daerahBil)){
            $this->db->where('program.program_daerah', $daerahBil);
        }
        $parlimenBil = $this->input->post('inputParlimen');
        if(!empty($parlimenBil)){
            $this->db->where('program.program_parlimen', $parlimenBil);
        }
        $dunBil = $this->input->post('inputDun');
        if(!empty($dunBil)){
            $this->db->where('program.program_dun', $dunBil);
        }
        $statusLaporan = $this->input->post('inputStatus');
        if(!empty($statusLaporan)){
            $this->db->where('program.program_status', $statusLaporan);
        }
        $tarikhMula = $this->input->post('inputTarikhMula');
        if(!empty($tarikhMula)){
            $this->db->where('DATE(program.program_tarikh_masa) >= ', $tarikhMula);
        }
        $tarikhTamat = $this->input->post('inputTarikhTamat');
        if(!empty($tarikhTamat)){
            $this->db->where('DATE(program.program_tarikh_masa) <= ', $tarikhTamat);
        }
        $naratif = $this->input->post('inputNaratif');
        if(!empty($naratif)){
            $this->db->where('kandungan_program.kandungan_program_kandungan', $naratif);
        }
        $this->db->where('program.program_pelapor', $penggunaBil);
        $this->db->order_by('program.program_tarikh_masa', 'DESC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function keputusanCarianPpd($perananBil){
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT PERANAN TB
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = program.program_peranan', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        //JOIN LEFT KANDUNGAN TB
        $this->db->join('kandungan_program', 'kandungan_program.kandungan_program_program = program.program_bil', 'left');
        $jenisBil = $this->input->post('inputJenis');
        if(!empty($jenisBil)){
            $this->db->where('program.program_jenis_program', $jenisBil);
        }
        $daerahBil = $this->input->post('inputDaerah');
        if(!empty($daerahBil)){
            $this->db->where('program.program_daerah', $daerahBil);
        }
        $parlimenBil = $this->input->post('inputParlimen');
        if(!empty($parlimenBil)){
            $this->db->where('program.program_parlimen', $parlimenBil);
        }
        $dunBil = $this->input->post('inputDun');
        if(!empty($dunBil)){
            $this->db->where('program.program_dun', $dunBil);
        }
        $statusLaporan = $this->input->post('inputStatus');
        if(!empty($statusLaporan)){
            $this->db->where('program.program_status', $statusLaporan);
        }
        $tarikhMula = $this->input->post('inputTarikhMula');
        if(!empty($tarikhMula)){
            $this->db->where('DATE(program.program_tarikh_masa) >= ', $tarikhMula);
        }
        $tarikhTamat = $this->input->post('inputTarikhTamat');
        if(!empty($tarikhTamat)){
            $this->db->where('DATE(program.program_tarikh_masa) <= ', $tarikhTamat);
        }
        $naratif = $this->input->post('inputNaratif');
        if(!empty($naratif)){
            $this->db->where('kandungan_program.kandungan_program_kandungan', $naratif);
        }
        $this->db->where('program.program_peranan', $perananBil);
        $this->db->order_by('program.program_tarikh_masa', 'DESC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function senaraiProgramPpd($ppd){
        $this->db->select("*");
        $this->db->select("(SELECT GROUP_CONCAT(kandungan1.kandungan_program_kandungan SEPARATOR ', ') FROM kandungan_program AS kandungan1 WHERE kandungan1.kandungan_program_program = program.program_bil) AS 'senaraiNaratif'");
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        $this->db->where('pengguna_tb.pengguna_peranan_bil', $ppd->pengguna_peranan_bil);
        $this->db->order_by('program.program_pengguna_waktu', 'DESC');       
        $this->db->group_by('program.program_status');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function bilanganLaporanSemuaPpd($ppd){
        $this->db->select('COUNT(*) AS bilanganLaporan');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        $this->db->where('pengguna_tb.pengguna_peranan_bil', $ppd->pengguna_peranan_bil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function senaraiStatusPpd($ppd){
        $this->db->select('program.program_status');
        $this->db->select('COUNT(program.program_status) AS kiraanStatus');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        $this->db->where('pengguna_tb.pengguna_peranan_bil', $ppd->pengguna_peranan_bil);
        $this->db->order_by('program.program_pengguna_waktu', 'DESC');       
        $this->db->group_by('program.program_status');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function bilanganLaporanLaksanaPPD($perananBil){
        $this->db->select('COUNT(*) AS bilanganLaporan');
        $this->db->select('program.program_status AS statusLaporan');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        $this->db->where('program.program_status', 'Pengesahan Hantar PPD');
        $this->db->where('pengguna_tb.pengguna_peranan_bil', $perananBil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function bilanganLaporanPengesahanPPD($perananBil){
        $this->db->select('COUNT(*) AS bilanganLaporan');
        $this->db->select('program.program_status AS statusLaporan');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        $this->db->where('program.program_status', 'Pengesahan Perancangan PPD');
        $this->db->where('pengguna_tb.pengguna_peranan_bil', $perananBil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function bilanganLaporanSemuaIndividu($penggunaBil){
        $this->db->select('COUNT(*) AS bilanganLaporan');
        $this->db->where('program_pelapor', $penggunaBil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function senaraiLaporanIndividuIkutStatus($status, $penggunaBil){
        $this->db->select("*");
        $this->db->select("(SELECT GROUP_CONCAT(kandungan1.kandungan_program_kandungan SEPARATOR ', ') FROM kandungan_program AS kandungan1 WHERE kandungan1.kandungan_program_program = program.program_bil) AS 'senaraiNaratif'");
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT PERANAN TB
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = program.program_peranan', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        $this->db->where('program_pelapor', $penggunaBil);
        $this->db->where('program_status', $status);
        $this->db->order_by('program.program_tarikh_masa', 'DESC');       
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function senaraiStatusIndividu($penggunaBil){
        $this->db->select('program_status');
        $this->db->select('COUNT(program_status) AS kiraanStatus');
        $this->db->where('program_pelapor', $penggunaBil);
        $this->db->order_by('program.program_pengguna_waktu', 'DESC');       
        $this->db->group_by('program_status');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function kuiriSenaraiCarian(){
        $this->db->select('UPPER(program.program_status) AS `Status Program`');
        $this->db->select('program.program_bil AS `Nombor Siri`');
        $this->db->select('UPPER(pengguna_tb.nama_penuh) AS `Nama Pelapor`');
        $this->db->select('pengguna_tb.no_tel AS `Nombor Telefon Pelapor`');
        $this->db->select('UPPER(pengguna_tb.pekerjaan) AS `Jawatan Pelapor`');
        $this->db->select('UPPER(pengguna_tb.pengguna_tempat_tugas) AS `Penempatan Pelapor`');
        $this->db->select('UPPER(jenis_tb.jt_nama) AS `Nama Program`');
        $this->db->select('UPPER(negeri_tb.nt_nama) AS `Negeri`');
        $this->db->select('UPPER(daerah.nama) AS `Daerah`');
        $this->db->select('UPPER(parlimen_tb.pt_nama) AS `Parlimen`');
        $this->db->select('UPPER(dun_tb.dun_nama) AS `DUN`');
        $this->db->select('DATE(program.program_tarikh_masa) AS `Tarikh`');
        $this->db->select('TIME(program.program_tarikh_masa) AS `Masa`');
        $this->db->select('program.program_khalayak AS `Jumlah Khalayak`');
        //BAHAGIAN B - TAJUK HEBAHAN - DONE
        $this->db->select("(SELECT GROUP_CONCAT(UPPER(kandungan1.kandungan_program_kandungan) SEPARATOR '; ') FROM kandungan_program AS kandungan1 WHERE kandungan1.kandungan_program_program = program.program_bil) AS 'Senarai Tajuk Hebahan / Naratif / Ceramah'");
        //BAHAGIAN C - PENGISIAN PROGRAM - DONE
        $this->db->select("(SELECT GROUP_CONCAT(UPPER(pengisian1.pengisian_program_pengisian) SEPARATOR '; ') FROM pengisian_program AS pengisian1 WHERE pengisian1.pengisian_program_program = program.program_bil) AS 'Senarai Pengisian Program'");
        //BAHAGIAN D - LOKASI PROGRAM - DONE
        $this->db->select("(SELECT GROUP_CONCAT(UPPER(lokasi1.lokasi_program_lokasi) SEPARATOR '; ') FROM lokasi_program AS lokasi1 WHERE lokasi1.lokasi_program_program = program.program_bil) AS 'Senarai Lokasi'");
        $this->db->select("(SELECT COUNT(*) FROM lokasi_program AS lokasi1 WHERE lokasi1.lokasi_program_program = program.program_bil) AS 'Bilangan Lokasi'");
        //BAHAGIAN E - PENGLIBATAN KOMUNITI
        $this->db->select("(
            SELECT GROUP_CONCAT(UPPER(km.komuniti_nama) SEPARATOR '; ') 
            FROM komuniti_program AS komuniti1 
            LEFT JOIN komuniti AS km ON km.komuniti_bil = komuniti1.komuniti_program_komuniti
            WHERE komuniti1.komuniti_program_program = program.program_bil
        ) AS 'Senarai Komuniti'");
        //BAHAGIAN F - PENGLIBATAN OBP
        $this->db->select("(
            SELECT GROUP_CONCAT(UPPER(obp1.obp_program_nama) SEPARATOR '; ') 
            FROM program_obp AS obp1 
            WHERE obp1.obp_program_program = program.program_bil
            ) AS 'Senarai OBP'");
        //BAHAGIAN G - PENGLIBATAN KELAB MALAYSIAKU
        $this->db->select("(
            SELECT GROUP_CONCAT(UPPER(kmk.kelabmalaysiaku_nama) SEPARATOR '; ') 
            FROM kelabmalaysiaku_program AS kelab1 
            LEFT JOIN kelabmalaysiaku AS kmk ON kmk.kelabmalaysiaku_bil = kelab1.kelabmalaysiaku_program_kelabmalaysiaku
            WHERE kelab1.kelabmalaysiaku_program_program = program.program_bil
            ) AS 'Senarai Kelab Malaysiaku'");
        //BAHAGIAN H - KERJASAMA AGENSI LAIN
        $this->db->select("(
            SELECT GROUP_CONCAT(UPPER(agensi1.agensi_program_agensi) SEPARATOR '; ') 
            FROM agensi_program AS agensi1 
            WHERE agensi1.agensi_program_program = program.program_bil
            ) AS 'Senarai Penglibatan Agensi Lain'");
        //BAHAGIAN I - EDARAN PENERBITAN
        $this->db->select("(
            SELECT GROUP_CONCAT(UPPER(penerbitan1.penerbitan_program_penerbitan) SEPARATOR '; ') 
            FROM penerbitan_program AS penerbitan1 
            WHERE penerbitan1.penerbitan_program_program = program.program_bil
            ) AS 'Senarai Edaran Penerbitan'");
        $this->db->select("(
            SELECT SUM(penerbitan1.penerbitan_program_bilangan) 
            FROM penerbitan_program AS penerbitan1 
            WHERE penerbitan1.penerbitan_program_program = program.program_bil
            ) AS 'Jumlah Bilangan Edaran Penerbitan'");
        //BAHAGIAN J - BILANGAN GAMBAR/VIDEO
        $this->db->select("(
            SELECT COUNT(*) 
            FROM gambar_program AS gambar1 
            WHERE gambar1.gambar_program_program = program.program_bil
            ) AS 'Bilangan Gambar/Video'");
        //BAHAGIAN K - BILANGAN PAUTAN
        $this->db->select("(
            SELECT COUNT(*) 
            FROM pautan_program AS pautan1 
            WHERE pautan1.pautan_program_program = program.program_bil
            ) AS 'Bilangan Pautan'");
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT PERANAN TB
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = program.program_peranan', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        
        $jenisBil = $this->input->post('inputJenis');
        if(!empty($jenisBil)){
            $this->db->where('program.program_jenis_program', $jenisBil);
        }
        $negeriBil = $this->input->post('inputNegeri');
        if(!empty($negeriBil)){
            $this->db->where('program.program_negeri', $negeriBil);
        }
        $daerahBil = $this->input->post('inputDaerah');
        if(!empty($daerahBil)){
            $this->db->where('program.program_daerah', $daerahBil);
        }
        $parlimenBil = $this->input->post('inputParlimen');
        if(!empty($parlimenBil)){
            $this->db->where('program.program_parlimen', $parlimenBil);
        }
        $dunBil = $this->input->post('inputDun');
        if(!empty($dunBil)){
            $this->db->where('program.program_dun', $dunBil);
        }
        $statusLaporan = $this->input->post('inputStatus');
        if(!empty($statusLaporan)){
            $this->db->where('program.program_status', $statusLaporan);
        }
        $tarikhMula = $this->input->post('inputTarikhMula');
        if(!empty($tarikhMula)){
            $this->db->where('DATE(program.program_tarikh_masa) >= ', $tarikhMula);
        }
        $tarikhTamat = $this->input->post('inputTarikhTamat');
        if(!empty($tarikhTamat)){
            $this->db->where('DATE(program.program_tarikh_masa) <= ', $tarikhTamat);
        }

        $this->db->group_by('program.program_bil');
        $this->db->order_by('program.program_tarikh_masa', 'DESC');       
        $query = $this->db->get($this->tableName);
        return $query;
    }

    public function kuiriLaporanPost(){
        $data = array(
            'program.program_status' => 'Penghantaran Hantar Negeri'
        );
        $this->db->where('program.program_bil', $this->input->post('inputProgramBil'));
        return $this->db->update($this->tableName, $data);
    }

    public function batalLaporanPost(){
        $data = array(
            'program.program_status' => 'Batal'
        );
        $this->db->where('program.program_bil', $this->input->post('inputProgramBil'));
        return $this->db->update($this->tableName, $data);
    }

    public function semakanPengguna($programBil, $penggunaBil){
        $this->db->where('program_bil', $programBil);
        $this->db->where('program_pelapor', $penggunaBil);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function semakanPpd($programBil, $perananBil){
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        $this->db->where('program.program_bil', $programBil);
        $this->db->where('pengguna_tb.pengguna_peranan_bil', $perananBil);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function senaraiDashboardDaerah($senaraiDaerah){
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT PERANAN TB
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = program.program_peranan', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        foreach($senaraiDaerah as $d){
            $this->db->where('program.program_daerah', $d->bil);
        }
        $this->db->order_by('program_pengguna_waktu', 'DESC');        
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function update20240110(){
        $this->fieldUpdate();
    }

    private function fieldUpdate(){
        if ($this->db->field_exists('program_perasmi', $this->tableName) == FALSE)
            {   
                $fields = array(
                    'program_perasmi' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($this->tableName, $fields);
            }
    }

    public function update20231226(){
        $this->binaTable();
    }

    private function binaTable(){
        //5.1LOAD LIBRARIES
        $this->load->dbforge();

        if($this->db->table_exists($this->tableName) == FALSE)
        {
            $fields = array(
                'program_bil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE,
                    'auto_increment' => TRUE,
                    'primary_key' => TRUE
                ),
                'program_pelapor' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE
                ),
                'program_no_telefon' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => TRUE
                ),
                'program_jenis_program' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE
                ),
                'program_negeri' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE
                ),
                'program_daerah' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE
                ),
                'program_parlimen' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE
                ),
                'program_dun' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => FALSE
                ),
                'program_tarikh_masa' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                ),
                'program_khalayak' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'program_jumlah_bahan_penerbitan' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'program_status' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => TRUE
                ),
                'program_perasmi' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'program_pengguna' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'program_peranan' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'program_pengguna_waktu' => array(
                    'type' => 'datetime',
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('program_bil', TRUE);
            $this->dbforge->create_table($this->tableName);
        }
    }

    public function senaraiDraf($perananBil){
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT PERANAN TB
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = program.program_peranan', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        $this->db->where('pengguna_tb.pengguna_peranan_bil', $perananBil);
        $this->db->where('program.program_status', 'Pengesahan PPD');
        $this->db->order_by('program_pengguna_waktu', 'DESC');        
        $query = $this->db->get($this->tableName);
        return $query->result();
    }


    public function senaraiProgramPelapor($senaraiPelapor){
        $this->db->select("*");
        $this->db->select("(SELECT GROUP_CONCAT(kandungan1.kandungan_program_kandungan SEPARATOR ', ') FROM kandungan_program AS kandungan1 WHERE kandungan1.kandungan_program_program = program.program_bil) AS 'senaraiNaratif'");
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT PERANAN TB
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = program.program_peranan', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        foreach($senaraiPelapor as $pelapor){
            $this->db->or_where('program.program_pelapor', $pelapor->bil);
        }
        $this->db->order_by('program_pengguna_waktu', 'DESC');        
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function bilanganProgramNegeri($senaraiNegeri, $tahun){
        $this->db->select('COUNT(*) AS jumlahProgram');
        foreach($senaraiNegeri as $negeri){
            $this->db->or_group_start();
                $this->db->where('program_negeri', $negeri->nt_bil);
                $this->db->where('YEAR(program_tarikh_masa)', $tahun);
                $this->db->where('program_status !=', 'Draf');
            $this->db->group_end();
        }
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function keputusanCarian(){
        $column = [
            "program.program_bil AS programBil",
            "jenis_tb.jt_nama AS programNama",
            "negeri_tb.nt_nama AS negeriNama"
        ];
        $this->db->select($column);
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT PERANAN TB
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = program.program_peranan', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        //JOIN LEFT KANDUNGAN TB
        $this->db->join('kandungan_program', 'kandungan_program.kandungan_program_program = program.program_bil', 'left');
        $jenisBil = $this->input->post('inputJenis');
        if(!empty($jenisBil)){
            $this->db->where('program.program_jenis_program', $jenisBil);
        }
        $negeriBil = $this->input->post('inputNegeri');
        if(!empty($negeriBil)){
            $this->db->where('program.program_negeri', $negeriBil);
        }
        $daerahBil = $this->input->post('inputDaerah');
        if(!empty($daerahBil)){
            $this->db->where('program.program_daerah', $daerahBil);
        }
        $parlimenBil = $this->input->post('inputParlimen');
        if(!empty($parlimenBil)){
            $this->db->where('program.program_parlimen', $parlimenBil);
        }
        $dunBil = $this->input->post('inputDun');
        if(!empty($dunBil)){
            $this->db->where('program.program_dun', $dunBil);
        }
        $statusLaporan = $this->input->post('inputStatus');
        if(!empty($statusLaporan)){
            $this->db->where('program.program_status', $statusLaporan);
        }
        $tarikhMula = $this->input->post('inputTarikhMula');
        if(!empty($tarikhMula)){
            $this->db->where('DATE(program.program_tarikh_masa) >= ', $tarikhMula);
        }
        $tarikhTamat = $this->input->post('inputTarikhTamat');
        if(!empty($tarikhTamat)){
            $this->db->where('DATE(program.program_tarikh_masa) <= ', $tarikhTamat);
        }
        $naratif = $this->input->post('inputNaratif');
        if(!empty($naratif)){
            $this->db->where('kandungan_program.kandungan_program_kandungan', $naratif);
        }
        $this->db->group_by('program.program_bil');
        $this->db->order_by('program.program_tarikh_masa', 'DESC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function senaraiStatus(){
        $this->db->where('program_status !=', 'Draf');
        $this->db->group_by('program_status');
        $this->db->order_by('program_status', 'ASC');
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    //NOTA
    //1. Draf - Baru
    //2. Draf - Kemaskini
    //3. Hantar - Baru

    //1. UPDATE
    public function kemaskiniA($noTelPelapor){
        $data = array(
            'program_pelapor' => $this->input->post('inputPelapor'),
            'program_no_telefon' => $noTelPelapor,
            'program_jenis_program' => $this->input->post('inputJenisProgram'),
            'program_negeri' => $this->input->post('inputNegeri'),
            'program_daerah' => $this->input->post('inputDaerah'),
            'program_parlimen' => $this->input->post('inputParlimen'),
            'program_dun' => $this->input->post('inputDun'),
            'program_tarikh_masa' => $this->input->post('inputMasa'),
            'program_khalayak' => $this->input->post('inputKhalayak'),
            'program_pengguna' => $this->input->post('inputPengguna'),
            'program_pengguna_waktu' => date('Y-m-d H:i:s'),
            'program_peranan' => $this->input->post('inputPerananBil'),
            'program_perasmi' => $this->input->post('inputPerasmi'),
            'program_status' => $this->input->post('inputStatus')
        );
        $this->db->where('program_bil', $this->input->post('inputProgramBil'));
        $this->db->update($this->tableName, $data);
    }

    //1.1 UPDATE DRAF INTO HANTAR USING POST
    public function hantar($status){
        $data = array(
            'program_status' => $status
        );
        $this->db->where('program_bil', $this->input->post('inputProgramBil'));
        $this->db->update($this->tableName, $data);
    }
    
    public function hantarLaporan(){
        $data = array(
            'program_status' => 'Hantar'
        );
        $this->db->where('program_bil', $this->input->post('inputProgramBil'));
        $this->db->update($this->tableName, $data);
    }
    
    //2. VIEW
    public function singleProgram($programBil){
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT PERANAN TB
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = program.program_peranan', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        $this->db->where('program_bil', $programBil);
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function manyProgram($programBil){
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT PERANAN TB
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = program.program_peranan', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        $this->db->where('program_bil', $programBil);
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function senaraiDashboardNegeri($senaraiNegeri){
        $this->db->select("*");
        $this->db->select("(SELECT GROUP_CONCAT(kandungan1.kandungan_program_kandungan SEPARATOR ', ') FROM kandungan_program AS kandungan1 WHERE kandungan1.kandungan_program_program = program.program_bil) AS 'senaraiNaratif'");
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT PERANAN TB
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = program.program_peranan', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $n){
            $this->db->or_where('program.program_negeri', $n->negeri);
        }
        $this->db->group_end();
        $this->db->where('program_status !=', 'Draf');
        $this->db->order_by('program_pengguna_waktu', 'DESC');        
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    //3. ADD

    public function tambahPostDrafNegeri($noTelPelapor){
        $dunBil = $this->input->post('inputDun');
        if(empty($dunBil)){
            $dunBil = 0;
        }
        $data = array(
            'program_pelapor' => $this->input->post('inputPelapor'),
            'program_no_telefon' => $noTelPelapor,
            'program_jenis_program' => $this->input->post('inputJenisProgram'),
            'program_negeri' => $this->input->post('inputNegeri'),
            'program_daerah' => $this->input->post('inputDaerah'),
            'program_parlimen' => $this->input->post('inputParlimen'),
            'program_dun' => $dunBil,
            'program_tarikh_masa' => $this->input->post('inputMasa'),
            'program_khalayak' => $this->input->post('inputKhalayak'),
            'program_pengguna' => $this->input->post('inputPengguna'),
            'program_pengguna_waktu' => date('Y-m-d H:i:s'),
            'program_peranan' => $this->input->post('inputPerananBil'),
            'program_perasmi' => $this->input->post('inputPerasmi'),
            'program_status' => 'Draf Negeri'
        );
        $return_data['insert_data'] = $this->db->insert($this->tableName, $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;
    }

    public function tambahPostDraf($noTelPelapor){
        $data = array(
            'program_pelapor' => $this->input->post('inputPelapor'),
            'program_no_telefon' => $noTelPelapor,
            'program_jenis_program' => $this->input->post('inputJenisProgram'),
            'program_negeri' => $this->input->post('inputNegeri'),
            'program_daerah' => $this->input->post('inputDaerah'),
            'program_parlimen' => $this->input->post('inputParlimen'),
            'program_dun' => $this->input->post('inputDun'),
            'program_tarikh_masa' => $this->input->post('inputMasa'),
            'program_khalayak' => $this->input->post('inputKhalayak'),
            'program_pengguna' => $this->input->post('inputPengguna'),
            'program_pengguna_waktu' => date('Y-m-d H:i:s'),
            'program_peranan' => $this->input->post('inputPerananBil'),
            'program_perasmi' => $this->input->post('inputPerasmi'),
            'program_status' => 'Draf'
        );
        $return_data['insert_data'] = $this->db->insert($this->tableName, $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;
    }

    public function tambahPost($noTelPelapor){
        $dunProgram = $this->input->post('inputDun');
        if(empty($dunProgram)){
            $dunProgram = 0;
        }
        $data = array(
            'program_pelapor' => $this->input->post('inputPelapor'),
            'program_no_telefon' => $noTelPelapor,
            'program_jenis_program' => $this->input->post('inputJenisProgram'),
            'program_negeri' => $this->input->post('inputNegeri'),
            'program_daerah' => $this->input->post('inputDaerah'),
            'program_parlimen' => $this->input->post('inputParlimen'),
            'program_dun' => $this->input->post('inputDun'),
            'program_tarikh_masa' => $this->input->post('inputMasa'),
            'program_khalayak' => $this->input->post('inputKhalayak'),
            'program_pengguna' => $this->input->post('inputPengguna'),
            'program_pengguna_waktu' => date('Y-m-d H:i:s'),
            'program_peranan' => $this->input->post('inputPerananBil'),
            'program_perasmi' => $this->input->post('inputPerasmi'),
            'program_status' => 'Jadual Aktiviti'
        );
        $return_data['insert_data'] = $this->db->insert($this->tableName, $data);
        $return_data['last_id'] = $this->db->insert_id();
        return $return_data;
    }

    public function kuiriSenaraiDashboardNegeri($senaraiNegeri){
        $this->db->select('program.program_status AS `Status Program`');
        $this->db->select('program.program_bil AS `Nombor Siri`');
        $this->db->select('pengguna_tb.nama_penuh AS `Nama Pelapor`');
        $this->db->select('pengguna_tb.pekerjaan AS `Jawatan Pelapor`');
        $this->db->select('pengguna_tb.pengguna_tempat_tugas AS `Penempatan Pelapor`');
        $this->db->select('jenis_tb.jt_nama AS `Nama Program`');
        $this->db->select('negeri_tb.nt_nama AS `Negeri`');
        $this->db->select('daerah.nama AS `Daerah`');
        $this->db->select('parlimen_tb.pt_nama AS `Parlimen`');
        $this->db->select('dun_tb.dun_nama AS `DUN`');
        $this->db->select('DATE(program.program_tarikh_masa) AS `Tarikh`');
        $this->db->select('TIME(program.program_tarikh_masa) AS `Masa`');
        $this->db->select('program.program_khalayak AS `Jumlah Khalayak`');
        //BAHAGIAN B - TAJUK HEBAHAN - DONE
        $this->db->select("(SELECT GROUP_CONCAT(kandungan1.kandungan_program_kandungan SEPARATOR '; ') FROM kandungan_program AS kandungan1 WHERE kandungan1.kandungan_program_program = program.program_bil) AS 'Senarai Tajuk Hebahan / Naratif / Ceramah'");
        //BAHAGIAN C - PENGISIAN PROGRAM - DONE
        $this->db->select("(SELECT GROUP_CONCAT(pengisian1.pengisian_program_pengisian SEPARATOR '; ') FROM pengisian_program AS pengisian1 WHERE pengisian1.pengisian_program_program = program.program_bil) AS 'Senarai Pengisian Program'");
        //BAHAGIAN D - LOKASI PROGRAM - DONE
        $this->db->select("(SELECT GROUP_CONCAT(lokasi1.lokasi_program_lokasi SEPARATOR '; ') FROM lokasi_program AS lokasi1 WHERE lokasi1.lokasi_program_program = program.program_bil) AS 'Senarai Lokasi'");
        $this->db->select("(SELECT COUNT(*) FROM lokasi_program AS lokasi1 WHERE lokasi1.lokasi_program_program = program.program_bil) AS 'Bilangan Lokasi'");
        //BAHAGIAN E - PENGLIBATAN KOMUNITI
        $this->db->select("(
            SELECT GROUP_CONCAT(km.komuniti_nama SEPARATOR '; ') 
            FROM komuniti_program AS komuniti1 
            LEFT JOIN komuniti AS km ON km.komuniti_bil = komuniti1.komuniti_program_komuniti
            WHERE komuniti1.komuniti_program_program = program.program_bil
        ) AS 'Senarai Komuniti'");
        //BAHAGIAN F - PENGLIBATAN OBP
        $this->db->select("(
            SELECT GROUP_CONCAT(obp1.obp_program_nama SEPARATOR '; ') 
            FROM program_obp AS obp1 
            WHERE obp1.obp_program_program = program.program_bil
            ) AS 'Senarai OBP'");
        //BAHAGIAN G - PENGLIBATAN KELAB MALAYSIAKU
        $this->db->select("(
            SELECT GROUP_CONCAT(kmk.kelabmalaysiaku_nama SEPARATOR '; ') 
            FROM kelabmalaysiaku_program AS kelab1 
            LEFT JOIN kelabmalaysiaku AS kmk ON kmk.kelabmalaysiaku_bil = kelab1.kelabmalaysiaku_program_kelabmalaysiaku
            WHERE kelab1.kelabmalaysiaku_program_program = program.program_bil
            ) AS 'Senarai Kelab Malaysiaku'");
        //BAHAGIAN H - KERJASAMA AGENSI LAIN
        $this->db->select("(
            SELECT GROUP_CONCAT(agensi1.agensi_program_agensi SEPARATOR '; ') 
            FROM agensi_program AS agensi1 
            WHERE agensi1.agensi_program_program = program.program_bil
            ) AS 'Senarai Penglibatan Agensi Lain'");
        //BAHAGIAN I - EDARAN PENERBITAN
        $this->db->select("(
            SELECT GROUP_CONCAT(penerbitan1.penerbitan_program_penerbitan SEPARATOR '; ') 
            FROM penerbitan_program AS penerbitan1 
            WHERE penerbitan1.penerbitan_program_program = program.program_bil
            ) AS 'Senarai Edaran Penerbitan'");
        $this->db->select("(
            SELECT SUM(penerbitan1.penerbitan_program_bilangan) 
            FROM penerbitan_program AS penerbitan1 
            WHERE penerbitan1.penerbitan_program_program = program.program_bil
            ) AS 'Jumlah Bilangan Edaran Penerbitan'");
        //BAHAGIAN J - BILANGAN GAMBAR/VIDEO
        $this->db->select("(
            SELECT COUNT(*) 
            FROM gambar_program AS gambar1 
            WHERE gambar1.gambar_program_program = program.program_bil
            ) AS 'Bilangan Gambar/Video'");
        //BAHAGIAN K - BILANGAN PAUTAN
        $this->db->select("(
            SELECT COUNT(*) 
            FROM pautan_program AS pautan1 
            WHERE pautan1.pautan_program_program = program.program_bil
            ) AS 'Bilangan Pautan'");
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT PERANAN TB
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = program.program_peranan', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('program_negeri', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('program_status !=', 'Draf');
        $this->db->where('YEAR(program.program_tarikh_masa)', date('Y'));
        $this->db->order_by('program.program_tarikh_masa', 'DESC');       
        $query = $this->db->get($this->tableName);
        return $query;
    }

    public function kuiriSenaraiDashboard(){
        $this->db->select('UPPER(program.program_status) AS `Status Program`');
        $this->db->select('program.program_bil AS `Nombor Siri`');
        $this->db->select('UPPER(pengguna_tb.nama_penuh) AS `Nama Pelapor`');
        $this->db->select('UPPER(pengguna_tb.pekerjaan) AS `Jawatan Pelapor`');
        $this->db->select('UPPER(pengguna_tb.pengguna_tempat_tugas) AS `Penempatan Pelapor`');
        $this->db->select('UPPER(jenis_tb.jt_nama) AS `Nama Program`');
        $this->db->select('UPPER(negeri_tb.nt_nama) AS `Negeri`');
        $this->db->select('UPPER(daerah.nama) AS `Daerah`');
        $this->db->select('UPPER(parlimen_tb.pt_nama) AS `Parlimen`');
        $this->db->select('UPPER(dun_tb.dun_nama) AS `DUN`');
        $this->db->select('DATE(program.program_tarikh_masa) AS `Tarikh`');
        $this->db->select('TIME(program.program_tarikh_masa) AS `Masa`');
        $this->db->select('program.program_khalayak AS `Jumlah Khalayak`');
        //BAHAGIAN B - TAJUK HEBAHAN - DONE
        $this->db->select("(SELECT GROUP_CONCAT(UPPER(kandungan1.kandungan_program_kandungan) SEPARATOR ', ') FROM kandungan_program AS kandungan1 WHERE kandungan1.kandungan_program_program = program.program_bil) AS 'Senarai Tajuk Hebahan / Naratif / Ceramah'");
        //BAHAGIAN C - PENGISIAN PROGRAM - DONE
        $this->db->select("(SELECT GROUP_CONCAT(UPPER(pengisian1.pengisian_program_pengisian) SEPARATOR ', ') FROM pengisian_program AS pengisian1 WHERE pengisian1.pengisian_program_program = program.program_bil) AS 'Senarai Pengisian Program'");
        //BAHAGIAN D - LOKASI PROGRAM - DONE
        $this->db->select("(SELECT GROUP_CONCAT(UPPER(lokasi1.lokasi_program_lokasi) SEPARATOR ', ') FROM lokasi_program AS lokasi1 WHERE lokasi1.lokasi_program_program = program.program_bil) AS 'Senarai Lokasi'");
        $this->db->select("(SELECT COUNT(*) FROM lokasi_program AS lokasi1 WHERE lokasi1.lokasi_program_program = program.program_bil) AS 'Bilangan Lokasi'");
        //BAHAGIAN E - PENGLIBATAN KOMUNITI
        $this->db->select("(
            SELECT GROUP_CONCAT(UPPER(km.komuniti_nama) SEPARATOR ', ') 
            FROM komuniti_program AS komuniti1 
            LEFT JOIN komuniti AS km ON km.komuniti_bil = komuniti1.komuniti_program_komuniti
            WHERE komuniti1.komuniti_program_program = program.program_bil
        ) AS 'Senarai Komuniti'");
        //BAHAGIAN F - PENGLIBATAN OBP
        $this->db->select("(
            SELECT GROUP_CONCAT(UPPER(obp1.obp_program_nama) SEPARATOR ', ') 
            FROM program_obp AS obp1 
            WHERE obp1.obp_program_program = program.program_bil
            ) AS 'Senarai OBP'");
        //BAHAGIAN G - PENGLIBATAN KELAB MALAYSIAKU
        $this->db->select("(
            SELECT GROUP_CONCAT(UPPER(kmk.kelabmalaysiaku_nama) SEPARATOR ', ') 
            FROM kelabmalaysiaku_program AS kelab1 
            LEFT JOIN kelabmalaysiaku AS kmk ON kmk.kelabmalaysiaku_bil = kelab1.kelabmalaysiaku_program_kelabmalaysiaku
            WHERE kelab1.kelabmalaysiaku_program_program = program.program_bil
            ) AS 'Senarai Kelab Malaysiaku'");
        //BAHAGIAN H - KERJASAMA AGENSI LAIN
        $this->db->select("(
            SELECT GROUP_CONCAT(UPPER(agensi1.agensi_program_agensi) SEPARATOR ', ') 
            FROM agensi_program AS agensi1 
            WHERE agensi1.agensi_program_program = program.program_bil
            ) AS 'Senarai Penglibatan Agensi Lain'");
        //BAHAGIAN I - EDARAN PENERBITAN
        $this->db->select("(
            SELECT GROUP_CONCAT(UPPER(penerbitan1.penerbitan_program_penerbitan) SEPARATOR ', ') 
            FROM penerbitan_program AS penerbitan1 
            WHERE penerbitan1.penerbitan_program_program = program.program_bil
            ) AS 'Senarai Edaran Penerbitan'");
        $this->db->select("(
            SELECT SUM(penerbitan1.penerbitan_program_bilangan) 
            FROM penerbitan_program AS penerbitan1 
            WHERE penerbitan1.penerbitan_program_program = program.program_bil
            ) AS 'Jumlah Bilangan Edaran Penerbitan'");
        //BAHAGIAN J - BILANGAN GAMBAR/VIDEO
        $this->db->select("(
            SELECT COUNT(*) 
            FROM gambar_program AS gambar1 
            WHERE gambar1.gambar_program_program = program.program_bil
            ) AS 'Bilangan Gambar/Video'");
        //BAHAGIAN K - BILANGAN PAUTAN
        $this->db->select("(
            SELECT COUNT(*) 
            FROM pautan_program AS pautan1 
            WHERE pautan1.pautan_program_program = program.program_bil
            ) AS 'Bilangan Pautan'");
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT PERANAN TB
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = program.program_peranan', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        $this->db->where('YEAR(program.program_tarikh_masa)', date('Y'));
        $this->db->order_by('program.program_tarikh_masa', 'DESC');       
        $query = $this->db->get($this->tableName);
        return $query;
    }

    public function kuiriSenaraiDashboardPpd($senaraiDaerah){
        $this->db->select('program.program_status AS `Status Program`');
        $this->db->select('program.program_bil AS `Nombor Siri`');
        $this->db->select('pengguna_tb.nama_penuh AS `Nama Pelapor`');
        $this->db->select('pengguna_tb.pekerjaan AS `Jawatan Pelapor`');
        $this->db->select('pengguna_tb.pengguna_tempat_tugas AS `Penempatan Pelapor`');
        $this->db->select('jenis_tb.jt_nama AS `Nama Program`');
        $this->db->select('negeri_tb.nt_nama AS `Negeri`');
        $this->db->select('daerah.nama AS `Daerah`');
        $this->db->select('parlimen_tb.pt_nama AS `Parlimen`');
        $this->db->select('dun_tb.dun_nama AS `DUN`');
        $this->db->select('program.program_perasmi AS `Perasmi`');
        $this->db->select('DATE(program.program_tarikh_masa) AS `Tarikh`');
        $this->db->select('TIME(program.program_tarikh_masa) AS `Masa`');
        $this->db->select('program.program_khalayak AS `Jumlah Khalayak`');
        //BAHAGIAN B - TAJUK HEBAHAN - DONE
        $this->db->select("(SELECT GROUP_CONCAT(kandungan1.kandungan_program_kandungan SEPARATOR '; ') FROM kandungan_program AS kandungan1 WHERE kandungan1.kandungan_program_program = program.program_bil) AS 'Senarai Tajuk Hebahan / Naratif / Ceramah'");
        //BAHAGIAN C - PENGISIAN PROGRAM - DONE
        $this->db->select("(SELECT GROUP_CONCAT(pengisian1.pengisian_program_pengisian SEPARATOR '; ') FROM pengisian_program AS pengisian1 WHERE pengisian1.pengisian_program_program = program.program_bil) AS 'Senarai Pengisian Program'");
        //BAHAGIAN D - LOKASI PROGRAM - DONE
        $this->db->select("(SELECT GROUP_CONCAT(lokasi1.lokasi_program_lokasi SEPARATOR '; ') FROM lokasi_program AS lokasi1 WHERE lokasi1.lokasi_program_program = program.program_bil) AS 'Senarai Lokasi'");
        $this->db->select("(SELECT COUNT(*) FROM lokasi_program AS lokasi1 WHERE lokasi1.lokasi_program_program = program.program_bil) AS 'Bilangan Lokasi'");
        //BAHAGIAN E - PENGLIBATAN KOMUNITI
        $this->db->select("(
            SELECT GROUP_CONCAT(km.komuniti_nama SEPARATOR '; ') 
            FROM komuniti_program AS komuniti1 
            LEFT JOIN komuniti AS km ON km.komuniti_bil = komuniti1.komuniti_program_komuniti
            WHERE komuniti1.komuniti_program_program = program.program_bil
        ) AS 'Senarai Komuniti'");
        //BAHAGIAN F - PENGLIBATAN OBP
        $this->db->select("(
            SELECT GROUP_CONCAT(obp1.obp_program_nama SEPARATOR '; ') 
            FROM program_obp AS obp1 
            WHERE obp1.obp_program_program = program.program_bil
            ) AS 'Senarai OBP'");
        //BAHAGIAN G - PENGLIBATAN KELAB MALAYSIAKU
        $this->db->select("(
            SELECT GROUP_CONCAT(kmk.kelabmalaysiaku_nama SEPARATOR '; ') 
            FROM kelabmalaysiaku_program AS kelab1 
            LEFT JOIN kelabmalaysiaku AS kmk ON kmk.kelabmalaysiaku_bil = kelab1.kelabmalaysiaku_program_kelabmalaysiaku
            WHERE kelab1.kelabmalaysiaku_program_program = program.program_bil
            ) AS 'Senarai Kelab Malaysiaku'");
        //BAHAGIAN H - KERJASAMA AGENSI LAIN
        $this->db->select("(
            SELECT GROUP_CONCAT(agensi1.agensi_program_agensi SEPARATOR '; ') 
            FROM agensi_program AS agensi1 
            WHERE agensi1.agensi_program_program = program.program_bil
            ) AS 'Senarai Penglibatan Agensi Lain'");
        //BAHAGIAN I - EDARAN PENERBITAN
        $this->db->select("(
            SELECT GROUP_CONCAT(penerbitan1.penerbitan_program_penerbitan SEPARATOR '; ') 
            FROM penerbitan_program AS penerbitan1 
            WHERE penerbitan1.penerbitan_program_program = program.program_bil
            ) AS 'Senarai Edaran Penerbitan'");
        $this->db->select("(
            SELECT SUM(penerbitan1.penerbitan_program_bilangan) 
            FROM penerbitan_program AS penerbitan1 
            WHERE penerbitan1.penerbitan_program_program = program.program_bil
            ) AS 'Jumlah Bilangan Edaran Penerbitan'");
        //BAHAGIAN J - BILANGAN GAMBAR/VIDEO
        $this->db->select("(
            SELECT COUNT(*) 
            FROM gambar_program AS gambar1 
            WHERE gambar1.gambar_program_program = program.program_bil
            ) AS 'Bilangan Gambar/Video'");
        //BAHAGIAN K - BILANGAN PAUTAN
        $this->db->select("(
            SELECT COUNT(*) 
            FROM pautan_program AS pautan1 
            WHERE pautan1.pautan_program_program = program.program_bil
            ) AS 'Bilangan Pautan'");
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT PERANAN TB
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = program.program_peranan', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        $this->db->where('YEAR(program.program_tarikh_masa)', date('Y'));
        foreach($senaraiDaerah as $daerah){
            $this->db->where('daerah.bil', $daerah->bil);
        }
        $this->db->order_by('program.program_tarikh_masa', 'DESC');       
        $query = $this->db->get($this->tableName);
        return $query;
    }

    public function senaraiDashboard(){
        $this->db->select('*');
        $this->db->select('(SELECT GROUP_CONCAT(lokasi_program_lokasi SEPARATOR "; ") FROM lokasi_program WHERE lokasi_program.lokasi_program_program = program.program_bil) AS senarai_lokasi');
        $this->db->select('(SELECT COUNT(*) FROM lokasi_program WHERE lokasi_program.lokasi_program_program = program.program_bil) AS bilangan_lokasi');
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT PERANAN TB
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = program.program_peranan', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        $this->db->where('YEAR(program.program_tarikh_masa)', date('Y'));
        $this->db->order_by('program_pengguna_waktu', 'DESC');        
        $query = $this->db->get($this->tableName);
        return $query->result();
    }

    public function senaraiDashboardSebelum(){
        //JOIN LEFT PENGGUNA TB
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = program.program_pelapor', 'left');
        //JOIN LEFT PERANAN TB
        $this->db->join('peranan_tb', 'peranan_tb.peranan_bil = program.program_peranan', 'left');
        //JOIN LEFT JENIS TB
        $this->db->join('jenis_tb', 'jenis_tb.jt_bil = program.program_jenis_program', 'left');
        //JOIN LEFT NEGERI TB
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = program.program_negeri', 'left');
        //JOIN LEFT DAERAH TB
        $this->db->join('daerah', 'daerah.bil = program.program_daerah', 'left');
        //JOIN LEFT PARLIMEN TB
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = program.program_parlimen', 'left');
        //JOIN LEFT DUN TB
        $this->db->join('dun_tb', 'dun_tb.dun_bil = program.program_dun', 'left');
        $this->db->where('YEAR(program.program_tarikh_masa)', date('Y'));
        $this->db->order_by('program_pengguna_waktu', 'DESC');        
        $query = $this->db->get($this->tableName);
        return $query->result();
    }
    //4. DELETE
        //4.1 DELETE PROGRAM POST
        public function padamPost(){
            $this->db->where('program_bil', $this->input->post('inputProgramBil'));
            $this->db->delete($this->tableName);
        }

}

?>