<?php
$conn = pg_connect("host=localhost dbname=sppp_db user=postgres password=sppp123");

if(!$conn){
    die("Connection failed");
}
?>
