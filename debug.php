<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("connect.php");
?>


<?php
include("connect.php");

echo "Connected Successfully<br><br>";

// SHOW TABLES
$tables = mysqli_query($conn, "SHOW TABLES");

echo "<h3>Tables:</h3>";

while($t = mysqli_fetch_array($tables)){
    echo $t[0] . "<br>";
}

echo "<br><hr><br>";

// FETCH DATA
$result = mysqli_query($conn, "SELECT * FROM sections");

if(!$result){
    die("Query Error: " . mysqli_error($conn));
}

echo "<h3>Section Data:</h3>";

while($row = mysqli_fetch_assoc($result)){
    echo $row['id'] . " - " . $row['name'] . "<br>";
}
?>
