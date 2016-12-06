//initialization

$(document).ready(function(){
		pullMsg();
		count=0;
		$('#scroll-chat')[0].scrollTop = $('#scroll-chat')[0].scrollHeight;

	});


//CHAT NEW MSG PULL

function pullMsg()
	{
		if($.active==0)
		{
		
	$.ajax({
			type:"POST",
			url:"pullMsg",
			data:{mid:x},
			dataType:'json'

			

		})
		.done(function(result){
			if(result!=0)
			{
			
			
			for(var key in result)
			{
				var today= new Date(result[key].created_at);
				var hour=today.getHours();
				var minutes=today.getMinutes();
				if (hour<10) {hour='0'+hour;}
				if (minutes<10) {minutes='0'+minutes;}


				$('#chatbox').append('<div class="row" style="margin-bottom:5px"><div class="left leftmsg"><p class="chatinfo">'+result[key].username+' | '+hour+':'+minutes+'</p>'+result[key].message+'</div></div>');
				x=result[key].id;
				count=count+1;

			}
	
				$('#scroll-chat')[0].scrollTop = $('#scroll-chat')[0].scrollHeight;
			}
			
			

		
		});
		}
		setTimeout(pullMsg,3000);
		
		}


//SEND MESSAGE



		function sendMessage()
	{
		var today= new Date();
		var hour=today.getHours();
		var minutes=today.getMinutes();
		if (hour<10) {hour='0'+hour;}
		if (minutes<10) {minutes='0'+minutes;}
		var message=$("#message").val().trim();
		if(message.length>0)
		{
			$("#message").val('');
			$("#message").attr('disabled',true);
			$("#sendbutton").prop('disabled',true);
			$('#sendbutton').css('color', 'lightgrey');

		$.ajax({
			type:"POST",
			data:{text:message},
			url:"sendmessage"
		})
		.done(function(result){

			$('#chatbox').append('<div class="row" style="margin-bottom:5px"><div class="right rightmsg primary-color">'+message+'<p class="chattime">'+hour+':'+minutes+'</p></div></div>');
			$('#scroll-chat')[0].scrollTop = $('#scroll-chat')[0].scrollHeight;
			$("#message").attr('disabled',false);
			$("#sendbutton").prop('disabled',false);
			$("#sendbutton").css('color', '');

		}); 		
	}
	}