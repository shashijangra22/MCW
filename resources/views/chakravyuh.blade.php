@extends('home1main')

@section('content')
<div class="row">
<div class="col-md-6" id="main-feed">
		<div class="panel panel-default">
				<div class="panel-body" >
					<div class="row text-center alert alert-danger" style="margin:auto">
						<strong style="font-size: 16px">Welcome Back :) You are on Level : {{$user->level}}</strong>
					</div>
					<br>
					<div class="row" style="margin:auto; overflow:hidden;">
						<img src="img/cllg.jpg" class="thumbnail" style="width: 100%">
					</div>
					<div class="row text-center alert alert-success" style="margin:auto">
						<strong>{{$questions[$user->level]->data}}</strong>
					</div>
					<br>
					<div class="row">
						<div class="col-md-10 col-xs-9">
							<input onkeydown="if (event.keyCode == 13) checkAnswer();" placeholder="Enter your answer here..." type="text" id="myAnswer" name="myAnswer" class="form-control">
						</div>
						<div class="col-md-1 col-xs-2 col-xs-offset-1">
							<button onclick="checkAnswer();" class="btn btn-danger pull-right">Submit</button>
						</div>
					</div>
				</div>
			</div>
			
			@if ($user->username=='shashijangra')
					<div class="panel panel-default" id="panel">
						<div class="panel-body">
							<div class="row text-center alert alert-danger" style="margin:auto; font-size: 16px">
								<strong>Add a new Question!</strong>
							</div>
							<br>
							<div class="row" style="margin: auto;">
								<input placeholder="Question goes here..." type="text" id="qBox" name="qBox" class="form-control">
							</div>
							<div class="row" style="padding-top: 5px">
								<div class="col-md-10 col-xs-9">
									<input onkeydown = "if (event.keyCode == 13) addQuestion();" placeholder="Answer goes here..." type="text" id="answerBox" name="answerBox" class="form-control">
								</div>
								<div class="col-md-1 col-xs-2 col-xs-offset-1">
									<button onclick="addQuestion();" id="addQButton" name="addQButton" class="btn btn-danger pull-right">Submit</button>
								</div>
							</div>
						</div>
					</div>
			@endif

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
<div class="col-md-3">
	<div class="panel panel-default">
		<div class="panel-body" >
			<div class="row text-center alert alert-danger" style="margin:auto">
				<strong style="font-size: 16px">Leaderboard</strong>
			</div>
			<br>
			<table class="table table-striped">
			    <thead>
			      <tr>
			        <th>Username</th>
			        <th>Level</th>
			      </tr>
			    </thead>
			    <tbody>
			      @foreach($players as $player)
			      	<tr>
			        	<td>{{$player->username}}</td>
			        	<td>{{$player->level}}</td>
			      	</tr>
			      @endforeach
			    </tbody>
			  </table>
			</div>
		</div>
	</div>
	<div class="col-md-3">
	<div class="panel panel-default">
		<div class="panel-body" >
			<div class="row text-center alert alert-danger" style="margin:auto">
				<strong style="font-size: 16px">Rules</strong>
			</div>
			<br>
			<table class="table table-striped">
			    <tbody>
			      <tr>
			      	<td>1. All answers should be strictly in small letters and without spaces.</td>
			      </tr>
			      <tr>
			      	<td>2. No user should leak answers in the chat or post. Though you can give hints ;)</td>
			      </tr>
			     </tbody>
			  </table>
			</div>
		</div>
	</div>
</div>
@endsection

@section('jscript')

$(document).ready(function()
{
	$("#home").removeClass("active");
	$("#chakravyuh").addClass("active");
});

function addQuestion()
{
	var question=$('#qBox').val().trim();
	var answer=$('#answerBox').val().trim();
	if(answer.length>0)
	{
		$.ajax({
			type:"POST",
			data:{question:question,answer:answer},
			url:"addQuestion"
		}).done(function(result){
			if(result==0)
			{
				$('#qBox').val('');
				$('#answerBox').val('');
				alert('Question added !');
			}
		});
	}
}

function checkAnswer()
{
	var answer=$('#myAnswer').val().trim();
	if(answer.length>0)
	{
		$.ajax({
			type:"POST",
			data:{answer:answer},
			url:"checkAnswer"
		}).done(function(result){
			$('#myAnswer').val('');
			if (result==0)
			{
				window.location.replace('chakravyuh');
			}
			else
			{
				alert('Wrong Answer');
			}
		});
	}
}


var x={{$msgid}};
	
	
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