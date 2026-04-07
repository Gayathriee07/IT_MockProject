<?php
session_start();
include("connect.php");

$user_id = $_SESSION['user_id'];
$mock_id = $_POST['mock_id'];

$score = 0;
$total_questions = 0;

// Get all questions of that mock test
$query = "SELECT * FROM question WHERE mock_id='$mock_id'";
$result = pg_query($conn, $query);

while($row = pg_fetch_assoc($result)){
    $qid = $row['id'];
    $correct_answer = $row['answer'];

    
    if(isset($_POST['answer_'.$qid])){
        $user_answer = $_POST['answer_'.$qid'];

        if($user_answer == $correct_answer){
            $score++;
        }
    }

    $total_questions++;
}




$check = "SELECT * FROM result WHERE user_id='$user_id' AND mock_id='$mock_id'";
$res = pg_query($conn, $check);

if(pg_num_rows($res) == 0){

    // First attempt
    $insert = "INSERT INTO result(user_id, mock_id, best_score, last_attempt_score, total_attempts)
               VALUES('$user_id', '$mock_id', '$score', '$score', 1)";
    pg_query($conn, $insert);

} else {

    $row = pg_fetch_assoc($res);
    $best_score = $row['best_score'];
    $attempts = $row['total_attempts'];

    // Update best score if needed
    if($score > $best_score){
        $best_score = $score;
    }

    $attempts++;

    $update = "UPDATE result 
               SET best_score='$best_score',
                   last_attempt_score='$score',
                   total_attempts='$attempts',
                   updated_at = CURRENT_TIMESTAMP
               WHERE user_id='$user_id' AND mock_id='$mock_id'";

    pg_query($conn, $update);
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Result</title>

<style>
body{
    font-family: Arial;
    background: linear-gradient(135deg,#667eea,#764ba2);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.box{
    background:white;
    padding:30px;
    border-radius:10px;
    text-align:center;
    box-shadow:0px 5px 20px rgba(0,0,0,0.3);
}

h2{
    margin-bottom:15px;
}

.score{
    font-size:22px;
    color:#4facfe;
    margin:10px 0;
}

a{
    display:inline-block;
    margin-top:15px;
    text-decoration:none;
    background:#4facfe;
    color:white;
    padding:10px 15px;
    border-radius:5px;
}

a:hover{
    background:#007bff;
}
</style>

</head>

<body>

<div class="box">
<h2>Test Result</h2>

<p class="score">
Your Score: <?php echo $score . " / " . $total_questions; ?>
</p>

<a href="user_dashboard.php">Go to Dashboard</a>

</div>

</body>
</html>
