import{_ as n}from"./AuthenticatedLayout.4f39ad32.js";import{o as l,f as p,a as s,b as o,w as t,F as c,H as u,d as e,t as r,L as i,k as f}from"./app.4e3604f7.js";const d=e("h1",{class:"h1"},"Mon profil",-1),_={class:"flex flex-col items-start gap-2"},k={__name:"Profile",props:{},setup(m){return(a,h)=>(l(),p(c,null,[s(o(u),{title:"Mon profil"}),s(n,null,{header:t(()=>[d]),default:t(()=>[e("div",_,[e("span",null,r(a.$page.props.auth.user.name),1),e("span",null,r(a.$page.props.auth.user.email),1),s(o(i),{href:a.route("logout"),method:"post",as:"button",class:"btn btn-secondary"},{default:t(()=>[f(" Se d\xE9connecter ")]),_:1},8,["href"])])]),_:1})],64))}};export{k as default};
