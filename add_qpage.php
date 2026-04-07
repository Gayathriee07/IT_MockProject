<?php
session_start();
include("connect.php");
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Question</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

/* BODY */
body{
    background-color:#0a192f;
    color:#ccd6f6;
}

/* BOX */
.box{
    width:420px;
    margin:60px auto;
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

/* INPUTS */
input, textarea, select{
    width:100%;
    padding:12px;
    margin:12px 0;

    border:none;
    border-bottom:2px solid rgba(255,255,255,0.5);

    background: transparent;
    color:white;
    outline:none;
}

textarea{
    resize:none;
    height:80px;
}

input::placeholder, textarea::placeholder{
    color:#aaa;
}

input:focus, textarea:focus, select:focus{
    border-color:#00ffcc;
}

/* SELECT FIX */
select{
    background-color:#0a192f;
}

/* BUTTON */
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
    transition:0.3s;

    box-shadow: 0 0 10px rgba(0,255,200,0.6);
}

button:hover{
    transform: scale(1.05);
    box-shadow: 0 0 25px rgba(0,255,200,1);
}

/* BACK */
.back{
    display:block;
    margin-top:15px;
    text-decoration:none;
    color:#8892b0;
}

.back:hover{
    color:#00ffcc;
}
</style>
</head>

<body>

<div class="box">
<h2>Add Question</h2>

<form method="post">

<!-- Question -->
<textarea name="question_text" placeholder="Enter Question" required></textarea>

<!-- Options -->
<input type="text" name="option1" placeholder="Option 1" required>
<input type="text" name="option2" placeholder="Option 2" required>
<input type="text" name="option3" placeholder="Option 3" required>
<input type="text" name="option4" placeholder="Option 4" required>

<!-- Correct Answer -->
<select name="correct_option" required>
    <option value="">Select Correct Answer</option>
    <option value="1">Option 1</option>
    <option value="2">Option 2</option>
    <option value="3">Option 3</option>
    <option value="4">Option 4</option>
</select>

<!-- Mock Test Dropdown -->
<select name="mock_test_id" required>
<option value="">Select Mock Test</option>

<?php
$query = "SELECT * FROM mock_tests";
$result = pg_query($conn, $query);

if(!$result){
    die("Error: " . pg_last_error($conn));
}

while($row = pg_fetch_assoc($result)){
    echo "<option value='".$row['id']."'>".$row['title']."</option>";
}
?>
</select>

<button type="submit" name="submit">Add Question</button>

</form>

<a href="adashboard.php" class="back">⬅ Back to Dashboard</a>

</div>

</body>
</html>

<?php
if(isset($_POST['submit'])){

    $q = $_POST['question_text'];
    $o1 = $_POST['option1'];
    $o2 = $_POST['option2'];
    $o3 = $_POST['option3'];
    $o4 = $_POST['option4'];
    $ans = $_POST['correct_option'];
    $mock_id = $_POST['mock_test_id'];

    // SAFE INSERT (important)
    $query = "INSERT INTO questions
              (question_text, option1, option2, option3, option4, correct_option, mock_test_id)
              VALUES ($1, $2, $3, $4, $5, $6, $7)";

    $result = pg_query_params($conn, $query,
        array($q, $o1, $o2, $o3, $o4, $ans, $mock_id)
    );

    if($result){
        echo "<script>alert('✅ Question Added Successfully');</script>";
    } else {
        echo "<script>alert('❌ Error: ".pg_last_error($conn)."');</script>";
    }
}
?>
