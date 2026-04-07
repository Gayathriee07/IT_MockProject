<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connect.php");

if(isset($_POST['register'])){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Use parameterized query to prevent SQL injection
    $query = "INSERT INTO users (name, email, password) VALUES ($1, $2, $3)";
    $result = pg_query_params($conn, $query, array($name, $email, $hashed_password));

    if($result){
        header("Location: login.php");
        exit();
    } else {
        $error = "Email already exists or Registration Failed!";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <title>Placement Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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

    /* 🔥 SAME background as login */
    background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                url('images/bgg.jpg') no-repeat center center/cover;
}

/* 🔥 Glass effect */
.container{
    width:350px;
    padding:40px 30px;
    border-radius:15px;

    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);

    box-shadow:0 15px 25px rgba(0,0,0,0.4);
    color:white;
}

h2{
    text-align:center;
    margin-bottom:20px;
}

/* Inputs */
input{
    width:100%;
    padding:10px;
    margin-bottom:20px;
    border:none;
    border-bottom:2px solid rgba(255,255,255,0.5);
    background: transparent;
    color:white;
    outline:none;
}

input::placeholder{
    color:#ddd;
}

input:focus{
    border-color:#00f2fe;
}

/* 🔥 Button */
button{
    width:100%;
    padding:12px;
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

button:hover{
    transform: scale(1.05);
    box-shadow: 0 0 20px rgba(0,255,200,1),
                0 0 40px rgba(0,255,200,0.6);
}
/* Error */
.error{
    color:#ff6b6b;
    text-align:center;
    margin-bottom:10px;
}

/* Switch */
.switch{
    text-align:center;
    margin-top:15px;
}

.switch a{
    color:#00f2fe;
    text-decoration:none;
}

.switch a:hover{
    text-decoration:underline;
}
</style>
</head>

<body>

<div class="container">

<h2>Register</h2>

<?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

<form method="POST">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="register">Register</button>
</form>

<div class="switch">
    Already have account? <a href="login.php">Login</a>
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</body>
</html>
