!function(){function e(){for(var e=this;-1===e.className.indexOf("nav-menu");)"li"===e.tagName.toLowerCase()&&(-1!==e.className.indexOf("focus")?e.className=e.className.replace(" focus",""):e.className+=" focus"),e=e.parentElement}var a,t,n,s,l,i;if(a=document.getElementById("site-navigation"),a&&(t=a.getElementsByTagName("button")[0],"undefined"!=typeof t)){if(n=a.getElementsByTagName("ul")[0],"undefined"==typeof n)return void(t.style.display="none");n.setAttribute("aria-expanded","false"),-1===n.className.indexOf("nav-menu")&&(n.className+=" nav-menu"),t.onclick=function(){-1!==a.className.indexOf("toggled")?(a.className=a.className.replace(" toggled",""),t.setAttribute("aria-expanded","false"),n.setAttribute("aria-expanded","false")):(a.className+=" toggled",t.setAttribute("aria-expanded","true"),n.setAttribute("aria-expanded","true"))},s=n.getElementsByTagName("a"),l=n.getElementsByTagName("ul"),i=n.getElementsByTagName("ul ul a"),console.log(i);for(var r=0,d=l.length;d>r;r++)l[r].parentNode.setAttribute("aria-haspopup","true");for(r=0,d=s.length;d>r;r++)s[r].addEventListener("focus",e,!0),s[r].addEventListener("blur",e,!0)}}();