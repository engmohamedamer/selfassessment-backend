<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Organization */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Organization'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-6">
            <h1 class="m-0 text-dark"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-6">
            <?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary','style'=>'float: right']) ?>
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
    <ul class="nav nav-pills">
        
            <li class="nav-item ml-auto "><a class="nav-link" href="#tab_2-2" data-toggle="tab" aria-expanded="false"> <?php echo Yii::t('common', 'Organization Manager') ?></a></li>
            <li class="nav-item "><a class="nav-link active" href="#tab_1-1" data-toggle="tab" aria-expanded="true"><?php echo Yii::t('backend', 'Main Details') ?></a></li>
         
    </ul>
    <div class="tab-content mt-2">
        <div class="tab-pane active" id="tab_1-1">
            <div class="row">

<?php 
    $gridColumn = [
        'id',
        'name',
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
            'attribute'=>Yii::t('common','First Image'),
            'value'=>function($model){
                return "<img src='$model->first_image_base_url$model->first_image_path' width='100' />";
            },
            'format'=>'raw'
        ],
        [
            'attribute'=>Yii::t('common','Second Image'),
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
            <div class="tab-pane active" id="tab_1-1">
            <div class="row">

            </div>
            </div>


</div>



</div>
</div>
</div>
</div>
