<?php
    session_start();
    include("./App/addtask.php");
    $t=new App\addtask();
    $db=new App\Database();
    $id=$_SESSION["user"];
    $result=$db->sql("select * from todolist where user_id='$id'");
    if(isset($_POST["submit"])){
        $idtl= $_POST["idtl"];
        $task=$_POST["task"]; 
        $t->task($task,$idtl);
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
    <title>add task</title>
</head>
<body>
    <section class="insc">
        <div class="fr">   
            <form method="POST" class="container">
            <div class="form-group">
                <label for="exampleFormControlSelect1">todolist</label>
                <select class="form-control" name="idtl" id="exampleFormControlSelect1">
                <?php foreach($result as $name){ ?>
                <option value="<?php echo $name["id_L"]; ?>"><?php echo $name["name"]; ?></option>
                <?php } ?>
                </select>
            </div>
                <div class="form-group">
                    <?php
                        echo $form->label("formGroupExampleInput","task");
                    ?>
                    <?php
                        echo $form->inputs("text","task","form-control","formGroupExampleInput");
                    ?>
                </div>
                
                    <?php echo $form->button("submit","btn btn-primary btnb","Ajouter"); ?>
                
            </form>
        </div>
    </section>
</body>
</html>