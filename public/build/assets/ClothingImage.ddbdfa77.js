import{o as e,g as t,h as o,v as a}from"./app.c829bebf.js";import{_ as r}from"./ApplicationLogo.2e99cc65.js";const g={props:{clothing:Object},data(){return{displayImage:"front"}},methods:{toggleImage(){this.displayImage=this.displayImage==="front"?"back":"front"}}},m=["src"],f={key:1,class:"w-full aspect-3/4 select-none bg-gray-200 text-gray-400 flex items-center justify-center"},d=["src"],_={key:3,class:"w-full aspect-3/4 select-none bg-gray-200 text-gray-400 flex items-center justify-center"};function y(h,l,s,u,c,i){return e(),t("div",{class:"rounded-xl overflow-hidden flex flex-row",onClick:l[0]||(l[0]=(...n)=>i.toggleImage&&i.toggleImage(...n))},[s.clothing.image_front?o((e(),t("img",{key:0,class:"w-full aspect-3/4 object-cover",src:"/storage/"+s.clothing.image_front},null,8,m)),[[a,c.displayImage==="front"]]):o((e(),t("div",f," Face ",512)),[[a,c.displayImage==="front"]]),s.clothing.image_back?o((e(),t("img",{key:2,class:"w-full aspect-3/4 object-cover",src:"/storage/"+s.clothing.image_back},null,8,d)),[[a,c.displayImage==="back"]]):o((e(),t("div",_," Dos ",512)),[[a,c.displayImage==="back"]])])}const I=r(g,[["render",y]]);export{I as C};