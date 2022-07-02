<html>
<head>
<meta charset="UTF-8">
<title>Update a Record in MySQL Database</title>
</head>
<body>
<?php
if(isset($_POST['update'])) {
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testphp1";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$id = $_POST['id1'];
$fname = $_POST['fname'];

$sql = "UPDATE topsite98 SET fname= '$fname' "."WHERE id = $id" ;
if ($conn->query($sql) === TRUE) {
echo "Record updated successfully";
} else {
echo "Error updating record: " . $conn->error;
}
$conn->close();
}else {
?>
<form method = "post" action = "<?php $_PHP_SELF ?>">
<label for="id1">id:</label><br>
<input type="text" id="id1" name="id1"><br>
<label for="fname">First name:</label><br>
<input type="text" id="fname" name="fname"><br>
<input name = "update" type = "submit" value ="Update">
</form>
<?php
}
?>
</body>
</html>