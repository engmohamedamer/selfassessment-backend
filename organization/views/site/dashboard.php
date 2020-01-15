<?php

use common\helpers\Filter;
use common\models\OrganizationStructure;
use common\models\base\Tag;
use kartik\select2\Select2;
use kartik\tree\TreeViewInput;
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
                    <form method="GET">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?= \Yii::t('common', 'Filter by time')?></label>
                                <select class="form-control" name="date">
                                    <option value=""><?= Yii::t('backend','All');  ?></option>
                                    <option value="dateCurrentDay" <?php if($_GET['date'] == 'dateCurrentDay') echo "selected"; ;?> >اليوم</option>
                                    <option value="dateLastDay" <?php if($_GET['date'] == 'dateLastDay') echo "selected"; ;?>>اليوم السابق</option>
                                    <option value="dateCurrentWeek" <?php if($_GET['date'] == 'dateCurrentWeek') echo "selected"; ;?>>الاسبوع الحالي</option>
                                    <option value="dateLastWeek" <?php if($_GET['date'] == 'dateLastWeek') echo "selected"; ;?>>الاسبوع السابق</option>
                                    <option value="dateCurrentMonth" <?php if($_GET['date'] == 'dateCurrentMonth') echo "selected"; ;?>>الشهر الحالي</option>
                                    <option value="dateLastMonth" <?php if($_GET['date'] == 'dateLastMonth') echo "selected"; ;?>>الشهر السابق</option>
                                    <option value="dateCurrentYear" <?php if($_GET['date'] == 'dateCurrentYear') echo "selected"; ;?>>السنة الحالية</option>
                                    <option value="dateLastYear" <?php if($_GET['date'] == 'dateLastYear') echo "selected"; ;?>>السنة السابقة</option>
                                </select>
                                <small class="form-text text-muted">بحث الإستبيانات بالمدة الزمنية المحددة</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?= \Yii::t('common', 'Search by section')?></label>
                                <?php 
                                    echo TreeViewInput::widget([
                                        // single query fetch to render the tree
                                        // use the Product model you have in the previous step
                                        'query' => Filter::organizationStructureQuery(), 
                                        'headingOptions'=>['label'=>'Categories'],
                                        'value' => $_GET['SurveySearch']['sector_id'],     // values selected (comma separated for multiple select)
                                        'name' => 'SurveySearch[sector_id]', // input name
                                        'asDropdown' => true,   // will render the tree input widget as a dropdown.
                                        'multiple' => false,     // set to false if you do not need multiple selection
                                        'fontAwesome' => true,  // render font awesome icons
                                        'rootOptions' => [
                                            'label'=>'<i class="fa fa-tree"></i>',  // custom root label
                                            'class'=>'text-success'
                                        ],
                                    ]);
                                ?>
                                <small class="form-text text-muted">بحث الإستبيانات حسب قطاع العمل</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?= \Yii::t('common', 'Search by Tags')?></label>
                                <?php
                                    $tags = \yii\helpers\ArrayHelper::map(Tag::find()->all(), 'id', 'name');
                                    echo Select2::widget([
                                        'name' => 'SurveySearch[tags]',
                                        'value' => $_GET['SurveySearch']['tags'], // initial value
                                        'data' => $tags,
                                        'options' => [
                                            'placeholder' => Yii::t('common', 'Search by Tags'),
                                            'multiple' => true
                                        ],
                                    ]);
                                ?>
                                <small class="form-text text-muted">بحث الإستبيانات حسب الوسوم</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                
                                <button class="btn btn-success" style="margin-top: 32px;"><?= \Yii::t('common', 'Advanced Search')?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    <?php if( (count($contributors->getModels()) == 0 || count($organization->survey) == 0) and (empty($_GET['date']) and  empty($_GET['SurveySearch']['sector_id']) and  empty($_GET['SurveySearch']['tags'])  ) ):?>
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
            </div>
            <div class="box-body">
                <canvas id="assessmentParticipantsChart"></canvas>
            </div>
            <!-- /.box-body -->
            </div>
        </div>

        <!--Assessments status-->
        
        

    </div>
        <div class="row custom-dashboard">
            
            <div class="col-md-6">
            
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('common','Assessments Contributor Status') .' ( '. $orgSurveyStats['countStats'] .' '. Yii::t('common','status').')' ?></h3>
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

$surveyChartLabels = json_encode($surveyChart['labels']);
$surveyChartDate = json_encode($surveyChart['data']);

$orgSurveyStatsLabels = json_encode($orgSurveyStats['labels']);
$orgSurveyStatsData = json_encode($orgSurveyStats['data']);
$this->registerJs(<<<JS


var ctx = document.getElementById('participantsStatusChart').getContext('2d');
var chart = new Chart(ctx, {
type: 'doughnut',
data: {
    datasets: [{
        data: $orgSurveyStatsData,
        backgroundColor: [
            "#2ecc71",
            "#f39c12",
            "#22CECE"
        ],
    }],
    labels: $orgSurveyStatsLabels
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
       

var primcolor= $("body").attr("data-Primcolor")
var ctx = document.getElementById('assessmentParticipantsChart').getContext('2d');
var chart = new Chart(ctx, {  
    type: 'line',
    data: {
        labels: $surveyChartLabels,
        datasets: [{
            label: 'عدد المشاركين في الإستبيان',
            data: $surveyChartDate,
            backgroundColor     : 'transparent',
            borderColor         : primcolor,
            pointBorderColor    : primcolor,
            pointBackgroundColor: primcolor,
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

      

JS
);

?>

