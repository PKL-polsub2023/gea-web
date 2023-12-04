<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('rupiah')) {
    function rupiah($nilai) 
    {
        $nilai = floatval(str_replace(',', '.', $nilai));
        return "Rp. " . number_format($nilai, 2, ",", ".");
    }
}