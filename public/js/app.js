(function($){

	var tweetManager = {

		init : function(){

			$('.main').on('click','.follow_user', this.followUser);
			$('.main').on('click','.unfollow_user', this.unfollowUser);
			$('.main').on('click','.delete_tweet', this.deleteTweet);

		},

		deleteTweet: function(e){

			e.preventDefault();

			var clickedButton = $(this);

			var id = clickedButton.data('id');

			// alert(id);
			// 
			if (confirm("Do you really want to delete this Tweet?")) {

				$.ajax({

					type : "POST",

					url  : "/deletetweet",

					headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

					data : {id : id} 
				})
				.done(function(){

					var currentPageUrl = window.location.href;

					$('.media-list').load(currentPageUrl+' .media-list');

				})
				.fail(function(){

					alert("error");

				});
			}
		},

		followUser: function(e){

			e.preventDefault();

			var clickedButton = $(this);

			var user_id = clickedButton.data('user-id');

			var follow_id = clickedButton.data('follow-id');

			// alert(user_id + follow_id);
			
			$.ajax({

				type : "POST",

				url  : "/follow_user",

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

				data : {user_id : user_id, follow_id: follow_id } 
			})
			.done(function(message){

				if(message){
					var currentPageUrl = window.location.href;

					$('.user_login').load(currentPageUrl+' .user_login');
				}

			})
			.fail(function(){

				alert("error");

			});
		},

		unfollowUser: function(e){

			e.preventDefault();

			var clickedButton = $(this);

			var user_id = clickedButton.data('user-id');
			var follow_id = clickedButton.data('follow-id');

			// alert(user_id + follow_id);
			
			$.ajax({

				type : "POST",

				url  : "/unfollow_user",

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

				data : {user_id : user_id, follow_id: follow_id } 
			})
			.done(function(message){

				// alert(message);

				if(message){
					var currentPageUrl = window.location.href;

					$('.user_login').load(currentPageUrl+' .user_login');
				}

			})
			.fail(function(){

				alert("error");

			});
		}
	};

	$(function(){

		tweetManager.init();

	});


})(jQuery);