$('#post').on("click",function(e){
			
			e.preventDefault();
			$('#post').addClass('hide');
			$('#postspinner').addClass('active');
			var formData = new FormData($("#post-form")[0]);
		$.ajax({
			url: "savedata",
			type:"POST",
			 
			data:formData,
			contentType: false,
			processData: false
			
			})
		.done(function(result){

		$("#post-form")[0].reset();
		var url;
			if(window.location.href.indexOf("home") > -1)
			{
				url='home';
			}
			else if(window.location.href.indexOf("confessions") > -1)
			{
				url='confessions';
			}
			if(result=='0')
			{
				window.location.replace(url);
			}
			else
			{
				alert(result);
				window.location.replace(url);
			}
			});
		
			
		});

/*
LOADMORE POST
using two global variables
post_id
auth_id
*/


$("#loadmore-button").on("click",function(e){
	$(window).off('scroll');
	e.preventDefault();
	$('#loadmore-button').addClass('hide');
	$('#loadmore-spinner').addClass('active');
	$('#loadmore-spinner').removeClass('hide');
	$.ajax({
		type:'POST',
		url:'loadmore',
		data:{pid:post_id},
		dataType:'json'
		
	})
	.done(function(result){
		var days = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
		var month = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
		if(result.length==0)
		{
			Materialize.toast("No More posts to load :)", 2000);
			$('#loadmore-button').remove();
		}
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
			var hours=d.getHours()-12;

			if(hours<0)
				var date=d.getDate()+" "+month[d.getMonth()]+" | "+days[d.getDay()]+" 0"+d.getHours()+":"+d.getMinutes()+" am";
			else
			{
				if(hours==0)
					hours=hours+12;
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
			





			
			$("#loadmore").append(post);
			post_id=result[key].id;
			$('#loadmore-button').removeClass('hide');
		}
		$(".materialboxed").materialbox();
		
		$('#loadmore-spinner').addClass('hide');
		$('#loadmore-spinner').removeClass('active');
		$(window).on('scroll', function(){
   if($(window).scrollTop() + $(window).height() == $(document).height()) {
        $('#loadmore-button').click();
   }
});
		
	});

	

	
});
