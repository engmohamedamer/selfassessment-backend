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
        </nav>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar ">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <img src="/img/tamkeen-logo.png" alt="" class="brand-image ">

            </a>

            <!-- Sidebar -->
            <div class="sidebar">


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>

                        </li>
                        <li class="nav-header">Assessments</li>
                        <li class="nav-item">
                            <a href="AssessmentsList.html" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Assessments List
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="NewAssessment.html" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    New Assessment
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="AssessmentsList.html" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Assessments Reports
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>ChartJS</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Flot</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inline</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header">Contributors</li>

                        <li class="nav-item">
                            <a href="ContributorsList.html" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Contributors List
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="NewContributor.html" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    New Contributor
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ContributorsList.html" class="nav-link">
                                <i class="nav-icon fas fa-chart-area"></i>
                                <p>
                                    Contributors Report
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">MISCELLANEOUS</li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Pages
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>News</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Contact us</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>About us</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Terms</p>
                                    </a>
                                </li>


                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-plus-square"></i>
                                <p>
                                    Extras
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Help Center</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Media Center</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Notifications Center</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
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
                            <h1 class="m-0 text-dark">Assessments List</h1>
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
