
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

$(document).ready(function(){
		newNotify();
	});

function newNotify()
{
	if($.active==0)
	{
		$.ajax({
			type:'POST',
			url:'newnotify',
			data:{lastNotifyTime:lastNotifyTime},
		})
		.done(function(result)
		{
			if(result!=0)
			{
				var temp=0;
				for (var key in result)
				{
					lastNotifyTime=result[key].created_at;
					temp=temp+1;
					if (result[key].category==0) {
						$('#dropdown2').prepend('<li><a style="cursor:pointer;" class="viewStoryBtn" data-pid="'+result[key].data.post_id+'" data-id="'+result[key].id+'">'+result[key].username + ' liked your Post.<span class="new badge blue"></span></a></li>');
					}
					else
					{
						$('#dropdown2').prepend('<li><a style="cursor:pointer;" class="viewStoryBtn" data-pid="'+result[key].data.post_id+'" data-id="'+result[key].id+'">'+result[key].username + ' commented on your Post.<span class="new badge blue"></span></a></li>');	
					}
				}
				var prev=$('.fa-bell').html().trim();
				var all=Number(prev)+Number(temp);
				$('.fa-bell').html(' '+all);
				Materialize.toast('You Have unread notifications',3000);
			}
		
		});
		}
		setTimeout(newNotify,10000);
}