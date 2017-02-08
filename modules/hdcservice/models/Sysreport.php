<?php

namespace app\modules\hdcservice\models;

use Yii;

//use frontend\models\Systransform;

/**
 * This is the model class for table "sys_report".
 *
 * @property integer $report_id
 * @property string $cat_id
 * @property string $id
 * @property string $report_name
 * @property string $source_file
 * @property string $source_table
 * @property string $t_sql
 * @property string $s_sql
 * @property string $weight
 * @property integer $active
 * @property string $version
 * @property string $aname
 * @property string $bname
 * @property string $query_hospcode
 * @property string $query_areacode
 * @property integer $cperiod
 * @property integer $carea_dopa
 * @property integer $carea_moph
 * @property string $target
 * @property string $rate
 * @property string $notice
 * @property integer $rightgreen
 * @property string $flag_healthcare
 * @property string $seletype
 * @property string $report_controller
 */
class Sysreport extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'sys_report';
    }

    public static function getDb() {
        return Yii::$app->get('db_hdc');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['cat_id', 'id', 'report_name', 'version'], 'required'],
            [['report_name', 't_sql', 's_sql', 'query_hospcode', 'query_areacode', 'notice'], 'string'],
            [['weight', 'target'], 'number'],
            [['active', 'cperiod', 'carea_dopa', 'carea_moph', 'rightgreen', 'pageview'], 'integer'],
            [['cat_id', 'id', 'rate'], 'string', 'max' => 32],
            [['source_file', 'aname', 'bname'], 'string', 'max' => 255],
            [['source_table', 'report_controller'], 'string', 'max' => 100],
            [['version'], 'string', 'max' => 14],
            [['flag_healthcare', 'kpi'], 'string', 'max' => 1],
            [['seletype'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'report_id' => 'Report ID',
            'cat_id' => 'Cat ID',
            'id' => 'ID',
            'report_name' => 'Report Name',
            'source_file' => 'Source File',
            'source_table' => 'Source Table',
            't_sql' => 'T Sql',
            's_sql' => 'S Sql',
            'weight' => 'Weight',
            'active' => 'Active',
            'version' => 'Version',
            'aname' => 'Aname',
            'bname' => 'Bname',
            'query_hospcode' => 'Query Hospcode',
            'query_areacode' => 'Query Areacode',
            'cperiod' => 'Cperiod',
            'carea_dopa' => 'Carea Dopa',
            'carea_moph' => 'Carea Moph',
            'target' => 'Target',
            'rate' => 'Rate',
            'notice' => 'Notice',
            'rightgreen' => 'Rightgreen',
            'flag_healthcare' => 'Flag Healthcare',
            'seletype' => 'Seletype',
            'report_controller' => 'Report Controller',
            'kpi' => 'Kpi Controller',
        ];
    }

    public static function getSourcetable($id) {
        $sourcetable = '';

        if ($id != '') {
            $data = Sysreport::find()
                    ->select('source_table')
                    ->where('id="' . $id . '"')
                    ->all();

            foreach ($data as $v) {
                $sourcetable = $v['source_table'];
            }
        } else {
            $sourcetable = '';
        }

        return $sourcetable;
    }

    public static function getReportName($id) {
        $reportname = '';

        if ($id != '') {
            $data = Sysreport::find()
                    ->select('report_name')
                    ->where('id="' . $id . '"')
                    ->all();

            foreach ($data as $v) {
                $reportname = $v['report_name'];
            }
        } else {
            $reportname = '';
        }

        return $reportname;
    }

    public static function getReportController($id) {
        $reportcontroller = '';

        if ($id != '') {
            $data = Sysreport::find()
                    ->select('report_controller')
                    ->where('id="' . $id . '"')
                    ->all();

            foreach ($data as $v) {
                $reportcontroller = $v['report_controller'];
            }
        } else {
            $reportcontroller = '';
        }

        return $reportcontroller;
    }

    /*
      public static function getCatController($id) {
      $catcontroller = '';

      if($id!=''){
      $data = Sysreport::find()
      ->select('report_controller')
      ->where('id="'.$id.'"')
      ->all();

      foreach($data as $v){
      $reportcontroller = $v['report_controller'];
      }
      }else{
      $reportcontroller = '';
      }

      return $reportcontroller;
      }
     *
     */

    public static function getCatid($id) {
        $cat_id = '';
        if ($id != '') {
            $data = Sysreport::find()
                    ->select('cat_id')
                    ->where('id="' . $id . '"')
                    ->all();

            foreach ($data as $v) {
                $cat_id = $v['cat_id'];
            }
        } else {
            $cat_id = '';
        }

        return $cat_id;
    }

    public static function getStable($id) {
        $s_sql = '';
        if ($id != '') {
            $data = Sysreport::find()
                    ->select('s_sql')
                    ->where('id="' . $id . '"')
                    ->all();

            foreach ($data as $v) {
                $s_sql = $v['s_sql'];
            }
        } else {
            $s_sql = '';
        }

        return $s_sql;
    }

    public static function getTtable($id) {
        $t_sql = '';
        if ($id != '') {
            $data = Sysreport::find()
                    ->select('t_sql')
                    ->where('id="' . $id . '"')
                    ->all();

            foreach ($data as $v) {
                $t_sql = $v['t_sql'];
            }
            /*
              $a = nl2br($t_sql);
              $i = 0;
              $exp[] = explode('|', $a);
              //$count = count($exp);
              $bb = $exp[0];
              $aa = count($exp[0]);
              $datax = '';
              if($aa>0){
              for($i==0;$i<$aa;$i++){
              //echo $bb[$i];
              $datax = Systransform::find()
              ->select('t_sql')
              ->where('t_name="'.$bb[$i].'"')
              ->andWhere('active=1')
              ->all();
              }
              }
             *
             */
        }

        return $t_sql;
    }

    /*
      public static function getTtableDetail($t_sql){
      $a = nl2br($t_sql);
      $i = 0;
      $exp[] = explode('|', $a);
      //$count = count($exp);
      $bb = $exp[0];
      $aa = count($exp[0]);
      $datax = '';
      if($aa>0){
      for($i==0;$i<$aa;$i++){
      //echo $bb[$i];
      $datax .= Systransform::find()
      ->select('t_sql')
      ->where('t_name="'.$bb[$i].'"')
      ->all();
      }
      }

      return $datax;
      }
     *
     */

    public static function getAname($id) {
        if ($id != '') {
            $data = Sysreport::find()
                    ->select('aname')
                    ->where('id="' . $id . '"')
                    ->all();

            foreach ($data as $v) {
                $aname = $v['aname'];
            }
        } else {
            $aname = '';
        }

        return $aname;
    }

    public static function getBname($id) {
        if ($id != '') {
            $data = Sysreport::find()
                    ->select('bname')
                    ->where('id="' . $id . '"')
                    ->all();

            foreach ($data as $v) {
                $bname = $v['bname'];
            }
        } else {
            $bname = '';
        }

        return $bname;
    }

    public static function getNotice($id) {
        if ($id != '') {
            $data = Sysreport::find()
                    ->select('notice')
                    ->where('id="' . $id . '"')
                    ->all();

            foreach ($data as $v) {
                $notice = $v['notice'];
            }
        } else {
            $notice = '';
        }

        return $notice;
    }

    public static function getTarget($id) {
        if ($id != '') {
            $data = Sysreport::find()
                    ->select('target')
                    ->where('id="' . $id . '"')
                    ->all();

            foreach ($data as $v) {
                $target = $v['target'];
            }
        } else {
            $target = '';
        }

        return $target;
    }

    public static function getRate($id) {
        if ($id != '') {
            $data = Sysreport::find()
                    ->select('rate')
                    ->where('id="' . $id . '"')
                    ->all();

            foreach ($data as $v) {
                $rate = $v['rate'];
            }
        } else {
            $rate = '';
        }

        return $rate;
    }

    public static function getMenuType($id) {
        $menu_type = '';
        if ($id != '') {
            $data = Sysreport::find()
                    ->select('menu_type')
                    ->where('id="' . $id . '"')
                    ->all();

            foreach ($data as $v) {
                $menu_type = $v['menu_type'];
            }
        } else {
            $menu_type = '';
        }

        return $menu_type;
    }

    public static function getPageView($id) {
        if ($id != '') {
            $data = Sysreport::find()
                    ->select('pageview')
                    ->where('id="' . $id . '"')
                    ->all();

            foreach ($data as $v) {
                $pageview = $v['pageview'];
            }
        } else {
            $pageview = '';
        }

        return $pageview;
    }

    public static function getRightgreen($id) {
        if ($id != '') {
            $data = Sysreport::find()
                    ->select('rightgreen')
                    ->where('id="' . $id . '"')
                    ->all();

            foreach ($data as $v) {
                $rightgreen = $v['rightgreen'];
            }
        } else {
            $rightgreen = '';
        }

        return $rightgreen;
    }

}
