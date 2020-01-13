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

    <!-- <div class="col-sm-12 text-center assessmentParticipants-preloader preloader" style="display:none">
        <img src="./img/preloader.gif" alt="">
    </div> -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class=" mb-2">
            <div class="">
                <h1 class="m-0 text-dark"><?= Yii::t('backend', 'Dashboard') ?></h1>
            </div>
            <div class='actionBtns'>
                <!-- <a href="/assessment/default/create" class="btn btn-success"><span><i class="fa fa-file-signature mr-2 ml-2"></i> <?= \Yii::t('common', 'Create new survey')?> </span></a> -->
                <a data-toggle="collapse" href="#filterCollapse" role="button" aria-expanded="false" aria-controls="filterCollapse" class="btn btn-info"><span><i class="fa fa-filter mr-2 ml-2"></i> <?= \Yii::t('common', 'Filter Options')?> </span></a>

            </div>
            <!-- <div class="col-sm-6"> -->
                <!-- <a href="NewOrganization.html" class="btn btn-primary" style="float: right">New Organization</a> -->
            <!-- </div> -->
            <!-- /.col -->
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
                            <small class="form-text text-muted">تخصيص لوحة التحكم بالمدة الزمنية المحددة</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?= \Yii::t('common', 'Filter by section')?></label>
                            <input type="text" class="form-control" value="">
                            <small class="form-text text-muted">تخصيص لوحة التحكم حسب قطاع العمل</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?= \Yii::t('common', 'Filter by Tags')?></label>
                            <input type="text" class="form-control" value="">
                            <small class="form-text text-muted">تخصيص لوحة التحكم حسب الوسوم</small>
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
    <?php if(count($contributors->getModels()) == 0 || count($organization->survey) == 0):?>
    <div class="row custom-dashboard text-center">

        <h2><?= Yii::t('common','welcome'); ?></h2>
        <h4><?= Yii::t('common','Before starting the assessments we recommend you do the following') ?></h4>
        <div class='guide'>
        <div class='item'>
            <span><?= $i++ ?></span>
            <h5><?= Yii::t('common','Modify the visual identity of the site to match the visual identity of your organization'); ?></h5>
            <a href="/organization/update" class='btn small thirdBtn'><?= Yii::t('common','Modify basic data'); ?></a>
        </div>
        
        <div class='item'>
            <span><?= $i++ ?></span>
            <h5><?= Yii::t('common','Add assessment contributors from your organization.'); ?></h5>
            <a href="/user/index" class='btn small thirdBtn'><?= Yii::t('common','Add contributors'); ?></a>
        </div>
        <div class='item'>
            <span><?= $i++ ?></span>
            <h5> <?= Yii::t('common','Create the first assessment for your organization'); ?></h5>
            <br>
            <h6>" <?= Yii::t('common','The status of the assessment must be modified from closed to visible so that participants can view the assessment'); ?> "</h6>
            <a href="/assessment/default/create" class='btn small thirdBtn'><?= \Yii::t('common', 'Create new survey')?></a>
        </div>
        </div>
    </div>
    <?php endif; ?>


    <?php if(count($contributors->getModels()) > 0 && count($organization->survey) > 0):?>
    <div>
    <div class="row custom-dashboard">

        

        <!--Countributing in assessments-->
        <div class="col-md-12">
            
            <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title"><?= Yii::t('common','Count Surveys Contributors')?></h3>

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
                <canvas id="assessmentParticipantsChart"  ></canvas>
            </div>
            <!-- /.box-body -->
            </div>
        </div>

        <!--Assessments status-->
        
        

    </div>
        <div class="row custom-dashboard">
            
            <!--Latest assessments-->
            <!-- <div class="col-md-8">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= \Yii::t('common', 'Latest Assessments')?></h3>

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
                    </div>
                    <div class="box-footer text-center">
                    <a href="/assessment" class="uppercase thirdBtn"><?= \Yii::t('common', 'Assessments List') ?></a>
                </div>
                   
                </div>
            </div> -->
            <div class="col-md-6">
            
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('common','Assessments Contributor Status') .' ( '. $countStats .' '. Yii::t('common','status').')' ?></h3>

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
            <!--Latest contributors-->
            <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('common', 'Latest Contributors') ?></h3>

                    <div class="box-tools pull-right">
                    <!-- <span class="label label-danger">8 New Members</span> -->
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
                <!-- /.box-header -->
                <div class="box-body no-padding">
                <ul class="products-list product-list-in-box">
                    <?php foreach($contributors->getModels() as $contributor): ?>
                    <li class="item col-lg-6">
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
                    <a href="/user/index" class="uppercase thirdBtn"><?= Yii::t('common', 'All Contributors') ?></a>
                </div>
                <!-- /.box-footer -->
                </div>
                <!--/.box -->
            </div>
        </div>

       
    </div>
    <?php endif; ?>




<?php
$this->registerJs(<<<JS

$.ajax({
    url: "/site/org-survey-stats",
    type: "GET",
    beforeSend: function () { $('.participantsStatus-preloader').show()},
    complete: function () { },
    success: res => {
        var ctx = document.getElementById('participantsStatusChart').getContext('2d');
        var chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: res.data,
                backgroundColor: [
                    "#2ecc71",
                    "#f39c12",
                    "#22CECE"
                ],
            }],
            labels: res.labels
        },
        options: {
            responsive: true,
            legend: {
                display: false
            },
            // tooltips: {
            //     callbacks: {
            //       label: function(tooltipItem) {
            //         console.log(tooltipItem)
            //             return tooltipItem.yLabel;
            //         }
            //   }
            // }
        }
        });
        $('.participantsStatus-preloader').hide()
    },
    error: function (err) {
        console.log(err);
        $('.participantsStatus-preloader').hide()
    }
    });

var primcolor= $("body").attr("data-Primcolor")

    $.ajax({
    url: "/site/org-survey",
    type: "GET",
    beforeSend: function () { $('.assessmentParticipants-preloader').show()},
    complete: function () { },
    success: res => {
        $('.assessmentParticipants-preloader').hide()
        var ctx = document.getElementById('assessmentParticipantsChart').getContext('2d');
        var chart = new Chart(ctx, {


            
            type: 'line',
            data: {
                labels: res.labels,
                datasets: [{
                    label: 'عدد المشاركين في الإستبيان',
                    data: res.data,
                    backgroundColor     : 'transparent',
                    borderColor         : primcolor,
                    pointBorderColor    : primcolor,
                    pointBackgroundColor: primcolor,
                    // backgroundColor: [
                    //     'rgba(255, 99, 132, 0.2)',

                    //     // '#16a085',
                    //     // '#e67e22',
                    //     // '#2c3e50',
                    //     // '#2980b9',
                    //     // '#c0392b',
                    //     // '#27ae60',
                    //     // '#f39c12'
                    // ],
                    // borderColor: [
                    //     'rgba(255, 99, 132, 1)',
                    //     'rgba(54, 162, 235, 1)',
                    //     'rgba(255, 206, 86, 1)',
                    //     'rgba(75, 192, 192, 1)',
                    //     'rgba(153, 102, 255, 1)',
                    //     'rgba(153, 102, 255, 1)',
                    //     'rgba(255, 159, 64, 1)'
                    // ],
                   // borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                
                tooltips: {
                mode: "index",
                intersect: false
                },
                hover: {
                mode: "nearest",
                intersect: true
                },
                legend: {
                labels: {
                    // This more specific font property overrides the global property
                    // fontColor: '#ccc'
                }
                },
                scales: {
                    xAxes: [
                        {
                        display: true,
                        scaleLabel: {
                            display: false,
                        },
                        ticks: {
                            beginAtZero: true,
                            //fontColor: '#ccc'
                        }
                        }
                    ],
                    yAxes: [
                        {
                        display: true,
                        scaleLabel: {
                            display: false
                        },
                        ticks: {
                            beginAtZero: true,
                            //fontColor: '#ccc'
                        },
                        }
                    ]
                },
            }
        }); 
        
    },
    error: function (err) {
        console.log(err);
        $('.assessmentParticipants-preloader').hide()
    }
    });

      

JS
);

?>

