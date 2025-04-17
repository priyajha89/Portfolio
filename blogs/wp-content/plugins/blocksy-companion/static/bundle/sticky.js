!function(){"use strict";var t={n:function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(n,{a:n}),n},d:function(e,n){for(var r in n)t.o(n,r)&&!t.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:n[r]})},o:function(t,e){return Object.prototype.hasOwnProperty.call(t,e)}},e=window.ctEvents,n=t.n(e),r=window.ctFrontend,o=function(t,e,n){return Math.max(t,Math.min(e,n))},i=function(t,e,n){return e[0]+(e[1]-e[0])/(t[1]-t[0])*(n-t[0])},a=function(t){if(t.blcInitialHeight)return t.blcInitialHeight;var e=t.firstElementChild;t.firstElementChild.firstElementChild&&(e=t.firstElementChild.firstElementChild);var n=e.getBoundingClientRect().height;return t.blcInitialHeight=n,n},c=function(t){var e=getComputedStyle(t),n=100;t.dataset.row.includes("middle")&&(n=e.getPropertyValue("--sticky-shrink"));var r=a(t);return n&&(r*=parseFloat(n)/100),r},s=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:function(){return 0},e=document.querySelector(".ct-floating-bar");e&&e.style.setProperty("--header-sticky-height-animated",t())};function u(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,r=new Array(e);n<e;n++)r[n]=t[n];return r}var l=null,d=function(t){var e,n=t.stickyContainer,r=t.startPosition;(e=n.querySelectorAll('[data-row*="middle"]'),function(t){if(Array.isArray(t))return u(t)}(e)||function(t){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(t))return Array.from(t)}(e)||function(t,e){if(t){if("string"==typeof t)return u(t,e);var n=Object.prototype.toString.call(t).slice(8,-1);return"Object"===n&&t.constructor&&(n=t.constructor.name),"Map"===n||"Set"===n?Array.from(t):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?u(t,e):void 0}}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()).map((function(t){if(t.querySelector('[data-id="logo"] .site-logo-container')){var e=t.querySelector('[data-id="logo"] .site-logo-container'),n=function(t){var e=t.logo,n=t.row;if(l)return l;var r=parseFloat(getComputedStyle(e).getPropertyValue("--logo-max-height")||50),o=parseFloat(getComputedStyle(e).getPropertyValue("--logo-sticky-shrink").toString().replace(",",".")||1),i=a(n),s=c(n);return l={initialHeight:r,stickyShrink:o,rowInitialHeight:i,rowStickyHeight:s}}({logo:e,row:t}),s=n.initialHeight,u=n.stickyShrink,d=n.rowInitialHeight,y=n.rowStickyHeight,f=s*u;1!==u&&e.style.setProperty("--logo-shrink-height","".concat(i([r,r+Math.abs(d===y?s-f:d-y)],[1,u],o(r,r+Math.abs(d===y?s-f:d-y),scrollY))*s,"px"))}}))},y=null,f=function(t){var e=t.stickyContainer,n=(t.containerInitialHeight,t.startPosition);e.querySelector('[data-row*="middle"]')&&[e.querySelector('[data-row*="middle"]')].map((function(t){var e=function(t){var e=t.row;if(y)return y;var n=a(e),r=c(e);return y={rowInitialHeight:n,rowStickyHeight:r}}({row:t}),r=e.rowInitialHeight,s=e.rowStickyHeight;r!==s&&t.style.setProperty("--shrink-height","".concat(i([n,n+Math.abs(r-s)],[r,s],o(n,n+Math.abs(r-s),scrollY)),"px"))}))};function h(t){return function(t){if(Array.isArray(t))return p(t)}(t)||function(t){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(t))return Array.from(t)}(t)||function(t,e){if(t){if("string"==typeof t)return p(t,e);var n=Object.prototype.toString.call(t).slice(8,-1);return"Object"===n&&t.constructor&&(n=t.constructor.name),"Map"===n||"Set"===n?Array.from(t):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?p(t,e):void 0}}(t)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function p(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,r=new Array(e);n<e;n++)r[n]=t[n];return r}function m(t){return function(t){if(Array.isArray(t))return g(t)}(t)||function(t){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(t))return Array.from(t)}(t)||function(t,e){if(t){if("string"==typeof t)return g(t,e);var n=Object.prototype.toString.call(t).slice(8,-1);return"Object"===n&&t.constructor&&(n=t.constructor.name),"Map"===n||"Set"===n?Array.from(t):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?g(t,e):void 0}}(t)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function g(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,r=new Array(e);n<e;n++)r[n]=t[n];return r}var w=null,k=function(t){var e=t.stickyContainer;if(w)return w;var n=m(e.querySelectorAll("[data-row]")).reduce((function(t,e){return t+c(e)}),0);return w={stickyContainerHeight:n}},v={up:{anchor:null,offset:100},down:{anchor:null,offset:0}};function b(t){return function(t){if(Array.isArray(t))return S(t)}(t)||function(t){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(t))return Array.from(t)}(t)||function(t,e){if(t){if("string"==typeof t)return S(t,e);var n=Object.prototype.toString.call(t).slice(8,-1);return"Object"===n&&t.constructor&&(n=t.constructor.name),"Map"===n||"Set"===n?Array.from(t):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?S(t,e):void 0}}(t)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function S(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,r=new Array(e);n<e;n++)r[n]=t[n];return r}function A(t){return function(t){if(Array.isArray(t))return C(t)}(t)||function(t){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(t))return Array.from(t)}(t)||function(t,e){if(t){if("string"==typeof t)return C(t,e);var n=Object.prototype.toString.call(t).slice(8,-1);return"Object"===n&&t.constructor&&(n=t.constructor.name),"Map"===n||"Set"===n?Array.from(t):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?C(t,e):void 0}}(t)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function C(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,r=new Array(e);n<e;n++)r[n]=t[n];return r}var x=function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"yes";Array.from(t.querySelectorAll("[data-row][data-transparent-row]")).map((function(t){t.dataset.transparentRow=e}))},O=null,j=null,I=null;window.wp&&wp.customize&&wp.customize.selectiveRefresh&&wp.customize.selectiveRefresh.bind("partial-content-rendered",(function(t){setTimeout((function(){y=null,l=null,O=null,j=null,I=null,H=null,P()}),500)}));var H=null,P=function(){if(H!==scrollY){var t=document.querySelector('[data-device="'.concat((0,r.getCurrentScreen)(),'"] [data-sticky]'));if(t){var e=O;null===e&&(e=function(t){if(-1===t.dataset.sticky.indexOf("shrink")&&-1===t.dataset.sticky.indexOf("auto-hide"))return t.parentNode.getBoundingClientRect().height+200;var e=t.closest("header").getBoundingClientRect().top+scrollY;if(e>0){var n=document.elementFromPoint(0,3);n&&function(t){for(var e=[];t&&t!==document;t=t.parentNode)e.push(t);return e}(n).map((function(t){return getComputedStyle(t).position})).indexOf("fixed")>-1&&(e-=n.getBoundingClientRect().height)}var r=t.parentNode,o=getComputedStyle(document.body),i=parseFloat(o.getPropertyValue("--header-sticky-offset")||0);if(i=i+parseFloat(o.getPropertyValue("--frame-size"))||0,1===r.parentNode.children.length||r.parentNode.children[0].classList.contains("ct-sticky-container"))return e>0?e-i:e;var a=Array.from(r.parentNode.children).reduce((function(t,e,n){return t.indexOf(0)>-1||!e.dataset.row?[].concat(A(t),[0]):[].concat(A(t),[e.classList.contains("ct-sticky-container")?0:e.getBoundingClientRect().height])}),[]).reduce((function(t,e){return t+e}),e);return a>0?a-i:a}(t),O=e);var n=I,i=t.dataset.sticky.split(":").filter((function(t){return"yes"!==t&&"no"!==t&&"fixed"!==t}));n||(n=parseInt(t.getBoundingClientRect().height),I=parseInt(n),s((function(){return-1===i.indexOf("auto-hide")?"".concat(A(t.querySelectorAll("[data-row]")).reduce((function(t,e){return t+c(e)}),0),"px"):"0px"})));var a=e>0&&Math.abs(window.scrollY-e)<5||window.scrollY>e;i.indexOf("shrink")>-1&&(a=e>0?window.scrollY>=e:window.scrollY>0),setTimeout((function(){a&&-1===document.body.dataset.header.indexOf("shrink")&&(document.body.dataset.header="".concat(document.body.dataset.header,":shrink")),!a&&document.body.dataset.header.indexOf("shrink")>-1&&(document.body.dataset.header=document.body.dataset.header.replace(":shrink",""))}),300);var u=j,l=scrollY;u||(u=j=Array.from(t.querySelectorAll("[data-row]")).reduce((function(t,e){return t+e.getBoundingClientRect().height}),0),t.parentNode.style.height="".concat(u,"px")),i.indexOf("shrink")>-1&&function(t){var e=t.containerInitialHeight,n=t.stickyContainer,r=t.isSticky,o=t.startPosition,i=t.stickyComponents;if(0===o&&0===window.scrollY&&(n.dataset.sticky=["fixed"].concat(h(i)).join(":")),r){if(i.indexOf("yes")>-1)return;-1===n.dataset.sticky.indexOf("yes")&&(x(n,"no"),n.dataset.sticky=["yes"].concat(h(i)).join(":")),d({stickyContainer:n,startPosition:o}),f({stickyContainer:n,containerInitialHeight:e,startPosition:o})}else Array.from(n.querySelectorAll("[data-row]")).map((function(t){return t.removeAttribute("style")})),Array.from(n.querySelectorAll('[data-row*="middle"] .site-logo-container')).map((function(t){return t.removeAttribute("style")})),x(n,"yes"),0===o&&window.scrollY<=0?n.dataset.sticky=["fixed"].concat(h(i)).join(":"):n.dataset.sticky=i.join(":")}({stickyContainer:t,stickyContainerHeight:n,containerInitialHeight:u,isSticky:a,startPosition:e,stickyComponents:i}),i.indexOf("auto-hide")>-1&&function(t){var e=t.currentScrollY,n=t.stickyContainer,r=t.containerInitialHeight,i=t.startPosition,a=t.isSticky,c=e<t.prevScrollY?"up":"down";a&&e-t.prevScrollY==0&&s((function(){return"0px"})),"up"===c&&function(t){var e=t.containerInitialHeight,n=t.stickyContainer,r=t.stickyComponents,o=t.isSticky,i=t.prevScrollY,a=t.startPosition,c=t.currentScrollY,u=k({stickyContainer:n}).stickyContainerHeight;o&&c-i==0&&s((function(){return"0px"})),!v.up.anchor&&c>2*e+a&&-1===n.dataset.sticky.indexOf("yes:")&&(v.up.anchor=c,n.dataset.sticky=["yes"].concat(m(r)).join(":"),x(n,"no"),document.body.removeAttribute("style")),!v.up.anchor&&v.down.anchor&&v.down.offset===u&&(v.up.anchor=c,v.down.anchor=null),o||(v.up.anchor=null,n.dataset.sticky=m(r).join(":"),x(n,"yes"),s((function(){return"0px"})))}(t),"down"===c&&function(t){var e=t.currentScrollY,n=t.stickyContainer,r=k({stickyContainer:n}).stickyContainerHeight;!v.down.anchor&&v.up.anchor&&0===v.up.offset&&(v.up.anchor=null,v.down.anchor=e),!v.down.anchor&&v.up.anchor&&v.up.offset===r&&(v.up.anchor=null,v.down.anchor=e-r)}(t),a?(d({stickyContainer:n,startPosition:i}),f({stickyContainer:n,containerInitialHeight:r,startPosition:i})):(Array.from(n.querySelectorAll("[data-row]")).map((function(t){return t.removeAttribute("style")})),Array.from(n.querySelectorAll('[data-row*="middle"] .site-logo-container')).map((function(t){return t.removeAttribute("style")}))),function(t){var e=t.currentScrollY,n=t.stickyContainer,r=null,i=k({stickyContainer:n}).stickyContainerHeight;v.down.anchor&&(v.down.offset=o(0,i,e-v.down.anchor),r=v.down.offset),!v.down.anchor&&v.up.anchor&&(v.up.offset=o(0,i,i-(v.up.anchor-e)),r=v.up.offset),null!==r&&(n.style.transform="translate3d(0px, ".concat(-1*Math.floor(r),"px, 0px)"),s((function(){return"".concat(i-r,"px")})))}(t)}({stickyContainer:t,isSticky:a,startPosition:e,stickyComponents:i,containerInitialHeight:u,stickyContainerHeight:n,currentScrollY:l,prevScrollY:H}),(i.indexOf("slide")>-1||i.indexOf("fade")>-1)&&function(t){var e=t.stickyContainer,n=t.startPosition,r=t.stickyComponents;t.isSticky?(-1===e.dataset.sticky.indexOf("yes")&&(e.dataset.sticky=["yes-start"].concat(b(r)).join(":"),setTimeout((function(){e.dataset.sticky=e.dataset.sticky.replace("yes-start","yes-end"),setTimeout((function(){e.dataset.sticky=e.dataset.sticky.replace("yes-end","yes")}),200)}),1)),x(e,"no")):-1===e.dataset.sticky.indexOf("yes-hide")&&e.dataset.sticky.indexOf("yes:")>-1&&(Math.abs(window.scrollY-n)>10?(e.dataset.sticky=r.join(":"),setTimeout((function(){Array.from(e.querySelectorAll("[data-row]")).map((function(t){return t.removeAttribute("style")}))}),300),x(e,"yes")):(e.dataset.sticky=["yes-hide-start"].concat(b(r)).join(":"),requestAnimationFrame((function(){e.dataset.sticky=e.dataset.sticky.replace("yes-hide-start","yes-hide-end"),setTimeout((function(){e.dataset.sticky=r.join(":"),setTimeout((function(){Array.from(e.querySelectorAll("[data-row]")).map((function(t){return t.removeAttribute("style")}))}),300),x(e,"yes")}),200)}))))}({stickyContainer:t,isSticky:a,startPosition:e,stickyComponents:i}),H=l}}},Y=function(){document.querySelector("header [data-sticky]")&&(window.addEventListener("resize",(function(t){P(t),n().trigger("ct:header:update")}),!1),window.addEventListener("orientationchange",(function(t){P(t),n().trigger("ct:header:update")})),window.addEventListener("scroll",P,!1),window.addEventListener("load",P,!1),P())};document.body.className.indexOf("e-preview")>-1?setTimeout((function(){Y()}),500):Y(),(0,r.registerDynamicChunk)("blocksy_sticky_header",{mount:function(t){}})}();