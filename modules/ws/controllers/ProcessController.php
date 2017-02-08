<?php

namespace app\modules\ws\controllers;

use yii\web\Controller;
use yii\helpers\FileHelper;
use yii;

/**
 * Default controller for the `ws` module
 */
class ProcessController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        echo date('Y-m-d');
    }

    public function actionRun() {
        $conn_status = \Yii::$app->db;
        $filepath = Yii::getAlias('@app') . "/web/log/u/";
        if (!is_dir($filepath))
            @mkdir($filepath);

        $file = FileHelper::findFiles($filepath, ['only' => ['*.txt'], 'except' => ['importprocess.txt'], 'recursive' => false]);
        if (count($file) == 0)
            exit;

        sort($file); #จัดเรียงลำดับไฟล์
        foreach ($file as $fileNameGroup) {
            list($a1_hospcode, $a1_table) = explode('-', basename($fileNameGroup));
            $sp_import_group[$a1_hospcode . '-' . $a1_table][] = $fileNameGroup; #จัดกลุ่มข้อมูล
        }
        #อ่านไฟล์
        #$processlist_run = @file($filepath . 'importprocess.txt');
        #อ่านจากฐานข้อมูล
        $processlist_run = $conn_status->createCommand("SELECT * FROM wmc_import;")->queryAll();

        #ระบบจะทำงานนำเข้าพร้อมกันเพียง 10 รายการเท่านั้น
        if (count($processlist_run) == 10)
            exit;
        $process_run = [];
        foreach ($processlist_run as $value) {
            $process_run[] = $value['groupdata'];
        }

        $prefix = 'dw_';
        $loop = 0;
        foreach ($sp_import_group as $tableGroup => $data) {

            if (in_array($tableGroup, $process_run))#ตรวจสอบการทำงานจากไฟล์ ถ้ามีแล้วจะข้ามไป
                continue;
            #---------------------------------------------------------------
            #ตรวจสอบการ Import
            $checkProcesslistRun = $conn_status->createCommand("SELECT * FROM wmc_import WHERE groupdata = '{$tableGroup}';")->queryAll();
            if (count($checkProcesslistRun) > 0)
                continue;
            #---------------------------------------------------------------
            #เพิ่มรายการ processlist
            $conn_status->createCommand()->insert('wmc_import', ['groupdata' => $tableGroup, 'starttime' => new \yii\db\Expression('NOW()'), 'countfiles' => count($data)])->execute();

            #---------------------------------------------------------------
            list($a2_hospcode, $a2_table) = explode('-', $tableGroup);
            $alterTableName = $prefix . $a2_hospcode . '.' . $a2_table;

            #---------------------------------------------------------------
            $initImport = yii::$app->db_datacenter;
            $initImportSQL = "/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
                                /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
                                /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
                                /*!40101 SET NAMES utf8 */;
                                /*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
                                /*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
                                /*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
                                /*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;";
            $initImport->createCommand($initImportSQL)->execute();
            #$initImport->createCommand("LOCK TABLES {$alterTableName} WRITE;")->execute();
            #$initImport->createCommand("ALTER TABLE {$alterTableName} DISABLE KEYS;")->execute();
            #---------------------------------------------------------------
            $success = 0;
            $error = 0;
            $datasize = 0;
            foreach ($data as $fileName) {

                #หาขนาดของไฟล์
                $datasize += (@filesize($fileName) ? @filesize($fileName) : 0);
                #เปลี่ยนชื่อเพื่อใช้ประมวลผล
                $arrFiles = explode('-', basename($fileName));
                if (count($arrFiles) == 6) { #version 2.0.2
                    list($hospcode, $table, $checksum, $no, $cc, $md5) = $arrFiles;
                    $newFileName = $filepath . $hospcode . '-' . $table . '-' . $checksum . '-' . $no . '-' . $cc . '-' . $md5 . '.sql';
                }

                if (count($arrFiles) == 5) { #version 2.0.1
                    $cc = 0;
                    list($hospcode, $table, $checksum, $no, $md5) = $arrFiles;
                    $newFileName = $filepath . $hospcode . '-' . $table . '-' . $checksum . '-' . $no . '-' . $md5 . '.sql';
                }

                if (@rename($fileName, $newFileName)) {
                    try {

                        $fileData = @file_get_contents($newFileName, FILE_IGNORE_NEW_LINES);
                        list($sqlClear, $sqlInsert) = explode("\n", $fileData);
                        $queryData = base64_decode($sqlClear);
                        if (trim($queryData) == 'AND 1<>1')
                            $queryData = " WHERE 1<>1";

                        $dbname = $prefix . $hospcode . '.' . $table;
                        $tableSync = $prefix . $hospcode . '.wm_table_sync_list';
                        #echo $newFileName . "->";
                        #---------------------------------------------------------------
                        $connection = yii::$app->db_datacenter;
                        #---------------------------------------------------------------
                        $executeClear = "/*{$no}*/ DELETE QUICK FROM {$dbname} {$queryData}";
                        $resultDelete = $connection->createCommand($executeClear)->execute();
                        #---------------------------------------------------------------
                        #$sqlInsert = "/*{$no}*/ INSERT DELAYED INTO " . $dbname . " " . $sqlInsert;
                        $sqlInsert = "/*{$no}*/ INSERT INTO " . $dbname . " " . $sqlInsert;

                        #$connection->createCommand("START TRANSACTION;")->execute();
                        $result = $connection->createCommand($sqlInsert)->execute();

                        #$connection->createCommand("COMMIT;")->execute();
                        #---------------------------------------------------------------
                        yii::$app->db_datacenter->createCommand()
                                ->update($tableSync, ['checksum' => $checksum, 'n_client' => (double) $cc, 'sync_time' => new \yii\db\Expression('NOW()')], "wm_table_sync_name = '{$table}'")
                                ->execute();

                        #---------------------------------------------------------------
                        #echo $result . '<br>';

                        @unlink($newFileName); #ประมวลผลเสร็จแล้ว ลบไฟล์ทิ้ง
                        #import สำเร็จ
                        $success++;
                    } catch (\Exception $exc) {
                        @rename($newFileName, $fileName); #ถ้าประมวลไม่สำเร็จก็จะเปลี่ยนชื่อเป็นเหมือนเดิม
                        #echo 'Error<br>';
                        #echo $exc->getMessage();
                        #import ไม่สำเร็จ
                        $error++;
                    }
                }
                $loop++;
            }
            #---------------------------------------------------------------
            #$initImport->createCommand("ALTER TABLE {$alterTableName} ENABLE KEYS;")->execute();
            #$initImport->createCommand("UNLOCK TABLES;")->execute();
            $initImportSQL = "/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
                                /*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
                                /*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
                                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
                                /*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
                                ";
            $initImport->createCommand($initImportSQL)->execute();
            #---------------------------------------------------------------
            #เก็บ log การนำเข้าระบบ
            $conn_status->createCommand()->insert('wmc_import_log', ['hospcode' => $a2_hospcode,
                'filename' => $a2_table,
                'importtime' => new \yii\db\Expression('NOW()'),
                'countfiles' => count($data),
                'success_no' => $success,
                'error_no' => $error,
                'datasize' => $datasize
            ])->execute();

            #เมื่อเสร็จสิ้นการนำเข้าจะลบรายการนั้นออก
            $conn_status->createCommand("DELETE FROM wmc_import WHERE groupdata = '{$tableGroup}'")->execute();
            #if ($loop == 1)
            #exit;
            /*
              $handle = fopen($filepath . 'importprocess.txt', 'r');
              $occorrenza = '';
              while (($buffer = fgets($handle)) !== false) {
              if (!stripos($buffer, md5($tableGroup))) {
              $occorrenza .= $buffer;
              }
              }
              fclose($handle);
              $handle = fopen($filepath . 'importprocess.txt', 'w');
              if (fwrite($handle, $occorrenza) === FALSE) {
              echo "Cannot write to file";
              }

              fclose($handle);
             *
             */
            #---------------------------------------------------------------
        }
    }

}
