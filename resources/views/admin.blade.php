@extends('home1main')

@section('content')
		<div class="row">
		    <div class="col s12">
		      <ul class="tabs">
		        <li class="tab col s3"><a href="#userModule">Users</a></li>
		        <li class="tab col s3"><a href="#postModule">Posts</a></li>
		        <li class="tab col s3"><a href="#commentModule">Comments</a></li>
		        <li class="tab col s3"><a href="#questionModule">Questions</a></li>
		      </ul>
		    </div>
		    <div id="userModule" class="col s12" style="padding-left: 5px;padding-right: 5px">
		    	<div class="row valign-wrapper" id="searchRow" style="margin:0px 10vw">
		    		<div class="col s10">
		    			<input onkeydown = "if (event.keyCode == 13)
                        $('#searchBtn').click()" id="searchInput" style="text-align: center;margin-bottom: 0px" type="text" name="searchInput" placeholder="Enter username">

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
		    	<div class="row" id="cardsRow" style="margin-bottom: 0px">
		    		<div class="col s12 l3" id="protoUser" style="display: none">
		    			<div class="card hoverable">
		    				<div class="card-content" style="font-size: 10px;padding: 0px 10px 10px 10px">
			    				<span style="font-size: 12px" class="card-title username"></span>
			    				<span class="card-title right">
		    					<div class="switch"><label><input type="checkbox" data-id=""><span class="lever" style="margin: 0px"></span></label>
							  </div>
		    				</span>
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
	    	<div id="postModule" class="col s12" style="padding-left: 5px; padding-right: 5px">
	    		<div class="row" id="postsRow" style="margin-bottom: 0px">
	    			<div class="col s12 l4" id="protoPost" style="display: none">
	    				<div class="card hoverable">
	    					<div class="card-content" style="font-size: 10px;padding: 0px 10px 10px 10px">
	    						<span style="font-size: 14px" class="card-title counter"></span>
		    						<span class="card-title right"><i data-id="" style="font-size: 20px;padding:0px 10px" class="btn waves-effect waves-light fa fa-trash"></i></span>
	    					</div>
	    				</div>
	    			</div>
	    		</div>
	    		<div class="row center-align" id="loadMorePosts" style="margin-bottom: 0px">
	    			<button class="btn waves-effect waves-light">Load More</button>
	    			<div id="postLoader" class="hide preloader-wrapper small active">
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
	    	<div id="commentModule" class="col s12" style="padding-left: 5px; padding-right: 5px">
	    		<div class="row" id="commentsRow" style="margin-bottom: 0px">
	    			<div class="col s12 l3" id="protoComment" style="display: none">
	    				<div class="card hoverable">
	    					<div class="card-content" style="font-size: 10px;padding: 0px 10px 10px 10px">
	    						<span style="font-size: 14px" class="card-title counter"></span>
		    						<span class="card-title right"><i data-id="" style="font-size: 20px;padding:0px 10px" class="btn waves-effect waves-light fa fa-trash"></i></span>
	    					</div>
	    				</div>
	    			</div>
	    		</div>
	    		<div class="row center-align" id="loadMoreComments" style="margin-bottom: 0px">
	    			<button class="btn waves-effect waves-light">Load More</button>
	    			<div id="commentLoader" class="hide preloader-wrapper small active">
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
	    	<div id="questionModule" class="col s12" style="padding-left: 5px; padding-right: 5px">
	    		<div class="row" id="formsRow" style="margin-bottom: 0px">
	    			<div class="col s12 l4 offset-l2">
				    	<div class="card hoverable">
				    		<div class="card-content" style="text-align: center;padding: 0px">
				    			 <span class="card-title" style="font-size: 18px">Add A Question</span>
				    		</div>
							<div class="card-action" style="padding: 10px">
								<form id="addForm" role="form" enctype="multipart/form-data">
				              	{{csrf_field()}}
				                  <div class="row" style="margin: auto;">
				                  	<input placeholder="Question goes here..." type="text" id="qBox" name="qBox">
				                  	<input placeholder="Answer goes here..." type="text" id="answerBox" name="answerBox">
				                  </div>
				                  <div class="row" style="margin: auto;">
				                  	<div class="fileUpload btn waves-effect waves-light left"><i class="material-icons">add</i>
					                      <input type="file" accept="image/*" class="upload" name="image" id="image" />
					                  </div>
				               		<a class="addBtn right btn waves-effect waves-light"><i class="material-icons">send</i></a>
				                  </div>
			           			</form>
							</div>
						</div>
					</div>
					<div class="col s12 l4">
				    	<div class="card hoverable">
				    		<div class="card-content" style="text-align: center;padding: 0px">
				    			 <span class="card-title" style="font-size: 18px">Update hint</span>
				    		</div>
							<div class="card-action" style="padding: 10px">
								<form id="hintForm" role="form">
				              	{{csrf_field()}}
				                  <div class="row" style="margin: auto;">
				                  	<input placeholder="question id..." type="text" id="questionid" name="questionid">
				                  	<input placeholder="new hint..." type="text" id="hint" name="hint">
				                  </div>
				                  <div class="row" style="margin: auto;">
				               		<a class="right btn hintBtn waves-effect waves-light"><i class="material-icons">send</i></a>
				                  </div>
			           			</form>
							</div>
						</div>
					</div>
	    		</div>
	    		<div class="row" id="questionsRow" style="margin-bottom: 0px">
	    			<div class="col s12 l3" id="protoQuestion" style="display: none">
	    				<div class="card hoverable">
	    					<div class="card-content" style="font-size: 10px;padding: 0px 10px 10px 10px">
	    						<span style="font-size: 14px" class="card-title counter"></span>
	    					</div>
	    				</div>
	    			</div>
	    		</div>
	    		<div class="row center-align" id="loadMoreQuestions" style="margin-bottom: 0px">
	    			<button class="btn waves-effect waves-light">Load More</button>
	    			<div id="questionLoader" class="hide preloader-wrapper small active">
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
		  </div>
@endsection

@section('JSwithTags')
	<script type="text/javascript" src="js/admin.js"></script>
@endsection