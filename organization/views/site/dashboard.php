<?php

use common\helpers\Filter;
use common\models\OrganizationStructure;
use common\models\base\Tag;
use kartik\select2\Select2;
use kartik\tree\TreeViewInput;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = Yii::t('backend', 'Dashboard');
\organization\assets\DashboardAsset::register($this);

$i = 1;
?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class=" mb-2">
            <div class="">
                <h1 class="m-0 text-dark"><?= Yii::t('backend', 'Dashboard') ?></h1>
            </div>
            <div class='actionBtns'>
                <a href="/assessment/default/create" class="btn btn-success"><span><i class="fa fa-file-signature mr-2 ml-2"></i> <?= \Yii::t('common', 'Create new survey')?> </span></a>
                <a data-toggle="collapse" href="#filterCollapse" role="button" aria-expanded="false" aria-controls="filterCollapse" class="btn btn-info"><span><i class="fa fa-filter mr-2 ml-2"></i> <?= \Yii::t('common', 'Filter Options')?> </span></a>

            </div>
        </div>
    </div>
    <div class="collapse <?php if(isset($_GET['date']) || isset($_GET['SurveySearch']['sector_id'])
            || isset($_GET['SurveySearch']['tags'])
        ) echo 'in' ;?>" id="filterCollapse">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-filter fa-xs"></i> <?= \Yii::t('common', 'Dashboard Filter')?></h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <?php if(count($contributors->getModels()) == 0 and count($organization->survey) == 0):?>
                    <div class="col-md-12">
                        <div class="alert alert-warning">
                            <p><?= Yii::t('common','No data can be displayed, please use other entries!') ?></p>
                        </div>
                    </div>
                    <?php endif;?>
                    <form method="GET">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><?= \Yii::t('common', 'Filter by time')?></label>
                                <select class="form-control" name="date">
                                <option value=""><?= Yii::t('backend','All');  ?></option>
                                <option value="dateCurrentDay" <?php if($_GET['date'] == 'dateCurrentDay') echo "selected"; ;?> >
                                    <?= Yii::t('common','Current Day')?>
                                </option>
                                <option value="dateLastDay" <?php if($_GET['date'] == 'dateLastDay') echo "selected"; ;?>>
                                    <?= Yii::t('common','Last Day')?>
                                </option>
                                <option value="dateCurrentWeek" <?php if($_GET['date'] == 'dateCurrentWeek') echo "selected"; ;?>>
                                    <?= Yii::t('common','Current Week')?>
                                </option>
                                <option value="dateLastWeek" <?php if($_GET['date'] == 'dateLastWeek') echo "selected"; ;?>>
                                    <?= Yii::t('common','Last Week')?>
                                </option>
                                <option value="dateCurrentMonth" <?php if($_GET['date'] == 'dateCurrentMonth') echo "selected"; ;?>>
                                    <?= Yii::t('common','Current Month')?>
                                </option>
                                <option value="dateLastMonth" <?php if($_GET['date'] == 'dateLastMonth') echo "selected"; ;?>>
                                    <?= Yii::t('common','Last Month')?>
                                </option>
                                <option value="dateCurrentYear" <?php if($_GET['date'] == 'dateCurrentYear') echo "selected"; ;?>>
                                    <?= Yii::t('common','Current Year')?>
                                </option>
                                <option value="dateLastYear" <?php if($_GET['date'] == 'dateLastYear') echo "selected"; ;?>>
                                    <?= Yii::t('common','Last Year')?>
                                </option>
                            </select>
                            <small class="form-text text-muted"><?= \Yii::t('common', 'Filter the dashboard by time.')?></small>
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
                                <small class="form-text text-muted"><?= Yii::t('common','Filter By Business Sector') ?></small>
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
                                <small class="form-text text-muted"><?= Yii::t('common','Filter By Tags') ?></small>
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
    <?php if( (count($contributors->getModels()) == 0 || count($organization->survey) == 0 || $organization->countOrganizationStructure() == 0) and (empty($_GET['date']) and  empty($_GET['SurveySearch']['sector_id']) and  empty($_GET['SurveySearch']['tags'])  ) ):?>
    <div class="row custom-dashboard text-center">

        <h2><?= Yii::t('common','welcome'); ?></h2>
        <h4><?= Yii::t('common','Before starting the assessments we recommend you do the following') ?></h4>
        <div class='guide'>
        <div class='item'>
            <span><?= $i++ ?></span>
            <h5><?= Yii::t('common','Modify the visual identity of the site to match the visual identity of your organization'); ?></h5>
            <a href="/organization/update" class='btn small thirdBtn'><?= Yii::t('common','Modify basic data'); ?></a>
        </div>
        <?php if($organization->countOrganizationStructure() == 0):?>
        <div class='item'>
            <span><?= $i++ ?></span>
            <h5><?= Yii::t('common','Add Your organization structure.'); ?></h5>
            <a href="/organization-structure" class='btn small thirdBtn'><?= Yii::t('common','Create new structure'); ?></a>
        </div>
        <?php endif;?>
        <?php if(count($contributors->getModels()) == 0):?>
        <div class='item'>
            <span><?= $i++ ?></span>
            <h5><?= Yii::t('common','Add assessment contributors from your organization.'); ?></h5>
            <a href="/user/index?user_role=user" class='btn small thirdBtn'><?= Yii::t('common','Add contributors'); ?></a>
        </div>
        <?php endif;?>
        <?php if(count($organization->survey) == 0):?>
        <div class='item'>
            <span><?= $i++ ?></span>
            <h5> <?= Yii::t('common','Create the first assessment for your organization'); ?></h5>
            <br>
            <h6>" <?= Yii::t('common','The status of the assessment must be modified from closed to visible so that participants can view the assessment'); ?> "</h6>
            <a href="/assessment/default/create" class='btn small thirdBtn'><?= \Yii::t('common', 'Create new survey')?></a>
        </div>
        <?php endif;?>
        </div>
    </div>
    <?php endif; ?>


    <div>
    <div class="row custom-dashboard">

        <!--Countributing in assessments-->
        <?php if(count($contributors->getModels()) > 0 and count($organization->survey) > 0):?>

        <div class="col-md-6">

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
        <?php endif;?>

        <!--Assessments status-->
        <?php if(count($contributors->getModels()) > 0 and count($organization->survey) > 0):?>
        <div class="col-md-6">

            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('common','Assessments Contributor Status') .' ( '. $orgSurveyStats['countStats'] .' '. Yii::t('common','status').')' ?></h3>
                </div>
                <div class="box-body">
                    <canvas id="participantsStatusChart"  height="150" width="475"></canvas>
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
        <?php endif;?>

    </div>
        <div class="row custom-dashboard">
            <?php if(count($contributors->getModels()) > 0):?>
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
            <?php endif;?>
            
            <?php if(count($organization->survey) > 0 and count($organizationLastSurveys) > 0 ):?>
            <!--Latest assessments-->
            <div class="col-md-6">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= \Yii::t('common', 'Latest Assessments')?></h3>
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
                                    foreach($organizationLastSurveys as $survey):
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
                                    <td><?= $survey->stats ? count($survey->stats) : 0 ?></td>
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
            </div>
            <?php endif;?>
        </div>


    </div>




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

