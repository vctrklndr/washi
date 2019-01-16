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
	$result = $conn->query("SELECT * FROM `logo`");
	$logo = array();

	while ($row = $result->fetch_assoc()){
		array_push($logo, $row);
	}
	$res['logo'] = $logo;
}

if ($action == 'create') {
	

	$urlId = generateRandomString();
	$logoUrl = $_POST['logoUrl'];

	$result = $conn->query("INSERT INTO `logo` ( `urlId` , `logoUrl`) VALUES ('$urlId' , '$logoUrl') ");
	if ($result) {
		$res['message'] = "logo Added successfully";
	} else{
		$res['error'] = true;
		$res['message'] = "Insert logo fail";
	}
}


if ($action == 'update') {

	$urlId = $_POST['urlId'];
	$logoUrl = $_POST['logoUrl'];


	$result = $conn->query("UPDATE `logo` SET `logoUrl` = '$logoUrl' WHERE `urlId` = '$urlId'");
	if ($result) {
		$res['message'] = "logo Updated successfully";
	} else{
		$res['error'] = true;
		$res['message'] = "logo Update failed";
	}
}


if ($action == 'delete') {
	$urlId = $_POST['urlId'];

	$result = $conn->query("DELETE FROM `logo` WHERE `urlId` = '$urlId'");
	if ($result) {
		$res['message'] = "logo deleted successfully";
	} else{
		$res['error'] = true;
		$res['message'] = "logo delete failed";
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
