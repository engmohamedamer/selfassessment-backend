<?php

use organization\models\Schools;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = Yii::t('backend', 'Dashboard');
\organization\assets\DashboardAsset::register($this);

$i = 1;
?>

<div class="col-sm-12 text-center assessmentParticipants-preloader preloader" style="display:none">
                <img src="./img/preloader.gif" alt="">
            </div>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
            <div class="col-md-6">
                <h1 class="m-0 text-dark"><?= Yii::t('backend', 'Dashboard') ?></h1>
            </div>
            <div class='col-md-6 actionBtns'>
                <a href="/assessment/default/create" class="btn btn-primary"><span><i class="fa fa-file-signature mr-2 ml-2"></i> <?= \Yii::t('common', 'Create new survey')?> </span></a>
            </div>
            <!-- <div class="col-sm-6"> -->
                <!-- <a href="NewOrganization.html" class="btn btn-primary" style="float: right">New Organization</a> -->
            <!-- </div> -->
            <!-- /.col -->
        </div>
    </div>
    <?php if(count($contributors->getModels()) == 0 || count($organization->survey) == 0):?>
    <div class="row custom-dashboard text-center">

        <h2><?= Yii::t('common','welcome'); ?></h2>
        <h4><?= Yii::t('common','Before starting the assessments we recommend you do the following') ?></h4>
        <div class='guide'>
            <span><?= $i++ ?></span>
            <h5><?= Yii::t('common','Modify the visual identity of the site to match the visual identity of your organization'); ?></h5>
            <a href="/organization/update" class='btn small btn-primary'><?= Yii::t('common','Modify basic data'); ?></a>
        </div>
        
        <div class='guide'>
            <span><?= $i++ ?></span>
            <h5><?= Yii::t('common','Add assessment contributors from your organization.'); ?></h5>
            <a href="/user/index" class='btn small btn-primary'><?= Yii::t('common','Add contributors'); ?></a>
        </div>
        <div class='guide'>
            <span><?= $i++ ?></span>
            <h5> <?= Yii::t('common','Create the first assessment for your organization'); ?></h5>
            <br>
            <h6>" <?= Yii::t('common','The status of the assessment must be modified from closed to visible so that participants can view the assessment'); ?> "</h6>
            <a href="/assessment/default/create" class='btn small btn-primary'><?= \Yii::t('common', 'Create new survey')?></a>
        </div>
    </div>
    <?php endif; ?>


    <?php if(count($contributors->getModels()) > 0 && count($organization->survey) > 0):?>
    <div>
    <div class="row custom-dashboard">

        <!--Countributing in assessments-->
        <div class="col-md-8">
            
            <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title"><?= Yii::t('common','Count Surveys Contributors')?></h3>

                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                </div>
            </div>
            <div class="box-body">
                <canvas id="assessmentParticipantsChart"  ></canvas>
            </div>
            <!-- /.box-body -->
            </div>
        </div>
        <!--Assessments status-->
        <div class="col-md-4">
            
            <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title"><?= Yii::t('common','Assessments Status') ?></h3>

                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                </div>
            </div>
            <div class="box-body">
                <canvas id="participantsStatusChart" style="height: 237px; width: 475px;" height="237" width="475"></canvas>
                <ul class="chart-legend clearfix" style="    margin: 20px;">
                    <li><i class="fa fa-circle-o" style="color: #2ecc71;"></i> <?= $orgSurveyStats['labels'][0] ?> (<?= $orgSurveyStats['data'][0] ?>)</li>
                    <li>&nbsp;</li>
                    <li><i class="fa fa-circle-o" style="color: #f39c12;"></i></i> <?= $orgSurveyStats['labels'][1] ?> (<?= $orgSurveyStats['data'][1] ?>)</li>
                    <li>&nbsp;</li>
                    <li><i class="fa fa-circle-o" style="color: #22cece;"></i></i> <?= $orgSurveyStats['labels'][2] ?> (<?= $orgSurveyStats['data'][2] ?>)</li>
                  </ul>
            </div>
            <!-- /.box-body -->
            </div>
        </div>

    </div>
        <div class="row custom-dashboard">
            <!--Latest contributors-->
            <div class="col-md-4">
                <!-- USERS LIST -->
                <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('common', 'Latest Contributors') ?></h3>

                    <div class="box-tools pull-right">
                    <!-- <span class="label label-danger">8 New Members</span> -->
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                   
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                <ul class="products-list product-list-in-box">
                    <?php foreach($contributors->getModels() as $contributor): ?>
                    <li class="item">
                        <div class="product-img">
                            <?php if($contributor->userProfile->avatar != null):?>
                                <img src="<?= $contributor->userProfile->avatar ?>" alt="<?= $contributor->userProfile->fullname ?>">
                            <?php else:?>    
                                <img alt="<?= $contributor->userProfile->fullname ?>" avatar="<?= $contributor->userProfile->fullname ?>">
                            <?php endif;?>    
                        </div>
                        <div class="product-info">
                            <a class="product-title" href="/user/view?id=<?= $contributor->id ?>"><?= $contributor->userProfile->fullname ?>
                            
                            </a>
                            <span class="product-description">
                            <?= date('Y-m-d',$contributor->created_at) ?>
                                </span>
                        </div>
                    </li>
                    <?php endforeach; ?>
                    <!-- /.item -->
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
            <!--Latest assessments-->
            <div class="col-md-8">
                <!-- TABLE: LATEST ORDERS -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= \Yii::t('common', 'Latest Assessments')?></h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
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
                                    <th><?= \Yii::t('common', 'Contributors Count')?></th>
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
                                    <td><?= count($survey->stats) ?></td>
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
                    <div class="box-footer text-center">
                    <a href="/assessment" class="uppercase"><?= \Yii::t('common', 'Assessments List') ?></a>
                </div>
                   
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
        </div>

       
    </div>
    <?php endif; ?>




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
