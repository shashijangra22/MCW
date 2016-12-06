@extends('home1main')

@section('content')
<div class="row" style="margin-bottom: 0px">
	<div class="col m12 s12 l6 offset-l3" style="padding-right: 5px;padding-left: 5px;">
		<div class="card">
			<div class="card-content" style="text-align: center;">
					<a style="cursor: pointer;""><img src="{{asset($user2->displaypic)}}" class="z-depth-4 circle responsive-img" style="max-width: 150px;"></a>
				<p><strong style="font-size: 20px">{{$user2->username}}</strong></p>
				<p>{{count($posts)}} Posts | {{$user2->likes()->count()}} Likes | {{$user2->comments()->count()}} Comments</p>
			</div>
		</div>
		<div class="row" style="margin-bottom: 0px">
		    <div class="col s12">
		      <ul class="tabs">
		        <li class="tab col s4"><a style="font-size: 12px" href="#test1">Posts</a></li>
		        <li class="tab col s4"><a style="font-size: 12px" href="#test2">Likes</a></li>
		        <li class="tab col s4"><a style="font-size: 12px" href="#test3">Activity</a></li>
		      </ul>
		    </div>
		    <div class="col s12" id="test1">
				@foreach($posts as $post)
				<div class="card feed z-depth-4">
					@if($post->path!=NULL)
					<div class="card-image">
		              <img src="{{asset($post->path)}}">
		            </div>
		            @endif
		            <div class="card-content" style="padding: 10px 10px 5px 10px;">
		              <div class="row" style="margin-bottom: 10px">
			              <div class="col s2 m1">
			                <img src="{{asset($post->user->displaypic)}}" class="circle left" width="35" height="35">
			              </div>
			              <div class="col s8 m10">
			                <p>By <strong>{{$post->user->username}}</strong></p>
			                <p style="font-size: 10px"><strong>{{date("j M | D H:i",strtotime($post->created_at))}}</strong></p>
			              </div>
		            </div>
		              <blockquote style="text-align: justify;font-size: 12px;margin-top: 0px;margin-bottom: 10px">
	              	{!!nl2br($post->data)!!}
	              </blockquote>
		              <a id="{{$post->id}}likes" data-id="{{$post->id}}" class="chip likescount blue white-text" style="margin-right: 0px;font-size: 12px;padding: 6px;display: inline;cursor: pointer;">{{$post->likes()->count()}} Likes</a>
		              <a id="{{$post->id}}comments" data-id="{{$post->id}}" class="chip commentscount blue white-text" style="font-size: 12px;padding: 6px;cursor: pointer;display:inline">{{$post->comments()->count()}} Comments</a>
					  <i style="display: none;" id="{{$post->id}}spinner" class="fa fa-spinner fa-pulse"></i>	              

		              <div id="{{$post->id}}likesbox" style="display: none;">
						
					  </div>
		              <div id="{{$post->id}}commentbox" style="display: none">
		              
					  </div>

		            </div>
		            <div class="card-action" style="padding: 0px 10px 0px 10px;">
			            <div class="row" style="padding-top: 0px;margin-bottom: auto;">
			              <div class="col s2 m1" style="padding-top: 10px">
			                <a style="cursor: pointer;margin-right: 0px;" class="likebutton left" value="{{$post->id}}">
								<i class="material-icons" style="font-size:32px">@if($likes->contains('post_id',$post->id)) favorite @else favorite_border @endif</i>
							</a>
			              </div>
			              <div class="col s8 m10">
			                <input style="margin-bottom: 10px" data-id="{{$post->id}}" id="{{$post->id}}commentinput" type="text" class="comment_input" placeholder="write a comment :)">
			              </div>
			              <div class="col s2 m1" style="padding-top: 10px">
			                <a style="margin-right: 0px;cursor: pointer;" data-id="{{$post->id}}" class="comment_button right" id="{{$post->id}}commentbutton"><i style="font-size: 32px" class="material-icons">send</i></a>
				              <div id="{{$post->id}}commentspinner" class="hide preloader-wrapper small right">
							    <div class="spinner-layer spinner-red-only">
							      <div class="circle-clipper left">
							        <div class="circle"></div>
							      </div><div class="gap-patch">
							        <div class="circle"></div>
							      </div><div class="circle-clipper right">
							        <div class="circle"></div>
							      </div>
							    </div>
							</div>
			              </div>
			            </div>
		            </div>
		        </div>
		        @endforeach
			</div>
		    <div id="test2" class="col s12">
		    	@foreach($likedposts as $likedpost)
				<div class="card feed z-depth-4">
					@if($likedpost->path!=NULL)
					<div class="card-image">
		              <img src="{{asset($likedpost->path)}}">
		            </div>
		            @endif
		            <div class="card-content" style="padding: 10px 10px 5px 10px;">
		              <div class="row" style="margin-bottom: 10px">
			              <div class="col s2 m1">
			                <img src="{{asset($likedpost->user->displaypic)}}" class="circle left" width="35" height="35">
			              </div>
			              <div class="col s8 m10">
			                <p>By <strong>{{$likedpost->user->username}}</strong></p>
			                <p style="font-size: 10px"><strong>{{date("j M | D H:i",strtotime($likedpost->created_at))}}</strong></p>
			              </div>
			              <div class="col s2 m1">
			              @if ($likedpost->user_id==$user->id)
			                <button class="btn-floating right delButton waves-effect waves-light" id="delButton" value="{{$likedpost->id}}" ><i id="{{$likedpost->id}}delspinner" class="fa fa-trash" style="font-size: 16px"></i></button>
			               @endif
			              </div>
		            </div>
		              <blockquote style="text-align: justify;font-size: 12px;margin-top: 0px;margin-bottom: 10px">
	              	{!!nl2br($likedpost->data)!!}
	              </blockquote>
		              <a id="{{$likedpost->id}}likes" data-id="{{$likedpost->id}}" class="chip likescount blue white-text" style="margin-right: 0px;font-size: 12px;padding: 6px;display: inline;cursor: pointer;">{{$likedpost->likes()->count()}} Likes</a>
		              <a id="{{$likedpost->id}}comments" data-id="{{$likedpost->id}}" class="chip commentscount blue white-text" style="font-size: 12px;padding: 6px;cursor: pointer;display:inline">{{$likedpost->comments()->count()}} Comments</a>
					  <i style="display: none;" id="{{$likedpost->id}}spinner" class="fa fa-spinner fa-pulse"></i>	              

		              <div id="{{$likedpost->id}}likesbox" style="display: none;">
						
					  </div>
		              <div id="{{$likedpost->id}}commentbox" style="display: none">
		              
					  </div>

		            </div>
		            <div class="card-action" style="padding: 0px 10px 0px 10px;">
			            <div class="row" style="padding-top: 0px;margin-bottom: auto;">
			              <div class="col s2 m1" style="padding-top: 10px">
			                <a style="cursor: pointer;margin-right: 0px;" class="likebutton left" value="{{$likedpost->id}}">
								<i class="material-icons" style="font-size:32px">@if($likes->contains('post_id',$likedpost->id)) favorite @else favorite_border @endif</i>
							</a>
			              </div>
			              <div class="col s8 m10">
			                <input style="margin-bottom: 10px" data-id="{{$likedpost->id}}" id="{{$likedpost->id}}commentinput" type="text" class="comment_input" placeholder="write a comment :)">
			              </div>
			              <div class="col s2 m1" style="padding-top: 10px">
			                <a style="margin-right: 0px;cursor: pointer;" data-id="{{$likedpost->id}}" class="comment_button right" id="{{$likedpost->id}}commentbutton"><i style="font-size: 32px" class="material-icons">send</i></a>
			                <div id="{{$likedpost->id}}commentspinner" class="hide preloader-wrapper small right">
						    <div class="spinner-layer spinner-red-only">
						      <div class="circle-clipper left">
						        <div class="circle"></div>
						      </div><div class="gap-patch">
						        <div class="circle"></div>
						      </div><div class="circle-clipper right">
						        <div class="circle"></div>
						      </div>
						    </div>
						</div>
			              </div>
			            </div>
		            </div>
		        </div>
		        @endforeach
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

$(document).ready(function()
{
	$(".homeBtn").removeClass("active");
	$(".profileBtn").addClass('active');
});

@endsection