"use strict";(self.webpackChunkshopwp=self.webpackChunkshopwp||[]).push([["StorefrontPageSize-public"],{senq:function(e,t,a){a.r(t);var n=a("XTMG"),s=a("jdSA"),o=a("E5I5"),l=a("CfeJ");t.default=function(e){var t=e.isLoading,a=e.payloadSettings,r=(0,s.O)(),i=a.sortingOptionsPageSize;return(0,n.tZ)(l.Z,{dropzone:a.dropzonePageSize,labelText:a.pageSizeLabelText,selectId:"swp-pagesize",options:i,isLoading:t,customOnChange:function(e){r({type:"MERGE_QUERY_PARAMS",payload:{first:parseInt(e.value)}}),r({type:"SET_IS_FETCHING_NEW",payload:!0})},defaultValue:(0,o.j5)(i,a.pageSize)})}},CfeJ:function(e,t,a){var n=a("GYXz"),s=a("XUG9"),o=a("ILDY"),l=a.n(o),r=a("XTMG"),i=a("udXY"),p=a("JTAO"),c={name:"vf0cu2-SelectWrapperCSS",styles:"display:flex;align-items:center;margin-left:20px;#swp-sortby *:hover,#swp-pagesize *:hover{cursor:pointer;}div[class*='control']{border-color:#aeaeae;};label:SelectWrapperCSS;"},u={name:"1ryp790-LabelCSS",styles:"font-weight:bold;text-align:right;padding-right:10px;font-size:15px;label:LabelCSS;"},d={name:"1991tl3-SelectCSS",styles:"width:200px;&:hover{cursor:pointer;}&:disabled{&:hover{cursor:not-allowed;}};label:SelectCSS;"};t.Z=function(e){var t=e.dropzone,a=e.labelText,o=e.selectId,S=e.options,f=e.isLoading,g=e.customOnChange,h=e.defaultValue,b=(0,wp.element.useState)(h),v=(0,s.Z)(b,2),w=v[0],y=v[1],C=d,m=u,z=c;function x(){return(x=(0,n.Z)(l().mark((function e(t){return l().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:y(t),g(t);case 2:case"end":return e.stop()}}),e)})))).apply(this,arguments)}return(0,i.vI)((0,r.tZ)("div",{className:"swp-select","aria-label":"Sort products",css:z},(0,r.tZ)("label",{htmlFor:o,css:m},a),(0,r.tZ)(p.ZP,{id:o,css:C,value:w,onChange:function(e){return x.apply(this,arguments)},options:S,defaultValue:h,isDisabled:f})),document.querySelector(t))}}}]);