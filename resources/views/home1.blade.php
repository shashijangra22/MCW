@extends('home1main')

@section('content')

<div class="row">
<div class="col m12 s12 l6 offset-l1" id="main-feed">
	<div class="card z-depth-4">
        <div class="card-content primary-color white-text  " style="padding-top: 5px;padding-bottom: 5px">
          <span class="card-title">Welcome {{$user->username}} :)</span>
         </div>
         <div class="card-action secondary-color black-text" style="padding-top:0px;padding-bottom: 10px">
              <form id="post-form" role="form" enctype="multipart/form-data">
              	{{csrf_field()}}
                  <div class="input-field">
                <i class="material-icons prefix ">mode_edit</i>
                  <textarea name="mytext" id="mytext" class="materialize-textarea" placeholder="What are you upto?"></textarea>
                </div>
                <div class="row" style="margin: auto">
                  <div class="fileUpload btn accent-color">Upload
                      <input type="file" accept="image/*" class="upload" name="image" id="image" />
                  </div>
                  <input type="hidden" name="type" value="0">
                   <button name="post" id="post" type="submit" class="right btn accent-color"><i class="material-icons">send</i></button>
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
			{{--*/$postflag=0/*--}}
			{{--*/$postid=-1/*--}}
			{{--*/$post_id=-1/*--}}
			@foreach($posts as $post)

			@if($postflag==0)
			{{--*/$postid=$post->id/*--}}
			{{--*/$postflag=1/*--}}
			@endif
			{{--*/$post_id=$post->id/*--}}
			<div class="card sticky-action feed z-depth-4">
				@if($post->path!=NULL)
				<div class="card-image">
	              <img class="materialboxed" src="{{$post->path}}">
	            </div>
	            @endif
	            <div class="card-content primary-color white-text" style="padding-top: 10px;padding-bottom: 10px">
	              <div class="row" style="padding-top: 5px">
		              <div class="col s2 m1">
		                <img src="{{$post->user->displaypic}}" class="circle left" width="35" height="35">
		              </div>
		              <div class="col s8 m10">
		                <p>By <strong>{{$post->user->username}}</strong></p>
		                <p style="font-size: 10px"><strong>{{$post->created_at}}</strong></p>
		              </div>
		              <div class="col s2 m1">
		              @if ($post->user_id==$user->id)
		                <button class="btn-floating right delButton accent-color" id="delButton" value="{{$post->id}}" ><i class="fa fa-trash" style="font-size: 16px"></i></button>
		               @endif
		              </div>
	            </div>
	              <p style="text-align: justify;padding-bottom: 5px">
	              		{!!nl2br($post->data)!!}
	              </p>
	              <p id="{{$post->id}}likes" class="chip secondary-color activator likescount" style="padding: 6px;display: inline; color:#c51162">{{$post->likes()->count()}} Likes</p>
	              <p id="{{$post->id}}comments" data-id="{{$post->id}}" class="chip secondary-color activator commentscount" style="padding: 6px;color:#c51162;display:inline">{{$post->comments()->count()}} Comments</p>

	            </div>
	            <div class="card-action secondary-color" style="padding-top: 5px;padding-bottom: 0px; ">
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
		                <button data-id="{{$post->id}}" class="comment_button btn-floating right accent-color" ><i class="fa fa-send" style="font-size: 16px"></i></button>
		              </div>
		            </div>
	            </div>
	            <div class="card-reveal secondary-color" style="padding-top: 0px">
			      
			      <div class="row">
				    <div class="col s8">
				      <ul class="tabs ">
				        <li class="tab col s6 commentcount accent-color white-text"><a class="" href="#{{$post->id}}commentbox" ">{{$post->comments()->count()}} Comments</a></li>
				        <li class="tab col s6 likecount accent-color white-text"><a href="{{$post->id}}likebox" ">{{$post->likes()->count()}} Likes</a></li>
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
	<div id="loadmore"></div>

<div id="button" class="center-align">
	<button class="btn accent-color " id="loadmore-button" style="margin:auto"> Loadmore</button>
	<div id="loadmore-spinner" class="preloader-wrapper small " >
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
<div class="col l4 hide-on-med-and-down" >
          <div class="row" style="position: fixed;">
            <div class="col s12">
              <div class="card">
                <div class="card-content teal white-text" style="padding-top: 10px;padding-bottom: 10px">
                  <span class="card-title">Upcoming Events</span>
                 </div>
                 <div class="card-action" style="padding-top: 5px;padding-bottom: 5px">
                      <table style="font-size: 14px">
                      <thead>
                        <tr>
                          <th>Event Name</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><a style="color: red" href="#">Songs Of India</a></td>
                          <td>7 October</td>
                        </tr>
                        <tr>
                          <td><a style="color: red" href="#">Dance With Props Competition</a></td>
                          <td>21 October</td>
                        </tr>
                        <tr>
                          <td><a style="color: red" href="#">Diwali Night</a></td>
                          <td>30 October</td>
                        </tr>
                        <tr>
                          <td><a style="color: red" href="#">Electronics Workshop</a></td>
                          <td>5 November</td>
                        </tr>
                        <tr>
                          <td><a style="color: red" href="#">Ice Cream Day :P</a></td>
                          <td>10 November</td>
                        </tr>
                      </tbody>
                    </table>
                 </div>
              </div>
              <div class="card">
                <div class="card-content blue white-text" style="padding-top: 10px;padding-bottom: 10px">
                  <span class="card-title">Notice Board</span>
                 </div>
                 <div class="card-action" style="padding-top: 5px;padding-bottom: 5px">
                      <table  style="font-size: 14px">
                      <thead>
                      <tr>
                        <th>Notice Name</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><a style="color: purple" href="#">Fee Submission</a></td>
                        <td>7 October</td>
                      </tr>
                      <tr>
                        <td><a style="color: purple" href="#">ID Card form</a></td>
                        <td>21 October</td>
                      </tr>
                      <tr>
                        <td><a style="color: purple" href="#">Diwali Break</a></td>
                        <td>30 October</td>
                      </tr>
                      <tr>
                        <td><a style="color: purple" href="#">Cricket Trials for Inter DU</a></td>
                        <td>5 November</td>
                      </tr>
                    </tbody>
                    </table>
                 </div>
                 </div>
            </div>
          </div>
    </div>

	</div>




@endsection

@section('JSwithTags')
	<script type="text/javascript" src="js/post.js"></script>
@endsection

@section('jscript')

	
	var postid={{$postid}};
var post_id={{$post_id}};

	function user_profile(event)
	{
		event.preventDefault();
		var user=$(event.target).text();
		alert(user);
		var url='userprofile/'+user;
		window.location.replace(url);
	}
	
			
@endsection