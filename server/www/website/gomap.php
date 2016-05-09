<!DOCTYPE html>  
<html>  
<head>  
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />  <!--为了更好的兼容手机设置viewport，这样手机就可以滑动查看页面了-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
<title>Hello, World</title>  
<style type="text/css">  
html{height:100%;}  
body{height:100%;margin:0px;padding:0px;}
#container{height:100%}  
.cameraList{position:absolute;right:0px;top:0px;z-index:1;background-color:rgba(255,255,255,0.8);padding-left:10px;padding-top:10px;}
.cameraList select{width:150px;height:30px;margin-left:7px}
.cameraList ul{right:20px;top:0px;}
</style> 
<!--style里面不能加这种注解，不知道为什么，加了就什么也不显示了，所以写到了下面-->
 <!--html中的body元素样式-->
<!--#表示后面取的是id，这句话表示设置id为container的样式--> 
<!--.kuan input{ width:30px; height:60px;no-repeat; border:none; float:left}
.an input{ width:120px; height:60px;  background:background:url(../img/an_02.jpg) no-repeat;border:none;  float:left}-->
<!--上面这句表示设置div class为an的里面的input元素的样式-->
<!--.an表示一个类（经常使用div），input表示这个类里面的一个元素（或成员）-->
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=c3HzkQBf0EEMX4GTOSdln4f9">
//
//v2.0版本的引用方式：src="http://api.map.baidu.com/api?v=2.0&ak=您的密钥"
//v1.4版本及以前版本的引用方式：src="http://api.map.baidu.com/api?v=1.4&key=您的密钥&callback=initialize"
var camera；
var currentPage;                                              //定义变量表示当前页数
var SumPage;                        //当前页数
var dataArray;   
var temp;                  
</script>
<script type="text/javascript"> 

var a = 3;
function change(value)
{
	//alert("select is" + value);
	if(value==1){
		dataArray.sort(function(a,b){
            return b.zan-a.zan});
		//alert(arr[0].zan);
		gotofirst();
	}else if(value==2){
		//alert("select is 2");
		dataArray.sort(function(a,b){
			return b.buzan-a.buzan});
		//alert(arr[0].zan);
		gotofirst();
	}
}
function gotofirst()
{
	currentPage=1;
	S2.appendChild(document.createTextNode(currentPage));
	removelist();
	for(x = 0;x < 10;x++)
	{
	var data = "id: " + dataArray[x]["id"] + " zan: " + dataArray[x]["zan"] + " buzan: \
	" + dataArray[x]["buzan"] + " time: " + dataArray[x]["uptime"];
	addItem(data);
	}
}
function addNewList(data)
{
	//alert("li is" + document.getElementById('list').getElementsByTagName('li').length);
	var list = document.getElementById('list');
	var item = list.getElementsByTagName('li');
	//alert(camera["result"]["Camera.list"].length);
	for(var y = 0; y < camera["result"]["Camera.list"].length;y++)
	{
		list.removeChild(item[0]);	
	var data = "id: " + camera["result"]["Camera.list"][y]["id"] + " zan: " + camera["result"]["Camera.list"][y]["zan"] + " buzan: \
	" + camera["result"]["Camera.list"][y]["buzan"] + " time: " + camera["result"]["Camera.list"][y]["uptime"];
	addItem(data);		
	}
}
function removelist()
{
	var list = document.getElementById('list');
	var item = list.getElementsByTagName('li');
	var length = item.length;
	//alert(camera["result"]["Camera.list"].length);
	for(var y = 0; y < length;y++)
	{
		list.removeChild(item[0]);			
	}
}
function del()
{
	deleteCamera(camera["result"]["Camera.list"][temp]["id"]);
}
function openWindow(index){
var opts = {    
 width : 250,     // 信息窗口宽度    
 height: 100,     // 信息窗口高度     
 title: "camera " + camera["result"]["Camera.list"][index].id,
}    
temp = index;
map.closeInfoWindow();
var content = "<ul id=\"winList\" style=\"list-style-type:none;margin:0px;padding:0;\"><div style=\"margin-bottom: 7px;\"><a href=\"comment.html\" target=\"view_window\">添加评论</a><div style=\"margin-bottom: 7px;\"><a href=\"demos/getcomment.html\" target=\"view_window\">查看评论</a></div><input type=\"button\" value=\"删除\" id=\"delete\" onclick=\"del()\"> <input type=\"button\" value=\"首页\" id=\"F-page\">";
var infoWindow = new BMap.InfoWindow(content, opts);  // 创建信息窗口对象    
var point2 = new BMap.Point(camera["result"]["Camera.list"][index]["longitude"], camera["result"]["Camera.list"][index]["latitude"]);
map.openInfoWindow(infoWindow, point2);      // 打开信息窗口
/*document.getElementById('delete').onclick = function(){
	deleteCamera(camera["result"]["Camera.list"][temp]["id"]);
};*/

map.centerAndZoom(point2, 15); 
}
function addOnlick(){
var ul = document.getElementById('list');
var li = ul.getElementsByTagName('li');
ul.onclick = function(e){
	var e = e || window.event, target = e.target || e.srcElement;
	var m;
	m=10*(currentPage-1);
	for(var s in li){
		if(target == li[s]){
		var a=parseInt(m)+parseInt(s);
		//alert(camera["result"]["Camera.list"][a]["id"]);
		openWindow(a);
		break;
		}
	}
}
}
function addItem(data){
var list = document.getElementById("list");
var li = document.createElement("li");
//　　li.setAttribute("id", "newli");
li.innerHTML = data;
li.style.padding = "10px";
list.appendChild(li);
}
function wang(){
// alert("wang");
var pwid=document.getElementById("from1");
var data = pwid.submit();
//var obj = eval("("+data+")");
}
<!--用IE浏览器能获取到数据，用google就不行-->
function loadXMLDoc()
{
var xmlhttp;

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  //alert("wang");
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  var x;
  //alert("state " + xmlhttp.readyState + " status" + xmlhttp.status);
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    var value1=xmlhttp.responseText;
	camera = eval("(" + value1 + ")");
	//alert("return message is " + camera["result"]["Camera.list"][0]["id"] + " camera length is " + camera["result"]["Camera.list"].length);
	alert(camera["result"]["Camera.list"].length);
	dataArray= camera["result"]["Camera.list"];
	
	currentPage=1;
	S2.appendChild(document.createTextNode(currentPage));
	 if(dataArray.length%10==0)                    //判断总的页数
     {
           SumPage=parseInt(dataArray.length/10);
     }
     else
     {
            SumPage=parseInt(dataArray.length/10)+1;
     }
     S1.appendChild(document.createTextNode(SumPage));
	addover();
	for(x = 0;x < 10;x++)
	{
	var data = "id: " + camera["result"]["Camera.list"][x]["id"] + " zan: " + camera["result"]["Camera.list"][x]["zan"] + " buzan: \
	" + camera["result"]["Camera.list"][x]["buzan"] + " time: " + camera["result"]["Camera.list"][x]["uptime"];
	addItem(data);
	}
addOnlick();
    }
  }
xmlhttp.open("GET","http://127.0.0.1:8003/camera/getCamera",true);
xmlhttp.send();
}
function addover()
{
	for(x in dataArray)
	{
		//alert("x = " + x);
		var point1 = new BMap.Point(camera["result"]["Camera.list"][x]["longitude"], camera["result"]["Camera.list"][x]["latitude"]); 
		var marker = new BMap.Marker(point1,{strokeColor:"blue",fillColor:"green",strokeWeight:2, strokeStyle:"dashed", strokeOpacity:0.5});        // 创建标注   
		//var marker = new BMap.Circle(point1,1000,{strokeColor:"blue",fillColor:"green",strokeWeight:2, strokeStyle:"dashed", strokeOpacity:0.5});	
		marker.addEventListener("click", function(e){  
			var longitude = e.target.point.lng;
			var latitude = e.target.point.lat;
			for(var x in dataArray)
			{
				//alert("longitude" + longitude + " data array longitude is " + dataArray[x]["longitude"]);
				if((longitude == dataArray[x]["longitude"]) && (latitude == dataArray[x]["latitude"]))
				{
					openWindow(x);
					break;
				}
			}  
			});
		map.addOverlay(marker);
	}
}
function deleteCamera(id)
{
var xmlhttp;
var arry;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    var value1=xmlhttp.responseText;
	arry = eval("(" + value1 + ")");
	if(arry["code"] == "10000") {
		alert("delete camera sucessfully id " + id);
	}
    }
  }
xmlhttp.open("POST","http://127.0.0.1:8003/camera/deleteCamera",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("id=" + id);
}
</script>
</head>

<!--<input name="" type="text" style="height: 84px;width:30px;"/>
</div>
<div class="an" style="height: 84px;width:30px;">
<input name="" type="button" />
</div>-->
<!--下面的代码可以实现在地图去除白色背景,默认的z-index是0，所以1的话就是在地图上面，z-index必须配合position一起使用-->
<!--background-color:transparent;-->
<p style="position:absolute;
background-color:rgba(0,152,50,1);
left:30px;
top:0px;
z-index:1;">wanglining</p>
<div class="cameraList" id="mylist">
<select onchange="change(this.value)">  
  <option value ="1">zan</option>  
  <option value ="2">buzan</option>  
</select>  
<ul id="list" style="list-style-type:none;padding:0px;margin:0px;">
</ul>
<div style="padding-top:20px;padding-bottom:10px;padding-left:6px">
总共<span id="s1"></span>页
当前第<span id="s2"></span>页
</div>
<div id="div-button" style="padding-bottom:10px;padding-left:6px">
<input type="button" value="首页" id="F-page">
<input type="button" value="下一页" id="Nex-page">
<input type="button" value="上一页" id="Pre-page">
<input type="button" value="尾页" id="L-page">
</div>
</div>
<!--<form id="from1" action="http://127.0.0.1:8003/camera/getCamera" method="get"></form>-->
<!--<button onclick="addItem()"></button>-->
<body onload="loadXMLDoc()">  
<div id="container"></div> 
<script type="text/javascript"> 
var Fp=document.getElementById('F-page');                      //首页
var Nep=document.getElementById('Nex-page');                  //下一页
var Prp=document.getElementById('Pre-page');                  //上一页
var Lp=document.getElementById('L-page');                     //尾页
var S1=document.getElementById('s1');                         //总页数
var S2=document.getElementById('s2');
  
var map = new BMap.Map("container");          // 创建地图实例  
var point = new BMap.Point(116.404, 39.915);  // 创建点坐标  
//var opts = {anchor: BMAP_ANCHOR_BOTTOM_LEFT }    
map.addControl(new BMap.NavigationControl());  
map.centerAndZoom(point, 15);                 // 初始化地图，设置中心点坐标和地图级别  
	function showInfo(e){
		alert(e.point.lng + ", " + e.point.lat);
	}
map.addEventListener("click", showInfo);
Nep.onclick=function()
{
	if(currentPage<SumPage)                                 //判断当前页数小于总页数
    {
		currentPage=currentPage+1;
		S2.innerHTML='';
		S2.appendChild(document.createTextNode(currentPage));
		var a;                                                 //定义变量a
        a=10*(currentPage-1);                       //a等于每页显示的行数乘以上一页数
        var c;                                                  //定义变量c
        if(dataArray.length-a>=10)                  //判断下一页数组数据是否小于每页显示行数
        {
            c=10;
        }
        else
        {
            c=dataArray.length-a;
        }
		removelist();
		for(var i=0;i<c;i++)
        {
			var data = "id: " + dataArray[a+i]["id"] + " zan: " + dataArray[a+i]["zan"] + " buzan: \
				" + dataArray[a+i]["buzan"] + " time: " + dataArray[a+i]["uptime"];
			addItem(data);
		} 
	}
}
Prp.onclick=function()
{
    if(currentPage>1)                        //判断当前是否在第一页
    {
		S2.innerHTML='';
		currentPage=currentPage-1;
        S2.appendChild(document.createTextNode(currentPage));
		var a;
		a=10*(currentPage-1);
		removelist();
		for(var i=0;i<10;i++)
        {
			var data = "id: " + dataArray[a+i]["id"] + " zan: " + dataArray[a+i]["zan"] + " buzan: \
				" + dataArray[a+i]["buzan"] + " time: " + dataArray[a+i]["uptime"];
			addItem(data);
		} 
	}
}
Lp.onclick=function()
{
	S2.innerHTML='';
    currentPage=SumPage;
    S2.appendChild(document.createTextNode(currentPage));
	var a;                                                 //定义变量a
    a=10*(currentPage-1);                       //a等于每页显示的行数乘以上一页数
    var c;                                                  //定义变量c
    if(dataArray.length-a>=10)                  //判断下一页数组数据是否小于每页显示行数
    {
        c=10;
    }
    else
    {
        c=dataArray.length-a;
    }
	removelist();
	for(var i=0;i<c;i++)
    {
		var data = "id: " + dataArray[a+i]["id"] + " zan: " + dataArray[a+i]["zan"] + " buzan: \
				" + dataArray[a+i]["buzan"] + " time: " + dataArray[a+i]["uptime"];
		addItem(data);
	} 
}
Fp.onclick=function()
{
	S2.innerHTML='';
	currentPage=1;
	S2.appendChild(document.createTextNode(currentPage));
	removelist();
	for(x = 0;x < 10;x++)
	{
	var data = "id: " + camera["result"]["Camera.list"][x]["id"] + " zan: " + camera["result"]["Camera.list"][x]["zan"] + " buzan: \
	" + camera["result"]["Camera.list"][x]["buzan"] + " time: " + camera["result"]["Camera.list"][x]["uptime"];
	addItem(data);
	}
}
var x;
alert("camera size is " + camera);

</script> 
</body>  

</html>