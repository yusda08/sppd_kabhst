<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tgl_indo extends CI_Model {
    public static function indo($date) {
        $str = explode('-', $date);
        $bulan = array(
            '00' => '00',
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );
        return $str[2] . " " . $bulan[$str[1]] . " " . $str[0];
        
    }
    
    public static function hari($day) {
        $day = date('D', strtotime($day));
        $listday = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu'
        );
        return $listday[$day];
    }
    
    
    
}