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
	$result = $conn->query("SELECT * FROM `users`");
	$users = array();

	while ($row = $result->fetch_assoc()){
		array_push($users, $row);
	}
	$res['users'] = $users;
}

if ($action == 'create') {
	

	$userId = generateRandomString();
	$apartmentNumber = $_POST['apartmentNumber'];
	$password = $_POST['password'];



	$result = $conn->query("INSERT INTO `users` ( `userId` , `apartmentNUmber`, `password`) VALUES ('$userId' , '$apartmentNumber', '$password') ");
	if ($result) {
		$res['message'] = "User Added successfully";
	} else{
		$res['error'] = true;
		$res['message'] = "Insert User fail";
	}
}


if ($action == 'delete') {
	$id = $_POST['id'];

	$result = $conn->query("DELETE FROM `users` WHERE `id` = '$id'");
	if ($result) {
		$res['message'] = "User deleted successfully";
	} else{
		$res['error'] = true;
		$res['message'] = "User delete failed";
	}
}

if ($action == 'login') {

    $apartmentNumber = $_POST['apartmentNumber'];
	$password = $_POST['password'];

	$result = $conn->query("SELECT `apartmentNumber` AND `password` FROM `users` WHERE `apartmentNumber` = '$apartmentNumber' AND `password` = '$password'");
    $users = array();

    while ($row = $result->fetch_assoc()){
		array_push($users, $row);
	}

    if ($users) {

		$res['message'] = "correct password";
	} else{
		$res['error'] = true;
		$res['message'] = "wrong password" ;
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
