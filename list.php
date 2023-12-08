<?php include '_header.php';
//var_dump($_POST);
//var_dump($_SESSION);

if (isset($_GET["suppr"]) and $_GET["suppr"] === "true") {
    $id = $_GET["id"];
    unset($_SESSION["movie"][$id]);
}  ?>

<h1>Movies List</h1>

<?php if (!isset($_GET["note"])) { ?>
<a href="list.php?filtre=true">Movie Rating</a>
<?php } else { ?>
<a href="list.php?">All the Movies</a>
<?php }

if (empty($_SESSION["movie"])){
    //$msg = $msgError;
    $msgError = "Il n'y a aucun film enregistré.";
}

foreach($_SESSION['movie'] as $key => $value){
    if((isset($_GET['filtre']) AND $_GET['filtre'] === 'true' AND isset($value["commentaire"])) OR !isset($_GET['filtre'])){
        echo "<div class='card'>  
        <div class='card-group'>
            <div class='card'>    
                <img src='...' class='card-img-top' alt='...'>    
                <div class='card-body'>      
                <h5 class='card-title'> Title  : {$_SESSION['movie'][$key]['movie-title']}</h5>      
                <p class='card-text'> Release date  : {$_SESSION['movie'][$key]['release-date']}</p>      
                <p class='card-text'> Category : {$_SESSION['movie'][$key]['category']}</p>
                <p class='card-text'> Synopsis  : {$_SESSION['movie'][$key]['synopsis']}</p>
                <p class='card-text'> Note  : {$_SESSION['movie'][$key]['note']}</p>
                <a href='detail.php?id=$key' class='card-link'> Voir le détail </a>
            </div>  
        </div>";
    }
}