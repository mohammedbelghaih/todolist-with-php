<?php 
    session_start();
    include("./App/Database.php");

    $db=new App\Database();
    if(isset($_POST["submit"])){
        $username=$_POST["username"];
        $password=$_POST["password"];
        $db->login($username,$password);
        $_SESSION["user"]=$db->user;
    }
    require("form.php");
    $form=new form();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
<section class="cont">
    <div class="frm">
        <form method="POST"  class="container">
        <div class="form-group">
            <?php 
                echo $form->label("exampleInputEmail1","Username");
            ?>
            <span><?php echo $db->validation(); ?></span>
            <?php
                echo $form->inputs("text","username","form-control","exampleInputEmail1");
            ?>
        </div>
        <div class="form-group">
            <?php 
                echo $form->label("exampleInputPassword1","Password");
                echo $form->inputs("password","password","form-control","exampleInputPassword1");
            ?>
        </div>
        <center>
        <?php
            echo $form->button("submit","btn btn-primary btnb","Se connecter");
        ?>
        <div><a href="inscription.php">inscrivez vous!</a></div>
        </center>
        </form>
    </div>
</section>

