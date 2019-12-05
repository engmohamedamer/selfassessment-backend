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
            <li role="presentation" class="active"><a  href="#tab_1-1" data-toggle="tab" aria-expanded="true"><span ><i class="fas fa-edit"></i></span><p><?php echo Yii::t('backend', 'Main Details') ?></p></a></li>
            <?php if($model->isNewRecord) :?>
            <li role="presentation" class=""><a  href="#tab_6-6" data-toggle="tab" aria-expanded="true"><span ><i class="fas fa-eye"></i></span><p><?php echo Yii::t('common', 'Organization Admin') ?></p></a></li>
            <?php endif ?>
            <li role="presentation" class=""><a  href="#tab_2-2" data-toggle="tab" aria-expanded="true"><span ><i class="fas fa-eye"></i></span><p><?php echo Yii::t('common', 'Organization Theme') ?></p></a></li>

            <li role="presentation" class=""><a  href="#tab_3-3" data-toggle="tab" aria-expanded="true"><span > <i class="fas fa-palette"></i></span><p><?php echo Yii::t('common', 'Colors') ?></p></a></li>
            <li role="presentation" class=""><a  href="#tab_4-4" data-toggle="tab" aria-expanded="true"><span > <i class="fas fa-link"></i></span><p><?php echo Yii::t('common', 'Footer Links') ?></p></a></li>
            <li role="presentation" class=""><a  href="#tab_5-5" data-toggle="tab" aria-expanded="true"><span > <i class="fas fa-users"></i></span><p><?php echo Yii::t('common', 'Socail Links') ?></p></a></li>
        </ul>
    </div>

    <div class='col-sm-10 col-lg-11 theme-edit-content'>
       
        <div class='theme-edit-form'>
            <div class="content-header" style="padding:0">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <h1><?= Html::encode($this->title) ?></h1>
                    </div>
                    <div class="col-md-6">
                    </div>
                    
                </div>
            </div>
            <div class="tab-content mt-5">




                <div class="tab-pane active" id="tab_1-1">
                    <div class="row">
                       <div class='col-sm-12 col-lg-8 row theme-edit-content-panel'>

                           <?php

                           if (Yii::$app->user->can('administrator') or Yii::$app->user->can('manager')) {
                               ?>

                               <div class="col-sm-12 slugaddon">
                                   <?= $form->field($model, 'slug',[
                                       'addon' => ['prepend' => ['content'=>'.selfasses.com']]
                                   ])->textInput(['maxlength' => true]) ?>
                               </div>
                               <hr class='mt-5 mb-5 col-lg-12 row'>


                               <?
                           }?>

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
                                <?= $form->field($model, 'about')->textarea(['rows' => '6'])->widget(MyMultiLanguageActiveField::className());  ?>
                            </div>
                            <div class="col-lg-6">
                            </div>
                            <hr class='mt-5 mb-5 col-lg-12 row'>


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
                            <div class="col-lg-6">
                            </div>

                            <div class="col-lg-6 ">
                                <?php echo  $form->field($theme, 'locale')->dropDownlist(Yii::$app->params['availableLocales']) ?>
                            </div>

                       </div>

                       <div class='col-sm-0 col-lg-4 theme-edit-preview'>
                            <h2 class=''> <?php echo Yii::t('common', 'Preview') ?></h2>
                            <div class='preview-images mt-5'>
                                <div  class="tab-pane active">
                                    <p><?php echo Yii::t('common', '* Please enter the required data in two languages arabic & english.') ?></p>
                                    <hr class='mt-5 mb-5'>
                                    <p><?php echo Yii::t('common', '* SLUG input is the subdomain of your website and contains your organization name in english with no spaces.') ?></p>
                                    <img src="/img/previews/preview4.png" alt="" class='mt-3 mb-3 img'>
                                    <hr class='mt-5 mb-5'>
                                    <p><?php echo Yii::t('common', '* Organization name shows in multiple places in your website like ( browser tab, website side menu and footer rights ).') ?></p>
                                    <p><?php echo Yii::t('common', '-- Examples --') ?></p>
                                    <img src="/img/previews/preview1.png" alt="" class='mt-3 mb-3 img'>
                                    <img src="/img/previews/preview2.png" alt="" class='mt-3 mb-3 img'>
                                    <img src="/img/previews/preview3.png" alt="" class='mt-3 mb-3 img'>

                                    <hr class='mt-5 mb-5'>
                                    <p><?php echo Yii::t('common', '* In default language part you enter the default language of your website.') ?></p>
                                    <hr class='mt-5 mb-5'>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>




                <div class="tab-pane " id="tab_2-2">
                    <div class='row'>
                        <div class='col-sm-12 col-lg-8 row theme-edit-content-panel'>
                            <div class="col-lg-6">
                                <?php echo $form->field($model, 'first_image')->widget(Upload::class, [
                                    'url'=>['first-upload']
                                ]) ?>
                            </div>
                            <div class="col-lg-6">
                                <?php echo $form->field($model, 'second_image')->widget(Upload::class, [
                                    'url'=>['second-upload']
                                ]) ?>
                            </div>
                        </div>
                        <div class='col-sm-0 col-lg-4 theme-edit-preview'>
                            <h2 class=''> <?php echo Yii::t('common', 'Preview') ?></h2>
                            <div class='preview-images mt-5'>
                                <div  class="tab-pane active" >
                                
                                    <p><?php echo Yii::t('common', '* Organization logo will be shown in your website header and the logo icon in your browser tab and website side menu.') ?></p>
                                    <p><?php echo Yii::t('common', '-- Examples --') ?></p>
                                    <img src="/img/previews/preview5.png" alt="" class='mt-3 mb-3 img'>
                                    <img src="/img/previews/preview6.png" alt="" class='mt-3 mb-3 img'>
                                    <p><?php echo Yii::t('common', 'Logos properties:') ?></p>
                                    <p><?php echo Yii::t('common', '- must be in PNG format.') ?></p>
                                    <p><?php echo Yii::t('common', '- size must be 1MB at max.') ?></p>
                                    <p><?php echo Yii::t('common', '- logo will be presented on white background so make sure that it suits it.') ?></p>
                                    <hr class='mt-5 mb-5'>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php if($model->isNewRecord) :?>

                <div class="tab-pane " id="tab_6-6">
                    <div class='row'>
                        <div class='col-sm-12 col-lg-8 row theme-edit-content-panel'>
                            <?=
                                $this->render('_formOrganizationAdmin', [
                                'form' => $form,
                                'user' => $user,
                                'profile' => $profile,
                            ]) ?>
                        </div>
                        <div class='col-sm-0 col-lg-4 theme-edit-preview'>
                            <h2 class=''> <?php echo Yii::t('common', 'Preview') ?></h2>
                            <div class='preview-images mt-5'>
                                <div  class="tab-pane active">
                                    <p><?php echo Yii::t('common', 'Colors will present your organization identity in the website parts like buttons and backgrounds.') ?></p>
                                    <p><?php echo Yii::t('common', 'Please enter your main color and the second color with lower opacity.') ?></p>
                                    <p> <?php echo Yii::t('common', '-- Examples --') ?> </p>
                                    <img src="/img/previews/preview7.png" alt="" class='mt-3 mb-3 img'>
                                    <hr class='mt-5 mb-5'>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endif;?>


                <div class="tab-pane " id="tab_3-3">
                    <div class='row'>
                        <div class='col-sm-12 col-lg-8 row theme-edit-content-panel'>
                            <?=
                                $this->render('_formOrganizationThemeColor', [
                                'form' => $form,
                                'OrganizationTheme' => $theme,
                            ]) ?>
                        </div>
                        <div class='col-sm-0 col-lg-4 theme-edit-preview'>
                            <h2 class=''> <?php echo Yii::t('common', 'Preview') ?></h2>
                            <div class='preview-images mt-5'>
                                <div  class="tab-pane active">
                                    <p><?php echo Yii::t('common', 'Colors will present your organization identity in the website parts like buttons and backgrounds.') ?></p>
                                    <p><?php echo Yii::t('common', 'Please enter your main color and the second color with lower opacity.') ?></p>
                                    <p> <?php echo Yii::t('common', '-- Examples --') ?> </p>
                                    <img src="/img/previews/preview7.png" alt="" class='mt-3 mb-3 img'>
                                    <hr class='mt-5 mb-5'>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>



                <div class="tab-pane " id="tab_4-4">
                    <div class='row'>
                        <div class='col-sm-12 col-lg-8 row theme-edit-content-panel'>
                            <?=
                                $this->render('_formOrganizationThemeFooterLinks', [
                                'form' => $form,
                                'organizationFooterLinks' => $themeFooterLinks,
                            ]) ?>
                        </div>
                        <div class='col-sm-0 col-lg-4 theme-edit-preview'>
                            <h2 class=''> <?php echo Yii::t('common', 'Preview') ?></h2>
                            <div class='preview-images mt-5'>
                                <div  class="tab-pane active" >
                                    <p><?php echo Yii::t('common', 'Footer links will be shown in the footer and contains 5 links with short naming.') ?></p>
                                    <p><?php echo Yii::t('common', 'Please enter your links names in the required languages.') ?></p>
                                    <p> <?php echo Yii::t('common', '-- Examples --') ?> </p>
                                    <img src="/img/previews/preview7.png" alt="" class='mt-3 mb-3 img'>
                                    <hr class='mt-5 mb-5'>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>



                <div class="tab-pane " id="tab_5-5">
                    <div class='row'>
                        <div class='col-sm-12 col-lg-8 row theme-edit-content-panel'>
                            <?=
                                $this->render('_formOrganizationThemeLinks', [
                                'form' => $form,
                                'OrganizationTheme' => $theme,
                            ]) ?>
                        </div>
                        <div class='col-sm-0 col-lg-4 theme-edit-preview'>
                            <h2 class=''> <?php echo Yii::t('common', 'Preview') ?></h2>
                            <div class='preview-images mt-5'>
                                <div  class="tab-pane active" >
                                <p><?php echo Yii::t('common', 'Social media links will be shown in the footer.') ?></p>
                                    <p> <?php echo Yii::t('common', '-- Examples --') ?> </p>
                                    <img src="/img/previews/preview7.png" alt="" class='mt-3 mb-3 img'>
                                    <hr class='mt-5 mb-5'>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group edit-theme-btn">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
           
     

        </div>
        

    </div>

    

</div>

    <?php ActiveForm::end(); ?>


