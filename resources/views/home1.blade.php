@extends('home1main')

@section('content')
<div class="row">
<div class="col-md-6 col-md-offset-1" id="main-feed">
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
	{{--*/$postflag=0/*--}}
	{{--*/$postid=-1/*--}}
	{{--*/$post_id=-1/*--}}
	@foreach($posts as $post)

	@if($postflag==0)
	{{--*/$postid=$post->id/*--}}
	{{--*/$postflag=1/*--}}
	@endif
	{{--*/$post_id=$post->id/*--}}

	
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
					<a id="{{$post->id}}show" class="show_comments" data-flag="0" data-id="{{$post->id}}" href="#/">show comments</a>
					<div id="{{$post->id}}commentbox">
						
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
								<input  data-id="{{$post->id}}" id="{{$post->id}}commentinput" type="text" class="form-control input-sm comment_input" placeholder="write a comment :)">
							</div>
							<div class="col-xs-1 pull-right">
								<button data-id="{{$post->id}}" class="comment_button btn btn-sm btn-danger pull-right"><span class="glyphicon glyphicon-comment"></span></button>
							</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endforeach
	<div id="loadmore"></div>

<div id="button" class="text-center">
	<button class="btn btn-info" id="loadmore-button"> Loadmore</button>
</div>


		<div class="panel panel-default" id="chat-panel" style="bottom: 0; right:0;position:fixed;  margin:-1px !important; border-top:none; max-height:60%s; ">
			<a data-toggle="collapse" id="big-chat" href="#collapse1"><div style="background: #0084FF; color:white;" class="panel-heading text-center"  ><b>Chatbox</b><span class="badge">0</span></div></a>
			
			<div id="collapse1" class="panel-collapse collapse">
				<div class="scrollbar" id="scroll-chat">
					<div class="panel-body scrollbox-content" id="chatbox" >
						{{--*/$msgid=-1/*--}}
						@foreach($chats as $chat)
							@if((Auth::user()->id)==($chat->user->id))
								<div class="row" style="padding:4px">
									<div class="pull-right rightmsg">{{$chat->message}}<p class="chattime">{{date("h:i",strtotime($chat->created_at))}}</p></div>
								</div>
							@else
								<div class="row" style="padding:4px">
									<div class="leftmsg pull-left"><p class="chatinfo">{{$chat->user->username}} | {{date("h:i",strtotime($chat->created_at))}}</p>{{$chat->message}}</div>
								</div>
							@endif	
							{{--*/$msgid=$chat->id/*--}}
						@endforeach
					</div>
				</div>
				<div class="panel-footer" style="background:white;2">
				<div class="row">
					<div class="col-xs-10">
						<input onkeydown = "if (event.keyCode == 13) sendMessage();" class="form-control" type="text" name="text" id="message" placeholder="Enter your message :)">
					</div>
					<div class="col-xs-2">
						<button class="btn btn-danger pull-right" onclick="sendMessage();"><i class="fa fa-send"></i></button>
					</div>

				</div>
					
				</div>
			</div>
		</div>	
	</div>

<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-body" >
			<div class="row text-center alert alert-danger" style="margin:auto">
				<strong style="font-size: 16px">Upcoming Events</strong>
			</div>
			<br>
			<table class="table table-striped">
			    <thead>
			      <tr>
			        <th>Event Name</th>
			        <th>Date</th>
			      </tr>
			    </thead>
			    <tbody>
		      	<tr>
		        	<td><a href="#">Songs Of India</a></td>
		        	<td>7 October</td>
		      	</tr>
		      	<tr>
		        	<td><a href="#">Dance With Props Competition</a></td>
		        	<td>21 October</td>
		      	</tr>
		      	<tr>
		        	<td><a href="#">Diwali Night</a></td>
		        	<td>30 October</td>
		      	</tr>
		      	<tr>
		        	<td><a href="#">Electronics Workshop</a></td>
		        	<td>5 November</td>
		      	</tr>
		      	<tr>
		        	<td><a href="#">Ice Cream Day :P</a></td>
		        	<td>10 November</td>
		      	</tr>
			    </tbody>
			  </table>
			</div>
		</div>
	</div>

</div>
@endsection

@section('jscript')
var x={{$msgid}};
var postid={{$postid}};
var post_id={{$post_id}};

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
			dataType:'json'

			

		})
		.done(function(result){
			if(result!=0)
			{
			
			
			for(var key in result)
			{
				var today= new Date(result[key].created_at);
				var hour=today.getHours();
				var minutes=today.getMinutes();


				$('#chatbox').append('<div class="row" style="padding:4px;"><div class="leftmsg pull-left"><p class="chatinfo">'+result[key].username+' | '+hour+':'+minutes+'</p>'+result[key].message+'</div></div>');
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

		function checktime(i)
		{

			if(i < 10)
			{
				i='0'+i;

			}
			return i;
		}
	function sendMessage()
	{
		var today= new Date();
		var hour=checktime(today.getHours());
		var minutes=checktime(today.getMinutes());
		
		var message=$("#message").val().trim();
		if(message.length>0)
		{
		$.ajax({
			type:"POST",
			data:{text:message},
			url:"sendmessage"
		})
		.done(function(result){
			$('#chatbox').append('<div class="row" style="padding:4px"><div class="pull-right rightmsg">'+message+'<p class="chattime">'+hour+':'+minutes+'</p></div></div>');
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
				if(result>0)
				{
					myFunction(result);
				}
			
			});
			}
			setTimeout(newPost,60000);

			}
	
		

$(document).ready(function(){
$(".scrollbar").css('height',$(window).height()*0.5);	
});

$("#loadmore-button").on("click",function(e){
	e.preventDefault();
	$.ajax({
		type:'POST',
		url:'loadmore',
		data:{pid:post_id},
		dataType:'json'
		
	})
	.done(function(result){
		for(var key in result)
		{
			
			var post=$("#prototype").clone(true);
			post.css('display','block');
			post.attr('id',result[key].id);
			var temp=post.find('.protodisplaypic');
			temp.attr('src',result[key].displaypic);
			temp=post.find('.protousername');
			temp.html(result[key].username);
			temp=post.find('.prototimestamp');
			temp.html(result[key].created_at);
			if({{Auth::id()}}==result[key].user_id)
			{
				temp=post.find('.protodelete');

				var button=$("#protodelbutton").clone(true);
				button.css('display','block');
				button.attr('id',"");
				button.attr('value',result[key].id);
				temp.append(button);
			}
			temp=post.find('.protodata');
			temp.html(result[key].data);

			if(result[key].path!=null)
			{
				temp=post.find('.protoimage');
				temp.css('display','block');
				temp.children('img').attr('src',result[key].path);
			}

			temp=post.find('#protolikes');
			temp.attr('id',result[key].id+'likes');
			temp.html(result[key].likes)

			temp=post.find('#protocomments');
			temp.attr('id',result[key].id+'comments');
			temp.html(result[key].comments)
			temp=post.find('#protoshow');
			temp.attr('id',result[key].id+'show');
			temp.attr('data-id',result[key].id);
			temp=post.find('#protocommentbox');
			temp.attr('id',result[key].id+'commentbox');
			temp=post.find('#protocommentinput');
			temp.attr('id',result[key].id+'commentinput');
			temp.attr('data-id',result[key].id);
			temp=post.find('.comment_button');
			temp.attr('data-id',result[key].id);
			temp=post.find('.likebutton');
			temp.attr('value',result[key].id);
			if(result[key].like_id!=null)
			temp.children('i').addClass('fa fa-heart');
			else
			temp.children('i').addClass('fa fa-heart-o');





			
			$("#loadmore").append(post);
			post_id=result[key].id;


	
		}

	});

	
});

$(".show_comments").on("click",function(e){
	e.preventDefault();
	var el=$(this);
var flag=el.data("flag");
var pid=el.data("id");

if(flag==0)
{
$.ajax({
	type:'POST',
	url:'showcomments',
	data:{pid:pid}
})
.done(function(result){
		$('#'+pid+'commentbox').empty();
		if(result.length==0)
		{
			el.css("display",'none');
			$('#'+pid+'commentbox').append('<div class="row text-center">no comments to show</div>');		
		}
		else
		{
	for(var key in result)
	{
		$('#'+pid+'commentbox').append('<div class="row" style="padding-top: 5px;font-size: 12px;margin:auto"><img src="'+result[key].displaypic+'" class="img-circle profile-pic" width="12" height="12" />	<b>'+result[key].username+'</b> '+result[key].data+'</div>');
	}
	
	el.data('flag',1);
	el.html("hide comments");
	}


});
}
else
{
$('#'+pid+'commentbox').empty();
el.data('flag',0);
el.html("show comments");


}

});




	

				
@endsection