<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>IT Placement Portal</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background-color: #0a192f;
}

/* Sidebar */
.sidebar {
    height: 100vh;
    width: 250px;
    position: fixed;
    background-color: #000;
    padding-top: 20px;
    overflow:hidden;
}

.sidebar a {
    display: block;
    color: #ccc;
    padding: 15px 15px;
    text-decoration: none;
    transition: 0.3s;
}

.sidebar a:hover {
    background-color: #1a1a1a;
    color: white;
}

/* Navbar */
.top-navbar {
    margin-left: 250px;
    background-color: #000;
    padding: 10px 25px;
}

/* Main content */
.main-content {
    margin-left: 250px;
    padding: 30px;
    color: white;
}
.coding-card{
    background: rgba(255,255,255,0.05);
    border-radius: 15px;
    padding: 25px;
    color: white;
    backdrop-filter: blur(8px);
    transition: 0.3s ease;
    height: 100%;
}

.coding-card:hover{
    transform: translateY(-8px);
    background: rgba(255,255,255,0.1);
    box-shadow: 0 8px 25px rgba(0,0,0,0.5);
}

.language-logo{
    width: 90px;
    height: 90px;
    object-fit: contain;
    margin-bottom: 15px;
    transition: 0.3s ease;
}
.com-logo{
    width: 90px;
    height: 90px;
    object-fit: contain;
    margin-bottom: 15px;
    transition: 0.3s ease;
}


.coding-card{
    background: rgba(255,255,255,0.05);
    border-radius: 15px;
    padding: 25px;
    color: white;
    backdrop-filter: blur(8px);
    transition: 0.3s ease;
    height: 100%;
    border: 1px solid rgba(255,255,255,0.08);
}

.coding-card:hover{
    transform: translateY(-8px);
    background: rgba(255,255,255,0.1);
    box-shadow: 0 8px 25px rgba(0,0,0,0.5);
}

.coding-card:hover .language-logo{
    transform: scale(1.1);
}


.more-options-card{
    background: rgba(255,255,255,0.05);
    border-radius: 15px;
    padding: 25px;
    color: white;
    backdrop-filter: blur(8px);
    transition: 0.3s ease;
    height: 100%;
    border: 1px solid rgba(255,255,255,0.08);
}

.more-options-card:hover{
    transform: translateY(-8px);
    background: rgba(255,255,255,0.1);
    box-shadow: 0 8px 25px rgba(0,0,0,0.5);
}







.aptitude-logo{
    width: 90px;
    height: 90px;
    object-fit: contain;
    margin-bottom: 15px;
    transition: 0.3s ease;
}

.coding-card:hover .aptitude-logo{
    transform: scale(1.1);
}

.sidebar-logo {
    display: flex;
    align-items: center;
    justify-content: flex-start;  /* pushes logo to left */
    padding: 20px 20px;           /* control spacing */
}

.sidebar-logo img {
    width: 500px;      /* adjust size */
    height: 90px;
    max-width: 100%;   /* prevents overflow */
    padding-left:0;
}

html{
scroll-behavior:smooth;
}
















</style>

</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">


<div class="sidebar-logo">
    <img src="images/logo2.png" alt="Placement prep">
    
</div>
    <a href="#navbarr">Dashboard</a>
    <a href="#coding"> Coding Practice</a>
    <a href="#aptitude"> Aptitude</a>
    <a href="#company">Company-wise prep</a>
    <a href="#">Mock Test</a>
    <a href="#">Interview Prep</a>
    <a href="#">Resume Builder</a>
</div>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark top-navbar">
    <div class="container-fluid d-flex justify-content-end" id="navbarr">

        <!-- Search -->
        <form class="d-flex me-4">
            <input class="form-control me-2" type="search" placeholder="Search">
            <button class="btn btn-outline-light" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>

        <!-- Nav Links -->
        <ul class="navbar-nav d-flex flex-row align-items-center">

            <li class="nav-item me-3">
                <a class="nav-link text-white" href="#options">About Us</a>
            </li>

            <li class="nav-item me-3">
                <a class="nav-link text-white" href="#options">Contact</a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-danger" href="logout.php">Logout</a>
            </li>

        </ul>

    </div>
</nav>







<!-- MAIN CONTENT -->
<div class="main-content">

   <h2>Welcome, <?php echo $_SESSION['user_name']; ?> 👋</h2>
<p class="mt-3">Prepare smartly for IT placements and track your progress.</p>


<!-- CODING PRACTICE -->
<div class="mt-5" id="coding">
<h4 class="mt-5 mb-4">Coding Practice</h4>

<div class="row g-4">

<div class="col-md-3">
<div class="coding-card text-center">
<img src="images/dsa.png" class="language-logo">
<h5>DSA</h5>
<p>Core Data Structures & Algorithms</p>
<button class="btn btn-light w-100" onclick="window.location.href='mocktests.php?section_id=1'">Start Mock Test</button>	
</div>
</div>
<div class="col-md-3">
<div class="coding-card text-center">
<img src="images/cp.png" class="language-logo">
<h5>C Programming</h5>
<p>Logic & Coding</p>
<button class="btn btn-light w-100" onclick="window.location.href='mocktests.php?section_id=2'">Start Mock Test</button>
</div>
</div>
<div class="col-md-3">
<div class="coding-card text-center">
<img src="images/cpp.png" class="language-logo">
<h5>C++</h5>
<p>Logic & Competitive Coding</p>
<button class="btn btn-light w-100" onclick="window.location.href='mocktests.php?section_id=3'">Start Mock Test</button>
</div>
</div>

<div class="col-md-3">
<div class="coding-card text-center">
<img src="images/python.png" class="language-logo">
<h5>Python</h5>
<p>Beginner to Intermediate</p>
<button class="btn btn-light w-100" onclick="window.location.href='mocktests.php?section_id=4'">Start Mock Test</button>
</div>
</div>

<div class="col-md-3">
<div class="coding-card text-center">
<img src="images/newjava.png" class="language-logo">
<h5>Java</h5>
<p>OOP & Placement Focus</p>
<button class="btn btn-light w-100" onclick="window.location.href='mocktests.php?section_id=5'">Start Mock Test</button>
</div>
</div>

<div class="col-md-3">
<div class="coding-card text-center">
<img src="images/sql.jpg" class="language-logo">
<h5>SQL</h5>
<p>Database Queries & Joins</p>
<button class="btn btn-light w-100" onclick="window.location.href='mocktests.php?section_id=6'">Start Mock Test</button>
</div>
</div>

<div class="col-md-3">
<div class="coding-card text-center">
<img src="images/js.png" class="language-logo">
<h5>JavaScript</h5>
<p>Frontend Logic Building</p>
<button class="btn btn-light w-100" onclick="window.location.href='mocktests.php?section_id=7'">Start Mock Test</button>
</div>
</div>


<div class="col-md-3">
<div class="coding-card text-center">
<img src="images/php.png" class="language-logo">
<h5>PHP</h5>
<p>Backend Development</p>
<button class="btn btn-light w-100" onclick="window.location.href='mocktests.php?section_id=8'">Start Mock Test</button>
</div>
</div>

</div>
</div>        



<!-- APTITUDE -->
<div class="mt-5" id="aptitude">
<h4 class="mt-5 mb-4">Aptitude Preparation</h4>

<div class="row g-4">

<div class="col-md-3">
<div class="coding-card text-center">
<img src="images/quant.png" class="aptitude-logo">
<h5>Quantitative Aptitude</h5>
<p>Arithmetic, Algebra, Percentages</p>
<button class="btn btn-light w-100" onclick="window.location.href='mocktests.php?section_id=17'">Practice</button>

</div>
</div>

<div class="col-md-3">
<div class="coding-card text-center">
<img src="images/lr.png" class="aptitude-logo">
<h5>Logical Reasoning</h5>
<p>Puzzles, Seating, Patterns</p>
<button class="btn btn-light w-100">Practice</button>
</div>
</div>

<div class="col-md-3">
<div class="coding-card text-center">
<img src="images/na.png" class="aptitude-logo">
<h5>Numerical Ability</h5>
<p>Number Series & Simplification</p>
<button class="btn btn-light w-100">Practice</button>
</div>
</div>

<div class="col-md-3">
<div class="coding-card text-center">
<img src="images/va.png" class="aptitude-logo">
<h5>Verbal Ability</h5>
<p>Grammar & Vocabulary</p>
<button class="btn btn-light w-100">Practice</button>
</div>
</div>

<div class="col-md-3">
<div class="coding-card text-center">
<img src="images/di.jpg" class="aptitude-logo">
<h5>Data Interpretation</h5>
<p>Charts & Graph Analysis</p>
<button class="btn btn-light w-100">Practice</button>
</div>
</div>

<div class="col-md-3">
<div class="coding-card text-center">
<img src="images/pro.jpg" class="aptitude-logo">
<h5>Probability & Permutation</h5>
<p>Combinations & Probability</p>
<button class="btn btn-light w-100">Practice</button>
</div>
</div>

</div>
</div>



<!-- COMPANY-WISE PREPARATION -->
<div class="mt-5" id="company">
    <h4>Company-wise Preparation</h4>
    <div class="row g-4 mt-2">

        <div class="col-md-3">
            <div class="coding-card text-center">
                <div class="icon">
                    <img src="images/tcs1.png" class="com-logo" >
                </div>
                <h5>TCS</h5>
                <p>Coding & Aptitude Pattern</p>
              <button class="btn btn-light w-100" onclick="window.location.href='mocktests.php?section_id=23'">Practice</button>

            </div>
        </div>

        <div class="col-md-3">
            <div class="coding-card text-center">
                <div class="icon">
                    <img src="images/info.png" class="com-logo">
                </div>
                <h5>Infosys</h5>
                <p>Aptitude + Technical Interview</p>
               <button class="btn btn-light w-100">Start Mock Test</button>
            </div>
        </div>

        <div class="col-md-3">
            <div class="coding-card text-center">
                <div class="icon">
                    <img src="images/wipro.png" class="com-logo">
                </div>
                <h5>Wipro</h5>
                <p>Coding + HR Rounds</p>
               <button class="btn btn-light w-100">Start Mock Test</button>
            </div>
        </div>

        <div class="col-md-3">
            <div class="coding-card text-center">
                <div class="icon">
                    <img src="images/cogni.jpg" class="com-logo">
                </div>
                <h5>Cognizant</h5>
                <p>Aptitude + Technical Prep</p>
               <button class="btn btn-light w-100">Start Mock Test</button>
            </div>
        </div>

        <div class="col-md-3">
            <div class="coding-card text-center">
                <div class="icon">
                    <img src="images/accent.png" class="com-logo">
                </div>
                <h5>Accenture</h5>
                <p>Logical + Technical + HR</p>
                <button class="btn btn-light w-100">Start Mock Test</button>
            </div>
        </div>

        <div class="col-md-3">
            <div class="coding-card text-center">
                <div class="icon">
                    <img src="images/cape.png" class="com-logo">
                </div>
                <h5>Capgemini</h5>
                <p>Programming + Scenario Questions</p>
               <button class="btn btn-light w-100">Start Mock Test</button>
            </div>
        </div>

        <div class="col-md-3">
            <div class="coding-card text-center">
                <div class="icon">
                    <img src="images/mahi.png" class="com-logo">
                </div>
                <h5>Tech Mahindra</h5>
                <p>Aptitude + Coding + HR</p>
               <button class="btn btn-light w-100">Start Mock Test</button>
            </div>
        </div>

        <div class="col-md-3">
            <div class="coding-card text-center">
                <div class="icon">
                    <img src="images/hcl2.png" class="com-logo">
                </div>
                <h5>HCL</h5>
                <p>Coding Rounds + Technical Interview</p>
               <button class="btn btn-light w-100">Start Mock Test</button>
            </div>
        </div>

        <div class="col-md-3">
            <div class="coding-card text-center">
                <div class="icon">
                    <img src="images/ibm.png" class="com-logo">
                </div>
                <h5>IBM</h5>
                <p>Coding + Problem Solving + HR</p>
               <button class="btn btn-light w-100">Start Mock Test</button>
            </div>
        </div>

    </div>
</div>

<!-- MORE OPTIONS SECTION -->
<div class="mt-5 mb-5" id="options">
    <h4>More Options</h4>
    <div class="row g-4 mt-2">

        <div class="col-md-4">
            <div class="coding-card text-center more-options-card">
                <h5>About Us</h5>
                <p>Learn more about our portal and mission.</p>
                <a href="#aboutus" class="btn btn-info w-100">View</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="coding-card text-center more-options-card">
                <h5>Contact</h5>
                <p>Get in touch with us for queries or support.</p>
                <a href="#contact" class="btn btn-warning w-100">Reach Out</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="coding-card text-center more-options-card">
                <h5>Logout</h5>
                <p>Sign out from your account securely.</p>
                <a href="logout.php" class="btn btn-danger w-100">Logout</a>
            </div>
        </div>

    </div>
</div>





</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
