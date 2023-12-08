<?php
include '_header.php';


if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header('Location: signUp.php');
    exit();
}
try {

    $request = $db->prepare("SELECT * FROM category");
    $request->execute([]);
    $categories = $request->fetchAll();
} catch (Exception $e) {
    echo $e->getMessage();
}


if (
    isset($_POST['title'])      &&
    isset($_POST['year'])       &&
    isset($_POST['real'])       &&
    isset($_POST['synopsis'])   &&
    isset($_POST['picture'])    &&
    isset($_POST['trailer'])    &&
    isset($_POST['duration'])   &&
    isset($_POST['cat'])
) {

    if (
        empty($_POST['title'])     ||
        empty($_POST['year'])      ||
        empty($_POST['real'])      ||
        empty($_POST['picture'])   ||
        empty($_POST['duration'])  ||
        empty($_POST['cat'])
    ) {

        $msgError = 'Veuillez remplir tous les champs';
    } else {



        try {

            $synopsis = empty($_POST['synopsis']) ? null : $_POST['synopsis'];
            $trailer = empty($_POST['trailer']) ? null : $_POST['trailer'];

            $request = $db->prepare('INSERT INTO movie (movie_title, 
                                                       movie_date, 
                                                       movie_duration,
                                                       movie_synopsis,
                                                       movie_real,
                                                       movie_trailer,
                                                       movie_category,
                                                       movie_picture) VALUES (?,?,?,?,?,?,?,?)');

            $request->execute([
                $_POST['title'],
                $_POST['year'],
                $_POST['duration'],
                $_POST['synopsis'],
                $_POST['real'],
                $_POST['trailer'],
                $_POST['cat'],
                $_POST['picture']
            ]);

            $msgSuccess = "Le film {$_POST['title']} a bien été ajouté !";
        } catch (Exception $e) {
            var_dump($e->getMessage());

            $msgError = "Le film {$_POST['title']} n'a pas pu être ajouté !";
        }
    }
}


?>


<h1>Add a new movie</h1>

<form action="" method="post" style="width: 60%; margin: auto">
    <div class="mb-3">
        <label for="title" class="form-label">Movie title</label>
        <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="year" class="form-label">Release date</label>
        <input type="number" class="form-control" name="year" id="year">
    </div>
    <div class="mb-3">
        <label for="real" class="form-label">Movie maker</label>
        <input type="text" class="form-control" name="real" id="real">
    </div>
    <div class="form-group">
        <label for="synopsis">Synopsis</label>
        <textarea class="form-control" name="synopsis" id="synopsis" rows="3"></textarea>
    </div>

    <div class="mb-3">
        <label for="picture" class="form-label">Movie picture</label>
        <input type="text" class="form-control" name="picture" id="picture">
    </div>
    <div class="mb-3">
        <label for="trailer" class="form-label">Trailer</label>
        <input type="text" class="form-control" name="trailer" id="trailer">
    </div>
    <div class="mb-3">
        <label for="duration" class="form-label">Movie time</label>
        <input type="time" class="form-control" name="duration" id="duration">
    </div>

    <div class="form-group">
        <label for="cat">Category</label>
        <select class="form-control" id="cat" name="cat">

            <?php foreach ($categories as $cat) {
                echo "<option value='{$cat['category_name']}'>{$cat['category_name']}</option>";
            } ?>

        </select>
    </div>


    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
include '_footer.php';
?>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('img/Fond/listefilm.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        overflow: hidden;
        color: white;
        backdrop-filter: brightness(40%);
    }
</style>