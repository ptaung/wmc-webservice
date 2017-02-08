<?php
/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\widgets\Connect;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

#use yii\captcha\Captcha;

/**
 * @var yii\web\View                   $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module           $module
 */
$this->title = Yii::t('user', 'Sign in') . Yii::$app->params['systemName'] . ' | ' . Yii::$app->params['depname'];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="rows">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">เข้าสู่<?= Yii::$app->params['systemName'] ?></h3>
            </div>
            <div style="padding-top:30px" class="panel-body" >
                <?php
                $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'enableAjaxValidation' => true,
                            'enableClientValidation' => false,
                            'validateOnBlur' => false,
                            'validateOnType' => false,
                            'validateOnChange' => false,
                        ])
                ?>
                <div style="margin-bottom: 25px"  class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="text" id="login-form-login" class="form-control" name="login-form[login]" autofocus="autofocus" tabindex="1" placeholder="ชื่อผู้ใช้งาน หรือ อีเมล">
                </div>

                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" id="login-form-password" class="form-control" name="login-form[password]" tabindex="2" placeholder="รหัสผ่าน">
                </div>
                <?php # $form->field($model, 'login', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]) ?>
                <?php # $form->field($model, 'password', ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2']])->passwordInput()->label(Yii::t('user', 'Password') . ($module->enablePasswordRecovery ? ' (' . Html::a(Yii::t('user', 'Forgot password?'), ['/user/recovery/request'], ['tabindex' => '5']) . ')' : '')) ?>
                <?php # $form->field($model, 'rememberMe')->checkbox(['tabindex' => '4'])   ?>

                <?php
                /*
                  $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                  'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                  'captchaAction' => '/site/captcha',
                  ])
                 *
                 */
                ?>

                <?= Html::submitButton('Login', ['class' => 'btn btn-success', 'tabindex' => '3']) ?>

                <?php if ($module->enableRegistration): ?>
                    <?= Html::a(Yii::t('user', 'สมัครสมาชิกใหม่'), ['/user/registration/register'], ['class' => 'btn btn-primary']) ?>
                <?php endif ?>
                <?php ActiveForm::end(); ?>
                <p>
                <div class="form-group">
                    <div class="col-md-12 control">
                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                            <?php if ($module->enableConfirmation): ?>
                                <?= Html::a(Yii::t('user', 'ยังไม่ได้รับข้อความยืนยัน'), ['/user/registration/resend']) ?>
                            <?php endif ?>
                            <?= Html::a(Yii::t('user', 'ลืมรหัสผ่าน'), ['/user/recovery/request']) ?>

                            <a href="#" class="pull-right">ผู้พัฒนาระบบ คุณศิลา กลั่นแกล้ว</a>
                        </div>
                    </div>
                </div>
                </p>
            </div>
        </div>
        <?= Connect::widget(['baseAuthUrl' => ['/user/security/auth'],])
        ?>
    </div>
</div>
