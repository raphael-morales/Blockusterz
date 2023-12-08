<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user_data = $username . ',' . password_hash($password, PASSWORD_DEFAULT) . PHP_EOL;
    $sql = "INSERT INTO utilisateurs (user_username, user_pswrd) VALUES ('$username', '" . password_hash($password, PASSWORD_DEFAULT) . "')";


    if ($db->query($sql) === TRUE) {
        $success_message = "Enregistrement réussi. Vous pouvez maintenant vous connecter à votre compte.";
    } else {
        $error_message = "Erreur lors de l'enregistrement : " . $db->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registration</title>
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

    <?php include('_header.php'); ?>

    <div class="container">
        <h2>Registration</h2>

        <?php
        if (isset($error_message)) {
            echo '<p class="error">' . $error_message . '</p>';
        }

        if (isset($success_message)) {
            echo '<p class="success">' . $success_message . '</p>';
        }
        ?>

        <form action="inscription.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" name="register" value="Sign Up">
        </form>
    </div>

    <?php include('_footer.php'); ?>

</body>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('img/Fond/1552587.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        overflow: hidden;
    }
</style>

</html>