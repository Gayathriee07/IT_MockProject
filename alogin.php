<?php
session_start();
include("connect.php");

if(isset($_POST['login']))
{
$email=$_POST['email'];
$password=$_POST['password'];

$query="SELECT * FROM admin WHERE email='$email' AND password='$password'";
$result=pg_query($conn,$query);

if(pg_num_rows($result)>0)
{
$_SESSION['admin']=$email;
header("Location: adashboard.php");
exit();
}
else
{
$error="Invalid Email or Password";
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: 'Segoe UI', sans-serif;
}


body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;

    background:
        linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)),
        url('images/abg.jpg') no-repeat center center/cover;
}


.container,
.login-box{
    width:350px;
    padding:40px 30px;
    border-radius:15px;

    background: rgba(0,0,0,0.5);   /* better for flashy bg */
    backdrop-filter: blur(12px);

    box-shadow:0 15px 25px rgba(0,0,0,0.5);
    text-align:center;
    color:white;
}

/* HEADING */
h2{
    margin-bottom:20px;
    color:white;
    text-shadow: 0 0 10px rgba(0,255,200,0.7); /* glow */
}

/* INPUT FIELDS */
input{
    width:100%;
    padding:12px;
    margin:12px 0;

    border:none;
    border-bottom:2px solid rgba(255,255,255,0.5);

    background: transparent;
    color:white;
    outline:none;

    transition:0.3s;
}

input::placeholder{
    color:#ccc;
}

input:focus{
    border-color:#00ffcc;
}


button{
    width:100%;
    padding:12px;
    margin-top:15px;

    border:none;
    border-radius:25px;

    background: linear-gradient(135deg, #00ffcc, #00cc99);
    color:#003333;
    font-weight:bold;

    cursor:pointer;
    transition: all 0.3s ease;

    box-shadow: 0 0 10px rgba(0,255,200,0.6);

    animation: glow 2s infinite;
}

/* HOVER EFFECT */
button:hover{
    transform: scale(1.05);
    box-shadow: 0 0 25px rgba(0,255,200,1),
                0 0 40px rgba(0,255,200,0.6);
}

/* GLOW ANIMATION */
@keyframes glow{
    0%{
        box-shadow: 0 0 5px rgba(0,255,200,0.4);
    }
    50%{
        box-shadow: 0 0 20px rgba(0,255,200,1);
    }
    100%{
        box-shadow: 0 0 5px rgba(0,255,200,0.4);
    }
}

/* ERROR MESSAGE */
.error{
    color:#ff6b6b;
    margin-bottom:10px;
}

/* SWITCH LINKS (Login/Register) */
.switch{
    text-align:center;
    margin-top:15px;
}

.switch a{
    color:#00ffcc;
    text-decoration:none;
}

.switch a:hover{
    text-decoration:underline;
}
</style>

</head>

<body>

<div class="login-box">

<h2>Admin Login</h2>

<?php
if(isset($error)){
echo "<p class='error'>$error</p>";
}
?>

<form method="POST">

<input type="email" name="email" placeholder="Enter Email" required>

<input type="password" name="password" placeholder="Enter Password" required>

<button name="login">Login</button>

</form>

</div>

</body>
</html>
