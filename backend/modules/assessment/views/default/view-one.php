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
<div class="content-header"  style="display:none">
    <div class="row mb-2">
        <div class="col-md-6">
            <h1 class="m-0 text-dark"> تقرير {{assessmentTitle}}</h1>
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
<div class="sectiontitle report-details">
    <v-row>
        <v-col cols="12" sm="6" md="4" lg="3" class="brandPrimColor">
        تاريخ إنشاء الإستبيان: <span class="brandPTextColor">{{reportGeneralInfo.survey_created_at}}</span>
        </v-col>
        <v-col cols="12" sm="6" md="4" lg="3" class="brandPrimColor">
        ينتهي في: <span class="brandPTextColor">{{reportGeneralInfo.survey_expired_at}}</span>
        </v-col>
        <v-col cols="12" sm="6" md="4" lg="3" class="brandPrimColor">
        تاريخ ملىء الإستبيان: <span class="brandPTextColor">{{reportGeneralInfo.survey_end_at}}</span>
        </v-col>
        <v-col cols="12" sm="6" md="4" lg="3" class="brandPrimColor">
        رقم الإستبيان: <span class="brandPTextColor">{{reportGeneralInfo.survey_number}}</span>
        </v-col>
        <v-col cols="12" sm="6" md="4" lg="3" class="brandPrimColor">
        الوقت المحدد: <span class="brandPTextColor">{{reportGeneralInfo.survey_time_to_pass}} دقائق</span>
        </v-col>
        <v-col cols="12" sm="6" md="4" lg="3" class="brandPrimColor">
        عدد الأسئلة: <span class="brandPTextColor">{{reportGeneralInfo.survey_question_number}}</span>
        </v-col>
        <v-col cols="12" sm="6" md="4" lg="3" class="brandPrimColor">
        نسبة التقدم: <span class="brandPTextColor">{{Math.ceil(this.reportGeneralInfo.progress)}}%</span>
        </v-col>
        
    </v-row>
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
                <p id="number2" class="number" v-if="reportGeneralInfo.total_points >= 0">{{reportGeneralInfo.total_points}}</p>
                <p id="number2" class="number" v-else>بدون نقاط</p>
                <span></span>
                <p>مجموع النقاط</p>
            </div>
            <div class="item wow fadeInUpBig animated animated" data-number="359" style="visibility: visible;">
                <i v-if="reportGeneralInfo.gained_points > (reportGeneralInfo.total_points/2) || reportGeneralInfo.gained_points == null" class="far fa-smile"></i>
                <i v-else class="far fa-frown"></i>
                <p id="number3" class="number"  v-if="reportGeneralInfo.gained_points >= 0">{{reportGeneralInfo.gained_points}}</p>
                <p id="number3" class="number" v-else>بدون نقاط</p>
                <span></span>
                <p>النقاط المحصلة</p>
            </div>
            <div class="item wow fadeInUpBig animated animated" data-number="246" style="visibility: visible;">
                <i class="fas fa-clock"></i>
                <p id="number4" class="number">{{reportGeneralInfo.actual_time}}</p>
                <span></span>
                <p>وقت الإستبيان (د)</p>
            </div>
        </div>
    </div>
</div>






<div id="tabletemplate" style="display:none">
    <template >
        <v-card class="mb-5">
            <v-card-title class="mb-5 search-card">
            الأسئلة 
                <v-spacer></v-spacer>
                <v-text-field
                v-model="search"
                append-icon="mdi-search"
                label="البحث"
                single-line
                hide-details
                :rows-per-page-items="[100, 150, 200, 250, 300]"
                :pagination.sync="pagination"
                ></v-text-field>
            </v-card-title>
            
            <!-- <v-data-table class="mb-5 mt-5"
                :headers="headers"
                :items="questionsReport"
                :search="search"
                :custom-filter="customFilter">
                    <template v-slot:item.qNum="{ item }" >
                        <v-chip label color="#eee" >{{ item.qNum }}</v-chip>
                    </template>
                    <template v-slot:item.qGainedPoints="{ item }" >
                        <v-chip v-if="item.qTotalPoints" :color="getLevel(item.qGainedPoints, item.qTotalPoints)" dark>{{ item.qTotalPoints }} / {{ item.qGainedPoints }}</v-chip>
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
                    <template v-slot:item.qText="{ item }" >
                        {{ item.qText }}
                        <i class="fas ml-1 mr-1 fa-check-circle " style='color:green' v-if='getLevel(item.qGainedPoints, item.qTotalPoints) == "green" || item.qTotalPoints == null || item.qTotalPoints == 0'></i>
                        <i class="fas ml-1 mr-1 fa-exclamation-triangle " style='color:orange' v-else-if='getLevel(item.qGainedPoints, item.qTotalPoints) == "orange"'></i>
                        <i class="fas ml-1 mr-1 fa-exclamation-circle" style='color:#cebe32' v-else-if='getLevel(item.qGainedPoints, item.qTotalPoints) == "#cebe32"'></i>

                        <i class="fas ml-1 mr-1 fa-times-circle" style='color:red' v-else></i>
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
                            <li v-for="choice in item.qAnswer" :key="choice.value">
                                {{choice.value}}
                                <i class="fas ml-1 mr-1 fa-check " style='color:green' v-if='choice.correct'></i>
                                <i class="fas ml-1 mr-1 fa-times " style='color:red' v-else></i>
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
                        <ul v-if="Array.isArray(item.qCorrectiveActions)" style=" border-radius:10px;  color:black;">
                            <li v-for="action in item.qCorrectiveActions" class="mt-3 mb-3 mr-3 ml-3" :key='action' v-html="action"></li>
                        </ul>
                        <p v-else class="mt-3 mb-3 mr-3 ml-3" style=" border-radius:10px; color:black;" v-html="item.qCorrectiveActions"></p>
                    </template>
                    <v-alert slot="no-results" :value="true" color="error" icon="mdi-warning">
                    لا يوجد بحث يطابق بحثك الحالي
                    </v-alert>
            </v-data-table> -->
            <v-data-table class="mb-5 mt-5"
                        :headers="headers"
                        :items="questionsReport"
                        :search="search"
                        :custom-filter="customFilter">
                            <template v-slot:item.qNum="{ item }" >
                                <v-chip label color="#eee" >{{ item.qNum }}</v-chip>
                            </template>
                            <template v-slot:item.qGainedPoints="{ item }" >
                                <v-chip v-if="item.qTotalPoints" :color="getLevel(item.qGainedPoints, item.qTotalPoints)" dark>{{ item.qTotalPoints }} / {{ item.qGainedPoints }}</v-chip>
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
                            <template v-slot:item.qText="{ item }" >
                                {{ item.qText }}
                                <i class="fas ml-1 mr-1 fa-check-circle " style='color:green' v-if='getLevel(item.qGainedPoints, item.qTotalPoints) == "green" || item.qTotalPoints == null || item.qTotalPoints == 0'></i>
                                <i class="fas ml-1 mr-1 fa-exclamation-triangle " style='color:orange' v-else-if='getLevel(item.qGainedPoints, item.qTotalPoints) == "orange"'></i>
                                <i class="fas ml-1 mr-1 fa-exclamation-circle" style='color:#cebe32' v-else-if='getLevel(item.qGainedPoints, item.qTotalPoints) == "#cebe32"'></i>

                                <i class="fas ml-1 mr-1 fa-times-circle" style='color:red' v-else></i>
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
                                    <li v-for="choice in item.qAnswer" :key="choice.value">
                                        {{choice.value}}
                                        <i class="fas ml-1 mr-1 fa-check " style='color:green' v-if='choice.correct'></i>
                                        <i class="fas ml-1 mr-1 fa-times " style='color:red' v-else></i>
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
                                <ul v-if="Array.isArray(item.qCorrectiveActions)" style=" border-radius:10px;  color:black;">
                                    <li v-for="action in item.qCorrectiveActions" class="mt-3 mb-3 mr-3 ml-3" :key='action' v-html="action"></li>
                                </ul>
                                <p v-else class="mt-3 mb-3 mr-3 ml-3" style=" border-radius:10px; color:black;" v-html="item.qCorrectiveActions"></p>
                            </template>
                            <v-alert slot="no-results" :value="true" color="error" icon="mdi-warning">
                                لا يوجد نتيجة للبحث  {{search}}
                            </v-alert>
                    </v-data-table>
        </v-card>


      
    </template>
</div>

<div id="noreport" style="display:none">
    <p> لا تملك الصلاحية للدخول إلي التقرير</p><div class="emptyassessment"><div class="img"></div><div class="name"></div></div><div class="emptyassessment"><div class="img"></div><div class="name"></div></div>

    <div class="col-md-12 text-center">
            <a class="btn btn-primary" href="/assessment/default/view?id=<?= $survey->survey_id ?>">العودة للإستبيان</a>        
        </div>
</div>




</div>

