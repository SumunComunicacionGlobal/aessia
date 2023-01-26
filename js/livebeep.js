(function(d,s,id){
if(d.getElementById(id)){return;}
var u='//www.livebeep.com/'+d.domain+'/eye.js?';
if((h=d.location.href.split(/#ev!/)[1])) u += '?_e=' +h;
else if((r=/.*\_evV=(\w+)\b.*/).test(c=d.cookie) ) u += '?_v='+c.replace(r,'$1');
var js = d.createElement(s);
js.src = u;js.id = id;
var fjs = d.getElementsByTagName(s)[0];
fjs.parentNode.insertBefore(js, fjs);
})(document,'script','livebeep-script');