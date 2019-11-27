<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CorrectiveActionReport */

$this->title = Yii::t('backend', 'Create Corrective Action Report');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Corrective Action Report'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corrective-action-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
