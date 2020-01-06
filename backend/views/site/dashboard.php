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
            <a href="/organization/create" class="btn btn-success"><i class="icofont-plus"></i><?= Yii::t('backend','New Organization') ?> </a>
            <a data-toggle="collapse" href="#filterCollapse" role="button" aria-expanded="false" aria-controls="filterCollapse" class="btn btn-info"><span><i class="fa fa-filter mr-2 ml-2"></i> <?= \Yii::t('common', 'Filter Options')?> </span></a>

        </div>
 
    </div>

</div>
<div class="collapse" id="filterCollapse">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-filter fa-xs"></i> <?= \Yii::t('common', 'Dashboard Filter')?></h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?= \Yii::t('common', 'Filter by time')?></label>
                            <select class="form-control">
                                <option>اليوم</option>
                                <option>اليوم السابق</option>
                                <option>الاسبوع الحالي</option>
                                <option>الاسبوع السابق</option>
                                <option>الشهر الحالي</option>
                                <option>الشهر السابق</option>
                                <option>السنة الحالية</option>
                                <option>السنة السابقة</option>
                            </select>
                            <small class="form-text text-muted"><?= \Yii::t('common', 'Filter the dashboard by time.')?></small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?= \Yii::t('common', 'Filter by organizations')?></label>
                            <input type="text" class="form-control" value="">
                            <small class="form-text text-muted"><?= \Yii::t('common', 'Filter the dashboard by organization.')?></small>
                        </div>
                    </div>
                   
                    <div class="col-md-3">
                        <div class="form-group">
                            
                            <button class="btn btn-success" style="margin-top: 32px;"><?= \Yii::t('common', 'Filter')?></button>
                        </div>
                    </div>
                </div>
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
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title"><?= Yii::t('backend','Contributing Report') ?></h3>
                <div class="box-tools pull-right">
                    <div class="dropdown">
                        <button class="btn btn-box-tool dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-cogs"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">اليوم</a>
                            <a class="dropdown-item" href="#">اليوم السابق</a>
                            <a class="dropdown-item" href="#">الاسبوع الحالي</a>
                            <a class="dropdown-item" href="#">الاسبوع السابق</a>
                            <a class="dropdown-item" href="#">الشهر الحالي</a>
                            <a class="dropdown-item" href="#">الشهر السابق</a>
                            <a class="dropdown-item" href="#">السنة الحالية</a>
                            <a class="dropdown-item" href="#">السنة السابقة</a>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="box-body">
                <canvas id="visitors-chart" style="height: 237px" height="237" ></canvas>
            
                <!-- <div class="d-flex flex-row justify-content-end">
                    
                </div> -->
            </div>
            <div class="box-footer text-center">
            <span class="mr-5 ml-5">
                        <i class="fas fa-square text-primary"></i> <?= Yii::t('backend','Contributors Count') ?>
                    </span>

                    <span class="mr-5 ml-5">
                        <i class="fas fa-square text-gray"></i> <?= Yii::t('backend','Contributing Count') ?>
                    </span>
            </div>
        <!-- /.box-body -->
        </div>  
        
    </div>
</div>



<div class="row">
    <div class="col-sm-12">
        <div class="box box-dark">
            <div class="box-header with-border">
                <h3 class="box-title"><?= Yii::t('common','New Organizations') ?></h3>
                <div class="box-tools pull-right">
                    <div class="dropdown">
                        <button class="btn btn-box-tool dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-cogs"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">اليوم</a>
                            <a class="dropdown-item" href="#">اليوم السابق</a>
                            <a class="dropdown-item" href="#">الاسبوع الحالي</a>
                            <a class="dropdown-item" href="#">الاسبوع السابق</a>
                            <a class="dropdown-item" href="#">الشهر الحالي</a>
                            <a class="dropdown-item" href="#">الشهر السابق</a>
                            <a class="dropdown-item" href="#">السنة الحالية</a>
                            <a class="dropdown-item" href="#">السنة السابقة</a>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="box-body">
                <div class="table-responsive">
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

