<?php

use common\models\User;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Organization */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Organization'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-md-6">
            <h1 class="m-0 text-dark"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-6 actionBtns">
            <?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
                <ul class="nav nav-pills innernavs">
                        <li class="nav-item active"><a class="nav-link " href="#tab1" data-toggle="tab" aria-expanded="true"><?php echo Yii::t('backend', 'Main Details') ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab2" data-toggle="tab" aria-expanded="false"> <?php echo Yii::t('common', 'Managers') ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab3" data-toggle="tab" aria-expanded="false"> <?php echo Yii::t('common', 'Footer Links') ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab4" data-toggle="tab" aria-expanded="false"> <?php echo Yii::t('common', 'Social Links') ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab5" data-toggle="tab" aria-expanded="false"> <?php echo Yii::t('common', 'Branding') ?></a></li>
                     
                </ul>
                <div class="tab-content mt-2">
                    <div class="tab-pane active" id="tab1">
                        <div class="row">
                            

                            <div class="col-md-12">
                            <?php 
                                $gridColumn = [
                                    'id',
                                    'name',
                                    'slug',
                                    'business_sector',
                                    'address',
                                    [
                                        'attribute'=>Yii::t('common','City'),
                                        'value'=>function($model){
                                            return $model->city->title;
                                        },
                                        'format'=>'raw'
                                    ],
                                    [
                                        'attribute'=>Yii::t('common','District'),
                                        'value'=>function($model){
                                            return $model->district->title;
                                        },
                                    ],
                                    'email:email',
                                    'phone',
                                    'mobile',
                                    'conatct_name',
                                    'contact_email:email',
                                    'contact_phone',
                                    'contact_position',
                                    'limit_account',
                                    [
                                        'attribute'=> Yii::t('common','Logo Image'),
                                        'value'=>function($model){
                                            return "<img src='$model->first_image_base_url$model->first_image_path' width='100' />";
                                        },
                                        'format'=>'raw'
                                    ],
                                    [
                                        'attribute'=> Yii::t('common','Logo Icon Image'),
                                        'value'=>function($model){
                                            return "<img src='$model->second_image_base_url$model->second_image_path' width='100' />";
                                        },
                                        'format'=>'raw'
                                    ]

                                ];
                                echo DetailView::widget([
                                    'model' => $model,
                                    'attributes' => $gridColumn

                                ]);
                            ?>
                            </div>
                        </div>

                           
                       
                    </div>
                    <div class="tab-pane" id="tab2">
                        
                            <?php 
                                $gridColumn = [
                                    'user_id',
                                    'firstname',
                                    'lastname',
                                    'user.email',
                                    'mobile',
                                    [
                                        'attribute'=>Yii::t('common','Status'),
                                        'value'=>function($model){
                                            return User::statuses()[$model->user->status];
                                        }
                                    ],
                                ];
                                echo DetailView::widget([
                                    'model' => $model->manager,
                                    'attributes' => $gridColumn
                                ]);
                            ?>
                     
                    </div>
                    <div class="tab-pane" id="tab3">

                       
                      
                            
                       
                    </div>
                    <div class="tab-pane" id="tab4">

                       
                            
                       
                    </div>

                    <div class="tab-pane" id="tab5">

                        <div class="col-md-3">
                            <p>
                            <label>Logo Image</label>
                            </p>
                            <img src="..." alt="..." class="img-thumbnail">
                       
                            <p>
                            <label>Logo Image</label>
                            </p>
                            <img src="..." alt="..." class="img-thumbnail">
                        </div>
                        <div class="col-md-9">
                           
                            <div style="width: 100px;height: 30px;background: #000;margin: 0 10px;" ></div>
                            <?php 
                                $organizationTheme = [
                                    'brandPrimColor',
                                    'brandSecColor',
                                    // 'brandHTextColor',
                                    // 'brandPTextColor',
                                    // 'brandBlackColor',
                                    // 'brandGrayColor',

                                    // 'arfont',
                                    // 'enfont',
                                    // 'facebook:url',
                                    // 'twitter:url',
                                    // 'linkedin:url',
                                    // 'instagram:url',
                                    // 'locale',
                                ];
                                echo DetailView::widget([
                                    'model' => $model->organizationTheme,
                                    'attributes' => $organizationTheme
                                ]);
                            ?>
                        </div>
                      
                            
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
