"use strict";(self.webpackChunkshopwp=self.webpackChunkshopwp||[]).push([["AdminSettingProductsImagesSizingHeight-admin"],{"/Bgf":function(e,t,o){o.d(t,{w:function(){return r}});var i=o("oYSA"),n=o("xblO"),s=o("Jqy6"),a=o("ALIA"),l={name:"146333t-styles",styles:"display:inline-block;position:absolute;top:26px;right:8px;margin:0;.dashicons-editor-help{position:relative;top:4px;}.components-tooltip .components-popover__content{width:300px;text-align:left;white-space:normal;};label:styles;"},p={name:"1b4vatr-wrapperStyles",styles:"position:relative;&[disabled]{svg,.components-base-control__help{opacity:0.4;}};label:wrapperStyles;"};function r(e){var t=e.settingName,o=e.toggleName,r=e.label,c=wp.components,m=c.TextControl,u=c.Tooltip,h=c.Dashicon,g=(0,wp.element.useContext)(a.Z),d=(0,i.Z)(g,2),w=d[0],y=d[1],f=p,b=l;return(0,n.tZ)("div",{className:"shopwp-image-dimensions-control ",css:f,disabled:!w[o]},(0,n.tZ)(m,{type:"text",value:(0,s.Fz)(w[t]),onChange:function(e){y({type:"UPDATE_SETTING",payload:{key:t,value:(0,s.Fz)(e)}})},onBlur:function(e){y({type:"UPDATE_SETTING",payload:{key:t,value:(0,s.Fz)(e.currentTarget.value)}})},disabled:!w[o],label:r,help:wp.i18n.__("Number in pixels or auto.","shopwp")}),(0,n.tZ)(u,{text:wp.i18n.__("Sets a custom size for the image. Maximum size of 5760 x 5760. Both the height and width values will maintain the image aspect ratio. Therefore, if you want to force all images to the same dimensions make sure to specify the crop option below as well. If you want to size by one dimension only, keep the other dimension set to auto.","shopwp")},(0,n.tZ)("p",{css:b},(0,n.tZ)(h,{icon:"editor-help"}))))}},NQ49:function(e,t,o){o.r(t);var i=o("/Bgf");t.default=function(){return React.createElement(i.w,{label:wp.i18n.__("Height","shopwp"),settingName:"productsImagesSizingHeight",toggleName:"productsImagesSizingToggle"})}}}]);