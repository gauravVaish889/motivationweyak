!function(){"use strict";function e(e,t){let n;try{n=e()}catch(e){return}return{getItem:e=>{var r;const o=e=>null===e?null:JSON.parse(e,null==t?void 0:t.reviver),a=null!=(r=n.getItem(e))?r:null;return a instanceof Promise?a.then(o):o(a)},setItem:(e,r)=>n.setItem(e,JSON.stringify(r,null==t?void 0:t.replacer)),removeItem:e=>n.removeItem(e)}}const t=e=>n=>{try{const r=e(n);return r instanceof Promise?r:{then(e){return t(e)(r)},catch(e){return this}}}catch(e){return{then(e){return this},catch(n){return t(n)(e)}}}},n=e=>{let t;const n=new Set,r=(e,r)=>{const o="function"==typeof e?e(t):e;if(!Object.is(o,t)){const e=t;t=(null!=r?r:"object"!=typeof o||null===o)?o:Object.assign({},t,o),n.forEach((n=>n(t,e)))}},o=()=>t,a={setState:r,getState:o,getInitialState:()=>i,subscribe:e=>(n.add(e),()=>n.delete(e))},i=t=e(r,o,a);return a};window.zustand={persist:(n,r)=>(o,a,i)=>{let s={storage:e((()=>localStorage)),partialize:e=>e,version:0,merge:(e,t)=>({...t,...e}),...r},l=!1;const c=new Set,u=new Set;let d=s.storage;if(!d)return n(((...e)=>{console.warn(`[zustand persist middleware] Unable to update item '${s.name}', the given storage is currently unavailable.`),o(...e)}),a,i);const h=()=>{const e=s.partialize({...a()});return d.setItem(s.name,{state:e,version:s.version})},m=i.setState;i.setState=(e,t)=>{m(e,t),h()};const v=n(((...e)=>{o(...e),h()}),a,i);let f;i.getInitialState=()=>v;const g=()=>{var e,n;if(!d)return;l=!1,c.forEach((e=>{var t;return e(null!=(t=a())?t:v)}));const r=(null==(n=s.onRehydrateStorage)?void 0:n.call(s,null!=(e=a())?e:v))||void 0;return t(d.getItem.bind(d))(s.name).then((e=>{if(e){if("number"!=typeof e.version||e.version===s.version)return[!1,e.state];if(s.migrate){const t=s.migrate(e.state,e.version);return t instanceof Promise?t.then((e=>[!0,e])):[!0,t]}console.error("State loaded from storage couldn't be migrated since no migrate function was provided")}return[!1,void 0]})).then((e=>{var t;const[n,r]=e;if(f=s.merge(r,null!=(t=a())?t:v),o(f,!0),n)return h()})).then((()=>{null==r||r(f,void 0),f=a(),l=!0,u.forEach((e=>e(f)))})).catch((e=>{null==r||r(void 0,e)}))};return i.persist={setOptions:e=>{s={...s,...e},e.storage&&(d=e.storage)},clearStorage:()=>{null==d||d.removeItem(s.name)},getOptions:()=>s,rehydrate:()=>g(),hasHydrated:()=>l,onHydrate:e=>(c.add(e),()=>{c.delete(e)}),onFinishHydration:e=>(u.add(e),()=>{u.delete(e)})},s.skipHydration||g(),f||v},createStore:e=>e?n(e):n,stores:[]},document.addEventListener("DOMContentLoaded",(function(){var e=document.querySelector("input.wp-block-search__input");e&&(e.addEventListener("focus",(function(){this.setAttribute("data-placeholder",this.placeholder),this.placeholder=""})),e.addEventListener("blur",(function(){this.placeholder=this.getAttribute("data-placeholder")})))}))}();


jQuery(document).ready(function() {
    const words = ["articles", "methods", "protocols"];
    const staticText = "Explore research ";
    let wordIndex = 0;
    let charIndex = 0;
    let typing = !0;
    function typeEffect() {
        let currentWord = words[wordIndex];
        let fullText = staticText + currentWord.substring(0, charIndex);
        jQuery('.searchInput .wp-block-search__input').attr('placeholder', fullText);
        if (typing) {
            if (charIndex < currentWord.length) {
                charIndex++
            } else {
                typing = !1;
                setTimeout(typeEffect, 1200);
                return
            }
        } else {
            if (charIndex > 0) {
                charIndex--
            } else {
                typing = !0;
                wordIndex = (wordIndex + 1) % words.length
            }
        }
        setTimeout(typeEffect, typing ? 100 : 50)
    }
    typeEffect()
});
