@extends('home1main')

@section('content')
<div class="row">

<div class="col s12 m12 l6 offset-l3" id="main-feed" style="padding-left: 5px;padding-right: 5px">
	<div class="row" style="margin-bottom: 0px" id="postFormRow">
			<div class="col s12">
				<div class="card z-depth-5" style="margin-bottom: 5px">
			        <div class="card-content pink white-text" style="text-align: center;padding-top: 0px;padding-bottom: 0px">
			          <span class="card-title" style="font-size: 20px">Welcome {{$user->username}} :)</span>
			         </div>
			         <div class="card-action" style="padding: 0px 10px 10px 10px;">
			              <form role="form" enctype="multipart/form-data">
			              	{{csrf_field()}}
			                  <div class="input-field">
			                <i class="material-icons prefix ">mode_edit</i>
			                  <textarea name="mytext" id="mytext" class="materialize-textarea" placeholder="Want to confess something ??" style="padding-top: 0px;margin-bottom: 1rem;"></textarea>
			                </div>
			                <div class="row" style="margin: auto">
			                  <input type="hidden" name="type" value="1">
			                   <a disabled class="right btn"><i class="material-icons">send</i></a>
			                   <div class="hide postspinner preloader-wrapper small right active">
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
			</div>
		</div>
	<div class="row" style="margin-bottom: 10px">
		<div class="col s12" id="postsRow">
			@foreach($posts as $post)
			<div class="card feed z-depth-4">
	            <div class="card-content" style="padding: 0px 10px 5px 10px;">
		              <span class="card-title" style="font-size: 20px">#{{$loop->remaining+1}} Confession</span>
		              <card
		              <span style="display: inline;"><strong style="font-size: 10px">{{date("j M | D h:i a",strtotime($post->created_at))}}</strong></span>
	              <blockquote style="text-align: justify;font-size: 12px;margin-top: 0px;margin-bottom: 10px">
	              	{!!nl2br($post->data)!!}
	              </blockquote>
	              <a data-id="{{$post->id}}" class="chip likescount blue white-text" style="margin-right: 0px;font-size: 12px;padding: 6px;display: inline;cursor: pointer;">{{$post->likes()->count()}} Likes</a>
	              <a data-id="{{$post->id}}" class="chip commentscount blue white-text" style="font-size: 12px;padding: 6px;cursor: pointer;display:inline">{{$post->comments()->count()}} Comments</a>
	              <i style="display: none;" class="fa fa-spinner fa-pulse"></i>
	              <div class="likesBox" style="display: none;"></div>
	              <div class="commentsBox" style="display: none;"></div>
	            </div>
	            <div class="card-action" style="padding: 0px 10px 0px 10px;">
		            <div class="row" style="padding-top: 0px;margin-bottom: auto;">
		              <div class="col s2 m1" style="padding-top: 10px">
			              <i data-id="{{$post->id}}" style="color:red;cursor:pointer;font-size: 32px" class="likeBtn left material-icons">@if($likes->contains('post_id',$post->id)) favorite @else favorite_border @endif</i>
						</div>
		              <div class="col s8 m10">
		                <input style="margin-bottom: 10px" data-id="{{$post->id}}" type="text" placeholder="write a comment :)">
		              </div>
		              <div class="col s2 m1" style="padding-top: 10px">
			              <i data-id="{{$post->id}}" style="color: grey;cursor: pointer;font-size: 32px" class="commentBtn right material-icons">send</i>
			              <div class="hide commentSpinner preloader-wrapper small right active">
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
		            </div>
	            </div>
	        </div>
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
	$(".confessionsBtn").addClass('active');
});
	
@endsection