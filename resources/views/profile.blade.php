@extends('home1main')

@section('content')
<div class="row" style="margin-bottom: 0px">
	<div class="col m12 s12 l6 offset-l3" style="padding-left: 5px;padding-right: 5px">
		<div class="card">
			<div class="card-content" style="text-align: center;">
					<a style="cursor: pointer;" onclick="upload();"><img src="{{$user->displaypic}}" id="profile-pic" class="z-depth-4 circle responsive-img profile-pic" style="max-width: 150px;"></a>
			     	<form id="pic-form" role="form" enctype="multipart/form-data" action="#">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="file" accept="image/*" class="hide" name="pic" id="pic"/>
					</form>
				<p><strong style="font-size: 20px">{{$user->fname}} {{$user->lname}}</strong></p>
				<p>{{$user->posts()->count()}} Posts | {{$user->likes()->count()}} Likes | {{$user->comments()->count()}} Comments</p>
				<p>{{$user->email}}</p>
				<p>{{$user->gender}} • {{$user->dept}} • {{$user->year}} yr.</p>
			</div>
			<div class="card-action" style="padding: 10px 20px">
				<div class="row" style="margin-bottom: 0px">
					<button class="btn tooltipped left waves-effect waves-light" onclick="upload();" data-position="bottom" data-delay="50" data-tooltip="Use Square Images for best results!"><i class="material-icons">add_a_photo</i></button>
					<button class="waves-effect waves-light btn right activator"><i class="material-icons">settings</i></button>
				</div>
			</div>
			<div class="card-reveal" style="padding: 15px">
			<span class="card-title"><i class="right material-icons">close</i></span>
				<div class="row" style="margin-bottom: 0px">
			      <form class="col s12" id="edit-form" role="form" enctype="multipart/form-data">
				      <div class="row" style="margin-bottom: 0px;">
				        <div class="input-field col s6">
					      <input id="fname" name="fname" type="text" value="{{$user->fname}}">
				          <label for="fname">First Name</label>
				        </div>
				        <div class="input-field col s6">
					      <input id="lname" name="lname" type="text" value="{{$user->lname}}">
				          <label for="lname">Last Name</label>	
				        </div>
				      </div>
				      <div class="row" style="margin-bottom: 0px;">
				        <div class="input-field col s6">
					      <input id="username" name="username" type="text" value="{{$user->username}}">
					      <label for="username">Username</label>	
				        </div>
				        <div class="input-field col s6">
				        <?php $select = $user->gender ?>
						    <select name="gender">
						      <option value="null" disabled @if ($select==null) selected @endif >Choose Gender</option>
						      <option value="Male" @if ($select=='Male') selected @endif >Male</option>
						      <option value="Female" @if ($select=='Female') selected @endif >Female</option>
						    </select>
						    <label>Gender</label>
						  </div>
				      </div>
				      <div class="row" style="margin-bottom: 0px;">
					      <div class="input-field col s6">
					      <?php $select = $user->dept ?>
						    <select name="dept">
						      <option value="null" disabled @if ($select==null) selected @endif >Choose Dept.</option>
						      <option value="CS" @if ($select=='CS') selected @endif >CS</option>
						      <option value="BMS" @if ($select=='BMS') selected @endif >BMS</option>
						      <option value="FT" @if ($select=='FT') selected @endif >FT</option>
						      <option value="Micro" @if ($select=='Micro') selected @endif >Micro</option>
						      <option value="Instru" @if ($select=='Instru') selected @endif >Instru</option>
						      <option value="Electro" @if ($select=='Electro') selected @endif >Electro</option>
						      <option value="Poly" @if ($select=='Poly') selected @endif >Poly</option>
						      <option value="Physics" @if ($select=='Physics') selected @endif >Physics</option>
						    </select>
						    <label>Department</label>
						  </div>	
				        <div class="input-field col s6">
				        <?php $select = $user->year ?>
						    <select name="year">
						      <option value="null" disabled @if ($select==null) selected @endif >Choose Year</option>
						      <option value="Ist" @if ($select=='Ist') selected @endif >Ist</option>
						      <option value="IInd" @if ($select=='IInd') selected @endif >IInd</option>
						      <option value="IIIrd" @if ($select=='IIIrd') selected @endif >IIIrd</option>
						      <option value="IVth" @if ($select=='IVth') selected @endif >IVth</option>
						    </select>
						    <label>Year</label>
						  </div>
				      </div>
				      <button id="editBtn" name="editBtn" class="waves-effect waves-light right btn">Submit</button>
		      	</form>
		      	</div>
			</div>
		</div>

	  	<div class="row" style="margin-bottom: 0px">
		    <div class="col s12">
		      <ul class="tabs">
		        <li class="tab col s6"><a style="font-size: 12px" href="#postsRow">My Posts</a></li>
		        <li class="tab col s6"><a style="font-size: 12px" href="#test3">My Activity</a></li>
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
					    	if ($postedon==$user->username) {
					    		$postedon='your own';
					    	}
					    	else
					    		$postedon=$postedon . "'s";
					    	?>
							<blockquote style="font-size: 12px;margin: 10px 0px 0px 0px">
					    		@if ($activity->type==0)
					    			You <a style="cursor: pointer;" data-pid="{{$activity->post_id}}" class="viewStoryBtn">posted</a> on the wall.
					    		@elseif ($activity->type==1)
				    				You liked {{$postedon}} <a style="cursor: pointer;" data-pid="{{$activity->post_id}}" class="viewStoryBtn">post.</a>
					    		@else
				    				You commented on {{$postedon}} <a style="cursor: pointer;" data-pid="{{$activity->post_id}}" class="viewStoryBtn">post.</a>
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

function upload() 
{
    $("input[id='pic']").click();
}

$('#editBtn').on("click",function(e){
			e.preventDefault();
			var formData = new FormData($("#edit-form")[0]);
		$.ajax({
			url: "updateProfile",
			type:"POST",
			 
			data:formData,
			contentType: false,
			processData: false
			
			})
		.done(function(result){
				Materialize.toast(result,3000);
			});
		});

  $('#pic').change(function(e) 
	{
		$('.spinner-wrapper').fadeIn('slow');
		e.preventDefault();
		var formData = new FormData($("#pic-form")[0]);
		$.ajax({
			url: "updatepic",
			type:"POST",
			data:formData,
			contentType: false,
			processData: false
			})
		.done(function(result){
				Materialize.toast(result,3000);
				$('.spinner-wrapper').fadeOut('slow');
			});
		});


$(document).ready(function()
{
	$(".homeBtn").removeClass("active");
	$(".profileBtn").addClass('active');
	profileModule.myProfilePosts();
	$('select').material_select();
});


$(".profile-pic").on("error",function(){

		$(this).attr("src","profile_pic/default.png")
});

@endsection