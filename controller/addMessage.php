<?php
session_start();
include "./../database/db.php";
$username = $_SESSION['username'];

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    date_default_timezone_set('America/Chicago');
    $info = getdate();
    $date = $info['mday'];
    $month = $info['mon'];
    $year = $info['year'];
    $hour = $info['hours'];
    $min = $info['minutes'];
    $sec = $info['seconds'];

    $username = $_SESSION['userid'];

    $current_date = date("F j Y g:i a");
    $name = $_POST['name'];
    $message = $_POST['message'];

    if($name == NULL || $message == NULL)
    {
    	$_SESSION['failAddGuest'] = 'Every form must be filled!';
        header("Location: ./../view.php");
    }
    else
    {
        $username = $_SESSION['username'];
        $sql = "INSERT INTO messages VALUES (null, '$name', '$message')";
	    $addGuest = $conn->query($sql);
        $_SESSION['msg'] = 'add message Success!';
	    header("location: ./../view.php");
    }
}

?>