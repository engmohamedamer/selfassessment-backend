<?php

use common\widgets\OrganizationForm;

/* @var $this yii\web\View */
/* @var $model common\models\Organization */

$title = (Yii::$app->language == 'ar' )? $model->name_ar : $model->name;
$this->title = Yii::t('common', 'Update') . ' ' . $title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Organization'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>



<?= OrganizationForm::widget([
	'model' => $model,
	'theme'=> $theme,
	'themeFooterLinks'=> $themeFooterLinks
]) ?>
