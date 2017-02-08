<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'lab-grid',
    'type' => 'bordered hover',
    //'itemsCssClass' => 'table-fixed-layout',
    'summaryText' => 'แสดงข้อมูลตั้งแต่ {start} ถึง {end} จากข้อมูล {count}',
    'htmlOptions' => array('class' => 'table-responsive'),
    'template' => '
        {items}
        {summary}
      <div class="rows">
        <div class="col-md-12 text-right smnall">{pager}</div>
      </div>',
    'pager' => array('htmlOptions' => array('class' => 'pagination'), 'header' => '', 'class' => 'bootstrap.widgets.TbPager'),
    'dataProvider' => $dataProvider,
    'columns' => array(
        array(
            'header' => 'ลำดับ',
            'value' => '$row + 1 + ($this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize)',
            'headerHtmlOptions' => array('width' => '5%'),
            'htmlOptions' => array('class' => 'small  text-center'),
        ),
        array(
            'header' => 'วันที่ให้บริการ',
            'name' => 'order_date',
            'type' => 'raw',
            'htmlOptions' => array('class' => 'small  text-center'),
        ),
        array(
            'header' => 'หน่วยบริการ',
            'name' => 'hospcode',
            'type' => 'raw',
            'htmlOptions' => array('class' => 'small  text-center'),
        ),
        array(
            'header' => 'ชื่อ LAB ที่ตรวจ',
            'name' => 'lab_items_name',
            'type' => 'raw',
            'headerHtmlOptions' => array('width' => '30%'),
            'htmlOptions' => array('class' => 'small'),
        ),
        array(
            'header' => 'ผล LAB ที่ตรวจ',
            'name' => 'lab_result',
            'type' => 'raw',
            'htmlOptions' => array('class' => 'small  text-center'),
        ),
        array(
            'header' => 'ยื่นยัน LAB ที่ตรวจ',
            'name' => 'confirm',
            'type' => 'raw',
            'htmlOptions' => array('class' => 'small  text-center'),
        ),
    ),
));
?>

