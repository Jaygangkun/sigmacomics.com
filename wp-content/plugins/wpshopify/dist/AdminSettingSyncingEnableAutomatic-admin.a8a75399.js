"use strict";(self.webpackChunkshopwp=self.webpackChunkshopwp||[]).push([["AdminSettingSyncingEnableAutomatic-admin"],{XyRh:function(e,t,n){n.d(t,{Z:function(){return m}});var a=n("oYSA"),o=n("xblO"),l=n("ALIA"),i=wp.element.memo((function(e){var t=e.settingName,n=e.onChange,a=e.label,o=e.help,l=e.note,i=e.noticeCSS,c=wp.components,m=c.ToggleControl,s=c.Notice;return React.createElement(React.Fragment,null,React.createElement(m,{checked:t,onChange:n,label:a,help:o,className:l&&t&&"shopwp-toggle-has-note"}),l&&t&&React.createElement(s,{isDismissible:!1,css:i,status:"warning"},l))})),c={name:"1cirfju-noticeCSS",styles:"&&{margin-left:0!important;margin-right:0!important;margin-bottom:3em!important;};label:noticeCSS;"},m=wp.element.memo((function(e){var t=e.settingName,n=void 0!==t&&t,m=e.label,s=void 0!==m&&m,p=e.help,r=void 0!==p&&p,u=e.note,g=void 0!==u&&u,h=e.alsoChange,b=void 0!==h&&h,S=e.disable,d=void 0!==S&&S,C=wp.element.useContext,w=wp.components.Disabled,f=C(l.Z),v=(0,a.Z)(f,2),y=v[0],E=v[1],A=c;function N(){E({type:"UPDATE_SETTING",payload:{key:n,value:!y[n]}}),b&&E({type:"UPDATE_SETTING",payload:{key:b,value:!y[b]}})}return(0,o.tZ)(React.Fragment,null,d?(0,o.tZ)(w,null,(0,o.tZ)(i,{settingName:y[n],onChange:N,label:s,help:r,note:g,noticeCSS:A})):(0,o.tZ)(i,{settingName:y[n],onChange:N,label:s,help:r,note:g,noticeCSS:A}))}))},qWPd:function(e,t,n){n.r(t);var a=n("XyRh");t.default=function(){return React.createElement(a.Z,{label:wp.i18n.__("Enable Automatic Post Syncing","shopwp"),settingName:"enableAutomaticSyncing"})}}}]);