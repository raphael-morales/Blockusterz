<?php
include '_header.php';

try {
    $request = $db->prepare("SELECT * FROM `category`");
    $request->execute();
    $category = $request->fetchAll();

}catch (Exception $e){
    var_dump($e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_movie'])) {
    $movie_id_to_delete = $_POST['movie_id_to_delete'];
    try {
        $delete_request = $db->prepare('DELETE FROM movie WHERE movie_id = :id');
        $delete_request->bindParam(':id', $movie_id_to_delete);
        $delete_request->execute();
        echo 'Film supprimé avec succès.';
    } catch (Exception $e) {
        echo 'Erreur lors de la suppression du film : ' . $e->getMessage();
    }
}

try {
    $request = $db->prepare('SELECT movie_id, movie_title FROM movie');
    $request->execute();
    $films = $request->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo 'Erreur lors de la récupération de la liste des films : ' . $e->getMessage();
}

if (isset($_GET['category']) && !empty($_GET['category'])){

    try {

        $request = $db->prepare("SELECT * FROM `movie` WHERE movie_category=?");
        $request->execute([$_GET['category']]);
        $PlateformeFilms = $request->fetchAll();
        $msgInfo = "Il y a " . count($PlateformeFilms) . " Films enregistrés dans cette categorie";

    }catch (Exception $e){
        var_dump($e->getMessage());
    }

}else{
    try {
        $request = $db->prepare('SELECT * FROM movie');
        $request->execute([]);
        $PlateformeFilms = $request->fetchAll();

        $msgSuccess = count($PlateformeFilms) . " film(s) trouvé(s) !";

    } catch (Exception $e){
        $msgError = "Une erreur est survenue !";
    }
}

if (isset($_GET['search']) && !empty($_GET['search'])){

    try {
        $search = '%'.$_GET['search'].'%';
        $request = $db->prepare("SELECT * FROM `movie` WHERE movie_title LIKE ?");
        $request->execute([$search]);
        $PlateformeFilms = $request->fetchAll();
        $msgSuccess = "Il y a " . count($PlateformeFilms) . " Films enregistrés contenant le nom " . $_GET['search'];
    }catch (Exception $e){
        var_dump($e->getMessage());
    }
}

var_dump($films[0]['movie_title']);

?>

<h1 style="text-align: center">Movies list</h1>
<?php
echo  ' <div class="container-fluid" style="margin: auto; width: 60%">
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" name="search" placeholder="search a move" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>';
echo '<div style="display: flex; justify-content: space-evenly; margin-top: 5px">';
echo '<button type="button" class="btn btn-success"><a href="/list.php" style="text-decoration: none; color: white">All movies</a></button>';

foreach ($category as $item) {
    echo '<button type="button" class="btn btn-info"><a href="/list.php?category='.$item['category_name'].'" style="text-decoration: none; color: white">'.$item['category_name'].'</a></button>';
}
echo '</div>';


?>
<div style="display: flex; justify-content: space-around; width: 80%; margin:auto; flex-wrap: wrap">
    <?php if (isset($PlateformeFilms) && !empty($PlateformeFilms)) { ?>
        <?php foreach ($PlateformeFilms as $movie) : ?>
            <a href='detail.php?movie=<?php echo addslashes($movie["movie_title"]); ?>'>
                <div style='background-size: cover;
                            background-image: url(<?php echo $movie["movie_picture"]; ?>);
                            margin-top: 10px;
                            width: 300px;
                            height: 450px;'>
                </div>
            </a>
        <?php endforeach; ?>
    <?php } ?>
</div>


<div style="position: fixed; bottom: 10px; right: 10px;">
    <form method="post">
        <label for="movie_to_delete">Select a film to delete :</label>
        <select id="movie_to_delete" name="movie_id_to_delete">
            <?php foreach ($films as $film) : ?>
                <option value="<?php echo $film['movie_id']; ?>"><?php echo $film['movie_title']; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="delete_movie">
            <img src="img/icones/poubelle_icon.png" alt="Poubelle" style="width: 20px; height: 20px">
        </button>
    </form>
</div>

<?php
include '_footer.php';
?>

