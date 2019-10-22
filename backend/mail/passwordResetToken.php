<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $token string */

$resetLink = Yii::getAlias('@backendUrl').'/sign-in/reset-password?token='.$token;
?>

Hello <?php echo Html::encode($user->username) ?>,

Follow the link below to reset your password:

<?php echo Html::a(Html::encode($resetLink), $resetLink) ?>