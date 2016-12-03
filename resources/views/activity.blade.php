@extends('home1main')

@section('content')

<div class="row" style="margin-bottom: 0px">
	<div class="col s12 m12 l6 offset-l3" style="padding-left: 5px;padding-right: 5px">
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
		    		<a href="{{asset($uname)}}">{{$uname}}</a>
		    		@if ($noti->type == 'App\Notifications\PostLiked')
		    			 liked
		    		@else
		    			commented on
		    		@endif
		    		your
		    		<a style="cursor: pointer;" data-pid="{{$noti->data['post_id']}}" class="viewStoryBtn">post.</a>
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
			    			<a href="{{asset($postedby)}}">{{$postedby}}</a> <a style="cursor: pointer;" data-pid="{{$activity->post_id}}" class="viewStoryBtn">posted</a> on the wall.
			    		@elseif ($activity->type==1)
		    				<a href="{{asset($postedby)}}">{{$postedby}}</a> liked {{$postedon}}'s <a style="cursor: pointer;" data-pid="{{$activity->post_id}}" class="viewStoryBtn">post.</a>
			    		@else
		    				<a href="{{asset($postedby)}}">{{$postedby}}</a> commented on {{$postedon}}'s <a style="cursor: pointer;" data-pid="{{$activity->post_id}}" class="viewStoryBtn">post.</a>
			    		@endif
			    		<p class="right" style="margin-top: 0px;margin-bottom: 0px;display: inline;font-size: 10px">{{date("j M | h:i a",strtotime($activity->created_at))}}</p>
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