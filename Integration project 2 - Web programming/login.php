<?php
include('conection.php');

if (isset($_POST['email']) || isset($_POST['password'])) {
    if(strlen($_POST['email']) == 0) {
        echo "Please enter your e-mail!";
    } else if(strlen($_POST['password']) == 0){
        echo "Please enter your password!";
    } else {
        //Cleaning up login inputs to prevent SQL injection practices.
        //Note: The $mysqli variable can be found in the conection.php file
        $email = $mysqli->real_escape_string($_POST['email']);
        $password = $mysqli->real_escape_string($_POST['password']);

        $sql_code = "SELECT * FROM users WHERE email = '$email' AND BINARY pwd = '$password'";
        $sql_query = $mysqli->query($sql_code) or die("SQL code execution failed: ".$mysqli->error);

        $quantity = $sql_query->num_rows;

        //If the DB search matches a registered user, the session starts
        if($quantity == 1) {
             $user = $sql_query->fetch_assoc();

             if(!isset($_SESSION)){
                session_start();
             }

             $_SESSION['user'] = $user['email'];
             $_SESSION['user_type_code'] = $user['user_type_code'];
             if ($_SESSION['user_type_code'] == 'A'){
                header("Location: painel_A.php");
             } else if ($_SESSION['user_type_code'] == 'E'){
                header("Location: painel_E.php");
             } else if ($_SESSION['user_type_code'] == 'M'){
                header("Location: painel_M.php");
             }
             
        } else {
            echo "Login failed! Incorrect e-mail or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style_login.css">
    <title>Port-Cartier Municipal Library: Log In</title>
</head>
<body>
    <h1>Welcome to Port-Cartier Municipal Library</h1>
    <div id="form-container">
        <form action="" method="POST">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" value="Sign In">
        </form>
    </div>
</body>
</html>