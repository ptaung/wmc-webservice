<?php

/*
 * พัฒนาโดย ศิลา กลั่นแกล้ว สสจ.สุพรรณบุรี
 *
 */

namespace app\components;

class Cprocess {

    public static function getTarget($source_table) {

        if (strlen($source_table) > 5) {
            try {
                $query = "SELECT ROUND((sum(result)/sum(target))*100,2) as p FROM {$source_table} WHERE b_year = (SELECT
                yearprocess + 543
            FROM
                sys_config) ;";
                $data = \Yii::$app->db->createCommand($query)->queryScalar();
            } catch (\Exception $exc) {
                $data = 0;
            }
        } else {
            $data = 0;
        }

        return $data;
    }

    public static function getGeocoder($areacode) {
        $coordinates = [];
        $polygon = [];
        try {
            echo $query = "SELECT
                            CONCAT('อ.', ampurname, ' จ.', changwatname) AS areaname,
                            areacode,
                            areatype,
                            geojson
                        FROM
                            campur
                                INNER JOIN
                            cchangwat ON cchangwat.changwatcode = campur.changwatcode
                                INNER JOIN
                            geojson ON areacode = ampurcodefull
                                AND areatype = '3'
                                AND LENGTH(geojson) > 0
                                AND areacode = '{$areacode}'";
            $data = \Yii::$app->db->createCommand($query)->cache(3600)->queryAll();
            foreach ($data as $key => $rows) {
                $coordinates['areaname'][] = $rows['areaname'];
                $geo = \GuzzleHttp\json_decode($rows['geojson'], true);
                array_push($polygon, $geo['coordinates'][0][0]);
            }
        } catch (\Exception $exc) {
            $data = [];
        }

        $coordinates['polygon'] = $polygon;

        return $coordinates;
    }

}
