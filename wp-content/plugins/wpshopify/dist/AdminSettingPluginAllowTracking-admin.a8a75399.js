"use strict";(self.webpackChunkshopwp=self.webpackChunkshopwp||[]).push([["AdminSettingPluginAllowTracking-admin"],{XyRh:function(e,t,n){n.d(t,{Z:function(){return s}});var a=n("oYSA"),l=n("xblO"),o=n("ALIA"),i=wp.element.memo((function(e){var t=e.settingName,n=e.onChange,a=e.label,l=e.help,o=e.note,i=e.noticeCSS,c=wp.components,s=c.ToggleControl,m=c.Notice;return React.createElement(React.Fragment,null,React.createElement(s,{checked:t,onChange:n,label:a,help:l,className:o&&t&&"shopwp-toggle-has-note"}),o&&t&&React.createElement(m,{isDismissible:!1,css:i,status:"warning"},o))})),c={name:"1cirfju-noticeCSS",styles:"&&{margin-left:0!important;margin-right:0!important;margin-bottom:3em!important;};label:noticeCSS;"},s=wp.element.memo((function(e){var t=e.settingName,n=void 0!==t&&t,s=e.label,m=void 0!==s&&s,r=e.help,p=void 0!==r&&r,g=e.note,u=void 0!==g&&g,h=e.alsoChange,b=void 0!==h&&h,d=e.disable,w=void 0!==d&&d,S=wp.element.useContext,C=wp.components.Disabled,f=S(o.Z),v=(0,a.Z)(f,2),T=v[0],k=v[1],y=c;function N(){k({type:"UPDATE_SETTING",payload:{key:n,value:!T[n]}}),b&&k({type:"UPDATE_SETTING",payload:{key:b,value:!T[b]}})}return(0,l.tZ)(React.Fragment,null,w?(0,l.tZ)(C,null,(0,l.tZ)(i,{settingName:T[n],onChange:N,label:m,help:p,note:u,noticeCSS:y})):(0,l.tZ)(i,{settingName:T[n],onChange:N,label:m,help:p,note:u,noticeCSS:y}))}))},"6Tb2":function(e,t,n){n.r(t);var a=n("XyRh");t.default=function(){return React.createElement(a.Z,{label:wp.i18n.__("Share Usage Data","shopwp"),settingName:"allowTracking"})}}}]);