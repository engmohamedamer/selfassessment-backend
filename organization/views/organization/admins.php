<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Organization */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common', 'Organization'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <div class="content-header">
        <div class="">
            <div class="">
                <h1 class="m-0 text-dark">
                    <?= Yii::t('common','Organization Admins List')?>
                </h1>
            </div>
            <div class=" actionBtns">
                <a href="/user/create" class="btn btn btn-primary"><i class="icofont-plus mr-2 ml-2"></i> إضافة مسئول</a>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="kv-grid-demo-pjax" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000">
                        <div class="kv-loader-overlay">
                            <div class="kv-loader"></div>
                        </div>
                        <div id="kv-grid-demo" class="grid-view is-bs3 hide-resize" data-krajee-grid="kvGridInit_ad27e77b" data-krajee-ps="ps_kv_grid_demo_container">
                            <div class="summary">مجموع <b>٤</b> مُدخلات.</div>
                            <div id="kv-grid-demo-container" class="table-responsive kv-grid-container" style="overflow: auto">
                                <table class="kv-grid-table table table-bordered table-striped kv-table-wrap">
                                    <thead>

                                        <tr class="kartik-sheet-style">
                                            <th style="width: 3.32%;">#</th>
                                            <th data-col-seq="1" style="width: 14%;">اسم المسئول</th>
                                            <th data-col-seq="2" style="width: 24.27%;"><a href="/user/index?sort=email" data-sort="email">البريد اﻻلكترونى</a></th>
                                            <th style="width: 16.39%;"><a href="/user/index?sort=status" data-sort="status">القطاع</a></th>
                                            <th style="width: 16.39%;"><a href="/user/index?sort=status" data-sort="status">الأدارة</a></th>
                                            <th data-col-seq="4" style="width: 18.46%;"><a href="/user/index?sort=updated_at" data-sort="updated_at">القسم</a></th>
                                            <th data-col-seq="5" style="width: 17.53%;"><a href="/user/index?sort=logged_at" data-sort="logged_at">الحالة</a></th>
                                            <th class="kv-align-center kv-align-middle skip-export kv-merged-header" style="width: 6.02%;" rowspan="2" data-col-seq="6">خيارات</th>
                                        </tr>
                                        <tr id="kv-grid-demo-filters" class="kartik-sheet-style skip-export">
                                            <td>&nbsp;</td>
                                            <td><select id="usersearch-searchfullname" class="form-control select2-hidden-accessible" name="UserSearch[SearchFullName]" data-s2-options="s2options_d6851687" data-krajee-select2="select2_9b4a981a" style="display:none"
                                                    data-select2-id="usersearch-searchfullname" tabindex="-1" aria-hidden="true">
<option value="" data-select2-id="2">ابحث هنا</option>
</select><span class="select2 select2-container select2-container--krajee" dir="ltr" data-select2-id="1" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-usersearch-searchfullname-container"><span class="select2-selection__rendered" id="select2-usersearch-searchfullname-container" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">ابحث هنا</span></span>
                                                <span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                                </span>
                                                </span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                            </td>
                                            <td><input type="text" id="usersearch-email" class="form-control" name="UserSearch[email]" placeholder="ابحث هنا"></td>
                                            <td><select class="form-control" name="UserSearch[status]">
                                                <option value=""></option>
                                                <option value="2">مفعل</option>
                                                <option value="1">غير مفعل</option>
                                                <option value="3">محذوف</option>
                                                </select></td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <tr class="kv-grid-demo" data-key="37">
                                            <td>1</td>
                                            <td class="kv-grid-demo" data-col-seq="1"><a href="/user/view?id=37" target="_blank">فؤاد عباس</a></td>
                                            <td class="kv-grid-demo" data-col-seq="2"><a href="mailto:org@orscsgdhgg.com">org@orscsgdhgg.com</a></td>
                                            <td>قطاع الأعمال</td>
                                            <td>الأدارة المالية</td>
                                            <td>قسم الحسابات العامة</td>
                                            <td>مفعل</td>
                                            <td class="skip-export kv-align-center kv-align-middle kv-grid-demo" style="width:50px;" data-col-seq="6"><a href="/user/view?id=37" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a><a href="/user/update?id=37" title="Update" aria-label="Update"
                                                    data-pjax="0"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                                        </tr>
                                        <tr class="kv-grid-demo" data-key="31">
                                            <td>2</td>
                                            <td class="kv-grid-demo" data-col-seq="1"><a href="/user/view?id=31" target="_blank">WorcBox حسن</a></td>
                                            <td class="kv-grid-demo" data-col-seq="2"><a href="mailto:dfghjk@fghjkl.com">dfghjk@fghjkl.com</a></td>
                                            <td>قطاع الأعمال</td>
                                            <td>الأدارة المالية</td>
                                            <td>قسم الحسابات العامة</td>
                                            <td>مفعل</td>
                                            <td class="skip-export kv-align-center kv-align-middle kv-grid-demo" style="width:50px;" data-col-seq="6"><a href="/user/view?id=31" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a><a href="/user/update?id=31" title="Update" aria-label="Update"
                                                    data-pjax="0"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                                        </tr>
                                        <tr class="kv-grid-demo" data-key="30">
                                            <td>3</td>
                                            <td class="kv-grid-demo" data-col-seq="1"><a href="/user/view?id=30" target="_blank">test last</a></td>
                                            <td class="kv-grid-demo" data-col-seq="2"><a href="mailto:test@test.com">test@test.com</a></td>
                                            <td>قطاع الأعمال</td>
                                            <td>الأدارة المالية</td>
                                            <td>قسم الحسابات العامة</td>
                                            <td>مفعل</td>
                                            <td class="skip-export kv-align-center kv-align-middle kv-grid-demo" style="width:50px;" data-col-seq="6"><a href="/user/view?id=30" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a><a href="/user/update?id=30" title="Update" aria-label="Update"
                                                    data-pjax="0"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                                        </tr>
                                        <tr class="kv-grid-demo" data-key="28">
                                            <td>4</td>
                                            <td class="kv-grid-demo" data-col-seq="1"><a href="/user/view?id=28" target="_blank">Abas Fawzy</a></td>
                                            <td class="kv-grid-demo" data-col-seq="2"><a href="mailto:cont@org.com">cont@org.com</a></td>
                                            <td>قطاع الأعمال</td>
                                            <td>الأدارة المالية</td>
                                            <td>قسم الحسابات العامة</td>
                                            <td>مفعل</td>
                                            <td class="skip-export kv-align-center kv-align-middle kv-grid-demo" style="width:50px;" data-col-seq="6"><a href="/user/view?id=28" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a><a href="/user/update?id=28" title="Update" aria-label="Update"
                                                    data-pjax="0"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>