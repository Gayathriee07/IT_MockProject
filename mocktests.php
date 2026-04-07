<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connect.php"); // Your PostgreSQL connection
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == ''){
    die("User not logged in!");
}

$user_id = (int) $_SESSION['user_id'];
if(isset($_GET['section_id'])){
    $section_id = intval($_GET['section_id']); // sanitize input

    // Fetch section name
    $sec_query = "SELECT name FROM sections WHERE id = $section_id";
    $sec_result = pg_query($conn, $sec_query);

    if(pg_num_rows($sec_result) > 0){
        $section = pg_fetch_assoc($sec_result)['name'];
    } else {
        die("Section not found!");
    }

} else {
    die("No section selected!");
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($section); ?> Mock Tests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0a192f;
            color: white;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            border-radius: 15px;
            transition: 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.5);
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2><?php echo htmlspecialchars($section); ?> Mock Tests</h2>
    <div class="row g-4 mt-3">

    <?php
    // Fetch all mock tests for this section
    $mock_query = "SELECT * FROM mock_tests WHERE section_id = $section_id ORDER BY level ASC";
    $mock_result = pg_query($conn, $mock_query);

    if(pg_num_rows($mock_result) > 0){
        while($row = pg_fetch_assoc($mock_result)){
            // Convert numeric level to text
            $level_text = ($row['level'] == 1) ? "Easy" : (($row['level']==2) ? "Medium" : "Hard");
            ?>
            <div class="col-md-4">
                <div class="card text-dark bg-light">
                    <div class="card-body text-center">
                        <h5><?php echo htmlspecialchars($row['title']); ?></h5>
                        <p>Level: <?php echo $level_text; ?></p>
                        <?php
$mock_id = $row['id'];
$level = $row['level'];

$locked = false;

// If not first level, check previous test
if($level > 1){

    $prev_level = $level - 1;

    $prev_query = "SELECT id, total_questions FROM mock_tests 
                   WHERE section_id = $section_id AND level = $prev_level";
    $prev_result = pg_query($conn, $prev_query);

    if($prev_row = pg_fetch_assoc($prev_result)){

        $prev_mock_id = $prev_row['id'];
        $total_q = $prev_row['total_questions'];

        // Get user's best score
        $res_query = "SELECT best_score FROM result 
                      WHERE user_id=$user_id AND mock_id=$prev_mock_id";
        $res_result = pg_query($conn, $res_query);
        if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == ''){
    die("User not logged in!");
}

$user_id = (int) $_SESSION['user_id'];

        if(pg_num_rows($res_result) > 0){

            $res = pg_fetch_assoc($res_result);
            $percentage = ($res['best_score'] / $total_q) * 100;

            if($percentage < 50){
                $locked = true;
            }

        } else {
            $locked = true;
        }
    }
}
?>

<?php if($locked){ ?>
    <button class="btn btn-secondary w-100" disabled>🔒 Locked</button>
<?php } else { ?>
    <a href="take_test.php?mock_id=<?php echo $mock_id; ?>" class="btn btn-primary w-100">Start Test</a>
<?php } ?>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p>No mock tests available for this section yet.</p>";
    }
    ?>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
