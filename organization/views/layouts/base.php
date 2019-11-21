<?php
use backend\assets\BackendAsset;
use backend\assets\BackendArabic;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use organization\assets\DashboardAsset;


if(Yii::$app->user->isGuest){
    $bundle = BackendAsset::register($this);
}else{
    if(Yii::$app->user->identity->userProfile->locale == 'en-US') {
        $bundle = BackendAsset::register($this);
    }else{
        $bundle = BackendArabic::register($this);
    }
}
DashboardAsset::register($this);

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
        /* /// Mahmoud Customizations On form Here Beside Base Style>>>>>>>> */


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



        .brandPrimColor {
            color: <?= $brandPrimColor ?> !important;

        }

        .brandPrimBgColor {
            background-color: <?= $brandPrimColor ?> !important;

        }
        .brandSecColor {
            color: <?= $brandSecColor ?> !important;

        }
        .brandSecBgColor {
            background-color: <?= $brandSecColor ?> !important;

        }


        .primBtn {
            color: white !important;
            background-color: <?= $brandPrimColor ?> !important;
            border: 1px solid <?= $brandPrimColor ?> !important;
            height: 44px !important;
            min-width: 78px !important;
            padding: 0 20px !important;
            font-size: 1rem !important;
            font-weight: 500 !important;
            border-radius: 5px !important;
            opacity: 1 !important;
            font-size: 20px !important;
            line-height: 40px !important;
            transition: all .2s !important;

        }

        .primBtn:hover {
                opacity: .8 !important;
            }

        .secBtn {
            color: <?= $brandPrimColor ?> !important;
            background-color: transparent !important;
            border: 1px solid <?= $brandPrimColor ?> !important;
            height: 44px !important;
            min-width: 78px !important;
            padding: 0 20px !important;
            font-size: 1rem !important;
            font-weight: 500 !important;
            border-radius: 5px !important;
            font-size: 20px !important;
            line-height: 40px !important;
            transition: all .2s !important;

        }

        .secBtn:hover, .secBtn:active, .secBtn:focus {
            color: white !important;
            background-color: <?= $brandPrimColor ?> !important; 
        }


        .thirdBtn {
            color: #000 !important;
            background-color: transparent  !important;
            height: 44px  !important;
            min-width: 78px  !important;
            padding: 0 20px  !important;
            font-size: 1rem  !important;
            box-shadow: none !important;
            font-size: 20px !important;
            line-height: 40px !important;
            transition: all .2s  !important;

        }

        .thirdBtn:hover {
            color: <?= $brandPrimColor ?> !important;
        }

        section.content .survey-container .survey-block .survey-name-wrap,  section.content .survey-container .survey-block .survey-question-view-wrap, section.content .kv-editable-popover .survey-block .survey-name-wrap, section.content .kv-editable-popover .survey-block .survey-question-name-wrap, section.content .kv-editable-popover .survey-block .survey-question-view-wrap {
            background-color: <?= $brandPrimColor ?> !important; 
        }

        section.content .survey-container .survey-block .survey-question-name-wrap {
            background-color: <?= $brandSecColor ?> !important; 
            color: <?= $brandPrimColor ?> !important;
            border: 1px dashed <?= $brandPrimColor ?> !important;

            
        }

        section.content .survey-container .survey-block  {
            background-color: #fff !important; 
            color: #000;
            border: 2px dashed <?= $brandPrimColor ?>;

        }

        section.content #survey-widget #survey-title, section.content #survey-view #survey-title {
            background-color: #fff !important; 
            color: #000;
            border: 2px dashed <?= $brandPrimColor ?>;
        }

        #survey-questions {
            background: <?= $brandPrimColor ?>;
            border-radius: 10px;
            padding: 20px;
        }

        section.content .survey-container #survey-questions .survey-block  {
            background-color: #fff !important; 
            color: #000;
            border: none !important;
            margin-bottom: 15px !important;

        }

        .survey-container .form-control, .kv-editable-popover .form-control, .survey-container .survey-block .select2-container--krajee .select2-selection--single, .kv-editable-popover .survey-block .select2-container--krajee .select2-selection--single {
            border-bottom: 1px solid <?= $brandPrimColor ?> !important;

        }


        .addQFixed {
            position: fixed;
            right: 3%;
            bottom: 0;
            z-index: 99999;
            background: white;
            padding: 10px;
            /* height:50%; */
            overflow:auto;
            
        }

        /* .addQPanel {

        } */


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
