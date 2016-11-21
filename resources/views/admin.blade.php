@extends('home1main')

@section('content')
<?php 
	$totalUsers=count($users);
	$totalPosts=count($posts);
	$totalComments=count($comments);
	$totalChats=count($chats);
	$totalLikes=count($likes);
	$totalQuestions=count($questions);
?>
		<div class="row">
		    <div class="col s12">
		      <ul class="tabs">
		        <li class="tab col s2"><a href="#users">Users</a></li>
		        <li class="tab col s2"><a href="#posts">Posts</a></li>
		        <li class="tab col s2"><a href="#comments">Comments</a></li>
		        <li class="tab col s2"><a href="#chats">Chats</a></li>
		        <li class="tab col s2"><a href="#likes">Likes</a></li>
		        <li class="tab col s2"><a href="#questions">Questions</a></li>
		      </ul>
		    </div>
		    <div id="users" class="col s12">
		    	<div class="row">
		    		<?php $counter=0; ?>
		    		@foreach ($users as $usr)
		    		<div class="col s12 l3">
		    			<div class="card">
		    				<div class="card-content" style="font-size: 12px">
	    						<span class="card-title">User : #{{++$counter}}</span>
		    						<span class="card-title right"><a style="cursor: pointer;" onclick="toggleuser('{{$usr->id}}',1);">
		    						@if ($usr->active==1)
			    						<i class="fa fa-ban"></i>
		    						@else
		    							<i class="fa fa-check"></i>
		    						@endif
		    						</a></span>
		    					<p><strong>Id : </strong>{{$usr->id}}</p>
		    					<p><strong>Name : </strong>{{$usr->fname}} {{$usr->lname}}</p>
		    					<p><strong>Username : </strong>{{$usr->username}}</p>
		    					<p><strong>Email : </strong>{{$usr->email}}</p>
		    					<p><strong>Level : </strong>{{$usr->level}}</p>
		    					<p><strong>Active : </strong>{{$usr->active}}</p>
		    					<p><strong>Verify Token : </strong>{{$usr->verifytoken}}</p>
		    					<p><strong>Date Created : </strong>{{$usr->created_at}}</p>
		    				</div>
		    			</div>
		    		</div>
		    		@endforeach
		    	</div>
		    </div>
		    <div id="posts" class="col s12">
		    	<div class="row">
		    		<?php $counter=0; ?>
		    		@foreach ($posts as $post)
		    		<div class="col s12 l3">
		    			<div class="card">
		    				<div class="card-content" style="font-size: 12px">
	    						<span class="card-title">Post : #{{++$counter}}</span>
		    						<span class="card-title right"><a style="cursor: pointer;" onclick="deletePost('{{$post->id}}');"><i class="fa fa-trash"></i></a></span>
		    					<p><strong>Id : </strong>{{$post->id}}</p>
		    					<p><strong>User : </strong>{{$post->user->username}}</p>
		    					<p><strong>Data : </strong>{{$post->data}}</p>
		    					<p><strong>Path : </strong>{{$post->path}}</p>
		    					<p><strong>Type : </strong>{{$post->type}}</p>
		    					<p><strong>Likes : </strong>{{$post->likes}}</p>
		    					<p><strong>Comments : </strong>{{$post->comments}}</p>
		    					<p><strong>Date Created : </strong>{{$post->created_at}}</p>
		    				</div>
		    			</div>
		    		</div>
		    		@endforeach
		    	</div>
		    </div>
		    <div id="comments" class="col s12">
		    	<div class="row">
			    	<?php $counter=0; ?>
		    		@foreach ($comments as $comment)
		    		<div class="col s12 l3">
		    			<div class="card">
		    				<div class="card-content" style="font-size: 12px">
	    						<span class="card-title">Comment : #{{++$counter}}</span>
		    						<span class="card-title right"><a style="cursor: pointer;" onclick="deleteComment('{{$comment->id}}');"><i class="fa fa-trash"></i></a></span>
		    					<p><strong>Id : </strong>{{$comment->id}}</p>
		    					<p><strong>User : </strong>{{$comment->user->username}}</p>
		    					<p><strong>Post : </strong>{{$comment->post->id}}</p>
		    					<p><strong>Data : </strong>{{$comment->data}}</p>
		    					<p><strong>Date Created : </strong>{{$comment->created_at}}</p>
		    				</div>
		    			</div>
		    		</div>
		    		@endforeach
		    	</div>
		    </div>
		    <div id="chats" class="col s12">
		    	<div class="row">
			    	<?php $counter=0; ?>
		    		@foreach ($chats as $chat)
		    		<div class="col s12 l3">
		    			<div class="card">
		    				<div class="card-content" style="font-size: 12px">
	    						<span class="card-title">Chat : #{{++$counter}}</span>
		    						<span class="card-title right"><a style="cursor: pointer;" onclick="deleteChat('{{$chat->id}}');"><i class="fa fa-trash"></i></a></span>
		    					<p><strong>Id : </strong>{{$chat->id}}</p>
		    					<p><strong>User : </strong>{{$chat->user->username}}</p>
		    					<p><strong>Message : </strong>{{$chat->message}}</p>
		    					<p><strong>Date Created : </strong>{{$chat->created_at}}</p>
		    				</div>
		    			</div>
		    		</div>
		    		@endforeach
		    	</div>
		    </div>
		    <div id="likes" class="col s12">
		    	<div class="row">
			    	<?php $counter=0; ?>
		    		@foreach ($likes as $like)
		    		<div class="col s12 l3">
		    			<div class="card">
		    				<div class="card-content" style="font-size: 12px">
	    						<span class="card-title">Like : #{{++$counter}}</span>
		    					<p><strong>Id : </strong>{{$like->id}}</p>
		    					<p><strong>User : </strong>{{$like->user->username}}</p>
		    					<p><strong>Post : </strong>{{$like->post->id}}</p>
		    					<p><strong>Date Created : </strong>{{$like->created_at}}</p>
		    				</div>
		    			</div>
		    		</div>
		    		@endforeach
		    	</div>
		    </div>
		    <div id="questions" class="col s12">
		    	<div class="row">
			    	<?php $counter=0; ?>
			    	<div class="col s12 l3">
				    	<div class="card">
				    		<div class="card-content" style="text-align: center;padding-top: 0px;padding-bottom: 0px">
				    			 <span class="card-title" style="font-size: 18px">Add A Question</span>
				    		</div>
							<div class="card-action">
								<form id="post-form" role="form" action="#" enctype="multipart/form-data">
				              	{{csrf_field()}}
				                  <div class="row" style="margin: auto;">
				                  	<input placeholder="Question goes here..." type="text" id="qBox" name="qBox">
				                  	<input placeholder="Answer goes here..." type="text" id="answerBox" name="answerBox">
				                  </div>
				                  <div class="row" style="margin: auto;">
				                  	<div class="fileUpload btn left"><i class="material-icons">add</i>
					                      <input type="file" accept="image/*" class="upload" name="image" id="image" />
					                  </div>
				               		<a name="addQBtn" id="addQBtn" class="right btn"><i class="material-icons">send</i></a>
				                  </div>
			           			</form>
							</div>
						</div>
					</div>
		    		@foreach ($questions as $question)
		    		<div class="col s12 l3">
		    			<div class="card">
		    				<div class="card-image">
		    					<img src="{{$question->path}}">
		    				</div>
		    				<div class="card-content" style="font-size: 12px">
	    						<!-- <span class="card-title">Question : #{{++$counter}}</span> -->
		    					<p><strong>Id : </strong>{{$question->id}}</p>
		    					<p><strong>Hint : </strong>{{$question->data}}</p>
		    					<p><strong>Answer : </strong>{{$question->answer}}</p>
		    					<p><strong>Date Created : </strong>{{$question->created_at}}</p>
		    				</div>
		    			</div>
		    		</div>
		    		@endforeach
		    	</div>
		    </div>
		  </div>
@endsection

@section('jscript')

	function toggleuser(uid,state) 
	{
		$.ajax({
			type:"POST",
			data:{uid:uid,state:state},
			url:"toggleuser"
		}).done(function(result)
		{
			Materialize.toast(result, 3000);
		});
	}

	function deletePost(pid) 
	{
		$.ajax({
			type:"POST",
			data:{pid:pid},
			url:"deletepost"
		}).done(function(result)
		{
			Materialize.toast(result, 3000);
		});
	}

	function deleteComment(cid) 
	{
		$.ajax({
			type:"POST",
			data:{cid:cid},
			url:"deletecomment"
		}).done(function(result)
		{
			Materialize.toast(result, 3000);
		});
	}

	function deleteChat(chatid) 
	{
		$.ajax({
			type:"POST",
			data:{chatid:chatid},
			url:"deletechat"
		}).done(function(result)
		{
			Materialize.toast(result, 3000);
		});
	}

	$('#addQBtn').on("click",function(e){
			e.preventDefault();
			var formData = new FormData($("#post-form")[0]);
		$.ajax({
			url: "addQuestion",
			type:"POST",
			 
			data:formData,
			contentType: false,
			processData: false
			
			})
		.done(function(result){
		$("#post-form")[0].reset();
			if(result=='0')
			{
				Materialize.toast('Question Added !', 3000);
			}
			else
			{
				Materialize.toast(result, 3000);
			}
			});
		
			
		});

@endsection