"use strict";(self.webpackChunkshopwp=self.webpackChunkshopwp||[]).push([["AdminSettingCartNotesPlaceholder-admin"],{sJdr:function(e,t,a){a.r(t);var o=a("oYSA"),n=a("ALIA"),l=wp.element,r=l.useContext,s=l.useState,c=wp.components.TextareaControl;t.default=function(){var e=r(n.Z),t=(0,o.Z)(e,2),a=t[0],l=t[1],p=s(a.cartNotesPlaceholder),u=(0,o.Z)(p,2),d=u[0],h=u[1];return React.createElement(c,{disabled:!a.enableCartNotes,cols:"60",value:d,onChange:function(e){h(e),l({type:"UPDATE_SETTING",payload:{key:"cartNotesPlaceholder",value:e}})},label:wp.i18n.__("Cart notes placeholder","shopwp")})}}}]);