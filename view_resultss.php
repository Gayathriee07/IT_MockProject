<?php
session_start();
include("connect.php");

// Query
$query = "SELECT users.name, mock_tests.title, result.best_score
          FROM result
          JOIN users ON result.user_id = users.id
          JOIN mock_tests ON result.mock_id = mock_tests.id";

$result = pg_query($conn, $query);

if(!$result){
    die("Error: " . pg_last_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
<title>View Results</title>

<style>
body{
    margin:0;
    font-family:'Segoe UI', sans-serif;
    background-color:#0a192f;
    color:white;
}

h2{
    text-align:center;
    margin-top:30px;
    color:#00ffcc;
}

/* TABLE */
table{
    width:80%;
    margin:40px auto;
    border-collapse:collapse;
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(10px);
    border-radius:10px;
    overflow:hidden;
}

th, td{
    padding:12px;
    text-align:center;
}

th{
    background:#00ffcc;
    color:#003333;
}

tr:nth-child(even){
    background: rgba(255,255,255,0.05);
}

tr:hover{
    background: rgba(0,255,200,0.1);
}

/* BACK BUTTON */
.back{
    display:block;
    width:200px;
    margin:20px auto;
    padding:10px;
    text-align:center;
    background:#00ffcc;
    color:#003333;
    text-decoration:none;
    border-radius:25px;
    font-weight:bold;
}

.back:hover{
    box-shadow:0 0 15px #00ffcc;
}
</style>
</head>

<body>

<h2>📊 Student Results</h2>

<table>
<tr>
    <th>Student Name</th>
    <th>Mock Test</th>
    <th>Score</th>
</tr>

<?php
while($row = pg_fetch_assoc($result)){
    echo "<tr>
            <td>".$row['name']."</td>
            <td>".$row['title']."</td>
            <td>".$row['best_score']."</td>
          </tr>";
}
?>

</table>

<a href="adashboard.php" class="back">⬅ Back to Dashboard</a>

</body>
</html>
