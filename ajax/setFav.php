<?php 
session_start();
require_once("../class/UserClass.php");
$data = '';
if(isset($_POST['adId'])){
	$UserClass = new UserClass();
	$data = $UserClass->setFav($_POST['adId'], $_SESSION['UserId']);
}
echo $data;