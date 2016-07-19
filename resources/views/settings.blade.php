@extends('home1main')

@section('content')
<div class="row">
<div class="col-md-6 col-md-offset-3">
	<div class="panel panel-default">
		<div class="panel-heading text-center">
			Edit Profile
		</div>
		<div class="panel-body">
			<form id="update-profile" role="form" action="#">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="fname">First Name: </label>
							<input class="form-control" type="text" name="fname" id="fname" placeholder="First Name" value="{{$user->fname}}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="lname">Last Name: </label>
							<input class="form-control" type="text" name="lname" id="lname" placeholder="Last Name" value="{{$user->lname}}">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="column col-md-6">
						<div class="form-group">
							<label class="control-label" for="contact">Phone:</label>
							<input type="number" class="form-control" id="contact" name="contact" placeholder="Phone No." value="{{$user->contact}}"/>
						</div>
					</div>
					<div class="column col-md-6">
						<div class="form-group">
							<label class="control-label" for="dob">Date of Birth:</label>
							<input type="date" class="form-control" id="dob" name="dob" value="{{$user->dob}}"/>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="column col-md-2 col-sm-2 col-xs-2">
						<button class=" btn btn-primary" id="submit" type="submit" name="submit">Update</button>
					</div>
					<div class="col-md-10 col-sm-10 col-xs-10 hidden" id="check">
						<h5><i class="fa fa-check"> Profile Successfully Updated</i></h5>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
@endsection


@section('jscript')

	$.ajaxSetup(
	{
		headers: 
		{                  
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

$(document).ready(function()
{
	$("#home").removeClass("active");
});


$(document).ready(function(e){
		
		var validator=$("#update-profile").bootstrapValidator({
			live: 'enabled',
				feedbackIcons: {
          			  	valid: 'glyphicon glyphicon-ok',
            			invalid: 'glyphicon glyphicon-remove',
            			validating: 'glyphicon glyphicon-refresh'
        		},
			fields: {

				fname : {
								message: "this field is required",
								validators : {
									notEmpty : {
										message : "this field is required"
									},
								stringLength: { 
									max: 20,
									message: "this field cannot be larger than 20 characters"
								}
							}
						},
						
						lname : {
							message : "This field is required",
							validators : {
								notEmpty : {
									message : "this field is required"
								},
								stringLength: { 
									max: 20,
									message: "this field cannot be larger than 20 characters"
							
								}
							}
						},

				contact : {
					validators : {
						phone : {
							country: 'US',
							message:'enter a 10 dig mobile number'
						}
					}
				},
				dob : {

					validators : {
						date : {
							format: 'DD/MM/YYYY',
							max : '2001-01-01',
							message : 'enter correct date of birth'
						}

						}
					}
				}
		})		
		.on("success.form.bv",function(e){

			e.preventDefault();
			$.ajax({
				url: "updateprofile",
				type:"POST",
				
				data: $("#update-profile").serialize()
			})
			.done(function(result){
				if(result==0)
				{
					$("#check").removeClass("hidden");
				}			
			});
			
		});
		
	
	});




@endsection