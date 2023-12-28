<?php
ob_start();
include('_header.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = $db->prepare("SELECT user_username, user_pswrd FROM utilisateurs WHERE user_username = ?");
    $sql->execute([$username]);
    $result = $sql->fetch();


    if (password_verify($password, $result['user_pswrd'])) {
        $_SESSION['user'] = ['firstname' => $username];
        header('Location: index.php');

        exit();
    } else {
        $error_message = "Identifiants invalides. Veuillez réessayer.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 60vh;
        }

        form {
            width: 300px;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>


    <div class="container">
        <h2>Connexion</h2>

        <?php
        if (isset($error_message)) {
            echo '<p class="error">' . $error_message . '</p>';
        }
        ?>

        <form action="codeco.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" name="login" value="Connect">
        </form>

        <?php
        if (isset($_SESSION['user_id'])) {
            echo '<p>Logged in as\'user.</p>';
            echo '<p><a href="index.php?logout=true">Disconnection/a></p>';
        }
        ?>
    </div>
    <?php include('_footer.php') ?>

</body>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('img/Fond/bobine.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        overflow: hidden;
    }
</style>

</html>