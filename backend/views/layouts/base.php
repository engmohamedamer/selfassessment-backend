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


    <style>
        .btn-primary{
            background-color: #cd4e8e !important;
            border-color: #cd4e8e !important;
        }
        .btn-danger{
            background-color: #94464e !important;
            border-color: #94464e !important;
        }
        .nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus{
             background-color: #cd4e8e !important;
        }
        .table td a {
            color: #cd4e8e !important;
        }
        a:hover, a:active, a:focus {
            color: #cd4e8e !important;
        }

        .panel-primary > .panel-heading {
            background-color: #cd4e8e !important;
            border-color: #cd4e8e !important;
        }
        .panel-primary {
            border-color: #cd4e8e !important;
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
