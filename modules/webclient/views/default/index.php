<?php
#use app\components\Cwidget;

use kartik\social\FacebookPlugin;
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\webclient\components\Report;
use kartik\icons\Icon;
use app\modules\webclient\models\WuseItemsLocal;

Icon::map($this);
Icon::map($this, Icon::OCT);
#$menugroup = Report::getMenuGroupDetail($_GET['id']);

$this->title = 'รายงาน';
$this->params['breadcrumbs'][] = $this->title;
#$this->params['breadcrumbs'][] = $menugroup->menu_group_name;
?>

<div class="row">
    <?php
    foreach ($mgroup as $grow) {
        ?>
        <div class="col-md-12">
            <h4 class="text-success"><?= $grow['menu_group_name'] ?></h4>
            <hr>
            <div class="row">
                <?php
                foreach (WuseItemsLocal::find()->where("menu_group_id='{$grow['menu_group_id']}'")->asArray()->all() as $rpt) {
                    if (!isset($report[$rpt['report_id']]))
                        continue;
                    ?>
                    <div class="col-md-4">
                        <?= Icon::show('chevron-right', ['class' => 'octicon'], Icon::OCT) ?> <?= @Html::a($report[$rpt['report_id']]['menu_items_name'], ['/webclient/rpt', 'items' => $rpt['report_id'], 'rsource' => $link], ['class' => 'text-warning']) ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <?php
    }
    ?>
</div>