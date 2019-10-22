<?php

use backend\models\City;
use backend\models\District;
use common\models\Organization;
use common\models\User;
use common\models\UserProfile;
use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use trntv\filekit\widget\Upload;
// use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\multiLang\MyMultiLanguageActiveField;

/* @var $this yii\web\View */
/* @var $model common\models\Organization */
/* @var $form yii\widgets\ActiveForm */

$city = City::find()->all();
if (isset($model->city_id) and !empty($model->city_id)) {
    $district = District::find()->where("city_id = $model->city_id")->all();
}else{
    $district = [];
}
?>



    <?php $form = ActiveForm::begin(); ?>

    <div class="alert alert-danger error-summary mt-2" style="display: none;">
        <?php  echo $form->errorSummary($model); ?>
    </div>





<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

    <ul class="nav nav-pills innernavs">
        <li class="nav-item  active"><a class="nav-link " href="#tab_1-1" data-toggle="tab" aria-expanded="true"><?php echo Yii::t('backend', 'Main Details') ?></a></li>

        <?php if($model->isNewRecord) :?>
            <li class="nav-item"><a class="nav-link" href="#tab_2-2" data-toggle="tab" aria-expanded="false"> <?php echo Yii::t('common', 'Organization Manager') ?></a></li>
        <?php endif; ?>
        <li class="nav-item  "><a class="nav-link " href="#tab_3-3" data-toggle="tab" aria-expanded="true"><?php echo Yii::t('common', 'Organization Theme') ?></a></li>

    </ul>
    <div class="tab-content mt-2">
        <div class="tab-pane active" id="tab_1-1">
            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name'])
                        ->widget(MyMultiLanguageActiveField::className());  ?>
                </div>

                <div class="col-lg-4">
                    <?= $form->field($model, 'slug',[
                            'addon' => ['prepend' => ['content'=>'selfasses.com']]
                    ])->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-lg-4">
                    <?= $form->field($model, 'business_sector')->textInput(['maxlength' => true])->widget(MyMultiLanguageActiveField::className());  ?>

                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'address')->textInput(['maxlength' => true])->widget(MyMultiLanguageActiveField::className());  ?>
                </div>
                <div class="col-lg-4">
                    <?php echo $form->field($model, 'city_id')->dropDownList([''=>Yii::t('common',  'Select')]+ArrayHelper::map($city, 'id', 'title'),['id'=>'City-id',]) ?>
                </div>
                <div class="col-lg-4">
                    <?php echo $form->field($model, 'district_id')->widget(DepDrop::classname(), [
                            'data'=> ArrayHelper::map($district,'id','title'),
                            'options' => ['id'=>'subcat-id' ,'placeholder'=>Yii::t('common','Select City first')],
                            'pluginOptions'=>[
                                'depends'=>['City-id'],
                                'placeholder' => Yii::t('common',  'Select') ,
                                'url' => Url::to(['/helper/school-districts','schoolId'=>$model->id])
                            ]
                        ]);
                    ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'conatct_name')->textInput(['maxlength' => true])->widget(MyMultiLanguageActiveField::className());  ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'contact_phone')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'contact_position')->textInput(['maxlength' => true])->widget(MyMultiLanguageActiveField::className());  ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'limit_account')->textInput() ?>
                </div>

                <div class="col-lg-4">
                    <?php echo $form->field($model, 'status')->dropDownList(Organization::status()) ?>
                </div>

                <div class="clearfix"></div>
                <div class="col-lg-4">
                    <?php echo $form->field($model, 'first_image')->widget(Upload::class, [
                        'url'=>['first-upload']
                    ]) ?>
                </div>
                <div class="col-lg-4">
                <?php echo $form->field($model, 'second_image')->widget(Upload::class, [
                    'url'=>['second-upload']
                ]) ?>
                </div>
            </div>
        </div>
        <?php if($model->isNewRecord) :?>
        <div class="tab-pane" id="tab_2-2">

            <div class="row">
                <div class="col-md-12">
                    <?php echo $form->field($profile, 'picture')->widget(Upload::class, [
                        'url'=>['avatar-upload']
                    ]) ?>
                </div>

                <div class="col-md-4 col-sm-12">
                    <?php echo $form->field($user, 'email') ?>
                </div>

                <div class="col-md-4 col-sm-12">
                    <?php echo $form->field($user, 'password')->passwordInput() ?>
                </div>



                <div class="col-md-4 col-sm-12">
                    <?php echo $form->field($profile, 'firstname') ?>
                </div>

                <div class="col-md-4 col-sm-12">
                    <?php echo $form->field($profile, 'lastname') ?>
                </div>
                <div class="col-md-4 col-sm-12">

                    <?php echo $form->field($profile, 'gender')->dropDownlist([
                        UserProfile::GENDER_FEMALE => Yii::t('backend', 'Female'),
                        UserProfile::GENDER_MALE => Yii::t('backend', 'Male')
                    ]) ?>
                </div>

                <div class="col-md-4 col-sm-12">
                    <?php echo $form->field($user, 'mobile') ?>
                </div>

            </div>

        </div>
        <?php endif;?>
        <div class="tab-pane " id="tab_3-3">
            <?=
                $this->render('_formOrganizationTheme', [
                'form' => $form,
                'OrganizationTheme' => is_null($model->organizationTheme) ? new common\models\OrganizationTheme() : $model->organizationTheme,
            ]) ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

            </div>
        </div>
    </div>
</div>

    <?php ActiveForm::end(); ?>


