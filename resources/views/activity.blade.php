@extends('home1main')

@section('content')

<div class="row" style="margin-bottom: 0px">
	<div class="col s12 m12 l6 offset-l3" style="padding-left: 0px;padding-right: 0px">
		<div class="row">
		    <div class="col s12">
		      <ul class="tabs">
		        <li class="tab col s6"><a style="font-size: 12px" href="#myActivity">About Me</a></li>
		        <li class="tab col s6"><a style="font-size: 12px" href="#othersActivity">Others</a></li>
		      </ul>
		    </div>
		    <div id="myActivity" class="col s12">
		    <?php 
		    	$allnotis=$user->notifications->take(15);
		    ?>
		    @foreach($allnotis as $noti)
		    <?php 
		    	$usrid=$noti->data['user_id'];
				$uname=App\User::find($usrid)->username;    		
		    ?>
		    	<blockquote style="font-size: 12px;margin: 10px 0px 0px 0px">
		    		@if ($noti->type == 'App\Notifications\PostLiked')
		    			{{$uname}} liked your <a style="cursor: pointer;" data-id="{{$noti->id}}" data-pid="{{$noti->data['post_id']}}" class="viewStoryBtn">post.</a>
		    		@else
		    			{{$uname}} commented on your <a style="cursor: pointer;" data-id="{{$noti->id}}" data-pid="{{$noti->data['post_id']}}" class="viewStoryBtn">post.</a>
		    		@endif
		    		<p class="right" style="margin-top: 0px;margin-bottom: 0px;display: inline;font-size: 10px">{{date("j M | h:i a",strtotime($noti->created_at))}}</p>
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
			    	<blockquote style="font-size: 12px;margin: 10px 0px 0px 0px">
			    		@if ($activity->type==0)
			    			{{$postedby}} <a style="cursor: pointer;" data-id="1" data-pid="{{$activity->post_id}}" class="viewStoryBtn">posted</a> on the wall.
			    		@elseif ($activity->type==1)
		    				{{$postedby}} liked {{$postedon}}'s <a style="cursor: pointer;" data-id="1" data-pid="{{$activity->post_id}}" class="viewStoryBtn">post.</a>
			    		@else
		    				{{$postedby}} commented on {{$postedon}}'s <a style="cursor: pointer;" data-id="1" data-pid="{{$activity->post_id}}" class="viewStoryBtn">post.</a>
			    		@endif
			    		<p class="right" style="margin-top: 0px;margin-bottom: 0px;display: inline;font-size: 10px">{{date("j M | h:i a",strtotime($noti->created_at))}}</p>
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