$(document).ready(function() {

	$("#searchBox").hide();
	$(".collapseBtn").hide();
	$(".upBtn").hide();


	$(window).scroll(function() {
		if($(this).scrollTop() > 100)
			$(".upBtn").fadeIn();
		else
			$(".upBtn").fadeOut();
	});

	$(".upBtn").click(function() {
		$("html, body").animate({ scrollTop: 0 }, 600);
		return false;
	});

});


function collapseToggle() {
	$("#navbar").slideToggle();
}
function searchToggle() {
	$("#searchBox").slideToggle();
}

(function($,sr){

  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function (func, threshold, execAsap) {
      var timeout;

      return function debounced () {
          var obj = this, args = arguments;
          function delayed () {
              if (!execAsap)
                  func.apply(obj, args);
              timeout = null;
          };

          if (timeout)
              clearTimeout(timeout);
          else if (execAsap)
              func.apply(obj, args);

          timeout = setTimeout(delayed, threshold || 100);
      };
  }
  // smartresize
  jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');

// usage:
// $(window).smartresize(function(){
// 	updatePage();
// });

window.getDevicePixelRatio = function () {
    var ratio = 1;
    // To account for zoom, change to use deviceXDPI instead of systemXDPI
    if (window.screen.systemXDPI !== undefined && window.screen.logicalXDPI       !== undefined && window.screen.systemXDPI > window.screen.logicalXDPI) {
        // Only allow for values > 1
        ratio = window.screen.systemXDPI / window.screen.logicalXDPI;
    }
    else if (window.devicePixelRatio !== undefined) {
        ratio = window.devicePixelRatio;
    }
    return ratio;
};
