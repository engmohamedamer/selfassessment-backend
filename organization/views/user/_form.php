<?php

use common\helpers\Filter;
use common\models\OrganizationStructure;
use common\models\User;
use common\models\UserProfile;
use kartik\tree\TreeViewInput;
use sjaakp\taggable\TagEditor;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model organization\models\UserForm */
/* @var $roles yii\rbac\Role[] */
/* @var $permissions yii\rbac\Permission[] */

$model->roles =Yii::$app->session->get('UserRole');

?>

    <?php $form = ActiveForm::begin() ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="">
        <div class="">
            <h1 class="m-0 text-dark">
                <?php 
                    if (Yii::$app->session->get('UserRole') == 'governmentAdmin') {
                        echo Yii::t('common','Organization Admins');
                    }else{
                        echo Yii::t('backend','Add Contributor');
                    }

                ?>
            </h1>
        </div>

        <div class=" actionBtns">
            <button type="submit" class="btn btn-success"><i class="icofont-verification-check mr-2 ml-2"></i> <?= Yii::t('backend', 'Save');?></button>
        </div>

        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.content-header -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <?php echo $form->field($profile, 'picture')->widget(\trntv\filekit\widget\Upload::class, [
                            'url'=>['avatar-upload']
                        ]) ?>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?php echo $form->field($profile, 'firstname') ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo $form->field($model, 'email') ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo $form->field($model, 'password')->passwordInput() ?>
                    </div>
                    <div class="col-md-4">
                    <?php
                        
                        echo $form->field($profile, 'sector_id')->widget(TreeViewInput::classname(),
                        [
                            'name' => 'kvTreeInput',
                            'value' => 'true', // preselected values
                            'query' => Filter::organizationStructureQuery(),
                            'headingOptions' => ['label' => Yii::t('common','Sector')],
                            'rootOptions' => ['label'=>'<i class="fas fa-tree text-success"></i>'],
                            'fontAwesome' => true,
                            'asDropdown' => true,
                            'multiple' => false,
                            'options' => ['disabled' => false]
                        ]);
                    ?>
                    </div>
                
                    <div class="col-md-4 col-sm-12">
                        <?php echo $form->field($profile, 'mobile') ?>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <?php echo $form->field($profile, 'gender')->dropDownlist([
                            UserProfile::GENDER_MALE => Yii::t('backend', 'Male'),
                            UserProfile::GENDER_FEMALE => Yii::t('backend', 'Female'),
                        ]) ?>
                    </div>
                    

                    <div class="col-md-4 col-sm-12">
                            <?php echo $form->field($profile, 'locale')->dropDownlist(Yii::$app->params['availableLocales']) ?>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <?php echo $form->field($model, 'status')->dropDownList(User::statuses()) ?>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <?= $form->field($model, 'tags')->widget(TagEditor::class, [
                            'clientOptions' => [
                                'autocomplete' => [
                                    'source' => Url::toRoute(['tag/suggest'])
                                ],
                            ]
                        ]) ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

    <?php ActiveForm::end() ?>

