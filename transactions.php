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
<div class="out2">
    <h1>TRANSACTIONS DETAILS</h1>
    <br>
        <br>
        <table>
<tr>
<th>From</th>
<th>T0</th>
<th>Amount</th>
<th>Date</th>
</tr>
<?php
        $servername = "localhost";
        $username = "root";
        $password = "";
      
  // Create connection
        $conn = new mysqli($servername, $username, $password,"banking");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
            $sql = "SELECT * FROM transactions";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
             {
            // output data of each row
            while($row = $result->fetch_assoc())
            {             
             echo "<tr>";
             echo "<td>".$row['sender']."</td>";
             echo "<td>".$row['receiver']."</td>";
             echo "<td>".$row['amount']."</td>";
             echo "<td>".$row['date']."</td>";
             echo "</tr>";   
            }
        }
            else {
                echo "0 results"; 
              }
              $conn->close();                        
?>
</table>
</div>
</body>
</html>