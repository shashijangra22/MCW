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
							<button name="post" id="post" type="submit" disabled="true" class="pull-right btn btn-sm btn-info">Post <i id="PostLoader" class="hidden fa fa-refresh fa-spin fa-fw"></i>
							</button>	
						</div>
					</div>
				</div>
			</div>
		</form>

	</div>
	{{--*/$postflag=0/*--}}
	{{--*/$postid=-1/*--}}
	@foreach($posts as $post)
	@if($postflag==0)
	{{--*/$postid=$post->id/*--}}
	{{--*/$postflag=1/*--}}
	@endif
	
	<div class="row feed">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body" >
					<div class="row" >
						<div class="col-xs-2">
							<img src="{{$post->user->displaypic}}" class="img-circle profile-pic" width="35" height="35" />	
						</div>
						<div class="col-xs-7 col-xs-offset-1">
							<div class="row">
							<!-- <a href="#" onclick="user_profile(event);"> -->
							{{ $post->user->username }}<!-- </a> --></div>
							<div class="row" style="font-size:10px">
							{{$post->created_at}}</div>
						</div>
						<div class="col-xs-2 pull-right">
							@if ($post->user_id==$user->id)
								<button class=" btn btn-sm btn-danger pull-right delButton" type="button" id="delButton" value="{{$post->id}}" >
									<span class="glyphicon glyphicon-trash"/>
								</button>
							@endif
						</div>
					</div>
					<hr>
					<div class="row" style="margin:auto">
						{!!nl2br($post->data)!!}
					</div>
					<hr>
	               	@if($post->path!=NULL)  
						<div class="row" style="overflow:hidden; margin:auto">
							<a class="pop" onclick="pop('{{$post->path}}');" href="#">
								<img id="imagesource" class="thumbnail img-responsive" src="{{$post->path}}"/>
							</a>
						</div>
					@endif
					<div class="row" style="font-size: 13px;margin:auto">
						<span style="color: white;background:#0084FF" class="badge"><b><p id="{{$post->id}}likes" style="display:inline;">{{$post->likes()->count()}}</p></b> Likes</span>
						<span style="color: white;background:#0084FF" class="badge"><b><p id="{{$post->id}}comments" style="display:inline;">{{$post->comments()->count()}}</p></b> Comments</span>
					</div>
					<div id="{{$post->id}}commentbox">
					@foreach($comments as $comment)
						@if ($comment->post_id==$post->id)

						<div class="row" style="padding-top: 5px;font-size: 12px;margin:auto">
							<img src="{{$comment->user->displaypic}}" class="img-circle profile-pic" width="12" height="12" />	<b>{{$comment->user->username}}</b> {{$comment->data}}
						</div>
						@endif
					@endforeach
					</div>
					<br>
					<div class="row" style="margin:auto">
					<div class="row">
						<div class="col-xs-1" style="padding-top:3px">
							@if($likes->contains('post_id',$post->id))
							<a class="likebutton" href="#" value="{{$post->id}}"><i class="heart fa fa-heart" style="font-size:22px"></i></a>	
							@else
							<a class="likebutton" href="#" value="{{$post->id}}"><i class="heart fa fa-heart-o" style="font-size:22px"></i></a>
							@endif
						</div>
							<div class="col-xs-9 col-md-10">
								<input onkeydown = "if (event.keyCode == 13) addComment('{{$post->id}}');" id="{{$post->id}}" type="text" class="form-control input-sm" placeholder="write a comment :)">
							</div>
							<div class="col-xs-1 pull-right">
								<button onclick="addComment('{{$post->id}}');" class="btn btn-sm btn-danger pull-right"><span class="glyphicon glyphicon-comment"></span></button>
							</div>
					</div>
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

		
		<div class="panel panel-default" id="chat-panel" style="bottom: 0; right:0;position:fixed;  margin:-1px !important; border-top:none;">
			<a data-toggle="collapse" href="#collapse1"><div style="background: #0084FF; color:white;" class="panel-heading text-center" id="big-chat" ><b>Chatbox</b><span class="badge">0</span></div></a>
			<!-- <a data-toggle="collapse" href="#collapse1" id="small-chat" ><button class="btn btn-sm btn-info pull-right"><span class="glyphicon glyphicon-comment"></span></button></a> -->
			<div id="collapse1" class="panel-collapse collapse">
				<div class="scrollbar" id="scroll-chat">
					<div class="panel-body scrollbox-content" id="chatbox" >
						{{--*/$msgid=-1/*--}}
						@foreach($chats as $chat)
							@if((Auth::user()->id)==($chat->user->id))
								<div class="row" style="padding:4px">
									<div class="pull-right rightmsg">{{$chat->message}}</div>
								</div>
							@else
								<div class="row" style="padding:4px">
									<div class="leftmsg pull-left">{{$chat->message}}</div>
								</div>
							@endif	
							{{--*/$msgid=$chat->id/*--}}
						@endforeach
					</div>
				</div>
				<div class="panel-footer">
					<input onkeydown = "if (event.keyCode == 13) sendMessage();" class="form-control" type="text" name="text" id="message" placeholder="Enter your message :)">
				</div>
			</div>
		</div>		
	</div>

@endsection

@section('jscript')
var x={{$msgid}};
var postid={{$postid}};
var xhr;

$('#image').change(function() {
  $("#check").removeClass("hidden");
});
$('#mytext').change(function(){
	$('#post').disabled='false';
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

			$("#PostLoader").removeClass("hidden");
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
		pullMsg();
		count=0;
		$('#scroll-chat')[0].scrollTop = $('#scroll-chat')[0].scrollHeight;

	});
	function pullMsg()
	{
		if($.active==0)
		{
		
	$.ajax({
			type:"POST",
			url:"pullMsg",
			data:{mid:x},

			

		})
		.done(function(result){
			if(result!=0)
			{
			
			
			for(var key in result)
			{
				$('#chatbox').append('<div class="row" style="padding:4px;"><div class="leftmsg pull-left">'+result[key].message+'</div></div>');
				x=result[key].id;
				count=count+1;





			}
	
				$('#scroll-chat')[0].scrollTop = $('#scroll-chat')[0].scrollHeight;
			}
			if($( "#collapse1" ).is( ":visible" ))
			{
				
				$("#big-chat").children('.badge').html('0');
				count=0;
				
			}
			else
			{
				$("#big-chat").children('.badge').html(count);	
			}
			
			

		
		});
		}
		setTimeout(pullMsg,3000);
		
		

		}

	function sendMessage()
	{
		
		var message=$("#message").val().trim();
		if(message.length>0)
		{
		$.ajax({
			type:"POST",
			data:{text:message},
			url:"sendmessage"
		})
		.done(function(result){
			$('#chatbox').append('<div class="row" style="padding:4px"><div class="pull-right rightmsg">'+message+'</div></div>');
			$('#scroll-chat')[0].scrollTop = $('#scroll-chat')[0].scrollHeight;
			$("#message").val('');	

		}); 		
	}
	}



	$(document).ready(function(){
	
		newPost();
	});
		

	function newPost(){
		if($.active==0)
		{
			$.ajax({
				type:'POST',
				url:'newpost',
				data:{pid:{{$postid}}},
			})
			.done(function(result){
				$("#home-span").children('.badge').html(result);
			
			});
			}
			setTimeout(newPost,60000);

			}
	$(document).ajaxError(function(){
		window.location.replace('home');
	});
		
	function updateScroll(){
    var element = document.getElementById("#chatbox");
    element.scrollTop = element.scrollHeight;
}

	

				
@endsection