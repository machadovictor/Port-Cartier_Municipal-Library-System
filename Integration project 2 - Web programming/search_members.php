<?php
include ('conection.php');
include ('protect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style_homepage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <title>Consulting Members</title>
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
    <form action="">
        <input type="text" name="search" placeholder="Enter User ID To Filter Your Search">
        <input type="submit" value="Search">
        <br>
        <h2>LIST OF MEMBERS</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Member</th>
                <th>St. Number</th>
                <th>St. Name</th>
                <th>City</th>
                <th>Province</th>
                <th>Phone</th>
                <th>E-mail</th>
            </tr>
            <?php
                if(!isset($_GET['search'])) {
                    ?>
                <tr>
                    <td colspan="9">Enter a User ID or just click search.</td>
                </tr>
                <?php
                } else {
                $search = $mysqli->real_escape_string($_GET['search']);
                $sql_code = "SELECT *
                    FROM users
                    WHERE user_type_code = 'M'
                    AND (user_code LIKE '%$search')";
                $sql_query = $mysqli->query($sql_code) or die("Query Error! " . $mysqli->error);

                if($sql_query->num_rows == 0) {
            ?>
            <tr>
                <td colspan="9">No results found!</td>
            </tr>
            <?php
                } else {
                   while ($data1 = $sql_query->fetch_assoc()) {
                    extract($data1);
                    ?>
                    <tr>
                        <td><?php echo "$user_code"?></td>
                        <td><?php echo $data1['full_name']?></td>
                        <td><?php echo $data1['street_number']?></td>
                        <td><?php echo $data1['street_name']?></td>
                        <td><?php echo $data1['city']?></td>
                        <td><?php echo $data1['province']?></td>
                        <td><?php echo $data1['phone']?></td>
                        <td><?php echo $data1['email']?></td>
                    </tr>
                    <?php
                   }
                }     
            ?>
            <?php } ?>
        </table>
        <br>
        <h2>LIST OF BORROWED DOCUMENTS:</h2>
        <table> <!-- style="display:none"; -->
                <tr>
                    <th>ID User</th>
                    <th>ID Document</th>
                    <th>Loan Date</th>
                    <th>Return Date</th>
                    <th>Loan Status</th>
            </tr>
            <?php
                if(!isset($_GET['search'])) {
                    ?>
                <tr>
                    <td colspan="5">Enter a User ID or just click search.</td>
                </tr>
                <?php
                } else {
                $search = $mysqli->real_escape_string($_GET['search']);
                $sql_code = "SELECT *
                    FROM loans
                    WHERE user_code LIKE '%$search'";
                $sql_query = $mysqli->query($sql_code) or die("Query Error! " . $mysqli->error);

                if($sql_query->num_rows == 0) {
            ?>
            <tr>
                <td colspan="9">No results found!</td>
            </tr>
            <?php
                } else {
                   while ($data1 = $sql_query->fetch_assoc()) {
                    extract($data1);
                    ?>
                    <tr>
                        <td><?php echo $data1['user_code']?></td>
                        <td><?php echo $data1['document_id']?></td>
                        <td><?php echo $data1['loan_date']?></td>
                        <td><?php echo $data1['return_date']?></td>
                        <td><?php echo $data1['loan_status']?></td>
                    </tr>
                    <?php
                   }
                }     
            unset($_GET['search']);
            ?>
            <?php } ?>
        </table>
    </form><br>
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