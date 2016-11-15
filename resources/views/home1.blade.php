@extends('home1main')

@section('content')

<div class="row">
<div class="col m12 s12 l6" id="main-feed">
	<div class="card z-depth-4" style="margin-bottom: 10px">
        <div class="card-content blue white-text" style="padding-top: 0px;padding-bottom: 0px">
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
                  <div class="fileUpload btn">Upload
                      <input type="file" accept="image/*" class="upload" name="image" id="image" />
                  </div>
                  <input type="hidden" name="type" value="0">
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
				@if($post->path!=NULL)
				<div class="card-image">
	              <img class="materialboxed" src="{{$post->path}}">
	            </div>
	            @endif
	            <div class="card-content" style="padding-top: 10px;padding-bottom: 5px">
	              <div class="row" style="padding-top: 5px; margin-bottom: 10px">
		              <div class="col s2 m1">
		                <img src="{{$post->user->displaypic}}" class="circle left" width="35" height="35">
		              </div>
		              <div class="col s8 m10">
		                <p>By <strong>{{$post->user->username}}</strong></p>
		                <p style="font-size: 10px"><strong>{{date("j M | D h:i a",strtotime($post->created_at))}}</strong></p>
		              </div>
		              <div class="col s2 m1">
		              @if ($post->user_id==$user->id)
		                <button class="btn-floating right delButton" id="delButton" value="{{$post->id}}" ><i class="fa fa-trash" style="font-size: 16px"></i></button>
		               @endif
		              </div>
	            </div>
	              <p style="text-align: justify;">
	              		{!!nl2br($post->data)!!}
	              </p>
	              <p id="{{$post->id}}likes" class="chip likescount blue white-text" style="padding: 6px;display: inline;">{{$post->likes()->count()}} Likes</p>
	              <p href="#" id="{{$post->id}}comments" data-id="{{$post->id}}" class="chip commentscount blue white-text" style="padding: 6px;display:inline">{{$post->comments()->count()}} Comments</p>
	              
	              <div id="{{$post->id}}likesbox">
					
				  </div>
	              <div id="{{$post->id}}commentbox" style="display: none">
	              
				  </div>

	            </div>
	            <div class="card-action" style="padding-top: 0px;padding-bottom: 0px; ">
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
<div class="col m12 s12 l6">
	<div class="card z-depth-4">
		<div class="card-content blue white-text center-align" style="padding-top: 0px;padding-bottom: 0px"> 
			<span class="card-title" style="font-size: 20px">Upcoming Events</span>
		</div>
		<div class="slider">
		    <ul class="slides">
		      <li>
		        <img src="img/study.jpg" style="filter: brightness(0.40);"> <!-- random image -->
		        <div class="caption center-align">
		          <h4>🤓 Exams 🤓</h4>
		          <h6 class="light grey-text text-lighten-3">📚 24 Nov | Pull your Socks ! 📑</h6>
		        </div>
		      </li>
		      <li>
		        <img src="img/penguins.jpg" style="filter: brightness(0.40);"> <!-- random image -->
		        <div class="caption left-align">
		          <h4>🎅 Christmas Day 🎅</h4>
		          <h6 class="light grey-text text-lighten-3">🍬 25 Dec | Ho Ho Ho :D ❄</h6>
		        </div>
		      </li>
		      <li>
		        <img src="img/party.jpg" style="filter: brightness(0.40);"> <!-- random image -->
		        <div class="caption right-align">
		          <h4>💃 New Year Party 💃</h4>
		          <h6 class="light grey-text text-lighten-3">😍 31 Dec | Don't be late coz party won't wait 😉</h6>
		        </div>
		      </li>
		    </ul>
		</div>
	</div>

	<div class="card z-depth-4">
		<div class="card-content blue white-text center-align" style="padding-top: 0px;padding-bottom: 0px"> 
			<span class="card-title" style="font-size: 20px">Notice Board</span>
		</div>
		<div class="card-action" style="padding-top: 0px;padding-bottom: 0px">
          	<table  style="font-size: 12px">
	          <thead>
	          <tr>
	            <th>Notice Name</th>
	            <th>Date</th>
	          </tr>
	        </thead>
	        <tbody>
	          <tr>
	            <td style="padding-bottom: 5px;"><a style="color: red" href="{{asset('notices')}}">Fee Submission</a></td>
	            <td style="padding-bottom: 5px;">7 October</td>
	          </tr>
	          <tr>
	            <td style="padding-bottom: 5px;"><a style="color: red" href="{{asset('notices')}}">ID Card form</a></td>
	            <td style="padding-bottom: 5px;">21 October</td>
	          </tr>
	          <tr>
	            <td style="padding-bottom: 5px;"><a style="color: red" href="{{asset('notices')}}">Diwali Break</a></td>
	            <td style="padding-bottom: 5px;">30 October</td>
	          </tr>
	          <tr>
	            <td style="padding-bottom: 5px;"><a style="color: red" href="{{asset('notices')}}">Cricket Trials for Inter DU</a></td>
	            <td style="padding-bottom: 5px;">5 November</td>
	          </tr>
	        </tbody>
        	</table>
        	<br>
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

	
			
@endsection