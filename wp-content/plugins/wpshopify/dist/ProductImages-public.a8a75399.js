"use strict";(self.webpackChunkshopwp=self.webpackChunkshopwp||[]).push([["ProductImages-public","Carousel-public"],{"37sc":function(e,t,a){function n(e){return Number.isInteger(e)}function i(e){return"string"==typeof e||e instanceof String}function o(e){var t=function(e){if(e){var t=e.split(".");return t[t.length-1].split("?")[0]}}(e);if(!t)return!1;var a=function(e,t){return a="."+t,e.split(a);var a}(e,t);return{extension:t,beforeExtension:a[0],afterExtension:a[1]}}function r(e){return e.src&&(s=e.src)&&s.includes("cdn.shopify.com/s/files/1/0533/2089/files/placeholder")?e.src:function(e,t){var a=o(t);return!1===a||e.scale<=1||e.scale>3?t:a.beforeExtension+function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0;return!e||!n(e)||e<=1||e>3?"":"@"+e+"x"}(e.scale)+"."+a.extension+a.afterExtension}(e,function(e,t){var a=o(t);return!1===a||!e.crop||function(e){return!e.width||0===e.width&&0===e.height}(e)?t:a.beforeExtension+function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";return e&&i(e)&&"none"!==e?"_crop_"+e:""}(e.crop)+"."+a.extension+a.afterExtension}(e,(t=e.width,a=e.height,r=e.src,!1===(l=o(r))?r:l.beforeExtension+function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0,t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0;return(!n(e)||e<0)&&(e=0),(!n(t)||t<0)&&(t=0),0!==e&&0!==t?"_"+e+"x"+t:0===t&&0!==e?"_"+e+"x":0===e&&0!==t?"_x"+t:""}(t,a)+"."+l.extension+l.afterExtension)));var t,a,r,l,s}function l(e,t){return t?r({src:e,width:t.imagesSizingWidth,height:t.imagesSizingHeight,crop:t.imagesSizingCrop,scale:t.imagesSizingScale}):e}function s(e,t){return t?r({src:e,width:t.thumbnailImagesSizingWidth,height:t.thumbnailImagesSizingHeight,crop:t.thumbnailImagesSizingCrop,scale:t.thumbnailImagesSizingScale}):e}function c(e){var t={id:"",data:!1};switch(e.node.mediaContentType){case"IMAGE":t.id=e.node.image.id,t.data=e.node.image;break;case"VIDEO":t.id=e.node.previewImage.id,t.data=e.node;break;case"EXTERNAL_VIDEO":t.id=e.node.id,t.data=e.node}return t}a.d(t,{hx:function(){return s},mo:function(){return l},o:function(){return c},yk:function(){return r}})},Pyla:function(e,t,a){a.r(t),a.d(t,{default:function(){return I}});var n=a("ecC/"),i=a("XTMG"),o=a("t2o5"),r=(a("m1nJ"),a("IXeW"),a("81/l")),l=a("rfPn"),s=a.n(l),c=a("E5I5"),d=a("raWh");function u(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,n)}return a}function g(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?u(Object(a),!0).forEach((function(t){(0,d.Z)(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):u(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function m(e){var t=e.className,a=e.style,n=e.onClick;return React.createElement("div",{className:t,style:g(g({},a),{},{display:"block",color:"inherit"}),onClick:n},React.createElement("svg",{"aria-hidden":"true",focusable:"false",role:"button",style:{width:"55px",height:"55px"},xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 192 512"},React.createElement("path",{fill:"currentColor",d:"M187.8 264.5L41 412.5c-4.7 4.7-12.3 4.7-17 0L4.2 392.7c-4.7-4.7-4.7-12.3 0-17L122.7 256 4.2 136.3c-4.7-4.7-4.7-12.3 0-17L24 99.5c4.7-4.7 12.3-4.7 17 0l146.8 148c4.7 4.7 4.7 12.3 0 17z"})))}function p(e){var t=e.className,a=e.style,n=e.onClick;return React.createElement("div",{className:t,style:g(g({},a),{},{display:"block",color:"inherit"}),onClick:n},React.createElement("svg",{"aria-hidden":"true",focusable:"false",style:{width:"55px",height:"55px"},role:"button",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 192 512"},React.createElement("path",{fill:"currentColor",d:"M4.2 247.5L151 99.5c4.7-4.7 12.3-4.7 17 0l19.8 19.8c4.7 4.7 4.7 12.3 0 17L69.3 256l118.5 119.7c4.7 4.7 4.7 12.3 0 17L168 412.5c-4.7 4.7-12.3 4.7-17 0L4.2 264.5c-4.7-4.7-4.7-12.3 0-17z"})))}var I=function(e){var t=e.children,a=e.defaultSettings,l=e.customSettings,d=e.extraCSS,u=e.element,g=(0,i.iv)("max-width:100%;margin:0 auto;.slick-next,.slick-prev{top:calc(50% - 30px);width:55px;height:55px;background-size:contain;background-position:50% 50%;background-repeat:no-repeat;&:hover,&:focus{opacity:0.7;}&:before{color:black;font-size:35px;content:'';}}.slick-prev{left:-55px;}.slick-next{right:-55px;}.slick-slide>div{margin:0 10px;}.slick-dots{margin:0;padding:0;li button:before{width:10px;height:10px;font-size:10px;}}",(0,r.mq)("large"),"{display:table!important;table-layout:fixed!important;width:100%!important;.slick-prev{left:0;z-index:999;}.slick-next{right:0;z-index:999;}.slick-list{width:75%;margin:0 auto;}}",(0,r.mq)("medium"),"{.slick-prev,.slick-next{width:35px;height:35px;}};label:CarouselCSS;"),I={dots:a.carouselDots,infinite:a.carouselInfinite,speed:a.carouselSpeed,slidesToShow:a.carouselSlidesToShow,slidesToScroll:a.carouselSlidesToScroll,nextArrow:!1!==a.carouselNextArrow&&(0,i.tZ)(m,null),prevArrow:!1!==a.carouselPrevArrow&&(0,i.tZ)(p,null),responsive:[{breakpoint:1e3,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:600,settings:{slidesToShow:1,slidesToScroll:1}}],onInit:function(){(0,c.k9)(u)}},y=s()(I,l),w=wp.hooks.applyFilters("misc.carouselSettings",y);return(0,i.tZ)(o.Z,(0,n.Z)({},w,{css:[g,d,";label:Carousel;"]}),t)}},"+Rsb":function(e,t,a){a.r(t),a.d(t,{default:function(){return X}});var n=a("XTMG"),i=a("XUG9"),o=a("MwdL"),r=wp.element.createContext(),l=a("GYXz"),s=a("ILDY"),c=a.n(s),d=a("37sc"),u={name:"1ffumr9-videoIcon",styles:"position:absolute;width:12px;fill:white;top:calc(50% - 14px);z-index:9999;left:calc(50% - 6px);label:videoIcon;"},g={name:"3njco4-featThumbStyles",styles:"outline:1px dashed #000000;outline-offset:3px;transition:transform 100ms ease;max-width:100%;label:featThumbStyles;"},m=wp.element.memo((function(e){var t=g,a=(0,n.iv)("display:block;margin-bottom:",e.isFeatured?"0px":"10px",";max-width:100%;filter:",e.isVideo?"brightness(0.5)":"none",";&:focus,&:active{outline:",e.isFeatured?"none":"1px dashed #000000",";outline-offset:",e.isFeatured?"none":"3px",";}&:hover{cursor:",e.isFeatured?"modal"!==e.linkTo:"pointer",";};label:thumbnailStyles;"),i=u;return(0,n.tZ)(React.Fragment,null,(0,n.tZ)("img",{css:function(){var t,a,n,i;if(!e.isFeatured)return null!==(t=e.galleryState.featImage)&&void 0!==t&&t.mediaContentType&&null!==(a=e.image)&&void 0!==a&&a.previewImage?null!==(n=e.galleryState.featImage)&&void 0!==n&&n.sources&&null!==(i=e.image)&&void 0!==i&&i.sources?e.galleryState.featImage.previewImage.id===e.image.previewImage.id:e.galleryState.featImage.embeddedUrl===e.image.embeddedUrl:e.galleryState.featImage.originalSrc===e.image.originalSrc}()?t:a,ref:e.imageRef,itemProp:"image",src:e.productImageSrc,className:"wps-product-image",loading:"lazy",alt:e.image.altText?e.image.altText:wp.i18n.__("Thumbnail for ","shopwp")+e.galleryState.product.title,"data-zoom":e.image.originalSrc}),e.isVideo&&(0,n.tZ)("svg",{css:i,xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 384 512"},(0,n.tZ)("path",{d:"M24.52 38.13C39.66 29.64 58.21 29.99 73.03 39.04L361 215C375.3 223.8 384 239.3 384 256C384 272.7 375.3 288.2 361 296.1L73.03 472.1C58.21 482 39.66 482.4 24.52 473.9C9.377 465.4 0 449.4 0 432V80C0 62.64 9.377 46.63 24.52 38.13V38.13zM48 432L336 256L48 80V432z"})))})),p=a("o+TG"),I=wp.element.lazy((function(){return a.e("Link-public").then(a.bind(a,"tdT1"))})),y=wp.element.memo((function(e){var t=e.image,a=e.isFeatured,n=e.payloadSettings,o=e.payload,l=e.placeholder,s=void 0!==l&&l,c=e.isVideo,u=void 0!==c&&c,g=wp.element,y=g.useEffect,w=g.useContext,f=g.useRef,b=g.useState,S=f(),h=w(r),x=(0,i.Z)(h,2),M=x[0],v=x[1],L=b((function(){return C()})),E=(0,i.Z)(L,2),T=E[0],Z=E[1];function C(){return u?a?"EXTERNAL_VIDEO"===t.mediaContentType?t.embeddedUrl:t.sources[0].url:(0,d.hx)(t.previewImage.url,n):s?t.src:a?n.imagesSizingToggle?(0,d.mo)(t.originalSrc,n):t.originalSrc:n.thumbnailImagesSizingToggle?(0,d.hx)(t.originalSrc,n):t.originalSrc}return y((function(){Z(C()),a&&v({type:"SET_FEAT_IMAGE_ELEMENT",payload:S.current})}),[t,n]),T?(0,p.AH)(n)?React.createElement(I,{payload:o,type:"products",linkTo:n.linkTo,target:n.linkTarget},React.createElement(m,{imageRef:S,image:t,productImageSrc:T,galleryState:M,isFeatured:a,linkTo:n.linkTo,isVideo:u})):React.createElement(m,{imageRef:S,image:t,productImageSrc:T,galleryState:M,isFeatured:a,linkTo:n.linkTo,isVideo:u}):null})),w=a("E5I5"),f={name:"1knh69z-ThumbnailCSS",styles:"transition:outline 0.2s ease;position:relative;&:hover{img{outline:1px dashed #000000;outline-offset:3px;}};label:ThumbnailCSS;"},b=wp.element.memo((function(e){var t=e.image,a=e.payload,o=e.payloadSettings,l=e.isExternalVideo,s=e.isHostedVideo,c=wp.element,d=c.useEffect,u=c.useContext,g=c.useState,m=u(r),p=(0,i.Z)(m,2),I=p[0],b=p[1],S=g((function(){return!1})),h=(0,i.Z)(S,2),x=h[0],M=h[1],v=f;return d((function(){return I.featImage.originalSrc!==t.originalSrc?M(!1):M(!0),function(){M(!1)}}),[I.featImage]),(0,n.tZ)("div",{css:v,className:"wps-component wps-component-products-images-thumbnail","aria-label":"Product Images Thumbnail",onClick:function(){b({type:"SET_FEAT_IMAGE",payload:t}),b({type:"SET_FEAT_IMAGE_IS_VIDEO",payload:l||s})},"data-wps-is-active":x},(0,n.tZ)(w.ce,{name:"before.productThumbnail",args:[I]}),l||s?(0,n.tZ)(y,{payloadSettings:o,isFeatured:!1,image:t,payload:a,isVideo:!0}):(0,n.tZ)(y,{payloadSettings:o,isFeatured:!1,image:t,payload:a}),(0,n.tZ)(w.ce,{name:"after.productThumbnail",args:[I]}))})),S=wp.element.memo((function(e){var t=e.payload,a=e.thumbnails,n=e.payloadSettings;function i(e){return(0,d.o)(e).id}function o(e){return(0,d.o)(e).data}return a.edges.map((function(e){return React.createElement(b,{key:i(e),image:o(e),payload:t,payloadSettings:n,isExternalVideo:"EXTERNAL_VIDEO"===e.node.mediaContentType,isHostedVideo:"VIDEO"===e.node.mediaContentType})}))})),h=S,x=a("81/l"),M=a("KKeo"),v=a.n(M),L=a("2E6O"),E=wp.element.memo((function(e){var t=e.product,a=e.payloadSettings,o=wp.element.useState,r=o("idle"),s=(0,i.Z)(r,2),u=s[0],g=s[1],m=o(t.media),p=(0,i.Z)(m,1)[0],I=(0,n.iv)("display:grid;grid-template-columns:repeat(5, 1fr);grid-template-rows:1fr;grid-column-gap:15px;grid-row-gap:0px;margin-top:12px;max-width:410px;",(0,x.mq)("large"),"{display:flex;flex-wrap:wrap;gap:0px 12px;max-width:100%;>div{width:57px;}};label:thumbnailsWrapperCSS;");function y(e){return new Promise((function(t,n){var i=new Image;e.node&&"IMAGE"===e.node.mediaContentType&&(i.onload=t,i.onerror=n,i.src=(0,d.mo)(e.node.image.originalSrc,a))}))}function w(e){return Promise.all(e.edges.map(y))}function f(){return(f=(0,l.Z)(c().mark((function e(){return c().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,(0,L.Z)(w(t.media));case 2:g("done");case 3:case"end":return e.stop()}}),e)})))).apply(this,arguments)}return"modal"!==a.linkTo&&t&&!v()(t.media)?(0,n.tZ)("div",{className:"wps-thumbnails-wrapper","aria-label":"Product Thumbnails",css:I,onMouseEnter:"idle"===u?function(){"done"!==u&&function(){f.apply(this,arguments)}()}:void 0},(0,n.tZ)(h,{payload:t,thumbnails:p,payloadSettings:a})):null})),T=a("raWh"),Z=a("1Lw3"),C=a.n(Z),N=a("7kVH");function z(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,n)}return a}function k(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?z(Object(a),!0).forEach((function(t){(0,T.Z)(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):z(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}var j=wp.element.lazy((function(){return a.e("ProductImageSoldOutLabel-public").then(a.bind(a,"Yr+7"))})),O=wp.element.lazy((function(){return a.e("ProductImageOnSaleLabel-public").then(a.bind(a,"npPa"))})),D=wp.element.lazy((function(){return Promise.resolve().then(a.bind(a,"SbLR"))})),G={name:"1w0isq8-paneElementCSS",styles:"position:relative;label:paneElementCSS;"};function P(e){var t=e.payloadSettings,a=e.payload,o=e.isOnSale,l=wp.element,s=l.useEffect,c=l.useContext,d=l.useRef,u=l.useState,g=l.Suspense,m=d(),p=d(!0),I=c(r),w=(0,i.Z)(I,2),f=w[0],b=w[1],S=u(f.featImage),h=(0,i.Z)(S,1)[0];function x(){return"none"===t.linkTo&&(C()(t.showZoom)?wpshopify.settings.general.productsImagesShowZoom:t.showZoom)}var M=G,v=(0,n.iv)("display:flex;align-items:flex-start;justify-content:","left"===t.imagesAlign?"flex-start":"right"===t.imagesAlign?"flex-end":t.imagesAlign,";;label:ProductImageFeaturedWrapperCSS;"),L=!1===a.availableForSale;function E(){return!f.featImageIsVideo&&!x()&&!(a.media.edges.length<=1)&&t.imagesShowNextOnHover}return s((function(){if(wpshopify.misc.isPro)if(p.current)p.current=!1;else if(f.featImage&&f.featImageElement&&m.current&&x()){var e=new N.Z(f.featImageElement,k(k({},t.imageZoomOptions),{},{inlineContainer:m.current,paneContainer:m.current}));return function(){!function(e){e.destroy(),window.Drift=null,e=null}(e)}}}),[f.featImageElement,t.showZoom]),(0,n.tZ)("div",{className:"wps-gallery-featured-wrapper",ref:m,css:M,onMouseEnter:E()?function(){var e=function(){var e=0;return a.media.edges.forEach((function(t,a){"IMAGE"===t.node.mediaContentType&&t.node.image.id===h.id&&(e=a+1)})),e}();if(0!==e){var t=a.media.edges[e].node;t&&b({type:"SET_FEAT_IMAGE",payload:t.image})}}:void 0,onMouseLeave:E()?function(){b({type:"SET_FEAT_IMAGE",payload:h})}:void 0},f.featImageIsVideo?(0,n.tZ)(D,{videoData:f.featImage}):(0,n.tZ)(React.Fragment,null,o&&t.showSaleNotice&&!L&&(0,n.tZ)(g,{fallback:!1},(0,n.tZ)(O,{text:t.saleLabelText})),L&&f.featImage&&t.showOutOfStockNotice&&(0,n.tZ)(g,{fallback:!1},(0,n.tZ)(j,{text:t.soldOutImageLabelText})),(0,n.tZ)("div",{className:"wps-product-image-wrapper",css:v},f.featImage?(0,n.tZ)(y,{payload:a,payloadSettings:t,isFeatured:!0,image:f.featImage}):(0,n.tZ)(y,{payload:a,payloadSettings:t,isFeatured:!0,image:f.featImagePlaceholder,placeholder:!0}))))}function A(e){var t=e.payloadSettings,a=e.payload,n=e.carousel,l=wp.element,s=l.useEffect,c=l.useContext,d=(0,o.C)(),u=c(r),g=(0,i.Z)(u,2)[1];return s((function(){d.selectedVariant&&(g({type:"SET_FEAT_IMAGE_IS_VIDEO",payload:!1}),g({type:"SET_FEAT_IMAGE",payload:d.selectedVariant.node.image}))}),[d.selectedVariant]),React.createElement(React.Fragment,null,((0,p.AH)(t)?t.showFeaturedOnly||"none"!==t.linkTo:t.showFeaturedOnly)?React.createElement(P,{isOnSale:d.isOnSale,payload:a,payloadSettings:t}):d&&d.hasManyImages?t.showImagesCarousel?n&&n:React.createElement(React.Fragment,null,React.createElement(P,{payload:a,payloadSettings:t,isOnSale:d.isOnSale}),React.createElement(E,{product:a,payloadSettings:t})):React.createElement(P,{payload:a,payloadSettings:t,isOnSale:d.isOnSale}))}var V=a("ecC/"),H=function(e,t){switch(t.type){case"SET_FEAT_IMAGE":return(0,w.kK)("featImage",t,e);case"SET_FEAT_IMAGE_ELEMENT":return(0,w.kK)("featImageElement",t,e);case"SET_FEAT_IMAGE_IS_VIDEO":return(0,w.kK)("featImageIsVideo",t,e);default:throw new Error("Unhandled action type: ".concat(t.type," in ProductGalleryReducer"))}};function R(e){var t=wp.element.useReducer(H,function(e){var t;if(e.payload.media.edges.length)if("IMAGE"===(null===(t=e.payload.media.edges[0])||void 0===t?void 0:t.node.mediaContentType))var a=e.payload.media.edges[0].node.image,n=!1;else a=e.payload.media.edges[0].node,n=!0;else a=!1;return{product:e.payload,featImageIsVideo:n,featImage:!!e.payload&&a,featImageElement:!1,featImagePlaceholder:{src:e.payloadSettings.imagePlaceholder,alt:wp.i18n.__("Placeholder Image","shopwp")}}}(e)),a=(0,i.Z)(t,2),n=a[0],o=a[1],l=wp.element.useMemo((function(){return[n,o]}),[n]);return React.createElement(r.Provider,(0,V.Z)({value:l},e))}var F=a("Pyla"),Q=a("SbLR"),Y={name:"1nnmgfq-ProductCarouselImagesCSS",styles:"margin-bottom:30px;label:ProductCarouselImagesCSS;"},U=function(e){var t=e.defaultCarouselSettings,a=e.images,i=e.element,o=(e.payload,e.payloadSettings,Y),r=(0,n.iv)(".slick-list{",(0,x.mq)("large"),"{width:100%;}}.slick-next{right:7px;background-image:url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDI1LjIuMSwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPgo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIGZvY3VzYWJsZT0iZmFsc2UiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiCgkgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCAxOTIgMzI0IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAxOTIgMzI0OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+Cgkuc3Qwe2ZpbGw6I0ZGRkZGRjt9Cjwvc3R5bGU+CjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0xODcuOCwxNzAuNUw0MSwzMTguNWMtNC43LDQuNy0xMi4zLDQuNy0xNywwTDQuMiwyOTguN2MtNC43LTQuNy00LjctMTIuMywwLTE3TDEyMi43LDE2Mkw0LjIsNDIuMwoJYy00LjctNC43LTQuNy0xMi4zLDAtMTdMMjQsNS41YzQuNy00LjcsMTIuMy00LjcsMTcsMGwxNDYuOCwxNDhDMTkyLjUsMTU4LjIsMTkyLjUsMTY1LjgsMTg3LjgsMTcwLjV6Ii8+Cjwvc3ZnPgo=');&:hover{background-image:url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDI1LjIuMSwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPgo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIGZvY3VzYWJsZT0iZmFsc2UiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiCgkgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCAxOTIgMzI0IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAxOTIgMzI0OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+Cgkuc3Qwe2ZpbGw6I0ZGRkZGRjt9Cjwvc3R5bGU+CjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0xODcuOCwxNzAuNUw0MSwzMTguNWMtNC43LDQuNy0xMi4zLDQuNy0xNywwTDQuMiwyOTguN2MtNC43LTQuNy00LjctMTIuMywwLTE3TDEyMi43LDE2Mkw0LjIsNDIuMwoJYy00LjctNC43LTQuNy0xMi4zLDAtMTdMMjQsNS41YzQuNy00LjcsMTIuMy00LjcsMTcsMGwxNDYuOCwxNDhDMTkyLjUsMTU4LjIsMTkyLjUsMTY1LjgsMTg3LjgsMTcwLjV6Ii8+Cjwvc3ZnPgo=');}}.slick-prev{left:7px;z-index:99;background-image:url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDI1LjIuMSwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPgo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIGZvY3VzYWJsZT0iZmFsc2UiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiCgkgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCAxOTIgMzI0IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAxOTIgMzI0OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+Cgkuc3Qwe2ZpbGw6I0ZGRkZGRjt9Cjwvc3R5bGU+CjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik00LjIsMTUzLjVMMTUxLDUuNWM0LjctNC43LDEyLjMtNC43LDE3LDBsMTkuOCwxOS44YzQuNyw0LjcsNC43LDEyLjMsMCwxN0w2OS4zLDE2MmwxMTguNSwxMTkuNwoJYzQuNyw0LjcsNC43LDEyLjMsMCwxN0wxNjgsMzE4LjVjLTQuNyw0LjctMTIuMyw0LjctMTcsMEw0LjIsMTcwLjVDLTAuNSwxNjUuOC0wLjUsMTU4LjIsNC4yLDE1My41eiIvPgo8L3N2Zz4K');&:hover{background-image:url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDI1LjIuMSwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPgo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIGZvY3VzYWJsZT0iZmFsc2UiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiCgkgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCAxOTIgMzI0IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAxOTIgMzI0OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+Cgkuc3Qwe2ZpbGw6I0ZGRkZGRjt9Cjwvc3R5bGU+CjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik00LjIsMTUzLjVMMTUxLDUuNWM0LjctNC43LDEyLjMtNC43LDE3LDBsMTkuOCwxOS44YzQuNyw0LjcsNC43LDEyLjMsMCwxN0w2OS4zLDE2MmwxMTguNSwxMTkuNwoJYzQuNyw0LjcsNC43LDEyLjMsMCwxN0wxNjgsMzE4LjVjLTQuNyw0LjctMTIuMyw0LjctMTcsMEw0LjIsMTcwLjVDLTAuNSwxNjUuOC0wLjUsMTU4LjIsNC4yLDE1My41eiIvPgo8L3N2Zz4K');}}.slick-next,.slick-prev{transition:all ease 0.2s;visibility:visible;opacity:1;background-repeat:no-repeat;text-align:center;background-position:45% 50%;background-size:13px;padding:70px 25px;top:calc(50% - 10px);&:hover{background-repeat:no-repeat;background-position:45% 50%;background-size:13px;}svg{display:none;}};label:ProductCarouselSliderCSS;");return wpshopify.misc.isPro?(0,n.tZ)("div",{css:o},(0,n.tZ)(F.default,{defaultSettings:t,customSettings:{slidesToScroll:1,slidesToShow:1,adaptiveHeight:!0},extraCSS:r,element:i},a.map((function(e){return(0,n.tZ)("div",{key:"IMAGE"===e.node.mediaContentType?e.node.image.id:e.node.previewImage.id},"IMAGE"===e.node.mediaContentType?(0,n.tZ)("img",{key:e.node.image.id,src:e.node.image.originalSrc,alt:e.node.image.altText}):(0,n.tZ)(Q.default,{key:e.node.previewImage.id,videoData:e.node}))})))):null},J=function(e){var t=e.payloadSettings,a=e.payload,i=e.defaultGalleryCarouselSettings,o=e.element,r=(0,n.iv)("margin-bottom:",t.isSingleComponent?"0px":"15px",";;label:ProductGalleryWrapperCSS;");return(0,n.tZ)("div",{className:"wps-component wps-component-products-images","aria-label":"Product Images",css:r},(0,n.tZ)(R,{payload:a,payloadSettings:t},(0,n.tZ)(A,{payload:a,payloadSettings:t,carousel:(0,n.tZ)(U,{images:a.media.edges,defaultCarouselSettings:i,element:o})})))},W=a("udXY"),X=wp.element.memo((function(){var e=(0,o.C)();return(0,W.vI)(React.createElement(J,{defaultGalleryCarouselSettings:e.defaultGalleryCarouselSettings,payloadSettings:e.payloadSettings,payload:e.payload,element:e.element}),(0,w.tu)(e.payloadSettings.dropzoneProductGallery))}))},SbLR:function(e,t,a){a.r(t);var n=a("XTMG"),i=a("dR63"),o={name:"vdxuk0-ProductFeaturedImageVideoCSS",styles:"position:relative;padding-top:56.25%;.react-player{position:absolute;top:0;left:0;};label:ProductFeaturedImageVideoCSS;"};t.default=function(e){var t=e.videoData,a=o;return(0,n.tZ)("div",{css:a},(0,n.tZ)(i.Z,{className:"react-player",url:"EXTERNAL_VIDEO"===t.mediaContentType?t.embeddedUrl:t.sources[0].url,controls:!0,width:"100%",height:"100%"}))}}}]);