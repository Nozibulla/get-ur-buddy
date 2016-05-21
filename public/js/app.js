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

			if (confirm("Do you really want to delete this Tweet?")) {

				$.ajax({

					type : "POST",

					url  : "/deletetweet",

					headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

					data : {id : id} 
				})
				.done(function(){

					var currentPageUrl = window.location.href;

					$('.row').load(currentPageUrl+' .row');

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

			clickedButton.text('Unfollow')
			
			$.ajax({

				type : "POST",

				url  : "/follow_user",

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

				data : {user_id : user_id, follow_id: follow_id } 
			})
			.done(function(message){

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

			clickedButton.text('Follow')
			
			$.ajax({

				type : "POST",

				url  : "/unfollow_user",

				headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

				data : {user_id : user_id, follow_id: follow_id } 
			})
			.done(function(message){

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