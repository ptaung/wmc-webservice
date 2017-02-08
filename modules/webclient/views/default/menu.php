<?php
#use app\components\Cwidget;

use kartik\social\FacebookPlugin;
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\webclient\components\Report;
use kartik\icons\Icon;

Icon::map($this);
Icon::map($this, Icon::OCT);
@$menugroup = Report::getMenuGroupDetail($_GET['id']);

$this->title = 'กลุ่มรายงาน';
$this->params['breadcrumbs'][] = $this->title;
#$this->params['breadcrumbs'][] = @$menugroup->menu_group_name;
?>
<style>
    .text-overflow{
        width: 100%;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }
</style>
<div class = "bs-example">
    <div class="alert alert-dismissible alert-warning">
        <strong>กลุ่มรายงาน:</strong> <?php echo @$menugroup->menu_group_name . ' (' . $cc . ' รายการ)';
?>
    </div>
    <div class = "row">
        <div class="list-group">
            <div class="col-sm-12 col-md-12">
                <?php
                foreach ($report as $rpt) {
                    #if (!isset($report[$rpt['report_id']]))
                    #continue;
                    #if (!empty($m->menu_items_sqlquery)) {
                    $url = Url::to(['/webclient/rpt', 'items' => $rpt['items_id']]);
                    $class = "";
                    #} else {
                    #$url = 'javascript:;';
                    #$class = "disabled btn";
                    #}
                    ?>
                    <div class="list-group-item ">

                        <a href="<?php echo $url; ?>" class="<?php echo $class; ?>">
                            <h4 class="list-group-item-heading text-primary text-overflow">
                                <?= Icon::show('mention', ['class' => 'octicon'], Icon::OCT) ?>
                                <?php echo @$report[$rpt['items_id']]['menu_items_name']; ?>
                                <?php if ($report[$rpt['items_id']]['allnew'] <= 5) { ?>
                                    <small class="pull-right">
                                        <span class="label label-primary"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> มาใหม่</span>
                                    </small>
                                <?php } ?>
                            </h4>

                        </a>

                        <div class="text-overflow">
                            <i>
                                <small class="text-default" style="padding-left: 20px;">ที่มา::<?php echo @Html::encode($report[$rpt['items_id']]['menu_items_comment']); ?></small>
                            </i>
                        </div>
                        <!--
                                              <div style="padding-left: 25px;">

                                                  <div class="btn btn-danger btn-xs" role="button">
                                                      <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Comment
                                                  </div>

                        <?php #echo FacebookPlugin::widget(['type' => FacebookPlugin::LIKE, 'settings' => ['showfaces' => 'false', 'href' => Url::to([($m->menu_items_url ? $m->menu_items_url : '/report/rpt'), 'items' => $m->menu_items_id])]]);          ?>
                                              </div>
                        -->

                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class = "clearfix"></div>
    <br>
    <div class = "row">


        <?php
        foreach ($model as $key => $m) {
            continue;
            ?>
            <div class="col-sm-6 col-md-12">

                <div class="thumbnail">
                    <!--
                    <a href="<?php echo Url::to([$m->menu_items_url, 'items' => $m->menu_items_id]); ?>">
                        <img class="img-responsive" data-src="holder.js/100%x200" alt="100%x200" src="http://cdn2.dazeinfo.com/wp-content/uploads/2015/05/myntra-mobile-app-shopping.png" data-holder-rendered="true" style="height: 150px; width: 100%; display: block;">
                    </a>
                    -->
                    <div class="caption">
                        <h4 class="text-overflow"><span class="glyphicon glyphicon-registration-mark" aria-hidden="true"></span> <?php echo $m->menu_items_name; ?></h4>
                        <p class="text-overflow"><?php echo Html::encode($m->menu_items_comment); ?></p>
                        <p><a href="#" class="btn btn-danger btn-xs" role="button">
                                <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Comment
                            </a>
                            <a href="<?php echo Url::to([$m->menu_items_url, 'items' => $m->menu_items_id]); ?>" class="btn btn-success btn-xs" role="button">
                                ดูรายงาน
                            </a>
                            <?php echo FacebookPlugin::widget(['type' => FacebookPlugin::LIKE, 'settings' => ['href' => Url::to([$m->menu_items_url])]]); ?>
                        </p>

                    </div>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
</div>
