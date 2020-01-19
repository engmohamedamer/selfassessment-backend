(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["profileEdit"],{1628:function(t,e,s){},"3e21":function(t,e,s){"use strict";var i=s("9c70"),o=s.n(i);o.a},"5e22":function(t,e,s){"use strict";var i=s("1628"),o=s.n(i);o.a},9734:function(t,e,s){},"9c70":function(t,e,s){},c8a9:function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("v-container",[s("v-row",{staticClass:"ProfileEdit",attrs:{justify:"center"}},[s("v-col",{attrs:{sm:"10",md:"6"}},[s("h2",{staticClass:"mb-5"},[t._v(t._s(t.$t("ProfileEdit.title")))]),s("AppProfileEditForm")],1)],1)],1)},o=[],a=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"profile block"},[s("div",{staticClass:"profile-picture big-profile-picture clear"},[s("v-avatar",{attrs:{size:"150"}},[t.userCredentials.profile.profile_picture?s("v-img",{staticClass:"card-img",attrs:{src:t.userCredentials.profile.profile_picture,avatar:t.userCredentials.profile.firstname}}):s("avatar",{staticClass:"card-img",attrs:{username:t.userCredentials.profile.firstname+" "+t.userCredentials.profile.lastname}}),s("div",{staticClass:"updateAvatar"},[s("input",{attrs:{type:"file",id:"imageInput",hidden:""},on:{change:t.handleImageChange}}),s("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var i=e.on;return[s("v-btn",t._g({staticClass:"mx-2 btn-primary",attrs:{fab:"",small:"",absolute:"",right:"",bottom:"",dark:""},on:{click:t.editImage}},i),[s("v-icon",{attrs:{dark:""}},[t._v(t._s(t.svg.camera))])],1)]}}])},[s("span",[t._v(t._s(t.$t("Profile.editProfileImg")))])])],1)],1)],1),s("v-form",{ref:"form",staticClass:"edit-profile-form",on:{submit:function(e){return e.preventDefault(),t.updateProfileHandlerSubmit(e)}}},[s("v-container",[s("v-row",[s("v-col",{attrs:{cols:"12",sm:"12",md:"6"}},[s("v-text-field",{attrs:{"background-color":t.theme.colors.brandGrayColor,label:t.$t("ProfileEdit.firstName"),loading:t.loadingForm,color:t.theme.colors.brandPTextColor,light:"",height:"40","append-icon":"mdi-account-outline",rules:t.nameRules,filled:""},model:{value:t.userCredentials.profile.firstname,callback:function(e){t.$set(t.userCredentials.profile,"firstname",e)},expression:"userCredentials.profile.firstname"}})],1),s("v-col",{attrs:{cols:"12",sm:"12",md:"6"}},[s("v-text-field",{attrs:{"background-color":t.theme.colors.brandGrayColor,label:t.$t("ProfileEdit.lastName"),loading:t.loadingForm,color:t.theme.colors.brandPTextColor,light:"",height:"40",filled:"","append-icon":"mdi-account-outline",rules:t.nameRules},model:{value:t.userCredentials.profile.lastname,callback:function(e){t.$set(t.userCredentials.profile,"lastname",e)},expression:"userCredentials.profile.lastname"}})],1),s("v-col",{attrs:{cols:"12",sm:"12",md:"6"}},[s("v-text-field",{attrs:{"background-color":t.theme.colors.brandGrayColor,label:t.$t("signup.emailPlaceholder"),loading:t.loadingForm,color:t.theme.colors.brandPTextColor,light:"",height:"40",filled:"","append-icon":"mdi-email-outline",rules:t.emailRules},model:{value:t.userCredentials.profile.email,callback:function(e){t.$set(t.userCredentials.profile,"email",e)},expression:"userCredentials.profile.email"}})],1),s("v-col",{attrs:{cols:"12",sm:"12",md:"6"}},[s("v-text-field",{attrs:{"background-color":t.theme.colors.brandGrayColor,label:t.$t("signup.mobilePlaceholder"),loading:t.loadingForm,color:t.theme.colors.brandPTextColor,light:"",height:"40",filled:"","append-icon":"mdi-phone-outline",rules:t.mobileRules},model:{value:t.userCredentials.profile.mobile,callback:function(e){t.$set(t.userCredentials.profile,"mobile",e)},expression:"userCredentials.profile.mobile"}})],1),s("v-col",{attrs:{cols:"12",sm:"12"}},[s("v-text-field",{attrs:{"append-icon":t.showPassword?t.svg.visibility:t.svg.visibilityOff,type:t.showPassword?"text":"password",name:"input-10-1","background-color":t.theme.colors.brandGrayColor,label:t.$t("ProfileEdit.newPassword"),placeholder:t.$t("ProfileEdit.resetPassword"),loading:t.loadingForm,color:t.theme.colors.brandPTextColor,height:"40",filled:"",rules:t.passRules,autocomplete:"new-password"},on:{"click:append":function(e){t.showPassword=!t.showPassword}},model:{value:t.newPasswprd,callback:function(e){t.newPasswprd=e},expression:"newPasswprd"}})],1),s("v-col",{attrs:{cols:"12",sm:"12"}},[t.errors?s("div",{staticClass:"subtitle1 text-center text-capitalize red--text"},t._l(t.errors,function(e,i){return s("p",{key:i},[t._v(t._s(e))])}),0):t._e()]),s("v-col",{attrs:{cols:"12",sm:"12"}},[s("div",{staticClass:"mt-5"},[s("v-btn",{attrs:{type:"submit",large:"",loading:t.loadingForm,color:t.theme.colors.brandPrimColor,elevation:"0",dark:""}},[t._v("\n                                "+t._s(t.$t("ProfileEdit.submitBtn"))+"\n                            ")])],1)])],1)],1)],1)],1)},r=[],l=s("502e"),n=s("d3a4"),c=s("4a89"),d=s.n(c),h=s("94ed"),u=s("2f62"),m=(s("bc3a"),{mixins:[l["a"]],components:{Avatar:d.a},data(){return{showPassword:!1,newPasswprd:"",nameRules:[t=>!!t||n["a"].messages[this.locale].errorsList.signup.errors.reqUserName],emailRules:[t=>!!t||n["a"].messages[this.locale].errorsList.signup.errors.reqEmail,t=>/.+@.+\..+/.test(t)||n["a"].messages[this.locale].errorsList.signup.errors.emailMustValid],mobileRules:[t=>!!t||n["a"].messages[this.locale].errorsList.signup.errors.reqMobile,t=>/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/.test(t)||n["a"].messages[this.locale].errorsList.signup.errors.mobileMustValid],passRules:[t=>t&&t.length>=6||0==t.length||n["a"].t("errorsList.signup.errors.passMoreThanNChars",{n:"6"})],svg:{visibility:h["j"],visibilityOff:h["i"],camera:h["d"]}}},methods:{updateProfileHandlerSubmit(){let t=Object({NODE_ENV:"production",VUE_APP_API:"http://api.sahlit.com/",VUE_APP_TITLE:"Tamkeen Self Assessment",BASE_URL:"/"}).VUE_APP_ORG_SLUG,e=window.location.host,s=e.split("."),i=s[0];this.$refs.form.validate()&&this.$store.dispatch("EDIT_USER_DETAILS",{locale:this.locale,organization:t||i,firstname:this.userCredentials.profile.firstname,lastname:this.userCredentials.profile.lastname,mobile:this.userCredentials.profile.mobile,email:this.userCredentials.profile.email,position:this.userCredentials.profile.position,password:this.newPasswprd}).then(()=>{this.$router.push({name:"profile"})})},handleImageChange(t){var e=t.target.files[0],s=new FileReader,i=this.$store;s.onload=function(t){return function(t){var e=t.target.result,s=window.btoa(e);const o={image:s};i.dispatch("UPLOAD_IMAGE",o)}}(),s.readAsBinaryString(e)},editImage(){const t=document.getElementById("imageInput");t.click()}},computed:{...Object(u["b"])(["errors","loadingForm","theme","locale","userCredentials"])},beforeDestroy(){this.$store.dispatch("CLEAR_ERROR")},mounted(){}}),p=m,f=(s("5e22"),s("2877")),g=s("6544"),v=s.n(g),b=s("8212"),C=s("8336"),w=s("62ad"),P=s("a523"),_=s("4bd4"),y=s("132d"),x=s("adda"),A=s("0fd9"),E=s("8654"),k=(s("9734"),s("4ad4")),I=s("a9ad"),$=s("16b7"),T=s("b848"),R=s("75eb"),L=s("f573"),O=s("f2e7"),V=s("80d2"),S=s("d9bd"),D=s("58df"),F=Object(D["a"])(I["a"],$["a"],T["a"],R["a"],L["a"],O["a"]).extend({name:"v-tooltip",props:{closeDelay:{type:[Number,String],default:0},disabled:Boolean,fixed:{type:Boolean,default:!0},openDelay:{type:[Number,String],default:0},openOnHover:{type:Boolean,default:!0},tag:{type:String,default:"span"},transition:String,zIndex:{default:null}},data:()=>({calculatedMinWidth:0,closeDependents:!1}),computed:{calculatedLeft(){const{activator:t,content:e}=this.dimensions,s=!this.bottom&&!this.left&&!this.top&&!this.right,i=!1!==this.attach?t.offsetLeft:t.left;let o=0;return this.top||this.bottom||s?o=i+t.width/2-e.width/2:(this.left||this.right)&&(o=i+(this.right?t.width:-e.width)+(this.right?10:-10)),this.nudgeLeft&&(o-=parseInt(this.nudgeLeft)),this.nudgeRight&&(o+=parseInt(this.nudgeRight)),`${this.calcXOverflow(o,this.dimensions.content.width)}px`},calculatedTop(){const{activator:t,content:e}=this.dimensions,s=!1!==this.attach?t.offsetTop:t.top;let i=0;return this.top||this.bottom?i=s+(this.bottom?t.height:-e.height)+(this.bottom?10:-10):(this.left||this.right)&&(i=s+t.height/2-e.height/2),this.nudgeTop&&(i-=parseInt(this.nudgeTop)),this.nudgeBottom&&(i+=parseInt(this.nudgeBottom)),`${this.calcYOverflow(i+this.pageYOffset)}px`},classes(){return{"v-tooltip--top":this.top,"v-tooltip--right":this.right,"v-tooltip--bottom":this.bottom,"v-tooltip--left":this.left}},computedTransition(){return this.transition?this.transition:this.isActive?"scale-transition":"fade-transition"},offsetY(){return this.top||this.bottom},offsetX(){return this.left||this.right},styles(){return{left:this.calculatedLeft,maxWidth:Object(V["f"])(this.maxWidth),minWidth:Object(V["f"])(this.minWidth),opacity:this.isActive?.9:0,top:this.calculatedTop,zIndex:this.zIndex||this.activeZIndex}}},beforeMount(){this.$nextTick(()=>{this.value&&this.callActivate()})},mounted(){"v-slot"===Object(V["r"])(this,"activator",!0)&&Object(S["b"])("v-tooltip's activator slot must be bound, try '<template #activator=\"data\"><v-btn v-on=\"data.on>'",this)},methods:{activate(){this.updateDimensions(),requestAnimationFrame(this.startTransition)},deactivate(){this.runDelay("close")},genActivatorListeners(){const t=k["a"].options.methods.genActivatorListeners.call(this);return t.focus=t=>{this.getActivator(t),this.runDelay("open")},t.blur=t=>{this.getActivator(t),this.runDelay("close")},t.keydown=t=>{t.keyCode===V["v"].esc&&(this.getActivator(t),this.runDelay("close"))},t}},render(t){const e=t("div",this.setBackgroundColor(this.color,{staticClass:"v-tooltip__content",class:{[this.contentClass]:!0,menuable__content__active:this.isActive,"v-tooltip__content--fixed":this.activatorFixed},style:this.styles,attrs:this.getScopeIdAttrs(),directives:[{name:"show",value:this.isContentActive}],ref:"content"}),this.showLazyContent(this.getContentSlot()));return t(this.tag,{staticClass:"v-tooltip",class:this.classes},[t("transition",{props:{name:this.computedTransition}},[e]),this.genActivator()])}}),j=Object(f["a"])(p,a,r,!1,null,"41d9e536",null),B=j.exports;v()(j,{VAvatar:b["a"],VBtn:C["a"],VCol:w["a"],VContainer:P["a"],VForm:_["a"],VIcon:y["a"],VImg:x["a"],VRow:A["a"],VTextField:E["a"],VTooltip:F});var G={components:{AppProfileEditForm:B}},N=G,U=(s("3e21"),Object(f["a"])(N,i,o,!1,null,"126dcfe2",null));e["default"]=U.exports;v()(U,{VCol:w["a"],VContainer:P["a"],VRow:A["a"]})}}]);
//# sourceMappingURL=profileEdit.31b0115e.js.map