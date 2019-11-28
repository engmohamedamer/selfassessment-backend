<?php

use organization\models\Schools;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = Yii::t('backend', 'Dashboard');
\organization\assets\DashboardAsset::register($this);
?>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?= Yii::t('backend', 'Dashboard') ?></h1>
            </div>
            <div class='col-sm-6 dashboard-fancy-btn'>
                <a href="/assessment/default/create" class="fancy-button bg-gradient1 "><span><i class="fa fa-file-signature mr-2 ml-2"></i> <?= \Yii::t('common', 'Create new survey')?> </span></a>
            </div>
            <!-- <div class="col-sm-6"> -->
                <!-- <a href="NewOrganization.html" class="btn btn-primary" style="float: right">New Organization</a> -->
            <!-- </div> -->
            <!-- /.col -->
        </div>
    </div>

    <div class="row custom-dashboard">
        <!-- <div class="col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fa fa-tag"></i></span>

                <div class="info-box-content">
                <span class="info-box-text"><a href="/organization/view"><?= Yii::t('common', 'Organization Show') ?></a></span>
                </div>
                <!~~ /.info-box-content ~~>
            </div>
            <!~~ /.info-box ~~>
        </div>
        <!~~ /.col ~~>
        <div class="col-sm-6 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-gear"></i></span>

                <div class="info-box-content">
                <span class="info-box-text"><a href="/organization/update"><?= Yii::t('common', 'Organization Update') ?></a>
                </span>
                </div>
                <!~~ /.info-box-content ~~>
            </div>
            <!~~ /.info-box ~~>
        </div>
        <!~~ /.col ~~>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                <span class="info-box-text"><a href="/user/index"><?= Yii::t('common', 'Contributors') ?></a></span>
                </div>
                <!~~ /.info-box-content ~~>
            </div>
            <!~~ /.info-box ~~>
        </div> -->

        <!-- /.col -->

        <div class="col-md-12">
            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= \Yii::t('common', 'Latest Assessments')?></h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?= \Yii::t('common', 'Survey')?></th>
                                <th><?= \Yii::t('common', 'Status')?></th>
                                <th><?= \Yii::t('common', 'Ends At')?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i=1;
                                foreach($organizationSurvey as $survey):
                                if ($survey->survey_is_closed) {
                                    $class = 'danger';
                                    $status = Yii::t('common','Closed');
                                }else{
                                    $class = 'success';
                                    $status = Yii::t('common','Open');
                                }
                            ?>

                            <tr>
                                <td><?= $i++ ?></td>
                                <td><a href="/assessment/default/view?id=<?= $survey->survey_id ?>"><?= $survey->survey_name ?></a></td>
                                <td><span class="label label-<?=$class?>"><?= $status ?></span></td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20"><?= $survey->survey_expired_at ?></div>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="/assessment/default/create" class="btn btn-sm btn-info btn-flat pull-left"><?= \Yii::t('common', 'Create new survey')?></a>
                    <a href="/assessment" class="btn btn-sm btn-default btn-flat pull-right"><?= \Yii::t('common', 'Assessments List') ?></a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>


        <div class="col-md-12">
            <div class="text-center assessmentParticipants-preloader preloader" style="display:none">
                <img src="./img/preloader.gif" alt="">
            </div>
            <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">عدد المشاركين في كل إستبيان</h3>

                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <canvas id="assessmentParticipantsChart"  ></canvas>
            </div>
            <!-- /.box-body -->
            </div>
        </div>

        <div class="col-md-6">
            <!-- <div class="text-center participantsStatus-preloader preloader" style="display:none">
                <img src="./img/preloader.gif" alt="">
            </div> -->
            <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">حالة الإستبيانات</h3>

                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <canvas id="participantsStatusChart" style="height: 237px; width: 475px;" height="237" width="475"></canvas>
            </div>
            <!-- /.box-body -->
            </div>
        </div>


        <!-- <div class="col-md-12">
                <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">الإستبيان الأخير</h3>

                    <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <canvas id="assessmentChart" style="height: 237px; width: 475px;" height="100%" width="475"></canvas>
                </div>
                <!~~ /.box-body ~~>
                </div>
        </div> -->




        <div class="col-md-6">
            <!-- USERS LIST -->
            <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title"><?= Yii::t('common', 'Latest Contributors') ?></h3>

                <div class="box-tools pull-right">
                <!-- <span class="label label-danger">8 New Members</span> -->
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <ul class="users-list clearfix row">
                <?php foreach($contributors->getModels() as $contributor): ?>
                <li class='col-sm-4 col-md-2 '>
                    <img width='80%' src="<?= $contributor->userProfile->avatar ?>" alt="<?= $contributor->userProfile->fullname ?>">
                    <a class="users-list-name" href="/user/view?id=<?= $contributor->id ?>"><?= $contributor->userProfile->fullname ?></a>
                    <span class="users-list-date"><?= date('Y-m-d',$contributor->created_at) ?></span>
                </li>
                <?php endforeach; ?>
                </ul>
                <!-- /.users-list -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
                <a href="/user/index" class="uppercase"><?= Yii::t('common', 'All Contributors') ?></a>
            </div>
            <!-- /.box-footer -->
            </div>
            <!--/.box -->
        </div>





    </div>



<?php
$this->registerJs(<<<JS
$(document).ready(function(e) {

});
JS
);

?>






















































































<!-- <div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Assessments Report</h3>
                    <a href="javascript:void(0);">Full Report</a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">820</span>
                        <span>Assessments Over Time</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                            <i class="fas fa-arrow-up"></i> 12.5%
                        </span>
                        <span class="text-muted">Since last week</span>
                    </p>
                </div>

                <div class="position-relative mb-4">
                    <canvas id="visitors-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
<i class="fas fa-square text-primary"></i> This Week
</span>

                    <span>
<i class="fas fa-square text-gray"></i> Last Week
</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">New Organizations</h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i>
                    </a>
                    <a href="#" class="btn btn-tool btn-sm">
                        <i class="fas fa-bars"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0">

                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>Organization</th>
                            <th>Assessments</th>
                            <th>Contributors</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                        <tbody>
                            <tr>
                                <td>

                                    <a href="OrganizationView.html"> Organization Name</a>
                                </td>
                                <td><a href="AssessmentList.html">3</a></td>
                                <td><a href="ContributorsList.html">52</a></td>
                                <td class="text-success">Active</td>

                                <td>
                                    <a href="#" class="text-muted" title="View Report" style="margin-right: 10px">
                                        <i class="fas fa-file-contract"></i>
                                    </a>
                                    <a href="#" class="text-muted" title="Edit Assessment">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                </td>
                            </tr>
                            <tr>
                                <td>

                                    <a href="OrganizationView.html"> Organization Name</a>
                                </td>
                                <td><a href="AssessmentList.html">3</a></td>
                                <td><a href="ContributorsList.html">52</a></td>
                                <td class="text-success">Active</td>

                                <td>
                                    <a href="#" class="text-muted" title="View Report" style="margin-right: 10px">
                                        <i class="fas fa-file-contract"></i>
                                    </a>
                                    <a href="#" class="text-muted" title="Edit Assessment">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                </td>
                            </tr>
                            <tr>
                                <td>

                                    <a href="OrganizationView.html"> Organization Name</a>
                                </td>
                                <td><a href="AssessmentList.html">3</a></td>
                                <td><a href="ContributorsList.html">52</a></td>
                                <td class="text-success">Active</td>

                                <td>
                                    <a href="#" class="text-muted" title="View Report" style="margin-right: 10px">
                                        <i class="fas fa-file-contract"></i>
                                    </a>
                                    <a href="#" class="text-muted" title="Edit Assessment">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                </td>
                            </tr>
                            <tr>
                                <td>

                                    <a href="OrganizationView.html"> Organization Name</a>
                                </td>
                                <td><a href="AssessmentList.html">3</a></td>
                                <td><a href="ContributorsList.html">52</a></td>
                                <td class="text-success">Active</td>

                                <td>
                                    <a href="#" class="text-muted" title="View Report" style="margin-right: 10px">
                                        <i class="fas fa-file-contract"></i>
                                    </a>
                                    <a href="#" class="text-muted" title="Edit Assessment">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                </td>
                            </tr>
                            <tr>
                                <td>

                                    <a href="OrganizationView.html"> Organization Name</a>
                                </td>
                                <td><a href="AssessmentList.html">3</a></td>
                                <td><a href="ContributorsList.html">52</a></td>
                                <td class="text-success">Active</td>

                                <td>
                                    <a href="#" class="text-muted" title="View Report" style="margin-right: 10px">
                                        <i class="fas fa-file-contract"></i>
                                    </a>
                                    <a href="#" class="text-muted" title="Edit Assessment">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                </td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Sales</h3>
                    <a href="javascript:void(0);">View Report</a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">$18,230.00</span>
                        <span>Sales Over Time</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                            <i class="fas fa-arrow-up"></i> 33.1%
                        </span>
                        <span class="text-muted">Since last month</span>
                    </p>
                </div>

                <div class="position-relative mb-4">
                    <canvas id="sales-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
<i class="fas fa-square text-primary"></i> This year
</span>

                    <span>
<i class="fas fa-square text-gray"></i> Last year
</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Assessments Overview</h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-sm btn-tool">
                        <i class="fas fa-download"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-tool">
                        <i class="fas fa-bars"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                    <p class="text-success text-xl">
                        <i class="fas fa-th"></i>
                    </p>
                    <p class="d-flex flex-column text-right">
                        <span class="font-weight-bold">
    <i class="ion ion-android-arrow-up text-success"></i> 12%
</span>
                        <span class="text-muted">ASSESSMENTS RATE</span>
                    </p>
                </div>
                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                    <p class="text-warning text-xl">
                        <i class="fas fa-shopping-cart"></i>
                    </p>
                    <p class="d-flex flex-column text-right">
                        <span class="font-weight-bold">
    <i class="ion ion-android-arrow-up text-warning"></i> 0.8%
</span>
                        <span class="text-muted">SALES RATE</span>
                    </p>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-0">
                    <p class="text-danger text-xl">
                        <i class="fas fa-users"></i>
                    </p>
                    <p class="d-flex flex-column text-right">
                        <span class="font-weight-bold">
    <i class="ion ion-android-arrow-down text-danger"></i> 1%
</span>
                        <span class="text-muted">REGISTRATION RATE</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Assessments Report</h3>
                        <a href="javascript:void(0);">Full Report</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <p class="d-flex flex-column">
                            <span class="text-bold text-lg">820</span>
                            <span>Assessments Over Time</span>
                        </p>
                        <p class="ml-auto d-flex flex-column text-right">
                            <span class="text-success">
      <i class="fas fa-arrow-up"></i> 12.5%
    </span>
                            <span class="text-muted">Since last week</span>
                        </p>
                    </div>

                    <div class="position-relative mb-4">
                        <canvas id="visitors-chart" height="200"></canvas>
                    </div>

                    <div class="d-flex flex-row justify-content-end">
                        <span class="mr-2">
    <i class="fas fa-square text-primary"></i> This Week
  </span>

                        <span>
    <i class="fas fa-square text-gray"></i> Last Week
  </span>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">New Assessments</h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-bars"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th>Assessment</th>
                                <th>Organization</th>
                                <th>Contributors</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                        <td>
                                            <a href="AssessmentView.html"> Assessment Name</a>
                                        </td>
                                        <td><a href="OrganizationView.html">Organization Name</a></td>
                                        <td><a href="ContributorsList.html">52</a></td>
                                        <td>25/05/2019</td>
                                        <td>
                                            <a href="#" class="text-muted" title="View Report" style="margin-right: 10px">
                                                <i class="fas fa-file-contract"></i>
                                            </a>
                                            <a href="#" class="text-muted" title="Edit Assessment">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                        </td>
                                    </tr>
                                    <tr>
                                            <td>
                                                <a href="AssessmentView.html"> Assessment Name</a>
                                            </td>
                                            <td><a href="OrganizationView.html">Organization Name</a></td>
                                            <td><a href="ContributorsList.html">52</a></td>
                                            <td>25/05/2019</td>
                                            <td>
                                                <a href="#" class="text-muted" title="View Report" style="margin-right: 10px">
                                                    <i class="fas fa-file-contract"></i>
                                                </a>
                                                <a href="#" class="text-muted" title="Edit Assessment">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                            </td>
                                        </tr>
                                        <tr>
                                                <td>
                                                    <a href="AssessmentView.html"> Assessment Name</a>
                                                </td>
                                                <td><a href="OrganizationView.html">Organization Name</a></td>
                                                <td><a href="ContributorsList.html">52</a></td>
                                                <td>25/05/2019</td>
                                                <td>
                                                    <a href="#" class="text-muted" title="View Report" style="margin-right: 10px">
                                                        <i class="fas fa-file-contract"></i>
                                                    </a>
                                                    <a href="#" class="text-muted" title="Edit Assessment">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                            <tr>
                                                    <td>
                                                        <a href="AssessmentView.html"> Assessment Name</a>
                                                    </td>
                                                    <td><a href="OrganizationView.html">Organization Name</a></td>
                                                    <td><a href="ContributorsList.html">52</a></td>
                                                    <td>25/05/2019</td>
                                                    <td>
                                                        <a href="#" class="text-muted" title="View Report" style="margin-right: 10px">
                                                            <i class="fas fa-file-contract"></i>
                                                        </a>
                                                        <a href="#" class="text-muted" title="Edit Assessment">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                            <tr>
                                <td>
                                    <a href="AssessmentView.html"> Assessment Name</a>
                                </td>
                                <td><a href="OrganizationView.html">Organization Name</a></td>
                                <td><a href="ContributorsList.html">52</a></td>
                                <td>25/05/2019</td>
                                <td>
                                    <a href="#" class="text-muted" title="View Report" style="margin-right: 10px">
                                        <i class="fas fa-file-contract"></i>
                                    </a>
                                    <a href="#" class="text-muted" title="Edit Assessment">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>

    </div>
 -->
