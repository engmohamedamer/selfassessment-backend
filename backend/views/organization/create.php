<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Organization */

$this->title = Yii::t('common', 'Create Organization');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Organization'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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

    <?= $this->render('_formTest', [
        'model' => $model,
        'user' => $user,
        'profile' => $profile,
        'theme'=> $theme,
        'themeFooterLinks'=> $themeFooterLinks
    ]) ?>


