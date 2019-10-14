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
<div class="organization-view">

    <div class="row">
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a(Yii::t('common', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

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
