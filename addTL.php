<?php
    session_start();
    include("./App/addlist.php");

    $db=new App\addlist();
    require("form.php");
    $form=new form();
    if(isset($_POST["add"])){
        $name=$_POST["name"];
        $color=$_POST["color"];
        $id=$_SESSION["user"];
        $db->add($name,$color,$id);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Ajouter</title>
</head>
<body>
<section class="insc">
        <div class="fr">   
            <form method="POST" class="container">
                <div class="form-group">
                    <?php
                        echo $form->label("exampleInputEmail1","Titre");
                        echo $form->inputs("text","name","form-control","exampleInputEmail1");
                    ?>
                </div>
                <div class="form-group">
            <?php 
                echo $form->label("exampleInputEmail1","Couleur");
                echo $form->inputs("color","color","form-control","exampleInputPassword1");
            ?>
        </div>
        <center>
            <?php echo $form->button("add","btn btn-primary bt","Ajouter"); ?>
        </center>
        </form>
    </div>
</section>
</body>
</html>