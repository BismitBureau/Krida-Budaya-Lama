$(document).ready(function() {
  check_if_in_view();

  $(window).on("scroll resize",check_if_in_view);

  });
  
var lang;
var mobile = false;

function readmore(id) {
	if(!mobile)
		location.href="http://kridabudaya.com/"+ lang +"/news/" + id;
	else
		location.href="http://kridabudaya.com/m/"+ lang +"/news/" + id;
}

function check_if_in_view() {
  var window_height = $(window).height();
  var window_top_position = $(window).scrollTop();
  var window_bottom_position = (window_top_position + window_height);

  $.each($(".postNews"), function() {
    var $element = $(this);
    var element_height = $element.outerHeight();
    var element_top_position = $element.offset().top;
    var element_bottom_position = (element_top_position + element_height);

    //check to see if this current container is within viewport
    if ((element_bottom_position >= window_top_position) &&
        (element_top_position <= window_bottom_position)) {
      $element.addClass("showContent");
    }
  });
}