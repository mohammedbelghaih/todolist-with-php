<?php
    session_start();
    include("./App/addtask.php");
    $t=new App\edittask();
    $db=new App\Database();
    if(isset($_POST["submit"])){
        $T=$_GET['idt'];
        $text=$_POST["taskText"];
        $t->etask($text,$T);
    }
    
    require("form.php");
    $form=new form();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section class="insc">
        <div class="fr">   
            <form method="POST" class="container">
                <div class="form-group">
                    <?php
                        echo $form->label("formGroupExampleInput","modifier le task");
                    ?>
                    <?php
                        echo $form->inputs("text","taskText","form-control","formGroupExampleInput");
                    ?>
                </div>
                
                    <?php echo $form->button("submit","btn btn-primary btnb","modifier"); ?>
                
            </form>
        </div>
    </section>
</body>
</html>