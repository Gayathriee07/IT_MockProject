<?php
session_start();

if(!isset($_SESSION['admin'])){
header("Location: alogin.php");
exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

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
min-height:100vh;
}


.header{
text-align:center;
padding:25px;
font-size:28px;
font-weight:bold;
color:#00ffcc;
text-shadow:0 0 10px rgba(0,255,200,0.6);
}


.container{
display:flex;
justify-content:center;
flex-wrap:wrap;
gap:30px;
padding:40px;
}


.card{
background: rgba(255,255,255,0.05);
width:220px;
height:150px;
border-radius:15px;

display:flex;
flex-direction:column;
justify-content:center;
align-items:center;

text-decoration:none;
color:#ccd6f6;
font-size:18px;
font-weight:bold;

border:1px solid rgba(255,255,255,0.08);
backdrop-filter: blur(10px);

transition:0.3s ease;
}

/* HOVER EFFECT */
.card:hover{
transform:translateY(-10px);
background: rgba(255,255,255,0.1);
box-shadow:0 10px 30px rgba(0,0,0,0.6);
}

/* ICON */
.icon{
font-size:40px;
margin-bottom:10px;
color:#00ffcc;
}


.logout{
display:block;
width:150px;
margin:30px auto;
padding:12px;
text-align:center;

background: linear-gradient(135deg, #00ffcc, #00cc99);
color:#003333;

text-decoration:none;
border-radius:25px;
font-weight:bold;

transition:0.3s;
box-shadow:0 0 10px rgba(0,255,200,0.6);
}

/* HOVER */
.logout:hover{
transform:scale(1.05);
box-shadow:0 0 25px rgba(0,255,200,1),
           0 0 40px rgba(0,255,200,0.6);
}
</style>

</head>

<body>

<div class="header">
Admin Dashboard
</div>

<div class="container">

<a class="card" href="add_sections.php">
<div class="icon">📂</div>
Add Section
</a>

<a class="card" href="add_mtests.php">
<div class="icon">📝</div>
Add Mock Test
</a>

<a class="card" href="add_qpage.php">
<div class="icon">❓</div>
Add Question
</a>

<a class="card" href="view_resultss.php">
<div class="icon">📊</div>
View Results
</a>

</div>

<a class="logout" href="logout.php">Logout</a>

</body>
</html>
