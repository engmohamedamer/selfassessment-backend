<style>
.sectionClass {
    position: relative;
    display: block;
}
#projectFacts .fullWidth {
    padding: 0;
}
.fullWidth {
    width: 100% !important;
    display: table;
    float: none;
    padding: 0;
    min-height: 1px;
    height: 100%;
    position: relative;
}
.projectFactsWrap {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -ms-flex-direction: row;
    flex-direction: row;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}
.projectFactsWrap .item {
    width: 25%;
    height: 100%;
    padding: 50px 0px;
    text-align: center;
}
.projectFactsWrap .item:nth-child(1) {
    background: #101f2e;
}
.projectFactsWrap .item:nth-child(2) {
    background: #122233;
}
.projectFactsWrap .item:nth-child(3) {
    background: #152638;
}
.projectFactsWrap .item:nth-child(4) {
    background: #172c42;
}
.projectFactsWrap .item i {
    vertical-align: middle;
    font-size: 50px;
    color: rgba(255, 255, 255, 0.8);
}
.projectFactsWrap .item p {
    color: rgba(255, 255, 255, 0.8);
    font-size: 18px;
    margin: 0;
    padding: 10px;
}
.projectFactsWrap .item p.number {
    font-size: 40px;
    padding: 0;
    font-weight: bold;
}
.projectFactsWrap .item span {
    width: 60px;
    background: rgba(255, 255, 255, 0.8);
    height: 2px;
    display: block;
    margin: 0 auto;
}
</style>


<div id="assessmentReport" data-SurveyId="<?= $survey->survey_id ?>"  data-UserId="<?= $user_id; ?>" data-tocken="<?= Yii::$app->user->getIdentity()->access_token ;?>" >
<div class="content-header">
    <div class="row mb-2">
        <div class="col-md-6">
            <h1 class="m-0 text-dark">تقرير {{assessmentTitle}}</h1>
        </div>
        <div class="col-md-6 actionBtns">
            <a class="btn btn-primary" href="/assessment/default/view?id=<?= $survey->survey_id ?>">العودة للإستبيان</a>        
        </div>
        <!-- /.col -->
        
        <div class="col-md-12">
            <p>{{assessmentDesc}}</p>
        </div>
    </div>
    <!-- /.row -->
</div>
    
    
    <div class="sectiontitle">
        
    </div>

<div id="projectFacts" class="sectionClass">
                <div class="fullWidth eight columns">
                    <div class="projectFactsWrap ">
                        <div class="item wow fadeInUpBig animated animated" data-number="12" style="visibility: visible;">
                            <i class="fas fa-tasks"></i>
                            <p id="number1" class="number">{{Math.ceil(reportGeneralInfo.progress)}}%</p>
                            <span></span>
                            <p>نسبة التقدم</p>
                        </div>
                        <div class="item wow fadeInUpBig animated animated" data-number="55" style="visibility: visible;">
                            <i class="fas fa-spinner"></i>
                            <p id="number2" class="number">{{reportGeneralInfo.total_points}}</p>
                            <span></span>
                            <p>مجموع النقاط</p>
                        </div>
                        <div class="item wow fadeInUpBig animated animated" data-number="359" style="visibility: visible;">
                            <i class="fas fa-spinner"></i>
                            <p id="number3" class="number">{{reportGeneralInfo.gained_points}}</p>
                            <span></span>
                            <p>النقاط المحصلة</p>
                        </div>
                        <div class="item wow fadeInUpBig animated animated" data-number="246" style="visibility: visible;">
                            <i class="fas fa-clock"></i>
                            <p id="number4" class="number">{{Math.ceil(reportGeneralInfo.actual_time)}}</p>
                            <span></span>
                            <p>وقت الإستبيان (د)</p>
                        </div>
                    </div>
                </div>
            </div>
<template>
  <v-card>
  <v-card-title class="mb-5">
                   بيان الإستبيان
                    <v-spacer></v-spacer>
                    <v-text-field
                    v-model="search"
                    label="البحث"
                    single-line
                    hide-details
                    ></v-text-field>
                </v-card-title>
    

    <v-data-table class="mb-5 mt-5" :headers="headers" :items="questionsReport" :search="search">
        <template v-slot:item.qGainedPoints="{ item }">
            <v-chip :color="getColor(item.qGainedPoints, item.qTotalPoints)" dark>{{ item.qGainedPoints }}</v-chip>
        </template>
        <template v-slot:item.qType="{ item }">
            {{ item.qType }}
        </template>
        <template v-slot:item.qAttatchments="{ item }">
            <div v-if="Array.isArray(item.qAttatchments)">
                <ul v-for="file in item.qAttatchments" :key="file.name">
                    <li v-if="file.content" >
                        <a :href="file.content" target="_blank">{{ file.name }}</a>
                    </li>
                </ul>
            </div>
        </template>
        <template v-slot:item.qAnswer="{ item }">
            <div v-if="Array.isArray(item.qAnswer) && item.qType == 'File'">
                <ul v-for="file in item.qAnswer" :key="file.id">
                    <li v-if="file.content" >
                        <a :href="file.content" target="_blank">{{ file.name }}</a>
                    </li>
                </ul>
            </div>
            <ul v-else-if="Array.isArray(item.qAnswer) && item.qType == 'Multiple choice'">
                <li v-for="choice in item.qAnswer" :key="choice">
                    {{choice}}
                </li>
            </ul>
            <ul v-else-if="Array.isArray(item.qAnswer) && item.qType == 'Ranking'">
                <li v-for="choice in item.qAnswer" :key="choice" v-html="choice">
                    
                </li>
            </ul>
            <div v-else>
                {{item.qAnswer}}
            </div>
        </template>
        <template v-slot:item.qCorrectiveActions="{ item }">
            <ul v-if="Array.isArray(item.qCorrectiveActions)">
                <li v-for="action in item.qCorrectiveActions" :key='action' v-html="action"></li>
            </ul>
            <p v-else v-html="item.qCorrectiveActions"></p>
        </template>
        <!-- <template slot="items" slot-scope="props">
            <td>{{ props.item.qNum }}</td>
            <td class="text-xs-left">{{ props.item.qText }}</td>
            <td class="text-xs-left">{{ props.item.qAnswer }}</td>
            <td class="text-xs-left">{{ props.item.qGainedPoints }}</td>
            <td class="text-xs-right">{{ props.item.qTotalPoints }}</td>
            <td class="text-xs-right">{{ props.item.qCorrectiveActions }}</td>
        </template> -->
        <v-alert slot="no-results" :value="true" color="error" icon="mdi-warning">
            لا يوجد بحث يطابق بحثك الحالي
        </v-alert>
</v-data-table>

  </v-card>
</template>





</div>

