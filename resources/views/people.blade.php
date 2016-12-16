@extends('home1main')

@section('content')
<div class="row">
	<div id="peopleModule" class="col s12" style="padding-left: 5px;padding-right: 5px">
		    	<div class="row valign-wrapper" id="searchRow" style="margin:0px 10vw">
		    		<div class="col s10">
		    			<input onkeydown = "if (event.keyCode == 13)
                        $('#searchBtn').click()" id="searchInput" style="text-align: center;margin-bottom: 0px" type="text" name="searchInput" placeholder="Search among {{$totalUsers}} users">
		    		</div>
		    		<div class="col s2">
		    			<button id="searchBtn" style="padding: 0px 10px" class="btn right"><i class="fa fa-search"></i></button>
		    			<div id="searchLoader" class="right hide preloader-wrapper small active">
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
	    		<div class="row" id="searchResult" style="margin-bottom: 0px">
	    		</div>
		    	<div class="row" id="cardsRow" style="margin-bottom: 10px">
		    		<div class="col s12 m3" id="protoUser" style="display: none">
		    			<div class="card hoverable">
		    				<div class="card-content" style="text-align: center;padding: 10px">
			    				<img style="width: 100px;height: 100px" class="circle">
								<hr>
			    				<span class="card-title" style="line-height: 28px;font-size: 14px"><a></a>
			    				</span>
			    				<p style="font-size: 10px"></p>
		    				</div>
		    			</div>
		    		</div>
		    	</div>
		    	<div class="row center-align" id="loadMore" style="margin-bottom: 0px">
		    		<button class="btn waves-effect waves-light">Load More</button>
		    		<div id="loader" class="hide preloader-wrapper small active">
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
</div>

@endsection

@section('jscript')
	
$(document).ready(function()
{
	peopleModule.getPeople();
	$(".homeBtn").removeClass("active");
	$(".peopleBtn").addClass('active');
});

@endsection