<?php
include("connect.php");
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Mock Test</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}


body{
    background-color:#0a192f;
    color:#ccd6f6;
}


.box{
    width:380px;
    margin:80px auto;
    padding:30px;
    border-radius:15px;

    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(10px);

    box-shadow:0 10px 30px rgba(0,0,0,0.6);
    text-align:center;

    border:1px solid rgba(255,255,255,0.08);
}

/* HEADING */
h2{
    margin-bottom:20px;
    color:#00ffcc;
    text-shadow:0 0 10px rgba(0,255,200,0.6);
}

/* INPUT + SELECT */
input, select{
    width:100%;
    padding:12px;
    margin:15px 0;

    border:none;
    border-bottom:2px solid rgba(255,255,255,0.5);

    background: transparent;
    color:white;
    outline:none;
}

/* FIX DROPDOWN TEXT COLOR */
select{
    background-color:#0a192f;
}

/* PLACEHOLDER */
input::placeholder{
    color:#aaa;
}

/* FOCUS EFFECT */
input:focus, select:focus{
    border-color:#00ffcc;
}


button{
    width:100%;
    padding:12px;
    margin-top:10px;

    border:none;
    border-radius:25px;

    background: linear-gradient(135deg, #00ffcc, #00cc99);
    color:#003333;
    font-weight:bold;

    cursor:pointer;
    transition: all 0.3s ease;

    box-shadow: 0 0 10px rgba(0,255,200,0.6);
}


button:hover{
    transform: scale(1.05);
    box-shadow: 0 0 25px rgba(0,255,200,1),
                0 0 40px rgba(0,255,200,0.6);
}


.back{
    display:block;
    margin-top:15px;
    text-decoration:none;
    color:#8892b0;
    transition:0.3s;
}

.back:hover{
    color:#00ffcc;
}
</style>
</head>

<body>

<div class="box">
<h2>Add Mock Test</h2>

<form method="post">

<!-- Title -->
<input type="text" name="title" placeholder="Enter Test Title" required>

<!-- Section Dropdown -->
<select name="section_id" required>
<option value="">Select Section</option>

<?php
$query = "SELECT * FROM sections";
$result = pg_query($conn, $query);

if(!$result){
    die("Error: " . pg_last_error($conn));
}

while($row = pg_fetch_assoc($result)){
    echo "<option value='".$row['id']."'>".$row['name']."</option>";
}
?>
</select>

<!-- Level -->
<input type="text" name="level" placeholder="Enter Level (Easy/Medium/Hard)" required>

<button type="submit" name="submit">Add Mock Test</button>

</form>

<a href="adashboard.php" class="back">⬅ Back to Dashboard</a>

</div>

</body>
</html>

<?php
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $section_id = $_POST['section_id'];
    $level = $_POST['level'];

    $query = "INSERT INTO mock_tests(title, section_id, level)
              VALUES('$title', '$section_id', '$level')";

    $result = pg_query($conn, $query);

    if($result){
        echo "<script>alert('Mock Test Added Successfully');</script>";
    } else {
        echo "<script>alert('Error: ".pg_last_error($conn)."');</script>";
    }
}
?>
