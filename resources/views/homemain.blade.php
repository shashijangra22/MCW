@if(!(Auth::check()))

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Your description here">
    <meta name="author" content="Your Name">
    <title> My College Wall </title>
    <link rel="shortcut icon" href="img/favicon.ico" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<link href="css/style1.css" rel="stylesheet" />
	
    <!-- For more icons -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- BootstrapValidator CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css" rel="stylesheet"/>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top" role=
    navigation>
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-container">
                    <span class="sr-only">Show and Hide the Navigation </span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home">My College Wall
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-container">
                <ul class="nav navbar-nav nav-pills">
                    <li id="home" class="active"><a href="{{asset('home')}}"><i class="fa fa-home"></i> Home</a></li>
                    <li id="contact"><a href="#" onClick="show_mod()"><i class="fa fa-phone"></i> Contact us</a></li>
                <li id="about"><a href="#"><i class="fa fa-book"></i> About </a></li>
                </ul>
                    <form class="navbar-form navbar-default navbar-right" role="form" id="login-form" >
                        <div class="input-group ">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </span>
                            <input type="text" name="username" class="form-control" placeholder="Username"/>
                        </div>
                        
                        <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-lock"></span>
                        </span>
                        <input type="password" name="password" class="form-control" placeholder="Password" />
                        </div>
                    
                        <button class="btn btn-primary" type="submit" id="login" name="login"><i class="fa fa-sign-in"></i> Login</button>
                        <a id="bad-login" href="password/reset" class="btn btn-danger"><i class="fa fa-question"></i></a>
                        <!--div class="row">
                            <div class="col-md-6" id="bad-login"></div>
                            <div class="col-md-6">
                                <a href="password/reset" style="font-size:12px">forget your password?</a>
                            </div>
                        </div-->
                    </form>
            </div>
        </div>
    </nav>

<!-- Modal for Contact Us-->

    <div class="modal modal fade modal-fullscreen modal-transparent" id="contactmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
          <div class="pull-right"><a href="#" onclick="close_mod()"><span class="glyphicon glyphicon-remove"></span></a></div>
            <h4 style="text-align:center">If you have any problems or query then feel free to contact us at: </h4>
            <h5 style="text-align:center" >alppha@gmail.com</h5>
          </div>
        </div>
      </div>
    </div>

<!-- Ajax Loader-->

    <div id="loadingdiv" class="hidden" style="margin:auto; padding: 0px; display: block; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.6;">
        <p style="position: absolute; top: 50%; left: 50%;">
            <img src="img/ajax-loader.gif"/>
        </p>
    </div>

    <div class="container" style="padding-top: 50px;">
        @yield('content')
    </div>

</body>

<!-- jQuery and Bootstrap JS -->
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
    
<!-- BootstrapValidator -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js" type="text/javascript"></script>

<script type="text/javascript">

@yield('jscript')

function show_mod()
{
    $('#contactmodal').modal('show');
    $('#home').removeClass('active');
    $('#contact').addClass('active');
}
function close_mod(){
    $('#contactmodal').modal('hide');
    $('#home').addClass('active');
    $('#contact').removeClass('active');
}

$("#login").on("click",function(event){
        
            event.preventDefault();
            $.ajax({
                url: "login",
                type: "POST",
                data: $("#login-form").serialize()
            })
            .done(function(result){
                if(result=='0')
                {
                 window.location.replace('home');
                }

                else if(result=='1'){
                $("#bad-login").html('incorrect username password')  
                }
                else if(result=='2')
                {
                 $("#bad-login").html('both fields required')   
                }
                else
                {
                 $("#bad-login").html('cannot login')   
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



