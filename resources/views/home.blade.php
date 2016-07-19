@extends('homemain')

@section('content')
		<div class="row">
			<div class="column col-md-6 ">
				<div id="carousel" class="carousel slide" data-ride="carousel">
    <!-- Menu -->
    <ol class="carousel-indicators">
        <li data-target="#carousel" data-slide-to="0" class="active"></li>
        <li data-target="#carousel" data-slide-to="1"></li>
        <li data-target="#carousel" data-slide-to="2"></li>
    </ol>
    
    <!-- Items -->
    <div class="carousel-inner">
        
        <div class="item active">
            <img src="img/cllg.jpg" alt="Slide 1"  style="width:100%" />
            <div class="carousel-caption">
            
					    <p style="font-family: Impact, Charcoal, sans-serif; font-size:15px;"> 
					    	Everything at one place
					    </p>
            </div>
        </div>
        <div class="item ">
            <img src="img/cllg1.jpg" alt="Slide 2" style="width:100% height:100%;"/>
       
        </div>
        <div class="item">
            <img src="img/cllg2.jpg" alt="Slide 3" style="width:100% "/>
             <div class="carousel-caption">
            
					    <p style="font-family: Impact, Charcoal, sans-serif; font-size:15px;"> 
					    	Connect with your college friends on the college social network
					    </p>
            </div>
        </div>
    </div> 
    <a href="#carousel" class="left carousel-control" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a href="#carousel" class="right carousel-control" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>
			</div>

			<div class="column col-md-6">
				<div class="panel panel-default panel-custom">
					<div class="panel-heading"> Registration </div>
					<div class="panel-body">
						<form id="registration-form" role="form" action="#">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="fname">First Name: </label>
										<input class="form-control" type="text" name="fname" id="fname" placeholder="First Name">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="lname">Last Name: </label>
										<input class="form-control" type="text" name="lname" id="lname" placeholder="Last Name">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="column col-md-6">
									<div class="form-group">
										<label class="control-lable" for="department" > Department: </label>
										<select id="department" name="department" class="form-control">
											<option value="0">---Select---</option>
											<option value="1">Computer Science</option>
											<option value="2">Bio medical science</option>
											<option value="3">Instrumentaion</option>	
											<option value="4">Physics</option>
											<option value="5">Polymer science</option>
											<option value="6">Microbiology</option>
											<option value="7">Food technology</option>
											<option value="8">Electronics</option>
										</select>
									</div>
								</div>

								<div class="column col-md-6">
									<div class="form-group">
										<label class="control-label" for="year"> Year: </label>
										<select id="year" name="year" class="form-control">
											<option value="0">---Select---</option>
											<option value="1">First</option>
											<option value="2">Second</option>
											<option value="3">Third</option>
											<option value="4">Fourth</option>
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="column col-md-6">
									<div class="form-group">
										<label class="control-label" for="gender"> Gender: </label>
										<select id="gender" name="gender" class="form-control">
											<option value="0">---Select---</option>
											<option value="1">Male</option>
											<option value="2">Female</option>
											<option value="3">Others :P</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="username">Username: </label>
										<input class="form-control" type="text" name="username" id="username" placeholder="Username">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="column col-md-12">
									<div class="form-group">
										<label class="control-label" for="email">E-mail:</label>
										<input type="text" class="form-control" id="email" placeholder="Email Address" name="email"/>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="column col-md-6">
									<div class="form-group">
										<label class="control-label" for="password"> Password:</label>
										<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off">
									</div>
								</div>

								<div class="column col-md-6">
									<div class="form-group">
										<label class="control-label" for="confirmpassword"> Confirm Password:</label>
										<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Re-enter Password" autocomplete="off">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="column col-md-12">
									<button class=" btn btn-success" id="submit" type="submit" name="submit">Register</button>
									<div id="test"></div>
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
			var validator = $("#registration-form").bootstrapValidator({
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
						
						department : {
							validators : {
								greaterThan : {
									value : 1,
									message : "choose one department"
								}
							}
						},
						
						year : {
							validators : {
								greaterThan : {
									value : 1,
									message : "select your current year"
								}
							}
						},
						
						gender : {
							validators : {
								greaterThan : {
									value : 1,
									message : "Select one"
								}
							}
						},


						email :{
							message : "Email address is required",
							validators : {
								notEmpty : {
									message : "Please provide an email address"
								}, 
								
								emailAddress: {
									message: "invalid email address"
								}
							}
						},

						password: {
							validators: {
								notEmpty: {
									message: "password is required"
								},

								stringLength: {
									min: 8,
									message : "password must be atleast 8 characters long"
								},

								different : {
									field: "email",
									message: "Email and password can't match"
								}
							}
						},

						confirmpassword:{
							validators: {
								notEmpty: {
									message: "This field is required."
								},

								identical : {
									field: "password",
									message: "password and confirmation must match"
								}
							}

						}

				}

			});

			validator.on('success.form.bv', function(event){
				event.preventDefault();
				$("#loadingdiv").removeClass("hidden");
				
				$.ajax({
				    url: 'register',
				    type: 'POST',
				    data: $("#registration-form").serialize()
				})
				.done(function(result) {
					$("#test").html(result)
					$("#loadingdiv").addClass("hidden"); 
				});

			});
			

		});
@endsection