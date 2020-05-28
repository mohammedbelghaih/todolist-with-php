<?php
    session_start();
    include("./App/Database.php");
    $db=new App\Database();
    $id=$_SESSION["user"];
    $result=$db->sql("select * from todolist where user_id='$id'");
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todolist</title>
</head>
<body>
    <?php foreach($result as $name){ ?>
        <div class="form-group">
            <a href="todolist.php?tl=<?php echo $name['id_L'] ?>"><?php echo $name["name"];  ?></a>
            <a href="delete.php?dll=<?php echo $name['id_L'] ?>"><input type="button" value="Supprimer"></a>
        </div>
    <?php } ?>
</body>
</html>