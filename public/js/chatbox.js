var chatModule = (function() {

	var x=-1;

	var days = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];

	var $el = $('#chat-slide-out');
	var $scrollChat = $el.find('div.scrollbar');
	var $chatbox = $scrollChat.find('#chatbox');

	var $sendBtn = $el.find('#sendBtn');
	var $input = $el.find('input');

	$sendBtn.on('click',sendMsg);
	
	function myTime(value) {
		var hour = value.getHours();
		var minutes = value.getMinutes();
		var day = days[value.getDay()];
		if (hour<10) {hour='0'+hour;}
		if (minutes<10) {minutes='0'+minutes;}
		return day+' - '+hour+':'+minutes;
	}

	function initialMsgs() {
		$.ajax({
			type:'POST',
			url:'initialMsgs',
			dataType:'json'
		}).done(function(result) {
			
		});
	}

	function sendMsg() {
		var t = myTime(new Date());
		var message = $input.val().trim();
		if (message.length>0) {
			$input.val('');
			$input.attr('disabled',true);
			$sendBtn.prop('disabled',true);
			$sendBtn.css('color', 'lightgrey');

			$.ajax({
				type:'POST',
				data:{text:message},
				url:'sendMsg'
			}).done(function(result) {
				$chatbox.append('<div class="row" style="margin-bottom:5px"><div class="right rightmsg primary-color">'+message+'<p class="chattime">'+t+'</p></div></div>');
				$scrollChat[0].scrollTop = $scrollChat[0].scrollHeight;
				$input.attr('disabled',false);
				$sendBtn.prop('disabled',false);
				$sendBtn.css('color', '');
			});
		}
	}

	function initialMsgs() {
		$.ajax({
			type:'POST',
			url:'initialMsgs',
			dataType:'json'
		}).done(function (result) {
			 for (var key in result){
			 	var t = myTime(new Date(result[key].created_at));
			 	if (result[key].username==auth_username) {
			 		$chatbox.append('<div class="row" style="margin-bottom:5px"><div class="right rightmsg primary-color">'+result[key].message+'<p class="chattime">'+t+'</p></div></div>');
			 	}
			 	else
			 	{
			 		$chatbox.append('<div class="row" style="margin-bottom:5px"><div class="left leftmsg"><p class="chatinfo">'+result[key].username+' | '+t+'</p>'+result[key].message+'</div></div>');
			 	}
			 	x=result[key].id;
			 }
			 $scrollChat[0].scrollTop = $scrollChat[0].scrollHeight;
		});
		pullMsg();
	}

	function pullMsg() {
		if ($.active==0) {
			$.ajax({
				type:'POST',
				data:{id:x},	// global variable x stores the last message's id
				url:'pullMsg',
				dataType:'json'
			}).done(function(result) {
				if (result!=0) {
					if($('#sidenav-overlay').length <= 0)
					{
						console.log("hello");
						$(".chat-button").addClass("red");
					}

					for (var key in result){
						var t=myTime(new Date(result[key].created_at));
						$chatbox.append('<div class="row" style="margin-bottom:5px"><div class="left leftmsg"><p class="chatinfo">'+result[key].username+' | '+t+'</p>'+result[key].message+'</div></div>');
						x=result[key].id;
					}

					$scrollChat[0].scrollTop = $scrollChat[0].scrollHeight;
				}
			});
		}setTimeout(pullMsg,3000);
	}

	return {
		initialMsgs: initialMsgs,
	};

})();

$(document).ready(function(){
		chatModule.initialMsgs();
	});