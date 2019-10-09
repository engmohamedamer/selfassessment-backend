<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\LoginForm */

$this->title = Yii::t('backend', 'Sign In');
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = 'login-page';
\backend\assets\LoginAsset::register($this);

?>
<style>
    body{
        background-image: url(/img/login-bg.png) !important;
        background-repeat: no-repeat !important;
        background-position: 100%;
        background-size: contain;
    }
    .help-block-error{
        display: block !important;
    }
</style>
<div class="wrapper">
        <header>
            <div class="container">
                <a href="" class="brand-link"><img src="/img/tamkeen-logo.png" width="150"> </a>

                
                <div class="row">
                    <div class="col-md-4">
                        <div class="login">
                            <h2>WELCOME,</h2>
                            <h4>Sign in Now!</h4>
                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                                <div class="form-group field-loginform-username required">
                                    <input type="text" id="loginform-username" class="form-control" name="LoginForm[username]" aria-required="true" placeholder="Email">
                                    <i class="fas fa-envelope"></i>
                                    <p class="help-block help-block-error"></p>
                                </div>
                                <div class="form-group field-loginform-password required">
                                    <input type="password" id="loginform-password" class="form-control" name="LoginForm[password]" aria-required="true" placeholder="Password">
                                    <i class="fas fa-eye"></i>
                                    <p class="help-block help-block-error"></p>
                                </div>
                                <div class="form-group">
                                <?php echo Html::submitButton(Yii::t('backend', 'Sign in'), [
                                    'class' => 'btn btn-primary',
                                    'name' => 'login-button'
                                ]) ?>
                                   
                                </div>
                            <?php ActiveForm::end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
<!-- <div class="login-box">
    <div class="login-logo">
        <?php echo Html::encode($this->title) ?>
    </div>
    <div class="header"></div>
    <div class="login-box-body">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="body">
            <?php echo $form->field($model, 'username') ?>
            <?php echo $form->field($model, 'password')->passwordInput() ?>
            <?php echo $form->field($model, 'rememberMe')->checkbox(['class'=>'simple']) ?>
        </div>
        <div class="footer">
            <?php echo Html::submitButton(Yii::t('backend', 'Sign In'), [
                'class' => 'btn btn-primary btn-flat btn-block',
                'name' => 'login-button'
            ]) ?>
        </div>
        <?php ActiveForm::end() ?>
    </div>

</div>  -->