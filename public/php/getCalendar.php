<?php

	function connectDB(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "u3539718_kridabudaya";

		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);

		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		return $conn;
	}


	date_default_timezone_set("Asia/Jakarta");
	$q = $_REQUEST["q"];
	$todayDate = date("d");
	$todayMonth = date("m");
	$todayYear = date("Y");
	$hour = date("G");
	$minute = date("i");

	if(strcmp($q,"gen")==0) {
		generate();
	} else if(strcmp($q,"date")==0) {
		echo $day;
	} else if(strcmp($q,"month")==0) {
		echo "".$month;
	} else if(strcmp($q,"year")==0) {
		echo "".$year;
	};



	function generate() {
		$month = $_GET["month"];
		$year = $_GET["year"];
		$monthName = date("F", mktime(0, 0, 0, $month,1, $year));
		$maxDay = cal_days_in_month(CAL_GREGORIAN,$month,$year);
		$days = array("Sunday"=>0, "Monday"=>1,"Tuesday"=>2,"Wednesday"=>3,"Thursday"=>4,"Friday"=>5,"Saturday"=>6);
		$curDay = 1 - $days[date("l",mktime(0, 0, 0, $month,1 , $year))];

		// Create connection
		$conn = connectDB();
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		echo "<header class='cal-head'>";

		echo "<h2 class='cal-h2'>".$monthName." ".$year." </h2>";
		echo "<table class='cal-table'>";
		echo "	<tr class='cal-tr'>";
		echo "		<td class='cal-td'> Sun </td>";
		echo "		<td class='cal-td'> Mon </td>";
		echo "		<td class='cal-td'> Tue </td>";
		echo "		<td class='cal-td'> Wed </td>";
		echo "		<td class='cal-td'> Thu </td>";
		echo "  	<td class='cal-td'> Fri </td>";
		echo "		<td class='cal-td'> Sat </td>";
		echo "	</tr>";
		for($i = 0; $i < 5; $i++) {
			echo "<tr class='cal-tr'>";
			for($j = 0; $j <7; $j++) {
				$sql = "SELECT * FROM event_posts WHERE date='".$year."-".$month."-".$curDay."'";
				// echo $sql."<br>";
				// if($curDay > 0 && $curDay <= $maxDay)
				$result = mysqli_query($conn, $sql);
				echo "<td ";
				if($GLOBALS["todayDate"] == $curDay && $GLOBALS["todayMonth"] == $month && $GLOBALS["todayYear"] == $year)
					echo "class='calendarToday cal-td selected'";
				else if(mysqli_num_rows($result) > 0) {
					echo "class='calendarEvent cal-td selected-event'";
				}
				if($curDay > 0 && $curDay <= $maxDay)
					echo "class='calendarEvent cal-td' onclick='getEvents(".$curDay.",".$month.",".$year.")'";
				echo ">";

				if($curDay > 0 && $curDay <= $maxDay) {
					echo $curDay;
				}
				$curDay++;
				echo "</td>";
			}
			echo "</tr>";
		}

		echo "<tr class='cal-tr'>";
		for($j = 0; $j <2; $j++) {
			echo "<td class='cal-td'";
			echo ">";

			if($curDay > 0 && $curDay <= $maxDay) {
				echo $curDay;
			}
			$curDay++;
			echo "</td>";
		}
		echo "</tr>";
		echo "</table>";
	};
?>
