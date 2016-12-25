@extends('home1main')

@section('content')
<div class="row" style="margin-bottom: 0px">
	<div class="col m12 s12 l6 offset-l3" style="padding-right: 5px;padding-left: 5px;">
		<div class="card">
			<div class="card-content" style="text-align: center;">
					<a style="cursor: pointer;"><img src="{{asset($user2->displaypic)}}" class="z-depth-4 circle responsive-img" style="max-width: 150px;"></a>
				<p><strong style="font-size: 20px">{{$user2->username}}</strong></p>
				<p>{{$user2->posts()->count()}} Posts | {{$user2->likes()->count()}} Likes | {{$user2->comments()->count()}} Comments</p>
				<p>{{$user2->gender}} • {{$user2->dept}} • {{$user2->year}} yr.</p>
			</div>
		</div>
		<div class="row" style="margin-bottom: 0px">
		    <div class="col s12">
		      <ul class="tabs">
		        <li class="tab col s6"><a style="font-size: 12px" href="#postsRow">Posts</a></li>
		        <li class="tab col s6"><a style="font-size: 12px" href="#test3">Activity</a></li>
		      </ul>
		    </div>
		    <div class="col s12" id="postsRow">
			</div>
		    <div id="test3" class="col s12">
		    	<div class="card z-depth-4">
			<div class="card-content">
				<span class="card-title" style="font-size: 20px">Recent activity</span>
				@foreach ($myActivities as $activity)
				<?php 
			    	$postedon=$activity->post->user->username;
			    	if ($postedon==$user2->username) {
			    		$postedon='his/her own';
			    	}
			    	else
			    		$postedon=$postedon . "'s";
			    ?>
					<blockquote style="font-size: 12px;margin: 10px 0px 0px 0px">
			    		@if ($activity->type==0)
			    			{{$user2->username}} <a style="cursor: pointer;" data-pid="{{$activity->post_id}}" class="viewStoryBtn">posted</a> on the wall.
			    		@elseif ($activity->type==1)
		    				{{$user2->username}} liked {{$postedon}} <a style="cursor: pointer;" data-pid="{{$activity->post_id}}" class="viewStoryBtn">post.</a>
			    		@else
		    				{{$user2->username}} commented on {{$postedon}} <a style="cursor: pointer;" data-pid="{{$activity->post_id}}" class="viewStoryBtn">post.</a>
			    		@endif
			    		<p class="right" style="margin-top: 0px;margin-bottom: 0px;display: inline;font-size: 10px">{{date("j M | H:i",strtotime($activity->created_at))}}</p>
			    	</blockquote>
				@endforeach
			</div>
		</div>
		    </div>
	 	</div>   
	</div>
</div>
@endsection

@section('jscript')
var uid = {{$user2->id}};
$(document).ready(function()
{
	$(".homeBtn").removeClass("active");
	$(".profileBtn").addClass('active');
	profileModule.userProfilePosts();
});

@endsection