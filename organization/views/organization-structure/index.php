<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use common\models\OrganizationStructure;
use kartik\tree\TreeView;
use kartik\tree\Module;
use yii\web\View;


$this->title = Yii::t('common', 'Organization Structure');
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
    <?php
    echo TreeView::widget([
        'query' => OrganizationStructure::find()->addOrderBy('root, lft'),
        'rootOptions' => ['label' => '<span class="text-primary">'.Yii::t('common', 'Organization Structure').'</span>'],
        'fontAwesome' => false,
        'isAdmin' => false,
        'displayValue' => 0,
        'softDelete'=>true,
        'iconEditSettings'=> [
             'show' => 'list',
             'listData' => [
                 'folder-close' => 'Folder',
                 'file' => 'File',

             ]
         ],
    ]);
    ?>
</div>
</div>
</div>
</div>
