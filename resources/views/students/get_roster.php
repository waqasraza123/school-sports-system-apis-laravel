<?php

	$roster_id = $_POST['roster_title'];
	
	$query = "SELECT * FROM rosters WHERE id = '$roster_id'";
    $result = mysqli_query($roster_name);
    $row = mysqli_fetch_array($result);
        $roster_name = $row['name'];
		
    $rosterData = array(
					"roster_name" => $roster_name,
					);
	echo json_encode($rosterData);


?>