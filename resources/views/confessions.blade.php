@extends('home1main')

@section('content')
<div class="row">
<div class="col-md-6 col-md-offset-3" id="main-feed">
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
	@foreach($posts as $post)
	<div class="row feed">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body" >
					<div class="row" >
						<div class="col-xs-2">

						</div>
						<div class="col-xs-7 col-xs-offset-1">
							<div class="row" style="font-size:10px">{{$post->created_at}}</div>
						</div>
					</div>
					<hr>
					<div class="row" style="margin:auto">
						{!!nl2br($post->data)!!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endforeach
		
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
	</div>

@endsection

@section('jscript')

$(document).ready(function()
{
	$("#home").removeClass("active");
	$("#confessions").addClass("active");
});
var x={{$msgid}};

$('#image').change(function() {
  $("#check").removeClass("hidden");
});
$('#mytext').change(function(){
	$('#post').disabled='false';
});

	
	$(document).ready(function(e){
		
		var validator=$("#post-form").bootstrapValidator({
			
			fields: {
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
			url: "savedataC",
			type:"POST",
			 
			data:formData,
			contentType: false,
			processData: false
			
			})
		.done(function(result){
		$("#post-form")[0].reset();
			if(result=='0')
			{
				window.location.replace('confessions');
			}
			else
			{
				$("#test").html(result);
			}
			});
		
			
		});
		
	
	});

	
	
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
$(".scrollbar").css('height',$(window).height()*0.5);	
});
				
@endsection