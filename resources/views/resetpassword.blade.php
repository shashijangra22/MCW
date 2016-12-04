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

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

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

<div class="section valign-wrapper" style="background: url({{asset('img/5.jpg')}}) no-repeat center fixed;background-size: cover;height: 95vh">
	<div class="row container">
		<div class="col l4 offset-l4 s12 m12">
			<div id="ResetPasswordFormCard" class="card valign z-depth-5">
				<div class="card-content" style="text-align: center;padding: 0px">
					<span style="font-size: 20px" class="card-title">Reset your Password</span>
				</div>
				<div class="card-action" style="padding: 0px 15px 15px 15px;">
					<div class="row" style="margin-bottom: 0px">
						<form id="ResetPasswordForm" role="form" class="col s12" style="text-align: center;">
							<input type="hidden" name="verifytoken" value="{{$user->verifytoken}}">
              <div class="row" style="margin-bottom: 0px">
								<div class="input-field col s12">
									<input type="password" name="newpass" id="newpass">
									<label for="newpass">New Password</label>
								</div>
							</div>
							<div class="row" style="margin-bottom: 0px">
								<div class="input-field col s12">
									<input type="password" name="cnewpass" id="cnewpass">
									<label for="cnewpass">Confirm Password</label>
								</div>
							</div>
							<div class="row" style="margin-bottom: 0px">
								<div class="input-field col s12">
									<button class="btn waves-effect waves-light" id="ResetPasswordFormButton" name="ResetPasswordFormButton" type="submit">Submit</button>
									<div id="submitSpinner" class="hide preloader-wrapper small">
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
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</body>

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
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

	$(window).load(function() 
	{
		$(".spinner-wrapper").fadeOut("slow");
	});


	$("#ResetPasswordFormButton").on("click",function(event){
            event.preventDefault();
            $('#ResetPasswordFormButton').addClass('hide');
            $('#submitSpinner').addClass('active');
            $('#submitSpinner').removeClass('hide');
            $.ajax({
                url: "../resetpass",
                type: "POST",
                data: $("#ResetPasswordForm").serialize()
            })
            .done(function(result)
            {
                if(result==0)
                {
                	Materialize.toast('Success! Redirecting...', 3000);
                    window.location.replace('../login');
                }
                else
                {
                	Materialize.toast('No such account !', 3000);
                	$('#submitSpinner').removeClass('active');
                	$('#submitSpinner').addClass('hide');
                	$('#ResetPasswordFormButton').removeClass('hide');
                }
            });
        });
</script>
</html>