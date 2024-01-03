<?php
// Vérifie si le bouton Modifier a été cliqué et s'il y a une clé à modifier
include '_header.php';

// Si le formulaire est soumis avec les modifications
if (isset($_POST)) {

    try {
        $title = $_POST['title'];
        $year = $_POST['year'];
        $real = $_POST['real'];
        $picture = $_POST['picture'];
        $trailer = $_POST['trailer'];
        $duration = $_POST['duration'];
        $category = $_POST['cat'];
        $movie_id = $_GET['movie'];

        $sql = "UPDATE movie SET movie_title = ?, 
                                 movie_date = ?, 
                                 movie_real = ?, 
                                 movie_picture = ?, 
                                 movie_trailer = ?, 
                                 movie_duration = ?, 
                                 movie_category = ? 
                            WHERE movie_id = ?";

        // Prepare statement
        $stmt = $db->prepare($sql);

        // execute the query
        $stmt->execute([$title, $year, $real, $picture, $trailer, $duration, $category, $movie_id]);

        // echo a message to say the UPDATE succeeded
        echo $stmt->rowCount() . " Les modifications ont été effectuées avec succés";
    } catch (PDOException $e) {
        echo $sql . "<br>!" . $e->getMessage();
    }

    // Recharger la page ou rediriger vers la même page pour refléter les changements
    // header("Location: {$_SERVER['PHP_SELF']}");

}

try {
    $request = $db->prepare("SELECT * FROM category");
    $request->execute([]);
    $categories = $request->fetchAll();
} catch (Exception $e) {
    echo $e->getMessage();
}

try {
    $request = $db->prepare("SELECT * FROM `movie` WHERE movie_id= ?");
    $request->execute([$_GET['movie']]);
    $movie = $request->fetch();
} catch (Exception $e) {
    var_dump($e->getMessage());
}

if ($_GET['update'] === 'true') {
?>

    <div class="container-form">

        <form action="" method="post" style="width: 60%; margin: auto">
            <div class="mb-3">
                <label for="title" class="form-label">Movie title</label>
                <input type="text" class="form-control" name="title" value="<?= $movie['movie_title'] ?>" id="title" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Release date</label>
                <input type="number" class="form-control" name="year" value="<?= $movie['movie_date'] ?>" id="year">
            </div>
            <div class="mb-3">
                <label for="real" class="form-label">Movie maker</label>
                <input type="text" class="form-control" name="real" value="<?= $movie['movie_real'] ?>" id="real">
            </div>
            <div class="form-group">
                <label for="synopsis">Synopsis</label>
                <textarea class="form-control" name="synopsis" id="synopsis" rows="3"> <?= $movie['movie_synopsis'] ?> </textarea>
            </div>

            <div class="mb-3">
                <label for="picture" class="form-label">Movie picture</label>
                <input type="text" class="form-control" name="picture" value="<?= $movie['movie_picture'] ?>" id="picture">
            </div>
            <div class="mb-3">
                <label for="trailer" class="form-label">Trailer</label>
                <input type="text" class="form-control" name="trailer" value="<?= $movie['movie_trailer'] ?>" id="trailer">
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Movie time</label>
                <input type="time" class="form-control" name="duration" value="<?= $movie['movie_duration'] ?>" id="duration">
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="cat" name="cat">

                    <?php foreach ($categories as $cat) {
                        if ($cat['category_name'] == $movie['$movie_category']) {
                            echo "<option selected value='{$cat['category_name']}'>{$cat['category_name']}</option>";
                        } else {
                            echo '<option value="' . $cat["category_name"] . '">' . $cat["category_name"] . '</option>';
                        }
                    }


                    ?>

                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


<?php
}
var_dump($_POST);


?>