
$.ajaxSetup({
		headers: 
		{                  
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
		});


$(window).load(function() 
	{
		$(".spinner-wrapper").fadeOut("slow");
	});





$(".profile-pic").on("error",function(){

		$(this).attr("src","profile_pic/default.png")
	});