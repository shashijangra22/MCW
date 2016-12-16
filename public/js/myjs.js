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

$(".chat-button").on("click",function(){
	$(this).removeClass("red");
});


$(document).ready(function(){
  $(document).ajaxError(function(){
        Materialize.toast('Connection Error! Try Refreshing the page.',3000);
    });
  $('.button-collapse').sideNav({edge: 'left',closeOnClick: true});
  $('.chat-button').sideNav({edge: 'right',});
	$('.modal').modal();

});

function hideChatBox() {
	$('.button-collapse').sideNav('hide');
}

var postModule = (function() {
	
	var post_id=-1;
	var days = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
	var months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
		
	var $el = $('#maindiv');

	var $postFormRow = $el.find('#postFormRow');
		var $postForm = $postFormRow.find('form');
			var $addBtn = $postForm.find('a');
			var $textarea = $postForm.find('textarea');
		var $addPostLoader = $postFormRow.find('div.postspinner');
	var $postsRow = $el.find('#postsRow');
		var $protoPost = $('#prototype');
			var $postUserImage = $protoPost.find('div.postUserImage');
	var $loadmoreRow = $el.find('#loadmoreRow');
		var $loadmoreBtn = $loadmoreRow.find('button');
		var $loadmoreSpinner = $loadmoreRow.find('#loadmoreSpinner');

	$textarea.on('keyup',togglePostBtn);
	$addBtn.on('click',addPost);
	$loadmoreBtn.on('click',getPosts);
	$(document).delegate('.likeBtn','click',likePost);
	$(document).delegate('.commentBtn','click',commentPost);
	$(document).delegate('.delBtn','click',deletePost);
	$(document).delegate('input.comment_input','keypress',onEnter);
	$(document).delegate('.likescount','click',showLikes);
	$(document).delegate('.commentscount','click',showComments);

	function togglePostBtn() {
		var value = ($textarea.val().length !=0) ? false : true;
            $addBtn.attr('disabled', value);
	}

	function showComments(e) {
		var target = $(e.target).closest('div.card-content');
		var commentsBox = target.find('div.commentsBox');
		var likesBox = target.find('div.likesBox'); 
		if (commentsBox.is(':visible')) {
			commentsBox.hide();
			return 0;
		}
		commentsBox.siblings('i').fadeIn();
		var pid = $(e.target).data('id');
		
		$.ajax({
			type:'POST',
			url:'showcomments',
			data:{pid:pid}
		}).done(function (result) {
			commentsBox.empty();
			if (result.length>0) {
				likesBox.hide();
				for (var key in result){
					var date=myTime(new Date(result[key].created_at));
					commentsBox.append('<div class="row" style="padding-top: 2px;font-size: 12px;margin:auto"><b><a href="'+result[key].username+'">'+result[key].username+'</a></b> '+result[key].data+' <p class="right" style="display:inline;font-size:8px">'+date+'</p></div>');
				}
				commentsBox.show();
				commentsBox.linkify();
			}
			else
			{
				Materialize.toast('Oops! No Comments to show :P', 3000);
			}
			commentsBox.siblings('i').fadeOut();
		});
	}

	function showLikes(e) {
		var target = $(e.target).closest('div.card-content');
		var likesBox = target.find('div.likesBox'); 
		var commentsBox = target.find('div.commentsBox');
		if (likesBox.is(':visible')) {
			likesBox.hide();
			return 0;
		}
		likesBox.siblings('i').fadeIn();
		var pid = $(e.target).data('id');
		$.ajax({
			type:'POST',
			url:'showlikes',
			data:{pid:pid}
		}).done(function(result) {
			likesBox.empty();
			if (result.length>0) {
				commentsBox.hide();
				for (var key in result){
					likesBox.append('<p style="font-size:12px;display:inline"><b><a href="'+result[key].username+'">'+result[key].username+'</a>, </b></p>');
					likesBox.show();
				}
			}
			else
			{
				Materialize.toast('Oops! No Likes to show :P', 3000);
			}
			likesBox.siblings('i').fadeOut();
		});
	}

	function onEnter(e) {
		if (e.which == 13) {
			commentPost(e);
		}
	}

	function deletePost(e) {
		var pid = $(e.target).data('id');
		$(e.target).attr('disabled',true);
		$(e.target).closest('div.card').fadeOut();
		$.ajax({
			type:'POST',
			url:'delpost',
			data:{pid:pid}
		}).done(function(result) {
			Materialize.toast(result,2000);
		});
	}

	function commentPost(e) {
		var $input = $(e.target).closest('div.row').find('input');
		var comment = $input.val().trim();
		if (comment.length<=0) {
			Materialize.toast('An empty comment! Really? 🤔',2000);
			return false;
		}
		$(e.target).css('pointer-events','none');
		var pid = $(e.target).data('id');
		var comments =  $(e.target).closest('div.card').find('a.commentscount');
		var string = comments.html();
		$input.prop('disabled',true);
		var spinner = $(e.target).closest('div.card-action').find('div.commentSpinner'); 
		spinner.siblings('i').addClass('hide');
		spinner.removeClass('hide');
		$.ajax({
			type:'POST',
			url:'savecomment',
			data:{pid:pid,data:comment}
		}).done(function(result) {
			if (result==0) {
				var count = string.match(/\d/g);
				count = Number(count.join(''));
				count++;
				comments.html(count+' Comments');
				$input.val('');
				spinner.siblings('i').removeClass('hide');
				spinner.addClass('hide');
			}
			$input.prop('disabled',false);
			$(e.target).css('pointer-events','auto');
		});
	}

	function likePost(e) {
		$(e.target).css('pointer-events','none');
		var pid = $(e.target).data('id');
		var likes =  $(e.target).closest('div.card').find('a.likescount');
		var string = likes.html();

		$.ajax({
			type:'POST',
			url:'likepost',
			data:{pid:pid}
		}).done(function(result) {
			var count = string.match(/\d/g);
			count = Number(count.join(''));
			if (result==0) {
				count++;
				likes.html(count+' Likes');
				$(e.target).html('favorite');
			}
			else{
			 	count--;
			 	if(count<0)
					count=0;
			 	likes.html(count+' Likes')
			 	$(e.target).html('favorite_border');	
			}
			$(e.target).css('pointer-events','auto');
		});
	}

	function addPost() {
		$addBtn.addClass('hide');
		$addPostLoader.removeClass('hide');
		var formData = new FormData($postForm[0]);
		$textarea.attr('disabled',true);
		$.ajax({
			type:'POST',
			url:'savedata',
			data:formData,
			contentType:false,
			processData:false
		}).done(function(result) {
			$postForm[0].reset();
			var url;
			if(window.location.href.indexOf("home") > -1)
			{
				url='home';
			}
			else if(window.location.href.indexOf("confessions") > -1)
			{
				url='confessions';
			}
			if(result==0)
			{
				window.location.replace(url);
			}
			else
			{
				alert(result);
				window.location.replace(url);
			}
		});
	}

	function myTime(value) {
		var hour = value.getHours();
		var minutes = value.getMinutes();
		if (hour<10) {hour='0'+hour;}
		if (minutes<10) {minutes='0'+minutes;}
		return value.getDate()+" "+months[value.getMonth()]+" | "+days[value.getDay()]+" "+hour+":"+minutes+"";
	}

	function makePost(obj,card,type) {
		card.attr('id',obj.id+type+'card');
		if(obj.path!=null)
			card.prepend('<div class="card-image"><img src="'+obj.path+'"></div>');
		card.find('a.postUserImg').attr('href',obj.username);
		card.find('img.postUserImg').attr('src',obj.displaypic);
		card.find('a.postUsername').attr('href',obj.username);
		card.find('a.postUsername').html('<strong>'+obj.username+'<strong/>');
		card.find('strong.timestamp').html(myTime(new Date(obj.created_at)));
		if(auth_id==obj.user_id)
		{
			card.find('div.deleteBtn').html('<i class="delBtn btn-floating waves-effect waves-light fa fa-trash right" style="font-size:20px;margin-left:0px;padding:0px 12px"></i>');
			card.find('i.delBtn').data('id',obj.id);
		}
		card.find('blockquote').html(obj.data.replace(/\n/g, "<br />"));
		card.find('blockquote').linkify();
		card.find('a.likescount').html(obj.likes+' Likes');
		card.find('a.likescount').data('id',obj.id);
		card.find('a.commentscount').data('id',obj.id);
		card.find('a.commentscount').html(obj.comments+' Comments');

		card.find('input').data('id',obj.id);
		card.find('i.commentBtn').data('id',obj.id);
		temp=card.find('i.likeBtn');
		temp.data('id',obj.id);
		temp.html((obj.like_id!=null) ? 'favorite':'favorite_border');
		return card;
	}

	function getPosts() {
		$(window).off('scroll');
		$loadmoreBtn.addClass('hide');
		$loadmoreSpinner.removeClass('hide');

		$.ajax({
			type:'POST',
			url:'loadmore',
			data:{pid:post_id},
			dataType:'json'
		}).done(function(result) {
			if(result.length>0)
			{
				for (var key in result){
					var card = makePost(result[key],$protoPost.clone(true),'post');
					$postsRow.append(card);
					card.fadeIn();
					post_id=result[key].id;
				}
				$(window).on('scroll', function(){
				   if($(window).scrollTop() + $(window).height() == $(document).height()) {
				        $('#loadmore-button').click();
				   }
				});
				$loadmoreBtn.removeClass('hide');
				$loadmoreSpinner.addClass('hide');
			}
			else{
				Materialize.toast("No More posts to load :)", 2000);
				$loadmoreRow.remove();
			}
		});
	}

	return {
		getPosts : getPosts,
		makePost : makePost
	}
})();

var notifModule = (function() {

	lastNotifyTime = 0;

	initialNotif();

	function initialNotif() {
		
		if ($.active==0) {
			$.ajax({
				type:'POST',
				url:'newnotify',
				data:{lastNotifyTime:lastNotifyTime}
			}).done(function(result) {
				if (result.length>0) {
					for (var key in result){
						if (result[key].category==0) {
							$('#dropdown2').append('<li><a style="cursor:pointer;" class="viewStoryBtn" data-pid="'+result[key].data.post_id+'">'+result[key].username + ' liked your Post.</a></li>');
						}
						else
						{
							$('#dropdown2').append('<li><a style="cursor:pointer;" class="viewStoryBtn" data-pid="'+result[key].data.post_id+'">'+result[key].username + ' commented on your Post.</a></li>');	
						}
					}
					lastNotifyTime=result[0].created_at;
				}
			});
		}
		newNotify();
	}
	
	$(".notifyBtn").on("click",function(event){
		if (!$('.fa-bell').html())	return false;
		$('.fa-bell').html('');
		$.ajax({url: "markallread",type:"POST",});
	});

	function newNotify(){
		if($.active==0)
		{
			$.ajax({
				type:'POST',
				url:'newnotify',
				data:{lastNotifyTime:lastNotifyTime},
			})
			.done(function(result)
			{
				if(result.length>0)
				{
					for (var key in result)
					{
						lastNotifyTime=result[key].created_at;
						if (result[key].category==0) {
							$('#dropdown2').prepend('<li><a style="cursor:pointer;" class="viewStoryBtn" data-pid="'+result[key].data.post_id+'">'+result[key].username + ' liked your Post.<span class="new badge blue"></span></a></li>');
						}
						else
						{
							$('#dropdown2').prepend('<li><a style="cursor:pointer;" class="viewStoryBtn" data-pid="'+result[key].data.post_id+'">'+result[key].username + ' commented on your Post.<span class="new badge blue"></span></a></li>');	
						}
					}
					var prev=$('.fa-bell').html().trim();
					var all=Number(prev)+result.length;
					$('.fa-bell').html(' '+all);
					Materialize.toast('You Have unread notifications',3000);
				}
			
			});
			}
			setTimeout(newNotify,10000);
	}
})();

var chatModule = (function() {

	var x=-1;

	var days = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];

	var $el = $('#chat-slide-out');
	var $scrollChat = $el.find('div.scrollbar');
	var $chatbox = $scrollChat.find('#chatbox');

	var $sendBtn = $el.find('#sendBtn');
	var $input = $el.find('input');

	$sendBtn.on('click',sendMsg);
	
	initialMsgs();

	function myTime(value) {
		var hour = value.getHours();
		var minutes = value.getMinutes();
		var day = days[value.getDay()];
		if (hour<10) {hour='0'+hour;}
		if (minutes<10) {minutes='0'+minutes;}
		return day+' - '+hour+':'+minutes;
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
})();

$(document).delegate('.viewStoryBtn','click',function(e)
{
	e.preventDefault();
	$('#loadpost').empty();
	var pid=$(this).data('pid');
	$(".spinner-wrapper").fadeIn("slow");
	$.ajax({
		type:'POST',
		url:'getpost',
		data:{pid:pid},
		dataType:'json'
	})
	.done(function(result){
		if (result==0) 
			Materialize.toast('Oops ! That post does not exist anymore !',2000);
		else
		{
			var card = postModule.makePost(result[0],$('#prototype').clone(true),'post');
			$("#loadpost").append(card);
			card.fadeIn();
			$('#modal1').modal('open');
		}
	});
	$(".spinner-wrapper").fadeOut("slow");
});

var profileModule = (function() {

	var $postsRow = $('#postsRow');

	function myProfilePosts() {
		$.ajax({
			type:'POST',
			url:'myprofileposts',
			dataType:'json'
		}).done(function(result) {
			if(result.length>0)
			{
				for (var key in result){
					var card = postModule.makePost(result[key],$('#prototype').clone(true),'post');
					$postsRow.append(card);
					card.fadeIn();
				}
			}
			else{
				Materialize.toast("You dont have any posts to show :(", 2000);
			}
		});
	}

	function userProfilePosts() {
		$.ajax({
			type:'POST',
			url:'userprofileposts',
			data:{uid:uid},
			dataType:'json'
		}).done(function(result) {
			if(result.length>0)
			{
				for (var key in result){
					var card = postModule.makePost(result[key],$('#prototype').clone(true),'post');
					$postsRow.append(card);
					card.fadeIn();
				}
			}
			else{
				Materialize.toast("No posts to show :(", 2000);
			}
		});
	}

	return {
		myProfilePosts : myProfilePosts,
		userProfilePosts : userProfilePosts
	}

})();

var peopleModule = (function() {
		
	var lastID = 0;

	var $el = $('#peopleModule');
	var $cardsRow = $el.find('#cardsRow');
	var $protoCard = $cardsRow.find('#protoUser');
	var $loadMoreRow = $el.find('#loadMore');
		var $loadMoreBtn = $loadMoreRow.find('button');
		var $loader = $loadMoreRow.find('#loader');
	var $searchRow = $el.find('#searchRow');
		var $searchBtn = $searchRow.find('button');
		var $searchInput = $searchRow.find('input');
		var $searchLoader = $searchRow.find('#searchLoader');
	var $searchResult = $el.find('#searchResult');

	$searchBtn.on('click',searchPeople);
	$loadMoreBtn.on('click',getPeople);

	function getPeople() {
		$loadMoreBtn.addClass('hide');
		$loader.removeClass('hide');
			$.ajax({
				type:'POST',
				data:{id:lastID},
				url:'getpeople'
			}).done(function(result) {
				if (result!=0) {
					for (var key in result){
						lastID=result[key].id;
						var card = fillData(result[key],$protoCard.clone(true),'people');
						$cardsRow.append(card);
						card.fadeIn();
					}
					$loader.addClass('hide');
					$loadMoreBtn.removeClass('hide');
				}
				else
				{
					Materialize.toast('No more users!',2000);
					$loader.addClass('hide');
				}
			});
	}

	function fillData(obj,card,type) {
			card.attr('id',obj.id+type+'card');
			var temp=card.find('div.card-content');
			temp.find('img').attr('src',obj.displaypic);
			temp.find('a').html('@'+obj.username);
			temp.find('a').attr('href',obj.username);
			temp.find('p').html(obj.posts+' Posts | '+obj.comments+' Comments | '+obj.likes+' Likes');
			return card;
	}

	function searchPeople() {
		$searchBtn.addClass('hide');
			$searchLoader.removeClass('hide');
			var data = $searchInput.val().trim(); 
			if (data.length) {
				$.ajax({
					type:"POST",
					data:{data:data},
					url:"searchpeople"
				}).done(function(result){
					if (result==1) {
						Materialize.toast('No Such User!',2000);
						$searchResult.html('');
					}
					else
					{
						Materialize.toast('User found!',2000);
						var card=fillData(result,$protoCard.clone(true),'people');
						card.attr('id','searchedUser');
						card.attr('class','col s12 l4 offset-l4');
						$searchResult.html(card);
						card.fadeIn();
					}
					$searchLoader.addClass('hide');
					$searchBtn.removeClass('hide');
				});
				$searchInput.val('');
			}
			else{
				Materialize.toast('Blank User ??',2000);
				$searchLoader.addClass('hide');
				$searchBtn.removeClass('hide');
			}
	}
	return {
		getPeople : getPeople,
		lastID : lastID
	}
})();