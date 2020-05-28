<?php 
    session_start();
    include("./App/Database.php");

    $db=new App\Database();
    $id=$_SESSION["user"];
    $dd=$db->sql("select * from users where id_U='$id'");

    if(isset($_POST["add"])){
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach($dd as $img){ ?>
        <img src="img/<?php echo $img["photo"]; ?>">
    <?php } ?>
        <form method="POST" enctype="multipart/form-data">
        <input type="file" name="image" class="custom-file-input" id="inputGroupFile04">
        <input type="submit" name="add" value="add">
        </form>
</body>
</html>