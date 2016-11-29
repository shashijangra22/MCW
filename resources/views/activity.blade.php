@extends('home1main')

@section('content')

<div class="row" style="margin-bottom: 0px">
	<div class="col s12 m12 l6 offset-l3">
		<div class="row">
		    <div class="col s12">
		      <ul class="tabs">
		        <li class="tab col s6"><a href="#myActivity">About Me</a></li>
		        <li class="tab col s6"><a href="#othersActivity">Others</a></li>
		      </ul>
		    </div>
		    <div id="myActivity" class="col s12">
		    <?php 
		    	$allnotis=$user->notifications;
		    ?>
		    @foreach($allnotis as $noti)
		    <?php 
		    	$usrid=$noti->data['user_id'];
				$uname=App\User::find($usrid)->username;    		
		    ?>
		    	<blockquote>
		    		@if ($noti->type == 'App\Notifications\PostLiked')
		    			{{$uname}} liked your <a style="cursor: pointer;" data-id="{{$noti->id}}" data-pid="{{$noti->data['post_id']}}" class="viewStoryBtn">post.</a>
		    		@else
		    			{{$uname}} commented on your <a style="cursor: pointer;" data-id="{{$noti->id}}" data-pid="{{$noti->data['post_id']}}" class="viewStoryBtn">post.</a>
		    		@endif
		    	</blockquote>
		    @endforeach
		    </div>
		    <div id="othersActivity" class="col s12">
		    	@foreach ($activities as $activity)
			    <?php 
			    	$postedby=$activity->user->username;
			    	$postedon=$activity->post->user->username;
			    ?>
			    @if ($postedon!=$user->username)
			    	<blockquote>
			    		@if ($activity->type==0)
			    			{{$postedby}} <a style="cursor: pointer;" data-id="1" data-pid="{{$activity->post_id}}" class="viewStoryBtn">posted</a> on the wall.
			    		@elseif ($activity->type==1)
		    				{{$postedby}} liked {{$postedon}}'s <a style="cursor: pointer;" data-id="1" data-pid="{{$activity->post_id}}" class="viewStoryBtn">post.</a>
			    		@else
		    				{{$postedby}} commented on {{$postedon}}'s <a style="cursor: pointer;" data-id="1" data-pid="{{$activity->post_id}}" class="viewStoryBtn">post.</a>
			    		@endif
			    	</blockquote>
			    @endif
		    @endforeach
		    </div>
		  </div>	
	</div>
</div>

@endsection

@section('jscript')

$(document).ready(function()
{
	$(".homeBtn").removeClass("active");
	$(".activityBtn").addClass('active');

});

@endsection