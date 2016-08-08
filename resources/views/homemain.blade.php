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

    <!-- For more icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

	<!-- BootstrapValidator CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css" rel="stylesheet"/>

    <!-- Theme CSS -->
    <link href="css/creative.css" rel="stylesheet">

</head>
<body>
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-container">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="">My College Wall</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-container">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#carousel">Login/Sign-up</i></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">About Us</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact Us</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <div id="carousel" class="carousel slide" data-ride="carousel"  style="width:100%;">
               <ol class="carousel-indicators">
                    <li data-target="#carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel" data-slide-to="1"></li>
                    <li data-target="#carousel" data-slide-to="2"></li>
                </ol> 
        <!-- Items -->
        <div class="carousel-inner" >
            <div class="item active fill">
                <img class="img-responsive carousel-img" src="img/cllg6.jpg" alt="Slide 1"  style="width:100%; height:100%; background:rgba(0,0,0,0.3);" />
            </div>
            <div class="item fill">
                <img class="img-responsive carousel-img" src="img/cllg4.jpg" alt="Slide 2" style="width:100%; height:100%; background:rgb(0,0,0,0.2);"/>
            </div>
            <div class="item fill">
                <img class="img-responsive carousel-img" src="img/cllg3.jpg" alt="Slide 3" style="width:100%; height:100%;"/>
            </div>
        </div>

        <div class="black-tint">
            <div class="row " style="position:absolute; left:15px; right:15px; margin:0 auto; top:30%; ">
                <div class="col-md-4 col-md-offset-4 text-center">
                    
                    <form id="register-form" class="hidden" role="form">
                        <div class="row ">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="fname" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="lname" placeholder="Last Name">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="username" placeholder="Username">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <input class="form-control" type="email" name="email" placeholder="E-mail">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <input class="form-control" type="password" name="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <input class="form-control" type="password" name="confirmpassword" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-xs-8 col-xs-offset-2">
                                <div class="form-group">
                                    <button class="btn btn-sm btn-primary" type="submit">Register <i id="RegisterLoader" class="hidden fa fa-refresh fa-spin fa-fw"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row hidden" id="RegisterErrorRow">
                            <div class="col-xs-8 col-xs-offset-2" style="color:white">
                                <div class="form-group" id="RegisterErrorBox"></div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-xs-8 col-xs-offset-2" style="color:white;font-size:12px">
                                <div class="form-group">
                                    Have an Account ? <a href="#" onclick="show_login();">Login !</a>
                                </div>
                            </div>
                        </div>          
                    </form>

                    <form id="login-form" role="form">
                        <div class="row form-group">
                            <div class="col-xs-8 col-xs-offset-2">
                                <input class="form-control"  type="text" name="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-8 col-xs-offset-2">
                                <input class="form-control"  type="password" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-8 col-xs-offset-2">
                                <button id="login" name="login" class="btn btn-sm btn-primary" type="submit">Login <i id="LoginLoader" class="hidden fa fa-refresh fa-spin fa-fw"></i></button>
                            </div>
                        </div>
                        <div id="LoginErrorRow" class="row form-group hidden">
                            <div class="col-xs-8 col-xs-offset-2" style="color:white">
                                <div id="LoginErrorBox" class="LoginErrorBox"></div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-8 col-xs-offset-2" style="color:white;font-size:12px">
                                Need an Account ? <a href="#" onclick="show_register();">Signup !</a>
                            </div>
                        </div>          
                    </form>            
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

    <section id="about" >
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="section-heading">About Us</h2>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container"  >
            <div class="row">
                <div class="col-md-3  text-center">
                    <div class="team">
                        <img src="img/saurav.jpg" class="img-circle ">
                        <h4>Saurav</h4>
                        <p >he does everything</p>
                        <a href="https://www.facebook.com/saurav.gupta.180410"><i class="fa  fa-facebook padding_right color-black"></i></a>
                        <a href="https://www.instagram.com/srv.1195/"><i class="fa  fa-instagram padding_right color-black"></i></a>
                        <a href="https://twitter.com/Srv1195"><i class="fa fa-twitter padding_right color-black"></i></a>

                    </div>
                </div>
                <div class="col-md-3  text-center">
                    <div class="team">
                        <img src="img/shashi.jpg" class="img-circle">
                        <h4>Shashi</h4>
                        <p >This Guy orders all the time. </p>
                        <a href="https://www.facebook.com/shashijangra22"><i class="fa  fa-facebook padding_right color-black"></i></a>
                        <a href="https://www.instagram.com/shashijangra/"><i class="fa  fa-instagram padding_right color-black"></i></a>
                        <a href="https://twitter.com/shashijangra22"><i class="fa  fa-twitter padding_right color-black"></i></a>

                    </div>
                </div>
                <div class="col-md-3  text-center">
                    <div class="team">
                        <img src="img/vishul.jpg" class="img-circle ">
                        <h4>Vishul</h4>
                        <p >Cries a lot.</p>
                        <a href="https://www.facebook.com/vishul.saini"><i class="fa fa-facebook padding_right color-black" ></i></a>
                        <a href="https://www.instagram.com/vishulsaini/"><i class="fa  fa-instagram padding_right color-black"></i></a>
                        <a href="#"><i class="fa  fa-twitter padding_right color-black"></i></a>

                    </div>
                </div>
                <div class="col-md-3  text-center">
                    <div class="team">
                        <img src="img/aman.jpg" class="img-circle ">
                        <h4>Aman</h4>
                        <p >Says a lot... Does none.</p>
                        <a href="https://www.facebook.com/amanyadav1396"><i class="fa fa-facebook padding_right color-black"></i></a>
                        <a href="https://www.instagram.com/amanyadav1396/"><i class="fa  fa-instagram padding_right color-black"></i></a>
                        <a href="https://twitter.com/amanyadav1396"><i class="fa  fa-twitter padding_right color-black"></i></a>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h2 class="section-heading">Contact Us</h2>
                    <hr class="primary">
                    <p>Have any questions for us or need our assistance. Don't hesitate...leave a message.</p>
                </div>
                
                <div class="col-md-4 col-md-offset-4 text-center">
                    <i class="fa fa-envelope-o fa-3x"></i>
                    <p><a href="mailto:admin@mycollegewall.com">admin@mycollegewall.com</a></p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        Made with <i class="fa fa-heart"></i> in Canteen
    </footer>

</body>

<!-- jQuery and Bootstrap JS -->
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
    
<!-- BootstrapValidator -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js" type="text/javascript"></script>

<!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<!-- Theme JavaScript -->
    <script src="js/creative.min.js"></script>

<script type="text/javascript">
$.ajaxSetup(
    {
        headers: 
        {                  
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
function show_register()
            {
                $("#login-form").addClass("hidden");
                $("#register-form").removeClass("hidden");
            }
            function show_login()
            {
                $("#login-form").removeClass("hidden");
                $("#register-form").addClass("hidden");
            }

$("#login").on("click",function(event){
            event.preventDefault();
            $('#LoginLoader').removeClass('hidden');
            $.ajax({
                url: "login",
                type: "POST",
                data: $("#login-form").serialize()
            })
            .done(function(result)
            {
                if(result=='0')
                {
                    window.location.replace('home');
                }
                else if(result=='1')
                {
                    $("#LoginErrorBox").html('Incorrect Username/Password!');
                    $('#LoginLoader').addClass('hidden');
                    $('#LoginErrorRow').removeClass('hidden');
                }
                else
                {
                    $("#LoginErrorBox").html('Both fields required!');
                    $('#LoginLoader').addClass('hidden');
                    $('#LoginErrorRow').removeClass('hidden');
                }
            });
        });

    $(document).ready(function()
    {
            var validator = $("#register-form").bootstrapValidator({
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

                        username : {
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
                $('#RegisterLoader').removeClass('hidden');
                $.ajax({
                    url: 'register',
                    type: 'POST',
                    data: $("#register-form").serialize()
                })
                .done(function(result) 
                {
                    if(result=='0')
                    {
                        $("#RegisterErrorBox").html('Succesfully Registered :)');
                        $('#RegisterLoader').addClass('hidden');
                        $('#RegisterErrorRow').removeClass('hidden');
                    }
                    else if(result=='1')
                    {
                        $("#RegisterErrorBox").html('Username already exists!');
                        $('#RegisterLoader').addClass('hidden');
                        $('#RegisterErrorRow').removeClass('hidden');
                    }
                    else
                    {
                        $("#RegisterErrorBox").html('E-mail already exists!');
                        $('#RegisterLoader').addClass('hidden');
                        $('#RegisterErrorRow').removeClass('hidden');
                    } 
                });

            });
            

        });
</script>

</html>

@else 
<script type="text/javascript">
window.location.replace('home');
</script>
@endif



