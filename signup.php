<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up | eHospital</title>

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
    background:linear-gradient(120deg,#0f172a,#020617);
    display:flex;
    justify-content:center;
    align-items:center;
}

/* ===== CARD ===== */
.card{
    width:850px;
    background:#0b1220;
    display:flex;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 30px 60px rgba(0,0,0,0.5);
    animation:fadeUp 0.8s ease;
}

/* ===== LEFT BRAND ===== */
.brand{
    width:40%;
    background:linear-gradient(180deg,#059669,#047857);
    padding:40px 30px;
    color:white;
    display:flex;
    flex-direction:column;
    justify-content:center;
}

.brand h1{
    font-size:34px;
    margin-bottom:10px;
}

.brand p{
    opacity:0.9;
    line-height:1.6;
}

.brand .tag{
    margin-top:20px;
    font-size:13px;
    opacity:0.8;
}

/* ===== FORM ===== */
.form-box{
    width:60%;
    padding:50px;
    color:#e5e7eb;
}

.form-box h2{
    font-size:28px;
    margin-bottom:5px;
}

.form-box .sub{
    font-size:14px;
    color:#94a3b8;
    margin-bottom:25px;
}

.form-group{
    margin-bottom:15px;
}

.form-group label{
    display:block;
    font-size:13px;
    margin-bottom:6px;
    color:#cbd5f5;
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

/* grid for name */
.grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:12px;
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
.login-link{
    margin-top:20px;
    font-size:13px;
    color:#94a3b8;
}

.login-link a{
    color:#34d399;
    text-decoration:none;
    font-weight:600;
}

.login-link a:hover{
    text-decoration:underline;
}

/* ===== ANIMATION ===== */
@keyframes fadeUp{
    from{opacity:0; transform:translateY(30px);}
    to{opacity:1; transform:translateY(0);}
}

/* ===== RESPONSIVE ===== */
@media(max-width:800px){
    .card{flex-direction:column;width:95%;}
    .brand,.form-box{width:100%;}
    .grid{grid-template-columns:1fr;}
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

if($_POST){
    $_SESSION["personal"]=array(
        'fname'=>$_POST['fname'],
        'lname'=>$_POST['lname'],
        'address'=>$_POST['address'],
        'nic'=>$_POST['nic'],
        'dob'=>$_POST['dob']
    );
    header("location: create-account.php");
}
?>

<div class="card">

    <!-- LEFT -->
    <div class="brand">
        <h1>eHospital</h1>
        <p>
            Secure digital platform to manage appointments, health records 
            and doctor consultations.
        </p>
        <div class="tag">Technology meets Compassion.</div>
    </div>

    <!-- RIGHT -->
    <div class="form-box">
        <h2>Create Account</h2>
        <div class="sub">Add your personal details to continue</div>

        <form method="POST">

            <div class="grid">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="fname" required>
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="lname" required>
                </div>
            </div>

            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" required>
            </div>

            <div class="form-group">
                <label>NIC</label>
                <input type="text" name="nic" required>
            </div>

            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" name="dob" required>
            </div>

            <div class="actions">
                <button type="reset" class="btn btn-soft">Reset</button>
                <button type="submit" class="btn btn-primary">Next</button>
            </div>

            <div class="login-link">
                Already have an account? <a href="login.php">Login</a>
            </div>

        </form>
    </div>
</div>

</body>
</html>
