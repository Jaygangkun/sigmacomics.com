"use strict";(self.webpackChunkshopwp=self.webpackChunkshopwp||[]).push([["AdminSettingProductsThumbnailWidth-admin"],{"/Bgf":function(e,t,o){o.d(t,{w:function(){return r}});var n=o("oYSA"),i=o("xblO"),a=o("Jqy6"),s=o("ALIA"),l={name:"146333t-styles",styles:"display:inline-block;position:absolute;top:26px;right:8px;margin:0;.dashicons-editor-help{position:relative;top:4px;}.components-tooltip .components-popover__content{width:300px;text-align:left;white-space:normal;};label:styles;"},p={name:"1b4vatr-wrapperStyles",styles:"position:relative;&[disabled]{svg,.components-base-control__help{opacity:0.4;}};label:wrapperStyles;"};function r(e){var t=e.settingName,o=e.toggleName,r=e.label,u=wp.components,c=u.TextControl,h=u.Tooltip,m=u.Dashicon,d=(0,wp.element.useContext)(s.Z),g=(0,n.Z)(d,2),w=g[0],b=g[1],y=p,f=l;return(0,i.tZ)("div",{className:"shopwp-image-dimensions-control ",css:y,disabled:!w[o]},(0,i.tZ)(c,{type:"text",value:(0,a.Fz)(w[t]),onChange:function(e){b({type:"UPDATE_SETTING",payload:{key:t,value:(0,a.Fz)(e)}})},onBlur:function(e){b({type:"UPDATE_SETTING",payload:{key:t,value:(0,a.Fz)(e.currentTarget.value)}})},disabled:!w[o],label:r,help:wp.i18n.__("Number in pixels or auto.","shopwp")}),(0,i.tZ)(h,{text:wp.i18n.__("Sets a custom size for the image. Maximum size of 5760 x 5760. Both the height and width values will maintain the image aspect ratio. Therefore, if you want to force all images to the same dimensions make sure to specify the crop option below as well. If you want to size by one dimension only, keep the other dimension set to auto.","shopwp")},(0,i.tZ)("p",{css:f},(0,i.tZ)(m,{icon:"editor-help"}))))}},"9XQv":function(e,t,o){o.r(t);var n=o("/Bgf");t.default=function(){return React.createElement(n.w,{label:wp.i18n.__("Width","shopwp"),settingName:"productsThumbnailImagesSizingWidth",toggleName:"productsThumbnailImagesSizingToggle"})}}}]);