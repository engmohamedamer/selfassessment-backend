(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["assessmentEdit"],{"2f83":function(e,t,s){"use strict";var a=s("4f78"),i=s.n(a);i.a},"4f78":function(e,t,s){},ca71:function(e,t,s){},d716:function(e,t,s){"use strict";s.r(t);var a=function(){var e=this,t=e.$createElement,s=e._self._c||t;return e.loadingSurvey?s("div",{staticClass:"text-center survey-preloader"},[s("v-progress-linear",{attrs:{indeterminate:"",size:50,color:e.theme.colors.brandPrimColor}})],1):s("div",{staticClass:"container",attrs:{id:"surveyElement"}},[s("v-row",{attrs:{justify:"center"}},[s("v-col",{attrs:{cols:"12",md:"10"}},[s("div",{staticClass:"bottomNav"},[s("div",{staticClass:"container"},[s("div",{staticClass:"row justify-center"},[s("div",{staticClass:"col-md-10 col-12"},["paused"==e.surveyStatus||"new"==e.surveyStatus?s("div",{staticClass:"rem-time"},[s("strong",[e._v(e._s(e.$t("Asses.remainTime"))+":")]),s("button",{attrs:{title:e.$t("Asses.pause"),id:"remainTime"}})]):e._e(),s("div",{staticClass:"custom-navigator d-none",attrs:{id:"navi"}},[s("select",{attrs:{id:"pageSelector"},on:{change:e.surveyCurrentPageNo}},[s("option",{attrs:{disabled:""}},[e._v("اختر الصفحة")])]),s("i",{staticClass:"fas fa-angle-down"})]),"paused"==e.surveyStatus||"new"==e.surveyStatus?s("div",{staticClass:"working-survey"},[s("a",{attrs:{id:"surveyComplete"},on:{click:e.exitSurveyForNow}},[e._v(" "+e._s(e.$t("Asses.pause")))])]):e._e()])])])]),e.loadingQLoader?s("div",{staticClass:"text-center qloader-preloader"},[e._v(",\n                "),s("v-progress-circular",{attrs:{indeterminate:"",size:50,color:e.theme.colors.brandPrimColor}})],1):e._e(),s("survey",{attrs:{survey:e.survey}})],1)],1),s("div",{staticClass:"text-center ma-2"},[s("v-snackbar",{model:{value:e.snackbar,callback:function(t){e.snackbar=t},expression:"snackbar"}},[e._v("\n        "+e._s(e.snackbarText.notValidFileType)+"\n        "),s("v-btn",{attrs:{color:"pink",text:""},on:{click:function(t){e.snackbar=!1}}},[e._v("\n            "+e._s(e.$t("public.close"))+"\n        ")])],1)],1)],1)},i=[],r=(s("d3a4"),s("2f62")),o=s("aae0"),n=(s("bc3a"),s("1b6e"));let u=n["Survey"];var c={components:{Survey:u},data(){let e={};var t=new n["Model"](e);return{survey:t,assessmentData:{},surveyResults:{},surveyStatus:"new",wholeSurveyErrors:[],snackbar:!1,snackbarText:{notValidFileType:"الملفات المرفقة لابد ان تكون بالامتدادات التالية (.pdf | .png | .jpeg | .jpg | .doc | .xls | .xlsx | .docx)"}}},beforeRouteLeave(e,t,s){t.meta.saved?s():this.exitSurveyForNow()},mounted(){let e=this;window.onbeforeunload=function(){e.exitSurveyForNow()};const t={headers:{Authorization:localStorage.getItem("FBidToken")}};var s=this.$route.params.id;this.$store.commit("SET_LOADING",{name:"ui",value:!0}),Object(o["a"])().get(`/assessments/${this.$route.params.id}`,t).then(a=>{if(401==a.data.status)this.$store.commit("SET_LOADING",{name:"ui",value:!1}),this.$router.push({name:"notFound"});else{function i(t,s){if(t>0){var a,i,r=t;a=parseInt(r/60,10),i=parseInt(r%60,10),a=a<10?"0"+a:a,i=i<10?"0"+i:i,s.textContent=a+":"+i}else e.survey.doComplete()}this.assessmentData=a.data.data,this.survey=new n["Model"](this.assessmentData),this.survey.onStarted.add(function(a){Object(o["a"])().get("/assessments/survey-start/"+s,t).then(t=>{e.$route.meta.saved=!1;let s=document.getElementById("navi");s.classList.remove("d-none")}).catch(e=>{this.$store.commit("SET_LOADING",{name:"ui",value:!1}),this.$router.push({name:"notFound"})})});let r=document.getElementById("remainTime");i(this.survey.maxTimeToFinish-this.survey.timeSpent,r),this.survey.onTimerPanelInfoText.add((e,t)=>{i(this.survey.maxTimeToFinish-this.survey.timeSpent,r),t.text=""}),this.survey.onUploadFiles.add(function(e,t){let s=new FormData;t.files.forEach(function(e){"image/png"!=e.type&&"image/jpg"!=e.type&&"image/jpeg"!=e.type&&"application/pdf"!=e.type&&"application/xls"!=e.type&&"application/xlsx"!=e.type&&"application/doc"!=e.type&&"application/docx"!=e.type||s.append(e.name,e)}),this.$store.commit("SET_LOADING",{name:"qLoader",value:!0});const a={headers:{Authorization:localStorage.getItem("FBidToken")}};Object(o["a"])().post("media/upload",s,a).then(e=>{t.callback("success",t.files.map((t,s)=>{if("image/png"==t.type||"image/jpg"==t.type||"image/jpeg"==t.type||"application/pdf"==t.type||"application/xls"==t.type||"application/xlsx"==t.type||"application/doc"==t.type||"application/docx"==t.type)return{file:t,content:e.data.data[s][t.name].link}})),this.$store.commit("SET_LOADING",{name:"qLoader",value:!1})}).catch(e=>{this.snackbar=!0,this.$store.commit("SET_LOADING",{name:"qLoader",value:!1})})}.bind(this)),this.assessmentData.answers&&(this.survey.data=this.assessmentData.answers,this.survey.currentPageNo=this.assessmentData.pageNo,this.$store.commit("SET_LOADING",{name:"ui",value:!1})),this.survey.onCurrentPageChanged.add(this.doOnCurrentPageChanged),this.survey.onComplete.add(e=>{this.$store.commit("SET_LOADING",{name:"ui",value:!0}),this.$route.meta.saved=!0,this.surveyResults.answers=e.data;const t={headers:{Authorization:localStorage.getItem("FBidToken")}};"paused"==this.surveyStatus?(this.surveyResults.status=1,this.surveyResults.pageNo=this.survey.currentPageNo,Object(o["a"])().put(`/assessments/${this.$route.params.id}`,this.surveyResults,t).then(e=>{this.$store.commit("SET_LOADING",{name:"ui",value:!1}),this.$router.push({name:"profile"})}).catch(e=>{this.$store.commit("SET_LOADING",{name:"ui",value:!1})})):(this.surveyStatus="completed",this.surveyResults.status=2,Object(o["a"])().put(`/assessments/${this.$route.params.id}`,this.surveyResults,t).then(e=>{this.$store.commit("SET_LOADING",{name:"ui",value:!1}),this.$router.push({name:"assessmentReport",params:{id:this.$route.params.id}})}).catch(e=>{this.$store.commit("SET_LOADING",{name:"ui",value:!1}),this.$router.push({name:"notFound"})}))}),2==this.assessmentData.status&&(this.$store.commit("SET_LOADING",{name:"ui",value:!1}),this.$router.push({name:"assessmentReport",params:{id:this.$route.params.id}})),this.setupPageSelector(this.survey),this.doOnCurrentPageChanged(this.survey)}}).catch(e=>{this.$store.commit("SET_LOADING",{name:"ui",value:!1}),this.$router.push({name:"notFound"})})},methods:{surveyValidateQuestion(e,t){if(e.isLastPage);else for(let s=0;s<e.currentPage.elements.length;s++){const t=e.currentPage.elements[s];return t.isRequired&&!t.value&&(this.wholeSurveyErrors.push(t.name),4==s&&this.survey.nextPage()),!0}},surveyCompleteLastPage(){this.survey.completeLastPage()},surveyNextPage(){this.survey.nextPage()},surveyPrevPage(){this.survey.prevPage()},surveyCurrentPageNo(e){this.survey.currentPageNo=e.target.value},doOnCurrentPageChanged(e){document.getElementById("pageSelector").value=e.currentPageNo,document.getElementById("surveyPageNo")&&(document.getElementById("surveyPageNo").value=e.currentPageNo)},setupPageSelector(e){for(var t=document.getElementById("pageSelector"),s=0;s<e.visiblePages.length;s++){var a=document.createElement("option");a.value=s,a.text="صفحة "+(s+1),t.add(a)}},exitSurveyForNow(){this.surveyStatus="paused",this.survey.completeLastPage(),this.$route.meta.saved=!0}},computed:{...Object(r["b"])(["loadingSurvey","loadingQLoader","theme","locale"])}},l=c,m=(s("2f83"),s("2877")),d=s("6544"),v=s.n(d),h=s("8336"),p=s("62ad"),y=s("490a"),g=s("8e36"),f=s("0fd9"),b=(s("ca71"),s("a9ad")),S=s("f2e7"),$=s("fe6c"),T=s("58df"),k=s("d9bd"),w=Object(T["a"])(b["a"],S["a"],Object($["b"])(["absolute","top","bottom","left","right"])).extend({name:"v-snackbar",props:{multiLine:Boolean,timeout:{type:Number,default:6e3},vertical:Boolean},data:()=>({activeTimeout:-1}),computed:{classes(){return{"v-snack--active":this.isActive,"v-snack--absolute":this.absolute,"v-snack--bottom":this.bottom||!this.top,"v-snack--left":this.left,"v-snack--multi-line":this.multiLine&&!this.vertical,"v-snack--right":this.right,"v-snack--top":this.top,"v-snack--vertical":this.vertical}}},watch:{isActive(){this.setTimeout()}},created(){this.$attrs.hasOwnProperty("auto-height")&&Object(k["d"])("auto-height",this)},mounted(){this.setTimeout()},methods:{setTimeout(){window.clearTimeout(this.activeTimeout),this.isActive&&this.timeout&&(this.activeTimeout=window.setTimeout(()=>{this.isActive=!1},this.timeout))}},render(e){return e("transition",{attrs:{name:"v-snack-transition"}},[this.isActive&&e("div",{staticClass:"v-snack",class:this.classes,on:this.$listeners},[e("div",this.setBackgroundColor(this.color,{staticClass:"v-snack__wrapper"}),[e("div",{staticClass:"v-snack__content"},this.$slots.default)])])])}}),C=Object(m["a"])(l,a,i,!1,null,null,null);t["default"]=C.exports;v()(C,{VBtn:h["a"],VCol:p["a"],VProgressCircular:y["a"],VProgressLinear:g["a"],VRow:f["a"],VSnackbar:w})}}]);
//# sourceMappingURL=assessmentEdit.ea52576d.js.map