<?php
	require 'config/config.php';
	$conn = new Connector();
	if( isset($_POST['userId']) && isset($_POST['hotelId']))
	{

	$userId = $_POST['userId'];
	$hotelId = $_POST['hotelId'];
	//$userId = 3;
	//$hotelId = 2;


		$que1 = "SELECT * FROM hotel WHERE hotelId = '".$hotelId."'";
		$res = $conn->executeQuery($que1);
		$res = mysqli_fetch_assoc($res);
		$hotelcost = $res['roomCost'];

		$que2 = "SELECT * FROM users WHERE userId = '".$userId."'";
		$res2 = $conn->executeQuery($que2);
		$res2 = mysqli_fetch_assoc($res2);
		$money = $res2['money'];

		$remCost = $money - $hotelcost;
		

		if($remCost >= 0){
			$query = "insert into bookings (userId, hotelId) values (".$userId." , ".$hotelId.")";
			$conn->executeQuery($query);

			$query2 = "UPDATE users SET money = '".$remCost."' WHERE userId = '".$userId."'";
			$conn->executeQuery($query2);
			echo $userId . " " . $hotelId . " " . "Successfully Booked Your Hotel!";
		}else{
			echo $userId . " " . $hotelId . " " . "Hotel Cannot be Booked!";
		}
				
	}
	else 
		echo $userId . " " . $hotelId . " " . "UserId or HotelId not found!";
?>