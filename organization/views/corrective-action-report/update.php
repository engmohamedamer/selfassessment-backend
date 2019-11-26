<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CorrectiveActionReport */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Corrective Action Report',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Corrective Action Report'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="corrective-action-report-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
