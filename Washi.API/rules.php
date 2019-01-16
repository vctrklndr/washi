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
	$result = $conn->query("SELECT * FROM `rules`");
	$rules = array();

	while ($row = $result->fetch_assoc()){
		array_push($rules, $row);
	}
	$res['rules'] = $rules;
}

if ($action == 'create') {
	

	$textId = generateRandomString();
	$textField = $_POST['textField'];

	$result = $conn->query("INSERT INTO `rules` ( `textField` , `textId`) VALUES ('$textField' , '$textId') ");
	if ($result) {
		$res['message'] = "Text Added successfully";
	} else{
		$res['error'] = true;
		$res['message'] = "Insert Text fail";
	}
}


if ($action == 'update') {
    
	$textId = $_POST['textId'];
	$textField = $_POST['textField'];


	$result = $conn->query("UPDATE `rules` SET `textField` = '$textField 'WHERE `textId` = '$textId'");
	if ($result) {
		$res['message'] = "Text Updated successfully";
	} else{
		$res['error'] = true;
		$res['message'] = "Text Update failed";
	}
}


if ($action == 'delete') {

	$result = $conn->query("DELETE FROM `rules`");
	if ($result) {
		$res['message'] = "User deleted successfully";
	} else{
		$res['error'] = true;
		$res['message'] = "User delete failed";
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
