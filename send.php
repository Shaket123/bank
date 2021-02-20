<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <h4 class="a1">FBANK</h4>
    <nav>
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="accounts.php">ACCOUNTS</a></li>
            <li><a href="transactions.php">TRANSATIONS</a></li>
            <li><a href="send.php">SEND</a></li>
        </ul>
    </nav>
    <div class="out1">

        <h1>SEND MONEY</h1>
        <br>
        <br>
        <br>
<form action="send.php" method="post">
<label for="">To</label><br>
<input type="number" name="a1"><br><br>
<label for="">from</label><br>
<input type="number" name="a2"><br><br>
<label for="">amount</label><br>
<input type="number" name="a3"><br><br>
<input type="submit">
</form>
    </div>
</body>
</html>


<?php

if(isset($_POST['a1'])&&$_POST['a2']&&$_POST['a3'])
{
    $a1=$_POST['a1'];
    $a2=$_POST['a2'];
    $a3=$_POST['a3'];
    echo $a1." ".$a2." ".$a3;

    $servername = "localhost";
    $username = "root";
    $password = "";
  
// Create connection
    $conn = new mysqli($servername, $username, $password,"banking");

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
        $sql1 = "SELECT * FROM users where account_no=$a1";
        $sql2 = "SELECT * FROM users where account_no=$a2";
        $result1 = $conn->query($sql1);
        $result2 = $conn->query($sql2);
        $row1 = $result1->fetch_assoc();
        $row2 = $result2->fetch_assoc();

        if (($result1->num_rows > 0) && ($result2->num_rows > 0)) 
         {
        
             if($row1['balance']>$a3)
             {
                 //insert into table
                 $da=(string)date("d-m-Y--h-i-sa");
                 
                 $sql4 = " INSERT INTO `transactions`(`sender`, `receiver`, `amount`, `date`) VALUES ('$a1','$a2','$a3','$da')";
                 $result4 = $conn->query($sql4);
                 $c=$row1['balance']-$a3;
                 $q=$row2['balance']+$a3;
                 $na=$row1['account_no'];
                 $nb=$row2['account_no'];
                 $sql5 = " UPDATE `users` SET `balance`='$c' WHERE account_no='$na'";
                 $result5 = $conn->query($sql5);
                 $sql6 = " UPDATE `users` SET `balance`='$q' WHERE account_no='$nb'";
                 $result6 = $conn->query($sql6);
                 


                 if ($conn->query($sql6) === TRUE) {
                    echo "New record created successfully";
                  } else {
                    echo "Error: " . $sql6 . "<br>" . $conn->error;
                  } 

             }
             else{
                 echo "alert('insufficient balance')";
             }
        
        }
        else {
            echo "0 results"; 
          }
          $conn->close(); 

}



?>
