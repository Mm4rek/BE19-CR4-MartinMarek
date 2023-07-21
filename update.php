<?php
require_once "db_connect.php";
require_once "file_upload.php";

$id = $_GET["id"];
$sql = "SELECT * FROM big_library WHERE id = $id";
$result = mysqli_query($connect, $sql);

$layout = "";

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Process form submission
    if (isset($_POST["update"])) {
        $title = $_POST["title"];
        $isbn = $_POST["isbn"];
        $short_description = $_POST["short_description"];
        $type = $_POST["type"];
        $author_first_name = $_POST["author_first_name"];
        $author_last_name = $_POST["author_last_name"];
        $publisher_name = $_POST["publisher_name"];
        $publisher_address = $_POST["publisher_address"];
        $publish_date = $_POST["publish_date"];

        // Check if a new image is uploaded
        if ($_FILES["image"]["size"] > 0) {
            $image_result = fileUpload($_FILES["image"]);
            if ($image_result[0] !== null) {
                // If the upload is successful, update the image column in the database
                $image = $image_result[0];
            } else {
                // If there's an error in uploading the new image, use the existing image path
                $image = $row["image"];
            }
        } else {
            // If no new image is uploaded, use the existing image path
            $image = $row["image"];
        }

        // Update the details in the database
        $update_sql = "UPDATE big_library SET 
                        title = '$title', 
                        image = '$image', 
                        isbn = '$isbn', 
                        short_description = '$short_description', 
                        type = '$type', 
                        author_first_name = '$author_first_name', 
                        author_last_name = '$author_last_name', 
                        publisher_name = '$publisher_name', 
                        publisher_address = '$publisher_address', 
                        publish_date = '$publish_date' 
                        WHERE id = $id";

        if (mysqli_query($connect, $update_sql)) {
            // Redirect to the updated details page
            header("Location: details.php?id=$id");
            exit;
        } else {
            $layout .= "<div class='alert alert-danger' role='alert'>
                            Error updating details.
                        </div>";
        }
    }

    $layout = "
        <form method='POST' enctype='multipart/form-data'>
            <div class='mb-3 mt-3'>
                <label for='title' class='form-label'>Title</label>
                <input type='text' class='form-control' id='title' aria-describedby='title' name='title' value='{$row["title"]}'>
            </div>
            <div class='mb-3'>
                <label for='image' class='form-label'>Image</label>
                <input type='file' class='form-control' id='image' aria-describedby='image' name='image'>
            </div>
            <div class='mb-3'>
                <label for='isbn' class='form-label'>ISBN</label>
                <input type='text' class='form-control' id='isbn' aria-describedby='isbn' name='isbn' value='{$row["isbn"]}'>
            </div>
            <div class='mb-3'>
                <label for='short_description' class='form-label'>short_description</label>
                <input type='text' class='form-control' id='short_description' aria-describedby='short_description' name='short_description' value='{$row["short_description"]}'>
            </div>
            <div class='mb-3'>
        <label for='type' class='form-label'>Type</label>
        <select class='form-control' id='type' name='type'>
            <option value='book' " . ($row["type"] == 'book' ? 'selected' : '') . ">Book</option>
            <option value='CD' " . ($row["type"] == 'CD' ? 'selected' : '') . ">CD</option>
            <option value='DVD' " . ($row["type"] == 'DVD' ? 'selected' : '') . ">DVD</option>
        </select>
        </div>
        <div class='mb-3'>
        <label for='author_first_name' class='form-label'>Author First Name</label>
        <input type='text' class='form-control' id='author_first_name' aria-describedby='author_first_name' name='author_first_name' value='{$row["author_first_name"]}'>
    </div>
    <div class='mb-3'>
        <label for='author_last_name' class='form-label'>Author Last Name</label>
        <input type='text' class='form-control' id='author_last_name' aria-describedby='author_last_name' name='author_last_name' value='{$row["author_last_name"]}'>
    </div>
    <div class='mb-3'>
        <label for='publisher_name' class='form-label'>Publisher Name</label>
        <input type='text' class='form-control' id='publisher_name' aria-describedby='publisher_name' name='publisher_name' value='{$row["publisher_name"]}'>
    </div>
    <div class='mb-3'>
        <label for='publisher_address' class='form-label'>Publisher Address</label>
        <textarea class='form-control' id='publisher_address' name='publisher_address' rows='3'>{$row["publisher_address"]}</textarea>
    </div>
    <div class='mb-3'>
        <label for='publish_date' class='form-label'>Publish Date</label>
        <input type='date' class='form-control' id='publish_date' name='publish_date' value='{$row["publish_date"]}'>
    </div>
        
            <button name='update' type='submit' class='btn btn-primary'>Update</button>
            <a href='index.php' class='btn btn-warning'>Back to Library</a>
        </form>
    ";
} else {
    $layout .= "<p>No Results was found</p>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Update Details</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM' crossorigin='anonymous'>
    <link rel='stylesheet' href='style.css'>
</head>

<body>
    <nav class="myNav navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php">Create</a>
                        <li class="nav-item">
                        <a class="nav-link" href="display_media.php">Media</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <?= $layout ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>

