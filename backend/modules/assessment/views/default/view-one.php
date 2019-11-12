


<div id="assessmentReport" data-SurveyId="<?= $survey->survey_id ?>"  data-UserId="<?= $user_id; ?>" data-tocken="<?= Yii::$app->user->getIdentity()->access_token ;?>" >

<template>
  <v-card>
    <v-card-title>
      Nutrition
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    

    <v-data-table class="mb-5 mt-5"
                    :headers="headers"
                    :items="questionsReport"
                    :search="search"
                   >
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
                            {{search}}
                        </v-alert>
                    </v-data-table>
                </v-card>
  </v-card>
</template>





</div>

