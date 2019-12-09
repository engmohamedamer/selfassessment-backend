(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["profileEdit"],{"179b":function(e,r,t){"use strict";var o=t("98f8"),s=t.n(o);s.a},"5c7c":function(e,r,t){},"98f8":function(e,r,t){},c8a9:function(e,r,t){"use strict";t.r(r);var o=function(){var e=this,r=e.$createElement,t=e._self._c||r;return t("v-container",[t("v-row",{staticClass:"ProfileEdit",attrs:{justify:"center"}},[t("v-col",{attrs:{sm:"10",md:"8"}},[t("h2",{staticClass:"mb-5"},[e._v(e._s(e.$t("ProfileEdit.title")))]),t("AppProfileEditForm")],1)],1)],1)},s=[],a=function(){var e=this,r=e.$createElement,t=e._self._c||r;return t("div",{staticClass:"profile block"},[t("div",{staticClass:"profile-picture big-profile-picture clear"},[t("v-avatar",{attrs:{size:"150"}},[e.userCredentials.profile.profile_picture?t("v-img",{staticClass:"card-img",attrs:{src:e.userCredentials.profile.profile_picture,avatar:e.userCredentials.profile.firstname}}):t("avatar",{staticClass:"card-img",attrs:{username:e.userCredentials.profile.firstname+" "+e.userCredentials.profile.lastname}}),t("div",{staticClass:"updateAvatar"},[t("input",{attrs:{type:"file",id:"imageInput",hidden:""},on:{change:e.handleImageChange}}),t("v-tooltip",{attrs:{bottom:""},scopedSlots:e._u([{key:"activator",fn:function(r){var o=r.on;return[t("v-btn",e._g({staticClass:"mx-2 btn-primary",attrs:{fab:"",small:"",absolute:"",right:"",bottom:"",dark:""},on:{click:e.editImage}},o),[t("v-icon",{attrs:{dark:""}},[e._v(e._s(e.svg.camera))])],1)]}}])},[t("span",[e._v(e._s(e.$t("Profile.editProfileImg")))])])],1)],1)],1),t("v-form",{ref:"form",staticClass:"edit-profile-form",on:{submit:function(r){return r.preventDefault(),e.updateProfileHandlerSubmit(r)}}},[t("v-container",[t("v-row",[t("v-col",{attrs:{cols:"12",sm:"12",md:"6"}},[t("v-text-field",{attrs:{"background-color":e.theme.colors.brandGrayColor,label:e.$t("ProfileEdit.firstName"),loading:e.loadingForm,color:e.theme.colors.brandPTextColor,light:"",height:"40","append-icon":"mdi-account-outline",rules:e.nameRules,filled:""},model:{value:e.userCredentials.profile.firstname,callback:function(r){e.$set(e.userCredentials.profile,"firstname",r)},expression:"userCredentials.profile.firstname"}})],1),t("v-col",{attrs:{cols:"12",sm:"12",md:"6"}},[t("v-text-field",{attrs:{"background-color":e.theme.colors.brandGrayColor,label:e.$t("ProfileEdit.lastName"),loading:e.loadingForm,color:e.theme.colors.brandPTextColor,light:"",height:"40",filled:"","append-icon":"mdi-account-outline",rules:e.nameRules},model:{value:e.userCredentials.profile.lastname,callback:function(r){e.$set(e.userCredentials.profile,"lastname",r)},expression:"userCredentials.profile.lastname"}})],1),t("v-col",{attrs:{cols:"12",sm:"12",md:"6"}},[t("v-text-field",{attrs:{"background-color":e.theme.colors.brandGrayColor,label:e.$t("signup.emailPlaceholder"),loading:e.loadingForm,color:e.theme.colors.brandPTextColor,light:"",height:"40",filled:"","append-icon":"mdi-email-outline",rules:e.emailRules},model:{value:e.userCredentials.profile.email,callback:function(r){e.$set(e.userCredentials.profile,"email",r)},expression:"userCredentials.profile.email"}})],1),t("v-col",{attrs:{cols:"12",sm:"12",md:"6"}},[t("v-text-field",{attrs:{"background-color":e.theme.colors.brandGrayColor,label:e.$t("signup.mobilePlaceholder"),loading:e.loadingForm,color:e.theme.colors.brandPTextColor,light:"",height:"40",filled:"","append-icon":"mdi-phone-outline",rules:e.mobileRules},model:{value:e.userCredentials.profile.mobile,callback:function(r){e.$set(e.userCredentials.profile,"mobile",r)},expression:"userCredentials.profile.mobile"}})],1),t("v-col",{attrs:{cols:"12",sm:"12",md:"6"}},[t("v-text-field",{attrs:{"background-color":e.theme.colors.brandGrayColor,label:e.$t("ProfileEdit.position"),loading:e.loadingForm,color:e.theme.colors.brandPTextColor,light:"",height:"40",filled:"","append-icon":"mdi-account-outline",rules:e.nameRules},model:{value:e.userCredentials.profile.position,callback:function(r){e.$set(e.userCredentials.profile,"position",r)},expression:"userCredentials.profile.position"}})],1),t("v-col",{attrs:{cols:"12",sm:"12",md:"6"}},[t("v-text-field",{attrs:{"append-icon":e.showPassword?e.svg.visibility:e.svg.visibilityOff,type:e.showPassword?"text":"password",name:"input-10-1","background-color":e.theme.colors.brandGrayColor,label:e.$t("ProfileEdit.newPassword"),placeholder:e.$t("ProfileEdit.resetPassword"),loading:e.loadingForm,color:e.theme.colors.brandPTextColor,height:"40",filled:"",rules:e.passRules,autocomplete:"new-password"},on:{"click:append":function(r){e.showPassword=!e.showPassword}},model:{value:e.newPasswprd,callback:function(r){e.newPasswprd=r},expression:"newPasswprd"}})],1),t("v-col",{attrs:{cols:"12",sm:"12"}},[t("v-text-field",{attrs:{"background-color":e.theme.colors.brandGrayColor,label:e.$t("ProfileEdit.address"),loading:e.loadingForm,color:e.theme.colors.brandPTextColor,light:"",height:"40",filled:"","append-icon":"mdi-account-outline",rules:e.nameRules},model:{value:e.userCredentials.profile.address,callback:function(r){e.$set(e.userCredentials.profile,"address",r)},expression:"userCredentials.profile.address"}})],1),t("v-col",{attrs:{cols:"12",sm:"12"}},[t("v-textarea",{attrs:{type:"text",loading:e.loadingForm,"no-resize":"","background-color":e.theme.colors.brandGrayColor,label:e.$t("Profile.YourBio"),color:e.theme.colors.brandPTextColor,light:"",height:"100",filled:"","append-icon":"mdi-account-card-details",rules:e.bioRules},model:{value:e.userCredentials.profile.bio,callback:function(r){e.$set(e.userCredentials.profile,"bio",r)},expression:"userCredentials.profile.bio"}})],1),t("v-col",{attrs:{cols:"12",sm:"12"}},[e.errors?t("div",{staticClass:"subtitle1 text-center text-capitalize red--text"},e._l(e.errors,(function(r,o){return t("p",{key:o},[e._v(e._s(r))])})),0):e._e()]),t("v-col",{attrs:{cols:"12",sm:"12"}},[t("div",{staticClass:"mt-5"},[t("v-btn",{attrs:{type:"submit",large:"",loading:e.loadingForm,color:e.theme.colors.brandPrimColor,elevation:"0",dark:""}},[e._v("\n                                "+e._s(e.$t("ProfileEdit.submitBtn"))+"\n                            ")])],1)])],1)],1)],1)],1)},l=[],i=t("502e"),n=t("d3a4"),d=t("4a89"),c=t.n(d),u=t("94ed"),m=t("2f62"),p=(t("bc3a"),{mixins:[i["a"]],components:{Avatar:c.a},data(){return{showPassword:!1,newPasswprd:"",nameRules:[e=>!!e||n["a"].messages[this.locale].signup.errors.reqUserName],emailRules:[e=>!!e||n["a"].messages[this.locale].signup.errors.reqEmail,e=>/.+@.+\..+/.test(e)||n["a"].messages[this.locale].signup.errors.emailMustValid],mobileRules:[e=>!!e||n["a"].messages[this.locale].signup.errors.reqMobile,e=>/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/.test(e)||n["a"].messages[this.locale].signup.errors.mobileMustValid],passRules:[e=>e&&e.length>=6||0==e.length||n["a"].t("signup.errors.passMoreThanNChars",{n:"6"})],bioRules:[e=>!!e||n["a"].messages[this.locale].signup.errors.reqBio,e=>e&&e.length>=10||n["a"].t("signup.errors.bioMoreThanNChars",{n:"10"})],svg:{visibility:u["i"],visibilityOff:u["h"],camera:u["c"]}}},methods:{updateProfileHandlerSubmit(){let e=Object({NODE_ENV:"production",VUE_APP_TITLE:"Tamkeen Self Assessment",VUE_APP_API:"http://api.sahlit.com/",BASE_URL:"/"}).VUE_APP_ORG_SLUG,r=window.location.host,t=r.split("."),o=t[0];this.$refs.form.validate()&&this.$store.dispatch("EDIT_USER_DETAILS",{locale:this.locale,organization:e||o,firstname:this.userCredentials.profile.firstname,lastname:this.userCredentials.profile.lastname,mobile:this.userCredentials.profile.mobile,email:this.userCredentials.profile.email,position:this.userCredentials.profile.position,address:this.userCredentials.profile.address,password:this.newPasswprd,bio:this.userCredentials.profile.bio}).then(()=>{this.$router.push({name:"profile"})})},handleImageChange(e){var r=e.target.files[0],t=new FileReader,o=this.$store;t.onload=function(e){return function(e){var r=e.target.result,t=window.btoa(r);const s={image:t};o.dispatch("UPLOAD_IMAGE",s)}}(),t.readAsBinaryString(r)},editImage(){const e=document.getElementById("imageInput");e.click()}},computed:{...Object(m["b"])(["errors","loadingForm","theme","locale","userCredentials"])},beforeDestroy(){this.$store.dispatch("CLEAR_ERROR")},mounted(){}}),f=p,h=(t("f43a"),t("2877")),b=t("6544"),g=t.n(b),v=t("8212"),C=t("8336"),P=t("62ad"),w=t("a523"),x=t("4bd4"),_=t("132d"),E=t("adda"),k=t("0fd9"),$=t("8654"),y=t("a844"),R=t("3a2f"),V=Object(h["a"])(f,a,l,!1,null,"05f7518e",null),T=V.exports;g()(V,{VAvatar:v["a"],VBtn:C["a"],VCol:P["a"],VContainer:w["a"],VForm:x["a"],VIcon:_["a"],VImg:E["a"],VRow:k["a"],VTextField:$["a"],VTextarea:y["a"],VTooltip:R["a"]});var A={components:{AppProfileEditForm:T}},F=A,I=(t("179b"),Object(h["a"])(F,o,s,!1,null,"aee09d60",null));r["default"]=I.exports;g()(I,{VCol:P["a"],VContainer:w["a"],VRow:k["a"]})},f43a:function(e,r,t){"use strict";var o=t("5c7c"),s=t.n(o);s.a}}]);
//# sourceMappingURL=profileEdit.f9be0e46.js.map