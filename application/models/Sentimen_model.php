<?php
class Sentimen_model extends CI_Model
{

    private $table = 'sentimen_tb';

    /**
     * Mendapatkan senarai laporan sentimen terkini, termasuk nama pelapor.
     * @param int $limit Bilangan laporan untuk dipaparkan.
     * @return array
     */
    public function laporan_terkini($limit = 5)
    {
        $this->db->select("sentimen_tb.stPerkara, sentimen_tb.stTarikhLaporan, pengguna_tb.nama_penuh AS penggunaNama");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->order_by('sentimen_tb.stTarikhLaporan', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('sentimen_tb');
        return $query->result();
    }

    public function senaraiBilanganLaporan($perananBil, $tahun){
        $columns = [
            "pengguna_tb.bil AS pegawaiNomborSiri",
            "UPPER(pengguna_tb.nama_penuh) AS pegawaiNama",
            "UPPER(pengguna_tb.pekerjaan) AS pegawaiJawatan",
            "COUNT(CASE WHEN DATE(sentimen_tb.stTarikhLaporan) = CURDATE() THEN 1 ELSE NULL END) AS laporanHari",
            "COUNT(CASE WHEN WEEKDAY(sentimen_tb.stTarikhLaporan) = WEEKDAY(CURDATE()) AND YEAR(sentimen_tb.stTarikhLaporan) = YEAR(CURDATE()) THEN 1 ELSE NULL END) AS laporanMinggu",
            "COUNT(CASE WHEN MONTH(sentimen_tb.stTarikhLaporan) = MONTH(CURDATE()) AND YEAR(sentimen_tb.stTarikhLaporan) = YEAR(CURDATE()) THEN 1 ELSE NULL END) AS laporanBulan",
            "COUNT(CASE WHEN YEAR(sentimen_tb.stTarikhLaporan) = YEAR(CURDATE()) THEN 1 ELSE NULL END) AS laporanTahun"
        ];
        $this->db->select($columns);

        $joins = [
            ['pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left']
        ];
        foreach ($joins as $join) {
            $this->db->join($join[0], $join[1], $join[2]);
        }

        $this->db->where("pengguna_tb.pengguna_peranan_bil", $perananBil);
        $this->db->where("YEAR(sentimen_tb.stTarikhLaporan)", $tahun);

        $this->db->order_by("laporanTahun", "DESC");

        $this->db->group_by("pengguna_tb.bil");
        $this->db->group_by("pengguna_tb.nama_penuh");
        $this->db->group_by("pengguna_tb.pekerjaan");

        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanIkutNegeri($tahun){
        $columns = [
            "UPPER(negeri_tb.nt_nama) AS negeriNama",
            "COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'POSITIF' THEN 1 END) AS positif",
            "COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'NEUTRAL' THEN 1 END) AS neutral",
            "COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'NEGATIF' THEN 1 END) AS negatif",
            "CASE 
            WHEN COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'POSITIF' THEN 1 END) >= COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'NEUTRAL' THEN 1 END) 
                 AND COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'POSITIF' THEN 1 END) >= COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'NEGATIF' THEN 1 END) 
            THEN 'POSITIF'
            WHEN COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'NEUTRAL' THEN 1 END) >= COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'POSITIF' THEN 1 END) 
                 AND COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'NEUTRAL' THEN 1 END) >= COUNT(CASE WHEN UPPER(sentimen_tb.stSentimen) = 'NEGATIF' THEN 1 END) 
            THEN 'NEUTRAL'
            ELSE 'NEGATIF'
        END AS dominan"
        ];
        $this->db->select($columns);
        $this->db->where('YEAR(sentimen_tb.stTarikhLaporan)', $tahun);
        // Define table joins
        $joins = [
            ['pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left'],
            ['daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left'],
            ['negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left'],
            ['parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left'],
            ['dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left'],
        ];
    
        // Apply joins
        foreach ($joins as $join) {
            $this->db->join($join[0], $join[1], $join[2]);
        }
        $this->db->group_by('negeri_tb.nt_bil');
        $this->db->order_by('negeriNama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function padam($sentimenBil){
        $this->db->delete($this->table, ['sentimen_tb.stBil' => $sentimenBil]);
    }

    public function statusPenghantaran($senaraiAnggota){
        $columns = [
            "UPPER(pengguna_tb.nama_penuh) AS nama_penuh",
            "pengguna_tb.bil",
            "UPPER(pengguna_tb.pekerjaan) AS jawatan",
            "UPPER(pengguna_tb.pengguna_tempat_tugas) AS penempatan",
            "COUNT(sentimen_tb.stPelaporBil) AS jumlah_laporan"
        ];
        $this->db->select($columns);
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiAnggota as $anggota){
            $this->db->or_where('sentimen_tb.stPelaporBil', $anggota->bil);
        }
        $this->db->group_end();
        $this->db->where('YEAR(sentimen_tb.stTarikhLaporan)', date("Y"));
        $this->db->group_by('sentimen_tb.stPelaporBil');
        $this->db->order_by("jumlah_laporan", "DESC");
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function muatTurunPilihan($filters = [], $senaraiPeranan) {
        // Define columns to select with aliases
        $columns = [
            "sentimen_tb.stBil AS `NOMBOR SIRI`",
            "sentimen_tb.stPenggunaWaktu AS `LAPORAN DIBINA`",
            "pengguna_tb.emel AS `E-MEL PELAPOR`",
            "sentimen_tb.stTarikhLaporan AS `TARIKH LAPORAN`",
            "UPPER(pengguna_tb.nama_penuh) AS `NAMA PELAPOR`",
            "pengguna_tb.no_tel AS `NOMBOR TELEFON PELAPOR`",
            "UPPER(negeri_tb.nt_nama) AS `NEGERI`",
            "UPPER(daerah.nama) AS `DAERAH`",
            "UPPER(parlimen_tb.pt_nama) AS `PARLIMEN`",
            "UPPER(dun_tb.dun_nama) AS `DUN`",
            "UPPER(sentimen_tb.stKawasan) AS `KAWASAN RESPONDEN`",
            "UPPER(sentimen_tb.stPekerjaan) AS `PEKERJAAN RESPONDEN`",
            "UPPER(sentimen_tb.stUmur) AS `KATEGORI UMUR RESPONDEN`",
            "UPPER(sentimen_tb.stKaum) AS `KAUM RESPONDEN`",
            "UPPER(sentimen_tb.stJantina) AS `JANTINA RESPONDEN`",
            "UPPER(sentimen_tb.stSentimen) AS `SENTIMEN`",
            "sentimen_tb.stAlasan AS `ULASAN SENTIMEN`",
        ];
    
        // Select columns
        $this->db->select($columns);
    
        // Define table joins
        $joins = [
            ['pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left'],
            ['daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left'],
            ['negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left'],
            ['parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left'],
            ['dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left'],
        ];
    
        // Apply joins
        foreach ($joins as $join) {
            $this->db->join($join[0], $join[1], $join[2]);
        }
    
        // Apply filtering conditions if provided
        if (!empty($filters)) {
            foreach ($filters as $column => $value) {
                // Check for special handling (e.g., LIKE for partial matches)
                if (is_array($value) && isset($value['operator'])) {
                    // Handle different operators (e.g., LIKE, >, <, etc.)
                    $this->db->where("{$column} {$value['operator']}", $value['value']);
                } else {
                    // Default to equality
                    $this->db->where($column, $value);
                }
            }
        }
    
        // Apply default condition
        $this->db->where('stTapisan', 'Terima');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
    
        // Set ordering
        $this->db->order_by('sentimen_tb.stPenggunaWaktu', 'DESC');
    
        // Execute query
        $query = $this->db->get($this->table);
    
        return $query->result_array();
    }
    

    public function sentimenPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(sentimen_tb.stSentimen) AS nama");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->where('sentimen_tb.stSentimen !=', '');
        $this->db->group_by('sentimen_tb.stSentimen');
        $this->db->order_by('sentimen_tb.stSentimen', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function jantinaPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(sentimen_tb.stJantina) AS nama");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->where('sentimen_tb.stJantina !=', '');
        $this->db->group_by('sentimen_tb.stJantina');
        $this->db->order_by('sentimen_tb.stJantina', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function kaumPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(sentimen_tb.stKaum) AS nama");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->where('sentimen_tb.stKaum !=', '');
        $this->db->group_by('sentimen_tb.stKaum');
        $this->db->order_by('sentimen_tb.stKaum', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function umurPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(sentimen_tb.stUmur) AS nama");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->where('sentimen_tb.stUmur !=', '');
        $this->db->group_by('sentimen_tb.stUmur');
        $this->db->order_by('sentimen_tb.stUmur', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function pekerjaanPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(sentimen_tb.stPekerjaan) AS nama");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->where('sentimen_tb.stPekerjaan !=', '');
        $this->db->group_by('sentimen_tb.stPekerjaan');
        $this->db->order_by('sentimen_tb.stPekerjaan', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function kawasanPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(sentimen_tb.stKawasan) AS nama");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->group_by('sentimen_tb.stKawasan');
        $this->db->order_by('sentimen_tb.stKawasan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function dunPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(dun_tb.dun_nama) AS dunNama");
        $this->db->select("dun_tb.dun_bil AS dunBil");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->group_by('sentimen_tb.stDunBil');
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function parlimenPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS parlimenNama");
        $this->db->select("parlimen_tb.pt_bil AS parlimenBil");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->group_by('sentimen_tb.stParlimenBil');
        $this->db->order_by('parlimenNama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function daerahPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(daerah.nama) AS daerahNama");
        $this->db->select("daerah.bil AS daerahBil");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->group_by('sentimen_tb.stDaerahBil');
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function negeriPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(negeri_tb.nt_nama) AS negeriNama");
        $this->db->select("negeri_tb.nt_bil AS negeriBil");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->group_by('negeri_tb.nt_nama');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function pelaporPeranan($senaraiPeranan)
    {
        $this->checkTableExists();
        $this->db->select("UPPER(pengguna_tb.nama_penuh) AS pelaporNama");
        $this->db->select("pengguna_tb.bil AS pelaporBil");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiPeranan as $peranan){
            $this->db->or_where('pengguna_tb.pengguna_peranan_bil', $peranan->perananBil);
        }
        $this->db->group_end();
        $this->db->group_by('sentimen_tb.stPelaporBil');
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiIkutIndividu($penggunaBil, $tahun){
        $this->checkTableExists();
        $this->db->select("sentimen_tb.stBil AS lksBil");
        $this->db->select("sentimen_tb.stPenggunaWaktu AS lksTimestamp");
        $this->db->select("pengguna_tb.emel AS penggunaEmel");
        $this->db->select("sentimen_tb.stTarikhLaporan AS lksTarikhLaporan");
        $this->db->select("UPPER(pengguna_tb.nama_penuh) AS penggunaNama");
        $this->db->select("pengguna_tb.no_tel AS penggunaNoTel");
        $this->db->select("UPPER(negeri_tb.nt_nama) AS negeriNama");
        $this->db->select("UPPER(daerah.nama) AS daerahNama");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS parlimenNama");
        $this->db->select("UPPER(dun_tb.dun_nama) AS dunNama");
        $this->db->select("UPPER(sentimen_tb.stKawasan) AS lksKawasan");
        $this->db->select("UPPER(sentimen_tb.stPekerjaan) AS lksPekerjaan");
        $this->db->select("sentimen_tb.stUmur AS lksUmur");
        $this->db->select("UPPER(sentimen_tb.stKaum) AS lksKaum");
        $this->db->select("UPPER(sentimen_tb.stJantina) AS lksJantina");
        $this->db->select("UPPER(sentimen_tb.stSentimen) AS lksSentimen");
        $this->db->select("UPPER(sentimen_tb.stPerkara) AS lksPerkara");
        $this->db->select("sentimen_tb.stAlasan AS lksUlasan");
        $this->db->select("UPPER(sentimen_tb.stTapisan) AS lksTapisan");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left');
        $this->db->where('sentimen_tb.stPelaporBil', $penggunaBil);
        $this->db->where('YEAR(sentimen_tb.stTarikhLaporan)', $tahun);
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiLaporanMengikutPelapor($perananBil, $tahun){
        $this->db->select('UPPER(pengguna_tb.nama_penuh) AS pelaporNama');
        $this->db->select('COUNT(sentimen_tb.stPelaporBil) AS bilanganLaporan');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->where('pengguna_tb.pengguna_peranan_bil', $perananBil);
        $this->db->where('YEAR(sentimen_tb.stTarikhLaporan)', $tahun);
        $this->db->group_by('sentimen_tb.stPelaporBil');
        $this->db->order_by('bilanganLaporan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function muatTurunTarikh($tarikhMula, $tarikhTamat){
        $this->db->select("sentimen_tb.stBil AS `NOMBOR SIRI`");
        $this->db->select("sentimen_tb.stPenggunaWaktu AS `LAPORAN DIBINA`");
        $this->db->select("pengguna_tb.emel AS `E-MEL PELAPOR`");
        $this->db->select("sentimen_tb.stTarikhLaporan AS `TARIKH LAPORAN`");
        $this->db->select("UPPER(pengguna_tb.nama_penuh) AS `NAMA PELAPOR`");
        $this->db->select("pengguna_tb.no_tel AS `NOMBOR TELEFON PELAPOR`");
        $this->db->select("UPPER(negeri_tb.nt_nama) AS `NEGERI`");
        $this->db->select("UPPER(daerah.nama) AS `DAERAH`");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS `PARLIMEN`");
        $this->db->select("UPPER(dun_tb.dun_nama) AS `DUN`");
        $this->db->select("UPPER(sentimen_tb.stKawasan) AS `KAWASAN RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stPekerjaan) AS `PEKERJAAN RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stUmur) AS `KATEGORI UMUR RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stKaum) AS `KAUM RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stJantina) AS `JANTINA RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stSentimen) AS `SENTIMEN`");
        $this->db->select("UPPER(sentimen_tb.stPerkara) AS `PERKARA`");
        $this->db->select("sentimen_tb.stAlasan AS `ULASAN SENTIMEN`");

        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left');
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('DATE(sentimen_tb.stPenggunaWaktu) >=', $tarikhMula);
        $this->db->where('DATE(sentimen_tb.stPenggunaWaktu) <=', $tarikhTamat);

        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query;
    }

    public function muatTurunSemua(){
        $this->db->select("sentimen_tb.stBil AS `NOMBOR SIRI`");
        $this->db->select("sentimen_tb.stPenggunaWaktu AS `LAPORAN DIBINA`");
        $this->db->select("pengguna_tb.emel AS `E-MEL PELAPOR`");
        $this->db->select("sentimen_tb.stTarikhLaporan AS `TARIKH LAPORAN`");
        $this->db->select("UPPER(pengguna_tb.nama_penuh) AS `NAMA PELAPOR`");
        $this->db->select("pengguna_tb.no_tel AS `NOMBOR TELEFON PELAPOR`");
        $this->db->select("UPPER(negeri_tb.nt_nama) AS `NEGERI`");
        $this->db->select("UPPER(daerah.nama) AS `DAERAH`");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS `PARLIMEN`");
        $this->db->select("UPPER(dun_tb.dun_nama) AS `DUN`");
        $this->db->select("UPPER(sentimen_tb.stKawasan) AS `KAWASAN RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stPekerjaan) AS `PEKERJAAN RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stUmur) AS `KATEGORI UMUR RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stKaum) AS `KAUM RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stJantina) AS `JANTINA RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stSentimen) AS `SENTIMEN`");
        $this->db->select("UPPER(sentimen_tb.stPerkara) AS `PERKARA`");
        $this->db->select("sentimen_tb.stAlasan AS `ULASAN SENTIMEN`");

        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left');
        $this->db->where('stTapisan', 'Terima');

        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query;
    }

    public function muatTurun($senaraiNegeri){
        $this->db->select("sentimen_tb.stBil AS `NOMBOR SIRI`");
        $this->db->select("sentimen_tb.stPenggunaWaktu AS `LAPORAN DIBINA`");
        $this->db->select("pengguna_tb.emel AS `E-MEL PELAPOR`");
        $this->db->select("sentimen_tb.stTarikhLaporan AS `TARIKH LAPORAN`");
        $this->db->select("UPPER(pengguna_tb.nama_penuh) AS `NAMA PELAPOR`");
        $this->db->select("pengguna_tb.no_tel AS `NOMBOR TELEFON PELAPOR`");
        $this->db->select("UPPER(negeri_tb.nt_nama) AS `NEGERI`");
        $this->db->select("UPPER(daerah.nama) AS `DAERAH`");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS `PARLIMEN`");
        $this->db->select("UPPER(dun_tb.dun_nama) AS `DUN`");
        $this->db->select("UPPER(sentimen_tb.stKawasan) AS `KAWASAN RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stPekerjaan) AS `PEKERJAAN RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stUmur) AS `KATEGORI UMUR RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stKaum) AS `KAUM RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stJantina) AS `JANTINA RESPONDEN`");
        $this->db->select("UPPER(sentimen_tb.stSentimen) AS `SENTIMEN`");
        $this->db->select("UPPER(sentimen_tb.stPerkara) AS `PERKARA`");
        $this->db->select("sentimen_tb.stAlasan AS `ULASAN SENTIMEN`");

        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left');
        $this->db->where('stTapisan', 'Terima');

        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();

        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query;
    }

    public function senaraiNegeri($senaraiNegeri)
    {
        //INTIALIZATION
        $this->checkTableExists();
        
        $this->db->select("sentimen_tb.stBil AS lksBil");
        $this->db->select("sentimen_tb.stPenggunaWaktu AS lksTimestamp");
        $this->db->select("pengguna_tb.emel AS penggunaEmel");
        $this->db->select("sentimen_tb.stTarikhLaporan AS lksTarikhLaporan");
        $this->db->select("UPPER(pengguna_tb.nama_penuh) AS penggunaNama");
        $this->db->select("pengguna_tb.no_tel AS penggunaNoTel");
        $this->db->select("UPPER(negeri_tb.nt_nama) AS negeriNama");
        $this->db->select("UPPER(daerah.nama) AS daerahNama");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS parlimenNama");
        $this->db->select("UPPER(dun_tb.dun_nama) AS dunNama");
        $this->db->select("UPPER(sentimen_tb.stKawasan) AS lksKawasan");
        $this->db->select("UPPER(sentimen_tb.stPekerjaan) AS lksPekerjaan");
        $this->db->select("UPPER(sentimen_tb.stUmur) AS lksUmur");
        $this->db->select("UPPER(sentimen_tb.stKaum) AS lksKaum");
        $this->db->select("UPPER(sentimen_tb.stJantina) AS lksJantina");
        $this->db->select("UPPER(sentimen_tb.stSentimen) AS lksSentimen");
        $this->db->select("UPPER(sentimen_tb.stPerkara) AS lksPerkara");
        $this->db->select("sentimen_tb.stAlasan AS lksUlasan");
        $this->db->select("UPPER(sentimen_tb.stTapisan) AS lksTapisan");

        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left');
        $this->db->where('stTapisan', 'Terima');

        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();

        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanJantina($senaraiNegeri){
        $this->db->select('UPPER(sentimen_tb.stJantina) AS jantina');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Positif" AND stJantina = jantina) AS bilanganPositif');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Neutral" AND stJantina = jantina) AS bilanganNeutral');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Negatif" AND stJantina = jantina) AS bilanganNegatif');
        $this->db->select('COUNT(sentimen_tb.stJantina) as bilanganLaporan');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('sentimen_tb.stJantina !=', '');
        $this->db->group_by('jantina');
        $this->db->order_by('bilanganLaporan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanKaum($senaraiNegeri){
        $this->db->select('UPPER(sentimen_tb.stKaum) AS kaum');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where UPPER(stSentimen) = "POSITIF" AND stKaum = kaum) AS bilanganPositif');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where UPPER(stSentimen) = "NEUTRAL" AND stKaum = kaum) AS bilanganNeutral');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where UPPER(stSentimen) = "NEGATIF" AND stKaum = kaum) AS bilanganNegatif');
        $this->db->select('COUNT(sentimen_tb.stKaum) as bilanganLaporan');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('sentimen_tb.stKaum !=', '');
        $this->db->group_by('kaum');
        $this->db->order_by('bilanganLaporan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanUmur($senaraiNegeri){
        $this->db->select('UPPER(sentimen_tb.stUmur) AS umur');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Positif" AND stUmur = umur) AS bilanganPositif');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Neutral" AND stUmur = umur) AS bilanganNeutral');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Negatif" AND stUmur = umur) AS bilanganNegatif');
        $this->db->select('COUNT(sentimen_tb.stUmur) as bilanganLaporan');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('sentimen_tb.stUmur !=', '');
        $this->db->group_by('umur');
        $this->db->order_by('umur', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanPekerjaan($senaraiNegeri){
        $this->db->select('UPPER(sentimen_tb.stPekerjaan) AS pekerjaan');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Positif" AND stPekerjaan = pekerjaan) AS bilanganPositif');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Neutral" AND stPekerjaan = pekerjaan) AS bilanganNeutral');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Negatif" AND stPekerjaan = pekerjaan) AS bilanganNegatif');
        $this->db->select('COUNT(sentimen_tb.stPekerjaan) as bilanganLaporan');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('sentimen_tb.stPekerjaan !=', '');
        $this->db->group_by('pekerjaan');
        $this->db->order_by('bilanganLaporan', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanKawasan($senaraiNegeri){
        $this->db->select('UPPER(sentimen_tb.stKawasan) AS kawasan');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Positif" AND stKawasan = kawasan) AS bilanganPositif');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Neutral" AND stKawasan = kawasan) AS bilanganNeutral');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb where stSentimen = "Negatif" AND stKawasan = kawasan) AS bilanganNegatif');
        $this->db->select('COUNT(sentimen_tb.stKawasan) as bilanganLaporan');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('sentimen_tb.stKawasan !=', '');
        $this->db->group_by('kawasan');
        $this->db->order_by('bilanganLaporan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanDun($senaraiNegeri){
        $this->db->select('UPPER(dun_tb.dun_nama) AS dunNama');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb B where B.stSentimen = "Positif" AND B.stDunBil = dun_tb.dun_bil) AS bilanganPositif');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb C where C.stSentimen = "Neutral" AND C.stDunBil = dun_tb.dun_bil) AS bilanganNeutral');
        $this->db->select('(SELECT COUNT(*) FROM sentimen_tb D where D.stSentimen = "Negatif" AND D.stDunBil = dun_tb.dun_bil) AS bilanganNegatif');
        $this->db->select('COUNT(dun_tb.dun_nama) as bilanganLaporan');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left');
        $this->db->join('negeri_tb', 'UPPER(negeri_tb.nt_nama) = UPPER(dun_tb.dun_negeri)', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->group_start();
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'POSITIF');
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'NEUTRAL');
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'NEGATIF');
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('dun_tb.dun_nama !=', '');
        $this->db->group_by('dunNama');
        $this->db->order_by('dunNama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanParlimen($senaraiNegeri){
        $this->db->select('UPPER(parlimen_tb.pt_nama) AS parlimenNama');
        $this->db->select('(SELECT COUNT(A.stParlimenBil) FROM sentimen_tb A where A.stSentimen = "Positif" AND A.stParlimenBil = parlimen_tb.pt_bil) AS bilanganPositif');
        $this->db->select('(SELECT COUNT(B.stParlimenBil) FROM sentimen_tb B where B.stSentimen = "Neutral" AND B.stParlimenBil = parlimen_tb.pt_bil) AS bilanganNeutral');
        $this->db->select('(SELECT COUNT(C.stParlimenBil) FROM sentimen_tb C where C.stSentimen = "Negatif" AND C.stParlimenBil = parlimen_tb.pt_bil) AS bilanganNegatif');
        $this->db->select('COUNT(parlimen_tb.pt_nama) as bilanganLaporan');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left');
        $this->db->join('negeri_tb', 'UPPER(negeri_tb.nt_nama) = UPPER(parlimen_tb.pt_negeri)', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->group_start();
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'POSITIF');
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'NEUTRAL');
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'NEGATIF');
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('parlimen_tb.pt_nama !=', '');
        $this->db->group_by('parlimenNama');
        $this->db->order_by('parlimenNama', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanNegeri($senaraiNegeri){
        $this->db->select('UPPER(sentimen_tb.stSentimen) AS sentimen');
        $this->db->select('COUNT(sentimen_tb.stSentimen) as bilanganLaporan');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('sentimen_tb.stSentimen !=', '');
        $this->db->group_start();
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'POSITIF');
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'NEUTRAL');
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'NEGATIF');
        $this->db->group_end();
        $this->db->group_by('sentimen');
        $this->db->order_by('bilanganLaporan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanDaerah($senaraiNegeri){
        $this->db->select('UPPER(daerah.nama) AS daerahNama');
        $this->db->select('(SELECT COUNT(A.stDaerahBil) FROM sentimen_tb A where A.stSentimen = "Positif" AND A.stDaerahBil = daerah.bil) AS bilanganPositif');
        $this->db->select('(SELECT COUNT(B.stDaerahBil) FROM sentimen_tb B where B.stSentimen = "Neutral" AND B.stDaerahBil = daerah.bil) AS bilanganNeutral');
        $this->db->select('(SELECT COUNT(C.stDaerahBil) FROM sentimen_tb C where C.stSentimen = "Negatif" AND C.stDaerahBil = daerah.bil) AS bilanganNegatif');
        $this->db->select('COUNT(*) as bilanganLaporan');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->group_start();
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'POSITIF');
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'NEUTRAL');
            $this->db->or_where('UPPER(sentimen_tb.stSentimen)', 'NEGATIF');
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('daerah.nama !=', '');
        $this->db->group_by('daerahNama');
        $this->db->order_by('bilanganLaporan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanOrganisasi($senaraiNegeri){
        $this->db->select('UPPER(pengguna_tb.pengguna_tempat_tugas) AS pelaporPenempatan');
        $this->db->select('COUNT(pengguna_tb.pengguna_tempat_tugas) as bilanganLaporan');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('pengguna_tb.pengguna_tempat_tugas !=', '');
        $this->db->group_by('pelaporPenempatan');
        $this->db->order_by('bilanganLaporan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanPelapor($senaraiNegeri){
        $this->db->select('UPPER(pengguna_tb.nama_penuh) AS pelaporNama');
        $this->db->select('COUNT(pengguna_tb.nama_penuh) as bilanganLaporan');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('pengguna_tb.nama_penuh !=', '');
        $this->db->group_by('pelaporNama');
        $this->db->order_by('bilanganLaporan', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function rumusanMingguan($senaraiNegeri){
        $this->db->select('YEARWEEK(sentimen_tb.stTarikhLaporan,1) AS minggu');
        $this->db->select('COUNT(YEARWEEK(sentimen_tb.stTarikhLaporan,1)) as bilanganLaporan');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->group_start();
        foreach($senaraiNegeri as $negeri){
            $this->db->or_where('negeri_tb.nt_bil', $negeri->nt_bil);
        }
        $this->db->group_end();
        $this->db->where('stTapisan', 'Terima');
        $this->db->group_by('minggu');
        $this->db->order_by('minggu', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function bilanganLaporanTahunKeseluruhan($perananBil, $tahun){
        $this->db->select('COUNT(*) AS bilanganLaporan');
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->where('pengguna_tb.pengguna_peranan_bil', $perananBil);
        $this->db->where('YEAR(stTarikhLaporan)', $tahun);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function bilanganLaporanTahun($penggunaBil, $tahun){
        $this->db->select('COUNT(*) AS bilanganLaporan');
        $this->db->where('stPelaporBil', $penggunaBil);
        $this->db->where('YEAR(stTarikhLaporan)', $tahun);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function senaraiCarian()
    {
        //INTIALIZATION
        $this->checkTableExists();

        //FILTERING
        $tarikhMula = $this->input->post('inputTarikhMula');
        $tarikhTamat = $this->input->post('inputTarikhTamat');
        $kawasan = $this->input->post('inputKawasan');
        $pekerjaan = $this->input->post('inputPekerjaan');
        $julatUmur = $this->input->post('inputJulatUmur');
        $kaum = $this->input->post('inputKaum');
        $sentimen = $this->input->post('inputSentimen');
        $negeri = $this->input->post('inputNegeri');

        
        $this->db->select("sentimen_tb.stBil AS lksBil");
        $this->db->select("sentimen_tb.stPenggunaWaktu AS lksTimestamp");
        $this->db->select("pengguna_tb.emel AS penggunaEmel");
        $this->db->select("sentimen_tb.stTarikhLaporan AS lksTarikhLaporan");
        $this->db->select("UPPER(pengguna_tb.nama_penuh) AS penggunaNama");
        $this->db->select("pengguna_tb.no_tel AS penggunaNoTel");
        $this->db->select("UPPER(negeri_tb.nt_nama) AS negeriNama");
        $this->db->select("UPPER(daerah.nama) AS daerahNama");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS parlimenNama");
        $this->db->select("UPPER(dun_tb.dun_nama) AS dunNama");
        $this->db->select("UPPER(sentimen_tb.stKawasan) AS lksKawasan");
        $this->db->select("UPPER(sentimen_tb.stPekerjaan) AS lksPekerjaan");
        $this->db->select("sentimen_tb.stUmur AS lksUmur");
        $this->db->select("UPPER(sentimen_tb.stKaum) AS lksKaum");
        $this->db->select("UPPER(sentimen_tb.stJantina) AS lksJantina");
        $this->db->select("UPPER(sentimen_tb.stSentimen) AS lksSentimen");
        $this->db->select("UPPER(sentimen_tb.stPerkara) AS lksPerkara");
        $this->db->select("sentimen_tb.stAlasan AS lksUlasan");
        $this->db->select("UPPER(sentimen_tb.stTapisan) AS lksTapisan");

        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left');
        $this->db->where('stTapisan', 'Terima');
        
        //WHERE FILTERING
        //1. FILTERING WAJIB
        $this->db->where('DATE(stPenggunaWaktu) >=', $tarikhMula);
        $this->db->where('DATE(stPenggunaWaktu) <=', $tarikhTamat);
        //2. FILTERING KALAU ADA
        if($kawasan != 'Semua'){
            $this->db->where('stKawasan', $kawasan);
        }
        if($pekerjaan != 'Semua'){
            $this->db->where('stPekerjaan', $pekerjaan);
        }
        if($julatUmur != 'Semua'){
            $this->db->where('stUmur', $julatUmur);
        }
        if($kaum != 'Semua'){
            $this->db->where('stKaum', $kaum);
        }
        if($sentimen != 'Semua'){
            $this->db->where('stSentimen', $sentimen);
        }
        if($negeri != 'Semua'){
            $this->db->where('negeri_tb.nt_bil', $negeri);
        }

        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiSentimen(){
        $this->db->select('stSentimen');
        $this->db->group_by('stSentimen');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiKaum(){
        $this->db->select('stKaum');
        $this->db->group_by('stKaum');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiJulatUmur(){
        $this->db->select('stUmur');
        $this->db->group_by('stUmur');
        $query = $this->db->get($this->table);
        return $query->result();
    }


    public function senaraiPekerjaan(){
        $this->db->select('stPekerjaan');
        $this->db->group_by('stPekerjaan');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiKawasan(){
        $this->db->select('stKawasan');
        $this->db->group_by('stKawasan');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function senaraiIkutNegeri($namaNegeri)
    {
        $this->checkTableExists();
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->where('negeri_tb.nt_nama', $namaNegeri);
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function satuTarikh($tarikh)
    {
        $this->checkTableExists();
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil');
        $this->db->where('stTapisan', 'Terima');
        $this->db->where('DATE(stPenggunaWaktu)', $tarikh);
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function semuaTanpaTapisan()
    {
        $this->checkTableExists();
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil');
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function draf($sentimenBil){
        $this->checkTableExists();
        $data = array(
            'stTapisan' => 'Draf'
        );
        $this->db->where('stBil', $sentimenBil);
        $this->db->update($this->table, $data);
    }

    public function terima($sentimenBil){
        $this->checkTableExists();
        $data = array(
            'stTapisan' => 'Terima'
        );
        $this->db->where('stBil', $sentimenBil);
        $this->db->update($this->table, $data);
    }

    public function tapisan()
    {
        $this->checkTableExists();
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil');
        $this->db->where('stTapisan', 'Hantar');
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function semua()
    {
        $this->checkTableExists();
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil');
        $this->db->where('stTapisan', 'Terima');
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function kemaskini(){
        $this->checkTableExists();
        $data = array(
            'stTarikhLaporan' => date_format(date_create($this->input->post('inputTarikhLaporan')), 'Y-m-d'),
            'stPelaporBil' => $this->input->post('inputPelaporBil'),
            'stDaerahBil' => $this->input->post('inputDaerahBil'),
            'stParlimenBil' => $this->input->post('inputParlimenBil'),
            'stDunBil' => $this->input->post('inputDunBil'),
            'stKawasan' => $this->input->post('inputKawasan'),
            'stSentimen' => $this->input->post('inputSentimen'),
            'stAlasan' => $this->input->post('inputAlasan'),
            'stPekerjaan' => $this->input->post('inputPekerjaan'),
            'stUmur' => $this->input->post('inputUmur'),
            'stKaum' => $this->input->post('inputKaum'),
            'stJantina' => $this->input->post('inputJantina'),
            'stPenggunaBil' => $this->input->post('inputPenggunaBil'),
            'stPenggunaWaktu' => date_format(date_create($this->input->post('inputPenggunaWaktu')), 'Y-m-d H:i:s'),
            'stTapisan' => 'Terima'
        );
        $this->db->where('stBil', $this->input->post('inputBil'));
        $this->db->update($this->table, $data);
    }

    public function sentimen($sentimenBil)
    {
        $this->checkTableExists();
        $this->db->where('stBil', $sentimenBil);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function senaraiIkutPeranan($perananBil)
    {
        $this->checkTableExists();
        $this->db->select("sentimen_tb.stBil AS lksBil");
        $this->db->select("sentimen_tb.stPenggunaWaktu AS lksTimestamp");
        $this->db->select("pengguna_tb.emel AS penggunaEmel");
        $this->db->select("sentimen_tb.stTarikhLaporan AS lksTarikhLaporan");
        $this->db->select("UPPER(pengguna_tb.nama_penuh) AS penggunaNama");
        $this->db->select("pengguna_tb.no_tel AS penggunaNoTel");
        $this->db->select("UPPER(negeri_tb.nt_nama) AS negeriNama");
        $this->db->select("UPPER(daerah.nama) AS daerahNama");
        $this->db->select("UPPER(parlimen_tb.pt_nama) AS parlimenNama");
        $this->db->select("UPPER(dun_tb.dun_nama) AS dunNama");
        $this->db->select("UPPER(sentimen_tb.stKawasan) AS lksKawasan");
        $this->db->select("UPPER(sentimen_tb.stPekerjaan) AS lksPekerjaan");
        $this->db->select("sentimen_tb.stUmur AS lksUmur");
        $this->db->select("UPPER(sentimen_tb.stKaum) AS lksKaum");
        $this->db->select("UPPER(sentimen_tb.stJantina) AS lksJantina");
        $this->db->select("UPPER(sentimen_tb.stSentimen) AS lksSentimen");
        $this->db->select("UPPER(sentimen_tb.stPerkara) AS lksPerkara");
        $this->db->select("sentimen_tb.stAlasan AS lksUlasan");
        $this->db->select("UPPER(sentimen_tb.stTapisan) AS lksTapisan");
        $this->db->join('pengguna_tb', 'pengguna_tb.bil = sentimen_tb.stPelaporBil', 'left');
        $this->db->join('daerah', 'daerah.bil = sentimen_tb.stDaerahBil', 'left');
        $this->db->join('negeri_tb', 'negeri_tb.nt_bil = daerah.negeri_bil', 'left');
        $this->db->join('parlimen_tb', 'parlimen_tb.pt_bil = sentimen_tb.stParlimenBil', 'left');
        $this->db->join('dun_tb', 'dun_tb.dun_bil = sentimen_tb.stDunBil', 'left');
        $this->db->where('pengguna_tb.pengguna_peranan_bil', $perananBil);
        $this->db->order_by($this->table.'.stPenggunaWaktu', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function tambah(){
        $this->checkTableExists();
        $tempPekerjaan = "";
        $pekerjaan = "";
        $tempKaum = "";
        $kaum = "";
        $tempPekerjaan = $this->input->post('inputPekerjaan');
        if($tempPekerjaan == "Lain-lain"){
            $pekerjaan = $this->input->post('inputPekerjaanLain');
        }else{
            $pekerjaan = $this->input->post('inputPekerjaan');
        }
        $tempKaum = $this->input->post('inputKaum');
        if($tempKaum == 'Lain-lain'){
            $kaum = $this->input->post('inputKaumLain');
        }else{
            $kaum = $this->input->post('inputKaum');
        }
        $data = array(
            'stTarikhLaporan' => date_format(date_create($this->input->post('inputTarikhLaporan')), 'Y-m-d'),
            'stPelaporBil' => $this->input->post('inputPelaporBil'),
            'stDaerahBil' => $this->input->post('inputDaerahBil'),
            'stParlimenBil' => $this->input->post('inputParlimenBil'),
            'stDunBil' => $this->input->post('inputDunBil'),
            'stKawasan' => $this->input->post('inputKawasan'),
            'stSentimen' => $this->input->post('inputSentimen'),
            'stAlasan' => $this->input->post('inputAlasan'),
            'stPerkara' => $this->input->post('inputJenisPersepsi'),
            'stPekerjaan' => $pekerjaan,
            'stUmur' => $this->input->post('inputUmur'),
            'stKaum' => $kaum,
            'stJantina' => $this->input->post('inputJantina'),
            'stPenggunaBil' => $this->input->post('inputPenggunaBil'),
            'stPenggunaWaktu' => date_format(date_create($this->input->post('inputPenggunaWaktu')), 'Y-m-d H:i:s'),
            'stTapisan' => 'Terima'
        );
        $this->db->insert($this->table, $data);
    }

    private function checkTableExists()
    {   
        $this->load->dbforge();

        //TIADA TABLE
        if($this->db->table_exists($this->table) == FALSE){
            $fields = array(
                'stBil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null'=> FALSE,
                        'auto_increment' => TRUE,
                        'primary_key' => TRUE
                ),
                'stTarikhLaporan' => array(
                        'type' => 'DATE',
                        'null' => TRUE
                ),
                'stPelaporBil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'stDaerahBil' => array(
                        'type' => 'BIGINT',
                        'constraint' => '20',
                        'null' => TRUE
                ),
                'stParlimenBil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'stDunBil' => array(
                    'type' => 'BIGINT',
                    'constraint' => '20',
                    'null' => TRUE
                ),
                'stKawasan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'stSentimen' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'stAlasan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'stPenggunaBil' => array(
                    'type' => 'BIGINT',
                    'constraint' => 20,
                    'null' => TRUE
                ),
                'stPenggunaWaktu' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
                ),
                'stTapisan' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                    'null' => TRUE
                ),
                'stPekerjaan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'stUmur' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'stKaum' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                ),
                'stJantina' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                    'null' => TRUE
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('stBil', TRUE);
            $this->dbforge->create_table($this->table, TRUE);
        }

        //ADA TABLE
        if($this->db->table_exists($this->table) == TRUE){
            if ($this->db->field_exists('stPerkara', $this->table) == FALSE)
            {   
                $field5 = array(
                    'stPerkara' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($this->table, $field5);
            }
            if ($this->db->field_exists('stPekerjaan', $this->table) == FALSE)
            {   
                $field4 = array(
                    'stPekerjaan' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($this->table, $field4);
            }
            if ($this->db->field_exists('stUmur', $this->table) == FALSE)
            {   
                $field3 = array(
                    'stUmur' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($this->table, $field3);
            }
            if ($this->db->field_exists('stKaum', $this->table) == FALSE)
            {   
                $field2 = array(
                    'stKaum' => array(
                        'type' => 'TEXT',
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($this->table, $field2);
            }
            if ($this->db->field_exists('stJantina', $this->table) == FALSE)
            {   
                $field1 = array(
                    'stJantina' => array(
                        'type' => 'VARCHAR',
                        'constraint' => 50,
                        'null' => TRUE
                    )
                );
                $this->dbforge->add_column($this->table, $field1);
            }
        }
    }

}
?>