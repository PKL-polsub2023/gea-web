<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Laporan_model extends CI_Model
{

    function get_data($table)
    {
        return $this->db->get($table);
    }

    function get_MasterCoa()
    {
        # code...
        $query = $this->db->query(
        "SELECT *,CASE 
            WHEN nama IN ( 'Kas', 'Persediaan Barang Dagang', 'Piutang Dagang', 'Perlengkapan', 'Peralatan', 'Kendaraan', 'Gedung', 'Tanah' ) THEN 'Aktiva' 
            WHEN nama = 'Modal' THEN 'Modal' WHEN nama IN ('Utang', 'Sewa Dibayar Dimuka', 'Asuransi Dibayar Dimuka') THEN 'Pasiva' 
            WHEN nama = 'Pendapatan Usaha' THEN 'Pendapatan' 
            WHEN nama IN ('Beban Gaji', 'Beban Sewa Gedung', 'Beban Perlengkapan', 'Beban Iklan', 'Beban Penyusutan Peralatan', 'Beban Lain Lain') THEN 'Biaya' 
            ELSE 'Lainnya' 
        END as status  FROM `dt_mastercoa`");
        return $query->result_array();
    }

    function getSaldoAwal_ByKode($periode)
    {
        # code baru
        $query = $this->db->query(
            "SELECT *, 
            CASE 
                WHEN nama IN ( 'Kas', 'Persediaan Barang Dagang', 'Piutang Dagang', 'Perlengkapan', 'Peralatan', 'Kendaraan', 'Gedung', 'Tanah' ) THEN 'Aktiva' 
                WHEN nama = 'Modal' THEN 'Modal' WHEN nama IN ('Utang', 'Sewa Dibayar Dimuka', 'Asuransi Dibayar Dimuka') THEN 'Pasiva' 
                WHEN nama = 'Pendapatan Usaha' THEN 'Pendapatan' 
                WHEN nama IN ('Beban Gaji', 'Beban Sewa Gedung', 'Beban Perlengkapan', 'Beban Iklan', 'Beban Penyusutan Peralatan', 'Beban Lain Lain') THEN 'Biaya' 
                ELSE 'Lainnya' 
            END as status 
            FROM dt_saldo_awal a 
            JOIN dt_mastercoa b ON a.mastercoa_id = b.mastercoa_id 
            WHERE a.periode = " . $periode
        );
        return $query->result_array();
    }

    function getdataBukuBesar($fromDate, $toDate, $kode)
    {
        /**
         * SELECT c.no_jurnal, b.tanggal, b.keterangan, a.kode, a.nama, CASE WHEN nama IN ('Kas', 'Persediaan Barang Dagang', 'Piutang Dagang', 'Perlengkapan', 'Peralatan', 'Kendaraan', 'Gedung', 'Tanah') THEN 'Aktiva' WHEN nama = 'Modal' THEN 'Modal' WHEN nama IN ('Utang', 'Sewa Dibayar Dimuka', 'Asuransi Dibayar Dimuka') THEN 'Pasiva' WHEN nama = 'Pendapatan Usaha' THEN 'Pendapatan' WHEN nama IN ('Beban Gaji', 'Beban Sewa Gedung', 'Beban Perlengkapan', 'Beban Iklan', 'Beban Penyusutan Peralatan', 'Beban Lain Lain') THEN 'Biaya' ELSE 'Lainnya' END as status, c.debit, c.kredit FROM dt_mastercoa a JOIN dt_jurnal_masuk_detail c ON a.mastercoa_id = c.mastercoa_id JOIN dt_jurnal_masuk b ON b.no_jurnal = c.no_jurnal WHERE b.tanggal BETWEEN '2022-01-01' AND '2023-12-12' AND b.tipe_jurnal IN (1,2) AND a.kode IN (101,102,103,104,105,106,107,121,122,123,124,125,126,127,201,301,401,501,502,503,504,505,506,507) ORDER BY a.kode,tanggal ASC;
         */
        $query = $this->db->query("SELECT c.no_jurnal, b.tanggal, b.keterangan, a.kode, a.nama, c.debit, c.kredit, kategori,
        CASE
            WHEN nama IN ('Kas', 'Persediaan Barang Dagang', 'Piutang Dagang', 'Perlengkapan', 'Peralatan', 'Kendaraan', 'Gedung', 'Tanah') THEN 'Aktiva'
            WHEN nama = 'Modal' THEN 'Modal'
            WHEN nama IN ('Utang', 'Sewa Dibayar Dimuka', 'Asuransi Dibayar Dimuka') THEN 'Pasiva'
            WHEN nama = 'Pendapatan Usaha' THEN 'Pendapatan'
            WHEN nama IN ('Beban Gaji', 'Beban Sewa Gedung', 'Beban Perlengkapan', 'Beban Iklan', 'Beban Penyusutan Peralatan', 'Beban Lain Lain') THEN 'Biaya'
            ELSE 'Lainnya'
        END as status 
        FROM dt_mastercoa a 
        JOIN dt_jurnal_masuk_detail c ON a.mastercoa_id = c.mastercoa_id 
        JOIN dt_jurnal_masuk b ON b.no_jurnal = c.no_jurnal
        WHERE b.tanggal BETWEEN '$fromDate' AND '$toDate'
        AND b.tipe_jurnal IN (1,2) 
        AND a.kode IN ($kode)
        ORDER BY a.kode,tanggal ASC");
        return $query->result_array();
    }
}
