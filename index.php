<?php
include '_header.php';

if (isset($_GET['logout']) and $_GET['logout'] == "true") {

    $_SESSION = [];
    session_destroy();
    header('location: index.php');
    exit();
}

if (isset($_GET['login']) and $_GET['login'] === "true") {
    $msgSuccess = "Bienvenue " . $_SESSION['user']['firstname'] . " !";
}

?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('img/Fond/SalleCinema.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        overflow: hidden;
    }

        .container {
    width: 80%;
    margin: 0 auto;
            padding: 20px;
            background-color: #FFFE71;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
    text-align: center;
            margin-bottom: 20px;
        }
h3 {
    text-align: center;
    margin-bottom: 20px;
}

        .content {
    display: flex;
    justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .image-container {
    margin-bottom: 20px;
        }

        .image-container img {
    max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .text-container {
    text-align: justify;
            line-height: 1.6;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Welcome to Blockusterz</h1>
        <h3>The library of films made by fans for fans!</h3>

        <div class="content">
            <div class="image-container">
                <img src="img/logo/logo.png" alt="Description de l'image">
            </div>

            <div class="text-container">
                <p>Create your account so you can add films, rate them and give us your opinion on them.</p>
            </div>
        </div>
    </div>

<?php
include "_footer.php";
?>