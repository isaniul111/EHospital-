<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Patient Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:#f4f7fb;
    min-height:100vh;
}

/* ===== LAYOUT ===== */
.wrapper{
    display:grid;
    grid-template-columns:260px 1fr;
    min-height:100vh;
}

/* ===== SIDEBAR ===== */
.sidebar{
    background:#0f172a;
    color:white;
    padding:20px;
}

.profile-box{
    background:linear-gradient(135deg,#0ea5e9,#22c55e);
    border-radius:16px;
    padding:16px;
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:25px;
}

.profile-box img{
    width:55px;
    height:55px;
    border-radius:50%;
}

.profile-box h3{font-size:16px;}
.profile-box p{font-size:12px;opacity:.9}

.menu a{
    display:block;
    padding:12px 14px;
    border-radius:10px;
    margin-bottom:6px;
    text-decoration:none;
    color:#cbd5e1;
    transition:.3s;
}

.menu a:hover{
    background:#1e293b;
    color:white;
}

.menu .active{
    background:#22c55e;
    color:#064e3b;
    font-weight:600;
}

/* ===== MAIN ===== */
.main{
    padding:25px;
}

/* ===== TOP ===== */
.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.topbar h1{
    font-size:26px;
    color:#0f172a;
}

/* ===== WELCOME ===== */
.welcome{
    background:white;
    border-radius:18px;
    padding:25px;
    box-shadow:0 10px 30px rgba(0,0,0,0.05);
    margin-bottom:25px;
}

.search-box{
    margin-top:15px;
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

.search-box input{
    padding:10px 12px;
    border-radius:10px;
    border:1px solid #e5e7eb;
    outline:none;
}

.search-box input:focus{
    border-color:#22c55e;
}

.btn{
    padding:10px 18px;
    border:none;
    border-radius:10px;
    background:#22c55e;
    color:#064e3b;
    font-weight:600;
    cursor:pointer;
}

/* ===== STATS ===== */
.stats{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:16px;
    margin-bottom:30px;
}

.stat-card{
    background:white;
    border-radius:16px;
    padding:20px;
    box-shadow:0 10px 30px rgba(0,0,0,0.05);
}

.stat-card h2{
    font-size:28px;
    color:#0f172a;
}

.stat-card p{
    font-size:14px;
    color:#64748b;
}

/* ===== TABLE ===== */
.table-box{
    background:white;
    border-radius:18px;
    padding:20px;
    box-shadow:0 10px 30px rgba(0,0,0,0.05);
}

table{
    width:100%;
    border-collapse:collapse;
}

th,td{
    padding:12px;
    border-bottom:1px solid #f1f5f9;
    text-align:center;
    font-size:14px;
}

th{
    background:#f8fafc;
    color:#22c55e;
    font-weight:600;
}

/* ===== RESPONSIVE ===== */
@media(max-width:900px){
    .wrapper{grid-template-columns:1fr;}
    .sidebar{display:flex;overflow-x:auto;gap:10px;}
    .menu{display:flex;gap:10px;}
}
</style>
</head>

<body>

<?php
session_start();
if(!isset($_SESSION["user"]) || $_SESSION['usertype']!='p'){
    header("location: ../login.php");
}

$useremail=$_SESSION["user"];
include("../connection.php");

$stmt=$database->prepare("select * from patient where pemail=?");
$stmt->bind_param("s",$useremail);
$stmt->execute();
$userfetch=$stmt->get_result()->fetch_assoc();

$userid=$userfetch["pid"];
$username=$userfetch["pname"];

date_default_timezone_set('Asia/Kolkata');
$today=date("Y-m-d");

$patientrow=$database->query("select * from patient");
$doctorrow=$database->query("select * from doctor");
$appointmentrow=$database->query("select * from appointment where appodate>='$today'");
$schedulerow=$database->query("select * from schedule where scheduledate='$today'");
?>

<div class="wrapper">

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="profile-box">
        <img src="../img/user.png">
        <div>
            <h3><?php echo $username ?></h3>
            <p><?php echo $useremail ?></p>
        </div>
    </div>

    <div class="menu">
        <a class="active" href="index.php">Home</a>
        <a href="doctors.php">All Doctors</a>
        <a href="schedule.php">Sessions</a>
        <a href="appointment.php">My Bookings</a>
        <a href="settings.php">Settings</a>
        <a href="../logout.php">Logout</a>
    </div>
</div>

<!-- MAIN -->
<div class="main">

<div class="topbar">
    <h1>Dashboard</h1>
    <p><?php echo $today ?></p>
</div>

<div class="welcome">
    <h2>Welcome, <?php echo $username ?> 👋</h2>
    <p>Book doctors, manage appointments & track your health.</p>

    <form action="schedule.php" method="post" class="search-box">
        <input type="search" name="search" placeholder="Search doctor..." list="doctors">
        <datalist id="doctors">
        <?php
        $dlist=$database->query("select docname from doctor");
        while($d=$dlist->fetch_assoc()){
            echo "<option value='".$d['docname']."'>";
        }
        ?>
        </datalist>
        <button class="btn">Search</button>
    </form>
</div>

<div class="stats">

    <div class="dashboard-items stat-card">
        <div class="stat-left">
            <h1><?php echo $doctorrow->num_rows ?></h1>
            <p>Doctors</p>
        </div>
        <div class="stat-icon">🩺</div>
    </div>

    <div class="dashboard-items stat-card">
        <div class="stat-left">
            <h1><?php echo $patientrow->num_rows ?></h1>
            <p>Patients</p>
        </div>
        <div class="stat-icon">👤</div>
    </div>

    <div class="dashboard-items stat-card">
        <div class="stat-left">
            <h1><?php echo $appointmentrow->num_rows ?></h1>
            <p>Bookings</p>
        </div>
        <div class="stat-icon">📅</div>
    </div>

    <div class="dashboard-items stat-card">
        <div class="stat-left">
            <h1><?php echo $schedulerow->num_rows ?></h1>
            <p>Today Sessions</p>
        </div>
        <div class="stat-icon">⏰</div>
    </div>

</div>


<div class="table-box">
<h3>Your Upcoming Appointments</h3><br>

<table>
<tr>
<th>No</th>
<th>Session</th>
<th>Doctor</th>
<th>Date & Time</th>
</tr>

<?php
$sqlmain="select * from schedule
inner join appointment on schedule.scheduleid=appointment.scheduleid
inner join doctor on schedule.docid=doctor.docid
where appointment.pid=$userid and schedule.scheduledate>='$today'
order by schedule.scheduledate asc";

$result=$database->query($sqlmain);

if($result->num_rows==0){
    echo "<tr><td colspan='4'>No upcoming bookings</td></tr>";
}else{
    while($row=$result->fetch_assoc()){
        echo "<tr>
        <td>{$row['apponum']}</td>
        <td>{$row['title']}</td>
        <td>{$row['docname']}</td>
        <td>{$row['scheduledate']} {$row['scheduletime']}</td>
        </tr>";
    }
}
?>
</table>
</div>

</div>
</div>

</body>
</html>
