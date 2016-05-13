(function($){
	var tweetManager = {

		init : function(){

			// $('.row').on('submit','.tweet form[data-remote]', this.saveTweet);

		},

		saveTweet: function(e){

			e.preventDefault();

			alert('hello');

			console.log('hello');
		}
	};

	$(function(){

		tweetManager.init();

	});


})(jQuery);