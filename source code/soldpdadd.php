<?php
 session_start();
 if(isset($_SESSION['user']))
 {

 }
 else{
  echo"<script>location.href='login.html'</script>";
 }
?>
<!doctype html>
<html>
<head>
  <title>
  Salesdetails
  </title>
<style>
  
  body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background: #484848;
}
.topnav {
  overflow: hidden;
  background-color: rgba(249, 105, 14, 1);
  height: 70px;
  border: 3px solid #e69500;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 35px;
  font-weight: bold;
}

.topnav-right {
  float: right;
}

fieldset { max-width: 450px;
  background: #FAFAFA;
	padding: 30px;
	margin: 50px auto;
	box-shadow: 1px 1px 25px rgba(0, 0, 0, 0.35);
	border-radius: 10px;
	border: 6px solid rgba(249, 105, 14, 1);


}

legend {
  padding: 0.2em 0.5em;
  border:2px solid rgba(249, 105, 14, 1);
  color:green;
  font-size:90%;
  text-align:center;
  }
</style>
  </head>
<body>
<div class="topnav">
            <a class="active" href="home.html"><img src="ic_add_pet.png"></a>
            <a href="sales.php">Sales details</a>
            <div class="topnav-right">
              <a href="logout.php">logout</a>
            </div>
          </div>
<form>
    <button type="submit" formaction="soldproducts.php" style="margin:15px;height: 30px;width: 100px;
    border-radius:15px;
border: 3px solid #e69500;background-color: rgba(249, 105, 14, 1);color:#f2f2f2;font-size:15px;cursor:pointer;">Back</button>
</form>  
<form method="post" action="soldpdadd.php"  >  
<fieldset>
  <input type="text" name="id" placeholder="Enter sales details id" style="width:100%;height:30px;
    border: 2px solid rgba(249, 105, 14, 1); border-radius:5px; background:transparent;" required>
  <br><br>
  <input type="text" name="pp" placeholder="Enter product id" style="width:100%;height:30px;
    border: 2px solid rgba(249, 105, 14, 1); border-radius:5px;  background:transparent;" required>
  <br><br>
   <input type="number" name="quantity" placeholder="Enter no. of quantity " style="width:100%;height:30px;
    border: 2px solid rgba(249, 105, 14, 1); border-radius:5px;  background:transparent;" min="1" required>
  <br><br>
  <input type="submit" name="submit" value="ADD" style="width:100%;height:30px;
    border: 2px solid rgba(249, 105, 14, 1); border-radius:5px; cursor:pointer;background-color: rgba(249, 105, 14, 1)">&ensp;  
  </fieldset>
</form> 
</body>
</html>
<?php
if(isset($_POST["submit"]))
{
 // define variables and set to empty values
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Petshop_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "  CONNECTION ESTABLISHED \r\n";
//echo "  INSERTION IN PROCESS";
$id = $_POST["id"];
  $pp_id = $_POST["pp"];
 $quantity=$_POST["quantity"];




$sql = "INSERT INTO sold_products( sd_id,pp_id,quantity)
VALUES ('$id','$pp_id','$quantity')";
if ($conn->query($sql) == TRUE) {
  echo'<div>
  <h1 style="color:#f2f2f2;font-size:20px; font-family: "Roboto", sans-serif;margin:auto;">New record of sales_id='
  .$id.'and pp_id='.$pp_id. ' inserted successfully</h1>
     </div>';
    $conn->query("call calculations_for_product('$pp_id','$id','$quantity')");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}

?>