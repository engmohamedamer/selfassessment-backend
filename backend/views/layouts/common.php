<?php
/**
 * @var $this yii\web\View
 * @var $content string
 */

use backend\assets\BackendAsset;
use backend\assets\BackendArabic;
use backend\modules\system\models\SystemLog;
use backend\widgets\Menu;
use common\models\TimelineEvent;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\log\Logger;
use yii\widgets\Breadcrumbs;

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

<?php $this->beginContent('@backend/views/layouts/base.php'); ?>
<div class="wrapper" style="height: auto; min-height: 100%;">

    <header class="main-header">

        <!-- Logo -->
        <!-- Brand Logo -->


        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <!-- <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        </a> -->

        <div class="white-text dropdown-item dropdown-header"><div><?= Yii::t('common','Tamkeen Technologies Adminstrator')?></div></div>
        
        <div class='user-info-block'>
            <span class="white-text dropdown-item dropdown-header"><?= Yii::t('common','welcome')?><div><?php echo strtoupper(Yii::$app->user->identity->userProfile->fullName) ?></div></span>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown user user-menu">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <img src="<?php echo Yii::$app->user->identity->userProfile->getAvatar($this->assetManager->getAssetUrl($bundle, 'img/anonymous.jpg')) ?>"
                                class="user-image">

                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="/sign-in/profile" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> <?= Yii::t('common','My Profile')?>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="/sign-in/account" class="dropdown-item">
                            <i class="fas fa-users-cog mr-2"></i>  <?= Yii::t('common','My Account')?>
                        </a>
                        <div class="dropdown-divider"></div>

                        <?php echo Html::a(  '<i class="fas fa-sign-out-alt mr-2"></i> '. Yii::t('backend', 'Logout'), ['/sign-in/logout'], ['class' => 'dropdown-item', 'data-method' => 'post']) ?>

                    </div>

                </li>


                </ul>
            </div>
        </div>

        </nav>
    </header>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar ">

        <a href="/" class="logo">
            <img src="/img/tamkeen-logo.png" alt="<?php echo Yii::$app->name ?>" title="<?php echo Yii::$app->name ?>" class="brand-image ">
        </a>
        <!-- Sidebar -->
        <section class="sidebar">


            <!-- Sidebar Menu -->
            <nav class="mt-2">


                <?php
                if (Yii::$app->user->can('administrator')) {
                // $this->beginContent('@app/views/layouts/menus/_superadmin_menu.php');
                    $this->beginContent('@app/views/layouts/menus/_manager_menu.php');
                    $this->endContent();
                } elseif (Yii::$app->user->can('manager') ) {
                    $this->beginContent('@app/views/layouts/menus/_manager_menu.php');
                    $this->endContent();

                }else{
                    //do no thing
                    $this->beginContent('@app/views/layouts/menus/empty.php');
                    $this->endContent();
                }
                ?>

            </nav>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Left side column. contains the logo and sidebar -->


    <!-- Right side column. Contains the navbar and content of the page -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">

                <?php if (Yii::$app->session->hasFlash('alert')): ?>
                    <?php echo Alert::widget([
                        'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                        'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
                    ]) ?>
                <?php endif; ?>

                <?php echo $content ?>


        </section><!-- /.content -->
    </div><!-- /.right-side -->


    <footer class="main-footer">
        <div class="">
            <!-- <?php echo Yii::powered() ?> -->
        Tamkeen Technologies &copy;  <?php echo date('Y') ?>
        </div>
  </footer>
</div><!-- ./wrapper -->

<?php $this->endContent(); ?>
