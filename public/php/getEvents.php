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
	// Create connection
	$conn = connectDB();
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$date = $_GET["year"]."-".$_GET["month"]."-".$_GET["day"];
	$lang = $_GET["lang"];
	$sql = "SELECT * FROM event_posts WHERE date='".$date."'";
	$result = mysqli_query($conn, $sql);

	echo "<h2 class='date-title' id='currentDate'> ".$_GET["day"]." ".date('F', mktime(0, 0, 0, $_GET["month"], 10))." ".$_GET["year"]." </h2>";
	if(mysqli_num_rows($result) > 0) {
		foreach($result as $event) {
			echo '<div class="postEvents row">';
			echo '	<div class="imgEvents col-md-4">';
			echo '		<img src="';
			echo     	'http://kridabudaya.com/'.$event['imageURL'];
			echo    	'">';
			echo '	</div>';
			echo '	<div class="infoEvents col-md-8">';
			echo '		<table>';
			echo '			<tr>';
			echo '				<div class="titleEvents">';
			echo '					<h2>'.( strcmp($lang,'en')==0 ? $event['titleen'] : $event['titleid'] ).'</h2>';
			echo '				</div>';
			echo '			</tr>';
			echo '			<tr> ';
			echo '				<p style="text-align: justify; color: black" class="py-4 snippetEvents">';
			echo 				(strcmp($lang,'en') == 0 ? $event['snippeten'] : $event['snippetid'] )	;
			echo '				<a  onclick="goto('.$event['id'].')" style="color: #20d0ff;">Read More</a></p>';
			echo '			</tr>';
			echo '		</table>';
			echo '	</div>';
			echo '</div>';
			echo '<br>';
		}
	} else {
	    	echo "<p style='text-align: justify; color: black' id='currentEvent'> NO EVENTS(S) </p>";
	}
?>
