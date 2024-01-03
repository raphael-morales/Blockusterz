<?php
ob_start();
include '_header.php';
include 'img/icones/star.php';

if (isset($_GET['delete']) && !empty($_GET['delete'])) {
  try {

    $request = $db->prepare("DELETE FROM `movie` WHERE movie_id=?");
    $request->execute([$_GET['delete']]);
  } catch (Exception $e) {
    var_dump($e->getMessage());
  }
}

if (isset($_GET['movie']) && !empty($_GET['movie'])) {
  try {

    $request = $db->prepare("SELECT * FROM `movie` WHERE movie_title=?");
    $request->execute([$_GET['movie']]);
    $movie = $request->fetch();
  } catch (Exception $e) {
    var_dump($e->getMessage());
  }
}

if (isset($_POST['rate']) && !empty($_POST['rate'])){
    $_SESSION['user'][$movie['movie_id']] = $_POST['rate'];

    if ($movie['rate'] !== null){
        $rate = ($movie['rate'] + $_POST['rate']) / 2;
    }else{
        $rate = $_POST['rate'];
    }

    try {
        $request = $db->prepare("UPDATE `movie` SET `rate`=? WHERE movie_id=?");
        $request->execute([
            $rate,
            $movie['movie_id'],
        ]);
    }catch (Exception $e){
        var_dump(($e->getMessage()));
    }
    header('location: detail.php?movie='.$movie["movie_title"]);
}
$rate = $movie['rate'];

if (isset($_GET['movie']) && !empty($_GET['movie']) && !empty($movie)) {
  echo '<div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <img style="max-height: 819px" src="' . $movie["movie_picture"] . '" class="card-img-top" alt="affiche du film ' . $movie['movie_title'] . '">
            </div>
            <div class="col-md-8" style="display: flex">
              <div class="card-body" style="display: flex; flex-direction: column">
                <h5 class="card-title">' . $movie['movie_title'] . '</h5>
                <p class="card-text">Réalisateur : ' . $movie['movie_real'] . '</p>
                <p class="card-text">Catégorie : ' . $movie['movie_category'] . '</p>
                <p class="card-text">' . $movie['movie_synopsis'] . '</p>
                <p class="card-text"><small class="text-body-secondary">Durée du film : ' . $movie['movie_duration'] . '</small></p>
                <p class="card-text"><small class="text-body-secondary">Année de sortie du film : ' . $movie['movie_date'] . '</small></p>';
  if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    echo '<div style="display: flex; justify-content: end; margin-bottom: 5px">
                        <button type="button" class="btn btn-primary" style="width: 10%; justify-content: end"><a href="update.php?movie=' . $movie['movie_id'] . '&update=true" style="text-decoration: none; color: white">Modifier</a></button>
                    </div>
                    <div style="display: flex; justify-content: end">
                        <button type="button" class="btn btn-danger" style="width: 10%; justify-content: end"><a href="detail.php?movie=' . $movie['movie_id'] . '&delete=' . $movie['movie_id'] . '" style="text-decoration: none; color: white">Supprimer</a></button>
                    </div>';
    }
    if (isset($_SESSION['user']) && !empty($_SESSION['user']) && !isset($_SESSION['user'][$movie['movie_id']])){
        echo '<form style="display: flex" method="post">';
                for ($i = 1; $i <= 5; $i++ ){
                    echo '<div style="display: flex; flex-direction: column; align-items: center">
                            <label id="star'.$i.'" for="rate'.$i.'">'.$star.'</label>
                            <input  style="display: none" type="radio" value="'.$i.'" id="rate'.$i.'" name="rate">
                          </div>';
                }
                  echo '<div>
                          <button type="submit" class="btn btn-success">Voter</button>
                        </div>
              </form>';
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

?>

<script>
    const rate1 = document.getElementById('rate1');
    const star1 = document.getElementById('star1');
    const rate2 = document.getElementById('rate2');
    const star2 = document.getElementById('star2');
    const rate3 = document.getElementById('rate3');
    const star3 = document.getElementById('star3');
    const rate4 = document.getElementById('rate4');
    const star4 = document.getElementById('star4');
    const rate5 = document.getElementById('rate5');
    const star5 = document.getElementById('star5');

    star1.addEventListener("click", () => {
        star1.style.fill = 'red';
        star2.style.fill = 'black';
        star3.style.fill = 'black';
        star4.style.fill = 'black';
        star5.style.fill = 'black';

    });

    star2.addEventListener("click", () => {
        // star1.style.fill = 'red';
            star1.style.fill = 'red';
            star2.style.fill = 'red';
            star3.style.fill = 'black';
            star4.style.fill = 'black';
            star5.style.fill = 'black';

    });

    star3.addEventListener("click", () => {
        // star1.style.fill = 'red';
        star1.style.fill = 'red';
        star2.style.fill = 'red';
        star3.style.fill = 'red';
        star4.style.fill = 'black';
        star5.style.fill = 'black';

    });

    star4.addEventListener("click", () => {
        // star1.style.fill = 'red';
        star1.style.fill = 'red';
        star2.style.fill = 'red';
        star3.style.fill = 'red';
        star4.style.fill = 'red';
        star5.style.fill = 'black';

    });

    star5.addEventListener("click", () => {
        // star1.style.fill = 'red';
        star1.style.fill = 'red';
        star2.style.fill = 'red';
        star3.style.fill = 'red';
        star4.style.fill = 'red';
        star5.style.fill = 'red';

    });
</script>

<?php
include '_footer.php';
