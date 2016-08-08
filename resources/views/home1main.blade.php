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



	function addComment(pid) 
{


	 var comment=$('#'+pid).val().trim();
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
				$('#'+pid+'commentbox').append('<div class="row" style="padding-top: 5px;font-size: 12px;margin:auto"><img src="{{Auth::user()->displaypic}}" class="img-circle profile-pic" width="12" height="12" />	<b>{{Auth::user()->username}}</b> '+comment+'</div>');
				$("p[id="+pid+"comments]").html(++count);
				//window.location.replace('home'));
			}
			$('#'+pid).val('');
			});
}





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