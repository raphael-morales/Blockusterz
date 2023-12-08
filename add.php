<?php
include '_header.php';
?>

<h1>Add a new movie</h1>

<form action="valid.php" method="post" style="width: 60%; margin : auto">

    <div class="mb-3">
        <label for="movie-title" class="form-label">Movie title</label>
        <input type="text" class="form-control" name="movie-title" id="movie-title" aria-describedby="movie-title">
    </div>

    <div class="mb-3">
        <label for="release-date" class="form-label">Release date</label>
        <input type="date" class="form-control" name="release-date" id="release-date" aria-describedby="release-date">
    </div>

    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select id="category" name="category">
            <option value="action">Action</option>
            <option value="drama">Drama</option>
            <option value="romantic">Romantic</option>
            <option value="fiction">Fiction</option>
            <option value="comedy">Comedy</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="synopsis" class="form-label">Synopsis</label>
        <input type="text" class="form-control" name="synopsis" id="synopsis" aria-describedby="synopsis">
    </div>

    <div class="mb-3">
        <label for="picture" class="form-label">Download picture</label>
        <input type="text" class="form-control" name="picture" id="picture" aria-describedby="picture">
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
