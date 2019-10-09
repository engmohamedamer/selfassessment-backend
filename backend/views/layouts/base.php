<?php
use backend\assets\BackendAsset;
use backend\assets\BackendArabic;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this \yii\web\View */
/* @var $content string */



if(Yii::$app->user->isGuest){
    $bundle = BackendAsset::register($this);
}else{
    if(Yii::$app->user->identity->userProfile->locale == 'en-US') {
        $bundle = BackendAsset::register($this);
    }else{
        $bundle =BackendArabic::register($this);
    }
}




$this->params['body-class'] = $this->params['body-class'] ?? null;
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
    <?php $this->head() ?>
    <script src="https://www.gstatic.com/firebasejs/5.11.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.11.1/firebase-firestore.js"></script>
</head>

<body class="hold-transition sidebar-mini">
    <?php $this->beginBody() ?>
        <?php echo $content ?>
    <?php $this->endBody() ?>
    
<?php echo Html::endTag('body') ?>
  <script type="text/javascript">
        $('button[type="reset"]').on('click',function(){
            console.log('reset');
            $("#eventrequestsearch-calssification_id").val('').trigger('change')
            $("#eventrequestsearch-field_id").val('').trigger('change')
            $("#eventrequestsearch-school_id").val('').trigger('change')
            $("#newssearch-school_id").val('').trigger('change')
        });
    </script>
</html>
<?php $this->endPage() ?>
