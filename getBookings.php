<?php
	require 'config/config.php';
	$conn = new Connector();
	session_start();
	$uname = $_SESSION['username'];

	$que = "SELECT userId from users where userName = '".$uname."'";
	$res = $conn->executeQuery($que);
	$row = mysqli_fetch_assoc($res);
	$userId = $row['userId'];
	//echo $userId;

	$query = "SELECT hotel.hotelname,hotel.roomCost from bookings INNER JOIN hotel ON bookings.hotelId = hotel.hotelId WHERE bookings.userId = '".$userId."'";

	if($result = $conn->executeQuery($query))
	{

		while($row = mysqli_fetch_array($result)) {
			
    	    $myArray[] = $row;
    	}
    	
    	echo json_encode($myArray);
	}else{
		echo "Query unsuccesfil";
	}
	

?>