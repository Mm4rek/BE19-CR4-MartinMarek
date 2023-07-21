<?php
require_once "db_connect.php";

$id = $_GET["id"];
$sql = "SELECT * FROM big_library WHERE id = $id";
$result = mysqli_query($connect, $sql);

$layout = "";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $layout = "
            <div class='card mb-3'>
                <img class='detailsImg' src='pictures/{$row["image"]}' class='card-img-top' alt='Photo'>
                <div class='card-body'>
                    <h5 class='card-title'>{$row["title"]}</h5>
                    <p class='card-text'>ISBN: {$row["isbn"]}</p>
                    <p class='card-text'>{$row["short_description"]}</p>
                    <p class='card-text'>Type: {$row["type"]}</p>
                    <p class='card-text'>Author: {$row["author_first_name"]} {$row["author_last_name"]}</p>
                    <p class='card-text'>Publisher: {$row["publisher_name"]}</p>
                    <p class='card-text'>Publisher Address: {$row["publisher_address"]}</p>
                    <p class='card-text'>Publish Date: {$row["publish_date"]}</p>
                    <a href='index.php' class='btn btn-primary'>Back</a>
                </div>
            </div>
        ";
    }
} else {
    $layout .= "<p>No Results was found</p>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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

