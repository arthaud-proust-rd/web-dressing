import{u as x,o as n,c,w as i,a,b as e,H as V,f as y,t as h,j as d,d as t,L as p,k as f,n as b,e as k}from"./app.4e3604f7.js";import{_ as S}from"./GuestLayout.56784aec.js";import{_ as w,a as g,b as _}from"./TextInput.e5f2c48b.js";import"./_plugin-vue_export-helper.cdc0426e.js";const B={key:0,class:"mb-4 font-medium text-sm text-green-600"},N=["onSubmit"],$={class:"flex flex-col gap-2"},q=["disabled"],E={__name:"Login",props:{canResetPassword:Boolean,status:String,env:Object},setup(o){const m=o,s=x({email:m.env.local?"user@email.com":"",password:m.env.local?"password":"",remember:!1}),v=()=>{s.post(route("login"),{onFinish:()=>s.reset("password")})};return(u,l)=>(n(),c(S,null,{default:i(()=>[a(e(V),{title:"Se connecter"}),o.status?(n(),y("div",B,h(o.status),1)):d("",!0),t("form",{onSubmit:k(v,["prevent"]),class:"flex flex-col gap-5"},[t("div",null,[a(w,{for:"email",value:"Email"}),a(g,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:e(s).email,"onUpdate:modelValue":l[0]||(l[0]=r=>e(s).email=r),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),a(_,{class:"mt-2",message:e(s).errors.email},null,8,["message"])]),t("div",null,[a(w,{for:"password",value:"Mot de passe"}),a(g,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:e(s).password,"onUpdate:modelValue":l[1]||(l[1]=r=>e(s).password=r),required:"",autocomplete:"current-password"},null,8,["modelValue"]),o.canResetPassword?(n(),c(e(p),{key:0,href:u.route("password.request"),class:"text-xs text-neutral-500 hover:text-gray-900"},{default:i(()=>[f(" Vous l'avez oubli\xE9? ")]),_:1},8,["href"])):d("",!0),a(_,{class:"mt-2",message:e(s).errors.password},null,8,["message"])]),t("div",$,[t("button",{class:b(["btn btn-primary",{"opacity-25":e(s).processing}]),disabled:e(s).processing}," Se connecter ",10,q),a(e(p),{class:b(["btn btn-tertiary",{"opacity-25":e(s).processing}]),href:u.route("register")},{default:i(()=>[f(" Je n'ai pas de compte ")]),_:1},8,["class","href"])])],40,N)]),_:1}))}};export{E as default};