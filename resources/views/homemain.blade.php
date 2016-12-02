@if(!(Auth::check()))
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Our College Own Social Network">
    <meta name="author" content="Saurav-Shashi-Vishul-Aman">

    <title>My College Wall</title>
    <link rel="stylesheet" type="text/css" href="css/new.css">

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

      <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

</head>
<body>

<div class="spinner-wrapper white valign-wrapper" style="position: fixed;top: 0;left: 0;right: 0;bottom: 0;z-index: 999999">
	<div class="preloader-wrapper active" style="margin: auto;">
      <div class="spinner-layer spinner-blue">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-red">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-yellow">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-green">
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

<div class="navbar-fixed">
  <nav class="blue">
    <div class="nav-wrapper">
      <a style="font-size: 24px;" href="{{asset('home')}}" class="brand-logo center">My College Wall</a>
	</div>
  </nav>
</div>

<div class="section valign-wrapper" style="background: url(img/5.jpg) no-repeat center fixed;background-size: cover;height: 95vh">
	<div class="row container">
		<div class="col l4 offset-l4 s12 m12">
			<div id="LoginFormCard" class="card valign z-depth-5"">
				<div class="card-content" style="text-align: center;padding: 0px">
					<span style="font-size: 20px" class="card-title">Login</span>
				</div>
				<div class="card-action" style="padding: 0px 15px 15px 15px;">
					<div class="row" style="margin-bottom: 0px">
					    <form id="LoginForm" role="form" class="col s12" style="text-align: center;">
					      <div class="row" style="margin-bottom: 0px;">
					        <div class="input-field col s12">
					          <input id="usrname" type="text" name="usrname">
					          <label for="usrname">Username</label>
					        </div>
					      </div>
					      <div class="row" style="margin-bottom: 0px;">
					        <div class="input-field col s12">
					          <input id="psswd" type="password" name="psswd">
					          <label for="psswd">Password</label>
					        </div>
					      </div>
					      <div class="row" style="margin-bottom: 0px;">
					        <div class="input-field col s12">
					          <button class="btn waves-effect waves-light" id="LoginFormButton" name="LoginFormButton" type="submit">Login</button>
						          <div id="loginSpinner" class="hide preloader-wrapper small">
									    <div class="spinner-layer spinner-blue-only">
										      <div class="circle-clipper left">
										        <div class="circle"></div>
										      </div>
										     <div class="gap-patch">
										        <div class="circle"></div>
										      </div>
										      <div class="circle-clipper right">
										        <div class="circle"></div>
										      </div>
									    </div>
								  </div>
					        </div>
					      </div>
					      <p style="text-align: center;">Need an account ?<a style="cursor: pointer;margin-right: 0px" onclick="showRegisterForm()"> Sign Up !</a></p>
					    </form>
					 </div>
				</div>
			</div>
			<div id="RegisterFormCard" class="hide card valign z-depth-5">
				<div class="card-content" style="text-align: center;padding: 0px">
					<span style="font-size: 20px" class="card-title">Register</span>
				</div>
				<div class="card-action" style="padding: 0px 15px 15px 15px;">
					<div class="row" style="margin-bottom: 0px">
					    <form id="RegisterForm" role="form" class="col s12" style="text-align: center;">
					      <div class="row" style="margin-bottom: 0px;">
					        <div class="input-field col s6">
					          <input id="fname" type="text" name="fname">
					          <label for="fname">First Name</label>
					        </div>
					        <div class="input-field col s6">
					          <input id="lname" type="text" name="lname">
					          <label for="lname">Last Name</label>
					        </div>
					      </div>
					      <div class="row" style="margin-bottom: 0px;">
					        <div class="input-field col s12">
					          <input id="username" type="text" name="username" class="tooltipped" data-position="top" data-delay="50" data-tooltip="Be Creative ! Be Anonymous ;)">
					          <label for="username">Username</label>
					        </div>
					      </div>
					      <div class="row" style="margin-bottom: 0px;">
					        <div class="input-field col s12">
					          <input id="email" type="text" name="email" class="tooltipped" data-position="top" data-delay="50" data-tooltip="We will verify this :)">
					          <label for="email">Email</label>
					        </div>
					      </div>
					      <div class="row" style="margin-bottom: 0px;">
					        <div class="input-field col s6">
					          <input id="password" type="password" name="password">
					          <label for="password">Password</label>
					        </div>
					        <div class="input-field col s6">
					          <input id="confirmpassword" type="password" name="confirmpassword">
					          <label for="confirmpassword">Confirm Password</label>
					        </div>
					      </div>
					      <div class="row" style="margin-bottom: 0px;">
					        <div class="input-field col s12">
					          <button class="btn waves-effect waves-light"  type="submit" id="RegisterFormButton" name="RegisterFormButton">Register</button>
						          <div id="RegisterSpinner" class="hide preloader-wrapper small">
									    <div class="spinner-layer spinner-blue-only">
									      <div class="circle-clipper left">
									        <div class="circle"></div>
									      </div>
									     <div class="gap-patch">
									        <div class="circle"></div>
									      </div>
									      <div class="circle-clipper right">
									        <div class="circle"></div>
									      </div>
									    </div>
									</div>
					        </div>
					      </div>
					      <p style="text-align: center;">Already Signed Up ?<a style="cursor: pointer;margin-right: 0px" onclick="showLoginForm()"> Log In !</a></p>
					    </form>
					 </div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="section" style="text-align: center;">
	<h4>About Us</h4>
	<div class="row container">
		<div class="col m12 s12 l3" style="text-align: center;margin-bottom: 10px">
			<img src="img/saurav.jpg" class="circle team">
			<h5>Saurav</h5>
			<a href="https://www.facebook.com/saurav.gupta.180410"><i class="fa fa-facebook iconpadding"></i></a>
            <a href="https://www.instagram.com/srv.1195/"><i class="fa fa-instagram iconpadding"></i></a>
            <a href="https://twitter.com/Srv1195"><i class="fa fa-twitter iconpadding"></i></a>
			<h6>He Does Everything.</h6>
		</div>
		<div class="col m12 s12 l3" style="text-align: center;margin-bottom: 10px">
			<img src="img/shashi.jpg" class="circle team" >
			<h5>Shashi</h5>
			<a href="https://www.facebook.com/shashijangra22"><i class="fa fa-facebook iconpadding"></i></a>
            <a href="https://www.instagram.com/shashijangra/"><i class="fa fa-instagram iconpadding"></i></a>
            <a href="https://twitter.com/shashijangra22"><i class="fa fa-twitter iconpadding"></i></a>
			<h6>This Guy Orders All The Time.</h6>
		</div>
		<div class="col m12 s12 l3" style="text-align: center;margin-bottom: 10px">
			<img src="img/vishul.jpg" class="circle team" >
			<h5>Vishul</h5>
			<a href="https://www.facebook.com/vishul.saini"><i class="fa fa-facebook iconpadding" ></i></a>
            <a href="https://www.instagram.com/vishulsaini/"><i class="fa fa-instagram iconpadding"></i></a>
            <a href="#"><i class="fa fa-twitter iconpadding"></i></a>
			<h6>Cries A Lot.</h6>
		</div>
		<div class="col m12 s12 l3" style="text-align: center;margin-bottom: 10px">
			<img src="img/aman.jpg" class="circle team" >
			<h5>Aman</h5>
			<a href="https://www.facebook.com/amanyadav1396"><i class="fa fa-facebook iconpadding"></i></a>
            <a href="https://www.instagram.com/amanyadav1396/"><i class="fa fa-instagram iconpadding"></i></a>
            <a href="https://twitter.com/amanyadav1396"><i class="fa fa-twitter iconpadding"></i></a>
			<h6>Says A Lot Does None.</h6>
		</div>
	</div>
</div>

<footer class="page-footer">
    Made with <i class="fa fa-heart"></i> in Canteen
</footer>
</body>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
<!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

<script type="text/javascript">

$.ajaxSetup(
    {
        headers: 
        {                  
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
$(document).ready(function(){

	jQuery.validator.addMethod("noSpace", function(value, element) { 
  return value.indexOf(" ") < 0 && value != ""; 
}, "No space please and don't leave it empty");


$("#RegisterForm").validate({
	
	invalidHandler: function(event, validator) {
    // 'this' refers to the form
    var errors = validator.numberOfInvalids();

    if (errors) {
    	
      Materialize.toast("you have "+errors+" error(s)", 3000);
    } 
  },
  errorPlacement: function(error, element) {
    
      error.insertAfter("");
     
  },
	rules:
	{
		fname:
		{
			required:true,
			minlength:3,
			noSpace:true,
		},
		lname:
		{
			required:true,
			minlength:3,
			noSpace:true,
		},
		username:
		{
			required:true,
			minlength:3,
			noSpace:true,


		},
		email:
		{
			required:true,
			email:true,
		},
		password:
		{
			required:true,
			minlength:8,
		},
		confirmpassword:
		{
			required:true,
			equalTo:"#password"
		},


	},
	submitHandler: function(event)
	{
            $('#RegisterFormButton').addClass('hide');
            $('#RegisterSpinner').addClass('active');
            $('#RegisterSpinner').removeClass('hide');
            $.ajax({
                url: "register",
                type: "POST",
                data: $("#RegisterForm").serialize()
            })
            .done(function(result)
            {
                if(result=='0')
                {
                    Materialize.toast('Success :) Check your Mailbox !', 3000);
                    $('#RegisterSpinner').removeClass('active');
                    $('#RegisterSpinner').addClass('hide');
                    $('#RegisterFormButton').removeClass('hide');
                }
                else if(result=='1')
                {
                	Materialize.toast('Oopps ! Username already exists.', 3000);
                	$('#RegisterSpinner').removeClass('active');
                	$('#RegisterSpinner').addClass('hide');
                	$('#RegisterFormButton').removeClass('hide');
                }
                else
                {
                	Materialize.toast('Oopps ! Email already exists.', 3000);
                	$('#RegisterSpinner').removeClass('active');
                	$('#RegisterSpinner').addClass('hide');
                	$('#RegisterFormButton').removeClass('hide');
                }
            });
	},
	
});
});


	$(window).load(function() 
	{
		$(".spinner-wrapper").fadeOut("slow");
	});

	function showRegisterForm() {
		$('#LoginFormCard').addClass('hide');
		$('#RegisterFormCard').removeClass('hide');
	}
	function showLoginForm() {
		$('#RegisterFormCard').addClass('hide');
		$('#LoginFormCard').removeClass('hide');
	}

	$("#LoginFormButton").on("click",function(event){
            event.preventDefault();
            $('#LoginFormButton').addClass('hide');
            $('#loginSpinner').addClass('active');
            $('#loginSpinner').removeClass('hide');
            $.ajax({
                url: "login",
                type: "POST",
                data: $("#LoginForm").serialize()
            })
            .done(function(result)
            {
                if(result=='0')
                {
                	Materialize.toast('Yeyy ! You are in.', 3000);
                    window.location.replace('home');
                }
                else if(result=='1')
                {
                	Materialize.toast('No such active account !', 3000);
                	$('#loginSpinner').removeClass('active');
                	$('#loginSpinner').addClass('hide');
                	$('#LoginFormButton').removeClass('hide');
                }
                else
                {
                	Materialize.toast('Both fields are required !', 3000);
                	$('#loginSpinner').removeClass('active');
                	$('#loginSpinner').addClass('hide');
                	$('#LoginFormButton').removeClass('hide');
                }
            });
        });

</script>

</html>

@else 
<script type="text/javascript">
window.location.replace('home');
</script>
@endif