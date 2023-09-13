<?php 
session_start(); 
require_once("class/UserClass.php");
$user = new UserClass();

$logout = $user->logout();

echo '<script>window.location.href="'.$logout['location'].'"</script>';