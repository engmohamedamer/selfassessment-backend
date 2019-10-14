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
    <?php $this->head() ?>
</head>

    <?php $this->beginBody() ?>
        <?php echo $content ?>
    <?php $this->endBody() ?>
    
</html>
<?php $this->endPage() ?>
