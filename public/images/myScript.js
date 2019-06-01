$(document).ready(function() {
	$("#searchBox").hide();
	$(".collapseBtn").hide();
	$(".upBtn").hide();

	var win = $(this);
	if(win.width() <= 1150) {
		$("#navbar").addClass("btn-group-vertical");
		$("#navbar").removeClass("btn-group");
		$(".collapseBtn").show();
		$(".naviBtn").css("width",win.width());
		$(".navcol-1").addClass("col-sm-12");
		$(".navcol-1").removeClass("col-sm-4");
		$(".navcol-2").addClass("col-sm-12");
		$(".navcol-2").removeClass("col-sm-8");
		$("#navbar").hide();
		$(".naviBtn").css("font-size","6vh");
		$(".naviBtn").css("height","auto");
		$(".topBtn").css("font-size","4vw");
		$(".navbar-dropdown").css("font-size","4vw");
		$(".navbar-dropdown").css("text-align","center");
		$(".navbar-dropdown").css("width","100vw");
	} else {
		$("#navbar").removeClass("btn-group-vertical");
		$("#navbar").addClass("btn-group");
		$(".naviBtn").css("width","auto");
		$(".collapseBtn").hide();
		$(".navcol-1").removeClass("col-sm-12");
		$(".navcol-1").addClass("col-sm-4");
		$(".navcol-2").removeClass("col-sm-12");
		$(".navcol-2").addClass("col-sm-8");
		$(".naviBtn").css("font-size","25px");
		$(".naviBtn").css("height","40px");
		$("#navbar").show();
		$(".topBtn").css("font-size","2vw");
		$(".navbar-dropdown").css("font-size","25px");
		$(".navbar-dropdown").css("text-align","left");
		$(".navbar-dropdown").css("width","auto");
	}


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
$(window).smartresize(function(){
	var win = $(this);
	if(win.width() <= 1150) {
		$("#navbar").addClass("btn-group-vertical");
		$("#navbar").removeClass("btn-group");
		$(".collapseBtn").show();
		$(".naviBtn").css("width",win.width());
		$(".navcol-1").addClass("col-sm-12");
		$(".navcol-1").removeClass("col-sm-4");
		$(".navcol-2").addClass("col-sm-12");
		$(".navcol-2").removeClass("col-sm-8");
		$("#navbar").hide();
		$(".naviBtn").css("font-size","6vh");
		$(".naviBtn").css("height","auto");
		$(".topBtn").css("font-size","4vw");
		$(".navbar-dropdown").css("font-size","4vw");
		$(".navbar-dropdown").css("text-align","center");
		$(".navbar-dropdown").css("width","100vw");
		$(".upBtn").css("width","6vw");
		$(".upBtn").css("height","6vw");
		$(".upBtn img").css("height","3vw");
		$(".upBtn img").css("width","3vw");
	} else {
		$("#navbar").removeClass("btn-group-vertical");
		$("#navbar").addClass("btn-group");
		$(".naviBtn").css("width","auto");
		$(".collapseBtn").hide();
		$(".navcol-1").removeClass("col-sm-12");
		$(".navcol-1").addClass("col-sm-4");
		$(".navcol-2").removeClass("col-sm-12");
		$(".navcol-2").addClass("col-sm-8");
		$(".naviBtn").css("font-size","25px");
		$(".naviBtn").css("height","40px");
		$("#navbar").show();
		$(".topBtn").css("font-size","2vw");
		$(".navbar-dropdown").css("font-size","25px");
		$(".navbar-dropdown").css("text-align","left");
		$(".navbar-dropdown").css("width","auto");
		$(".upBtn").css("width","4vw");
		$(".upBtn").css("height","4vw");
		$(".upBtn img").css("height","2vw");
		$(".upBtn img").css("width","2vw");
	}
});



/**
* fungsional kalender untuk halaman events
**/
