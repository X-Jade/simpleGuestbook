<?php
include "./../database/db.php";


if($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    // $eventID = $_POST['eventid'];
    
    //$hashpassword=sha1($password);

    //$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$hashpassword'";
    //select nya belum ada db event ID
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = $conn->query($sql);

    // $sql2 = "SELECT * FROM events WHERE eventID = '$eventID'";
    // $result2 = $conn->query($sql2);

    session_start();

    if($result->num_rows > 0) 
    {
        // login successful

        $row=$result->fetch_assoc();
        $dbpass=$row['password'];
        $userid = $row['userID'];
        if($dbpass==sha1($password))
        {
            session_regenerate_id();
            $_SESSION['username'] = $username;
            // $_SESSION['userid'] = $userid;
            // redirect('./../view.php');

            header("location: ./../view.php");
            
            // if($result2->num_rows > 0)
            // {
            //     $row2=$result2->fetch_assoc();
                
            //     if($eventID==$row2['eventID'])
            //     {
            //         $_SESSION['eventid'] = $eventID;
            //         header("location: ./../view.php?userid=$userid");
            //     }
            //     else
            //     {
            //     //prompt membuat event baru
            //         $_SESSION['eventid'] = $eventID;
            //         header("location: ./../eventnotexist.php?userid=$userid");
            //         // die ("event tidak ditemukan");
            //     }
            // }

            // else
            // {
            //     //prompt membuat event baru
            //     $_SESSION['eventid'] = $eventID;
            //     header("location: ./../eventnotexist.php?userid=$userid");
            //     // die ("event tidak ditemukan");
            // }
            
        }
        else
        {
            $_SESSION['error'] = 'Invalid email or password';
            header("location: ./../login.php");
        }
    }
    else
    {
        $_SESSION['error'] = 'Invalid email or password';
        header("location: ./../login.php");
    }
}
?>