<?php

use backend\models\City;
use backend\models\District;
use common\models\Organization;
use common\models\User;
use common\models\UserProfile;
use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use trntv\filekit\widget\Upload;
// use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\multiLang\MyMultiLanguageActiveField;

\organization\assets\OrgUpdate::register($this);


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



    

<div class="row theme-edit">

    <div class='col-sm-2 col-lg-1 theme-nav' >
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation" class="active"><a  href="#tab_1-1" data-toggle="tab" aria-expanded="true"><span class=" glyphicon glyphicon-pencil" aria-hidden="true"></span><p><?php echo Yii::t('backend', 'Main Details') ?></p></a></li>
            <li role="presentation" class=""><a  href="#tab_2-2" data-toggle="tab" aria-expanded="true"><span class=" glyphicon glyphicon-eye-open" aria-hidden="true"></span><p><?php echo Yii::t('common', 'Organization Theme') ?></p></a></li>
            <li role="presentation" class=""><a  href="#tab_3-3" data-toggle="tab" aria-expanded="true"><span > <i class="fas fa-palette"></i></span><p>الألوان</p></a></li>
            <li role="presentation" class=""><a  href="#tab_4-4" data-toggle="tab" aria-expanded="true"><span > <i class="fas fa-link"></i></span><p>روابط تذييل الصفحة</p></a></li>
            <li role="presentation" class=""><a  href="#tab_5-5" data-toggle="tab" aria-expanded="true"><span > <i class="fas fa-users"></i></span><p>التواصل الإجتماعي</p></a></li>
        </ul>
    </div>

    <div class='col-sm-10 theme-edit-content'>
        <h2 class='mt-2 mb-5'>تعديل البيانات</h2>
        <div class='theme-edit-form'>
            <div class="tab-content mt-5">




                <div class="tab-pane active" id="tab_1-1">
                    <div class="row">
                       <div class='col-sm-12 col-lg-8 row'>

                            <div class="col-lg-6">
                                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name'])
                                    ->widget(MyMultiLanguageActiveField::className());  ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'business_sector')->textInput(['maxlength' => true])->widget(MyMultiLanguageActiveField::className());  ?>

                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'conatct_name')->textInput(['maxlength' => true])->widget(MyMultiLanguageActiveField::className());  ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'contact_position')->textInput(['maxlength' => true])->widget(MyMultiLanguageActiveField::className());  ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'address')->textInput(['maxlength' => true])->widget(MyMultiLanguageActiveField::className());  ?>
                            </div>
                            <div class="col-lg-6">
                            </div>

                            <div class="col-lg-6">
                                <?= $form->field($model, 'slug',[
                                        'addon' => ['prepend' => ['content'=>'selfasses.com']]
                                ])->textInput(['maxlength' => true]) ?>
                            </div>

                            <div class="col-lg-6">
                                <?php echo $form->field($model, 'city_id')->dropDownList([''=>Yii::t('common',  'Select')]+ArrayHelper::map($city, 'id', 'title'),['id'=>'City-id',]) ?>
                            </div>
                            

                            
                            
                            <div class="col-lg-6">
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
                            <div class="col-lg-6">
                                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
                            </div>
                            
                            <div class="col-lg-6">
                                <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'contact_phone')->textInput(['maxlength' => true]) ?>
                            </div>
                            
                            <div class="col-lg-6">
                                <?= $form->field($model, 'limit_account')->textInput() ?>
                            </div>

                            <div class="w-100"></div>
                            
                       </div>
                       
                       <div class='col-sm-0 col-lg-4 theme-edit-preview'>
                            <h2 class=''> عرض توضيحي</h2>
                            <div class='preview-images mt-5'>
                                <div  class="tab-pane active" id="tab_1-1">
                                    <p>* يرجى ادخال البيانات المطلوبة باللغتين العربية والإنجليزية</p>
                                    <hr>
                                    <p>* يظهر اسم المؤسسة المُدخل في أماكن عدة بالموقع كتبويب المتصفح وفي خانة الحقوق بتذييل الموقع</p>

                                    <img src="/img/preview/preview1.png" alt="" class='mt-3 mb-3 img'>
                                    <img src="/img/preview/preview2.png" alt="" class='mt-3 mb-3 img'>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                

                <div class="tab-pane " id="tab_2-2">
                    <div class='row'>
                        <div class='col-sm-12 col-lg-8 row'>
                            <div class="col-lg-6">
                                <?php echo $form->field($model, 'first_image')->widget(\common\b4widget\upload\MyUpload::class, [
                                    'url'=>['first-upload']
                                ]) ?>
                            </div>
                            <div class="col-lg-6">
                                <?php echo $form->field($model, 'second_image')->widget(\common\b4widget\upload\MyUpload::class, [
                                    'url'=>['second-upload']
                                ]) ?>
                            </div>
                        </div>
                        <div class='col-sm-0 col-lg-4 theme-edit-preview'>
                            <h2 class=''> عرض توضيحي</h2>
                            <div class='preview-images mt-5'>
                                <div  class="tab-pane active" id="tab_1-1">

                                    <img src="/img/tamkeen-logo.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="tab-pane " id="tab_3-3">
                    <div class='row'>
                        <div class='col-sm-12 col-lg-8 row'>
                            <?= 
                                $this->render('_formOrganizationTheme', [
                                'form' => $form,
                                'OrganizationThemeColor' => is_null($model->organizationTheme) ? new common\models\OrganizationTheme() : $model->organizationTheme,
                            ]) ?>
                        </div>
                        <div class='col-sm-0 col-lg-4 theme-edit-preview'>
                            <h2 class=''> عرض توضيحي</h2>
                            <div class='preview-images mt-5'>
                                <div  class="tab-pane active" id="tab_1-1">

                                    <img src="/img/tamkeen-logo.png" alt="">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>



                <div class="tab-pane " id="tab_4-4">
                    <div class='row'>
                        <div class='col-sm-12 col-lg-8 row'>
                            <?= 
                                $this->render('_formOrganizationTheme', [
                                'form' => $form,
                                'OrganizationThemeLinks' => is_null($model->organizationTheme) ? new common\models\OrganizationTheme() : $model->organizationTheme,
                            ]) ?>
                        </div>
                        <div class='col-sm-0 col-lg-4 theme-edit-preview'>
                            <h2 class=''> عرض توضيحي</h2>
                            <div class='preview-images mt-5'>
                                <div  class="tab-pane active" id="tab_1-1">

                                    <img src="/img/tamkeen-logo.png" alt="">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>



                <div class="tab-pane " id="tab_5-5">
                    <div class='row'>
                        <div class='col-sm-12 col-lg-8 row'>
                            
                        </div>
                        <div class='col-sm-0 col-lg-4 theme-edit-preview'>
                            <h2 class=''> عرض توضيحي</h2>
                            <div class='preview-images mt-5'>
                                <div  class="tab-pane active" id="tab_1-1">

                                    <img src="/img/tamkeen-logo.png" alt="">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>


            </div>
        </div>

    </div>

    <div class='col-sm-12'>
        <div class="form-group edit-theme-btn">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
        </div>
    </div>
         
</div>

    <?php ActiveForm::end(); ?>


