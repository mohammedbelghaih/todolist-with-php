<?php 
    session_start();
    include("./App/Database.php");

    $db=new App\Database();
    if(isset($_SESSION["user"])){
        echo $_SESSION["user"];
    }else{
        echo "khawya";
    }
    if(isset($_POST["submit"])){
        $username=$_POST["username"];
        $password=$_POST["password"];
        $email=$_POST["email"];
        $firstname=$_POST["firstname"];
        $lastname=$_POST["lastname"];
        $db->inscription($username,$password,$email,$firstname,$lastname);

        
        $images=$_FILES["image"]["name"];
        $tmp_dir=$_FILES["image"]["tmp_name"];
        $imageSize=$_FILES["image"]["size"];
        
        $img_dir="img/";
        $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
        $valid_extensions=array("jpeg", "jpg", "png");
        $picProfile=rand(1000, 1000000).".".$imgExt;
        move_uploaded_file($tmp_dir, $img_dir.$picProfile);
        $stmt=$db->getpdo()->prepare("insert into users(photo) values(:pic)");
        $stmt->bindParam(":pic", $picProfile);
        if($stmt->execute()){
            echo "done";
        }else{
            echo "no";
        }
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
    <title>Inscription</title>
</head>
<body>
    <section class="insc">
        <div class="fr">   
            <form method="POST" enctype="multipart/form-data" action="inscription.php" class="container">
                <div class="form-group">
                    <?php
                        echo $form->label("formGroupExampleInput","Username");
                    ?>
                        <span><?php echo $db->validation(); ?></span>
                    <?php
                        echo $form->inputs("text","username","form-control","formGroupExampleInput");
                    ?>
                </div>
                <div class="form-group">
                    <?php
                        echo $form->label("exampleInputEmail1","Email");
                        echo $form->inputs("text","email","form-control","exampleInputEmail1");
                    ?>
                </div>
                <div class="form-group">
                    <?php
                        echo $form->label("exampleInputEmail1","Firstname");
                        echo $form->inputs("text","firstname","form-control","exampleInputEmail1");
                    ?>
                </div>
                <div class="form-group">
                    <?php
                        echo $form->label("exampleInputEmail1","Lastname");
                        echo $form->inputs("text","lastname","form-control","exampleInputEmail1");
                    ?>
                </div>
                <div class="form-group">
                    <?php
                        echo $form->label("exampleInputPassword1","Mot de passe");
                        echo $form->inputs("password","password","form-control","exampleInputPassword1");
                    ?>
                </div>
                <div>
                <input type="file" name="image" >
                </div>      
                <center>
                    <?php
                        echo $form->button("submit","btn btn-primary bt","S'inscrir");
                    ?>
                </center>
            </form>
        </div>
    </section>
</body>
</html>