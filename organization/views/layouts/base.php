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

    <link rel="stylesheet" href="/css/icofont/icofont.min.css">


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
            height: 24px !important;
            min-width: 78px !important;
            padding: 0 16px !important;
            font-size: 1rem !important;
            font-weight: 500 !important;
            border-radius: 10px !important;
            opacity: 1 !important;
            font-size: 16px !important;
            line-height: 16px !important;
            /* transition: all .2s !important; */

        }

        .primBtn:hover {
                opacity: .8 !important;
            }

        .secBtn {
            color: <?= $brandPrimColor ?> !important;
            background-color: transparent !important;
            border: 1px solid <?= $brandPrimColor ?> !important;
            height: 24px !important;
            min-width: 78px !important;
            padding: 0 16px !important;
            font-size: 1rem !important;
            font-weight: 500 !important;
            border-radius: 10px !important;
            font-size: 16px !important;
            line-height: 16px !important;
            transition: all .2s !important;

        }

        .secBtn:hover, .secBtn:active, .secBtn:focus {
            color: white !important;
            background-color: <?= $brandPrimColor ?> !important;
        }


        .thirdBtn {
            color: <?= $brandPrimColor ?> !important;
            background-color: transparent  !important;
            height: 24px  !important;
            min-width: 78px  !important;
            padding: 0 16px  !important;
            font-size: 1rem  !important;
            box-shadow: none !important;
            font-size: 16px !important;
            line-height: 16px !important;
            transition: all .2s  !important;
            border-radius: 10px !important;


        }

        .thirdBtn:hover {
            color: white !important;
            background-color: <?= $brandPrimColor ?>  !important;
            text-decoration:none;
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

        #survey-widget #survey-title .survey-labels .survey-label, #survey-view #survey-title .survey-labels .survey-label {
            background: <?= $brandPrimColor ?> !important;
            border-color: <?= $brandPrimColor ?> !important;
        }


        .addQFixed {
            position: fixed;
            right: 250px;
            bottom: 0;
            z-index: 99999;
            background: white;
            padding: 10px 5px;
            height: auto;
            overflow: hidden;
            width: calc(100% - 250px);
            display: flex;
            align-items: flex-start;
            justify-content: center;
            flex-direction: row;
            flex-wrap: wrap;
            /* border: 2px solid #ddd; */
            /* border-radius: 10px; */
            box-shadow: 0 0 10px 0 #c5c5c5;
            margin:0 !important;

        }

        .addQFixed a:hover {
            background: <?= $brandPrimColor ?>;
            color:white !important;
            text-decoration: none !important;
        }
        .addQFixed a {
            width: 9%;
            display:inline-block;
            color: #7d7d7d;
            padding: 10px 0;
            border-radius: 10px;
            /* border-bottom: 1px solid #ddd; */
            font-size: 35px;
            margin: 0 5px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            /* transition: all ease-in-out .2s; */
        }

        .addQFixed a i {
            font-size: 35px;

        }

        .addQFixed a span {
            font-size: 12px;
            display: inline-block;
            width: 100%;
            text-align: center;
            margin: 7px 0;
        }

        .addQFixed .saveSurveyBtn {
            margin: 20px 0 !important;
        }

        .survey-details {
            background: #fff;
            position: fixed;
            bottom: 110px;
            right: 25px;
            width: 200px;
            z-index: 99999;
            border-radius: 10px;
            padding: 5px;
        }

        .inner-details {
            border: 2px dashed <?= $brandPrimColor ?>;
            height:100%;
            border-radius:10px;
            padding:10px;
        }

        .inner-details h5 {
            color: <?= $brandPrimColor ?>;
        }

        .inner-details p {
            color: #333;
        }

        .inner-details p span {
            color: #6e84a3;
        }

        .inner-details p i {
            display:inline-block;
        }




  











        .custom-dashboard .box-danger {
            border-top-color: <?= $brandPrimColor ?> !important;
        }
        .theme-edit .theme-nav ul.nav li.active a{
            background-color:<?= $brandPrimColor ?> !important;
            border: 0;
        }
        .login .form-group .btn{
            background:<?= $brandPrimColor ?> !important;
        }
        .login .form-group a.btn {
            background: <?= $brandSecColor ?> !important;
            color: #333;
        }

        .treeview.menu-open >a{
            color: <?= $brandPrimColor ?> !important;
        }


        /* .content-header h1 {
            border-right: 5px solid <?= $brandPrimColor ?> !important ;
            border-left: 5px solid <?= $brandPrimColor ?> !important;
        } */

        .sidebar-menu>li.active>a {
            background: <?= $brandPrimColor ?>!important;
            color: white !important;
        }

        .btn-success{
            background-color: <?= $brandPrimColor ?> !important;
            border-color: <?= $brandPrimColor ?> !important;
        }

        .table td.skip-export a:hover{
            -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
            box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
            background: <?= $brandPrimColor ?>;
        }

        table.table thead tr:first-child {
        background: #333;
        border-bottom: 5px solid <?= $brandPrimColor ?>;
        }

        table.table thead tr th {
        color: white;
        }

        table.table thead tr th a {
        color: white;
        }

        .nav.nav-pills.innernavs {
            margin-bottom: 20px;
        }
        
                    


    </style>
    <?php $this->head() ?>
</head>
<body class="skin-blue sidebar-mini" cz-shortcut-listen="true" style="height: auto; min-height: 100%;" data-Primcolor="<?= $brandPrimColor ?>">

    <?php $this->beginBody() ?>
        <?php echo $content ?>
    <?php $this->endBody() ?>
    </body>

    <script>



  $(function () {
    $('[data-toggle="popover"]').popover({
        container: 'body',
    html : true,
  })
})
    </script>
</html>
<?php $this->endPage() ?>
