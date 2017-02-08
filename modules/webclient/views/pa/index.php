<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Chospital;
use app\modules\webclient\components\Cwebclient;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

$this->title = 'ติดตามตัวชี้วัด HDC ' . (isset($_GET['q_byear']) ? 'ช่วงคัดกรองวันที่ ' . Cwebclient::getThaiDate($birth[0]) . ' ถึง ' . Cwebclient::getThaiDate($birth[1]) : '');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(['id' => 'gdData', 'timeout' => false, 'enablePushState' => false,]) ?>
<div class="menu-group-index">
    <?php
    $y = date('Y') - 2;
    $s = date('Y') + 2;
    for ($y; $y < $s; $y++) {
        $byear[$y] = $y + 543;
    }
#current budgetyear
    if ((int) date('Ym') >= (int) (date('Y') . '10') OR (int) date('Ym') >= (int) (date('Y') . '11')OR (int) date('Ym') >= (int) (date('Y') . '12')) {
        $budgetyear = date('Y') + 1;
    } else {
        $budgetyear = date('Y');
    }
    if (strlen(\Yii::$app->params['ampcode']) == 4) {
        $ampcode = " and concat(provcode,distcode) = '" . \Yii::$app->params['ampcode'] . "' ";
    } else {
        $ampcode = '';
    }
    $dataselect = (isset($_GET['q_hospcode']) ? $_GET['q_hospcode'] : \Yii::$app->user->identity->profile->hospcode);

    if (!\Yii::$app->user->can('super_admin')) {
        $sqlStringAdd = " and hoscode='{$dataselect}' ";
    }

    $provcode = \Yii::$app->params['provcode'];
    $data = Chospital::find()->where("hostype in ('03','05','06','07','18' ) $ampcode and provcode = '{$provcode}' {$sqlStringAdd}")->orderBy('hoscode')->all();
    ?>

    <?php
    $url = yii\helpers\Url::to(['target/ppspecialdetail']);
    $this->registerJs(
            "$('.detail-view-link').click(function() {
      var cid = $(this).data('id');
      $('.modal-body').html('<p>กำลังเรียกข้อมูลของ '+cid+'</p>');
      $.get(
      '" . $url . "',
      {
      cid: $(this).data('id')
      },
      function (d) {
      $('#cid-html').html(cid);
      $('.modal-body').html(d);
      $('#pp-modal').modal();
      }
      );
      });
      "
    );
    ?>
    <div class="">

        <?php
        ?>



        <?=
        GridView::widget([
            'export' => [
                #'fontAwesome' => true,
                'showConfirmAlert' => false,
                'target' => GridView::TARGET_BLANK,
                'label' => 'ส่งออกรายงาน',
            ],
            'exportConfig' => [
                GridView::EXCEL => ['label' => 'บันทึกเป็น EXCEL'],
            #GridView::PDF => ['label' => 'บันทึกเป็น PDF'],
            ],
            #'pjax' => true,
            'responsiveWrap' => false,
            #'floatHeader' => true,
            #'export' => false,
            'layout' => '<div class="box box-success">
<div class="box-header with-border">
<i class="fa fa-fw fa-list-ul" style="color: #1E8000;"></i> <b>' . $this->title . '</b>
<div class="box-tools pull-right">{summary}</div>
</div>
<div class="box-body">
          {items}{pager}
</div>
</div>',
            'dataProvider' => $dataProvider,
            'columns' => $columns # array_merge($columns, $hColumns)
        ]);
        ?>
    </div>
</div>
<?php Pjax::end(); ?>

<?php
Modal::begin([
    'id' => 'pp-modal',
    'size' => 'modal-lg',
    'header' => '<h4 class="modal-title">การได้รับคัดกรอง <span id="cid-html"></span></h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
]);
?>
<?php Modal::end(); ?>