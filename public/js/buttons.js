
//Notify BUTTON JS
$(".notifyBtn").on("click",function(event)
{
	$('.fa-bell').html('');
});



//DETELE BUTTON JS


$(".delButton").on("click",function(event)
{
	event.preventDefault();
	var el=$(this);
	var id=$(this).val();
    $("#"+id+"delspinner").removeClass('fa-trash');
	$("#"+id+"delspinner").addClass('fa-spinner fa-pulse');
	$.ajax({
	url:'delete/'+id,
	type:'DELETE',

				})
			.done(function(result){

			el.parents(".feed").fadeOut("slow",function(){
				this.remove();
			});
			});

				
	});

//LIKE BUTTON JS
$(".likebutton").on("click",function(event)
{
	event.preventDefault();

	 var el=$(this);
	  el.css("pointer-events","none");
	 var pid=$(this).attr('value');
	 var string=$("a[id="+pid+"likes]").html();

  		 $.ajax({
			url: "likepost",
			type:"POST",
			data:{post_id:pid}
			})
		.done(function(result){

			 if(result=='like')
			 {
			 	var count=string.match(/\d/g);
			 	count=Number(count.join(''));
			 	count++;
			 	$("a[id="+pid+"likes]").html(count+" Likes");
			 	el.children('i').html('favorite');
			}
			else if(result=='unlike')
			{
				var count=string.match(/\d/g);
			 	count=Number(count.join(''));
			 	count--;
			 	if(count<0)
					count=0;
			 	$("a[id="+pid+"likes]").html(count+" Likes")

			 	el.children('i').html('favorite_border');

			}
			el.css("pointer-events","auto");
			});
});



//COMMENT BUTTON JS
$('.comment_input').keypress(function (e) {
  if (e.which == 13) {
    var id=$(this).data('id');
	    $("#"+id+"commentbutton").click();
      }
});

	$(".comment_button").on("click",function(e){
		e.preventDefault();
		var el=$(this);
		var pid=el.data('id');
		var string=$("a[id="+pid+"comments]").html();
		var comment=$('#'+pid+'commentinput').val().trim();
		if (comment.length<=0) 
		{
			Materialize.toast('An empty comment! Really? 🤔',2000);
			return false;
		}
		$('#'+pid+'commentinput').prop('disabled',true);
		$('#'+pid+'commentbutton').addClass('hide');
		$('#'+pid+'commentspinner').removeClass('hide');
		$('#'+pid+'commentspinner').addClass('active');
	  $.ajax({
	  		url: "savecomment",
	  		type:"POST",
	  		data:{post_id:pid,data:comment}
	  		})
	  	.done(function(result){
	  		if(result==0)
		 	{
		 		var count=string.match(/\d/g);
			 	count=Number(count.join(''));
			 	count++;
			 	$("a[id="+pid+"comments]").html(count+" Comments");
			 	$("#"+pid+"commentinput").val("");
			 	$('#'+pid+'commentbox').append('<div class="row" style="padding-top: 5px;font-size: 12px;margin:auto"><img src="'+auth_displaypic+'" class="circle profile-pic" width="12" height="12" />	<b>'+auth_username+'</b> '+comment+'</div>');
				$('#'+pid+'commentspinner').addClass('hide');
				$('#'+pid+'commentspinner').removeClass('active');
				$('#'+pid+'commentbutton').removeClass('hide');
			}
				$('#'+pid+'commentinput').prop('disabled',false);
			});
});

//HAMBURGER JS

	$(document).ready(function() {
          $('.button-collapse').sideNav({
      // menuWidth: '100%', // Default is 240
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
      // closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
    }
  );
        });



//SHOW COMMENTS BUTTON
//WORKS ON COMMENTS BADGE

 $(".commentscount").on("click",function(){
	var pid=$(this).data('id');
	if ($('#'+pid+'commentbox').is(':visible')) 
	{
		$('#'+pid+'commentbox').hide('normal');
		return 0;
	}
	$('#'+pid+'spinner').show();
	$.ajax({
	type:'POST',
	url:'showcomments',
	data:{pid:pid}
})
.done(function(result){
		$('#'+pid+'commentbox').empty();
		if(result.length==0)
		{
			Materialize.toast('Oops! No Comments to show :P', 3000);
		}
		else
		{
			$('#'+pid+'likesbox').hide('normal');

			var month = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
			
			for(var key in result)
			{
				var d=new Date(result[key].created_at);
				var hours=d.getHours()%12;
				if (hours==0) {hours=12;}
				var minutes=d.getMinutes();
				if (d.getMinutes()<10) { minutes='0'+minutes;}
				if(hours<10)
					var date=d.getDate()+" "+month[d.getMonth()]+" | 0"+hours+":"+minutes+" am";
				else
				{
					var date=d.getDate()+" "+month[d.getMonth()]+" | "+hours+":"+minutes+" pm";
				}
				$('#'+pid+'commentbox').append('<div class="row" style="padding-top: 2px;font-size: 12px;margin:auto"><img src="'+result[key].displaypic+'" class="circle profile-pic" width="12" height="12" />	<b>'+result[key].username+'</b> '+result[key].data+' <p class="right" style="display:inline;font-size:8px">'+date+'</p></div>');	
			}
		}
		$('#'+pid+'commentbox').show('normal');
		$('#'+pid+'spinner').hide();
});

});


//SHOW Likes BUTTON
//WORKS ON Likes BADGE

 $(".likescount").on("click",function(){
	var pid=$(this).data('id');
	if ($('#'+pid+'likesbox').is(':visible')) 
	{
		$('#'+pid+'likesbox').hide('normal');
		return 0;
	}
	$('#'+pid+'spinner').show();
	$.ajax({
	type:'POST',
	url:'showlikes',
	data:{pid:pid}
})
.done(function(result){
		$('#'+pid+'likesbox').empty();
		if(result.length==0)
		{
			Materialize.toast('Oops! No Likes to show :P', 3000);
		}
		else
		{
			$('#'+pid+'commentbox').hide('normal');
			for(var key in result)
			{
				$('#'+pid+'likesbox').append('<p style="font-size:12px;display:inline"><b> '+result[key].username+',</b></p>');	
			}
		}
		$('#'+pid+'likesbox').show('normal');
		$('#'+pid+'spinner').hide();
});

});


// load a post on notification click

$(".viewStoryBtn").on("click",function(e)
{
	e.preventDefault();
	$(".spinner-wrapper").fadeIn("slow");
	$('#loadpost').empty();
	var nid=$(this).data('id');
	var pid=$(this).data('pid');
	if ($('#'+pid+'likes').offset()) 
	{
		$('html,body').animate({
        scrollTop: $('#'+pid+'likes').offset().top-$('#'+pid+'likes').parent().parent().height()},
        'slow');
		Materialize.toast('Its already on the page ;)',2000);
		$(".spinner-wrapper").fadeOut("slow");
		return false;
	}
	$.ajax({
		type:'POST',
		url:'getpost',
		data:{nid:nid,pid:pid},
		dataType:'json'
		
	})
	.done(function(result)
	{
		if (result==0) 
		{
			Materialize.toast('Oops ! That post does not exist anymore !',2000);
		}
		else
		{
			var days = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
			var month = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
			
			for(var key in result)
			{
				
				var post=$("#prototype").clone(true);
				post.css('display','block');
				post.attr('id',result[key].id);
				var temp=post.find('.protodisplaypic');
				temp.attr('src',result[key].displaypic);
				temp=post.find('.protousername');
				temp.html(result[key].username);
				temp=post.find('.prototimestamp');
				var d=new Date(result[key].created_at);
				var hours=d.getHours()%12;
				if (hours==0) {hours=12;}

				if(hours<10)
					var date=d.getDate()+" "+month[d.getMonth()]+" | "+days[d.getDay()]+" 0"+hours+":"+d.getMinutes()+" am";
				else
				{
					var date=d.getDate()+" "+month[d.getMonth()]+" | "+days[d.getDay()]+" "+hours+":"+d.getMinutes()+" pm";
				}
				temp.html(date);

				if(auth_id==result[key].user_id)
				{
					temp=post.find('.protodelete');
					var button=$("#protodelbutton").clone(true);
					button.css('display','block');
					button.attr('id',"");
					button.attr('value',result[key].id);
					temp.append(button);
					

					
				}
				temp=post.find('.protodata');
				temp.html(result[key].data);

				if(result[key].path!=null)
				{
					temp=post.find('.protoimage');
					temp.css('display','block');
					temp.children('div').children('img').attr('src',result[key].path);
				}

				temp=post.find('#protolikes');
				temp.attr('id',result[key].id+'likes');
				temp.attr('data-id',result[key].id);
				temp.html(result[key].likes+' likes')

				temp=post.find('#protocomments');
				temp.attr('id',result[key].id+'comments');
				temp.attr("data-id",result[key].id);
				temp.html(result[key].comments+' comments')
				temp=post.find('#protocommentbox');
				temp.attr('id',result[key].id+'commentbox');
				temp=post.find('#protolikesbox');
				temp.attr('id',result[key].id+'likesbox');
				temp=post.find('#protocommentinput');
				temp.attr('id',result[key].id+'commentinput');
				
				temp.attr('data-id',result[key].id);
				temp=post.find('#protospinner');
				temp.attr('id',result[key].id+'spinner');
				temp=post.find('#protocommentspinner');
				temp.attr('id',result[key].id+'commentspinner');
				temp=post.find('.comment_button');
				temp.attr("id",result[key].id+"commentbutton");
				temp.attr('data-id',result[key].id);
				temp=post.find('.likebutton');
				temp.attr('value',result[key].id);
				if(result[key].like_id!=null)
				temp.children('i').html('favorite');
				else
				temp.children('i').html('favorite_border');
				temp=post.find('.commentscount');
				temp.attr("data-id",result[key].id);
				temp.attr("id",result[key].id+"comments");
				temp.html(result[key].comments+' comments');
				temp=post.find('.likecount');
				temp.attr("data-id",result[key].id);
				temp.attr("id",result[key].id+"likes");
				temp.html(result[key].likes+' likes');
				
				$("#loadpost").append(post);
				$('#modal1').modal('open');
			}
			$(".materialboxed").materialbox();
			
		}
	});
	$(".spinner-wrapper").fadeOut("slow");
});