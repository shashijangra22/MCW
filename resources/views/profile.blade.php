@extends('home1main')

@section('content')
<?php 
	function yr($value)
	{
		switch ($value) 
			{
				case '1':
					return "I";
					break;
				
				case '2':
					return "II";
					break;
				
				case '3':
					return "III";
					break;
				
				case '4':
					return "IV";
					break;
			}
	}
	function dpmt($value)
	{
		switch ($value) 
			{
				case '1':
					return "CS";
					break;
				
				case '2':
					return "BMS";
					break;
				
				case '3':
					return "Instru";
					break;
				
				case '4':
					return "Physics";
					break;
				case '5':
					return "Poly";
					break;
				
				case '2':
					return "Micro";
					break;
				
				case '3':
					return "FT";
					break;
				
				case '4':
					return "Electro";
					break;
			}	
	}
	function myposts($value)
	{
		return ($value==null)?0:$value->count();
	}
?>
<div class="row">
<div class="col-md-6 col-md-offset-3">

	<div class="row">
		<div class="col-md-4 col-sm-4 col-xs-4 text-center">
			<div id="profile_img">
				<input type="image" onclick="upload();" src="{{$user->displaypic}}" onError="pic_error()" id="profile-pic" class="img-circle img-responsive profile-pic" />
			</div>
			<div>
				<form id="pic-form" role="form" enctype="multipart/form-data" action="#">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="file" accept="image/*" class="hidden" name="pic" id="pic"/>
				</form>	
			</div>
		</div>
		<div class="col-md-7 col-sm-7 col-xs-7 col-md-offset-1">
			<div id="profile-details">
				<div id="user-details">
					<h3>{{$user->username}} <a href="{{asset('settings')}}" class="btn btn-sm btn-primary "><span class="glyphicon glyphicon-cog"></span></a></h3>
					@if ($user->gender==1)
						<h4>{{$user->fname}} {{$user->lname}} <i class="fa fa-mars"></i></h4>
					@else
						<h4>{{$user->fname}} {{$user->lname}} <i class="fa fa-venus"></i></h4>
					@endif
					<h5>{{$user->email}}</h5>
					<h5>{{dpmt($user->department)}} - {{yr($user->year)}} - {{myposts($user->posts)}} Posts</h5>
				</div>
			</div>
		</div>
	</div>
	<br>

	@foreach($posts as $post)
		<div class="row feed">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-2">
								<img src="{{$user->displaypic}}" class="img-circle profile-pic" width="35" height="35"/>	
							</div>
							<div class="col-xs-3 col-xs-offset-1">
								<div class="row">{{$post->user->username}}</div>
								<div class="row">{{$post->created_at}}</div>
							</div>
							<div class="col-xs-2 col-xs-offset-4">
								<button class=" btn btn-sm btn-danger pull-right delButton" type="button" id="delButton" value="{{$post->id}}" >
									<span class="glyphicon glyphicon-trash"/>
								</button>
							</div>
						</div>	
					</div>
					<div class="panel-body">
						<div class="row" style="margin:auto">
							{{$post->data}}
						</div>
		               	@if($post->path!=NULL)
		               		<br>  
							<div class="row" style="overflow:hidden; margin:auto">
								<a class="pop" onclick="pop('{{$post->path}}');" href="#">
									<img id="imagesource" class="thumbnail img-responsive" src="{{$post->path}}"/>
								</a>
							</div>
						@endif
					</div>
					<div class="panel-footer">
					<div class="row" id="mydiv" style="margin:auto">
					{{--*/$flag=0/*--}}
					@foreach ($likes as $like)
						@if ($post->id==$like->post_id)
							{{--*/$flag=$like->id/*--}}
							@break
						@endif							
					@endforeach
						@if ($flag==0)
							<a onclick="setlike('{{$user->id}}','{{$post->id}}','0');" href="#"><i id="likebutton" class="fa fa-heart-o"></i></a>
						@else
							<a onclick="setlike('{{$user->id}}','{{$post->id}}','{{$flag}}');" href="#"><i id="unlikebutton" class="fa fa-heart"></i></a>
						@endif
						{{$post->likes()->count()}}
					</div>
				</div>
				</div>
			</div>
		</div>
	@endforeach
		<div class="row text-center" id='posts'>
			{!!str_replace('/?', '?', $posts->render());!!}
		</div>
</div>
</div>
@endsection

@section('jscript')

function upload() 
{
    $("input[id='pic']").click();
};

$('#pic').change(function() {
  $('#pic-form').submit();
});


	$.ajaxSetup(
	{
		headers: 
		{                  
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$(document).ready(
	function(e)
	{
	var validator=$("#pic-form").bootstrapValidator({
			
			fields: 
			{
				pic : 
				{
					validators : 
					{
						file : 
						{
							type :'image/jpeg,image/png,image/gif',
							message:'only image file can be uploaded'
							}
						}
					}
				}
			
		})		
		.on("success.form.bv",function(e){
			e.preventDefault();
			$("#loadingdiv").removeClass("hidden");
			var id={{$user->id}};
			var formData = new FormData($("#pic-form")[0]);

		$.ajax({
			url: "updatepic/"+id,
			type:"POST",
			 
			data:formData,
			contentType: false,
			processData: false
			
			})
		.done(function(result){
		if(result==0)
		
			$("#profile_img").load(window.location + " #profile-pic");			
			});
			$("#loadingdiv").addClass("hidden");
		
			
		});
		
	
	});


$(document).ready(function()
{
	$("#home").removeClass("active");
});


$(".profile-pic").on("error",function(){

		$(this).attr("src","profile_pic/default.png")
});

function pic_error()
{
	$("#profile-pic").attr("src","profile_pic/default.png")
}

@endsection