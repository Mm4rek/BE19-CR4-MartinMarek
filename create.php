<?php

require_once "db_connect.php";
require_once "file_upload.php";

if (isset($_POST["create"])) {
    $title = $_POST["title"];
    $image = fileUpload($_FILES["image"]);
    $isbn = $_POST["isbn"];
    $short_description = $_POST["short_description"];
    $type = $_POST["type"];
    $author_first_name = $_POST["author_first_name"];
    $author_last_name = $_POST["author_last_name"];
    $publisher_name = $_POST["publisher_name"];
    $publisher_address = $_POST["publisher_address"];
    $publish_date = $_POST["publish_date"];

    $sql = "INSERT INTO `big_library` (`title`, `image`, `isbn`, `short_description`, `type`, `author_first_name`, `author_last_name`, `publisher_name`, `publisher_address`, `publish_date`)
            VALUES ('$title', '$image[0]', '$isbn', '$short_description', '$type', '$author_first_name', '$author_last_name', '$publisher_name', '$publisher_address', '$publish_date')";

    if (mysqli_query($connect, $sql)) {
        echo "<div class='alert alert-success' role='alert'>
                New product has been added, {$image[1]}
              </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>
                Error occurred, {$image[1]}
              </div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library - Create New Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2>Create New Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3 mt-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" aria-describedby="title" name="title">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" aria-describedby="image" name="image">
        </div>
        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" class="form-control" id="isbn" aria-describedby="isbn" name="isbn">
        </div>
        <div class="mb-3">
            <label for="short_description" class="form-label">Short Description</label>
            <textarea class="form-control" id="short_description" name="short_description" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-control" id="type" name="type">
                <option value="book">Book</option>
                <option value="CD">CD</option>
                <option value="DVD">DVD</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="author_first_name" class="form-label">Author First Name</label>
            <input type="text" class="form-control" id="author_first_name" aria-describedby="author_first_name" name="author_first_name">
        </div>
        <div class="mb-3">
            <label for="author_last_name" class="form-label">Author Last Name</label>
            <input type="text" class="form-control" id="author_last_name" aria-describedby="author_last_name" name="author_last_name">
        </div>
        <div class="mb-3">
            <label for="publisher_name" class="form-label">Publisher Name</label>
            <input type="text" class="form-control" id="publisher_name" aria-describedby="publisher_name" name="publisher_name">
        </div>
        <div class="mb-3">
            <label for="publisher_address" class="form-label">Publisher Address</label>
            <textarea class="form-control" id="publisher_address" name="publisher_address" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="publish_date" class="form-label">Publish Date</label>
            <input type="date" class="form-control" id="publish_date" name="publish_date">
        </div>
        <button name="create" type="submit" class="btn btn-primary">Create Product</button>
        <a href="index.php" class="btn btn-warning">Back to Library</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
