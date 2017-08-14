<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<style>
#cc{
	display: -webkit-box;
	-webkit-box-orient: vertical;
	-webkit-line-clamp: 1;
	overflow: hidden;
	text-overflow: ellipsis;
}


</style>
</head>


<script src="js/stackblur.js"></script>

<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script>

var icon=['','电影','热剧','纪录','动漫','生活','体育','新闻','音乐','游戏','娱乐','综艺'];
var videoIcon=['','iqiyi','iqiyi','iqiyi','yinyuetai','iqiyi','iqiyi','iqiyi','iqiyi','tangdou'];
var videoName=['','爱奇艺','爱奇艺','爱奇艺','音悦台','爱奇艺','爱奇艺','爱奇艺','爱奇艺','糖豆网'];
var name;//视频的名称
var type;//视频的分类
var title;//视频的标题
var content;//视频的内容
var image;//视频的图片

var x;
var y;
var h;
var tleft;
var ttop;
var twidth;
var theight;
var map={};
map["爱奇艺"]="iqiyi";
map["凤凰"]="fenghuang";
map["风行"]="fengxing";
map["华数"]="huashu";
map["酷六"]="ku6";
map["酷狗"]="kugou";
map["乐视"]="letv";
map["pps"]="pps";
map["PPTV"]="pptv";
map["新浪"]="sina";
map["搜狐"]="souhu";
map["糖豆网"]="tangdou";
map["糖豆"]="tangdou";
map["腾讯"]="tengxun";
map["土豆"]="tudou";
map["微电影"]="vdianying";
map["网易"]="wangyi";
map["香巢"]="xiangchao";
map["音悦台"]="yinyuetai";
map["优酷"]="youku";
map["芒果TV"]="hunantv";
map["哔哩哔哩"]="bilibili";
map["AcFun"]="acfun";
map["56"]="56";
map["CNTV"]="cntv";
map["爆米花"]="baomihua";
map["贝瓦网"]="beiwawang";


window.onload=function(){

	//alert("ok");

	var aQuery = window.location.href.split("?");
	var bQuery=aQuery[1].split("=");
	var id=bQuery[1];

	 x=$(window).height();//获取当前手机的高度
	 y=$(window).width();//获取当前手机的宽度
	$("#fa").height(x);//大框子的高度
	$("#fa").width(y);//大框子的宽度
	$("#canvas01").width(y);//画布的宽度
	$("#canvas01").height(1.0*x/7);
	 h=1.0*x/3;//高斯模糊的高度

	 tleft=1.0*y/22;//左上侧图片的绝对定位值
	 ttop=tleft;

	 twidth=1.0*y/4;//左上侧图片的长宽
	 theight=10.0*twidth/7;

	 //放置图片
	$("#titleimg").css("left",tleft);
	$("#titleimg").css("top",ttop);

	$("#titleImg").width(twidth);
	$("#titleImg").height(theight);

	var cleft=tleft+twidth+ttop-4;//左上侧标题的绝对定位
	var ctop=ttop+6;

	//放置标题
	$("#titlename").css("left",cleft);
	$("#titlename").css("top",ctop);

  //左上侧介绍的绝对定位
	var bleft=cleft;
	var btop=1.0*x/8+10;
	//放置介绍
	$("#titlecont").css("left",bleft);
	$("#titlecont").css("top",btop);

  var bbtop=btop+20;
	var bbwidth=y-ttop*2-twidth;
	$("#index").css("width",bbwidth);





	$("#topDiv").css("min-height",ttop+theight+ttop-4);
	//$("#midDiv").css('height','auto');

	//评论div的定位
	//间隙
	var tag=1.0*x/70;
	var h1=$("#topDiv").height()+tag;
	$("#midDiv").css("top",h1);







	var url="http://bc.runbros.com/api/card/getSingleCard.php?cid="+id ;

	$.getJSON(url,function(data){


		name=data.card.cname;
		title=data.card.ctitle;
		type=data.card.cvideotype;
		content=data.card.ccontent;
		image=data.card.cimg;

		$("#bcimg").attr('src',"image/bb.jpg");
		$("#titleImg").attr('src',image);
    $("#index").html(content);

		loadc();

		var c=document.getElementById("canvas01");
		var ctx=c.getContext("2d");
		var img=document.getElementById("bcimg");
		var xx=(1.0*140/412)*y;
		//alert(y);
		//高斯模糊
		img.onload=function(){

			ctx.drawImage(img,40,160,y,h,0,0,y,h);
			StackBlur.canvasRGB(canvas01,0,0,y,h,52);

		}



    //StackBlur.image(img,canvas01,52);
		//添加标题
		$("#titleName").html(name);
		$("#titletype").html(icon[type]);

		//添加介绍
		$("#titleCont").html(title);
		$("#titlecontext").html(content);


		//var 评论的top

		//评论的高度
		var h2=1.0*x/10;
		var htop=1.0*h2/3;
		//图标的高度
		var iconHeight=1.0*x/26;
		var iconWidth=iconHeight;

		var IconHeight=iconHeight+2;
		var IconWidth=IconHeight+2;

		var iconHeight2=iconHeight-8;
		var iconWidth2=iconHeight2-4;

		//评论内容的left
		var comleft=ttop+iconHeight+8;
		//评论内容的宽度
		var comwidth=y-(ttop+iconHeight+3)*2;
		//括号的left
		var nextleft=comleft+comwidth+ttop;
		//横线的top
		var bottomtop=0;
		//横线的width
		var bottomwidth=y-ttop*2;

		var hh=h2;

		var tag2=0;

		$.each(data.comment,function(i,term){

			var src=term.src;
			var url=term.url;
			var title=term.title;
			if(tag2!=0){
				var html2="<img src='image/bottom.png' style='position:absolute;left:"+ttop+"px;top:"+bottomtop+"px;width:"+bottomwidth+"px;height:1px;'/>";
	      $("#midDiv").append(html2);

			}
			var html="<div onclick='window.open(&quot;"+url+"&quot;)' style='position:absolute;top:"+htop+"px;left:"+tleft+"px;height:"+iconHeight+"px;width:"+iconWidth+"px;'>";
			 html+="<img src='image/"+src+".png' style='height:"+iconHeight+"px;width:"+iconWidth+"px;'>";
			 html+="</div>";
			 html+="<div onclick='window.open(&quot;"+url+"&quot;)' style='position:absolute;top:"+htop+"px;left:"+comleft+"px;height:"+iconHeight+"px;width:"+comwidth+"px;text-overflow:ellipsis;line-height:"+iconHeight+"px;'>";
			 html+="<font style='font-size:13px;color:#54504f'>"+title+"</font></div>";
			 html+="<div onclick='window.open(&quot;"+url+"&quot;)' style='position:absolute;left:"+nextleft+"px;top:"+htop+"px;height:"+iconHeight+"px;width:"+iconWidth+"px;'><img src='image/kuozhehao.png' style='height:"+iconHeight2+"px;width:"+iconWidth2+"px;'></div>"
			$("#midDiv").height(hh);
			$("#midDiv").append(html);
		tag2++;

			htop+=h2;
			bottomtop+=h2;
			hh+=h2;
		});

	 var hh1=$("#midDiv").height()+h1+tag;
	 $("#bottomDiv").css("top",hh1);

		var URL="http://bc.runbros.com/api/search/csearch.php?keyword="+name;
		$.getJSON(URL,function(data){

			//alert("ok");
			var i=data.moviePrograms.items.length;
			i+=data.cardPrograms.items.length;
			i+=data.soaPrograms.items.length;
			var string;
			if(i==0)
			   string="不好意思，暂时没有搜到资源，敬请期待";
			else {
				string="为您搜索到《"+name+"》,即可点播欣赏";
			}

			//资源标题的高度
			var videoH=1.0*x/13;
			var vtop=videoH+ttop+2;//高度
			var vtop2=ttop+iconHeight+5;
			var vtop3=vtop+3;
			//视频网站名称的left
			var vnleft=ttop+ttop+iconWidth-5;
			//标题的left
			var cnleft=vnleft+45;
			//简介的left
			var vcleft=vnleft+ttop;

			var iconHeight3=iconHeight2-1;
			var iconWidth3=iconWidth2-2;
			var y2=y-20;
			var ttop2=ttop-4;
			var hh3=ttop2+iconHeight+ttop2;
			var hh2=hh3;
			var hh4=ttop2+iconHeight+6;
			var html="<div id='cc' style='position:absolute;left:"+tleft+"px;top:"+ttop2+"px;height:"+iconHeight+"px;font-size:14px;'>"+string+"</div>";
			html+="<img src='image/bottom.png' style='position:absolute;left:0px;top:"+hh4+"px;width:"+y+"px;height:1px;'/></div>";
			$("#bottomDiv").append(html);
			$("#bottomDiv").height(hh3);

      var html2;
			var ttag2=0;

			var urlMovie="http://api.runbros.com/jmd-apis/wechat/?r=wtv/Dmovie&movieid=";
			var urlSoa="http://api.runbros.com/jmd-apis/wechat/?r=wtv/Dsoa&soapid=";
			$.each(data.moviePrograms.items,function(i,term){



						if(ttag2!=0){
							var html3="<img src='image/bottom.png' style='position:absolute;left:10px;top:"+vtop2+"px;width:"+y2+"px;height:1px;'/>";
							$("#bottomDiv").append(html3);
						}
              //alert(term.type);
							var xxx=term.type;

							if (!term.type && typeof(term.type)!="undefined" && term.type!=0)
								xxx=9;
                     //alert(map[term.src]);
					         html2="<img src='image/"+map[term.src]+".png' style='position:absolute;top:"+vtop+"px;left:"+ttop+"px;height:"+IconHeight+"px;width:"+IconWidth+"px;'>";
									 html2+="<div onclick='window.open(&quot;"+urlMovie+term.movieId+"&quot;)' style='position:absolute;top:"+vtop+"px;left:"+vnleft+"px;height:"+iconHeight+"px;line-height:"+iconHeight+"px;'><font style='font-size:14px;color:#54504f'>"+term.src+"&nbsp;&nbsp;</font><font style='font-size:12px;color:#858180'>&nbsp;&nbsp;"+term.title+"&nbsp;&nbsp;</font></div>";
									 html2+="<img src='image/kuozhehao.png' style='position:absolute;top:"+vtop3+"px;left:"+nextleft+"px;height:"+iconHeight3+"px;width:"+iconWidth3+"px'/>";
                   //html2+="<img src='image/bottom.png' style='position:absolute;left:10px;top:"+vtop2+"px;width:"+y2+"px;height:1px;'/>";

									 hh2+=h2;
		 							$("#bottomDiv").height(hh2);
		 							$("#bottomDiv").append(html2);
		 							vtop+=h2;
									vtop2+=h2;
									vtop3+=h2;
									ttag2=1;

								});

				$.each(data.soaPrograms.items,function(i,term){

					if(ttag2!=0){
						var html3="<img src='image/bottom.png' style='position:absolute;left:10px;top:"+vtop2+"px;width:"+y2+"px;height:1px;'/>";
						$("#bottomDiv").append(html3);
					}

					var xxx=term.type;

					if (!term.type && typeof(term.type)!="undefined" && term.type!=0)
						xxx=9;

							 html2="<img src='image/"+map[term.src]+".png' style='position:absolute;top:"+vtop+"px;left:"+ttop+"px;height:"+IconHeight+"px;width:"+IconWidth+"px;'>";
							 html2+="<div onclick='window.open(&quot;"+urlSoa+term.soapid+"&quot;)' style='position:absolute;top:"+vtop+"px;left:"+vnleft+"px;height:"+iconHeight+"px;line-height:"+iconHeight+"px;'><font style='font-size:14px;color:#54504f'>"+term.src+"&nbsp;&nbsp;</font><font style='font-size:12px;color:#858180'>&nbsp;&nbsp;"+term.title+"&nbsp;&nbsp;</font><font style='font-size:12px;color:#858180'>更新至"+term.subItemsNum+"集</font></div>";
							 html2+="<img src='image/kuozhehao.png' style='position:absolute;top:"+vtop3+"px;left:"+nextleft+"px;height:"+iconHeight3+"px;width:"+iconWidth3+"px'/>";
							// html2+="<img src='image/bottom.png' style='position:absolute;left:10px;top:"+vtop2+"px;width:"+y2+"px;height:1px;'/>";

							 hh2+=h2;
							$("#bottomDiv").height(hh2);
							$("#bottomDiv").append(html2);
							vtop+=h2;
							vtop2+=h2;
							vtop3+=h2;
							ttag2=1;


				});

				$.each(data.cardPrograms.items,function(i,term){

					if(ttag2!=0){
						var html3="<img src='image/bottom.png' style='position:absolute;left:10px;top:"+vtop2+"px;width:"+y2+"px;height:1px;'/>";
						$("#bottomDiv").append(html3);
					}


					var xxx=term.type;

					if (!term.type && typeof(term.type)!="undefined" && term.type!=0)
						xxx=9;

							 html2="<img src='image/"+map[term.src]+".png' style='position:absolute;top:"+vtop+"px;left:"+ttop+"px;height:"+IconHeight+"px;width:"+IconWidth+"px;'>";
							 html2+="<div style='position:absolute;top:"+vtop+"px;left:"+vnleft+"px;height:"+iconHeight+"px;line-height:"+iconHeight+"px;'><font style='font-size:14px;color:#54504f'>"+term.src+"&nbsp;&nbsp;</font><font style='font-size:12px;color:#858180'>&nbsp;&nbsp;"+term.title+"&nbsp;&nbsp;</font></div>";
							 html2+="<img src='image/kuozhehao.png' style='position:absolute;top:"+vtop3+"px;left:"+nextleft+"px;height:"+iconHeight3+"px;width:"+iconWidth3+"px'/>";
							// html2+="<img src='image/bottom.png' style='position:absolute;left:10px;top:"+vtop2+"px;width:"+y2+"px;height:1px;'/>";

							 hh2+=h2;
							$("#bottomDiv").height(hh2);
							$("#bottomDiv").append(html2);
							vtop+=h2;
							vtop2+=h2;
							vtop3+=h2;
							ttag2=1;

				});





				});

	});








}



</script>

<body>

			<div id=fa style="position:absolute;left:0px;top:0px;background-color: #e7e5e6;">
					<div id="topDiv" style="position:absolute;left:0px;top:0px;width:100%;background: white;">
							<img id="bcimg"  style="display:none;" />
							<canvas id="canvas01" ></canvas>
					    <div id="titleimg" style="position:absolute;">
									<img id="titleImg"/>
							</div>
					    <div id="titlename" style="position:absolute">
									<font id="titleName" style="font-size:15px;font-weight:600;color:white;"></font><br/>
									<font id="titletype" style="font-size:12px;font-weight:lighter;color:white"></font>
							</div>
					    <div id="titlecont" style="position:absolute">
									<font id="titleCont" style="font-size:13px;font-weight:600;color:#2f2929;"></font><br/>
									<div class="desc">
										<div style="height:3px;"></div>
								     <div id="index" class="branddesc" style="font-size:12px;color:#858180;font-weight:lighter;"></div>
							    </div>

					    </div>
				   </div>

				   <div id="midDiv" style="position:absolute;left:0px;background:white;width:100%;overflow:hidden;">
				   </div>

					 <div id="bottomDiv" style="position:absolute;left:0px;background:white;width:100%;overflow:hidden;">

					 </div>


			</div>





</body>
<script>
function loadc(){
$.fn.moreText = function(options){
var defaults = {
maxLength:200,
mainCell:".branddesc",
openBtn:'展开',
closeBtn:'收起'
}
return this.each(function() {
var _this = $(this);

var opts = $.extend({},defaults,options);
var maxLength = opts.maxLength;
var TextBox = $(opts.mainCell,_this);
var openBtn = opts.openBtn;
var closeBtn = opts.closeBtn;

var countText = TextBox.html();
var newHtml = '';
if(countText.length > maxLength){
newHtml = countText.substring(0,maxLength)+'...<span class="more" style="color:red;">'+openBtn+'</span>';
}else{
newHtml = countText;
}
TextBox.html(newHtml);
TextBox.on("click",".more",function(){
if($(this).text()==openBtn){
TextBox.html(countText+' <span class="more" style="color:red;">'+closeBtn+'</span>');
var h1=$("#titlecont").height()
//alert(h1);
var h2=$("#titlecont").offset().top;
//alert(h2);
var h3=Number(h1)+Number(h2);
$("#topDiv").css("height",h3+6);
//$("#midDiv").css("top",)
var tag=1.0*x/70;
//alert(x);
var h4=$("#topDiv").height()+tag;
$("#midDiv").css("top",h4);

var h5=$("#midDiv").height()+h4+tag;
$("#bottomDiv").css("top",h5);


}else{
TextBox.html(newHtml);
$("#topDiv").css("height",ttop+theight+ttop-4);

var tag=1.0*x/70;
var h4=$("#topDiv").height()+tag;
$("#midDiv").css("top",h4);

var h5=$("#midDiv").height()+h4+tag;
$("#bottomDiv").css("top",h5);
}
})
})
}

$(function(){
$(".desc").moreText({
maxLength: 40, //默认最大显示字数，超过...
mainCell: '.branddesc' //文字容器
});
})
}
</script>
</html>
