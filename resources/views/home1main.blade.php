<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Your description here">
    <meta name="author" content="Your Name">

    <title>My College Wall</title>
    <link rel="shortcut icon" href="img/favicon.ico" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <link href="css/basic-template.css" rel="stylesheet" />

	<link rel="stylesheet" type="text/css" href="css/scroll.css">
	<link rel="stylesheet" type="text/css" href="css/fileButton.css">	

	<!-- For more icons -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- BootstrapValidator CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css" rel="stylesheet"/>
</head>
<body style="background:url('img/bg.png') no-repeat center fixed; background-size:cover ; ">
	<nav class="navbar navbar-default navbar-fixed-top">
		<div  class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-container">
					<span class="sr-only">Show and Hide the Navigation </span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{asset('home')}}">My College Wall
				</a>
			</div>
			<div class="collapse navbar-collapse" id="navbar-container">
				<ul class="nav navbar-nav">
					<li id="home" class="active"><a href="{{asset('home')}}"><i class="fa fa-home"></i> Home<p id="home-span" style="display:inline;"><span  class="badge"></span></p></a></li>
					<li id="confessions"><a href="#"><i class="fa fa-heart"></i> Confessions</a></li>
					<li id="chatroom"><a href="#"><i class="fa fa-chat"></i> Chatroom</a></li>
					<li id="chakravyuh"><a href="#"><i class="fa fa-puzzle"></i> Chakravyuh</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expands="false">{{$user->username}}
						<img src="{{$user->displaypic}}" class="img-circle" width="18" height="18">
						</a>
						<ul class="dropdown-menu" role=menu>
							<!-- <li id="profile"><a href="{{asset('profile')}}"><i class="fa fa-user"></i> My Profile</a></li> -->
							<li><a href="{{asset('logout')}}"><i class="fa fa-btn fa-sign-out"> Logout</i></a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	
<!-- Modal for image preview-->

<div class="modal modal fade modal-fullscreen modal-transparent" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <img src="" id="imagepreview" style="width: 100%; height: 100%;" />
      </div>
    </div>
  </div>
</div>


<!-- prototype -->

<div class="row feed"  id="prototype" style="display:none;">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body" >
					<div class="row" >
						<div  class="col-xs-2 ">
							<img src="" class="img-circle profile-pic protodisplaypic" width="35" height="35" />	
						</div>
						<div class="col-xs-7 col-xs-offset-1">
							<div class="row protousername">
							<!-- <a href="#" onclick="user_profile(event);"> -->
							<!-- </a> --></div>
							<div class="row prototimestamp"  style="font-size:10px">
							</div>
						</div>
						<div class="col-xs-2 pull-right protodelete" >
						<!-- append del button if required -->
							
						</div>
					</div>
					<hr>
					<div class="row protodata" style="margin:auto">
					</div>
					<hr>  
						<div class="row protoimage" style="overflow:hidden; margin:auto; display:none; ">
							<!-- imagedata -->
							<!-- <a class="pop" onclick="pop('');" href="#"> -->
								<img class="thumbnail img-responsive " src=""/>
							<!-- </a> -->
						</div>
					<div class="row" style="font-size: 13px;margin:auto">
						<span style="color: white;background:#0084FF" class="badge protolikecount"><b><p id="protolikes" style="display:inline;"><!-- likes count --></p></b> Likes</span>
						<span style="color: white;background:#0084FF" class="badge protocommentcount"><b><p id="protocomments" style="display:inline;"><!-- comments count --></p></b> Comments</span>
					</div>
					<a id="protoshow" class="show_comments" data-flag="0" data-id="" href="#/">show comments</a>
					<div id="protocommentbox">
						
					</div>
					<br>
					<div class="row" style="margin:auto">
					<div class="row">
						<div class="col-xs-1 " style="padding-top:3px">	
							
							<a class="likebutton" href="#" value=""><i class="heart" style="font-size:22px"></i></a>
						</div>
							<div class="col-xs-9 col-md-10">
								<input  data-id="" id="protocommentinput" type="text" class="form-control input-sm comment_input" placeholder="write a comment :)">
							</div>
							<div class="col-xs-1 pull-right">
								<button  data-id="" class="comment_button btn btn-sm btn-danger pull-right"><span class="glyphicon glyphicon-comment"></span></button>
							</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<button class="btn btn-sm btn-danger pull-right delButton" type="button" id="protodelbutton" value="" style="display:none;">
									<span class="glyphicon glyphicon-trash"/>
								</button>




<!-- Ajax Loader -->
<div id="loadingdiv" class="hidden" style="margin:auto; padding: 0px; display: block; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.6;">
<p style="position: absolute; top: 50%; left: 50%;">
	<img src="img/ajax-loader.gif"/>
</p>
</div>

	<div class="container" style=" margin-top:70px">
		@yield('content')
	</div>
</body>

<!-- jQuery and Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-rc1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js" type="text/javascript"></script>
	
<!-- BootstrapValidator -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js" type="text/javascript"></script>

<script type="text/javascript">

$.ajaxSetup({
		headers: 
		{                  
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
		});


@yield('jscript')

$(".likebutton").on("click",function(event)
{
	event.preventDefault();

	 var el=$(this);
	 el.css("pointer-events","none");
	 var pid=$(this).attr('value');
	 var count=$("p[id="+pid+"likes]").html();

  		 $.ajax({
			url: "likepost",
			type:"POST",
			data:{post_id:pid}
			})
		.done(function(result){

			 if(result=='like')
			 {
				$("p[id="+pid+"likes]").html(++count);
				el.children("i").removeClass('fa fa-heart-o');
				el.children('i').addClass('fa fa-heart');

			}
			else if(result=='unlike')
			{
				$("p[id="+pid+"likes]").html(--count);
				el.children("i").removeClass('fa fa-heart');
				el.children('i').addClass('fa fa-heart-o');

			}
			el.css("pointer-events","auto");
			});
});



	$(".comment_button").on("click",function(e){
		e.preventDefault();
		var el=$(this);
		var pid=el.data('id');
	 var comment=$('#'+pid+'commentinput').val().trim();
	  if (comment.length<=0) { return false;}
	  var count=$("p[id="+pid+"comments]").html();
		
	  $.ajax({
	  		url: "savecomment",
	  		type:"POST",
	  		data:{post_id:pid,data:comment}
	  		})
	  	.done(function(result){
	  		if(result==0)
		 	{
		 		if($('#'+pid+'show:visible').length==0 || $('#'+pid+'commentbox').is(':empty'))
	 		{
		 			$("#"+pid+"show").data('flag',1);
					$("#"+pid+"show").html("hide comments");
					$('#'+pid+'commentbox').empty();
			}
				$('#'+pid+'commentbox').append('<div class="row" style="padding-top: 5px;font-size: 12px;margin:auto"><img src="{{Auth::user()->displaypic}}" class="img-circle profile-pic" width="12" height="12" />	<b>{{Auth::user()->username}}</b> '+comment+'</div>');
				$("p[id="+pid+"comments]").html(++count);
				
				$('#'+pid+'show').css("display","block");
				//$("#"+pid+"show").html("show previous comments");
				
				//window.location.replace('home'));
			}
			$('#'+pid).val('');
			});
});





$(".delButton").on("click",function(event)
{
	event.preventDefault();
	$("#loadingdiv").removeClass("hidden");
	var el=$(this);
	var id=$(this).val();
	
	$.ajax({
	url:'delete/'+id,
	type:'DELETE',
	data: { "_token": "{{ csrf_token() }}" }

				})
			.done(function(result){

			el.parents(".feed").fadeOut("slow",function(){
				this.remove();
			});

			$("#loadingdiv").addClass("hidden");


			});

				
	});
function pop(a)
	{
		$('#imagepreview').attr('src',a); // here asign the image to the modal when the user click the enlarge link
   $('#imagemodal').modal('show'); 
	}
</script>

</html>