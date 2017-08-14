<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="stylesheet" href="css/pullToRefresh.css"/>
<script src="js/iscroll.js"></script>
<script src="js/pullToRefresh.js"></script>
<script src="js/colorful.js"></script>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>

<!--自己导入的样式，css-->
<link rel="stylesheet" href="css/cards-style.css" type="text/css" />

<style type="text/css" media="all">
body, html {
	padding: 0;
	margin: 0;
	height: 100%;
	-webkit-text-size-adjust:none;
	background-color: #D3D3D3;

}
li{

	-moz-border-radius: 6px;
	-webkit-border-radius: 6px;
	border-radius:6px;

	background: white;
}

#hh{

	-moz-border-radius: 6px;
	-webkit-border-radius: 6px;
	border-radius:6px;

	margin:0 auto;

}

#bigimage{

	-moz-border-radius-topleft:6px;
	-webkit-border-top-left-radius:6px;
	-moz-border-radius-topright:6px;
	-webkit-border-top-right-radius:6px;



}
#minimage{

	-moz-border-radius:100px;
	-webkit-border-radius:100px;
	border-radius:100px;



}
#cc{

display: -webkit-box;
-webkit-box-orient: vertical;
-webkit-line-clamp: 2;
overflow: hidden;
text-overflow: ellipsis;
font-size:10px;
color:#858180;

}

</style>
</head>
<body>
<!--must content ul li,or shoupi-->
<div id="wrapper">
  <ul id='uli'>
  </ul>
</div>
<div id="mess" value="没有更多了"><div>

<?php

    function show(){

      echo "aaaa";

    };

		if($_POST["do"]=="yes"){
			show();
		}
 ?>
<script>


function jump(){

		//alert("ok");
   document.location.herf="?do=yes";
}
//图标小数组
var icon=['','movie','drama','record','cartoon','life','sports','news','music','game','happy','variety'];
//GetJson请求数据异常处理函数
$.ajaxSetup({
           		error:function(x,e){

								//alert("0");
               return false;
           }
       });

//获取当前时间的函数，转换为年月日格式
function utcToDate(utcCurrTime) {
            utcCurrTime = utcCurrTime + "";
            var date = "";
            var month = new Array();
            month["Jan"] = 1;
            month["Feb"] = 2;
            month["Mar"] = 3;
            month["Apr"] = 4;
            month["May"] = 5;
            month["Jun"] = 6;
            month["Jul"] = 7;
            month["Aug"] = 8;
            month["Sep"] = 9;
            month["Oct"] = 10;
            month["Nov"] = 11;
            month["Dec"] = 12;
            var week = new Array();
            week["Mon"] = "一";
            week["Tue"] = "二";
            week["Wed"] = "三";
            week["Thu"] = "四";
            week["Fri"] = "五";
            week["Sat"] = "六";
            week["Sun"] = "日";

            str = utcCurrTime.split(" ");
            date = str[3]+ "-"+month[str[1]] + "-" + str[2];
            return date;
        }

var Top=55;//全局变量
var myDate=new Date();//全局变量时间
var time=utcToDate(myDate);//当天的时间（年-月-日）
var ulh=0;//ul的高度


//不同手机分辨率
var Pwidth=($(window).width());//当前手机屏幕的宽度

var side=1.0*Pwidth/36;//两边的边距
var mide=1.0*Pwidth/36;//中间的边距
var hide=1.0*Pwidth/18;//上下的间距


var pwidth=(Pwidth-side-side-mide)/2;//小版图片的宽度
var pwidth2=pwidth-10;//下划线的长度
var pheight=(1.0*pwidth/7)*10;//小版图片的长宽比默认 10：7


var swidth=(Pwidth-side-side);//横版图片的宽度
var swidth2=swidth-10;//下划线的长度
var sheight=(1.0*swidth/14)*9;//横版图片的长宽比默认 9：14

var lleft=pwidth+side+mide;//小版右侧的left

var cheight=3.0*pheight/11;//文字介绍的高度为图片高度的三分之一
var cheight2=4.0*sheight/15;



var icHeight=1.0*Pwidth/14;//图标的高度
var icWidth=icHeight*2;//图标的宽度

var Pheight=pheight+cheight2+icHeight-10;//小版一个li的高度
var Pheight2=sheight+cheight+icHeight-10;//横版一个li的高度

var bottomTop=sheight-icHeight;//横版底部阴影的top值

var bottomLeft=swidth-icWidth/2;//播放键的left值
var boheight=icHeight-4;//播放键的高度
var bowidth=boheight;//播放键的宽度

var boheight2=boheight-6;//底部作者图标的高度
var bowidth2=boheight2-4;//底部作者图标的宽度

var bottomTop2=pheight-icHeight;//小版底部阴影的top值
var bottomLeft2=pwidth-icWidth/2;//小版播放键的left值

var bottomtop=sheight+cheight;//横版底部作者的top值
var bottomtop2=pheight+cheight2;//小版底部作者的top值

var icHeight2=icHeight-6;

var xxxtop=bottomTop+icHeight;
var xxxtop2=bottomTop2+icHeight;
//用辅助的缓存是达到，你给我的数据，有横版，我就加载横版，没有横版就布局竖版，不是严格的4块小的，一块大的，我觉得这样也是可行的。布局和四小一大差不多，取决于后台传的数据
//辅助的缓存最多只存一个，长度最长就是一。而真正储存的缓存，加载一次请求得到的所有数据，也不会太大，每次布局完都会清空。所以不会有内部缓存的累积。

var Purl=[];//辅助的缓存
var Pname=[];
var Ptitle=[];
var Ptype=[];
var Pcontent=[];
var Pcreatetime=[];
var Pcvideotype=[];
var Puimg=[];
var Puname=[];
var Pcid=[];

var ttop=0;//指针


var url=[];//类似于缓存，储存请求得来的视频图片
var nname=[];
var title=[];
var type=[];
var content=[];
var createtime=[];
var cvideotype=[];
var uimg=[];
var uname=[];
var cid=[];


//布局函数
function layout(){

	var len=url.length;
	for(var i=0;i<len;i++){
		//如果是横版的话
		if(type[i]==2){


			var html="<li style='position:absolute;height:"+Pheight2+"px;width:"+swidth2+"px;top:"+Top+"px;left:"+side+"px'>"
					html+="<div style='position: absolute;top:0px;left:0px;'>";
					html+="<div style='position: absolute;top: 8px;left: 8px;'><img src='image/"+icon[cvideotype[i]]+".png' style='height:"+icHeight+"px;width:"+icWidth+"px;'/></div><img id='bigimage' style='height:"+sheight+"px;width:"+swidth+"px;top:"+Top+"px;left:"+side+"px;' src='"+url[i]+"'/>";
					html+="<div style='position: absolute;top:"+bottomTop+"px;height:"+icHeight+"px;width:"+swidth+"px;background:rgba(0,0,0,0.4);line-height:"+icHeight+"px;'><font color='#FFFFFF' style='font-size:11px ;'>&nbsp;&nbsp;"+nname[i]+"</font> <a href='information.php?id="+cid[i]+"'><img src='image/play.png' onclick='jump()' style='position: absolute;left:"+bottomLeft+"px;top:2px;height:"+boheight+"px;width:"+bowidth+"px;'/></a></div></div>";
					html+="<div style='position: absolute;top:"+xxxtop+"px;height:"+cheight+"px;width:"+swidth2+"px;overflow:hidden;text-overflow:ellipsis;'><font style='font-size:11px;color:#54504f'>"+title[i]+"</font><br/>";
					html+="<div style='position: absolute;top:9px;'><img src='image/bottom.png' style='width:"+swidth2+"px;height:1px;'></div>";
          html+="<div id='cc' style='position: absolute;top:29px;line-height:12px;width:"+swidth2+"px;height:23px;'>"+content[i]+"</div>";
					html+="</div>";
					html+="<div id='hh' style='position: absolute;bottom: 0px;top:"+bottomtop+"px;left:0px;height:"+icHeight+"px;width:"+swidth+"px;background:rgba(255,255,255,1.0);line-height:"+icHeight+"px;vertical-align:middle;'>";
          html+="<div style='position:absolute;top:5px;left:0px;height:"+icHeight2+"px;width:"+swidth+"px;line-height:"+icHeight2+"px;vertical-align:middle;'><font style='font-size:8px;float:right;'>&nbsp;&nbsp;by"+uname[i]+"&nbsp;&nbsp;</font>&nbsp;&nbsp;<img  id='minimage' src='"+uimg[i]+"' style='float:right;height:"+boheight2+"px;width:"+bowidth2+"px;'/></div></div>";
					html+="</li>";
					$("#uli").append(html);
					ulh+=Pheight2+hide;
					$("#uli").height(ulh);
					Top+=Pheight2+hide;
			}
			//如果是竖版
			if(type[i]==1){
				//如果栈里没有元素就压栈
				if(ttop==0){
						//alert(ttop);
					Purl[++ttop]=url[i];
					Pname[ttop]=nname[i];
					Ptitle[ttop]=title[i];
					Ptype[ttop]=type[i];
					Pcontent[ttop]=content[i];
					Pcreatetime[ttop]=createtime[i];
					Pcvideotype[ttop]=cvideotype[i];
					Puimg[ttop]=uimg[i];
					Puname[ttop]=uname[i];
					Pcid[ttop]=cid[i];
				}
				//否则，就和栈里的元素一起出栈，排成一排
				else{

					var html="<li  style='position:absolute;height:"+Pheight+"px;width:"+pwidth2+"px;top:"+Top+"px;left:"+side+"px'>";
							html+="<div  style='position: absolute;top:0px;left:0px;'>";
							html+="<div style='position: absolute;top:8px;left: 8px;'><img src='image/"+icon[Pcvideotype[ttop]]+".png' style='height:"+icHeight+"px;width:"+icWidth+"px;'/></div> <img id='bigimage'  style='height:"+pheight+"px;width:"+pwidth+"px;top:"+Top+"px;left:"+side+"px;' src='"+Purl[ttop]+"'>";
							html+="<div style='position: absolute;top:"+bottomTop2+"px;height:"+icHeight+"px;width:"+pwidth+"px;background:rgba(0,0,0,0.4);line-height:"+icHeight+"px;'> <font color='#FFFFFF' style='font-size:11px ;' >&nbsp;&nbsp;"+Pname[ttop]+"</font> <a href='information.php?id="+Pcid[ttop]+"'><a href='information.php?id="+Pcid[ttop]+"'><img src='image/play.png' style='position: absolute;left:"+bottomLeft2+"px;top:2px;height:"+boheight+"px;width:"+bowidth+"px;'/></a></div></div>";
							html+="<div style='position: absolute;top:"+xxxtop2+"px;height:"+cheight2+"px;overflow:hidden;text-overflow:ellipsis;width:"+pwidth2+"px;'><font style='font-size:11px;color:#54504f'>"+Ptitle[ttop]+"</font><br/>";
							html+="<div style='position: absolute;top:9px;'><img src='image/bottom.png' style='width:"+pwidth2+"px;height:1px;'></div>";
		          html+="<div id='cc' style='position: absolute;top:29px;line-height:12px;width:"+pwidth2+"px;height:23px;'>"+Pcontent[ttop]+"</div>";
							html+="</div>";
							html+="<div id='hh' style='position: absolute;bottom: 0px;top:"+bottomtop2+"px;left:0px;height:"+icHeight+"px;width:"+pwidth+"px;background:rgba(255,255,255,1.0);line-height:"+icHeight+"px;vertical-align:middle;'>";
              html+="<div style='position:absolute;top:5px;left:0px;height:"+icHeight2+"px;width:"+pwidth+"px;line-height:"+icHeight2+"px;vertical-align:middle;'><font style='font-size:8px;float:right;'>&nbsp;&nbsp;by"+Puname[ttop]+"&nbsp;&nbsp;</font>&nbsp;&nbsp;<img id='minimage' src='"+Puimg[ttop]+"' style='float:right;height:"+boheight2+"px;width:"+bowidth2+"px;'/></div></div>";
							html+="</li>";
							$("#uli").append(html);
							ttop--;

							var html="<li style='position:absolute;height:"+Pheight+"px;width:"+pwidth2+"px;top:"+Top+"px;left:"+lleft+"px'>"
									html+="<div style='position: absolute;top:0px;left:0px;'>";
									html+="<div style='position: absolute;top: 8px;left:8px;'><img src='image/"+icon[cvideotype[i]]+".png' style='height:"+icHeight+"px;width:"+icWidth+"px'/></div> <img id='bigimage' style='height:"+pheight+"px;width:"+pwidth+"px;top:"+Top+"px;left:"+lleft+"px;' src='"+url[i]+"'>";
									html+="<div style='position: absolute;top:"+bottomTop2+"px;height:"+icHeight+"px;width:"+pwidth+"px;background:rgba(0,0,0,0.4);line-height:"+icHeight+"px;'> <font color='#FFFFFF' style='font-size:11px ;' >&nbsp;&nbsp;"+nname[i]+"</font><a href='information.php?id="+cid[i]+"'><img src='image/play.png' style='position: absolute;left:"+bottomLeft2+"px;top:2px;height:"+boheight+"px;width:"+bowidth+"px;'/></a></div></div>";
									html+="<div style='position: absolute;top:"+xxxtop2+"px;height:"+cheight2+"px;overflow:hidden;text-overflow:ellipsis; width:"+pwidth2+"px;'><font style='font-size:11px;color:#54504f'>"+title[i]+"</font><br/>";
									html+="<div style='position: absolute;top:9px;'><img src='image/bottom.png' style='width:"+pwidth2+"px;height:1px;'></div>";
				          html+="<div id='cc' style='position: absolute;top:29px;line-height:12px;width:"+pwidth2+"px;height:23px;'>"+content[i]+"</div>";
									html+="</div>"
									html+="<div id='hh' style='position: absolute;bottom: 0px;top:"+bottomtop2+"px;left:0px;height:"+icHeight+"px;width:"+pwidth+"px;background:rgba(255,255,255,1.0);line-height:"+icHeight+"px;vertical-align:middle;'>";
									html+="<div style='position:absolute;top:5px;left:0px;height:"+icHeight2+"px;width:"+pwidth+"px;line-height:"+icHeight2+"px;vertical-align:middle;'><font style='font-size:8px;float:right;'>&nbsp;&nbsp;by"+uname[i]+"&nbsp;&nbsp;</font>&nbsp;&nbsp;<img id='minimage' src='"+uimg[i]+"' style='float:right;height:"+boheight2+"px;width:"+bowidth2+"px;'/></div></div>";
									html+="</li>";
							$("#uli").append(html);
							ulh+=Pheight+hide;
							$("#uli").height(ulh);
							Top+=Pheight+hide;
						}
			}
	}
  	$("#uli").height(ulh+20);
}

//加载数据的函数
function loadData(){
	var tag=0;//判断能否请求到数据。
	$.getJSON("http://bc.runbros.com/api/card/getCard.php?time="+time,function(data){
			//初始化
			 url=[];nname=[];title=[];
			 type=[];content=[];createtime=[];cvideotype=[];uimg=[];uname=[];cid=[];

				$.each(data.card,function(i,term){
					//alert(term.cimg);
					url.push(term.cimg);
					nname.push(term.cname);
					title.push(term.ctitle);
					type.push(term.ccardtype);
					content.push(term.ccontent);
					createtime.push(term.ccreatetime);
					cvideotype.push(term.cvideotype);
					uimg.push(term.uimg);
					uname.push(term.uname);
					cid.push(term.cid);
					time=term.ccreatetime;
					tag=1;
				});

});

			//如果有某个时间点不能正常获取数据，就推到下一天,（这里我觉得还要改进，可以等后面再改）
			setTimeout(function(){
				//alert(tag);
				if(tag==0){
				var time2=time.split(" ");
				var time3=time2[0].split("-");
				time3[2]=time3[2]-1;
				time=time3[0]+"-"+time3[1]+"-"+time3[2]+" "+time2[1];
				loadData();
				//alert(time);
			}
		},2000);
}

//刚进页面的加载函数
window.onload=function(){

var x=$(window).height();
var y=$(window).width();
$("#wrapper").height(x);
$("#wrapper").width(y);
//加载的时候请求一次数据，并显示出来
	$.getJSON("http://bc.runbros.com/api/card/getCard.php?time="+time,function(data){
			//初始化
			 url=[];nname=[];title=[];
			 type=[];content=[];createtime=[];cvideotype=[];uimg=[];uname=[];cid=[];

				$.each(data.card,function(i,term){
					//alert(term.cimg);
					url.push(term.cimg);
					nname.push(term.cname);
					title.push(term.ctitle);
					type.push(term.ccardtype);
					content.push(term.ccontent);
					createtime.push(term.ccreatetime);
					cvideotype.push(term.cvideotype);
					uimg.push(term.uimg);
					uname.push(term.uname);
					cid.push(term.cid);
					time=term.ccreatetime;
					//alert(time);
					tag=1;
			});

			layout();

      url=[];nname=[];title=[];
			type=[];content=[];createtime=[];cvideotype=[];uimg=[];uname=[];cid=[];

		});



}

refresher.init({
	id:"wrapper",//<------------------------------------------------------------------------------------┐
	pullDownAction:Refresh,
	pullUpAction:Load
	});

//下拉操作
function Refresh() {

	setTimeout(function () {	// <-- Simulate network congestion, remove setTimeout from production!
		 loadData();
		/****remember to refresh after  action completed！ ---yourId.refresh(); ----| ****/
	}, 500);
	layout();
	wrapper.refresh();
}
//上滑操作
function Load() {

	setTimeout(function () {// <-- Simulate network congestion, remove setTimeout from production!
		loadData();
		/****rem写ember to refresh after action completed！！！   ---id.refresh(); --- ****/
	}, 500);
	layout();
	wrapper.refresh();
}
</script>

</body>
</html>
