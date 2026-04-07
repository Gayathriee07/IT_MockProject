<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connect.php");

// Check mock_id
if(!isset($_GET['mock_id'])){
    die("No mock test selected!");
}

$mock_id = intval($_GET['mock_id']);

// Fetch questions
$q_query = "SELECT * FROM questions WHERE mock_test_id = $mock_id ORDER BY id ASC";
$q_result = pg_query($conn, $q_query);

if(pg_num_rows($q_result) == 0){
    die("No questions found for this mock test!");
}

$score = 0;
$user_answers = [];

if(isset($_POST['submit_test'])){
    $user_answers = $_POST['answers'] ?? [];

    // Calculate score
    while($q = pg_fetch_assoc($q_result)){
        $qid = $q['id'];

        if(isset($user_answers[$qid]) && $user_answers[$qid] == $q['correct_option']){
            $score++;
        }
    }

    // Reset result pointer to re-loop questions
    pg_result_seek($q_result, 0);
    session_start();

$user_id = $_SESSION['user_id'];

// Check existing result
$check = pg_query($conn, "SELECT * FROM result WHERE user_id=$user_id AND mock_id=$mock_id");

if(pg_num_rows($check) == 0){

    pg_query($conn, "INSERT INTO result(user_id, mock_id, best_score, last_attempt_score, total_attempts)
                     VALUES($user_id, $mock_id, $score, $score, 1)");

} else {

    $row = pg_fetch_assoc($check);
    $best = $row['best_score'];
    $attempts = $row['total_attempts'];

    if($score > $best){
        $best = $score;
    }

    $attempts++;

    pg_query($conn, "UPDATE result 
                     SET best_score=$best,
                         last_attempt_score=$score,
                         total_attempts=$attempts,
                         updated_at=CURRENT_TIMESTAMP
                     WHERE user_id=$user_id AND mock_id=$mock_id");
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Take Test</title>
    <style>
        body {
            font-family: Arial;
            background: #0a192f;
            color: white;
            padding: 30px;
        }

        .question-box {
            background: #f8f9fa;
            color: black;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .correct {
            color: green;
            font-weight: bold;
        }

        .wrong {
            color: red;
            font-weight: bold;
        }

        .score-box {
            background: #d4edda;
            color: black;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Mock Test</h2>

<?php if(isset($_POST['submit_test'])){ ?>
    <div class="score-box">
        <h3>Your Score: <?php echo $score; ?> / <?php echo pg_num_rows($q_result); ?></h3>
    </div>
<?php } ?>

<form method="POST">

<?php
$q_num = 1;

while($q = pg_fetch_assoc($q_result)){
    $qid = $q['id'];
?>

    <div class="question-box">
        <h4>Q<?php echo $q_num++; ?>: <?php echo $q['question_text']; ?></h4>

        <?php
        for($i=1; $i<=4; $i++){
            $option = $q["option".$i];

            $checked = "";
            $class = "";

            if(isset($user_answers[$qid])){
                if($user_answers[$qid] == $i){
                    $checked = "checked";

                    if($i == $q['correct_option']){
                        $class = "correct";
                    } else {
                        $class = "wrong";
                    }
                }
                elseif($i == $q['correct_option']){
                    $class = "correct";
                }
            }
        ?>

        <div>
            <input type="radio"
                   name="answers[<?php echo $qid; ?>]"
                   value="<?php echo $i; ?>"
                   <?php echo $checked; ?>
                   <?php echo isset($_POST['submit_test']) ? "disabled" : ""; ?>
                   required>

            <span class="<?php echo $class; ?>">
                <?php echo $option; ?>
            </span>
        </div>

        <?php } ?>
    </div>

<?php } ?>

<?php if(!isset($_POST['submit_test'])){ ?>
    <button type="submit" name="submit_test">Submit Test</button>
<?php } ?>

</form>

</body>
</html>
