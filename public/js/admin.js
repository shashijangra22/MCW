var userModule = (function() {
	
	var users = [];
	var lastID = 0;

	var $el = $('#userModule');
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

	$searchBtn.on('click',searchUser);
	$protoCard.delegate('input','change',toggleUser);
	$loadMoreBtn.on('click',getUsers);

	getUsers();	// initial call

	function getUsers() {
		$loadMoreBtn.addClass('hide');
		$loader.removeClass('hide');
		users.length=0;	// empty the array on each call
			$.ajax({
				type:'POST',
				data:{id:lastID},
				url:'getusers'
			}).done(function(result) {
				if (result.length>0) {
					for (var key in result){
						users.push(result[key]);
						lastID=result[key].id;
					}
					showUsers();
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
			var keys = Object.keys(obj);
			var values = Object.values(obj);
			keys.forEach(function(key,index) {
				temp.append('<p class="'+key+'"><strong>'+key+': </strong>'+values[index]+'</p>');
			});
			return card;
	}

	function addTitle(card,username,id,active) {
		card.find('span.username').html(username);
		var temp=card.find('input');
		temp.data('id',id);
		if (active==1) {
			temp.attr('checked','checked');
		}
		return card;
	}

	function showUsers() {
		var len=users.length;
			for (var i = 0; i < len; i++) {
				var card = fillData(users[i],$protoCard.clone(true),'user');
				addTitle(card,users[i].username,users[i].id,users[i].active);
				card.find('p.email').addClass('truncate');
				card.find('p.displaypic').addClass('truncate');
				$cardsRow.append(card);
				card.fadeIn();
			}
	}

	function searchUser(value) {
		var output=[];
		$searchBtn.addClass('hide');
			$searchLoader.removeClass('hide');
			users.length=0;		// empty the array on each call
			var data = (typeof value==='string') ? value.trim() : $searchInput.val().trim(); 
			if (data.length) {
				$.ajax({
					type:"POST",
					data:{data:data},
					url:"searchuser"
				}).done(function(result){
					if (result==1) {
						Materialize.toast('No Such User!',2000);
						$searchResult.html('');
					}
					else
					{
						Materialize.toast('User found!',2000);
						users.push(result);
						output.push(result);
						var card=fillData(users[0],$protoCard.clone(true),'user');
						addTitle(card,users[0].username,users[0].id,users[0].active);
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
			return output;
	}

	function toggleUser(e) {
		var uid=$(e.target).data('id');
			$.ajax({
				type: "POST",
				data: {uid:uid},
				url: "toggleuser"
			}).done(function(result) {
				Materialize.toast(result,2000);
			});
	}

	return {
		fillData : fillData
	};

})();

var postModule = (function() {
	
	var posts = [];
	var lastID = 0;

	var $el = $('#postModule');

	var $postsRow = $el.find('#postsRow');
		var $protoPost = $postsRow.find('#protoPost');
	var $loadMorePostsRow = $el.find('#loadMorePosts');
		var $loadMoreBtn = $loadMorePostsRow.find('button');
		var $loader = $loadMorePostsRow.find('#postLoader');
	var $deleteBtn = $postsRow.find('i');

	$loadMoreBtn.on('click',getPosts);
	$postsRow.delegate('i','click',deletePost);

	getPosts();	// initial call

	function getPosts() {
		$loadMoreBtn.addClass('hide');
		$loader.removeClass('hide');
		posts.length=0;
		$.ajax({
			type: 'POST',
			data:{id:lastID},
			url:'getposts'
		}).done(function(result) {
			if (result.length>0) {
				for (var key in result){
					posts.push(result[key]);
					lastID=result[key].id;
				}
				showPosts();
				$loader.addClass('hide');
				$loadMoreBtn.removeClass('hide');
			}
			else
			{
				Materialize.toast('No more posts!',2000);
				$loader.addClass('hide');
			}
		});
	}

	function showPosts() {
		var len=posts.length;
			for (var i = 0; i < len; i++) {
				var card=userModule.fillData(posts[i],$protoPost.clone(true),'post');
				card.find('p.data').addClass('truncate');
				card.find('p.path').addClass('truncate');
				card.find('i').data('id',posts[i].id);
				card.find('span.counter').html('Post #'+posts[i].id);
				$postsRow.append(card);
				card.fadeIn();
			}
	}

	function deletePost(e) {
		var pid=$(e.target).data('id');
		$(e.target).closest('div.col').fadeOut();
			$.ajax({
				type: "POST",
				data: {pid:pid},
				url: "deletepost"
			}).done(function(result) {
				Materialize.toast(result,2000);
			});
	}

})();

var commentModule = (function() {
	
	var comments = [];
	var lastID = 0;

	var $el = $('#commentModule');

	var $commentsRow = $el.find('#commentsRow');
		var $protoComment = $commentsRow.find('#protoComment');
	var $loadMorecommentsRow = $el.find('#loadMoreComments');
		var $loadMoreBtn = $loadMorecommentsRow.find('button');
		var $loader = $loadMorecommentsRow.find('#commentLoader');
	var $deleteBtn = $commentsRow.find('i');

	$loadMoreBtn.on('click',getComments);
	$commentsRow.delegate('i','click',deleteComment);

	getComments();	// initial call

	function getComments() {
		$loadMoreBtn.addClass('hide');
		$loader.removeClass('hide');
		comments.length=0;
		$.ajax({
			type: 'POST',
			data:{id:lastID},
			url:'getcomments'
		}).done(function(result) {
			if (result.length>0) {
				for (var key in result){
					comments.push(result[key]);
					lastID=result[key].id;
				}
				showComments();
				$loader.addClass('hide');
				$loadMoreBtn.removeClass('hide');
			}
			else
			{
				Materialize.toast('No more comments!',2000);
				$loader.addClass('hide');
			}
		});
	}

	function showComments() {
		var len=comments.length;
			for (var i = 0; i < len; i++) {
				var card=userModule.fillData(comments[i],$protoComment.clone(true),'comment');
				card.find('p.data').addClass('truncate');
				card.find('i').data('id',comments[i].id);
				card.find('span.counter').html('Comment #'+comments[i].id);
				$commentsRow.append(card);
				card.fadeIn();
			}
	}

	function deleteComment(e) {
		var cid=$(e.target).data('id');
		$(e.target).closest('div.col').fadeOut();
			$.ajax({
				type: "POST",
				data: {cid:cid},
				url: "deletecomment"
			}).done(function(result) {
				Materialize.toast(result,2000);
			});
	}

})();


var questionModule = (function() {
	
	var questions = [];
	var lastID = 0;

	var $el = $('#questionModule');

	var $questionsRow = $el.find('#questionsRow');
		var $protoQuestion = $questionsRow.find('#protoQuestion');
	var $formsRow = $el.find('#formsRow');
		var $addForm = $formsRow.find('#addForm');
		var $addBtn = $formsRow.find('a.addBtn');
		var $hintForm = $formsRow.find('#hintForm');
		var $hintBtn = $formsRow.find('a.hintBtn');
	var $loadMoreQuestionsRow = $el.find('#loadMoreQuestions');
		var $loadMoreBtn = $loadMoreQuestionsRow.find('button');
		var $loader = $loadMoreQuestionsRow.find('#questionLoader');

	$loadMoreBtn.on('click',getQuestions);
	$addBtn.on('click',addQuestion);
	$hintBtn.on('click',updateHint);

	getQuestions();	// initial call

	function getQuestions() {
		$loadMoreBtn.addClass('hide');
		$loader.removeClass('hide');
		questions.length=0;
		$.ajax({
			type: 'POST',
			data:{id:lastID},
			url:'getquestions'
		}).done(function(result) {
			if (result.length>0) {
				for (var key in result){
					questions.push(result[key]);
					lastID=result[key].id;
				}
				showQuestions();
				$loader.addClass('hide');
				$loadMoreBtn.removeClass('hide');
			}
			else
			{
				Materialize.toast('No more questions!',2000);
				$loader.addClass('hide');
			}
		});
	}

	function showQuestions() {
		var len=questions.length;
			for (var i = 0; i < len; i++) {
				var card=userModule.fillData(questions[i],$protoQuestion.clone(true),'question');
				card.find('p.data').addClass('truncate');
				card.find('p.path').addClass('truncate');
				card.find('span.counter').html('Question #'+questions[i].id);
				$questionsRow.append(card);
				card.fadeIn();
			}
	}

	function addQuestion() {
		var formData = new FormData($addForm[0]);
		$.ajax({
			url: 'addQuestion',
			type:'POST',
			data:formData,
			contentType: false,
			processData: false
		}).done(function(result) {
			$addForm[0].reset();
			Materialize.toast(result,2000);
		});
	}

	function updateHint() {
		$.ajax({
			url: 'addHint',
			type:"POST",
			data:$hintForm.serialize(),
		}).done(function(result) {
			$hintForm[0].reset();
			Materialize.toast(result,2000);		
		});
	}

})();