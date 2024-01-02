<?php
ob_start();
include '_header.php';

if (isset($_GET['delete']) && !empty($_GET['delete'])){
    try {

        $request = $db->prepare("DELETE FROM `movie` WHERE movie_id=?");
        $request->execute([$_GET['delete']]);

    }catch (Exception $e){
        var_dump($e->getMessage());
    }
}

if (isset($_GET['movie']) && !empty($_GET['movie'])){
    try {

        $request = $db->prepare("SELECT * FROM `movie` WHERE movie_title=?");
        $request->execute([$_GET['movie']]);
        $movie = $request->fetch();


    }catch (Exception $e){
        var_dump($e->getMessage());
    }
}


//echo '<pre>';
//var_dump($movie);
//echo '</pre>';

if (isset($_GET['movie']) && !empty($_GET['movie']) && !empty($movie)){
    echo '<div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img style="max-height: 819px" src="'.$movie["movie_picture"].'" class="card-img-top" alt="affiche du film '.$movie['movie_title'].'">
            </div>
            <div class="col-md-8" style="display: flex">
              <div class="card-body" style="display: flex; flex-direction: column">
                <h5 class="card-title">'.$movie['movie_title'].'</h5>
                <p class="card-text">Réalisateur : '.$movie['movie_real'].'</p>
                <p class="card-text">Catégorie : '.$movie['movie_category'].'</p>
                <p class="card-text">'.$movie['movie_synopsis'].'</p>
                <p class="card-text"><small class="text-body-secondary">Durée du film : '.$movie['movie_duration'].'</small></p>
                <p class="card-text"><small class="text-body-secondary">Année de sortie du film : '.$movie['movie_date'].'</small></p>';
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        echo '<div style="display: flex; justify-content: end; margin-bottom: 5px">
                        <button type="button" class="btn btn-primary" style="width: 10%; justify-content: end"><a href="/add.php?movie=' . $movie['movie_id'] . '&update=true" style="text-decoration: none; color: white">Modifier</a></button>
                    </div>
                    <div style="display: flex; justify-content: end">
                        <button type="button" class="btn btn-danger" style="width: 10%; justify-content: end"><a href="/data.php?movie=' . $movie['movie_id'] . '&delete=' . $movie['movie_id'] . '" style="text-decoration: none; color: white">Supprimer</a></button>
                    </div>';
        echo '<div class="rating">
  <input type="radio" id="star5" name="rating" value="5"><label for="star5"></label>
  <input type="radio" id="star4" name="rating" value="4"><label for="star4"></label>
  <input type="radio" id="star3" name="rating" value="3"><label for="star3"></label>
  <input type="radio" id="star2" name="rating" value="2"><label for="star2"></label>
  <input type="radio" id="star1" name="rating" value="1"><label for="star1"></label>
</div>';
    }
    echo '<div style="display: flex; justify-content: end; height: 100%; align-items: end">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/'.$movie['movie_trailer'].'?si=YQoHVXAO1_PhLiRM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
              </div>
              </div>
            </div>
          </div>
        </div>';
}else{
    header('location: list.php');
}


include '_footer.php';
?>
