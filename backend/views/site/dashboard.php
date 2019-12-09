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
    <div class="">
        <div class="">
            <h1 class=" m-0 text-dark"><?= Yii::t('backend','Dashboard') ?></h1>
        </div>
        <div class=" actionBtns">
            <a href="/organization/create" class="btn btn-primary"><i class="icofont-ui-add mr-2 ml-2"></i><?= Yii::t('backend','New Organization') ?> </a>
        </div>
 
    </div>

</div>
<!-- /.content-header -->
<div class="row">
    <div class="col-sm-12 col-md-4">

            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="icofont-list"></i></span>

                <div class="info-box-content">
                <span class="info-box-number"><?= $surveyCount?></span>
                <span class="info-box-text"><?= Yii::t('backend','Assessments Count') ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="icofont-files-stack"></i></span>

            <div class="info-box-content">
            <span class="info-box-number"><?= $surveyStatsCount ?></span>
            <span class="info-box-text"><?= Yii::t('backend','Contributing Count') ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
                
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="icofont-ui-user-group"></i></span>

            <div class="info-box-content">
            <span class="info-box-number"><?= $userCount ?></span>
            <span class="info-box-text"><?= Yii::t('backend','Contributors Count') ?></span>
            </div>
            <!-- /.info-box-content -->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
      
        <div class="box box-dark">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title"><?= Yii::t('backend','Contributing Report') ?></h3>
                </div>
            </div>
            <div class="card-body">
                
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                    <canvas id="visitors-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                    <span class="mr-5 ml-5">
                        <i class="fas fa-square text-primary"></i> <?= Yii::t('backend','Contributors Count') ?>
                    </span>

                    <span class="mr-5 ml-5">
                        <i class="fas fa-square text-gray"></i> <?= Yii::t('backend','Contributing Count') ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-sm-12">
        <div class="box box-dark">
            <div class="card-header border-0">
                <h3 class="card-title"><?= Yii::t('common','New Organizations') ?></h3>

            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><?= Yii::t('common','Name') ?></th>
                            <th><?= Yii::t('common','Assessments')?></th>
                            <th><?= Yii::t('common','Contributors')?></th>
                            <th><?= Yii::t('common','Surveys Contributors')?></th>
                            <th><?= Yii::t('common','Status') ?></th>
                            <th><?= Yii::t('common','Actions') ?></th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php foreach($organizations as $organization):?>
                            <tr>
                                <td>
                                    
                                    <a href="#"><?= $organization->name ?></a>
                                </td>
                                <td><a href="#"><?= count($organization->survey) ?></a></td>
                                <td><a href="#"><?= $organization->countUsers() ?></a></td>
                                <td><a href="#"><?= $organization->startSurvey() ?></a></td>
                                <td class="text-success"><?= $organization->status()[$organization->status] ?></td>

                                <td>
                                    <a href="/organization/view?id=<?= $organization->id ?>" class="text-muted newOrgsActions" title="View Report" style="margin-right: 10px">
                                        <i class="fas fa-file-contract"></i>
                                    </a>
                                    <a href="/organization/update?id=<?= $organization->id ?>" class="text-muted newOrgsActions" title="Edit Assessment">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
            </div>
        </div>
        <!-- /.card -->  
    </div>
    
    <!-- /.col-md-6 -->
</div>
   
    

<!-- /.row -->

<?php

$l = json_encode($labels);
$d1 = json_encode($data1);
$d2 = json_encode($data2);
$js = <<<JS
$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true
    var Charts = $('#visitors-chart')
  var visitorsChart  = new Chart(Charts, {
    data   : {
      labels  : $l,
      datasets: [{
        type                : 'line',
        data                : $d1,
        backgroundColor     : 'transparent',
        borderColor         : '#007bff',
        pointBorderColor    : '#007bff',
        pointBackgroundColor: '#007bff',
        fill                : false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },
        {
          type                : 'line',
          data                : $d2,
          backgroundColor     : 'tansparent',
          borderColor         : '#ced4da',
          pointBorderColor    : '#ced4da',
          pointBackgroundColor: '#ced4da',
          fill                : false
          // pointHoverBackgroundColor: '#ced4da',
          // pointHoverBorderColor    : '#ced4da'
        }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero : true,
            suggestedMax: 200
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
})
JS;
$this->registerJs($js);

?>

