<?php
    require_once "db_connect.php";

    $id = $_GET["id"]; // to take the value from the parameter "id" in the url 
    $sql = "SELECT * FROM big_library WHERE id = $id"; // finding the product 
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);  // fetching the data 
    if($row["image"] != "product.png"){ // if the picture is not product.png (the detault picture) we will delete the picture
        unlink("pictures/$row[image]");
    }
    
    $delete = "DELETE FROM big_library WHERE id = $id"; // query to delete a record from the database

    if(mysqli_query($connect, $delete)){
        header("Location: index.php");
    }else {
        echo "Error";
    }
    
    mysqli_close($connect);
?>

<?php 

    function fileUpload($pic){
        if($pic["error"] == 4){
            $pictureName = "product.png";
            $message = "No picture has been chosen, but you can upload an image later.";
        } else {
            $checkIfImage = getimagesize($pic["tmp_name"]);
            $message = $checkIfImage ? "Success" : "Not an image";
        }

        if($message == "Success"){
            $ext = strtolower(pathinfo($pic["name"], PATHINFO_EXTENSION));
            $pictureName = uniqid("") . "." . $ext;

            $destination = "pictures/{$pictureName}";
            move_uploaded_file($pic["tmp_name"], $destination);
        }elseif($message == "Not an image"){
            $pictureName = "product.png";
            $message = "the file that you chose is not an image!";
        }
        return [$pictureName, $message];
    }