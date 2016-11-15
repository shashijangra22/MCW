@extends('home1main')

@section('content')
<div class="row">
<div class="col m12 s12 l6 offset-l1">
	
	<?php $totalQ = count($questions); ?>
		@if($totalQ>0 && $user->level<$totalQ)
		<div class="card z-depth-4">
				<div class="card-content pink white-text" style="padding-top: 10px;padding-bottom: 10px">
					<span class="card-title">Welcome Back :)</span>
					<span class="card-title right">Level {{$user->level}}</span>
				</div>
				<div class="card-image">
	              <img class="materialboxed" src="{{$questions[$user->level]->path}}">
	            </div>
				<div class="card-content">
					<p style="text-align: center;"><strong>Hint: {{$questions[$user->level]->data}}</strong></p>
				</div>
				<div class="card-action" style="padding-top: 0px;padding-bottom: 0px">
					<div class="row">
		              <div class="col s10 m11">
		                <input onkeydown="if (event.keyCode == 13) checkAnswer();" placeholder="Enter your answer here..." type="text" id="myAnswer" name="myAnswer">
		              </div>
		              <div class="col s2 m1" style="padding-top: 12px">
		                <button onclick="checkAnswer();" class="btn-floating right"><i class="material-icons">send</i></button>
		              </div>
		            </div>
				</div>
			</div>
			@else
				<div class="card z-depth-4">
				<div class="card-content pink white-text" style="padding-top: 10px;padding-bottom: 10px">
					<span class="card-title">Oops ! Check back soon :P</span>
				</div>
			</div>
			@endif
			
			@if ($user->username=='shashijangra')
			<div class="card z-depth-4">
			<div class="card-content pink white-text" style="padding-top: 10px;padding-bottom: 10px">
					<span class="card-title">Add a Question!</span>
				</div>
				<div class="card-action">
					<form id="post-form" role="form" action="#" enctype="multipart/form-data">
	              	{{csrf_field()}}
	                  <div class="row" style="margin: auto;">
	                  	<input placeholder="Question goes here..." type="text" id="qBox" name="qBox">
	                  	<input placeholder="Answer goes here..." type="text" id="answerBox" name="answerBox">
	                  </div>
	                  <div class="fileUpload btn pink accent-4">Upload
	                      <input type="file" accept="image/*" class="upload" name="image" id="image" />
	                  </div>
	               		<button name="post" id="post" class="right btn pink accent-4"><i class="material-icons">send</i></button>
           			</form>
				</div>
			</div>

			@endif		
	</div>
	<div class="col l4 m4 s12">
		<div class="card z-depth-4">
				<div class="card-content pink white-text" style="padding-top: 10px;padding-bottom: 10px">
					<span class="card-title">Leaderboard</span>
				<table>
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
			<div class="card z-depth-4">
				<div class="card-content pink white-text" style="padding-top: 10px;padding-bottom: 10px">
					<span class="card-title">Rules</span>
				<table>
			    <tbody>
			      <tr>
			      	<td>1. All answers should be strictly in small letters and without spaces.</td>
			      </tr>
			      <tr>
			      	<td>2. No user should leak answers in the chat or post. Though you can give hints ;)</td>
			      	<tr>
			      	<td>3. There will be {{$totalQ}} no. of questions on total.</td>
			      </tr>
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
	$(".homeBtn").removeClass("active");
	$(".chakravyuhBtn").addClass('active');
});


$('#post').on("click",function(e){
			e.preventDefault();
			var formData = new FormData($("#post-form")[0]);
		$.ajax({
			url: "addQuestion",
			type:"POST",
			 
			data:formData,
			contentType: false,
			processData: false
			
			})
		.done(function(result){
		$("#post-form")[0].reset();
			if(result=='0')
			{
				alert('q added')
			}
			else
			{
				alert(result);
			}
			});
		
			
		});


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


@endsection