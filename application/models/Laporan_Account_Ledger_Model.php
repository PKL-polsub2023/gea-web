<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Laporan_Account_Ledger_Model extends CI_Model
{

    function get_data($table)
    {
        return $this->db->get($table);
    }

    function get_MasterCoa()
    {
        # code...
        $query = $this->db->query(
        "SELECT a.id_kelompokakun,a.kode,a.nama,b.nama AS status FROM dt_mastercoa a LEFT JOIN dt_kelompokakun b ON a.id_kelompokakun = b.id_kelompokakun");
        return $query->result_array();
    }

    function getSaldoAwal_ByKode($periode)
    {
        $query = $this->db->query(
            "SELECT saldo_normal, saldo_akhir, debit, kredit, periode, kode,b.nama, b.id_kelompokakun, c.nama as status 
            FROM dt_saldo_awal a 
            LEFT JOIN dt_mastercoa b ON a.mastercoa_id = b.mastercoa_id 
            LEFT JOIN dt_kelompokakun c ON c.id_kelompokakun = b.id_kelompokakun 
            WHERE a.periode = " . $periode
        );
        return $query->result_array();
    }

    function getdataBukuBesar($fromDate, $toDate, $kode)
    {
        $query = $this->db->query("SELECT b.no_jurnal, b.tanggal, a.kode, a.nama, debit, tot_debit, kredit, tot_kredit, b.keterangan,d.id_kelompokakun,d.nama as status FROM dt_mastercoa a
        JOIN dt_jurnal_masuk_detail c ON a.mastercoa_id = c.mastercoa_id 
        JOIN dt_jurnal_masuk b ON b.no_jurnal = c.no_jurnal
        JOIN dt_kelompokakun d ON d.id_kelompokakun = a.id_kelompokakun 
        WHERE b.tanggal BETWEEN '$fromDate' AND '$toDate'
        AND b.tipe_jurnal IN (1,2) 
        AND a.kode IN ($kode)
        ORDER BY a.kode,tanggal ASC");
        return $query->result_array();
    }
}
