<?php

use common\grid\EnumColumn;
use common\models\User;
use kartik\grid\GridView;
use kartik\helpers\Html;
use trntv\yii\datetime\DateTimeWidget;
use yii\web\JsExpression;

$url=\yii\helpers\Url::to(['/helper/users-list']);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \Yii::t('common', 'Respondents');
$this->params['breadcrumbs'][] = $this->title;


$organization = $survey->organization;
$siteLink = $_SERVER['REQUEST_SCHEME'] . '://'. $organization->slug . $_SERVER['SERVER_NAME'];
$link =  str_ireplace(['api','endpoints','organization'],'',$siteLink);

?>

<div class="content-header">
    <div class="">
        <h1> <?= \Yii::t('common', 'Respondents') ?>  : <?= $survey->survey_name ?> </h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            
           
            <div class="card-body">
            <?php
                $gridColumns=[
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => \Yii::t('common', 'Respondents'),
                        'value'=> function($model){
                            return $model->user->userProfile->fullName;
                        }
                    ],

                    [
                        'attribute' => \Yii::t('common', 'Reports'),
                        'value'=> function($model) use($link){
                            if ($model->survey_stat_is_done) {
                                return Html::a(\Yii::t('common', 'View'), $link.'/report/'.$model->survey_stat_hash,['target'=>'_blank']);
                            }
                            return '---';
                        },
                        'format'=>'raw'
                    ],


                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'template'=>'{delete}'
                    ],
                ];

                echo GridView::widget([
                    'id' => 'kv-grid-demo',
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $gridColumns, // check the configuration for grid columns by clicking button above

                ]);
            ?>
            </div>
        </div>
    </div>
</div>
