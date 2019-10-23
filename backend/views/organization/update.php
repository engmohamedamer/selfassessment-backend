<?php

use common\widgets\OrganizationForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Organization */

$this->title = Yii::t('common', 'Update') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Organization'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common', 'Update');
?>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-md-6">
            <h1 class="m-0 text-dark"><?= Html::encode($this->title) ?></h1>
        </div>

        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.content-header -->
<?= OrganizationForm::widget(['model' => $model,
	'theme'=> $theme,
    'themeFooterLinks'=> $themeFooterLinks
]) ?>

