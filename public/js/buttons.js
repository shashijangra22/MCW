

//DETELE BUTTON JS


$(".delButton").on("click",function(event)
{
	event.preventDefault();
	$("#loadingdiv").removeClass("hidden");
	var el=$(this);
	var id=$(this).val();
	
	$.ajax({
	url:'delete/'+id,
	type:'DELETE',

				})
			.done(function(result){

			el.parents(".feed").fadeOut("slow",function(){
				this.remove();
			});

			$("#loadingdiv").addClass("hidden");


			});

				
	});

//LIKE BUTTON JS
$(".likebutton").on("click",function(event)
{
	event.preventDefault();

	 var el=$(this);
	  el.css("pointer-events","none");
	 var pid=$(this).attr('value');
	 var string=$("p[id="+pid+"likes]").html();

  		 $.ajax({
			url: "likepost",
			type:"POST",
			data:{post_id:pid}
			})
		.done(function(result){

			 if(result=='like')
			 {
			 	var count=string.match(/\d/g);
			 	count=++count;
			 	$("p[id="+pid+"likes]").html(count+" likes");
			 	el.children('i').html('favorite');
			}
			else if(result=='unlike')
			{
				var count=string.match(/\d/g);
			 	count=--count;
			 	if(count<0)
					count=0;
			 	$("p[id="+pid+"likes]").html(count+" likes")

			 	el.children('i').html('favorite_border');

			}
			el.css("pointer-events","auto");
			});
});



//COMMENT BUTTON JS

	$(".comment_button").on("click",function(e){
		e.preventDefault();
		var el=$(this);
		var pid=el.data('id');
		var string=$("p[id="+pid+"comments]").html();
	 var comment=$('#'+pid+'commentinput').val().trim();
	  if (comment.length<=0) { return false;}
	  var count=$("p[id="+pid+"comments]").html();
		
	  $.ajax({
	  		url: "savecomment",
	  		type:"POST",
	  		data:{post_id:pid,data:comment}
	  		})
	  	.done(function(result){
	  		if(result==0)
		 	{
		 		var count=string.match(/\d/g);
			 	count=++count;
			 	$("p[id="+pid+"comments]").html(count+" comments");
			 	$("#"+pid+"commentinput").val("");
			}
			});
});

//HAMBURGER JS

	$(document).ready(function() {
          $('.button-collapse').sideNav({
      menuWidth: '100%', // Default is 240
      edge: 'left', // Choose the horizontal origin
      closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
    }
  );
        });

	//CHAT-BUTTON JS

        $(document).ready(function() {
          $('.chat-button').sideNav({
      // menuWidth: '23%', // Default is 240
      edge: 'right', // Choose the horizontal origin
      closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
    }
  );
        });



//SHOW COMMENTS BUTTON
//WORKS ON COMMENTS BADGE

 $(".commentscount").on("click",function(){
	var pid=$(this).data('id');

	$.ajax({
	type:'POST',
	url:'showcomments',
	data:{pid:pid}
})
.done(function(result){
		$('#'+pid+'commentbox').empty();
		if(result.length==0)
		{
			$('#'+pid+'commentbox').append('<div class="row text-center">no comments to show</div>');		
		}
		else
		{
	for(var key in result)
	{
		$('#'+pid+'commentbox').append('<div class="row" style="padding-top: 5px;font-size: 12px;margin:auto"><img src="'+result[key].displaypic+'" class="img-circle profile-pic" width="12" height="12" />	<b>'+result[key].username+'</b> '+result[key].data+'</div>');
	}

	}


});

});