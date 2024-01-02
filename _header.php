<?php

session_start();


if (!isset($_SESSION['user'])) {

    $_SESSION['user'] = [];
}

try {


    $db = new PDO("mysql:host=localhost;dbname=blockusterz;charset=utf8", 'root', 'Morales03071994', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

}catch (Exception $e) {

    var_dump($e->getMessage());
}

$msgSuccess = "";
$msgError = "";

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #F9BC28 !important;">
            <div class="container-fluid">

                <a class="navbar-brand" href="index.php"><img style="width: 80px" src="img/logo/logo.png" alt="logo du site blockusterz"></a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav" style="width: 100%">
                        <div style="display: flex; font-weight: bold; width: -webkit-fill-available;">
                            <a class="nav-link" href="list.php">Movies List</a>
                            <a class="nav-link" href="add.php">Add movies</a>
                        </div>
                        <?php if (isset($_SESSION['user']) AND !empty($_SESSION['user'])) { ?>
                            <div style="display: flex; width: 100%; justify-content: end; font-weight: bold;">
                                <a class="nav-link" href="index.php?logout=true">Logout</a>
                            </div>
                        <?php } else { ?>
                            <div style="display: flex; width: 100%; justify-content: end; font-weight: bold;">
                                <a class="nav-link" href="codeco.php">Login</a>
                                <a class="nav-link" href="inscription.php">Sign Up</a>
                                <?php } ?>
                            </div>

                    </div>
                </div>
        </nav>
    </header>