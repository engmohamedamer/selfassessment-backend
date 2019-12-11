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
<div class="organization-structure-index">
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
