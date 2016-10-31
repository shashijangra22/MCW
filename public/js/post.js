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
	e.preventDefault();
	$('#loadmore-button').addClass('hide');
	$('#loadmore-spinner').addClass('active');
	$.ajax({
		type:'POST',
		url:'loadmore',
		data:{pid:post_id},
		dataType:'json'
		
	})
	.done(function(result){
		if(result.length==0)
		{
			$('#loadmore').append('<button class=" btn disabled center-align">no more post to show</button>');
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
			temp.html(result[key].created_at);
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
			temp.html(result[key].likes+' likes')

			temp=post.find('#protocomments');
			temp.attr('id',result[key].id+'comments');
			temp.attr("data-id",result[key].id);
			temp.html(result[key].comments+' comments')
			temp=post.find('#protoshow');
			temp.attr('id',result[key].id+'show');
			temp.attr('data-id',result[key].id);
			temp=post.find('#protocommentbox');
			temp.attr('id',result[key].id+'commentbox');
			temp=post.find('#protolikebox');
			temp.attr('id',result[key].id+'likebox');
			temp=post.find('#protocommentinput');
			temp.attr('id',result[key].id+'commentinput');
			temp.attr('data-id',result[key].id);
			temp=post.find('.comment_button');
			temp.attr('data-id',result[key].id);
			temp=post.find('.likebutton');
			temp.attr('value',result[key].id);
			if(result[key].like_id!=null)
			temp.children('i').html('favorite');
			else
			temp.children('i').html('favorite_border');
			temp=post.find('.commentcount');
			temp.children('a').html(result[key].comments+' comments');
			temp.children('a').attr('href','#'+result[key].id+'commentbox');
			temp=post.find('.likecount');
			temp.children('a').html(result[key].likes+' likes');
			temp.children('a').attr('href','#'+result[key].id+'likebox');





			
			$("#loadmore").append(post);
			post_id=result[key].id;


		$('#loadmore-button').removeClass('hide');
		}
		$("ul.tabs").tabs();
		$(".materialboxed").materialbox();
		
	$('#loadmore-spinner').removeClass('active');

	});

	
});

// CHECK NEW POST
// using 1 global variable
// postid


$(document).ready(function(){
	
		newPost();
	});
		

	function newPost(){
		

		if($.active==0)
		{
			$.ajax({
				type:'POST',
				url:'newpost',
				data:{pid:postid},
			})
			.done(function(result){
				if(result!=0)
				{
					myFunction(result['post'],result['confession']);
				}
			
			});
			}
			setTimeout(newPost,60000);

	}
	function myFunction(value1,value2) {
    var x = document.getElementById("snackbar");
    x.innerHTML=value1+" New Post(s), "+value2+"New Confession(s)";
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}

