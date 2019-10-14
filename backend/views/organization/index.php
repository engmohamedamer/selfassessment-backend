<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = Yii::t('common', 'Organization');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-6">
            <h1 class="m-0 text-dark">Organization</h1>
        </div>
        <div class="col-6">
            <?= Html::a(Yii::t('common', 'Create Organization'), ['create'], ['class' => 'btn btn-primary','style'=>'float: right']) ?>
       
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.content-header -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Organizations List</h3>
                
            </div>
            <div class="card-body">
            
   
<?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'name',
        [
            'label' => Yii::t('common', 'Organization Manager'),
            'attribute' => 'manager',
            'value'=>function ($model) {
                return  ' <a href="/user/update?id='.$model->manager->user_id.'"target="_blank">'.$model->manager->firstname.'</a> ' ;

            },
            'format' => 'raw',
        ],
        'business_sector',
        // 'address',
        // 'city_id',
        // 'district_id',
        'email:email',
        // 'phone',
        // 'mobile',
        'conatct_name',
        'contact_email:email',
        // 'contact_phone',
        // 'contact_position',
        // 'limit_account',
        // 'first_image_base_url:url',
        // 'first_image_path',
        // 'second_image_base_url:url',
        // 'second_image_path',
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-organization']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        'export' => false,
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
                'exportConfig' => [
                    ExportMenu::FORMAT_PDF => false
                ]
            ]) ,
        ],
    ]); ?>

            </div>
        </div>
    </div>
</div>
