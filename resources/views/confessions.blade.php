@extends('home1main')

@section('content')
<div class="row">
<div class="col m6 offset-m3" id="main-feed">
	<div class="card z-depth-4" style="margin-bottom: 10px">
        <div class="card-content pink white-text  " style="padding-top: 0px;padding-bottom: 0px">
          <span class="card-title" style="font-size: 20px">Welcome {{$user->username}} :)</span>
         </div>
         <div class="card-action" style="padding-top:0px;padding-bottom: 10px">
              <form id="post-form" role="form" enctype="multipart/form-data">
              	{{csrf_field()}}
                  <div class="input-field">
	                <i class="material-icons prefix ">mode_edit</i>
	                  <textarea name="mytext" id="mytext" class="materialize-textarea" placeholder="What are you upto?" style="padding-top: 0px;margin-bottom: 1rem;"></textarea>
                </div>
                <div class="row" style="margin: auto">
                  <input type="hidden" name="type" value="1">
                   <button name="post" id="post" type="submit" class="right btn"><i class="material-icons">send</i></button>
                   <div id="postspinner" class="preloader-wrapper small right">
				    <div class="spinner-layer spinner-blue-only">
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
           </form>
         </div>
      </div>
	<div class="row">
		<div class="col s12">
			<?php 
				$postflag=0;
				$postid=-1;
			 	$post_id=-1;
			 ?>
			@foreach($posts as $post)

			@if($postflag==0)
			<?php 
				$postid=$post->id;
				$postflag=1;
			?>
			@endif
			<?php $post_id=$post->id; ?>
			<div class="card feed z-depth-4">
	            <div class="card-content" style="padding-top: 0px;padding-bottom: 5px">
		              <span class="card-title" style="font-size: 20px">#{{$post->id}} Confession</span>
		              <span style="display: inline;"><strong style="font-size: 10px">{{date("j M | D h:i a",strtotime($post->created_at))}}</strong></span>
	              <blockquote style="text-align: justify;margin-top: 0px;margin-bottom: 10px">
	              	{!!nl2br($post->data)!!}
	              </blockquote>
	              <p id="{{$post->id}}likes" data-id="{{$post->id}}" class="chip likescount" style="padding: 6px;display: inline;">{{$post->likes()->count()}} Likes</p>
	              <p id="{{$post->id}}comments" data-id="{{$post->id}}" class="chip commentscount" style="padding: 6px;display:inline">{{$post->comments()->count()}} Comments</p>
	              <div id="{{$post->id}}likesbox" style="display: none;">
	              	
				  </div>
	              <div id="{{$post->id}}commentbox" style="display: none;">
	              
				  </div>

	            </div>
	            <div class="card-action" style="padding-top: 0px;padding-bottom: 0px;">
		            <div class="row" style="padding-top: 0px;margin-bottom: auto;">
		              <div class="col s2 m1" style="padding-top: 10px">
		                @if($likes->contains('post_id',$post->id))
						<a class="likebutton " href="#" value="{{$post->id}}"><i class="material-icons" style="font-size:32px">favorite</i></a>	
						@else
						<a class="likebutton" href="#" value="{{$post->id}}"><i class="material-icons" style="font-size:32px">favorite_border</i></a>
						@endif
		              </div>
		              <div class="col s8 m10">
		                <input style="margin-bottom: 10px" data-id="{{$post->id}}" id="{{$post->id}}commentinput" type="text" class="comment_input" placeholder="write a comment :)">
		              </div>
		              <div class="col s2 m1" style="padding-top: 10px">
		                <button data-id="{{$post->id}}" class="comment_button btn-floating right" ><i class="fa fa-send" style="font-size: 16px"></i></button>
		              </div>
		            </div>
	            </div>
	        </div>
	        @endforeach
		</div>
	</div>
		
			
	</div>
	</div>

@endsection

@section('JSwithTags')
	<script type="text/javascript" src="js/post.js"></script>
@endsection

@section('jscript')

$(document).ready(function()
{
	$(".homeBtn").removeClass("active");
	$(".confessionsBtn").addClass('active');
});



var postid={{$postid}};
var post_id={{$post_id}};

	
	
@endsection