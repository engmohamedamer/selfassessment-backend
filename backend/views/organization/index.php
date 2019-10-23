<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\OrganizationSearch */
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


echo newerton\fancybox3\FancyBox::widget([

    'config'=>[
        'iframe' => [

            'preload'       => false,
            'css'=>[
                'width'=>'900px',
                'height'=>'500px'
            ]
        ],

    ],
]);

?>
<style>
.table-responsive {
    min-height: 0.01%;
    overflow-x: hidden;
}
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-md-6">
            <h1 class="m-0 text-dark"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-6 actionBtns">
            <?= Html::a(Yii::t('common', 'Create Organization'), ['create'], ['class' => 'btn btn-primary']) ?>
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



    <p>
    </p>
    <div class="search-form" style="display:none">
        <?=  $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?php
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'name',
            'value'=>function ($model) {
                return Html::a( $model->name, ['/organization/view?id='.$model->id]) ;
            },
            'format' => 'raw',
        ],
        [
            'label' => Yii::t('common', 'Organization Manager'),
            'attribute' => 'manager',
            'value'=>function ($model) {
                return  ' <a data-src="/organization/manager?id='.$model->manager->user_id.'" data-fancybox data-type="iframe" href="javascript:;" >'.$model->manager->firstname.'</a> ' ;
            },
            'format' => 'raw',
        ],
        'business_sector',
        'email:email',
        'phone',
        'conatct_name',
        'contact_phone',
        [
            'class' => 'kartik\grid\ActionColumn',
            'template'=>'{view}{update}'
        ],
    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => false,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-organization']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
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
                    'label' => Yii::t('backend','Full'),
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">'. Yii::t('backend','Export All Data') .'</li>',
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
