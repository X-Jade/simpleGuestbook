<?php 
session_start();
include "database/db.php";
// $eventid = $_SESSION['eventid'];
$username = $_SESSION['username'];
// echo $userid;
if($username == NULL)
{
    header("location: ./login.php");
}

else
{ $username = $_GET['userid'];?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/view.css">
    <title>Guestbook</title>
</head>
<body>
    <!-- navbar -->
    <div class="navbar1">
        <div class="menu">
            <a href="controller/doLogout.php" class="list">Sign Out</a>
            <a href="#" class="list">About Us</a>
        </div>
        <a href="signup.php"><img src="./images/logo.png" alt="Logo" class="logo"></a>
    </div>

    <div class="container">
        

        <div class="body">
            <div class="heading">
                <h2>GUESTBOOK</h2>
                <!-- <h4>Event ID: <?=$eventid?></h4> -->
                <h4>Hello, <?=$username?></h4>
            </div>
            <br>
            <div class="form">
                <form action="controller/addMessage.php?userid=<?$username?>"  method="POST">
                    <div class="form-content">
                        <label for="name" class="label-heading">Name</label>
                        <br>
                        <input type="text" name="name" class="form-text">
                    </div>
                    <br>
                    <div class="form-content">
                        <label for="Message" class="label-heading">Message</label>
                        <br>
                        <input type="text" name="message" class="form-text">
                    </div>
                    <br>
                    <input type="submit" value="Submit" class="btn" id="submitbtn">
                </form>
            </div>
            <br>
            <div class="results">
                <h3>Messages</h3>
                <br>
                <table>
                
                    <tr>
                        <th id="no">No</th>
                        <th id="name">Name</th>
                        <th id="message">Message</th>
                    </tr>

                    <?php
                    $sql = "SELECT * FROM messages";
                    $dbresult = $conn->query($sql);
                    if($dbresult->num_rows>0){
                        while($row = $dbresult->fetch_assoc()){
                        ?>
                        <tr>
                            <td class="td-spacing"><?=$row['no']?></td>
                            <td class="td-spacing"><?=$row['name']?></td>
                            <td class="td-spacing"><?=$row['message']?></td>
                        </tr>
                        <?php
                        } 
                    }?>
                
                </table>
            </div>
        </div>
    </div>
</body>
</html>
<?php
}
?>