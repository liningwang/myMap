<!DOCTYPE html>
<html>
<head>

</head> 
<script type='text/javascript' src='jquery.js'></script>
<script type="text/javascript"> 
$(document).ready(function()
{
	alert("wang");
	var headers ={};
	var action = "http://127.0.0.1:8003/comment/commentList";
	alert(action);
	var data = "cameraId=17";
	$.ajax({
		'headers' : headers,
		'type' : "get",
		'url' : action,
		'data': data,
		'success' : function(msg){
			alert(msg);
		}	
	});
});
</script>

</html>