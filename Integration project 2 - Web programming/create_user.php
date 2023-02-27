<?php

include ('conection.php');
include ('protect.php');

if(isset($_POST['submit'])){

include ('conection.php');
include ('protect.php');

        $full_name = $mysqli->real_escape_string($_POST['full_name']);
        $street_number = $mysqli->real_escape_string($_POST['street_number']);
        $street_name = $mysqli->real_escape_string($_POST['street_name']);
        $city = $mysqli->real_escape_string($_POST['city']);
        $province = $mysqli->real_escape_string($_POST['province']);
        $phone = $mysqli->real_escape_string($_POST['phone']);
        $email = $mysqli->real_escape_string($_POST['email']);
        $password = $mysqli->real_escape_string($_POST['password']);
        $user_type_code = $mysqli->real_escape_string($_POST['user_type_code']);

        $result = mysqli_query($mysqli,"INSERT INTO users(full_name, street_number, street_name, city, province, phone, email, pwd, user_type_code) 
        VALUES ('$full_name','$street_number','$street_name','$city','$province','$phone','$email','$password','$user_type_code')");
        echo "<div id='success-message'>User successfully registered!</div>";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style_homepage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <title>Register User</title>
</head>
<body>
    <h6 class="bg-dark-subtle">
        Welcome to Painel, <?php echo $_SESSION['user'];?>
        <br>
    </h6>
    <a href="logout.php">Logout</a>
    <a name="back" href="#" onclick="redirect()">Back to Menu</a>
    <br><br><br><br>
    <div id="container" class="container">
    <h2>USER REGISTRATION</h2>
    <form action="create_user.php" method="post" onsubmit="return verifypassword();">
        <p style="text-align: left;">
            <label>Name: </label><input type="text" name="full_name" placeholder="Enter the user's full name" required><br>
            <label>Address: </label><input type="text" name="street_number" placeholder="Street Number" maxlength="6" style="width: 150px; margin-right:0%;" required>
            <input type="text" name="street_name" placeholder="Street Name" maxlength="50" style="width: 400px; margin:0% auto;" required>
            <input type="text" name="city" placeholder="City" maxlength="20" style="width: 200px; margin:0% auto;" required>
            <input type="text" name="province" placeholder="Province" maxlength="2" style="width: 100px; margin-left:0%;" required><br>
            <label>Phone: </label><input type="tel" name="phone" placeholder="Phone Number" maxlength="10" required>
            <label>E-mail: </label><input type="email" name="email" placeholder="E-mail" maxlength="50" style="width: 400px;" required><br>
            <label>User Type: </label>
            <label>Member</label><input type="radio" name="user_type_code" value="M" style="margin-right: 40px;" required>
            <label>Employee</label><input type="radio" name="user_type_code" value="E" style="margin-right: 40px;" required>
            <label>Administrator</label><input type="radio" name="user_type_code" value="A" style="margin-right: 40px;" required><br>
            <label>Password: </label><input id="password"  type="password" name="password" placeholder="Password" maxlength="16" required>
            <label>Confirm Password: </label><input id="confirm-password" type="password" name="confirm-password" placeholder="Confirm Password" maxlength="16" required><br>
        
        </p>
        <div id="error-message" class="hidden" style="display: none;">Password didn't match!</div>
        <input type="submit" name="submit" value="Submit">
    </form>
    <script>
        function verifypassword(){
            var pwd1 = document.getElementById("password").value;
            var pwd2 = document.getElementById("confirm-password").value;
            if (pwd1 != pwd2){
                alert("The didn't match!");
                return false;
            }
            return true;
        };

        setTimeout(function() {
        document.getElementById("success-message").style.display = "none";
        }, 3000);
    </script>
    </div>
    <script>
        function redirect() {
            var user_type_code = "<?php echo $_SESSION['user_type_code']; ?>";
            if (user_type_code == "E") {
                window.location.href = "painel_E.php";
            } else if (user_type_code == "A") {
                window.location.href = "painel_A.php";
            }
        }
    </script>
</body>
</html>

