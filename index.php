<?php
require('conexion_db_mysql/importante.php');
require('conexion_db_mysql/conexion_bd_mysql.php');

session_start();
if((isset($_SESSION['adminLogin'])&&$_SESSION['adminLogin']==true)){
    redirect('Welcome.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="with=device-with, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <?php  require('inc/links.php'); ?>

    <style>
        div.login-form{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            width: 400px;
        }
    </style>
</head>
<body class="bg-light">
<div class="login-form text-center rounded bg-white shadow overflow-none">
    <form method="POST">
        <h4 class="bg-dark text-white py-3">INICIO SESION ADMINISTRADOR</h4>
        <div class="p-4">
            <div class="mb-3">
                <input name="name_user" required type="text" class="form-control shadow-none text-center" placeholder="Nombre de Administrador">
            </div>
            <div class="mb-4">
                <input name="password_user" required type="password" class="form-control shadow-none text-center" placeholder="Contrasenaa">
            </div>
            <button name="login" type="submit" class="btn text-white bg-dark custom-bg shadow-none">INICIAR SESION</button>
        </div>
    </form>
</div>

<?php

    if(isset($_POST['login']))
    {
        $frm_data = filteration($_POST);

        $query = "SELECT * FROM userlogin WHERE name_user = ? AND password_user = ?";
        $values = [$frm_data['name_user'],$frm_data['password_user']];

        $res = select($query,$values,"ss");
        if($res->num_rows==1){
            $row = mysqli_fetch_assoc($res);
            $_SESSION['adminLogin'] = true;
            $_SESSION['adminId'] = $row['sr_no'];
            redirect('Welcome.php');
        }
        else{
            alert('error','Login Failed - Invalidos Credenciales');
        }
    }

?>

<?php require('inc/scripts.php') ?>
</body>
</html>
