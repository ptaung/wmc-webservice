<?php

/*
 * พัฒนาโดย ศิลา กลั่นแกล้ว สสจ.สุพรรณบุรี
 *
 */

namespace app\components;

use Yii;

class Cprocess {

    public static function getTarget($source_table) {

        if (strlen($source_table) > 5) {
            try {
                $query = "SELECT ROUND((sum(result)/sum(target))*100,2) as p FROM {$source_table} WHERE b_year = (SELECT
                yearprocess + 543
            FROM
                sys_config) ;";
                $data = Yii::$app->db->createCommand($query)->queryScalar();
            } catch (\Exception $exc) {
                $data = 0;
            }
        } else {
            $data = 0;
        }

        return $data;
    }

    public static function getGeocoderByDmht($areacode) {
        try {
            $query = "select latitude as lat,longitude as lon,'' as hosname

from gisdmht_view g
left join chospital h on g.hcode = h.hoscode
where latitude > 0
and longitude > 0
#and concat(provcode,distcode) = '{$areacode}'
group by cid
";
            $data = Yii::$app->db_datacenter->createCommand($query)->cache(3600)->queryAll();
        } catch (\Exception $e) {
            $data = [];
        }

        return $data;
    }

    public static function getGeocoderByHoscode($areacode, $ampcode) {
        try {
            $query = "select * from
                            (select hoscode,hosname,lat,lon,
                            0 as point,
                            0 as kpi,
                            0 as target,
                             IF(hostype IN ('05','06','07'),'hos','pcu') AS hostype
                            from chospital h
                            LEFT JOIN geojson g ON g.hcode = h.hoscode
                            WHERE provcode = '{$areacode}'
                            and hostype in ('03','05','06','07','18')
                            " . (strlen($ampcode) == 4 ? "AND concat(provcode,distcode) = '{$ampcode}'" : "") . "
                            group by h.hoscode ) t1
";

            $data = Yii::$app->db->createCommand($query)->cache(3600)->queryAll();
        } catch (\Exception $e) {
            $data = [];
        }

        return $data;
    }

    public static function getGeocoder($areacode, $ampcode, $kpi) {
        $coordinates = [];
        $polygon['p'] = [];
        $polygon['info'] = [];

        try {
            $query = "SELECT
                            CONCAT('อ.', ampurname, ' จ.', changwatname) AS areaname,
                            areacode,
                            areatype,
                            geojson,
                            0 as point,
                            0 as kpi,
                            0 as target
                        FROM
                            campur
                                INNER JOIN
                            cchangwat ON cchangwat.changwatcode = campur.changwatcode
                                INNER JOIN
                            geojson ON areacode = ampurcodefull
                                AND areatype = '3'
                                AND LENGTH(geojson) > 0
                                AND cchangwat.changwatcode = '{$areacode}'
                                    " . (strlen($ampcode) == 4 ? "AND campur.ampurcodefull = '{$ampcode}'" : "") . "
                                ";

            $data = Yii::$app->db->createCommand($query)->cache(3600)->queryAll();

            foreach ($data as $key => $rows) {
                $geo = \GuzzleHttp\json_decode($rows['geojson'], true);
                foreach ($geo['coordinates'] as $geo_key => $geo_value) {
                    $polygon['areaname'][] = $rows['areaname'];
                    $polygon['areacode'][] = $rows['areacode'];
                    $polygon['point'][] = $rows['point'];
                    $polygon['kpi'][] = $rows['kpi'];
                    $polygon['target'][] = $rows['target'];
                    array_push($polygon['p'], $geo_value[0]);
                }
            }
        } catch (\Exception $exc) {
            echo $exc->getMessage();
            $data = [];
        }

        $coordinates['polygon'] = $polygon;
        return $coordinates;
    }

}
