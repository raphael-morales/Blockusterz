<?php

include "_header.php";


$idMovie = $_GET['id'];

$data = $_SESSION['movie'][$_GET['id']];

if (isset($_GET['id']) && !empty($data)) {
   echo '<div class="card mb-3" style="align-items: center; width: 50%; margin: auto">
                <img src="'.$data['picture'].'" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">'.$data['movie-title'].'</h5>
                <p class="card-text">'.$data['category'].'</p>
                <p class="card-text">'.$data['synopsis'].'</p>
                <p class="card-text"><small class="text-body-secondary">'.$data['release-date'].'</small></p>
            </div>
          </div>';
}


include "_footer.php";
