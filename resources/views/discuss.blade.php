@extends('home1main')

@section('content')

<div class="row" style="margin-bottom: 0px">
	<div class="col s12" id="discussModule" style="padding-left: 5px;padding-right: 5px">
		<div class="row addTopicRow" style="margin-bottom: 0px">
			<div class="modal modal-fixed-footer">
			<p style="text-align: center;margin-bottom: 0px;margin-top: 0px" class="truncate"></p>
				<div class="modal-content" style="padding-top: 0px">
				    
				</div>
				<div class="modal-footer">
					<div class="row valign-wrapper" style="margin: auto">
		              <div class="col s10 m11" style="padding-left: 0px;padding-right: 0px">
		                <input style="margin-bottom: 0px;text-align: center;" onkeydown = "if (event.keyCode == 13) $('#addThreadBtn').click();" type="text" placeholder="add your thoughts :)">
		              </div>
		              <div class="col s2 m1">
		              	<a style="padding: 0px" id="addThreadBtn"><i class="material-icons" style="font-size: 32px">send</i></a>
		              </div>
			        </div>
			    </div>
			</div>
			<div class="col s12 m4 offset-m4">
				<div class="card hoverable">
					<div class="card-content center-align">
						<div class="input-field">
				            <input id="topic" style="margin-bottom: 0px" class="topic" type="text">
				            <label for="topic" >Start a new topic</label>
				          </div>
					</div>
					<div class="card-action center-align" style="padding: 5px 10px">
						<a class="addBtn btn waves-effect waves-light"><i class="material-icons">add</i></a>
					</div>
				</div>		
			</div>
		</div>
		<div class="row topicsRow">
			<div class="col s12 m4 protoTopic" style="display: none">
				<div class="card hoverable">
					<div class="card-content center-align" style="padding: 5px">
						<span class="card-title truncate" style="font-size: 20px;line-height: 40px"></span>
						<p style="font-size: 13px" class="username"></p>
						<p style="font-size: 12px" class="counter"></p>
					</div>
					<div class="card-action center-align" style="padding: 5px 10px">
						<a class="joinBtn btn waves-effect waves-light">Join</a>
					</div>
				</div>
			</div>
		@foreach ($discussions as $discussion)
			<div class="col s12 m4">
				<div class="card hoverable">
					<div class="card-content center-align" style="padding: 5px 10px">
						<span class="card-title truncate" style="font-size: 20px;line-height: 40px">{{$discussion->topic}}</span>
						<p style="font-size: 13px">By <a href="{{$discussion->user->username}}">{{$discussion->user->username}}</a> | {{date("j M",strtotime($discussion->created_at))}}</p>
						<p style="font-size: 12px">{{$discussion->threads()->count()}} Threads</p>
					</div>
					<div class="card-action center-align" style="padding: 5px 10px">
						<a data-id="{{$discussion->id}}" class="joinBtn btn waves-effect waves-light">Join</a>
					</div>
				</div>
			</div>
		@endforeach
		</div>
	</div>
</div>

@endsection

@section('jscript')

$(document).ready(function()
{
	$(".homeBtn").removeClass("active");
	$(".discussBtn").addClass('active');
});

@endsection