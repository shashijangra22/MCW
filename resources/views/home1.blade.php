@extends('home1main')

@section('content')

<div class="row">
	<div class="col m12 s12 l6" id="main-feed" style="padding-left: 5px;padding-right: 5px">
		<div class="row" style="margin-bottom: 0px" id="postFormRow">
			<div class="col s12">
				<div class="card z-depth-5" style="margin-bottom: 5px">
			        <div class="card-content blue white-text" style="text-align: center;padding-top: 0px;padding-bottom: 0px">
			          <span class="card-title" style="font-size: 20px">Welcome {{$user->username}} :)</span>
			         </div>
			         <div class="card-action" style="padding: 0px 10px 10px 10px;">
			              <form role="form" enctype="multipart/form-data">
			              	{{csrf_field()}}
			                  <div class="input-field">
			                <i class="material-icons prefix ">mode_edit</i>
			                  <textarea name="mytext" id="mytext" class="materialize-textarea" placeholder="What are you upto?" style="padding-top: 0px;margin-bottom: 1rem;"></textarea>
			                </div>
			                <div class="row" style="margin: auto">
			                  <div class="fileUpload btn waves-effect waves-light"><i class="material-icons">add_a_photo</i><input type="file" accept="image/*" class="upload" name="image" id="image"/></div>
			                  <input type="hidden" name="type" value="0">
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
			</div>
		</div>
		<div class="row center-align" id="loadmoreRow" style="margin-bottom: 0px">
			<button id="loadmore-button" class="btn">Load More</button>
			<div id="loadmoreSpinner" class="preloader-wrapper small hide active">
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
	<div class="col m12 s12 l6 hide-on-med-and-down">
		<div class="card z-depth-4">
			<div class="card-content blue white-text center-align" style="padding-top: 0px;padding-bottom: 0px"> 
				<span class="card-title" style="font-size: 20px">Upcoming Events</span>
			</div>
			<div class="slider">
			    <ul class="slides">
			      <li>
			        <img src="img/study.jpg" style="filter: brightness(0.40);"> <!-- random image -->
			        <div class="caption center-align">
			          <h5>🤓 Exams 🤓</h5>
			          <h6 class="light grey-text text-lighten-3">📚 24 Nov | Pull your Socks ! 📑</h6>
			        </div>
			      </li>
			      <li>
			        <img src="img/penguins.jpg" style="filter: brightness(0.40);"> <!-- random image -->
			        <div class="caption center-align">
			          <h5>🎅 Christmas Day 🎅</h5>
			          <h6 class="light grey-text text-lighten-3">🍬 25 Dec | Ho Ho Ho :D ❄</h6>
			        </div>
			      </li>
			      <li>
			        <img src="img/party.jpg" style="filter: brightness(0.40);"> <!-- random image -->
			        <div class="caption center-align">
			          <h5>💃 New Year Party 💃</h5>
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
		            <th>Date Added</th>
		          </tr>
		        </thead>
		        <tbody>
		        @foreach($notices as $notice)
		          <tr>
		            <td style="padding-bottom: 5px;"><a style="color: red" href="{{asset('notices')}}">{{$notice->head}}</a></td>
		            <td style="padding-bottom: 5px;">{{date("j M | D H:i",strtotime($notice->created_at))}}</td>
		          </tr>
		          @endforeach
		        </tbody>
	        	</table>
	        	<br>
	     </div>
		</div>
	</div>
</div>

@endsection

@section('jscript')

$(document).ready(function(){
	postModule.getPosts();
      $('.slider').slider({full_width: true});
      $('.slider').height('190');
      $('.slides').height('160');
    });


$(window).on('scroll', function(){
   if($(window).scrollTop() + $(window).height() == $(document).height()) {
        $('#loadmore-button').click();
   }
});

@endsection