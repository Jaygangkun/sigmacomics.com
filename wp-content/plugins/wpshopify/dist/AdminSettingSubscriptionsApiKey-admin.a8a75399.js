"use strict";(self.webpackChunkshopwp=self.webpackChunkshopwp||[]).push([["AdminSettingSubscriptionsApiKey-admin"],{bhkL:function(e,t,n){n.r(t);var r=n("/0+J"),a=n("oYSA"),p=n("o0o1"),s=n.n(p),i=n("xblO"),o=n("PgSa"),c=n("Ancs"),u=n("UWz1"),l=n("FxId");function h(){var e=arguments.length>0&&void 0!==arguments[0]&&arguments[0];return e||(e=wpshopify.settings.general.rechargeApiKey),e?e.substring(e.length-30):""}var f={name:"3pm7kj-ErrorCSS",styles:".components-notice{width:100%;margin-top:0;}.components-button{top:0px;};label:ErrorCSS;"},y={name:"7736dr-RowCSS",styles:"display:flex;justify-content:space-between;margin-bottom:22px;position:relative;.components-base-control{flex:1;margin-right:8px;}.components-button{position:relative;top:20px;top:25px;height:31px;justify-content:center;}.shopwp-help{margin-top:-15px!important;font-size:12px;color:rgb(117, 117, 117);};label:RowCSS;"};t.default=function(){var e=wp.components,t=e.TextControl,n=e.Button,p=e.Notice,g=wp.element,d=g.useState,b=(0,g.useContext)(c.Z),w=(0,a.Z)(b,2)[1],m=d(!1),S=(0,a.Z)(m,2),x=S[0],v=S[1],Z=d(wpshopify.settings.general.rechargeApiKey),_=(0,a.Z)(Z,2),k=_[0],A=_[1],C=d((function(){return!!wpshopify.settings.general.rechargeApiKey})),E=(0,a.Z)(C,2),R=E[0],I=E[1],T=d(!1),P=(0,a.Z)(T,2),K=P[0],O=P[1];function N(){return N=(0,r.Z)(s().mark((function e(){var t,n,r,p;return s().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return v(!1),O(!0),w({type:"RESET_NOTICES"}),e.next=5,(0,l.Z)((0,o.ff)({apiKey:k}));case 5:if(t=e.sent,n=(0,a.Z)(t,2),r=n[0],p=n[1],O(!1),!r){e.next=13;break}return v(r.message),e.abrupt("return");case 13:if(!(0,o.nq)(p)){e.next=16;break}return v((0,o.OM)(p)),e.abrupt("return");case 16:I(!0),A(h(p.data)),w({type:"UPDATE_NOTICES",payload:(0,u.hS)("Successfully activated Recharge API key")});case 19:case"end":return e.stop()}}),e)}))),N.apply(this,arguments)}function j(){return j=(0,r.Z)(s().mark((function e(){var t,n,r,p;return s().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return v(!1),O(!0),w({type:"RESET_NOTICES"}),e.next=5,(0,l.Z)((0,o.ko)({apiKey:k}));case 5:if(t=e.sent,n=(0,a.Z)(t,2),r=n[0],p=n[1],O(!1),!r){e.next=14;break}return v(r.message),O(!1),e.abrupt("return");case 14:if(!(0,o.nq)(p)){e.next=17;break}return v((0,o.OM)(p)),e.abrupt("return");case 17:I(!1),A(""),w({type:"UPDATE_NOTICES",payload:(0,u.hS)("Successfully deactivated Recharge API key")});case 20:case"end":return e.stop()}}),e)}))),j.apply(this,arguments)}var D=y,M=f;return(0,i.tZ)(React.Fragment,null,(0,i.tZ)("div",{css:D},(0,i.tZ)(t,{type:"text",value:k,onChange:function(e){A(e)},disabled:K||R,placeholder:wp.i18n.__("Enter your Recharge api key here","shopwp"),label:wp.i18n.__("Recharge API Key","shopwp")}),(0,i.tZ)(n,{onClick:R?function(){return j.apply(this,arguments)}:function(){return N.apply(this,arguments)},disabled:K,isBusy:K,isPrimary:!0,text:R?wp.i18n.__("Deactivate","shopwp"):wp.i18n.__("Activate","shopwp")})),(0,i.tZ)("div",{css:D},(0,i.tZ)("p",{className:"shopwp-help"},"Get started by"," ",(0,i.tZ)("a",{href:"https://support.rechargepayments.com/hc/en-us/articles/360008829993-Recharge-API-#h_f3b493d2-ce6e-4042-b905-afd6bafde0f5",target:"_blank"},wp.i18n.__("generating a Recharge API key","shopwp"))," ",wp.i18n.__("and adding it here.","shopwp"))),x&&(0,i.tZ)("div",{css:[D,M,";label:SubscriptionsApiKey;"]},(0,i.tZ)(p,{status:"error",onRemove:function(){v(!1)}},(0,i.tZ)("div",{dangerouslySetInnerHTML:{__html:x}}))))}}}]);