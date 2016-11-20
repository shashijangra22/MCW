
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


				$('#chatbox').append('<div class="row" style="margin-bottom:5px"><div class="left leftmsg"><p class="chatinfo">'+result[key].username+' | '+hour+':'+minutes+'</p>'+result[key].message+'</div></div>');
				x=result[key].id;
				count=count+1;
				Materialize.toast("You have a message !", 500);




			}
	
				$('#scroll-chat')[0].scrollTop = $('#scroll-chat')[0].scrollHeight;
			}
			
			

		
		});
		}
		setTimeout(pullMsg,3000);
		
		}


//SEND MESSAGE

		function checktime(i)
		{

			if(i < 10)
			{
				i='0'+i;

			}
			return i;
		}


		function sendMessage()
	{
		var today= new Date();
		var hour=checktime(today.getHours());
		var minutes=checktime(today.getMinutes());
		
		var message=$("#message").val().trim();
		if(message.length>0)
		{
			$("#message").val('');
			$("#message").attr('onkeydown','');
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
			$("#message").attr('onkeydown','if (event.keyCode == 13) sendMessage();');
			$("#sendbutton").prop('disabled',false);
			$("#sendbutton").css('color', '');

		}); 		
	}
	}