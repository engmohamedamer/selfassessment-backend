<?php
/**
 * @var $this yii\web\View
 * @var $content string
 */

use backend\assets\BackendArabic;
use backend\assets\BackendAsset;
use backend\modules\system\models\SystemLog;
use backend\widgets\Menu;
use common\models\TimelineEvent;
use kartik\icons\Icon;
use kartik\widgets\Alert;
// use yii\bootstrap4\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\log\Logger;
use yii\widgets\Breadcrumbs;
Icon::map($this);


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

<?php $this->beginContent('@organization/views/layouts/base.php'); ?>
<div class="wrapper" style="height: auto; min-height: 100%;">

<header class="main-header">

    <!-- Logo -->
    <!-- Brand Logo -->


    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      </a>
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
                  <span class="dropdown-item dropdown-header"><?= Yii::t('common','Welcome')?>,  <?php echo Yii::$app->user->identity->userProfile->fullName; ?></span>
                  <div class="dropdown-divider"></div>
                  <a href="/sign-in/profile" class="dropdown-item">
                      <i class="far fa-user-circle mr-2"></i> <?= Yii::t('common','My Profile')?>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="/sign-in/account" class="dropdown-item">
                      <i class="far fa-user mr-2"></i>  <?= Yii::t('common','My Account')?>
                  </a>
                  <div class="dropdown-divider"></div>

                  <?php echo Html::a(  '<i class="fas fa-sign-out-alt mr-2"></i> '. Yii::t('backend', 'Logout'), ['/sign-in/logout'], ['class' => 'dropdown-item', 'data-method' => 'post']) ?>

              </div>

          </li>


        </ul>
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
                    if (Yii::$app->user->can('governmentAdmin')) {
                        $this->beginContent('@app/views/layouts/menus/_superadmin_menu.php');
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
                    <?php 
                      echo Alert::widget([
                        'type' => Alert::TYPE_SUCCESS,
                        'icon' => 'fas fa-ok-circle',
                        'body' => Yii::$app->session->getFlash('alert')['body'],
                        'showSeparator' => true,
                        'delay' => 3000
                    ]);
                    ?>
                <?php endif; ?>

                <?php echo $content ?>


        </section><!-- /.content -->
    </div><!-- /.right-side -->


    <footer class="main-footer">
        <strong>&nbsp;</strong>
        <div class="pull-right">
            <!-- <?php echo Yii::powered() ?> -->
        selfassesment &copy;  <?php echo date('Y') ?>
        </div>
  </footer>
</div><!-- ./wrapper -->

<?php $this->endContent(); ?>
