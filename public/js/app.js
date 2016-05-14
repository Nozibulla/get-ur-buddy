(function($){

	var tweetManager = {

		init : function(){

			$('.main').on('click','.follow_user', this.followUser);
			$('.main').on('click','.unfollow_user', this.unfollowUser);

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

					$('.twt-wrapper').load(currentPageUrl+' .twt-wrapper');
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

					$('.twt-wrapper').load(currentPageUrl+' .twt-wrapper');
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