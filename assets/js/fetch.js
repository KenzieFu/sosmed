$(function(){
	var win = $(window);
	var offset = 10;

	win.scroll(function(){
		if($(document).height() <= (win.height() + win.scrollTop())){
			offset +=10;
			$('#loader').show();
			$.post('http://localhost/sosmed/core/ajax/fetchPosts.php', {fetchPost:offset}, function(data){
				$('.posts').html(data);
				$('#loader').hide();
			});
		}
	});
});