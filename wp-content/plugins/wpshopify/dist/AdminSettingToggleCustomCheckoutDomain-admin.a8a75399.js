"use strict";(self.webpackChunkshopwp=self.webpackChunkshopwp||[]).push([["AdminSettingToggleCustomCheckoutDomain-admin"],{XyRh:function(e,t,n){n.d(t,{Z:function(){return c}});var o=n("oYSA"),a=n("xblO"),l=n("ALIA"),i=wp.element.memo((function(e){var t=e.settingName,n=e.onChange,o=e.label,a=e.help,l=e.note,i=e.noticeCSS,m=wp.components,c=m.ToggleControl,s=m.Notice;return React.createElement(React.Fragment,null,React.createElement(c,{checked:t,onChange:n,label:o,help:a,className:l&&t&&"shopwp-toggle-has-note"}),l&&t&&React.createElement(s,{isDismissible:!1,css:i,status:"warning"},l))})),m={name:"1cirfju-noticeCSS",styles:"&&{margin-left:0!important;margin-right:0!important;margin-bottom:3em!important;};label:noticeCSS;"},c=wp.element.memo((function(e){var t=e.settingName,n=void 0!==t&&t,c=e.label,s=void 0!==c&&c,p=e.help,u=void 0!==p&&p,h=e.note,r=void 0!==h&&h,g=e.alsoChange,d=void 0!==g&&g,C=e.disable,w=void 0!==C&&C,b=wp.element.useContext,f=wp.components.Disabled,S=b(l.Z),v=(0,o.Z)(S,2),y=v[0],k=v[1],E=m;function N(){k({type:"UPDATE_SETTING",payload:{key:n,value:!y[n]}}),d&&k({type:"UPDATE_SETTING",payload:{key:d,value:!y[d]}})}return(0,a.tZ)(React.Fragment,null,w?(0,a.tZ)(f,null,(0,a.tZ)(i,{settingName:y[n],onChange:N,label:s,help:u,note:r,noticeCSS:E})):(0,a.tZ)(i,{settingName:y[n],onChange:N,label:s,help:u,note:r,noticeCSS:E}))}))},"ea+3":function(e,t,n){n.r(t);var o=n("XyRh");t.default=function(){return React.createElement(o.Z,{label:wp.i18n.__("Enable custom checkout domain","shopwp"),help:wp.i18n.__("When turned on, the plugin will attempt to use the custom domain you have set within Shopify for checkout instead of myshopify.com","shopwp"),settingName:"enableCustomCheckoutDomain"})}}}]);