"use strict";(self.webpackChunkshopwp=self.webpackChunkshopwp||[]).push([["AdminSettingPluginEnableBeta-admin"],{XyRh:function(e,t,n){n.d(t,{Z:function(){return c}});var a=n("oYSA"),l=n("xblO"),o=n("ALIA"),i=wp.element.memo((function(e){var t=e.settingName,n=e.onChange,a=e.label,l=e.help,o=e.note,i=e.noticeCSS,s=wp.components,c=s.ToggleControl,m=s.Notice;return React.createElement(React.Fragment,null,React.createElement(c,{checked:t,onChange:n,label:a,help:l,className:o&&t&&"shopwp-toggle-has-note"}),o&&t&&React.createElement(m,{isDismissible:!1,css:i,status:"warning"},o))})),s={name:"1cirfju-noticeCSS",styles:"&&{margin-left:0!important;margin-right:0!important;margin-bottom:3em!important;};label:noticeCSS;"},c=wp.element.memo((function(e){var t=e.settingName,n=void 0!==t&&t,c=e.label,m=void 0!==c&&c,p=e.help,r=void 0!==p&&p,u=e.note,g=void 0!==u&&u,h=e.alsoChange,b=void 0!==h&&h,d=e.disable,w=void 0!==d&&d,C=wp.element.useContext,S=wp.components.Disabled,f=C(o.Z),v=(0,a.Z)(f,2),y=v[0],E=v[1],N=s;function R(){E({type:"UPDATE_SETTING",payload:{key:n,value:!y[n]}}),b&&E({type:"UPDATE_SETTING",payload:{key:b,value:!y[b]}})}return(0,l.tZ)(React.Fragment,null,w?(0,l.tZ)(S,null,(0,l.tZ)(i,{settingName:y[n],onChange:R,label:m,help:r,note:g,noticeCSS:N})):(0,l.tZ)(i,{settingName:y[n],onChange:R,label:m,help:r,note:g,noticeCSS:N}))}))},wohy:function(e,t,n){n.r(t);var a=n("XyRh");t.default=function(){return React.createElement(a.Z,{label:wp.i18n.__("Enable Beta Updates","shopwp"),settingName:"enableBeta"})}}}]);