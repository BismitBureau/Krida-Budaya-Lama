var bulan,tahun;
$(document).ready(function() {
	bulan = new Date().getMonth() + 1;
	tahun = new Date().getFullYear();
	generateCalendar();

	$("#calendarNext").click(function() {
		nextMonth();
	});

	$("#calendarPrev").click(function() {
		prevMonth();
	});

});

function nextMonth() {
	bulan++;
	if(bulan > 12) {
		bulan = 1;
		tahun++;
	}
	generateCalendar();
}

function prevMonth() {
	bulan--;
	if(bulan < 1) {
		bulan = 12;
		tahun--;
	}
	generateCalendar();
}

function generateCalendar() {
	 $.get("//localhost:9000/php/getCalendar.php?q=gen",{ 'month': bulan, 'year': tahun }, function(data){
       	$(".calendar").html(data);
    });

}
