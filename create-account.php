<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Account | eHospital</title>

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
}

/* ===== CARD ===== */
.card{
    width:480px;
    background:#020617;
    border-radius:18px;
    padding:40px;
    box-shadow:0 30px 60px rgba(0,0,0,0.6);
    animation:fadeUp 0.8s ease;
    color:white;
}

@keyframes fadeUp{
    from{opacity:0; transform:translateY(40px);}
    to{opacity:1; transform:translateY(0);}
}

.card h1{
    font-size:28px;
    margin-bottom:6px;
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

/* ===== BUTTONS ===== */
.actions{
    display:flex;
    gap:12px;
    margin-top:10px;
}

.btn{
    width:100%;
    padding:12px;
    border-radius:8px;
    border:none;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}

.btn-primary{
    background:#34d399;
    color:#064e3b;
}

.btn-primary:hover{
    background:#10b981;
    box-shadow:0 0 15px rgba(52,211,153,0.5);
}

.btn-soft{
    background:#020617;
    color:#cbd5e1;
    border:1px solid #1e293b;
}

.btn-soft:hover{
    border-color:#64748b;
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
@media(max-width:520px){
    .card{width:90%;}
}
</style>
</head>

<body>

<?php
session_start();
$_SESSION["user"]="";
$_SESSION["usertype"]="";

date_default_timezone_set('Asia/Kolkata');
$_SESSION["date"]=date('Y-m-d');

include("connection.php");

if($_POST){

    $fname=$_SESSION['personal']['fname'];
    $lname=$_SESSION['personal']['lname'];
    $name=$fname." ".$lname;
    $address=$_SESSION['personal']['address'];
    $nic=$_SESSION['personal']['nic'];
    $dob=$_SESSION['personal']['dob'];

    $email=$_POST['newemail'];
    $tele=$_POST['tele'];
    $newpassword=$_POST['newpassword'];
    $cpassword=$_POST['cpassword'];

    if($newpassword==$cpassword){

        $stmt=$database->prepare("select * from webuser where email=?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result=$stmt->get_result();

        if($result->num_rows==1){
            $error="Already have an account for this email.";
        }else{
            $database->query("insert into patient(pemail,pname,ppassword,paddress,pnic,pdob,ptel)
                              values('$email','$name','$newpassword','$address','$nic','$dob','$tele')");
            $database->query("insert into webuser values('$email','p')");

            $_SESSION["user"]=$email;
            $_SESSION["usertype"]="p";
            $_SESSION["username"]=$fname;

            header('Location: patient/index.php');
        }
    }else{
        $error="Password confirmation does not match!";
    }
}
?>

<div class="card">
    <h1>Create Account</h1>
    <div class="sub">Now set your login credentials</div>

    <form method="POST">

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="newemail" placeholder="example@mail.com" required>
        </div>

        <div class="form-group">
            <label>Mobile Number (Bangladesh)</label>
            <input type="tel" 
                   name="tele" 
                   placeholder="ex: 01712345678"
                   pattern="^01[3-9][0-9]{8}$"
                   title="Enter valid BD number (ex: 01712345678)"
                   required>
        </div>

        <div class="form-group">
            <label>Create Password</label>
            <input type="password" name="newpassword" required>
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="cpassword" required>
        </div>

        <?php if(!empty($error)){ echo "<div class='error'>$error</div>"; } ?>

        <div class="actions">
            <button type="reset" class="btn btn-soft">Reset</button>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </div>
    </form>

    <div class="footer">
        Already have an account? <a href="login.php">Login</a>
    </div>
</div>

</body>
</html>
