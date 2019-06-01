$(document).ready(function(){
	var $window = $(window);
	var animate_galleryPost = [];
    $('.galleryPost').each(function() { 
		animate_galleryPost.push($(this));
	});
	
	function check_if_in_view() {
		var window_height = $window.height();
		var window_top_position = $window.scrollTop();
		var window_bottom_position = (window_top_position + window_height);

		$.each(animate_galleryPost, function() {
			var $element = $(this);
			var element_height = $element.outerHeight();
			var element_top_position = $element.offset().top;
			var element_bottom_position = (element_top_position + element_height);
 
			if ((element_bottom_position >= window_top_position) &&
				(element_top_position <= window_bottom_position)) {
				$element.addClass('tes');
			} 
		});
	}
	$window.on('scroll resize', check_if_in_view);
	$window.trigger('scroll');
});

$(document).ready(function() {
	var modal = document.getElementById('imgModal');
	var span = document.getElementsByClassName("closeImg")[0];
	
	span.onclick = function() { 
	    modal.style.display = "none";
	}

	var images = document.getElementsByClassName('thisImg');
	var modalImg = document.getElementById("img01");
	var captionText = document.getElementById("caption");
	var i;
	for (i = 0; i < images.length; i++) {
	   images[i].onclick = function(){
		   modal.style.display = "block";
		   modalImg.src = this.src;
		   modalImg.alt = this.alt;
		   captionText.innerHTML = this.nextElementSibling.innerHTML;
	   }
	}
});