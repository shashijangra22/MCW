@extends('home1main')

@section('content')

<div class="row" style="margin-bottom: 0px">
	<div class="col s12" id="discussModule" style="padding-left: 5px;padding-right: 5px">
		<div class="row addTopicRow">
			<div class="modal modal-fixed-footer">
				<div class="modal-content">
				    
				</div>
				<div class="modal-footer">
					<div class="row valign-wrapper" style="margin: auto">
		              <div class="col s10 m10" style="padding-left: 0px;padding-right: 0px">
		                <input style="margin-bottom: 0px;" onkeydown = "if (event.keyCode == 13) $('#addThreadBtn').click();" type="text" placeholder="Enter your message :)">
		              </div>
		              <div class="col s2 m2">
		              	<a style="padding: 0px" id="addThreadBtn"><i class="material-icons" style="font-size: 32px">send</i></a>
		              </div>
			        </div>
			    </div>
			</div>
			<div class="col s12 m4 offset-m4">
				<div class="card">
					<div class="card-content center-align">
						<div class="input-field">
				            <input style="margin-bottom: 0px" class="topic" type="text">
				            <label for="topic" >Start a new topic</label>
				          </div>
					</div>
					<div class="card-action center-align">
						<a class="addBtn btn waves-effect waves-light"><i class="material-icons">add</i></a>
					</div>
				</div>		
			</div>
		</div>
		<div class="row topicsRow">
			<div class="col s12 m4 protoTopic" style="display: none">
				<div class="card">
					<div class="card-content center-align">
						<span class="card-title"></span>
						<p class="username"></p>
						<p class="counter"></p>
					</div>
					<div class="card-action center-align">
						<a class="joinBtn btn waves-effect waves-light">Join</a>
					</div>
				</div>
			</div>
		@foreach ($discussions as $discussion)
			<div class="col s12 m4">
				<div class="card">
					<div class="card-content center-align">
						<span class="card-title">{{$discussion->topic}}</span>
						<p>By {{$discussion->user->username}}</p>
						<p>{{$discussion->threads()->count()}} Threads</p>
					</div>
					<div class="card-action center-align">
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

@endsection