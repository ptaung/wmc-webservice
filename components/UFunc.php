<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

class UFunc {

    /**
     *  self::$_m  //ตัวอย่างการเรียกใช้งาน
     *
     * @var array
     */
    public $_thaimtS = array('01' => 'ม.ค.', '02' => 'ก.พ.', '03' => 'มี.ค.', '04' => 'เม.ย.', '05' => 'พ.ค.', "06" => 'มิ.ย.', '07' => 'ก.ค.', '08' => 'ส.ค.', '09' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.');

    /**
     *
     * @var array
     */
    public $_thaimtL = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');

//วันที่
    public static function getThaiDate($scode, $rtype = 'S', $showtime = '') {
        $thaimtS = array('00' => '', '01' => 'ม.ค.', '02' => 'ก.พ.', '03' => 'มี.ค.', '04' => 'เม.ย.', '05' => 'พ.ค.', "06" => 'มิ.ย.', '07' => 'ก.ค.', '08' => 'ส.ค.', '09' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.');
        $thaimtL = array('00' => '', '01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');

        if (empty($scode)) {
            return '';
        }
        $day = (integer) substr($scode, 8, 2);
        $mt = substr($scode, 5, 2);
        $time = substr($scode, 10, 12);
        $year = (integer) substr($scode, 0, 4) + 543;
        if (strtoupper($rtype) == 'L') {
            $tmt = $thaimtL;
            return $day . ' ' . $tmt[$mt] . ' ' . $year . ' : ' . ($showtime <> '' ? $time : '');
        } else {
            $tmt = $thaimtS;
            return $day . ' ' . $tmt[$mt] . ' ' . substr($year, 2, 4) . ' ' . ($showtime <> '' ? $time : '');
        }
    }

    public static function getLabelSize($size) {
        $mb = 1024 * 1024;
        if ($size > $mb) {
            $mysize = sprintf('%01.2f', $size / $mb) . ' MB';
        } elseif ($size >= 1024) {
            $mysize = sprintf('%01.2f', $size / 1024) . ' Kb';
        } else {
            $mysize = $size . ' bytes';
        }
        return $mysize;
    }

    public static function calPersent($setA, $setB, $decimal = 0) {
        return @number_format(($setA * 100) / $setB, $decimal);
    }

}
