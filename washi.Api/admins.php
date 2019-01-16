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
	$result = $conn->query("SELECT * FROM `admins`");
	$admins = array();

	while ($row = $result->fetch_assoc()){
		array_push($admins, $row);
	}
	$res['users'] = $admins;
}

if ($action == 'create') {
	
	$adminId = generateRandomString();
	$adminName = $_POST['adminName'];
	$password = $_POST['password'];


	$result = $conn->query("INSERT INTO `admins` ( `adminId` , `adminName`, `password`) VALUES ('$adminId' , '$adminName', '$password') ");
	if ($result) {
		$res['message'] = "User Added successfully";
	} else{
		$res['error'] = true;
		$res['message'] = "Insert User fail";
	}
}


if ($action == 'update') {
	$id = $_POST['id'];
	$username = $_POST['username'];



	$result = $conn->query("UPDATE `users` SET `username` = '$username', `email` = '$email', `mobile` = '$mobile'WHERE `id` = '$id'");
	if ($result) {
		$res['message'] = "User Updated successfully";
	} else{
		$res['error'] = true;
		$res['message'] = "User Update failed";
	}
}


if ($action == 'delete') {
	$id = $_POST['id'];

	$result = $conn->query("DELETE FROM `admins` WHERE `id` = '$id'");
	if ($result) {
		$res['message'] = "User deleted successfully";
	} else{
		$res['error'] = true;
		$res['message'] = "User delete failed";
	}
}

if ($action == 'login') {

    $adminName = $_POST['adminName'];
	$password = $_POST['password'];

	$result = $conn->query("SELECT `adminName` AND `password` FROM `admins` WHERE `adminName` = '$adminName' AND `password` = '$password'");
    $users = array();

    while ($row = $result->fetch_assoc()){
		array_push($admins, $row);
	}

    if ($admins) {

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
