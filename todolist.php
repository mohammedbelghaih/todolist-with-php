<?php
    session_start();
    include("./App/Database.php");
    $db=new App\Database();
    $id=$_SESSION["user"];
    $ll=$_GET["tl"];
    $_SESSION["ll"]=$ll;
    $result=$db->sql("select if(done, 'true', 'false')done, id_T, todolist_id,taskText, id_L, color, user_id from todolist, task where user_id='$id' and todolist_id='$ll' and id_L=$ll GROUP BY id_T");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Tasks</title>
</head>
<body>
<table class="table" id="tab">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Taches</th>
      <th scope="col">Done</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($result as $tl){ 
      $color = $tl['color'];
      echo "<script>
      function color(){
      document.getElementById('tab').style.backgroundColor='$color';
      }
      color();
    </script>";
    ?>
    <tr>
      <th scope="row"><?php echo $tl["id_T"] ?></th>
      <td><?php echo $tl["taskText"] ?></td>
      <td><?php echo $tl["done"] ?></td>
      <td><a href="edit.php?idt=<?php echo $tl["id_T"]; ?>"><input type="button" value="modifier"></a><a href="delete.php?dl=<?php echo $tl["id_T"]; ?>"><input type="button" value="Supprimer"></a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>


</body>
</html>