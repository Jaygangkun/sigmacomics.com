"use strict";(self.webpackChunkshopwp=self.webpackChunkshopwp||[]).push([["ProductOptionDropdown-public"],{"4RL0":function(t,a,o){o.r(a),o.d(a,{default:function(){return E}});var e=o("XUG9"),n=o("XTMG"),i=o("vUFd"),r=o("81/l"),p=(o("4Lfj"),o("LboF")),l=o.n(p),d=o("5Hnr"),s=o.n(d),c=o("shRe"),w=o.n(c),m=o("3c4z"),u=o.n(m),b=o("3mzb"),f=o.n(b),y=o("Hd6Y"),v=o.n(y),h=o("22vu"),g={};g.styleTagTransform=v(),g.setAttributes=u(),g.insert=w().bind(null,"head"),g.domAPI=s(),g.insertStyleElement=f(),l()(h.Z,g),h.Z&&h.Z.locals&&h.Z.locals;var x=o("6bqM"),D=o("f8o8"),S=o("KKeo"),T=o.n(S);function O(){return(0,n.tZ)("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 30 30",style:{maxWidth:"19px",position:"absolute",right:"16px",top:"calc(50% - 9px)"}},(0,n.tZ)("path",{fill:"#fff",d:"M15 17.8L3.2 6 .7 8.7 15 23 29.3 8.7 26.8 6z"}))}var Z=function(t){var a=t.missingSelections,o=t.selectedOptions,p=t.payloadSettings,l=wp.element,d=l.useEffect,s=l.useContext,c=l.useRef,w=s(i.m),m=(0,e.Z)(w,2),u=m[0],b=m[1],f=c(),y=(0,D.Th)(D.dC),v=c(!0);d((function(){v.current?v.current=!1:a&&(u.isOptionSelected||y(f.current))}),[a]);var h=(0,n.iv)("&&{background-color:",p.variantDropdownButtonColor?p.variantDropdownButtonColor:"black",";color:",p.variantDropdownTextColor?p.variantDropdownTextColor:"white",";font-family:",p.variantDropdownTypeFontFamily?p.variantDropdownTypeFontFamily:"inherit",";font-weight:",p.variantDropdownTypeFontWeight?p.variantDropdownTypeFontWeight:"initial",";font-style:",p.variantDropdownTypeFontStyle?p.variantDropdownTypeFontStyle:"initial",";font-size:",p.variantDropdownTypeFontSize?p.variantDropdownTypeFontSize:"initial",";letter-spacing:",p.variantDropdownTypeLetterSpacing?p.variantDropdownTypeLetterSpacing:"initial",";line-height:",p.variantDropdownTypeLineHeight?p.variantDropdownTypeLineHeight:"initial",";text-decoration:",p.variantDropdownTypeTextDecoration?p.variantDropdownTypeTextDecoration:"initial",";text-transform:",p.variantDropdownTypeTextTransform?p.variantDropdownTypeTextTransform:"initial",";};label:variantDropdownCSS;");return(0,n.tZ)("button",{className:"wps-btn wps-icon wps-icon-dropdown wps-modal-trigger",onClick:function(){wp.hooks.doAction("on.variantDropdownToggle",u),b({type:"TOGGLE_DROPDOWN",payload:!u.isDropdownOpen})},ref:f,css:[r.Q0,r.ct,h,";label:ProductOptionTrigger;"],"aria-label":"Product Variant Dropdown"},wp.hooks.applyFilters("product.optionName",u.isOptionSelected&&!T()(o)?u.option.name+": "+u.selectedOption[u.option.name]:u.option.name,u),(0,n.tZ)(O,null))},C=o("udXY"),k=o("8wr9"),F={name:"1pbp7de-ProductVariantDropdownValueCSS",styles:"margin:0;padding:12px;border-bottom:1px solid #eee;font-size:15px;text-align:center;color:black;list-style:none;line-height:1.4;&:last-child{border-bottom:none;}&:hover{background-color:#f3f3f3;cursor:pointer;};label:ProductVariantDropdownValueCSS;"},P=wp.element.memo((function(t){var a=t.onSelection,o=t.optionObj,e=t.isAvailableToSelect,i=t.isAvailableInShopify,r=F;return e?(0,n.tZ)("li",{itemProp:"category",className:"wps-product-variant wps-product-style wps-modal-close-trigger",onClick:a,css:r,"data-is-available":e,"data-is-available-in-shopify":i},wp.hooks.applyFilters("product.variantValue",o.value)):null})),L={name:"1h5p2bf-modalCSS",styles:"&&{list-style:none;padding:0;margin:0;background-color:#fff;width:100%;max-width:100%;border-bottom-left-radius:5px;border-bottom-right-radius:5px;overflow-x:hidden;overflow-y:scroll;max-height:400px;};label:modalCSS;"},V=function(t){var a=t.availableVariants,o=t.dropdownElement,r=t.isDropdownOpen,p=t.selectedOptions,l=t.option,d=t.allSelectableOptions,s=(0,wp.element.useContext)(i.m),c=(0,e.Z)(s,2),w=c[0],m=c[1];(0,C.t$)(o,(function(){m({type:"TOGGLE_DROPDOWN",payload:!1})}),r);var u=L;return(0,n.tZ)("ul",{className:"wps-modal wps-variants",css:u},l.values.map((function(t){return(0,n.tZ)(k.Z,{key:t.name+t.value,optionObj:t,availableVariants:a,selectedOptions:p,variants:w.variants,allSelectableOptions:d},(0,n.tZ)(P,null))})))},E=function(t){var a=t.availableVariants,o=t.selectedOptions,p=t.missingSelections,l=t.payloadSettings,d=t.allSelectableOptions,s=(0,wp.element.useContext)(i.m),c=(0,e.Z)(s,1)[0],w=(0,n.iv)("position:relative;text-align:center;margin:0 0 10px 0;padding:0;width:100%;[data-tippy-root]{width:100%!important;max-width:100%;*:focus{outline:none;}.tippy-box{border-bottom-left-radius:5px;border-bottom-right-radius:5px;border-top-left-radius:0;border-top-right-radius:0;}}.tippy-box{box-shadow:0 28px 30px rgba(0, 0, 0, 0.11);padding:0;max-width:100%!important;margin:0 auto;margin-top:-2px;background:white;border:1px solid #313131;left:0;}.tippy-content{padding:0;}span[aria-expanded='true']{display:block;}&[data-wps-is-selected='false'] .wps-product-variant[data-wps-is-selectable='false']{display:none;}[aria-expanded='true'] .wps-modal-trigger{border-bottom-right-radius:0;border-bottom-left-radius:0;}[aria-expanded='true']+[data-tippy-root] .tippy-box[data-animation]{opacity:1!important;}",(0,r.mq)("medium"),"{width:100%;flex:1;max-width:100%;padding-right:0;};label:ProductOptionDropdownCSS;");return(0,n.tZ)("div",{className:"wps-btn-dropdown-wrapper"},(0,n.tZ)("div",{className:"wps-btn-dropdown",css:w,"data-wps-is-selected":c.isOptionSelected,ref:c.dropdownElement},(0,n.tZ)(x.ZP,{visible:c.isDropdownOpen,placement:"bottom",allowHTML:!0,appendTo:"parent",arrow:!1,animation:"shift-away",theme:"light",interactive:!0,inertia:!0,delay:[0,0],offset:[0,0],content:(0,n.tZ)(V,{dropdownElement:c.dropdownElement,isDropdownOpen:c.isDropdownOpen,option:c.option,availableVariants:a,selectedOptions:o,allSelectableOptions:d})},(0,n.tZ)("span",null,(0,n.tZ)(Z,{missingSelections:p,selectedOptions:o,payloadSettings:l})))))}},"22vu":function(t,a,o){var e=o("J8ja"),n=o.n(e),i=o("JPst"),r=o.n(i)()(n());r.push([t.id,".tippy-box[data-animation=shift-away][data-state=hidden]{opacity:0}.tippy-box[data-animation=shift-away][data-state=hidden][data-placement^=top]{transform:translateY(10px)}.tippy-box[data-animation=shift-away][data-state=hidden][data-placement^=bottom]{transform:translateY(-10px)}.tippy-box[data-animation=shift-away][data-state=hidden][data-placement^=left]{transform:translateX(10px)}.tippy-box[data-animation=shift-away][data-state=hidden][data-placement^=right]{transform:translateX(-10px)}",""]),a.Z=r}}]);