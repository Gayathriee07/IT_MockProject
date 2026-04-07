<?php
include("connect.php");
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Section</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

/* 🔥 BODY (same as dashboard) */
body{
    background-color:#0a192f;
    color:#ccd6f6;
}

/* 🔥 BOX (GLASS STYLE) */
.box{
    width:350px;
    margin:100px auto;
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

/* INPUT */
input{
    width:100%;
    padding:12px;
    margin:15px 0;

    border:none;
    border-bottom:2px solid rgba(255,255,255,0.5);

    background: transparent;
    color:white;
    outline:none;
}

input::placeholder{
    color:#aaa;
}

input:focus{
    border-color:#00ffcc;
}

/* 🔥 MINT BUTTON */
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

/* HOVER */
button:hover{
    transform: scale(1.05);
    box-shadow: 0 0 25px rgba(0,255,200,1),
                0 0 40px rgba(0,255,200,0.6);
}

/* BACK LINK */
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
<h2>Add Section</h2>

<form method="post">
<input type="text" name="name" placeholder="Enter Section Name" required>
<button type="submit" name="submit">Add Section</button>
</form>

<a href="adashboard.php" class="back">⬅ Back to Dashboard</a>

</div>

</body>
</html>

<?php
if(isset($_POST['submit'])){
    $name = $_POST['name'];

    $query = "INSERT INTO sections(name) VALUES('$name')";
    $result = pg_query($conn, $query);

    if($result){
        echo "<script>alert('Section Added Successfully');</script>";
    } else {
        echo "<script>alert('Error: ".pg_last_error($conn)."');</script>";
    }
}
?>
