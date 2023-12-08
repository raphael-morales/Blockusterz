<?php
include '_header.php';

?>



<?php

// $msgSuccess = '';
// $msgAlert = '';

if (
    isset($_POST['movie-title']) &&
    !empty($_POST['release-date']) &&
    !empty($_POST['category']) &&
    !empty($_POST['synopsis']) &&
    !empty($_POST['picture'])
) {

    // $msgSuccess = 'Movie added successfully !';

    $data = [
        "movie-title"   => $_POST['movie-title'],
        "release-date"  => $_POST['release-date'],
        "category"      => $_POST['category'],
        "synopsis"      => $_POST['synopsis'],
        "picture"       => $_POST['picture']
    ];

    array_push($_SESSION['movie'], $data);
} else {

    // $msgError =  "Please fill in all the blanks";
}

?>


<?php
// include 'box.php';
echo "<pre>";

var_dump($_SESSION['movie']);

echo "</pre>";

include '_footer.php';
?>