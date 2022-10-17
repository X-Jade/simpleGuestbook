<?php 
session_start();

$username = $_SESSION['userid'];
if($username == NULL)
{
    header("location: ./login.php");
}
else
{
    header("location : ./view.php?userid=$username");
}