<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Organization */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Organization'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="content-header">
    <div class="">
        <div class="">
            <h1 class="m-0 text-dark"><?= Yii::t('common','Organization Structure')?></h1>
        </div>
        <!-- <div class=" actionBtns">
            <a href="/user/create" class="btn btn btn-primary"><i class="icofont-plus mr-2 ml-2"></i> إضافة مشارك</a>
        </div> -->
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>

