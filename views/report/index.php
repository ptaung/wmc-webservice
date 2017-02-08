<?php

use miloschuman\highcharts\Highcharts;
?>
<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">แผนภูมิสรุปข้อมูล</h3>
    </div>
    <div class="panel-body">
        <?php
        echo Highcharts::widget([
            'options' => [
                'chart' => ['type' => 'column'],
                'title' => ['text' => 'แผนภูมิสรุปข้อมูล'],
                'xAxis' => ['categories' => $cat],
                'yAxis' => ['title' => ['text' => 'Fruit eaten']],
                'series' => [
                    ['name' => 'ผู้ป่วยนอก', 'data' => [1, 0, 4, 5]],
                //['name' => 'ผู้ป่วยใน', 'data' => [5, 7, 3]]
                ]
            ]
        ]);
        ?>
    </div>
</div>

<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">แผนภูมิสรุปข้อมูล</h3>
    </div>
    <div class="panel-body">
        <?php
        echo Highcharts::widget([
            'options' => [
                'chart' => ['type' => 'column'],
                'title' => ['text' => 'แผนภูมิสรุปข้อมูล'],
                'xAxis' => ['categories' => ['ก.พ', 'มี.ค', 'เม.ย']],
                'yAxis' => ['title' => ['text' => 'Fruit eaten']],
                'series' => [
                    ['name' => 'ผู้ป่วยนอก', 'data' => [1, 0, 4]],
                //['name' => 'ผู้ป่วยใน', 'data' => [5, 7, 3]]
                ]
            ]
        ]);
        ?>
    </div>
</div>
