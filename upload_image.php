<?php
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The image has been uploaded successfully.";
    } else {
        echo "There was an error uploading the image.";
    }
?>
