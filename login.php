<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | eHospital</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    min-height:100vh;
    background:linear-gradient(120deg,#020617,#0f172a);
    display:flex;
    justify-content:center;
    align-items:center;
    overflow:hidden;
}

/* ===== ANIMATED BLOBS ===== */
.blob{
    position:absolute;
    width:300px;
    height:300px;
    background:#34d399;
    filter:blur(120px);
    opacity:0.3;
    animation:float 8s infinite alternate;
}

.blob2{
    background:#0ea5e9;
    right:-100px;
    bottom:-100px;
    animation-delay:2s;
}

.blob1{
    left:-100px;
    top:-100px;
}

@keyframes float{
    from{transform:translateY(0);}
    to{transform:translateY(80px);}
}

/* ===== CARD ===== */
.card{
    width:420px;
    background:#020617;
    border-radius:18px;
    padding:40px;
    box-shadow:0 30px 60px rgba(0,0,0,0.6);
    z-index:2;
    animation:fadeUp 0.8s ease;
    color:white;
}

@keyframes fadeUp{
    from{opacity:0; transform:translateY(40px);}
    to{opacity:1; transform:translateY(0);}
}

.card h1{
    font-size:28px;
    margin-bottom:5px;
}

.card .sub{
    font-size:14px;
    color:#94a3b8;
    margin-bottom:25px;
}

/* ===== FORM ===== */
.form-group{
    margin-bottom:15px;
}

.form-group label{
    font-size:13px;
    color:#cbd5f5;
    display:block;
    margin-bottom:6px;
}

.form-group input{
    width:100%;
    padding:11px 12px;
    border-radius:8px;
    border:1px solid #1e293b;
    background:#020617;
    color:white;
    outline:none;
    transition:0.3s;
}

.form-group input:focus{
    border-color:#34d399;
    box-shadow:0 0 0 2px rgba(52,211,153,0.2);
}

/* ===== BUTTON ===== */
.btn{
    width:100%;
    padding:12px;
    border:none;
    border-radius:8px;
    font-weight:600;
    cursor:pointer;
    background:#34d399;
    color:#064e3b;
    transition:0.3s;
}

.btn:hover{
    background:#10b981;
    box-shadow:0 0 15px rgba(52,211,153,0.6);
    transform:translateY(-2px);
}

/* ===== FOOTER ===== */
.footer{
    margin-top:18px;
    font-size:13px;
    color:#94a3b8;
    text-align:center;
}

.footer a{
    color:#34d399;
    text-decoration:none;
    font-weight:600;
}

.footer a:hover{
    text-decoration:underline;
}

/* ===== ERROR ===== */
.error{
    margin:10px 0;
    font-size:13px;
    color:#fb7185;
    text-align:center;
}

/* ===== RESPONSIVE ===== */
@media(max-width:480px){
    .card{width:90%;}
}
</style>
</head>

<body>

<div class="blob blob1"></div>
<div class="blob blob2"></div>

<?php
session_start();
$_SESSION["user"]="";
$_SESSION["usertype"]="";

date_default_timezone_set('Asia/Kolkata');
$_SESSION["date"]=date('Y-m-d');

include("connection.php");

if($_POST){
    $email=$_POST['useremail'];
    $password=$_POST['userpassword'];
    $error="";

    $result= $database->query("select * from webuser where email='$email'");
    if($result->num_rows==1){
        $utype=$result->fetch_assoc()['usertype'];

        if ($utype=='p'){
            $checker = $database->query("select * from patient where pemail='$email' and ppassword='$password'");
            if ($checker->num_rows==1){
                $_SESSION['user']=$email;
                $_SESSION['usertype']='p';
                header('location: patient/index.php');
            }else{ $error="Wrong email or password"; }
        }

        elseif($utype=='a'){
            $checker = $database->query("select * from admin where aemail='$email' and apassword='$password'");
            if ($checker->num_rows==1){
                $_SESSION['user']=$email;
                $_SESSION['usertype']='a';
                header('location: admin/index.php');
            }else{ $error="Wrong email or password"; }
        }

        elseif($utype=='d'){
            $checker = $database->query("select * from doctor where docemail='$email' and docpassword='$password'");
            if ($checker->num_rows==1){
                $_SESSION['user']=$email;
                $_SESSION['usertype']='d';
                header('location: doctor/index.php');
            }else{ $error="Wrong email or password"; }
        }
    }else{
        $error="No account found with this email";
    }
}
?>

<div class="card">
    <h1>Welcome Back 👋</h1>
    <div class="sub">Login to continue to eHospital</div>

    <form method="POST">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="useremail" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="userpassword" required>
        </div>

        <?php if(!empty($error)){ echo "<div class='error'>$error</div>"; } ?>

        <button class="btn">Login</button>
    </form>

    <div class="footer">
        Don't have an account? <a href="signup.php">Sign up</a>
    </div>
</div>

</body>
</html>
