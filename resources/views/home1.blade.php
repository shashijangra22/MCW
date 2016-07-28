@extends('home1main')

@section('content')
<div class="row">
<div class="col-md-6 col-md-offset-3">
	<div>
		<form id="post-form" role="form" action="#" enctype="multipart/form-data">
		{{ csrf_field() }}
			<div class="panel panel-default" id="panel">
				<div class="panel-body">
					<textarea rows=3 class="form-control" name="mytext" id="mytext" placeholder="What are you up to?"></textarea>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-xs-4">
							<div class="fileUpload btn btn-sm btn-primary">Upload
		    					<span class="glyphicon glyphicon-camera"></span>
		    					<input type="file" accept="image/*" class="upload" name="image" id="image" />
							</div>
							<i id="check" class="fa fa-check hidden" style="font-size:16px"></i>
						</div>
						<div id="test" class="col-xs-6">
								
						</div>
						<div class="col-xs-2">
							<button name="post" id="post" type="submit" disabled="true" class="pull-right btn btn-sm btn-info">Post</button>				
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

	@foreach($posts as $post)
	<div class="row feed">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-2">
							<img src="{{$post->user->displaypic}}" class="img-circle profile-pic" width="35" height="35" />	
						</div>
						<div class="col-xs-3 col-xs-offset-1">
							<div class="row">
							<a href="#" onclick="user_profile(event);">
							{{ $post->user->username }}</a></div>
							<div class="row" style="font-size:10px">
							{{$post->created_at}}</div>
						</div>
						<div class="col-xs-2 col-xs-offset-4">
							@if ($post->user_id==$user->id)
								<button class=" btn btn-sm btn-danger pull-right delButton" type="button" id="delButton" value="{{$post->id}}" >
									<span class="glyphicon glyphicon-trash"/>
								</button>
							@endif
						</div>
					</div>	
				</div>
				<div class="panel-body">
					<div class="row" style="margin:auto">
						{{$post->data}}
					</div>
	               	@if($post->path!=NULL)
	               		<br>  
						<div class="row" style="overflow:hidden; margin:auto">
							<a class="pop" onclick="pop('{{$post->path}}');" href="#">
								<img id="imagesource" class="thumbnail img-responsive" src="{{$post->path}}"/>
							</a>
						</div>
					@endif
				</div>
				<div class="panel-footer">
					<div class="row" id="mydiv" style="margin:auto">
					{{--*/$flag=0/*--}}
					@foreach ($likes as $like)
						@if ($post->id==$like->post_id)
							{{--*/$flag=$like->id/*--}}
							@break
						@endif							
					@endforeach
						@if ($flag==0)
							<a onclick="setlike('{{$user->id}}','{{$post->id}}','0');" href="#"><i id="likebutton" class="fa fa-heart-o"></i></a>
						@else
							<a onclick="setlike('{{$user->id}}','{{$post->id}}','{{$flag}}');" href="#"><i id="unlikebutton" class="fa fa-heart"></i></a>
						@endif
						{{$post->likes()->count()}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endforeach
		<div class="row text-center" id='posts'>
			{!!str_replace('/?', '?', $posts->render());!!}
		</div>
</div>

<div class="col-md-3">
	<div class="panel panel-default" style="width:80%; height:200px; overflow-y: scroll;">
		<div class="panel-body" id="chatbox">
		@foreach($chats as $chat)
		@if((Auth::user()->id)==($chat->user->id))
		<br><div style="text-align:right">
		@else
		<br><div class="row">
		@endif
		{{$chat->message}}
		</div><br>
				
		{{--*/$msgid=$chat->id/*--}}

		@endforeach

		</div>
		
	</div>
	<input type="text" name="text" id="message">
</div>
</div>
@endsection

@section('jscript')
var x={{$msgid}};

$('#image').change(function() {
  $("#check").removeClass("hidden");
});
$('#mytext').change(function(){
	$('#post').disabled='false';
});

	$.ajaxSetup({
		headers: 
		{                  
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
		});

	$(document).ready(function(e){
		
		var validator=$("#post-form").bootstrapValidator({
			
			fields: {
				image : {
					validators : {
						file : {
							type :'image/jpeg,image/png,image/gif',
							message:"only image file can be uploaded"
						}
					}
				},
				mytext : {
					validators : {
						notEmpty : {
							message:"please enter something"
						}
					}
				}
			}
			
			
		})		
		.on("success.form.bv",function(e){
			e.preventDefault();

			$("#loadingdiv").removeClass("hidden");
			var formData = new FormData($("#post-form")[0]);
		$.ajax({
			url: "savedata",
			type:"POST",
			 
			data:formData,
			contentType: false,
			processData: false
			
			})
		.done(function(result){
		$("#post-form")[0].reset();
			if(result=='0')
			{
				window.location.replace('home');
			}
			else
			{
				$("#test").html(result)
			}
			$("#loadingdiv").addClass("hidden");
			});
		
			
		});
		
	
	});
	$(".profile-pic").on("error",function(){

		$(this).attr("src","profile_pic/default.png")
	});

	function user_profile(event)
	{
		event.preventDefault();
		var user=$(event.target).text();
		alert(user);
		var url='userprofile/'+user;
		window.location.replace(url);
	}
	
	function pop(a)
	{
		$('#imagepreview').attr('src',a);
   		$('#imagemodal').modal('show'); 
	}



	$(document).ready(function(){

		
		$(document).keyup(function(e){
			if(e.keyCode==13)
			{
				sendMessage();
			}
		});
	});
	
	$(document).ready(function(){
		pullMsg();

	});

	function pullMsg()
	{

		ajaxMsg();
		setTimeout(pullMsg,3000);

	}
	function ajaxMsg()
	{
		
		$.ajax({
			type:"POST",
			url:"pullMsg/"+x,
			

		})
		.done(function(result){
			var user={{Auth::user()->id}};
			
			for(var key in result)
			{
				if(result[key].user_id!=user)
				{
				$('#chatbox').append('<br><div style="text-align:left;">'+result[key].message+'</div><br>');

				}
				x=result[key].id;



			}
		
		});
		}

	function sendMessage()
	{
		var message=$("#message").val();
		if(message.length>0)
		{
		$.ajax({
			type:"POST",
			data:{text:message},
			url:"sendmessage"
		})
		.done(function(result){
			$('#chatbox').append('<br><div style="text-align:right;">'+message+'</div><br>');
			$("#message").val('');

		}); 		
	}
	}

				
@endsection