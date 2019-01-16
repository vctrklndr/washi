<?php
header("Access-Control-Allow-Origin: *");

$conn = new mysqli("mikahl.se.mysql", "mikahl_se_washio", "qwerty123456", "mikahl_se_washio");
if ($conn->connect_error) {
	die("Database connection established Failed..");
}
$res = array('error' => false);

$action = 'read';

if (isset($_GET['action'])) {
	$action = $_GET['action'];
}

if ($action == 'read') {
	$result = $conn->query("SELECT * FROM `bookings`");
	$bookings = array();

	while ($row = $result->fetch_assoc()){
		array_push($bookings, $row);
	}
	$res['bookings'] = $bookings;
}

if ($action == 'create') {
	

	$apartmentNumber = $_POST['apartmentNumber'];
	$bookingId = generateRandomString();
	$selectedTime = $_POST['selectedTime'];
	$selectedDate = $_POST['selectedDate'];

	$result = $conn->query("INSERT INTO `bookings` ( `bookingId` , `bookingTime`, `bookingDate`, `apartmentNumber`) VALUES ('$bookingId' , '$selectedTime', '$selectedDate', '$apartmentNumber') ");
	if ($result) {
		$res['message'] = "User Added successfully";
	} else{
		$res['error'] = true;
		$res['message'] = "Insert User fail";
	}
}


if ($action == 'delete') {
	$apartmentNumber = $_POST['apartmentNumber'];


	$result = $conn->query("DELETE FROM `bookings` WHERE `apartmentNumber` = '$apartmentNumber'");
	if ($result) {
		$res['message'] = "booking deleted successfully";
	} else{
		$res['error'] = true;
		$res['message'] = "$apartmentNumber";
	}
}




$conn -> close();
header("Content-type: application/json");
echo json_encode($res);
die();


function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}


 ?>
