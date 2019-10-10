<?php
/**
 * @var $this yii\web\View
 * @var $content string
 */

use backend\assets\BackendAsset;
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
        $bundle =\backend\assets\BackendArabic::register($this);
    }
}


?>

<?php $this->beginContent('@backend/views/layouts/base.php'); ?>

<div class="wrapper">
        <nav class="main-header navbar navbar-expand">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>

            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user user-menu">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <img src="<?php echo Yii::$app->user->identity->userProfile->getAvatar($this->assetManager->getAssetUrl($bundle, 'img/anonymous.jpg')) ?>"
                                class="user-image">
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">Welcome, Mohamed Amer</span>
                        <div class="dropdown-divider"></div>
                        <a href="/sign-in/profile" class="dropdown-item">
                            <i class="far fa-user-circle mr-2"></i> My Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="/sign-in/account" class="dropdown-item">
                            <i class="far fa-user mr-2"></i> My Account
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="/sign-in/logout" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                        <?php echo Html::a(Yii::t('backend', 'Logout'), ['/sign-in/logout'], ['class' => 'dropdown-item', 'data-method' => 'post']) ?>
                       
                    </div>
                   
                </li>
            </ul>
        </nav>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar ">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <img src="/img/tamkeen-logo.png" alt="<?php echo Yii::$app->name ?>" title="<?php echo Yii::$app->name ?>" class="brand-image ">

            </a>

            <!-- Sidebar -->
            <div class="sidebar">


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
                        $this->beginContent('@app/views/layouts/menus/_manager_menu.php');
                        $this->endContent();
                    }
                    ?>

                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
    
    <!-- Left side column. contains the logo and sidebar -->
   

    <!-- Right side column. Contains the navbar and content of the page -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">
                            <?php echo $this->title ?>
                            <?php if (isset($this->params['subtitle'])): ?>
                                <small><?php echo $this->params['subtitle'] ?></small>
                            <?php endif; ?>
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <a href="NewAssessment.html" class="btn btn-primary" style="float:right">New Assessment</a>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
        

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
            <?php if (Yii::$app->session->hasFlash('alert')): ?>
                <?php echo Alert::widget([
                    'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                    'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
                ]) ?>
            <?php endif; ?>
            <?php echo $content ?>
            </div>
        </section><!-- /.content -->
    </div><!-- /.right-side -->

  
    <footer class="main-footer">
        <strong>&nbsp;</strong>
        <div class="pull-right">
            <!-- <?php echo Yii::powered() ?> -->
        فعال &copy;  <?php echo date('Y') ?>
        </div>
  </footer>
</div><!-- ./wrapper -->

<?php $this->endContent(); ?>
