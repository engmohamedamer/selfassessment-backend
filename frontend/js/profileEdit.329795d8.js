(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["profileEdit"],{"179b":function(t,e,i){"use strict";var s=i("98f8"),o=i.n(s);o.a},"4f76":function(t,e,i){"use strict";var s=i("f715"),o=i.n(s);o.a},9734:function(t,e,i){},"98f8":function(t,e,i){},c8a9:function(t,e,i){"use strict";i.r(e);var s=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-container",[i("v-row",{staticClass:"ProfileEdit",attrs:{justify:"center"}},[i("v-col",{attrs:{sm:"10",md:"8"}},[i("h2",{staticClass:"mb-5"},[t._v(t._s(t.$t("ProfileEdit.title")))]),i("AppProfileEditForm")],1)],1)],1)},o=[],a=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"profile block"},[i("div",{staticClass:"profile-picture big-profile-picture clear"},[i("v-avatar",{attrs:{size:"150"}},[t.userCredentials.profile.profile_picture?i("v-img",{staticClass:"card-img",attrs:{src:t.userCredentials.profile.profile_picture,avatar:t.userCredentials.profile.firstname}}):i("avatar",{staticClass:"card-img",attrs:{username:t.userCredentials.profile.firstname+" "+t.userCredentials.profile.lastname}}),i("div",{staticClass:"updateAvatar"},[i("input",{attrs:{type:"file",id:"imageInput",hidden:""},on:{change:t.handleImageChange}}),i("v-tooltip",{attrs:{bottom:""},scopedSlots:t._u([{key:"activator",fn:function(e){var s=e.on;return[i("v-btn",t._g({staticClass:"mx-2 btn-primary",attrs:{fab:"",small:"",absolute:"",right:"",bottom:"",dark:""},on:{click:t.editImage}},s),[i("v-icon",{attrs:{dark:""}},[t._v(t._s(t.svg.camera))])],1)]}}])},[i("span",[t._v(t._s(t.$t("Profile.editProfileImg")))])])],1)],1)],1),i("v-form",{ref:"form",staticClass:"edit-profile-form",on:{submit:function(e){return e.preventDefault(),t.updateProfileHandlerSubmit(e)}}},[i("v-container",[i("v-row",[i("v-col",{attrs:{cols:"12",sm:"12",md:"6"}},[i("v-text-field",{attrs:{"background-color":t.theme.colors.brandGrayColor,label:t.$t("ProfileEdit.firstName"),loading:t.loadingForm,color:t.theme.colors.brandPTextColor,light:"",height:"40","append-icon":"mdi-account-outline",rules:t.nameRules,filled:""},model:{value:t.userCredentials.profile.firstname,callback:function(e){t.$set(t.userCredentials.profile,"firstname",e)},expression:"userCredentials.profile.firstname"}})],1),i("v-col",{attrs:{cols:"12",sm:"12",md:"6"}},[i("v-text-field",{attrs:{"background-color":t.theme.colors.brandGrayColor,label:t.$t("ProfileEdit.lastName"),loading:t.loadingForm,color:t.theme.colors.brandPTextColor,light:"",height:"40",filled:"","append-icon":"mdi-account-outline",rules:t.nameRules},model:{value:t.userCredentials.profile.lastname,callback:function(e){t.$set(t.userCredentials.profile,"lastname",e)},expression:"userCredentials.profile.lastname"}})],1),i("v-col",{attrs:{cols:"12",sm:"12",md:"6"}},[i("v-text-field",{attrs:{"background-color":t.theme.colors.brandGrayColor,label:t.$t("signup.emailPlaceholder"),loading:t.loadingForm,color:t.theme.colors.brandPTextColor,light:"",height:"40",filled:"","append-icon":"mdi-email-outline",rules:t.emailRules},model:{value:t.userCredentials.profile.email,callback:function(e){t.$set(t.userCredentials.profile,"email",e)},expression:"userCredentials.profile.email"}})],1),i("v-col",{attrs:{cols:"12",sm:"12",md:"6"}},[i("v-text-field",{attrs:{"background-color":t.theme.colors.brandGrayColor,label:t.$t("signup.mobilePlaceholder"),loading:t.loadingForm,color:t.theme.colors.brandPTextColor,light:"",height:"40",filled:"","append-icon":"mdi-phone-outline",rules:t.mobileRules},model:{value:t.userCredentials.profile.mobile,callback:function(e){t.$set(t.userCredentials.profile,"mobile",e)},expression:"userCredentials.profile.mobile"}})],1),i("v-col",{attrs:{cols:"12",sm:"12",md:"6"}},[i("v-text-field",{attrs:{"background-color":t.theme.colors.brandGrayColor,label:t.$t("ProfileEdit.position"),loading:t.loadingForm,color:t.theme.colors.brandPTextColor,light:"",height:"40",filled:"","append-icon":"mdi-account-outline",rules:t.nameRules},model:{value:t.userCredentials.profile.position,callback:function(e){t.$set(t.userCredentials.profile,"position",e)},expression:"userCredentials.profile.position"}})],1),i("v-col",{attrs:{cols:"12",sm:"12",md:"6"}},[i("v-text-field",{attrs:{"append-icon":t.showPassword?t.svg.visibility:t.svg.visibilityOff,type:t.showPassword?"text":"password",name:"input-10-1","background-color":t.theme.colors.brandGrayColor,label:t.$t("ProfileEdit.newPassword"),placeholder:t.$t("ProfileEdit.resetPassword"),loading:t.loadingForm,color:t.theme.colors.brandPTextColor,height:"40",filled:"",rules:t.passRules,autocomplete:"new-password"},on:{"click:append":function(e){t.showPassword=!t.showPassword}},model:{value:t.newPasswprd,callback:function(e){t.newPasswprd=e},expression:"newPasswprd"}})],1),i("v-col",{attrs:{cols:"12",sm:"12"}},[i("v-text-field",{attrs:{"background-color":t.theme.colors.brandGrayColor,label:t.$t("ProfileEdit.address"),loading:t.loadingForm,color:t.theme.colors.brandPTextColor,light:"",height:"40",filled:"","append-icon":"mdi-account-outline",rules:t.nameRules},model:{value:t.userCredentials.profile.address,callback:function(e){t.$set(t.userCredentials.profile,"address",e)},expression:"userCredentials.profile.address"}})],1),i("v-col",{attrs:{cols:"12",sm:"12"}},[i("v-textarea",{attrs:{type:"text",loading:t.loadingForm,"no-resize":"","background-color":t.theme.colors.brandGrayColor,label:t.$t("Profile.YourBio"),color:t.theme.colors.brandPTextColor,light:"",height:"100",filled:"","append-icon":"mdi-account-card-details",rules:t.bioRules},model:{value:t.userCredentials.profile.bio,callback:function(e){t.$set(t.userCredentials.profile,"bio",e)},expression:"userCredentials.profile.bio"}})],1),i("v-col",{attrs:{cols:"12",sm:"12"}},[t.errors?i("div",{staticClass:"subtitle1 text-center text-capitalize red--text"},t._l(t.errors,(function(e,s){return i("p",{key:s},[t._v(t._s(e))])})),0):t._e()]),i("v-col",{attrs:{cols:"12",sm:"12"}},[i("div",{staticClass:"mt-5"},[i("v-btn",{attrs:{type:"submit",large:"",loading:t.loadingForm,color:t.theme.colors.brandPrimColor,elevation:"0",dark:""}},[t._v("\n                                "+t._s(t.$t("ProfileEdit.submitBtn"))+"\n                            ")])],1)])],1)],1)],1)],1)},r=[],n=i("502e"),l=i("d3a4"),d=i("4a89"),c=i.n(d),h=i("94ed"),u=i("2f62"),f=(i("bc3a"),{mixins:[n["a"]],components:{Avatar:c.a},data(){return{showPassword:!1,newPasswprd:"",nameRules:[t=>!!t||l["a"].messages[this.locale].errorsList.signup.errors.reqUserName],emailRules:[t=>!!t||l["a"].messages[this.locale].errorsList.signup.errors.reqEmail,t=>/.+@.+\..+/.test(t)||l["a"].messages[this.locale].errorsList.signup.errors.emailMustValid],mobileRules:[t=>!!t||l["a"].messages[this.locale].errorsList.signup.errors.reqMobile,t=>/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/.test(t)||l["a"].messages[this.locale].errorsList.signup.errors.mobileMustValid],passRules:[t=>t&&t.length>=6||0==t.length||l["a"].t("errorsList.signup.errors.passMoreThanNChars",{n:"6"})],bioRules:[t=>!!t||l["a"].messages[this.locale].errorsList.signup.errors.reqBio,t=>t&&t.length>=10||l["a"].t("errorsList.signup.errors.bioMoreThanNChars",{n:"10"})],svg:{visibility:h["j"],visibilityOff:h["i"],camera:h["d"]}}},methods:{updateProfileHandlerSubmit(){let t=Object({NODE_ENV:"production",VUE_APP_TITLE:"Tamkeen Self Assessment",VUE_APP_API:"http://api.tamkeentechlab.com/",BASE_URL:"/"}).VUE_APP_ORG_SLUG,e=window.location.host,i=e.split("."),s=i[0];this.$refs.form.validate()&&this.$store.dispatch("EDIT_USER_DETAILS",{locale:this.locale,organization:t||s,firstname:this.userCredentials.profile.firstname,lastname:this.userCredentials.profile.lastname,mobile:this.userCredentials.profile.mobile,email:this.userCredentials.profile.email,position:this.userCredentials.profile.position,address:this.userCredentials.profile.address,password:this.newPasswprd,bio:this.userCredentials.profile.bio}).then(()=>{this.$router.push({name:"profile"})})},handleImageChange(t){var e=t.target.files[0],i=new FileReader,s=this.$store;i.onload=function(t){return function(t){var e=t.target.result,i=window.btoa(e);const o={image:i};s.dispatch("UPLOAD_IMAGE",o)}}(),i.readAsBinaryString(e)},editImage(){const t=document.getElementById("imageInput");t.click()}},computed:{...Object(u["b"])(["errors","loadingForm","theme","locale","userCredentials"])},beforeDestroy(){this.$store.dispatch("CLEAR_ERROR")},mounted(){}}),p=f,m=(i("4f76"),i("2877")),g=i("6544"),v=i.n(g),b=i("8212"),w=i("8336"),C=i("62ad"),x=i("a523"),y=i("4bd4"),P=i("132d"),k=i("adda"),A=i("0fd9"),O=i("8654"),T=i("a844"),_=(i("9734"),i("4ad4")),L=i("a9ad"),I=i("16b7"),$=i("b848"),E=i("75eb"),R=i("f573"),F=i("f2e7"),S=i("80d2"),Y=i("d9bd"),B=i("58df"),N=Object(B["a"])(L["a"],I["a"],$["a"],E["a"],R["a"],F["a"]).extend({name:"v-tooltip",props:{closeDelay:{type:[Number,String],default:0},disabled:Boolean,fixed:{type:Boolean,default:!0},openDelay:{type:[Number,String],default:0},openOnHover:{type:Boolean,default:!0},tag:{type:String,default:"span"},transition:String,zIndex:{default:null}},data:()=>({calculatedMinWidth:0,closeDependents:!1}),computed:{calculatedLeft(){const{activator:t,content:e}=this.dimensions,i=!this.bottom&&!this.left&&!this.top&&!this.right,s=!1!==this.attach?t.offsetLeft:t.left;let o=0;return this.top||this.bottom||i?o=s+t.width/2-e.width/2:(this.left||this.right)&&(o=s+(this.right?t.width:-e.width)+(this.right?10:-10)),this.nudgeLeft&&(o-=parseInt(this.nudgeLeft)),this.nudgeRight&&(o+=parseInt(this.nudgeRight)),`${this.calcXOverflow(o,this.dimensions.content.width)}px`},calculatedTop(){const{activator:t,content:e}=this.dimensions,i=!1!==this.attach?t.offsetTop:t.top;let s=0;return this.top||this.bottom?s=i+(this.bottom?t.height:-e.height)+(this.bottom?10:-10):(this.left||this.right)&&(s=i+t.height/2-e.height/2),this.nudgeTop&&(s-=parseInt(this.nudgeTop)),this.nudgeBottom&&(s+=parseInt(this.nudgeBottom)),`${this.calcYOverflow(s+this.pageYOffset)}px`},classes(){return{"v-tooltip--top":this.top,"v-tooltip--right":this.right,"v-tooltip--bottom":this.bottom,"v-tooltip--left":this.left}},computedTransition(){return this.transition?this.transition:this.isActive?"scale-transition":"fade-transition"},offsetY(){return this.top||this.bottom},offsetX(){return this.left||this.right},styles(){return{left:this.calculatedLeft,maxWidth:Object(S["f"])(this.maxWidth),minWidth:Object(S["f"])(this.minWidth),opacity:this.isActive?.9:0,top:this.calculatedTop,zIndex:this.zIndex||this.activeZIndex}}},beforeMount(){this.$nextTick(()=>{this.value&&this.callActivate()})},mounted(){"v-slot"===Object(S["r"])(this,"activator",!0)&&Object(Y["b"])("v-tooltip's activator slot must be bound, try '<template #activator=\"data\"><v-btn v-on=\"data.on>'",this)},methods:{activate(){this.updateDimensions(),requestAnimationFrame(this.startTransition)},deactivate(){this.runDelay("close")},genActivatorListeners(){const t=_["a"].options.methods.genActivatorListeners.call(this);return t.focus=t=>{this.getActivator(t),this.runDelay("open")},t.blur=t=>{this.getActivator(t),this.runDelay("close")},t.keydown=t=>{t.keyCode===S["v"].esc&&(this.getActivator(t),this.runDelay("close"))},t}},render(t){const e=t("div",this.setBackgroundColor(this.color,{staticClass:"v-tooltip__content",class:{[this.contentClass]:!0,menuable__content__active:this.isActive,"v-tooltip__content--fixed":this.activatorFixed},style:this.styles,attrs:this.getScopeIdAttrs(),directives:[{name:"show",value:this.isContentActive}],ref:"content"}),this.showLazyContent(this.getContentSlot()));return t(this.tag,{staticClass:"v-tooltip",class:this.classes},[t("transition",{props:{name:this.computedTransition}},[e]),this.genActivator()])}}),W=Object(m["a"])(p,a,r,!1,null,"6cc70c37",null),D=W.exports;v()(W,{VAvatar:b["a"],VBtn:w["a"],VCol:C["a"],VContainer:x["a"],VForm:y["a"],VIcon:P["a"],VImg:k["a"],VRow:A["a"],VTextField:O["a"],VTextarea:T["a"],VTooltip:N});var M={components:{AppProfileEditForm:D}},V=M,X=(i("179b"),Object(m["a"])(V,s,o,!1,null,"aee09d60",null));e["default"]=X.exports;v()(X,{VCol:C["a"],VContainer:x["a"],VRow:A["a"]})},f573:function(t,e,i){"use strict";var s=i("fe6c"),o=i("21be"),a=i("4ad4"),r=i("58df"),n=i("80d2");const l=Object(r["a"])(o["a"],s["a"],a["a"]);e["a"]=l.extend().extend({name:"menuable",props:{allowOverflow:Boolean,light:Boolean,dark:Boolean,maxWidth:{type:[Number,String],default:"auto"},minWidth:[Number,String],nudgeBottom:{type:[Number,String],default:0},nudgeLeft:{type:[Number,String],default:0},nudgeRight:{type:[Number,String],default:0},nudgeTop:{type:[Number,String],default:0},nudgeWidth:{type:[Number,String],default:0},offsetOverflow:Boolean,openOnClick:Boolean,positionX:{type:Number,default:null},positionY:{type:Number,default:null},zIndex:{type:[Number,String],default:null}},data:()=>({absoluteX:0,absoluteY:0,activatedBy:null,activatorFixed:!1,dimensions:{activator:{top:0,left:0,bottom:0,right:0,width:0,height:0,offsetTop:0,scrollHeight:0,offsetLeft:0},content:{top:0,left:0,bottom:0,right:0,width:0,height:0,offsetTop:0,scrollHeight:0}},hasJustFocused:!1,hasWindow:!1,inputActivator:!1,isContentActive:!1,pageWidth:0,pageYOffset:0,stackClass:"v-menu__content--active",stackMinZIndex:6}),computed:{computedLeft(){const t=this.dimensions.activator,e=this.dimensions.content,i=(!1!==this.attach?t.offsetLeft:t.left)||0,s=Math.max(t.width,e.width);let o=0;if(o+=this.left?i-(s-t.width):i,this.offsetX){const e=isNaN(Number(this.maxWidth))?t.width:Math.min(t.width,Number(this.maxWidth));o+=this.left?-e:t.width}return this.nudgeLeft&&(o-=parseInt(this.nudgeLeft)),this.nudgeRight&&(o+=parseInt(this.nudgeRight)),o},computedTop(){const t=this.dimensions.activator,e=this.dimensions.content;let i=0;return this.top&&(i+=t.height-e.height),!1!==this.attach?i+=t.offsetTop:i+=t.top+this.pageYOffset,this.offsetY&&(i+=this.top?-t.height:t.height),this.nudgeTop&&(i-=parseInt(this.nudgeTop)),this.nudgeBottom&&(i+=parseInt(this.nudgeBottom)),i},hasActivator(){return!!this.$slots.activator||!!this.$scopedSlots.activator||!!this.activator||!!this.inputActivator}},watch:{disabled(t){t&&this.callDeactivate()},isActive(t){this.disabled||(t?this.callActivate():this.callDeactivate())},positionX:"updateDimensions",positionY:"updateDimensions"},beforeMount(){this.hasWindow="undefined"!==typeof window},methods:{absolutePosition(){return{offsetTop:0,offsetLeft:0,scrollHeight:0,top:this.positionY||this.absoluteY,bottom:this.positionY||this.absoluteY,left:this.positionX||this.absoluteX,right:this.positionX||this.absoluteX,height:0,width:0}},activate(){},calcLeft(t){return Object(n["f"])(!1!==this.attach?this.computedLeft:this.calcXOverflow(this.computedLeft,t))},calcTop(){return Object(n["f"])(!1!==this.attach?this.computedTop:this.calcYOverflow(this.computedTop))},calcXOverflow(t,e){const i=t+e-this.pageWidth+12;return t=(!this.left||this.right)&&i>0?Math.max(t-i,0):Math.max(t,12),t+this.getOffsetLeft()},calcYOverflow(t){const e=this.getInnerHeight(),i=this.pageYOffset+e,s=this.dimensions.activator,o=this.dimensions.content.height,a=t+o,r=i<a;return r&&this.offsetOverflow&&s.top>o?t=this.pageYOffset+(s.top-o):r&&!this.allowOverflow?t=i-o-12:t<this.pageYOffset&&!this.allowOverflow&&(t=this.pageYOffset+12),t<12?12:t},callActivate(){this.hasWindow&&this.activate()},callDeactivate(){this.isContentActive=!1,this.deactivate()},checkForPageYOffset(){this.hasWindow&&(this.pageYOffset=this.activatorFixed?0:this.getOffsetTop())},checkActivatorFixed(){if(!1!==this.attach)return;let t=this.getActivator();while(t){if("fixed"===window.getComputedStyle(t).position)return void(this.activatorFixed=!0);t=t.offsetParent}this.activatorFixed=!1},deactivate(){},genActivatorListeners(){const t=a["a"].options.methods.genActivatorListeners.call(this),e=t.click;return t.click=t=>{this.openOnClick&&e&&e(t),this.absoluteX=t.clientX,this.absoluteY=t.clientY},t},getInnerHeight(){return this.hasWindow?window.innerHeight||document.documentElement.clientHeight:0},getOffsetLeft(){return this.hasWindow?window.pageXOffset||document.documentElement.scrollLeft:0},getOffsetTop(){return this.hasWindow?window.pageYOffset||document.documentElement.scrollTop:0},getRoundedBoundedClientRect(t){const e=t.getBoundingClientRect();return{top:Math.round(e.top),left:Math.round(e.left),bottom:Math.round(e.bottom),right:Math.round(e.right),width:Math.round(e.width),height:Math.round(e.height)}},measure(t){if(!t||!this.hasWindow)return null;const e=this.getRoundedBoundedClientRect(t);if(!1!==this.attach){const i=window.getComputedStyle(t);e.left=parseInt(i.marginLeft),e.top=parseInt(i.marginTop)}return e},sneakPeek(t){requestAnimationFrame(()=>{const e=this.$refs.content;e&&"none"===e.style.display?(e.style.display="inline-block",t(),e.style.display="none"):t()})},startTransition(){return new Promise(t=>requestAnimationFrame(()=>{this.isContentActive=this.hasJustFocused=this.isActive,t()}))},updateDimensions(){this.hasWindow="undefined"!==typeof window,this.checkActivatorFixed(),this.checkForPageYOffset(),this.pageWidth=document.documentElement.clientWidth;const t={};if(!this.hasActivator||this.absolute)t.activator=this.absolutePosition();else{const e=this.getActivator();if(!e)return;t.activator=this.measure(e),t.activator.offsetLeft=e.offsetLeft,!1!==this.attach?t.activator.offsetTop=e.offsetTop:t.activator.offsetTop=0}this.sneakPeek(()=>{t.content=this.measure(this.$refs.content),this.dimensions=t})}}})},f715:function(t,e,i){}}]);
//# sourceMappingURL=profileEdit.329795d8.js.map