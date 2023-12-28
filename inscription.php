<?php
ob_start();
include '_header.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    try {
        $request = $db->prepare("INSERT INTO `utilisateurs` (user_pswrd, user_username) VALUE (?, ?)");

        $request->execute([
            $passwordHash,
            $username,
        ]);

        $_SESSION['user'] = [
            'email' => $_POST['username']
        ];
        $msgSuccess = 'Vous avez bien été enregistré';
//            echo '<script> location.replace("index.php?login=true"); </script>';
        header('Location: index.php?login=true');
//            $queryUser = "SELECT * FROM `user`";
//            $query = sprintf("INSERT INTO `user` (user_firstname, user_email, user_password, user_date) VALUE ('%s', '%s', '%s')", $_POST['firstname'],$_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT));
//            $row = $db->Query($query);
    }catch (Exception $e){
        var_dump($e->getMessage());
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