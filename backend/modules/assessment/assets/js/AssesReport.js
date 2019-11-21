var currentHostname = window.location.hostname;
var api;

  if ( currentHostname  === 'organization.selfassest.localhost/') {
         api ='http://api.selfassest.localhost/';
  }
  // else if(currentHostname  === 'organization.selfassest.localhost' ){
  //       api = 'http://api.selfassest.localhost/';
  // }
  else{
        api = '';
  }


  var app = new Vue({
    el: "#assessmentReport",
    vuetify: new Vuetify(),
    data: {
      Api: api,
      tocken: $("#assessmentReport").attr("data-tocken"),
      SurveyId:$("#assessmentReport").attr("data-SurveyId"),
      UserId:$("#assessmentReport").attr("data-UserId"),
      Asses:{},
      search: '',
        headers: [
          { text: 'الرقم', align: '', sortable: true, value: 'qNum' },
          { text: 'السؤال', align: '', value: 'qText' },
          { text: 'الإجابة', align: '', value: 'qAnswer' },
          { text: 'الملفات المرفقة', value: 'qAttatchments' },
          { text: 'النقاط المحصلة', align: 'center', value: 'qGainedPoints' },
         // { text: 'النقاط الإجمالية', align: 'center', value: 'qTotalPoints' },
          { text: 'الإجرائات التصحيحية', value: 'qCorrectiveActions' },
        ],
        assessmentData: {},
        surveyResults: {},
        questionsReport: [],
        reportGeneralInfo: {},
        assessmentTitle: '',
        assessmentDesc: '',
        pagination: {
          rowsPerPage: 100
        },
        methods: {
          customFilter(items, search, filter) {
              search = search.toString().toLowerCase();
              return items.filter(row => filter(row["qNum"], search));
          } 
      },
     },
    mounted() {
      $.ajax({
        url:"http://api.selfassest.localhost/assessments/custom-report/"+this.SurveyId+"/"+this.UserId,
        method: "GET",
        "headers": {
          "Content-Type": "application/json",
          Authorization: "Bearer "+this.tocken

        },
        success: res => {
          if(res.status == 200){
            
            this.questionsReport = res.data.answers
            this.reportGeneralInfo = res.data.generalInfo
            this.assessmentDesc = res.data.description
            this.assessmentTitle = res.data.title
            $("#tabletemplate").show()
            $("#projectFacts").show()
            $(".content-header").show()
          }
        },
        error:res =>{
          $("#tabletemplate").hide()
          $("#projectFacts").hide()
          $("#noreport").show()
        }
      });
      
    },
    methods: {
      getLevel(gained, total) {
        if ((gained/total)*100 < 25 || total == 0) {
            return 'red'
        } else if ( (gained/total)*100 >= 25 && (gained/total)*100 < 50 ) {
            return 'orange'
        } else if ( (gained/total)*100 >= 50 && (gained/total)*100 < 75 ) {
            return '#cebe32'
        }
        else {
            return 'green'
        }
    },
     
  
    },
  
    computed: {
     
  
    }
  });



