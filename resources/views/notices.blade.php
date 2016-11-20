@extends('home1main')

@section('content')
<div class="row">
			
	@if ($user->username=='beerus')
		<div class="col s12 l3">
			<div class="card z-depth-4">
        <div class="card-content pink white-text  " style="padding-top: 5px;padding-bottom: 5px">
          <span class="card-title">Add a Notice!</span>
         </div>
         <div class="card-action pink lighten-5 black-text" style="padding-top:0px;padding-bottom: 10px">
              <form id="post-form" role="form" action="#" enctype="multipart/form-data">
              	{{csrf_field()}}
                  <div class="input-field">
                	<input type="text" name="noticeHeader" id="noticeHeader" placeholder="Notice head goes here..">
                	</div>
                  <div class="input-field">
                  <textarea name="mytext" id="mytext" class="materialize-textarea" placeholder="Notice body goes here..."></textarea>
                </div>
                <div class="row" style="margin: auto">
                  <div class="hide fileUpload btn pink accent-4">Upload
                      <input type="file" accept="image/*" class="upload" name="image" id="image" />
                  </div>
                   <button name="post" id="post" class="right btn pink accent-4"><i class="material-icons">send</i></button>
                   <div id="postspinner" class="preloader-wrapper small right">
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



	@endif

@foreach($notices as $notice)

<div class="col s12 l3">
	<div class="card green white-text">
		<div class="card-content" style="padding-top: 5px;padding-bottom: 10px;text-align: center;">
			<span class="card-title" style="font-size: 20px"><strong>{{$notice->head}}</strong></span>
			<p style="text-align: justify;">{{$notice->data}}</p>
		</div>
	</div>
</div>

@endforeach

</div>

@endsection

@section('jscript')

$(document).ready(function()
{
	$(".homeBtn").removeClass("active");
	$(".noticesBtn").addClass("active");
});

$('#post').on("click",function(e){
			e.preventDefault();
			$('#post').addClass('hide');
			$('#postspinner').addClass('active');
			var formData = new FormData($("#post-form")[0]);
		$.ajax({
			url: "notices",
			type:"POST",
			 
			data:formData,
			contentType: false,
			processData: false
			
			})
		.done(function(result){
		$("#post-form")[0].reset();
			if(result=='0')
			{
				Materialize.toast("Notice added", 3000);
			}
			});
			$('#postspinner').removeClass('active');
			$('#post').removeClass('hide');
			
		});

				
@endsection