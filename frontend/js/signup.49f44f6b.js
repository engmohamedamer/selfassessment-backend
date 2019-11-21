(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["signup"],{"34c3b":function(s,e,i){"use strict";i.r(e);var t=function(){var s=this,e=s.$createElement,i=s._self._c||e;return i("v-container",[i("v-row",{staticClass:"login mt-5 mb-5",attrs:{justify:"start"}},[i("v-col",{attrs:{sm:"12",md:"6"}},[i("h2",[s._v(s._s(s.$t("signup.welcomeMsg"))+",")]),i("h4",[s._v(s._s(s.$t("signup.signupTitle"))+"!")]),i("AppSignUpForm"),i("p",{staticClass:"mt-4"},[s._v(s._s(s.$t("signup.verifyMsg")))])],1),s.windowWidth>960?i("v-col",{attrs:{sm:"0",md:"6"}},[i("div",{staticClass:"login-bg"})]):s._e()],1)],1)},o=[],l=function(){var s=this,e=s.$createElement,i=s._self._c||e;return i("v-form",{ref:"form",staticClass:"row",on:{submit:function(e){return e.preventDefault(),s.signupHandlerSubmit(e)}}},[i("div",{staticClass:"col-lg-6"},[i("v-text-field",{attrs:{label:s.$t("signup.namePlaceholder"),loading:s.loadingForm,color:s.theme.colors.brandPrimColor,light:"",height:"40",outlined:"","append-icon":"mdi-account-outline",rules:s.nameRules},model:{value:s.signupUser.name,callback:function(e){s.$set(s.signupUser,"name",e)},expression:"signupUser.name"}})],1),i("div",{staticClass:"col-lg-6"},[i("v-text-field",{attrs:{label:s.$t("signup.emailPlaceholder"),loading:s.loadingForm,color:s.theme.colors.brandPrimColor,light:"",height:"40",outlined:"","append-icon":"mdi-email-outline",rules:s.emailRules},model:{value:s.signupUser.email,callback:function(e){s.$set(s.signupUser,"email",e)},expression:"signupUser.email"}})],1),i("div",{staticClass:"col-lg-6"},[i("v-text-field",{attrs:{label:s.$t("signup.mobilePlaceholder"),loading:s.loadingForm,color:s.theme.colors.brandPrimColor,light:"",height:"40",outlined:"","append-icon":"mdi-phone-outline",rules:s.mobileRules,autocomplete:""},model:{value:s.signupUser.mobile,callback:function(e){s.$set(s.signupUser,"mobile",e)},expression:"signupUser.mobile"}})],1),i("div",{staticClass:"col-lg-6"},[i("v-text-field",{attrs:{"append-icon":s.showPassword?s.svg.visibility:s.svg.visibilityOff,type:s.showPassword?"text":"password",name:"input-10-1",label:s.$t("login.passPlaceholder"),loading:s.loadingForm,color:s.theme.colors.brandPrimColor,height:"40",outlined:"",autocomplete:"",rules:s.passRules},on:{"click:append":function(e){s.showPassword=!s.showPassword}},model:{value:s.signupUser.password,callback:function(e){s.$set(s.signupUser,"password",e)},expression:"signupUser.password"}})],1),i("div",{staticClass:"col-lg-12"},[i("v-text-field",{attrs:{label:s.$t("signup.bioPlaceholder"),loading:s.loadingForm,color:s.theme.colors.brandPrimColor,light:"",height:"40",outlined:"","append-icon":"mdi-account-badge-horizontal-outline",rules:s.bioRules},model:{value:s.signupUser.bio,callback:function(e){s.$set(s.signupUser,"bio",e)},expression:"signupUser.bio"}})],1),i("div",{staticClass:"col-lg-12"},[s.errors?i("div",{staticClass:"subtitle1 text-center text-capitalize red--text"},s._l(s.errors,(function(e,t){return i("p",{key:t},[s._v(s._s(e))])})),0):s._e()]),i("div",{staticClass:"col-lg-12"},[i("div",{staticClass:"mt-5"},[i("v-btn",{staticClass:"primBtn",class:{"mr-4":"en"==s.locale},attrs:{type:"submit",large:"",loading:s.loadingForm,color:s.theme.colors.brandPrimColor,elevation:"0",dark:""}},[s._v("\n                "+s._s(s.$t("signup.signupBtn"))+"\n            ")]),i("router-link",{staticClass:"v-btn secBtn mr-4",attrs:{to:"/login"}},[s._v(s._s(s.$t("signup.loginBtn")))])],1)])])},a=[],n=i("502e"),r=i("d3a4"),u=i("94ed"),c=i("2f62"),d=(i("bc3a"),{mixins:[n["a"]],data(){return{showPassword:!1,signupUser:{name:"",password:"",bio:"",mobile:"",email:""},nameRules:[s=>!!s||r["a"].messages[this.locale].signup.errors.reqUserName],emailRules:[s=>!!s||r["a"].messages[this.locale].signup.errors.reqEmail,s=>/.+@.+\..+/.test(s)||r["a"].messages[this.locale].signup.errors.emailMustValid],mobileRules:[s=>!!s||r["a"].messages[this.locale].signup.errors.reqMobile,s=>/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/.test(s)||r["a"].messages[this.locale].signup.errors.mobileMustValid],passRules:[s=>!!s||r["a"].messages[this.locale].signup.errors.reqPass,s=>s&&s.length>=6||r["a"].t("signup.errors.passMoreThanNChars",{n:"6"})],bioRules:[s=>!!s||r["a"].messages[this.locale].signup.errors.reqBio,s=>s&&s.length>=10||r["a"].t("signup.errors.bioMoreThanNChars",{n:"10"})],svg:{visibility:u["i"],visibilityOff:u["h"]}}},methods:{signupHandlerSubmit(){let s=Object({NODE_ENV:"production",VUE_APP_TITLE:"Self Assessment",VUE_APP_API:"http://api.selfassest.localhost/",BASE_URL:"/"}).VUE_APP_ORG_SLUG,e=window.location.host,i=e.split("."),t=i[0];this.$refs.form.validate()&&this.$store.dispatch("SIGN_UP",{organization:s||t,name:this.signupUser.name,password:this.signupUser.password,bio:this.signupUser.bio,mobile:this.signupUser.mobile,email:this.signupUser.email,locale:this.locale}).then(()=>{this.$router.push({name:"login"})})}},computed:{...Object(c["b"])(["errors","loadingForm","theme","locale"])},beforeDestroy(){this.$store.dispatch("CLEAR_ERROR")},mounted(){}}),p=d,m=(i("5edf"),i("2877")),g=i("6544"),h=i.n(g),b=i("8336"),v=i("4bd4"),w=i("8654"),f=Object(m["a"])(p,l,a,!1,null,"4b20a15e",null),U=f.exports;h()(f,{VBtn:b["a"],VForm:v["a"],VTextField:w["a"]});var _={components:{AppSignUpForm:U},data(){return{windowWidth:window.innerWidth}},mounted(){window.onresize=()=>{this.windowWidth=window.innerWidth}}},C=_,P=i("62ad"),$=i("a523"),x=i("0fd9"),R=Object(m["a"])(C,t,o,!1,null,null,null);e["default"]=R.exports;h()(R,{VCol:P["a"],VContainer:$["a"],VRow:x["a"]})},"5edf":function(s,e,i){"use strict";var t=i("763e"),o=i.n(t);o.a},"763e":function(s,e,i){}}]);
//# sourceMappingURL=signup.49f44f6b.js.map