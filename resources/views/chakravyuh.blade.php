@extends('home1main')

@section('content')
<div class="row" style="margin-bottom: 0px">
<div class="col m12 s12 l6 offset-l1">
	
	<?php $totalQ = count($questions); ?>
		@if($totalQ>0 && $user->level<$totalQ)
		<div class="card" style="margin-bottom: 0px">
				<div class="card-content blue white-text" style="padding-top: 0px;padding-bottom: 0px">
					<span class="card-title" style="font-size: 20px">Welcome Back :)</span>
					<span class="card-title right" style="font-size: 20px">Level {{$user->level}}</span>
				</div>
				<div class="card-image">
	              <img class="materialboxed" src="{{$questions[$user->level]->path}}">
	            </div>
				<div class="card-content" style="padding-top: 5px;padding-bottom: 5px">
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
				<div class="card">
				<div class="card-content blue white-text" style="padding-top: 0px;padding-bottom: 0px">
					<span class="card-title" style="font-size: 20px">Stay Tuned ;) We'll be adding more Questions soon</span>
				</div>
			</div>
			@endif
			
			@if ($user->username=='beerus')
			<div class="card">
			<div class="card-content blue white-text" style="padding-top: 0px;padding-bottom: 0px">
					<span class="card-title" style="font-size: 20px">Add a Question!</span>
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
		<div class="card">
				<div class="card-content blue white-text center-align" style="padding-top: 0px;padding-bottom: 0px">
					<span class="card-title" style="font-size: 20px;">Leaderboard</span>
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
				      <tr>
				        	<td>{{$user->username}}</td>
				        	<td>{{$user->level}}</td>
				      	</tr>
				      	<tr>
				        	<td>{{$user->username}}</td>
				        	<td>{{$user->level}}</td>
				      	</tr>
				    </tbody>
				  </table>
				</div>
			</div>
	</div>
</div>
<div class="section" style="text-align: justify;padding-top: 0px">
	<h4 class="center-align">How to Play!</h4>
	<hr>
	<blockquote>
		An answer can be a name, number, place or any word related to the image shown in the question :)
	</blockquote>
	<blockquote>
		Mostly questions are based on tv shows, animes, movies, riddles. (I repeat MOSTLY :P)
	</blockquote>
	<blockquote>
		All answers should be strictly in small letters and without spaces. (if Barry Allen is the answer then type : barryallen) :P
	</blockquote>
	<blockquote>
		You can search on Google or do whatever you want to get to the answer ;)
	</blockquote>
	<blockquote>
		You can discuss in the chatbox with your college mates.
	</blockquote>
	<blockquote>
		There are {{$totalQ}} no. of questions in total. (We'll be adding more and more as per your intelligence :D )
	</blockquote>
	<blockquote>
		If nobody clears a level then more hints would be provided accordingly. :) (Yeah we really want you to solve the chakravyuh.)
	</blockquote>
	<blockquote>
		Top 5 players are listed on the leaderboard. Good Luck :)
	</blockquote>
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
				Materialize.toast('Question Added !', 3000);
			}
			else
			{
				Materialize.toast(result, 3000);
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
				Materialize.toast('Yeyy ! Correct Answer :)', 3000);
				window.location.replace('chakravyuh');
			}
			else
			{
				Materialize.toast('Wrong Answer', 3000);
			}
		});
	}
}


@endsection