<!DOCTYPE html>  
<html>  
<head>  
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
<title>Hello, World</title>  
<style type="text/css">  
html{height:100%}  
body{height:100%;margin:0px;padding:0px}  
#container{height:100%}  
</style>  
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=c3HzkQBf0EEMX4GTOSdln4f9">
//v2.0�汾�����÷�ʽ��src="http://api.map.baidu.com/api?v=2.0&ak=������Կ"
//v1.4�汾����ǰ�汾�����÷�ʽ��src="http://api.map.baidu.com/api?v=1.4&key=������Կ&callback=initialize"
</script>
</head>  
 
<body>  
<div id="container"></div> 
<script type="text/javascript"> 
var map = new BMap.Map("container");          // ������ͼʵ��  
var point = new BMap.Point(116.404, 39.915);  // ����������  
map.centerAndZoom(point, 15);                 // ��ʼ����ͼ���������ĵ�����͵�ͼ����  
</script>  
</body>  
</html>