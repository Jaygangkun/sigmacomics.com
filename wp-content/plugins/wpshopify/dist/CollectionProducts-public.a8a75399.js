"use strict";(self.webpackChunkshopwp=self.webpackChunkshopwp||[]).push([["CollectionProducts-public"],{qVXd:function(e,t,l){l.r(t),l.d(t,{default:function(){return C}});var o=l("XUG9"),a=l("E5I5"),n=l("udXY"),s=l("a2wX"),r=l("UOCU"),i=l("eyhd"),c=l("XTMG"),p=l("CfeJ"),u=l("2SHZ"),d=l("jdSA"),S={name:"y0nm4u-CollectionsSortingWrapperCSS",styles:"width:100%;display:flex;align-items:flex-end;justify-content:flex-end;margin-bottom:20px;align-items:baseline;#swp-collections-sorting *:hover{cursor:pointer;};label:CollectionsSortingWrapperCSS;"},f=function(e){var t=e.payloadSettings,l=(0,d.O)(),o=(0,d.Q)(),n=S,s=[{label:"Title (A-Z)",value:"TITLE"},{label:"Title (Z-A)",value:"TITLE-REVERSE"},{label:"Price (Low to high)",value:"PRICE"},{label:"Price (high to low)",value:"PRICE-REVERSE"},{label:"Best Selling",value:"BEST_SELLING"},{label:"Recently Added",value:"CREATED"},{label:"Collection default",value:"COLLECTION_DEFAULT"},{label:"Manual",value:"MANUAL"}];return(0,c.tZ)("div",{css:n},o.isLoading&&(0,c.tZ)(u.default,{color:"#000"}),(0,c.tZ)(p.Z,{labelText:wp.i18n.__("Sort by:","shopwp"),selectId:"swp-collections-sorting",options:s,customOnChange:function(e){l({type:"SET_QUERY_TYPE",payload:"collectionProducts"}),l({type:"MERGE_QUERY_PARAMS_COLLECTION_PRODUCTS",payload:(0,a.OW)(e.value)}),l({type:"SET_IS_FETCHING_NEW",payload:!0})},defaultValue:(0,a.j5)(s,t.sortBy,t.reverse),isLoading:o.isLoading}))},C=function(e){var t=e.payloadSettings,l=e.componentId,c=(0,wp.element.useContext)(i.W),p=(0,o.Z)(c,1)[0];return(0,n.vI)(React.createElement(s.o,{options:p.productOptions,componentId:l},t.sorting&&React.createElement(f,{payloadSettings:t}),React.createElement(r.Z,null)),(0,a.tu)(t.dropzoneCollectionProducts))}},CfeJ:function(e,t,l){var o=l("GYXz"),a=l("XUG9"),n=l("ILDY"),s=l.n(n),r=l("XTMG"),i=l("udXY"),c=l("JTAO"),p={name:"vf0cu2-SelectWrapperCSS",styles:"display:flex;align-items:center;margin-left:20px;#swp-sortby *:hover,#swp-pagesize *:hover{cursor:pointer;}div[class*='control']{border-color:#aeaeae;};label:SelectWrapperCSS;"},u={name:"1ryp790-LabelCSS",styles:"font-weight:bold;text-align:right;padding-right:10px;font-size:15px;label:LabelCSS;"},d={name:"1991tl3-SelectCSS",styles:"width:200px;&:hover{cursor:pointer;}&:disabled{&:hover{cursor:not-allowed;}};label:SelectCSS;"};t.Z=function(e){var t=e.dropzone,l=e.labelText,n=e.selectId,S=e.options,f=e.isLoading,C=e.customOnChange,E=e.defaultValue,b=(0,wp.element.useState)(E),g=(0,a.Z)(b,2),h=g[0],v=g[1],y=d,m=u,w=p;function T(){return(T=(0,o.Z)(s().mark((function e(t){return s().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:v(t),C(t);case 2:case"end":return e.stop()}}),e)})))).apply(this,arguments)}return(0,i.vI)((0,r.tZ)("div",{className:"swp-select","aria-label":"Sort products",css:w},(0,r.tZ)("label",{htmlFor:n,css:m},l),(0,r.tZ)(c.ZP,{id:n,css:y,value:h,onChange:function(e){return T.apply(this,arguments)},options:S,defaultValue:E,isDisabled:f})),document.querySelector(t))}}}]);