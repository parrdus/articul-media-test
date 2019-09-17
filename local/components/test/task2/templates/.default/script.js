$(document).ready(function () {
	
	$("body").on("click", ".ajax-nav a", function(e) {
		if( $(this).closest(".ajax-content").length >0 ){
			e.preventDefault();
			var url = $(this).attr("href");
			var ajax_content = $(this).closest(".ajax-content");
			
			$.ajax({
				url: url,
				success: function(answ) {
					history.pushState(null, null, url);
					ajax_content.html( $(answ).find(".ajax-content").html() );
				}
			});
		}
	});
	
});