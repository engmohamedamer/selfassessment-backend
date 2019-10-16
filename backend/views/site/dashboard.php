<?php

use backend\models\Schools;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = Yii::t('backend', 'Dashboard'); 
\backend\assets\DashboardAsset::register($this);
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
        </div>
        <div class="col-sm-6">
            <!-- <a href="NewOrganization.html" class="btn btn-primary" style="float: right">New Organization</a> -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.content-header -->

<div class="row">
    <div class="col-lg-6">
       <?/*?>
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
                <!-- /.d-flex -->

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

    <? */?>
        <!-- /.card -->

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
        <!-- /.card -->
    </div>
    <? /*?>
    <!-- /.col-md-6 -->
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
                <!-- /.d-flex -->

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
        <!-- /.card -->

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
                <!-- /.d-flex -->
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
                <!-- /.d-flex -->
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
                <!-- /.d-flex -->
            </div>
        </div>
    </div>
    <!-- /.col-md-6 -->
    <? */?>
</div>
<? /*?>
<!-- /.row -->
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
                    <!-- /.d-flex -->

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
            <!-- /.card -->

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
            <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->

        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->

<? */?>