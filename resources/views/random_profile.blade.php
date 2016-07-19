@extends('home1main')

@section('content')

<div class="row jumbotron" style="padding:20px" >
	
	<div class="col-md-4">
	<div class="row">
	<img style="margin-left:20px" src="{{asset($searched_user->displaypic)}}" onError="pic_error()" id="profile-pic" class="img-circle" style=" max-width:100%; max-height:100%;" width="180" height="180"/>
	</div>
	</div>
	<div class="col-md-6 col-md-offset-2">
	<em><h3>{{$searched_user->fname}} {{$searched_user->lname}}</h3></em>
	<!--<h5>{{$user->username}}</h5>
	<h5>{{$user->email}}</h5>-->

	</div>
</div>
@foreach($posts as $post)
	{{--*/$pid=$post->id/*--}}
	<div class="row" >
		<div class="panel panel-default">
		<div class="panel-heading">
		<div class="row">
		<div class="col-md-2">

		<img style="margin-left:5px" src="{{asset($searched_user->displaypic)}}"  class="img-circle profile-pic" style=" max-width:100%; max-height:100%;" width="50" height="50"/>
		</div>
		<div class="col-md-8">
		<div class="row" style="padding:10px"><b><em>
		{{ $post->username}}</em></b>
						
						<br>
						<em>{{$post->created_at}}</em>
		</div>
		</div>
		</div>
		</div>
		
		<div class="panel-body\">
		<div class="row" style="padding:20px;">{{$post->data}}</div>
                 @if($post->path!=NULL)
		<div class="row" style="padding:20px; overflow:hidden"><a class="pop" onclick="pop('{{asset($post->path)}}');" href="#"><img id="imagesource" class="thumbnail" style=" max-width:100%; max-height:404px;" src="{{asset($post->path)}}"/></a></div>
		@endif
                 </div>
		</div>
		</div>

		
		@endforeach
		<div class="row text-center" id='posts'>
			{!!str_replace('/?', '?', $posts->render());!!}
		</div>

@endsection


@section('jscript')

$(document).ready(function(){
	$("#home").removeClass("active");
});


$(".profile-pic").on("error",function(){

		$(this).attr("src","profile_pic/default.png")
	});
	function pic_error(){
	$("#profile-pic").attr("src","profile_pic/default.png")
	}


@endsection