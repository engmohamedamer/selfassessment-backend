<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\District */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Districts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-view">

    <div class="row">
        <div class="col-sm-8">
            <h2><?= Yii::t('backend', 'District').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
            <?= Html::a(Yii::t('backend', 'Save As New'), ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>            
            <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'city.title',
            'label' => Yii::t('backend', 'City'),
        ],
        'title',
        'slug',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>City<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnCity = [
        ['attribute' => 'id', 'visible' => false],
        'ref',
        'title',
        'slug',
        'sort',
    ];
    echo DetailView::widget([
        'model' => $model->city,
        'attributes' => $gridColumnCity    ]);
    ?>
    
    <div class="row">
<?php
if($providerSchools->totalCount){
    $gridColumnSchools = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'title',
            'slug',
            'school_identity_number',
            'city_id',
                        'stage',
            'gender',
            'category',
            'email:email',
            'admin_name',
            'admin_phone',
            'admin_email:email',
            'supervisor_phone',
            'owner_name',
            'owner_phone',
            'owner_identity',
            'owner_gender',
            'owner_email:email',
            'nour_rep_phone',
            'owner_id',
            'lock',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerSchools,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-schools']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('backend', 'Schools')),
        ],
        'export' => false,
        'columns' => $gridColumnSchools
    ]);
}
?>

    </div>
</div>
