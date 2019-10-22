<?php
use backend\assets\BackendAsset;
use backend\assets\BackendArabic;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

if(Yii::$app->user->isGuest){
    $bundle = BackendAsset::register($this);
}else{
    if(Yii::$app->user->identity->userProfile->locale == 'en-US') {
        $bundle = BackendAsset::register($this);
    }else{
        $bundle = BackendArabic::register($this);
    }
}

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    
    <?php echo Html::csrfMetaTags() ?>
    <title><?php echo Html::encode($this->title) ?></title>
    <?php 
        $brandPrimColor =  Yii::$app->user->identity->userProfile->organization->organizationTheme->brandPrimColor; 
        $brandSecColor =  Yii::$app->user->identity->userProfile->organization->organizationTheme->brandSecColor; 

    ?>

    <style>
        .btn-primary{
            background-color: <?= $brandPrimColor ?> !important;
            border-color: <?= $brandPrimColor ?> !important;
        }
        .btn-danger{
            background-color: <?= $brandSecColor ?> !important;
            border-color: <?= $brandSecColor ?> !important;
        }
        .nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus{
             background-color: <?= $brandPrimColor ?> !important;
        }
        .table td a {
            color: <?= $brandPrimColor ?> !important;
        }
        a:hover, a:active, a:focus {
            color: <?= $brandPrimColor ?> !important;
        }
    </style>
    <?php $this->head() ?>
</head>
<body class="skin-blue sidebar-mini" cz-shortcut-listen="true" style="height: auto; min-height: 100%;">

    <?php $this->beginBody() ?>
        <?php echo $content ?>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
