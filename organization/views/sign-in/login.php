<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \organization\models\LoginForm */

$this->title = Yii::t('backend', 'Sign In');
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = 'login-page';
\organization\assets\LoginAsset::register($this);

?>
   
<div class="wrapper">
        <header>
            <div class="container">
                <a href="" class="brand-link"><img src="/img/tamkeen-logo.png" width="150"> </a>


                <div class="row">
                    <div class="col-md-4">
                        <div class="login">
                            <h2>WELCOME,</h2>
                            <h4>Tamkeen Admin!</h4>
                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                                <?php echo $form->field($model, 'username')->textInput(['placeholder'=>'Email'])->label(false) ?>
                                <?php echo $form->field($model, 'password')->passwordInput(['placeholder'=>'Password'])->label(false) ?>
                                <div class="form-group">
                                    <?php echo Html::submitButton(Yii::t('backend', 'Sign in'), [
                                        'class' => 'btn btn-primary',
                                        'name' => 'login-button'
                                    ]) ?>
                                    <a href="/sign-in/request-password-reset" class="btn"><? echo Yii::t('backend', 'Forget password?') ?></a>
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
