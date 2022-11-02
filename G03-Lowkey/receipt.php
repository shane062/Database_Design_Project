<?php
session_start();
?>

<?php include "dbConnection_arngren.php";
		if(isset($_POST['insert_records']) && isset($orderID) && isset($userID) && isset($total)){
		$orderID = $_POST['orderID'];
		$userID = $_POST['userID'];
		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$orderDate = $_POST['orderDate'];
		$orderTime = $_POST['orderTime'];
		$total = $_POST['total'];
		$address = $_POST['address'];
		$state = $_POST['state'];
		$city = $_POST['city'];
		$zip = $_POST['zip'];

		makePayment($orderID, $userID, $fullname, $email, $orderDate, $orderTime, $total, $address, $state, $city, $zip);
	}
  ?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Receipt | ARNGREN</title>
<style type="text/css">
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    margin-left: auto;
    margin-right: auto;
}
.image{
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 10%;
}
h1{
    text-align: left;
    font-family: lucida calligraphy;
}
.thanks{
    text-align: center;
    font-family: lucida calligraphy;
}
.backtomain{
  font: bold 13px Arial;
  text-decoration: none;
  background-color: #04AA6D;
  color: white;
  padding: 2px 6px 2px 6px;
  border-top: 1px solid #CCCCCC;
  border-right: 1px solid #333333;
  border-bottom: 1px solid #333333;
  border-left: 1px solid #CCCCCC;
  margin-left: 45%;
  margin-right: 45%;
  text-align: center;
  display: block;
  border-radius: 5px;
}
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin-left: auto;
  margin-right: auto;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
  margin-left: auto;
  margin-right: auto;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
  margin-left: auto;
  margin-right: auto;
}
.notify{
  text-align: center;
}
</style>
</head>
<body>
  <br><br>
  <hr>
  <br><br>
<img src="arngrenlogo.png" class="image">
<h1>RECEIPT <?php             global $conn;
                              $sql = "SELECT userID FROM user WHERE logStatus = 1";
                              $result = mysqli_query($conn, $sql);
                              
                              if ($result !== false && $result->num_rows > 0) 
                              {
                                while ($row = $result -> fetch_assoc())
                                {
                                  
                                  echo $row['userID'];
                                  
                                  
                                }
                              } ?></h1>
<br><br>
<h3>ARNGREN.NET</h3>
<h3>Sondrevegen 3K</h3>
<h3>0378 Oslo, Norway</h3>
<br><br>
<h4>Receipt To:</h4>
<?php $fullname = $_POST['fullname'];
              echo $_POST['fullname']
              ?>
<br><br>
<h4>With Email:</h4>
<?php $email = $_POST['email'];
              echo $_POST['email']
              ?>
<br><br>
<h4>Ship To:</h4>
<?php $fullname = $_POST['address'];
              echo $_POST['address']
              ?>
<br><br>
<h4>Order Date:</h4>
<?php $fullname = $_POST['orderDate'];
              echo $_POST['orderDate']
              ?>
<br><br>
<h4>Order Time:</h4>
<?php $fullname = $_POST['orderTime'];
              echo $_POST['orderTime']
              ?>
  <br><br>
  <hr>
  <br>
  <table id="customers">
  <tr>
      <th>Order ID</th>
      <th>User ID</th>
      <th>Quantity</th>
      <th>Product Name</th>
      <th>Total (kr)</th>
    </tr>
    <tr>
    <td><?php       if (isset($_SESSION["orderID"])){
        echo $_SESSION["orderID"];
      }
              ?></td>

      <td><?php       if (isset($_SESSION["userID"])){
        echo $_SESSION["userID"];
      }
              ?></td>
      
      <td><?php       if (isset($_SESSION["quantityOfProduct"])){
        echo $_SESSION["quantityOfProduct"];
      }
              ?></td>
      
      <td><?php       if (isset($_SESSION["nameProduct"])){
        echo $_SESSION["nameProduct"];
      }
              ?></td>
              <td><?php       if (isset($_SESSION["total"])){
        echo $_SESSION["total"];
      }
              ?></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <th>Tax (6%)</th>
      <td><?php $x = $_SESSION["total"];
                  $y = 0.06;
                  echo $x*$y;?></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <th>Merchandise Total (kr)</th>
      <td><?php                   $x = $_SESSION["total"];
                  $y = 0.06;
                  $z = $x*$y;
                  echo $x + $z;
                  $j = $x + $z;
                  $_SESSION["merchtotal"] = "$j";?></td>
    </tr>
</table>
<br>
<h3 class="notify" >Your receipt has been send through your email: <a href="<?php $email = $_POST['email'];
              echo $_POST['email']
              ?>"><?php $email = $_POST['email'];
              echo $_POST['email']
              ?></a></h3>
  <br>
  <h2 class="thanks">THANK YOU FOR YOUR PURCHASE</h2>
  <br>
  
  <br>
  <a href="index.php" class="backtomain">Return To Home Page</a>
  <br><br>
</body>
</html>
