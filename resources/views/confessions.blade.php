@extends('home1main')

@section('content')
<div class="row">
<div class="col m6 offset-m3" id="main-feed">
	<div class="card z-depth-4">
        <div class="card-content pink white-text  " style="padding-top: 5px;padding-bottom: 5px">
          <span class="card-title">Welcome {{$user->username}} :)</span>
         </div>
         <div class="card-action pink lighten-5 black-text" style="padding-top:0px;padding-bottom: 10px">
              <form id="post-form" role="form" enctype="multipart/form-data">
              	{{csrf_field()}}
                  <div class="input-field">
                <i class="material-icons prefix ">mode_edit</i>
                  <textarea name="mytext" id="mytext" class="materialize-textarea" placeholder="What are you upto?"></textarea>
                </div>
                <div class="row" style="margin: auto">
                  <div class="fileUpload btn pink accent-4">Upload
                      <input type="file" accept="image/*" class="upload" name="image" id="image" />
                  </div>
                  <input type="hidden" name="type" value="1">
                   <button name="post" id="post" type="submit" class="right btn pink accent-4"><i class="material-icons">send</i></button>
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
			<div class="card pink sticky-action feed z-depth-4">
				@if($post->path!=NULL)
				<div class="card-image">
	              <img class="materialboxed" src="{{$post->path}}">
	            </div>
	            @endif
	            <div class="card-content pink white-text" style="padding-top: 10px;padding-bottom: 10px">
	              <div class="row" style="padding-top: 5px">
		              <div class="col s2 m1">
		                
		              </div>
		              <div class="col s8 m10">
		                <p style="font-size: 10px"><strong>{{$post->created_at}}</strong></p>
		              </div>
		              <div class="col s2 m1">
		              </div>
	            </div>
	              <p style="text-align: justify;padding-bottom: 5px">
	              		{!!nl2br($post->data)!!}
	              </p>
	              <p id="{{$post->id}}likes" class="chip pink lighten-5 pink activator likescount" style="padding: 6px;display: inline; color:#c51162">{{$post->likes()->count()}} Likes</p>
	              <p id="{{$post->id}}comments" data-id="{{$post->id}}" class="chip pink lighten-5 activator commentscount" style="padding: 6px;color:#c51162;display:inline">{{$post->comments()->count()}} Comments</p>

	            </div>
	            <div class="card-action pink lighten-5" style="padding-top: 5px;padding-bottom: 0px; ">
		            <div class="row" style="padding-top: 0px;margin-bottom: auto;">
		              <div class="col s2 m1" style="padding-top: 12px">
		                @if($likes->contains('post_id',$post->id))
						<a class="likebutton " href="#" value="{{$post->id}}"><i class="material-icons" style="font-size:32px">favorite</i></a>	
						@else
						<a class="likebutton" href="#" value="{{$post->id}}"><i class="material-icons" style="font-size:32px">favorite_border</i></a>
						@endif
		              </div>
		              <div class="col s8 m10">
		                <input  data-id="{{$post->id}}" id="{{$post->id}}commentinput" type="text" class="comment_input" placeholder="write a comment :)">
		              </div>
		              <div class="col s2 m1" style="padding-top: 12px">
		                <button data-id="{{$post->id}}" class="comment_button btn-floating right pink accent-4" ><i class="fa fa-send" style="font-size: 16px"></i></button>
		              </div>
		            </div>
	            </div>
	            <div class="card-reveal pink lighten-5" style="padding-top: 0px">
			      
			      <div class="row">
				    <div class="col s8">
				      <ul class="tabs pink">
				        <li class="tab col s6 commentcount pink white-text"><a class="" href="#{{$post->id}}commentbox" style="color:#fce4ec;">{{$post->comments()->count()}} Comments</a></li>
				        <li class="tab col s6 likecount pink white-text"><a href="{{$post->id}}likebox" style="color:#fce4ec;">{{$post->likes()->count()}} Likes</a></li>
				      </ul>
				    </div>
				    <div class="col s4">
				    	<span class="card-title" style="padding-top: 10px"><i class="material-icons right">close</i></span>
				    </div>
				    <div id="{{$post->id}}likebox" class="col s12 " style="padding-top: 10px">
				    </div>
				    <div id="{{$post->id}}commentbox" class="col s12 " style="padding-top: 10px">
					    	
				
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