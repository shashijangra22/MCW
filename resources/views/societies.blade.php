@extends('home1main')

@section('content')

<div class="row">
	<div class="col m12 s12 l12">
		 <div class="row">
		    <div class="col s12">
		      <ul class="tabs">
		        <li class="tab col s3 active"><a href="#test1">Dance</a></li>
		        <li class="tab col s3 disabled"><a href="#test2">Drama</a></li>
		        <li class="tab col s3 disabled"><a href="#test3">Music</a></li>
		        <li class="tab col s3 disabled"><a href="#test4">Misc</a></li>
		      </ul>
		    </div>
		    <div id="test1" class="col s12">
		    	<div class="row" style="margin-bottom: 0px">
		    		<div class="col s12">
		            <div class="card">
		                <div class="card-image waves-effect waves-block waves-light">
		                    <img src="http://demo.geekslabs.com/materialize/v2.1/layout03/images/user-profile-bg.jpg" alt="user background" style="max-height: 300px">
		                </div>
		            </div>
		    		</div>
		    	</div>
	            <div class="row">
	            	<div class="col l4">
	            		<div class="card">
		                  <div class="card-content" style="padding-top: 10px;padding-bottom: 10px">
		                    <span class="card-title">
		                    About Us
			                    <a class="right" href="https://www.facebook.com/pg/rage.bcas"><i class="fa fa-facebook"></i></a>
					            <a style="padding-right: 10px" class="right" href="https://www.instagram.com/rage_western_dance_soc_bcas/"><i class="fa fa-instagram"></i></a>
				            </span>
		                    <blockquote style="text-align: justify;margin-top: 10px;margin-bottom:10px ">Great dancers are not great because of their technique, they are great because of their passion. 
just GET UP AND DANCE :D</blockquote>
		                  </div>                
		                </div>
	            	</div>
	            	<div class="col s12 m12 l8">
	            		<div class="row">
						    <div class="col s12">
						      <ul class="tabs">
						        <li class="tab col s4 disabled"><a href="#dancePosts">Posts</a></li>
						        <li class="tab col s4 disabled"><a href="#dancePhotos">Photos</a></li>
						        <li class="tab col s4 active"><a href="#danceVideos">Videos</a></li>
						      </ul>
						    </div>
						    <div id="dancePosts" class="col s12">
						    	@for ($i=0; $i < 5; $i++)
						    	<div class="card light-blue">
				                  <div class="card-content white-text">
				                    <span class="card-title">About Me!</span>
				                    <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
				                  </div>                
				                </div>
				                @endfor
						    </div>
						    <div id="dancePhotos" class="col s12">
						    	@for ($i=0; $i < 5; $i++)
						    	<div class="card">
				                  <div class="card-image">
				                  	<img src="http://demo.geekslabs.com/materialize/v2.1/layout03/images/user-profile-bg.jpg">
				                  </div> 
				                </div>
				                @endfor
						    </div>
						    <div id="danceVideos" class="col s12">
						    	<div class="card">
				                  <div class="card-image">
				                  	<div class="video-container no-controls">
			                            <iframe src="https://www.youtube.com/embed/Q2NK6Vmv6vo" frameborder="0" allowfullscreen></iframe>
			                        </div>
				                  </div> 
				                </div>
				                <div class="card">
				                  <div class="card-image">
				                  	<div class="video-container no-controls">
			                            <iframe src="https://www.youtube.com/embed/aHJ7dfatyg0" frameborder="0" allowfullscreen></iframe>
			                        </div>
				                  </div> 
				                </div>
						    </div>
						  </div>
	            	</div>
	            </div>
		    </div>
		    <div id="test2" class="col s12">Test 2</div>
		    <div id="test3" class="col s12">Test 3</div>
		    <div id="test4" class="col s12">Test 4</div>
		  </div>
	</div>
</div>

@endsection

@section('jscript')

$(document).ready(function()
{
	$(".homeBtn").removeClass("active");
	$(".societiesBtn").addClass('active');
});

@endsection