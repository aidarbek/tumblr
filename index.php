<?
$base_url="http://idarbek.com/tumblr/";
//$base_url="http://tumblr.api/";

?>
<html>
	<head>
				  	<!-- Put this script tag to the <head> of your page -->
		<script type="text/javascript" src="//vk.com/js/api/openapi.js?113"></script>

		<script type="text/javascript">
		  VK.init({apiId: API_ID, onlyWidgets: true});
		</script>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js">
		</script>
		<link rel="stylesheet" href="<?=$base_url?>css/bootstrap.css">
		
		<link rel="stylesheet" href="<?=$base_url?>css/style.css">
		<script type="text/javascript" src="<?=$base_url?>js/bootstrap.js">
		</script>
		<script>
			var tag = "swag";
			$(document).ready(function(){
				function init()
				{
					 $.ajax({
			         url:"<?=$base_url?>tumblr.php?tag="+tag,
			         success:function(data)
			         {
			         	data = eval("("+data+")");
			         	var timestamp = 0;
			         	if(data.response.length ==0 )
			         	{
			         		$("#posts").html("<h1>Sorry, no posts found!</h1>");
			         	}
			         	else
			         	{
				         	for(var i = 0; i < data.response.length;i++)
				         	{
				         		var post = data.response[i];
				         		timestamp = post.timestamp;
				         		if(post.type=="photo")
				         		{
				         			var thumb = post.photos[0].alt_sizes;
				         			photo_url = thumb[0].url;
				         			$("#posts").append("<div class='col-xs-12 col-md-12'><div class='text-center'><img src='"+photo_url+"'></div></div>");
				         			
				         		}
				         	}
				         	$("#posts").append("<div class='col-xs-12 col-md-12'><ul class='nav nav-pills nav-justified'><li><a last='"+timestamp+"' id='next_button'>Load more</a></li></ul>");
			         	}
			         }
					});
				}
				tag = "swag";
				init();

				$(document).on('click',"#next_button",function(){
					var last = $(this).attr("last");
					$(this).replaceWith("<div id='loading_label'>Loading...</div>");
					var button = $(this);
					$.ajax({
			         url:"<?=$base_url?>tumblr.php?last="+last+"&tag="+tag,
			         success:function(data)                                                                                     	
			         {
			         	$("#loading_label").remove();
			         	data = eval("("+data+")");
			         	var timestamp = 0;
			         	for(var i = 0; i < data.response.length;i++)
			         	{
			         		var post = data.response[i];
			         		timestamp = post.timestamp;
			         		if(post.type=="photo")
			         		{
			         			var thumb = post.photos[0].alt_sizes;
			         			photo_url = thumb[0].url;
			         			$("#posts").append("<div class='col-xs-12 col-md-12'><div><img src='"+photo_url+"'></div></div>");
			         			
			         		}
			         	}
			         	$("#posts").append("<div class='col-xs-12 col-md-12'><ul class='nav nav-pills nav-justified'><li><a last='"+timestamp+"' id='next_button'>Load more</a></li></ul>");
			         }
					});
				});
				$(document).on('click',"#tag", function(){
					tag = $(this).text();
					$("#tag").replaceWith("<input type='text' value='"+tag+"' id='input_field' >");
					$('#input_field').focus();
				});
				$(document).on("blur",'#input_field',function(){
					if($(this).val().length)
					{
						tag = $(this).val();
						$(this).replaceWith("<span id='tag'>"+tag+"</span>");
						$("#posts").html("");
						init();
					}
				});
				$('#tag').tooltip({placement: 'top'});
			});
		</script>
	</head>
	<body>
		<div class="container">
			<div class="col-md-12 col-xs-12">
				<h1>
					#<span id="tag" data-original-title="Click here for editing tag">swag</span>
				</h1>
			</div>
			 <!-- Generated markup by the plugin -->
		  <p>
		  	From <a href="http://tumblr.com">tumblr.com</a>
		  	<br>
		  	<small>Made with love by <a href="http://idarbek.com">idarbek</a></small>
			<!-- Put this div tag to the place, where the Like block will be -->
			<div id="vk_like"></div>
			<script type="text/javascript">
			VK.Widgets.Like("vk_like", {type: "mini"});
			</script>
		  </p>

			<div class="">
				<div id="posts">
				</div>
			</div>
		</div>
		
	</body>
</html>