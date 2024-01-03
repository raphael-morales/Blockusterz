<?php
include '_header.php';

$result = json_decode(file_get_contents('https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=true&language=fr&page='.$_GET['page'].'&sort_by=popularity.desc&api_key=c42b18c704b68fc89277887e1921a730'));


echo '<div style="display: flex; justify-content: center; flex-wrap: wrap">';
foreach ($result as $movies => $movie) {
    if ($movies == 'results'){
//        echo '<pre>';
//        var_dump($movie);
//        echo '</pre>';
        foreach ($movie as $value){
            echo '<a href="detail.php?movie=" style="width: 368px; height:499px ; margin: 5px">
                        <img style="width: 368px; height:499px" src="https://image.tmdb.org/t/p/w500'.$value->poster_path.'" class="card-img-top" alt="affiche du film">
                  </a>';
        }
    }
}
echo '</div>';

//echo '<pre>';
//var_dump($result);
//echo '</pre>';

echo '<div style="display: flex; justify-content: center">';
        for ($i=1; $i <= 20; $i++){
            echo '<p style="margin: 5px">
                    <a href="/listMovies.php?page='.$i.'">'.$i.'</a>
                  </p>';
        }
echo '</div>';

include '_footer.php';
